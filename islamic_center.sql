-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2026 at 04:53 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.30

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
(18, 'Dinding Informasi Terkait Menara', '', '1776332799_69e0afff9c457.jpeg', '2026-04-16 09:46:39'),
(19, 'Bar Cafeteria', 'bagus', '1776332843_69e0b02ba4ff7.jpg', '2026-04-16 09:47:23'),
(20, 'logo islamic', 'test', '1776520581_69e38d8569322.jpg', '2026-04-18 13:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `sesi` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `no_wa` varchar(20) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Tunggu',
  `tanggal_kunjungan` date DEFAULT NULL,
  `jam_kunjungan` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengunjung`
--

INSERT INTO `pengunjung` (`id`, `nama`, `email`, `jumlah`, `sesi`, `created_at`, `no_wa`, `status`, `tanggal_kunjungan`, `jam_kunjungan`) VALUES
(11, 'darel', 'darel2227@gmail.com', 20, 'Pagi', '2026-04-19 07:16:36', '6282146218068', 'Dibatalkan', '2026-04-19', NULL),
(12, 'darel', 'darel@gmail.com', 50, 'Sore', '2026-04-19 08:34:11', '082146218068', 'Dibayar', '2026-04-24', NULL),
(13, 'admin', 'admin@gmail.com', 200, 'Sore', '2026-04-19 14:16:46', '0812345678', 'Selesai', '2026-04-25', NULL),
(14, 'darel', 'darel@gmail.com', 3, 'Pagi', '2026-04-19 14:18:15', '6282146218068', 'Menunggu Pembayaran', '2026-04-30', NULL),
(15, 'test', 'test@gmail.com', 10, 'sore', '2026-04-19 14:41:46', '6282146218068', 'Tunggu', '2026-04-24', NULL),
(16, 'darel', 'darel@gmail.com', 30, 'sore', '2026-04-20 04:49:17', '6282146218068', 'Tunggu', '2026-04-30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `komentar` text,
  `rating` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `nama`, `komentar`, `rating`, `created_at`) VALUES
(1, 'Test', 'test', 1, '2026-04-15 13:14:47'),
(2, 'saya', 'keeren', 5, '2026-04-15 13:24:02'),
(3, 'p', '123', 4, '2026-04-15 13:55:56'),
(4, 'test3', 'islamic sangat keren', 5, '2026-04-15 14:14:24'),
(5, 'darel', 'sangat bagus dan keren', 5, '2026-04-18 14:03:20'),
(10, 'messi', 'sangat bagus', 5, '2026-04-19 13:38:56');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
