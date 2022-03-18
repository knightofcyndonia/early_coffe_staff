-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2021 at 12:51 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pusrenpros`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rapat`
--

CREATE TABLE `tbl_rapat` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `jadwal_rapat` datetime DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rapat_attachment`
--

CREATE TABLE `tbl_rapat_attachment` (
  `id` int(11) NOT NULL,
  `id_rapat` int(11) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `file_display_name` varchar(100) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  `file_uploaded_at` datetime NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `level` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nama`, `username`, `email`, `password`, `phone`, `level`, `created_date`, `status`) VALUES
(7, 'admin', 'admin', 'admin@admin.com', '1', '081313131313', 'admin', '2021-07-02 08:29:32', 'ACTIVE'),
(8, 'Dwi Cahya Purnama Aji', 'aji', 'aji@gmail.com', '1', '0813', 'konsultan', '2021-07-02 03:34:04', 'ACTIVE'),
(9, 'Lakuntara', 'lakuntara', 'lakuntara@gmail.com', '1', '123123', 'pejabat', '2021-07-02 03:34:18', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_rapat`
--
ALTER TABLE `tbl_rapat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rapat_attachment`
--
ALTER TABLE `tbl_rapat_attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_rapat`
--
ALTER TABLE `tbl_rapat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_rapat_attachment`
--
ALTER TABLE `tbl_rapat_attachment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
