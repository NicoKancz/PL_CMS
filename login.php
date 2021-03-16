<?php
include_once './page_parts/header.php';
?>
    <form method="post" action="./index.php">
        <label>Gebruikersnaam</label>
        <input type="text" name="userName"><br>
        <label>Wachtwoord</label>
        <input type="text" name="userPassword"><br>
        <input type="submit" value="Inlogen">
    </form><br>
    <a href="./register.php"><p>Nog geen gebruiker?</p></a><br>
    <a href="./reset-password.php"><p>Wachtwoord vergeten?</p></a>
<?php
include_once './page_parts/footer.php';
?>