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
    <title>Rejestracja | Drogeria internetowa Kosmetykowo.pl</title>
    <link rel="icon" type="image/ico" href="/sklep/images/ui/logo-small.svg">
    <link rel="stylesheet" href="/sklep/css/main.css">
    <link rel="stylesheet" href="/sklep/css/register.css">
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
        <div class='register-container'>
            <h1>Zarejestruj się</h1>
            <form method='POST' action='/sklep/php/register.php'>
                <label for='email'>E-mail</label><input type='email' name='email' class='register-field' id='email' required minlength='6' maxlength='254'>
                <label for='username_register'>Nazwa użytkownika</label><input type='text' class='register-field' name='username' id='username_register' required minlength='1' maxlength='50'>
                <label for='password_register'>Hasło</label><input type='password' name='password' class='register-field' id='password_register' required minlength='5' maxlength='64'>
                <label for='repeat-password'>Powtórz hasło</label><input type='password' name='repeat-password' class='register-field' id='repeat-password' required minlength='5' maxlength='64'>
                <div>
                    <input type='checkbox' id='accept-rules' required><label for='accept-rules'>Akceptuję warunki <a>regulaminu</a></label>
                </div>
                <div>
                    <input type='checkbox' name='newsletter' id='newsletter-add'><label for='newsletter-add'>Chcę zapisać się do newslettera</label>
                </div>
                <input class='register-button-confirm pink-button' type='submit' value='Zarejestruj się'>
            </form>
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