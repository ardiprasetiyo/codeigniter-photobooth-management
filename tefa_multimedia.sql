-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2019 at 03:13 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tefa_multimedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `tefa_account`
--

CREATE TABLE `tefa_account` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` int(11) NOT NULL,
  `last_login` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `profile_images` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tefa_account`
--

INSERT INTO `tefa_account` (`id`, `username`, `password`, `full_name`, `email`, `role`, `last_login`, `is_active`, `profile_images`) VALUES
(1, 'admin', '39512188952616c19ce4af3b011fcb5cd59dcc1af3ed4e0ea8139db0f351c7f1', 'Ardi Prasetiyo', 'ardiprasetiyo@students.smkn3bandung.sch.id', 3, 1563757611, 1, 'default');

-- --------------------------------------------------------

--
-- Table structure for table `tefa_account_roles`
--

CREATE TABLE `tefa_account_roles` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tefa_account_roles`
--

INSERT INTO `tefa_account_roles` (`id_role`, `role_name`) VALUES
(1, 'SuperAdmin'),
(2, 'Admin'),
(3, 'Editing'),
(4, 'Produksi'),
(5, 'FrontOffice'),
(6, 'Cashier');

-- --------------------------------------------------------

--
-- Table structure for table `tefa_editing`
--

CREATE TABLE `tefa_editing` (
  `id_editing` int(11) NOT NULL,
  `order_code` varchar(200) NOT NULL,
  `editor` int(11) NOT NULL,
  `editing_date_start` int(11) NOT NULL,
  `editing_date_finish` int(11) NOT NULL,
  `editing_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tefa_log`
--

CREATE TABLE `tefa_log` (
  `id_log` int(11) NOT NULL,
  `log_date` int(11) NOT NULL,
  `log_user` int(11) NOT NULL,
  `log_activity` varchar(200) NOT NULL,
  `log_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tefa_log`
--

INSERT INTO `tefa_log` (`id_log`, `log_date`, `log_user`, `log_activity`, `log_description`) VALUES
(1, 1563318422, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(2, 1563318565, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(3, 1563318640, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(4, 1563362153, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(5, 1563371706, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(6, 1563405583, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(7, 1563415315, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(8, 1563415378, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(9, 1563420506, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(10, 1563427747, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(11, 1563428281, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(12, 1563516779, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(13, 1563531870, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(14, 1563532099, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(15, 1563532131, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(16, 1563532238, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(17, 1563540452, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(18, 1563540519, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(19, 1563536927, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(20, 1563537516, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(21, 1563538953, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(22, 1563538985, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(23, 1563539011, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(24, 1563539558, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(25, 1563539647, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(26, 1563539709, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(27, 1563543276, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(28, 1563597225, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(29, 1563597338, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(30, 1563597392, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(31, 1563609739, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(32, 1563624032, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(33, 1563627299, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(34, 1563627335, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(35, 1563627374, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(36, 1563627981, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(37, 1563635192, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(38, 1563673562, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(39, 1563675703, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(40, 1563675787, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(41, 1563675877, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(42, 1563703366, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(43, 1563707216, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(44, 1563707239, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(45, 1563707256, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(46, 1563707305, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(47, 1563707735, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(48, 1563719630, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(49, 1563724773, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(50, 1563725144, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(51, 1563813448, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(52, 1563813622, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(53, 1563727244, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(54, 1563728051, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(55, 1563728193, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(56, 1563728643, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(57, 1563728695, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi'),
(58, 1563757591, 1, 'Login Aplikasi', 'Melakukan request login kedalam aplikasi');

-- --------------------------------------------------------

--
-- Table structure for table `tefa_order`
--

CREATE TABLE `tefa_order` (
  `id_order` int(11) NOT NULL,
  `order_code` varchar(100) NOT NULL,
  `order_date` int(11) NOT NULL,
  `order_deadline` int(11) NOT NULL,
  `order_description` text NOT NULL,
  `order_status` int(11) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `customer_phone` varchar(200) NOT NULL,
  `customer_email` varchar(200) NOT NULL,
  `is_approved` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tefa_order`
--

INSERT INTO `tefa_order` (`id_order`, `order_code`, `order_date`, `order_deadline`, `order_description`, `order_status`, `customer_name`, `customer_phone`, `customer_email`, `is_approved`) VALUES
(1, '210719-060736.T', 1563707266, 1563710866, '[3x Photo Group Express] \nIMG_1886 CETAK 2\nIMG_1887 CETAK 1X\n\n[1x Photo Group Standard (A4)] \nIMG_1885 CETAK 1X', 2, 'REGA MADILA', '085821779898', 'regamadila@students.smkn3bandung.sch.id', 1);

--
-- Triggers `tefa_order`
--
DELIMITER $$
CREATE TRIGGER `trigger` AFTER DELETE ON `tefa_order` FOR EACH ROW DELETE FROM tefa_order WHERE customer_name = ""
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tefa_order_details`
--

CREATE TABLE `tefa_order_details` (
  `id_order_list` int(11) NOT NULL,
  `order_code` varchar(200) NOT NULL,
  `order_product` int(11) NOT NULL,
  `order_cetak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tefa_order_details`
--

INSERT INTO `tefa_order_details` (`id_order_list`, `order_code`, `order_product`, `order_cetak`) VALUES
(1, '210719-060736.T', 2, 1),
(2, '210719-060736.T', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tefa_order_tracking`
--

CREATE TABLE `tefa_order_tracking` (
  `id_tracking` int(11) NOT NULL,
  `order_code` varchar(200) NOT NULL,
  `tracking_date` int(11) NOT NULL,
  `tracking_location` varchar(200) NOT NULL,
  `tracking_description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tefa_order_tracking`
--

INSERT INTO `tefa_order_tracking` (`id_tracking`, `order_code`, `tracking_date`, `tracking_location`, `tracking_description`) VALUES
(1, '210719-060736.T', 1563707397, 'Front Office - Review Order', 'Order sudah ditindak lanjut oleh Front Office'),
(2, '210719-060736.T', 1563707879, 'Editing - Editing Session', 'Order sedang dalam proses editing');

-- --------------------------------------------------------

--
-- Table structure for table `tefa_product`
--

CREATE TABLE `tefa_product` (
  `id_product` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` varchar(100) NOT NULL,
  `product_cost` int(11) NOT NULL,
  `product_basepoint` int(11) NOT NULL,
  `product_deadline` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tefa_product`
--

INSERT INTO `tefa_product` (`id_product`, `product_name`, `product_description`, `product_cost`, `product_basepoint`, `product_deadline`) VALUES
(1, 'Photo Group Express', 'Photo Group Express', 35000, 2, 3600),
(2, 'Photo Group Standard (A4)', 'Photo Group Standad Ukuran A4 Plus Frame dan Laminasi', 20000, 2, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `tefa_tom_config`
--

CREATE TABLE `tefa_tom_config` (
  `id_config` int(11) NOT NULL,
  `config_name` varchar(200) NOT NULL,
  `config_value` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tefa_tom_config`
--

INSERT INTO `tefa_tom_config` (`id_config`, `config_name`, `config_value`) VALUES
(1, 'storage_location', '/home/ardiprasetiyo/Pictures/'),
(2, 'storage_mapping_link', '/storage/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tefa_account`
--
ALTER TABLE `tefa_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tefa_account_roles`
--
ALTER TABLE `tefa_account_roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `tefa_editing`
--
ALTER TABLE `tefa_editing`
  ADD PRIMARY KEY (`id_editing`);

--
-- Indexes for table `tefa_log`
--
ALTER TABLE `tefa_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `tefa_order`
--
ALTER TABLE `tefa_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `tefa_order_details`
--
ALTER TABLE `tefa_order_details`
  ADD PRIMARY KEY (`id_order_list`);

--
-- Indexes for table `tefa_order_tracking`
--
ALTER TABLE `tefa_order_tracking`
  ADD PRIMARY KEY (`id_tracking`);

--
-- Indexes for table `tefa_product`
--
ALTER TABLE `tefa_product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `tefa_tom_config`
--
ALTER TABLE `tefa_tom_config`
  ADD PRIMARY KEY (`id_config`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tefa_account`
--
ALTER TABLE `tefa_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tefa_account_roles`
--
ALTER TABLE `tefa_account_roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tefa_editing`
--
ALTER TABLE `tefa_editing`
  MODIFY `id_editing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tefa_log`
--
ALTER TABLE `tefa_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tefa_order`
--
ALTER TABLE `tefa_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tefa_order_details`
--
ALTER TABLE `tefa_order_details`
  MODIFY `id_order_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tefa_order_tracking`
--
ALTER TABLE `tefa_order_tracking`
  MODIFY `id_tracking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tefa_product`
--
ALTER TABLE `tefa_product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tefa_tom_config`
--
ALTER TABLE `tefa_tom_config`
  MODIFY `id_config` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
