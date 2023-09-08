-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2022 at 06:43 PM
-- Server version: 5.7.38-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wbsmconf_confed`
--

-- --------------------------------------------------------

--
-- Table structure for table `td_stn_pbsb_mrdetail`
--

CREATE TABLE `td_stn_pbsb_mrdetail` (
  `sl_no` int(15) NOT NULL,
  `payment_key` int(10) NOT NULL,
  `trans_dt` date DEFAULT NULL,
  `mr_no` varchar(50) DEFAULT NULL,
  `mr_dt` date DEFAULT NULL,
  `bank` int(10) DEFAULT NULL,
  `trans_mode` varchar(15) DEFAULT NULL,
  `pay_dt` date DEFAULT NULL,
  `mr_amt` decimal(10,2) DEFAULT NULL,
  `amt` decimal(10,2) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` date DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_stn_pbsb_mrdetail`
--

INSERT INTO `td_stn_pbsb_mrdetail` (`sl_no`, `payment_key`, `trans_dt`, `mr_no`, `mr_dt`, `bank`, `trans_mode`, `pay_dt`, `mr_amt`, `amt`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(2, 2, '2022-06-01', '5610', '2022-06-01', 3, 'neft', '2022-06-01', '5610.00', '5610.00', 'Synergic Softek', '2022-06-01', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `td_stn_pbsb_mrdetail`
--
ALTER TABLE `td_stn_pbsb_mrdetail`
  ADD PRIMARY KEY (`sl_no`),
  ADD KEY `sl_no` (`sl_no`),
  ADD KEY `mr_no` (`mr_no`,`payment_key`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `td_stn_pbsb_mrdetail`
--
ALTER TABLE `td_stn_pbsb_mrdetail`
  MODIFY `sl_no` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
