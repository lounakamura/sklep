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
                <li><a href='/sklep/user/acount.php'>Twoje konto</a></li>
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
                            <label>Imię</label>
                            <input name='first-name' type='text' value='".$userInfo['imie']."' minlength='2' maxlength='50'>
                            <label>Nazwisko</label>
                            <input name='last-name' type='text' value='".$userInfo['nazwisko']."' minlength='2' maxlength='50'>
                            <label>Nazwa użytkownika</label>
                            <input name='username' type='text' value='".$userInfo['nazwa']."' minlength='1' maxlength='50'>
                            <label>Adres email</label>
                            <input name='email' type='text' value='".$userInfo['email']."' minlength='6' maxlength='254'>
                            <label>Numer telefonu</label>
                            <input name='phone' type='text' value='".$userInfo['numer_telefonu']."' minlength='9' maxlength='50'>";
                        ?>
                        </div>
                        <button type="submit" class="pink-button">Zapisz</button>
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
                            <label>Obecne hasło</label>
                            <input name='current-password' type='password' minlength='5' maxlength='64' required>
                            <label>Nowe hasło</label>
                            <input name='new-password' type='password' minlength='5' maxlength='64' required>
                            <label>Powtórz hasło</label>
                            <input name='repeat-password' type='password' minlength='5' maxlength='64' required>
                        </div>
                        <button type="submit" class="pink-button">Zapisz</button>
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
?>

<?php
    if(isset($_SESSION['message']) && isset($_SESSION['message-type'])){
        echo "<script>spop('".$_SESSION['message']."', '".$_SESSION['message-type']."');</script>";
        unset($_SESSION["message"]);
        unset($_SESSION["message-type"]);
    }
    $connection->close();
?>