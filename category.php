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
<?php
    include_once './page_parts/main.php';
    include_once './page_parts/footer.php';
?>
