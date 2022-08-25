-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Sie 2022, 19:06
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wypcar`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `auta`
--

CREATE TABLE `auta` (
  `ID` int(11) NOT NULL,
  `Marka` varchar(20) NOT NULL,
  `Model` varchar(20) NOT NULL,
  `Cena` int(11) NOT NULL,
  `Wypozyczony` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `auta`
--

INSERT INTO `auta` (`ID`, `Marka`, `Model`, `Cena`, `Wypozyczony`) VALUES
(1, 'Toyota', 'Yaris', 200, 0),
(2, 'Mazda', 'CX-3', 300, 0),
(3, 'Skoda', 'Fabia', 1000, 0),
(4, 'Toyota', 'Corolla', 2000, 0),
(5, 'Opel', 'Astra', 500, 0),
(6, 'Opel', 'Vectra', 200, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `ID` int(11) NOT NULL,
  `Login` varchar(20) NOT NULL,
  `Haslo` varchar(64) NOT NULL,
  `Grupa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`ID`, `Login`, `Haslo`, `Grupa`) VALUES
(1, 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Administrator'),
(2, 'pracownik', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Pracownik'),
(3, 'user', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Uzytkownik');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenia`
--

CREATE TABLE `wypozyczenia` (
  `ID` int(11) NOT NULL,
  `ID_Uzytkownika` int(11) NOT NULL,
  `ID_Samochodu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Wyzwalacze `wypozyczenia`
--
DELIMITER $$
CREATE TRIGGER `Niewypozyczony` BEFORE DELETE ON `wypozyczenia` FOR EACH ROW BEGIN
UPDATE auta INNER JOIN wypozyczenia on auta.ID=wypozyczenia.ID_Samochodu SET Wypozyczony = 0 WHERE auta.ID=wypozyczenia.ID_Samochodu;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Wypozyczony` AFTER INSERT ON `wypozyczenia` FOR EACH ROW BEGIN
UPDATE auta INNER JOIN wypozyczenia on auta.ID=wypozyczenia.ID_Samochodu SET Wypozyczony = 1 WHERE auta.ID=wypozyczenia.ID_Samochodu;
END
$$
DELIMITER ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `auta`
--
ALTER TABLE `auta`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Uzytkownika` (`ID_Uzytkownika`),
  ADD KEY `ID_Samochodu` (`ID_Samochodu`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `auta`
--
ALTER TABLE `auta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD CONSTRAINT `wypozyczenia_ibfk_1` FOREIGN KEY (`ID_Uzytkownika`) REFERENCES `uzytkownicy` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `wypozyczenia_ibfk_2` FOREIGN KEY (`ID_Samochodu`) REFERENCES `auta` (`ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
