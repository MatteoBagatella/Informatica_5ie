<?php
session_start();
require 'connect.php';

$nome = $_GET['nome'] ?? null;

$stmt = $conn->prepare("SELECT * FROM pista WHERE nomePista = ?");
$stmt->execute([$nome]);
$pista = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pista) {
    die("Pista non trovata");
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pista['nomePista']) ?></title>
    <link rel="stylesheet" href="../css/styleHome.css">
    <link rel="stylesheet" href="../css/stylePistaDetail.css">
</head>
<body>


<div class="hero-pista">
    <div class="hero-info">
        <p class="nazione"><?= htmlspecialchars($pista['nazione']) ?></p>
        <h1><?= htmlspecialchars($pista['nomePista']) ?></h1>
        <p class="anno">Dal <?= htmlspecialchars($pista['annoPrimoGP']) ?></p>
    </div>
    <div class="hero-img">
        <img src="<?= htmlspecialchars($pista['imgPista']) ?>" alt="<?= htmlspecialchars($pista['nomePista']) ?>">
    </div>
</div>

<main>
    <h2>STATISTICHE</h2>

    <div class="stats">
        <div class="stat-row">
            <span class="stat-label">Nazione</span>
            <span class="stat-value"><?= htmlspecialchars($pista['nazione']) ?></span>
        </div>
        <div class="stat-row">
            <span class="stat-label">Lunghezza</span>
            <span class="stat-value"><?= number_format($pista['lunghezza']) ?> m</span>
        </div>
        <div class="stat-row">
            <span class="stat-label">Curve</span>
            <span class="stat-value"><?= htmlspecialchars($pista['nCurve']) ?></span>
        </div>
        <div class="stat-row">
            <span class="stat-label">Giri</span>
            <span class="stat-value"><?= htmlspecialchars($pista['giri']) ?></span>
        </div>
        <div class="stat-row">
            <span class="stat-label">Record pista</span>
            <span class="stat-value"><?= htmlspecialchars($pista['recordPista']) ?></span>
        </div>
        <div class="stat-row">
            <span class="stat-label">Primo GP</span>
            <span class="stat-value"><?= htmlspecialchars($pista['annoPrimoGP']) ?></span>
        </div>
        <div class="stat-row">
            <span class="stat-label">Prezzo biglietto</span>
            <span class="stat-value">€<?= number_format($pista['prezzoBiglietto'], 2) ?></span>
        </div>
    </div>
</main>

</body>
</html>