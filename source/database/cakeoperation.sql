-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 dec 2023 om 09:05
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cakeoperation`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cakecategories`
--

CREATE TABLE `cakecategories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `cakecategories`
--

INSERT INTO `cakecategories` (`id`, `name`) VALUES
(4, 'gluten free'),
(5, 'Sugar free'),
(6, 'Vegan');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cakes`
--

CREATE TABLE `cakes` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `imageUrl` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `cakes`
--

INSERT INTO `cakes` (`id`, `category_id`, `name`, `description`, `price`, `imageUrl`, `updatedAt`, `createdAt`) VALUES
(2, 6, 'qsdqsd', 'dqsdsqdd', 18.00, '1a262ec3655211d7403468096bf05173.jpg', '2023-12-01 08:04:38', '2023-12-01 08:04:38');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `cakeId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `favorites`
--

CREATE TABLE `favorites` (
  `userid` int(11) NOT NULL,
  `cakeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `userprofile`
--

CREATE TABLE `userprofile` (
  `id` int(11) NOT NULL,
  `profilePicture` varchar(255) NOT NULL,
  `theme` text NOT NULL DEFAULT 'light'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `userprofile`
--

INSERT INTO `userprofile` (`id`, `profilePicture`, `theme`) VALUES
(1, 'https://i.pinimg.com/564x/b1/27/e7/b127e748dee69963b2ef9065a138ad2c.jpg', 'light'),
(2, 'https://i.pinimg.com/564x/b1/27/e7/b127e748dee69963b2ef9065a138ad2c.jpg', 'light'),
(3, 'https://i.pinimg.com/564x/b1/27/e7/b127e748dee69963b2ef9065a138ad2c.jpg', 'light'),
(4, 'https://i.pinimg.com/564x/b1/27/e7/b127e748dee69963b2ef9065a138ad2c.jpg', 'light');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `userpurchase`
--

CREATE TABLE `userpurchase` (
  `id` int(11) NOT NULL,
  `purchaseTime` datetime NOT NULL,
  `cakeId` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `CakeName` int(11) NOT NULL,
  `cakeImage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `userrole_mapping`
--

CREATE TABLE `userrole_mapping` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `street` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zipcode` text NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `street`, `city`, `state`, `zipcode`, `reset_token`, `updatedAt`, `createdAt`) VALUES
(1, 'Cat', 'cat@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$REJGb05xUmhXTzMuZGdtMw$ZwS2MESmPz61Epd0hZlfBP+9m/YelUYp7o0xw0QeYqo', 'aaaaaaaa', 'AAAAAAAAAAAA', 'qsdq', 'qsdqsd', 'qsdqsd', 'qsdsqd', '', '2023-12-01 07:58:00', '2023-11-26 16:23:34'),
(2, 'mari', 'marilili@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$QVI2ODV1V1ZYOGtwZTB4OQ$IYxL6UzU7iWKWbQjCvDssIr4F56DeINj20zaiF8WPlM', 'aaaaaaaa', 'adasd', '', '', '', '', '', '2023-11-26 22:30:42', '2023-11-26 22:30:42'),
(3, 'lili', 'mail@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$SFE3NlhUMnlNekhpa2VtWA$4tno1MQYyeCPZRAcyDDu6EKOFhuNTnbZEiEJgMrnQ1Q', 'asdasd', 'adasd', '', '', '', '', '', '2023-11-26 22:32:18', '2023-11-26 22:32:18'),
(4, 'cake', 'cake@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$T3Jhcld0SzdrTXIwNU9BTg$ZCy0q7f/6LBncWuBYU2/hGqzmAgaP8E5Isduv1HYUuE', 'ss', 'adasd', '', '', '', '', '', '2023-11-26 22:35:11', '2023-11-26 22:35:11');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(3, 'admin'),
(1, 'guest'),
(2, 'user');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `cakecategories`
--
ALTER TABLE `cakecategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`(768));

--
-- Indexen voor tabel `cakes`
--
ALTER TABLE `cakes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `name` (`name`),
  ADD KEY `description` (`description`(768)),
  ADD KEY `description_2` (`description`(768));

--
-- Indexen voor tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `cakeId` (`cakeId`);

--
-- Indexen voor tabel `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`email`);

--
-- Indexen voor tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `cakecategories`
--
ALTER TABLE `cakecategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `cakes`
--
ALTER TABLE `cakes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_cakeId` FOREIGN KEY (`cakeId`) REFERENCES `cakes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
