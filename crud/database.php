<?php
require_once 'databaseInfo.php';

function connect_db():PDO {
    $host = 'localhost';
    $database = 'PL_CMS';
    $username = 'nico';
    $password = 'Ppnssn1581996';
    $port = 3306;

    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    return $conn;
}

function close_db($conn){
    $conn = null;
}
