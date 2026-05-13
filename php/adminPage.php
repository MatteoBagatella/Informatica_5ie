<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
require 'connect.php';

$stmt = $conn->query("SELECT * FROM notizia");
$notizie = [];
while ($n = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $notizie[$n['id_div']] = $n;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_div = $_POST['id_div'];
    $descrizione = $_POST['descrizione'];
    $percorsoImmagine = $_POST['percorsoImmagine'];

    $check = $conn->prepare("SELECT * FROM notizia WHERE id_div = ?");
    $check->execute([$id_div]);

    if ($check->fetch()) {
        $stmt = $conn->prepare("UPDATE notizia SET descrizione = ?, percorsoImmagine = ? WHERE id_div = ?");
        $stmt->execute([$descrizione, $percorsoImmagine, $id_div]);
    } else {
        $stmt = $conn->prepare("INSERT INTO notizia (descrizione, percorsoImmagine, id_div) VALUES (?, ?, ?)");
        $stmt->execute([$descrizione, $percorsoImmagine, $id_div]);
    }
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Admin - Notizie</title>
    <link rel="stylesheet" href="../css/styleAdmin.css">
</head>
<body>

<header>
    <span class="title">GESTIONE NOTIZIE</span>
    <a href="logout.php" class="logout">Esci</a>
</header>

<main>


<form method="POST">

    <div class="form-group">
        <label>Seleziona div</label>
        <select name="id_div" id="id_div" onchange="caricaNotizia(this.value)">
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <option value="div<?= $i ?>">div<?= $i ?></option>
            <?php endfor; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Descrizione</label>
        <textarea name="descrizione" id="descrizione" rows="3"></textarea>
    </div>

    <div class="form-group">
        <label>URL Immagine</label>
        <input type="text" name="percorsoImmagine" id="percorsoImmagine" placeholder="https://...">
    </div>

    <div class="preview-wrap">
        <p class="preview-label">Anteprima immagine</p>
        <div class="preview" id="preview"></div>
    </div>

    <button type="submit">SALVA</button>

</form>
</main>

<script>
const notizie = <?= json_encode($notizie) ?>;

function caricaNotizia(id) {
    const n = notizie[id];
    document.getElementById('descrizione').value = n ? n.descrizione : '';
    const img = n ? n.percorsoImmagine : '';
    document.getElementById('percorsoImmagine').value = img;
    document.getElementById('preview').style.backgroundImage = img ? `url('${img}')` : 'none';
}

document.getElementById('percorsoImmagine').addEventListener('input', function() {
    document.getElementById('preview').style.backgroundImage = this.value ? `url('${this.value}')` : 'none';
});

// carica subito il primo
caricaNotizia('div1');
</script>

</body>
</html>