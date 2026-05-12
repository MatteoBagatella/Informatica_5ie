<?php
require 'connect.php';

$id = $_GET['id'] ?? null;

$stmt = $conn->prepare("SELECT * FROM pilota WHERE numPilota = ?");
$stmt->execute([$id]);

$pilota = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pilota) {
    die("Pilota non trovato");
}

$teamNames = [
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

$teamClass = $teamNames[$pilota['idTeam']] ?? 'default';
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pilota['nomePilota']) ?> <?= htmlspecialchars($pilota['cognomePilota']) ?></title>
    <link rel="stylesheet" href="../css/stylePilota.css">
</head>

<body>

<header>
    <a href="piloti.php" class="back">← Piloti</a>
</header>

<!-- HERO -->
<div class="hero team-<?= $teamClass ?>">
    <div class="hero-numero"><?= htmlspecialchars($pilota['numPilota']) ?></div>

    <div class="hero-info">
        <img src="<?= htmlspecialchars($pilota['logoTeam']) ?>" class="logo-team" alt="Logo team">
        <p class="nome"><?= htmlspecialchars($pilota['nomePilota']) ?></p>
        <h1><?= htmlspecialchars($pilota['cognomePilota']) ?></h1>
        <div class="hero-meta">
            <span><?= htmlspecialchars($pilota['nazionalita']) ?></span>
            <span class="sep">|</span>
            <span><?= htmlspecialchars($pilota['dataNascitaPilota']) ?></span>
        </div>
    </div>

    <div class="hero-foto">
        <img src="<?= htmlspecialchars($pilota['fotoPilota']) ?>" class="foto-pilota" alt="">
    </div>
</div>

<!-- STATS -->
<main>
    <h2 class="stats-title">STATISTICHE CARRIERA</h2>

    <div class="stats">

        <div class="stat-row">
            <span class="stat-label">Gare disputate</span>
            <span class="stat-value"><?= htmlspecialchars($pilota['gareDisputatePilota']) ?></span>
        </div>

        <div class="stat-row">
            <span class="stat-label">Vittorie</span>
            <span class="stat-value"><?= htmlspecialchars($pilota['vittoriePilota']) ?></span>
        </div>

        <div class="stat-row">
            <span class="stat-label">Podi</span>
            <span class="stat-value"><?= htmlspecialchars($pilota['podiPilota']) ?></span>
        </div>

        <div class="stat-row">
            <span class="stat-label">Pole Position</span>
            <span class="stat-value"><?= htmlspecialchars($pilota['polePilota']) ?></span>
        </div>

        <div class="stat-row">
            <span class="stat-label">Campionati vinti</span>
            <span class="stat-value"><?= htmlspecialchars($pilota['nCampioniPilota']) ?></span>
        </div>

        <div class="stat-row">
            <span class="stat-label">DNF</span>
            <span class="stat-value"><?= htmlspecialchars($pilota['dnf']) ?></span>
        </div>

    </div>
</main>

</body>
</html>