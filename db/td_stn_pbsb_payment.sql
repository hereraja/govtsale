-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2022 at 02:24 PM
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
-- Table structure for table `td_stn_pbsb_payment`
--

CREATE TABLE `td_stn_pbsb_payment` (
  `id` int(11) NOT NULL,
  `trans_dt` date NOT NULL,
  `vendor_id` varchar(10) DEFAULT NULL,
  `sb_less_amt` decimal(10,2) NOT NULL,
  `pb_less_amt` decimal(10,2) NOT NULL,
  `s_bill_add_amt` decimal(10,2) NOT NULL DEFAULT 0.00,
  `p_bill_add_amt` decimal(10,2) NOT NULL,
  `s_bill_round_off` decimal(10,2) NOT NULL,
  `p_bill_round_off` decimal(10,2) NOT NULL,
  `s_bill_add_rnd_off` decimal(10,2) NOT NULL,
  `p_bill_add_rnd_off` decimal(10,2) NOT NULL,
  `less_gst` decimal(10,2) DEFAULT NULL,
  `confed_margin` decimal(10,2) DEFAULT NULL,
  `add_gst` decimal(10,2) DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `td_stn_pbsb_payment`
--
ALTER TABLE `td_stn_pbsb_payment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `td_stn_pbsb_payment`
--
ALTER TABLE `td_stn_pbsb_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
