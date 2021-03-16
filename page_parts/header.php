<!DOCTYPE html>
<html lang="en">
    <head>
        <meta content="text/html" charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PL-CMS</title>
        <link href="./css/myStyle.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav>
                <h1 id="logo">Logo</h1>
                <ul id="categories">
                    <li><a href="./php.php">PHP</a></li>
                    <li><a href="./javascript.php">JavaScript</a></li>
                    <li><a href="./python.php">Python</a></li>
                    <li><a href="./java.php">Java</a></li>
                    <li><a href="./csharp.php">C#</a></li>
                    <li><a href="./perl.php">Perl</a></li>
                    <li><a href="./ruby.php">Ruby</a></li>
                    <li><a href="./cplusplus.php">C++</a></li>
                </ul>
                <form method="post" action="search.php" id="search">
                    <input type="text" name="search" placeholder="Search">
                    <button type="submit">
                        <img src="./img/search_icon.png" alt="Image search icon" width="25px" height="25px"/>
                    </button>
                </form>
                <button id="btnLogin">Login</button>
            </nav>
        </header>

