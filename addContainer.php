<?php
    require_once './includes/queries.inc.php';
    require_once './classes/Container.php';
    require_once './includes/validation.inc.php';
    include_once './page_parts/header.php';

    //initialize name & appearance variables
    $nameErr = $descErr = '';
    $name = $desc = '';
    $conn = connect_db();
    $language = showLanguage($conn, htmlspecialchars($_SESSION['languageId']));

    //check if form is submitted
    if(isset($_POST['btnSubmit']) && $_SERVER["REQUEST_METHOD"] == "POST") {
        //check if container fields are not empty
        if (emptyInputCheck($_POST['name'])) {
            $nameErr = 'Naam van de container is verplicht';
        } else {
            $name = $_POST['name'];
        }

        if (emptyInputCheck($_POST['desc'])) {
            $descErr = 'Beschrijving van de container is verplicht';
        } else {
            $desc = $_POST['desc'];
        }

        if (isset($_POST['name']) && isset($_POST['desc'])) {
            $newContainer = new Container($_POST['name'], $_POST['desc'],date("Y-m-d"),$_SESSION['languageId']);

            createContainer($conn, $newContainer);
            close_db($conn);
            header("location:category.php?id=" . $_SESSION['languageId']);
        }
    }
?>
    <main>
        <h1>Een nieuwe container toevoegen voor <?php echo $language['languageName'] ?></h1>
        <form method="post" action="addContainer.php?id=<?php echo htmlspecialchars($_SESSION['languageId']) ?>">
            <label for="name">Titel</label>
            <span class="error">* <?php echo $nameErr;?></span><br>
            <input type="text" name="name" placeholder="Titel"/><br>
            <label for="desc">Beschrijving</label>
            <span class="error">* <?php echo $descErr;?></span><br>
            <textarea name="desc" cols="60" rows="10" placeholder="Beschrijving van de container"></textarea><br>
            <input type="submit" name="btnSubmit" value="Submit"/><br>
            <span class="error">* Verplichte velden</span>
        </form>
    </main>
<?php
    include_once './page_parts/footer.php';
?>
