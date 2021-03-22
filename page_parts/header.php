<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta content="text/html" charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PL-CMS</title>
        <link href="/PL_CMS/css/myStyle.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav>
                <a id="logo" href="/PL_CMS/index.php">PL-<br>CMS</a>
                <ul id="categories">
                    <?php
                        //get rows from the table languages and display on header as the categories
                        require_once './includes/queries.inc.php';
                        $conn = connect_db();
                        $rows = showLanguages($conn);
                        foreach($rows as $row){
                            echo '<li><a href="/PL_CMS/category.php?id=' . htmlspecialchars($row['languageId']) . '">' . htmlspecialchars($row['languageName']) . '</a></li>';
                        }
                        close_db($conn);
//                        if(isset($_SESSION['userName']) && $_SESSION['userRole'] === 1){
                            echo '<li><a id="btnAddLanguage" href="/PL_CMS/addLanguage.php"> + </a></li>';
//                        }
                    ?>
                </ul>
                <a id="search" href="search.php">Zoeken</a>
<!--                <form method="post" action="/PL_CMS/search.php" id="search">-->
<!--                    <input type="text" name="search" placeholder="Search">-->
<!--                    <button type="submit">-->
<!--                        <img src="/PL_CMS/img/search_icon.png" alt="Image search icon" width="25px" height="25px"/>-->
<!--                    </button>-->
<!--                </form>-->
                <?php
                if(isset($_SESSION['userName'])){
                    echo '<span id="loginSystem">
                            <a id="btnProfile" href="/PL_CMS/profile.php">Profiel</a>
                        </span>';
                }else{
                    echo '<span id="loginSystem"><a id="btnLogin" href="/PL_CMS/login.php">Inloggen</a></span>';
                }
                ?>
            </nav>
        </header>

