<?php
session_start();
require 'connect.php';

// Utente loggato
$stmt = $conn->prepare("SELECT u.*, a.tipo, a.numPiste FROM utente u LEFT JOIN abbonamento a ON u.idAbbonamento = a.idAbbonamento WHERE u.email = ?");
$stmt->execute([$_SESSION['user_email']]);
$utente = $stmt->fetch(PDO::FETCH_ASSOC);

// Azioni POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Acquisto ticket
    if (isset($_POST['acquista'])) {
        $nomePista = $_POST['nomePista'];
        $stmt = $conn->prepare("SELECT prezzoBiglietto FROM pista WHERE nomePista = ?");
        $stmt->execute([$nomePista]);
        $pista = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $stmt = $conn->prepare("INSERT INTO ticket (nomePista, prezzo, utenteId) VALUES (?, ?, ?)");
        $stmt->execute([$nomePista, $pista['prezzoBiglietto'], $utente['utenteId']]);
    }

    // Elimina ticket
    if (isset($_POST['elimina_ticket'])) {
        $idTicket = $_POST['idTicket'];
        $stmt = $conn->prepare("DELETE FROM ticket WHERE idTicket = ? AND utenteId = ?");
        $stmt->execute([$idTicket, $utente['utenteId']]);
    }

    // Acquisto abbonamento
    if (isset($_POST['acquista_abbonamento'])) {
        $idAbbonamento = $_POST['idAbbonamento'];
        $stmt = $conn->prepare("UPDATE utente SET idAbbonamento = ? WHERE email = ?");
        $stmt->execute([$idAbbonamento, $_SESSION['user_email']]);
    }

    // Elimina abbonamento
    if (isset($_POST['elimina_abbonamento'])) {
        $stmt = $conn->prepare("UPDATE utente SET idAbbonamento = NULL WHERE email = ?");
        $stmt->execute([$_SESSION['user_email']]);
    }

    header("Location: ticketAbbonamenti.php");
    exit();
}

// Piste
$piste = $conn->query("SELECT * FROM pista ORDER BY nomePista")->fetchAll(PDO::FETCH_ASSOC);

// Ticket utente
$stmt = $conn->prepare("SELECT * FROM ticket WHERE utenteId = ?");
$stmt->execute([$utente['utenteId']]);
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Abbonamenti
$abbonamenti = $conn->query("SELECT * FROM abbonamento ORDER BY idAbbonamento")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ticket & Abbonamenti</title>
    <link rel="stylesheet" href="../css/styleHome.css">
    <link rel="stylesheet" href="../css/styleTicket.css">
</head>
<body>


<main>

    <!-- SEZIONE TICKET -->
    <div class="sezione-titolo">
        <h1>TICKET</h1>
    </div>

    <div class="due-colonne">

        <!-- Acquisto -->
        <div class="blocco-scuro">
            <h3>ACQUISTA TICKET</h3>
            <form method="POST">
                <select name="nomePista">
                    <?php foreach ($piste as $p): ?>
                        <option value="<?= htmlspecialchars($p['nomePista']) ?>">
                            <?= htmlspecialchars($p['nomePista']) ?> — €<?= number_format($p['prezzoBiglietto'], 2) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="acquista" class="btn-rosso">ACQUISTA</button>
            </form>
        </div>

        <!-- Ticket acquistati -->
        <div class="blocco-scuro">
            <h3>I MIEI TICKET (<?= count($tickets) ?>)</h3>
            <?php if (count($tickets) > 0): ?>
                <?php foreach ($tickets as $t): ?>
                <div class="riga-ticket">
                    <span><?= htmlspecialchars($t['nomePista']) ?></span>
                    <span>€<?= number_format($t['prezzo'], 2) ?></span>
                    <form method="POST" style="margin:0">
                        <input type="hidden" name="idTicket" value="<?= $t['idTicket'] ?>">
                        <button type="submit" name="elimina_ticket" class="btn-elimina">✕</button>
                    </form>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="vuoto">Nessun ticket acquistato</p>
            <?php endif; ?>
        </div>

    </div>

    <!-- SEZIONE ABBONAMENTI -->
    <div class="sezione-titolo">
        <h1>ABBONAMENTI</h1>
    </div>

    <div class="abbonamenti-grid">
        <?php foreach ($abbonamenti as $a):
            $attivo = $utente['idAbbonamento'] == $a['idAbbonamento'];
            $haAbbonamento = !empty($utente['idAbbonamento']);
        ?>
        <div class="abb-card <?= $attivo ? 'attivo' : '' ?>">
            <h3><?= htmlspecialchars($a['tipo']) ?></h3>
            <p class="abb-piste"><?= $a['numPiste'] ?> piste incluse</p>

            <?php if ($attivo): ?>
                <span class="badge-attivo">✔ ATTIVO</span>
                <form method="POST">
                    <button type="submit" name="elimina_abbonamento" class="btn-elimina-abb">DISDICI</button>
                </form>
            <?php elseif (!$haAbbonamento): ?>
                <form method="POST">
                    <input type="hidden" name="idAbbonamento" value="<?= $a['idAbbonamento'] ?>">
                    <button type="submit" name="acquista_abbonamento" class="btn-rosso">ATTIVA</button>
                </form>
            <?php else: ?>
                <span class="disabilitato">HAI GIÀ UN ABBONAMENTO</span>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>

</main>

</body>
</html>