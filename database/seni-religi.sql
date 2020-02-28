-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 29, 2020 at 12:45 AM
-- Server version: 5.7.27-log
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myghanco_igni460`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` int(10) UNSIGNED NOT NULL,
  `pengurus_nim` varchar(15) NOT NULL,
  `agenda_category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `location` text NOT NULL,
  `start_at` datetime NOT NULL,
  `end_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `agenda_category`
--

CREATE TABLE `agenda_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agenda_category`
--

INSERT INTO `agenda_category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Pembinaan', '2020-02-10 10:32:43', '2020-02-11 10:57:45'),
(2, 'YKS', '2020-02-10 10:29:21', '2020-02-11 10:57:48'),
(3, 'Piket', '2020-02-10 10:34:13', '2020-02-11 10:57:52'),
(4, 'Muhadhoroh', '2020-02-10 10:33:57', '2020-02-11 10:57:55'),
(5, 'Evaluasi', '2020-02-10 10:34:08', '2020-02-11 10:57:59'),
(6, 'Diklat', '2020-02-10 10:34:02', '2020-02-11 10:58:07'),
(8, 'Pembinaan', '2020-02-13 09:28:32', '2020-02-13 09:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidang`
--

INSERT INTO `bidang` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(2, 'Bendahara', '2020-02-10 04:23:13', '2020-02-11 10:58:15'),
(3, 'Khattil Qur an', '2020-02-13 09:26:33', '2020-02-13 09:26:33'),
(4, 'Syarhil Qur an', '2020-02-13 09:26:56', '2020-02-13 09:26:56'),
(5, 'Tilawatil Qur an', '2020-02-13 09:27:06', '2020-02-13 09:27:06'),
(6, 'Hifdzil Qur an', '2020-02-13 09:27:16', '2020-02-13 09:27:16'),
(7, 'Fahmil Qur an', '2020-02-13 09:27:23', '2020-02-13 09:27:23'),
(8, 'Karya Ilmiah Qur an', '2020-02-13 09:27:33', '2020-02-13 09:27:33'),
(9, 'Nasyid', '2020-02-13 09:27:41', '2020-02-13 09:27:41'),
(10, 'Hadrah Al-Banjari', '2020-02-13 09:27:54', '2020-02-13 09:27:54');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `faculty` varchar(30) NOT NULL,
  `study_program` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `nim` varchar(15) NOT NULL,
  `bidang_id` int(10) UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `birthday_date` date NOT NULL,
  `faculty` varchar(30) NOT NULL,
  `study_program` varchar(30) NOT NULL,
  `role` enum('PH','ANGGOTA') NOT NULL,
  `picture` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `presensi_guest`
--

CREATE TABLE `presensi_guest` (
  `agenda_id` int(10) UNSIGNED NOT NULL,
  `guest_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `presensi_pengurus`
--

CREATE TABLE `presensi_pengurus` (
  `pengurus_nim` varchar(15) NOT NULL,
  `agenda_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agenda_FKIndex1` (`agenda_category_id`),
  ADD KEY `agenda_FKIndex2` (`pengurus_nim`);

--
-- Indexes for table `agenda_category`
--
ALTER TABLE `agenda_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `pengurus_FKIndex1` (`bidang_id`);

--
-- Indexes for table `presensi_guest`
--
ALTER TABLE `presensi_guest`
  ADD PRIMARY KEY (`agenda_id`,`guest_id`),
  ADD KEY `presensi_guest_FKIndex1` (`guest_id`),
  ADD KEY `presensi_guest_FKIndex2` (`agenda_id`);

--
-- Indexes for table `presensi_pengurus`
--
ALTER TABLE `presensi_pengurus`
  ADD PRIMARY KEY (`pengurus_nim`,`agenda_id`),
  ADD KEY `presensi_pengurus_FKIndex1` (`agenda_id`),
  ADD KEY `presensi_pengurus_FKIndex2` (`pengurus_nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `agenda_category`
--
ALTER TABLE `agenda_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`agenda_category_id`) REFERENCES `agenda_category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`pengurus_nim`) REFERENCES `pengurus` (`nim`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD CONSTRAINT `pengurus_ibfk_1` FOREIGN KEY (`bidang_id`) REFERENCES `bidang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `presensi_guest`
--
ALTER TABLE `presensi_guest`
  ADD CONSTRAINT `presensi_guest_ibfk_1` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `presensi_guest_ibfk_2` FOREIGN KEY (`agenda_id`) REFERENCES `agenda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `presensi_pengurus`
--
ALTER TABLE `presensi_pengurus`
  ADD CONSTRAINT `presensi_pengurus_ibfk_1` FOREIGN KEY (`agenda_id`) REFERENCES `agenda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `presensi_pengurus_ibfk_2` FOREIGN KEY (`pengurus_nim`) REFERENCES `pengurus` (`nim`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
