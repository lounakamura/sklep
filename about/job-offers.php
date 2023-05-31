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
        <h1>Oferty Pracy</h1>
        <p>
            <?php echo nl2br("
            <h3>Copywriter</h3>
            <h4>Opis stanowiska:</h4>
            <ul><li>Tworzenie tekstów eksperckich o szeroko rozumianej tematyce beauty</li>
            <li>Przygotowywanie opisów produktów na potrzeby sklepu internetowego</li>
            <li>Tworzenie i optymalizacja treści sklepu internetowego pod kątem wyszukiwarek internetowych</li>
            <li>Tworzenie treści na bloga</li>
            <li>Tworzenie tekstów na strony</li></ul>
            
            <h4>Wymagania:</h4>
            <ul><li>Rozumiesz i bardzo dobrze znasz branżę beauty, śledzisz trendy makijażowe i kosmetyczne</li>
            <li>Posiadasz lekkie pióro pdf</li>
            <li>Znasz doskonale zasady pisowni języka polskiego (gramatyka, ortografia, interpunkcja)</li>
            <li>Bogate słownictwo</li>
            <li>Potrafisz dostosować stylu do komunikatu</li>
            <li>Jesteś kreatywna/y</li>
            <li>Jesteś sumienna/y, dokładna/y i terminowa/y</li>
            <li>Rozumiesz czym jest SEO i potrafisz budować treści na strony internetowe</li></ul>
        
            <h4>Oferujemy:</h4>
            <ul><li>Praca w dużym, młodym zespole</li>
            <li>Umowa o pracę na pełen etat, współpraca B2B</li>
            <li>Komfortowe miejsce i warunki pracy</li>
            <li>Praca w młodym, energicznym zespole</li>
            <li>Szkolenie wdrożeniowe</li>
            <li>Rabat pracowniczy</li></ul>
            "); ?>
        </p>
        <a href='mailto:rekrutacja@kosmetykowo.pl' style='text-align:center;'><h3>Aplikuj</h3></a>
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