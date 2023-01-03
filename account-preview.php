<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/jquery-3.6.1.min.js"></script>
</head>

<body>
<?php
    session_start();

    require_once "php/config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    echo "
    <div>
        <div class='account-shape'>
            <button>Wyloguj</button>
            <button>Zaloguj się</button>
            <button>Zarejestruj się</button>";
        echo "</div>";
    echo "</div>";
?>

<script src="js/script.js"></script>
<script src="js/previewCart.js"></script>
<script src="js/addToCart.js"></script>
<script src="js/removeFromCart.js"></script>
</body>

<?php
    $connection->close();
?>