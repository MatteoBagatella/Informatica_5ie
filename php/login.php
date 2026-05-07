<?php
session_start();
require 'connect.php';

$errore = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pass = $_POST["password"];

    // Cerca utente nel DB
    $stmt = $conn->prepare("SELECT * FROM utente WHERE email = :email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    $utente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utente && password_verify($pass, $utente['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_email'] = $utente['email'];

        header("Location: notizie.php");
        exit();
    } else {
        $errore = "Credenziali errate";
    }
}
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

    <?php if (isset($errore)): ?>
        <p class="error"><?php echo $errore; ?></p>
    <?php endif; ?>

</div>

</body>
</html>