<?php
require 'connect.php';

$teamOrder = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];

$placeholders = implode(',', array_fill(0, count($teamOrder), '?'));    
// Crea una stringa di placeholder "?" separati da virgola (uno per ogni team)
// usati nella query per ordinare i piloti secondo l'ordine specificato in $teamOrder
$stmt = $conn->prepare("SELECT * FROM pilota ORDER BY FIELD(idTeam, " . $placeholders . "), numPilota ASC");
$stmt->execute($teamOrder);
$piloti = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Mappa idTeam -> classe CSS
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
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>F1 2026 Piloti</title>
    <link rel="stylesheet" href="../css/stylePiloti.css">
    
</head>

<body>

<h1>Piloti ufficiali del 2026</h1>

<div class="grid">

<?php foreach ($piloti as $p):
    $teamClass = $teamNames[$p['idTeam']] ?? 'default';
?>

<a href="pilota.php?id=<?= $p['numPilota'] ?>" class="card team-<?= $teamClass ?>">

    <div class="card-info">
        <p class="nome"><?= htmlspecialchars($p['nomePilota']) ?></p>
        <h2><?= htmlspecialchars($p['cognomePilota']) ?></h2>
        <p class="num">#<?= htmlspecialchars($p['numPilota']) ?></p>
        <img src="<?= htmlspecialchars($p['logoTeam']) ?>" class="logo-team" alt="Logo team">
    </div>

    <div class="pilota-wrap">
        <img src="<?= htmlspecialchars($p['fotoPilota']) ?>" class="pilota" alt="">
    </div>

</a>

<?php endforeach; ?>

</div>

</body>
</html>