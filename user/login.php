<?php
    session_start();

    require_once __DIR__."\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);
    
    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    if(isset($_SESSION['loggedin'])) {
        header('Location: account.php');
    }

    

    require_once __DIR__.'\..\page-components\required.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie | Drogeria internetowa Kosmetykowo.pl</title>
    <?php
        require_once __DIR__.'\..\page-components\head.html';
    ?>
    <link rel="stylesheet" href="/sklep/css/login.css">
</head>

<body>
    <?php 
        require_once __DIR__.'\..\page-components\header.html';
        require_once __DIR__.'\..\page-components\nav.php'; 
    ?>
    
    <main>
        <div class='login-container'>
            <div class='login-container-section'>
                <h1>Zaloguj się</h1>
                <form method='POST' action='/sklep/php/login.php'>
                    <label for='username_login'>Nazwa użytkownika</label>
                    <input type='text' class='login-field' name='username' id='username_login' required>
                    <label for='password_login'>Hasło</label>
                    <input type='password' class='login-field' name='password' id='password_login' required maxlength='64'>
                    <a class='forgotten-password'>Nie pamiętam hasła</a>
                    <input class='log-in-button-confirm pink-button' type='submit' value='Zaloguj się'>
                </form>
            </div>
            <div class='login-container-section'>
                <h3>Nie masz konta?</h3>
                <button onclick="location.href='/sklep/user/register.php'"class='register-button white-button' >Zarejestruj się</button>
            </div>
        </div>
    </main>

    <?php 
        require_once __DIR__.'\..\page-components\newsletter.html';
        require_once __DIR__.'\..\page-components\social-media.html'; 
        require_once __DIR__.'\..\page-components\footer.html';
        require_once __DIR__.'\..\page-components\extras.html';
    ?>
</body>
</html>

<?php 
    require_once __DIR__.'\..\page-components\scripts.html';
?>

<script src="/sklep/js/addToCart.js"></script>
<script src="/sklep/js/removeFromCart.js"></script>

<?php
    if(isset($_SESSION['message']) && isset($_SESSION['message-type'])){
        echo "<script>spop('".$_SESSION['message']."', '".$_SESSION['message-type']."');</script>";
        unset($_SESSION["message"]);
        unset($_SESSION["message-type"]);
    }
    $connection->close();
?>