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

        // Niezalogowany
        echo "
        <div>
            <div class='account-shape'>
                <button class='login-button'>Zaloguj się</button>
                <button class='register-button'>Zarejestruj się</button>";
            echo "</div>";
        echo "</div>";


        // Zalogowany
        echo "
        <div>
            <div class='account-shape'>
                <button>Wyloguj</button>";
            echo "</div>";
        echo "</div>";
    ?>

    <script src="js/script.js"></script>
    <script src="js/previewCart.js"></script>
    <script src="js/addToCart.js"></script>
    <script src="js/removeFromCart.js"></script>
    <script src="js/logIn.js"></script>
    <script src="js/register.js"></script>
</body>

<?php
    $connection->close();
?>