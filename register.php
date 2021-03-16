<?php
include_once './page_parts/header.php';
?>
    <form method="post" action="./login.php">
        <label>Gebruikersnaam</label>
        <input type="text" name="userName"><br>
        <label>Email-adres</label>
        <input type="text" name="userEmail"><br>
        <label>Wachtwoord</label>
        <input type="text" name="userPassword"><br>
        <input type="submit" value="Registreren">
    </form>
<?php
include_once './page_parts/footer.php';
?>