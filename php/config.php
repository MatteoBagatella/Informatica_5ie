<?php

    $host = 'localhost';
    $db = 'SitoWebF1';
    $user = 'root';
    $password = '';

    try{
        $conn = new PDO("mysql:host=$host;db=$db", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Errore di connessione: " . $e->getMessage();
    }
?>