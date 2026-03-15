<?php
require_once './ConnexionBDD.php';
session_start();

$bdd = new ConnexionBDD();
$_SESSION['BDD'] = '';

include_once './user/form.connexion.html';