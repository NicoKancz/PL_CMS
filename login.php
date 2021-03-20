<?php
include_once './page_parts/header.php';

session_start();
//initialize name & appearance variables
$nameErr = $passwordErr = '';
$name = $password = '';

//check if form is submitted
if(isset($_POST['btnSubmit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
    //check if language fields are not empty
    if(empty($_POST['name'])){
        $nameErr = 'Naam is verplicht';
    }else{
        $name = $_POST['name'];
    }

    if(empty($_POST['password'])){
        $appearanceErr = 'Wachtwoord is verplicht';
    }else{
        $appearance = $_POST['appearance'];
    }

    if(!empty($name) && !empty($password)) {
        //connect to database and get the data from the table user
        $conn = connect_db();
        getUser($conn, $id);
        close_db($conn);
        header("location:index.php");
    }
}
?>
    <form method="post" action="./index.php">
        <label>Gebruikersnaam</label>
        <input type="text" name="name"><br>
        <label>Wachtwoord</label>
        <input type="text" name="password"><br>
        <input type="submit" name="btnSubmit" value="Inlogen">
    </form><br>
    <a href="./register.php">Nog geen gebruiker?</a><br>
    <a href="./reset-password.php">Wachtwoord vergeten?</a>
<?php
include_once './page_parts/footer.php';
?>