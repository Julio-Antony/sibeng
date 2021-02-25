-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Feb 2021 pada 12.35
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(10) NOT NULL,
  `discount_item` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
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

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `gender`, `phone`, `address`, `created`, `updated`) VALUES
(1, 'Dahlia', 'Perempuan', '085632549651', 'Cikarang,Bekasi', '2021-01-31 09:17:02', NULL),
(2, 'Yudi', 'Laki-laki', '081325462579', 'Cibitung,Bekasi', '2021-01-31 09:17:51', '2021-01-31 03:18:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_category`
--

CREATE TABLE `product_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_name`, `created`, `updated`) VALUES
(72, 'Makanan', '2021-02-01 18:21:41', '2021-02-17 17:18:23'),
(73, 'Minuman', '2021-02-01 18:21:47', NULL),
(74, 'Cemilan', '2021-02-01 18:21:52', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_item`
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
-- Dumping data untuk tabel `product_item`
--

INSERT INTO `product_item` (`item_id`, `image`, `barcode`, `item_name`, `category_id`, `unit_id`, `price`, `stock`, `created`, `updated`) VALUES
(31, 'item-210215-271482db3b.jpg', 'S1001', 'Gurame Bakar 2', 72, 7, 70000, 21, '2021-02-15 12:14:45', '2021-02-20 12:24:08'),
(32, 'item-210215-dad9545154.jpg', 'S1002', 'Gurame Goreng Kering', 72, 8, 72000, 20, '2021-02-15 12:15:43', NULL),
(33, 'item-210215-58e0ca21c2.jpg', 'S1003', 'Gurame Goreng Tepung', 73, 8, 72000, 25, '2021-02-15 12:17:30', NULL),
(34, 'item-210215-602cdacbe0.jpg', 'S1004', 'Gurame Rebus', 72, 8, 71000, 25, '2021-02-15 12:20:11', NULL),
(35, 'item-210215-60cfd0313d.jpg', 'S1005', 'Gurame Saos Padang', 72, 8, 75000, 25, '2021-02-15 12:21:18', NULL),
(36, 'item-210215-5b3af8a9c7.jpg', 'S1006', 'Gurame Saos Asam Manis', 72, 8, 75000, 21, '2021-02-15 12:22:42', NULL),
(37, 'item-210215-bea5fc3c1d.jpg', 'S1007', 'Gurame Saos Tiram', 72, 8, 74000, 25, '2021-02-15 12:23:56', NULL),
(38, 'item-210215-471d1ca9f7.jpg', 'S1008', 'Gurame Saos Lada Hitam', 72, 8, 76000, 25, '2021-02-15 12:27:09', NULL),
(39, 'item-210215-539d5007eb.jpg', 'S1009', 'Gurame Mentega', 72, 8, 72000, 15, '2021-02-15 12:27:55', NULL),
(40, 'item-210215-5dd094d3fc.jpg', 'S2001', 'Bawal Bakar', 72, 8, 71000, 25, '2021-02-15 12:40:18', NULL),
(41, 'item-210215-d926e09ddb.jpg', 'S2002', 'Bawal Goreng Kering', 72, 8, 73000, 25, '2021-02-15 12:41:13', NULL),
(42, 'item-210215-6ee056bc03.jpg', 'S2003', 'Bawal Goreng Tepung', 72, 8, 72000, 25, '2021-02-15 12:41:55', NULL),
(43, 'item-210215-65a569b314.jpg', 'S2004', 'Bawal Rebus', 72, 8, 70000, 25, '2021-02-15 12:42:26', NULL),
(44, 'item-210215-2bfd30b4e9.jpg', 'S2005', 'Bawal Saos Padang', 72, 8, 75000, 18, '2021-02-15 12:43:10', NULL),
(45, 'item-210215-2e9ca42c12.jpg', 'S2006', 'Bawal Saos Asam Manis', 72, 8, 75000, 19, '2021-02-15 12:43:42', NULL),
(46, 'item-210215-5f49d0e317.jpg', 'S2007', 'Bawal Saos Tiram', 72, 8, 74000, 25, '2021-02-15 12:44:34', NULL),
(47, 'item-210215-ef8f525a54.jpg', 'S2008', 'Bawal Saos Lada Hitam', 72, 8, 76000, 25, '2021-02-15 12:45:32', NULL),
(48, 'item-210215-947c4301d5.jpg', 'S2009', 'Bawal Mentega', 72, 8, 77000, 25, '2021-02-15 12:46:10', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_unit`
--

CREATE TABLE `product_unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product_unit`
--

INSERT INTO `product_unit` (`unit_id`, `unit_name`, `created`, `updated`) VALUES
(7, 'Buah', '2021-02-01 18:22:21', NULL),
(8, 'Porsi', '2021-02-01 18:22:33', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
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
-- Dumping data untuk tabel `sales`
--

INSERT INTO `sales` (`sales_id`, `invoice`, `customer_id`, `total_price`, `discount`, `final_price`, `cash`, `remaining`, `note`, `date`, `user_id`, `created`) VALUES
(11, 'MP2102170001', NULL, 70000, 0, 70000, 100000, 30000, '', '2021-02-17', 1, '2021-02-17 12:48:04'),
(12, 'MP2102170002', NULL, 140000, 0, 140000, 150000, 10000, '', '2021-02-17', 1, '2021-02-17 13:01:26'),
(13, 'MP2102170003', NULL, 70000, 0, 70000, 100000, 30000, '', '2021-02-17', 1, '2021-02-17 13:08:01'),
(14, 'MP2102170004', NULL, 70000, 0, 70000, 100000, 30000, '', '2021-02-17', 1, '2021-02-17 13:23:18'),
(15, 'MP2102170005', NULL, 72000, 0, 72000, 80000, 8000, '', '2021-02-17', 1, '2021-02-17 13:24:00'),
(16, 'MP2102170006', 2, 288000, 0, 288000, 300000, 12000, '', '2021-02-17', 1, '2021-02-17 13:28:47'),
(17, 'MP2102190001', NULL, 1020000, 0, 1020000, 1100000, 80000, '', '2021-02-19', 1, '2021-02-19 19:28:06'),
(18, 'MP2102190002', NULL, 975000, 0, 975000, 1000000, 25000, '', '2021-02-19', 1, '2021-02-19 21:10:18');

--
-- Trigger `sales`
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
-- Struktur dari tabel `sales_detail`
--

CREATE TABLE `sales_detail` (
  `detail_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(10) NOT NULL,
  `discount_item` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sales_detail`
--

INSERT INTO `sales_detail` (`detail_id`, `sales_id`, `item_id`, `price`, `qty`, `discount_item`, `total`) VALUES
(12, 9, 32, 72000, 1, 0, 72000),
(13, 9, 37, 74000, 1, 0, 74000),
(16, 11, 31, 70000, 1, 0, 70000),
(17, 12, 31, 70000, 2, 0, 140000),
(18, 14, 31, 70000, 1, 0, 70000),
(19, 15, 32, 72000, 1, 0, 72000),
(20, 16, 32, 72000, 4, 0, 288000),
(21, 17, 39, 72000, 10, 0, 720000),
(22, 17, 36, 75000, 4, 0, 300000),
(23, 18, 45, 75000, 6, 0, 450000),
(24, 18, 44, 75000, 7, 0, 525000);

--
-- Trigger `sales_detail`
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
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `detail` varchar(200) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `qty` int(10) NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`stock_id`, `item_id`, `type`, `detail`, `supplier_id`, `qty`, `date`, `created`, `user_id`) VALUES
(22, 31, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:48:50', 1),
(23, 32, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:49:02', 1),
(24, 33, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:49:15', 1),
(25, 34, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:49:53', 1),
(26, 35, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:50:03', 1),
(27, 36, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:50:18', 1),
(28, 37, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:50:30', 1),
(29, 38, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:50:42', 1),
(30, 39, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:50:54', 1),
(31, 40, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:51:07', 1),
(32, 41, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:51:20', 1),
(33, 42, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:51:35', 1),
(34, 43, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:51:46', 1),
(35, 44, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:52:03', 1),
(36, 45, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:52:13', 1),
(37, 46, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:52:24', 1),
(38, 47, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:52:35', 1),
(39, 48, 'in', 'Input Awal', 8, 25, '2021-02-15', '2021-02-15 12:52:46', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `description` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `phone`, `address`, `description`, `created`, `updated`) VALUES
(8, 'Toko A', '081324697851', 'Klari, Karawang', 'Supplier Bera', '2021-02-10 20:34:31', '2021-02-20 11:56:22'),
(9, 'Toko B', '085612453127', 'Tambun, Bekasi', 'Supplier Daging', '2021-02-10 20:35:11', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `username` varchar(128) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `level` int(1) NOT NULL,
  `joined` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `image`, `username`, `address`, `level`, `joined`) VALUES
(1, 'admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'avatar.jpg', 'Admin', 'Jakarta', 1, '2021-02-19'),
(2, 'kasir@gmail.com', '8691e4fc53b99da544ce86e22acba62d13352eff', 'avatar04.png', 'Kasir', 'Jakarta', 2, '2021-02-19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user` (`user_id`),
  ADD KEY `item` (`item_id`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indeks untuk tabel `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `product_item`
--
ALTER TABLE `product_item`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD KEY `item_category` (`category_id`),
  ADD KEY `item_unit` (`unit_id`);

--
-- Indeks untuk tabel `product_unit`
--
ALTER TABLE `product_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indeks untuk tabel `sales_detail`
--
ALTER TABLE `sales_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `stock_user` (`user_id`),
  ADD KEY `stock_item` (`item_id`),
  ADD KEY `stock_supplier` (`supplier_id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT untuk tabel `product_item`
--
ALTER TABLE `product_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `product_unit`
--
ALTER TABLE `product_unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `sales_detail`
--
ALTER TABLE `sales_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `item` FOREIGN KEY (`item_id`) REFERENCES `product_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product_item`
--
ALTER TABLE `product_item`
  ADD CONSTRAINT `item_category` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`category_id`),
  ADD CONSTRAINT `item_unit` FOREIGN KEY (`unit_id`) REFERENCES `product_unit` (`unit_id`);

--
-- Ketidakleluasaan untuk tabel `sales_detail`
--
ALTER TABLE `sales_detail`
  ADD CONSTRAINT `sales_detail_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `product_item` (`item_id`);

--
-- Ketidakleluasaan untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_item` FOREIGN KEY (`item_id`) REFERENCES `product_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stock_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `stock_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
