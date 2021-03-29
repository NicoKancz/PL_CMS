<?php
    require_once './includes/queries.inc.php';
    require_once './classes/Container.php';
    require_once './includes/validation.inc.php';
    include_once './page_parts/header.php';

    //initialize name & appearance variables
    $nameErr = $descErr = '';
    $name = $desc = $link = '';
    $conn = connect_db();
    $language = getLanguage($conn, htmlspecialchars($_SESSION['languageId']));

    //check if form is submitted
    if(isset($_POST['btnSubmit']) && $_SERVER["REQUEST_METHOD"] == "POST") {
        //check if container fields are valid
        if (emptyInputCheck($_POST['name'])) {
            $nameErr = 'Naam is verplicht';
        } else {
            $name = $_POST['name'];
        }

        if (emptyInputCheck($_POST['desc'])) {
            $descErr = 'Beschrijving is verplicht';
        } else {
            $desc = $_POST['desc'];
        }

        if(isset($_POST['link'])){
            $link = $_POST['link'];
        }else{
            $link = 0;
        }

        if (!empty($name) && !empty($desc) && !empty($link)) {
            $newContainer = new Container($name, $desc, date("Y-m-d"), $link, $_SESSION['languageId']);

            createContainer($conn, $newContainer);
            close_db($conn);
            header("location:category.php?id=" . $_SESSION['languageId']);
        }
    }
?>
    <main>
        <h1>Een nieuwe container toevoegen voor <?=$language['languageName'] ?></h1>
        <form method="post" action="addContainer.php?id=<?=htmlspecialchars($_SESSION['languageId']) ?>">
            <label for="name">Titel</label>
            <span class="error">* <?=$nameErr;?></span><br>
            <input type="text" name="name" placeholder="Titel"/><br>
            <label for="desc">Beschrijving</label>
            <span class="error">* <?=$descErr;?></span><br>
            <textarea name="desc" cols="60" rows="10" placeholder="Beschrijving van de container"></textarea><br>
            <input class="btnSubmit" type="submit" name="btnSubmit" value="Container aanmaken"/><br>
            <input type="checkbox" name="link" value="1" checked>
            <label for="link"> Link zetten?</label>
            <span class="error">* Verplichte velden</span>
        </form>
    </main>
<?php
    include_once './page_parts/footer.php';
?>
