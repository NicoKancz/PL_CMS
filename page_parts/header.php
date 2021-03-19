<!DOCTYPE html>
<html lang="en">
    <head>
        <meta content="text/html" charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PL-CMS</title>
        <link href="/PL_CMS/css/myStyle.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav>
                <a href="/PL_CMS/index.php"><h1 id="logo">Logo</h1></a>
                <ul id="categories">
                    <?php
                        //get rows from the table languages and display on header as the categories
                        require_once './crud/queries.php';
                        $conn = connect_db();
                        $rows = showLanguages($conn);
                        foreach($rows as $row){
                            echo '<li><a href="/PL_CMS/category.php">' . $row['languageName'] . '</a></li>';
                        }
                    ?>
                </ul>
                <a href="/PL_CMS/addLanguage.php"><button id="btnAddLanguage">Add language</button></a>
                <form method="post" action="/PL_CMS/search.php" id="search">
                    <input type="text" name="search" placeholder="Search">
                    <button type="submit">
                        <img src="/PL_CMS/img/search_icon.png" alt="Image search icon" width="25px" height="25px"/>
                    </button>
                </form>
                <a href="/PL_CMS/login.php"><button id="btnLogin">Login</button></a>
            </nav>
        </header>

