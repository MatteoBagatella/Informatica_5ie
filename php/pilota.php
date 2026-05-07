<?php
require 'connect.php';

$id = $_GET['id'] ?? null;

$stmt = $conn->prepare("SELECT * FROM piloti WHERE id = ?");
$stmt->execute([$id]);

$pilota = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pilota) {
    die("Pilota non trovato");
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pilota['nome']) ?></title>
</head>

<body>

<a href="piloti.php">← Torna</a>

<h1><?= htmlspecialchars($pilota['nome']) ?> <?= htmlspecialchars($pilota['cognome']) ?></h1>

<img src="<?= htmlspecialchars($pilota['foto_pilota']) ?>" width="250">

<img src="<?= htmlspecialchars($pilota['foto_team']) ?>" width="150">

<p>Team: <?= htmlspecialchars($pilota['team']) ?></p>
<p>Numero: <?= htmlspecialchars($pilota['numero']) ?></p>
<p>Nazionalità: <?= htmlspecialchars($pilota['nazionalita']) ?></p>

</body>
</html>