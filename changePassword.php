<?php
include_once './page_parts/header.php';
require_once './includes/queries.inc.php';
require_once './includes/validation.inc.php';

//initialize name & appearance variables
$passwordErr = '';
$password = '';

//check if form is submitted
if(isset($_POST['btnSubmit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
    //connect to database and add the data to table user
    $conn = connect_db();
    //check if password field is not empty
    if(emptyInputCheck($_POST['password'])){
        $passwordErr = 'Wachtwoord is verplicht';
    }elseif(passwordMatchCheck($_POST['password'], $_POST['passwordRepeat'])){
        $passwordErr = 'Wachtwoord komt niet overeen';
    }else{
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    }

    if(!empty($password)) {
        changePassword($conn, $_SESSION['userId'], $password);
        close_db($conn);
        header("location:profile.php");
        echo '<p id="geregistreerdText">Je wachtwoord is veranderd</p>';
        exit();
    }else{
        close_db($conn);
    }
}
?>
<h1>Wachtwoord veranderen</h1>
<form method="post" action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="password">Wachtwoord veranderen</label>
    <span class="error">* <?=$passwordErr;?></span><br>
    <input type="password" name="password" placeholder="Wachtwoord"><br>
    <label for="passwordRepeat">Nieuw wachtwoord herhalen</label><br>
    <input type="password" name="passwordRepeat" placeholder="Wachtwoord herhalen"><br>
    <input class="btnSubmit" type="submit" name="btnSubmit" value="Veranderen"><br>
    <span class="error">* Verplichte velden</span>
</form>
<?php
include_once './page_parts/footer.php';
?>
