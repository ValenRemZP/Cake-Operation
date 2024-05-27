-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 09:14 AM
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
(9, 4, 'Cake', 'Delicious', 12.00, 'raf_360x360_075_t_fafafa_ca443f4786-removebg-preview.png', '2024-05-17 12:57:03', '2024-05-17 12:57:03');

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
(8, 6),
(5, 9),
(11, 9);

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
(10, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.pinterest.com%2Fpin%2F609393393322792039%2F&psig=AOvVaw1oQk2KsPXPM5VlhkLc9O4K&ust=1716017675697000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCKjh6pOWlIYDFQAAAAAdAAAAABAE', 'light'),
(11, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.pinterest.com%2Fpin%2F609393393322792039%2F&psig=AOvVaw1oQk2KsPXPM5VlhkLc9O4K&ust=1716017675697000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCKjh6pOWlIYDFQAAAAAdAAAAABAE', 'light'),
(12, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.pinterest.com%2Fpin%2F609393393322792039%2F&psig=AOvVaw1oQk2KsPXPM5VlhkLc9O4K&ust=1716017675697000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCKjh6pOWlIYDFQAAAAAdAAAAABAE', 'light'),
(13, 'https://static.vecteezy.com/system/resources/previews/024/198/824/original/profile-icon-or-symbol-in-pink-and-white-color-vector.jpg', 'light'),
(14, 'https://static.vecteezy.com/system/resources/previews/024/198/824/original/profile-icon-or-symbol-in-pink-and-white-color-vector.jpg', 'light'),
(15, 'https://static.vecteezy.com/system/resources/previews/024/198/824/original/profile-icon-or-symbol-in-pink-and-white-color-vector.jpg', 'light'),
(16, 'https://static.vecteezy.com/system/resources/previews/024/198/824/original/profile-icon-or-symbol-in-pink-and-white-color-vector.jpg', 'light'),
(17, 'https://static.vecteezy.com/system/resources/previews/024/198/824/original/profile-icon-or-symbol-in-pink-and-white-color-vector.jpg', 'light'),
(18, 'https://static.vecteezy.com/system/resources/previews/024/198/824/original/profile-icon-or-symbol-in-pink-and-white-color-vector.jpg', 'light'),
(19, 'https://static.vecteezy.com/system/resources/previews/024/198/824/original/profile-icon-or-symbol-in-pink-and-white-color-vector.jpg', 'light');

-- --------------------------------------------------------

--
-- Table structure for table `userpurchase`
--

CREATE TABLE `userpurchase` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `purchaseTime` datetime NOT NULL,
  `price` int(11) NOT NULL,
  `pdfFilename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userpurchase`
--

INSERT INTO `userpurchase` (`id`, `userid`, `purchaseTime`, `price`, `pdfFilename`) VALUES
(7, 16, '2024-05-27 01:39:55', 51, 'bills/Bill.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `userrole_mapping`
--

CREATE TABLE `userrole_mapping` (
  `userid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userrole_mapping`
--

INSERT INTO `userrole_mapping` (`userid`, `roleid`) VALUES
(16, 3),
(17, 3),
(18, 3),
(19, 3);

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
  `reset_token_expiry` varchar(255) NOT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `street`, `city`, `state`, `zipcode`, `reset_token`, `reset_token_expiry`, `updatedAt`, `createdAt`) VALUES
(16, 'a', 'kussulp@gmail.com', '$2y$10$wulLOPPe9DPN7E3E43Re..D4r9SFHIgyyIL7Gf79RtIJkBS1fOqr6', 'a', 'a', 's', 's', 's', 's', '4de7de926effe7139f93f4524081127d', '2024-05-27 10:11:56', '2024-05-27 07:11:56', '2024-05-26 22:51:22'),
(17, 'z', 'Remi@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$QmtGZi4veVBEMjIxMXVnZA$wxVOjSP7K9usgPUu8ZWnBzbL6io9a5Z3EQk9XriIQT4', 'z', 'z', '', '', '', '', '', '', '2024-05-26 22:51:47', '2024-05-26 22:51:47'),
(18, 'd', 'cat@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$Q1N1SGo2QnhXazZOdWRXVA$lxOtkl4Hj+y/hso3YIpR/5DdGzmnfiOUjKzjxiedC8c', 'd', 'd', '', '', '', '', '', '', '2024-05-26 23:02:29', '2024-05-26 23:02:29'),
(19, 'admin ', 'admin@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$ZWw2T3BPb3JqcDVYRjNNdg$eIImKtLMVbFeofGs+O1kzOmNDhP01yqSL6K/IAsS7Uk', 'admin', 'admin', '', '', '', '', '', '', '2024-05-27 07:00:41', '2024-05-27 07:00:41');

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
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userpurchase`
--
ALTER TABLE `userpurchase`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cakes`
--
ALTER TABLE `cakes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `userpurchase`
--
ALTER TABLE `userpurchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
