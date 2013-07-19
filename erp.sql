-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 04, 2013 at 06:21 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(10, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id_customer` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(32) DEFAULT NULL,
  `company` varchar(32) DEFAULT NULL,
  `alamat` varchar(32) NOT NULL,
  `kota` varchar(32) NOT NULL,
  `telp` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=147 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `company`, `alamat`, `kota`, `telp`, `email`) VALUES
(101, 'Bambang Supriadi', 'Fielder Comp', 'Jl. Ikan Hias 36 ', 'Malang', '0341 567456', 'filedercomp@gmail.com'),
(102, 'Hengky Prasetyo', 'Buanavarian', 'Jl. Tanjung Priuk 13', 'Surabaya', '031 4567689', 'hengky@ymail.com'),
(143, 'Andika Subchi', 'AnSub ', 'Jl. Lidah Buaya 34', 'Semarang', '089423896543', 'andikasub@mail.com'),
(144, 'Dedik Santoso', 'Bagong Graf', 'Jl. Danau Toba 83', 'Malang', '0341 7653489', 'bagonggraf@yahoo.com'),
(145, 'Irfansyah', 'Elcomp', 'Jl. Soekarno - Hatta', 'Jakarta', '021 8734589', 'elcomp@ymail.com'),
(146, 'Moch. Muchlis', 'Folding Corp', 'Jl. Simanjuntak 38', 'Bekasi', '021 49573859', 'Muchlisin@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `id_karyawan` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(32) DEFAULT NULL,
  `alamat` varchar(32) DEFAULT NULL,
  `kota` varchar(32) DEFAULT NULL,
  `telp` varchar(32) DEFAULT NULL,
  `title` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1007 ;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `alamat`, `kota`, `telp`, `title`, `email`) VALUES
(1000, 'Heru Wicaksono', 'Jl. Tembang Wetan 120 ', 'Malang', '081555333444', 'Sales', 'herumail@gmail.com'),
(1001, 'M. Saiful', 'Jl. Sumber Rejeki ', 'Malang', '081323459090', 'Sales', 'saiful@yahoo.co.id'),
(1002, 'Om Ridho', 'Jl. Ciputra 32', 'Malang', '0898345345', 'Web Development', 'ridho@yahoo.com'),
(1004, 'Hengky Lo', 'Jl. Windows Genuie', 'Malang', '085634569878', 'Mobile Development', 'hengkylo@yahoo.com'),
(1005, 'Ramdani', 'Jl. Github dot com', 'Malang', '087845324568', 'Mobile Development', 'Ramdaniles@live.com'),
(1006, 'Johan Prasetyo', 'Jl. Seagate baracuda', 'Malang', '081954875689', 'Sales', 'Prasetyo@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int(4) NOT NULL AUTO_INCREMENT,
  `nama` varchar(32) DEFAULT NULL,
  `harga` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_produk`),
  KEY `harga` (`harga`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=208 ;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `harga`) VALUES
(200, 'AlfaPos', '2000000'),
(201, 'AlfaMedika', '1500000'),
(202, 'AlfaKoperasi', '1000000');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int(4) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(4) DEFAULT NULL,
  `id_customer` int(4) DEFAULT NULL,
  `id_produk` int(4) DEFAULT NULL,
  `tgl_jual` varchar(32) DEFAULT NULL,
  `bln` varchar(12) NOT NULL,
  `harga` varchar(32) DEFAULT NULL,
  `qty` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `id_karyawan` (`id_karyawan`),
  KEY `id_customer` (`id_customer`),
  KEY `id_produk` (`id_produk`),
  KEY `harga` (`harga`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=553 ;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_karyawan`, `id_customer`, `id_produk`, `tgl_jual`, `bln`, `harga`, `qty`) VALUES
(547, 1000, 101, 200, '1/24/2013', '1', '2000000', '3'),
(548, 1001, 102, 201, '2/6/2013', '2', '1500000', '2'),
(549, 1002, 143, 202, '3/22/2013', '3', '1000000', '2'),
(550, 1004, 144, 201, '4/2/2013', '4', '1500000', '1'),
(551, 1001, 145, 200, '5/30/2013', '5', '2000000', '1'),
(552, 1004, 146, 201, '6/13/2013', '6', '1500000', '2');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`harga`) REFERENCES `produk` (`harga`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
