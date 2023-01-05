-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2022 at 09:06 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asetrii`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_id`, `name`, `group_by`, `label`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
('44c628a2-c9e0-4414-8afe-e9fa3358e73c', NULL, 'laptop', 'kinds', 'Laptop', 'Laptop', '2022-12-27 00:29:08', '2022-12-27 00:29:08', NULL),
('98143882-83a7-4f1b-9259-096f34b7247b', NULL, 'mobil', 'kinds', 'Mobil', 'Mobil', '2022-12-27 00:29:08', '2022-12-27 00:29:08', NULL),
('98143882-8686-4fd1-8fd5-a80e4eb61c0e', '44c628a2-c9e0-4414-8afe-e9fa3358e73c', 'dell', 'merks', 'Dell', 'Dell', '2022-12-27 00:29:08', '2022-12-27 00:29:08', NULL),
('98143882-87cd-402e-adb4-c0337f2e8abf', '44c628a2-c9e0-4414-8afe-e9fa3358e73c', 'asus', 'merks', 'Asus', 'Asus', '2022-12-27 00:29:08', '2022-12-27 00:29:08', NULL),
('98143882-88bf-4a49-8116-09321000634f', NULL, 'unit', 'units', 'unit', 'unit', '2022-12-27 00:29:08', '2022-12-27 00:29:08', NULL),
('98143882-89ad-49d0-b665-ad488cc5027f', NULL, 'pcs', 'units', 'pcs', 'pcs', '2022-12-27 00:29:08', '2022-12-27 00:29:08', NULL),
('98143882-8c89-4216-a274-71c4b4658cf6', NULL, 'finance-and-support', 'divisions', 'Finance and Support', 'Finance and Support', '2022-12-27 00:29:08', '2022-12-27 00:29:08', NULL),
('98143882-8de4-42fd-bf73-5cc532fc1be2', NULL, 'operation', 'divisions', 'Operation', 'Operation', '2022-12-27 00:29:08', '2022-12-27 00:29:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kind_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merk_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ukuran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `stock_id`, `kind_id`, `merk_id`, `unit_id`, `name`, `code`, `ukuran`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
('98143b85-6790-4ed0-8c32-0eabc6003e98', '98143b51-1cd6-4a15-b9ed-d17762052604', '44c628a2-c9e0-4414-8afe-e9fa3358e73c', '98143882-8686-4fd1-8fd5-a80e4eb61c0e', '98143882-88bf-4a49-8116-09321000634f', 'Dell Inspiron 14 5000 2 in 1 Core i3', 'RII-2022-DEL-009', NULL, 1, '2022-12-27 00:37:33', '2022-12-27 00:38:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loan_records`
--

CREATE TABLE `loan_records` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_in` tinyint(1) NOT NULL DEFAULT 1,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_records`
--

INSERT INTO `loan_records` (`id`, `item_id`, `is_in`, `notes`, `receipt`, `position`, `upload_file`, `created`, `created_at`, `updated_at`, `deleted_at`) VALUES
('98143bbb-fa27-4a80-8764-91093d9b84e0', '98143b85-6790-4ed0-8c32-0eabc6003e98', 0, 'Head Office', 'Hafizd Muhammad', 'IT Division', NULL, '2022-12-27 00:00:00', '2022-12-27 00:38:09', '2022-12-27 00:38:09', NULL),
('98143bd9-4fa7-4b1d-b46e-f092affb8e74', '98143b85-6790-4ed0-8c32-0eabc6003e98', 1, 'Head Office', NULL, NULL, NULL, '2022-12-27 00:00:00', '2022-12-27 00:38:28', '2022-12-27 00:38:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_05_010000_create_loan_records_table', 1),
(6, '2022_10_20_010000_create_categories_table', 1),
(7, '2022_10_20_010000_create_items_table', 1),
(8, '2022_10_20_010000_create_stock_logs_table', 1),
(9, '2022_10_20_010000_create_stocks_table', 1),
(10, '2022_10_20_020000_alter_categories_table', 1),
(11, '2022_10_20_020000_alter_items_table', 1),
(12, '2022_10_20_020000_alter_stock_logs_table', 1),
(13, '2022_10_20_020000_alter_stocks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `division_id`, `user_id`, `type`, `name`, `location`, `created_at`, `updated_at`, `deleted_at`) VALUES
('98143b51-1cd6-4a15-b9ed-d17762052604', '98143882-8c89-4216-a274-71c4b4658cf6', '9814397a-1bd9-4926-9559-7ed22b96e421', 'asset', 'Stock Asset Laptop RII', 'Head Office', '2022-12-27 00:36:59', '2022-12-27 00:36:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_logs`
--

CREATE TABLE `stock_logs` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `reciever` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `moved_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `position`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('98143882-454e-47db-bd3b-2f793f11cc0c', 'Dummy User Admin', 'admin', NULL, 'admin', 'admin@gmail.com', NULL, '$2y$10$PT9rzuX3JyQ0rJpHg.Mmu.RaZkeqnk7nZaK1xLlIXuSqn.swwRwxS', NULL, '2022-12-27 00:29:08', '2022-12-27 00:29:08'),
('98143882-605d-4ef7-bc10-4e02d9621635', 'Dummy User Super Admin', 'superadmin', NULL, 'superadmin', 'superadmin@gmail.com', NULL, '$2y$10$VxKQP7xrhRwV7Q4U8spN2.lmJYmE0GUdCuVyjgQ5jVn5ukJqlzycS', NULL, '2022-12-27 00:29:08', '2022-12-27 00:29:08'),
('98143882-797d-4aab-bfee-3ba7caf69f06', 'Dummy User Director', 'director', NULL, 'director', 'director@gmail.com', NULL, '$2y$10$4oN/xVuTPjbFw7Jw7LpSlOWviP3oUEYn0CUMy.8fHZMPg1xrDUfBK', NULL, '2022-12-27 00:29:08', '2022-12-27 00:29:08'),
('9814397a-1bd9-4926-9559-7ed22b96e421', 'M Hafizd Elison', 'admin', 'IT Division', 'hafizdm', 'hafidz@rapidinfrastruktur.com', NULL, '$2y$10$nsEu4QSu0ZlclcqQxRqAy.DDw32RxrFUGTaLqCqQcDfqE6XLjj5Na', NULL, '2022-12-27 00:31:50', '2022-12-27 00:31:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_group_by_unique` (`name`,`group_by`),
  ADD KEY `categories_category_id_index` (`category_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `items_code_unique` (`code`),
  ADD KEY `items_stock_id_index` (`stock_id`),
  ADD KEY `items_kind_id_index` (`kind_id`),
  ADD KEY `items_merk_id_index` (`merk_id`),
  ADD KEY `items_unit_id_index` (`unit_id`);

--
-- Indexes for table `loan_records`
--
ALTER TABLE `loan_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_division_id_index` (`division_id`);

--
-- Indexes for table `stock_logs`
--
ALTER TABLE `stock_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_logs_item_id_index` (`item_id`),
  ADD KEY `stock_logs_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_kind_id_foreign` FOREIGN KEY (`kind_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `items_merk_id_foreign` FOREIGN KEY (`merk_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `items_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`),
  ADD CONSTRAINT `items_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `stock_logs`
--
ALTER TABLE `stock_logs`
  ADD CONSTRAINT `stock_logs_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `stock_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
