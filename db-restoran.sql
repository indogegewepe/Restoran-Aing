-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2022 at 03:11 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `banyak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_transaksi`, `id_menu`, `banyak`) VALUES
(2, 7, 1),
(3, 7, 2),
(4, 4, 1),
(4, 5, 1),
(6, 7, 1),
(10, 2, 1),
(14, 4, 1),
(15, 4, 2),
(15, 5, 1),
(18, 4, 1),
(18, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `kategori` enum('makanan','minuman','cemilan') NOT NULL,
  `ketersediaan` enum('ada','tidak ada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `kategori`, `ketersediaan`) VALUES
(1, 'Bakso', 16000, 'makanan', 'ada'),
(2, 'Es Teh', 3000, 'minuman', 'ada'),
(4, 'Es Jeruk', 3000, 'minuman', 'ada'),
(5, 'Mie Goreng', 8000, 'makanan', 'ada'),
(6, 'Mie Rebus', 8000, 'makanan', 'ada'),
(7, 'Es Sirup', 3000, 'minuman', 'ada');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(7) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jenisKelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `jenisPegawai` enum('Admin','Kasir') NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `jenisKelamin`, `jenisPegawai`, `email`, `password`, `alamat`) VALUES
('AX-0001', 'Wahyono', 'Laki-laki', 'Admin', 'wahyonoUvvU@gmail.com', 'Wahyowaw', 'asgard'),
('AX-0002', 'Cahyadhy', 'Laki-laki', 'Kasir', 'cahyadhyUvvU@gmail.com', 'Cahyawaw', 'namek');

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `noMeja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `Nama`, `noMeja`) VALUES
(2, 'Bagas', 56),
(3, 'Tsiqoh', 90),
(4, 'Amin', 2),
(5, 'Dewa', 2),
(6, 'Fiqyan', 5),
(7, 'Fikri', 1),
(8, 'Danang', 4),
(9, 'Dewa', 2),
(10, 'Faris', 10),
(12, 'Rembo', 2),
(13, 'Rembo', 18),
(14, 'Fikri', 1),
(15, 'Fikri', 100),
(16, 'Fikri', 100);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_pegawai` varchar(7) DEFAULT NULL,
  `total_transaksi` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal_transaksi`, `id_pembeli`, `id_pegawai`, `total_transaksi`) VALUES
(2, '2021-12-21', 3, 'AX-0002', 19000),
(3, '2021-11-21', 4, 'AX-0002', 6000),
(4, '2021-01-21', 5, 'AX-0002', 11000),
(6, '2021-12-21', 6, 'AX-0002', 19000),
(7, '2021-12-21', 6, 'AX-0002', 16000),
(10, '2021-12-21', 6, 'AX-0002', 3000),
(13, '2021-12-21', 8, 'AX-0002', 16000),
(14, '2021-12-21', 9, 'AX-0002', 3000),
(15, '2021-12-22', 13, 'AX-0002', 14000),
(16, '0000-00-00', 14, NULL, NULL),
(17, '0000-00-00', 15, NULL, NULL),
(18, '0000-00-00', 16, NULL, 19000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_pembeli` (`id_pembeli`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
