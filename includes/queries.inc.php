<?php
require_once 'database.inc.php';

//Language queries
function createLanguage($conn, $language){
    $query = "INSERT INTO languages(languageName, languageAppearance) VALUES(?,?)";
    $conn->prepare($query)->execute([$language->getName(),$language->getAppearance()]);
}

function getLanguage($conn, $id){
    $query = "SELECT * FROM languages WHERE languageId=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getLanguages($conn){
    $query = 'SELECT * FROM languages';
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateLanguage($conn, $id, $lang){
    $query = "UPDATE languages SET languageName=?, languageAppearance=? WHERE languageId=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$lang->getName(),$lang->getAppearance(),$id]);
}

function deleteLanguage($conn, $id){
    $query = "DELETE FROM languages WHERE languageId=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
}

//Container queries
function createContainer($conn, $container){
    $query = "INSERT INTO containers(containerName,containerDescription,containerDate,languageId)
                VALUES(?,?,?,?)";
    $conn->prepare($query)->execute([$container->getName(),$container->getDesc(),$container->getDate(),$container->getLangId()]);
}

function getContainer($conn, $id){
    $query = "SELECT * FROM containers WHERE containerId=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getContainers($conn, $id){
    $query = "SELECT * FROM containers WHERE languageId=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateContainer($conn, $id, $container){
    $query = "UPDATE containers SET containerName=?, containerDescription=?, containerDate=? WHERE containerId=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$container->getName(),$container->getDesc(),$container->getDate(),$id]);
}

function deleteContainer($conn, $id){
    $query = 'DELETE FROM containers WHERE containerId=?';
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
}

//Article queries
//todo: create article
//todo: show articles

//User queries
function createUser($conn, $user, $password){
    $query = "INSERT INTO users(userName,userEmail,userPassword,userRole,userRegDate) VALUES(?,?,?,?,?)";
    $roleId = getRoleId($conn, $user->getRole());
    $conn->prepare($query)->execute([$user->getName(),$user->getEmail(),$password,$roleId,$user->getRegDate()]);
}

function getUser($conn, $id){
    $query = "SELECT * FROM users WHERE userId=?";
    $stmt = $conn->prepare($query);
    return $stmt->execute([$id]);
}

//Role queries
function getRoleId($conn, $role){
    $query = "SELECT roleId FROM roles WHERE roleName=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$role]);
    return $stmt->fetch(PDO::FETCH_ASSOC)['roleId'];
}

function getRoleName($conn, $id){
    $query = "SELECT roleName FROM roles WHERE roleId=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC)['roleName'];
}