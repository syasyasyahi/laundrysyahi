-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Des 2025 pada 09.25
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laundry_syahi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(2, 'Lee Kwang Soo', '+82 2-500-7336', '102 Daegongwongwangjang-ro, Gwacheon-si, Gyeonggi-do, South Korea', '2025-11-28 07:37:11', NULL),
(3, 'Yoo Jae Suk', '+82 2-2061-0006', '161 Mokdongseo-ro, Yangcheon District, Seoul, South Korea', '2025-11-28 07:37:46', NULL),
(4, 'Jeon So Min', '+81 11-622-5167', '471-110 Bankei, Chuo Ward, Sapporo, Hokkaido 064-0945, Japan', '2025-11-30 23:38:39', NULL),
(5, 'Ha Dong Hoon', '+82 2-500-7336', '161 Mokdongseo-ro, Yangcheon District, Seoul, South Korea', '2025-11-30 23:39:50', NULL),
(6, 'Kim Jong Kook', '+82 10-2523-599', '240 Noksapyeong-daero, Yongsan District, Seoul, South Korea', '2025-12-01 04:03:57', NULL),
(7, 'Jee Seok Jin', '+82 2-6177-1390', '10 Gukjegeumyung-ro, Yeongdeungpo District, Seoul, South Korea', '2025-12-01 04:16:18', NULL),
(9, 'Song Ji Hyo', '+82 2-2197-5000', ' 92 Mapo-daero, Mapo-gu, Seoul, South Korea', '2025-12-01 04:31:33', NULL),
(10, 'Yang Se Chan', '+82 2-500-7336', '102 Daegongwongwangjang-ro, Gwacheon-si, Gyeonggi-do, South Korea', '2025-12-01 04:32:52', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `level_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `levels`
--

INSERT INTO `levels` (`id`, `level_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2025-11-28 07:05:59', NULL),
(2, 'Operator', '2025-11-28 07:11:28', NULL),
(3, 'Pimpinan', '2025-12-01 04:19:38', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_menus`
--

CREATE TABLE `level_menus` (
  `id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `level_menus`
--

INSERT INTO `level_menus` (`id`, `level_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(30, 2, 19, '2025-12-01 00:10:25', NULL),
(31, 2, 16, '2025-12-01 00:10:25', NULL),
(32, 2, 14, '2025-12-01 00:10:25', NULL),
(33, 4, 20, '2025-12-01 04:19:43', NULL),
(34, 4, 14, '2025-12-01 04:19:43', NULL),
(35, 5, 19, '2025-12-01 04:20:27', NULL),
(36, 5, 18, '2025-12-01 04:20:27', NULL),
(37, 5, 17, '2025-12-01 04:20:27', NULL),
(38, 1, 21, '2025-12-01 04:23:51', NULL),
(39, 1, 19, '2025-12-01 04:23:51', NULL),
(40, 1, 18, '2025-12-01 04:23:51', NULL),
(41, 1, 17, '2025-12-01 04:23:51', NULL),
(42, 1, 16, '2025-12-01 04:23:51', NULL),
(43, 1, 15, '2025-12-01 04:23:51', NULL),
(44, 1, 14, '2025-12-01 04:23:51', NULL),
(45, 1, 13, '2025-12-01 04:23:51', NULL),
(46, 1, 12, '2025-12-01 04:23:51', NULL),
(47, 3, 21, '2025-12-01 04:23:56', NULL),
(48, 3, 14, '2025-12-01 04:23:56', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `link` varchar(35) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `name`, `icon`, `link`, `order`, `created_at`, `updated_at`) VALUES
(12, 'Level', 'bi bi-sort-numeric-up', 'level', 4, '2025-11-28 07:20:22', '2025-11-28 07:35:30'),
(13, 'User', 'bi bi-person-circle', 'user', 5, '2025-11-28 07:22:43', '2025-11-28 07:35:57'),
(14, 'Dashboard', 'bi bi-house-heart', 'dashboard', 1, '2025-11-28 07:23:54', NULL),
(15, 'Service', 'bi bi-basket2', 'service', 3, '2025-11-28 07:25:29', NULL),
(16, 'Customer', 'bi bi-people-fill', 'customer', 2, '2025-11-28 07:26:19', NULL),
(17, 'Menu', 'bi bi-journal-text', 'menu', 7, '2025-11-28 07:29:39', '2025-11-28 07:35:40'),
(18, 'Tax', 'bi bi-cash-coin', 'tax', 6, '2025-11-28 07:31:05', '2025-11-28 07:35:50'),
(19, 'Order', 'bi bi-cart3', 'order', 8, '2025-11-28 07:31:41', NULL),
(21, 'Report', 'bi bi-file-earmark-post-fill', 'report', 9, '2025-12-01 04:23:44', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `service_price` int(11) NOT NULL,
  `service_description` text NOT NULL,
  `service_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id`, `service_name`, `service_price`, `service_description`, `service_photo`, `created_at`, `updated_at`) VALUES
(2, 'Wash Only', 4500, 'Wash your clothes until smells good from 5m', 'assets/uploads/1764545591-laundry (1).png', '2025-11-28 07:41:13', '2025-11-30 23:33:11'),
(3, 'Iron Only', 5000, 'Hot pressed iron like nobodys business', 'assets/uploads/1764569540-iron (2).png', '2025-11-28 07:42:15', '2025-12-01 06:12:20'),
(5, 'Wash and Iron', 5000, 'Clean clothes like no other!  we guarantee a clean, nice smelling, and hot pressed laundry at every transaction!', 'assets/uploads/1764562729-clothes.png', '2025-12-01 04:18:49', NULL),
(6, 'Thick item (Blanket, Carpet, Jacket, and Bed Sheet', 7000, 'Wash and Iron your speciality item to ensure clean finish every time', 'assets/uploads/1764563257-blanket.png', '2025-12-01 04:26:07', '2025-12-01 04:27:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_orders`
--

CREATE TABLE `trans_orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_code` varchar(20) NOT NULL,
  `order_end_date` date NOT NULL,
  `order_status` tinyint(1) NOT NULL DEFAULT 0,
  `order_pay` int(11) NOT NULL,
  `order_change` int(11) NOT NULL,
  `order_tax` int(11) NOT NULL,
  `order_total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `trans_orders`
--

INSERT INTO `trans_orders` (`id`, `customer_id`, `order_code`, `order_end_date`, `order_status`, `order_pay`, `order_change`, `order_tax`, `order_total`, `created_at`, `updated_at`) VALUES
(4, 2, 'ORD-28112025003', '2025-11-19', 1, 150000, 54240, 10260, 95760, '2025-11-28 07:55:40', NULL),
(5, 2, 'ORD-28112025003', '2025-11-19', 1, 150000, 54240, 10260, 95760, '2025-11-28 07:56:33', NULL),
(7, 5, 'ORD-01122025007', '2025-12-01', 1, 150000, 10560, 14940, 139440, '2025-11-30 23:40:45', '2025-11-30 23:41:44'),
(8, 4, 'ORD-01122025007', '2025-12-09', 1, 150000, 42480, 11520, 107520, '2025-11-30 23:41:29', '2025-11-30 23:41:40'),
(9, 3, 'ORD-01122025009', '2025-12-17', 1, 150000, 21760, 13740, 128240, '2025-11-30 23:44:07', '2025-12-01 04:24:26'),
(10, 5, 'ORD-01122025010', '2025-12-19', 1, 50000, 1280, 5220, 48720, '2025-11-30 23:46:36', '2025-12-01 04:24:30'),
(11, 6, 'ORD-01122025011', '2025-12-25', 1, 200000, 40960, 17040, 159040, '2025-12-01 04:25:27', '2025-12-01 04:33:49'),
(12, 7, 'ORD-01122025012', '2025-12-22', 1, 100000, 8160, 9840, 91840, '2025-12-01 04:27:16', '2025-12-01 04:44:12'),
(13, 3, 'ORD-01122025013', '2025-12-31', 1, 150000, 9440, 15060, 140560, '2025-12-01 04:28:13', '2025-12-01 04:44:18'),
(15, 9, 'ORD-01122025014', '2026-01-08', 1, 150000, 35200, 12300, 114800, '2025-12-01 04:36:44', '2025-12-01 04:44:21'),
(18, 6, 'ORD-01122025016', '2025-12-03', 0, 150000, 15040, 14460, 134960, '2025-12-01 06:20:53', NULL),
(19, 4, 'ORD-01122025019', '2025-12-13', 0, 150000, 28480, 13020, 121520, '2025-12-01 08:02:01', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_order_details`
--

CREATE TABLE `trans_order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `price` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `trans_order_details`
--

INSERT INTO `trans_order_details` (`id`, `order_id`, `service_id`, `qty`, `price`, `subtotal`, `created_at`, `updated_at`, `notes`) VALUES
(1, 1, 1, 2.00, 5000, 10000, '2025-11-28 07:43:51', NULL, ''),
(2, 1, 2, 3.00, 4500, 13500, '2025-11-28 07:43:51', NULL, ''),
(3, 2, 1, 9.00, 5000, 45000, '2025-11-28 07:47:05', NULL, ''),
(4, 2, 2, 3.00, 4500, 13500, '2025-11-28 07:47:05', NULL, ''),
(5, 2, 4, 3.00, 7000, 21000, '2025-11-28 07:47:05', NULL, ''),
(6, 3, 1, 2.00, 5000, 10000, '2025-11-28 07:50:35', NULL, ''),
(7, 3, 2, 3.00, 4500, 13500, '2025-11-28 07:50:35', NULL, ''),
(8, 3, 3, 4.00, 5000, 20000, '2025-11-28 07:50:35', NULL, ''),
(9, 4, 1, 2.00, 5000, 10000, '2025-11-28 07:55:40', NULL, ''),
(10, 4, 2, 3.00, 4500, 13500, '2025-11-28 07:55:40', NULL, ''),
(11, 4, 3, 4.00, 5000, 20000, '2025-11-28 07:55:40', NULL, ''),
(12, 4, 4, 6.00, 7000, 42000, '2025-11-28 07:55:40', NULL, ''),
(13, 5, 1, 2.00, 5000, 10000, '2025-11-28 07:56:33', NULL, ''),
(14, 5, 2, 3.00, 4500, 13500, '2025-11-28 07:56:33', NULL, ''),
(15, 5, 3, 4.00, 5000, 20000, '2025-11-28 07:56:33', NULL, ''),
(16, 5, 4, 6.00, 7000, 42000, '2025-11-28 07:56:33', NULL, ''),
(17, 6, 1, 1.00, 5000, 5000, '2025-11-28 08:42:15', NULL, ''),
(18, 7, 1, 5.00, 5000, 25000, '2025-11-30 23:40:45', NULL, ''),
(19, 7, 2, 7.00, 4500, 31500, '2025-11-30 23:40:45', NULL, ''),
(20, 7, 3, 8.00, 5000, 40000, '2025-11-30 23:40:45', NULL, ''),
(21, 7, 4, 4.00, 7000, 28000, '2025-11-30 23:40:45', NULL, ''),
(22, 8, 3, 8.00, 5000, 40000, '2025-11-30 23:41:29', NULL, ''),
(23, 8, 4, 4.00, 7000, 28000, '2025-11-30 23:41:29', NULL, ''),
(24, 8, 2, 4.00, 4500, 18000, '2025-11-30 23:41:29', NULL, ''),
(25, 8, 1, 2.00, 5000, 10000, '2025-11-30 23:41:29', NULL, ''),
(26, 9, 1, 2.00, 5000, 10000, '2025-11-30 23:44:07', NULL, ''),
(27, 9, 2, 5.00, 4500, 22500, '2025-11-30 23:44:07', NULL, ''),
(28, 9, 3, 8.00, 5000, 40000, '2025-11-30 23:44:07', NULL, ''),
(29, 9, 4, 6.00, 7000, 42000, '2025-11-30 23:44:07', NULL, ''),
(30, 10, 1, 2.00, 5000, 10000, '2025-11-30 23:46:36', NULL, ''),
(31, 10, 2, 3.00, 4500, 13500, '2025-11-30 23:46:36', NULL, ''),
(32, 10, 3, 4.00, 5000, 20000, '2025-11-30 23:46:36', NULL, ''),
(33, 11, 2, 4.00, 4500, 18000, '2025-12-01 04:25:27', NULL, ''),
(34, 11, 3, 6.00, 5000, 30000, '2025-12-01 04:25:27', NULL, ''),
(35, 11, 4, 7.00, 7000, 49000, '2025-12-01 04:25:27', NULL, ''),
(36, 11, 5, 9.00, 5000, 45000, '2025-12-01 04:25:27', NULL, ''),
(37, 12, 2, 6.00, 4500, 27000, '2025-12-01 04:27:16', NULL, ''),
(38, 12, 3, 8.00, 5000, 40000, '2025-12-01 04:27:16', NULL, ''),
(39, 12, 5, 3.00, 5000, 15000, '2025-12-01 04:27:16', NULL, ''),
(40, 13, 3, 9.00, 5000, 45000, '2025-12-01 04:28:13', NULL, ''),
(41, 13, 5, 6.00, 5000, 30000, '2025-12-01 04:28:13', NULL, ''),
(42, 13, 2, 5.00, 4500, 22500, '2025-12-01 04:28:13', NULL, ''),
(43, 13, 6, 4.00, 7000, 28000, '2025-12-01 04:28:13', NULL, ''),
(44, 14, 2, 2.00, 4500, 9000, '2025-12-01 04:33:24', NULL, ''),
(45, 14, 3, 4.00, 5000, 20000, '2025-12-01 04:33:24', NULL, ''),
(46, 14, 5, 6.00, 5000, 30000, '2025-12-01 04:33:24', NULL, ''),
(47, 14, 6, 8.00, 7000, 56000, '2025-12-01 04:33:24', NULL, ''),
(48, 15, 2, 3.00, 4500, 13500, '2025-12-01 04:36:44', NULL, ''),
(49, 15, 3, 6.00, 5000, 30000, '2025-12-01 04:36:44', NULL, ''),
(50, 15, 5, 9.00, 5000, 45000, '2025-12-01 04:36:44', NULL, ''),
(51, 15, 6, 2.00, 7000, 14000, '2025-12-01 04:36:44', NULL, ''),
(52, 16, 2, 1.50, 4500, 6750, '2025-12-01 04:37:36', NULL, ''),
(53, 16, 3, 2.80, 5000, 14000, '2025-12-01 04:37:36', NULL, ''),
(54, 16, 5, 3.90, 5000, 19500, '2025-12-01 04:37:36', NULL, ''),
(55, 16, 6, 4.60, 7000, 32200, '2025-12-01 04:37:36', NULL, ''),
(56, 17, 2, 3.00, 4500, 13500, '2025-12-01 04:43:25', NULL, ''),
(57, 17, 3, 5.00, 5000, 25000, '2025-12-01 04:43:25', NULL, ''),
(58, 17, 5, 7.00, 5000, 35000, '2025-12-01 04:43:25', NULL, ''),
(59, 17, 6, 6.00, 7000, 42000, '2025-12-01 04:43:25', NULL, ''),
(60, 18, 3, 5.00, 5000, 25000, '2025-12-01 06:20:53', NULL, ''),
(61, 18, 2, 3.00, 4500, 13500, '2025-12-01 06:20:53', NULL, ''),
(62, 18, 5, 8.00, 5000, 40000, '2025-12-01 06:20:53', NULL, ''),
(63, 18, 6, 6.00, 7000, 42000, '2025-12-01 06:20:53', NULL, ''),
(64, 19, 5, 2.00, 5000, 10000, '2025-12-01 08:02:01', NULL, ''),
(65, 19, 3, 4.00, 5000, 20000, '2025-12-01 08:02:01', NULL, ''),
(66, 19, 2, 5.00, 4500, 22500, '2025-12-01 08:02:01', NULL, ''),
(67, 19, 6, 8.00, 7000, 56000, '2025-12-01 08:02:01', NULL, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `level_id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(3, 1, 'Administrator', 'admin@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '2025-11-28 07:08:55', '2025-11-28 07:28:51'),
(4, 2, 'Operator', 'operator@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '2025-11-28 07:30:22', NULL),
(5, 3, 'Pimpinan', 'pimpinan@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '2025-11-30 23:34:49', NULL),
(6, 1, 'Syahirah Khairunnisa', 'syahirahkhairunnisa2021@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '2025-12-01 04:21:24', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `level_menus`
--
ALTER TABLE `level_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `trans_orders`
--
ALTER TABLE `trans_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `trans_order_details`
--
ALTER TABLE `trans_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `level_menus`
--
ALTER TABLE `level_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `trans_orders`
--
ALTER TABLE `trans_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `trans_order_details`
--
ALTER TABLE `trans_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
