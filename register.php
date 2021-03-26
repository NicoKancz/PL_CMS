<?php
include_once './page_parts/header.php';
require_once './classes/User.php';
require_once './includes/queries.inc.php';
require_once './includes/validation.inc.php';

//initialize name & appearance variables
$nameErr = $emailErr = $passwordErr = '';
$name = $email = $password = '';

//check if form is submitted
if(isset($_POST['btnSubmit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
    //connect to database and add the data to table user
    $conn = connect_db();
    //check if language fields are not empty
    if(emptyInputCheck($_POST['name'])){
        $nameErr = 'Name is verplicht';
    }elseif(invalidUsernameCheck($_POST['name'])){
        $nameErr = 'Naam is ongeldig';
    }elseif(userNameExistCheck($conn, $_POST['name'], $_POST['email'])){
        $nameErr = 'Gebruikersnaam bestaat al';
    }else{
        $name = $_POST['name'];
    }

    if(emptyInputCheck($_POST['email'])){
        $emailErr = 'Email is verplicht';
    }elseif(invalidEmailCheck($_POST['email'])){
        $emailErr = 'Email is ongeldig';
    }else{
        $email = $_POST['email'];
    }

    if(emptyInputCheck($_POST['password'])){
        $passwordErr = 'Wachtwoord is verplicht';
    }elseif(passwordMatchCheck($_POST['password'], $_POST['passwordRepeat'])){
        $passwordErr = 'Wachtwoord komt niet overeen';
    }else{
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    }

    if(!empty($name) && !empty($email) && !empty($password)) {
        //create object of user
        $newUser = new User($name, $email, 'Gebruiker', date('Y-m-d'));
        createUser($conn, $newUser, $password);
        close_db($conn);
        //header("location:login.php");
        echo '<p id="geregistreerdText">Welkom op onze website ' . $name . '!<br>
                Nu kan je met je gegevens inlogen.</p>';
        exit();
    }else{
        close_db($conn);
    }
}
?>
    <h1>Registreren</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="name">Gebruikersnaam</label>
        <span class="error">* <?php echo $nameErr;?></span><br>
        <input type="text" name="name" placeholder="Gebruikersnaam"><br>
        <label for="email">Email</label>
        <span class="error">* <?php echo $emailErr;?></span><br>
        <input type="text" name="email" placeholder="Email"><br>
        <label for="password">Wachtwoord</label>
        <span class="error">* <?php echo $passwordErr;?></span><br>
        <input type="password" name="password" placeholder="Wachtwoord"><br>
        <label for="passwordRepeat">Wachtwoord herhalen</label><br>
        <input type="password" name="passwordRepeat" placeholder="Wachtwoord herhalen"><br>
        <input class="btnSubmit" type="submit" name="btnSubmit" value="Registreren"><br>
        <span class="error">* Verplichte velden</span>
    </form>
<?php
include_once './page_parts/footer.php';
?>