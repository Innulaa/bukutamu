-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 21, 2025 at 05:58 PM
-- Server version: 10.4.21-MariaDB-log
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bukutamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$.fQF9u0oZzTw6J0jBPFStu2HhF5nLOIeJDr4CzC2oneyu7dv56pdS');

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` int(11) NOT NULL,
  `nama_departemen` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `nama_departemen`, `created_at`) VALUES
(1, 'HRD', '2025-06-21 16:17:25'),
(2, 'Keuangan', '2025-06-21 16:17:25'),
(3, 'IT', '2025-06-21 16:17:25'),
(4, 'Marketing', '2025-06-21 16:36:53'),
(6, 'Pelayanan', '2025-06-21 16:52:42'),
(8, 'SDM', '2025-06-21 17:10:24'),
(9, 'Konsultan', '2025-06-21 17:43:05');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama_jabatan`, `created_at`) VALUES
(1, 'Direktur Utama', '2025-06-21 10:22:23'),
(2, 'Sekretaris', '2025-06-21 10:22:23'),
(3, 'SPV', '2025-06-21 10:22:23'),
(4, 'Manajer', '2025-06-21 10:22:23'),
(5, 'Direktur Keuangan', '2025-06-21 10:22:23'),
(6, 'Manager Pemasaran', '2025-06-21 10:22:23'),
(7, 'Office Boyy', '2025-06-21 10:22:23');

-- --------------------------------------------------------

--
-- Table structure for table `keperluan`
--

CREATE TABLE `keperluan` (
  `id` int(11) NOT NULL,
  `nama_keperluan` varchar(100) NOT NULL,
  `departemen_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keperluan`
--

INSERT INTO `keperluan` (`id`, `nama_keperluan`, `departemen_id`, `created_at`) VALUES
(1, 'Interview', 1, '2025-06-21 17:03:49'),
(2, 'Meeting', 2, '2025-06-21 17:03:49'),
(3, 'Magang', 8, '2025-06-21 17:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `id_jabatan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama_petugas`, `id_jabatan`) VALUES
(1, 'Pak Budi', 1),
(2, 'Bu Sari', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `keperluan` varchar(100) DEFAULT NULL,
  `petugas` varchar(100) DEFAULT NULL,
  `departemen` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `instansi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`id`, `nama`, `tanggal`, `keperluan`, `petugas`, `departemen`, `telepon`, `instansi`) VALUES
(1, 'Intan Nur Laila', '2025-06-09', 'Interview', 'Pak Budi', 'HRD', '0867653930', 'Kantor'),
(2, 'jordan fernandez', '2005-06-13', 'Interview', 'Pak Budi', 'Keuangan', '087688900', 'Fernandez Group'),
(3, 'Alveric cavariuss', '2025-06-20', 'Meeting', 'Pak Budi', 'IT', '0856789890', 'Alveric Group'),
(6, 'Zainab', '2025-06-22', 'Meeting', 'Bu Sari', 'IT', '086784657', 'Fernandez Group');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','resepsionis') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin1', '$2y$10$aGK17F8MOKioPeOQ9aMYVuQZZ6hoX/7jHSMexZ4rMj6KHXchgaSwW', 'admin'),
(2, 'resepsionis1', '$2y$10$UEBMClMmQh5HEk4.fvaEcuu1yGtw2FXjZcv8pyNMpNgY.uJ7a6oMG', 'resepsionis');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keperluan`
--
ALTER TABLE `keperluan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jabatan` (`id_jabatan`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `keperluan`
--
ALTER TABLE `keperluan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tamu`
--
ALTER TABLE `tamu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `fk_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`),
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
