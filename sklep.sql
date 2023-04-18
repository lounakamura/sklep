-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Kwi 2023, 20:08
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sklep`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria`
--

CREATE TABLE `kategoria` (
  `kategoria_id` int(11) NOT NULL,
  `kategoria` varchar(25) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `kategoria`
--

INSERT INTO `kategoria` (`kategoria_id`, `kategoria`) VALUES
(1, 'Włosy'),
(2, 'Twarz'),
(3, 'Makijaż'),
(4, 'Ciało');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria_1`
--

CREATE TABLE `kategoria_1` (
  `kategoria_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `kategoria` varchar(32) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `kategoria_1`
--

INSERT INTO `kategoria_1` (`kategoria_id`, `parent_id`, `kategoria`) VALUES
(1, 1, 'Pielęgnacja'),
(2, 1, 'Stylizacja'),
(3, 1, 'Koloryzacja'),
(4, 1, 'Akcesoria do włosów'),
(5, 2, 'Oczyszczanie i demakijaż'),
(6, 2, 'Pielęgnacja twarzy'),
(7, 2, 'Pielęgnacja ust'),
(8, 3, 'Twarz'),
(9, 3, 'Oczy'),
(10, 3, 'Brwi'),
(11, 3, 'Usta'),
(12, 3, 'Paznokcie'),
(13, 3, 'Akcesoria do makijażu'),
(14, 4, 'Kąpiel'),
(15, 4, 'Pielęgnacja ciała'),
(16, 4, 'Pielęgnacja dłoni'),
(17, 4, 'Pielęgnacja stóp'),
(18, 4, 'Opalanie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria_2`
--

CREATE TABLE `kategoria_2` (
  `kategoria_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `kategoria` varchar(32) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `kategoria_2`
--

INSERT INTO `kategoria_2` (`kategoria_id`, `parent_id`, `kategoria`) VALUES
(1, 1, 'Szampony'),
(2, 1, 'Szampony suche'),
(3, 1, 'Odżywki'),
(4, 1, 'Maski'),
(5, 1, 'Olejki i serum'),
(6, 1, 'Peelingi'),
(7, 1, 'Kuracje i wcierki'),
(8, 2, 'Lakiery'),
(9, 2, 'Pianki'),
(10, 2, 'Pudry'),
(11, 2, 'Kremy'),
(12, 2, 'Żele, pasty i gumy'),
(13, 2, 'Mgiełki i spraye'),
(14, 3, 'Farby i tonery'),
(15, 3, 'Rozjaśniacze'),
(16, 3, 'Płukanki'),
(17, 3, 'Dekoloryzatory'),
(18, 3, 'Henna'),
(19, 3, 'Akcesoria do koloryzacji'),
(20, 4, 'Szczotki'),
(21, 4, 'Grzebienie'),
(22, 4, 'Klamry'),
(23, 4, 'Gumki'),
(24, 4, 'Turbany'),
(25, 4, 'Opaski'),
(26, 4, 'Wałki do włosów'),
(27, 4, 'Czepki'),
(28, 5, 'Żele'),
(29, 5, 'Pianki'),
(30, 5, 'Płyny micelarne'),
(31, 5, 'Mleczka'),
(32, 5, 'Olejki myjące'),
(33, 5, 'Peelingi'),
(34, 5, 'Akcesoria do oczyszczania twarzy'),
(35, 6, 'Kremy do twarzy'),
(36, 6, 'Serum'),
(37, 6, 'Toniki'),
(38, 6, 'Olejki'),
(39, 6, 'Kremy pod oczy'),
(40, 6, 'Maseczki'),
(41, 7, 'Balsamy'),
(42, 7, 'Sztyfty'),
(43, 7, 'Olejki'),
(44, 7, 'Peelingi'),
(45, 7, 'Maski'),
(46, 8, 'Podkłady'),
(47, 8, 'Korektory'),
(48, 8, 'Pudry'),
(49, 8, 'Bronzery'),
(50, 8, 'Rozświetlacze'),
(51, 8, 'Róże'),
(52, 8, 'Bazy pod makijaż'),
(53, 8, 'Utrwalacze'),
(54, 8, 'Palety do konturowania'),
(55, 9, 'Cienie do powiek'),
(56, 9, 'Palety cieni'),
(57, 9, 'Bazy pod cienie'),
(58, 9, 'Tusze do rzęs'),
(59, 9, 'Eyelinery'),
(60, 9, 'Kredki do oczu'),
(61, 9, 'Sztuczne rzęsy'),
(62, 10, 'Kredki'),
(63, 10, 'Tusze'),
(64, 10, 'Pomady i woski'),
(65, 10, 'Cienie i pudry'),
(66, 10, 'Henna'),
(67, 10, 'Akcesoria do brwi'),
(68, 11, 'Szminki i pomadki w płynie'),
(69, 11, 'Szminki i pomadki w sztyfcie'),
(70, 11, 'Konturówki'),
(71, 11, 'Błyszczyki'),
(72, 12, 'Lakiery'),
(73, 12, 'Topy i bazy'),
(74, 12, 'Ozdoby do paznokci'),
(75, 12, 'Sztuczne paznokcie i kleje'),
(76, 12, 'Zmywacze do paznokci'),
(77, 12, 'Odżywki do paznokci'),
(78, 12, 'Akcesoria do paznokci'),
(79, 13, 'Pędzle'),
(80, 13, 'Gąbki i aplikatory'),
(81, 13, 'Pęsety'),
(82, 13, 'Zalotki'),
(83, 13, 'Kosmetyczki'),
(84, 14, 'Żele do mycia'),
(85, 14, 'Mydła'),
(86, 14, 'Pianki i musy'),
(87, 14, 'Olejki do kąpieli'),
(88, 14, 'Peelingi do ciała'),
(89, 14, 'Sole i kule do kąpieli'),
(90, 14, 'Akcesoria'),
(91, 15, 'Kremy, balsamy'),
(92, 15, 'Olejki'),
(93, 15, 'Mgiełki'),
(94, 15, 'Masła'),
(95, 15, 'Produkty brązujące, samoopalacze'),
(96, 16, 'Kremy do rąk'),
(97, 16, 'Serum'),
(98, 16, 'Maski'),
(99, 16, 'Peelingi'),
(100, 17, 'Kremy'),
(101, 17, 'Serum'),
(102, 17, 'Maski'),
(103, 17, 'Peelingi'),
(104, 18, 'Ochrona przeciwsłoneczna'),
(105, 18, 'Produkty po opalaniu'),
(106, 5, 'Toniki'),
(109, 1, 'Odżywki myjące');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
  `koszyk_id` int(11) NOT NULL,
  `produkt_id` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `sesja_id` int(11) NOT NULL,
  `uzytkownik_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `koszyk`
--

INSERT INTO `koszyk` (`koszyk_id`, `produkt_id`, `ilosc`, `sesja_id`, `uzytkownik_id`) VALUES
(25, 153, 1, 17, 2),
(26, 151, 1, 17, 2),
(27, 152, 1, 17, 2),
(28, 150, 1, 17, 2),
(29, 9, 1, 17, 2),
(30, 4, 1, 17, 2),
(31, 31, 1, 17, 2),
(32, 149, 1, 17, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kraj`
--

CREATE TABLE `kraj` (
  `kraj_id` int(11) NOT NULL,
  `nazwa` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `kraj`
--

INSERT INTO `kraj` (`kraj_id`, `nazwa`) VALUES
(1, 'Polska'),
(2, 'Argentyna'),
(3, 'Austria'),
(4, 'Belgia'),
(5, 'Białoruś'),
(6, 'Bułgaria'),
(7, 'Chorwacja'),
(8, 'Dania'),
(9, 'Estonia'),
(10, 'Finlandia'),
(11, 'Francja'),
(12, 'Grecja'),
(13, 'Hiszpania'),
(14, 'Holandia'),
(15, 'Irlandia'),
(16, 'Islandia'),
(17, 'Kanada'),
(18, 'Liechtenstein'),
(19, 'Litwa'),
(20, 'Luksemburg'),
(21, 'Łotwa'),
(22, 'Niemcy'),
(23, 'Norwegia'),
(24, 'Nowa Zelandia'),
(25, 'Portugalia'),
(26, 'Rosja'),
(27, 'Słowacja'),
(28, 'Stany Zjednoczone'),
(29, 'Szwajcaria'),
(30, 'Szwecja'),
(31, 'Ukraina'),
(32, 'Węgry'),
(33, 'Wielka Brytania'),
(34, 'Włochy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `marka`
--

CREATE TABLE `marka` (
  `marka_id` int(11) NOT NULL,
  `marka` varchar(32) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `marka`
--

INSERT INTO `marka` (`marka_id`, `marka`) VALUES
(1, 'Makeup Revolution'),
(2, 'Anwen'),
(3, 'NYX Professional Makeup'),
(4, 'Resibo'),
(5, 'theBalm'),
(6, 'Yope'),
(7, 'ONLYBIO'),
(8, 'HairBoom'),
(9, 'Fluff'),
(10, 'FaceBoom'),
(11, 'MEXMO'),
(12, 'Hairy Tale'),
(14, 'Sattva');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `metoda_dostawy`
--

CREATE TABLE `metoda_dostawy` (
  `metoda_dostawy_id` int(11) NOT NULL,
  `rodzaj` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `cena` decimal(5,2) NOT NULL,
  `oczekiwanie_min` tinyint(4) NOT NULL,
  `oczekiwanie_max` tinyint(4) NOT NULL,
  `zdjecie_sciezka` varchar(128) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `metoda_dostawy`
--

INSERT INTO `metoda_dostawy` (`metoda_dostawy_id`, `rodzaj`, `cena`, `oczekiwanie_min`, `oczekiwanie_max`, `zdjecie_sciezka`) VALUES
(1, 'InPost Paczkomaty 24/7', '9.90', 1, 2, '/sklep/images/shipping/inpost.png'),
(2, 'Kurier Inpost', '11.90', 1, 2, '/sklep/images/shipping/inpost.png'),
(3, 'Kurier DPD', '12.90', 1, 2, '/sklep/images/shipping/dpd.png'),
(4, 'Pocztex', '9.90', 2, 3, '/sklep/images/shipping/pocztex.jpg'),
(5, 'Pocztex odbiór w placówce lub na stacji Orlen', '7.90', 2, 3, '/sklep/images/shipping/pocztex.jpg'),
(6, 'Kurier FedEx', '13.90', 1, 2, '/sklep/images/shipping/fedex.png'),
(7, 'Kurier DHL', '12.90', 1, 2, '/sklep/images/shipping/dhl.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `metoda_platnosci`
--

CREATE TABLE `metoda_platnosci` (
  `metoda_platnosci_id` int(11) NOT NULL,
  `rodzaj` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `cena` float DEFAULT NULL,
  `zdjecie_sciezka` varchar(128) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `metoda_platnosci`
--

INSERT INTO `metoda_platnosci` (`metoda_platnosci_id`, `rodzaj`, `cena`, `zdjecie_sciezka`) VALUES
(1, 'BLIK', NULL, '/sklep/images/payment/blik.png'),
(2, 'PayU', NULL, '/sklep/images/payment/payu.png'),
(3, 'Płatność za pobraniem', 5, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkt`
--

CREATE TABLE `produkt` (
  `produkt_id` int(11) NOT NULL,
  `kategoria_id` int(11) NOT NULL,
  `nazwa` varchar(128) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `opis` text COLLATE utf8mb4_polish_ci NOT NULL,
  `marka_id` int(11) NOT NULL,
  `ilosc` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `produkt`
--

INSERT INTO `produkt` (`produkt_id`, `kategoria_id`, `nazwa`, `cena`, `opis`, `marka_id`, `ilosc`) VALUES
(1, 56, 'Makeup Revolution Forever Flawless Decadent Paleta Cieni', '49.99', 'Makeup Revolution Forever Flawless Decadent Paleta Cieni\n\nReaktywacja palet z serii Flawless?\n\nMarka Makeup Revolution nie zwalnia tempa!\n\nForever Flawless to kolejne nowości, które podbiją Wasze serca!\n\nNiesamowita paleta cieni zamknięta w wyjątkowym opakowaniu z lusterkiem.\n\nZestaw zawiera 18 cieni do powiek o wykończeniu matowym i błyszczącym.\n\nCienie posiadają wysoki stopień pigmentacji, są długotrwałe i wyjątkowo łatwo się blendują.\n\nPaleta pozwala na wykonanie każdego makijażu - zarówno dziennego, jak i wieczorowego.\n\nWersja: Forever Flawless Decadent - zawiera ciepłe odcienie brązów i róży', 1, 40),
(3, 56, 'Makeup Revolution Forever Flawless Chilled with Cannabis Sativa Paleta Cieni', '49.99', 'Makeup Revolution Forever Flawless Chilled with Cannabis Sativa Paleta Cieni\r\n\r\nReaktywacja palet z serii Flawless?\r\n\r\nMarka Makeup Revolution nie zwalnia tempa!\r\n\r\nForever Flawless to kolejne nowości, które podbiją Wasze serca!\r\n\r\nProdukt pochodzi z serii Cannabis Sativa, której głównym składnikiem jest olej z nasion konopii indyjskich.\r\n\r\nOlej ten stanowi źródło intensywnego odżywienia oraz nawilżenia.\r\n\r\nNiesamowita paleta cieni zamknięta w wyjątkowym opakowaniu z lusterkiem.\r\n\r\nZestaw zawiera 18 cieni do powiek o wykończeniu matowym i błyszczącym.\r\n\r\nCienie posiadają wysoki stopień pigmentacji, są długotrwałe i wyjątkowo łatwo się blendują.\r\n\r\nPaleta pozwala na wykonanie wielu makijaży.\r\n\r\nWersja: Cannabis Sativa', 1, 0),
(4, 56, 'Makeup Revolution Forever Flawless Allure Paleta cieni', '49.99', 'Makeup Revolution Forever Flawless Allure Paleta cieni\r\n\r\nReaktywacja palet z serii Flawless?\r\n\r\nMarka Makeup Revolution nie zwalnia tempa!\r\n\r\nForever Flawless to kolejne nowości, które podbiją Wasze serca!\r\n\r\nPaleta dostępna jest w kilku wersjach – możesz odkryć swoją romantyczną stronę, zostać nieustraszoną bohaterką lub zdradzić ukrytą stronę osobowości. Którą opcję wybierzesz dzisiaj?\r\n\r\nNiesamowita paleta cieni zamknięta w wyjątkowym opakowaniu z lusterkiem.\r\n\r\nZestaw zawiera 18 cieni do powiek o wykończeniu matowym i błyszczącym.\r\n\r\nCienie posiadają wysoki stopień pigmentacji, są długotrwałe i wyjątkowo łatwo się blendują.\r\n\r\nPaleta pozwala na wykonanie wielu makijaży.\r\n\r\nWersja: Allure', 1, 10),
(7, 88, 'Body in Balance by ONLYBIO Peeling do ciała migdałowy', '19.99', 'Pamiętaj! Jesteś piękna, bo jesteś!\r\nMożesz mieć pewność, że dołożyliśmy wszelkich starań, aby peeling był nie tylko skuteczny, ale również bezpieczny – tak samo dla Ciebie, jak i środowiska. Jego formuła jest wegańska i zawiera 98% wyselekcjonowanych składników pochodzenia naturalnego. Tuba wykonana z bioplastiku, uzyskanego z trzciny cukrowej, jest wygodna podczas użytkowania i nadaje się do recyklingu.\r\n\r\nKiedy stosować?\r\nJak tylko poczujesz, że skóra jest szorstka i sucha – wszystko zależy od indywidualnych potrzeb.\r\n\r\nCo nawilża?\r\nZawarty w formule olejek ze słodkich migdałów uelastycznia skórę oraz przywróci jej gładkość i odpowiednie, głębokie nawilżenie.\r\n\r\nJak pachnie?\r\nRelaksujący i zmysłowy zapach migdałów wprowadzi Cię w błogi nastrój. Pokochasz jego orzechową słodycz!\r\n\r\nJak stosować?\r\nNałóż peeling na skórę i wykonaj delikatny masaż.\r\n\r\nPojemność: 200 ml', 7, 999),
(8, 88, 'Body in Balance by ONLYBIO Peeling do ciała malinowy', '19.99', 'Pamiętaj! Jesteś piękna, bo jesteś!\r\nMalinowy peeling do ciała OnlyBio działa łagodnie, a zarazem skutecznie. To zasługa starannie dobranych, wegańskich składników, które w 98% są pochodzenia naturalnego. Dlatego to świetny wybór, jeśli szukasz nowoczesnego produktu do świadomej pielęgnacji, bezpiecznego dla Ciebie, jak i środowiska. Zadbaliśmy o wysokie standardy zrównoważonej produkcji oraz nadające się do ponownego przetworzenia tuby z bioplastiku, uzyskiwanego z trzciny cukrowej.\r\n\r\nKiedy stosować?\r\nWszystko zależy od Twoich potrzeb! Użyj peelingu, kiedy poczujesz, że skóra jest sucha i szorstka.\r\n\r\nCo nawilża?\r\nZawarta w formule malina nordycka uelastycznia skórę oraz przywróci jej gładkość i odpowiednie, głębokie nawilżenie.\r\n\r\nJak pachnie?\r\nSłodka maliną! Jej zapach jest zmysłowy i niezwykle czarujący.\r\n\r\nJak stosować?\r\nNałóż produkt na ciało i delikatnie go wmasuj. Następnie spłucz.\r\n\r\nPojemność: 200 ml', 7, 999),
(9, 34, 'FaceBoom Nawilżająco-oczyszczające chusteczki do demakijażu', '17.99', 'KIM JESTEŚMY?\r\n\r\nJesteśmy nawilżająco-oczyszczającymi chusteczki do demakijażu na bazie wegańskiej receptury, która skutecznie i szybko usuwa nawet wodoodporny makijaż twarzy, oczu i ust. Nasza formuła zawierająca wodę termalną działa oczyszczająco i odświeżająco na skórę, jednocześnie aktywnie wspierając nawilżenie naskórka. W naszej recepturze znajdziesz składniki, które idealnie nadają się dla skóry suchej i normalnej. Jesteśmy delikatne i nie wymagamy mocnego pocierania podczas demakijażu.\r\n\r\n\r\nODKRYJ MOJE WNĘTRZE\r\n\r\nTrehaloza - pomaga zachować prawidłowe nawilżenie oraz posiada właściwości antyoksydacyjne\r\n\r\nHydrolat z kwiatów pomarańczy - działa łagodząco, polecany jest dla cery delikatnej, podrażnionej i wrażliwej.\r\n\r\nEkstrakt z kiwi - przywraca skórze blask i promienny wygląd oraz wspomaga nawilżenie i odżywienie.\r\n\r\nDBAM O ŚRODOWISKO\r\n\r\nZostałyśmy wykonane z biodegradowalnej włókniny przyjaznej środowisku.\r\n\r\nNasza folia nadaje się do recyklingu.\r\n\r\nPo zużyciu, wyrzuć na do odpowiedniego pojemnika.\r\n\r\nVegan friendly > Posiadamy przyjazną środowisku i skórze wegańską formułę.\r\n\r\nWspieramy finansowo budowę i funkcjonowanie systemu odzysku i recyklingu odpadów opakowaniowych.\r\n\r\nZachowujemy normę środowiskową ISO 14001 i ISO 9001.\r\n\r\nPETA! - Zostałyśmy zaaprobowane przez międzynarodową organizacji PETA.', 10, 0),
(10, 1, 'HairBoom Rice Rehab Ultralekki ryżowy szampon w piance', '24.99', 'Pozwól, że się przedstawię\r\nJestem naturalnym (94% składników pochodzenia naturalnego wg normy ISO 16128), ultralekkim ryżowym szamponem w piance, stworzonym do pielęgnacji włosów suchych i zniszczonych o każdej porowatości, które potrzebują oczyszczenia, zmiękczenia i wygładzenia. Posiadam łagodną formułę i cudownie pachnę, dlatego wiem, że zaprzyjaźnimy się na dłużej.\r\n\r\nJak mnie stosować?\r\nSzampon ryżowy wmasuj w wilgotne włosy i skórę głowy. Następnie spłucz i powtórz mycie.\r\n\r\nCo mogę ci zaoferować?\r\nBędę się troszczył i dbał o Twoje włosy. Wiem, że czasami bywają niesforne, ale dzięki mnie staną się lekkie i pełne objętości. Sprawię, że będą gładkie i wyjątkowo miękkie.\r\n\r\nOdkryj moje wnętrze\r\n\r\nFermentowana woda ryżowa \r\nnawilża, wygładza strukturę i wydobywa naturalne piękno włosów.\r\n\r\nArginina\r\npoprawia elastyczność, wytrzymałość na uszkodzenia i przywraca zdrowy wygląd włosom.\r\n\r\nPeptydy ryżowe \r\nzauważalnie wzmacniają i regenerują włosy.   \r\n\r\nZmysłowy zapach \r\nktóry pozostanie na włosach, to połączenie niezwykłego aromatu paczuli, świeżych malin, słodkiej śliwki i cedru.   \r\n\r\nDbam o środowisko\r\n\r\nBio etykieta\r\nMoja etykieta jest przyjazna środowisku, została przygotowana z BIO folii.\r\n\r\nWegańska formuła\r\nPosiadam przyjazną środowisku i skórze wegańską formułę.  \r\n\r\nWsparacie\r\nWspieram finansowo budowę i funkcjonowanie systemu odzysku i recyklingu odpadów opakowaniowych.   \r\n\r\nIso\r\nZachowuję normę środowiskową ISO 14001 i ISO 9001.   \r\n\r\nPraktyka produkcyjna\r\nZachowuję dobrą praktykę produkcyjną. \r\n\r\nCertyfikat peta\r\nJestem zaaprobowany przez organizację PETA.', 8, 999),
(11, 7, 'HairBoom Rice Rehab Wygładzająca ryżowa płukanka octowa', '19.99', 'Pozwól, że się przedstawię\r\nJestem naturalną (98% składników pochodzenia naturalnego wg normy ISO 16128), wygładzającą ryżową płukanką octową, stworzoną do pielęgnacji włosów suchych i zniszczonych o każdej porowatości, które potrzebują nabłyszczenia, wygładzenia i zmiękczenia. Posiadam odpowiednio niskie pH i cudownie pachnę, dlatego wiem, że zaprzyjaźnimy się na dłużej.\r\n\r\nJak mnie stosować?\r\nPrzed użyciem wstrząśnij. Umyj włosy jak zwykle, następnie jako ostatni etap pielęgnacji, nanieś mnie bezpośrednio na skórę głowy i mokre włosy. Wmasuj i po upływie 2 minut spłucz letnią wodą. Przy włosach niskoporowatych stosuj mnie raz w tygodniu, przy średnio i wysokoporowatych co drugie mycie.\r\n\r\nCo mogę ci zaoferować?\r\nBędę się troszczyła i dbała o Twoje włosy. Wiem, że czasami bywają niesforne, ale dzięki mnie staną się gładkie, lśniące, zyskają lekkość, objętość i długotrwałą świeżość. Domknę łuski włosa, ujednolicę jego strukturę i wydobędę blask.\r\n\r\nOdkryj moje wnętrze\r\n\r\nFermentowana woda ryżowa \r\nnawilża, wygładza strukturę i wydobywa naturalne piękno włosów.\r\n\r\nTrehaloza\r\nnadaje włosom miękkość, połysk i utrzymuje prawidłowe nawilżenie.  \r\n\r\nOcet jabłkowy  \r\nnabłyszcza włosy, redukuje puszenie i ogranicza przetłuszczanie.\r\n\r\nZmysłowy zapach \r\nktóry pozostanie na włosach, to połączenie niezwykłego aromatu paczuli, świeżych malin, słodkiej śliwki i cedru.\r\n\r\nDbam o środowisko\r\n\r\nBio etykieta\r\nMoja etykieta jest przyjazna środowisku, została przygotowana z BIO folii.\r\n\r\nWegańska formuła\r\nPosiadam przyjazną środowisku i skórze wegańską formułę.  \r\n\r\nWsparacie\r\nWspieram finansowo budowę i funkcjonowanie systemu odzysku i recyklingu odpadów opakowaniowych.   \r\n\r\nIso\r\nZachowuję normę środowiskową ISO 14001 i ISO 9001.   \r\n\r\nPraktyka produkcyjna\r\nZachowuję dobrą praktykę produkcyjną. \r\n\r\nCertyfikat peta\r\nJestem zaaprobowany przez organizację PETA.', 8, 999),
(12, 3, 'HairBoom Rice Rehab Kondycjonująca woda ryżowa w mgiełce', '24.99', 'Pozwól, że się przedstawię\r\nJestem naturalną (97% składników pochodzenia naturalnego wg normy ISO 16128), kondycjonującą wodą ryżową w mgiełce, stworzoną do pielęgnacji włosów suchych i zniszczonych o każdej porowatości, które potrzebują ochrony, wygładzenia i nawilżenia, bez efektu obciążenia. Posiadam odżywczą formułę anti-frizz i cudownie pachnę, dlatego wiem, że zaprzyjaźnimy się na dłużej.\r\n\r\nJak mnie stosować?\r\nPrzed użyciem wstrząśnij. Spryskaj mną umyte, wilgotne, osuszone ręcznikiem włosy. Pozostaw bez spłukiwania. Stosuj mnie zawsze, kiedy czujesz taką potrzebę. Nie rozpylaj w kierunku oczu.\r\n\r\nCo mogę ci zaoferować?\r\nBędę się troszczyła i dbała o Twoje włosy. Wiem, że czasami bywają niesforne, ale dzięki mnie staną się elastyczne, nawilżone, pełne objętości i blasku. Sprawię, że będą lekkie, cudownie gładkie, łatwe do rozczesania i przestaną się puszyć.\r\n\r\nOdkryj moje wnętrze\r\n\r\nFermentowana woda ryżowa \r\nnawilża, wygładza strukturę i wydobywa naturalne piękno włosów.\r\n\r\nTrehaloza\r\nnadaje włosom miękkość, połysk i utrzymuje prawidłowe nawilżenie.  \r\n\r\nPeptydy ryżowe \r\nzauważalnie wzmacniają i regenerują włosy.   \r\n\r\nZmysłowy zapach \r\nktóry pozostanie na włosach, to połączenie niezwykłego aromatu paczuli, świeżych malin, słodkiej śliwki i cedru.\r\n\r\nDbam o środowisko\r\n\r\nBio etykieta\r\nMoja etykieta jest przyjazna środowisku, została przygotowana z BIO folii.\r\n\r\nWegańska formuła\r\nPosiadam przyjazną środowisku i skórze wegańską formułę.  \r\n\r\nWsparacie\r\nWspieram finansowo budowę i funkcjonowanie systemu odzysku i recyklingu odpadów opakowaniowych.   \r\n\r\nIso\r\nZachowuję normę środowiskową ISO 14001 i ISO 9001.   \r\n\r\nPraktyka produkcyjna\r\nZachowuję dobrą praktykę produkcyjną. \r\n\r\nCertyfikat peta\r\nJestem zaaprobowany przez organizację PETA.\r\n', 8, 999),
(13, 4, 'HairBoom Rice Rehab 4 w 1 multifunkcyjna ryżowa maska', '24.99', 'Pozwól, że się przedstawię\r\nJestem naturalną (98% składników pochodzenia naturalnego wg normy ISO 16128), multifunkcyjną ryżową maską 4 w 1, stworzoną do pielęgnacji włosów suchych i zniszczonych o każdej porowatości, które potrzebują odżywienia, wzmocnienia i nawilżenia. Posiadam wielozadaniową formułę i cudownie pachnę, dlatego wiem, że zaprzyjaźnimy się na dłużej. Możesz mnie stosować na 4 sposoby, czy to nie cudowna wiadomość?\r\n\r\nJak mnie stosować?\r\n\r\n1. Jako ekspresowa odżywka (wysoka i średnia porowatość): nanieś mnie na umyte, wilgotne włosy. Pozostaw na 60 sekund, następnie spłucz chłodną wodą. Stosuj mnie po każdym myciu.\r\n\r\n2. Jako regenerująca maska (każda porowatość): nanieś mnie na umyte, wilgotne włosy. Pozostaw na 5 minut, następnie spłucz chłodną wodą. Stosuj mnie raz w tygodniu.\r\n\r\n3. Do emulgowania oleju (każda porowatość): po olejowaniu włosów spłucz je ciepłą wodą. Następnie nanieś mnie na włosy, wmasuj i pozostaw na 60 sekund, spłucz i umyj skórę głowy szamponem.\r\n\r\n4. Pielęgnacja O-M-O (wysoka i średnia porowatość): zwilż włosy i rozprowadź mnie na całej ich długości, pozostaw na 60 sekund. Następnie spłucz włosy i umyj szamponem. Nałóż mnie ponownie, wczesz we włosy i po 3 minutach spłucz. Stosuj mnie raz w tygodniu.\r\n\r\nCo mogę ci zaoferować?\r\nBędę się troszczyła i dbała o Twoje włosy. Wiem, że czasami bywają niesforne, ale dzięki mnie staną się mocniejsze, nawilżone, zauważalnie odżywione i zregenerowane. Sprawię, że będą gładkie, miękkie i łatwe do rozczesania.\r\n\r\nOdkryj moje wnętrze\r\n\r\nFermentowana woda ryżowa \r\nnawilża, wygładza strukturę i wydobywa naturalne piękno włosów.\r\n\r\nOlej z otrąb ryżowych \r\nzauważalnie odżywia, wzmacnia i pomaga utrzymać optymalne nawilżenie włosów.  \r\n\r\nEkstrakt z lnu   \r\nnadaje włosom jedwabistą miękkość, sprężystość i blask.\r\n\r\nZmysłowy zapach \r\nktóry pozostanie na włosach, to połączenie niezwykłego aromatu paczuli, świeżych malin, słodkiej śliwki i cedru.\r\n\r\nDbam o środowisko\r\n\r\nBio etykieta\r\nMoja etykieta jest przyjazna środowisku, została przygotowana z BIO folii.\r\n\r\nWegańska formuła\r\nPosiadam przyjazną środowisku i skórze wegańską formułę.  \r\n\r\nWsparacie\r\nWspieram finansowo budowę i funkcjonowanie systemu odzysku i recyklingu odpadów opakowaniowych.   \r\n\r\nIso\r\nZachowuję normę środowiskową ISO 14001 i ISO 9001.   \r\n\r\nPraktyka produkcyjna\r\nZachowuję dobrą praktykę produkcyjną. \r\n\r\nCertyfikat peta\r\nJestem zaaprobowany przez organizację PETA.\r\n', 8, 999),
(14, 5, 'HairBoom Rice Rehab Odżywczy olej z otrąb ryżowych do olejowania', '24.99', 'Pozwól, że się przedstawię\r\nJestem naturalnym (99% składników pochodzenia naturalnego wg normy ISO 16128), odżywczym olejem ryżowym, stworzonym do olejowania włosów suchych i zniszczonych o każdej porowatości, które potrzebują solidnej regeneracji, wzmocnienia, nabłyszczenia i wygładzenia. Posiadam bogatą formułę i cudownie pachnę, dlatego wiem, że zaprzyjaźnimy się na dłużej.\r\n\r\nJak mnie stosować?\r\nRozprowadź mnie na całej długości suchych lub wilgotnych włosów. Przy włosach niskoporowatych pozostaw mnie na 30 minut, przy średnio i wysokoporowatych na 60 minut. Następnie umyj włosy szamponem lub zastosuj do emulgowania maskę 4 w 1 Rice Rehab- postępuj zgodnie ze sposobem użycia na jej opakowaniu.\r\n\r\nCo mogę ci zaoferować?\r\nBędę się troszczył i dbał o Twoje włosy. Wiem, że czasami bywają niesforne, ale dzięki mnie staną się bardziej wytrzymałe i zauważalnie zdrowsze. Sprawię, że będą wyjątkowo gładkie, miękkie i pełne blasku.\r\n\r\nOdkryj moje wnętrze\r\n\r\nOlej z otrąb ryżowych \r\nzauważalnie odżywia, wzmacnia i pomaga utrzymać optymalne nawilżenie włosów.\r\n\r\nFermentowany olej arganowy \r\nwyraźnie kondycjonuje włosy, przywraca miękkość i dodaje blasku.\r\n\r\nEkstrakt z korzenia lukrecji\r\nnawilża, wygładza i poprawia elastyczność włosów. \r\n\r\nWitamina e  \r\nnadaje włosom jedwabistą gładkość i poprawia ich nawilżenie.\r\n\r\nZmysłowy zapach \r\nktóry pozostanie na włosach, to połączenie niezwykłego aromatu paczuli, świeżych malin, słodkiej śliwki i cedru.\r\n\r\nDbam o środowisko\r\n\r\nBio etykieta\r\nMoja etykieta jest przyjazna środowisku, została przygotowana z BIO folii.\r\n\r\nWegańska formuła\r\nPosiadam przyjazną środowisku i skórze wegańską formułę.  \r\n\r\nWsparacie\r\nWspieram finansowo budowę i funkcjonowanie systemu odzysku i recyklingu odpadów opakowaniowych.   \r\n\r\nIso\r\nZachowuję normę środowiskową ISO 14001 i ISO 9001.   \r\n\r\nPraktyka produkcyjna\r\nZachowuję dobrą praktykę produkcyjną. \r\n\r\nCertyfikat peta\r\nJestem zaaprobowany przez organizację PETA.\r\n', 8, 999),
(15, 6, 'HairBoom Rice Rehab Enzymatyczny ryżowy peeling do skóry głowy i włosów', '19.99', 'Pozwól, że się przedstawię\r\nJestem naturalnym (96% składników pochodzenia naturalnego wg normy ISO 16128), enzymatycznym ryżowym peelingiem, stworzonym do pielęgnacji skóry głowy i włosów, które potrzebują dogłębnego oczyszczenia i nawilżenia. Posiadam trychologiczną formułę i cudownie pachnę, dlatego wiem, że zaprzyjaźnimy się na dłużej.\r\n\r\nJak mnie stosować?\r\nNanieś peeling ryżowy na suchą skórę głowy. Delikatnie wmasuj opuszkami palców i pozostaw na 5-10 minut. Spłucz i umyj włosy szamponem jak zwykle. Stosuj mnie raz w tygodniu.\r\n\r\nCo mogę ci zaoferować?\r\nBędę się troszczył i dbał o Twoje włosy. Wiem, że czasami bywają niesforne, ale dzięki mnie staną się oczyszczone, nawilżone i w lepszej kondycji. Ograniczę ich przetłuszczanie, odblokuję ujścia mieszków włosowych, aby skóra głowy i włosy odzyskały równowagę i lepiej wchłaniały składniki aktywne.\r\n\r\nOdkryj moje wnętrze\r\n\r\nFermentowana woda ryżowa \r\nnawilża, wygładza strukturę i wydobywa naturalne piękno włosów.\r\n\r\nEkstrakt z papai \r\ndoskonale oczyszcza skórę głowy i usuwa martwy naskórek.\r\n\r\nNiacynamid\r\ndziała normalizująco i zmniejsza przetłuszczanie się skóry głowy oraz włosów.\r\n\r\nKwas bursztynowy \r\nusuwa nadmiar zrogowaciałego naskórka, zanieczyszczenia i pozostałości środków do stylizacji.\r\n\r\nZmysłowy zapach \r\nktóry pozostanie na włosach, to połączenie niezwykłego aromatu paczuli, świeżych malin, słodkiej śliwki i cedru.\r\n\r\nDbam o środowisko\r\n\r\nBio etykieta\r\nMoja etykieta jest przyjazna środowisku, została przygotowana z BIO folii.\r\n\r\nWegańska formuła\r\nPosiadam przyjazną środowisku i skórze wegańską formułę.  \r\n\r\nWsparacie\r\nWspieram finansowo budowę i funkcjonowanie systemu odzysku i recyklingu odpadów opakowaniowych.   \r\n\r\nIso\r\nZachowuję normę środowiskową ISO 14001 i ISO 9001.   \r\n\r\nPraktyka produkcyjna\r\nZachowuję dobrą praktykę produkcyjną. \r\n\r\nCertyfikat peta\r\nJestem zaaprobowany przez organizację PETA.\r\n', 8, 999),
(17, 91, 'Fluff Superfood jogurt do ciała soczysty arbuz', '16.99', 'Dla kogo?\r\nDla osób, które nie lubią czekać, aż produkt się wchłonie. :) Jogurt wchłania się ekstremalnie szybko nie pozostawiając tłustej warstwy. Również dla osób marzących o aksamitnie gładkiej skórze.\r\n\r\nCo zrobi dla Twojej skóry Jogurt do ciała Arbuz?\r\nSami zobaczcie na jego cudowny skład- proteiny ryżu, które przywrócą Twojej skórze odpowiednią mikroflorę. Skóra stanie się nawilżona, elastyczna i nawodniona, pozostawiając na niej uczucie ukojenia.\r\n\r\nDlaczego Superfood proteiny ryżu i olej kokosowy?\r\nTo olej kokosowy jest składnikiem, który ma silne właściwości regenerujące, nawilżające i wygładzające. Jogurt wnika w głębokie warstwy skóry trwale ją regenerując oraz uelastyczniając.\r\n\r\nProteiny ryżu chronią Twoją skórę przed czynnikami zewnętrznymi oraz przywraca Twojej skórze odpowiednią mikroflorę.\r\n\r\nSposób użycia\r\nWmasuj odpowiednia ilość jogurtu w skórę ciała.', 9, 999),
(18, 91, 'Fluff Superfood jogurt do ciała mleczna czekolada', '16.99', 'Dla kogo?\r\nDla osób, które nie lubią czekać, aż produkt się wchłonie. :) Jogurt wchłania się ekstremalnie szybko nie pozostawiając tłustej warstwy. Również dla osób marzących o aksamitnie gładkiej skórze.\r\n\r\nCo zrobi dla Twojej skóry Jogurt do ciała Malina z Migdałami?\r\nSami zobaczcie na jego cudowny skład- proteiny ryżu, które przywrócą Twojej skórze odpowiednią mikroflorę. Skóra stanie się nawilżona, elastyczna i nawodniona, pozostawiając na niej uczucie ukojenia.\r\n\r\nDlaczego Superfood proteiny ryżu i olej kokosowy?\r\nTo olej kokosowy jest składnikiem, który ma silne właściwości regenerujące, nawilżające i wygładzające. Jogurt wnika w głębokie warstwy skóry trwale ją regenerując oraz uelastyczniając.\r\n\r\nProteiny ryżu chronią Twoją skórę przed czynnikami zewnętrznymi oraz przywraca Twojej skórze odpowiednią mikroflorę.\r\n\r\nSposób użycia\r\nWmasuj odpowiednia ilość jogurtu w skórę ciała.', 9, 999),
(19, 91, 'Fluff Superfood jogurt do ciała maliny i migdały', '16.99', 'Dla kogo?\r\nDla osób, które nie lubią czekać, aż produkt się wchłonie. :) Jogurt wchłania się ekstremalnie szybko nie pozostawiając tłustej warstwy. Również dla osób marzących o aksamitnie gładkiej skórze.\r\n\r\nCo zrobi dla Twojej skóry Jogurt do ciała Czekolada?\r\nSami zobaczcie na jego cudowny skład- proteiny ryżu, które przywrócą Twojej skórze odpowiednią mikroflorę. Skóra stanie się nawilżona, elastyczna i nawodniona, pozostawiając na niej uczucie ukojenia.\r\n\r\nDlaczego Superfood proteiny ryżu i olej kokosowy?\r\nTo olej kokosowy jest składnikiem, który ma silne właściwości regenerujące, nawilżające i wygładzające. Jogurt wnika w głębokie warstwy skóry trwale ją regenerując oraz uelastyczniając.\r\n\r\nProteiny ryżu chronią Twoją skórę przed czynnikami zewnętrznymi oraz przywraca Twojej skórze odpowiednią mikroflorę.\r\n\r\nSposób użycia\r\nWmasuj odpowiednia ilość jogurtu w skórę ciała.', 9, 999),
(21, 30, 'Faceboom Oczyszczająca Woda Micelarna', '19.99', 'Jestem naturalną wodą micelarną stworzoną z myślą o oczyszczaniu skóry twarzy, szyi i dekoltu. Dzięki zawartości naturalnych składników i wegańskiej formuły nie podrażniam i mogę być stosowana również do demakijażu oczu.  Woda micelarna Zaradna Wizjonerka przeznaczona jest do każdego typu skóry, również tej skłonnej do podrażnień.\r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych.  Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJak mnie stosować?\r\nNanieś wodę micelarną na płatek kosmetyczny i przemyj twarz, oczy i szyje. Nie spłukuj. Powtarzaj aż do uzyskania czystego płatka kosmetycznego. Stosuj mnie rano i wieczorem, a dla najlepszych efektów po oczyszczeniu zastosuj krem z linii FaceBoom odpowiedni dla Twojej cery. Wybierz Krem Matująco-Detoksykujący Lojalny Wybawca lub Nawilżająco-Kojący Hydro Krem Wrażliwy Przyjaciel. \r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nSkutecznie zmywam makijaż. Oczyszczam skórę z zaniecyszczeń powstałych po całym dniu. Odświeżam i przygotowuję ją do dalszych etapów pielęgnacji. \r\n\r\nODKRYJ MOJE WNĘTRZE\r\nHydrolat z kwiatów pomarańczy - Reguluje wydzielanie sebum, działa antybakteryjne i regenerująco. Reguluje pracę gruczołów łojowych i wydzielanie sebum. Zmniejsza zaczerwienienie. Działa łagodząco, polecany jest dla cery delikatnej, podrażnionej i wrażliwej.\r\nHydrolat z liści zielonej herbaty - Łagodzi podrażenienia i zaczerwienienia oraz wpływa kojąco na cerę. Korzystnie działa na skórę naczynkową, powodując obkurczenie naczynek i złagodzenie stanów zapalnych.\r\nTrehaloza - Pomaga zachować prawidłowe nawilżenie oraz posiada właściwości antyoksydacyjne.', 10, 999),
(22, 29, 'Faceboom Oczyszczająca Pianka Do Mycia Twarzy', '19.99', 'Jestem naturalną, wegańską, oczyszczającą pianką do mycia twarzy. Zadbam o każdy rodzaj cery, a w szczególności zatroszczę się o tę wrażliwą i skłonną do podrażnień. Usuwam makijaż, odświeżam i dokładnie oczyszczam.\r\n\r\nP.S. Tak samo, jak Ty nie lubię SLS, PEG-ów, parabenów i olei mineralnych. Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJAK STOSOWAĆ PIANKĘ DO TWARZY FACEBOOM?\r\nOczyszczającą piankę do twarzy rozprowadź na wilgotnej skórze twarzy i masuj okrężnymi ruchami przez około 1 minutę, omijając okolice oczu i ust, a następnie dokładnie spłucz. Stosuj piankę do twarzy Puszystą kumpelkę rano i wieczorem, a dla najlepszych efektów po oczyszczeniu zastosuj krem z linii FaceBoom odpowiedni dla Twojej cery. Wybierz Krem Matująco-Detoksykujący Lojalny Wybawca lub Nawilżająco-Kojący Hydro Krem Wrażliwy Przyjaciel. \r\n\r\n*opakowanie na zdjęciu jest poglądowe i może sie różnić od rzeczywistego. \r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nOczyszczam cerę z zanieczyszczeń powstałych po całym dniu. Odświeżam i przygotowuję ją do dalszych etapów pielęgnacji. Zmywam pozostałości makijażu, koję, łagodzę podrażnienia i jestem delikatny dla każdego typu cery nawet tej najbardziej wrażliwej.\r\n\r\nODKRYJ MOJE WNĘTRZE\r\nEkstrakt z kiwi - nawilża i odżywia skórę. Działa łagodząco i chroni cerę przed działaniem wolnych rodników, przywraca skórze blask i zdrowy wygląd oraz odbudowuje płaszcz hydrolipidowy.\r\nEkstrakt z melona - Ma właściwości antyoksydacyjne, jest źródłem cennych kwasów, przeciwutleniaczy oraz witamin C i A, a także wzmacnia skórę i przywraca naturalne nawilżenie. Koi podrażnienia skóry i zapewnia odpowiednie nawilżenie. Posiada właściwości rozjasniające i i jest cennym źródłem kwasów i przeciwutleniaczy.\r\nSok z limonki - detoksykuje skórę, wyrównuje koloryt i łagodzi podrażnienia. Sok z limonki ma właściwości rozjaśniające dzięki czemu jest idealny w walce z przebarwieniami. Zmiękcza i i pozostawia skórę gładką w dotyku.', 10, 999),
(23, 35, 'Faceboom Nawilżająco-Kojący Hydro Krem', '29.99', 'Jestem naturalnym kremem do twarzy stworzonym z myślą o cerze suchej, wrażliwej i odwodnionej, która wymaga intensywnego nawilżenia i regeneracji. Powstałem na bazie naturalnej, wegańskiej formuły.\r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych. Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski! \r\n\r\nUżywaj mnie codziennie – rano i/lub wieczorem. Stosuj mnie na skórę twarzy, szyi i dekoltu. Przed użyciem oczyść skórę kosmetykiem z linii FaceBoom, wybierz Oczyszczającą Piankę Puszystą Kumpelkę, Oczyszczającą Wodę Micelarną Zaradną Wizjonerkę lub Puder Enzymatyczny Do Oczyszczania Twarzy Sypki Flirciarz.\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nNawilżam.  Sucha i wrażliwa skóra potrzebuje intensywnej pielęgnacji. Zawieram kompozycję naturalnych składników aktywnych, które dogłębnie nawilżą Twoją cerę, zapewniając uczucie komfortu. Jestem lekki, więc idealnie nadaję się do codziennej pielęgnacji, również pod makijaż. \r\nKoję i niweluję podrażnienia. Możesz być pewna, że dzieki składnikom aktywnym zawartym w moim wnętrzu pozostawię Twoją skórę gładką i delikatną jak nigdy przedtem. Jestem idealny dla cery suchej, wrażliwej i skłonnej do podrażnień. Możesz być pewna, że naturalność mojej formuły ukoi Twoją cerę i zmysły. Regeneruję Dzięki składnikom aktywnym zawartym w moim wnętrzu, zregeneruję Twoją skórę i dostarczę jej niezbędnych składników odżywczych.\r\nRegeneruję. Dzięki składnikom aktywnym zawartym w moim wnętrzu,zregenerujęTwoją skórę i dostarczę jej niezbędnych składników odżywczych. \r\nODKRYJ MOJE WNĘTRZE\r\nOlej z róży koi cerę wrażliwą, dodaje blasku i korzystnie wpływa na skórę naczynkową. Regeneruje, uelastycznia, normalizuje pracę gruczolów lojowych. Łagodzi, wygładza i zmiękcza skórę, zapewniając jej odpowiednie nawilżenie. Wspomaga wyrównanie kolorytu skóry.\r\nOlej z avocado Zapobiega przesuszaniu i opóźnia proces starzenia się skóry. Zapewnienia ochronę przed szkodliwym i niszczącym działaniem wolnych rodników. Olej z avocado pozytywnie wpływa na stan skóry zapewniając jej odpowiednie nawiżenie i odżywienie. \r\nOlej z orzechów brazylijskich Silnie nawilża, chroni i regeneruje skórę. Pomaga zwiększyć szybkość metabolizmu komórek. Skóra zyskuje siłę do skuteczniejszej i szybszej regeneracji. Uelastycznia i nadaje cerze promiennego, zdrowego wyglądu. Zapobiega suchości i powstrzymuje starzenie sie skóry. ', 10, 999),
(24, 35, 'Faceboom Matująco-Detoksykujący Krem', '29.99', 'Jestem naturalnym kremem do twarzy, stworzonym z myślą o cerze mieszanej i tłustej. Powstałem na bazie naturalnej, wegańskiej formuły. Zadbam o Twoją skórę najlepiej jak potrafię, normalizując wydzielanie sebum i pozostawiając skórę gładką i delikatną w dotyku. Dziękki lekkiej formule, nie obciążam skóry i pomagam w zmniejszeniu widoczności rozszerzonych porów. \r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych.  Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJAK MNIE STOSOWAĆ?\r\n\r\nUżywaj mnie codziennie – rano i/lub wieczorem. Stosuj mnie na skórę twarzy, szyi i dekoltu. Przed użyciem oczyść skórę kosmetykiem z linii FaceBoom wybierz Oczyszczającą Piankę Puszystą Kumpelkę, Oczyszczającą Wodę Micelarną Zaradną Wizjonerkę lub Puder Enzymatyczny Do Oczyszczania Twarzy Sypki Flirciarz.', 10, 999),
(25, 33, 'Faceboom Puder Enzymatyczny Do Oczyszczania Twarzy', '22.99', 'Jestem naturalnym pudrem enzymatycznym przeznaczonym do oczyszczania skóry twarzy, szyi i dekoltu. Wygładzam, zmiękczam i zapewniam bezpieczną pielęgnację wrażliwej cerze. Moja naturalna, wegańska receptura korzystnie wpłynie na stan odwodnionej skóry.\r\n\r\nP.S. Tak samo, jak Ty nie lubię SLS, PEG-ów, parabenów i olei mineralnych. Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJAK MNIE STOSOWAĆ?\r\n\r\nWstrząśnij słoiczek. Zwilż skórę twarzy. Osuszonymi palcami nasyp niewielką ilość w zagłębieniu dłoni i zmieszaj z wodą.  Pocieraj dłońmi do uzyskania jednolitej konsystencji. Nałóż mnie na twarz i masuj okrężnymi ruchami. a następnie dokładnie spłucz wodą. Dla uzyskania najlepszych efektów stosuj mnie  rano i wieczorem. Po użyciu zastosuj wodę micelarną FaceBoom lub nałóż krem do twarzy z serii FaceBoom przeznaczony do Twojej cery. Nie lubię wilgoci, dlatego po użyciu szczelnie zamknij słoik i zadbaj o to, aby do środka nie dostała się woda.\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nDelikatnie złuszczam - Delikatnie złuszczam warstwę rogową naskórka, odsłaniając nową, pełną blasku cerę. Jedwabna mąka owsiana skutecznie usunie obumarłe komórki skóry pozostawiając ją gladką.\r\nWyrównuję strukturę skóry - Dzięki delikatnym właściwościom złuszczającym Twoja skóra zostanie wygładzona i odpowiednio przygotowana pod kolejne etapy pielęgnacji. \r\nOczyszczam - Dokładnie oczyszczona cera to podstawa skutecznej pielęgnacji. Dzięki skladnikom aktywnym takim jak jedwabna mąka owsiana delikatnie ale skutecznie oczyszczam pory. Sprawię, że Twoja skóra będzie wygładzona, oczyszczona i miękka w dotyku.', 10, 999),
(26, 33, 'Faceboom Peeling Gruboziarnisty', '20.99', 'Jestem gruboziarnistym peeligniem do twarzy stworzonym z myślą o oczyszczaniu cery, szczególnie tej z trądzikiem i niedoskonałościami. Powstałem na bazie naturalnej, wegańskiej formuły, a moim składnikiem złuszczającym jest owoc trukwy egipskiej – luffa, który jest sprzymierzeńcem cery tłustej i mieszanej.\r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych.  Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJAK MNIE STOSOWAĆ?\r\n\r\nRozprowadź mnie na wilgotnej skórze twarzy i wcieraj okrężnymi ruchami przez około 1 minutę, omijając okolice oczu i ust, a następnie dokładnie spłucz. Stosuj mnie 1-2 razy w tygodniu. Przed użyciem oczyść skórę kosmetykiem z linii FaceBoom, wybierz Oczyszczającą Piankę Puszystą Kumpelkę, Oczyszczającą Wodę Micelarną Zaradną Wizjonerkę lub Puder Enzymatyczny Do Oczyszczania Twarzy Sypki Flirciarz.', 10, 999),
(27, 40, 'Faceboom Gumowa Maska Algowa Peel-Off', '15.99', 'Jestem naturalną, gumową maską algową do twarzy typu peel-off. Po nałożeniu mnie na cerę stopniowo tężeję, tworząc na skórze miękki w dotyku opatrunek. Posiadam składniki pochodzenia roślinnego i przygotowuję, skórę do dalszych zabiegów pielęgnacyjncyh. Jestem polecana do każdego rodzaju skóry - suchej, wrażliwej, tłustej i mieszanej ze skłonnością do niedoskonałości oraz dojrzałej. \r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych.  Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\n\r\nJAK MNIE STOSOWAĆ?\r\n\r\nPołącz mnie z wodą dodając do kubeczka dokładnie 30ml letniej wody. Mieszaj energicznie przez kilka minut w celu uzyskania jednolitej masy. Nałóż mnie na oczyszczoną skórę twarzy. Pozostaw na około 10-15 minut. Ściągnij w całości. Dla najlepszych efektów stosuj razen z innymi kosmetykami z linii FaceBoom. Przed użyciem oczyść skórę Oczyszczającą Piankę Puszystą Kumpelkę, Oczyszczającą Wodę Micelarną Zaradną Wizjonerkę lub Puder Enzymatyczny Do Oczyszczania Twarzy Sypki Flirciarz. Pamiętaj aby precyzyjnie odmierzyć ilość wody, w przeciwynym razie nieodpowiednia konsystencja nie pozwoli Ci cieszyć się moim efektem! Jestem przeznaczona do jednarozowego zastosowania. \r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nNawilżam i przywracam blask - Przywracam skórze blask i zdrowy wygląd. Daję efekt silnego dotlenienia i nawilżenia skóry. Zwiększam elastyczność i sprężystość skóry. Jestem bogata w szereg witamin z grupy B, E i C, a także beta-karoten oraz pierwiastków, takich jak potas, magnez, wapń, cynk i fosfor, jod, żelazo, miedź które w większości stanowią materiał budulcowy dla skóry.\r\nKoję - działam kojąco i łagodząco na cerę, poprawiając jej wygląd i łagodząc podrażnieniaSpotkanie ze mną to chwila przyjemności, w której Ty zyskasz 15 minut dla siebie, a ja zadziałam na korzyść Twojej skóry. Możesz być pewna, że poczujesz się w pełni zrelaksowana i piękna jak nigdy przedtem.\r\nSok aloesowy - Nawilża i stymuluje komórki skóry do regeneracji. Łagodzi stany zapalne i podrażnienia. Tonizuje i przywraca równowagę kwasowo-zasadową. \r\nRóżowa glinka - Działa kojąco i odprężająco. Obkurcza i uszczelnia naszynia krwionośne. Detoksykuje i oczyszcza pory, absorbując nadmiar sebum. \r\nBorówka amerykańska - Zawiera witaminę C wzmacniającą naczynia krwionośne. Źródło antyoksydantów, dostarcza energii zmęczonej i pozbawionej blasku cerze. Działa wzmacniająco na naczynka.  ', 10, 999),
(28, 36, 'Faceboom Korygująco-rozjaśniające serum do twarzy', '31.99', 'Jestem naturalnym korygująco-rozjaśniającym serum do twarzy stworzonym z myślą o każdym typie cery, a w szczególności tłustej, mieszanej, błyszczącej, szarej z rozszerzonymi porami, przebarwieniami, zmianami trądzikowymi i innymi widocznymi niedoskonałościami. Powstałem na bazie naturalnej, wegańskiej formuły. \r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych. Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJAK MNIE STOSOWAĆ?\r\n\r\nNałóż serum rozjaśniające na oczyszczoną skórę twarzy. Dzięki zawartości kwasów poczujesz delikatne podszczypywanie. Pozostaw mnie do wchłonięcia. Stosuj na noc. Dla najlepszych efektów przed użyciem oczyść skórę kosmetykiem z linii FaceBoom wybierz Oczyszczającą Piankę Puszystą Kumpelkę lub Puder Enzymatyczny Do Oczyszczania Twarzy Sypki Flirciarz, a następnie użyj kremu FaceBoom przeznaczonego do typu Twojej cery. \r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nWyrównuję koloryt\r\nKoryguję niedoskonałości\r\nOczyszczam \r\nODKRYJ MOJE WNĘTRZE\r\nGluconolactone - Należący do grupy kwasów PHA kwas, który stymuluje komórki i zapobiega starzeniu. Redukuje zmiany trądzikowe i niedoskonałości. Uelastycznia, ujędrnia i zapobiega powstawaniu zaskórników. Silnie nawilża, łagodzi podrażnienia i chroni przed utratą wody.\r\nKwas migdałowy - Rozjaśnia przebarwienia pozapalne i posłoneczne. Reguluje wydzielanie sebum, nawilża i tonizuje skórę. Niweluje zmiany trądzikowe i łagodzii stany zapalne.\r\nKwas glikolowy - Pobudza procesy regeneracyjne. Wspomaga w stymulacji produkcji kolagenu. Wygładza i  zapobiega przedwczesnemu starzeniu się skóry.', 10, 999),
(29, 44, 'Faceboom Intensywnie odżywczy peeling do ust', '16.99', 'Jestem naturalnym, intensywnie odżywczym peelingiem do ust. Powstałem na bazie naturalnej, wegańskiej formuły. Dzięki mnie Twoje usta będą miękkie, delikatne i idealnie przygotowane do dalszej pielęgnacji lub makijażu. Kiedy mnie poznasz i przekonasz się co potrafię - staniemy się nierozłączni!\r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych.  Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJAK MNIE STOSOWAĆ?\r\n\r\nOpuszkami palców nałóż peeling na usta, a następnie rozsmaruj i delikatnie masuj okrężnymi ruchami przez 30 sekund. Zetrzyj peeling delikatnie za pomocą wacika lub opłucz wodą. Dla uzyskania najlepszych efektów, stosuj mnie 2-3 razy w tygodniu, a następnie nałóż intensywnie nawilżający balsam do ust Słodki Kusiciel FaceBoom.\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nDzięki zawartości naturalnych, wyselekcjonowanych składników peeling do ust złuszcza martwy naskórek pozostawiając usta kusząco miękkie, gładkie i przygotowane na dalsze etapy pielęgnacji.\r\n\r\nODKRYJ MOJE WNĘTRZE\r\nWegański skład\r\nZawieram Olej Abisyński, który wspomaga regenerację popękanych warg i łagodzi wszelkie podrażnienia. \r\nOleje babassu i z orzecha brazylijskiego, wzmacniają ochronną warstwę  hydrolipidową, a w połączeniu ze skrobią ryżową pobudzają ukrwienie, nadając Twoim ustom piękny koloryt. \r\nBetaina skutecznie nawilża odwodnioną skórę warg i łagodzi zaczerwienienia. \r\nOlej z Avokado szczególnie zatroszczy się o bardzo suche oraz wrażliwe usta i w duecie z Kalaminą ukoi łuszczącą się skórę. \r\nGlukoza połączona z cudownymi właściwościami masła shea zadba o utrzymanie odpowiedniego nawilżenia. Dodam, że dzięki drobinkom cukru jestem wyjątkowo słodki.', 10, 999),
(30, 41, 'Faceboom Intensywnie nawilżający balsam do ust', '16.99', 'Jestem naturalnym, intensywnie nawilżającym balsamem do ust. Powstałem na bazie naturalnej wegańskiej formuły. Mój słodki zapach i odżywcze działanie sprawią, że czule zatroszczę się o Twoje usta. Będą wyglądać pełniej i kusząco!\r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych.  Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJAK MNIE STOSOWAĆ?\r\n\r\nMożesz stosować balsam do ust od FaceBoom na dwa sposoby! Wybierz dla siebie najlepszą opcję! \r\n\r\nSPOSÓB 1. Nałóż obfitą warstwę na oczyszczoną, suchą skórę ust. Pozostaw do wchłonięcia. Stosuj w dzień lub na noc. \r\nSPOSÓB 2. Możesz stosować mnie również jako błyszczyk lub balsam w ciągu dnia, nakładając cienką warstwę przed makijażem. Stosuj mnie tak często, jak tego potrzebujesz. Dla najlepszych efektów, przed użyciem wykonaj peeling do ust Szorstki Smakosz FaceBoom.\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nDzięki zawartości wyselekcjonowanych, naturalnych składników, nawilżający balsam do ust skutecznie pielęgnuję podrażnioną i wymagającą intensywnego nawilżenia skórę warg. Sprawię, że Twoje spierzchnięte i przesuszone usta będą miękkie i delikatne.\r\nODKRYJ MOJE WNĘTRZE\r\nOlej babassu - Zapewni ukojenie, zmiękczenie i wygładzenie delikatnej skóry ust. Chroni naskórek przed utratą wody.\r\nOlej z pestek malin - Zregeneruje podrażniony i szorstki naskórek. Nawilża i łagodzi podrażnienia skóry.\r\nOlej z avokado - Sprawi, że usta będą nawilżone przez długi czas.\r\nOlej ze słodkich migdałów - Działa łagodząco, koi i regeneruje. \r\nOliwa z oliwek - Działa łagodząco, koi i regeneruje.\r\nMasło Shea - Uelastycznia i chroni przed utratą wilgoci.\r\nKalamina - Ma działanie łagodzące.\r\nPropanediol - Czyli glikol roślinny, który jest świetnym nośnikiem składników aktywnych, pozwalając dodatkowo utrzymać trwały poziom nawilżenia ust.', 10, 999),
(31, 40, 'Faceboom Detoksykująco-kojąca maseczka z różową glinką', '10.99', 'Jestem naturalną, detoksykująco-kojącą maską do twarzy. Nadaję się do każdego rodzaju skóry, w szczególności mieszanej i tłustej, ale również do suchej, delikatnej i skłonnej do podrażnień. Powstałam na bazie naturalnej wegańskiej formuły.\r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych.  Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJAK MNIE STOSOWAĆ?\r\n\r\nNałóż mnie na oczyszczoną skórę twarzy, omijając okolice oczu. Pozostaw na 10 minut, a następnie dokładnie zmyj letnią wodą.\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nDzięki zawartości wyselekcjonowanych naturalnych składników dokładnie oczyszczam, detoksykuję i koję cerę. Niweluję niedoskonałości, zmniejszam widoczność rozszerzonych porów, regeneruję naskórek i przywracam skórze zdrowy wygląd.\r\n\r\nODKRYJ MOJE WNĘTRZE\r\nWegański skład\r\nRóżowa glinka łagodzi podrażnienia, oczyszcza pory i absorbuje nadmiar sebum, detoksykuje, tonizuje, a przy tym koi i relaksuje. \r\nBiała Glinka delikatnie usuwa zanieczyszczenia, rozjaśnia. \r\nEkstrakt z kwiatu hibiskusa ujędrnia i wygładza cerę. \r\nEkstrakt z kwiatu lotosu nawilża i poprawia elastyczność skóry. \r\nSkrobia ryżowa absorbuje sebum oraz ogranicza przetłuszczanie się skóry. \r\nKalamina koi, zmiękcza i działa przeciwzapalnie. \r\nKwas mlekowy odblokowuje pory skóry i działa antybakteryjnie.', 10, 999),
(32, 40, 'Faceboom Nawilżająco-rozświetlająca maseczka w płacie', '10.99', 'Jestem naturalną, rozświetlająco-nawilżającą maską do twarzy przeznaczoną do każdego rodzaju cery, a w szczególności suchej, odwodnionej, zmęczonej i pozbawionej blasku. Doskonale nawilżam, łagodzę podrażnienia, pozostawiając cerę rozjaśnioną, rozświetloną przywracając jej zdrowy i promienny wygląd.\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych.  Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\nJAK MNIE STOSOWAĆ?\r\nNałóż mnie na oczyszczoną skórę twarzy. Zdejmij po 15 minutach. Pozostałości wmasuj delikatnie w skórę. Dla najlepszych efektów stosuj mnie wraz z innymi kosmetykami FaceBoom.Wykonaj dalsze etapy pielęgnacji używając kremu FaceBoom przeznaczonego do Twojego typu cery.\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nDzięki zawartości naturalnych składników znanych ze swoich nawilżających i rozjaśniających właściwości, rozświetlam i wyrównuję koloryt skóry wspomagając naturalny proces regeneracji. Po użyciu mnie cera wydaje się bardziej jednolita, promienna, pełna blasku z efektem “flash”! Dzięki zastosowaniu włókniny, podczas stosowania skóra ma możliwość dłuższego obcowania z moimi składnikami aktywnymi zawartymi z naturalnej formule, a specjalnie dopasowany kształt płachty zapewnia jej przyleganie do twarzy.\r\nODKRYJ MOJE WNĘTRZE\r\nWegański skład\r\nUltrastabilna witamina C wyrównuje koloryt skóry, działa wybielająco i przeciwdziała fotostarzeniu się skóry. \\\r\nKwas mlekowy wspomaga odblokowanie porów i chroni przed utratą wody. \r\nEkstrakt z ananasa koi i łagodzi skórę wspomagając redukację obrzęków i podrażnień. Ekstrakt z melona – ma działanie antyoksydacyjne. Oczyszcza i odświeża skórę. Likwiduje skutki stresu oksydacyjnego. Przywraca skórze blask. \r\nEkstrakt z pomarańczy działa antyseptycznie i łagodząco. Ma właściwości ściągające i zmniejszające pory. Rozjaśnia przebarwienia i wyrównuje koloryt skóry.', 10, 999),
(46, 35, 'FaceBoom Skin Harmony Rozpieszczająco-nawilżający krem do twarzy', '34.99', 'Jestem naturalnym (98% składników pochodzenia naturalnego wg normy ISO 16128), rozpieszczająco- nawilżającym kremem na dzień i na noc, stworzonym do codziennej pielęgnacji cery odwodnionej, suchej i mieszanej z widocznymi oznakami podrażnienia, stresu i zmęczenia.\r\n\r\nJestem po to, aby Cię rozpieszczać, dlatego posiadam satynową formułę i obłędnie pachnę, mój relaksujący zapach będzie sprzyjał poczuciu szczęścia.\r\n\r\nNa początku poczujesz karmelową nutę głowy, później uwolni się kwiatowa nuta serca, a na koniec otuli Cię waniliowa nuta głębi.\r\n\r\nJAK MNIE STOSOWAĆ?\r\n\r\nWmasuj mnie okrężnymi ruchami w oczyszczoną skórę twarzy, szyi i dekoltu. Stosuj mnie codziennie rano i wieczorem. Dla najlepszych efektów zastosuj również pozostałe produkty Face Boom Skin Harmony i pozwól im harmonizować kapitał emocjonalny dla ekspresji naturalnego piękna.\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nKażdego ranka i każdej nocy będę koić Twoje zmysły, nawilżać, wygładzać, ujędrniać i zmniejszać reaktywność skóry, abyś odzyskała równowagę i promienny wygląd. Zawieram sensoskładniki ze świat roślin, które poprzez holistyczną pielęgnację wpłyną na poprawę Twojego nastroju i wydobędą naturalne piękno.\r\n\r\nODKRYJ MOJE WNĘTRZE\r\nOlej abisyński - nawilża i zapewnia skórze długotrwałe uczucie komfortu.\r\nEkstrakt z ashwagandhy -  uspokająjący skórę adaptogen o własciwościach przeciwstarzeniowych. \r\nOlej konopny - kondycjonuje, zauważalnie odżywia i wygładza skórę.\r\nEktoina - koi i chroni naskórek przed nadmierną utratą wody.', 10, 999),
(51, 39, 'FaceBoom Skin Harmony Rozpieszczająco-nawilżający krem pod oczy', '26.99', 'Jestem naturalnym (98% składników pochodzenia naturalnego wg normy ISO 16128), rozpieszczająco- nawilżającym kremem pod oczy stworzonym do codziennej pielęgnacji skóry odwodnionej, suchej i mieszanej z widocznymi oznakami podrażnienia, stresu i zmęczenia. Jestem po to, aby Cię rozpieszczać, dlatego posiadam wyjątkową jedwabistą formułę i obłędnie pachnę, mój relaksujący zapach będzie sprzyjał poczuciu szczęścia.\r\nJAK MNIE STOSOWAĆ?\r\n\r\nWmasuj mnie delikatnie w skórę wokół oczu. Dla najlepszych efektów zastosuj również pozostałe produkty Face Boom Skin Harmony i pozwól im harmonizować kapitał emocjonalny dla ekspresji naturalnego piękna.\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nCodziennie będę koić Twoje zmysły, zapewniać Ci wypoczęty wygląd, rozjaśniać cienie pod oczami, nawilżać, wygładzać i zmniejszać reaktywność skóry, abyś odzyskała równowagę i promienny wygląd. Zawieram sensoskładniki ze świata roślin, które poprzez holistyczną pielęgnację wpłyną na poprawę Twojego nastroju i wydobędą naturalne piękno.\r\nODKRYJ MOJE WNĘTRZE\r\nEkstrakt z guarany  - zauważalnie rewitalizuje i nadaje sprężystość skórze.\r\nKofeina -przywraca gładkość i redukuje opuchnięcia pod oczami.\r\nPerła naturalna - rozświetla, optycznie rozjaśnia cienie pod oczami, dodając skórze blasku.\r\nEkstrakt z gotu kola - działa łagodząco, zmiekczająco i poprawia nawilżenie skóry.', 10, 999),
(52, 36, 'FaceBoom Skin Harmony Rozpieszczające serum olejkowe do twarzy', '34.99', 'Jestem naturalnym (98% składników pochodzenia naturalnego wg normy ISO 16128), rozpieszczającym serum olejkowym do twarzy, stworzonym do pielęgnacji cery odwodnionej, suchej i mieszanej z widocznymi oznakami podrażnienia, stresu i zmęczenia. Jestem po to, aby Cię rozpieszczać, dlatego posiadam aksamitną olejkową formułę i obłędnie pachnę, mój relaksujący zapach będzie sprzyjał poczuciu szczęścia. Na początku poczujesz karmelową nutę głowy, później uwolni się kwiatowa nuta serca, a na koniec otuli Cię waniliowa nuta głębi.\r\nJAK MNIE STOSOWAĆ?\r\nNaciśnij dozownik 1-2 razy. Wmasuj mnie okrężnymi ruchami w oczyszczoną skórę twarzy, szyi i dekoltu. Możesz stosować mnie samodzielnie zamiast kremu lub przed nałożeniem kremu, a także zmieszać na dłoni z kremem z linii Skin Harmony. Dla najlepszych efektów zastosuj również pozostałe produkty Face Boom Skin Harmony i pozwól im harmonizować kapitał emocjonalny dla ekspresji naturalnego piękna.\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nBędę koić Twoje zmysły, regenerować, wygładzać, odżywiać i zmniejszać reaktywność skóry, abyś odzyskała równowagę i promienny wygląd. Zawieram sensoskładniki ze świat roślin, które poprzez holistyczną pielęgnację wpłyną na poprawę Twojego nastroju i wydobędą naturalne piękno.\r\n\r\nODKRYJ MOJE WNĘTRZE\r\nOlej bawełniany  - wygładza, odczuwanie regeneruje i zmiękcza skórę.   \r\nOlej konopny  - kondycjonuje, zauważalnie odżywia i wygładza skórę.\r\nOlej z orzechów brazylijskich - zapobiega przesuszeniu i zapewia długotrwałe uczucie komfortu.\r\nWyciąg z porcelanowego kwiatu - rozświetla, koi i doskonale nawilża skórę.', 10, 999);
INSERT INTO `produkt` (`produkt_id`, `kategoria_id`, `nazwa`, `cena`, `opis`, `marka_id`, `ilosc`) VALUES
(53, 40, 'FaceBoom Skin Harmony Rozpieszczająca kolekcja maseczek do twarzy', '13.99', 'Jestem naturalną (97% składników pochodzenia naturalnego wg normy ISO 16128), rozpieszczającą kolekcją maseczek do twarzy, stworzoną do pielęgnacji cery odwodnionej, suchej i mieszanej z widocznymi oznakami podrażnienia, stresu i zmęczenia, zgodnej z jej dobowym rytmem.\r\n\r\nJestem po to, aby Cię rozpieszczać, dlatego o poranku dodam Twojej skórze energii, a wieczorem utulę ją do regenerującego snu. Obłędnie pachnę, mój relaksujący zapach będzie sprzyjał poczuciu szczęścia.\r\n\r\nNa początku poczujesz karmelową nutę głowy, później uwolni się kwiatowa nuta serca, a na koniec otuli Cię waniliowa nuta głębi.\r\n\r\n\r\nJAK MNIE STOSOWAĆ?\r\n\r\nEnergetyzująca skórę o poranku maseczka do twarzy DZIEŃ DOBRY: Rano nałóż mnie na oczyszczoną skórę twarzy i szyi omijając okolice oczu. Pozostaw na 10 minut, następnie zmyj letnią wodą. \r\n\r\nRegenerująca skórę podczas snu maseczka do twarzy DOBRANOC: Przed snem nałóż mnie na oczyszczoną skórę twarzy i szyi, omijając okolice oczu. Pozostaw mnie bez spłukiwania na całą noc.\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nNa DZIEŃ DOBRY będę pobudzać Cię do działania, błyskawicznie rewitalizować, nawilżać i dodawać skórze energii, dzięki temu, Twój makijaż będzie wyglądał piękniej.\r\n\r\nNa DOBRANOC będę koić Twoje zmysły, odżywiać, regenerować, wygładzać i zmniejszać reaktywność skóry, abyś rano obudziła się jeszcze piękniejsza.\r\n\r\nZawieram sensoskładniki ze świat roślin, które poprzez holistyczną pielęgnację wpłyną na poprawę Twojego nastroju i wydobędą naturalne piękno.\r\n\r\nODKRYJ MOJE WNĘTRZE\r\nOlej kukui - odczuwalnie regeneruje, odżywia i koi skórę.\r\nEkstrakt z gotu kola - działa łagodząco, zmiękczająco i poprawia nawilżenie skóry.\r\nEkstrakt z drzewa moringa - wygładza skórę i przywraca miękkość\r\nKwas hialuronowy - nawilża, odświeża i niwelując uczucie ściągnięcia i suchości.\r\nEkstrakt z guarany - uspokająjący skórę adaptogen o własciwościach przeciwstarzeniowych. ', 10, 999),
(54, 32, 'FaceBoom Skin Harmony Rozpieszczający olejek do demakijażu', '34.99', 'Jestem naturalnym (98% składników pochodzenia naturalnego wg normy ISO 16128), rozpieszczającym olejkiem do demakijażu stworzonym do łagodnego oczyszczania cery odwodnionej, suchej i mieszanej z widocznymi oznakami podrażnienia, stresu i zmęczenia. Jestem po to, aby Cię rozpieszczać, dlatego posiadam wyjątkowo przyjemną formułę i obłędnie pachnę, mój relaksujący zapach będzie sprzyjał poczuciu szczęścia.\r\nJAK MNIE STOSOWAĆ?\r\nNałóż mnie na dłoń i wmasuj w suchą skórę twarzy. Następnie zwilż dłonie i jeszcze przez chwilę masuj. Na koniec spłucz mnie ciepłą wodą.\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nCodziennie będę koić Twoje zmysły, usuwać makijaż, oczyszczać, wygładzać i zmniejszać reaktywność skóry, abyś odzyskała równowagę i promienny wygląd. Zawieram sensoskładniki ze świat roślin, które poprzez holistyczną pielęgnację wpłyną na poprawę Twojego nastroju i wydobędą naturalne piękno\r\n\r\nODKRYJ MOJE WNĘTRZE\r\nOlejek ze słodkich migdałów - odczuwalnie regeneruje i odżywia skórę. \r\nFitoskwalan oliwkowy - wygładza, koi i niweluje uczucie ściągnięcia.\r\nWitamina e - kondycjonująca skórę „witamina młodości”.', 10, 999),
(55, 31, 'FaceBoom Skin Harmony Rozpieszczające mleczko tonizujące do twarzy', '26.99', 'Jestem naturalnym (98% składników pochodzenia naturalnego wg normy ISO 16128), rozpieszczającym mleczkiem tonizującym stworzonym do odświeżania oraz rewitalizowania cery odwodnionej, suchej i mieszanej z widocznymi oznakami podrażnienia, stresu i zmęczenia. Jestem po to, aby Cię rozpieszczać, dlatego posiadam mleczną formułę i obłędnie pachnę, mój relaksujący zapach będzie sprzyjał poczuciu szczęścia.\r\nJAK MNIE STOSOWAĆ?\r\nPrzed użyciem wstrząśnij. Rozpyl mnie bezpośrednio na oczyszczoną skórę twarzy lub na dłoń. Następnie wmasuj mnie okrężnymi ruchami.\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nCodziennie będę koić Twoje zmysły, tonizować, nawilżać, odświeżać, wygładzać i zmniejszać reaktywność skóry, abyś odzyskała równowagę i promienny wygląd. Zawieram sensoskładniki ze świat roślin, które poprzez holistyczną pielęgnację wpłyną na poprawę Twojego nastroju i wydobędą naturalne piękno.\r\nODKRYJ MOJE WNĘTRZE\r\nKomórki macierzyste z krzewu motyli ', 10, 999),
(56, 35, 'FaceBoom Seboom Seboom Mikrozłuszczający krem do twarzy na noc', '29.99', 'Jestem naturalnym (97% składników pochodzenia naturalnego wg normy ISO 16128), mikrozłuszczającym kremem z 2%-owym kompleksem kwasów stworzonym z myślą o cerze tłustej, mieszanej i problematycznej, która wymaga pielęgnacji dopasowanej do jej humorów i zachcianek.\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych.  Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\nJAK MNIE STOSOWAĆ?\r\nUżywaj mnie wieczorem na skórę twarzy, szyi i dekoltu. Przed użyciem oczyść skórę kosmetykiem z linii FaceBoom Seboom. Pamiętaj, aby w ciągu dnia używać produktów z wysoką ochroną przeciwsłoneczną – dzięki nim Twoja skóra będzie bezpieczna i zachowa młody wygląd na dłuuugo!\r\nWAŻNE! Przed pierwszym użyciem wykonaj próbę uczuleniową na małym odcinku skóry. W przypadku aktywnego trądziku skonsultuj się z lekarzem. Słuchaj swojej skóry! Nie musimy spotykać się codziennie, wystarczy 2–3 razy w tygodniu, w zależności od Twoich potrzeb. Jeśli jednak zdecydujesz się na codzienny kontakt, po 3–4 dniach rozstańmy się na tydzień.\r\nHey #FaceBoomGirl, dzięki mojemu wnętrzu mam już spore grono fanów*:\r\n93% osób deklaruje, że poprawiam nawilżenie skóry**\r\n81% osób deklaruje, że zmniejszam świecenie skóry**\r\n74% osób deklaruje, że zmniejszam ilość widocznych porów**\r\n83% osób deklaruje, że złuszczam martwy naskórek.\r\n89% osób deklaruje, że pomagam oczyścić skórę z zaskórników.\r\n*Badania przeprowadzono na grupie 100 osób.\r\n**Skuteczność potwierdzona także w badaniach aparaturowych.\r\nODKRYJ MOJE WNĘTRZE\r\nKwas kaprilowo-salicylowy (lha) - Wpływa korzystanie na regulacje sebum, działa przeciwzaskórnikowo. Redukuje wypryski i niedoskonałości.\r\nKwas migdałowy (aha) - Zmniejsza widoczność rozszerzonych porów. Przywraca zdrowy koloryt skóry, nawilża i tonizuje skórę. Niweluje zmiany potrądzikowe.\r\nKwas szikimowy (aha) - Wspiera skórę w walce z niedoskonałościami. Złuszcza martwy naskórek, może opóźniać procesy starzenia i chroni przed szkodliwym wpływem czynników środowiskowych.\r\nKwas laktobionowy (pha) - Wykazuje działanie nawilżające i łagodzące. Wspomaga odnowę i regenerację naskórka. \r\nSkwalan - Składnik naturalnie występujący w skórze, chroni ją przed szkodliwym działaniem czynników zewnętrznych, wykazuje działanie nawilżające.', 10, 999),
(57, 35, 'FaceBoom Seboom Nawilżająco-matujący krem do twarzy na dzień', '29.99', 'Jestem naturalnym (98% składników pochodzenia naturalnego wg normy ISO 16128), nawilżająco-matującym kremem na dzień stworzonym dla skóry tłustej, mieszanej i problematycznej, która wymaga pielęgnacji dopasowanej do jej humorów i zachcianek.\r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych. Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJAK STOSOWAĆ KREM DO TWARZY?\r\nNałóż krem matujący na oczyszczoną skórę twarzy. Wmasuj okrężnymi ruchami i pozostaw do wchłonięcia. Stosuj krem nawilżająco-matujący codziennie rano i/lub wieczorem jako zamiennik kremu mikrozłuszczjącego z linii FaceBoom Seboom.\r\n\r\nWAŻNE! Przed pierwszym użyciem wykonaj próbę uczuleniową na małym odcinku skóry. W przypadku aktywnego trądziku skonsultuj się z lekarzem.\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nWiem, jak niesforna potrafi być czasami Twoja skóra i dlatego zostałem stworzony, aby przywrócić jej naturalną równowagę i świeżość. Intensywnie odżywiam, wspomagam utrzymanie długotrwałego poziomu nawilżenia i dodatkowo dbam o mikrobiom Twojej skóry. Moja lekka formuła wchłania się błyskawicznie, nie obciążając. Zapewniam efekt matowej i świeżej cery, regulując nadmierne wydzielanie sebum. Działam delikatnie ściągająco, by zniwelować błyszczenie naskórka.\r\n\r\nHey #FaceBoomGirl, dzięki mojemu wnętrzu mam już spore grono fanów*:\r\n\r\n94% osób deklaruje, że daję efekt matowej i świeżej skóry.\r\n82% osób deklaruje, że redukuję wydzielanie sebum.**\r\n95% osób deklaruje, że pomagam przywrócić skórze jej naturalną równowagę.\r\n97% osób deklaruje, że łagodzę zaczerwieniania.**\r\n*Badania przeprowadzono na grupie 100 osób.\r\n**Skuteczność potwierdzona także w badaniach aparaturowych.\r\n\r\nODKRYJ MOJE WNĘTRZE\r\nProszek bambusowy Wykazuje działanie pochłaniające sebum, dzięki czemu skóra pozostaje matowa.\r\nKombucha - Sfermentowany napój z czarnej herbaty, bogaty w kwasy organiczne i witaminy jest prawdziwą bombą energii i nawilżenia dla skóry.\r\nEkstrakt z zielonej herbaty - Nazywana herbatą młodości, łagodzi i koi podrażnioną skórę.\r\nNiacynamid - Wspiera skórę w walce z niedoskonałościami, zauważalnie ujednolica koloryt skóry.\r\nBetaina - Skutecznie nawilża odwodnioną skórę i łagodzi zaczerwienienia.\r\nPrebiotyki i probiotyki - Dbają o mikrobiom skóry i zwiększają odporność na czynniki zewnętrzne.', 10, 999),
(58, 36, 'FaceBoom Seboom Punktowy lotion na niedoskonałości', '31.99', 'Jestem naturalnym (94% składników pochodzenia naturalnego wg normy ISO 16128), punktowym lotionem na niedoskonałości stworzonym z myślą o cerze tłustej, mieszanej i problematycznej, która wymaga pielęgnacji dopasowanej do jej humorów i zachcianek.\r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych.  Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJAK MNIE STOSOWAĆ?\r\n\r\nProszę, nie wstrząsaj mną, bardzo tego nie lubię. Zanurz patyczek kosmetyczny w mojej butelce, aby pokrył się zieloną masą. Następnie nałóż mnie punktowo na niedoskonałości. Pozostaw na noc do wyschnięcia i połóż się spać. Rano spłucz mnie wodą i ciesz się piękną, oczyszczona skórą!\r\n\r\nWAŻNE! Przed pierwszym użyciem wykonaj próbę uczuleniową na małym odcinku skóry. W przypadku aktywnego trądziku skonsultuj się z lekarzem. \r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nWiem, jak niesforna potrafi być czasami Twoja skóra i dlatego zostałem stworzony, aby przywrócić jej naturalną równowagę i świeżość. Moja formuła wysuszającego lotionu powstała w oparciu o skuteczne składniki na niedoskonałości, takie jak kwas salicylowy, cynk PCA czy olejek z drzewa herbacianego. Działam głównie w nocy przez kilka godzin. Kiedy Ty śpisz, ja oczyszczam, delikatnie złuszczam i przyspieszam regenerację niedoskonałości.\r\n\r\n\r\nHey #FaceBoomGirl, dzięki mojemu wnętrzu mam już spore grono fanów*:\r\n\r\n93% osób deklaruje, że wyciszam zmiany trądzikowe.\r\n95% osób deklaruje, że przyspieszam proces regeneracji niedoskonałości.\r\n99% osób deklaruje, że oczyszczam skórę.\r\n* Badania przeprowadzone na grupie 100 osób.\r\n\r\nODKRYJ MOJE WNĘTRZE\r\nTlenek cynku - Przyspiesza proces regeneracji skóry i wykazuje działanie ściągające.\r\nOlejek z drzewa harbacianego - Bardzo dobrze oczyszcza skórę, wykazuje działanie antybakteryjne, delikatne ściąga pory, działa regenerująco i normalizuje wydzielanie sebum.\r\nKwas salicylowy (bha)  - Wpływa korzystanie na regulacje sebum, działa przeciwzaskórnikowo. Redukuje wypryski i niedoskonałości.', 10, 999),
(59, 33, 'FaceBoom Seboom 10-minutowy wygładzający peeling kwasowy do twarzy', '29.99', 'Jestem naturalnym (95% składników pochodzenia naturalnego wg normy ISO 16128), 10-minutowym, wygładzającym peelingiem kwasowym z 10%-owym kompleksem kwasów stworzonym z myślą o cerze tłustej, mieszanej i problematycznej, która wymaga pielęgnacji dopasowanej do jej humorów i zachcianek.\r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych.  Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJAK STOSOWAĆ PEELIGN KWASOWY?\r\n\r\nNałóż peeling kwasowy na oczyszczoną i osuszoną skórę twarzy, szyi i dekoltu podczas wieczornej pielęgnacji. Omijaj okolice oczu, ust, skrzydełek nosa oraz błony śluzowe. Po nałożeniu peelingu kwasowego może wystąpić delikatne mrowienie, które jest normalnym odczuciem przy produktach z zawartością kwasów. Pozostaw na ok. 10 minut, a następnie dokładnie spłucz letnią wodą. W zależności od stopnia wrażliwości cery możesz mnie stosować 2–3 razy w tygodniu.\r\n\r\nWAŻNE! Przed pierwszym użyciem wykonaj próbę uczuleniową na małym odcinku skóry. W przypadku aktywnego trądziku skonsultuj się z lekarzem. W trakcie stosowania mnie unikaj długiej ekspozycji na słońce. Pamiętaj, aby w ciągu dnia używać produktów z wysoką ochroną przeciwsłoneczną – dzięki nim Twoja skóra będzie bezpieczna i zachowa młody wygląd na dłuuugo!\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nWiem, jak niesforna potrafi być czasami Twoja skóra i dlatego zostałem stworzony, aby przywrócić jej naturalną równowagę i świeżość. Moja specjalistyczna receptura zawierająca mix kwasów AHA, BHA i PHA rozjaśnia powierzchniowe przebarwienia posłoneczne i potrądzikowe. Pomogę Ci oczyścić skórę z zaskórników, wyreguluję produkcję sebum, które jest jedną z przyczyn powstawania niedoskonałości. Przy regularnym stosowaniu mnie Twoja skóra będzie widocznie gładsza i dogłębnie oczyszczona.\r\n\r\n\r\nHey #FaceBoomGirl, dzięki mojemu wnętrzu mam już spore grono fanów*:\r\n\r\n94% osób deklaruje, że odczuwalnie wygładzam skórę**\r\n86% osób deklaruje, że zmniejszam świecenie się skóry**\r\n78% osób deklaruje, że wyrównuje koloryt skóry**\r\n96% osób deklaruje, że złuszczam naskórek.\r\n* Przeprowadzono na grupie 100 osób.\r\n\r\n**Skuteczność potwierdzona także w badaniach aparaturowych.\r\n\r\nODKRYJ MOJE WNĘTRZE\r\nKwas salicylowy (bha) - wpływa korzystanie na regulację sebum, działa przeciwzaskórnikowo. Redukuje wypryski i niedoskonałości.\r\nKwas cytrynowy (aha) - rozjaśnia przebarwienia potrądzikowe i posłoneczne. Wyrównuje koloryt i dodaje skórze blask.\r\nKwas mlekowy (aha) -  rozjaśnia przebarwienia, zwęża pory i może opóźniać procesy starzenia.\r\nKwas glikolowy (aha) - złuszcza naskórek, nawilża, przyspiesza regenerację, odczuwalnie zmiękcza i wygładza naskórek.\r\nGlukonolakton (pha) -  redukuje zmiany potrądzikowe i niedoskonałości, zapobiega powstawaniu zaskórników. Silnie nawilża i chroni przed utratą wody\r\nTrehaloza -  Wykazuje właściwości przeciwutleniające, chroni przed szkodliwymi czynnikami zewnętrznymi. ', 10, 999),
(60, 36, 'FaceBoom Seboom Udoskonalające serum z korygującym pigmentem', '31.99', 'Jestem naturalnym (98% składników pochodzenia naturalnego wg normy ISO 16128), udoskonalającym serum z korygującym pigmentem. Zostałem stworzony z myślą o cerze tłustej, mieszanej i problematycznej, która wymaga pielęgnacji dopasowanej do jej humorów i zachcianek.\r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych.  Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJAK MNIE STOSOWAĆ?\r\nNałóż na skórę twarzy swój ulubiony krem od FaceBoom, odczekaj aż się wchłonie, a następnie nałóż mnie. W momencie kontaktu ze skórą dzięki specjalnej formule zmienię odcień z zielonego na beżowy i wtopię się w Twoją skórę. Możesz pozostawić mnie samego na twarzy dla delikatnego efektu lub nałożyć makijaż. Jeśli chcesz, stosuj mnie na pojedyncze niedoskonałości.\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nWiem, jak niesforna potrafi być czasami Twoja skóra i dlatego zostałem stworzony, aby przywrócić jej naturalną równowagę i świeżość. Dzięki mnie zaczerwienienia stają się mniej widoczne, nierówny koloryt zostaje wyrównany. Moja lekka formuła w kolorze zielonym, w kontakcie ze skórą zmienia się w delikatny beżowy odcień.\r\nODKRYJ MOJE WNĘTRZE\r\nNiacynamid - Wspiera skórę w walce z niedoskonałościami, zauważalnie ujednolica koloryt skóry.\r\nOlej tamanu - Skutecznie odżywia skórę i poprawia koloryt cery, nie obciążając jej.\r\nKorygujące mikrokapsułki - Sprawiają, że koloryt skóry jest wyrównany, delikatnie kryją przebarwienia i niedoskonałości.', 10, 999),
(61, 30, 'FaceBoom Seboom Matująco-normalizująca woda micelarna', '26.99', 'Jestem matująco-normalizującą wodą micelarną, stworzoną dla skóry tłustej, mieszanej i problematycznej, która wymaga pielęgnacji dopasowanej do jej humorów i zachcianek. \r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych.  Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJAK MNIE STOSOWAĆ?\r\n\r\nNanieś mnie na płatek kosmetyczny i przemyj twarz, oczy i szyję. Powtarzaj, aż do uzyskania czystego płatka kosmetycznego, a następnie przemyj twarz wodą w celu dodatkowego odświeżenia. Stosuj mnie rano i wieczorem.\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nWiem, jak niesforna potrafi być czasami Twoja skóra i dlatego zostałam stworzona, aby przywrócić jej naturalną równowagę i świeżość. Nie podrażniam i mogę być stosowana do demakijażu oczu. Oczyszczam cerę z zanieczyszczeń powstałych po całym dniu. Dodatkowo odświeżam i przygotowuję ją do dalszych etapów pielęgnacji\r\n\r\nODKRYJ MOJE WNĘTRZE\r\nNiacynamid - Wspiera skórę problematyczną i tłustą w walce z niedoskonałościami.\r\nKombucha - Sfermentowany napój z czarnej herbaty, bogaty w kwasy organiczne i witaminy jest prawdziwą bombą energii dla skóry.\r\nWoda Cytrynowa - Tonizuje, odświeża cerę, posiada właściwości delikatnie ściągające.\r\nEkstrakt z trawy cytrynowej - Wykazuje właściwości odświeżające i zmniejsza widoczność porów. ', 10, 999),
(62, 40, 'FaceBoom Seboom Matująco-normalizująca maseczka do twarzy', '21.99', 'Jestem matująco-normalizującą maseczką stworzoną dla skóry, która wymaga pielęgnacji dopasowanej do jej humorów i zachcianek. \r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych.  Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJAK MNIE STOSOWAĆ?\r\n\r\nOczyść skórę i osusz ją ręcznikiem. Nałóż mnie na skórę twarzy, szyi i dekoltu, po 10 minutach zmyj letnią wodą.\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nWiem, jak niesforna potrafi być czasami Twoja skóra i dlatego zostałam stworzona, aby przywrócić jej naturalną równowagę i świeżość. Oczyszczam z nadmiaru sebum i codziennych zanieczyszczeń. Przy regularnym stosowaniu mnie 2 razy w tygodniu poprawię ogólny wygląd i kondycję Twojej skóry, a dodatkowo zadbam o jej mikrobiom.\r\n\r\n\r\nHey #FaceBoomGirl, dzięki mojemu wnętrzu mam już spore grono fanów*:\r\n\r\n100% osób deklaruje, że oczyszczam skórę z nadmiaru sebum*\r\n95% osób deklaruje, że matuję skórę*\r\n90% osób deklaruje, że reguluję wydzielanie sebum*\r\n* Badania przeprowadzono na grupie 100 osób.\r\nODKRYJ MOJE WNĘTRZE\r\nGlukonolakton - redukuje zmiany potrądzikowe i niedoskonałości, zapobiega powstawaniu zaskórników. Silnie nawilża i chroni przed utratą wody.\r\nTlenek cynku - przyspiesza proces regeneracji skóry i wykazuje działanie ściągające.\r\nKombucha - Sfermentowany napój z czarnej herbaty, bogaty w kwasy organiczne i witaminy jest prawdziwą bombą energii dla skóry.\r\nEkstrakt z trawy cytrynowej - Wykazuje właściwości odświeżające i zmniejsza widoczność porów. ', 10, 999),
(63, 28, 'FaceBoom Seboom Matująco-normalizujący żel do mycia twarzy', '28.99', 'Jestem naturalnym (98% składników pochodzenia naturalnego wg normy ISO 16128), matująco-normalizującym żelem do mycia twarzy stworzonym dla skóry tłustej, mieszanej i problematycznej, która wymaga pielęgnacji dopasowanej do jej humorów i zachcianek.\r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych.  Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJAK MNIE STOSOWAĆ?\r\nNałóż mnie na zwilżoną wodą skórę twarzy, omijając okolice oczu, a następnie dokładnie spłucz. Stosuj mnie w codziennej pielęgnacji rano i wieczorem.\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nWiem, jak niesforna potrafi być czasami Twoja skóra i dlatego zostałem stworzony, aby przywrócić jej naturalną równowagę i świeżość. Delikatnie i skutecznie oczyszczam skórę twarzy z zanieczyszczeń i pozostałości makijażu. Wspieram codzienną walkę z niedoskonałościami i nadmiernym przetłuszczaniem.\r\n\r\nODKRYJ MOJE WNĘTRZE\r\nWoda cytrusowa - tonizuje, odświeża cerę, posiada właściwości delikatnie ściągające i normalizujące.\r\nBetaina - skutecznie nawilża odwodnioną skórę i łagodzi zaczerwienienia.\r\nKwas salicylowy (bha) wpływa korzystanie na regulację sebum, działa przeciwzaskórnikowo.', 10, 999),
(64, 106, 'FaceBoom Seboom Normalizujący tonik w żelu do twarzy', '21.99', 'Jestem naturalnym (98% składników pochodzenia naturalnego wg normy ISO 16128), normalizującym tonikiem w żelu stworzonym dla skóry tłustej, mieszanej i problematycznej, która wymaga pielęgnacji dopasowanej do jej humorów i zachcianek.\r\n\r\nP.S. Tak samo jak Ty, nie lubię SLS, PEG-ów, parabenów i olei mineralnych.  Kocham za to zwierzęta, naturalne składy, dbam o środowisko, a do tego pochodzę z Polski!\r\n\r\nJAK MNIE STOSOWAĆ?\r\nOczyść skórę i osusz ją ręcznikiem. Nałóż tonik w żelu na dłoń, a następnie rozprowadź lub delikatnie wklep w skórę twarzy i szyi. Pozostaw do całkowitego wchłonięcia.\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nWykazuję działanie tonizujące i odświeżające oraz pozostawiam Twoją skórę nawilżoną. Dodatkowo zawarte we mnie składniki aktywne, takie jak probiotyki i prebiotyki dbają o mikrobiom skóry. Moja żelowa konsystencja błyskawicznie się wchłania, a nakładając mnie jesteś bardziej #lesswaste, bo nie potrzebuję wacików kosmetycznych. Nie martw się, nie ucieknę z Twojej dłoni.\r\n\r\nODKRYJ MOJE WNĘTRZE\r\nPrebiotyki i probiotyki - Dbają o mikrobiom skóry i zwiększają odporność na czynniki zewnętrzne. \r\nEkstrakt z trawy cytrynowej - Wykazuje właściwości odświeżające i zmniejsza widoczność porów. ', 10, 999),
(65, 34, 'FaceBoom Seboom Normalizująco-oczyszczające chusteczki do demakijażu', '17.99', 'Jesteśmy naturalnymi (99% składników pochodzenia naturalnego wg normy ISO 16128) normalizująco-oczyszczającymi chusteczkami do demakijażu na wegańskiej receptury, które skutecznie i szybko usuwają nawet wodoodporny makijaż twarzy, oczu i ust. \r\n\r\nJAK NAS STOSOWAĆ?\r\nDelikatnie oczyść skórę twarzy, oczu i ust z pomocą jednej z nas. Jesteśmy super nasączone - nie musisz mocno pocierać swojej skóry. W razie dostania się płynu do oczu, przemyj je wodą. Szczelnie zamknij nasze opakowanie po zastosowaniu, aby zapobiec naszemu wysychaniu. Po wykonanym demakijażu wyrzuć jedną z nas do kosza.\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nNasza formuła zawierająca wodę termalną działa odświeżająco i normalizująco na skórę, jednocześnie dogłębnie oczyszczając naskórek. W naszej recepturze znajdziesz składniki, które idealnie nadają się dla cery tłustej, mieszanej i problematycznej. Jesteśmy delikatne i nie wymagamy mocnego pocierania podczas demakijażu.\r\n\r\nWegański skład\r\nEkstrakt z czarnej herbaty - sfermentowany napój z czarnej herbaty, bogaty w kwasy organiczne i witaminy jest prawdziwą bombą energii dla skóry.\r\nHydrolat z zielonej herbaty - odświeża skórę, posiada właściwości delikatnie ściągające i normalizujące.\r\nNiacynamid - wspiera skórę problematyczną i tłustą w walce z niedoskonałościami.', 10, 999),
(66, 34, 'FaceBoom Seboom Oczyszczające plastry-kwiatki na niedoskonałości i wypryski', '26.99', 'Jesteśmy hydrokoloidowymi, oczyszczającymi plastrami na niedoskonałości i wypryski o kształcie słodkich, zielonych kwiatków. Stworzono nas z myślą o cerze tłustej, mieszanej i problematycznej, która wymaga pielęgnacji dopasowanej do jej humorów i zachcianek.\r\nJAK NAS STOSOWAĆ?\r\nDokładnie oczyść obszar skóry na który mam być zaaplikowany. Czystymi i suchymi rękoma naklej mnie na problematyczne miejsce na ok 6-8 godzin. Najlepiej stosuj mnie na noc, a rano ciesz się piękna skórą. Możesz również przykleić mnie w ciągu dnia, mój kształt może być słodkim uzupełnieniem Twojego makijażu!\r\n\r\nCO MOGĘ CI ZAOFEROWAĆ?\r\nWiemy, jak niesforna potrafi być czasami Twoja skóra i jesteśmy po to, aby przywrócić jej naturalną równowagę i świeżość. Nasza formuła oparta w 100% na wegańskich składnikach sprawia, że przyspieszamy regenerację niedoskonałości. Dzięki nam pryszczenie i niedoskonałości znikają dużo szybciej. Chronimy wypryski przed zabrudzeniami, niepotrzebnym dotykaniem i czynnikami zewnętrznymi. Wchłaniamy nadmiar sebum i zanieczyszczenia.  Dodatkowo wyglądamy mega słodko i kolorowo, więc spokojnie możesz naklejać nas w ciągu dnia. Możemy być dodatkiem do Twojego makijażu!\r\nODKRYJ MOJE WNĘTRZE\r\nOlejek z drzewa herbacianego - bardzo dobrze oczyszcza skórę, wykazuje działanie antybakteryjne, delikatne ściąga pory, działa regenerująco i normalizuje wydzielanie sebum. \r\nOlej z trawy cytrynowej - sprzymierzeniec skóry problematycznej, wspiera ją w walce z niedoskonałościami i wypryskami, wpływa korzystanie na regulacje sebum.', 10, 999),
(81, 44, 'Peel Your Lips Cherry Lip Scrub - Peeling do ust o zapachu wiśni', '29.99', 'Peeling Mexmo by AndziaThere jest na bazie cukru. \r\n\r\nZawiera olej z nasion słonecznika, olej roślinny, wosk pszczeli, olej rycynowy, masło shea, olej że słodkich migdałów, olej makadamia i witaminę E. \r\n\r\nW połączeniu z balsamem Mexmo by AndziaThere Fix Your Lips zadba o skórę ust w sezonie jesienno zimowym, gdy są one narażone na pękanie i wysuszenie.', 11, 999),
(82, 41, 'Fix Your Lips - Cherry Lip Balm - Balsam do ust o zapachu wiśni', '29.99', 'Balsam do ust Mexmo by AndziaThere Fix Your Lips o zapachu wiśniowym jest lekki, nie daje uczucia obciążenia ust i nie klei się. Wspaniale regeneruje spierzchnięte usta i chroni przed zimnem i wysuszeniem. \r\n\r\nZawiera masło shea, wosk pszczeli, olej makadamia, olej ze słodkich migdałów, olej z ziaren soi, olej ze słonecznika, olej roślinny, wosk karnauba i witaminę e.\r\n\r\nW połączeniu z peelingiem Mexmo by AndziaThere Peel Your Lips zadba o skórę ust w sezonie jesienno zimowym, gdy są one narażone na pękanie i wysuszenie.', 11, 999),
(83, 44, 'Peel Your Lips - Raspberry Lip Scrub - Peeling do ust o zapachu maliny', '29.99', 'Peeling Mexmo by AndziaThere jest na bazie cukru. \r\n\r\nZawiera olej z nasion słonecznika, olej roślinny, wosk pszczeli, olej rycynowy, masło shea, olej że słodkich migdałów, olej makadamia i witaminę E. \r\n\r\nW połączeniu z balsamem Mexmo by AndziaThere Fix Your Lips zadba o skórę ust w sezonie jesienno zimowym, gdy są one narażone na pękanie i wysuszenie.', 11, 999),
(84, 41, 'Fix Your Lips - Raspberry Lip Balm - Balsam do ust o zapachu malinowym', '29.99', 'Balsam do ust Mexmo by AndziaThere Fix Your Lips o zapachu malinowym jest lekki, nie daje uczucia obciążenia ust i nie klei się. Wspaniale regeneruje spierzchnięte usta i chroni przed zimnem i wysuszeniem. \r\n\r\nZawiera masło shea, wosk pszczeli, olej makadamia, olej ze słodkich migdałów, olej z ziaren soi, olej ze słonecznika, olej roślinny, wosk karnauba i witaminę e.\r\n\r\nW połączeniu z peelingiem Mexmo by AndziaThere Peel Your Lips zadba o skórę ust w sezonie jesienno zimowym, gdy są one narażone na pękanie i wysuszenie.', 11, 999),
(85, 109, 'HAIRY TALE COSMETICS Nutty co-wash orzechowy krem myjący do suchej skóry głowy', '49.99', 'Nutty co-wash idealnie sprawdzi się w oczyszczaniu suchej i wrażliwej skóry głowy. Dzięki zawartości olejów: abisyńskiego i z orzechów włoskich doskonale współgra z lekką odżywką emolientową do włosów wysokoporowatych Flylight! Ekstrakt z orzechów włoskich działa kojąco i regulująco, a ksylitol i jego pochodne dodatkowo nawilżają. Co-wash Nutty to świetny wybór dla osób, które potrzebują uczucia oczyszczenia skóry głowy, ale jednocześnie mają wrażliwą skórę. Połączyliśmy w nim zarówno detergenty niejonowe (bardzo łagodne), jak i anionowe (mocniejsze).\r\n\r\nPrzyjemny aromat masła orzechowego zwiększy Twój apetyt na włosing.\r\n\r\nNasze kosmetyki są biodegradowalne, co oznacza, iż nie zanieczyszczają środowiska. Są bezpieczne dla dróg wodnych, zwierząt i roślin.\r\n\r\nSposób użycia: Wstrząśnij przed użyciem! Niewielką ilość produktu nanieś na skórę głowy i włosy lub rozmieszaj niewielką porcję z wodą i spień. Masuj skórę głowy, wytworzoną pianę nanieś na resztę włosów. Dokładnie spłucz wodą. W razie potrzeby powtórz czynności.\r\n\r\nSkładniki: Aqua, Decyl Glucoside, Sodium Cocoyl Isethionate, Disodium 2-Sulfolaurate, Propanediol, Coco Glucoside, Glyceryl Oleate, Cetyl Alcohol, Polyglyceryl-4 Pelargonate, Cetearyl Alcohol, Crambe Abyssinica Seed Oil, Juglans Regia (Walnut) Seed Oil, Juglans Regia (Walnut) Shell Extract, Moringa Oil/Hydrogenated Moringa Oil Esters, Helianthus Annuus (Sunﬂower) Seed Oil, Laurdimonium Hydroxypropyl Hydrolyzed Wheat Protein, Inulin Lauryl Carbamate, Xylitylglucoside, Anhydroxylitol, Xylitol, Glucose, Xanthan Gum, Hydroxypropyl Guar, Glycerin, Tocopheryl Acetate, Citric Acid, Sodium Benzoate, Phenoxyethanol, Potassium Sorbate, Sodium Levulinate, Trisodium Ethylenediamine Disuccinate, Benzyl Benzoate, Parfum.\r\n\r\nPrzechowuj w temperaturze od 10 ºC do 25 ºC.\r\n\r\nWyprodukowano w Polsce\r\n\r\nPojemność: 200 ml', 12, 999),
(86, 1, 'HAIRY TALE COSMETICS Murky Kojący szampon do przetłuszczającej się skóry głowy', '59.99', 'Kojący szampon MURKY zawiera ekstrakt z piołunu, pochodną kwasu glicyretynowego z lukrecji oraz azeloglicynę. Dodatkowo zawiera argininę, niacynamid, ekstrakt z drożdży oraz biotynę. Receptura została opracowana z myślą o łagodnym oczyszczeniu i uregulowaniu pracy gruczołów łojowych problematycznej skóry oraz zniwelowaniu tendencji do przesuszenia, swędzenia i podrażnień.\r\n\r\nSzampon Murky ma potwierdzone badaniami działanie przeciwdrobnoustrojowe w kierunku Malassezia Furfur – działa przeciwłupieżowo, kojąco i regulująco.\r\n\r\nPrzyjemny aromat cedru oraz zielonej herbaty ukoi również Twoje zmysły i wprowadzi w stan relaksu.\r\n\r\nWypróbuj w duecie z emulsją myjącą z linii Murky!\r\n\r\nSzampon Murky ma bardzo gęstą konsystencję, dlatego rozwadniaj go i spieniaj, a posłuży Ci dłużej, niż myślisz ♥\r\n\r\nZawiera wyłącznie łagodne substancje myjące.\r\n\r\nNasze kosmetyki są biodegradowalne, co oznacza, iż nie zanieczyszczają środowiska. Są bezpieczne dla dróg wodnych, zwierząt i roślin.\r\n\r\nSposób użycia: Niewielką ilość produktu nanieś na skórę głowy i włosy lub rozmieszaj niewielką porcję z wodą i spień. Masuj skórę głowy, wytworzoną pianę nanieś na resztę włosów. Dokładnie spłucz wodą. W razie potrzeby powtórz czynności.\r\n\r\nSkładniki: Aqua, Decyl Glucoside, Glycerin, Babassu Oil Polyglyceryl-4 Esters, Panthenol, Coco-Glucoside, Glyceryl Oleate, Potassium Azeloyl Diglycinate, Artemisia Absinthium Extract, Arginine, Niacinamide, Threonine, Biotin, Ammonium Glycyrrhizate, Inulin, Calcium Pantothenate, Faex Extract, Mannitol, Cellulose, Glucose, Fructose, Allantoin, Sodium Levulinate, Lactic Acid, Cellulose Gum, Trisodium Ethylenediamine Disuccinate, Potassium Sorbate, Citric Acid, Xanthan Gum, Tocopherol, Sodium Metabisulfite, Hydrogenated Vegetable Glycerides Citrate, Butylene Glycol, Parfum, Limonene, Linalool.\r\n\r\nWyprodukowano w Polsce\r\n\r\nPojemność: 250 ml', 12, 999),
(87, 1, 'HAIRY TALE COSMETICS Squeaky Clean Łagodny szampon chelatujący do mycia w twardej wodzie', '59.99', 'Chelatujący szampon do oczyszczania włosów i skóry głowy SQUEAKY CLEAN zawiera ekstrakt z aceroli oraz kompleks kwasów AHA: mlekowy, glikolowy, winowy, jabłkowy, winogronowy oraz żurawinowy. Wzbogacony dodatkiem naturalnego chelatora Trisodium Ethylenediamine Disuccinate doskonale oczyści skórę i włosy z wszelkiej nadbudowy minerałów i osadzonych pozostałości innych kosmetyków.\r\n\r\nDzięki temu pasma staną się o wiele bardziej podatne na kondycjonujące działanie masek. Świetnie sprawdzi się przed hennowaniem, a jego regularne stosowanie pomoże przeciwdziałać jej ciemnieniu. Do szamponu dodaliśmy także sporo nawilżaczy, takich jak arginina, gliceryna, panthenol, czy też glukoza, które równoważą działanie kwasów i ekstraktów, chroniąc wrażliwą skórę głowy.\r\n\r\nOrzeźwiający aromat cytrusów doda Ci energii, a każdy kolejny włosing będzie czystą przyjemnością!\r\n\r\nSzampon Squeaky Clean został obdarzony przyjemną, miodową konsystencją, dlatego rozwadniaj go i spieniaj, a posłuży Ci dłużej, niż myślisz ♥\r\n\r\nZawiera wyłącznie łagodne substancje myjące.\r\n\r\nNasze kosmetyki są biodegradowalne, co oznacza, iż nie zanieczyszczają środowiska. Są bezpieczne dla dróg wodnych, zwierząt i roślin.\r\n\r\nSposób użycia: Niewielką ilość produktu nanieś na skórę głowy i włosy lub rozmieszaj niewielką porcję z wodą i spień. Masuj skórę głowy, wytworzoną pianę nanieś na resztę włosów. Dokładnie spłucz wodą. W razie potrzeby powtórz czynności.\r\n\r\nSkładniki: Aqua, Decyl Glucoside, Glycerin, Babassu Oil Polyglyceryl-4 Esters, Panthenol, Maltodextrin, Coco-Glucoside, Glyceryl Oleate, Malpighia Glabra Fruit Extract, Arginine PCA, Saccharum Officinarum Extract, Pyrus Malus Fruit Extract, Vitis Vinifera Leaf Extract, Vaccinium Myrtillus Leaf Extract, Citrus Limon Fruit Extract, Cellulose Gum, Citric Acid, Sodium Levulinate, Lactic Acid, Glycolic Acid, Trisodium Ethylenediamine Disuccinate, Potassium Sorbate, Xanthan Gum, Inulin, Cellulose, Glucose, Fructose, Tartaric Acid, Malic Acid, Tocopherol, Hydrogenated Vegetable Glycerides Citrate, Propylene Glycol, Parfum, Limonene.\r\n\r\nWyprodukowano w Polsce\r\n\r\nPojemność: 250 ml', 12, 999),
(88, 109, 'HAIRY TALE COSMETICS Murky Kojąca emulsja myjąca do przetłuszczającej się skóry głowy', '59.99', 'Kojąca emulsja do mycia MURKY zawiera olej z czarnuszki, ekstrakt z piołunu, pochodną kwasu glicyretynowego z lukrecji oraz azeloglicynę. Dodatkowo zawiera argininę, niacynamid, ekstrakt z drożdży oraz biotynę. Receptura została opracowana z myślą o łagodnym oczyszczeniu i uregulowaniu pracy gruczołów łojowych problematycznej skóry oraz zniwelowaniu tendencji do przesuszenia, swędzenia i podrażnień.\r\n\r\nEmulsja Murky ma potwierdzone badaniami działanie przeciwdrobnoustrojowe w kierunku Malassezia Furfur – działa przeciwłupieżowo, kojąco i regulująco.\r\n\r\nPrzyjemny aromat cedru oraz zielonej herbaty ukoi również Twoje zmysły i wprowadzi w stan relaksu.\r\n\r\nWypróbuj w duecie z szamponem z linii Murky, jeśli zależy Ci na podwójnym działaniu składników odżywczych!\r\n\r\nZawiera wyłącznie łagodne substancje myjące.\r\n\r\nNasze kosmetyki są biodegradowalne, co oznacza, iż nie zanieczyszczają środowiska. Są bezpieczne dla dróg wodnych, zwierząt i roślin.\r\n\r\nSposób użycia: Niewielką ilość produktu nanieś na skórę głowy i włosy lub rozmieszaj niewielką porcję z wodą i spień. Masuj skórę głowy, wytworzoną pianę nanieś na resztę włosów. Dokładnie spłucz wodą. W razie potrzeby powtórz czynności.\r\n\r\nPrzed użyciem mocno wstrząśnij!\r\n\r\nZ uwagi na wysoką zawartość oleju z czarnuszki nasz co-wash może się rozwarstwiać. Nie wpływa to na jego właściwości i działanie.\r\n\r\nSkładniki: Aqua, Decyl Glucoside, Glycerin, Cetearyl Alcohol, Babassu Oil Polyglyceryl-4 Esters, Panthenol, Hydrogenated Sunflower Seed Oil Polyglyceryl-3 Esters, Nigella Sativa Seed Oil, Potassium Azeloyl Diglycinate, Artemisia Absinthium Extract, Arginine, Niacinamide, Threonine, Biotin, Ammonium Glycyrrhizate, Inulin, Calcium Pantothenate, Faex Extract, Mannitol, Cellulose, Glucose, Fructose, Allantoin, Sodium Levulinate, Hydrogenated Sunflower Seed Oil Glyceryl Esters, Lactic Acid, Coco-Glucoside, Glyceryl Oleate, Sodium Stearoyl Lactylate, Tocopheryl Acetate, Cellulose Gum, Trisodium Ethylenediamine Disuccinate, Potassium Sorbate, Citric Acid, Xanthan Gum, Sodium Metabisulfite, Tocopherol, Hydrogenated Vegetable Glycerides Citrate, Butylene Glycol, Parfum, Linalool, Limonene.\r\n\r\nWyprodukowano w Polsce\r\n\r\nPojemność: 250 ml', 12, 999),
(89, 109, 'HAIRY TALE COSMETICS Fluffy Nawilżający krem myjący do suchej i wrażliwej skóry głowy', '59.99', 'Krem do mycia skóry i włosów FLUFFY zawiera odżywczy olej z ziaren owsa oraz masło shea. Jego receptura została stworzona specjalnie z myślą o łagodnym myciu kruchych, odwodnionych włosów oraz wrażliwej, skłonnej do przesuszania się skóry głowy. \r\nDodatek protein owsianych dodaje włosom lekkości oraz równoważy działanie emolientów zawartych w kremie.\r\n\r\nPrzyjemny, słodki aromat brzoskwini i mango przeniesie Cię w bajkowy nastrój!\r\n\r\nZawiera wyłącznie łagodne substancje myjące.\r\n\r\nMożna stosować od 1. miesiąca życia!\r\n\r\nNasze kosmetyki są biodegradowalne, co oznacza, iż nie zanieczyszczają środowiska. Są bezpieczne dla dróg wodnych, zwierząt i roślin.\r\n\r\nWstrząśnij przed użyciem!\r\n\r\nSposób użycia: Niewielką ilość produktu nanieś na skórę głowy i włosy lub rozmieszaj niewielką porcję z wodą i spień. Masuj skórę głowy, wytworzoną pianę nanieś na resztę włosów. Dokładnie spłucz wodą. W razie potrzeby powtórz czynności.\r\n\r\nSkładniki: Aqua, Decyl Glucoside, Glycerin, Babassu Oil Polyglyceryl-4 Esters, Panthenol, Cetearyl Alcohol, Hydrogenated Sunflower Seed Oil Polyglyceryl-3 Esters, Avena Sativa Kernel Oil, Butyrospermum Parkii Butter, Arginine PCA, Hydrolyzed Oat Protein, Inulin, Glucose, Fructose, Hydrogenated Sunflower Seed Oil Glyceryl Esters, Lactic Acid, Coco-Glucoside, Glyceryl Oleate, Sodium Stearoyl Lactylate, Tocopheryl Acetate, Sodium Levulinate, Cellulose Gum, Trisodium Ethylenediamine Disuccinate, Potassium Sorbate, Citric Acid, Xanthan Gum, Cellulose, Tocopherol, Hydrogenated Vegetable Glycerides Citrate, Parfum, Citronellol, Geraniol.\r\n\r\nWyprodukowano w Polsce\r\n\r\nPojemność: 250 ml', 12, 999),
(90, 1, 'HAIRY TALE COSMETICS Dragon Wash Oczyszczający szampon', '59.99', 'Oczyszczający szampon Dragon Wash oparty został na delikatnym surfaktancie anionowym: Sodium Lauroyl Lactylate. Dodatkowo zawiera ramnolipidy – glikolipidy wytwarzane przez bakterie Pseudomonas aeruginosa, stanowiące biosurfaktanty, czyli naturalne składniki myjące o działaniu oczyszczającym, ekstrakt z koniczyny czerwonej oraz kojące składniki aktywne.\r\n\r\nNajważniejszym składnikiem działającym na skórę głowy jest surowiec Saniscalp®. To oparty na glikolu roślinnym składnik aktywny powstały w procesie enzymatycznej biokonwersji nasion marakui, pochodzących z przemysłu spożywczego. Chroni oraz poprawia kondycję i komfort skóry głowy.\r\n\r\nSzampon Dragon Wash ma potwierdzone badaniami działanie przeciwdrobnoustrojowe w kierunku Malassezia furfur – działa przeciwłupieżowo, kojąco i regulująco.\r\n\r\nProdukt przeznaczony jest do skutecznego oczyszczenia włosów z nadbudowy kosmetyków, minerałów lub do nadania objętości.\r\nEgzotyczny zapach przeniesie Cię na rajską wyspę podczas każdego mycia głowy.\r\n\r\nSzampon Dragon Wash ma lekką, doskonale pieniącą się konsystencję, dlatego rozwadniaj go i spieniaj, a posłuży Ci dłużej, niż myślisz ♥\r\n\r\nNasze kosmetyki są biodegradowalne, co oznacza, iż nie zanieczyszczają środowiska. Są bezpieczne dla dróg wodnych, zwierząt i roślin.\r\n\r\nSposób użycia: Niewielką ilość produktu nanieś na skórę głowy i włosy lub rozmieszaj niewielką porcję z wodą i spień. Masuj skórę głowy, wytworzoną pianę nanieś na resztę włosów. Dokładnie spłucz wodą. W razie potrzeby powtórz czynności.\r\n\r\nSkładniki: Aqua, Decyl Glucoside, Citric Acid, Glyceryl Oleate, Coco-Glucoside, Disodium Coco-Glucoside Citrate, Lauryl Glucoside, Sodium Lauroyl Lactylate, Panthenol, Trifolium Pratense (Clover) Flower Extract, Botrytis Cinerea/Passiflora Edulis Fruit Extract/Piceatannol Ferment Lysate Filtrate, Rhamnolipids, Tocopherol, Isopentyldiol, Hydrogenated Vegetable Glycerides Citrate, Maltodextrin, Biosaccharide Gum-1, Propanediol, Sodium Levulinate, Potassium Sorbate, Sorbitan Caprylate, Sodium Benzoate, Trisodium Ethylenediamine Disuccinate, Parfum, Limonene, Linalool.\r\n\r\nWyprodukowano w Polsce\r\n\r\nPojemność: 250 ml', 12, 999),
(91, 6, 'HAIRY TALE COSMETICS Wasabi Scrub myjący', '69.99', 'Nasz scrub myjący Wasabi delikatnie, ale skutecznie oczyszcza skórę głowy. Zawarte w nim drobinki ścierne to estry jojoba w formie kuleczek, które nie drapią i nie narażają skóry na mikrouszkodzenia. Unikalna forma aksamitnej pasty myjącej to połączenie różnej mocy surfaktantów, emolientów i emulgatorów. Za dodatkowe działanie stymulujące skórę głowy odpowiada najwyższej jakości, unikalny ekstrakt z wasabi. Masło i olej moringa, rozpuszczalne w wodzie oleje: słonecznikowy i ryżowy oraz bisabolol działają łagodząco i wzmacniają skórę głowy.\r\nWypróbuj scrub myjący Wasabi z wcierkami Hairy Tale, jeśli zależy Ci na jeszcze lepszym działaniu i zdrowej skórze głowy!\r\n\r\nNasze kosmetyki są biodegradowalne, co oznacza, iż nie zanieczyszczają środowiska. Są bezpieczne dla dróg wodnych, zwierząt i roślin.\r\n\r\nSposób użycia: nanieś niewielką porcję produktu na wilgotną skórę głowy. Delikatnie wmasuj, a następnie dodaj jeszcze trochę wody i wykonaj ponownie delikatny masaż skóry. Powstałą pianę możesz delikatnie rozprowadzić po długości włosów. W razie potrzeby użyj jednego z naszych szamponów jako drugie mycie, choć nie jest to konieczne! Nasza aksamitna pasta bazowa łączy kilka różnej mocy surfaktantów z emulgatorami, które razem efektywnie domywają. Dokładnie spłucz i nałóż odżywkę. Używaj raz w tygodniu.\r\n\r\nSkładniki: Aqua, Disodium 2-Sulfolaurate, Jojoba Esters, Sodium Cocoyl Isethionate, Cetyl Alcohol, Coco Glucoside, Glyceryl Oleate, Cetyl Palmitate, Rice Oil Glycereth-8 Esters, Tocopheryl Acetate, Moringa Oil/Hydrogenated Moringa Oil Esters, Wasabia Japonica Root Extract, Hydrogenated Sunflower Seed Oil Polyglyceryl-3 Esters, Hydrogenated Sunflower Seed Oil Glyceryl Esters, Cetearyl Alcohol, Sodium Stearoyl Lactylate, Bisabolol, Maltodextrin, Biosaccharide Gum-1, Lactic Acid, Trisodium Ethylenediamine Disuccinate, Sodium Levulinate, Potassium Sorbate, Sodium Benzoate, Citric Acid, Parfum.\r\n\r\nWyprodukowano w Polsce\r\n\r\nPojemność: 150 ml', 12, 999),
(92, 6, 'HAIRY TALE COSMETICS Murky Regulujący peeling do skóry głowy', '75.99', 'Nasz delikatny peeling regulujący Murky oczyszcza i uspokaja skórę głowy skłonną do przetłuszczania i łupieżu. Zawiera regulującą azeloglicynę, a także korzystny dla skóry ekstrakt z piołunu i drożdży.\r\n\r\nAzeloglicyna dzięki swoim unikatowym właściwościom doskonale reguluje wydzielanie sebum i funkcjonowanie skóry, nie podrażniając jej. Działa korzystnie przy problemie łupieżu. Właściwości regulujące podbija ekstrakt z piołunu, niacynamid i ekstrakt z drożdży. Wspierająco i nawilżająco zadziała gliceryna, kwas glicyryzynowy z lukrecji, arginina, mannitol, treonina i biotyna. Za żelową konsystencję odpowiada m.in. guma ksantanowa. Z osadem z twardej wody poradzi sobie naturalny składnik chelatujący: Trisodium Ethylenediamine Disuccinate.\r\n\r\nJeśli masz wrażliwą i problemową skórę głowy, wypróbuj nasz delikatny peeling Murky!\r\n\r\nSposób użycia: niewielką ilość produktu nałóż na suchą skórę głowy przed myciem. Dla ułatwienia, podziel włosy na przedziałki. Delikatnie wmasuj. Pozostaw na 5-10 minut na skórze głowy, a następnie umyj głowę szamponem. Dla zmaksymalizowania regulującego efektu, zastosuj do zmycia szampon lub emulsję myjącą Murky. Stosuj peeling raz w tygodniu.\r\n\r\nSkładniki: Aqua, Potassium Azeloyl Diglycinate, Glycerin, Lactic Acid, Xanthan Gum, Artemisia Absinthium Extract, Ammonium Glycyrrhizinate, Mannitol, Arginine, Niacinamide, Calcium Pantothenate, Feax (Yeast) Extract, Allantoin, Threonine, Biotin, Sodium Levulinate, Potassium Sorbate, Trisodium Ethylenediamine Disuccinate, Butylene Glycol, Parfum, Limonene, Linalool.\r\n\r\nWyprodukowano w Polsce\r\n\r\nPojemność: 150 ml', 12, 999),
(93, 6, 'HAIRY TALE COSMETICS Squeaky Clean Kwasowy peeling do skóry głowy', '75.99', 'Nasz peeling kwasowy Squeaky Clean dokładnie oczyszcza skórę głowy z nagromadzonego naskórka, sebum oraz pozostałości kosmetyków i osadów z twardej wody. Zawiera kwas winowy, mlekowy, glikolowy i szikimowy, zrównoważone ekstraktem z aceroli o wysokiej zawartości antyoksydantów oraz kojącą pochodną inuliny. Pełne spektrum działania, poza złuszczaniem, to również regulowanie procesów odnowy naskórka i wydzielania sebum.\r\n\r\nNa żelową bazę peelingu składa się duet nawilżający: pantenol i arginina. Arginina fantastycznie reguluje proces złuszczania naskórka kwasami, spowalniając i łagodząc ich działanie. Dzięki temu złuszczanie jest skuteczne, ale nie drażniące! Zawarte humektanty: maltodekstryna oraz gliceryna, a także łagodząca pochodna inuliny, zapewniają dodatkową równowagę. Za przyjemną „żelkową” konsystencję odpowiada zarówno również fukożel oraz guma ksantanowa.\r\n\r\nSqueaky Clean to peeling idealny dla osób, u których „żaden peeling nie działa”.\r\n\r\nSposób użycia: niewielką ilość produktu nałóż na suchą skórę głowy przed myciem. Dla ułatwienia, podziel włosy na przedziałki. Delikatnie wmasuj. Pozostaw na 5-10 minut na skórze głowy, a następnie umyj głowę szamponem. Dla zmaksymalizowania użyj łagodnego szamponu chelatującego Squeaky Clean! Stosuj peeling raz w tygodniu.\r\n\r\nSkładniki: Aqua, Panthenol, Arginine PCA, Tartaric Acid, Lactic Acid, Glycolic Acid, Maltodextrine, Shikimic Acid, Citric Acid, Xanthan Gum, Malpighia Glabra Fruit Juice, Glycerin, Inulin Lauryl Carbamate, Biosaccharide Gum-1, Sodium Levulinate, Potassium Sorbate, Trisodium Ethylenediamine Disuccinate, Sodium Hydroxide, Parfum, d-Limonene, Linalool, Citral.\r\n\r\nWyprodukowano w Polsce\r\n\r\nPojemność: 150 ml', 12, 999),
(94, 7, 'HAIRY TALE COSMETICS Grasshopper Wcierka regulująca', '75.99', 'Wcierka Hairy Tale Grasshopper została oparta na bazie wodnej z wysoką zawartością pozyskanego przez nas ekstraktu z drożdży piwnych z przemysłu spożywczego i ekstraktu z chmielu z polskich upraw Można jej używać przy zwiększonym przetłuszczaniu, wypadaniu włosów, jak i przy łuszczeniu się skóry i drobnym łupieżu. Działa regulująco i nawilżająco, bez efektu uczucia ściągnięcia skóry głowy. Tonizuje, czyli przywraca skórze naturalne pH po myciu.\r\n\r\nEkstrakt chmielu, a przede wszystkim zawarta w nim lupulina, wykazuje działanie bakteriobójcze w stosunku do bakterii gram dodatnich i gram ujemnych. Badania prowadzone nad chmielem są niezwykle obiecujące w zakresie hamowania 5α-reduktazy. To znaczy, że może on stanowić oręż w walce z łysieniem androgenowym.\r\n\r\nEkstrakt z drożdży piwnych jest bogatym źródłem aminokwasów o właściwościach nawilżających, a także peptydów i polisacharydów stymulujących i kojących. Są one bogate w witaminy z grupy B: B6, B12, a także cynk, miedź i mangan korzystnym działaniu na skórę.\r\nWcierka Hairy Tale Grasshopper została wzbogacona dodatkami kojącego i nawilżającego polisacharydu pochodzącego m.in. z cykorii (Inulin Lauryl Carbamate), kompleksu nawilżającego w postaci pantenolu, propanediolu oraz gliceryny, a także glukonolaktonu.\r\n\r\nGlukonolakton poprawia nawilżenie skóry głowy i działa antyoksydacyjnie. Normalizuje też wydzielanie sebum, co w połączeniu z chmielem daje przepotężną regulującą moc.\r\nProdukt nie zawiera dodatków zapachowych, ma naturalny aromat zastosowanych w nim surowców.\r\n\r\nOsad na dnie jest zjawiskiem naturalnym.\r\n\r\nNasze kosmetyki są biodegradowalne, co oznacza, iż nie zanieczyszczają środowiska. Są bezpieczne dla dróg wodnych, zwierząt i roślin.\r\n\r\nSposób użycia: Wstrząśnij, a następnie nanieś niewielką porcję produktu na wilgotną skórę głowy po myciu. Delikatnie wmasuj, nie spłukuj. Stosuj po każdym myciu.\r\n\r\nSkładniki:  Aqua, Saccharomyces Cerevisiae, Humulus Lupulus (Hop) Extract, Panthenol, Propanediol, Glycerin, Inulin Lauryl Carbamate, Gluconolactone, Sodium Levulinate, Potassium Sorbate.\r\n\r\nWyprodukowano w Polsce\r\n\r\nPojemność: 100 ml', 12, 999),
(95, 7, 'HAIRY TALE COSMETICS Magic Mushrooms Wcierka odżywcza', '75.99', 'Wcierka Hairy Tale Magic Mushrooms została oparta na bazie wodnej z wysoką zawartością pozyskanego przez nas ekstraktu z grzybów shitake. W połączeniu z kwasem szikimowym działa rewitalizująco. Nawilża, delikatnie złuszcza naskórek i reguluje proces rogowacenia. Nada się zarówno dla suchej, jak i przetłuszczającej się skóry głowy. Tonizuje, czyli przywraca skórze naturalne pH po myciu.\r\n\r\nEkstrakt z grzybów shitake stanowi składnik przewodni wcierki do skóry głowy z uwagi na wysoką zawartość alfa i beta-glukanów oraz innych polisacharydów, a szczególnie bardzo wyjątkowego lentinanu. Lentinan to polisacharyd z grupy β-glukanów, który jest obecnie pod baczną obserwacją z uwagi na potencjalne działanie prozdrowotne. W pielęgnacji opieramy się na jego działaniu antybakteryjnym, szczególnie przeciw Staphylococcus aureus, czyli gronkowcowi złocistemu. Gronkowiec złocisty może powodować stany zapalne na skórze głowy oraz potęgować nieprzyjemne dolegliwości związane z ŁZS (łojotokowym zapaleniem skóry głowy).\r\n\r\nKwas szikimowy należy do grupy kwasów AHA. Działa on antyoksydacyjnie oraz przeciwstarzeniowo na skórę. Składnik ten ogranicza również rogowacenie naskórka, a więc przyczynia się do utrzymania czystych, niezatkanych nadmiarem sebum mieszków włosowych. Kwas szikimowy reguluje również pracę samych gruczołów łojowych, pomagając w ograniczeniu nadmiernego przetłuszczania.\r\n\r\nProdukt nie zawiera dodatków zapachowych, ma naturalny aromat zastosowanych w nim surowców.\r\n\r\nOsad na dnie jest zjawiskiem naturalnym.\r\n\r\nNasze kosmetyki są biodegradowalne, co oznacza, iż nie zanieczyszczają środowiska. Są bezpieczne dla dróg wodnych, zwierząt i roślin.\r\n\r\nSposób użycia: Wstrząśnij, a następnie nanieś niewielką porcję produktu na wilgotną skórę głowy po myciu. Delikatnie wmasuj, nie spłukuj. Stosuj po każdym myciu.\r\n\r\nSkładniki: Aqua, Shikimic Acid, Lentinula Edodes (Shiitake) Extract, Panthenol, Propanediol, Sodium Levulinate, Potassium Sorbate.\r\n\r\nWyprodukowano w Polsce\r\n\r\nPojemność: 100 ml', 12, 999);
INSERT INTO `produkt` (`produkt_id`, `kategoria_id`, `nazwa`, `cena`, `opis`, `marka_id`, `ilosc`) VALUES
(96, 7, 'HAIRY TALE COSMETICS Wasabi Wcierka stymulująca', '75.99', 'Wcierka Hairy Tale Wasabi została oparta na bazie wodnej z zawartością unikalnego, najwyższej jakości ekstraktu z wasabi. Dodatek aminokwasów, niacynamidu oraz ekstraktu z drożdży unosi włosy u nasady i przedłuża świeżość. Wcierka działa nie tylko stymulująco, ale też nawilżająco i regulująco na skórę głowy. Tonizuje, czyli przywraca skórze naturalne pH po myciu.\r\n\r\nEkstrakt z wasabi stanowi bogate źródło izosaponaryny oraz związków siarkoorganicznych: izotiocyjanianów (ITCs). Kluczowym w wasabi jest izotiocyjanian 6-(metylosulfinylo)heksylu (6-MSITC). Poza działaniem stymulującym, wasabi wykazuje właściwości bakteriobójcze, także w kierunku gronkowca złocistego Staphylococcus aureus.\r\n\r\nPrzenikanie cennych składników ekstraktu wasabi i jego efektywność wspomaga kompleks cennych aminokwasów oraz propanediol, natomiast pantenol zapewnia dodatkowe nawilżenie.\r\nWcierka Hairy Tale Wasabi zawiera kwas laktobionowy i glukonolakton. Poprawiają nawilżenie skóry głowy i działają antyoksydacyjnie. Kwas laktobionowy znajduje zastosowanie w kuracji przeciwtrądzikowej i wspomagającej walkę z łojotokowym zapaleniem skóry głowy (ŁZS).\r\n\r\nProdukt nie zawiera dodatków zapachowych, ma naturalny aromat zastosowanych w nim surowców.\r\n\r\nOsad na dnie jest zjawiskiem naturalnym.\r\n\r\nNasze kosmetyki są biodegradowalne, co oznacza, iż nie zanieczyszczają środowiska. Są bezpieczne dla dróg wodnych, zwierząt i roślin.\r\n\r\nSposób użycia: Wstrząśnij, a następnie nanieś niewielką porcję produktu na wilgotną skórę głowy po myciu. Delikatnie wmasuj, nie spłukuj. Stosuj po każdym myciu.\r\n\r\nSkładniki: Aqua, Wasabia Japonica (Wasabi) Root Extract, Panthenol, Propanediol, Ammonium Glycyrrhizate, Mannitol, Arginine, Niacinamide, Calcium Pantothenate, Faex (Yeast) Extract, Allantoin, Threonine, Biotin, Lactobionic Acid, Gluconolactone, Sodium Levulinate, Potassium Sorbate.\r\n\r\nWyprodukowano w Polsce\r\n\r\nPojemność: 100 ml', 12, 999),
(97, 91, 'Body in Balance by ONLYBIO Balsam do ciała mandarynka', '19.99', 'Mandarynkowy balsam do ciała Onlybio Body in Balance to energetyzująca bomba dla Twojego ciała! Koniecznie sprawdź jego działanie i świeży zapach!\r\n\r\nKiedy stosować?\r\nKiedy tylko zechcesz lub gdy Twoja skóra stanie się szorstka, sucha i będzie wymagała nawodnienia. Dla długotrwałego efektu sięgaj po produkt regularnie.\r\n\r\nCo odżywia?\r\nEkstrakt z mandarynki uelastycznia skórę oraz dodaje jej jędrności. Wygładza ją oraz głęboko nawilża. Witamina C wyrównuje koloryt oraz walczy z wolnymi rodnikami, spowalniając procesy starzenia.\r\n\r\nJak pachnie?\r\nZdecydowanie i energetyzująco! Świeży zapach cytrusów pobudza zmysły, poprawia humor i zachęca do działania.\r\n\r\nJak stosować?\r\nOczyść i wysusz skórę, następnie kulistymi ruchami wmasuj w nią balsam.\r\n\r\nSkładniki:\r\nAqua, Caprylic/Capric Triglyceride, Sodium Stearoyl Lactylate, Prunus Amygdalus Dulcis (Sweet Almond) Oil, Cetearyl Alcohol, Glyceryl Stearate, Cocos Nucifera (Coconut) Oil, Microcrystalline Cellulose, Glycerin, Ascorbyl Glucoside, Citrus Nobilis Peel Extract, Vaccinium Macrocarpon (Cranberry) Seed Oil, Xanthan Gum, Tocopherol, Citric Acid, Potassium Sorbate, Sodium Benzoate, Benzyl Alcohol, Benzoic Acid, Dehydroacetic Acid, Parfum, Limonene, Linalool, Citral.\r\n\r\nPojemność: 200ml\r\n\r\nTESTOWANO DERMATOLOGICZNIE', 7, 999),
(98, 91, 'Body in Balance by ONLYBIO Mleczko do ciała malinowe', '19.99', 'Pamiętaj! Jesteś piękna, bo jesteś!\r\n\r\nMalinowe mleczko OnlyBio doskonale uzupełni świadomą pielęgnację Twojego ciała. Zawiera aż 98% składników pochodzenia naturalnego, które każdego dnia łagodnie, ale skutecznie dbają o Twój komfort. Zamknęliśmy je w ekologicznej tubie, wyprodukowanej z bioplastiku, uzyskiwanego z trzciny cukrowej oraz nadającego się do recyklingu. Wybierając wegańskie kosmetyki z serii Body in Balance stawiasz na rozwiązania bezpieczne zarówno dla Ciebie, jak i środowiska.\r\n\r\nKiedy stosować?\r\nMleczko nakładaj, kiedy poczujesz, że Twoja skóra jest sucha i szorstka. Dla długotrwałego efektu możesz je też stosować codziennie.\r\n\r\nCo nawilża?\r\nZawarta w formule malina nordycka uelastycznia skórę oraz przywróci jej gładkość i odpowiednie, głębokie nawilżenie.\r\n\r\nJak pachnie?\r\nZapach maliny jest zmysłowy i odprężający. Jego delikatna słodycz wprowadzi Cię w beztroski nastrój!\r\n\r\nJak stosować?\r\nWmasuj mleczko kolistymi ruchami w oczyszczoną i osuszoną skórę.\r\n\r\nSkładniki:\r\nAqua, Coco-Caprylate/Caprate, Caprylic/Capric Triglyceride, Glycerin, Propanediol, Prunus Persica (Peach) Kernel Oil, Glyceryl Stereate, Cetearyl Alcohol, Potassium Cetyl Phosphate, Rubus Idaeus (Raspberry) Seed Oil, Rubus Chamaemorus Fruit Extract, Butyrospermum Parkii (Shea) Butter, Helianthus Annuus (Sunflower) Seed Oil Benzyl Alcohol, Microcrystalline Cellulose, Xanthan Gum, Citric Acid, Dehydroacetic Acid, Benzoic Acid, Tocopherol, Parfum.\r\n\r\nPojemność: 200 ml\r\n\r\nTESTOWANO DERMATOLOGICZNIE', 7, 999),
(99, 91, 'Body in Balance by ONLYBIO Krem do ciała kokosowy', '19.99', 'Pamiętaj! Jesteś piękna, bo jesteś!\r\n\r\nKokosowy krem do ciała OnlyBio ma przyjemną konsystencję i szybko się wchłania, nie pozostawiając tłustej warstwy. To zasługa nowoczesnej, wegańskiej formuły. Stworzyliśmy ją na bazie surowców pochodzenia naturalnego (98%) i zapakowaliśmy w tubę wykonaną z bioplastiku z trzciny cukrowej, którą można poddać recyklingowi. W kwestii bezpieczeństwa kosmetyku oraz standardów zrównoważonej i ekologicznej produkcji nie uznajemy kompromisów!\r\n\r\nKiedy stosować?\r\nKrem nakładaj codziennie oraz gdy tylko poczujesz, że skóra jest sucha, szorstka i potrzebuje nawodnienia.\r\n\r\nCo regeneruje?\r\nZawarte w formule masło kokosowe uelastycznia skórę oraz przywróci jej gładkość i odpowiednie, głębokie nawilżenie.\r\n\r\nJak pachnie?\r\nSłodko, świeżo i egzotycznie! Zmysłowy zapach kokosa przywodzi na myśl wakacje i wprowadza w znakomity nastrój – daj się nim otulić!\r\n\r\nJak stosować?\r\nKolistymi ruchami wmasuj krem we wcześniej oczyszczoną i osuszoną skórę.\r\n\r\nSkładniki:\r\nAqua, Coco-Caprylate/Caprate, Cocos Nucifera (Coconut) Oil, Glycerin, Prunus Amygdalus Dulcis (Sweet Almond) Oil, Glyceryl Stereate, Cetearyl Alcohol, Decyl Cocoate, Potassium Cetyl Phosphate, Benzyl Alcohol, Citric Acid, Benzoic Acid, Dehydroacetic Acid, Tocopherol, Parfum Benzyl Salicylate, Hexyl Cinnamal, Coumarin.\r\n\r\nPojemność: 200 ml\r\n\r\nTESTOWANO DERMATOLOGICZNIE', 7, 999),
(100, 85, 'Hand in Balance by ONLYBIO Mydło do rąk papaja', '15.99', 'Chroni, pielęgnuje i zniewala zapachem\r\n\r\nA gdyby tak pielęgnować dłonie nawet podczas ich mycia? Za sprawą Mydła do rąk Papaja od Onlybio teraz to możliwe! To nasz sposób na odżywienie i nawilżenie suchej skóry. Zawarty w nim ekstrakt z papai jest źródłem wielu cennych składników, dzięki którym dłonie są miękkie, gładkie, a ich szorstkość przestaje powodować dyskomfort. Łagodnie działające substancje myjące odpowiadają za skuteczne usuwanie zanieczyszczeń bez wysuszania skóry. Formuła produktu jest wegańska i zawiera aż 98% składników pochodzenia naturalnego.\r\n\r\n·        Jak pachnie? Papaja pachnie egzotycznie i zmysłowo, wprowadzając w znakomity nastrój!\r\n\r\n·        Kiedy stosować? Podczas każdego mycia rąk, szczególnie jeśli zechcesz nawilżyć suchą skórę dłoni.\r\n\r\n·        Jak stosować? Niewielką ilość mydła trzeba dobrze rozmasować w zwilżonych dłoniach. Następnie należy dokładnie umyć skórę, pamiętając o palcach i przestrzeniach między nimi, po czym spłukać powstałą pianę czystą wodą.\r\n\r\nNaturalnie zadbaj o swoje dłonie z produktami z linii Hand in Balance od Onlybio!\r\n\r\nSkładniki: Aqua, Sodium Coco-Sulfate, Coco-Glucoside, Cocamidopropyl Betaine, Sodium Chloride, Glycerin, Carica Papaya Leaf Extract, Glyceryl Oleate, Sodium Cocoyl Glutamate, Citric Acid, Potassium Sorbate, Sodium Benzoate, Parfum.', 7, 999),
(101, 85, 'Hand in Balance by ONLYBIO Mydło do rąk kokos', '15.99', 'Nieco egzotyki w Twojej łazience\r\n\r\nRutyna nie musi być nudna! Mydło do rąk Kokos od Onlybio zadba o Twoje dłonie, a przy tym oczaruje Cię zmysłowym zapachem. Jego łagodna formuła z masłem kokosowym sprawi, że sucha i odwodniona skóra stanie się miękka, gładka, a przede wszystkim odżywiona. Delikatne substancje myjące skutecznie usuną zanieczyszczenia, nie powodując przesuszenia. Mydło jest wegańskie i zawiera aż 98% składników pochodzenia naturalnego.\r\n\r\n·        Jak pachnie? Słodki, otulający i egzotyczny zapach kokosa jest po prostu obłędny – na pewno go pokochasz!\r\n\r\n·        Kiedy stosować? Podczas każdego mycia rąk, kiedy zechcesz również nawilżyć i zregenerować skórę.\r\n\r\n·        Jak stosować? Nanieś niewielką ilość mydła na mokre dłonie i rozmasuj produkt, aby uzyskać pianę. Dokładnie umyj dłonie z każdej strony, pamiętając o palcach oraz przestrzeniach między nimi. Następnie spłucz czystą wodą.\r\n\r\nNaturalnie zadbaj o swoje dłonie z produktami z linii Hand in Balance od Onlybio!\r\n\r\nSkładniki: Aqua, Sodium Coco-Sulfate, Coco-Glucoside, Cocamidopropyl  Betaine, Sodium Chloride, Glycerin, Cocos Nucifera (Coconut) Oil, Sodium Cocoyl Glutamate, Glyceryl Oleate, Citric Acid, Potassium Sorbate, Sodium  Benzoate,  Parfum,  Hexyl  Cinnamal,  Benzyl Salicylate.', 7, 999),
(102, 85, 'Hand in Balance by ONLYBIO Mydło do rąk malina', '15.99', 'Koniec z szorstkimi dłoniami!\r\n\r\nTeraz nawet podczas tak prozaicznej czynności, jak mycie rąk możesz dbać o swoją skórę! Mydło do rąk Malina od Onlybio nie tylko myje i odżywia dłonie, ale i za sprawą wyjątkowego zapachu wprowadza w dobry nastrój! Jego formuła bogata jest w ekstrakt z maliny nordyckiej, który znakomicie sprawdza się w pielęgnacji suchej i zniszczonej skóry – przyspiesza procesy naprawcze, poprawia elastyczność oraz intensywnie nawilża. W rezultacie ta staje się cudownie miękka oraz aksamitnie gładka. Co ważne, mydło zawiera substancje myjące, które działają skutecznie, a zarazem bardzo delikatnie. Jest wegańskie i wyprodukowane z aż 98% składników pochodzenia naturalnego.\r\n\r\n·        Jak pachnie? Zapach maliny otula dłonie zmysłową słodyczą, która Cię zachwyci!\r\n\r\n·        Kiedy stosować? Podczas każdego mycia rąk, zwłaszcza jeśli zechcesz nawilżyć podrażnioną i szorstką skórę dłoni.\r\n\r\n·        Jak stosować? Niewielką ilość mydła rozmasuj we wcześniej zwilżonych dłoniach, a uzyskasz pianę. Dokładnie umyj dłonie, palce oraz przestrzenie między nimi, następnie spłucz czystą wodą.\r\n\r\nNaturalnie zadbaj o swoje dłonie z produktami z linii Hand in Balance od Onlybio!\r\n\r\nSkładniki: Aqua, Sodium Coco-Sulfate, Coco- Glucoside, Cocamidopropyl  Betaine, Sodium Chloride, Glycerin, Rubus Idaeus (Raspberry) Seed Oil, Glyceryl Oleate, Sodium Cocoyl Glutamate, Citric Acid, Potassium Sorbate, Sodium Benzoate, Parfum.', 7, 999),
(103, 96, 'Hand in Balance by ONLYBIO Krem do rąk nawilżający Kokos', '11.99', 'Pamiętaj! Jesteś piękna, bo jesteś!\r\n\r\nKokosowy krem do ciała OnlyBio ma przyjemną konsystencję i szybko się wchłania, nie pozostawiając tłustej warstwy. To zasługa nowoczesnej, wegańskiej formuły. Stworzyliśmy ją na bazie surowców pochodzenia naturalnego (98%) i zapakowaliśmy w tubę wykonaną z bioplastiku z trzciny cukrowej, którą można poddać recyklingowi. W kwestii bezpieczeństwa kosmetyku oraz standardów zrównoważonej i ekologicznej produkcji nie uznajemy kompromisów!\r\n\r\nKiedy stosować?\r\nTak często, jak tylko chcesz, lub gdy poczujesz, że Twoje dłonie potrzebują nawilżenia. Polecamy używanie kremu po każdym myciu rąk.\r\n\r\nCo regeneruje skórę?\r\nZawarte w formule masło kokosowe uelastycznia skórę oraz przywróci jej gładkość i odpowiednie, głębokie nawilżenie.\r\n\r\nJak pachnie?\r\nOczywiście kokosem! Jego zmysłowy i przyciągający zapach jest kolejnym powodem, by regularnie sięgać po nasz krem.\r\n\r\nJak stosować?\r\nWmasuj niewielką ilość produktu w skórę dłoni i gotowe!\r\nWygodna i poręczna tuba bez problemu zmieści się w kosmetyczce lub torebce, dlatego możesz mieć kokosowy krem Onlybio zawsze przy sobie. Stosuj go regularnie, aby cieszyć się najlepszymi rezultatami!\r\n\r\nSkładniki:\r\nAqua, Coco-Caprylate/Caprate, Cocos Nucifera (Coconut) Oil, Butyrospermum Parkii (Shea) Butter, Glycerin, Glyceryl Stereate, Cetearyl Alcohol, Potassium Cetyl Phosphate, Musa Sapientum (Banana) Flower Extract, Helianthus Annuus (Sunflower) Seed Oil, Citric Acid, Benzyl Alcohol, Sodium Benzoate, Benzoic Acid, Dehydroacetic Acid, Tocopherol, Parfum, Benzyl Salicylate, Hexyl Cinnamal, Coumarin.\r\n\r\nPojemność: 50ml\r\n\r\nTESTOWANO DERMATOLOGICZNIE', 7, 999),
(104, 96, 'Hand in Balance by ONLYBIO Krem do rąk przeciw szorstkości Papaja', '11.99', 'Poznaj Krem Papaja z linii Hand in Balance by Onlybio – dzięki niemu Twoje dłonie będą cudownie miękkie i pachnące!\r\n\r\nKiedy stosować?\r\nKiedy tylko chcesz! Używaj kremu po każdym myciu rąk oraz gdy tylko poczujesz, że Twoje dłonie potrzebują natychmiastowego nawilżenia.\r\n\r\nCo odżywia skórę?\r\nZawarty w formule ekstrakt z maliny nordyckiej uelastyczni skórę oraz przywróci jej gładkość i odpowiednie, głębokie nawilżenie.\r\n\r\nJak pachnie?\r\nZapach papai jest słodki, egzotyczny i wyjątkowy! To kolejny powód, dla którego będziesz z przyjemnością często sięgać po ten kosmetyk!\r\n\r\nJak stosować?\r\nWmasuj niewielką ilość produktu w skórę dłoni.\r\n\r\nSkładniki:\r\nAqua, Coco-Caprylate/Caprate, Caprylic/ Capric Triglyceride, Glycerin, Mangifera Indica (Mango) Seed Butter, Prunus Amygdalus Dulcis (Sweet Almond) Oil, Glyceryl Stereate, Cetearyl Alcohol, Potassium Cetyl Phosphate, Carica Papaya Leaf Extract, Musa Sapientum (Banana) Flower Extract, Helianthus Annuus (Sunflower) Seed Oil,Citric Acid, Benzyl Alcohol, Sodium Benzoate, Benzoic Acid, Dehydroacetic Acid, Tocopherol, Parfum, Amyl Cinnamal, Limonene, Linalool.\r\n\r\nPojemność: 50ml\r\n\r\nTESTOWANO DERMATOLOGICZNIE', 7, 999),
(105, 96, 'Hand in Balance by ONLYBIO Krem do rąk malina', '11.99', 'Poznaj Krem Malina z linii Hand in Balance by Onlybio – dzięki niemu Twoje dłonie będą cudownie miękkie i pachnące!\r\n\r\nKiedy stosować?\r\nSięgnij po krem gdy tylko poczujesz, że Twoje dłonie potrzebują nawilżenia. Polecamy nakładać go również po każdym myciu rąk.\r\n\r\nCo odżywia skórę?\r\nZawarty w formule ekstrakt z maliny nordyckiej uelastyczni skórę oraz przywróci jej gładkość i odpowiednie, głębokie nawilżenie.\r\n\r\nJak pachnie?\r\nZmysłowy zapach słodkiej maliny przyciąga i hipnotyzuje, wprowadzając w świetny nastrój!\r\n\r\nJak stosować?\r\nWmasuj niewielką ilość produktu w skórę dłoni.\r\n\r\nSkładniki:\r\nAqua, Coco-Caprylate/Caprate, Caprylic/Capric Triglyceride, Glycerin, Mangifera Indica (Mango) Seed Butter, Prunus Amygdalus Dulcis (Sweet Almond) Oil, Cetearyl Alcohol, Glyceryl Stearate, Potassium Cetyl Phosphate, Potassium Olivoyl Hydrolyzed Oat Protein, Rubus Chamaemorus Fruit Extract, Glyceryl Oleate, Helianthus Annuus (Sunflower) Seed Oil, Tocopherol, Citric Acid, Benzyl Alcohol, Benzoic Acid, Dehydroacetic Acid, Parfum\r\n\r\nPojemność: 50ml\r\n\r\nTESTOWANO DERMATOLOGICZNIE', 7, 999),
(106, 84, 'Body in Balance by ONLYBIO Żel pod prysznic Migdał', '22.99', 'Nawilżona i jędrna skóra na co dzień\r\n\r\nTwoje ciało jest piękne, dlatego warto to podkreślać każdego dnia! Żel pod prysznic Migdał, z linii Body in Balance by Onlybio, zabierze Cię w aromatyczną podróż. Jej celem jest zregenerowana skóra, w której będziesz czuć się pewnie i komfortowo. Dzięki starannie skomponowanym składnikom, w tym odżywczemu olejkowi ze słodkich migdałów, skóra będzie nawilżona, ujędrniona i gładka. Tak aksamitnego ciała chce się dotykać bez przerwy!\r\n\r\nJak pachnie?\r\nZapach migdałów kusi i uwodzi, zamieniając Twoją łazienkę w prywatne SPA.\r\n\r\nKiedy stosować?\r\nPodczas każdej kąpieli, kiedy zechcesz zrobić sobie małą przyjemność oraz wprowadzić się w znakomity nastrój.\r\n\r\nJak stosować?\r\nZwilż skórę i rozprowadź po niej niewielką ilość żelu. Następnie dokładnie spłucz wodą.\r\n\r\nO wyjątkowości kosmetyku decyduje wegańska formuła, bogata w składniki pochodzenia naturalnego – jest ich aż 98%! Postaw na świadomą pielęgnację przygotowaną przez Onlybio i żyj w zgodzie z sobą oraz naturą.\r\n\r\nSkładniki/Ingredients: Aqua, Coco-Glucoside, Sodium Coco-Sulfate,  Cocamidopropyl Betaine, Glycerin, Prunus Amygdalus Dulcis (Sweet Almond) Oil, Glyceryl Oleate, Citric Acid, Tocopherol, Sodium Chloride, Potassium Sorbate, Sodium Benzoate, Parfum, Benzyl Salicylate, Coumarin, Hexyl Cinnamal.\r\n\r\nTESTOWANO DERMATOLOGICZNIE', 7, 999),
(107, 84, 'Body in Balance by ONLYBIO Żel pod prysznic Kokos', '22.99', 'Odpręż się i doceń swoje piękno!\r\n\r\nOd teraz każda kąpiel może być wyjątkowa – aromatyczna i niezwykle odprężająca. Żel pod prysznic Kokos z serii Body in Balance by Onlybio naturalnie zatroszczy się o Twoje ciało. Jego wegańska formuła pomoże Ci w odkrywaniu oraz doświadczania własnego piękna, dając poczucie pełnego komfortu oraz akceptacji. Formułę wzbogaciliśmy o masło kokosowe, które wzmacnia płaszcz hydrolipidowy skóry. Regeneruje ją oraz głęboko nawilża, sprawiając, że jest gładka i widocznie odżywiona.\r\n\r\nJak pachnie?\r\nZmysłowy i słodki zapach kokosa zabierze Cię w egzotyczną podróż po dobry nastrój!\r\n\r\nKiedy stosować?\r\nGdy będziesz mieć ochotę na chwilę relaksu! Aromatyczna kąpiel to świetny sposób na odprężenie ciała oraz uwolnienie myśli.\r\n\r\nJak stosować?\r\nNiewielką ilość produktu rozprowadź na zwilżonej skórze i dokładnie spłucz wodą.\r\n\r\nNasz kokosowy żel pod prysznic to aż 98% składników pochodzenia naturalnego, które dostarczą Twojej skórze cenne, odżywcze substancje. Rozpocznij świadomą pielęgnację z wegańskimi kosmetykami Body in Balance by Onlybio!\r\n\r\nSkładniki/Ingredients:  Aqua,  Coco-Glucoside,  Sodium Coco-Sulfate,  Cocamidopropyl  Betaine,  Glycerin,  Cocos Nucifera (Coconut) Oil, Glyceryl Oleate, Citric Acid, Tocophe-rol, Sodium Chloride, Potassium Sorbate, Sodium Benzoate, Parfum, Benzyl Salicylate, Coumarin, Hexyl Cinnamal.\r\n\r\nTESTOWANO DERMATOLOGICZNIE', 7, 999),
(108, 84, 'Body in Balance by ONLYBIO Żel pod prysznic Malina', '22.99', 'Aromatyczna i skuteczna pielęgnacja\r\n\r\nŻel pod prysznic Malina, z linii Body in Balance by Onlybio, będzie nie tylko poprawiał Ci nastrój, ale i każdego dnia dbał o Twoją skórę. Sekretem jego odżywczego działania jest ekstrakt z maliny nordyckiej. Zwiększa on elastyczność skóry, głęboko nawilża, a także przyspiesza procesy naprawcze. Dzięki temu możesz czuć się w pełni komfortowo, ciesząc się gładką i zregenerowaną skórą, której niczego nie brakuje.\r\n\r\nTwoje ciało jest naturalnie piękne – podkreśl to dzięki świadomej pielęgnacji w duchu body positive!\r\n\r\nJak pachnie?\r\nPrzyjemny zapach maliny otuli Cię swoją słodyczą, zamieniając kąpielową rutynę w aromatyczną przygodę.\r\n\r\nKiedy stosować?\r\nPodczas każdego prysznica. Żel zadba o Twoją skórę oraz rozbudzi zmysły!\r\n\r\nJak stosować?\r\nRozprowadź niewielką ilość produktu na zwilżonej skórze i dokładnie spłucz wodą.\r\n\r\nW formule zawarliśmy aż 98% składników pochodzenia naturalnego. Reszta to substancje, dzięki którym żel nie straci swych wyjątkowych właściwości przez długi czas. Kosmetyk jest w pełni wegański.\r\n\r\nTESTOWANO DERMATOLOGICZNIE\r\n\r\nSkładniki/Ingredients: Aqua, Sodium Coco-Sulfate, Coco-Glucoside, Glycerin, Cocamidopropyl Betaine, Glyceryl Oleate, Rubus Chamaemorus Fruit Extract, Citric Acid, Helianthus Annuus (Sunflower) Seed Oil, Tocopherol, Sodium Chloride, Potassium Sorbate, Sodium Benzoate, Parfum.', 7, 999),
(110, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 01 Born to Hustle', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!', 3, 999),
(111, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 02 Goal Crusher', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!', 3, 999),
(112, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 03 Ambition Statement', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!', 3, 999),
(113, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 04 Life Goals', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(114, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 05 Magic Maker', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!', 3, 999),
(115, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 06 Boundary Pusher', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(116, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 07 Global Citizen ', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(117, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 08 Overnight Hero', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!', 3, 999),
(118, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 09 Make It Work', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(119, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 10 Trophy Life', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(120, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 11 Cash Flow', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(121, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 12 Movin Up', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(122, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 13 Another Level', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(123, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 14 Lead Everything', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(124, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 15 World Shaper', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(125, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 16 Goal Getter', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(126, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 17 Rebel in Red', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(127, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 18 On A Mission', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(129, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 19 Never Basic', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(130, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 20 In Charge', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(131, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 21 Next Gen Thinking', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(132, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 22 Shake Things Up', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(134, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 24 Self Taught Millionaire', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(135, 71, 'NYX Professional Makeup Shine Loud High Shine Lip Color Błyszczyk 23 Disrupter', '56.99', 'Nowa generacja pomadki w płynie: nie odbijający się pigment + ultra szklane wykończenie!\r\n\r\nKrok 1: Nałóż wysoko napigmentowany kolor nasycony kwasem hialuronowym.\r\nKrok 2: Wykończ makijaż ust nakładając top coat o szklanym efekcie.\r\n\r\nNieklejący się top coat utrwali intensywność pigmentu i doda mu ultra soczyste wykończenie!\r\n\r\nTa dwustronna pomadka w płynie zapewni Ci długotrwały komfort i nieziemski efekt!\r\n', 3, 999),
(136, 18, 'Sattva Ayurveda naturalna ziołowa farba do włosów ciemny brąz', '38.99', 'Opakowanie zawiera kompozycję ajurwedyjskich ziół. Henna nadaje włosom odcień ciemnego czekoladowego brązu o chłodnej tonacji. Naturalne składniki zawarte w hennie, sprawiają, że włosy stają się dogłębnie odżywione, zyskują naturalny zdrowy połysk i nabierają objętości.', 14, 999),
(137, 18, 'Sattva Ayurveda naturalna ziołowa farba do włosów orzechowy brąz', '38.99', 'Opakowanie zawiera kompozycję rzadkich ajurwedyjskich ziół. Henna Sattva Ayurveda nadaje włosom odcień ciemnego, orzechowego brązu o chłodnym ocieniu. Twoje włosy staną się grubsze, lśniące i odporne na działanie czynników zewnętrznych. Henna głęboko odżywia strukturę włosa.', 14, 999),
(138, 18, 'Sattva Ayurveda naturalna ziołowa farba do włosów jasny brąz', '38.99', 'Opakowanie zawiera kompozycję ajurwedyjskich ziół. Henna nadaje włosom odcień od jasnego brązu do średniego brązu w ciepłych odcieniach. Ponadto, henna ziołowa Sattva Ayurveda intensywnie odżywia i regeneruje włosy oraz przywraca im blask i zdrowy wygląd. Farbowanie henną to także doskonały sposób na zregenerowanie włosów zniszczonych długotrwałym farbowaniem chemicznym oraz stylizacją.', 14, 999),
(139, 18, 'Sattva Ayurveda naturalna ziołowa farba do włosów czerwona', '38.99', 'Opakowanie zawiera 100% sproszkowanych liści rośliny o nazwie Lawsonia Inermis . Naturalna henna farbuje jasne włosy na odcienie rude i czerwone. W przypadku włosów ciemnych daje piękne mahoniowe refleksy. Idealnie farbuje siwe włosy. Stosowanie henny sprawia, że włosy są mocniejsze, zdrowsze i bardziej lśniące. Im częściej używasz henny Sattva Ayurveda, tym lepszą kondycję będą mieć Twoje włosy!', 14, 999),
(140, 19, 'Sattva Ayurveda naturalna ziołowa farba do włosów Cassia', '38.99', 'Opakowanie zawiera 100%  sproszkowanych liści Cassia Obovata.  Włosom jasny blond, białym i rozjaśnianym nada delikatny złoty kolor. Sproszkowane liście rośliny Cassia polecane są w szczególności do włosów łamliwych, cienkich, matowych a także zniszczonych farbowaniem chemicznym. Wyjątkowo skutecznie wzmacniają zniszczone włosy wraz z cebulkami, przywracając im blask, objętość i przeciwdziałając wypadaniu.', 14, 999),
(141, 7, 'Sattva Ayurveda wcierka rewitalizująca do skóry głowy anyż i lukrecja', '31.99', 'To wyjątkowa kompozycja aloesu, anyżu, lukrecji, ziół ajurwedyjskich, ekstraktu z papryki oraz ashwagandy. Wcierki są bardzo intensywnie ziołowe. Przy skłonności do alergii na składniki naturalne (np. na aloes, rumianek) należy wykonać próbę uczuleniową.\r\n\r\nZapach tej wcierki na pewno przypadnie do gustu fanom słodyczy z lukrecji! Jej zapachowe cechy szczególne to delikatne, odświeżające, słodkawe nuty. Zioła mogą delikatnie przyciemniać włosy – dotyczy jasnych i platynowych blondów.', 14, 999),
(142, 7, 'Sattva Ayurveda wcierka blask i miękkość do skóry głowy henna i amla', '31.99', 'To wyjątkowa kompozycja aloesu, henny, amli, ekstraktu z kozieradki, gorczycy, papryki oraz drzewa sandałowego. Wcierki są bardzo intensywnie ziołowe. Przy skłonności do alergii na składniki naturalne (np. na aloes, rumianek) należy wykonać próbę uczuleniową. Zioła mogą delikatnie przyciemniać włosy – dotyczy jasnych i platynowych blondów.\r\n\r\n \r\n\r\nZapach tej wcierki jest najbardziej orientalny i najmocniejszy ze wszystkich 3 rodzajów. To sprawka przede wszystkim amli oraz drzewa sandałowego. Zapach z czasem słabnie i przechodzi w delikatniejsze, ziołowe nuty.', 14, 999),
(143, 7, 'Sattva Ayurveda wcierka wzmacniająca do skóry głowy szafran i cynamon', '31.99', 'To wyjątkowa kompozycja aloesu, cynamonu,  szafranu, bazylii azjatyckiej i ziół ajurwedyjskich. Wcierki są bardzo intensywnie ziołowe. Przy skłonności do alergii na składniki naturalne (np. na aloes, rumianek) należy wykonać próbę uczuleniową. Zioła mogą nieznacznie przyciemniać włosy – dotyczy jasnych i platynowych blondów.\r\n\r\nZapach tej wcierki jest najbardziej neutralny. Pachnie delikatnie ziołowo, wyczuwalne są cynamonowe nuty.', 14, 999),
(144, 50, 'theBalm rozświetlacz Mary-Lou Manizer', '69.99', 'Rozświetlacz Mary-Lou Manizer - \"The Luminizer\" od firmy theBalm.\r\n\r\nTo uniwersalny kosmetyk rozświetlający.\r\n\r\nMożna go używać do ciała, powiek (jak cień) i policzków.\r\n\r\nMary-Lou Manizer jest jedwabiście gładkim pudrem, łatwym w aplikacji o szampańskim odcieniu, iskrzący i pięknie odbijający światło.\r\n\r\nDaje efekt smugi światła, jaki można zobaczyć na modelkach z pokazów mody.\r\n\r\nCudowne opakowanie w stylu Pin-up girl skrywa lusterko.\r\nKosmetyk sprawia, że skóra dostaje naturalnego blasku, wygląda delikatniej i młodziej.\r\n\r\nJest bardzo trwały, utrzymuje się na skórze przez wiele godzin.', 5, 999),
(145, 49, 'theBalm bronzer Bahama Mama', '59.99', 'Bahama Mama od firmy theBalm to matowy bronzer, który doda Twojej skórze efekt pięknej opalenizny.\r\n\r\nTheBalm to amerykańska linia produktów do makijażu z wysokiej jakości surowców gwarantująca piękny, naturalny wygląd.\r\n\r\nIch znakiem rozpoznawczym są niezwykle oryginalne i zabawne opakowania.\r\n\r\nSpecjalnie zaprojektowana formuła pudru Bahama Mama sprawia, że Twoja twarz będzie wyglądała jak muśnięta słońcem, nawet w środku zimy.\r\n\r\nZaletą jest także fakt, że jest niesamowicie delikatny więc nie powoduje uczucia ciężkości.\r\n\r\nCudowne opakowanie w stylu Pin-up girl skrywa duże lusterko.\r\n\r\nDoskonale nadaje się do konturowania.\r\n\r\nNie bez powodu jest kosmetykiem kultowym.', 5, 999),
(146, 51, 'theBalm róż Hot Mama', '59.99', 'Hot Mama! To produkt marki TheBalm.\r\n\r\nSpełnia funkcję różu do policzków, jak również - cienia do powiek.\r\n\r\nW sposób subtelny odbija światło i rozświetla skórę.\r\n\r\nKosmetyk posiada gładką, jedwabistą konsystencję.\r\n\r\nRóż idealnie rozciera się, aplikuje, nie pozostawia plam oraz smug.\r\n\r\nDodaje cerze blasku i młodzieńczego wyglądu.\r\n\r\nCudowne opakowanie w stylu Pin-up girl skrywa duże lusterko.\r\n\r\nProdukt posiada uniwersalny kolor w odcieniu różowo - brzoskwiniowym.\r\n\r\nJest bardzo trwały, utrzymuje się na skórze przez wiele godzin.', 5, 999),
(147, 13, 'Yope Balance my hair sól morska do stylizacji włosów z algami', '24.99', 'YOPE Balance Sól Morska do Włosów z Algami 100ml\r\n\r\nYope Bounce my hair to nowa seria produktów przeznaczonych do pielęgnacji włosów.\r\n\r\nW swoich formułach bazuje na adaptogenach.\r\n\r\nSeria ta charakteryzuje się wyjątkowymi zapachami i holistycznym działaniem. Jest doskonałym suplementem dla skóry głowy i włosów.\r\n\r\nSól morska do stylizacji z algami to kosmetyk, który doskonale uzupełnia codzienną pielęgnację każdego rodzaju włosów.\r\n\r\nPozwala nadać im objętość, nie wysusza skóry głowy. Kosmetyk dodatkowo wspomaga ochronę włosów i pielęgnuje je.\r\n\r\nWzbogacony prowitaminą B5.', 6, 999),
(148, 12, 'Hair in Balance by ONLYBIO Żel mocny do stylizacji włosów kręconych', '19.99', 'Stylizacja fal i loków\r\nNaturalna, wegańska formuła z ksylitolem i aloesem\r\n\r\nZalety produktu:\r\n\r\nJak pachnie?\r\nPołączenie maliny i różowego pieprzu nie tylko intryguje, ale i zniewala. Po prostu musisz to poczuć!\r\n\r\nKiedy stosować?\r\nGdy chcesz utrwalić skręt włosów i zwiększyć ich sprężystość.\r\n\r\nJaki efekt?\r\nDługotrwałe utrzymanie skrętu włosów.\r\n\r\nSposób użycia:\r\nŻel wgnieć w mokre włosy, na których wcześniej rozprowadzony został aktywator skrętu. Następnie wysusz je przy pomocy suszarki z dyfuzorem.\r\n\r\nSkład:\r\nAqua, PVP, Acrylates Copolymer, Propanediol, Aloe Barbadensis Leaf Juice, Xylitol, Anhydroxylitol, Xylitylglucoside, Glucose, Sodium Hydroxide, Polyglyceryl-4 Laurate/ Sebacate, Polyglyceryl-6 Caprylate/Caprate, Benzyl Alcohol, Benzoic Acid, Dehydroacetic Acid, Tocopherol, Sodium Benzoate; Potassium Sorbate, Parfum, Hexyl Cinnanal, Limonene, Linalool.', 7, 999),
(149, 11, 'Hair in Balance by ONLYBIO Aktywator skrętu w kremie', '24.99', 'Stylizacja fal i loków\r\nNaturalna, wegańska formuła z magnolią i masłem murumuru\r\n\r\nZalety produktu:\r\n\r\nJak pachnie?\r\nSłodki i niezwykle przyjemny zapach kiwi przy każdym użyciu będzie poprawiał Ci humor!\r\n\r\nKiedy stosować?\r\nPodczas stylizacji na mokro, kiedy chcesz wydobyć naturalny skręt włosów.\r\n\r\nJaki efekt?\r\nWłosy są nawilżone, dociążone i zabiezpieczone.\r\n\r\nSposób użycia:\r\nW umyte, ociekające wodą włosy wgnieć niewielką ilość aktywatora, dokładnego go rozprowadzając. Dla uzyskania najlepszego rezultatu wysusz włosy przy pomocy suszarki z dyfuzorem.\r\n\r\nSkład:\r\nAqua, Cetearyl Alcohol, Dicaprylyl Carbonate, Bis-(Isostearoyl/Oleoyl Isopropyl) Dimonium Methosulfate, Distearoylethyl Dimonium Chloride, Astrocarya Murumuru Seed Butter, Magnolia Officinalis Bark Extract, Persea Gratissima (Avocado) Oil, Pentylene Glycol, Glyceryl Caprylate, Cetrimonium Chloride, Tocopherol, Benzyl Alcohol, Dehydroacetic Acid, Benzoic Acid, Parfum.agnolia Officinalis Bark Extract, Persea Gratissima (Avocado) Oil, Pentylene Glycol, Glyceryl Caprylate, Cetrimonium Chloride, Tocopherol, Benzyl Alcohol, Dehydroacetic Acid, Benzoic Acid, Parfum.', 7, 999),
(150, 12, 'Hair in Balance by ONLYBIO Stylizator proteinowy do stylizacji włosów kręconych', '24.99', 'Stylizacja fal i loków\r\nNaturalna, wegańska formuła z proteinami lnu, owsa i pszenicy\r\n\r\nZalety produktu:\r\n\r\nJak pachnie?\r\nMaliną i różowym pieprzem – to intrygujące połączenie najpierw Cię zaskoczy, a następnie wprowadzi w świetny nastrój!\r\n\r\nKiedy stosować?\r\nGdy zechcesz, aby skręt włosów był mocniej zdefiniowany i utrwalony. Stosuj również, jeżeli mierzysz się z problemem puszenia.\r\n\r\nJaki efekt?\r\nWłosy delikatnie utrwalone, sprężyste i pełne objętności.\r\n\r\nSposób użycia:\r\nWgnieć niewielką ilość stylizatora w mokre pasma. Po dokładnym rozprowadzeniu produktu wysusz włosy, używając do tego suszarki z dyfuzorem.\r\n\r\nSkład:\r\nAqua, Panthenol, Cellulose Gum, Sucrose, Hydrolyzed Linseed Seed, Hydrolysed Oats, Hydrolyzed Wheat Protein, Xanthan Gum, Polyglyceryl-4 Laurate/Sebacate, Polyglyceryl-6 Caprylate/Caprate, Potassium Sorbate, Sodium Benzoate, Benzyl Alcohol, Benzoic Acid, Dehydroacetic Acid, Tocopherol, Parfum, Hexyl Cinnanal, Limonene, Linalool.', 7, 999),
(151, 13, 'Hair in Balance by ONLYBIO Mgiełka odbijająca włosy od nasady', '19.99', 'Objętość i nawilżenie\r\nNaturalna, wegańska formuła z maliną i imbirem\r\n\r\nZalety produktu:\r\n\r\nKiedy stosować?\r\nAby cieszyć sprężystymi włosami o zwiększonej objętości, używaj mgiełki po każdym myciu.\r\n\r\nJaki efekt?\r\nWłosy są odbite od nasady, lekkie i miękkie. Mgiełka nie obciąża i nie skleja włosów.\r\n\r\nJak pachnie?\r\nMgiełka ma energetyzujący, rześki, a przy tym delikatnie słodki zapach pina colady, który będzie zachwycać Cię przy każdym użyciu.\r\n\r\nSposób użycia:\r\nRozpyl mgiełkę na mokre włosy, tuż przy skórze głowy. Pozwól pasmom wyschnąć i gotowe!\r\n\r\nSkład:\r\nAqua, Polyquaternium-110, Zingiber Officinale Root Extract, Rubus Chamaemorus Fruit Extract, Panthenol, Niacinamide, Glycerin, Helianthus Annuus (Sunflower) Seed Oil, Cetrimonium Chloride, PVP, Polyglyceryl-4 Laurate/Sebacate, Polyglyceryl-6 Caprylate/Caprate, Benzyl Alcohol, Benzoic Acid, Dehydroacetic Acid, Tocopherol, Parfum, Limonene.', 7, 999),
(152, 9, 'Hair in Balance by ONLYBIO Pianka utrwalająca do stylizacji fal i loków', '22.99', 'Zdefiniowane loki i fale\r\n\r\nPodkreśl naturalny skręt włosów – Pianka utrwalająca do stylizacji fal i loków z linii Hair in Balance pomoże Ci w wydobyciu ich piękna. Produkt sprawia, że kosmyki zyskują miękkość i sprężystość, a skręt jest delikatnie podkreślony, bez sklejania czy efektu obciążenia. Jego wegańska formuła to aż 98% składników pochodzenia naturalnego, w tym ekstrakt z lnu oraz proteiny roślinne.\r\n\r\n·        Jak pachnie? Zapach smoczego owocu jest egzotyczny i energetyzujący – po prostu wyjątkowy!\r\n\r\n·        Kiedy stosować? Gdy włosy są cienkie i delikatne, puszą się, a ich skręt potrzebuje podkreślenia.\r\n\r\n·        Jak stosować? Wgnieć niewielką ilość pianki w wilgotne włosy, następnie wysusz je suszarką z dyfuzorem.\r\n\r\n·        Jaki efekt? Delikatnie utrwalone, sprężyste loki lub fale.\r\n\r\nPianka utrwalająca od Onlybio idealnie sprawdza się do wydobywania skrętu popularnymi metodami, takimi jak wgniatanie oraz plopping. Zacznij świadomą stylizację włosów z Hair in Balance!\r\n\r\nSkładniki: \r\nAqua, Sodium Polyitaconate,Sodium Cocoyl Sarcosinate, Linum Usitatissimum (Linseed)  Seed  Extract,  Hydrolyzed  Vegetable Protein,  Rubus  Idaeus  (Raspberry)  Seed  Oil, Polyglyceryl-4 Laurate/Sebacate, Polyglyceryl-6 Caprylate/Caprate, Citric Acid, Sodium Benzoate, Potassium Sorbate, Benzyl Alcohol, Benzoic Acid, Dehydroacetic Acid, Tocopherol, Parfum, Linalool.', 7, 999),
(153, 13, 'Hair in Balance by ONLYBIO Mgiełka odbijająca włosy od nasady', '19.99', 'Objętość i nawilżenie\r\nNaturalna, wegańska formuła z maliną i imbirem\r\n\r\nZalety produktu:\r\n\r\nKiedy stosować?\r\nAby cieszyć sprężystymi włosami o zwiększonej objętości, używaj mgiełki po każdym myciu.\r\n\r\nJaki efekt?\r\nWłosy są odbite od nasady, lekkie i miękkie. Mgiełka nie obciąża i nie skleja włosów.\r\n\r\nJak pachnie?\r\nMgiełka ma energetyzujący, rześki, a przy tym delikatnie słodki zapach pina colady, który będzie zachwycać Cię przy każdym użyciu.\r\n\r\nSposób użycia:\r\nRozpyl mgiełkę na mokre włosy, tuż przy skórze głowy. Pozwól pasmom wyschnąć i gotowe!\r\n\r\nSkład:\r\nAqua, Polyquaternium-110, Zingiber Officinale Root Extract, Rubus Chamaemorus Fruit Extract, Panthenol, Niacinamide, Glycerin, Helianthus Annuus (Sunflower) Seed Oil, Cetrimonium Chloride, PVP, Polyglyceryl-4 Laurate/Sebacate, Polyglyceryl-6 Caprylate/Caprate, Benzyl Alcohol, Benzoic Acid, Dehydroacetic Acid, Tocopherol, Parfum, Limonene.', 7, 999),
(154, 13, 'Hair in Balance by ONLYBIO Ochrona przed UV w mgiełce', '26.99', 'Optymalna ochrona\r\n\r\nSłońce sprawia, że Twoje włosy stają się przesuszone, wypłowiałe, a przy tym łatwiej się łamią? Onlybio wie, jak temu przeciwdziałać! Ochrona przed UV w mgiełce Hair in Balance to szybki sposób na zabezpieczenie pasm. Produkt dba o kondycję włosów, których struktura może być osłabiona przez szkodliwe promieniowanie. Dzięki SPF30 wyglądają one zdrowo, a ich kolor nie traci intensywności i głębi. Po kosmetyk sięgaj przed każdą ekspozycją na słońce, a w szczególności wtedy, gdy planujesz spędzić więcej czasu na świeżym powietrzu.\r\n\r\nMgiełka chroniąca przed UV od Onlybio wzbogacona jest ekstraktem z maliny oraz olejem brokułowym. Za ich sprawą włosy są dodatkowo wygładzone oraz lśniące. Jednocześnie lekka formuła powoduje, że kosmyki pozostają lekkie i nieobciążone. Kosmetyk jest wegański.\r\n\r\n·        Jak pachnie? Słodki zapach soczystego arbuza przypomni Ci wspomnienia z błogich wakacji!\r\n\r\n·        Kiedy stosować? Przed każdą ekspozycją na słońce.\r\n\r\n·        Jak stosować? Mocno wstrząśnij opakowanie. Rozpyl mgiełkę na włosy z odległości około 15 centymetrów od głowy, następnie przeczesz je szczotką lub grzebieniem, rozprowadzając produkt.\r\n\r\n·        Jaki efekt? Włosy chronione przed blaknięciem i przesuszeniem, bez obciążenia.\r\n\r\nSkładniki/Ingredients:\r\nAqua, Ethylhexyl Methoxycinnamate, Cyclopentasiloxane, Ethylhexyl Salicylate, Diethylamino Hydroxybenzoyl Hexyl Benzoate, Dicaprylyl Ether, Rubus Chamaemorus Fruit Extract, Brassica Oleracea Italica(Broccoli) Seed Oil, Sorbitan Laurate, Helianthus Annuus (Sunflower) Seed Oil, Polyglyceryl-4 Laurate, Solanum Tuberosum Starch, Dilauryl Citrate, Benzyl Alcohol, Ethylhexylglycerin, Citric Acid, Parfum, Citral, Citronellol, Limonene, Linalool.', 7, 999);
INSERT INTO `produkt` (`produkt_id`, `kategoria_id`, `nazwa`, `cena`, `opis`, `marka_id`, `ilosc`) VALUES
(155, 13, 'Hair in Balance by ONLYBIO Termoochrona w mgiełce', '22.99', 'Zdrowa stylizacja\r\n\r\nStosowanie zabiegów z udziałem wysokiej temperatury źle wpływa na kondycję włosów. Dlatego przed życiem prostownicy, lokówki albo suszarki z gorącym nawiewem warto zabezpieczyć kosmyki przy pomocy Termoochrony w mgiełce od Onlybio! Produkt bogaty w ekstrakt z owoców kasztanowca zapobiega niszczeniu włosów, dzięki czemu te mogą zachwycać zdrowym wyglądem. Lekka formuła mgiełki nie obciąża ich ani nie skleja. Dodatek silikonów wygładza pasma.\r\n\r\n·        Jak pachnie? Orzeźwiającym, cytrynowym sorbetem, który pobudza zmysły i wprowadza w znakomity humor!\r\n\r\n·        Kiedy stosować? Przed każdym suszeniem włosów ciepłym nawiewem lub stylizacją na gorąco.\r\n\r\n·        Jak stosować? Rozpyl mgiełkę równomiernie na włosach, zachowując odległość ok. 15 centymetrów.\r\n\r\n·        Jaki efekt? Wygładzone i zabezpieczone przed temperaturą włosy.\r\n\r\nPokochasz tę wegańską formułę, która zawiera aż 98% składników pochodzenia naturalnego – zacznij świadomą pielęgnację włosów z Hair in Balance!\r\n\r\nSkładniki: \r\nAqua,  Cyclopentasiloxane, Glycerin,  Propanediol,  Cetrimonium  Chloride, Behenamidopropyl  Dimethylamine,  Hydrolyzed Vegetable  Protein,  Hydrolyzed  Chestnut  Extract, Polyglyceryl-4 Laurate/Sebacate, Cetearyl Alcohol, Solanum  Tuberosum  Starch,  Polyglyceryl-6 Caprylate/Caprate, Lactic Acid, Citric Acid, Sodium Benzoate,  Potassium  Sorbate,  Benzyl  Alcohol, Benzoic  Acid,  Dehydroacetic  Acid,  Tocopherol, Parfum, Citral, Hexyl Cinnamal, Limonene, Linalool.', 7, 999);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sesja`
--

CREATE TABLE `sesja` (
  `sesja_id` int(11) NOT NULL,
  `data_dodania` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `sesja`
--

INSERT INTO `sesja` (`sesja_id`, `data_dodania`) VALUES
(1, '2023-03-24 15:43:54'),
(2, '2023-03-24 15:43:54'),
(3, '2023-03-24 15:50:49'),
(4, '2023-03-25 13:25:14'),
(5, '2023-03-25 16:21:38'),
(6, '2023-03-25 16:21:43'),
(7, '2023-03-25 16:21:45'),
(8, '2023-03-25 16:21:50'),
(9, '2023-03-25 19:50:18'),
(10, '2023-03-25 19:54:32'),
(11, '2023-04-01 20:42:48'),
(12, '2023-04-01 20:43:12'),
(13, '2023-04-01 20:52:01'),
(14, '2023-04-05 16:49:47'),
(15, '2023-04-08 15:05:48'),
(16, '2023-04-12 15:06:54'),
(17, '2023-04-13 19:16:55');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ulubiony`
--

CREATE TABLE `ulubiony` (
  `ulubiony_id` int(11) NOT NULL,
  `uzytkownik_id` int(11) NOT NULL,
  `produkt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `ulubiony`
--

INSERT INTO `ulubiony` (`ulubiony_id`, `uzytkownik_id`, `produkt_id`) VALUES
(8, 2, 135),
(9, 2, 111),
(11, 2, 11),
(12, 2, 120),
(21, 2, 154);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik`
--

CREATE TABLE `uzytkownik` (
  `uzytkownik_id` int(11) NOT NULL,
  `nazwa` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(254) COLLATE utf8mb4_polish_ci NOT NULL,
  `haslo` varchar(64) COLLATE utf8mb4_polish_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `imie` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `nazwisko` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `numer_telefonu` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `uzytkownik`
--

INSERT INTO `uzytkownik` (`uzytkownik_id`, `nazwa`, `email`, `haslo`, `admin`, `imie`, `nazwisko`, `numer_telefonu`) VALUES
(1, 'user', 'email@email.com', '$2y$10$Jgikq3TKjhauN/ectDPzqeT.0NQAwOx/6dm05gC6B4zeGMNL05f2W', 0, NULL, NULL, NULL),
(2, 'admin', 'admin@admin.com', '$2y$10$6mD55QOIarjOAeBKApLbv.AcxklRZBwPltFVL8TU4zPTc1zqbmBhe', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownik_adres`
--

CREATE TABLE `uzytkownik_adres` (
  `uzytkownik_adres_id` int(11) NOT NULL,
  `uzytkownik_id` int(11) NOT NULL,
  `ulica` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `nr_domu` smallint(6) NOT NULL,
  `nr_mieszkania` smallint(6) NOT NULL,
  `miasto` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `kod_pocztowy` varchar(6) COLLATE utf8mb4_polish_ci NOT NULL,
  `kraj_id` int(11) NOT NULL,
  `czy_firma` tinyint(1) NOT NULL DEFAULT 0,
  `nazwa_firmy` varchar(50) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `nip` varchar(10) COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdjecie`
--

CREATE TABLE `zdjecie` (
  `zdjecie_id` int(11) NOT NULL,
  `sciezka` varchar(128) COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwa` varchar(128) COLLATE utf8mb4_polish_ci NOT NULL,
  `produkt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `zdjecie`
--

INSERT INTO `zdjecie` (`zdjecie_id`, `sciezka`, `nazwa`, `produkt_id`) VALUES
(1, '/sklep/images/product-images/1/', '1_1668709133.jpg', 1),
(2, '/sklep/images/product-images/1/', '1_1668709173.jpg', 1),
(3, '/sklep/images/product-images/1/', '1_1668709177.jpg', 1),
(6, '/sklep/images/product-images/3/', '3_1668709228.jpg', 3),
(7, '/sklep/images/product-images/3/', '3_1668709253.jpg', 3),
(8, '/sklep/images/product-images/3/', '3_1668709262.jpg', 3),
(9, '/sklep/images/product-images/4/', '4_1668709268.jpg', 4),
(10, '/sklep/images/product-images/4/', '4_1668709271.jpg', 4),
(11, '/sklep/images/product-images/4/', '4_1668709274.jpg', 4),
(20, '/sklep/images/product-images/7/', '7_1668709643.jpg', 7),
(21, '/sklep/images/product-images/7/', '7_1668709646.jpg', 7),
(22, '/sklep/images/product-images/8/', '8_1668709650.jpg', 8),
(23, '/sklep/images/product-images/8/', '8_1668709692.jpg', 8),
(69, '/sklep/images/product-images/21/', '21_1668769500.jpg', 21),
(70, '/sklep/images/product-images/21/', '21_1668769506.jpg', 21),
(71, '/sklep/images/product-images/23/', '23_1668769523.jpg', 23),
(72, '/sklep/images/product-images/23/', '23_1668769525.jpg', 23),
(73, '/sklep/images/product-images/23/', '23_1668769528.jpg', 23),
(74, '/sklep/images/product-images/23/', '23_1668769534.jpg', 23),
(75, '/sklep/images/product-images/17/', '17_1668769683.jpg', 17),
(76, '/sklep/images/product-images/17/', '17_1668769687.jpg', 17),
(77, '/sklep/images/product-images/18/', '18_1668769696.jpg', 18),
(79, '/sklep/images/product-images/18/', '18_1668769745.jpg', 18),
(80, '/sklep/images/product-images/19/', '19_1668769789.jpg', 19),
(81, '/sklep/images/product-images/19/', '19_1668769793.jpg', 19),
(82, '/sklep/images/product-images/28/', '28_1668769860.jpg', 28),
(83, '/sklep/images/product-images/28/', '28_1668769864.jpg', 28),
(84, '/sklep/images/product-images/28/', '28_1668769869.jpg', 28),
(85, '/sklep/images/product-images/28/', '28_1668769872.jpg', 28),
(86, '/sklep/images/product-images/27/', '27_1668769883.jpg', 27),
(87, '/sklep/images/product-images/27/', '27_1668769887.jpg', 27),
(88, '/sklep/images/product-images/26/', '26_1668769910.jpg', 26),
(89, '/sklep/images/product-images/26/', '26_1668769914.jpg', 26),
(90, '/sklep/images/product-images/26/', '26_1668769918.jpg', 26),
(91, '/sklep/images/product-images/26/', '26_1668769921.jpg', 26),
(92, '/sklep/images/product-images/25/', '25_1668769978.jpg', 25),
(93, '/sklep/images/product-images/25/', '25_1668769984.jpg', 25),
(94, '/sklep/images/product-images/25/', '25_1668769987.jpg', 25),
(95, '/sklep/images/product-images/25/', '25_1668769991.jpg', 25),
(96, '/sklep/images/product-images/24/', '24_1668770027.jpg', 24),
(97, '/sklep/images/product-images/24/', '24_1668770030.jpg', 24),
(98, '/sklep/images/product-images/24/', '24_1668770040.jpg', 24),
(99, '/sklep/images/product-images/24/', '24_1668770043.jpg', 24),
(100, '/sklep/images/product-images/29/', '29_1668770169.jpg', 29),
(101, '/sklep/images/product-images/29/', '29_1668770175.jpg', 29),
(102, '/sklep/images/product-images/30/', '30_1668770213.jpg', 30),
(103, '/sklep/images/product-images/30/', '30_1668770218.jpg', 30),
(104, '/sklep/images/product-images/31/', '31_1668770232.jpg', 31),
(105, '/sklep/images/product-images/31/', '31_1668770237.jpg', 31),
(106, '/sklep/images/product-images/32/', '32_1668770245.jpg', 32),
(107, '/sklep/images/product-images/32/', '32_1668770249.jpg', 32),
(108, '/sklep/images/product-images/9/', '9_1669224882.jpg', 9),
(109, '/sklep/images/product-images/9/', '9_1669224887.jpg', 9),
(110, '/sklep/images/product-images/11/', '11_1669225613.jpg', 11),
(111, '/sklep/images/product-images/11/', '11_1669225619.jpg', 11),
(112, '/sklep/images/product-images/12/', '12_1669225623.jpg', 12),
(113, '/sklep/images/product-images/12/', '12_1669225627.jpg', 12),
(114, '/sklep/images/product-images/13/', '13_1669225631.jpg', 13),
(115, '/sklep/images/product-images/13/', '13_1669225638.jpg', 13),
(116, '/sklep/images/product-images/14/', '14_1669225642.jpg', 14),
(117, '/sklep/images/product-images/14/', '14_1669225678.jpg', 14),
(118, '/sklep/images/product-images/14/', '14_1669225682.jpg', 14),
(119, '/sklep/images/product-images/14/', '14_1669225687.jpg', 14),
(120, '/sklep/images/product-images/15/', '15_1669225691.jpg', 15),
(121, '/sklep/images/product-images/15/', '15_1669225695.jpg', 15),
(122, '/sklep/images/product-images/15/', '15_1669225699.jpg', 15),
(123, '/sklep/images/product-images/15/', '15_1669225703.jpg', 15),
(124, '/sklep/images/product-images/22/', '22_1669225850.jpg', 22),
(125, '/sklep/images/product-images/22/', '22_1669225854.jpg', 22),
(127, '/sklep/images/product-images/10/', '10_1669226388.jpg', 10),
(128, '/sklep/images/product-images/10/', '10_1669226392.jpg', 10),
(131, '/sklep/images/product-images/61/', '61_1669236283.jpg', 61),
(132, '/sklep/images/product-images/61/', '61_1669236287.jpg', 61),
(133, '/sklep/images/product-images/59/', '59_1669236311.jpg', 59),
(134, '/sklep/images/product-images/59/', '59_1669236315.jpg', 59),
(135, '/sklep/images/product-images/59/', '59_1669236319.jpg', 59),
(136, '/sklep/images/product-images/59/', '59_1669236324.jpg', 59),
(137, '/sklep/images/product-images/59/', '59_1669236329.jpg', 59),
(138, '/sklep/images/product-images/59/', '59_1669236430.jpg', 59),
(139, '/sklep/images/product-images/62/', '62_1669236490.jpg', 62),
(140, '/sklep/images/product-images/62/', '62_1669236494.jpg', 62),
(141, '/sklep/images/product-images/62/', '62_1669236497.jpg', 62),
(142, '/sklep/images/product-images/63/', '63_1669236641.jpg', 63),
(143, '/sklep/images/product-images/63/', '63_1669236645.jpg', 63),
(144, '/sklep/images/product-images/64/', '64_1669236663.jpg', 64),
(145, '/sklep/images/product-images/64/', '64_1669236668.jpg', 64),
(147, '/sklep/images/product-images/58/', '58_1669236762.jpg', 58),
(148, '/sklep/images/product-images/58/', '58_1669236766.jpg', 58),
(149, '/sklep/images/product-images/58/', '58_1669236772.jpg', 58),
(150, '/sklep/images/product-images/58/', '58_1669236776.jpg', 58),
(151, '/sklep/images/product-images/58/', '58_1669236779.jpg', 58),
(152, '/sklep/images/product-images/58/', '58_1669236783.jpg', 58),
(153, '/sklep/images/product-images/60/', '60_1669236797.jpg', 60),
(154, '/sklep/images/product-images/60/', '60_1669236800.jpg', 60),
(155, '/sklep/images/product-images/60/', '60_1669236803.jpg', 60),
(156, '/sklep/images/product-images/60/', '60_1669236807.jpg', 60),
(157, '/sklep/images/product-images/60/', '60_1669236816.jpg', 60),
(158, '/sklep/images/product-images/60/', '60_1669236819.jpg', 60),
(159, '/sklep/images/product-images/65/', '65_1669236829.jpg', 65),
(160, '/sklep/images/product-images/65/', '65_1669236833.jpg', 65),
(161, '/sklep/images/product-images/66/', '66_1669236845.jpg', 66),
(162, '/sklep/images/product-images/66/', '66_1669236847.jpg', 66),
(163, '/sklep/images/product-images/46/', '46_1669237145.jpg', 46),
(164, '/sklep/images/product-images/46/', '46_1669237150.jpg', 46),
(165, '/sklep/images/product-images/46/', '46_1669237153.jpg', 46),
(166, '/sklep/images/product-images/46/', '46_1669237156.jpg', 46),
(167, '/sklep/images/product-images/52/', '52_1669237172.jpg', 52),
(168, '/sklep/images/product-images/52/', '52_1669237178.jpg', 52),
(170, '/sklep/images/product-images/52/', '52_1669237205.jpg', 52),
(171, '/sklep/images/product-images/52/', '52_1669237210.jpg', 52),
(172, '/sklep/images/product-images/54/', '54_1669237220.jpg', 54),
(173, '/sklep/images/product-images/54/', '54_1669237223.jpg', 54),
(174, '/sklep/images/product-images/53/', '53_1669237248.jpg', 53),
(175, '/sklep/images/product-images/53/', '53_1669237257.jpg', 53),
(176, '/sklep/images/product-images/53/', '53_1669237261.jpg', 53),
(177, '/sklep/images/product-images/55/', '55_1669237309.jpg', 55),
(178, '/sklep/images/product-images/55/', '55_1669237312.jpg', 55),
(179, '/sklep/images/product-images/51/', '51_1669237323.jpg', 51),
(180, '/sklep/images/product-images/51/', '51_1669237327.jpg', 51),
(181, '/sklep/images/product-images/51/', '51_1669237334.jpg', 51),
(182, '/sklep/images/product-images/51/', '51_1669237337.jpg', 51),
(190, '/sklep/images/product-images/81/', '81_168071362973.jpg', 81),
(191, '/sklep/images/product-images/82/', '82_168071380350.jpg', 82),
(192, '/sklep/images/product-images/83/', '83_168071392270.jpg', 83),
(193, '/sklep/images/product-images/84/', '84_168071402668.jpg', 84),
(194, '/sklep/images/product-images/85/', '85_168071424414.jpg', 85),
(195, '/sklep/images/product-images/86/', '86_168071435838.jpg', 86),
(196, '/sklep/images/product-images/86/', '86_16807143588.jpg', 86),
(197, '/sklep/images/product-images/87/', '87_168071460217.jpg', 87),
(198, '/sklep/images/product-images/87/', '87_168071460285.jpg', 87),
(199, '/sklep/images/product-images/88/', '88_168071467887.jpg', 88),
(200, '/sklep/images/product-images/89/', '89_168071684662.jpg', 89),
(201, '/sklep/images/product-images/90/', '90_168071691885.jpg', 90),
(202, '/sklep/images/product-images/90/', '90_168071691829.jpg', 90),
(203, '/sklep/images/product-images/91/', '91_168071731417.jpg', 91),
(204, '/sklep/images/product-images/91/', '91_168071731415.jpg', 91),
(205, '/sklep/images/product-images/92/', '92_168071736846.jpg', 92),
(206, '/sklep/images/product-images/92/', '92_168071736870.jpg', 92),
(207, '/sklep/images/product-images/93/', '93_168071741824.jpg', 93),
(208, '/sklep/images/product-images/93/', '93_168071741860.jpg', 93),
(209, '/sklep/images/product-images/94/', '94_168071750562.jpg', 94),
(210, '/sklep/images/product-images/95/', '95_168071756131.jpg', 95),
(211, '/sklep/images/product-images/96/', '96_168071760573.jpg', 96),
(212, '/sklep/images/product-images/97/', '97_168071835925.jpg', 97),
(213, '/sklep/images/product-images/97/', '97_168071835939.jpg', 97),
(214, '/sklep/images/product-images/98/', '98_168071881966.jpg', 98),
(215, '/sklep/images/product-images/98/', '98_168071881991.jpg', 98),
(216, '/sklep/images/product-images/99/', '99_168071889485.jpg', 99),
(217, '/sklep/images/product-images/99/', '99_168071889460.jpg', 99),
(218, '/sklep/images/product-images/100/', '100_168071898965.jpg', 100),
(219, '/sklep/images/product-images/100/', '100_16807189899.jpg', 100),
(220, '/sklep/images/product-images/100/', '100_168071898990.jpg', 100),
(221, '/sklep/images/product-images/101/', '101_168071906366.jpg', 101),
(222, '/sklep/images/product-images/101/', '101_168071906349.jpg', 101),
(223, '/sklep/images/product-images/101/', '101_168071906388.jpg', 101),
(224, '/sklep/images/product-images/102/', '102_168071921299.jpg', 102),
(225, '/sklep/images/product-images/102/', '102_168071921253.jpg', 102),
(226, '/sklep/images/product-images/102/', '102_168071921250.jpg', 102),
(231, '/sklep/images/product-images/103/', '103_168072005810.jpg', 103),
(232, '/sklep/images/product-images/103/', '103_168072005886.jpg', 103),
(233, '/sklep/images/product-images/104/', '104_168072012838.jpg', 104),
(234, '/sklep/images/product-images/104/', '104_168072012839.jpg', 104),
(235, '/sklep/images/product-images/105/', '105_168072018793.jpg', 105),
(236, '/sklep/images/product-images/105/', '105_168072018783.jpg', 105),
(237, '/sklep/images/product-images/106/', '106_168072024417.jpg', 106),
(238, '/sklep/images/product-images/106/', '106_168072024439.jpg', 106),
(239, '/sklep/images/product-images/106/', '106_168072024433.jpg', 106),
(240, '/sklep/images/product-images/107/', '107_168072028356.jpg', 107),
(241, '/sklep/images/product-images/107/', '107_168072028392.jpg', 107),
(242, '/sklep/images/product-images/107/', '107_168072028329.jpg', 107),
(243, '/sklep/images/product-images/108/', '108_168072032410.jpg', 108),
(244, '/sklep/images/product-images/108/', '108_168072032428.jpg', 108),
(248, '/sklep/images/product-images/110/', '110_168088163965.webp', 110),
(249, '/sklep/images/product-images/110/', '110_168088163949.jpg', 110),
(250, '/sklep/images/product-images/110/', '110_168088163955.webp', 110),
(251, '/sklep/images/product-images/110/', '110_16808816393.jpg', 110),
(252, '/sklep/images/product-images/110/', '110_168088163951.jpg', 110),
(253, '/sklep/images/product-images/111/', '111_168088187215.webp', 111),
(254, '/sklep/images/product-images/111/', '111_168088187276.jpg', 111),
(255, '/sklep/images/product-images/111/', '111_168088187218.jpg', 111),
(256, '/sklep/images/product-images/111/', '111_168088187259.jpg', 111),
(257, '/sklep/images/product-images/111/', '111_168088187271.jpg', 111),
(258, '/sklep/images/product-images/112/', '112_168088194093.webp', 112),
(259, '/sklep/images/product-images/112/', '112_168088194043.jpg', 112),
(260, '/sklep/images/product-images/112/', '112_168088194089.jpg', 112),
(261, '/sklep/images/product-images/112/', '112_168088194065.jpg', 112),
(262, '/sklep/images/product-images/112/', '112_168088194067.jpg', 112),
(263, '/sklep/images/product-images/113/', '113_168088198534.webp', 113),
(264, '/sklep/images/product-images/113/', '113_168088198541.jpg', 113),
(265, '/sklep/images/product-images/113/', '113_168088198583.jpg', 113),
(266, '/sklep/images/product-images/113/', '113_168088198535.jpg', 113),
(267, '/sklep/images/product-images/113/', '113_168088198520.webp', 113),
(268, '/sklep/images/product-images/114/', '114_168088203014.webp', 114),
(269, '/sklep/images/product-images/114/', '114_168088203058.jpg', 114),
(270, '/sklep/images/product-images/114/', '114_168088203096.jpg', 114),
(271, '/sklep/images/product-images/114/', '114_168088203017.jpg', 114),
(272, '/sklep/images/product-images/114/', '114_168088203060.webp', 114),
(273, '/sklep/images/product-images/115/', '115_168088214326.jpg', 115),
(274, '/sklep/images/product-images/115/', '115_168088214369.jpg', 115),
(275, '/sklep/images/product-images/115/', '115_168088214392.jpg', 115),
(276, '/sklep/images/product-images/115/', '115_168088214393.jpg', 115),
(277, '/sklep/images/product-images/115/', '115_168088214387.jpg', 115),
(278, '/sklep/images/product-images/116/', '116_168088219738.webp', 116),
(279, '/sklep/images/product-images/116/', '116_168088219794.jpg', 116),
(280, '/sklep/images/product-images/116/', '116_168088219742.jpg', 116),
(281, '/sklep/images/product-images/116/', '116_168088219761.jpg', 116),
(282, '/sklep/images/product-images/116/', '116_168088219720.jpg', 116),
(283, '/sklep/images/product-images/117/', '117_168088224318.jpg', 117),
(284, '/sklep/images/product-images/117/', '117_168088224381.jpg', 117),
(285, '/sklep/images/product-images/117/', '117_168088224330.jpg', 117),
(286, '/sklep/images/product-images/117/', '117_168088224327.jpg', 117),
(287, '/sklep/images/product-images/117/', '117_168088224377.jpg', 117),
(288, '/sklep/images/product-images/118/', '118_168088229374.webp', 118),
(289, '/sklep/images/product-images/118/', '118_168088229336.jpg', 118),
(290, '/sklep/images/product-images/118/', '118_168088229329.jpg', 118),
(291, '/sklep/images/product-images/118/', '118_16808822935.jpg', 118),
(292, '/sklep/images/product-images/118/', '118_168088229346.jpg', 118),
(293, '/sklep/images/product-images/119/', '119_168088233495.webp', 119),
(294, '/sklep/images/product-images/119/', '119_168088233483.jpg', 119),
(295, '/sklep/images/product-images/119/', '119_168088233445.jpg', 119),
(296, '/sklep/images/product-images/119/', '119_168088233429.jpg', 119),
(297, '/sklep/images/product-images/119/', '119_168088233470.jpg', 119),
(298, '/sklep/images/product-images/120/', '120_168088237035.webp', 120),
(299, '/sklep/images/product-images/120/', '120_168088237071.jpg', 120),
(300, '/sklep/images/product-images/120/', '120_168088237031.webp', 120),
(301, '/sklep/images/product-images/120/', '120_168088237092.jpg', 120),
(302, '/sklep/images/product-images/120/', '120_168088237033.webp', 120),
(303, '/sklep/images/product-images/121/', '121_16808824106.webp', 121),
(304, '/sklep/images/product-images/121/', '121_168088241068.jpg', 121),
(305, '/sklep/images/product-images/121/', '121_168088241029.jpg', 121),
(306, '/sklep/images/product-images/121/', '121_168088241068.jpg', 121),
(307, '/sklep/images/product-images/121/', '121_168088241075.jpg', 121),
(308, '/sklep/images/product-images/122/', '122_168088253052.jpg', 122),
(309, '/sklep/images/product-images/122/', '122_168088253064.jpg', 122),
(310, '/sklep/images/product-images/122/', '122_168088253061.jpg', 122),
(311, '/sklep/images/product-images/122/', '122_168088253085.jpg', 122),
(312, '/sklep/images/product-images/122/', '122_16808825301.jpg', 122),
(313, '/sklep/images/product-images/123/', '123_168088256659.webp', 123),
(314, '/sklep/images/product-images/123/', '123_168088256682.jpg', 123),
(315, '/sklep/images/product-images/123/', '123_168088256692.jpg', 123),
(316, '/sklep/images/product-images/123/', '123_168088256619.jpg', 123),
(317, '/sklep/images/product-images/123/', '123_168088256660.jpg', 123),
(318, '/sklep/images/product-images/124/', '124_168088259912.webp', 124),
(319, '/sklep/images/product-images/124/', '124_168088259947.jpg', 124),
(320, '/sklep/images/product-images/124/', '124_168088259994.jpg', 124),
(321, '/sklep/images/product-images/124/', '124_168088259949.webp', 124),
(322, '/sklep/images/product-images/124/', '124_168088259973.jpg', 124),
(323, '/sklep/images/product-images/125/', '125_168088263169.jpg', 125),
(324, '/sklep/images/product-images/125/', '125_168088263112.jpg', 125),
(325, '/sklep/images/product-images/125/', '125_168088263124.jpg', 125),
(326, '/sklep/images/product-images/125/', '125_168088263132.webp', 125),
(327, '/sklep/images/product-images/125/', '125_168088263144.jpg', 125),
(328, '/sklep/images/product-images/126/', '126_168088266373.webp', 126),
(329, '/sklep/images/product-images/126/', '126_168088266369.jpg', 126),
(330, '/sklep/images/product-images/126/', '126_168088266392.jpg', 126),
(331, '/sklep/images/product-images/126/', '126_168088266353.webp', 126),
(332, '/sklep/images/product-images/126/', '126_168088266397.webp', 126),
(333, '/sklep/images/product-images/127/', '127_168088271858.webp', 127),
(334, '/sklep/images/product-images/127/', '127_168088271826.jpg', 127),
(335, '/sklep/images/product-images/127/', '127_168088271926.webp', 127),
(336, '/sklep/images/product-images/127/', '127_168088271932.webp', 127),
(337, '/sklep/images/product-images/127/', '127_168088271969.jpg', 127),
(343, '/sklep/images/product-images/129/', '129_168088296245.webp', 129),
(344, '/sklep/images/product-images/129/', '129_168088296226.jpg', 129),
(345, '/sklep/images/product-images/129/', '129_168088296228.jpg', 129),
(346, '/sklep/images/product-images/129/', '129_16808829629.jpg', 129),
(347, '/sklep/images/product-images/129/', '129_168088296225.webp', 129),
(348, '/sklep/images/product-images/130/', '130_168088302922.webp', 130),
(349, '/sklep/images/product-images/130/', '130_168088302994.jpg', 130),
(350, '/sklep/images/product-images/130/', '130_168088302963.jpg', 130),
(351, '/sklep/images/product-images/130/', '130_168088302989.jpg', 130),
(352, '/sklep/images/product-images/130/', '130_168088302981.jpg', 130),
(353, '/sklep/images/product-images/131/', '131_168088306328.webp', 131),
(354, '/sklep/images/product-images/131/', '131_168088306391.jpg', 131),
(355, '/sklep/images/product-images/131/', '131_16808830637.jpg', 131),
(356, '/sklep/images/product-images/131/', '131_168088306347.jpg', 131),
(357, '/sklep/images/product-images/131/', '131_168088306349.jpg', 131),
(358, '/sklep/images/product-images/132/', '132_16808831193.webp', 132),
(359, '/sklep/images/product-images/132/', '132_168088311928.jpg', 132),
(360, '/sklep/images/product-images/132/', '132_168088311927.jpg', 132),
(361, '/sklep/images/product-images/132/', '132_168088311944.jpg', 132),
(362, '/sklep/images/product-images/132/', '132_168088311972.jpg', 132),
(368, '/sklep/images/product-images/134/', '134_168088319097.jpg', 134),
(369, '/sklep/images/product-images/134/', '134_168088319076.jpg', 134),
(370, '/sklep/images/product-images/134/', '134_168088319016.jpg', 134),
(371, '/sklep/images/product-images/134/', '134_168088319037.jpg', 134),
(372, '/sklep/images/product-images/134/', '134_168088319061.jpg', 134),
(373, '/sklep/images/product-images/135/', '135_168088342740.jpg', 135),
(374, '/sklep/images/product-images/135/', '135_168088342749.jpg', 135),
(375, '/sklep/images/product-images/135/', '135_168088342787.jpg', 135),
(376, '/sklep/images/product-images/135/', '135_168088342720.jpg', 135),
(377, '/sklep/images/product-images/135/', '135_168088342727.jpg', 135),
(378, '/sklep/images/product-images/136/', '136_168174527796.webp', 136),
(379, '/sklep/images/product-images/136/', '136_168174527769.webp', 136),
(380, '/sklep/images/product-images/137/', '137_168174535488.webp', 137),
(381, '/sklep/images/product-images/137/', '137_168174535448.webp', 137),
(382, '/sklep/images/product-images/138/', '138_16817453931.webp', 138),
(383, '/sklep/images/product-images/138/', '138_168174539392.webp', 138),
(384, '/sklep/images/product-images/139/', '139_168174543775.webp', 139),
(385, '/sklep/images/product-images/139/', '139_168174543799.webp', 139),
(386, '/sklep/images/product-images/140/', '140_168174549849.webp', 140),
(387, '/sklep/images/product-images/140/', '140_168174549862.webp', 140),
(388, '/sklep/images/product-images/141/', '141_168174557637.webp', 141),
(389, '/sklep/images/product-images/141/', '141_168174557632.webp', 141),
(390, '/sklep/images/product-images/141/', '141_168174557670.webp', 141),
(391, '/sklep/images/product-images/142/', '142_168174564231.webp', 142),
(392, '/sklep/images/product-images/142/', '142_168174564251.webp', 142),
(393, '/sklep/images/product-images/142/', '142_168174564289.webp', 142),
(394, '/sklep/images/product-images/143/', '143_168174574339.webp', 143),
(395, '/sklep/images/product-images/143/', '143_168174574352.webp', 143),
(396, '/sklep/images/product-images/143/', '143_168174574354.webp', 143),
(397, '/sklep/images/product-images/144/', '144_168174610919.webp', 144),
(398, '/sklep/images/product-images/144/', '144_168174610939.webp', 144),
(399, '/sklep/images/product-images/145/', '145_168174616428.webp', 145),
(400, '/sklep/images/product-images/146/', '146_168174621275.webp', 146),
(401, '/sklep/images/product-images/147/', '147_168174728561.webp', 147),
(402, '/sklep/images/product-images/147/', '147_168174728529.webp', 147),
(403, '/sklep/images/product-images/147/', '147_168174728527.webp', 147),
(404, '/sklep/images/product-images/147/', '147_168174728558.webp', 147),
(405, '/sklep/images/product-images/148/', '148_168174751295.webp', 148),
(406, '/sklep/images/product-images/148/', '148_168174751219.webp', 148),
(407, '/sklep/images/product-images/149/', '149_168174757843.webp', 149),
(408, '/sklep/images/product-images/149/', '149_168174757830.webp', 149),
(409, '/sklep/images/product-images/150/', '150_168174763764.webp', 150),
(410, '/sklep/images/product-images/150/', '150_168174763776.webp', 150),
(411, '/sklep/images/product-images/151/', '151_168174769384.webp', 151),
(412, '/sklep/images/product-images/151/', '151_168174769383.webp', 151),
(413, '/sklep/images/product-images/151/', '151_168174769325.webp', 151),
(414, '/sklep/images/product-images/152/', '152_168174783595.webp', 152),
(415, '/sklep/images/product-images/152/', '152_168174783578.webp', 152),
(416, '/sklep/images/product-images/152/', '152_168174783588.webp', 152),
(417, '/sklep/images/product-images/153/', '153_168174788617.webp', 153),
(418, '/sklep/images/product-images/153/', '153_168174788662.webp', 153),
(419, '/sklep/images/product-images/153/', '153_168174788630.webp', 153),
(420, '/sklep/images/product-images/154/', '154_168174822690.webp', 154),
(421, '/sklep/images/product-images/154/', '154_168174822662.webp', 154),
(422, '/sklep/images/product-images/154/', '154_16817482261.webp', 154),
(423, '/sklep/images/product-images/155/', '155_168174826298.webp', 155),
(424, '/sklep/images/product-images/155/', '155_168174826211.webp', 155),
(425, '/sklep/images/product-images/155/', '155_168174826254.webp', 155);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`kategoria_id`);

--
-- Indeksy dla tabeli `kategoria_1`
--
ALTER TABLE `kategoria_1`
  ADD PRIMARY KEY (`kategoria_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indeksy dla tabeli `kategoria_2`
--
ALTER TABLE `kategoria_2`
  ADD PRIMARY KEY (`kategoria_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indeksy dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD PRIMARY KEY (`koszyk_id`),
  ADD KEY `produkt_id` (`produkt_id`),
  ADD KEY `sesja_id` (`sesja_id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`);

--
-- Indeksy dla tabeli `kraj`
--
ALTER TABLE `kraj`
  ADD PRIMARY KEY (`kraj_id`);

--
-- Indeksy dla tabeli `marka`
--
ALTER TABLE `marka`
  ADD PRIMARY KEY (`marka_id`);

--
-- Indeksy dla tabeli `metoda_dostawy`
--
ALTER TABLE `metoda_dostawy`
  ADD PRIMARY KEY (`metoda_dostawy_id`);

--
-- Indeksy dla tabeli `metoda_platnosci`
--
ALTER TABLE `metoda_platnosci`
  ADD PRIMARY KEY (`metoda_platnosci_id`);

--
-- Indeksy dla tabeli `produkt`
--
ALTER TABLE `produkt`
  ADD PRIMARY KEY (`produkt_id`),
  ADD KEY `marka_id` (`marka_id`),
  ADD KEY `kategoria_id` (`kategoria_id`);

--
-- Indeksy dla tabeli `sesja`
--
ALTER TABLE `sesja`
  ADD PRIMARY KEY (`sesja_id`);

--
-- Indeksy dla tabeli `ulubiony`
--
ALTER TABLE `ulubiony`
  ADD PRIMARY KEY (`ulubiony_id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`),
  ADD KEY `produkt_id` (`produkt_id`);

--
-- Indeksy dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  ADD PRIMARY KEY (`uzytkownik_id`);

--
-- Indeksy dla tabeli `uzytkownik_adres`
--
ALTER TABLE `uzytkownik_adres`
  ADD PRIMARY KEY (`uzytkownik_adres_id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`),
  ADD KEY `kraj` (`kraj_id`),
  ADD KEY `kraj_id` (`kraj_id`);

--
-- Indeksy dla tabeli `zdjecie`
--
ALTER TABLE `zdjecie`
  ADD PRIMARY KEY (`zdjecie_id`),
  ADD KEY `produkt_id` (`produkt_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `kategoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `kategoria_1`
--
ALTER TABLE `kategoria_1`
  MODIFY `kategoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `kategoria_2`
--
ALTER TABLE `kategoria_2`
  MODIFY `kategoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  MODIFY `koszyk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT dla tabeli `kraj`
--
ALTER TABLE `kraj`
  MODIFY `kraj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT dla tabeli `marka`
--
ALTER TABLE `marka`
  MODIFY `marka_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `metoda_dostawy`
--
ALTER TABLE `metoda_dostawy`
  MODIFY `metoda_dostawy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `metoda_platnosci`
--
ALTER TABLE `metoda_platnosci`
  MODIFY `metoda_platnosci_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `produkt`
--
ALTER TABLE `produkt`
  MODIFY `produkt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT dla tabeli `sesja`
--
ALTER TABLE `sesja`
  MODIFY `sesja_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT dla tabeli `ulubiony`
--
ALTER TABLE `ulubiony`
  MODIFY `ulubiony_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `uzytkownik`
--
ALTER TABLE `uzytkownik`
  MODIFY `uzytkownik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `uzytkownik_adres`
--
ALTER TABLE `uzytkownik_adres`
  MODIFY `uzytkownik_adres_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `zdjecie`
--
ALTER TABLE `zdjecie`
  MODIFY `zdjecie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=426;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `kategoria_1`
--
ALTER TABLE `kategoria_1`
  ADD CONSTRAINT `kategoria_1_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `kategoria` (`kategoria_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `kategoria_2`
--
ALTER TABLE `kategoria_2`
  ADD CONSTRAINT `kategoria_2_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `kategoria_1` (`kategoria_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD CONSTRAINT `koszyk_ibfk_1` FOREIGN KEY (`produkt_id`) REFERENCES `produkt` (`produkt_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `koszyk_ibfk_2` FOREIGN KEY (`sesja_id`) REFERENCES `sesja` (`sesja_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `koszyk_ibfk_3` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownik` (`uzytkownik_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `produkt`
--
ALTER TABLE `produkt`
  ADD CONSTRAINT `produkt_ibfk_2` FOREIGN KEY (`marka_id`) REFERENCES `marka` (`marka_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produkt_ibfk_3` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoria_2` (`kategoria_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `ulubiony`
--
ALTER TABLE `ulubiony`
  ADD CONSTRAINT `ulubiony_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownik` (`uzytkownik_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ulubiony_ibfk_2` FOREIGN KEY (`produkt_id`) REFERENCES `produkt` (`produkt_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `uzytkownik_adres`
--
ALTER TABLE `uzytkownik_adres`
  ADD CONSTRAINT `uzytkownik_adres_ibfk_1` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownik` (`uzytkownik_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `uzytkownik_adres_ibfk_2` FOREIGN KEY (`kraj_id`) REFERENCES `kraj` (`kraj_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `zdjecie`
--
ALTER TABLE `zdjecie`
  ADD CONSTRAINT `zdjecie_ibfk_1` FOREIGN KEY (`produkt_id`) REFERENCES `produkt` (`produkt_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
