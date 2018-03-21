-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 21 Mar 2018, 06:13
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
  `id` int(11) NOT NULL COMMENT 'id pojazdu',
  `model` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `brand` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `engine` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `fuel` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `mileage` int(11) NOT NULL,
  `production_year` smallint(6) NOT NULL,
  `gearshift` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `vin` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `air_conditioning` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `registration_number` varchar(63) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `car`
--

INSERT INTO `car` (`id`, `model`, `brand`, `version`, `engine`, `fuel`, `mileage`, `production_year`, `gearshift`, `vin`, `air_conditioning`, `registration_number`) VALUES
(1, 'A3', 'Audi', 'SLine', '2.0', 'diesel', 120000, 2016, 'Automatyczna, 5 biegów', '3GTEC14T36G260999', 'Automatyczna', 'WA24573'),
(2, 'Passat', 'Volgkswagen', 'Facelift', '1.9', 'Diesel', 250000, 2006, 'Automatyczna, 6 biegów', '3FALP15P0VR126814', 'Automatyczna, dwustrefowa', 'KN4318S'),
(3, 'A4', 'Audi', 'Prestige', '2.0', 'Diesel', 23123123, 2012, 'Automatyczna', '2312312313131', 'Klimatronik', 'KN723AS');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL COMMENT 'notice id',
  `car_id` int(11) DEFAULT NULL COMMENT 'id pojazdu',
  `created_at` datetime NOT NULL COMMENT 'created at date',
  `expired_at` datetime NOT NULL COMMENT 'created at date',
  `is_active` tinyint(1) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `notice`
--

INSERT INTO `notice` (`id`, `car_id`, `created_at`, `expired_at`, `is_active`, `price`) VALUES
(1, 1, '2018-03-08 00:00:00', '2018-03-09 00:00:00', 1, 150),
(2, 2, '2018-03-08 00:00:00', '2018-03-27 00:00:00', 0, 2992),
(5, 3, '2018-03-12 19:02:20', '2018-03-26 00:00:00', 0, 245);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rentalOrder`
--

CREATE TABLE `rentalOrder` (
  `id` int(11) NOT NULL COMMENT 'notice id',
  `notice_id` int(11) DEFAULT NULL COMMENT 'notice id',
  `user_id` int(11) DEFAULT NULL COMMENT 'id użytkownika',
  `created_at` datetime NOT NULL COMMENT 'Created at date',
  `rent_from` datetime NOT NULL COMMENT 'Rent from date',
  `rent_to` datetime NOT NULL COMMENT 'Rent to date',
  `days_quantity` smallint(6) NOT NULL COMMENT 'Quanity of order days',
  `total_cost` double NOT NULL COMMENT 'Total cost of order',
  `status` enum('pending','approved','rejected') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `rentalOrder`
--

INSERT INTO `rentalOrder` (`id`, `notice_id`, `user_id`, `created_at`, `rent_from`, `rent_to`, `days_quantity`, `total_cost`, `status`) VALUES
(7, 2, 11, '2018-03-20 22:53:53', '2018-03-20 00:00:00', '2018-03-21 00:00:00', 1, 2992, 'approved'),
(8, 5, 12, '2018-03-20 23:00:09', '2018-03-20 00:00:00', '2018-03-23 00:00:00', 3, 735, 'rejected');

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
  `is_active` tinyint(1) NOT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`idUser`, `userName`, `email`, `first_name`, `last_name`, `gender`, `birthday`, `password`, `salt`, `is_active`, `roles`) VALUES
(3, 'pepe', 'bielu000@o.2pl', 'Patryk', 'Biel', 'male', '1994-03-17', 'EwoW6XH5Sh6bBaEKd8B6+KJV2b2IVsPji4jIdwnwxl88Gu1P3565YQ==', 'Og3Zy+M3WdUwHQ==', 1, ''),
(11, 'adata', 'bielu000@o.2pl', 'P', 'B', 'male', '1994-03-17', 'mt+5Uu6OgATub1X1GUWKfIBhidcjjbnrh08TfvmVzBCbApZJ9y4reQ==', 'IRjpKLoYxC9oZA==', 1, '[\"ROLE_ADMIN\"]'),
(12, 'pbiel', 'bielu000@o.2pl', 'Patryk', 'Biel', 'male', '1994-03-17', 'atWeCXHcFd9xV3kc+K46RFgBQR9Lu5WcZ8N2v7r6JnzihB1geAb0Hg==', 'rCWQE0WAG0ZN3A==', 1, '[\"ROLE_USER\"]');

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
  ADD UNIQUE KEY `UNIQ_E6819347A76ED395` (`user_id`),
  ADD UNIQUE KEY `UNIQ_E68193477D540AB` (`notice_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id pojazdu', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'notice id', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `rentalOrder`
--
ALTER TABLE `rentalOrder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'notice id', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id użytkownika', AUTO_INCREMENT=13;

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
