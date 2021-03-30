<?php
require_once './includes/queries.inc.php';
require_once './classes/Article.php';
require_once './includes/validation.inc.php';
include_once './page_parts/header.php';

//initialize name & appearance variables
$nameErr = $descErr = $imageErr = $dateErr = '';
$name = $desc = $image = $date = '';
$conn = connect_db();
$container = getContainer($conn, htmlspecialchars($_SESSION['containerId']));

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

    $image = $_POST['image'];

    $date = date("Y-m-d");

    if (!empty($name) && !empty($desc) && !empty($date)) {
        $newArticle = new Article($name, $desc, $image, $date, $_SESSION['userId'], $container['containerId']);

        createArticle($conn, $newArticle);
        close_db($conn);
        header("location:theme.php?id=" . $container['containerId']);
    }
}
?>
    <main>
        <h1>Een nieuwe item toevoegen voor de container <?=$container['containerId'] ?></h1>
        <form method="post" action="addArticle.php?id=<?=htmlspecialchars($container['containerId']) ?>">
            <label for="name">Titel van het item</label>
            <span class="error">* <?=$nameErr;?></span><br>
            <input type="text" name="name" placeholder="Titel"/><br>
            <label for="desc">Beschrijving</label>
            <span class="error">* <?=$descErr;?></span><br>
            <textarea name="desc" cols="60" rows="10" placeholder="Beschrijving van de container"></textarea><br>
            <label for="name">Image van het item</label>
            <span class="error"><?=$nameErr;?></span><br>
            <input type="text" name="image" placeholder="Image"/><br>
            <input class="btnSubmit" type="submit" name="btnSubmit" value="Item aanmaken"/><br>
            <span class="error">* Verplichte velden</span>
        </form>
    </main>
<?php
    include_once './page_parts/footer.php';
?>
