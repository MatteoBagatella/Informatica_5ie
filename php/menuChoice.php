<?php

$json = file_get_contents('../pages.json');

// restituisce il nome del file della pagina corrente, es. "notizie.php"
$pageName = basename($_SERVER['PHP_SELF']);

$obj = json_decode($json);


// in_array() restituisce true se $pageName è presente nell'array $obj->loggedInPages
if(in_array($pageName, $obj->loggedInPages)){
    require 'headerDir/headerLogged.php';
}

if(in_array($pageName, $obj->DBPages)){
    //require_once('DBHandler.php');
}

if(in_array($pageName, $obj->userpages)){
    if (isset($_SESSION['user_email'])) {
        include 'headerDir/headerLogged.php';
    } else {
        include 'headerDir/header.php';
    }
    // include ad.php;
}elseif(in_array($pageName, $obj->adminpages)){
    include 'adminMenu.php';
}
//}
