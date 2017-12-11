-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2017 at 06:19 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restro`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_shop_category`
--

CREATE TABLE `client_shop_category` (
  `id` int(11) NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `category_id` varchar(32) NOT NULL,
  `category` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_shop_details`
--

CREATE TABLE `client_shop_details` (
  `id` int(11) NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address_one` varchar(30) NOT NULL,
  `address_two` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `phone` int(10) NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_shop_details`
--

INSERT INTO `client_shop_details` (`id`, `client_id`, `name`, `address_one`, `address_two`, `city`, `country`, `postcode`, `phone`, `info`) VALUES
(1, '5d41402abc4b2a76b9719d911017c592', 'Pizza Hut', 'restr', 'ghdgsd', 'Hexham', 'United Kingdom', 'NE41UE', 1234567890, ''),
(2, '202cb962ac59075b964b07152d234b70', 'SecondRestro', 'addone1', 'addtwo2', 'Hexham', 'United Kingdom', 'NE1234', 0, ''),
(3, '5d41402abc4b2a76b9719d688917c592', 'Corbridge', 'Adr1', 'Adr2', '', '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `client_shop_menu`
--

CREATE TABLE `client_shop_menu` (
  `id` int(11) NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `category_id` varchar(32) NOT NULL,
  `category` varchar(32) NOT NULL,
  `item_topic` varchar(32) NOT NULL,
  `item_desc` varchar(200) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_shop_owners`
--

CREATE TABLE `client_shop_owners` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `mobile` int(10) NOT NULL,
  `address_one` varchar(30) NOT NULL,
  `address_two` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `postcode` int(6) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_shop_owners`
--

INSERT INTO `client_shop_owners` (`id`, `email`, `client_id`, `firstname`, `lastname`, `mobile`, `address_one`, `address_two`, `city`, `country`, `postcode`, `updated_at`) VALUES
(1, 'akshay@gmail.com', '5d41402abc4b2a76b9719d911017c592', 'Akshay', 'Kumar', 1234567895, '', '', '', '', 625006, '2017-12-10 22:52:18'),
(2, 'usernameh@gmail.com', '202cb962ac59075b964b07152d234b70', 'Name2', 'Lastname2', 1234567891, 'add1', 'add2', 'city', 'cuntru', 625362, '0000-00-00 00:00:00'),
(3, 'corbridge@gmail.com', '5d41402abc4b2a76b9719d688917c592', 'Corbridge', 'CH', 1234567809, 'address one', 'address two', 'Corbridge', 'UK', 625006, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `client_shop_search`
--

CREATE TABLE `client_shop_search` (
  `id` int(11) NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `active` char(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `profile_img` varchar(150) NOT NULL,
  `cuisine` text NOT NULL,
  `delivery_fee` int(3) NOT NULL,
  `delivery_dis` int(2) NOT NULL,
  `min_order` int(3) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `category` varchar(50) NOT NULL,
  `sub_category` varchar(50) NOT NULL,
  `table_dir` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_shop_search`
--

INSERT INTO `client_shop_search` (`id`, `client_id`, `active`, `name`, `profile_img`, `cuisine`, `delivery_fee`, `delivery_dis`, `min_order`, `lat`, `lng`, `category`, `sub_category`, `table_dir`, `city`) VALUES
(2, '5d41402abc4b2a76b9719d911017c592', 'Y', 'Pizza Hut', '', '', 1, 2, 8, 54.973286, -2.095061, 'Restaurant', 'Takeaway', 'client_shop_menu', 'Hexham'),
(3, '202cb962ac59075b964b07152d234b70', 'Y', 'SecondRestro', '', '', 1, 3, 6, 54.971877, -2.100992, 'Restaurant', 'Takeaway', '', ''),
(4, '5d41402abc4b2a76b9719d688917c592', 'Y', 'Corbridge', '', '', 2, 7, 10, 54.968306, -1.985878, 'Restaurant', 'Takeaway', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `error_handles`
--

CREATE TABLE `error_handles` (
  `id` int(11) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `errors` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_login`
--

CREATE TABLE `users_login` (
  `id` int(11) NOT NULL,
  `profile_status` char(1) NOT NULL DEFAULT 'N',
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` char(1) NOT NULL DEFAULT 'U',
  `name` varchar(50) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(120) NOT NULL,
  `last_changed` timestamp NULL DEFAULT NULL,
  `token` varchar(500) DEFAULT NULL,
  `mobile` int(10) DEFAULT NULL,
  `verified_mob` char(1) NOT NULL DEFAULT 'N',
  `verified_email` char(1) NOT NULL DEFAULT 'N',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_login`
--

INSERT INTO `users_login` (`id`, `profile_status`, `joined`, `type`, `name`, `email`, `password`, `last_changed`, `token`, `mobile`, `verified_mob`, `verified_email`, `updated_at`) VALUES
(1, 'N', '2017-12-05 20:46:22', 'U', 'Test', 'username@gmail.com', '$2y$10$L3LTdPQAlaEtCh2V8EcwnO/uv2rZ1AMmZ3iaR4svPzuUL5vC2TRSC', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1MTI5NDA1MTMsImV4cCI6MzAyNzA5MDYyNiwiaXNzIjoiZ3Nkcm9pZC5jb20iLCJkYXRhIjp7InVzciI6IlRlc3QiLCJ0eXBlIjoiVSIsImVtYWlsIjoidXNlcm5hbWVAZ21haWwuY29tIn19.Jkyo1n0I6iaj7VEzs5Ia71cvg848fCQNeMddklKi3kYxD0r2RdzSre30NgrMo0kgJfg5w1rD802rG-gwTN_ZKVijcbHAjP01I5B4nzlyv_VsO9n2ERI3pR1xKeyd9mJkiZxhpy6jpB7SIAQ7tM-ZbvMA6PKGEtQBKDMQipl5X7k', 1234567890, '', '', '2017-12-10 21:15:13'),
(2, 'N', '2017-12-05 21:50:43', 'U', 'Test2', 'usernameh@gmail.com', '$2y$10$OflNGOLMHxOFn5V5gUSsgeGAIAvhUwE1m1eVqNlsHVaIILWhxfBEi', '2017-12-05 21:50:43', 'eyJ0eXAiOiJKV1QiLCJhbGcdsadahhsddsadaaiOiJSUzI1NiJ9.eyJpc3MiOiJnc2Ryb2lkLmNvbSIsImF1ZCI6ImdzZHJvaWQuY29tIiwidXNyIjoidXNlcm5hbWVoQGdtYWlsLmNvbSIsInR5cGUiOiJVIn0.WXhF41PvgUUAo2k_217gRsLrw2AzQJLzPg-HX7FmO_G756-TJhmr5MBgHOMS-71MaLNmXoK-6mv1_SF3H1M8eCOPVACLih20bnfeJohQJhU1kJeOmBcErxZkVaulkA2Yvfj2DtIgXIxC', 1234567895, '', '', '2017-12-10 20:43:02'),
(3, 'N', '2017-12-05 23:42:22', 'U', 'asdsadghf', 'usernam@gmail.com', '$2y$10$bPJGMIxgzhhtxFDxtOsY9.K72GoAfB1LaxPoZbUdYH6ZM2gU.cURG', '2017-12-05 23:42:22', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJnc2Ryb2lkLmNvbSIsImF1ZCI6ImdzZHJvaWQuY29tIiwidXNyIjoidXNlcm5hbUBnbWFpbC5jb20iLCJ0eXBlIjoiVSJ9.aOjaQo5fzhBFGexqmNzudyIePa1Nd7nqSADNc0JxnISfQfUzkGkjgjeVSP-tIOEkli1EtPasDncimtaSseGDxW4vYfcEcDKYsNzmgbNiVBfcynvV0lifWXccYDErt9T2XQMMU_sNi1CPprh5hzWhtp6qBzRCg3', 1234567894, '', '', '2017-12-05 23:42:22'),
(4, 'N', '2017-12-05 23:44:07', 'U', 'Akshay', 'akshay@gmail.com', '$2y$10$dO3IN05IIink0miMmIAf2u5pintq.OPcad/WtOucYmTRl5ITPhwY2', '2017-12-05 23:44:07', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJnc2Ryb2lkLmNvbSIsImF1ZCI6ImdzZHJvaWQuY29tIiwidXNyIjoiYWtzaGF5QGdtYWlsLmNvbSIsInR5cGUiOiJVIn0.t99FBl5sfGOm3HvAhpm2vNXgiBxYJ9Ts58GTf8pRoaqy9nZjAa9nYxUTs0B1L2Fl6ykHvGEGkdbOtfrsEuZaTGkTe3MvQzu4gGbW1VWSKhTybtXXPnuGK6fjSVQuKsDfw7WayNifEiccdhr-zmCtd_0lRyhLmjF', 1234567891, '', '', '2017-12-05 23:44:07'),
(5, 'N', '2017-12-05 20:46:22', 'C', 'Corbridge', 'corbridge@gmail.com', '$2y$10$L3LTdPQAlaEtCh2V8EcwnO/uv2rZ1AMmZ3iaR4svPzuUL5vC2TRSC', NULL, '', 1234567809, '', '', '2017-12-10 21:15:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `mobile` int(10) NOT NULL,
  `address_one` varchar(30) NOT NULL,
  `address_two` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `postcode` int(6) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `email`, `firstname`, `lastname`, `mobile`, `address_one`, `address_two`, `city`, `country`, `postcode`, `updated_at`) VALUES
(1, 'username@gmail.com', 'Test', 'Ravichandran', 1234567890, 'ddddddddddddddd', 'ddddddddddf', 'Delhi', 'India', 123456, '2017-12-07 18:20:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_shop_category`
--
ALTER TABLE `client_shop_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `client_shop_details`
--
ALTER TABLE `client_shop_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `client_id` (`client_id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `client_shop_menu`
--
ALTER TABLE `client_shop_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `client_shop_owners`
--
ALTER TABLE `client_shop_owners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `client_id` (`client_id`);

--
-- Indexes for table `client_shop_search`
--
ALTER TABLE `client_shop_search`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `client_id` (`client_id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `error_handles`
--
ALTER TABLE `error_handles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_shop_category`
--
ALTER TABLE `client_shop_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_shop_details`
--
ALTER TABLE `client_shop_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client_shop_menu`
--
ALTER TABLE `client_shop_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_shop_owners`
--
ALTER TABLE `client_shop_owners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client_shop_search`
--
ALTER TABLE `client_shop_search`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `error_handles`
--
ALTER TABLE `error_handles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_login`
--
ALTER TABLE `users_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_shop_category`
--
ALTER TABLE `client_shop_category`
  ADD CONSTRAINT `client_shop_category_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_shop_search` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client_shop_details`
--
ALTER TABLE `client_shop_details`
  ADD CONSTRAINT `client_shop_details_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_shop_owners` (`client_id`);

--
-- Constraints for table `client_shop_menu`
--
ALTER TABLE `client_shop_menu`
  ADD CONSTRAINT `client_shop_menu_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_shop_category` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `client_shop_menu_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `client_shop_category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client_shop_owners`
--
ALTER TABLE `client_shop_owners`
  ADD CONSTRAINT `client_shop_owners_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users_login` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `client_shop_owners_ibfk_2` FOREIGN KEY (`mobile`) REFERENCES `users_login` (`mobile`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client_shop_search`
--
ALTER TABLE `client_shop_search`
  ADD CONSTRAINT `client_shop_search_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_shop_details` (`client_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `client_shop_search_ibfk_3` FOREIGN KEY (`name`) REFERENCES `client_shop_details` (`name`) ON UPDATE CASCADE;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users_login` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_profile_ibfk_2` FOREIGN KEY (`mobile`) REFERENCES `users_login` (`mobile`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
