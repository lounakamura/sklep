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
        header('Location: ..\account.php');
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
    <link rel="icon" type="image/ico" href="/sklep/images/ui/logo-small.svg">
    <link rel="stylesheet" href="/sklep/css/main.css">
    <link rel="stylesheet" href="/sklep/css/login.css">
    <script src="/sklep/js/jquery-3.6.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/it.js"></script>
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
                <button onclick="location.href='/sklep/php/register.php'"class='register-button white-button' >Zarejestruj się</button>
            </div>
        </div>
    </main>

    <?php 
        require_once __DIR__.'\..\page-components\newsletter.html';
        require_once __DIR__.'\..\page-components\social-media.html'; 
        require_once __DIR__.'\..\page-components\footer.html';
        require_once __DIR__.'\..\page-components\extras.html';
    ?>

    <script src="/sklep/js/misc.js"></script>
    <script src="/sklep/js/scrollToTop.js"></script>
    <script src="/sklep/js/menuHandler.js"></script>
<script src="/sklep/js/select2.js"></script>
    <script src="/sklep/js/cartPreview.js"></script>
    <script src="/sklep/js/addToCart.js"></script>
    <script src="/sklep/js/removeFromCart.js"></script>
    <script src="/sklep/js/accountPreview.js"></script>
</body>
</html>

<?php
    $connection->close();
?>