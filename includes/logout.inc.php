<?php

session_start();
unset($_SESSION['username']);
unset($_SESSION['userId']);
unset($_SESSION['userRole']);
session_destroy();
header("location:../index.php");
exit();
