-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2022 at 02:01 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
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
-- Table structure for table `td_stn_pbsb_dtls`
--

CREATE TABLE `td_stn_pbsb_dtls` (
  `id` int(10) NOT NULL,
  `trans_dt` date DEFAULT NULL,
  `project_cd` int(10) NOT NULL,
  `vendor_id` int(5) NOT NULL,
  `c_order_no` varchar(60) NOT NULL,
  `s_bill_no` varchar(100) DEFAULT NULL,
  `s_bill_dt` date DEFAULT NULL,
  `s_taxable_value` decimal(10,2) DEFAULT NULL,
  `gst_rate` decimal(5,2) DEFAULT NULL,
  `s_cgst` decimal(10,2) DEFAULT NULL,
  `s_sgst` decimal(10,2) DEFAULT NULL,
  `s_bill_amt` int(25) DEFAULT NULL,
  `p_bill_no` varchar(100) DEFAULT NULL,
  `p_bill_dt` date DEFAULT NULL,
  `p_taxable_value` decimal(10,2) DEFAULT NULL,
  `p_cgst` decimal(10,2) DEFAULT NULL,
  `p_sgst` decimal(10,2) NOT NULL,
  `p_bill_amt` int(25) DEFAULT NULL,
  `bill_status` enum('0','1') NOT NULL DEFAULT '0',
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` date DEFAULT NULL,
  `modified_by` varchar(55) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `td_stn_pbsb_dtls`
--

INSERT INTO `td_stn_pbsb_dtls` (`id`, `trans_dt`, `project_cd`, `vendor_id`, `c_order_no`, `s_bill_no`, `s_bill_dt`, `s_taxable_value`, `gst_rate`, `s_cgst`, `s_sgst`, `s_bill_amt`, `p_bill_no`, `p_bill_dt`, `p_taxable_value`, `p_cgst`, `p_sgst`, `p_bill_amt`, `bill_status`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(2, '2022-05-30', 175, 1, 'err345', '23', '2022-05-30', '1200.00', '12.00', '72.00', '72.00', 1344, '2656', '2022-05-30', '1128.00', '68.00', '68.00', 1263, '1', 'Synergic Softek', '2022-05-30', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `td_stn_pbsb_dtls`
--
ALTER TABLE `td_stn_pbsb_dtls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `s_bill_no` (`s_bill_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `td_stn_pbsb_dtls`
--
ALTER TABLE `td_stn_pbsb_dtls`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
