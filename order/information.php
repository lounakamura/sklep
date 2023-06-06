<?php
    session_start();

    require_once __DIR__."\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);
    
    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }

    if(!isset($_SESSION['loggedin'])){
        header('Location: login.php');
    }

    $query = "SELECT koszyk_id FROM koszyk WHERE uzytkownik_id=".$_SESSION['id'];
    $result = $connection->query($query);
    if(mysqli_num_rows($result)<=0){
        header('Location: ../cart.php');
    }

    $countries = [];
    $userInfo = [];

    $query = "SELECT * FROM kraj";
    $result = $connection->query($query);
    fetchAllToArray($countries, $result);
    $result->free();

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
        <?php
            require_once 'nav.php';
        ?>

        <div class='client-info'>
            <h1>Twoje dane</h1>
            <form method='POST' action='../php/save-information.php'>
                <?php
                    echo "
                    <div class='company'>
                        <div>
                            <input class='info-field' type='radio' name='company' value='no' id='private-person' onclick='changeFormDisplay(this)' checked>
                            <label for='private-person'>Osoba prywatna</label>
                        </div>
                        <div>
                            <input class='info-field' type='radio' name='company' value='yes' id='company' onclick='changeFormDisplay(this)'>
                            <label for='company'>Firma</label>
                        </div>
                    </div>
                    <div class='name'>
                        <label for='first-name' class='required'>Imię</label>
                        <input class='info-field' type='text' name='first-name' id='first-name' value='".$userInfo['imie']."' minlength='2' maxlength='50' required>
                    </div>
                    <div class='last-name'>
                        <label for='last-name' class='required'>Nazwisko</label>
                        <input class='info-field' type='text' name='last-name' id='last-name' value='".$userInfo['nazwisko']."' minlength='2' maxlength='50' required>
                    </div>
                    <div class='company-name not-displayed'>
                        <label for='company-name' class='required'>Nazwa firmy</label>
                        <input class='info-field' type='text' name='company-name' id='company-name' minlength='2' maxlength='50' disabled>
                    </div>
                    <div class='nip not-displayed'>
                        <label for='nip' class='required'>NIP</label>
                        <input class='info-field' type='text' name='nip' id='nip' minlength='10' maxlength='10' disabled>
                    </div>
                    <div class='street'>
                        <label for='street' class='required'>Ulica</label>
                        <input class='info-field' type='text' name='street' id='street' minlength='2' maxlength='50' required>
                    </div>
                    <div class='street-no'>
                        <label for='street-no' class='required'>Nr domu</label>
                        <input class='info-field' type='number' name='street-no' id='street-no' min='1' max='9999' minlength='1' required>
                    </div>
                    <div class='house-no'>
                        <label for='house-no'>Nr mieszkania</label>
                        <input class='info-field' type='number' name='house-no' id='house-no' min='1' max='9999'>
                    </div>
                    <div class='city'>
                        <label for='city' class='required'>Miasto</label>
                        <input class='info-field' type='text' name='city' id='city' minlength='2' maxlength='50' required>
                    </div>
                    <div class='postal-code'>
                        <label for='postal-code' class='required'>Kod pocztowy</label>
                        <input class='info-field' type='text' name='postal-code' id='postal-code' minlength='5' maxlength='6' required>
                    </div>
                    <div class='country'>
                        <label for='country' class='required'>Kraj</label>
                        <select class='info-field' name='country' id='country'>";
                                foreach ($countries as $country) {
                                    echo "<option value='".$country['kraj_id']."'>".$country['nazwa']."</option>";
                                }
                        echo "</select>
                    </div>
                    <div class='phone'>
                        <label for='phone' class='required'>Numer telefonu</label>
                        <input class='info-field' type='tel' pattern='[0-9]{9}' name='phone' id='phone' value='".$userInfo['numer_telefonu']."' minlength='9' maxlength='9' required>
                    </div>
                    <div class='email'>
                        <label for='email' class='required'>Adres email</label>
                        <input class='info-field' type='email' name='email' id='email' value='".$userInfo['email']."' minlength='6' maxlength='254' required>
                    </div>
                    <div class='buttons'>
                        <input type='hidden' name='previous' value='information'>
                        <button type='submit' class='pink-button'>Przejdź dalej</button>
                        <button type='button' class='white-button go-back' onclick='location.href=\"/sklep/cart.php\"'>Wróć</button>
                    </div>";
                ?>
            </form>
        </div>
    </main>

    <?php 
        require_once __DIR__.'\..\page-components\footer.html';
    ?>
</body>
</html>

<script src="/sklep/js/orderInfoDisplay.js"></script>
<script src="/sklep/js/misc.js"></script>

<?php
    $connection->close();
?>