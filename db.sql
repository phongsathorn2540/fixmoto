-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2020 at 01:46 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fixmoto`
--

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE `buy` (
  `buy_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `buy_date` date DEFAULT NULL,
  `buy_status_id` int(11) NOT NULL,
  `recv_date` date DEFAULT NULL,
  `due_pay_date` date DEFAULT NULL,
  `pay_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`buy_id`, `supplier_id`, `buy_date`, `buy_status_id`, `recv_date`, `due_pay_date`, `pay_date`) VALUES
(16, 6, '2020-03-07', 2, '2020-03-31', '2020-03-08', '2020-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `buy_desc`
--

CREATE TABLE `buy_desc` (
  `buydesc_id` int(10) UNSIGNED NOT NULL,
  `part_id` int(10) UNSIGNED NOT NULL,
  `buy_id` int(10) UNSIGNED NOT NULL,
  `order_amount` varchar(4) DEFAULT NULL,
  `recv_amount` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buy_desc`
--

INSERT INTO `buy_desc` (`buydesc_id`, `part_id`, `buy_id`, `order_amount`, `recv_amount`) VALUES
(33, 4, 16, '5', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `buy_status`
--

CREATE TABLE `buy_status` (
  `buy_status_id` int(11) NOT NULL,
  `buy_status_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buy_status`
--

INSERT INTO `buy_status` (`buy_status_id`, `buy_status_desc`) VALUES
(1, 'รออนุมัติ'),
(2, 'อนุมัติแล้ว'),
(3, 'รับสินค้าแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) UNSIGNED NOT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `l_name` varchar(50) DEFAULT NULL,
  `mobile_num` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `f_name`, `l_name`, `mobile_num`) VALUES
(7, 'Phongsathorn', 'Phuttha', '0871457871');

-- --------------------------------------------------------

--
-- Table structure for table `fix_list`
--

CREATE TABLE `fix_list` (
  `fix_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `fix_detail` varchar(50) NOT NULL,
  `fix_status_id` int(11) NOT NULL,
  `plate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fix_list`
--

INSERT INTO `fix_list` (`fix_id`, `customer_id`, `date`, `brand`, `fix_detail`, `fix_status_id`, `plate`) VALUES
(9, 7, '2020-03-31', 'HONDA WAVE 100', 'เปลี่ยนไฟหน้า', 4, 'กมง695');

-- --------------------------------------------------------

--
-- Table structure for table `fix_status`
--

CREATE TABLE `fix_status` (
  `fix_status_id` int(11) NOT NULL,
  `fix_detail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fix_status`
--

INSERT INTO `fix_status` (`fix_status_id`, `fix_detail`) VALUES
(1, 'รับเรื่องซ่อม'),
(2, 'กำลังซ่อม'),
(3, 'รอชำระ'),
(4, 'ซ่อมเรียบร้อย');

-- --------------------------------------------------------

--
-- Table structure for table `fix_use`
--

CREATE TABLE `fix_use` (
  `fix_id` int(10) UNSIGNED NOT NULL,
  `part_number` varchar(50) NOT NULL,
  `fixuse_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fix_use`
--

INSERT INTO `fix_use` (`fix_id`, `part_number`, `fixuse_id`) VALUES
(9, 'LF001', 11),
(9, 'LF001', 12);

-- --------------------------------------------------------

--
-- Table structure for table `member_login`
--

CREATE TABLE `member_login` (
  `member_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member_login`
--

INSERT INTO `member_login` (`member_id`, `username`, `password`, `status`) VALUES
(1, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `part_list`
--

CREATE TABLE `part_list` (
  `part_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `part_desc` varchar(50) DEFAULT NULL,
  `part_cost` varchar(10) DEFAULT NULL,
  `part_price` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `part_list`
--

INSERT INTO `part_list` (`part_id`, `supplier_id`, `part_desc`, `part_cost`, `part_price`) VALUES
(4, 6, 'ไฟหน้า', '20', '50');

-- --------------------------------------------------------

--
-- Table structure for table `part_number`
--

CREATE TABLE `part_number` (
  `part_id` int(10) UNSIGNED NOT NULL,
  `part_number` varchar(50) NOT NULL,
  `part_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `part_number`
--

INSERT INTO `part_number` (`part_id`, `part_number`, `part_status`) VALUES
(4, 'LF001', 'used');

-- --------------------------------------------------------

--
-- Table structure for table `part_stock`
--

CREATE TABLE `part_stock` (
  `part_id` int(10) UNSIGNED NOT NULL,
  `part_total` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `part_stock`
--

INSERT INTO `part_stock` (`part_id`, `part_total`) VALUES
(4, '2');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `supplier_desc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_desc`) VALUES
(5, 'Phongsathorn'),
(6, 'Phongsathorn2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`buy_id`),
  ADD KEY `buy_FKIndex1` (`supplier_id`),
  ADD KEY `buy_status_id` (`buy_status_id`);

--
-- Indexes for table `buy_desc`
--
ALTER TABLE `buy_desc`
  ADD PRIMARY KEY (`buydesc_id`),
  ADD KEY `buy_desc_FKIndex1` (`buy_id`),
  ADD KEY `buy_desc_FKIndex2` (`part_id`);

--
-- Indexes for table `buy_status`
--
ALTER TABLE `buy_status`
  ADD PRIMARY KEY (`buy_status_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `fix_list`
--
ALTER TABLE `fix_list`
  ADD PRIMARY KEY (`fix_id`),
  ADD KEY `fix_list_FKIndex1` (`customer_id`),
  ADD KEY `fix_fk_2` (`fix_status_id`);

--
-- Indexes for table `fix_status`
--
ALTER TABLE `fix_status`
  ADD PRIMARY KEY (`fix_status_id`);

--
-- Indexes for table `fix_use`
--
ALTER TABLE `fix_use`
  ADD PRIMARY KEY (`fixuse_id`),
  ADD KEY `fix_use_FKIndex1` (`fix_id`),
  ADD KEY `fix_use_fk_2` (`part_number`);

--
-- Indexes for table `member_login`
--
ALTER TABLE `member_login`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `part_list`
--
ALTER TABLE `part_list`
  ADD PRIMARY KEY (`part_id`),
  ADD KEY `part_list_FKIndex1` (`supplier_id`);

--
-- Indexes for table `part_number`
--
ALTER TABLE `part_number`
  ADD PRIMARY KEY (`part_number`),
  ADD KEY `part_id` (`part_id`);

--
-- Indexes for table `part_stock`
--
ALTER TABLE `part_stock`
  ADD PRIMARY KEY (`part_id`),
  ADD KEY `part_stock_FKIndex1` (`part_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buy`
--
ALTER TABLE `buy`
  MODIFY `buy_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `buy_desc`
--
ALTER TABLE `buy_desc`
  MODIFY `buydesc_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `buy_status`
--
ALTER TABLE `buy_status`
  MODIFY `buy_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fix_list`
--
ALTER TABLE `fix_list`
  MODIFY `fix_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fix_status`
--
ALTER TABLE `fix_status`
  MODIFY `fix_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fix_use`
--
ALTER TABLE `fix_use`
  MODIFY `fixuse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `member_login`
--
ALTER TABLE `member_login`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `part_list`
--
ALTER TABLE `part_list`
  MODIFY `part_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `part_stock`
--
ALTER TABLE `part_stock`
  MODIFY `part_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buy`
--
ALTER TABLE `buy`
  ADD CONSTRAINT `buy_fk` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `buy_fk_2` FOREIGN KEY (`buy_status_id`) REFERENCES `buy_status` (`buy_status_id`);

--
-- Constraints for table `buy_desc`
--
ALTER TABLE `buy_desc`
  ADD CONSTRAINT `buy_desc_fk` FOREIGN KEY (`buy_id`) REFERENCES `buy` (`buy_id`),
  ADD CONSTRAINT `buy_desc_fk_2` FOREIGN KEY (`part_id`) REFERENCES `part_list` (`part_id`);

--
-- Constraints for table `fix_list`
--
ALTER TABLE `fix_list`
  ADD CONSTRAINT `fix_fk` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `fix_fk_2` FOREIGN KEY (`fix_status_id`) REFERENCES `fix_status` (`fix_status_id`);

--
-- Constraints for table `fix_use`
--
ALTER TABLE `fix_use`
  ADD CONSTRAINT `fix_use_fk` FOREIGN KEY (`fix_id`) REFERENCES `fix_list` (`fix_id`),
  ADD CONSTRAINT `fix_use_fk_2` FOREIGN KEY (`part_number`) REFERENCES `part_number` (`part_number`);

--
-- Constraints for table `part_list`
--
ALTER TABLE `part_list`
  ADD CONSTRAINT `part_list_fk` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`);

--
-- Constraints for table `part_number`
--
ALTER TABLE `part_number`
  ADD CONSTRAINT `part_number_fk` FOREIGN KEY (`part_id`) REFERENCES `part_list` (`part_id`);

--
-- Constraints for table `part_stock`
--
ALTER TABLE `part_stock`
  ADD CONSTRAINT `part_fk` FOREIGN KEY (`part_id`) REFERENCES `part_list` (`part_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
