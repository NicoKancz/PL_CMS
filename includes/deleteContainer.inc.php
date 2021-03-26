<?php
    require_once 'queries.inc.php';

    session_start();
    $id = htmlspecialchars($_GET['id']);
    $conn = connect_db();
    deleteContainer($conn, $id);
    close_db($conn);
    header("Location:../category.php?id=" . $_SESSION['languageId']);
    exit();