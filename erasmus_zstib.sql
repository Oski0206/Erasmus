-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Sty 2023, 14:11
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `erasmus_zstib`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `er_artykuły`
--

CREATE TABLE `er_artykuły` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) NOT NULL,
  `treść` text NOT NULL,
  `sekcja` int(11) NOT NULL,
  `autor_anon` tinyint(1) NOT NULL,
  `autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `er_sekcja`
--

CREATE TABLE `er_sekcja` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `er_sekcja`
--

INSERT INTO `er_sekcja` (`id`, `nazwa`) VALUES
(1, 'programista'),
(2, 'gastronomia');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `er_użytkownik`
--

CREATE TABLE `er_użytkownik` (
  `id` int(11) NOT NULL,
  `login` varchar(150) NOT NULL,
  `haslo` varchar(60) NOT NULL,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(100) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `programista_art` tinyint(1) NOT NULL,
  `gastronomia_art` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `er_użytkownik`
--

INSERT INTO `er_użytkownik` (`id`, `login`, `haslo`, `imie`, `nazwisko`, `admin`, `programista_art`, `gastronomia_art`) VALUES
(1, 'admin.admin', '$2y$10$AIwdd7hBb38QiJoQFTUf1OffVZYSFxa5HkBduLkhOJTLIxKbr6HT6', 'Administrator', 'A', 1, 1, 1),
(2, 'patryk.widlo', '$2y$10$SvbMyf5ehaE8e2MeHS./1OF8tvOG.E.qCq2SaCx/BO6hN2J9BEGSa', 'Patryk', 'Widło', 1, 1, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `er_artykuły`
--
ALTER TABLE `er_artykuły`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sekcja` (`sekcja`),
  ADD KEY `artykuły_ibfk_1` (`autor`);

--
-- Indeksy dla tabeli `er_sekcja`
--
ALTER TABLE `er_sekcja`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `er_użytkownik`
--
ALTER TABLE `er_użytkownik`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `er_artykuły`
--
ALTER TABLE `er_artykuły`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `er_sekcja`
--
ALTER TABLE `er_sekcja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `er_użytkownik`
--
ALTER TABLE `er_użytkownik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `er_artykuły`
--
ALTER TABLE `er_artykuły`
  ADD CONSTRAINT `er_artykuły_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `er_użytkownik` (`id`),
  ADD CONSTRAINT `er_artykuły_ibfk_2` FOREIGN KEY (`sekcja`) REFERENCES `er_sekcja` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
