<?php
    require_once './includes/queries.inc.php';
    require_once './includes/functions.inc.php';
    include_once './page_parts/header.php';

    //get id from container
    if(isset($_GET['id'])){
        $_SESSION['containerId'] = $_GET['id'];
    }
    $conn = connect_db();
    $container = getContainer($conn, htmlspecialchars($_SESSION['containerId']));
    $language = getLanguage($conn, htmlspecialchars($_SESSION['languageId']));
//    //save information for the path in the header
//    $_SESSION['directory'] = $_SERVER['PHP_SELF'];
//    $_SESSION['dirName'] = makeDirName('container', $container);
?>
    <main class="articles">
        <h1>Items van <?=$container['containerName']?> in <?=$language['languageName']?></h1>
        <?php
            if(isset($_SESSION['userName']) && $_SESSION['userRole'] !== 4){
                echo '<div class="center">
                        <a class="btnProfile" href="addArticle.php?id=' . $container['containerId'] . '">Nieuw item toevoegen aan ' . $container['containerName'] . '</a>
                    </div>';
            }
            $rows = getArticles($conn, $container['containerId']);
            foreach($rows as $row){
                echo
                '<div class="item">
                            <h2>';
                if($row['articleType'] == 'Standard') {
                    echo '<a href="item.php?id=' . $row['articleId'] . '">' . $row['articleName'] . '</a>';
                }else{
                    echo '<p>' . $row['articleName'] . '</p>';
                }
                echo    '</h2>
                            <hr>';
                if(isset($_SESSION['userName']) && $_SESSION['userRole'] !== 4) {
                    echo '<a href="updateArticle.php?id=' . $row['articleId'] . '">Bijwerken</a>
                          <a href="./includes/deleteArticle.inc.php?id=' . $row['articleId'] . '">Verwijderen</a>
                          <hr>';
                }
                echo    '<p>' . $row['articleDescription'] . '</p>
                        </div>';
            }
        ?>
    </main>

<?php
    require_once './page_parts/footer.php';
    close_db($conn);
?>
