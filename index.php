<?php
include_once './page_parts/header.php';
?>
    <main>
        <h1>Welkom <?php echo $_SESSION['userName'] ?> </h1>
        <p id="indexText">
            Een Content Management System website met de bedoeling
            om informatie en nieuwigheden van de verschillende
            programmeertalen te kunnen plaatsen.<br>
            Iedereen kan hier content op de verschillende
            categorieën plaatsen en zo zijn ervaring en informatie
            meedelen met de community van PL_CMS.<br>
            De afkorting PL staat voor programming languages.
        </p>
    </main>
<?php
include_once './page_parts/footer.php';
