<?php
require 'connect.php';

$stmt = $conn->query("SELECT * FROM pilota");
$piloti = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>F1 2026 Piloti</title>
    <link rel="stylesheet" href="../css/styleHome.css">
</head>

<body>

<h1>Piloti F1 2026</h1>

<div class="grid">

<?php foreach ($piloti as $p): ?>

<a href="pilota.php?id=<?= $p['numPilota'] ?>" class="card">

    <img src="<?= htmlspecialchars($p['fotoPilota']) ?>" class="pilota">

    <img src="<?= htmlspecialchars($p['logoTeam']) ?>" class="team">

    <h2><?= htmlspecialchars($p['nomePilota']) ?> <?= htmlspecialchars($p['cognomePilota']) ?></h2>

    <p>#<?= htmlspecialchars($p['numPilota']) ?></p>

</a>

<?php endforeach; ?>

</div>

</body>
</html>