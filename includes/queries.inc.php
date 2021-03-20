<?php
require_once 'database.inc.php';

//Language queries
function createLanguage($conn, $language){
    $query = "INSERT INTO languages(languageName, languageAppearance) VALUES(?,?)";
    $conn->prepare($query)->execute([$language->getName(),$language->getAppearance()]);
}

function showLanguage($conn, $id){
    $query = "SELECT * FROM languages WHERE languageId=?";
    $result = $conn->prepare($query);
    $result->execute([$id]);
    return $result->fetch(PDO::FETCH_ASSOC);
}

function showLanguages($conn){
    $query = 'SELECT * FROM languages';
    $result = $conn->prepare($query);
    $result->execute();
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

//Container queries
function createContainer($conn, $container){
    $query = "INSERT INTO containers(containerName,containerDescription,containerDate,languageId)
                VALUES(?,?,?,?)";
    $conn->prepare($query)->execute([$container->getName(),$container->getDesc(),$container->getDate(),$container->getLangId()]);
}

function showContainer($conn, $id){
    $query = "SELECT * FROM containers WHERE containerId=?";
    $result = $conn->prepare($query);
    return $result->execute([$id]);
}

function showContainers($conn){
    $query = "SELECT * FROM containers";
    $result = $conn->prepare($query);
    $result->execute();
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

//todo: update container
function updateContainer($conn, $id, $name, $desc, $date){
    $query = "UPDATE containers SET containerName=$name, containerDescription=$desc, containerDate=$date WHERE containerId=$id";
    $conn->prepare($query);
}

//todo: delete container
function deleteContainer($conn, $id){
    $query = 'DELETE FROM containers WHERE containerId=$id';
    $conn->prepare($query);
}

//Article queries
//todo: create article
//todo: show articles

//User queries
function createUser($conn, $user){
    $query = "INSERT INTO users(userName,userEmail,userPassword,userRole,userRegDate)
                VALUES(?,?,?,?,?)";
    $conn->prepare($query)->execute([$user->getName(),$user->getEmail(),$user->getPassword(),$user->getRole(),$user->getRegDate()]);
}

function getUser($conn, $id){
    $query = "SELECT * FROM users WHERE userId=?";
    $result = $conn->prepare($query);
    return $result->execute([$id]);
}