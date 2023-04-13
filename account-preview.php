<?php
    session_start();

    require_once __DIR__."\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    if(!(isset($_SERVER['HTTP_SEC_FETCH_DEST']) && $_SERVER['HTTP_SEC_FETCH_DEST'] == 'iframe')) {
        header('Location: '.__DIR__.'\index.php');
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/sklep/css/main.css">
    <link rel="stylesheet" href="/sklep/css/previews.css">
    <script src="/sklep/js/jquery-3.6.1.min.js"></script>
</head>

<body>
    <?php
        if (!isset($_SESSION['loggedin'])){
            echo '
            <div>
                <div class="account-shape">
                    <button onclick="parent.location.href=\'/sklep/user/login.php\'" class="login-button pink-button">Zaloguj się</button>
                    <span>lub</span>
                    <button onclick="parent.location.href=\'/sklep/user/register.php\'" class="register-button pink-button">Zarejestruj się</button>';
                echo "</div>";
            echo "</div>";
        }


        if (isset($_SESSION['loggedin'])){
            echo '
            <div>
                <div class="account-shape">
                    <span class="display-username">'.$_SESSION['username'].'</span>';
                    if(isset($_SESSION['isadmin'])) {
                        echo '<a href="/sklep/admin/admin.php" target="_parent">Panel administratora</a>';
                    }
                    echo '<a href="/sklep/user/account.php" target="_parent">Twoje konto</a>
                    <a href="/sklep/user/orders.php" target="_parent">Zamówienia</a>
                    <button onclick="parent.location.href=\'/sklep/php/logout.php\'" class="white-button">Wyloguj</button>';
                echo "</div>";
            echo "</div>";
        }
    ?>
</body>

<?php
    $connection->close();
?>