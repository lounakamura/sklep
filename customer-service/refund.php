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
</head>

<body>
    <?php 
        require_once __DIR__.'\..\page-components\header.html';
        require_once __DIR__.'\..\page-components\nav.php'; 
    ?>
    
    <main>
        <h1>Reklamacje</h1>
        <p>
            <?php echo nl2br("
            Każdy klient ma prawo reklamacji produktów kupionych w sklepie internetowym Kosmetykowo.

            Warunkiem koniecznym uznania reklamacji jest poinformowanie o tym fakcie obsługi sklepu internetowego.

            Możesz skontaktować się z nami na kilka sposobów:

            - Kontakt telefoniczny
            - Wypełnienie i wysłanie formularza kontaktowego
            - Wysyłka emaila na adres: zwrot@kosmetykowo.pl

            Pamiętaj, aby zareklamować towar, należy przedstawić nam jego dowód zakupu (np. fakturę VAT, potwierdzenie zamówienia z numerem lub paragon) i przekazać nam informację o jego numerze."); ?>
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
?>

<?php
    $connection->close();
?>