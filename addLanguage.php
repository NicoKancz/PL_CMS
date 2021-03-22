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
        //check if language fields are not empty
        if(emptyInputCheck($_POST['name'])){
            $nameErr = 'Name of the language is required';
        }else{
            $name = $_POST['name'];
        }

        if(emptyInputCheck($_POST['appearance'])){
            $appearanceErr = 'Year of the first appearance of the language is required';
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="text" name="name"/>
        <span class="error">* <?php echo $nameErr;?></span><br>
        <select class="form-control" name="appearance">
            <?php
            for ($year = (int)date('Y'); 1900 <= $year; $year--): ?>
                <option value="<?=$year;?>"><?=$year;?></option>
            <?php endfor; ?>
        </select>
        <span class="error">* <?php echo $appearanceErr;?></span><br>
        <input type="submit" name="btnSubmit" value="Submit"/><br>
        <span class="error">* Verplichte velden</span>
    </form>
<?php
    include_once './page_parts/footer.php';
?>

