-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2020 at 09:33 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seni-religi`
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `agenda_category`
--

CREATE TABLE `agenda_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
(6, 'Diklat', '2020-02-10 10:34:02', '2020-02-11 10:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidang`
--

INSERT INTO `bidang` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(2, 'Bendahara', '2020-02-10 04:23:13', '2020-02-11 10:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `faculty` varchar(30) NOT NULL,
  `study_program` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id`, `name`, `faculty`, `study_program`, `created_at`, `updated_at`) VALUES
(2, 'Ghany Abdillah Ersa', 'filkom', 'information system', '2020-02-04 04:33:00', '2020-02-11 10:58:24'),
(3, 'Ghany Ersa', 'filkom', 'information system', '2020-02-14 03:32:32', '2020-02-14 03:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `nim` varchar(15) NOT NULL,
  `bidang_id` int(10) UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `birthday_date` date NOT NULL,
  `faculty` varchar(30) NOT NULL,
  `study_program` varchar(30) NOT NULL,
  `role` enum('PH','ANGGOTA') NOT NULL,
  `picture` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`nim`, `bidang_id`, `password`, `name`, `birthday_date`, `faculty`, `study_program`, `role`, `picture`, `created_at`, `updated_at`) VALUES
('165150401111060', 2, '$2y$10$9puUTdnk4plIUgmZKkuq6u7m8gxyRdaZAbNjScprnKgasqtlmfc3u', 'ghany Update', '1997-12-24', 'filkom', 'information system', 'ANGGOTA', 'C:/xampp/htdocs/seni-religi/uploads/profil/2020-02-11_16_51_profil-1651504011110601.jpg', '2020-01-02 10:42:24', '2020-02-16 08:23:07'),
('165150401111061', 2, '$2y$10$ylWY2q0DLtBQZBdsFUGnI.1RG4.bsD8Py7238i7kwysJUxvY/QOgC', 'ghany abdillah ersa B', '1997-12-24', 'filkom', 'information system', 'PH', 'C:/xampp/htdocs/seni-religi/uploads/profil/2020-02-04_11_42_profil-165150401111061.jpg', '2020-01-02 04:50:44', '2020-02-11 10:58:48'),
('165150401111063', 2, '$2y$10$QNzc1qle2n2zwNoodgQUwuXJbiES8XMG0o0WUD4VTdsCsWoJxKM1m', 'ghany abdillah ersa', '1997-12-24', 'filkom', 'information system', 'PH', NULL, '2020-02-12 03:40:14', '2020-02-12 03:40:14');

-- --------------------------------------------------------

--
-- Table structure for table `presensi_guest`
--

CREATE TABLE `presensi_guest` (
  `agenda_id` int(10) UNSIGNED NOT NULL,
  `guest_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `presensi_pengurus`
--

CREATE TABLE `presensi_pengurus` (
  `pengurus_nim` varchar(15) NOT NULL,
  `agenda_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agenda_category`
--
ALTER TABLE `agenda_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `presensi_guest_ibfk_2` FOREIGN KEY (`agenda_id`) REFERENCES `agenda` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `presensi_pengurus`
--
ALTER TABLE `presensi_pengurus`
  ADD CONSTRAINT `presensi_pengurus_ibfk_1` FOREIGN KEY (`agenda_id`) REFERENCES `agenda` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `presensi_pengurus_ibfk_2` FOREIGN KEY (`pengurus_nim`) REFERENCES `pengurus` (`nim`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
