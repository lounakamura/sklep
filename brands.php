<?php
    session_start();

    require_once __DIR__."\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    require_once __DIR__.'\page-components\required.php';

    $letters = [];

    // Storing brands' first letter of name alphabetically
    $query = "SELECT DISTINCT UPPER(SUBSTRING(marka, 1, 1)) AS litera FROM marka ORDER BY marka";
    $result = $connection->query($query);
    fetchAllToArray($letters, $result);
    $result->free();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marki | Drogeria internetowa Kosmetykowo.pl</title>
    <?php
        require_once __DIR__.'\page-components\head.html';
    ?>
    <link rel="stylesheet" href="/sklep/css/brands.css">
</head>

<body>
    <?php 
        require_once __DIR__.'\page-components\header.html';
        require_once __DIR__.'\page-components\nav.php'; 
    ?>

    <main>
        <section class="alphabet-ref">
            <?php
                foreach ($letters as $letter) {
                    echo "<a href='#" . $letter['litera'] . "'>" . $letter['litera'] . "</a>";
                }
            ?>
        </section>
        <section>
            <?php
                foreach ($letters as $letter) {
                    $brands = [];
                    echo "<div id='" . $letter['litera'] . "' class='brand'>";
                        echo "<h2>" . $letter['litera'] . "</h2>";

                        $query = "SELECT * FROM marka WHERE UPPER(SUBSTRING(marka, 1, 1))='" . $letter['litera'] . "'";
                        $result = $connection->query($query);
                        fetchAllToArray( $brands, $result );
                        $result->free();

                        foreach ( $brands as $brand ) {
                            echo "<a href='/sklep/products.php?brand=" . $brand['marka_id'] . "'>" . $brand['marka'] . "</a>";
                        }

                    echo "</div>";
                    unset($brands);
                }
            ?>
        </section>
    </main>

    <?php 
        require_once __DIR__.'\page-components\newsletter.html';
        require_once __DIR__.'\page-components\social-media.html'; 
        require_once __DIR__.'\page-components\footer.html';
        require_once __DIR__.'\page-components\extras.html';
    ?>
</body>
</html>

<?php 
    require_once __DIR__.'\page-components\scripts.html';
?>

<?php
    $connection->close();
?>