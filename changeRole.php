<?php
include_once './page_parts/header.php';
require_once './includes/queries.inc.php';
require_once './includes/validation.inc.php';

//initialize name & appearance variables
$nameErr = $roleErr = '';
$name = $role = '';

//check if form is submitted
if(isset($_POST['btnSubmit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
    //connect to database and add the data to table user
    $conn = connect_db();
    //check if fields are valid
    if(emptyInputCheck($_POST['name'])){
        $nameErr = 'Naam is verplicht';
    }elseif(userNameExistCheck($conn, $_POST['name'], $_POST['name']) === false){
        $nameErr = 'Naam of email bestaat niet';
    }else{
        $name = $_POST['name'];
    }

    if(emptyInputCheck($_POST['role'])){
        $roleErr = 'Rol is verplicht';
    }elseif(userRoleCheck($conn, $_POST['name'], $_POST['role'])){
        $roleErr = 'Rol van de gebruiker al toegepast';
    }else{
        $role = $_POST['role'];
    }

    if(!empty($name) && !empty($role)) {
        changeUserRole($conn, $name, $role);
        close_db($conn);
        header("location:profile.php");
        exit();
    }else{
        close_db($conn);
    }
}
?>
    <h1>Rol van een gebruiker veranderen</h1>
    <form method="post" action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <p class="light">Gelieve een bestaand gebruikersnaam in te vullen van de gebruiker waar u de rol wilt veranderen.</p>
        <label for="name">Gerbuikersnaam</label>
        <span class="error">* <?=$nameErr;?></span><br>
        <input type="text" name="name" placeholder="Naam"><br>
        <label for="role">Nieuwe rol</label>
        <span class="error">* <?=$roleErr;?></span><br>
        <select name="role">
            <option value="Administrator">Administrator</option>
            <option value="Moderator">Moderator</option>
            <option value="Gebruiker" selected="selected">Gebruiker</option>
            <option value="Blocked">Blocked</option>
        </select><br>
        <input class="btnSubmit" type="submit" name="btnSubmit" value="Rol veranderen"><br>
        <span class="error">* Verplichte velden</span>
    </form>
<?php
include_once './page_parts/footer.php';
?>
