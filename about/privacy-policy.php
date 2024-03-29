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
    <title>Polityka prywatności | Drogeria internetowa Kosmetykowo.pl</title>
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
        <h1>Polityka prywatności</h1>
        <p>
            <?php echo nl2br("
            <h3>1. Informacje ogólne</h3>
            Niniejsza polityka dotyczy Serwisu www, funkcjonującego pod adresem url: kosmetykowo.pl
            Operatorem serwisu oraz Administratorem danych osobowych jest: Kosmetykowo Limanowa 123, 34-600, Limanowa
            Adres kontaktowy poczty elektronicznej operatora: kosmetykowo@gmail.com
            Operator jest Administratorem Twoich danych osobowych w odniesieniu do danych podanych dobrowolnie w Serwisie.
            Serwis wykorzystuje dane osobowe w następujących celach:
            Prowadzenie newslettera
            Prowadzenie systemu komentarzy
            Obsługa zapytań przez formularz
            Przygotowanie, pakowanie, wysyłka towarów
            Realizacja zamówionych usług
            Prezentacja oferty lub informacji
            Serwis realizuje funkcje pozyskiwania informacji o użytkownikach i ich zachowaniu w następujący sposób:
            Poprzez dobrowolnie wprowadzone w formularzach dane, które zostają wprowadzone do systemów Operatora.
            Poprzez zapisywanie w urządzeniach końcowych plików cookie (tzw. „ciasteczka”).

            <h3>2. Wybrane metody ochrony danych stosowane przez Operatora</h3>
            Miejsca logowania i wprowadzania danych osobowych są chronione w warstwie transmisji (certyfikat SSL). Dzięki temu dane osobowe i dane logowania, wprowadzone na stronie, zostają zaszyfrowane w komputerze użytkownika i mogą być odczytane jedynie na docelowym serwerze.
            Dane osobowe przechowywane w bazie danych są zaszyfrowane w taki sposób, że jedynie posiadający Operator klucz może je odczytać. Dzięki temu dane są chronione na wypadek wykradzenia bazy danych z serwera.
            Hasła użytkowników są przechowywane w postaci hashowanej. Funkcja hashująca działa jednokierunkowo - nie jest możliwe odwrócenie jej działania, co stanowi obecnie współczesny standard w zakresie przechowywania haseł użytkowników.
            W celu ochrony danych Operator regularnie wykonuje kopie bezpieczeństwa.
            Istotnym elementem ochrony danych jest regularna aktualizacja wszelkiego oprogramowania, wykorzystywanego przez Operatora do przetwarzania danych osobowych, co w szczególności oznacza regularne aktualizacje komponentów programistycznych.

            <h3>3. Hosting</h3>
            Serwis jest hostowany (technicznie utrzymywany) na serwerach operatora: smarthost.pl

            <h3>4. Twoje prawa i dodatkowe informacje o sposobie wykorzystania danych</h3>
            W niektórych sytuacjach Administrator ma prawo przekazywać Twoje dane osobowe innym odbiorcom, jeśli będzie to niezbędne do wykonania zawartej z Tobą umowy lub do zrealizowania obowiązków ciążących na Administratorze. Dotyczy to takich grup odbiorców:
            firma hostingowa na zasadzie powierzenia
            kurierzy
            banki
            operatorzy płatności
            operatorzy systemu komentarzy
            upoważnieni pracownicy i współpracownicy, którzy korzystają z danych w celu realizacji celu działania strony
            firmy, świadczące usługi marketingu na rzecz Administratora
            Twoje dane osobowe przetwarzane przez Administratora nie dłużej, niż jest to konieczne do wykonania związanych z nimi czynności określonych osobnymi przepisami (np. o prowadzeniu rachunkowości). W odniesieniu do danych marketingowych dane nie będą przetwarzane dłużej niż przez 3 lata.
            Przysługuje Ci prawo żądania od Administratora:
            dostępu do danych osobowych Ciebie dotyczących,
            ich sprostowania,
            usunięcia,
            ograniczenia przetwarzania,
            oraz przenoszenia danych.
            Przysługuje Ci prawo do złożenia sprzeciwu w zakresie przetwarzania wskazanego w pkt 3.3 c) wobec przetwarzania danych osobowych w celu wykonania prawnie uzasadnionych interesów realizowanych przez Administratora, w tym profilowania, przy czym prawo sprzeciwu nie będzie mogło być wykonane w przypadku istnienia ważnych prawnie uzasadnionych podstaw do przetwarzania, nadrzędnych wobec Ciebie interesów, praw i wolności, w szczególności ustalenia, dochodzenia lub obrony roszczeń.
            Na działania Administratora przysługuje skarga do Prezesa Urzędu Ochrony Danych Osobowych, ul. Stawki 2, 00-193 Warszawa.
            Podanie danych osobowych jest dobrowolne, lecz niezbędne do obsługi Serwisu.
            W stosunku do Ciebie mogą być podejmowane czynności polegające na zautomatyzowanym podejmowaniu decyzji, w tym profilowaniu w celu świadczenia usług w ramach zawartej umowy oraz w celu prowadzenia przez Administratora marketingu bezpośredniego.
            Dane osobowe nie są przekazywane od krajów trzecich w rozumieniu przepisów o ochronie danych osobowych. Oznacza to, że nie przesyłamy ich poza teren Unii Europejskiej.

            <h3>5. Informacje w formularzach</h3>
            Serwis zbiera informacje podane dobrowolnie przez użytkownika, w tym dane osobowe, o ile zostaną one podane.
            Serwis może zapisać informacje o parametrach połączenia (oznaczenie czasu, adres IP).
            Serwis, w niektórych wypadkach, może zapisać informację ułatwiającą powiązanie danych w formularzu z adresem e-mail użytkownika wypełniającego formularz. W takim wypadku adres e-mail użytkownika pojawia się wewnątrz adresu url strony zawierającej formularz.
            Dane podane w formularzu są przetwarzane w celu wynikającym z funkcji konkretnego formularza, np. w celu dokonania procesu obsługi zgłoszenia serwisowego lub kontaktu handlowego, rejestracji usług itp. Każdorazowo kontekst i opis formularza w czytelny sposób informuje, do czego on służy.

            <h3>6. Logi Administratora</h3>
            Informacje zachowaniu użytkowników w serwisie mogą podlegać logowaniu. Dane te są wykorzystywane w celu administrowania serwisem.

            <h3>7. Istotne techniki marketingowe</h3>
            Operator stosuje analizę statystyczną ruchu na stronie, poprzez Google Analytics (Google Inc. z siedzibą w USA). Operator nie przekazuje do operatora tej usługi danych osobowych, a jedynie zanonimizowane informacje. Usługa bazuje na wykorzystaniu ciasteczek w urządzeniu końcowym użytkownika. W zakresie informacji o preferencjach użytkownika gromadzonych przez sieć reklamową Google użytkownik może przeglądać i edytować informacje wynikające z plików cookies przy pomocy narzędzia: https://www.google.com/ads/preferences/
            Operator stosuje techniki remarketingowe, pozwalające na dopasowanie przekazów reklamowych do zachowania użytkownika na stronie, co może dawać złudzenie, że dane osobowe użytkownika są wykorzystywane do jego śledzenia, jednak w praktyce nie dochodzi do przekazania żadnych danych osobowych od Operatora do operatorom reklam. Technologicznym warunkiem takich działań jest włączona obsługa plików cookie.
            Operator stosuje korzysta z piksela Facebooka. Ta technologia powoduje, że serwis Facebook (Facebook Inc. z siedzibą w USA) wie, że dana osoba w nim zarejestrowana korzysta z Serwisu. Bazuje w tym wypadku na danych, wobec których sam jest administratorem, Operator nie przekazuje od siebie żadnych dodatkowych danych osobowych serwisowi Facebook. Usługa bazuje na wykorzystaniu ciasteczek w urządzeniu końcowym użytkownika.
            Operator stosuje rozwiązanie badające zachowanie użytkowników poprzez tworzenie map ciepła oraz nagrywanie zachowania na stronie. Te informacje są anonimizowane zanim zostaną przesłane do operatora usługi tak, że nie wie on jakiej osoby fizycznej one dotyczą. W szczególności nagrywaniu nie podlegają wpisywane hasła oraz inne dane osobowe.
            Operator stosuje rozwiązanie automatyzujące działanie Serwisu w odniesieniu do użytkowników, np. mogące przesłać maila do użytkownika po odwiedzeniu konkretnej podstrony, o ile wyraził on zgodę na otrzymywanie korespondencji handlowej od Operatora.
            Operator może stosować profilowanie w rozumieniu przepisów o ochronie danych osobowych

            <h3>8. Informacja o plikach cookies</h3>
            Serwis korzysta z plików cookies.
            Pliki cookies (tzw. „ciasteczka”) stanowią dane informatyczne, w szczególności pliki tekstowe, które przechowywane są w urządzeniu końcowym Użytkownika Serwisu i przeznaczone są do korzystania ze stron internetowych Serwisu. Cookies zazwyczaj zawierają nazwę strony internetowej, z której pochodzą, czas przechowywania ich na urządzeniu końcowym oraz unikalny numer.
            Podmiotem zamieszczającym na urządzeniu końcowym Użytkownika Serwisu pliki cookies oraz uzyskującym do nich dostęp jest operator Serwisu.
            Pliki cookies wykorzystywane są w następujących celach:
            utrzymanie sesji użytkownika Serwisu (po zalogowaniu), dzięki której użytkownik nie musi na każdej podstronie Serwisu ponownie wpisywać loginu i hasła;
            realizacji celów określonych powyżej w części 'Istotne techniki marketingowe';
            W ramach Serwisu stosowane są dwa zasadnicze rodzaje plików cookies: „sesyjne” (session cookies) oraz „stałe” (persistent cookies). Cookies „sesyjne” są plikami tymczasowymi, które przechowywane są w urządzeniu końcowym Użytkownika do czasu wylogowania, opuszczenia strony internetowej lub wyłączenia oprogramowania (przeglądarki internetowej). „Stałe” pliki cookies przechowywane są w urządzeniu końcowym Użytkownika przez czas określony w parametrach plików cookies lub do czasu ich usunięcia przez Użytkownika.
            Oprogramowanie do przeglądania stron internetowych (przeglądarka internetowa) zazwyczaj domyślnie dopuszcza przechowywanie plików cookies w urządzeniu końcowym Użytkownika. Użytkownicy Serwisu mogą dokonać zmiany ustawień w tym zakresie. Przeglądarka internetowa umożliwia usunięcie plików cookies. Możliwe jest także automatyczne blokowanie plików cookies Szczegółowe informacje na ten temat zawiera pomoc lub dokumentacja przeglądarki internetowej.
            Ograniczenia stosowania plików cookies mogą wpłynąć na niektóre funkcjonalności dostępne na stronach internetowych Serwisu.
            Pliki cookies zamieszczane w urządzeniu końcowym Użytkownika Serwisu wykorzystywane mogą być również przez współpracujące z operatorem Serwisu podmioty, w szczególności dotyczy to firm: Google (Google Inc. z siedzibą w USA), Facebook (Facebook Inc. z siedzibą w USA), Twitter (Twitter Inc. z siedzibą w USA)."); ?>
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