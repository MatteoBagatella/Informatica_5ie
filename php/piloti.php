<?php
require 'connect.php';

$stmt = $conn->query("SELECT * FROM piloti");
$piloti = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>F1 2026 Piloti</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<h1>Piloti F1 2026</h1>

<div class="grid">

<?php foreach ($piloti as $p): ?>

<a href="pilota.php?id=<?= $p['id'] ?>" class="card">

    <img src="<?= htmlspecialchars($p['foto_pilota']) ?>" class="pilota">

    <img src="<?= htmlspecialchars($p['foto_team']) ?>" class="team">

    <h2><?= htmlspecialchars($p['nome']) ?> <?= htmlspecialchars($p['cognome']) ?></h2>

    <p>#<?= htmlspecialchars($p['numero']) ?></p>

</a>

<?php endforeach; ?>

</div>

</body>
</html>