<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF8");
header('Content-Type: text/plain');
date_default_timezone_set('Asia/Bangkok');

$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'my_vue_vuetify';

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error : (' . $e->getCode() . ') ' . $e->getMessage());
}
