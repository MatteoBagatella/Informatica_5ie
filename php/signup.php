<?php
session_start();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Sign Up F1</title>
    <link rel="stylesheet" href="../css/loginStyle.css">
</head>

<body>

<div class="box">
    <div class="logo">SIGN UP</div>
    <h4 class="scritta">INSERISCI I TUOI DATI</h4>

    <form action="" method="POST">
        <div class="input-group">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="text" name="cognome" placeholder="Cognome" required>
            <input type="date" class="input-date">
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit">SIGN UP</button>
    </form>

    

</div>

</body>
</html>