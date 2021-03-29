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
function createArticle($conn, $article){
    $query = "INSERT INTO articles(articleName, articleDescription, articleImage, articleDate, userId, containerId) 
                VALUES(?,?,?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$article->getName(),$article->getDesc(),$article->getImage(),$article->getDate(),$article->getUserId(),$article->getContainerId()]);
}

function getArticle($conn, $id){
    $query = "SELECT * FROM articles WHERE articleId=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateArticle($conn, $id, $article){
    $query = "UPDATE articles SET articleName=?, articleDescription=?, articleImage=? WHERE articleId=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$article->getName(),$article->getDesc(),$article->getImage(),$article->getDate(),$id]);
}

function deleteArticle($conn, $id){
    $query = "DELETE FROM articles WHERE articleId=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
}

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

function getUsers($conn){
    $query = "SELECT * FROM users";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function changeUserRole($conn, $name, $role){
    $query = "UPDATE users SET userRole=? WHERE userName=? OR userEmail=?";
    $stmt = $conn->prepare($query);
    $role = getRoleId($conn, $role);
    $stmt->execute([$role,$name,$name]);
}

function changePassword($conn, $id, $password){
    $query = "UPDATE users SET userPassword=? WHERE userId=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$password,$id]);
}

function deleteUser($conn, $id){
    $query = "DELETE FROM users WHERE userId=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
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