<?php
include_once './page_parts/header.php';
?>
    <div class="center">
        <img src="img/under-construction-yom.png" alt="Under construction"/>
    </div>
    <form method="post" action="./login.php">
        <label>Email-adres:</label><br>
        <input type="text" name="userEmail"><br>
        <input type="submit" name="btnSubmit" value="Verzenden">
    </form><br>
<?php
include_once './page_parts/footer.php';
?>