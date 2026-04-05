<?php
session_start();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login F1</title>
    <link rel="stylesheet" href="../css/loginStyle.css">
</head>

<body>

<div class="box">
    <div class="logo">LOGIN</div>
    <h4 class="scritta">INSERISCI LE TUE CREDENZIALI</h4>

    <form action="" method="POST">
        <div class="input-group">
            <input type="text" name="email" placeholder="Email" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit">LOGIN</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $pass = $_POST["password"];

        // LOGIN DI TEST (da migliorare!)
        if ($email === "email@istituto.it" && $pass === "1234") {
            echo "<p class='success'>ACCESSO RIESCIUTO</p>";
        } else {
            echo "<p class='error'>CREDENZIALI ERRATE</p>";
        }
    }
    ?>

</div>

</body>
</html>