<?php
include_once './page_parts/header.php';
require_once './classes/User.php';
require_once './includes/queries.inc.php';
require_once './includes/userValidation.inc.php';

//initialize name & appearance variables
$nameErr = $passwordErr = '';
$name = $password = '';

//check if form is submitted
if(isset($_POST['btnSubmit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
    //connect to database and get the data from the table user
    $conn = connect_db();
    //check if language fields are not empty
    if(emptyInputCheck($_POST['name'])){
        $nameErr = 'Naam is verplicht';
    }elseif(userNameExistCheck($conn, $_POST['name'], $_POST['name']) === false){
        $nameErr = 'Naam of email bestaat niet';
    }else{
        $name = $_POST['name'];
    }

    if(emptyInputCheck($_POST['password'])){
        $passwordErr = 'Wachtwoord is verplicht';
    }elseif(passwordLoginCheck($conn, $_POST['name'], $_POST['password'])){
        $passwordErr = 'Wachtwoord is fout';
    }else{
        $password = $_POST['password'];
    }

    if(!empty($name) && !empty($password)) {
        loginUser($conn, $name);
        close_db($conn);
        header("location:index.php");
        exit();
    }else{
        close_db($conn);
    }
}
?>
    <h2>Inlogen</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="text" name="name" placeholder="Gebruikersnaam"><br>
        <span class="error">* <?php echo $nameErr;?></span><br>
        <input type="password" name="password" placeholder="Wachtwoord"><br>
        <span class="error">* <?php echo $passwordErr;?></span><br>
        <input type="submit" name="btnSubmit" value="Inlogen">
    </form><br>
    <a href="./register.php">Nog geen gebruiker?</a><br>
    <a href="./reset-password.php">Wachtwoord vergeten?</a>
<?php
include_once './page_parts/footer.php';
?>