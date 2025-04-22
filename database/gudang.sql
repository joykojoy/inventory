-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2025 at 03:15 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudang`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id` int(5) UNSIGNED NOT NULL,
  `level_id` int(5) NOT NULL,
  `akses_menu_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id`, `level_id`, `akses_menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 2),
(5, 2, 3),
(6, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(5) UNSIGNED NOT NULL,
  `induk` varchar(20) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `satuan` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `min` int(11) DEFAULT 0,
  `harga` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `induk`, `kode`, `nama`, `satuan`, `status`, `min`, `harga`) VALUES
(1, 'NB ASUS', 'NBASUS UX578TX', 'Notebook ASUS UX578TX core i5', 1, 1, 8, '10000.00'),
(2, 'NB LENOVO', 'NBLNV ID825TX', 'Notebook Lenovo  ID825TX core i5', 1, 1, 40, '10000.00'),
(3, 'NB HP', 'ER-404', 'HP Pavilion', 1, 1, 10, '8000000.00'),
(4, 'NB ASUS', 'ER-405', 'ROG', 1, 1, 50, '15000000.00'),
(5, 'NB ASUS', 'NBASUS UX578TXXXX', 'sss', 1, 1, 100, '10000.00'),
(6, 'NB ASUS', 'NBASUS UX578TXXXXX', 'sss', 2, 1, 100, '10000.00'),
(7, 'PNJ', 'SL001', 'Isolasi Kabel Nitto', 2, 1, 1, '100.00'),
(8, '', 'TTTTT', 'TTTTT', 2, 1, 0, '10000.00'),
(9, '', 'TTTTTT', 'TTTTT', 1, 1, 0, '10000.00');

-- --------------------------------------------------------

--
-- Table structure for table `barangkeluar`
--

CREATE TABLE `barangkeluar` (
  `id` int(5) UNSIGNED NOT NULL,
  `no_do` varchar(20) NOT NULL,
  `tgl_do` date NOT NULL,
  `customer` varchar(20) NOT NULL,
  `total` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barangkeluar`
--

INSERT INTO `barangkeluar` (`id`, `no_do`, `tgl_do`, `customer`, `total`) VALUES
(1, 'DO-0001', '2023-02-21', 'C01', 28600000),
(2, 'DO-0002', '2025-04-15', 'C01', 8000000),
(3, 'DO-0003', '2025-04-15', 'C01', 32000000),
(4, 'DO-0004', '2025-04-17', 'C01', 10000),
(5, 'DO-0005', '2025-04-20', 'C01', 100000000),
(6, 'DO-0006', '2025-04-20', 'C01', 10000000),
(7, 'DO-0007', '2025-04-20', 'C01', 10000),
(8, 'DO-0008', '2025-04-20', 'C01', 5000000),
(9, 'DO-0009', '2025-04-21', 'C01', 8000000);

-- --------------------------------------------------------

--
-- Table structure for table `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `id` int(5) UNSIGNED NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `tgl_faktur` date NOT NULL,
  `supplier` varchar(20) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barangmasuk`
--

INSERT INTO `barangmasuk` (`id`, `no_faktur`, `tgl_faktur`, `supplier`, `total`) VALUES
(1, 'MTR-10015', '2023-02-21', 'V01', 102150000),
(2, 'MTR101', '2023-02-22', 'V01', 42625000),
(3, 'aaaaa', '2025-04-15', 'V01', 8000000),
(4, 'aaa', '2025-04-15', 'V01', 80000000),
(5, 'FC001', '2025-04-17', 'V02', 100000),
(6, 'COOO00', '2025-04-20', 'V01', 120000000),
(7, 'FK-102', '2025-04-20', 'V01', 1000000000),
(8, 'aaaa', '2025-04-20', 'V01', 100000000),
(9, 'FK-103', '2025-04-20', 'V01', 1000000),
(10, 'FK-104', '2025-04-20', 'V01', 2100000),
(11, 'FK-105', '2025-04-20', 'V02', 20000),
(12, 'FK-106', '2025-04-20', 'V02', 2000000),
(13, 'FK-107', '2025-04-20', 'V02', 1000000),
(14, 'FK-108', '2025-04-20', 'V02', 10),
(15, 'FK-109', '2025-04-21', 'V01', 80000000),
(16, 'FK-110', '2025-04-21', 'V01', 150000000);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(5) UNSIGNED NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `telp` varchar(25) DEFAULT NULL,
  `pic` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `kode`, `nama`, `alamat`, `telp`, `pic`) VALUES
(1, 'C01', 'Pelanggan Umum', 'Surabaya', '', '11'),
(2, 'C02', 'Perusahaan', 'test', '1111111111', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `detil_brgkeluar`
--

CREATE TABLE `detil_brgkeluar` (
  `id` int(5) UNSIGNED NOT NULL,
  `no_do` varchar(20) NOT NULL,
  `tgl_do` date NOT NULL,
  `customer` varchar(20) NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `qtt` int(9) NOT NULL,
  `hrg` int(9) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detil_brgkeluar`
--

INSERT INTO `detil_brgkeluar` (`id`, `no_do`, `tgl_do`, `customer`, `kode_brg`, `qtt`, `hrg`, `subtotal`) VALUES
(2, 'DO-0001', '2023-02-21', 'C01', 'NBASUS UX578TX', 1, 8900000, 8900000),
(3, 'DO-0001', '2023-02-22', 'C01', 'NBLNV ID825TX', 2, 9850000, 19700000),
(4, 'DO-0002', '2025-04-15', 'C01', 'ER-404', 1, 8000000, 8000000),
(5, 'DO-0003', '2025-04-15', 'C01', 'ER-404', 4, 8000000, 32000000),
(6, 'DO-0004', '2025-04-17', 'C01', 'SL001', 1, 10000, 10000),
(7, 'DO-0005', '2025-04-20', 'C01', 'NBASUS UX578TX', 10, 10000000, 100000000),
(8, 'DO-0006', '2025-04-20', 'C01', 'ER-405', 10, 1000000, 10000000),
(9, 'DO-0007', '2025-04-20', 'C01', 'ER-404', 10, 1000, 10000),
(10, 'DO-0008', '2025-04-20', 'C01', 'NBASUS UX578TXXXXX', 5, 1000000, 5000000),
(11, 'DO-0009', '2025-04-21', 'C01', 'NBASUS UX578TXXXX', 1, 8000000, 8000000);

-- --------------------------------------------------------

--
-- Table structure for table `detil_brgmasuk`
--

CREATE TABLE `detil_brgmasuk` (
  `id` int(5) UNSIGNED NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `tgl_faktur` date NOT NULL,
  `supplier` varchar(20) NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `qtt` int(9) NOT NULL,
  `hpp` int(9) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detil_brgmasuk`
--

INSERT INTO `detil_brgmasuk` (`id`, `no_faktur`, `tgl_faktur`, `supplier`, `kode_brg`, `qtt`, `hpp`, `subtotal`) VALUES
(1, 'MTR-10015', '2023-02-21', 'V01', 'NBASUS UX578TX', 5, 8600000, 43000000),
(2, 'MTR-10015', '2023-02-21', 'V01', 'NBLNV ID825TX', 7, 8450000, 59150000),
(3, 'MTR101', '2023-02-22', 'V01', 'NBASUS UX578TX', 5, 8525000, 42625000),
(4, 'aaaaa', '2025-04-15', 'V01', 'ER-404', 1, 8000000, 8000000),
(5, 'aaa', '2025-04-15', 'V01', 'ER-404', 10, 8000000, 80000000),
(6, 'FC001', '2025-04-17', 'V02', 'SL001', 10, 10000, 100000),
(7, 'COOO00', '2025-04-20', 'V01', 'NBASUS UX578TX', 100, 1200000, 120000000),
(8, 'FK-102', '2025-04-20', 'V01', 'ER-404', 10, 100000000, 1000000000),
(9, 'aaaa', '2025-04-20', 'V01', 'NBASUS UX578TX', 10, 10000000, 100000000),
(10, 'FK-103', '2025-04-20', 'V01', 'NBASUS UX578TXXXX', 10, 100000, 1000000),
(11, 'FK-104', '2025-04-20', 'V01', 'NBASUS UX578TXXXX', 1, 100000, 100000),
(12, 'FK-104', '2025-04-20', 'V01', 'NBASUS UX578TXXXX', 20, 100000, 2000000),
(13, 'FK-105', '2025-04-20', 'V02', 'NBASUS UX578TXXXXX', 10, 2000, 20000),
(14, 'FK-106', '2025-04-20', 'V02', 'SL001', 100, 20000, 2000000),
(15, 'FK-107', '2025-04-20', 'V02', 'SL001', 10, 100000, 1000000),
(16, 'FK-108', '2025-04-20', 'V02', 'SL001', 1, 10, 10),
(17, 'FK-109', '2025-04-21', 'V01', 'ER-404', 10, 8000000, 80000000),
(18, 'FK-110', '2025-04-21', 'V01', 'ER-405', 10, 15000000, 150000000);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(5) UNSIGNED NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `kode`, `nama`) VALUES
(1, 'NB ASUS', 'Notebook Asus'),
(2, 'NB LENOVO', 'Notebook Lenovo'),
(3, 'NB HP', 'Notebook HP'),
(4, 'PNJ', 'Penunjang');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(5) UNSIGNED NOT NULL,
  `nama` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `nama`) VALUES
(1, 'Administrator'),
(2, 'Admin gudang'),
(3, 'Sales');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(5) UNSIGNED NOT NULL,
  `user_level_id` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `urutan` int(5) NOT NULL,
  `aktif` int(1) NOT NULL,
  `submenu` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `user_level_id`, `nama`, `url`, `icon`, `urutan`, `aktif`, `submenu`) VALUES
(1, 1, 'Kelola Akun User', '/admin/manuser', 'bi bi-stack', 1, 1, 0),
(2, 2, 'Kelola Stock', '#', 'bi bi-file-earmark-medical-fill', 4, 1, 1),
(3, 2, 'Kelola Supplier', '/admin/mansupplier', 'bi bi-grid-1x2-fill', 2, 1, 0),
(4, 2, 'Kelola Customer', '/admin/mancustomer', 'bi bi-file-earmark-person-fill', 3, 1, 0),
(5, 3, 'Lihat Stock', '/sales/pesanan', 'bi bi-cart-fill', 1, 1, 0),
(6, 2, 'Master', '', 'bi bi-diamond-fill', 1, 1, 1),
(7, 2, 'Laporan Stock', '#', 'bi bi-grid-fill', 6, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-12-12-022826', 'App\\Database\\Migrations\\User', 'default', 'App', 1670813930, 1),
(2, '2022-12-12-022858', 'App\\Database\\Migrations\\Level', 'default', 'App', 1670813930, 1),
(3, '2022-12-12-022942', 'App\\Database\\Migrations\\Akses', 'default', 'App', 1670813930, 1),
(4, '2022-12-12-024202', 'App\\Database\\Migrations\\Menu', 'default', 'App', 1670813930, 1),
(5, '2022-12-12-025538', 'App\\Database\\Migrations\\Submenu', 'default', 'App', 1670813930, 1),
(6, '2022-12-12-140453', 'App\\Database\\Migrations\\Barang', 'default', 'App', 1670854253, 2),
(7, '2022-12-14-041358', 'App\\Database\\Migrations\\Supplier', 'default', 'App', 1670991415, 3),
(8, '2022-12-14-041406', 'App\\Database\\Migrations\\Customer', 'default', 'App', 1670991415, 3),
(9, '2022-12-29-012306', 'App\\Database\\Migrations\\Satuan', 'default', 'App', 1672277202, 4),
(10, '2022-12-29-065701', 'App\\Database\\Migrations\\Barangmasuk', 'default', 'App', 1672298376, 5),
(11, '2022-12-29-065713', 'App\\Database\\Migrations\\Barangkeluar', 'default', 'App', 1672298376, 5),
(12, '2022-12-29-065740', 'App\\Database\\Migrations\\Stock', 'default', 'App', 1672298376, 5),
(13, '2022-12-29-075336', 'App\\Database\\Migrations\\TempBarangmasuk', 'default', 'App', 1672300596, 6),
(14, '2022-12-30-092818', 'App\\Database\\Migrations\\Group', 'default', 'App', 1672392646, 7),
(15, '2023-01-03-012106', 'App\\Database\\Migrations\\DetilBrgmasuk', 'default', 'App', 1672709077, 8),
(16, '2023-01-07-135552', 'App\\Database\\Migrations\\MutasiStock', 'default', 'App', 1673100934, 9),
(17, '2023-01-09-091051', 'App\\Database\\Migrations\\Tempbarangkeluar', 'default', 'App', 1673256149, 10),
(18, '2023-01-09-091135', 'App\\Database\\Migrations\\Detilbrgkeluar', 'default', 'App', 1673256149, 10),
(19, '2023-01-10-031709', 'App\\Database\\Migrations\\Barangkeluar', 'default', 'App', 1673320893, 11);

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_stock`
--

CREATE TABLE `mutasi_stock` (
  `id` int(5) UNSIGNED NOT NULL,
  `tgl` date NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `qtt_in` int(9) DEFAULT NULL,
  `qtt_out` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mutasi_stock`
--

INSERT INTO `mutasi_stock` (`id`, `tgl`, `kode_brg`, `qtt_in`, `qtt_out`) VALUES
(1, '2023-02-21', 'NBASUS UX578TX', 5, NULL),
(2, '2023-02-21', 'NBLNV ID825TX', 7, NULL),
(3, '2023-02-21', 'NBASUS UX578TX', NULL, 1),
(4, '2023-02-22', 'NBASUS UX578TX', 5, NULL),
(5, '2025-04-15', 'ER-404', 1, NULL),
(6, '2025-04-15', 'ER-404', 10, NULL),
(7, '2025-04-15', 'ER-404', NULL, 1),
(8, '2025-04-15', 'ER-404', NULL, 4),
(9, '2025-04-17', 'SL001', 10, NULL),
(10, '2025-04-17', 'SL001', NULL, 1),
(11, '2025-04-20', 'NBASUS UX578TX', 100, NULL),
(12, '2025-04-20', 'ER-404', 10, NULL),
(13, '2025-04-20', 'NBASUS UX578TX', 10, NULL),
(14, '2025-04-20', 'NBASUS UX578TXXXX', 10, NULL),
(15, '2025-04-20', 'NBASUS UX578TXXXX', 1, 0),
(16, '2025-04-20', 'NBASUS UX578TXXXX', 20, 0),
(17, '2025-04-20', 'NBASUS UX578TXXXXX', 10, 0),
(18, '2025-04-20', 'SL001', 100, 0),
(19, '2025-04-20', 'SL001', 10, 0),
(20, '2025-04-20', 'SL001', 1, 0),
(21, '2025-04-20', 'NBASUS UX578TX', NULL, 10),
(22, '2025-04-20', 'ER-405', NULL, 10),
(23, '2025-04-20', 'ER-404', NULL, 10),
(24, '2025-04-20', 'NBASUS UX578TXXXXX', NULL, 5),
(25, '2025-04-21', 'ER-404', 10, 0),
(26, '2025-04-21', 'NBASUS UX578TXXXX', NULL, 1),
(27, '2025-04-21', 'ER-405', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int(5) UNSIGNED NOT NULL,
  `nama` varchar(20) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `nama`, `status`) VALUES
(1, 'unit', 1),
(2, 'pcs', 1),
(3, 'Kilogram', 1),
(4, 'Lot', 1),
(5, 'gram', 1),
(6, 'Centimeter', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(5) UNSIGNED NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `qtt` int(9) NOT NULL,
  `hpp` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `kode_brg`, `qtt`, `hpp`) VALUES
(1, 'NBASUS UX578TX', 109, 2496009),
(2, 'NBLNV ID825TX', 7, 8450000),
(3, 'ER-404', 16, 65500000),
(4, 'SL001', 120, 10000),
(5, 'NBASUS UX578TXXXX', 20, 0),
(6, 'NBASUS UX578TXXXXX', 5, 0),
(7, 'ER-405', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_menu_induk` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `urutan` int(5) NOT NULL,
  `aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`id`, `id_menu_induk`, `nama`, `url`, `urutan`, `aktif`) VALUES
(1, 2, 'Penerimaan Barang', '/admin/barangmasuk', 1, 1),
(2, 2, 'Pengeluaran Barang', '/admin/barangkeluar', 2, 1),
(3, 6, 'Master Barang', '/admin/master_barang', 1, 1),
(4, 6, 'Master Satuan', '/admin/master_satuan', 2, 1),
(5, 6, 'Group Barang', '/admin/mangroup', 3, 1),
(6, 7, 'Histori Barang Masuk', '/admin/historystock/barangmasuk', 2, 1),
(7, 7, 'Histori Barang Keluar', '/admin/historystock/barangkeluar', 3, 1),
(8, 7, 'Histori Barang', '/admin/historystock', 4, 1),
(9, 7, 'Stock Barang', '/admin/historystock/ready', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(5) UNSIGNED NOT NULL,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `telp` varchar(25) DEFAULT NULL,
  `pic` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `kode`, `nama`, `alamat`, `telp`, `pic`) VALUES
(1, 'V01', 'PT MITRA LAPTOP', 'Surabaya', '08112345678', 'Bpk Berlian'),
(2, 'V02', 'Test Supplier', 'Bandung', '0899999999', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `temp_barangkeluar`
--

CREATE TABLE `temp_barangkeluar` (
  `id` int(5) UNSIGNED NOT NULL,
  `no_do` varchar(20) NOT NULL,
  `tgl_do` date NOT NULL,
  `customer` varchar(20) NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `qtt` int(9) NOT NULL,
  `hrg` int(9) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `temp_barangmasuk`
--

CREATE TABLE `temp_barangmasuk` (
  `id` int(5) UNSIGNED NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `tgl_faktur` date NOT NULL,
  `supplier` varchar(20) NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `qtt` int(9) NOT NULL,
  `hpp` int(9) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(5) NOT NULL,
  `status` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', '$2y$10$e68ReueqC8rqqA2tHnRR5uKco/UmCaF6wyqE1XtHmsbKaOf1FT3Km', 1, '1', '2022-12-12 04:26:09', '2023-02-21 08:13:40'),
(2, 'Admin Penerimaan Barang', 'penerimaan@gmail.com', '$2y$10$.TfphfRbjrfMHW081r6GkOdkRpRhWvIAKxzxgsfs4MzRKSxxDUKr6', 2, '1', '2022-12-12 04:26:09', '2022-12-13 02:42:49'),
(3, 'Admin Pengeluaran Barang', 'pengeluaran@gmail.com', '$2y$10$.TfphfRbjrfMHW081r6GkOdkRpRhWvIAKxzxgsfs4MzRKSxxDUKr6', 2, '1', '2022-12-12 06:59:47', '2022-12-12 06:59:47'),
(4, 'Sales1', 'sales@gmail.com', '$2y$10$.TfphfRbjrfMHW081r6GkOdkRpRhWvIAKxzxgsfs4MzRKSxxDUKr6', 3, '1', '2022-12-12 06:59:47', '2023-02-19 09:10:27'),
(11, 'Fajar', 'Fajar', '$2y$10$d2LSbUy16jsMPBhzxuljxOWaRBdpY0jMsIQEdn3FSqF1BKDmwypOC', 1, '1', '2025-04-14 08:19:34', '2025-04-14 08:19:34'),
(12, 'test', 'test', '$2y$10$4LrlUBmjevYf4CvEkgAkQ.gLsFNUUASKAneSjkj1J0Kvj1peGWeVm', 3, '1', '2025-04-15 15:13:22', '2025-04-15 15:23:59'),
(13, 'raihan', 'raihan', '$2y$10$AOGQPrzXVRlToZ/GA/dKGenEXPK1fZ1CH3GaeqDGpAyrLmAArI7GK', 1, '1', '2025-04-16 09:58:53', '2025-04-16 09:59:55'),
(14, 'elban', 'elban', '$2y$10$332IiT4KT2nXMfY78Kws1uz89NxfpMq3JxvQ7ywYS1LCF7o75oKDm', 1, '1', '2025-04-16 10:01:17', '2025-04-16 10:01:17'),
(15, 'gudang', 'gudang', '$2y$10$1Hb1SbpxIsbAHZ2r4vpgQuB3puMe15XLl2Kqtf4fIiHmFVPv462Fi', 2, '1', '2025-04-17 08:05:51', '2025-04-17 08:05:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangkeluar`
--
ALTER TABLE `barangkeluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detil_brgkeluar`
--
ALTER TABLE `detil_brgkeluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detil_brgmasuk`
--
ALTER TABLE `detil_brgmasuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutasi_stock`
--
ALTER TABLE `mutasi_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_barangkeluar`
--
ALTER TABLE `temp_barangkeluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_barangmasuk`
--
ALTER TABLE `temp_barangmasuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `barangkeluar`
--
ALTER TABLE `barangkeluar`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `detil_brgkeluar`
--
ALTER TABLE `detil_brgkeluar`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `detil_brgmasuk`
--
ALTER TABLE `detil_brgmasuk`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `mutasi_stock`
--
ALTER TABLE `mutasi_stock`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `temp_barangkeluar`
--
ALTER TABLE `temp_barangkeluar`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `temp_barangmasuk`
--
ALTER TABLE `temp_barangmasuk`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
