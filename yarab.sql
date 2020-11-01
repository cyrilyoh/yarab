-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2020 at 10:11 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yarab`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(150) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `verification_key` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `subscription` enum('story','comment','poll','') NOT NULL,
  `type` enum('admin','user') NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `phone`, `dob`, `email`, `verification_key`, `password`, `country`, `subscription`, `type`, `status`) VALUES
(1, 'Admin', '', 0, '0000-00-00', 'admin@gmail.com', '', '21232f297a57a5a743894a0e4a801fc3', '', '', 'admin', 1),
(32, 'CYRIL', 'YOHANNAN', 9995669083, '2020-11-20', 'cyril.yoh@gmail.com', '09fc64c22da364ab8df9147a3adb3179', '81dc9bdb52d04dc20036dbd8313ed055', 'United Kingdom', 'story', 'user', 1),
(33, 'new ', 'hman', 4487654321, '1989-02-04', 'ghg@jhd.com', '4e9b33ff8996425d2189e27b6525c85a', 'e10adc3949ba59abbe56e057f20f883e', 'United Kingdom', 'story', 'user', 0),
(34, 'john', 'kennedy', 4478945612, '7895-04-05', 'john@gmail.com', '7640eff788a122ad0e8f03d6347a72d6', '202cb962ac59075b964b07152d234b70', 'United Kingdom', 'story', 'user', 0),
(35, 'Ten', 'Sen', 4478945612, '1887-04-05', 'ten@dfg.com', '813d8569550c989ff47ec6e22b92b285', 'b5e50dc6642a7fce5f623c097de86fa1', 'United Kingdom', 'story', 'user', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
