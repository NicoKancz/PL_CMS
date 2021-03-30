<?php
//todo: zoekopdracht pagina maken
include_once './page_parts/header.php';
?>
    <div class="center">
        <img src="img/under-construction-yom.png"/>
    </div>
    <form method="post" action="/PL_CMS/search.php" id="search">
        <input type="text" name="search" placeholder="Search">
        <button type="submit">
            <img src="/PL_CMS/img/search_icon.png" alt="Image search icon" width="25px" height="25px"/>
        </button>
    </form>
