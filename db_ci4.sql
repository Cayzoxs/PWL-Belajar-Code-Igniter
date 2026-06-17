-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2026 at 10:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-05-20-051812', 'App\\Database\\Migrations\\User', 'default', 'App', 1779254640, 1),
(2, '2026-05-20-051819', 'App\\Database\\Migrations\\Product', 'default', 'App', 1779254640, 1),
(3, '2026-05-20-051826', 'App\\Database\\Migrations\\Transaction', 'default', 'App', 1779254640, 1),
(4, '2026-05-20-052059', 'App\\Database\\Migrations\\TransactionDetail', 'default', 'App', 1779254640, 1),
(5, '2026-05-21-055200', 'App\\Database\\Migrations\\AddDeletedAtToTables', 'default', 'App', 1779343007, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int(5) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `nama`, `harga`, `jumlah`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ASUS TUF A15 FA506NF', 10899000, 5, 'asus_tuf_a15.jpg', '2026-05-20 05:29:41', NULL, NULL),
(2, 'Asus Vivobook 14 A1404ZA', 6899000, 7, 'asus_vivobook_14.jpg', '2026-05-20 05:29:41', NULL, NULL),
(3, 'Lenovo IdeaPad Slim 3-14IAU7', 6299000, 5, 'lenovo_idepad_slim_3.jpg', '2026-05-20 05:29:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `total_harga` double NOT NULL,
  `alamat` text NOT NULL,
  `ongkir` double DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `username`, `total_harga`, `alamat`, `ongkir`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'nilam.hakim', 10939000, 'Jalan Tirto Agung Barat 3', 40000, 0, '2026-06-17 08:21:06', '2026-06-17 08:21:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `transaction_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `jumlah` int(5) NOT NULL,
  `diskon` double DEFAULT NULL,
  `subtotal_harga` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`id`, `transaction_id`, `product_id`, `jumlah`, `diskon`, `subtotal_harga`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 0, 10899000, '2026-06-17 08:20:37', '2026-06-17 08:20:37', NULL),
(2, 2, 1, 1, 0, 10899000, '2026-06-17 08:21:06', '2026-06-17 08:21:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'nilam.hakim', 'nasab96@gmail.co.id', '$2y$10$nMqb5vEXvkxwBrgMsqXCoOrjg/l0hzet4msq2R8xEVO68GEvK98za', 'admin', '2026-05-20 05:33:01', NULL, NULL),
(2, 'indah.thamrin', 'najmudin.puji@yahoo.com', '$2y$10$eQIfTz3jNWqsD3bEFVFVfuJOrqZYhsEpXz6sJlekShA0mvF73qIeC', 'admin', '2026-05-20 05:33:01', NULL, NULL),
(3, 'ikhsan51', 'hafshah66@rahmawati.sch.id', '$2y$10$tJqIVG0QTSZITE4pyO3xguhwzADgQEcmoZAUCHzYM4/nXJLX00Leu', 'admin', '2026-05-20 05:33:01', NULL, NULL),
(4, 'nabila05', 'amalia.novitasari@gmail.com', '$2y$10$lKRC6F7mU0f2llNvoXryKeXmGiPyQFUowrPgWDSsSs7hAO2TtREMW', 'admin', '2026-05-20 05:33:01', NULL, NULL),
(5, 'hardiansyah.zelda', 'wprabowo@usamah.biz', '$2y$10$ZdmCHMqQ4rnK69fnYXRIhuTDhtIJr1CxwLNkdbfnGjcAMU4kYBBnC', 'guest', '2026-05-20 05:33:02', NULL, NULL),
(6, 'mardhiyah.tri', 'usman41@mayasari.id', '$2y$10$DOCSGXRScajvhFyvhcG73eapK.1cH3Gl/liWwZMwVIq2cpqyQetPC', 'admin', '2026-05-20 05:33:02', NULL, NULL),
(7, 'tsalahudin', 'hutapea.jumari@samosir.web.id', '$2y$10$yBfzSBeHRsj.opGFC3/sse73x/88xU/dZ1hgKBnORTv0a8WhjeAs2', 'admin', '2026-05-20 05:33:02', NULL, NULL),
(8, 'karna.salahudin', 'luluh.nurdiyanti@gmail.co.id', '$2y$10$GcxKD0ZJP.EWn5tpXnjdQO2hEmTaVu.7KUVpLdQFAyP.AxCfZPhM2', 'admin', '2026-05-20 05:33:02', NULL, NULL),
(9, 'hari.puspita', 'susanti.wani@yahoo.com', '$2y$10$2xL7mOlzLnUWFkyCqzboj.bQZvuiNBSyi8Fu24D7Y03GWQpJiC20e', 'admin', '2026-05-20 05:33:02', NULL, NULL),
(10, 'crahmawati', 'adriansyah.kiandra@gmail.co.id', '$2y$10$YxEiIRkUer849NEmav25B.X35zTFF5p/g0zpAw3O1SGu0qbAvxFvW', 'guest', '2026-05-20 05:33:02', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
