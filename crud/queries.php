<?php
require_once 'database.php';

//Language queries
function showLanguages($conn){
    $query = 'SELECT * FROM languages';
    $result = $conn->query($query);
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

//Container queries
//todo: create container
function createContainer($conn, $name, $desc, $date, $languageId){
    $query = "INSERT INTO containers(containerName,containerDescription,containerDate,languageId)
                VALUES(' . $name . ',' . $desc . ',' . $date . ',' . $languageId . ')";
    $conn->query($query);
}

//todo: read and show container
function showContainers($conn){
    $query = "SELECT * FROM containers";
    $conn->query($query);
}

//todo: update container
function updateContainer($conn, $id, $name, $desc, $date){
    $query = "UPDATE containers SET containerName=$name, containerDescription=$desc, containerDate=$date WHERE containerId=$id";
    $conn->query($query);
}

//todo: delete container
function deleteContainer($conn, $id){
    $query = 'DELETE FROM containers WHERE containerId=$id';
    $conn->query($query);
}