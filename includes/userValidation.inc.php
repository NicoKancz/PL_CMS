<?php
function emptyInputCheck($input){
    $result = false;
    if(empty($input)){
        $result = true;
    }
    return $result;
}

function invalidUsernameCheck($username){
    $result = false;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = true;
    }
    return $result;
}

function invalidEmailCheck($email){
    $result = false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    return $result;
}

function passwordMatchCheck($password, $passwordRepeat){
    $result = false;
    if($password !== $passwordRepeat){
        $result = true;
    }
    return $result;
}

function userNameExistCheck($conn, $username, $email){
    $query = "SELECT * FROM users WHERE userName=? OR userEmail=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$username,$email]);

    if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        return $row;
    }else{
        return false;
    }
}

function passwordLoginCheck($conn, $username, $password){
    $usernameExists = userNameExistCheck($conn, $username, $username);

    $result = false;
    $passwordHashed = $usernameExists['userPassword'];
    $checkPassword = password_verify($password, $passwordHashed);

    if($checkPassword === false){
        $result = true;
    }
    return $result;
}

function loginUser($conn, $username){
    $usernameExists = userNameExistCheck($conn, $username, $username);

    session_start();
    $_SESSION['userId'] = $usernameExists['userId'];
    $_SESSION['userName'] = $usernameExists['userName'];
}