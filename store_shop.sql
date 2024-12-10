-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 09, 2024 lúc 01:35 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `store_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2014_10_12_000000_create_users_table', 1),
(11, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(12, '2019_08_19_000000_create_failed_jobs_table', 1),
(13, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(14, '2024_12_09_093144_role', 1),
(15, '2024_12_09_093353_warehouse', 1),
(16, '2024_12_09_093602_cart', 1),
(17, '2024_12_09_093633_total_cart', 1),
(18, '2024_12_09_093802_product', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `category` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `gender` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `image`, `quantity`, `status`, `category`, `brand`, `gender`, `created_at`, `updated_at`) VALUES
(1, 'Quần nam 1', 90000, 'oke', 'image1.png', 100, 1, 'Đồ nam', 'Balenciaga', 1, '2024-12-09 04:12:55', '2024-12-09 04:12:55'),
(2, 'Quần nam 2', 90000, 'oke', 'image1.png', 100, 1, 'Đồ nam', 'Balenciaga', 1, '2024-12-09 04:12:58', '2024-12-09 04:12:58'),
(3, 'Quần nam 3', 90000, 'oke', 'image1.png', 100, 1, 'Đồ nam', 'Balenciaga', 1, '2024-12-09 04:13:01', '2024-12-09 04:13:01'),
(4, 'Quần nam 4', 90000, 'oke', 'image1.png', 100, 1, 'Đồ nam', 'Balenciaga', 1, '2024-12-09 04:13:03', '2024-12-09 04:13:03'),
(5, 'Quần nam 5', 90000, 'oke', 'image1.png', 100, 1, 'Đồ nam', 'Balenciaga', 1, '2024-12-09 04:13:06', '2024-12-09 04:13:06'),
(6, 'Quần nữ 1', 90000, 'oke', 'image1.png', 100, 1, 'Đồ nữ', 'Balenciaga', 0, '2024-12-09 04:13:28', '2024-12-09 04:13:28'),
(7, 'Quần nữ 2', 90000, 'oke', 'image1.png', 100, 1, 'Đồ nữ', 'Balenciaga', 0, '2024-12-09 04:13:31', '2024-12-09 04:13:31'),
(8, 'Quần nữ 3', 90000, 'oke', 'image1.png', 100, 1, 'Đồ nữ', 'Balenciaga', 0, '2024-12-09 04:13:33', '2024-12-09 04:13:33'),
(9, 'Quần nữ 4', 90000, 'oke', 'image1.png', 100, 1, 'Đồ nữ', 'Balenciaga', 0, '2024-12-09 04:13:36', '2024-12-09 04:13:36'),
(10, 'Quần nữ 5', 90000, 'oke', 'image1.png', 100, 1, 'Đồ nữ', 'Balenciaga', 0, '2024-12-09 04:13:39', '2024-12-09 04:13:39'),
(11, 'Quần nữ 6', 90000, 'oke', 'image1.png', 100, 1, 'Đồ nữ', 'Balenciaga', 0, '2024-12-09 04:13:42', '2024-12-09 04:13:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nameRole` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `nameRole`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2024-12-09 05:26:20', '2024-12-09 05:26:20'),
(2, 'User', '2024-12-09 05:26:25', '2024-12-09 05:26:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `totalcart`
--

CREATE TABLE `totalcart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cart` int(11) NOT NULL,
  `id_payment` int(11) NOT NULL,
  `orderTime` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `phoneNumber` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `account`, `password`, `id_role`, `fullName`, `address`, `birth`, `phoneNumber`, `email`, `created_at`, `updated_at`) VALUES
(1, 'admin', '123', 1, 'Admin', NULL, NULL, NULL, NULL, '2024-12-09 04:13:55', '2024-12-09 04:13:55'),
(2, 'member1', '123', 2, 'Member', NULL, NULL, NULL, NULL, '2024-12-09 04:14:09', '2024-12-09 04:14:09'),
(3, 'member2', '123', 2, 'Member', NULL, NULL, NULL, NULL, '2024-12-09 04:14:12', '2024-12-09 04:14:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `warehouse`
--

CREATE TABLE `warehouse` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_product` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `warehouse`
--

INSERT INTO `warehouse` (`id`, `id_product`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 0, 1, '2024-12-09 04:12:55', '2024-12-09 04:12:55'),
(2, '2', 0, 1, '2024-12-09 04:12:58', '2024-12-09 04:12:58'),
(3, '3', 0, 1, '2024-12-09 04:13:01', '2024-12-09 04:13:01'),
(4, '4', 0, 1, '2024-12-09 04:13:03', '2024-12-09 04:13:03'),
(5, '5', 0, 1, '2024-12-09 04:13:06', '2024-12-09 04:13:06'),
(6, '6', 0, 1, '2024-12-09 04:13:28', '2024-12-09 04:13:28'),
(7, '7', 0, 1, '2024-12-09 04:13:31', '2024-12-09 04:13:31'),
(8, '8', 0, 1, '2024-12-09 04:13:33', '2024-12-09 04:13:33'),
(9, '9', 0, 1, '2024-12-09 04:13:36', '2024-12-09 04:13:36'),
(10, '10', 0, 1, '2024-12-09 04:13:39', '2024-12-09 04:13:39'),
(11, '11', 0, 1, '2024-12-09 04:13:42', '2024-12-09 04:13:42');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_namerole_unique` (`nameRole`);

--
-- Chỉ mục cho bảng `totalcart`
--
ALTER TABLE `totalcart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_account_unique` (`account`),
  ADD UNIQUE KEY `users_phonenumber_unique` (`phoneNumber`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `totalcart`
--
ALTER TABLE `totalcart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
