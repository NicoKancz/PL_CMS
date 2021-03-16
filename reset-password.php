<?php
include_once './page_parts/header.php';
?>
    <form method="post" action="./login.php">
        <label>Email-adres</label>
        <input type="text" name="userEmail"><br>
        <input type="submit" value="Verzenden">
    </form><br>
<?php
include_once './page_parts/footer.php';
?>