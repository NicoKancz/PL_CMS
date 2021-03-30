<?php
    require_once './includes/queries.inc.php';
    require_once './includes/functions.inc.php';
    include_once './page_parts/header.php';

    //get id from container
    if(isset($_GET['id'])){
        $_SESSION['containerId'] = $_GET['id'];
    }
    $conn = connect_db();
    $container = getContainer($conn, $_SESSION['containerId']);
    $language = getLanguage($conn, $_SESSION['languageId']);
//    //save information for the path in the header
//    $_SESSION['directory'] = $_SERVER['PHP_SELF'];
//    $_SESSION['dirName'] = makeDirName('container', $container);
?>
    <main>
        <h1>Items van <?=$container['containerName']?> in <?=$language['languageName']?></h1>
        <?php
            if(isset($_SESSION['userName']) && $_SESSION['userRole'] !== 4){
                echo '<div class="center">
                        <a class="btnProfile" href="addArticle.php?id=' . $container['containerId'] . '">Nieuw item toevoegen aan ' . $container['containerName'] . '</a>
                    </div>';
            }
            echo '';
        ?>
    </main>

<?php
    require_once './page_parts/footer.php';
    close_db($conn);
?>
