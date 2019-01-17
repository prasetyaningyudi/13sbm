-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2019 at 09:39 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `13sbm`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_data`
--

CREATE TABLE `app_data` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(250) DEFAULT NULL,
  `ICON` varchar(45) DEFAULT NULL,
  `FAVICON` text,
  `NOTES` text,
  `CREATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `USER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_data`
--

INSERT INTO `app_data` (`ID`, `NAME`, `ICON`, `FAVICON`, `NOTES`, `CREATE_DATE`, `UPDATE_DATE`, `USER_ID`) VALUES
(2, 'SBM APP', 'file-invoice-dollar', '', 'Aplikasi Standar Biaya Masukan TA 2019', '2019-01-17 10:02:43', '2019-01-17 10:02:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `daftar_sbm`
--

CREATE TABLE `daftar_sbm` (
  `ID` int(11) NOT NULL,
  `KODE` varchar(255) NOT NULL,
  `KETERANGAN` text NOT NULL,
  `STATUS` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `daftar_sbm`
--

INSERT INTO `daftar_sbm` (`ID`, `KODE`, `KETERANGAN`, `STATUS`) VALUES
(1, 'SBUHPDDN', 'Satuan Biaya Uang Harian Perjalanan Dinas Dalam Negeri', 1),
(2, 'SBPPDDN', 'Satuan Biaya Penginapan Perjalanan Dinas Dalam Negeri', 1),
(3, 'SBTPDDN', 'Satuan Biaya Taksi Perjalanan Dinas Dalam Negeri', 1),
(4, 'SBTPPDDNPP', 'Satuan Biaya Tiket Pesawat Perjalanan Dinas Dalam Negeri Pergi Pulang', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `ID` int(11) NOT NULL,
  `NAMA` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`ID`, `NAMA`) VALUES
(1, 'JAKARTA'),
(2, 'AMBON'),
(3, 'BALIKPAPAN'),
(4, 'BANDA ACEH'),
(5, 'BANDAR LAMPUNG');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `ID` int(11) NOT NULL,
  `MENU_NAME` varchar(255) NOT NULL,
  `PERMALINK` text NOT NULL,
  `MENU_ICON` varchar(255) NOT NULL,
  `MENU_ORDER` varchar(10) NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1',
  `CREATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `MENU_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`ID`, `MENU_NAME`, `PERMALINK`, `MENU_ICON`, `MENU_ORDER`, `STATUS`, `CREATE_DATE`, `UPDATE_DATE`, `MENU_ID`) VALUES
(1, 'Setup Menu', '#', 'bars', '11', '1', '2019-01-08 15:51:57', '2019-01-17 09:59:37', NULL),
(2, 'User & Role', '#', 'users-cog', '12', '1', '2019-01-08 15:52:58', '2019-01-17 09:59:50', NULL),
(3, 'Application Data', 'app_data', 'cogs', '13', '1', '2019-01-08 15:54:30', '2019-01-17 10:00:03', NULL),
(4, 'List Menu', 'menu', 'bars', '1101', '1', '2019-01-08 15:55:15', '2019-01-17 09:59:41', 1),
(5, 'Assign Menu', 'assignmenu', 'bar', '1102', '1', '2019-01-08 15:56:23', '2019-01-17 09:59:44', 1),
(6, 'List User', 'user', '', '1201', '1', '2019-01-08 15:57:31', '2019-01-17 09:59:55', 2),
(7, 'List Role', 'role', '', '1202', '1', '2019-01-08 15:57:57', '2019-01-17 09:59:58', 2),
(8, 'Referensi', '#', 'clipboard-list', '03', '1', '2019-01-17 09:47:33', '2019-01-17 10:00:13', NULL),
(9, 'Daftar SBM', 'daftar_sbm', '', '0301', '1', '2019-01-17 09:48:04', '2019-01-17 10:00:16', 8),
(10, 'Satuan', 'satuan', '', '0302', '1', '2019-01-17 09:48:19', '2019-01-17 10:00:19', 8),
(11, 'Provinsi', 'provinsi', '', '0303', '1', '2019-01-17 09:48:37', '2019-01-17 10:00:24', 8),
(12, 'Kota', 'kota', '', '0304', '1', '2019-01-17 09:48:59', '2019-01-17 10:00:27', 8),
(13, 'SBM 2019', '#', 'binoculars', '01', '1', '2019-01-17 12:20:12', '2019-01-17 12:22:43', NULL),
(14, 'SBUHPDDN', 'sbuhpddn', '', '0101', '1', '2019-01-17 12:21:01', '2019-01-17 12:21:01', 13),
(15, 'SBPPDDN', 'sbppddn', '', '0102', '1', '2019-01-17 13:11:13', '2019-01-17 13:11:13', 13),
(16, 'SBTPDDN', 'sbtpddn', '', '0103', '1', '2019-01-17 14:29:51', '2019-01-17 14:29:51', 13),
(17, 'SBTPPDDNPP', 'sbtppddnpp', '', '0104', '1', '2019-01-17 14:47:10', '2019-01-17 14:47:10', 13);

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `ID` int(11) NOT NULL,
  `NAMA` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`ID`, `NAMA`) VALUES
(1, 'ACEH'),
(2, 'SUMATERA UTARA'),
(3, 'RIAU'),
(4, 'KEPULAUAN RIAU'),
(5, 'JAMBI'),
(6, 'SUMATERA BARAT'),
(7, 'SUMATERA SELATAN'),
(8, 'LAMPUNG'),
(9, 'BENGKULU'),
(10, 'BANGKA BELITUNG'),
(12, 'BANTEN');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `ID` int(11) NOT NULL,
  `ROLE_NAME` varchar(255) NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1',
  `CREATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ID`, `ROLE_NAME`, `STATUS`, `CREATE_DATE`, `UPDATE_DATE`) VALUES
(1, 'administrator', '1', '2019-01-08 15:30:43', '2019-01-08 15:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `role_menu`
--

CREATE TABLE `role_menu` (
  `ID` int(11) NOT NULL,
  `ROLE_ID` int(11) NOT NULL,
  `MENU_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_menu`
--

INSERT INTO `role_menu` (`ID`, `ROLE_ID`, `MENU_ID`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 1, 5),
(4, 1, 2),
(5, 1, 6),
(6, 1, 7),
(7, 1, 3),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `ID` int(11) NOT NULL,
  `NAMA` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`ID`, `NAMA`) VALUES
(2, 'OH'),
(3, 'Orang/Kali');

-- --------------------------------------------------------

--
-- Table structure for table `sbppddn_2019`
--

CREATE TABLE `sbppddn_2019` (
  `ID` int(11) NOT NULL,
  `ES_I` decimal(10,0) NOT NULL,
  `ES_II` decimal(10,0) NOT NULL,
  `GOL_IV` decimal(10,0) NOT NULL,
  `GOL_III` decimal(10,0) NOT NULL,
  `GOL_I_II` decimal(10,0) NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1',
  `CREATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PROVINSI_ID` int(11) NOT NULL,
  `SATUAN_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sbppddn_2019`
--

INSERT INTO `sbppddn_2019` (`ID`, `ES_I`, `ES_II`, `GOL_IV`, `GOL_III`, `GOL_I_II`, `STATUS`, `CREATE_DATE`, `UPDATE_DATE`, `PROVINSI_ID`, `SATUAN_ID`) VALUES
(1, '4420000', '3526000', '3526000', '3526001', '3526001', '1', '2019-01-17 12:57:55', '2019-01-17 15:37:39', 1, 2),
(2, '1', '1', '1', '1', '1', '1', '2019-01-17 15:37:48', '2019-01-17 15:37:48', 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sbtpddn_2019`
--

CREATE TABLE `sbtpddn_2019` (
  `ID` int(11) NOT NULL,
  `BESARAN` decimal(10,0) NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1',
  `CREATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PROVINSI_ID` int(11) NOT NULL,
  `SATUAN_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sbtpddn_2019`
--

INSERT INTO `sbtpddn_2019` (`ID`, `BESARAN`, `STATUS`, `CREATE_DATE`, `UPDATE_DATE`, `PROVINSI_ID`, `SATUAN_ID`) VALUES
(2, '123000', '1', '2019-01-17 14:30:23', '2019-01-17 14:30:23', 1, 3),
(3, '127', '1', '2019-01-17 15:33:44', '2019-01-17 15:33:44', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sbtppddnpp_2019`
--

CREATE TABLE `sbtppddnpp_2019` (
  `ID` int(11) NOT NULL,
  `BISNIS` decimal(10,0) NOT NULL,
  `EKONOMI` decimal(10,0) NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1',
  `CREATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `KOTA_ASAL_ID` int(11) NOT NULL,
  `KOTA_TUJUAN_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sbtppddnpp_2019`
--

INSERT INTO `sbtppddnpp_2019` (`ID`, `BISNIS`, `EKONOMI`, `STATUS`, `CREATE_DATE`, `UPDATE_DATE`, `KOTA_ASAL_ID`, `KOTA_TUJUAN_ID`) VALUES
(2, '1121', '122121', '1', '2019-01-17 15:01:25', '2019-01-17 15:01:25', 2, 1),
(3, '112122', '1112222', '1', '2019-01-17 15:01:39', '2019-01-17 15:01:39', 3, 1),
(4, '11', '111', '1', '2019-01-17 15:02:41', '2019-01-17 15:02:41', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sbuhpddn_2019`
--

CREATE TABLE `sbuhpddn_2019` (
  `ID` int(11) NOT NULL,
  `LUAR_KOTA` decimal(10,0) NOT NULL,
  `DALAM_KOTA` decimal(10,0) NOT NULL,
  `DIKLAT` decimal(10,0) NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1',
  `CREATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PROVINSI_ID` int(11) NOT NULL,
  `SATUAN_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sbuhpddn_2019`
--

INSERT INTO `sbuhpddn_2019` (`ID`, `LUAR_KOTA`, `DALAM_KOTA`, `DIKLAT`, `STATUS`, `CREATE_DATE`, `UPDATE_DATE`, `PROVINSI_ID`, `SATUAN_ID`) VALUES
(1, '360000', '140000', '110000', '1', '2019-01-17 11:45:16', '2019-01-17 12:11:35', 1, 2),
(3, '11', '11', '111', '1', '2019-01-17 15:36:23', '2019-01-17 15:36:23', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1',
  `CREATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ROLE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `USERNAME`, `PASSWORD`, `STATUS`, `CREATE_DATE`, `UPDATE_DATE`, `ROLE_ID`) VALUES
(1, 'prsty', 'c61a56c2b825813586744dfde2f2aad1', '1', '2019-01-08 15:30:43', '2019-01-08 15:30:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `ID` int(11) NOT NULL,
  `ALIAS` text NOT NULL,
  `EMAIL` text,
  `PHONE` varchar(255) DEFAULT NULL,
  `ADDRESS` text,
  `PHOTO_1` text,
  `USER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_data`
--
ALTER TABLE `app_data`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_APP_DATA_USER1_idx` (`USER_ID`);

--
-- Indexes for table `daftar_sbm`
--
ALTER TABLE `daftar_sbm`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_MENU_MENU1_idx` (`MENU_ID`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `role_menu`
--
ALTER TABLE `role_menu`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_ROLE_has_MENU_MENU1_idx` (`MENU_ID`),
  ADD KEY `fk_ROLE_has_MENU_ROLE1_idx` (`ROLE_ID`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sbppddn_2019`
--
ALTER TABLE `sbppddn_2019`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_SBPPDDN_2019_PROVINSI1_idx` (`PROVINSI_ID`),
  ADD KEY `fk_SBPPDDN_2019_SATUAN1_idx` (`SATUAN_ID`);

--
-- Indexes for table `sbtpddn_2019`
--
ALTER TABLE `sbtpddn_2019`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_SBTPDDN_2019_PROVINSI1_idx` (`PROVINSI_ID`),
  ADD KEY `fk_SBTPDDN_2019_SATUAN1_idx` (`SATUAN_ID`);

--
-- Indexes for table `sbtppddnpp_2019`
--
ALTER TABLE `sbtppddnpp_2019`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_SBTPPDDNPP_2019_KOTA1_idx` (`KOTA_ASAL_ID`),
  ADD KEY `fk_SBTPPDDNPP_2019_KOTA2_idx` (`KOTA_TUJUAN_ID`);

--
-- Indexes for table `sbuhpddn_2019`
--
ALTER TABLE `sbuhpddn_2019`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_UHPDDN_PROVINSI_idx` (`PROVINSI_ID`),
  ADD KEY `fk_UHPDDN_SATUAN1_idx` (`SATUAN_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USERNAME_UNIQUE` (`USERNAME`),
  ADD KEY `fk_USER_ROLE_idx` (`ROLE_ID`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_USER_INFO_USER1_idx` (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_data`
--
ALTER TABLE `app_data`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `daftar_sbm`
--
ALTER TABLE `daftar_sbm`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_menu`
--
ALTER TABLE `role_menu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sbppddn_2019`
--
ALTER TABLE `sbppddn_2019`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sbtpddn_2019`
--
ALTER TABLE `sbtpddn_2019`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sbtppddnpp_2019`
--
ALTER TABLE `sbtppddnpp_2019`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sbuhpddn_2019`
--
ALTER TABLE `sbuhpddn_2019`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_data`
--
ALTER TABLE `app_data`
  ADD CONSTRAINT `fk_APP_DATA_USER1` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_MENU_MENU1` FOREIGN KEY (`MENU_ID`) REFERENCES `menu` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `role_menu`
--
ALTER TABLE `role_menu`
  ADD CONSTRAINT `fk_ROLE_has_MENU_MENU1` FOREIGN KEY (`MENU_ID`) REFERENCES `menu` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ROLE_has_MENU_ROLE1` FOREIGN KEY (`ROLE_ID`) REFERENCES `role` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sbppddn_2019`
--
ALTER TABLE `sbppddn_2019`
  ADD CONSTRAINT `fk_SBPPDDN_2019_PROVINSI1` FOREIGN KEY (`PROVINSI_ID`) REFERENCES `provinsi` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_SBPPDDN_2019_SATUAN1` FOREIGN KEY (`SATUAN_ID`) REFERENCES `satuan` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sbtpddn_2019`
--
ALTER TABLE `sbtpddn_2019`
  ADD CONSTRAINT `fk_SBTPDDN_2019_PROVINSI1` FOREIGN KEY (`PROVINSI_ID`) REFERENCES `provinsi` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_SBTPDDN_2019_SATUAN1` FOREIGN KEY (`SATUAN_ID`) REFERENCES `satuan` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sbtppddnpp_2019`
--
ALTER TABLE `sbtppddnpp_2019`
  ADD CONSTRAINT `fk_SBTPPDDNPP_2019_KOTA1` FOREIGN KEY (`KOTA_ASAL_ID`) REFERENCES `kota` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_SBTPPDDNPP_2019_KOTA2` FOREIGN KEY (`KOTA_TUJUAN_ID`) REFERENCES `kota` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sbuhpddn_2019`
--
ALTER TABLE `sbuhpddn_2019`
  ADD CONSTRAINT `fk_UHPDDN_PROVINSI` FOREIGN KEY (`PROVINSI_ID`) REFERENCES `provinsi` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_UHPDDN_SATUAN1` FOREIGN KEY (`SATUAN_ID`) REFERENCES `satuan` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_USER_ROLE` FOREIGN KEY (`ROLE_ID`) REFERENCES `role` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `fk_USER_INFO_USER1` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
