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
    //check if container fields are valid
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

    if (!empty($name) && !empty($appearance)) {
        $newLanguage = new Language($name,$appearance);

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
    <h1><?=$result['languageName'];?> bijwerken</h1>
    <form method="post" action="updateLanguage.php?id=<?=htmlspecialchars($id);?>">
        <label for="name">Programmeertaal-naam</label>
        <span class="error">* <?=$nameErr;?></span><br>
        <input type="text" name="name" value="<?=$result['languageName'];?>" placeholder="Naam van het programmeertaal"/><br>
        <label for="appearance">Publicatiejaar</label>
        <span class="error">* <?=$appearanceErr;?></span><br>
        <select class="form-control" name="appearance">
            <?php
            for ($year = (int)date('Y'); 1900 <= $year; $year--){
                if($year == $result['languageAppearance']){
                    echo "<option value=\"$year\" selected=\"selected\">$year</option>";
                }else{
                    echo "<option value=\"$year\">$year</option>";
                }
            }
            ?>
        </select><br>

        <input class="btnSubmit" type="submit" name="btnSubmit" value="Taal bijwerken"/><br>
        <span class="error">* Verplichte velden</span>
    </form>
</main>
<?php
    include_once './page_parts/footer.php';
?>
