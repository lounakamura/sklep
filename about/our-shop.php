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
    <title>Nasz sklep | Drogeria internetowa Kosmetykowo.pl</title>
    <?php
        require_once __DIR__.'\..\page-components\head.html';
    ?>
</head>

<body>
    <?php 
        require_once __DIR__.'\..\page-components\header.html';
        require_once __DIR__.'\..\page-components\nav.php'; 
    ?>
    
    <main>
        <h1>
            <img class="logo_big" src="/sklep/images/ui/logo-big.svg">
        </h1>
        <p>
            Kosmetykowo to sklep internetowy, który prowadzi sprzedaż wysyłkową z dostawą do domu. W asortymencie znajdują się kultowe marki podbijające Internet, kosmetyki do pielęgnacji oraz zdobywające uznanie polskie, naturalne kosmetyki, a także niszowe kosmetyki.
        </p>
        <br>
        <p>
            Wysokiej jakości kosmetyki i akcesoria do makijażu które trudno znaleźć w tradycyjnych sklepach z kosmetykami, sprowadzane są przez nas prosto z Wielkiej Brytanii, USA oraz innych zakątków świata. Często są to produkty uznane wśród blogerek, gwiazd show biznesu i najlepszych makijażystek, wyróżnione przez Best Beauty Buys oraz Glamour Glammies.
        </p>
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