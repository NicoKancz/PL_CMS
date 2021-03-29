<?php
    require_once './includes/queries.inc.php';
    require_once './includes/validation.inc.php';
    require_once './classes/Language.php';
    include_once './page_parts/header.php';

    //initialize name & appearance variables
    $nameErr = $appearanceErr = '';
    $name = $appearance = '';

    //check if form is submitted
    if(isset($_POST['btnSubmit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
        //check if language fields are valid
        if(emptyInputCheck($_POST['name'])){
            $nameErr = 'Naam is verplicht';
        }else{
            $name = $_POST['name'];
        }

        if(emptyInputCheck($_POST['appearance'])){
            $appearanceErr = 'Publicatiejaar is verplicht';
        }else{
            $appearance = $_POST['appearance'];
        }

        if(!empty($name) && !empty($appearance)) {
            //create object of language
            $newLanguage = new Language($name, $appearance);
            //connect to database and add the data to table language
            $conn = connect_db();
            createLanguage($conn, $newLanguage);
            close_db($conn);
            header("location:index.php");
        }
    }
?>
    <h1>Een nieuwe programmeertaal toevoegen</h1>
    <form method="post" action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="name">Programmeertaal-naam</label>
        <span class="error">* <?=$nameErr;?></span><br>
        <input type="text" name="name" placeholder="Naam van het programmeertaal"/><br>
        <label for="appearance">Publicatiejaar</label>
        <span class="error">* <?=$appearanceErr;?></span><br>
        <select class="form-control" name="appearance">
            <?php
            for ($year = (int)date('Y'); 1900 <= $year; $year--): ?>
                <option value="<?=$year;?>"><?=$year;?></option>
            <?php endfor; ?>
        </select><br>

        <input class="btnSubmit" type="submit" name="btnSubmit" value="Taal aanmaken"/><br>
        <span class="error">* Verplichte velden</span>
    </form>
<?php
    include_once './page_parts/footer.php';
?>

