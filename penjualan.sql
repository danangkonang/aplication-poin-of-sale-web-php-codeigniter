-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 22, 2019 at 08:47 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id1736597_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `laba` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `setok` int(11) NOT NULL,
  `mulai_promo` date NOT NULL,
  `ahir_promo` date NOT NULL,
  `jenis_promo` varchar(50) NOT NULL,
  `potongan` int(11) NOT NULL,
  `harga_ahir` int(11) NOT NULL,
  `setatus_promo` int(1) NOT NULL,
  `setatus_barang` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `laba`, `satuan`, `setok`, `mulai_promo`, `ahir_promo`, `jenis_promo`, `potongan`, `harga_ahir`, `setatus_promo`, `setatus_barang`) VALUES
(1, 'telur ayam', 15000, 17500, 2500, 'kg', 86, '2019-06-13', '2019-06-25', 'diskon', 5, 0, 1, 1),
(2, 'gula', 5000, 7000, 2000, 'kg', 92, '2019-06-12', '2019-06-21', 'minimal', 10, 60000, 1, 1),
(4, 'sampo', 3000, 4000, 1000, 'botol', 91, '0000-00-00', '0000-00-00', 'diskon', 0, 0, 0, 1),
(5, 'ayam', 6000, 8000, 2000, 'kg', 100, '0000-00-00', '0000-00-00', 'diskon', 0, 0, 0, 1),
(6, 'bayam', 2000, 2500, 500, 'kg', 90, '0000-00-00', '0000-00-00', 'diskon', 0, 0, 1, 1),
(7, 'minyak goreng', 5000, 6000, 1000, 'liter', 98, '2019-06-17', '2019-06-27', 'minimal', 5, 28000, 1, 1),
(8, 'indomi goreng', 2000, 3000, 1000, 'pcs', 100, '0000-00-00', '0000-00-00', 'diskon', 0, 0, 0, 1),
(9, 'jagung', 5000, 6000, 1000, 'kg', 86, '0000-00-00', '0000-00-00', 'diskon', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cookie`
--

CREATE TABLE `cookie` (
  `id_cookie` int(11) NOT NULL,
  `id_user_cookie` int(11) NOT NULL,
  `cookie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cookie`
--

INSERT INTO `cookie` (`id_cookie`, `id_user_cookie`, `cookie`) VALUES
(1, 1, '0ouqvqu3piugeacpvimg4u1jd52aj4tn'),
(2, 4, 'q0nofsxwwfx3fq1qx9ymldwp5xgu4lqgkb2rg5dvvukao5hobb53vtbbnvplwqe8fqozyoe15pny00xs8ol3nfkwroexvix4dhz3ylbgmozic96miwbiisotvddwetfb');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `browser_version` varchar(200) NOT NULL,
  `os` varchar(200) NOT NULL,
  `ip_address` varchar(200) NOT NULL,
  `online` int(11) NOT NULL,
  `waktu_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `id_user`, `browser`, `browser_version`, `os`, `ip_address`, `online`, `waktu_login`) VALUES
(33, 4, 'Chrome', '73.0.3683.75', 'Linux', '120.188.87.24', 1, '2019-07-07 01:24:37'),
(34, 4, 'Chrome', '73.0.3683.75', 'Linux', '120.188.86.163', 0, '2019-07-07 03:38:40'),
(35, 4, 'Chrome', '73.0.3683.75', 'Linux', '114.4.216.141', 0, '2019-07-07 03:46:21'),
(36, 4, 'Chrome', '73.0.3683.75', 'Linux', '120.188.78.101', 0, '2019-07-07 04:58:58'),
(37, 4, 'Chrome', '73.0.3683.75', 'Linux', '182.1.114.170', 0, '2019-07-07 02:49:16'),
(38, 4, 'Chrome', '66.0.3359.158', 'Android', '182.1.125.205', 1, '2019-07-07 04:34:28'),
(39, 4, 'Chrome', '73.0.3683.75', 'Linux', '120.188.75.109', 1, '2019-07-07 07:29:28'),
(40, 4, 'Chrome', '66.0.3359.158', 'Android', '120.188.75.109', 1, '2019-07-07 07:34:58'),
(41, 4, 'Chrome', '73.0.3683.75', 'Linux', '114.4.82.119', 1, '2019-08-08 09:37:07'),
(42, 4, 'Chrome', '66.0.3359.158', 'Android', '182.0.232.95', 1, '2019-09-09 12:56:17'),
(43, 4, 'Chrome', '73.0.3683.75', 'Linux', '118.136.114.19', 1, '2019-09-09 05:41:51'),
(44, 4, 'Chrome', '73.0.3683.75', 'Linux', '118.136.114.19', 1, '2019-09-09 08:04:13'),
(45, 4, 'Chrome', '73.0.3683.75', 'Linux', '118.136.114.19', 1, '2019-09-09 02:14:06'),
(46, 4, 'Chrome', '73.0.3683.75', 'Linux', '118.136.114.19', 1, '2019-09-09 06:23:47'),
(47, 4, 'Chrome', '73.0.3683.75', 'Linux', '118.136.114.19', 1, '2019-09-09 05:19:13'),
(48, 1, 'Chrome', '76.0.3809.100', 'Linux', '118.136.114.19', 1, '2019-09-09 01:46:33'),
(49, 4, 'Chrome', '76.0.3809.100', 'Linux', '118.136.114.19', 1, '2019-09-09 01:53:42'),
(50, 1, 'Chrome', '76.0.3809.100', 'Linux', '118.136.114.19', 1, '2019-09-09 01:54:56'),
(51, 4, 'Chrome', '76.0.3809.100', 'Linux', '118.136.114.19', 1, '2019-09-09 02:01:01'),
(52, 1, 'Chrome', '76.0.3809.100', 'Linux', '118.136.114.19', 1, '2019-09-09 02:06:44'),
(53, 4, 'Chrome', '44.0.2403.119', 'Android', '202.67.32.26', 1, '2019-09-09 01:44:44'),
(54, 4, 'Chrome', '76.0.3809.132', 'Windows 10', '36.82.252.7', 1, '2019-09-09 01:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `kasir` int(11) NOT NULL,
  `kode_brg` int(11) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `harga_brg` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `kasir`, `kode_brg`, `nama_brg`, `harga_brg`, `jumlah`, `total_harga`, `tgl_transaksi`, `waktu`) VALUES
(3, 1, 2, 'gula', 7000, 1, 7000, '2019-06-15', '02:58:59'),
(4, 1, 1, 'telur ayam', 17500, 1, 17500, '2019-06-20', '02:36:00'),
(5, 1, 6, 'agajak', 100, 2, 200, '2019-06-20', '02:36:00'),
(6, 1, 4, 'sampo', 4000, 1, 4000, '2019-06-20', '02:36:00'),
(7, 1, 7, 'minyak goreng', 6000, 1, 6000, '2019-06-22', '06:55:00'),
(8, 1, 4, 'sampo', 4000, 5, 20000, '2019-06-22', '14:02:00'),
(9, 1, 5, 'ayam', 8000, 5, 40000, '2019-06-22', '20:45:00'),
(10, 1, 7, 'minyak goreng', 6000, 6, 36000, '2019-06-22', '20:46:00'),
(11, 1, 6, 'bayam', 2500, 3, 7500, '2019-06-22', '21:06:00'),
(12, 1, 1, 'telur ayam', 17500, 2, 35000, '2019-06-22', '21:06:00'),
(13, 1, 9, 'jagung', 6000, 2, 12000, '2019-06-30', '18:09:00'),
(14, 1, 9, 'jagung', 6000, 8, 48000, '2019-07-04', '17:02:00'),
(15, 1, 2, 'gula', 7000, 2, 14000, '2019-07-06', '15:18:00'),
(16, 1, 6, 'bayam', 2500, 7, 17500, '2019-07-06', '18:19:00'),
(17, 1, 4, 'sampo', 4000, 3, 12000, '2019-07-06', '18:19:00'),
(18, 1, 2, 'gula', 7000, 6, 42000, '2019-07-06', '18:19:00'),
(19, 1, 4, 'sampo', 4000, 1, 4000, '2019-07-06', '18:26:00'),
(20, 1, 1, 'telur ayam', 17500, 9, 157500, '2019-07-06', '18:28:00'),
(21, 1, 1, 'telur ayam', 17500, 2, 35000, '2019-09-04', '13:13:00'),
(22, 1, 4, 'sampo', 4000, 1, 4000, '2019-09-04', '01:59:00'),
(23, 1, 4, 'sampo', 4000, 4, 16000, '2019-09-12', '20:22:00'),
(24, 4, 9, 'jagung', 6000, 1, 6000, '2019-09-13', '20:40:00'),
(25, 4, 7, 'minyak goreng', 6000, 2, 12000, '2019-09-13', '15:40:00'),
(26, 4, 1, 'telur ayam', 17500, 1, 17500, '2019-09-14', '14:29:00'),
(27, 4, 9, 'jagung', 6000, 3, 18000, '2019-09-14', '18:24:00');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id_token` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `token` varchar(225) NOT NULL,
  `waktu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id_token`, `email`, `token`, `waktu`) VALUES
(5, 'dngrifai@gmail.com', 'Fbn1MR%2Fp977n12ano60xPfad0uiHkcyXn0i02Lt2S1A%3D', 1562894788),
(6, 'dngrifai@gmail.com', '8LeiXFAdupTeQzMT%2BbdSWb%2FNwUNvuEEOBCJEMZvOWSQ%3D', 1562895722);

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `telephon_toko` int(11) NOT NULL,
  `alamat_toko` varchar(100) NOT NULL,
  `moto_toko` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `telephon_toko`, `alamat_toko`, `moto_toko`) VALUES
(54, 'toko makmur', 123456, 'jl raya klaten', 'hemat');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `aktif` int(1) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `jenis_kelamin`, `telephone`, `foto`, `aktif`, `level`) VALUES
(1, 'danang', 'dngrifai@gmail.com', '$2y$10$wiJxB3Kd3vkF6/AJ9p1.Qe/bwp/mZ30J1dkPHxUECWm2LOzRdMrUy', '', '', '', 1, 0),
(4, 'rifai', 'dngrifai21@gmail.com', '$2y$10$NUBAXrkjkZSlXUW0y.ePduizp1glmG0eO4nMUTCqQ/JER87JPiYHq', '', '', '', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `cookie`
--
ALTER TABLE `cookie`
  ADD PRIMARY KEY (`id_cookie`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id_token`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cookie`
--
ALTER TABLE `cookie`
  MODIFY `id_cookie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
