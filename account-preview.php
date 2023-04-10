<?php
    session_start();

    require_once "php/config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    $connection = new mysqli ($servername, $username, $password, $database);

    if(!(isset($_SERVER['HTTP_SEC_FETCH_DEST']) && $_SERVER['HTTP_SEC_FETCH_DEST'] == 'iframe')) {
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/previews.css">
    <script src="js/jquery-3.6.1.min.js"></script>
</head>

<body>
    <?php
        if (!isset($_SESSION['loggedin'])){
            echo '
            <div>
                <div class="account-shape">
                    <button onclick="parent.location.href=\'/sklep/login.php\'" class="login-button pink-button">Zaloguj się</button>
                    <span>lub</span>
                    <button onclick="parent.location.href=\'/sklep/register.php\'" class="register-button pink-button">Zarejestruj się</button>';
                echo "</div>";
            echo "</div>";
        }


        if (isset($_SESSION['loggedin'])){
            echo '
            <div>
                <div class="account-shape">
                    <span class="display-username">'.$_SESSION['username'].'</span>';
                    if(isset($_SESSION['isadmin'])) {
                        echo '<a href="/sklep/admin.php" target="_parent">Panel administratora</a>';
                    }
                    echo '<a href="user/account.php" target="_parent">Twoje konto</a>
                    <a href="user/orders.php" target="_parent">Zamówienia</a>
                    <button onclick="parent.location.href=\'/sklep/php/logout.php\'" class="white-button">Wyloguj</button>';
                echo "</div>";
            echo "</div>";
        }
    ?>

    <script src="js/script.js"></script>
    <script src="js/previewCart.js"></script>
    <script src="js/addToCart.js"></script>
    <script src="js/removeFromCart.js"></script>
</body>

<?php
    $connection->close();
?>