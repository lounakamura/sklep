<?php
    session_start();

    require_once __DIR__."\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);
    
    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    require_once __DIR__.'\..\page-components\required.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drogeria internetowa Kosmetykowo.pl</title>
    <?php
        require_once __DIR__.'\..\page-components\head.html';
    ?>
    <link rel="stylesheet" href="/sklep/css/order.css">
</head>

<body>
    <header class='header-small'>
        <div class="logo_big-container">
            <a href="/sklep/index.php"><img class="logo_big" src="/sklep/images/ui/logo-big.svg" /></a>
        </div>
    </header>

    <main>
        <div class='order-navigation'>
            <a class='nav' href='/sklep/cart.php'>
                <span class='order-icons'>
                    <i class="fa-solid fa-cart-shopping fa-xl" style="color: #000000;"></i>
                </span>
                <span class='nav-text'>
                    <span class='nav-name'>Koszyk</span>
                    <span class='nav-desc'>Jakiś tekst</span>
                </span>
            </a>
            <a class='nav' href='/sklep/order/login.php'>
                <span class='order-icons'>
                    <i class="fa-solid fa-file-lines fa-xl" style="color: #000000;"></i>
                </span>
                <span class='nav-text'>
                    <span class='nav-name'>Twoje dane</span>
                    <span class='nav-desc'>Jakiś tekst</span>
                </span>
            </a>
            <a class='nav' href='/sklep/order/shipping.php'>
                <span class='order-icons'>
                    <i class="fa-solid fa-truck fa-xl" style="color: #000000;"></i>
                </span>
                <span class='nav-text'>
                    <span class='nav-name'>Dostawa i płatność</span>
                    <span class='nav-desc'>Jakiś tekst</span>
                </span>
            </a>
            <a class='nav' href='/sklep/order/check.php'>
                <span class='order-icons bubble-icon'>
                    <i class="fa-solid fa-clipboard-check fa-xl" style="color: #000000;"></i>
                </span>
                <span class='nav-text'>
                    <span class='nav-name'>Weryfikacja danych</span>
                    <span class='nav-desc'>Jakiś tekst</span>
                </span>
            </a>
        </div>
        
        <div class='login-container'>
            <div class='login-container-section'>
                <h1>Logowanie</h1>
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
        require_once __DIR__.'\..\page-components\footer.html';
    ?>
</body>
</html>

<?php
    $connection->close();
?>