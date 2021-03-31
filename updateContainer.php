<?php
    require_once './includes/queries.inc.php';
    require_once './classes/Container.php';
    require_once './includes/validation.inc.php';
    include_once './page_parts/header.php';

    //initialize name & appearance variables
    $nameErr = $descErr = '';
    $name = $desc = $link = '';

    //connect to database
    $conn = connect_db();
    //get data from the current container
    $container = getContainer($conn, htmlspecialchars($_GET['id']));
    close_db($conn);

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

        if (!empty($name) && !empty($desc)) {
            $conn = connect_db();
            $newContainer = new Container($name,$desc,$container['containerDate'],$link,$container['languageId']);

            updateContainer($conn, $container['containerId'], $newContainer);
            close_db($conn);
            header("location:category.php?id=" . $container['languageId']);
        }
    }
?>
    <main>
        <h1>Container <?=$container['containerName'];?> bijwerken </h1>
        <form method="post" action="updateContainer.php?id=<?=$container['containerId'];?>">
            <label for="name">Titel</label>
            <span class="error">* <?=$nameErr;?></span><br>
            <input type="text" name="name" placeholder="Titel" value="<?=$container['containerName'];?>"/><br>
            <label for="desc">Beschrijving</label>
            <span class="error">* <?=$descErr;?></span><br>
            <textarea name="desc" cols="60" rows="10" placeholder="Beschrijving van de container"><?=$container['containerDescription'];?></textarea><br>
            <input type="checkbox" name="link" value="1" checked>
            <label for="link"> Link zetten?</label><br>
            <input class="btnSubmit" type="submit" name="btnSubmit" value="Container bijwerken"/><br>
            <span class="error">* Verplichte velden</span>
        </form>
    </main>
<?php
    include_once './page_parts/footer.php';
?>

