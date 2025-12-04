-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2025 at 01:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simb`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `isbn` int(50) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `cover` varchar(50) NOT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `isbn`, `judul`, `tahun_terbit`, `id_kategori`, `penulis`, `penerbit`, `cover`, `tanggal_input`) VALUES
(58, 123456, 'Laskar Pelangi', '2020', 1, 'Andrea Hirata', 'Bintang Pustaka', 'Laskar Pelangi_Andrea Hirata.jpg', '2025-11-29 02:47:27'),
(59, 2147483647, 'Laut Bercerita', '2021', 1, 'Leila S. Chudori', 'Gramedia', 'Laut Bercerita_Leila S. Chudori.jpg', '2025-11-29 02:48:27'),
(62, 2147483647, 'Filosofi Teras', '2021', 2, 'Henry Manampiring', 'Bentang Pustaka', 'Filosofi Teras_Henry Manampiring.jpg', '2025-11-29 02:53:51'),
(65, 2147483647, 'Almond', '2022', 1, 'Won Pyung Sohn', 'Gramedia', 'Almond_Won Pyung Sohn.jpg', '2025-11-29 03:00:59'),
(66, 2147483647, 'Bumi Manusia', '2020', 1, 'Pramoedya Ananta Toer', 'Gramedia', 'Bumi Manusia_Pramoedya Ananta Toer.jpg', '2025-11-29 03:02:22'),
(67, 2147483647, 'Atomic Habits', '2020', 2, 'James Clear', 'Media Jaya', 'Atomic Habits_James Clear.jpg', '2025-11-29 03:03:34'),
(69, 1234567, 'apapun', '2030', 2, 'saya sendiri', 'rumah saya', 'apapun_saya sendiri.jpg', '2025-11-29 04:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Fiksi'),
(2, 'Non-Fiksi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `email`) VALUES
('khai', '$2y$10$Y3I8IwyVn6ORTpFSCv7ShOvmnndX1mB3.iYadTaDignE0iEnH6BiK', 'fatinkhai@gmail');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
