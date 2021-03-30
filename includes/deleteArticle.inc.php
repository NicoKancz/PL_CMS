<?php
require_once 'queries.inc.php';

session_start();
$id = htmlspecialchars($_GET['id']);
$conn = connect_db();
deleteArticle($conn, $id);
close_db($conn);
header("Location:../theme.php?id=" . $_SESSION['containerId']);
exit();