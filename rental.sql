-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 07 Mar 2018, 06:36
-- Wersja serwera: 10.1.26-MariaDB
-- Wersja PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `rental`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL COMMENT 'id pojazdu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL COMMENT 'notice id',
  `car_id` int(11) DEFAULT NULL COMMENT 'id pojazdu',
  `created_at` datetime NOT NULL COMMENT 'created at date',
  `expired_at` datetime NOT NULL COMMENT 'created at date',
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rentalOrder`
--

CREATE TABLE `rentalOrder` (
  `id` int(11) NOT NULL COMMENT 'notice id',
  `notice_id` int(11) DEFAULT NULL COMMENT 'notice id',
  `user_id` int(11) DEFAULT NULL COMMENT 'id użytkownika',
  `rent_from` datetime NOT NULL COMMENT 'Rent from date',
  `rent_to` datetime NOT NULL COMMENT 'Rent to date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL COMMENT 'id użytkownika',
  `userName` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'imię',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'email użytkownika',
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'imię',
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'nazwisko',
  `gender` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'płeć',
  `birthday` date NOT NULL COMMENT 'płeć',
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'password',
  `salt` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'salt',
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_480D45C2C3C6F69F` (`car_id`);

--
-- Indexes for table `rentalOrder`
--
ALTER TABLE `rentalOrder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E68193477D540AB` (`notice_id`),
  ADD KEY `IDX_E6819347A76ED395` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pojazdu';

--
-- AUTO_INCREMENT dla tabeli `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'notice id';

--
-- AUTO_INCREMENT dla tabeli `rentalOrder`
--
ALTER TABLE `rentalOrder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'notice id';

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id użytkownika';

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `notice`
--
ALTER TABLE `notice`
  ADD CONSTRAINT `FK_480D45C2C3C6F69F` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`);

--
-- Ograniczenia dla tabeli `rentalOrder`
--
ALTER TABLE `rentalOrder`
  ADD CONSTRAINT `FK_E68193477D540AB` FOREIGN KEY (`notice_id`) REFERENCES `notice` (`id`),
  ADD CONSTRAINT `FK_E6819347A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
