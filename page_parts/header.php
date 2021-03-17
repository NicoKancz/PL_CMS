<!DOCTYPE html>
<html lang="en">
    <head>
        <meta content="text/html" charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PL-CMS</title>
        <link href="/PL_CMS/css/myStyle.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <nav>
                <a href="/PL_CMS/index.php"><h1 id="logo">Logo</h1></a>
                <ul id="categories">
                    <li><a href="/PL_CMS/categories/php.php">PHP</a></li>
                    <li><a href="/PL_CMS/javascript.php">JavaScript</a></li>
                    <li><a href="/PL_CMS/python.php">Python</a></li>
                    <li><a href="/PL_CMS/java.php">Java</a></li>
                    <li><a href="/PL_CMS/csharp.php">C#</a></li>
                    <li><a href="/PL_CMS/perl.php">Perl</a></li>
                    <li><a href="/PL_CMS/ruby.php">Ruby</a></li>
                    <li><a href="/PL_CMS/cplusplus.php">C++</a></li>
                </ul>
                <form method="post" action="search.php" id="search">
                    <input type="text" name="search" placeholder="Search">
                    <button type="submit">
                        <img src="/PL_CMS/img/search_icon.png" alt="Image search icon" width="25px" height="25px"/>
                    </button>
                </form>
                <button id="btnLogin">Login</button>
            </nav>
        </header>

