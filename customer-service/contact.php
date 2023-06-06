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
    <title>Kontakt | Drogeria internetowa Kosmetykowo.pl</title>
    <?php
        require_once __DIR__.'\..\page-components\head.html';
    ?>
    <style>
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        main > div {
            width: 600px;
        }
        main > div > div {
            margin: 20px 0 20px 0;
        }
        main > div form {
            display: flex;
            flex-direction: column;
        }
        main > div form * {
            margin: 3px 0 3px 0;
        }
        main > div form input,
        main > div form textarea {
            font-size: 17px;
            border-radius: 1px;
            border: 1px solid #c2c2c2;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        main > div form input {
            height: 45px;
        }
        main > div form textarea {
            height: 300px;
        }
    </style>
</head>

<body>
    <?php 
        require_once __DIR__.'\..\page-components\header.html';
        require_once __DIR__.'\..\page-components\nav.php'; 
    ?>
    
    <main>
        <div>
            <h1>Kontakt</h1>
            
            <div>
                <h3>Email</h3>
                <p>kontakt@kosmetykowo.pl</p>
            </div>
            <div>
                <h3>Telefon</h3>
                <p>123 256 789</p>
            </div>
            <div>
                <h3>Formularz kontaktowy</h3>
                <form method='POST'>
                    <label for='first-last-name'>Imię i nazwisko</label>
                    <input type='text' id='fist-last-name' name='fist-last-name' required>
                    <label for='email'>Adres email</label>
                    <input type='email' id='email' name='email' required>
                    <label for='message'>Treść wiadomości</label>
                    <textarea name='message' id='message' required></textarea>
                    <button type='submit' class='pink-button'>Wyślij</button>
                </form>
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