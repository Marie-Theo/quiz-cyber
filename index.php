<?php
require_once './ConnexionBDD.php';
session_start();

echo $_SESSION['pseudo'];

$bdd = new ConnexionBDD();
$_SESSION['BDD'] = '';

if ( !isset($_SESSION['id']) ) {
    include_once './user/form.connexion.php';
}

session_destroy();