-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 20, 2021 at 06:15 AM
-- Server version: 8.0.26-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `face_detection`
--
CREATE DATABASE IF NOT EXISTS `face_detection` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `face_detection`;

-- --------------------------------------------------------

--
-- Table structure for table `eligibility`
--

CREATE TABLE `eligibility` (
  `id_eligibilty` int NOT NULL,
  `id_men` int NOT NULL,
  `id_room` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id_mem` int NOT NULL,
  `id_code` varchar(13) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `e_main` varchar(100) NOT NULL,
  `pass` varchar(25) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `stu_face` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id_room` int NOT NULL,
  `room_num` varchar(20) NOT NULL,
  `room_fstatus` int NOT NULL,
  `room_dclose` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `rqroom`
--

CREATE TABLE `rqroom` (
  `rq_id` int NOT NULL,
  `id_men` int NOT NULL,
  `id_room` int NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id_ schedule` int NOT NULL,
  `id_men` int NOT NULL,
  `id_room` int NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tbadmin`
--

CREATE TABLE `tbadmin` (
  `id_admin` int NOT NULL,
  `name_ad` varchar(50) NOT NULL,
  `pass_ad` varchar(20) NOT NULL,
  `e_emil_ad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tbimage`
--

CREATE TABLE `tbimage` (
  `id_tbimage` int NOT NULL,
  `id_mem` int NOT NULL,
  `path_image` varchar(100) NOT NULL,
  `name_image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eligibility`
--
ALTER TABLE `eligibility`
  ADD PRIMARY KEY (`id_eligibilty`),
  ADD KEY `e_mem` (`id_men`),
  ADD KEY `e_room` (`id_room`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_mem`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id_room`);

--
-- Indexes for table `rqroom`
--
ALTER TABLE `rqroom`
  ADD PRIMARY KEY (`rq_id`),
  ADD KEY `s` (`id_men`),
  ADD KEY `sd` (`id_room`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id_ schedule`),
  ADD KEY `id_mem` (`id_men`),
  ADD KEY `id_room` (`id_room`);

--
-- Indexes for table `tbimage`
--
ALTER TABLE `tbimage`
  ADD PRIMARY KEY (`id_tbimage`),
  ADD KEY `tb` (`id_mem`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eligibility`
--
ALTER TABLE `eligibility`
  MODIFY `id_eligibilty` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id_mem` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id_room` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rqroom`
--
ALTER TABLE `rqroom`
  MODIFY `rq_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id_ schedule` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbimage`
--
ALTER TABLE `tbimage`
  MODIFY `id_tbimage` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eligibility`
--
ALTER TABLE `eligibility`
  ADD CONSTRAINT `e_mem` FOREIGN KEY (`id_men`) REFERENCES `members` (`id_mem`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `e_room` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id_room`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `rqroom`
--
ALTER TABLE `rqroom`
  ADD CONSTRAINT `s` FOREIGN KEY (`id_men`) REFERENCES `members` (`id_mem`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `sd` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id_room`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `id_mem` FOREIGN KEY (`id_men`) REFERENCES `members` (`id_mem`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `id_room` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id_room`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbimage`
--
ALTER TABLE `tbimage`
  ADD CONSTRAINT `tb` FOREIGN KEY (`id_mem`) REFERENCES `members` (`id_mem`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
