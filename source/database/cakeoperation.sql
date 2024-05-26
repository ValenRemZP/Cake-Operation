-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 09:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
-- Table structure for table `cakecategories`
--

CREATE TABLE `cakecategories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cakecategories`
--

INSERT INTO `cakecategories` (`id`, `name`) VALUES
(4, 'gluten free'),
(5, 'Sugar free'),
(6, 'Vegan');

-- --------------------------------------------------------

--
-- Table structure for table `cakes`
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
-- Dumping data for table `cakes`
--

INSERT INTO `cakes` (`id`, `category_id`, `name`, `description`, `price`, `imageUrl`, `updatedAt`, `createdAt`) VALUES
(6, 4, 'Chocolate ganache cake', 'Chocolate Ganache cake is a fluffy and tender layered cake complete with butterscotch buttercream and a homemade butterscotch sauce drizzle.', 56.00, 'chocolate-ganache-cake-FI.jpg', '2024-05-13 08:02:13', '2024-05-13 08:02:13'),
(7, 5, 'Buttercream Cake', 'Buttercream Cake is a fluffy and tender layered cake complete with butterscotch buttercream and a homemade butterscotch sauce drizzle.', 50.99, 'ButtercreamCake_11_30bea246-9d9f-4a33-82ce-8ac6539f8727.webp', '2024-05-13 08:03:30', '2024-05-13 08:03:30'),
(8, 5, 'DDD', 'DDD', 24.00, 'Broklyn.png', '2024-05-13 12:59:08', '2024-05-13 12:59:08');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `cakeId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `userid` int(11) NOT NULL,
  `cakeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`userid`, `cakeid`) VALUES
(5, 3),
(5, 4),
(5, 7),
(8, 6);

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `id` int(11) NOT NULL,
  `profilePicture` varchar(255) NOT NULL,
  `theme` text NOT NULL DEFAULT 'light'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`id`, `profilePicture`, `theme`) VALUES
(1, 'https://i.pinimg.com/564x/b1/27/e7/b127e748dee69963b2ef9065a138ad2c.jpg', 'light'),
(2, 'https://i.pinimg.com/564x/b1/27/e7/b127e748dee69963b2ef9065a138ad2c.jpg', 'light'),
(3, 'https://i.pinimg.com/564x/b1/27/e7/b127e748dee69963b2ef9065a138ad2c.jpg', 'light'),
(4, 'https://i.pinimg.com/564x/b1/27/e7/b127e748dee69963b2ef9065a138ad2c.jpg', 'light'),
(5, 'https://static.vecteezy.com/system/resources/previews/024/198/824/original/profile-icon-or-symbol-in-pink-and-white-color-vector.jpg', 'light'),
(6, 'https://i.pinimg.com/564x/b1/27/e7/b127e748dee69963b2ef9065a138ad2c.jpg', 'light'),
(7, 'https://i.pinimg.com/564x/b1/27/e7/b127e748dee69963b2ef9065a138ad2c.jpg', 'light'),
(8, 'https://i.pinimg.com/564x/b1/27/e7/b127e748dee69963b2ef9065a138ad2c.jpg', 'light');

-- --------------------------------------------------------

--
-- Table structure for table `userpurchase`
--

CREATE TABLE `userpurchase` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `purchaseTime` datetime NOT NULL,
  `cakeId` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `CakeName` int(11) NOT NULL,
  `cakeImage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userrole_mapping`
--

CREATE TABLE `userrole_mapping` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `street`, `city`, `state`, `zipcode`, `reset_token`, `updatedAt`, `createdAt`) VALUES
(2, 'mari', 'marilili@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$QVI2ODV1V1ZYOGtwZTB4OQ$IYxL6UzU7iWKWbQjCvDssIr4F56DeINj20zaiF8WPlM', 'aaaaaaaa', 'adasd', '', '', '', '', '', '2023-11-26 22:30:42', '2023-11-26 22:30:42'),
(3, 'lili', 'mail@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$SFE3NlhUMnlNekhpa2VtWA$4tno1MQYyeCPZRAcyDDu6EKOFhuNTnbZEiEJgMrnQ1Q', 'asdasd', 'adasd', '', '', '', '', '', '2023-11-26 22:32:18', '2023-11-26 22:32:18'),
(4, 'cake', 'cake@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$T3Jhcld0SzdrTXIwNU9BTg$ZCy0q7f/6LBncWuBYU2/hGqzmAgaP8E5Isduv1HYUuE', 'ss', 'adasd', '', '', '', '', '', '2023-11-26 22:35:11', '2023-11-26 22:35:11'),
(5, 'Remimito', 'Remi@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$YVZOODVELmpEejNhWXdhaw$egTP1vSvd1dQo2hXZl0//hsS8cV4Idwpc/Hv34yN2BI', 'Remi', 'Lopez', 'xxx', 'xxx', 'xxx', 'xxx', '', '2024-05-13 01:18:21', '2024-05-13 01:11:36'),
(8, 'cat', 'cat@gmail.com', '$2y$10$sYfw0vPkulHnvwlCbQnmxe.YXs.8qRi1RjiABDgf8sAUyaFcBaNTi', 'cat', 'cat', 'Ss', 'S', 'SD', 'DD', '', '2024-05-13 12:59:30', '2024-05-13 12:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(3, 'admin'),
(1, 'guest'),
(2, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cakecategories`
--
ALTER TABLE `cakecategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`(768));

--
-- Indexes for table `cakes`
--
ALTER TABLE `cakes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `name` (`name`),
  ADD KEY `description` (`description`(768)),
  ADD KEY `description_2` (`description`(768)),
  ADD KEY `name_2` (`name`);
ALTER TABLE `cakes` ADD FULLTEXT KEY `idx_name_description` (`name`,`description`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `cakeId` (`cakeId`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`email`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cakecategories`
--
ALTER TABLE `cakecategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cakes`
--
ALTER TABLE `cakes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_cakeId` FOREIGN KEY (`cakeId`) REFERENCES `cakes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cart_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
