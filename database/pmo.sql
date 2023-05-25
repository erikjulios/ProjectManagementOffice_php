-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 11:57 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmo`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_fgd`
--

CREATE TABLE `db_fgd` (
  `kode_fgd` varchar(50) NOT NULL,
  `no_transaksi` int(20) NOT NULL,
  `tanggal_create` varchar(20) NOT NULL,
  `tahun_fgd` int(11) NOT NULL,
  `nama_fgd` varchar(100) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `team` varchar(100) NOT NULL,
  `user_create` varchar(10) NOT NULL,
  `user_modified` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_fgd`
--

INSERT INTO `db_fgd` (`kode_fgd`, `no_transaksi`, `tanggal_create`, `tahun_fgd`, `nama_fgd`, `pic`, `team`, `user_create`, `user_modified`) VALUES
('Bumitama2023001', 0, '2023-03-10 10:05:07', 2023, 'Nama 1', '12', '11,12,13', '2023-03-10', ''),
('Bumitama2023002', 0, '2023-03-15 11:21:03', 2023, 'Nama 2', '13', '12,13,14', '2023-03-15', ''),
('Bumitama2023003', 0, '2023-03-15 11:41:14', 2023, 'Nama 3', '11', '13,14,15', '2023-03-15', ''),
('Bumitama2023005', 0, '2023-03-15 13:32:09', 2023, 'Nama 4', '9', '6,7,8', '2023-03-15', ''),
('Bumitama2023006', 0, '2023-03-15 14:28:51', 2022, 'Nama 5', '8', '7,9,14', '2023-03-15', ''),
('Bumitama2023007', 0, '2023-03-15 14:41:29', 2023, 'Nama 6', '10', '7,8,9', '2023-03-15', ''),
('Bumitama2023008', 222104, '2023-03-28 13:57:57', 2023, 'Nama 7', '8', '6,7,8,9', '2023-03-28', '');

-- --------------------------------------------------------

--
-- Table structure for table `db_target_activity`
--

CREATE TABLE `db_target_activity` (
  `kode_activity` int(11) NOT NULL,
  `kode_intermediate` int(11) DEFAULT NULL,
  `no_transaksi` int(20) DEFAULT NULL,
  `tanggal_create` varchar(20) DEFAULT NULL,
  `kode_fgd` varchar(50) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `supported_by` varchar(50) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `uom` varchar(50) NOT NULL,
  `target` varchar(50) NOT NULL,
  `estimasi_cost` int(50) NOT NULL,
  `start` varchar(50) NOT NULL,
  `end` varchar(50) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `target_jan` varchar(10) DEFAULT NULL,
  `target_feb` varchar(10) DEFAULT NULL,
  `target_mar` varchar(10) DEFAULT NULL,
  `target_apr` varchar(10) DEFAULT NULL,
  `target_mei` varchar(10) DEFAULT NULL,
  `target_jun` varchar(10) DEFAULT NULL,
  `target_jul` varchar(10) DEFAULT NULL,
  `target_aug` varchar(10) DEFAULT NULL,
  `target_sep` varchar(10) DEFAULT NULL,
  `target_okt` varchar(10) DEFAULT NULL,
  `target_nov` varchar(10) DEFAULT NULL,
  `target_des` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `user_create` varchar(20) DEFAULT NULL,
  `user_modified` varchar(20) DEFAULT NULL,
  `tanggal_modified` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_target_activity`
--

INSERT INTO `db_target_activity` (`kode_activity`, `kode_intermediate`, `no_transaksi`, `tanggal_create`, `kode_fgd`, `activity`, `pic`, `supported_by`, `lokasi`, `uom`, `target`, `estimasi_cost`, `start`, `end`, `duration`, `target_jan`, `target_feb`, `target_mar`, `target_apr`, `target_mei`, `target_jun`, `target_jul`, `target_aug`, `target_sep`, `target_okt`, `target_nov`, `target_des`, `status`, `user_create`, `user_modified`, `tanggal_modified`) VALUES
(8, 1, 770219, '2023-04-11 20:23:24', 'Bumitama2023002', 'act1', '12', '7', 'jakarta', '1', '12', 200000, '2023-04-26', '2023-04-27', '1', 't1', 't2', 't3', 't4', 't5', 't6', 't7', 't8', 't9', 't10', 't11', 't12', 'input', 'admin', 'admin', '2023-04-14 15:30:11'),
(9, 5, 138546, '2023-04-11 20:31:32', 'Bumitama2023002', 'act21', '6', '7,9,11', 'jakarta', '2', '12', 200000, '2023-04-26', '2023-04-27', '1', 't1', 't2', 't3', 't4', 't5', 't6', 't7', 't8', 't9', 't10', 't11', 't12', 'input', 'admin', 'admin', '2023-04-18 15:12:28'),
(10, 2, 837954, '2023-04-12 10:35:19', 'Bumitama2023001', 'act33', '8', '6,7,8', 'jakarta', '4', '12', 3400000, '2023-04-26', '2023-04-30', '4', 't11', 't21', 't31', 't41', 't51', 't61', 't71', 't81', 't91', 't101', 't111', 't121', 'input', 'admin', 'admin', '2023-04-18 14:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `db_target_end_result`
--

CREATE TABLE `db_target_end_result` (
  `kode_endresult` int(11) NOT NULL,
  `no_transaksi` int(20) DEFAULT NULL,
  `tanggal_create` varchar(20) DEFAULT NULL,
  `kode_fgd` varchar(20) NOT NULL,
  `end_result` varchar(100) NOT NULL,
  `uom` varchar(10) NOT NULL,
  `estimate_cost` int(20) NOT NULL,
  `start` varchar(20) NOT NULL,
  `end` varchar(20) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `asis` varchar(10) NOT NULL,
  `tube` int(5) NOT NULL,
  `target_jan` varchar(10) DEFAULT NULL,
  `target_feb` varchar(10) DEFAULT NULL,
  `target_mar` varchar(10) DEFAULT NULL,
  `target_apr` varchar(10) DEFAULT NULL,
  `target_mei` varchar(10) DEFAULT NULL,
  `target_jun` varchar(10) DEFAULT NULL,
  `target_jul` varchar(10) DEFAULT NULL,
  `target_aug` varchar(10) DEFAULT NULL,
  `target_sep` varchar(10) DEFAULT NULL,
  `target_okt` varchar(10) DEFAULT NULL,
  `target_nov` varchar(10) DEFAULT NULL,
  `target_des` varchar(10) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `user_create` varchar(20) DEFAULT NULL,
  `user_modified` varchar(20) DEFAULT NULL,
  `tanggal_modified` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_target_end_result`
--

INSERT INTO `db_target_end_result` (`kode_endresult`, `no_transaksi`, `tanggal_create`, `kode_fgd`, `end_result`, `uom`, `estimate_cost`, `start`, `end`, `duration`, `asis`, `tube`, `target_jan`, `target_feb`, `target_mar`, `target_apr`, `target_mei`, `target_jun`, `target_jul`, `target_aug`, `target_sep`, `target_okt`, `target_nov`, `target_des`, `status`, `user_create`, `user_modified`, `tanggal_modified`) VALUES
(29, NULL, '2023-03-08 15:41:08', 'Bumitama2023001', 'end result test 1', '2', 90000, '2023-03-08', '2023-03-10', '2', '10', 1, 't11', 't21', 't31', 't41', 't51', 't61', 't71', 't81', 't91', 't101', 't111', 't121', 'input', 'admin', 'admin', '2023-05-02 08:19:42'),
(30, NULL, '2023-03-08 15:44:55', 'Bumitama2023001', 'end result 2', '3', 90000, '2023-03-08', '2023-03-09', '1', '10', 1, 't11', 't21', 't31', 't41', 't51', 't61', 't71', 't81', 't91', 't1011', 't111', 't121', 'input', 'admin', 'admin', '2023-04-18 15:13:17'),
(31, NULL, '2023-03-08 15:54:09', 'Bumitama2023008', 'Mill Digitalisasi ', '10', 600000, '2023-03-09', '2023-03-10', '1', '10', 1, 't1', 't2', 't3', 't4', 't5', 't6', 't7', 't8', 't9', 't10', 't11', 't12', 'input', 'admin', 'admin', '2023-04-18 08:35:47'),
(35, 923993, '2023-04-13 10:14:21', 'Bumitama2023008', 'Traction Digitalisasi, Automation and Mechanization', '1', 1, '2023-04-13', '2023-04-22', '9', '10', 1, 't1', 't2', 't3', 't4', 't5', 't6', 't7', 't8', 't9', 't10', 't11', 't12', 'input', 'admin', 'admin', '2023-05-02 13:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `db_target_intermediate`
--

CREATE TABLE `db_target_intermediate` (
  `kode_intermediate` int(11) NOT NULL,
  `kode_endresult` int(11) DEFAULT NULL,
  `no_transaksi` int(20) DEFAULT NULL,
  `tanggal_create` varchar(20) NOT NULL,
  `kode_fgd` varchar(20) DEFAULT NULL,
  `intermediate` varchar(100) NOT NULL,
  `uom` varchar(10) NOT NULL,
  `estimate_cost` int(20) NOT NULL,
  `start` varchar(20) NOT NULL,
  `end` varchar(20) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `asis` varchar(10) NOT NULL,
  `tube` int(5) NOT NULL,
  `target_jan` varchar(10) DEFAULT NULL,
  `target_feb` varchar(10) DEFAULT NULL,
  `target_mar` varchar(10) DEFAULT NULL,
  `target_apr` varchar(10) DEFAULT NULL,
  `target_mei` varchar(10) DEFAULT NULL,
  `target_jun` varchar(10) DEFAULT NULL,
  `target_jul` varchar(10) DEFAULT NULL,
  `target_aug` varchar(10) DEFAULT NULL,
  `target_sep` varchar(10) DEFAULT NULL,
  `target_okt` varchar(10) DEFAULT NULL,
  `target_nov` varchar(10) DEFAULT NULL,
  `target_des` varchar(10) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `user_create` varchar(20) DEFAULT NULL,
  `user_modified` varchar(20) DEFAULT NULL,
  `tanggal_modified` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_target_intermediate`
--

INSERT INTO `db_target_intermediate` (`kode_intermediate`, `kode_endresult`, `no_transaksi`, `tanggal_create`, `kode_fgd`, `intermediate`, `uom`, `estimate_cost`, `start`, `end`, `duration`, `asis`, `tube`, `target_jan`, `target_feb`, `target_mar`, `target_apr`, `target_mei`, `target_jun`, `target_jul`, `target_aug`, `target_sep`, `target_okt`, `target_nov`, `target_des`, `status`, `user_create`, `user_modified`, `tanggal_modified`) VALUES
(1, 29, 0, '2023-03-07', 'Bumitama2023001', 'intermediate 1', '1', 900000, '2023-03-07', '2023-03-08', '1', '10', 1, 't11', 't21', 't31', 't41', 't51', 't61', 't71', 't81', 't91', 't101', 't111', 't121', 'input', '2023-03-07 13:55:03', 'admin', '2023-05-02 08:37:39'),
(2, 0, 0, '2023-03-08', 'Bumitama2023002', 'Intermediate 2', '5', 0, '2023-03-07', '2023-03-08', '1', '10', 1, 't1', 't2', 't3', 't4', 't5', 't6', 't7', 't8', 't9', 't10', 't11', 't12', 'input', '2023-03-07 13:55:03', 'admin', '2023-04-18 13:20:18'),
(3, 30, 0, '2023-03-09 11:42:12', 'Bumitama2023001', 'intermediate 3', '3', 100000, '2023-03-09', '2023-03-10', '1', '10', 1, 't1', 't2', 't3', 't4', 't5', 't6', 't7', 't8', 't9', 't10', 't11', 't12', 'input', 'admin', 'admin', '2023-04-18 13:23:15'),
(4, 0, 0, '2023-03-09 11:43:53', 'Bumitama2023002', 'intermediate 4', '5', 90000000, '2023-03-10', '2023-03-11', '1', '10', 2, '1', 't21', 't31', 't41', 't51', 't61', 't71', 't81', 't91', 't101', 't111', 't121', 'input', 'admin', 'admin', '2023-04-18 13:20:25'),
(5, 0, 478914, '2023-03-28 14:10:41', 'Bumitama2023002', 'intermediate 5', '6', 0, '2023-03-28', '2023-03-29', '1', '10', 1, 't1', 't2', 't3', 't4', 't5', 't6', 't7', 't8', 't9', 't10', 't11', 't12', 'input', 'admin', NULL, NULL),
(7, 30, 585932, '2023-04-12 10:27:52', 'Bumitama2023001', 'intermediate 6', '1', 9600000, '2023-04-19', '2023-04-21', '2', '10', 1, 't1', 't2', 't3', 't4', 't5', 't6', 't7', 't8', 't9', 't10', 't11', 't12', 'input', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `db_user`
--

CREATE TABLE `db_user` (
  `userid` int(6) UNSIGNED NOT NULL,
  `tanggal_create` varchar(50) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `departement` varchar(30) DEFAULT NULL,
  `jabatan` varchar(30) DEFAULT NULL,
  `otoritas` varchar(30) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `user_modified` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `db_user`
--

INSERT INTO `db_user` (`userid`, `tanggal_create`, `username`, `password`, `departement`, `jabatan`, `otoritas`, `status`, `email`, `user_create`, `user_modified`) VALUES
(6, '2023-03-15 10:45:46', 'admin', '123', 'IT', 'Intern1', 'otoritas1', 'status', 'erikjulios96@gmail.com', 'admin', 'admin'),
(7, '2023-03-15 11:28:48', 'erik2', '123', 'ITGD', 'Intern', 'otoritas1', 'status1', 'erikjulios96@gmail.com', 'admin', NULL),
(8, '2023-03-15 11:28:50', 'erik1', '', 'ITGD', 'Intern', 'otoritas1', 'status1', 'erikjulios96@gmail.com', 'admin', NULL),
(9, '2023-03-15 11:28:51', 'erik3', '', 'ITGD', 'Intern', 'otoritas1', 'status1', 'erikjulios96@gmail.com', 'admin', NULL),
(10, '2023-03-15 11:28:51', 'erik4', '', 'ITGD', 'Intern', 'otoritas1', 'status1', 'erikjulios96@gmail.com', 'admin', NULL),
(11, '2023-03-15 11:28:51', 'erik5', '', 'ITGD', 'Intern', 'otoritas1', 'status1', 'erikjulios96@gmail.com', 'admin', NULL),
(12, '2023-03-15 11:28:52', 'erik6', '', 'ITGD', 'Intern', 'otoritas1', 'status1', 'erikjulios96@gmail.com', 'admin', NULL),
(13, '2023-03-15 11:28:52', 'erik7', '', 'ITGD', 'Intern', 'otoritas1', 'status1', 'erikjulios96@gmail.com', 'admin', NULL),
(14, '2023-03-15 11:29:34', 'erik', '', 'ITGD', 'Intern', 'otoritas1', 'status1', 'erikjulios96@gmail.com', 'admin', NULL),
(15, '2023-03-17 14:57:04', 'erik', '', 'ITGD', 'Intern', 'otoritas1', 'status1', 'erikjulios96@gmail.com', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
  `id` int(11) NOT NULL,
  `nama` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`id`, `nama`) VALUES
(1, 'kg'),
(2, 'ton'),
(3, 'm'),
(4, '%'),
(5, 'status'),
(6, 'km'),
(7, 'ltr'),
(8, 'case'),
(9, 'qty'),
(10, 'org');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_fgd`
--
ALTER TABLE `db_fgd`
  ADD PRIMARY KEY (`kode_fgd`);

--
-- Indexes for table `db_target_activity`
--
ALTER TABLE `db_target_activity`
  ADD PRIMARY KEY (`kode_activity`);

--
-- Indexes for table `db_target_end_result`
--
ALTER TABLE `db_target_end_result`
  ADD PRIMARY KEY (`kode_endresult`);

--
-- Indexes for table `db_target_intermediate`
--
ALTER TABLE `db_target_intermediate`
  ADD PRIMARY KEY (`kode_intermediate`);

--
-- Indexes for table `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `uom`
--
ALTER TABLE `uom`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_target_activity`
--
ALTER TABLE `db_target_activity`
  MODIFY `kode_activity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `db_target_end_result`
--
ALTER TABLE `db_target_end_result`
  MODIFY `kode_endresult` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `db_target_intermediate`
--
ALTER TABLE `db_target_intermediate`
  MODIFY `kode_intermediate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `db_user`
--
ALTER TABLE `db_user`
  MODIFY `userid` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `uom`
--
ALTER TABLE `uom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
