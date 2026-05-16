<?php
session_start();
require 'connect.php';

$stmt = $conn->prepare("SELECT u.*, a.tipo, a.numPiste FROM utente u LEFT JOIN abbonamento a ON u.idAbbonamento = a.idAbbonamento WHERE u.email = ?");
$stmt->execute([$_SESSION['user_email']]);
$utente = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt2 = $conn->prepare("SELECT * FROM ticket WHERE utenteId = ?");
$stmt2->execute([$utente['utenteId']]);
$tickets = $stmt2->fetchAll(PDO::FETCH_ASSOC);

function mostraTicket($tickets) {
    if (count($tickets) > 0) {
        foreach ($tickets as $t) {
            echo "<div class='riga'>
                <span>" . htmlspecialchars($t['nomePista']) . "</span>
                <span>€" . number_format($t['prezzo'], 2) . "</span>
            </div>";
        }
    } else {
        echo "<p class='vuoto'>Nessun ticket</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Area Personale</title>    
    <link rel="stylesheet" href="../css/styleArea.css">
</head>
<body>



<div class="area-main">

    <h1><?= strtoupper(substr($utente['nome'],0,1)) ?>. <?= strtoupper($utente['cognome']) ?></h1>
    <p class="sub"><?= htmlspecialchars($utente['email']) ?></p>

    <div class="blocco">
        <div class="riga"><span>Nome</span><span><?= htmlspecialchars($utente['nome']) ?></span></div>
        <div class="riga"><span>Cognome</span><span><?= htmlspecialchars($utente['cognome']) ?></span></div>
        <div class="riga"><span>Data di nascita</span><span><?= htmlspecialchars($utente['utenteDataNascita']) ?></span></div>
        <div class="riga"><span>Fan Club</span><span><?= $utente['nomeFanClub'] ? htmlspecialchars($utente['nomeFanClub']) : '—' ?></span></div>
        <div class="riga"><span>Abbonamento</span><span><?= $utente['tipo'] ?? '—' ?></span></div>
    </div>

    <div class="blocco">
        <p class="blocco-titolo">TICKET - <?= count($tickets) ?></p>
        <?= mostraTicket($tickets) ?>
    </div>

</div>

<div style="text-align: center; margin-top: 30px;">
    <a href="logout.php" class="logout">Log out</a>
</div>

</body>
</html>