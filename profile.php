<?php
include_once './page_parts/header.php';
require_once './includes/queries.inc.php';
?>
    <main>
        <h1>Profiel</h1>
        <div class="center">
            <label>Gebruikersnaam:</label>
            <?php
                echo '<p class="userParagraph">' . $_SESSION['userName'] . '</p>';
                echo '<label>Rol:</label>';
                echo '<p class="userParagraph">' . getRoleName($conn, htmlspecialchars($_SESSION['userRole'])) . '</p>';
                if(isset($_SESSION['userName']) && $_SESSION['userRole'] == 1 || $_SESSION['userRole'] == 3){
                    echo '<a class="btnProfile" href="./changeRole.php">Rol van een gebruiker veranderen</a><br>';
                }
            ?>
            <a class="btnProfile" href="./changePassword.php">Wachtwoord veranderen</a><br>
            <a class="btnProfile" href="./includes/logout.inc.php">Uitloggen</a>
        </div>
    </main>
