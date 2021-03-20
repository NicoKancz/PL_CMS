<?php
function connect_db():PDO {
    $host = 'localhost';
    $database = 'PL_CMS';
    $username = 'nico';
    $password = 'Ppnssn1581996';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        return $conn;
    }catch(PDOException $e){
        error_log($e->getMessage());
        exit('Fatal Error: Verbinding naar de database mislukt.');
    }
}

function close_db($conn){
    try{
        $conn = null;
    }catch(PDOException $e){
        error_log($e->getMessage());
        exit('De verbinding is niet onderbroken');
    }

}
