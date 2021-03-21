<?php
    require_once './includes/queries.inc.php';
    require_once './classes/Container.php';
    include_once './page_parts/header.php';

    //initialize name & appearance variables
    $nameErr = $descErr = '';
    $name = $desc = '';

    //check if form is submitted
    if(isset($_POST['btnSubmit']) && $_SERVER["REQUEST_METHOD"] == "POST") {
        //check if container fields are not empty
        if (empty($_POST['name'])) {
            $nameErr = 'Name of the container is required';
        } else {
            $name = $_POST['name'];
        }

        if (empty($_POST['desc'])) {
            $descErr = 'Description of the container is required';
        } else {
            $desc = $_POST['desc'];
        }

        if (isset($_POST['name']) && isset($_POST['desc'])) {
            $newContainer = new Container($_POST['name'], $_POST['desc'],date("Y-m-d"),$_SESSION['languageId']);

            $conn = connect_db();
            createContainer($conn, $newContainer);
            close_db($conn);
            header("location:category.php?id=" . $_SESSION['languageId']);
        }
    }
?>
    <h1>Een nieuwe container toevoegen</h1>
    <form method="post" action="category.php?id=<?php echo $_SESSION['languageId'] ?>">
        <input type="text" name="name"/>
        <span class="error">* <?php echo $nameErr;?></span><br>
        <textarea name="desc" cols="60" rows="10"></textarea><br>
        <span class="error">* <?php echo $descErr;?></span><br>
        <input type="submit" name="btnSubmit" value="Submit"/>
    </form>
<?php
    include_once './page_parts/footer.php';
?>
