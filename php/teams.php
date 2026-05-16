<?php
require 'connect.php';

$stmt = $conn->query("SELECT * FROM team");
$teams = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>F1 2026 - Team</title>
    <link rel="stylesheet" href="../css/styleTeams.css">
</head>
<body>

<div class="titolo-wrap">
    <h1>TEAM UFFICIALI 2026</h1>
</div>

<div class="grid">
    <?php foreach ($teams as $t):
        $classe = $teamColors[$t['idTeam']] ?? 'default';
    ?>
    <a href="teamDetail.php?id=<?= $t['idTeam'] ?>" class="card team-<?= $classe ?>">

        <div class="card-top">
            <div class="card-info">
                <h2><?= htmlspecialchars($t['nomeTeam']) ?></h2>
            </div>
            <div class="logo-wrap">
                <img src="<?= htmlspecialchars($t['logoTeam']) ?>" class="logo-team" alt="Logo">
            </div>
        </div>

        <div class="card-macchina">
            <img src="<?= htmlspecialchars($t['fotoMacchina']) ?>" class="macchina" alt="<?= htmlspecialchars($t['nomeTeam']) ?>">
        </div>

    </a>
    <?php endforeach; ?>
</div>

</body>
</html>