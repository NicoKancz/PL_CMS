<?php
include_once './page_parts/header.php';
require_once './classes/User.php';
require_once './includes/queries.inc.php';
require_once './includes/userValidation.inc.php';

//initialize name & appearance variables
$nameErr = $emailErr = $passwordErr = '';
$name = $email = $password = '';

//check if form is submitted
if(isset($_POST['btnSubmit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
    //connect to database and add the data to table user
    $conn = connect_db();
    //check if language fields are not empty
    if(emptyInputCheck($_POST['name'])){
        $nameErr = 'Name is required';
    }elseif(invalidUsernameCheck($_POST['name'])){
        $nameErr = 'Invalid characters';
    }elseif(userNameExistCheck($conn, $_POST['name'], $_POST['email'])){
        $nameErr = 'Username already exist';
    }else{
        $name = $_POST['name'];
    }

    if(emptyInputCheck($_POST['email'])){
        $emailErr = 'Email is required';
    }elseif(invalidEmailCheck($_POST['email'])){
        $emailErr = 'Email is invalid';
    }else{
        $email = $_POST['email'];
    }

    if(emptyInputCheck($_POST['password'])){
        $passwordErr = 'Password is required';
    }elseif(passwordMatchCheck($_POST['password'], $_POST['passwordRepeat'])){
        $passwordErr = 'Password is not matching';
    }else{
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    }

    if(!empty($name) && !empty($email) && !empty($password)) {
        //create object of user
        $newUser = new User($name, $email, 'Gebruiker', date('Y-m-d'));
        createUser($conn, $newUser, $password);
        close_db($conn);
        //header("location:login.php");
        echo 'Welkom op onze website ' . $name . '!<br>
                Nu kan je met je gegevens inlogen.';
        exit();
    }else{
        close_db($conn);
    }
}
?>
    <h2>Een nieuwe gebruiker aanmaken</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="text" name="name" placeholder="Gebruikersnaam"><br>
        <span class="error">* <?php echo $nameErr;?></span><br>
        <input type="text" name="email" placeholder="Email"><br>
        <span class="error">* <?php echo $emailErr;?></span><br>
        <input type="password" name="password" placeholder="Wachtwoord"><br>
        <input type="password" name="passwordRepeat" placeholder="Wachtwoord herhalen"><br>
        <span class="error">* <?php echo $passwordErr;?></span><br>
        <input type="submit" name="btnSubmit" value="Registreren">
    </form>
<?php
include_once './page_parts/footer.php';
?>