-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2025 at 01:27 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kuliah_dbpuskesmas`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kec_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`id`, `nama`, `kec_id`) VALUES
(1, 'Beji', 1),
(2, 'Depok Jaya', 2),
(3, 'Cipayung', 3),
(4, 'Cinere', 4),
(5, 'Tapos', 5);

-- --------------------------------------------------------

--
-- Table structure for table `paramedik`
--

CREATE TABLE `paramedik` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gender` char(1) NOT NULL,
  `tmp_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kategori` enum('dokter','perawat','apoteker','') NOT NULL,
  `telpon` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `unit_kerja_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paramedik`
--

INSERT INTO `paramedik` (`id`, `nama`, `gender`, `tmp_lahir`, `tgl_lahir`, `kategori`, `telpon`, `alamat`, `unit_kerja_id`) VALUES
(1, 'Dr. Aditya Nugraha', 'L', 'Jakarta', '1985-05-20', 'dokter', '081234567890', 'Jl. Sudirman No. 15', 1),
(2, 'Siti Marlina', 'P', 'Depok', '1990-08-12', 'perawat', '081345678901', 'Jl. Kartini No. 8', 2),
(3, 'Budi Rahmat', 'L', 'Bogor', '1988-03-05', 'apoteker', '081456789012', 'Jl. Ahmad Yani No. 20', 5),
(4, 'Dewi Kusuma', 'P', 'Bandung', '1992-11-25', 'perawat', '081567890123', 'Jl. Pemuda No. 30', 2),
(5, 'Dr. Intan Permatasari', 'P', 'Bekasi', '1987-02-15', 'dokter', '081678901234', 'Jl. Melati No. 11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `tmp_lahir` varchar(45) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `gender` char(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kelurahan_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `kode`, `nama`, `tmp_lahir`, `tgl_lahir`, `gender`, `email`, `alamat`, `kelurahan_id`) VALUES
(1, 'P001', 'Andi Saputra', 'Depok', '1995-04-12', 'L', 'andi.saputra@gmail.com', 'Jl. Merpati No. 10', 1),
(2, 'P002', 'Siti Rahma', 'Jakarta', '1998-09-23', 'P', 'siti.rahma@yahoo.com', 'Jl. Anggrek Raya No. 5', 2),
(3, 'P003', 'Budi Santoso', 'Bogor', '1990-01-15', 'L', 'budi.santoso@outlook.com', 'Jl. Kenanga No. 20', 3),
(4, 'P004', 'Dewi Lestari', 'Bandung', '1992-07-08', 'P', 'dewi.lestari@gmail.com', 'Jl. Melati Putih No. 12', 4),
(5, 'P005', 'Rizky Pratama', 'Bekasi', '1997-11-30', 'L', 'rizky.pratama@hotmail.com', 'Jl. Dahlia Indah No. 7', 5);

-- --------------------------------------------------------

--
-- Table structure for table `periksa`
--

CREATE TABLE `periksa` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `berat` double NOT NULL,
  `tinggi` double NOT NULL,
  `tensi` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `pasien_id` int NOT NULL,
  `paramedik_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periksa`
--

INSERT INTO `periksa` (`id`, `tanggal`, `berat`, `tinggi`, `tensi`, `keterangan`, `pasien_id`, `paramedik_id`) VALUES
(1, '2025-04-26', 70.5, 170, '120/80', 'Pemeriksaan rutin, pasien dalam kondisi sehat.', 1, 1),
(2, '2025-04-25', 55, 160, '130/85', 'Pasien mengeluh sakit kepala ringan.', 2, 2),
(3, '2025-04-24', 80, 175, '140/90', 'Pasien dalam kondisi tekanan darah tinggi, perlu kontrol lebih lanjut.', 3, 3),
(4, '2025-04-26', 64, 178, '100/80', 'Dummy 1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `id` int NOT NULL,
  `nama` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`id`, `nama`) VALUES
(1, 'UGD'),
(2, 'Poli Umum'),
(3, 'Poli Gigi'),
(4, 'Laboratorium'),
(5, 'Farmasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paramedik`
--
ALTER TABLE `paramedik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_kerja_id` (`unit_kerja_id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelurahan_id` (`kelurahan_id`);

--
-- Indexes for table `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paramedik_id` (`paramedik_id`),
  ADD KEY `pasien_id` (`pasien_id`);

--
-- Indexes for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paramedik`
--
ALTER TABLE `paramedik`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `paramedik`
--
ALTER TABLE `paramedik`
  ADD CONSTRAINT `paramedik_ibfk_1` FOREIGN KEY (`unit_kerja_id`) REFERENCES `unit_kerja` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `pasien_ibfk_1` FOREIGN KEY (`kelurahan_id`) REFERENCES `kelurahan` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `periksa`
--
ALTER TABLE `periksa`
  ADD CONSTRAINT `periksa_ibfk_1` FOREIGN KEY (`paramedik_id`) REFERENCES `paramedik` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `periksa_ibfk_2` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
