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
    <link rel="icon" type="image/ico" href="/sklep/images/ui/logo-small.svg">
    <link rel="stylesheet" href="/sklep/css/main.css">
    <script src="/sklep/js/jquery-3.6.1.min.js"></script>
</head>

<body>
    <?php 
        require_once __DIR__.'\..\page-components\header.html';
        require_once __DIR__.'\..\page-components\nav.php'; 
    ?>
    
    <main>
        <h1>Regulamin sklepu</h1>
        <p>
            <?php echo nl2br("
            <h3>Witamy w Kosmetykowo!</h3>
            Niniejszy regulamin określa zasady korzystania ze Strony internetowej Kosmetykowo, dostępnej pod adresem www.kosmetykowo.pl.

            Użytkownik wchodząc na Stronę internetową, akceptuje niniejsze warunki. W przypadku braku akceptacji niniejszych warunków Użytkownik powinien opuścić Stronę Kosmetykowo.

            <h3>1. Pliki cookie</h3>
            Na tej Stronie internetowej wykorzystujemy pliki cookie, aby spersonalizować doświadczenia online naszych odbiorców. Wchodząc na Stronę Kosmetykowo, wyrażasz zgodę na używanie wymaganych plików cookie.

            Plik cookie to plik tekstowy, który jest umieszczany przez serwer strony internetowej na dysku twardym komputera Użytkownika. Pliki cookie nie mogą być wykorzystywane do uruchamiania programów lub przenoszenia wirusów na komputer Użytkownika. Pliki cookie są ściśle przypisane do danego użytkownika i mogą być odczytane tylko przez serwer internetowy w domenie, która wygenerowała plik cookie.

            Pliki cookie mogą być wykorzystywane do zbierania, przechowywania i śledzenia informacji w celach statystycznych lub marketingowych związanych z prowadzeniem naszej Strony internetowej. Użytkownik ma prawo zaakceptować lub odmówić zaakceptowania opcjonalnych plików cookie. Niektóre pliki cookie są wymagane i niezbędne do prawidłowego funkcjonowania Strony internetowej. Takie pliki cookie nie wymagają zgody, ponieważ są aktywne przez cały czas. Pamiętaj , że akceptując wymagane pliki cookie, akceptujesz również pliki cookie stron trzecich, które mogą być wykorzystywane przez inne podmioty podczas korzystania z usług świadczonych przez te podmioty.

            <h3>2. Licencja</h3>
            O ile nie stwierdzono inaczej, firma Kosmetykowo lub jej licencjodawcy są właścicielami praw własności intelektualnej wszystkich materiałów zamieszczonych na Stronie Kosmetykowo. Wszelkie prawa własności intelektualnej zostały zastrzeżone. Użytkownicy mogą uzyskać dostęp materiałów dostępnych na Stronie Kosmetykowo na własny użytek, z zastrzeżeniem ograniczeń określonych w niniejszym regulaminie.

            <h3>3. Zabrania się:</h3>
            Kopiowania lub ponownego publikowania materiałów umieszczonych na Stronie Kosmetykowo
            Sprzedaży, wypożyczania lub udzielania sublicencji na materiały umieszczone na Stronie Kosmetykowo
            Odtwarzania, powielania lub kopiowania materiałów zamieszczonych na Stronie Kosmetykowo
            Ponownego rozpowszechniania treści zamieszczonych na Stronie Kosmetykowo
            Niniejsza umowa zaczyna obowiązywać w dniu jej sporządzenia.

            Użytkownicy mają możliwość zamieszczania i wymiany opinii oraz informacji w niektórych częściach niniejszej Strony internetowej. Kosmetykowo} nie filtruje, nie edytuje, nie publikuje ani nie sprawdza komentarzy przed ich umieszczeniem na Stronie. Komentarze nie odzwierciedlają poglądów i opinii Kosmetykowo, jej przedstawicieli ani podmiotów stowarzyszonych. Zamieszczone komentarze odzwierciedlają poglądy i opinie osoby, która je zamieściła. W zakresie przewidzianym przez obowiązujące prawo Kosmetykowo nie odpowiada za komentarze ani nie ponosi odpowiedzialności za jakiekolwiek zobowiązania, szkody lub wydatki spowodowane lub poniesione w wyniku wykorzystania, zamieszczenia lub pojawienia się komentarzy na niniejszej Stronie.

            Kosmetykowo zastrzega sobie prawo do monitorowania wszystkich komentarzy i usuwania tych, które można uznać za nieodpowiednie, obraźliwe lub naruszające niniejsze warunki.

            <h3>4. Użytkownik zapewnia i oświadcza, że:</h3>
            Jest uprawniony do zamieszczania Komentarzy na naszej Stronie internetowej i posiada wszelkie niezbędne licencje i zgody, aby to robić;
            Komentarze nie naruszają praw własności intelektualnej, w tym między innymi praw autorskich, patentów lub znaków towarowych stron trzecich;
            Komentarze nie zawierają treści o charakterze oszczerczym, zniesławiającym, obraźliwym, nieprzyzwoitym lub w inny sposób niezgodnym z prawem, stanowiącym naruszenie prywatności.
            Komentarze nie będą wykorzystywane do pozyskiwania lub promowania działalności biznesowej lub zwyczajów, ani do prezentowania działań komercyjnych lub niezgodnych z prawem.
            Niniejszym Użytkownik udziela Kosmetykowo niewyłącznej licencji na wykorzystywanie, powielanie, edytowanie i upoważnianie innych osób do wykorzystywania, powielania i edytowania jego komentarzy w dowolnej formie i we wszystkich formatach lub mediach.

            <h3>5. Zamieszczanie odnośników do naszych treści</h3>
            Następujące podmioty mogą umieszczać odnośniki do naszych treści bez uprzedniej pisemnej zgody:

            Organy rządowe;
            Wyszukiwarki internetowe;
            Organizacje prasowe;
            Podmioty zajmujące się rozpowszechnianiem katalogów online mogą zamieszczać linki do naszej Strony w taki sam sposób, w jaki zamieszczają hiperłącza do stron internetowych innych wymienionych podmiotów; oraz
            Akredytowane przez system działalności, z wyjątkiem organizacji non-profit, punktów handlowych dla organizacji charytatywnych oraz grup zbierających fundusze na cele charytatywne, które nie mogą zamieszczać hiperłączy do naszej Strony internetowej.
            Organizacje te mogą zamieszczać odnośniki do naszej strony głównej, publikacji lub innych materiałów zamieszczonych na Stronie pod warunkiem, że odnośnik ten (a) nie wprowadza w błąd; (b) nie sugeruje, że jest sponsorowany, promowany lub uznany przez stronę linkującą oraz jej produkty i/lub usługi, jeśli nie jest to zgodne z prawdą ; oraz (c) pasuje do kontekstu strony linkującej.

            <h3>6. Możliwość rozważenia i zatwierdzenia innych próśb o link od następujących typów organizacji:</h3>
            powszechnie znanych źródeł informacji dla konsumentów lub podmiotów gospodarczych;
            działalności internetowych typu dot-com;
            stowarzyszeń lub innych podmiotów reprezentujących organizacje charytatywne;
            dystrybutorów katalogów internetowych;
            portali internetowych;
            firm księgowych, prawniczych i konsultingowych; oraz
            instytucji edukacyjnych i stowarzyszeń handlowych.
            Zaakceptujemy prośby o link od tych podmiotów, jeśli uznamy, że: (a) link nie będzie nas stawiał w niekorzystnym świetle względem nas samych lub naszych akredytowanych działalności; (b) nie odnotowano u nas żadnych negatywnych zapisów związanych z daną organizacją; (c) korzyść dla nas wynikająca z widoczności hiperłącza rekompensuje brak nazwy Kosmetykowo; oraz (d) link występuje w kontekście informacji ogólnych zasobów.

            Podmioty te mogą zamieszczać linki do naszej strony głównej pod warunkiem, że link ten (a) nie wprowadza w błąd; (b) fałszywie nie sugeruje sponsorowania, promowania lub zaakceptowania witryny linkującej i jej produktów lub usług; oraz (c) wpisuje się w kontekst witryny linkującej.

            Jeśli należysz do organizacji wymienionych w punkcie 2 powyżej i jesteś zainteresowany umieszczeniem linku do naszej Strony internetowej, zgłoś nam to wysyłając e-mail na adres Kosmetykowo. W e-mailu należy podać swoje imię i nazwisko, nazwę organizacji / podmiotu, informacje kontaktowe oraz adres URL swojej witryny, listę adresów URL, z których zamierzasz linkować do naszej Strony, a także listę adresów URL naszej witryny, do których chcesz linkować. Nasz czas odpowiedzi wynosi od 2 do 3 tygodni.

            <h3>7. Zatwierdzone podmioty mogą zamieszczać odnośniki do naszej Strony w następujący sposób:</h3>
            Używając naszej nazwy (firmy); lub
            Poprzez zastosowanie ujednoliconego identyfikatora zasobów, do którego prowadzi odnośnik; lub
            Stosowanie innych opisów naszej Strony internetowej, do której kieruje link, uzasadnionych z punktu widzenia kontekstu i formatu treści strony linkującej.
            Nie wyrażamy zgody na wykorzystanie logo lub innych elementów graficznych Kosmetykowo w celu umieszczenia linku bez umowy licencyjnej na wykorzystanie znaku towarowego.

            <h3>8. Odpowiedzialność za treść</h3>
            Nie ponosimy odpowiedzialności za jakiekolwiek treści, które pojawiają się na innych stronach internetowych. Zobowiązujesz się do zapewnienia nam ochrony przed wszelkimi roszczeniami, które zostaną postawione wobec Twojej Strony. Link(i) nie powinny być umieszczane na Stronie, która może być postrzegana jako oszczercza, nieprzyzwoita lub niezgodna z prawem, lub która w inny sposób łamie, lub zachęca do łamania, prawa osób trzecich.

            <h3>9. Zastrzeżenia praw</h3>
            Zastrzegamy sobie prawo do zażądania usunięcia wszystkich lub wybranych linków kierujących do naszej Strony. Podmioty linkujące zobowiązują się do natychmiastowego usunięcia wszystkich linków prowadzących do naszej Strony w przypadku otrzymania takiego żądania z naszej strony. Zastrzegamy sobie również prawo do zmiany niniejszych warunków i zasad linkowania w dowolnym momencie. Umieszczanie linków do naszej Strony oznacza akceptację i zobowiązanie do przestrzegania niniejszych zasad i warunków.

            Usuwanie linków z naszej Strony
            Jeśli zauważysz na naszej Stronie link, który z jakichkolwiek powodów jest obraźliwy, skontaktuj się z nami i poinformuj nas o tym w dowolnym momencie. Rozpatrzymy prośbę o usunięcie linku. Nie zobowiązujemy się jednak do usunięcia takiego linku, ani do udzielenia bezpośredniej odpowiedzi osobie zgłaszającej.

            Nie gwarantujemy, że informacje zawarte na tej stronie są poprawne. Nie zapewniamy ich kompletności ani dokładności, ani nie zobowiązujemy się do utrzymania dostępności strony lub aktualizacji materiałów na niej zawartych.

            <h3>10. Wyłączenie odpowiedzialności</h3>
            W maksymalnym zakresie dozwolonym przez obowiązujące prawo, nie udzielamy żadnych poręczeń, gwarancji i innych zobowiązań względem naszej strony internetowej i sposobu jej wykorzystywania. Żadne z postanowień niniejszej klauzuli wyłączenia odpowiedzialności nie będzie:

            ograniczać lub wyłączać naszej lub Twojej odpowiedzialności za śmierć lub odniesione obrażenia ciała
            ograniczać lub wyłączać naszej lub Twojej odpowiedzialność za oszustwa lub świadome wprowadzanie w błąd;
            ograniczać odpowiedzialności naszej lub Twojej w jakikolwiek sposób, który nie jest zgodny z obowiązującym prawem; lub
            wyłączać odpowiedzialności naszej lub Twojej, która nie może zostać wyłączona na mocy obowiązującego prawa.
            Ograniczenia i wyłączenia odpowiedzialności zawarte w tym ustępie oraz w innych miejscach tego wyłączenia odpowiedzialności: (a) nie naruszają postanowień poprzedniego ustępu; oraz (b) regulują wszystkie zobowiązania wynikające z tego wyłączenia odpowiedzialności, w tym zobowiązania wynikające z umowy, z czynu niedozwolonego oraz z tytułu naruszenia obowiązków ustawowych.

            Pod warunkiem, że strona internetowa oraz informacje i usługi na niej zawarte są udostępniane nieodpłatnie, nie ponosimy odpowiedzialności za powstanie jakichkolwiek strat lub szkód o dowolnym charakterze."); ?>
        </p>
    </main>

    <?php 
        require_once __DIR__.'\..\page-components\newsletter.html';
        require_once __DIR__.'\..\page-components\social-media.html'; 
        require_once __DIR__.'\..\page-components\footer.html';
        require_once __DIR__.'\..\page-components\extras.html';
    ?>

    <script src="/sklep/js/misc.js"></script>
    <script src="/sklep/js/scrollToTop.js"></script>
    <script src="/sklep/js/menuHandler.js"></script>
    <script src="/sklep/js/slideshowGallery.js"></script>

    <script src="/sklep/js/cartPreview.js"></script>
    <script src="/sklep/js/addToCart.js"></script>
    <script src="/sklep/js/accountPreview.js"></script>
</body>
</html>

<?php
    $connection->close();
?>