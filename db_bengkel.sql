-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2023 at 05:09 PM
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
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(10) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `category` enum('sparepart','service') NOT NULL,
  `part_number` varchar(100) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(10) DEFAULT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `updated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `image`, `category`, `part_number`, `product_name`, `price`, `stock`, `created`, `updated`) VALUES
(4, 'item-221225-1f8093df57.png', 'sparepart', 'B0001S', 'Kampas Rem Honda / Kampas Rem Set Depan Belakang Beat Vario Scoopy', 36500, 56, '2022-12-26', '0000-00-00'),
(5, 'item-221225-b3724cc6c4.png', 'sparepart', 'B0156C', 'Busi Motor BRISK Copper AR12C', 50000, 44, '2022-12-26', '2023-01-21'),
(6, 'item-221225-f5d001a9af.png', 'sparepart', 'B4561D', 'XTRA BATTERY GTZ5S MF GEL ACID - AKI MOTOR KERING / MAINTAINANCE FREE', 119000, 0, '2022-12-26', '0000-00-00'),
(7, 'item-221225-7e8de8b1b6.png', 'sparepart', 'B4561F', 'Van Belt (Belt Drive Kit) - BeAT eSP K81 23100K44BA0', 143700, 0, '2022-12-26', '0000-00-00'),
(8, 'item-221225-856b1709ff.png', 'sparepart', 'B1289S', 'Shock Breaker Belakang Honda Beat ESP', 287500, 0, '2022-12-26', '0000-00-00'),
(10, NULL, 'service', NULL, 'Service Ringan All Matics', 70000, NULL, '2023-01-14', '0000-00-00');

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
(32, 'MP2301230002', 0, 0, 86500, 100000, 13500, '', '2023-01-23', 12, '2023-01-23 23:01:20');

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
  `price` int(11) NOT NULL,
  `qty` int(10) NOT NULL,
  `total` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_detail`
--

INSERT INTO `sales_detail` (`detail_id`, `sales_id`, `price`, `qty`, `total`, `product_id`) VALUES
(39, 32, 36500, 1, 36500, 4),
(40, 32, 50000, 1, 50000, 5);

--
-- Triggers `sales_detail`
--
DELIMITER $$
CREATE TRIGGER `stock_min` AFTER INSERT ON `sales_detail` FOR EACH ROW BEGIN
	UPDATE product SET stock = stock - NEW.qty
    WHERE product_id = NEW.product_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stock_return` AFTER DELETE ON `sales_detail` FOR EACH ROW BEGIN
	UPDATE product SET stock = stock + OLD.qty
    WHERE product_id = OLD.product_id;
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
(41, 4, 'in', 'Re-stock', 12, 60, '2022-12-26', '2022-12-26 07:17:28', 12),
(42, 0, 'in', 'Tambahan', 13, 15, '2023-01-21', '2023-01-21 22:32:16', 12),
(43, 0, 'in', 'tambahan', 13, 15, '2023-01-21', '2023-01-21 22:34:17', 12),
(45, 5, 'in', 'Re-stock', 13, 45, '2023-01-21', '2023-01-21 22:42:30', 12);

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
(12, 'kasir@gmail.com', 'de28f8f7998f23ab4194b51a6029416f', 'avatar.png', 'Kasir', 'Bekasi', 2, '0000-00-00'),
(13, 'julio@gmail.com', '62398fb63509f679f2128ea6a44a7f9a', 'avatar.png', 'Julio', 'Pengasinan', 1, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user` (`user_id`),
  ADD KEY `product` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

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
  ADD KEY `sales_product` (`product_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

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
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sales_detail`
--
ALTER TABLE `sales_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales_detail`
--
ALTER TABLE `sales_detail`
  ADD CONSTRAINT `sales_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
