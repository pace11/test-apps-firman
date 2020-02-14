-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 14, 2020 at 05:30 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`) VALUES
(1, 'administrator', 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` varchar(7) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `harga`) VALUES
('BRG0001', 'Jersey Barcelona 2020', 250000);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(5) NOT NULL,
  `barang_id` varchar(7) DEFAULT NULL,
  `email_pemesan` varchar(30) DEFAULT NULL,
  `nama_pemesan` int(30) DEFAULT NULL,
  `qty` int(5) DEFAULT NULL,
  `total_bruto` int(10) DEFAULT NULL,
  `total_diskon` int(10) NOT NULL,
  `total_netto` int(10) NOT NULL,
  `tgl_masuk` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(5) NOT NULL,
  `barang_id` varchar(7) DEFAULT NULL,
  `email_pemesan` varchar(30) DEFAULT NULL,
  `nama_pemesan` varchar(30) DEFAULT NULL,
  `qty` int(5) DEFAULT NULL,
  `total_bruto` int(10) DEFAULT NULL,
  `total_diskon` int(10) DEFAULT NULL,
  `total_netto` int(10) DEFAULT NULL,
  `tgl_masuk` timestamp NULL DEFAULT NULL,
  `status` enum('selesai','belum') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
