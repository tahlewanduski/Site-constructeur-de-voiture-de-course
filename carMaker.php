<?php
/*
 * On indique que les chemins des fichiers qu'on inclut
 * seront relatifs au répertoire src.
 */
set_include_path("./src");

/* Inclusion des classes utilisées dans ce fichier */
require_once("Router.php");
require_once('src/model/CarMakerStorageMySQL.php');
require_once('/users/22003660/private/mysql_config.php');

/*
 * Cette page est simplement le point d'arrivée de l'internaute
 * sur notre site. On se contente de créer un routeur
 * et de lancer son main.
 */
$dsn = "mysql:host=" . MYSQL_HOST .";port=". MYSQL_PORT .";dbname=". MYSQL_DB.";charset=utf8";
$user = MYSQL_USER;
$password = MYSQL_PASSWORD;
$pdo = new PDO($dsn, $user, $password);
$router = new Router();
$router->main(new CarMakerStorageMySQL($pdo));
?>