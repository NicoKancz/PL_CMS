<?php
    require_once './includes/queries.inc.php';
    require_once './includes/functions.inc.php';
    include_once './page_parts/header.php';

    //get id from language
    if(isset($_GET['id'])){
        $_SESSION['languageId'] = $_GET['id'];
    }
    $conn = connect_db();
    $language = getLanguage($conn, htmlspecialchars($_SESSION['languageId']));
//    //save information for the path in the header
//    $_SESSION['directory'] = $_SERVER['PHP_SELF'];
//    $_SESSION['dirName'] = makeDirName('language', $language);


?>
    <h1>Containers van <?=htmlspecialchars($language['languageName']);?></h1>
    <main class="containers">
        <?php
            $rows = getContainers($conn, htmlspecialchars($_SESSION['languageId']));
            foreach($rows as $row){
                echo
                    '<div class="languageContainer">
                        <h2>';
                        if($row['containerLink'] == 1) {
                            echo '<a href="theme.php?id=' . $row['containerId'] . '">' . $row['containerName'] . '</a>';
                        }else{
                            echo '<p>' . $row['containerName'] . '</p>';
                        }
                echo    '</h2>
                        <hr>';
                        if(isset($_SESSION['userName']) && ($_SESSION['userRole'] == 3 || $_SESSION['userRole'] == 1)) {
                            echo '<a href="updateContainer.php?id=' . $row['containerId'] . '">Bijwerken</a>
                                  <a href="./includes/deleteContainer.inc.php?id=' . $row['containerId'] . '">Verwijderen</a>
                                  <hr>';
                        }
                echo    '<p>' . $row['containerDescription'] . '</p>
                    </div>';
            }
            if(isset($_SESSION['userName']) && ($_SESSION['userRole'] == 3 || $_SESSION['userRole'] == 1)){
                echo '<a class="languageContainerPlus" href="addContainer.php"><h2> Add </h2></a>';
            }
        ?>
    </main>
<?php
    include_once './page_parts/footer.php';
    close_db($conn);
?>
