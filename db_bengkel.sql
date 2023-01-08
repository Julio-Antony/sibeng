-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2023 at 01:52 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bengkel`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `qty` int(10) NOT NULL,
  `discount_item` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `item_id`, `service_id`, `price`, `qty`, `discount_item`, `total`, `user_id`) VALUES
(1, 4, NULL, 36500, 1, 0, 36500, 12);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_name`, `created`, `updated`) VALUES
(72, 'Makanan', '2021-02-01 18:21:41', '2021-02-17 17:18:23'),
(73, 'Minuman', '2021-02-01 18:21:47', NULL),
(74, 'Cemilan', '2021-02-01 18:21:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_item`
--

CREATE TABLE `product_item` (
  `item_id` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `stock` int(10) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_item`
--

INSERT INTO `product_item` (`item_id`, `image`, `barcode`, `item_name`, `category_id`, `unit_id`, `price`, `stock`, `created`, `updated`) VALUES
(31, 'item-221218-051b932506.png', 'S1001', 'Gurame Bakar', 72, 7, 70000, 25, '2021-02-15 12:14:45', '2022-12-18 08:09:28'),
(32, 'item-210215-dad9545154.jpg', 'S1002', 'Gurame Goreng Kering', 72, 8, 72000, 26, '2021-02-15 12:15:43', NULL),
(33, 'item-210215-58e0ca21c2.jpg', 'S1003', 'Gurame Goreng Tepung', 73, 8, 72000, 25, '2021-02-15 12:17:30', NULL),
(34, 'item-210215-602cdacbe0.jpg', 'S1004', 'Gurame Rebus', 72, 8, 71000, 25, '2021-02-15 12:20:11', NULL),
(35, 'item-210215-60cfd0313d.jpg', 'S1005', 'Gurame Saos Padang', 72, 8, 75000, 25, '2021-02-15 12:21:18', NULL),
(36, 'item-210215-5b3af8a9c7.jpg', 'S1006', 'Gurame Saos Asam Manis', 72, 8, 75000, 25, '2021-02-15 12:22:42', NULL),
(37, 'item-210215-bea5fc3c1d.jpg', 'S1007', 'Gurame Saos Tiram', 72, 8, 74000, 26, '2021-02-15 12:23:56', NULL),
(38, 'item-210215-471d1ca9f7.jpg', 'S1008', 'Gurame Saos Lada Hitam', 72, 8, 76000, 0, '2021-02-15 12:27:09', NULL),
(39, 'item-210215-539d5007eb.jpg', 'S1009', 'Gurame Mentega', 72, 8, 72000, 0, '2021-02-15 12:27:55', NULL),
(40, 'item-210215-5dd094d3fc.jpg', 'S2001', 'Bawal Bakar', 72, 8, 71000, 0, '2021-02-15 12:40:18', NULL),
(41, 'item-210215-d926e09ddb.jpg', 'S2002', 'Bawal Goreng Kering', 72, 8, 73000, 0, '2021-02-15 12:41:13', NULL),
(42, 'item-210215-6ee056bc03.jpg', 'S2003', 'Bawal Goreng Tepung', 72, 8, 72000, 0, '2021-02-15 12:41:55', NULL),
(43, 'item-210215-65a569b314.jpg', 'S2004', 'Bawal Rebus', 72, 8, 70000, 0, '2021-02-15 12:42:26', NULL),
(44, 'item-210215-2bfd30b4e9.jpg', 'S2005', 'Bawal Saos Padang', 72, 8, 75000, 0, '2021-02-15 12:43:10', NULL),
(45, 'item-210215-2e9ca42c12.jpg', 'S2006', 'Bawal Saos Asam Manis', 72, 8, 75000, 0, '2021-02-15 12:43:42', NULL),
(46, 'item-210215-5f49d0e317.jpg', 'S2007', 'Bawal Saos Tiram', 72, 8, 74000, 0, '2021-02-15 12:44:34', NULL),
(47, 'item-210215-ef8f525a54.jpg', 'S2008', 'Bawal Saos Lada Hitam', 72, 8, 76000, 0, '2021-02-15 12:45:32', NULL),
(48, 'item-210215-947c4301d5.jpg', 'S2009', 'Bawal Mentega', 72, 8, 77000, 0, '2021-02-15 12:46:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_unit`
--

CREATE TABLE `product_unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_unit`
--

INSERT INTO `product_unit` (`unit_id`, `unit_name`, `created`, `updated`) VALUES
(7, 'Buah', '2021-02-01 18:22:21', NULL),
(8, 'Porsi', '2021-02-01 18:22:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `total_price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `final_price` int(11) NOT NULL,
  `cash` int(11) NOT NULL,
  `remaining` int(11) NOT NULL,
  `note` text NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `invoice`, `total_price`, `discount`, `final_price`, `cash`, `remaining`, `note`, `date`, `user_id`, `created`) VALUES
(11, 'MP2102170001', 70000, 0, 70000, 100000, 30000, '', '2021-02-17', 1, '2021-02-17 12:48:04'),
(12, 'MP2102170002', 140000, 0, 140000, 150000, 10000, '', '2021-02-17', 1, '2021-02-17 13:01:26'),
(13, 'MP2102170003', 70000, 0, 70000, 100000, 30000, '', '2021-02-17', 1, '2021-02-17 13:08:01'),
(14, 'MP2102170004', 70000, 0, 70000, 100000, 30000, '', '2021-02-17', 1, '2021-02-17 13:23:18'),
(15, 'MP2102170005', 72000, 0, 72000, 80000, 8000, '', '2021-02-17', 1, '2021-02-17 13:24:00'),
(16, 'MP2102170006', 288000, 0, 288000, 300000, 12000, '', '2021-02-17', 1, '2021-02-17 13:28:47'),
(17, 'MP2102190001', 1020000, 0, 1020000, 1100000, 80000, '', '2021-02-19', 1, '2021-02-19 19:28:06'),
(18, 'MP2102190002', 975000, 0, 975000, 1000000, 25000, '', '2021-02-19', 1, '2021-02-19 21:10:18'),
(19, 'MP2107170001', 519000, 0, 519000, 550000, 31000, '', '2021-07-17', 9, '2021-07-17 15:05:43'),
(20, 'MP2107180001', 357000, 0, 357000, 400000, 43000, '', '2021-07-18', 2, '2021-07-18 16:47:15'),
(21, 'MP2301080001', 0, 0, 36500, 100000, 63500, '', '2023-01-08', 12, '2023-01-08 06:38:20'),
(22, 'MP2301080002', 0, 0, 36500, 100000, 63500, '', '2023-01-08', 12, '2023-01-08 06:40:54');

--
-- Triggers `sales`
--
DELIMITER $$
CREATE TRIGGER `delete_detail` BEFORE DELETE ON `sales` FOR EACH ROW BEGIN
	DELETE FROM sales_detail
    WHERE sales_id = OLD.sales_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_detail`
--

CREATE TABLE `sales_detail` (
  `detail_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `sparepart_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(10) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `sales_detail`
--
DELIMITER $$
CREATE TRIGGER `stock_min` AFTER INSERT ON `sales_detail` FOR EACH ROW BEGIN
	UPDATE product_item SET stock = stock - NEW.qty
    WHERE item_id = NEW.item_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stock_return` AFTER DELETE ON `sales_detail` FOR EACH ROW BEGIN
	UPDATE product_item SET stock = stock + OLD.qty
    WHERE item_id = OLD.item_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_name`, `price`, `created`, `updated`) VALUES
(2, 'Service Ringan All Matics', 70000, '2022-12-26 06:39:42', '2022-12-26 00:43:42'),
(3, 'Service Ringan All Cub', 70000, '2022-12-26 06:48:41', NULL),
(4, 'Service Ringan Honda Mega Pro/Verza', 87000, '2022-12-26 06:49:17', NULL),
(5, 'Service Rigan Honda CB150R', 91000, '2022-12-26 06:49:37', NULL),
(6, 'Service Ringan Honda Tiger', 91000, '2022-12-26 06:50:03', NULL),
(7, 'Service Ringan Honda Sonic', 87500, '2022-12-26 06:50:29', NULL),
(8, 'Service Ringan Honda Supra GTR', 87500, '2022-12-26 06:51:21', NULL),
(9, 'Service Ringan Honda CBR150', 150000, '2022-12-26 06:51:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sparepart`
--

CREATE TABLE `sparepart` (
  `sparepart_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `part_number` varchar(100) NOT NULL,
  `sparepart_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(10) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sparepart`
--

INSERT INTO `sparepart` (`sparepart_id`, `image`, `part_number`, `sparepart_name`, `price`, `stock`, `created`, `updated`) VALUES
(4, 'item-221225-1f8093df57.png', 'B0001S', 'Kampas Rem Honda / Kampas Rem Set Depan Belakang Beat Vario Scoopy', 36500, 60, '2022-12-26', 0),
(5, 'item-221225-b3724cc6c4.png', 'B01526C', 'Busi Motor BRISK Copper AR12C', 50000, 0, '2022-12-26', 0),
(6, 'item-221225-f5d001a9af.png', 'B4561D', 'XTRA BATTERY GTZ5S MF GEL ACID - AKI MOTOR KERING / MAINTAINANCE FREE', 119000, 0, '2022-12-26', 0),
(7, 'item-221225-7e8de8b1b6.png', 'B4561F', 'Van Belt (Belt Drive Kit) - BeAT eSP K81 23100K44BA0', 143700, 0, '2022-12-26', 0),
(8, 'item-221225-856b1709ff.png', 'B1289S', 'Shock Breaker Belakang Honda Beat ESP', 287500, 0, '2022-12-26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `detail` text NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `qty` int(10) NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `item_id`, `type`, `detail`, `supplier_id`, `qty`, `date`, `created`, `user_id`) VALUES
(22, 31, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:48:50', 1),
(23, 32, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:49:02', 1),
(24, 33, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:49:15', 1),
(25, 34, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:49:53', 1),
(26, 35, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:50:03', 1),
(27, 36, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:50:18', 1),
(28, 37, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:50:30', 1),
(41, 4, 'in', 'Re-stock', 12, 60, '2022-12-26', '2022-12-26 07:17:28', 12);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `phone` int(15) NOT NULL,
  `address` text NOT NULL,
  `description` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `phone`, `address`, `description`, `created`, `updated`) VALUES
(12, 'PT. CNC', 2147483647, 'Cikarang Baru', 'Supplier Rangka', '2022-12-25 23:22:13', '2022-12-26 00:30:00'),
(13, 'PT. Kayaba', 2147483647, 'Cikarang', 'Supplier Shock Breaker', '2022-12-25 23:23:01', NULL),
(14, 'PT. Enkei', 2147483647, 'Cikarang', 'Supplier Velg', '2022-12-25 23:24:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `level` int(1) NOT NULL,
  `joined` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `image`, `username`, `address`, `level`, `joined`) VALUES
(1, 'damai@gmail.com', '5160754372bf17e8dcff4771d5775d56', 'avatar.png', 'Damai Bela Refo', 'Cijingga, Cikarang Selatan', 1, '2022-12-01'),
(12, 'kasir@gmail.com', 'de28f8f7998f23ab4194b51a6029416f', 'avatar.png', 'Kasir', 'Bekasi', 2, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user` (`user_id`),
  ADD KEY `sparepart` (`item_id`),
  ADD KEY `service` (`service_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `product_item`
--
ALTER TABLE `product_item`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD KEY `item_category` (`category_id`),
  ADD KEY `item_unit` (`unit_id`);

--
-- Indexes for table `product_unit`
--
ALTER TABLE `product_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `sales_detail`
--
ALTER TABLE `sales_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `item_id` (`sparepart_id`),
  ADD KEY `sales_services` (`service_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `sparepart`
--
ALTER TABLE `sparepart`
  ADD PRIMARY KEY (`sparepart_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `stock_user` (`user_id`),
  ADD KEY `stock_item` (`item_id`),
  ADD KEY `stock_supplier` (`supplier_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `product_item`
--
ALTER TABLE `product_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `product_unit`
--
ALTER TABLE `product_unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sales_detail`
--
ALTER TABLE `sales_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sparepart`
--
ALTER TABLE `sparepart`
  MODIFY `sparepart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `service` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`),
  ADD CONSTRAINT `sparepart` FOREIGN KEY (`item_id`) REFERENCES `sparepart` (`sparepart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_item`
--
ALTER TABLE `product_item`
  ADD CONSTRAINT `item_category` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`category_id`),
  ADD CONSTRAINT `item_unit` FOREIGN KEY (`unit_id`) REFERENCES `product_unit` (`unit_id`);

--
-- Constraints for table `sales_detail`
--
ALTER TABLE `sales_detail`
  ADD CONSTRAINT `sales_services` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`),
  ADD CONSTRAINT `sales_sparepart` FOREIGN KEY (`sparepart_id`) REFERENCES `sparepart` (`sparepart_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
