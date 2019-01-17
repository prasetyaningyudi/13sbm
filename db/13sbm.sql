-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2019 at 02:58 AM
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
(1, 'SBUHPDDN', 'Standar Biaya Uang Harian Perjalanan Dinas Dalam Negeri', 1),
(2, 'SBPPDDN', 'Standar Biaya Penginapan Perjalanan Dinas Dalam Negeri', 1),
(3, 'SBTPDDN', 'Standar Biaya Taksi Perjalanan Dinas Dalam Negeri', 1),
(4, 'SBTPPDDNPP', 'Standar Biaya Tiket Pesawat Perjalanan Dinas Dalam Negeri Pulang Pergi', 1);

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
(1, 'Setup Menu', '#', 'bars', '01', '1', '2019-01-08 15:51:57', '2019-01-08 16:01:06', NULL),
(2, 'User & Role', '#', 'users-cog', '02', '1', '2019-01-08 15:52:58', '2019-01-08 16:01:21', NULL),
(3, 'Application Data', 'app_data', 'cogs', '03', '1', '2019-01-08 15:54:30', '2019-01-08 16:02:37', NULL),
(4, 'List Menu', 'menu', 'bars', '0101', '1', '2019-01-08 15:55:15', '2019-01-08 15:55:15', 1),
(5, 'Assign Menu', 'assignmenu', 'bar', '0102', '1', '2019-01-08 15:56:23', '2019-01-08 15:56:39', 1),
(6, 'List User', 'user', '', '0201', '1', '2019-01-08 15:57:31', '2019-01-08 15:57:31', 2),
(7, 'List Role', 'role', '', '0202', '1', '2019-01-08 15:57:57', '2019-01-08 15:57:57', 2);

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
(10, 'BANGKA BELITUNG');

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
(7, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `ID` int(11) NOT NULL,
  `NAMA` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `UDPATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PROVINSI_ID` int(11) NOT NULL,
  `SATUAN_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `daftar_sbm`
--
ALTER TABLE `daftar_sbm`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_menu`
--
ALTER TABLE `role_menu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sbppddn_2019`
--
ALTER TABLE `sbppddn_2019`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sbtpddn_2019`
--
ALTER TABLE `sbtpddn_2019`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sbtppddnpp_2019`
--
ALTER TABLE `sbtppddnpp_2019`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sbuhpddn_2019`
--
ALTER TABLE `sbuhpddn_2019`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
