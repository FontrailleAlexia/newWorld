<?php
$db_user = 'root';
$db_pass = '';
$db_host = 'localhost';
$db_name = 'newWorld';

// Connecteur PDO de connexion à la bdd mysql
$laBase = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die('Echec de la connexion : ' . mysqli_connect_error());
mysqli_set_charset($laBase, "utf8");
?>