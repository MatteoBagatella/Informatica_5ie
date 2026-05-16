<?php
session_start();
require 'connect.php';

$stmt = $conn->query("SELECT * FROM pista ORDER BY nomePista");
$piste = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>F1 2026 - Piste</title>
    <link rel="stylesheet" href="../css/styleHome.css">
    <link rel="stylesheet" href="../css/stylePiste.css">
</head>
<body>

<div class="titolo-wrap">
    <h1>PISTE F1 2026</h1>
</div>

<div class="grid">
    <?php foreach ($piste as $p): ?>
    <a href="pista.php?nome=<?= urlencode($p['nomePista']) ?>" class="card-pista">
        <div class="pista-img">
            <img src="<?= htmlspecialchars($p['imgPista']) ?>" alt="<?= htmlspecialchars($p['nomePista']) ?>">
        </div>
        <div class="pista-info">
            <p class="pista-nazione"><?= htmlspecialchars($p['nazione']) ?></p>
            <h2><?= htmlspecialchars($p['nomePista']) ?></h2>
            <div class="pista-stats">
                <span><?= number_format($p['lunghezza']) ?> m</span>
                <span><?= $p['nCurve'] ?> curve</span>
                <span><?= $p['giri'] ?> giri</span>
            </div>
        </div>
    </a>
    <?php endforeach; ?>
</div>

</body>
</html>