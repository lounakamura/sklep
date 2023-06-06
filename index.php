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
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Główna | Drogeria internetowa Kosmetykowo.pl</title>
    <?php
        require_once __DIR__.'\page-components\head.html';
    ?>
    <link rel="stylesheet" href="/sklep/css/home.css">
</head>
<body>
    <?php 
        require_once __DIR__.'\page-components\header.html';
        require_once __DIR__.'\page-components\nav.php'; 
    ?>

    <main>
        <div class='slideshow-container'>
            <a class='promo-banner-container' href='/sklep/products.php'>
                <div class='promo-banner'></div>
            </a>
            <a class='promo-banner-container' href='/sklep/products.php'>
                <div class='promo-banner'></div>
            </a>
            <a class='promo-banner-container' href='/sklep/products.php'>
                <div class='promo-banner'></div>
            </a>
        </div>
    </main>

    <?php 
        require_once __DIR__.'\page-components\social-media.html'; 
        require_once __DIR__.'\page-components\footer.html';
        require_once __DIR__.'\page-components\extras.html';
    ?>
</body>
</html>

<?php 
    require_once __DIR__.'\page-components\scripts.html';
?>

<script src="/sklep/js/slideshowGallery.js"></script>

<script src="/sklep/js/addToCart.js"></script>
<script src="/sklep/js/productQuantity.js"></script>

<?php
    $connection->close();
?>