<?php
    require_once './includes/queries.inc.php';
    require_once './classes/Article.php';
    require_once './includes/validation.inc.php';
    include_once './page_parts/header.php';

    //initialize name & appearance variables
    $nameErr = $descErr = $typeErr = $imageErr = '';
    $name = $desc = $type = $image = '';

    //connect to database
    $conn = connect_db();
    //get data from the current container
    $article = getArticle($conn, htmlspecialchars($_GET['id']));
    echo $article['articleName'];
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

        if (emptyInputCheck($_POST['type'])) {
            $typeErr = 'Type is verplicht';
        } else {
            $type = $_POST['type'];
        }

        $image = $_POST['image'];

        if (!empty($name) && !empty($desc) && !empty($type)) {
            $conn = connect_db();
            $newArticle = new Article($name,$desc,$type,$image,$article['articleDate'],$article['userId'],$article['containerId']);

            updateArticle($conn, $article['articleId'], $newArticle);
            close_db($conn);
            header("location:theme.php?id=" . $article['containerId']);
        }
    }
?>
    <main>
        <h1>Item <?=$article['articleName'];?> bijwerken </h1>
        <form method="post" action="updateArticle.php?id=<?=$article['articleId'];?>">
            <label for="name">Titel</label>
            <span class="error">* <?=$nameErr;?></span><br>
            <input type="text" name="name" placeholder="Titel" value="<?=$article['articleName'];?>"/><br>
            <label for="desc">Beschrijving</label>
            <span class="error">* <?=$descErr;?></span><br>
            <textarea name="desc" cols="60" rows="10" placeholder="Beschrijving van de container"><?=$article['articleDescription'];?></textarea><br>
            <label for="type">Type</label>
            <span class="error">* <?=$typeErr;?></span><br>
            <select class="form-control" name="type">
                <option value="Standard">Standaard</option>
            </select><br>
            <label for="name">Image van het item</label>
            <span class="error"><?=$imageErr;?></span><br>
            <input type="text" name="image" placeholder="Image" value="<?=$article['articleImage'];?>"/><br>
            <input class="btnSubmit" type="submit" name="btnSubmit" value="Item bijwerken"/><br>
            <span class="error">* Verplichte velden</span>
        </form>
    </main>
<?php
    include_once './page_parts/footer.php';
?>