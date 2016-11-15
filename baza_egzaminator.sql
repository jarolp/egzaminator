-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 20 Paź 2012, 15:27
-- Wersja serwera: 5.1.41
-- Wersja PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `baza_egzaminator`
--
CREATE DATABASE `baza_egzaminator` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `baza_egzaminator`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `egzaminy`
--

CREATE TABLE IF NOT EXISTS `egzaminy` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(200) NOT NULL,
  `poziom` varchar(7) NOT NULL,
  `tryb` varchar(20) NOT NULL,
  `semestr` varchar(10) NOT NULL,
  `rok` int(2) NOT NULL,
  `id_prof` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `egzaminy`
--

INSERT INTO `egzaminy` (`id`, `nazwa`, `poziom`, `tryb`, `semestr`, `rok`, `id_prof`) VALUES
(1, 'Zarządzanie informatyką w firmie', 'mgr.', 'stacjonarny', 'zimowy', 2, 2),
(2, 'Technologia informacyjna', 'lic.', 'stacjonarny', 'letni', 1, 2),
(3, 'Projektowanie systemów informatycznych', 'lic.', 'niestacjonarny', 'zimowy', 1, 2),
(4, 'Systemy multimedialne', 'inż.', 'stacjonarny', 'letni', 2, 3),
(5, 'Podstawy grafiki komputerowej', 'lic.', 'niestacjonarny', 'letni', 1, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `odpowiedzi`
--

CREATE TABLE IF NOT EXISTS `odpowiedzi` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `id_pytania` int(20) NOT NULL,
  `odp1` varchar(700) NOT NULL,
  `odp2` varchar(700) NOT NULL,
  `odp3` varchar(700) NOT NULL,
  `odp4` varchar(700) NOT NULL,
  `odp1_tf` int(1) NOT NULL,
  `odp2_tf` int(1) NOT NULL,
  `odp3_tf` int(1) NOT NULL,
  `odp4_tf` int(1) NOT NULL,
  `id_egzaminu` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Zrzut danych tabeli `odpowiedzi`
--

INSERT INTO `odpowiedzi` (`id`, `id_pytania`, `odp1`, `odp2`, `odp3`, `odp4`, `odp1_tf`, `odp2_tf`, `odp3_tf`, `odp4_tf`, `id_egzaminu`) VALUES
(1, 1, 'dane > informacja > wiedza > mądrość', 'dane > wiedza > informacja > mądrość', 'dane > informacja > mądrość > wiedza', 'informacja > dane > wiedza > mądrość', 1, 0, 0, 0, 1),
(2, 2, 'planowanie produkcji przedsiębiorstwa', 'planowanie obiegu dokumentów w przedsiębiorstwie', 'planowanie sprzedaży', 'planowanie zasobów przedsiębiorstwa', 0, 0, 0, 1, 1),
(3, 3, 'MRP', 'MRP II', 'ERP', 'żadne z powyższych', 1, 0, 0, 0, 1),
(4, 4, 'archiwizacji danych', 'zbieraniu, rejestrowaniu i ewidencjonowaniu danych, czyli informacyjne zasilanie obiektu', 'wysyłaniu danych do odbiorcy', 'przesłaniu danych do bazy danych', 0, 1, 0, 0, 1),
(5, 5, 'sprzęt techniczny, dzięki któremu informacje są nadawane, odbierane, przetwarzane i przesyłane', 'zbiór programów i instrukcji napisanych w specjalnym języku, który jest zrozumiały dla komputera', 'organizacja, sprzęt oraz oprogramowanie umożliwiające wspólną pracę dwu lub wielu komputerów, a w pewnych sytuacjach pozwalająca na pracę jednego komputera z terminalami czyli końcówkami ', 'żadne z powyższych', 1, 0, 0, 0, 1),
(6, 6, ' usługi', 'standardy', 'narzędzia oraz integracja', 'wszystkie powyższe', 0, 0, 0, 1, 3),
(7, 7, '1.Planowanie > 2.Analiza ryzyka > 3.Weryfikacja przez klienta > 4.Konstrukcja', '1.Planowanie > 2.Analiza ryzyka > 3.Konstrukcja', '1.Planowanie > 2.Konstrukcja > 3.Analiza ryzyka', '1.Planowanie > 2.Konstrukcja > 3.Weryfikacja przez klienta ', 1, 0, 0, 0, 3),
(8, 8, 'regularnie współpracująca lub współzależna grupa elementów tworzących jedną całość', 'nieregularnie współpracująca lub niezależna grupa elementów tworzących jedną całość', 'powiązany w całość zbiór rzeczy', 'żadne z powyższych', 1, 0, 0, 0, 3),
(9, 9, 'argumentowanie w sposób logiczny i emocjonalny', 'danie czasu na oswojenie się ze zmianą lub odejście', 'zaangażowanie podwładnych w proces identyfikowania potrzeby zmiany właściwej', 'dokształcanie pracowników', 0, 0, 1, 0, 3),
(10, 10, 'strukturalne', 'przyrostowe', 'obiektowe', 'wszystkie powyższe', 0, 0, 0, 1, 3),
(11, 11, 'do obróbki plików video', 'do odtwarzania muzyki', 'do nagrywania płyt', 'do przeglądania zdjęć ', 1, 0, 0, 0, 2),
(12, 12, 'jedna z dziedzin informatyki', 'nauka o umiejetności informowania', 'dział matematyki', 'nazwa firmy komputerowej ', 1, 0, 0, 0, 2),
(13, 13, 'graficznego', 'tekstowego', 'muzycznego', 'żadne z powyższych', 1, 0, 0, 0, 2),
(14, 14, 'LAN', 'WAN', 'MAN', 'Internet', 1, 0, 0, 0, 2),
(15, 15, 'bardzo szybki dysk twardy', 'rodzaj płyt DVD', 'zestaw stereo', 'urządzenie do przenoszenia danych z systemów komputerowych na taśmę magnetyczną ', 0, 0, 0, 1, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `pytania`
--

CREATE TABLE IF NOT EXISTS `pytania` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `pytanie` varchar(10000) NOT NULL,
  `id_egzaminu` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Zrzut danych tabeli `pytania`
--

INSERT INTO `pytania` (`id`, `pytanie`, `id_egzaminu`) VALUES
(1, 'Zaznacz prawidłową kolejność:', 1),
(2, 'Nazwa ERP (Enterprise Resource Planning) oznacza:', 1),
(3, 'Planowanie Zapotrzebowania Materiałowego to:', 1),
(4, 'Gromadzenie informacji polega na:', 1),
(5, 'Hardware to:', 1),
(6, 'Z jakich elementów składa się "warsztat" służący do tworzenia SI:', 3),
(7, 'Podaj etapy modelu spiralnego:', 3),
(8, 'System to:', 3),
(9, 'Partycypacja to:', 3),
(10, 'Jakie są metody tworzenia i opisu systemów informacyjnych?', 3),
(11, 'Do czego służy program Movie Maker?', 2),
(12, 'Co to jest technologia informacyjna?', 2),
(13, 'Rozszerzenie *.bmp pliku dotyczy pliku:', 2),
(14, 'Pod względem wielkości sieci najmniejszą siecią jest:', 2),
(15, 'Streamer to:', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `rejestracja`
--

CREATE TABLE IF NOT EXISTS `rejestracja` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `stopien` varchar(50) NOT NULL,
  `imie` varchar(40) NOT NULL,
  `nazwisko` varchar(40) NOT NULL,
  `login` varchar(30) NOT NULL,
  `haslo` varchar(35) NOT NULL,
  `email` varchar(100) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `rejestracja`
--

INSERT INTO `rejestracja` (`id`, `stopien`, `imie`, `nazwisko`, `login`, `haslo`, `email`, `data`) VALUES
(2, 'Dr inż.', 'Paweł', 'Pawłowicz', 'pawel', 'e10adc3949ba59abbe56e057f20f883e', 'pawel@email.pl', '2012-08-23'),
(3, 'Mgr', 'Katarzyna', 'Bratek', 'kasia', 'e10adc3949ba59abbe56e057f20f883e', 'kasia@email.pl', '2012-08-23'),
(4, 'Prof.', 'Wiesław', 'Stonoga', 'wiesiek', 'e10adc3949ba59abbe56e057f20f883e', 'wiesiek@email.pl', '2012-08-23'),
(1, 'admin', 'admin', 'admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@admin.pl', '2012-08-23'),
(5, 'Dr hab. inż.', 'Paulina', 'Szewczyk', 'paulina', 'e10adc3949ba59abbe56e057f20f883e', 'paulina@email.pl', '2012-08-24');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `wyniki`
--

CREATE TABLE IF NOT EXISTS `wyniki` (
  `id` int(40) NOT NULL AUTO_INCREMENT,
  `id_egzaminu` int(10) NOT NULL,
  `ocena` varchar(3) NOT NULL,
  `procent` double NOT NULL,
  `l_pop_odp` int(5) NOT NULL,
  `l_wsz_odp` int(5) NOT NULL,
  `imie_stud` varchar(40) NOT NULL,
  `nazwisko_stud` varchar(40) NOT NULL,
  `album` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Zrzut danych tabeli `wyniki`
--

INSERT INTO `wyniki` (`id`, `id_egzaminu`, `ocena`, `procent`, `l_pop_odp`, `l_wsz_odp`, `imie_stud`, `nazwisko_stud`, `album`) VALUES
(1, 1, '5', 100, 5, 5, 'Michał', 'Kubek', 10521),
(2, 1, '3+', 60, 3, 5, 'Patrycja', 'Nowak', 42215),
(3, 1, '4+', 80, 4, 5, 'Tomasz', 'Kowalski', 45120),
(4, 1, '4+', 80, 4, 5, 'Paulina', 'Pretko', 54451),
(5, 1, '2', 40, 2, 5, 'Bronisław', 'Tarta', 12001),
(6, 2, '4+', 80, 4, 5, 'Bartłomiej', 'Hak', 41100),
(7, 2, '2', 40, 2, 5, 'Monika', 'Pałasz', 41302),
(8, 2, '5', 100, 5, 5, 'Ewelina', 'Budka', 45123),
(9, 2, '2', 0, 0, 5, 'Marcin', 'Cyryl', 42111),
(10, 2, '4+', 80, 4, 5, 'Mariusz', 'Banasik', 54120),
(11, 1, '5', 100, 5, 5, 'Jan', 'Kowalski', 24115);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
