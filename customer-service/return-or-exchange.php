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
    <title>Zwrot i wymiana towaru | Drogeria internetowa Kosmetykowo.pl</title>
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
        <h1>Zwrot i wymiana towaru</h1>
        <p>
            <?php echo nl2br("
            Każdy klient ma prawo zwrotu lub wymiany produktów kupionych w sklepie internetowym Kosmetykowo.

            Poinformuj obsługę sklepu o zamiarze zwrócenia zakupionego towaru

            Warunkiem koniecznym uznania zwrotu jest poinformowanie o tym fakcie obsługi sklepu internetowego w terminie do 14 dni od daty otrzymania przesyłki.

            Możesz skontaktować się z nami na kilka sposobów:

            - Kontakt telefoniczny
            - Wypełnienie i wysłanie formularza kontaktowego
            - Wysyłka emaila na adres: zwrot@kosmetykowo.pl

            Pamiętaj, aby zwrócić towar, należy przedstawić nam jego dowód zakupu (np. fakturę VAT, potwierdzenie zamówienia z numerem lub paragon) i przekazać nam informację o jego numerze.

            O prawie do zwrotu zakupionego towaru przeczytasz w naszym regulaminie:

            1. Mają Państwo prawo odstąpić od niniejszej umowy w terminie 14 dni bez podania jakiejkolwiek przyczyny.

            2. Zwracane produkty należy odesłać maksymalnie do 16 dni od momentu zgłoszenia odstąpienia od umowy, postępując zgodnie z krokami przedstawionymi w dalszej części regulaminu.

            3. Produkty podlegające zwrotowi muszą być kompletnie oraz nie mogą nosić śladów użytkowania ani uszkodzeń mechanicznych pochodzenia zewnętrznego.

            4. Termin do odstąpienia od umowy wygasa po upływie 14 dni od dnia, w którym weszli Państwo w posiadanie rzeczy lub w którym osoba trzecia inna niż przewoźnik i wskazana przez Państwa weszła w posiadanie rzeczy. 

            5. Mogą Państwo skorzystać ze wzoru formularza odstąpienia od umowy, jednak nie jest to obowiązkowe. 

            6. Aby zachować termin do odstąpienia od umowy, wystarczy, aby wysłali Państwo informację dotyczącą wykonania przysługującego Państwu prawa odstąpienia od umowy przed upływem terminu do odstąpienia od umowy.

            7. Skutki odstąpienia od umowy. W przypadku odstąpienia od niniejszej umowy zwracamy Państwu wszystkie otrzymane od Państwa płatności, w tym koszty dostarczenia rzeczy (z wyjątkiem dodatkowych kosztów wynikających z wybranego przez Państwa sposobu dostarczenia innego niż najtańszy zwykły sposób dostarczenia oferowany przez nas) niezwłocznie, a w każdym przypadku nie później niż 14 dni od dnia, w którym otrzymaliśmy od Państwa zwracany towar, w stanie kompletnym i bez śladów użytkowania. Zwrotu płatności dokonamy przy użyciu takich samych sposobów płatności, jakie zostały przez Państwa użyte w pierwotnej transakcji, chyba że wyraźnie zgodziliście się Państwo na inne rozwiązanie w każdym przypadku nie poniosą Państwo żadnych opłat w związku z tym zwrotem.

            8. Koszty związane z dostarczeniem do nas zwracanego do nas towaru ponosi zawsze Konsument i nie są przez nas zwracane.

            9. Odstąpienie od umowy w przypadku skorzystania z promocji 'darmowa dostawa', oznacza rezygnację z uczestnictwa w promocji. W związku z tym konsumentowi, który odstąpił od umowy sprzedaży, zostaną zwrócone wszystkie pieniądze otrzymane w związku z realizacją zamówienia pomniejszone o należne koszty dostawy.

            10. Powyższa możliwość odstąpienia od umowy dotyczy tylko Konsumentów (osób fizycznych dokonujących czynności prawnej niezwiązanej bezpośrednio z ich działalnością gospodarczą lub zawodową), nie dotyczy natomiast firm.

            11. Prawo odstąpienia od umowy zawartej poza lokalem przedsiębiorstwa lub na odległość nie przysługuje konsumentowi, kiedy przedmiotem świadczenia jest rzecz nieprefabrykowana, wyprodukowana według specyfikacji konsumenta lub służąca zaspokojeniu jego zindywidualizowanych potrzeb."); ?>
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