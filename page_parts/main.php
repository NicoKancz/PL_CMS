    <main>
<!--        todo: design containers-->
        <?php
            require_once './includes/queries.inc.php';

            $conn = connect_db();
            $rows = showContainers($conn);
            foreach($rows as $row){
                echo
                    '<div class="languageContainer">
                        <h2>' . $row['containerName'] . '</h2>
                    </div>';
            }
        ?>
    </main>
