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
            ?>
            <a id="btnLogout" href="./includes/logout.inc.php">Uitloggen</a>
        </div>
    </main>
