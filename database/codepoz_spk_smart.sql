-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 10, 2023 at 07:54 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codepoz_spk_smart`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`id_alternatif`, `nama`) VALUES
(1, 'BBNI'),
(2, 'ADRO'),
(3, 'TLKM'),
(4, 'AMRT'),
(5, 'ANTM');

-- --------------------------------------------------------

--
-- Table structure for table `tb_evaluasi`
--

CREATE TABLE `tb_evaluasi` (
  `id_evaluasi` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_evaluasi`
--

INSERT INTO `tb_evaluasi` (`id_evaluasi`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(1, 1, 1, 60),
(2, 1, 2, 70),
(3, 1, 3, 30),
(4, 1, 4, 50),
(5, 1, 5, 30),
(6, 2, 1, 100),
(7, 2, 2, 50),
(8, 2, 3, 30),
(9, 2, 4, 100),
(10, 2, 5, 30),
(11, 3, 1, 45),
(12, 3, 2, 30),
(13, 3, 3, 30),
(14, 3, 4, 100),
(15, 3, 5, 100),
(16, 4, 1, 30),
(17, 4, 2, 30),
(18, 4, 3, 30),
(19, 4, 4, 100),
(20, 4, 5, 30),
(21, 5, 1, 30),
(22, 5, 2, 30),
(23, 5, 3, 30),
(24, 5, 4, 50),
(25, 5, 5, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `bobot` float DEFAULT NULL,
  `tipe` enum('benefit','cost') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `nama`, `bobot`, `tipe`) VALUES
(1, 'PER', 80, 'benefit'),
(2, 'PBV', 100, 'benefit'),
(3, 'DER', 70, 'cost'),
(4, 'ROE', 85, 'benefit'),
(5, 'DPR', 65, 'cost');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria_sub`
--

CREATE TABLE `tb_kriteria_sub` (
  `id_kriteria_sub` int(11) NOT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kriteria_sub`
--

INSERT INTO `tb_kriteria_sub` (`id_kriteria_sub`, `id_kriteria`, `nama`, `nilai`) VALUES
(1, 2, '0.1-0.3', 100),
(2, 2, '0.31-0.6', 80),
(3, 2, '0.61-1', 70),
(4, 2, '1.1-1.5', 50),
(5, 2, '> 1.5', 30),
(6, 1, '0-5', 100),
(7, 1, '6-10', 80),
(8, 1, '11-15', 60),
(9, 1, '16-20', 45),
(10, 1, '> 20', 30),
(11, 3, '0.1-0.3', 100),
(12, 3, '0.31-0.6', 80),
(13, 3, '0.61-1', 70),
(14, 3, '1.1-1.5', 50),
(15, 3, '> 1.5', 30),
(16, 4, '> 20', 100),
(17, 4, '16-20', 80),
(18, 4, '10-15', 70),
(19, 4, '5-9', 50),
(20, 4, '0-4', 30),
(21, 5, '> 60 %', 100),
(22, 5, '> 40 %', 70),
(23, 5, '> 30 %', 50),
(24, 5, '< 30 %', 30);

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `id_member` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tmp_lahir` varchar(50) DEFAULT NULL,
  `kelamin` enum('L','P') DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `alamat` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`id_member`, `id_users`, `tgl_lahir`, `tmp_lahir`, `kelamin`, `telepon`, `alamat`) VALUES
(1, 27295562, '2023-02-20', 'makassar', 'L', '123', 'asda'),
(2, 24461953, '2023-03-04', 'Konoha', 'L', '0987654321', 'Konoha');

-- --------------------------------------------------------

--
-- Table structure for table `tb_riwayat`
--

CREATE TABLE `tb_riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `hasil` json DEFAULT NULL,
  `tgl` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_riwayat`
--

INSERT INTO `tb_riwayat` (`id_riwayat`, `id_member`, `hasil`, `tgl`) VALUES
(1, 2, '{\"1\": 0.4982142857142857, \"2\": 0.7, \"3\": 0.25535714285714284, \"4\": 0.375, \"5\": 0.1625}', '2023-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id_users` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `token` text,
  `tokenExpire` text,
  `level` enum('admin','users') DEFAULT NULL,
  `status` enum('0','1') NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_users`, `nama`, `email`, `username`, `password`, `picture`, `token`, `tokenExpire`, `level`, `status`, `created`, `modified`) VALUES
(1, 'Alan Saputra Lengkoan', 'alanlengkoan15@gmail.com', 'admin', '$2y$10$CR9Pd9ALwRZ4J610leCea.1S6QNrv6aYARP9zp7TdvMNNyz.ZVCc6', NULL, 'SMVyGX4vuat9fBAgRxJ3Kh6lYQqbCD1E', '1578184269', 'admin', '1', '2020-01-02 05:23:40', '2023-02-19 13:22:36'),
(24461953, 'Naruto', 'naruto@gmail.com', 'naruto', '$2y$10$Ze0a33ipefHpRKtLgEqeCe0TWF3VvhktjhF5EJFg6oUlmzwxTQAgW', NULL, NULL, NULL, 'users', '1', '2023-03-04 05:10:53', '2023-03-04 05:10:53'),
(27295562, 'Alan', 'alan@gmail.com', 'alan', '$2y$10$2qaLotCChA4Jj3rWfnl2UOHjNclJTpade3pI6cT47siJlZSg1vp/u', NULL, NULL, NULL, 'users', '1', '2023-02-20 01:11:58', '2023-02-20 01:11:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `tb_evaluasi`
--
ALTER TABLE `tb_evaluasi`
  ADD PRIMARY KEY (`id_evaluasi`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tb_kriteria_sub`
--
ALTER TABLE `tb_kriteria_sub`
  ADD PRIMARY KEY (`id_kriteria_sub`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id_member`),
  ADD KEY `member_to_users` (`id_users`);

--
-- Indexes for table `tb_riwayat`
--
ALTER TABLE `tb_riwayat`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_evaluasi`
--
ALTER TABLE `tb_evaluasi`
  MODIFY `id_evaluasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_kriteria_sub`
--
ALTER TABLE `tb_kriteria_sub`
  MODIFY `id_kriteria_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_riwayat`
--
ALTER TABLE `tb_riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27295563;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_evaluasi`
--
ALTER TABLE `tb_evaluasi`
  ADD CONSTRAINT `evaluasi_to_alternatif` FOREIGN KEY (`id_alternatif`) REFERENCES `tb_alternatif` (`id_alternatif`) ON DELETE CASCADE,
  ADD CONSTRAINT `evaluasi_to_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `tb_kriteria` (`id_kriteria`) ON DELETE CASCADE;

--
-- Constraints for table `tb_kriteria_sub`
--
ALTER TABLE `tb_kriteria_sub`
  ADD CONSTRAINT `sub_kriteria_to_kritera` FOREIGN KEY (`id_kriteria`) REFERENCES `tb_kriteria` (`id_kriteria`) ON DELETE CASCADE;

--
-- Constraints for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD CONSTRAINT `member_to_users` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
