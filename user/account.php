<?php
    session_start();

    require_once __DIR__."\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    if(!isset($_SESSION['loggedin'])) {
        header('Location: login.php');
    }

    $userInfo = [];

    $query = "SELECT uzytkownik_id, nazwa, email, imie, nazwisko, numer_telefonu FROM uzytkownik WHERE uzytkownik_id=".$_SESSION['id'];
    $result = $connection->query($query);
    $userInfo = $result->fetch_assoc();
    $result->free();

    require_once __DIR__.'\..\page-components\required.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twoje konto | Drogeria internetowa Kosmetykowo.pl</title>
    <?php
        require_once __DIR__.'\..\page-components\head.html';
    ?>
    <link rel="stylesheet" href="/sklep/css/account.css">
</head>

<body>
    <?php 
        require_once __DIR__.'\..\page-components\header.html';
        require_once __DIR__.'\..\page-components\nav.php'; 
    ?>

    <main>
        <div class='breadcrumbs'>
            <ul>
                <li><a href='/sklep/index.php'>Strona Główna</a></li>
                <li><a href='/sklep/user/account.php'>Konto</a></li>
            </ul>
        </div>

        <div class="container">
            <label for='state1'>
                <div class='accordion'>Moje dane</div>
            </label>
            <input type='checkbox' id='state1' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/php/modify-user-info.php">
                        <div>
                        <?php
                            echo "
                            <label for='first-name'>Imię</label>
                            <input name='first-name' id='first-name' type='text' value='".$userInfo['imie']."' minlength='2' maxlength='50' pattern='[A-Za-zĄĘĆŻŹŁÓąęćżźłó]{2,50}'>
                            <label for='last-name'>Nazwisko</label>
                            <input name='last-name' id='last-name' type='text' value='".$userInfo['nazwisko']."' minlength='2' maxlength='50' pattern='[A-Za-zĄĘĆŻŹŁÓąęćżźłó]{2,50}'>
                            <label for='username' class='required'>Nazwa użytkownika</label>
                            <input name='username' id='username' type='text' value='".$userInfo['nazwa']."' minlength='1' maxlength='50' required>
                            <label for='email' class='required'>Adres email</label>
                            <input name='email' id='email' type='text' value='".$userInfo['email']."' minlength='6' maxlength='254' required>
                            <label for='phone'>Numer telefonu</label>
                            <input name='phone' id='phone' type='tel' pattern='[0-9]{9}' value='".$userInfo['numer_telefonu']."' minlength='9' maxlength='9'>";
                        ?>
                        </div>
                        <button type="submit" class="pink-button">Zapisz zmiany</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state2'>
                <div class='accordion'>Zmiana hasła</div>
            </label>
            <input type='checkbox' id='state2' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/php/change-password.php">
                        <div>
                            <label for='current-password' class='required'>Obecne hasło</label>
                            <input name='current-password' id='current-password' type='password' minlength='5' maxlength='64' required>
                            <label for='new-password' class='required'>Nowe hasło</label>
                            <input name='new-password' id='new-password' type='password' minlength='5' maxlength='64' required>
                            <label for='repeat-password' class='required'>Powtórz hasło</label>
                            <input name='repeat-password' id='repeat-password' type='password' minlength='5' maxlength='64' required>
                        </div>
                        <button type="submit" class="pink-button">Zapisz zmiany</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php 
        require_once __DIR__.'\..\page-components\social-media.html'; 
        require_once __DIR__.'\..\page-components\footer.html';
        require_once __DIR__.'\..\page-components\extras.html';
    ?>
</body>
</html>

<?php 
    require_once __DIR__.'\..\page-components\scripts.html';
    require_once __DIR__.'\..\page-components\popup-module.php';
?>

<?php
    $connection->close();
?>