-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2026 at 06:10 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_ti1c_qonitahilyatulfirdausa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_karyawan`
--

CREATE TABLE `tabel_karyawan` (
  `id_karyawan` int NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `hari_kerja_masuk` int NOT NULL,
  `gaji_dasar_per_hari` decimal(10,2) NOT NULL,
  `jenis_karyawan` enum('Kontrak','Tetap','Magang') NOT NULL,
  `durasi_kontrak_bulan` int DEFAULT NULL,
  `agensi_penyalur` varchar(100) DEFAULT NULL,
  `tunjangan_kesehatan` decimal(10,2) DEFAULT NULL,
  `opsi_saham_id` varchar(50) DEFAULT NULL,
  `uang_saku_bulanan` decimal(10,2) DEFAULT NULL,
  `sertifikat_kampus_merdeka` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_karyawan`
--

INSERT INTO `tabel_karyawan` (`id_karyawan`, `nama_karyawan`, `departemen`, `hari_kerja_masuk`, `gaji_dasar_per_hari`, `jenis_karyawan`, `durasi_kontrak_bulan`, `agensi_penyalur`, `tunjangan_kesehatan`, `opsi_saham_id`, `uang_saku_bulanan`, `sertifikat_kampus_merdeka`) VALUES
(1, 'Andi Wijaya', 'IT', 20, '150000.00', 'Kontrak', 12, 'PT Mitratama', NULL, NULL, NULL, NULL),
(2, 'Budi Santoso', 'HR', 22, '140000.00', 'Kontrak', 6, 'PT Solusi Asia', NULL, NULL, NULL, NULL),
(3, 'Citra Lestari', 'Marketing', 18, '135000.00', 'Kontrak', 12, 'PT Mitratama', NULL, NULL, NULL, NULL),
(4, 'Dewi Sartika', 'Finance', 21, '145000.00', 'Kontrak', 6, 'PT Solusi Asia', NULL, NULL, NULL, NULL),
(5, 'Eko Prasetyo', 'IT', 19, '150000.00', 'Kontrak', 24, 'PT TechTalent', NULL, NULL, NULL, NULL),
(6, 'Fajar Nugroho', 'Operations', 22, '130000.00', 'Kontrak', 6, 'PT Mitratama', NULL, NULL, NULL, NULL),
(7, 'Gita Permata', 'Marketing', 20, '135000.00', 'Kontrak', 12, 'PT TechTalent', NULL, NULL, NULL, NULL),
(8, 'Hadi Kusuma', 'IT', 22, '250000.00', 'Tetap', NULL, NULL, '500000.00', 'ESOP-001', NULL, NULL),
(9, 'Indah Permadi', 'HR', 21, '220000.00', 'Tetap', NULL, NULL, '450000.00', 'ESOP-002', NULL, NULL),
(10, 'Joko Widodo', 'Finance', 23, '240000.00', 'Tetap', NULL, NULL, '500000.00', 'ESOP-003', NULL, NULL),
(11, 'Kurniawan', 'Operations', 22, '210000.00', 'Tetap', NULL, NULL, '400000.00', 'ESOP-004', NULL, NULL),
(12, 'Larasati', 'Marketing', 20, '230000.00', 'Tetap', NULL, NULL, '450000.00', 'ESOP-005', NULL, NULL),
(13, 'Muhammad Fauzan', 'IT', 22, '260000.00', 'Tetap', NULL, NULL, '550000.00', 'ESOP-006', NULL, NULL),
(14, 'Novianti', 'Finance', 21, '225000.00', 'Tetap', NULL, NULL, '450000.00', 'ESOP-007', NULL, NULL),
(15, 'Oki Setiawan', 'IT', 15, '80000.00', 'Magang', NULL, NULL, NULL, NULL, '1500000.00', 'MSIB-BATCH4-01'),
(16, 'Putri Ayu', 'Marketing', 18, '75000.00', 'Magang', NULL, NULL, NULL, NULL, '1200000.00', 'MSIB-BATCH4-02'),
(17, 'Qomarudin', 'HR', 16, '75000.00', 'Magang', NULL, NULL, NULL, NULL, '1200000.00', 'MSIB-BATCH4-03'),
(18, 'Rian Hidayat', 'IT', 20, '85000.00', 'Magang', NULL, NULL, NULL, NULL, '1600000.00', 'MSIB-BATCH5-01'),
(19, 'Siti Aminah', 'Finance', 17, '80000.00', 'Magang', NULL, NULL, NULL, NULL, '1400000.00', 'MSIB-BATCH5-02'),
(20, 'Taufik Hidayat', 'Operations', 15, '75000.00', 'Magang', NULL, NULL, NULL, NULL, '1200000.00', 'MSIB-BATCH5-03'),
(21, 'Utami Putri', 'Marketing', 19, '75000.00', 'Magang', NULL, NULL, NULL, NULL, '1300000.00', 'MSIB-BATCH5-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  MODIFY `id_karyawan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
