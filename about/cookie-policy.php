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
    <title>Polityka cookies | Drogeria internetowa Kosmetykowo.pl</title>
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
        <h1>Polityka Cookies</h1>
        <p>
            <?php echo nl2br("
            Poniższa Polityka Cookies określa zasady zapisywania i uzyskiwania dostępu do danych na Urządzeniach Użytkowników korzystających z Serwisu do celów świadczenia usług drogą elektroniczną przez Administratora Serwisu.

            <h3>1. Definicje</h3>
            Serwis - serwis internetowy działający pod adresem www.kosmetykowo.pl
            Serwis zewnętrzny - serwis internetowe partnerów, usługodawców lub usługobiorców Administratora
            Administrator - firma Kosmetykowo, prowadząca działalność pod adresem: Limanowa 123, 34-600, Limanowa, o nadanym numerze identyfikacji podatkowej (NIP): 1234567890, o nadanym numerze REGON: 098765432, świadcząca usługi drogą elektroniczną za pośrednictwem Serwisu oraz przechowująca i uzyskująca dostęp do informacji w urządzeniach Użytkownika
            Użytkownik - osba fizyczna, dla której Administrator świadczy usługi drogą elektroniczna za pośrednictwem Serwisu.
            Urządzenie - elektroniczne urządzenie wraz z oprogramowaniem, za pośrednictwem, którego Użytkownik uzyskuje dostęp do Serwisu
            Cookies (ciasteczka) - dane tekstowe gromadzone w formie plików zamieszczanych na Urządzeniu Użytkownika
            
            <h3>2. Rodzaje Cookies</h3>
            Cookies wewnętrzne - pliki zamieszczane i odczytywane z Urządzenia Użytkownika przes system teleinformatyczny Serwisu
            Cookies zewnętrzne - pliki zamieszczane i odczytywane z Urządzenia Użytkownika przez systemy teleinformatyczne Serwisów zewnętrznych
            Cookies sesyjne - pliki zamieszczane i odczytywane z Urządzenia Użytkownika przez Serwis lub Serwisy zewnętrzne podczas jednej sesji danego Urządzenia. Po zakończeniu sesji pliki są usuwane z Urządzenia Użytkownika.
            Cookies trwałe - pliki zamieszczane i odczytywane z Urządzenia Użytkownika przez Serwis lub Serwisy zewnętrzne do momentu ich ręcznego usunięcia. Pliki nie są usuwane automatycznie po zakończeniu sesji Urządzenia chyba że konfiguracja Urządzenia Użytkownika jest ustawiona na tryb usuwanie plików Cookie po zakończeniu sesji Urządzenia.
            
            <h3>3. Bezpieczeństwo</h3>
            Mechanizmy składowania i odczytu - Mechanizmy składowania i odczytu Cookies nie pozwalają na pobierania jakichkolwiek danych osobowych ani żadnych informacji poufnych z Urządzenia Użytkownika. Przeniesienie na Urządzenie Użytkownika wirusów, koni trojańskich oraz innych robaków jest praktynie niemożliwe.
            Cookie wewnętrzne - zastosowane przez Administratora Cookie wewnętrzne są bezpieczne dla Urządzeń Użytkowników
            Cookie zewnętrzne - za bezpieczeństwo plików Cookie pochodzących od partnerów Serwisu Administrator nie ponosi odpowiedzialności. Lista partnerów zamieszczona jest w dalszej części Polityki Cookie.

            <h3>4. Cele do których wykorzystywane są pliki Cookie</h3>
            Usprawnienie i ułatwienie dostępu do Serwisu - Administrator może przechowywać w plikach Cookie informacje o prefernecjach i ustawieniach użytkownika dotyczących Serwisu aby usprawnić, polepszyć i przyśpieszyć świadczenie usług w ramach Serwisu.Logowanie - Administrator wykorzystuje pliki Cookie do celów logowania Użytkowników w SerwisieMarketing i reklama - Administrator oraz Serwisy zewnętrzne wykorzystują pliki Cookie do celów marketingowych oraz serwowania reklam Użytkowników.Dane statystyczne - Administrator oraz Serwisy zewnętrzne wykorzystuje pliki Cookie do zbirania i przetwarzania danych statystycznych takich jak np. statystyki odwiedzin, statystyki Urządzeń Użytkowników czy statystyki zachowań użytkowników. Dane te zbierane są w celu analizy i ulepszania Serwisu.

            <h3>5. Serwisy zewnętrzne</h3>
            Administrator nie współpracuje z serwisami zewnętrznymi i Serwis nie umieszcza ani nie korzysta z żadnych plików zewnętrznych plików Cookie.

            <h3>6. Możliwości określania warunków przechowywania i uzyskiwania dostępu na Urządzeniach Użytkownika przez Serwis i Serwisy zewnętrzne</h3>
            Użytkownik może w dowolnym momencie, samodzielnie zmienić ustawienia dotyczące zapisywania, usuwania oraz dostępu do danych zapisanych plików Cookies
            Użytkownik może w dowolnym momencie usunąć wszelkie zapisane do tej pory pliki Cookie korzystając z narzędzi Urządzenia Użytkownika za pośrednictwem którego Użytkowanik korzysta z usług Serwisu.
            
            <h3>7. Wyłączenie odpowiedzialności</h3>
            Administrator stosuje wszelkie możliwe środki w celu zapewnienia bezpieczeństwa danych umieszczanych w plikach Cookie. Należy jednak zwrócić uwagę, że zapewnienie bezpieczeństwa tych danych zależy od obu stron, w tym działalności Użytkownika oraz satnu zabezpieczeń urządzenia z którego korzysta.
            Administrator nie bierze odpowiedzialności za przechwycenie danych zawartych w plikach Cookie, podszycie się pod sesję Użytkownika lub ich usunięcie, na skutek świadomej lub nieświadomej działalność Użytkownika, wirusów, koni trojańskich i innego oprogramowania szpiegującego, którymi może być zainfekowane Urządzenie Użytkownika.
            Użytkownicy w celu zabezpieczenia się przed wskazanymi w punkcie poprzednim zagrożeniami powinni stosować się do zasad cyberbezpieczeństwa w sieci.
            Usługi świadczone przez podmioty trzecie są poza kontrolą Administratora. Podmioty te mogą w każdej chwili zmienić swoje warunki świadczenia usług, cel oraz wykorzystanie plików cookie. Administrator nie odpowiada na tyle na ile pozwala na to prawo za działanie plików cookies używanych przez serwisy partnerskie. Użytkownicy w każdej chwili mogą samodzielnie zarządzać zezwoleniami i ustawieniami plików cookie dla każedej dowolnej witryny.
            
            <h3>8. Wymagania Serwisu</h3>
            Ograniczenie zapisu i dostępu do plików Cookie na Urządzeniu Użytkownika może spowodować nieprawidłowe działanie niektórych funkcji Serwisu.
            Administrator nie ponosi żadnej odpowiedzialności za nieprawidłowo działające funkcje Serwisu w przypadku gdy Użytkownik ograniczy w jakikolwiek sposób możliwość zapisywania i odczytu plików Cookie.
            
            <h3>9. Zmiany w Polityce Cookie</h3>
            Administrator zastrzega sobie prawo do dowolnej zmiany niniejszej Polityki Cookie bez konieczności informowania o tym użytkowników.
            Wprowadzone zmiany w Polityce Cookie zawsze będą publikowane na tej stronie.
            Wprowadzone zmiany wchodzą w życie w dniu publikacji Polityki Cookie."); ?>
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