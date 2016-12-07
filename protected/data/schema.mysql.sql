-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2016 at 11:04 
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simple_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_tagihan`
--

CREATE TABLE IF NOT EXISTS `tbl_detail_tagihan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_tagihan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT '1',
  `harga` double(18,2) DEFAULT '0.00',
  `diskon` double DEFAULT '0',
  `id_promosi` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `invoice_id_idx` (`id_tagihan`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_detail_tagihan`
--

INSERT INTO `tbl_detail_tagihan` (`id`, `id_tagihan`, `id_produk`, `jumlah`, `harga`, `diskon`, `id_promosi`) VALUES
(1, 1, 1, 1, 100.00, 0, 0),
(2, 1, 2, 1, 200.00, 0, 0),
(3, 2, 1, 1, 100.00, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE IF NOT EXISTS `tbl_pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(128) COLLATE utf8_bin NOT NULL DEFAULT '',
  `email_pelanggan` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `telepon_pelanggan` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `alamat_pelanggan` text COLLATE utf8_bin,
  `tanggal_input` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_input` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id`, `nama_pelanggan`, `email_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`, `tanggal_input`, `user_input`) VALUES
(1, 'pelanggan 1', 'effendi@localhost.com', '1', '1', '2013-03-07 07:55:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE IF NOT EXISTS `tbl_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(128) COLLATE utf8_bin NOT NULL,
  `deskripsi_produk` text COLLATE utf8_bin,
  `jenis_produk` varchar(64) COLLATE utf8_bin DEFAULT 'makanan' COMMENT 'makanan, minuman',
  `harga_produk` double DEFAULT '0',
  `tanggal_input` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_input` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=171 ;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id`, `nama_produk`, `deskripsi_produk`, `jenis_produk`, `harga_produk`, `tanggal_input`, `user_input`) VALUES
(1, 'Nasi Kebuli', '', '1', 100, '2014-11-03 01:01:33', 1),
(2, 'Nasi Kebuli Jumbo', '', '1', 200, '2014-11-03 01:02:53', 1),
(3, 'Gule Kambing', '', '1', 300, '2014-11-03 01:04:06', 1),
(4, 'Sate Sapi', '', '1', 400, '2014-11-03 01:06:25', 1),
(78, '+ Maryam', 'gule, maryam', '1', 7800, '2015-01-11 21:06:01', 1),
(7, 'Nasi Ayam Goreng', 'nasi, ayam, goreng', '1', 700, '2015-01-11 19:40:59', 1),
(8, 'Tim Kambing', 'tim, kambing', '1', 800, '2015-01-11 19:41:56', 1),
(9, 'Kambing Bakar Madu', 'kambing,bakar, madu', '1', 900, '2015-01-11 19:42:58', 1),
(10, 'Nasgor Kambing', 'nasgor, kambing', '1', 1000, '2015-01-11 19:43:52', 1),
(11, 'Nasgor Ayam', 'nasgor, ayam', '1', 1100, '2015-01-11 19:45:57', 1),
(12, 'Nasi Kambing Goreng', 'nasi, krengsengan, kambing, goreng', '1', 1200, '2015-01-11 19:46:31', 1),
(13, 'Kentang goreng', 'kentang, goreng', '1', 1300, '2015-01-11 19:47:00', 1),
(14, 'Nasi putih', 'nasi, putih', '1', 1400, '2015-01-11 19:47:30', 1),
(15, 'Kebab', 'kebab', '1', 1500, '2015-01-11 19:48:01', 1),
(16, 'Fhull', 'full', '1', 1600, '2015-01-11 19:48:25', 1),
(17, 'Sambosa', 'sambosa', '1', 1700, '2015-01-11 19:48:58', 1),
(18, 'Sazuka', 'saszuka', '1', 1800, '2015-01-11 19:49:23', 1),
(19, 'Maryam', 'maryam', '1', 1900, '2015-01-11 19:50:00', 1),
(20, 'Dadar', 'dadar', '1', 2000, '2015-01-11 19:50:28', 1),
(21, '+ Keju', 'keju, maryam, saszuka', '1', 2100, '2015-01-11 19:51:11', 1),
(22, '+ Coklat', 'maryam, dadar', '1', 2200, '2015-01-11 19:51:56', 1),
(23, '+ Coklat Keju', 'coklat, maryam, dadar', '1', 2300, '2015-01-11 19:53:42', 1),
(84, 'Nasi kebuli polos', 'nasi, kebuli, polos', '1', 8400, '2015-01-16 23:45:35', 1),
(24, '+ Ice Cream', 'maryam, dadar, es', '1', 2400, '2015-01-11 19:54:23', 1),
(145, 'sahe 1 teko', 'sahe, teko', '2', 14500, '2015-06-20 23:24:35', 1),
(25, '+ Spesial', 'spesial, saszuka, maryam, dadar', '1', 2500, '2015-01-11 19:55:06', 1),
(26, 'Ice/hot Tea', 'teh, es, panas, ice, hot, tea', '1', 2600, '2015-01-11 19:56:46', 1),
(27, 'Ice/hot orange', 'jeruk, es, panas, orange', '2', 2700, '2015-01-11 19:57:20', 1),
(28, 'Sahe', 'sahe', '2', 2800, '2015-01-11 19:57:44', 1),
(29, 'Qahwa', 'gahwa', '2', 2900, '2015-01-11 19:58:23', 1),
(30, 'Najwa', 'nadjwa', '2', 3000, '2015-01-11 19:59:02', 1),
(31, 'Safa', 'safa', '2', 3100, '2015-01-11 19:59:24', 1),
(32, 'Marwah', 'marwah', '2', 3200, '2015-01-11 19:59:48', 1),
(33, 'Float', 'float', '2', 3300, '2015-01-11 20:00:15', 1),
(34, 'Jus Alpukat', 'jus, alpukat', '2', 3400, '2015-01-11 20:00:41', 1),
(35, 'Jus Sirsak', 'jus, sirsak', '2', 3500, '2015-01-11 20:01:08', 1),
(36, 'Jus Melon', 'jus, melon', '2', 3600, '2015-01-11 20:01:28', 1),
(37, 'Jus Semangka', 'jus, semangka', '2', 3700, '2015-01-11 20:01:46', 1),
(38, 'Jus Jeruk', 'jus, jeruk', '2', 3800, '2015-01-11 20:02:04', 1),
(39, 'Jus Jambu', 'jus, jambu', '2', 3900, '2015-01-11 20:05:38', 1),
(40, 'Jus Kurma', 'jus, kurma', '2', 4000, '2015-01-11 20:06:03', 1),
(41, 'Air mineral Ades', 'air, mineral, ades', '2', 4100, '2015-01-11 20:07:25', 1),
(42, 'Air mineral Pristin', 'air, mineral, pristin', '2', 4200, '2015-01-11 20:08:02', 1),
(43, 'Air putih', 'air, putih', '2', 4300, '2015-01-11 20:08:25', 1),
(44, 'Minute Maid', 'minute, maid', '2', 4400, '2015-01-11 20:09:25', 1),
(45, 'Frestea botol kaca', 'frestea, botol, kaca', '2', 4500, '2015-01-11 20:10:06', 1),
(46, 'Frestea botol plastik', 'frestea, botol, plastik', '2', 4600, '2015-01-11 20:10:29', 1),
(47, 'Sprite botol kaca', 'sprite, botol, kaca', '2', 4700, '2015-01-11 20:11:01', 1),
(48, 'Sprite botol plastik', 'sprite, botol, plastik', '2', 4800, '2015-01-11 20:11:37', 1),
(49, 'Coca cola botol kaca', 'coca, cola, botol, kaca', '2', 4900, '2015-01-11 20:12:52', 1),
(50, 'Coca cola botol plastik', 'coca, cola, botol, plastik', '2', 5000, '2015-01-11 20:13:28', 1),
(51, 'Fanta botol kaca', 'fanta, botol, kaca', '2', 5100, '2015-01-11 20:13:55', 1),
(52, 'Fanta botol plastik', 'fanta, botol, plastik', '2', 5200, '2015-01-11 20:14:23', 1),
(53, 'Shisha', 'shisha', '2', 5300, '2015-01-11 20:16:19', 1),
(54, ' + Buah', 'shisha, buah', '2', 5400, '2015-01-11 20:16:45', 1),
(55, ' + Juice', 'shisha, juice', '2', 5500, '2015-01-11 20:17:08', 1),
(56, ' + Soft drink', 'shisha, soft, drink', '2', 5600, '2015-01-11 20:17:41', 1),
(58, 'Ganti rasa Reguler/tungku', 'shisha, ganti, rasa, reguler, tungku', '2', 5800, '2015-01-11 20:18:49', 1),
(59, 'Ganti rasa Buah', 'shisha, ganti, rasa', '2', 5900, '2015-01-11 20:19:29', 1),
(60, 'Pipet', 'shisha, pipet', '2', 6000, '2015-01-11 20:21:00', 1),
(61, 'Gule polos', 'gule, polos', '2', 6100, '2015-01-11 20:21:51', 1),
(62, 'Daging Kambing goreng', 'daging, kambing, goreng', '1', 6200, '2015-01-11 20:22:38', 1),
(63, 'Kambing bakar tanpa nasi', 'kambing, bakar, tanpa, nasi', '1', 6300, '2015-01-11 20:23:39', 1),
(64, 'Tim kambing+maryam', 'tim, kambing', '1', 6400, '2015-01-11 20:24:27', 1),
(65, 'Nasi kebuli ayam', 'nasi, kebuli, ayam', '2', 6500, '2015-01-11 20:24:59', 1),
(148, 'Nasi kebuli ayam disc', 'kebuli, ayam', '1', 14800, '2015-06-21 23:18:05', 1),
(66, 'Susu putih', 'susu, putih', '2', 6600, '2015-01-11 20:25:26', 1),
(67, 'Kopi hitam', 'kopi, hitam', '2', 6700, '2015-01-11 20:25:52', 1),
(68, 'Teh tawar', 'teh, tawar', '2', 6800, '2015-01-11 20:26:23', 1),
(69, 'Minke 7k', 'minke, 7k', '2', 6900, '2015-01-11 20:28:11', 1),
(70, 'Minke 10k', 'minke, 10k', '2', 7000, '2015-01-11 20:28:53', 1),
(71, 'Minke 12k', 'minke, 12k', '2', 7100, '2015-01-11 20:29:31', 1),
(72, 'Minke 13k', 'minke, 13k', '2', 7200, '2015-01-11 20:29:55', 1),
(73, 'Minke 15k', 'minke, 15k', '2', 7300, '2015-01-11 20:30:47', 1),
(74, 'Minke 17k', 'minke, 17k', '2', 7400, '2015-01-11 20:31:30', 1),
(75, 'Minke 20k', 'minke, 20k', '2', 7500, '2015-01-11 20:32:01', 1),
(76, 'Lemon tea', 'lemon, tea', '2', 7600, '2015-01-11 20:32:33', 1),
(77, 'Emping', 'emping', '1', 7700, '2015-01-11 20:33:23', 1),
(79, 'telor', 'telor', '1', 7900, '2015-01-11 21:43:07', 1),
(80, 'kopi susu', 'kopi, susu', '2', 8000, '2015-01-12 23:55:15', 1),
(81, 'Kopi susu es', 'kopi, susu, es', '2', 8100, '2015-01-12 23:56:22', 1),
(82, 'Sahe adane', 'sahe, adane', '2', 8200, '2015-01-13 19:59:34', 1),
(83, 'Teh tarik', 'teh, tarik', '2', 8300, '2015-01-13 20:00:18', 1),
(85, 'Es coklat', 'es, coklat', '2', 8500, '2015-01-16 23:48:38', 1),
(86, '+ kuah gule', 'kuah, gule', '1', 8600, '2015-01-18 20:57:37', 1),
(87, 'Kopi leci', 'kopi, leci', '2', 8700, '2015-01-21 23:12:26', 1),
(88, 'Nasgor polos', 'nasgor, polos', '1', 8800, '2015-01-23 22:47:59', 1),
(89, 'Marwa', 'minuman', '2', 8900, '2015-01-24 12:37:49', 3),
(90, 'Maryam', 'makanan', '1', 9000, '2015-01-24 14:43:13', 3),
(99, 'Hot chocolate', 'hot, chocolate', '2', 9900, '2015-02-23 23:27:13', 1),
(91, 'Kambing bakar madu polos', 'kambing, bakar, madu, polos', '1', 9100, '2015-01-25 19:29:44', 1),
(132, 'sambosa mentah', '', '1', 13200, '2015-04-17 13:42:45', 3),
(92, 'Ayam goreng', 'ayam, goreng', '1', 9200, '2015-02-03 20:23:54', 1),
(93, 'Nasi kebuli jumbo ayam', 'nasi, kebuli, jumbo, ayam', '1', 9300, '2015-02-04 20:21:24', 4),
(94, 'Nasi kebuli jumbo polos', 'nasi, kebuli, jumbo, polos', '1', 9400, '2015-02-04 21:47:37', 4),
(95, 'tamis', '', '1', 9500, '2015-02-08 12:59:50', 3),
(96, 'tamis', '', '1', 9600, '2015-02-08 13:00:23', 3),
(97, 'Ayam bakar', 'makanan lezat', '1', 9700, '2015-02-08 23:07:52', 3),
(98, 'Ayam bakar', 'makanan lezat', '1', 9800, '2015-02-08 23:08:48', 3),
(100, 'Nasi Briyani', 'nasi, briyani', '1', 10000, '2015-02-27 23:07:46', 1),
(101, 'Nasi Briyani ayam', 'nasi, briyani, ayam', '1', 10100, '2015-03-03 22:35:53', 1),
(102, 'Jus apel', '', '2', 10200, '2015-03-12 14:04:39', 3),
(103, 'Ayam bakar madu', 'ayam,bakar,madu', '1', 10300, '2015-03-12 18:38:53', 3),
(104, 'Capucino', 'kopi', '2', 10400, '2015-03-15 19:20:27', 3),
(105, 'Nasi Briyani telor', 'Nasi, Briyani, telor', '1', 10500, '2015-03-28 23:58:09', 1),
(106, 'White milk', '', '2', 10600, '2015-04-03 15:49:16', 3),
(107, 'Chocolate milk', '', '2', 10700, '2015-04-03 15:49:41', 3),
(108, 'Ice Chocolate ', '', '2', 10800, '2015-04-03 15:50:07', 3),
(109, 'Chocolate mint', '', '2', 10900, '2015-04-03 15:50:32', 3),
(110, 'Chocolate vanilla', '', '2', 11000, '2015-04-03 15:51:46', 3),
(111, 'Creamy coffe', '', '2', 11100, '2015-04-03 15:52:11', 3),
(112, 'Cinammon coffe', '', '2', 11200, '2015-04-03 15:52:39', 3),
(113, 'Mocca coffe', '', '2', 11300, '2015-04-03 15:53:01', 3),
(139, 'teh panas/dingin', '', '2', 13900, '2015-06-02 19:25:01', 3),
(114, 'Lychee latte', '', '2', 11400, '2015-04-03 15:53:33', 3),
(115, 'Strawberry latte', '', '2', 11500, '2015-04-03 15:53:58', 3),
(116, 'Vanilla latte', '', '2', 11600, '2015-04-03 15:54:23', 3),
(117, 'Milkshake', '', '2', 11700, '2015-04-03 15:54:52', 3),
(118, 'Alpukat keruk', '', '1', 11800, '2015-04-03 18:24:19', 3),
(119, '+milo', '', '1', 11900, '2015-04-03 18:25:24', 3),
(135, 'kebab polos', 'kebab, polos', '1', 13500, '2015-05-26 19:51:38', 1),
(120, '+nutella', '', '1', 12000, '2015-04-03 18:25:52', 3),
(121, '+krunch', '', '1', 12100, '2015-04-03 18:26:22', 3),
(122, '+oreo', '', '1', 12200, '2015-04-03 18:28:11', 3),
(123, '+energen', '', '1', 12300, '2015-04-03 18:28:41', 3),
(124, '+beng-beng', '', '1', 12400, '2015-04-03 18:29:23', 3),
(125, 'Shisha premium', 'shisha, premium', '2', 12500, '2015-04-03 22:33:08', 1),
(126, 'Milkshake ', 'minuman laziz', '2', 12600, '2015-04-07 11:08:41', 4),
(127, 'Daging ayam goreng', 'daging, ayam, goreng', '1', 12700, '2015-04-07 21:13:31', 1),
(170, '+bara', 'bara', '2', 17000, '2015-10-07 22:45:29', 1),
(129, 'jus strawberry', '', '2', 12900, '2015-04-12 13:38:35', 3),
(130, 'Air es', 'air, es', '2', 13000, '2015-04-12 19:26:36', 3),
(131, '+ bucket', 'bucket', '2', 13100, '2015-04-14 20:09:03', 1),
(133, 'air mineral aqua', 'air, mineral, aqua', '2', 13300, '2015-05-16 22:03:42', 1),
(134, 'kambing goreng tanpa nasi', '', '1', 13400, '2015-05-18 18:59:08', 3),
(136, 'daging krengsengan', 'daging, krengsengan', '1', 13600, '2015-05-26 20:36:26', 1),
(137, 'greentea', '', '2', 13700, '2015-05-28 15:28:34', 3),
(138, '+vanilla', '', '2', 13800, '2015-05-28 15:29:13', 3),
(140, 'Yamanies', 'yamanies', '2', 14000, '2015-06-13 19:42:03', 1),
(141, 'Arabian Ovomaltine', 'Arabian, ovomaltine', '2', 14100, '2015-06-13 19:46:01', 1),
(142, 'Hadramies', 'Hadramies', '2', 14200, '2015-06-13 19:46:26', 1),
(143, 'Pudding kampung arab', 'pudding, kampung, arab', '2', 14300, '2015-06-13 19:47:48', 1),
(144, 'Miloreo', 'miloreo', '2', 14400, '2015-06-13 19:48:12', 1),
(146, 'Jus wortel', 'jus, wortel', '2', 14600, '2015-06-20 23:25:34', 1),
(147, 'Jus mangga', 'jus, mangga', '2', 14700, '2015-06-20 23:26:02', 1),
(149, 'Nasgor ayam jumbo', 'Nasgor, ayam, jumbo', '1', 14900, '2015-06-23 21:22:21', 1),
(150, 'Nasi Briyani polos', 'nasi, briyani, polos', '1', 15000, '2015-06-28 23:22:27', 1),
(151, 'Nasi Briyani disc', 'nasi, briyani, disc', '1', 15100, '2015-06-28 23:32:38', 1),
(152, 'Minke 14k', 'minke, 14k', '2', 15200, '2015-07-01 17:19:01', 1),
(153, 'Jus semangka disc', 'jus, semangka, disc', '2', 15300, '2015-07-03 21:57:40', 1),
(154, 'Nasi Briyani jumbo', 'Nasi, Briyani, jumbo', '1', 15400, '2015-07-03 23:23:45', 1),
(155, 'Tim kambing polos', 'tim, kambing, polos', '1', 15500, '2015-07-14 23:36:18', 1),
(156, '+ milk', 'shisha, milk', '2', 15600, '2015-07-20 23:05:12', 1),
(157, 'Milkshake float', 'Milkshake float', '2', 15700, '2015-08-20 19:14:06', 1),
(158, 'Shisha disc50%', 'shisha', '2', 15800, '2015-08-22 21:36:06', 1),
(159, 'Briyani Jumbo Ayam', '', '1', 15900, '2015-09-09 17:19:46', 1),
(160, 'Briyani Jumbo Ayam', '', '1', 16000, '2015-09-09 17:20:33', 1),
(161, 'Sop/Gule Sumsum', '', '1', 16100, '2015-09-12 13:12:21', 1),
(167, 'Air mineral', 'air, mineral', '2', 16700, '2015-09-18 23:03:31', 1),
(163, 'Gule sumsum', 'gule, sumsum', '1', 16300, '2015-09-17 21:51:25', 1),
(164, 'Tim sumsum', 'tim, sumsum', '1', 16400, '2015-09-17 21:51:42', 1),
(168, 'Nasgor kambing jumbo', 'nasgor, kambing, jumbo', '1', 16800, '2015-10-06 22:51:57', 1),
(166, 'Shisha flavour', 'shisha, flavour', '2', 16600, '2015-09-17 22:03:55', 1),
(169, 'Nutrisari', 'nutrisari', '2', 16900, '2015-10-07 22:42:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk_diskon`
--

CREATE TABLE IF NOT EXISTS `tbl_produk_diskon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NOT NULL,
  `jumlah_produk` int(4) DEFAULT '1',
  `harga_produk` double DEFAULT '0',
  `tanggal_mulai_diskon` datetime DEFAULT NULL,
  `tanggal_berakhir_diskon` datetime DEFAULT NULL,
  `tanggal_input` datetime NOT NULL,
  `user_input` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`id_produk`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promosi`
--

CREATE TABLE IF NOT EXISTS `tbl_promosi` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode_promosi` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `jenis_promosi` varchar(30) NOT NULL DEFAULT 'persentase' COMMENT 'absolut, percentage',
  `nilai_promosi` double DEFAULT '0',
  `maksimal_digunakan` int(11) DEFAULT '0',
  `telah_digunakan` int(11) DEFAULT '0',
  `status_promosi` varchar(32) DEFAULT 'aktif' COMMENT 'aktif, tidak_aktif',
  `produk_yang_terdiskon` text,
  `tanggal_mulai_promosi` datetime DEFAULT NULL,
  `tanggal_berakhir_promosi` datetime DEFAULT NULL,
  `tanggal_input` datetime NOT NULL,
  `user_input` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `start_index_idx` (`tanggal_mulai_promosi`),
  KEY `end_index_idx` (`tanggal_berakhir_promosi`),
  KEY `active_index_idx` (`status_promosi`),
  KEY `code_index_idx` (`kode_promosi`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_promosi`
--

INSERT INTO `tbl_promosi` (`id`, `kode_promosi`, `deskripsi`, `jenis_promosi`, `nilai_promosi`, `maksimal_digunakan`, `telah_digunakan`, `status_promosi`, `produk_yang_terdiskon`, `tanggal_mulai_promosi`, `tanggal_berakhir_promosi`, `tanggal_input`, `user_input`) VALUES
(1, 'DISC25%', '', 'percentage', 20, 0, 0, 'aktif', NULL, '2014-10-06 00:00:00', '2015-06-30 00:00:00', '2014-10-24 00:00:00', '2014-10-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tagihan`
--

CREATE TABLE IF NOT EXISTS `tbl_tagihan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nomor_tagihan` varchar(32) NOT NULL,
  `id_pelanggan` int(11) DEFAULT '0',
  `total_tagihan` double DEFAULT '0',
  `status_tagihan` varchar(16) DEFAULT 'paid' COMMENT 'paid,unpaid,refund',
  `tanggal_pembayaran` datetime DEFAULT NULL,
  `tanggal_input` datetime NOT NULL,
  `user_input` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id_idx` (`id_pelanggan`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_tagihan`
--

INSERT INTO `tbl_tagihan` (`id`, `nomor_tagihan`, `id_pelanggan`, `total_tagihan`, `status_tagihan`, `tanggal_pembayaran`, `tanggal_input`, `user_input`) VALUES
(1, 'P-INV-0001', 0, 300, 'paid', '2016-12-07 22:41:07', '2016-12-07 22:41:07', 1),
(2, 'P-INV-0002', 1, 100, 'paid', '2016-12-07 22:44:09', '2016-12-07 22:44:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(32) DEFAULT 'aktif' COMMENT 'aktif, tidak_aktif',
  `hak_akses` text,
  `tanggal_input` datetime NOT NULL,
  `user_input` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `status`, `hak_akses`, `tanggal_input`, `user_input`) VALUES
(1, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'aktif', NULL, '2012-01-19 09:42:26', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
