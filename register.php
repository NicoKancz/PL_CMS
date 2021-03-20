<?php
include_once './page_parts/header.php';
require_once './includes/queries.inc.php';
require_once './includes/functions.inc.php';

session_start();
//initialize name & appearance variables
$nameErr = $emailErr = $passwordErr = $passwordRepeatErr = '';
$name = $email = $password = $passwordRepeat = '';

//check if form is submitted
if(isset($_POST['btnSubmit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
    //check if language fields are not empty
    if(empty($_POST['name'])){
        $nameErr = 'Name is required';
    }else{
        $name = $_POST['name'];
    }

    if(empty($_POST['email'])){
        $emailErr = 'Email is required';
    }else{
        $email = $_POST['email'];
    }

    if(empty($_POST['password'])){
        $passwordErr = 'Password is required';
    }else{
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    }

    if(!empty($name) && !empty($email) && !empty($password)) {
        //create object of user
        $newUser = new User($name, $appearance, $password, 'Gebruiker', date('Y-m-d'));
        //connect to database and add the data to table language
        $conn = connect_db();
        createLanguage($conn, $newUser);
        close_db($conn);
        header("location:login.php");
        exit();
    }
}
?>
    <form method="post" action="./login.php">
        <label>Gebruikersnaam</label>
        <input type="text" name="name">
        <span class="error">* <?php echo $nameErr;?></span><br>
        <label>Email-adres</label>
        <input type="text" name="email">
        <span class="error">* <?php echo $emailErr;?></span><br>
        <label>Wachtwoord</label>
        <input type="password" name="password">
        <span class="error">* <?php echo $passwordErr;?></span><br>
        <input type="password" name="passwordRepeat">
        <span class="error">* <?php echo $passwordRepeatErr;?></span><br>
        <input type="submit" name="btnSubmit" value="Registreren">
    </form>
<?php
include_once './page_parts/footer.php';
?>