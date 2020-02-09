<?php include 'config.inc.php';

$pdo = new Pdo('mysql:host=185.98.131.90;dbname=' . DB_NAME, DB_USER, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
//var_dump($pdo);

const PUBLIC_URL = 'http://jhovine.fr/';

session_start();
