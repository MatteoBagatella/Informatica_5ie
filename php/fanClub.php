<?php
session_start();

require 'connect.php';

// Dati utente loggato
$stmt = $conn->prepare("SELECT * FROM utente WHERE email = ?");
$stmt->execute([$_SESSION['user_email']]);
$utente = $stmt->fetch(PDO::FETCH_ASSOC);

// Azione iscrizione
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['iscriviti'])) {
        $nomeFanClub = $_POST['nomeFanClub'];

        // Aggiorna utente
        $stmt = $conn->prepare("UPDATE utente SET nomeFanClub = ? WHERE email = ?");
        $stmt->execute([$nomeFanClub, $_SESSION['user_email']]);

        // Incrementa membri
        $stmt = $conn->prepare("UPDATE fanClub SET membri = membri + 1 WHERE nomeFanClub = ?");
        $stmt->execute([$nomeFanClub]);

    } elseif (isset($_POST['lascia'])) {
        $nomeFanClub = $_POST['nomeFanClub'];

        // Rimuovi utente dal fan club
        $stmt = $conn->prepare("UPDATE utente SET nomeFanClub = NULL WHERE email = ?");
        $stmt->execute([$_SESSION['user_email']]);

        // Decrementa membri
        $stmt = $conn->prepare("UPDATE fanClub SET membri = membri - 1 WHERE nomeFanClub = ?");
        $stmt->execute([$nomeFanClub]);
    }

    header("Location: fanClub.php");
    exit();
}

// Tutti i fan club con nome team
$stmt = $conn->query("SELECT f.*, t.nomeTeam FROM fanClub f JOIN team t ON f.idTeam = t.idTeam");
$fanClubs = $stmt->fetchAll(PDO::FETCH_ASSOC);

$teamColors = [
    1  => 'mclaren',
    2  => 'ferrari',
    3  => 'mercedes',
    4  => 'redbull',
    5  => 'astonmartin',
    6  => 'alpine',
    7  => 'haas',
    8  => 'williams',
    9  => 'audi',
    10 => 'racingbulls',
    11 => 'cadillac',
];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Fan Club</title>
    <link rel="stylesheet" href="../css/styleHome.css">
    <link rel="stylesheet" href="../css/styleFanClub.css">
</head>
<body>


<main>
    <div class="titolo-wrap">
        <h1>FAN CLUB</h1>
    </div>

    <div class="lista">
        <?php foreach ($fanClubs as $f):
            $classe = $teamColors[$f['idTeam']] ?? 'default';
            $iscritto = $utente['nomeFanClub'] === $f['nomeFanClub'];
            $haFanClub = !empty($utente['nomeFanClub']);
        ?>
        <div class="fc-card team-<?= $classe ?>">

            <div class="fc-logo">
                <img src="<?= htmlspecialchars($f['imgTeam']) ?>" alt="<?= htmlspecialchars($f['nomeTeam']) ?>">
            </div>

            <div class="fc-info">
                <p class="fc-team"><?= htmlspecialchars($f['nomeTeam']) ?></p>
                <h2><?= htmlspecialchars($f['nomeFanClub']) ?></h2>
                <p class="fc-desc"><?= htmlspecialchars($f['descrizione']) ?></p>
                <p class="fc-membri">👥 <?= number_format($f['membri']) ?> membri</p>
            </div>

            <div class="fc-azione">
                <?php if ($iscritto): ?>
                    <span class="badge-iscritto">✔ ISCRITTO</span>
                    <form method="POST">
                        <input type="hidden" name="nomeFanClub" value="<?= htmlspecialchars($f['nomeFanClub']) ?>">
                        <button type="submit" name="lascia" class="btn-lascia">LASCIA</button>
                    </form>
                <?php elseif (!$haFanClub): ?>
                    <form method="POST">
                        <input type="hidden" name="nomeFanClub" value="<?= htmlspecialchars($f['nomeFanClub']) ?>">
                        <button type="submit" name="iscriviti" class="btn-iscriviti">UNISCITI</button>
                    </form>
                <?php else: ?>
                    <span class="btn-disabilitato">GIÀ ISCRITTO AD UN ALTRO</span>
                <?php endif; ?>
            </div>

        </div>
        <?php endforeach; ?>
    </div>
</main>

</body>
</html>