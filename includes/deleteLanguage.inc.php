<?php
    require_once 'queries.inc.php';

    session_start();
    $id = htmlspecialchars($_GET['id']);
    $conn = connect_db();
    deleteLanguage($conn, $id);
    close_db($conn);
    header("Location:../index.php");
    exit();
