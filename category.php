<?php
    require_once './includes/queries.inc.php';
    include_once './page_parts/header.php';

    if(isset($_GET['id'])){
        $_SESSION['languageId'] = $_GET['id'];
    }
    $conn = connect_db();
    $language = showLanguage($conn, htmlspecialchars($_SESSION['languageId']));
?>
    <h1>Containers van <?php echo htmlspecialchars($language['languageName']) ?></h1>
    <main class="containers">
        <?php

        $conn = connect_db();
        $rows = showContainers($conn, htmlspecialchars($_SESSION['languageId']));
        foreach($rows as $row){
            echo
                '<div class="languageContainer">
                    <h2><a href="forum.php?id=' . $row['containerId'] . '">' . $row['containerName'] . '</a></h2>
                    <p>' . $row['containerDescription'] . '</p>
                </div>';
        }
        //if(isset($_SESSION['userName']) && $_SESSION['userRole'] === 3){
        echo '<div class="languageContainerPlus"><a href="addContainer.php"> + </a></div>';
        //}
        ?>
    </main>
<?php
    include_once './page_parts/footer.php';
?>
