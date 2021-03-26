<?php
require_once './includes/queries.inc.php';
require_once './classes/Language.php';
require_once './includes/validation.inc.php';
include_once './page_parts/header.php';

//initialize name & appearance variables
$nameErr = $appearanceErr = '';
$name = $appearance = '';
//get the id from current task
$id = htmlspecialchars($_GET['id']);

//check if form is submitted
if(isset($_POST['btnSubmit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
    //check if container fields are not empty
    if (emptyInputCheck($_POST['name'])){
        $nameErr = 'Naam is verplicht';
    } else {
        $name = $_POST['name'];
    }

    if (emptyInputCheck($_POST['appearance'])) {
        $descErr = 'Publicatiejaar is verplicht';
    } else {
        $desc = $_POST['appearance'];
    }

    if (!empty($_POST['name']) && !empty($_POST['appearance'])) {
        $newLanguage = new Language($_POST['name'], $_POST['appearance']);

        updateLanguage($conn, $id, $newLanguage);
        close_db($conn);
        header("location:index.php");
    }
}else{
    //connect to database
    $conn = connect_db();
    //get data from the current container
    $result = getLanguage($conn, $id);
    close_db($conn);
}
?>
<main>
    <h1><?php echo $result['languageName'] ?> bijwerken</h1>
    <form method="post" action="updateContainer.php?id=<?php echo htmlspecialchars($id) ?>">
        <label for="name">Naam van het taal</label>
        <span class="error">* <?php echo $nameErr;?></span><br>
        <input type="text" name="name" placeholder="Naam" value="<?php echo $result['languageName'] ?>"/><br>
        <label for="desc">Publicatiejaar</label>
        <span class="error">* <?php echo $appearanceErr;?></span><br>
        <textarea name="appearance" cols="60" rows="10" placeholder="Publicatiejaar van het taal">
            <?php echo $result['languageAppearance'] ?>
        </textarea><br>
        <input class="btnSubmit" type="submit" name="btnSubmit" value="Taal bijwerken"/><br>
        <span class="error">* Verplichte velden</span>
    </form>
</main>
<?php
    include_once './page_parts/footer.php';
?>
