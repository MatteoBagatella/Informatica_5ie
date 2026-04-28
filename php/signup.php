<?php
session_start();
require 'connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $dataNascita = $_POST["dataNascita"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("INSERT INTO utente (nome, cognome, utenteDataNascita, email, password) VALUES (:nome, :cognome, :dataNascita, :email, :password)");
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':cognome', $cognome);
    $stmt->bindValue(':dataNascita', $dataNascita);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
    
    

    if ($stmt->execute()) {
        $_SESSION['user_email'] = $email;
        header("Location: index.php");
        exit();
    } else {
        echo "Errore nella registrazione. Riprova.";
    }

    
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Sign Up F1</title>
    <link rel="stylesheet" href="../css/loginStyle.css">
</head>

<body>
<?php include 'headerDir/header.php'; ?>

<div class="box">
    <div class="logo">SIGN UP</div>
    <h4 class="scritta">INSERISCI I TUOI DATI</h4>

    <form action="" method="POST">
        <div class="input-group">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="text" name="cognome" placeholder="Cognome" required>
            <input type="date" name="dataNascita" class="input-date">
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