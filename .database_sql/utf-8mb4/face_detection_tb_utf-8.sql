-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2021 at 02:46 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

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

-- --------------------------------------------------------

--
-- Table structure for table `eligibility`
--

CREATE TABLE `eligibility` (
  `id_eligibilty` int(11) NOT NULL COMMENT 'รหัสสิทธิ์เข้าห้อง',
  `id_mem` int(11) NOT NULL COMMENT 'ไอดีผู้ที่ต้องการเข้าห้อง',
  `id_room` int(11) NOT NULL COMMENT 'ไอดีที่ผู้ใช้เข้าห้องได้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id_mem` int(11) NOT NULL COMMENT 'ไอดีผู้ใช้',
  `id_code` varchar(13) NOT NULL COMMENT 'รหัสบัตรประชาชน',
  `name` varchar(50) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `last_name` varchar(50) NOT NULL COMMENT 'นามสกุลผู้ใช้',
  `e_mail` varchar(100) NOT NULL COMMENT 'อีเมลผู้ใช้',
  `pass` varchar(25) NOT NULL COMMENT 'รหัสผ่านเข้าระบบ',
  `phone` varchar(10) NOT NULL COMMENT 'เบอร์ติดต่อ',
  `position` varchar(60) NOT NULL COMMENT 'ตำเเหน่ง',
  `stu_face` int(11) DEFAULT 0 COMMENT 'สถานะอัพโหลดภาพ 0 = ยังไม่อัพ 1 = อัพโหลดแล้ว'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id_room` int(11) NOT NULL COMMENT 'ไอดีห้อง',
  `room_id_code` varchar(30) NOT NULL COMMENT 'รหัสประจำเครื่อ',
  `room_num` varchar(20) NOT NULL COMMENT 'ชื่อห้อง',
  `room_fstatus` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะเปิด-ปิดไฟ 0=ปิด 1=เปิด',
  `room_open` time NOT NULL DEFAULT '00:00:00' COMMENT 'เวลาเปิดไฟห้อง',
  `room_dclose` time NOT NULL DEFAULT '00:00:00' COMMENT 'เวลาปิดไฟ',
  `status_door` int(11) NOT NULL DEFAULT 0 COMMENT 'สถานะเปิด-ปิดประตู 0 = ปิด 1= เปิด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rqroom`
--

CREATE TABLE `rqroom` (
  `rq_id` int(11) NOT NULL COMMENT 'ไอดีขอใช้ห้อง',
  `id_mem` int(11) NOT NULL COMMENT 'ไอดีผู้ขอใช้ห้อง',
  `id_room` int(11) NOT NULL COMMENT 'ไอดีห้องที่ต้องการใช้',
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาขอใช้ห้อง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id_ schedule` int(11) NOT NULL COMMENT 'ไอดีประวัติเข้าใช้ห้อง',
  `id_mem` int(11) NOT NULL COMMENT 'ไอดีผู้ใช้ที่ใช้ห้อง',
  `id_code` varchar(15) NOT NULL COMMENT 'รหัสบัตรประจำตัว',
  `full_name` varchar(50) NOT NULL COMMENT 'ชื่อผู้ที่เข้าห้อง',
  `id_room` int(11) NOT NULL COMMENT 'ไอดีห้องที่ใช้งาน',
  `room_name` varchar(50) NOT NULL COMMENT 'ห้องผู้ใช้เข้า',
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'เวลาใช้งานห้อง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbadmin`
--

CREATE TABLE `tbadmin` (
  `id_admin` int(11) NOT NULL COMMENT 'ไอดีลำดับผู้ดูแลระบบ',
  `name_ad` varchar(50) NOT NULL COMMENT 'ชื่อเรียกผู้ดูแลระบบ',
  `pass_ad` varchar(20) NOT NULL COMMENT 'รหัสผ่านเข้าใช้งาน',
  `e_emil_ad` varchar(100) NOT NULL COMMENT 'อีเมลผู้ดูแลระบบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbimage`
--

CREATE TABLE `tbimage` (
  `id_tbimage` int(11) NOT NULL COMMENT 'ไอดีตารางภาพ',
  `id_mem` int(11) NOT NULL COMMENT 'ไอดีผู้ใช้',
  `path_image` varchar(100) NOT NULL COMMENT 'ที่อยู่ภาพ',
  `name_image` varchar(30) NOT NULL COMMENT 'ชื่อรูปภาพ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `id_mem` (`id_mem`),
  ADD KEY `id_room` (`id_room`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id_ schedule`),
  ADD KEY `id_mem` (`id_mem`),
  ADD KEY `id_room` (`id_room`);

--
-- Indexes for table `tbadmin`
--
ALTER TABLE `tbadmin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbimage`
--
ALTER TABLE `tbimage`
  ADD PRIMARY KEY (`id_tbimage`),
  ADD KEY `id_mem` (`id_mem`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eligibility`
--
ALTER TABLE `eligibility`
  MODIFY `id_eligibilty` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสิทธิ์เข้าห้อง';

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id_mem` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีผู้ใช้';

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีห้อง';

--
-- AUTO_INCREMENT for table `rqroom`
--
ALTER TABLE `rqroom`
  MODIFY `rq_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีขอใช้ห้อง';

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id_ schedule` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีประวัติเข้าใช้ห้อง';

--
-- AUTO_INCREMENT for table `tbadmin`
--
ALTER TABLE `tbadmin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีลำดับผู้ดูแลระบบ';

--
-- AUTO_INCREMENT for table `tbimage`
--
ALTER TABLE `tbimage`
  MODIFY `id_tbimage` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีตารางภาพ';

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
