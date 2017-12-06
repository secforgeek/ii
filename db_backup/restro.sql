-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2017 at 12:53 AM
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
-- Table structure for table `client_profile`
--

CREATE TABLE `client_profile` (
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

-- --------------------------------------------------------

--
-- Table structure for table `client_shop_details`
--

CREATE TABLE `client_shop_details` (
  `id` int(11) NOT NULL,
  `client_id` varchar(32) NOT NULL,
  `active` char(1) NOT NULL,
  `store_status` char(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `profile_img` text NOT NULL,
  `address_one` varchar(30) NOT NULL,
  `address_two` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `pin` varchar(6) NOT NULL,
  `info` text NOT NULL,
  `delivery_price` int(3) NOT NULL,
  `minimum_order` int(3) NOT NULL,
  `distance_km` int(2) NOT NULL
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
  `token` varchar(300) DEFAULT NULL,
  `mobile` int(10) DEFAULT NULL,
  `verified_mob` char(1) NOT NULL DEFAULT 'N',
  `verified_email` char(1) NOT NULL DEFAULT 'N',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_login`
--

INSERT INTO `users_login` (`id`, `profile_status`, `joined`, `type`, `name`, `email`, `password`, `last_changed`, `token`, `mobile`, `verified_mob`, `verified_email`, `updated_at`) VALUES
(1, 'N', '2017-12-05 20:46:22', 'U', 'Test1', 'username@gmail.com', '$2y$10$L3LTdPQAlaEtCh2V8EcwnO/uv2rZ1AMmZ3iaR4svPzuUL5vC2TRSC', NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE1MTI1OTUxODcsImV4cCI6MzAyNjM5OTk3NCwiaXNzIjoiZ3Nkcm9pZC5jb20iLCJkYXRhIjp7InVzciI6IlRlc3QxIiwidHlwZSI6IlUiLCJlbWFpbCI6InVzZXJuYW1lQGdtYWlsLmNvbSJ9fQ.qoIex2T6wbDMotUAaS47gB6fwxvn56FXBPRIEunuEkLTP4rhNq5jyiSx17lAYxvstAspm3zqLFM09KoaIIi2qgz1TTfbX-pmsG3RfFfC', 1234567890, '', '', '2017-12-06 21:19:47'),
(2, 'N', '2017-12-05 21:50:43', 'U', 'Test2', 'usernameh@gmail.com', '$2y$10$OflNGOLMHxOFn5V5gUSsgeGAIAvhUwE1m1eVqNlsHVaIILWhxfBEi', '2017-12-05 21:50:43', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJnc2Ryb2lkLmNvbSIsImF1ZCI6ImdzZHJvaWQuY29tIiwidXNyIjoidXNlcm5hbWVoQGdtYWlsLmNvbSIsInR5cGUiOiJVIn0.WXhF41PvgUUAo2k_217gRsLrw2AzQJLzPg-HX7FmO_G756-TJhmr5MBgHOMS-71MaLNmXoK-6mv1_SF3H1M8eCOPVACLih20bnfeJohQJhU1kJeOmBcErxZkVaulkA2Yvfj2DtIgXIxCfXnHS6xFzkgvcnA', 1234567895, '', '', '2017-12-06 21:12:21'),
(3, 'N', '2017-12-05 23:42:22', 'U', 'asdsadghf', 'usernam@gmail.com', '$2y$10$bPJGMIxgzhhtxFDxtOsY9.K72GoAfB1LaxPoZbUdYH6ZM2gU.cURG', '2017-12-05 23:42:22', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJnc2Ryb2lkLmNvbSIsImF1ZCI6ImdzZHJvaWQuY29tIiwidXNyIjoidXNlcm5hbUBnbWFpbC5jb20iLCJ0eXBlIjoiVSJ9.aOjaQo5fzhBFGexqmNzudyIePa1Nd7nqSADNc0JxnISfQfUzkGkjgjeVSP-tIOEkli1EtPasDncimtaSseGDxW4vYfcEcDKYsNzmgbNiVBfcynvV0lifWXccYDErt9T2XQMMU_sNi1CPprh5hzWhtp6qBzRCg3', 1234567894, '', '', '2017-12-05 23:42:22'),
(4, 'N', '2017-12-05 23:44:07', 'U', 'Akshay', 'akshay@gmail.com', '$2y$10$dO3IN05IIink0miMmIAf2u5pintq.OPcad/WtOucYmTRl5ITPhwY2', '2017-12-05 23:44:07', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJnc2Ryb2lkLmNvbSIsImF1ZCI6ImdzZHJvaWQuY29tIiwidXNyIjoiYWtzaGF5QGdtYWlsLmNvbSIsInR5cGUiOiJVIn0.t99FBl5sfGOm3HvAhpm2vNXgiBxYJ9Ts58GTf8pRoaqy9nZjAa9nYxUTs0B1L2Fl6ykHvGEGkdbOtfrsEuZaTGkTe3MvQzu4gGbW1VWSKhTybtXXPnuGK6fjSVQuKsDfw7WayNifEiccdhr-zmCtd_0lRyhLmjF', 1234567891, '', '', '2017-12-05 23:44:07');

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
-- Indexes for dumped tables
--

--
-- Indexes for table `client_profile`
--
ALTER TABLE `client_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `client_id` (`client_id`);

--
-- Indexes for table `client_shop_details`
--
ALTER TABLE `client_shop_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `client_id` (`client_id`);

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
-- AUTO_INCREMENT for table `client_profile`
--
ALTER TABLE `client_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_shop_details`
--
ALTER TABLE `client_shop_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_login`
--
ALTER TABLE `users_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_profile`
--
ALTER TABLE `client_profile`
  ADD CONSTRAINT `client_profile_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users_login` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `client_profile_ibfk_2` FOREIGN KEY (`mobile`) REFERENCES `users_login` (`mobile`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client_shop_details`
--
ALTER TABLE `client_shop_details`
  ADD CONSTRAINT `client_shop_details_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client_profile` (`client_id`);

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
