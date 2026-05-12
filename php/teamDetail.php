<?php
require 'connect.php';

$id = $_GET['id'] ?? null;

// Prendo i dati del team
$stmt = $conn->prepare("SELECT * FROM team WHERE idTeam = ?");
$stmt->execute([$id]);
$team = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$team) {
    die("Team non trovato");
}

// Prendo i piloti del team
$stmt2 = $conn->prepare("SELECT * FROM pilota WHERE idTeam = ?");
$stmt2->execute([$id]);
$piloti = $stmt2->fetchAll(PDO::FETCH_ASSOC);

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

$teamClass = $teamColors[$team['idTeam']] ?? 'default';
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($team['nomeTeam']) ?></title>
    <link rel="stylesheet" href="../css/styleTeamDetail.css">
</head>
<body>

<header>
    <a href="teams.php" class="back">← Team</a>
</header>

<!-- HERO -->
<div class="hero team-<?= $teamClass ?>">

    <div class="hero-macchina">
        <img src="<?= htmlspecialchars($team['fotoMacchina']) ?>" class="macchina" alt="<?= htmlspecialchars($team['nomeTeam']) ?>">
    </div>

    <h1 class="nomeTeam"><?= htmlspecialchars($team['nomeTeam']) ?></h1>
   
    <img src="<?= htmlspecialchars($team['logoTeam']) ?>" class="logo-team" alt="Logo">
    
    <div class="hero-piloti">
        <?php foreach ($piloti as $p): ?>
            <a href="pilota.php?id=<?= $p['numPilota'] ?>" class="pilota-link">
                <?= htmlspecialchars($p['nomePilota']) ?> <?= htmlspecialchars($p['cognomePilota']) ?>
            </a>
        <?php endforeach; ?>
    </div>

</div>


<!-- STATS -->
<main>
    <h2 class="stats-title">STATISTICHE TEAM</h2>

    <div class="stats-container">

        <div class="stat-row">
            <span class="stat-label">Gare disputate</span>
            <span class="stat-value"><?= htmlspecialchars($team['gareDisputateTeam']) ?></span>
        </div>
        <div class="stat-row">
            <span class="stat-label">Vittorie</span>
            <span class="stat-value"><?= htmlspecialchars($team['vittorieTeam']) ?></span>
        </div>
        <div class="stat-row">
            <span class="stat-label">Podi</span>
            <span class="stat-value"><?= htmlspecialchars($team['podiTeam']) ?></span>
        </div>
        <div class="stat-row">
            <span class="stat-label">Pole Position</span>
            <span class="stat-value"><?= htmlspecialchars($team['poleTeam']) ?></span>
        </div>
        <div class="stat-row">
            <span class="stat-label">Campionati costruttori</span>
            <span class="stat-value"><?= htmlspecialchars($team['nCampioniCostruttori']) ?></span>
        </div>
        <div class="stat-row">
            <span class="stat-label">Sede</span>
            <span class="stat-value"><?= htmlspecialchars($team['sede']) ?></span>
        </div>
        <div class="stat-row">
            <span class="stat-label">Primo GP</span>
            <span class="stat-value"><?= htmlspecialchars($team['annoPrimoGPTeam']) ?></span>
        </div>
        <div class="stat-row">
            <span class="stat-label">Team Principal</span>
            <span class="stat-value"><?= htmlspecialchars($team['nomeTeamPrincipal']) ?> <?= htmlspecialchars($team['cognomeTeamPrincipal']) ?></span>
        </div>

    </div>
</main>

</body>
</html>