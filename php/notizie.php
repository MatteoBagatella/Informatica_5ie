<?php
session_start();
require 'connect.php';

$stmt = $conn->query("SELECT * FROM notizia");
$notizie = [];
while ($n = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $notizie[$n['id_div']] = $n;
}

function notizia($notizie, $id) {
    $n = $notizie[$id] ?? null;
    $img = $n ? htmlspecialchars($n['percorsoImmagine']) : '';
    $desc = $n ? htmlspecialchars($n['descrizione']) : '';
    echo "
    <div class='notizia-box' id='$id' style='background-image: url(\"$img\")'>
        <div class='notizia-overlay'>
            <p>$desc</p>
        </div>
    </div>";
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>F1 - Notizie</title>
    <link rel="stylesheet" href="../css/notizieStyle.css">
</head>
<body>

<h1>NOTIZIE PIU' RECENTI</h1>

<main>

    <!-- RIGA 1 -->
    <div class="row row-1">
        <?php notizia($notizie, 'div1'); ?>
        <div class="col-right">
            <?php notizia($notizie, 'div2'); ?>
            <?php notizia($notizie, 'div3'); ?>
        </div>
    </div>

    <!-- RIGA 2 -->
    <div class="row row-2">
        <?php notizia($notizie, 'div4'); ?>
        <?php notizia($notizie, 'div5'); ?>
        <?php notizia($notizie, 'div6'); ?>
        <?php notizia($notizie, 'div7'); ?>
        <?php notizia($notizie, 'div8'); ?>
    </div>

    <!-- RIGA 3 -->
    <div class="row row-3">
        <?php notizia($notizie, 'div9'); ?>
        <?php notizia($notizie, 'div10'); ?>
    </div>

</main>

</body>
</html>