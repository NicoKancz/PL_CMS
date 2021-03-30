<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta content="text/html" charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PL-CMS</title>
        <link href="/PL_CMS/css/myStyle.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav>
<!--                todo: class active toevoegen aan links-->
                <a id="logo" class="<?=($_SERVER['PHP_SELF'] == "/PL_CMS/index.php" ? "active" : "")?>" href="/PL_CMS/index.php">PL-<br>CMS</a>
                <div id="categories">
                    <a class="btnDropdown">Talen</a>
                    <div class="dropdownContent">
                    <?php
                        //get rows from the table languages and display on header as the categories
                        require_once './includes/queries.inc.php';
                        $conn = connect_db();
                        $rows = getLanguages($conn);
                        foreach($rows as $row){
                            echo '<a href="/PL_CMS/category.php?id=' . htmlspecialchars($row['languageId']) . '">' . htmlspecialchars($row['languageName']) . '</a>';
                            if(isset($_SESSION['userName']) && $_SESSION['userRole'] == 1){
//                                echo '<a class="btnDeleteLanguage" href="/PL_CMS/includes/deleteLanguage.inc.php?id=' . $row['languageId'] . '"> - </a>';
//                                echo '<a class="btnUpdateLanguage" href="/PL_CMS/updateLanguage.php?id=' . $row['languageId'] . '"> Edit </a>';
                            }
                        }
                        close_db($conn);

                        if(isset($_SESSION['userName']) && $_SESSION['userRole'] == 1){
                            echo '<a class="center" id="btnAddLanguage" href="/PL_CMS/addLanguage.php"> + </a>';
                        }
                    ?>
                    </div>
                </div>
<!--                <div id="directory">-->
<!--                    <p>Pad:-->
<!--                        --><?php
//                            if(empty($_SESSION['directories'])) {
//                                $_SESSION['directories'] = $_SESSION['dirNames'] = [];
//                            }
//
//                            array_push($_SESSION['directories'], $_SESSION['directory']);
//                            array_push($_SESSION['dirNames'], $_SESSION['dirName']);
//                            for ($counter = 0; $counter < count($_SESSION['directories']); $counter++) {
//                                echo '<a href="' . $_SESSION['directories'][$counter] . '">' . $_SESSION['dirNames'][$counter] . '</a>/';
//                            }
//
//                            $_SESSION['directory'] = '';
//                            $_SESSION['dirName'] = '';
//                        ?>
<!--                    </p>-->
<!--                </div>-->
                <a id="search" href="search.php">Zoeken</a>
                <?php
                if(isset($_SESSION['userName'])){
                    echo '<span class="loginSystem">
                            <a id="btnProfile" href="/PL_CMS/profile.php">Profiel</a>
                        </span>';
                }else{
                    echo '<span class="loginSystem"><a id="btnLogin" href="/PL_CMS/login.php">Inloggen</a></span>';
                }
                ?>
            </nav>
        </header>

