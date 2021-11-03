-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2021 at 08:12 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

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
  `id_eligibilty` int(11) NOT NULL,
  `id_mem` int(11) NOT NULL,
  `id_room` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eligibility`
--

INSERT INTO `eligibility` (`id_eligibilty`, `id_mem`, `id_room`) VALUES
(6, 37, 1);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id_mem` int(11) NOT NULL,
  `id_code` varchar(13) NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `e_mail` varchar(100) NOT NULL,
  `pass` varchar(25) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `position` varchar(60) NOT NULL,
  `stu_face` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id_mem`, `id_code`, `name`, `last_name`, `e_mail`, `pass`, `phone`, `position`, `stu_face`) VALUES
(37, '1339900662224', 'SOMPHOL', 'WILA', 'std.62122710108@ubrru.ac.th', '1234', '0971271931', 'นักศึกษา', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id_room` int(11) NOT NULL,
  `room_num` varchar(20) NOT NULL,
  `room_fstatus` int(11) NOT NULL DEFAULT 0,
  `room_dclose` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id_room`, `room_num`, `room_fstatus`, `room_dclose`) VALUES
(1, 'ห้องนอน', 0, '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rqroom`
--

CREATE TABLE `rqroom` (
  `rq_id` int(11) NOT NULL,
  `id_mem` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rqroom`
--

INSERT INTO `rqroom` (`rq_id`, `id_mem`, `id_room`, `time_stamp`) VALUES
(20, 37, 1, '2021-10-30 03:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id_ schedule` int(11) NOT NULL,
  `id_mem` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id_ schedule`, `id_mem`, `id_room`, `time_stamp`) VALUES
(2, 37, 1, '2021-10-30 05:43:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbadmin`
--

CREATE TABLE `tbadmin` (
  `id_admin` int(11) NOT NULL,
  `name_ad` varchar(50) NOT NULL,
  `pass_ad` varchar(20) NOT NULL,
  `e_emil_ad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbimage`
--

CREATE TABLE `tbimage` (
  `id_tbimage` int(11) NOT NULL,
  `id_mem` int(11) NOT NULL,
  `path_image` varchar(100) NOT NULL,
  `name_image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eligibility`
--
ALTER TABLE `eligibility`
  ADD PRIMARY KEY (`id_eligibilty`),
  ADD KEY `e_mem` (`id_mem`),
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
  ADD KEY `s` (`id_mem`),
  ADD KEY `sd` (`id_room`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id_ schedule`),
  ADD KEY `id_mem` (`id_mem`),
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
  MODIFY `id_eligibilty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id_mem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `rqroom`
--
ALTER TABLE `rqroom`
  MODIFY `rq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id_ schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbimage`
--
ALTER TABLE `tbimage`
  MODIFY `id_tbimage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eligibility`
--
ALTER TABLE `eligibility`
  ADD CONSTRAINT `e_mem` FOREIGN KEY (`id_mem`) REFERENCES `members` (`id_mem`),
  ADD CONSTRAINT `e_room` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id_room`);

--
-- Constraints for table `rqroom`
--
ALTER TABLE `rqroom`
  ADD CONSTRAINT `s` FOREIGN KEY (`id_mem`) REFERENCES `members` (`id_mem`),
  ADD CONSTRAINT `sd` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id_room`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `id_mem` FOREIGN KEY (`id_mem`) REFERENCES `members` (`id_mem`),
  ADD CONSTRAINT `id_room` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id_room`);

--
-- Constraints for table `tbimage`
--
ALTER TABLE `tbimage`
  ADD CONSTRAINT `tb` FOREIGN KEY (`id_mem`) REFERENCES `members` (`id_mem`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
