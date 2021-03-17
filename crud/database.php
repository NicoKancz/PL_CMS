<?php
require_once './databaseInfo.php';

function connect_db($host, $db, $un, $pw):PDO{
    $conn = new PDO("mysql:host=$host;dbname=$db", $un, $pw);

    return $conn;
}

function close_db($conn){
    $conn = null;
}
