-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 28, 2026 at 06:57 PM
-- Server version: 8.0.30
-- PHP Version: 8.5.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `islamic_center`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(4, 'admin1', '$2y$12$fMtn8NuYJEKZ7uxB1hszIefPeq66of6zwh6cDh0IQH5kd1xl/5fHW'),
(5, 'admin2', '$2y$12$Rjmo598C6ia7n7pbm6oMJOfn1OThbYsO9C53i.KodDTU4YsYMEJH.');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `deskripsi`, `gambar`, `created_at`) VALUES
(8, 'Menara Islamic ', '', '1776332677_69e0af85ef153.jpg', '2026-04-16 09:44:37'),
(10, 'View dari atas Menara Islamic', '', '1776332708_69e0afa48fc78.jpg', '2026-04-16 09:45:08'),
(13, 'View dari atas Menara Islamic', '', '1776332728_69e0afb8ca97e.jpg', '2026-04-16 09:45:28'),
(14, 'Ruang Duduk Cafeteria', '', '1776332748_69e0afccaa84a.jpg', '2026-04-16 09:45:48'),
(15, 'Pintu Masuk', '', '1776332762_69e0afda9c846.JPG', '2026-04-16 09:46:02'),
(17, 'View didalam Menara', '', '1776332780_69e0afec97e7e.JPG', '2026-04-16 09:46:20'),
(26, 'View dari Menara', '', '1777399975_69f0f8a745231.jpeg', '2026-04-28 18:12:55'),
(27, 'View Dari Menara', '', '1777399988_69f0f8b405f82.jpeg', '2026-04-28 18:13:08'),
(28, 'View Dari Menara', '', '1777399999_69f0f8bf81690.jpeg', '2026-04-28 18:13:19'),
(29, 'Bangunan Menara', '', '1777400008_69f0f8c8ec202.jpeg', '2026-04-28 18:13:28'),
(30, 'Lift', '', '1777400048_69f0f8f0a50cf.jpeg', '2026-04-28 18:14:08');

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `sesi` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `no_wa` varchar(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Tunggu',
  `tanggal_kunjungan` date DEFAULT NULL,
  `jam_kunjungan` time DEFAULT NULL,
  `kode_booking` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id`, `nama`, `jumlah`, `sesi`, `created_at`, `no_wa`, `status`, `tanggal_kunjungan`, `jam_kunjungan`, `kode_booking`) VALUES
(36, 'test', 10, 'Siang', '2026-04-28 16:00:32', '6282146218068', 'Dibayar', '2026-04-29', NULL, 'IC-20260428-8241'),
(37, 'test', 100, 'Pagi', '2026-04-28 16:00:54', '6282146218068', 'Menunggu Pembayaran', '2026-04-29', NULL, 'IC-20260428-7206'),
(38, 'Darel Prasetya', 10, 'sore', '2026-04-28 18:32:44', '6282146218068', 'Menunggu Pembayaran', '2026-04-29', NULL, 'IC-20260428-8086');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `sesi` enum('Pagi','Siang','Sore') DEFAULT 'Pagi',
  `komentar` text,
  `rating` int DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `nama`, `sesi`, `komentar`, `rating`, `gambar`, `created_at`) VALUES
(33, 'test', 'Sore', 'testestest', 5, 'assets/images/review/time_1777304392_69ef8348f35aa.jpg', '2026-04-27 15:39:52'),
(34, 'asdasd', 'Sore', 'asdasd', 5, NULL, '2026-04-28 12:07:24'),
(35, 'test', 'Siang', 'test', 5, NULL, '2026-04-28 18:30:44'),
(36, 'Darel Prasetya', 'Siang', 'Bagus', 5, 'assets/images/review/time_1777401064_69f0fce8ca7ad.jpeg', '2026-04-28 18:31:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
