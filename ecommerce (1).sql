-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 02:49 AM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_image` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `profile_image`, `email_verified_at`, `password`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '202407101535d250c67d-dbda-4624-9b8d-fb7f616b816e.png', NULL, '$2y$12$3DENBg7XBvviKdPvohd5H.QaPtDwegd50KL/2TewOOMV3xV2Ewpk2', '8cf0717071ad3ade741f2f35a78294acb4fe1d784a95ed369a2d377766e2a700', '2024-01-18 15:40:07', '2024-07-10 14:35:49'),
(3, 'Admin', 'admin@wtech.com', '202406261542wtech_logo.png', NULL, '$2y$12$3DENBg7XBvviKdPvohd5H.QaPtDwegd50KL/2TewOOMV3xV2Ewpk2', '133bf30674eb149f69f9ded493bce888a37ea7fc9f7e1db4c99f8e37d48eddd3', '2024-01-18 15:40:07', '2024-07-08 05:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `isdelete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `isdelete`, `created_at`, `updated_at`) VALUES
(1, 'NIKE', 0, 0, '2024-08-28 19:56:33', '2024-08-28 19:56:33'),
(2, 'GIVENCHI', 0, 0, '2024-09-03 09:41:58', '2024-09-03 09:41:58'),
(3, 'OFF-WHITE', 0, 0, '2024-09-03 09:42:14', '2024-09-03 09:42:14'),
(4, 'AMIRI', 0, 0, '2024-09-03 09:42:27', '2024-09-03 09:42:27'),
(5, 'TOTE BAGS', 0, 0, '2024-09-03 09:42:52', '2024-09-03 09:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `inMenu` tinyint(4) NOT NULL DEFAULT 0,
  `isdelete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`, `inMenu`, `isdelete`, `created_at`, `updated_at`) VALUES
(1, 'Beverages', 'upload/category/1809171570523690.jpg', 0, 0, 0, '2024-08-27 04:58:54', '2024-09-03 09:47:40'),
(2, 'Fashion', 'upload/category/1809171540033539.jpg', 0, 1, 0, '2024-08-28 19:56:01', '2024-09-03 09:47:11'),
(3, 'Gadgets', 'upload/category/1809171518129543.jpg', 0, 0, 0, '2024-08-28 19:58:02', '2024-09-03 09:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `isdelete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `code`, `status`, `isdelete`, `created_at`, `updated_at`) VALUES
(1, 'Black', 'black', 0, 0, '2024-08-28 19:56:52', '2024-08-28 19:56:52'),
(2, 'Blue', '#2986cc', 0, 0, '2024-08-28 19:57:07', '2024-08-28 19:57:07'),
(3, 'Yellow', '#f1c232', 0, 0, '2024-08-28 19:57:37', '2024-08-28 19:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_codes`
--

CREATE TABLE `coupon_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `percent_amount` varchar(255) DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `isdelete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_codes`
--

INSERT INTO `coupon_codes` (`id`, `name`, `type`, `percent_amount`, `expire_date`, `status`, `isdelete`, `created_at`, `updated_at`) VALUES
(1, 'testCoupon', 'Amount', '100', '2024-11-11', 0, 0, '2024-11-07 17:12:19', '2024-11-07 17:12:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_18_152439_create_admins_table', 1),
(6, '2024_03_11_081558_create_sellers_table', 1),
(7, '2024_06_25_153408_create_routine_students_table', 1),
(8, '2024_06_26_154551_create_summer_students_table', 1),
(9, '2024_07_10_211123_create_categories_table', 2),
(10, '2024_07_10_211853_create_categories_table', 3),
(11, '2024_07_11_054156_create_sub_categories_table', 4),
(12, '2024_07_11_121022_create_products_table', 5),
(13, '2024_07_11_134415_create_brands_table', 6),
(14, '2024_07_11_151632_create_colors_table', 7),
(15, '2024_07_14_155009_create_product_colors_table', 8),
(16, '2024_07_14_194334_create_product_sizes_table', 9),
(17, '2024_07_14_222823_create_product_images_table', 10),
(18, '2024_08_01_053433_create_coupon_codes_table', 11),
(19, '2024_08_01_153619_create_shipping_charges_table', 12),
(20, '2024_08_02_111347_create_orders_table', 13),
(21, '2024_08_02_120516_create_order_items_table', 14),
(22, '2024_08_11_151315_create_product_wishlists_table', 15),
(23, '2024_08_12_232408_create_product_reviews_table', 16),
(24, '2024_08_14_035224_create_pages_table', 17),
(25, '2024_08_14_092144_create_settings_table', 18),
(26, '2024_08_16_114325_create_sliders_table', 19),
(27, '2024_08_16_142101_create_support_brands_table', 20),
(28, '2024_08_22_150916_create_notifications_table', 21),
(29, '2024_08_26_055510_create_payment_settings_table', 22),
(30, '2024_08_26_113820_create_contacts_table', 23),
(31, '2024_08_27_091440_create_subscribers_table', 24),
(32, '2024_08_27_092555_create_subscribers_table', 25);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `is_Admin` tinyint(4) NOT NULL DEFAULT 0,
  `is_read` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `url`, `message`, `is_Admin`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 'http://127.0.0.1:8000/admin/view/users', 'New Registered Customer', 0, 1, '2024-08-28 14:46:38', '2024-08-28 14:48:58'),
(2, 1, 'http://127.0.0.1:8000/admin/details/orders/1', 'New Order Placed #371479488', 0, 1, '2024-08-28 14:56:16', '2024-10-17 18:09:54'),
(3, 1, 'http://127.0.0.1:8000/user/orders', 'Your Order Status has been Updated #371479488', 1, 1, '2024-08-28 14:58:25', '2024-10-17 18:26:05'),
(4, 1, 'http://127.0.0.1:8000/admin/details/orders/5', 'New Order Placed #775526926', 0, 1, '2024-09-23 14:02:44', '2024-10-17 18:09:45'),
(5, 1, 'http://127.0.0.1:8000/admin/details/orders/10', 'New Order Placed #590516677', 0, 1, '2024-10-17 18:23:09', '2024-10-17 18:23:39'),
(6, 1, 'http://127.0.0.1:8000/user/orders', 'Your Order Status has been Updated #590516677', 1, 1, '2024-10-17 18:25:08', '2024-10-17 18:25:33'),
(7, 1, 'http://127.0.0.1:8000/admin/details/orders/11', 'New Order Placed #180070632', 0, 1, '2024-11-07 17:14:35', '2024-11-07 17:15:19'),
(8, 1, 'http://127.0.0.1:8000/user/orders', 'Your Order Status has been Updated #180070632', 1, 1, '2024-11-07 17:16:25', '2024-11-07 17:16:34'),
(9, 1, 'http://127.0.0.1:8000/user/orders', 'Your Order Status has been Updated #180070632', 1, 1, '2024-11-07 17:16:53', '2024-11-07 17:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderNo` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `stripe_session_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `couponCode` varchar(255) DEFAULT NULL,
  `couponCode_amount` varchar(255) DEFAULT NULL,
  `shipping_id` int(11) DEFAULT NULL,
  `shipping_amount` varchar(255) NOT NULL DEFAULT '0',
  `total_amount` varchar(255) NOT NULL DEFAULT '0',
  `payment_method` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '    0 = Pending\r\n\r\n    1 = Inprogress\r\n    2 = Delivered\r\n    3 = Completed\r\n    4 = Cancelled',
  `isdelete` tinyint(4) NOT NULL DEFAULT 0,
  `isPayment` tinyint(4) NOT NULL DEFAULT 0,
  `payment_data` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderNo`, `transaction_id`, `stripe_session_id`, `user_id`, `firstName`, `lastName`, `country`, `address1`, `address2`, `city`, `state`, `postcode`, `phone`, `email`, `notes`, `couponCode`, `couponCode_amount`, `shipping_id`, `shipping_amount`, `total_amount`, `payment_method`, `currency`, `status`, `isdelete`, `isPayment`, `payment_data`, `created_at`, `updated_at`) VALUES
(1, '371479488', '1L141194V9415514U', NULL, 1, 'TEST', 'Another TEst', 'Nigeria', 'ANy address', 'None', 'Akure', 'Ondo', '101121', '09102678284', 'user@test.com', '', '', '0', 1, '0', '300', 'paypal', 'EUR', 3, 0, 1, NULL, '2024-08-28 14:54:40', '2024-08-28 14:58:15'),
(2, '309311476', NULL, NULL, 1, 'Firstname', 'Lastname', 'Nigeria', 'ANy address', 'None', 'Akure', 'Ondo', '101121', '09102678284', 'user@test.com', '', '', '0', 1, '0', '1400', 'paystack', NULL, 0, 0, 0, NULL, '2024-08-29 09:40:19', '2024-08-29 09:40:19'),
(3, '789105014', NULL, NULL, 1, 'Firstname', 'Lastname', 'Nigeria', 'ANy address', 'None', 'Akure', 'Ondo', '101121', '09102678284', 'user@test.com', '', '', '0', 1, '0', '1400', 'paystack', NULL, 0, 0, 0, NULL, '2024-08-29 09:46:31', '2024-08-29 09:46:31'),
(4, '708448254', NULL, NULL, 1, 'Firstname', 'Lastname', 'Nigeria', 'ANy address', 'None', 'Akure', 'Ondo', '101121', '09102678284', 'user@test.com', '', '', '0', 1, '0', '1400', 'paystack', NULL, 0, 0, 0, NULL, '2024-08-29 09:49:17', '2024-08-29 09:49:17'),
(5, '775526926', '4204294122', NULL, 1, 'Firstname', 'Lastname', 'Nigeria', 'ANy address', 'None', 'Akure', 'Ondo', '101121', '09102678284', 'user@test.com', '', '', '0', 1, '0', '1410', 'paystack', NULL, 4, 0, 1, NULL, '2024-09-23 14:01:08', '2024-10-17 18:25:50'),
(6, '998286044', NULL, NULL, 1, 'Firstname', 'Lastname', 'Nigeria', 'ANy address', 'None', 'Akure', 'Ondo', '101121', '09102678284', 'user@test.com', 'notes', '', '0', 1, '0', '6000', 'stripe', NULL, 0, 0, 0, NULL, '2024-10-17 18:12:10', '2024-10-17 18:12:10'),
(7, '190254602', NULL, NULL, 1, 'Firstname', 'Lastname', 'Nigeria', 'ANy address', 'None', 'Akure', 'Ondo', '101121', '09102678284', 'user@test.com', 'note', '', '0', 1, '0', '6000', '', NULL, 0, 0, 0, NULL, '2024-10-17 18:18:52', '2024-10-17 18:18:52'),
(8, '901891934', NULL, NULL, 1, 'Firstname', 'Lastname', 'Nigeria', 'ANy address', 'None', 'Akure', 'Ondo', '101121', '09102678284', 'user@test.com', 'note', '', '0', 1, '0', '6000', 'paypal', NULL, 0, 0, 0, NULL, '2024-10-17 18:19:04', '2024-10-17 18:19:04'),
(9, '169596420', NULL, NULL, 1, 'Firstname', 'Lastname', 'Nigeria', 'ANy address', 'None', 'Akure', 'Ondo', '101121', '09102678284', 'user@test.com', 'note', '', '0', 1, '0', '6000', 'stripe', NULL, 0, 0, 0, NULL, '2024-10-17 18:20:02', '2024-10-17 18:20:02'),
(10, '590516677', '1729192970', 'cs_test_a1EdeRwsCGaWDtummGTtkWRE4QBix8WblI6zdndDzh51mfFbHq3BPHVaFe', 1, 'Firstname', 'Lastname', 'Nigeria', 'ANy address', 'None', 'Akure', 'Ondo', '101121', '09102678284', 'user@test.com', 'note', '', '0', 1, '0', '6000', 'stripe', 'eur', 3, 0, 1, NULL, '2024-10-17 18:20:28', '2024-10-17 18:24:12'),
(11, '180070632', '1EF22612EY092715P', NULL, 1, 'Firstname', 'Lastname', 'Nigeria', 'ANy address', 'None', 'Akure', 'Ondo', '101121', '09102678284', 'user@test.com', '', 'testCoupon', '100', 1, '0', '2300', 'paypal', 'EUR', 4, 0, 1, NULL, '2024-11-07 17:12:52', '2024-11-07 17:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` varchar(255) NOT NULL DEFAULT '0',
  `quantity` varchar(255) NOT NULL DEFAULT '0',
  `color_name` varchar(255) DEFAULT NULL,
  `size_name` varchar(255) DEFAULT NULL,
  `size_amount` varchar(255) NOT NULL DEFAULT '0',
  `total_price` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`, `color_name`, `size_name`, `size_amount`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '100', '3', NULL, NULL, '0', '100', '2024-08-28 14:54:40', '2024-08-28 14:54:40'),
(2, 2, 2, '1400', '1', 'Blue', NULL, '0', '1400', '2024-08-29 09:40:22', '2024-08-29 09:40:22'),
(3, 3, 2, '1400', '1', 'Blue', NULL, '0', '1400', '2024-08-29 09:46:31', '2024-08-29 09:46:31'),
(4, 4, 2, '1400', '1', 'Blue', NULL, '0', '1400', '2024-08-29 09:49:17', '2024-08-29 09:49:17'),
(5, 5, 7, '470', '3', 'Black', 'MEDIUM', '20', '470', '2024-09-23 14:01:08', '2024-09-23 14:01:08'),
(6, 6, 8, '2000', '3', 'Black', NULL, '0', '2000', '2024-10-17 18:12:10', '2024-10-17 18:12:10'),
(7, 7, 8, '2000', '3', 'Black', NULL, '0', '2000', '2024-10-17 18:18:52', '2024-10-17 18:18:52'),
(8, 8, 8, '2000', '3', 'Black', NULL, '0', '2000', '2024-10-17 18:19:04', '2024-10-17 18:19:04'),
(9, 9, 8, '2000', '3', 'Black', NULL, '0', '2000', '2024-10-17 18:20:02', '2024-10-17 18:20:02'),
(10, 10, 8, '2000', '3', 'Black', NULL, '0', '2000', '2024-10-17 18:20:28', '2024-10-17 18:20:28'),
(11, 11, 9, '800', '3', 'Black', NULL, '0', '800', '2024-11-07 17:12:52', '2024-11-07 17:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image_name` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `title`, `description`, `image_name`, `created_at`, `updated_at`) VALUES
(1, 'about', 'OUR STORY', '<p>HEy ou</p>', 'upload/pages/1808008663389135.jpg', NULL, '2024-08-21 13:43:46'),
(2, 'contact', 'CONTACT INFO', '', 'upload/pages/1808009802136312.jpg', NULL, '2024-08-21 14:01:52'),
(3, 'faq', 'faq', NULL, NULL, NULL, NULL),
(4, 'payment-method', 'payment-method', NULL, NULL, NULL, NULL),
(5, 'money-back-guarantee', 'money-back-guarantee', NULL, NULL, NULL, NULL),
(6, 'shipping', 'shipping', NULL, NULL, NULL, NULL),
(7, 'returns', 'returns', NULL, NULL, NULL, NULL),
(8, 'terms-conditions', 'terms-conditions', NULL, NULL, NULL, NULL),
(9, 'privacy-policy', 'PRIVACY POLICY', '<p>LOREM</p>', NULL, NULL, '2024-08-21 14:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$12$V7EB28QY/n91tCls7M.OQ.Dm3e77YTbDAoMDeYmh6ktqg3VRT6Ofi', '2024-08-18 13:54:56');

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paypal_id` varchar(255) DEFAULT NULL,
  `paypal_sk` varchar(255) DEFAULT NULL,
  `paypal_status` varchar(255) NOT NULL DEFAULT 'sandbox',
  `stripe_pk` varchar(255) DEFAULT NULL,
  `stripe_sk` varchar(255) DEFAULT NULL,
  `paystack_pk` varchar(255) DEFAULT NULL,
  `paystack_sk` varchar(255) DEFAULT NULL,
  `merchant_email` varchar(255) DEFAULT NULL,
  `is_cash` tinyint(4) NOT NULL DEFAULT 1,
  `is_paypal` tinyint(4) NOT NULL DEFAULT 1,
  `is_stripe` tinyint(4) NOT NULL DEFAULT 1,
  `is_paystack` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `paypal_id`, `paypal_sk`, `paypal_status`, `stripe_pk`, `stripe_sk`, `paystack_pk`, `paystack_sk`, `merchant_email`, `is_cash`, `is_paypal`, `is_stripe`, `is_paystack`, `created_at`, `updated_at`) VALUES
(1, 'AZI3yJ5EKNNU_UnDP_JVoLGPNmnPUWYosZALhl4nfNJsdutaZUb9ToGI3x-K4qJykiNHjdmYhgatboVj', 'EAjfFgVdHOG2zsS2jro5g2qlzJtJXEc2Y-z9qdP5XzUG7rQ5W5ffoGUEwYGxMuSFN4_caLajRJVzpQx2', 'sandbox', 'pk_test_51OwRhKRqZMkPEwgB5BNh5rANFABxxEAIh1jWkaYBuYxc90ntrX8s2r9j7cZBOVZduWzlbpeJVsgULp5wFzSjJXYj00pzpCMpdQ', 'sk_test_51OwRhKRqZMkPEwgBk7DMrrYqdg8mQeddKJHCjYdAtYUcxgmi3hcMcqyBp9qU6OtYz7st4w8HbeVI0Htbq7zn3TY900Or73yNt3', 'pk_test_7f28c9740c0d77f74c39f7b94ee3bf685c59ed9c', 'sk_test_c7ac2fbe687eb5f1df6a56ba8fee90092beef571', 'unicodeveloper@gmail.com', 0, 1, 1, 1, NULL, '2024-09-23 14:00:46');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `old_price` int(11) DEFAULT 0,
  `price` int(11) DEFAULT 0,
  `short_description` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `additional_information` text DEFAULT NULL,
  `shipping_returns` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `isdelete` tinyint(4) NOT NULL DEFAULT 0,
  `isFeatured` tinyint(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `category_id`, `sku`, `subcategory_id`, `brand_id`, `old_price`, `price`, `short_description`, `description`, `additional_information`, `shipping_returns`, `status`, `isdelete`, `isFeatured`, `created_at`, `updated_at`) VALUES
(1, '2 in 1 Coffee', 2, '2 I-MSRFTLEE', 2, 1, 200, 100, 'Short Description *', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(80,93,105);font-family:Nunito, sans-serif;font-size:14.4px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>Description </strong></span></span><span style=\"background-color:rgb(255,255,255);color:rgba(var(--bs-danger-rgb),var(--bs-text-opacity))!important;font-family:Nunito, sans-serif;font-size:14.4px;\"><span class=\"text-danger\" style=\"--bs-text-opacity:1;-webkit-text-stroke-width:0px;box-sizing:border-box;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>*</strong></span></span></p>', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(80,93,105);font-family:Nunito, sans-serif;font-size:14.4px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>Additional information </strong></span></span><span style=\"background-color:rgb(255,255,255);color:rgba(var(--bs-danger-rgb),var(--bs-text-opacity))!important;font-family:Nunito, sans-serif;font-size:14.4px;\"><span class=\"text-danger\" style=\"--bs-text-opacity:1;-webkit-text-stroke-width:0px;box-sizing:border-box;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>*</strong></span></span></p>', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(80,93,105);font-family:Nunito, sans-serif;font-size:14.4px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>Shiipping Returns </strong></span></span><span style=\"background-color:rgb(255,255,255);color:rgba(var(--bs-danger-rgb),var(--bs-text-opacity))!important;font-family:Nunito, sans-serif;font-size:14.4px;\"><span class=\"text-danger\" style=\"--bs-text-opacity:1;-webkit-text-stroke-width:0px;box-sizing:border-box;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>*</strong></span></span></p>', 0, 0, 0, '2024-08-27 17:12:32', '2024-08-28 20:02:38'),
(2, 'Nike Sneakers', 2, 'NIK-QWITIRUK', 2, 1, 2450, 1400, '', '', '', '', 0, 0, 1, '2024-08-28 19:55:30', '2024-09-03 09:34:04'),
(3, 'Shoes', 2, 'SHO-EYUMWWRY', 2, 4, 200, 100, 'Short Description *', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(80,93,105);font-family:Nunito, sans-serif;font-size:14.4px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>Description </strong></span></span><span style=\"background-color:rgb(255,255,255);color:rgba(var(--bs-danger-rgb),var(--bs-text-opacity))!important;font-family:Nunito, sans-serif;font-size:14.4px;\"><span class=\"text-danger\" style=\"--bs-text-opacity:1;-webkit-text-stroke-width:0px;box-sizing:border-box;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>*</strong></span></span></p>', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(80,93,105);font-family:Nunito, sans-serif;font-size:14.4px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>Additional information </strong></span></span><span style=\"background-color:rgb(255,255,255);color:rgba(var(--bs-danger-rgb),var(--bs-text-opacity))!important;font-family:Nunito, sans-serif;font-size:14.4px;\"><span class=\"text-danger\" style=\"--bs-text-opacity:1;-webkit-text-stroke-width:0px;box-sizing:border-box;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>*</strong></span></span></p>', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(80,93,105);font-family:Nunito, sans-serif;font-size:14.4px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>Shiipping Returns </strong></span></span><span style=\"background-color:rgb(255,255,255);color:rgba(var(--bs-danger-rgb),var(--bs-text-opacity))!important;font-family:Nunito, sans-serif;font-size:14.4px;\"><span class=\"text-danger\" style=\"--bs-text-opacity:1;-webkit-text-stroke-width:0px;box-sizing:border-box;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>*</strong></span></span></p>', 0, 0, 1, '2024-08-27 17:12:32', '2024-09-03 09:48:56'),
(4, 'Bags', 2, 'BAG-PMCC4SMO', 5, 1, 1450, 800, '', '', '', '', 0, 0, 1, '2024-08-28 19:55:30', '2024-09-03 09:37:53'),
(5, 'Round White Top', 2, 'ROU-X9K68NQG', 6, 2, 859, 620, 'Short Description *', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(80,93,105);font-family:Nunito, sans-serif;font-size:14.4px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>Description </strong></span></span><span style=\"background-color:rgb(255,255,255);color:rgba(var(--bs-danger-rgb),var(--bs-text-opacity))!important;font-family:Nunito, sans-serif;font-size:14.4px;\"><span class=\"text-danger\" style=\"--bs-text-opacity:1;-webkit-text-stroke-width:0px;box-sizing:border-box;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>*</strong></span></span></p>', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(80,93,105);font-family:Nunito, sans-serif;font-size:14.4px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>Additional information </strong></span></span><span style=\"background-color:rgb(255,255,255);color:rgba(var(--bs-danger-rgb),var(--bs-text-opacity))!important;font-family:Nunito, sans-serif;font-size:14.4px;\"><span class=\"text-danger\" style=\"--bs-text-opacity:1;-webkit-text-stroke-width:0px;box-sizing:border-box;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>*</strong></span></span></p>', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(80,93,105);font-family:Nunito, sans-serif;font-size:14.4px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>Shiipping Returns </strong></span></span><span style=\"background-color:rgb(255,255,255);color:rgba(var(--bs-danger-rgb),var(--bs-text-opacity))!important;font-family:Nunito, sans-serif;font-size:14.4px;\"><span class=\"text-danger\" style=\"--bs-text-opacity:1;-webkit-text-stroke-width:0px;box-sizing:border-box;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>*</strong></span></span></p>', 0, 0, 0, '2024-08-27 17:12:32', '2024-09-03 09:46:03'),
(6, 'Airpods', 3, 'AIR-RKEIZNOM', 4, 0, 250, 150, '', '', '', '', 0, 0, 0, '2024-08-28 19:55:30', '2024-09-03 09:39:23'),
(7, 'OFF WHITE', 2, 'OFF-KZLWTWHO', 6, 3, 700, 450, 'Short Description *', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(80,93,105);font-family:Nunito, sans-serif;font-size:14.4px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>Description </strong></span></span><span style=\"background-color:rgb(255,255,255);color:rgba(var(--bs-danger-rgb),var(--bs-text-opacity))!important;font-family:Nunito, sans-serif;font-size:14.4px;\"><span class=\"text-danger\" style=\"--bs-text-opacity:1;-webkit-text-stroke-width:0px;box-sizing:border-box;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>*</strong></span></span></p>', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(80,93,105);font-family:Nunito, sans-serif;font-size:14.4px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>Additional information </strong></span></span><span style=\"background-color:rgb(255,255,255);color:rgba(var(--bs-danger-rgb),var(--bs-text-opacity))!important;font-family:Nunito, sans-serif;font-size:14.4px;\"><span class=\"text-danger\" style=\"--bs-text-opacity:1;-webkit-text-stroke-width:0px;box-sizing:border-box;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>*</strong></span></span></p>', '<p><span style=\"background-color:rgb(255,255,255);color:rgb(80,93,105);font-family:Nunito, sans-serif;font-size:14.4px;\"><span style=\"-webkit-text-stroke-width:0px;display:inline !important;float:none;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>Shiipping Returns </strong></span></span><span style=\"background-color:rgb(255,255,255);color:rgba(var(--bs-danger-rgb),var(--bs-text-opacity))!important;font-family:Nunito, sans-serif;font-size:14.4px;\"><span class=\"text-danger\" style=\"--bs-text-opacity:1;-webkit-text-stroke-width:0px;box-sizing:border-box;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:start;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;\"><strong>*</strong></span></span></p>', 0, 0, 1, '2024-08-27 17:12:32', '2024-09-03 09:44:41'),
(8, 'Air Sneakers', 2, 'AIR-OVPOP70L', 2, 1, 2450, 2000, '', '', '', '', 0, 0, 1, '2024-08-28 19:55:30', '2024-09-03 09:40:25'),
(9, 'TEST', 3, 'TES-VFZHO3DU', 3, 4, 600, 800, '', '', '', '', 0, 0, 1, '2024-11-07 17:06:48', '2024-11-07 17:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id`, `product_id`, `color_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2024-08-28 20:00:26', '2024-08-28 20:00:26'),
(2, 2, 2, '2024-08-28 20:00:26', '2024-08-28 20:00:26'),
(3, 2, 3, '2024-08-28 20:00:26', '2024-08-28 20:00:26'),
(4, 1, 1, '2024-08-28 20:02:39', '2024-08-28 20:02:39'),
(7, 4, 2, '2024-09-03 09:37:53', '2024-09-03 09:37:53'),
(8, 4, 3, '2024-09-03 09:37:53', '2024-09-03 09:37:53'),
(9, 6, 1, '2024-09-03 09:39:23', '2024-09-03 09:39:23'),
(10, 8, 1, '2024-09-03 09:40:25', '2024-09-03 09:40:25'),
(11, 8, 2, '2024-09-03 09:40:25', '2024-09-03 09:40:25'),
(12, 8, 3, '2024-09-03 09:40:25', '2024-09-03 09:40:25'),
(13, 7, 1, '2024-09-03 09:44:41', '2024-09-03 09:44:41'),
(14, 5, 1, '2024-09-03 09:46:03', '2024-09-03 09:46:03'),
(15, 5, 2, '2024-09-03 09:46:03', '2024-09-03 09:46:03'),
(16, 3, 2, '2024-09-03 09:48:56', '2024-09-03 09:48:56'),
(19, 9, 1, '2024-11-07 17:10:18', '2024-11-07 17:10:18'),
(20, 9, 2, '2024-11-07 17:10:18', '2024-11-07 17:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `image_zoom` text DEFAULT NULL,
  `image_extension` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT 100,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_name`, `image_zoom`, `image_extension`, `order_by`, `created_at`, `updated_at`) VALUES
(4, 2, 'upload/products/1808666540415928.jpg', 'upload/products/zoom/1808666540415928.jpg', 'jpg', 100, '2024-08-28 20:00:26', '2024-08-28 20:00:26'),
(5, 2, 'upload/products/1808666540717286.jpg', 'upload/products/zoom/1808666540717286.jpg', 'jpg', 100, '2024-08-28 20:00:27', '2024-08-28 20:00:27'),
(6, 2, 'upload/products/1808666541069243.jpg', 'upload/products/zoom/1808666541069243.jpg', 'jpg', 100, '2024-08-28 20:00:27', '2024-08-28 20:00:27'),
(7, 2, 'upload/products/1808666541331367.jpg', 'upload/products/zoom/1808666541331367.jpg', 'jpg', 100, '2024-08-28 20:00:27', '2024-08-28 20:00:27'),
(8, 1, 'upload/products/1808666679375410.jpg', 'upload/products/zoom/1808666679375410.jpg', 'jpg', 100, '2024-08-28 20:02:39', '2024-08-28 20:02:39'),
(9, 1, 'upload/products/1808666679644620.jpg', 'upload/products/zoom/1808666679644620.jpg', 'jpg', 100, '2024-08-28 20:02:39', '2024-08-28 20:02:39'),
(10, 1, 'upload/products/1808666679921645.jpg', 'upload/products/zoom/1808666679921645.jpg', 'jpg', 100, '2024-08-28 20:02:39', '2024-08-28 20:02:39'),
(11, 4, 'upload/products/1809170822128757.jpg', 'upload/products/zoom/1809170822128757.jpg', 'jpg', 100, '2024-09-03 09:35:47', '2024-09-03 09:35:47'),
(12, 4, 'upload/products/1809170955376831.jpg', 'upload/products/zoom/1809170955376831.jpg', 'jpg', 100, '2024-09-03 09:37:54', '2024-09-03 09:37:54'),
(13, 4, 'upload/products/1809170955528495.jpg', 'upload/products/zoom/1809170955528495.jpg', 'jpg', 100, '2024-09-03 09:37:54', '2024-09-03 09:37:54'),
(14, 6, 'upload/products/1809171049007528.jpg', 'upload/products/zoom/1809171049007528.jpg', 'jpg', 100, '2024-09-03 09:39:23', '2024-09-03 09:39:23'),
(15, 6, 'upload/products/1809171049238485.jpg', 'upload/products/zoom/1809171049238485.jpg', 'jpg', 100, '2024-09-03 09:39:23', '2024-09-03 09:39:23'),
(16, 6, 'upload/products/1809171049364118.jpg', 'upload/products/zoom/1809171049364118.jpg', 'jpg', 100, '2024-09-03 09:39:23', '2024-09-03 09:39:23'),
(17, 6, 'upload/products/1809171049532670.jpg', 'upload/products/zoom/1809171049532670.jpg', 'jpg', 100, '2024-09-03 09:39:24', '2024-09-03 09:39:24'),
(18, 8, 'upload/products/1809171114405478.jpg', 'upload/products/zoom/1809171114405478.jpg', 'jpg', 100, '2024-09-03 09:40:26', '2024-09-03 09:40:26'),
(19, 8, 'upload/products/1809171115022563.jpg', 'upload/products/zoom/1809171115022563.jpg', 'jpg', 100, '2024-09-03 09:40:26', '2024-09-03 09:40:26'),
(20, 8, 'upload/products/1809171115806514.jpg', 'upload/products/zoom/1809171115806514.jpg', 'jpg', 100, '2024-09-03 09:40:27', '2024-09-03 09:40:27'),
(21, 8, 'upload/products/1809171116280551.jpg', 'upload/products/zoom/1809171116280551.jpg', 'jpg', 100, '2024-09-03 09:40:28', '2024-09-03 09:40:28'),
(22, 8, 'upload/products/1809171116797770.jpg', 'upload/products/zoom/1809171116797770.jpg', 'jpg', 100, '2024-09-03 09:40:28', '2024-09-03 09:40:28'),
(23, 7, 'upload/products/1809171383107493.jpg', 'upload/products/zoom/1809171383107493.jpg', 'jpg', 100, '2024-09-03 09:44:42', '2024-09-03 09:44:42'),
(24, 7, 'upload/products/1809171383508907.jpg', 'upload/products/zoom/1809171383508907.jpg', 'jpg', 100, '2024-09-03 09:44:42', '2024-09-03 09:44:42'),
(25, 7, 'upload/products/1809171383714554.jpg', 'upload/products/zoom/1809171383714554.jpg', 'jpg', 100, '2024-09-03 09:44:43', '2024-09-03 09:44:43'),
(26, 7, 'upload/products/1809171384133225.jpg', 'upload/products/zoom/1809171384133225.jpg', 'jpg', 100, '2024-09-03 09:44:43', '2024-09-03 09:44:43'),
(27, 7, 'upload/products/1809171384498980.jpg', 'upload/products/zoom/1809171384498980.jpg', 'jpg', 100, '2024-09-03 09:44:43', '2024-09-03 09:44:43'),
(28, 5, 'upload/products/1809171468795139.jpg', 'upload/products/zoom/1809171468795139.jpg', 'jpg', 100, '2024-09-03 09:46:03', '2024-09-03 09:46:03'),
(29, 5, 'upload/products/1809171468958517.jpg', 'upload/products/zoom/1809171468958517.jpg', 'jpg', 100, '2024-09-03 09:46:04', '2024-09-03 09:46:04'),
(30, 5, 'upload/products/1809171469167278.jpg', 'upload/products/zoom/1809171469167278.jpg', 'jpg', 100, '2024-09-03 09:46:04', '2024-09-03 09:46:04'),
(31, 5, 'upload/products/1809171469512039.jpg', 'upload/products/zoom/1809171469512039.jpg', 'jpg', 100, '2024-09-03 09:46:04', '2024-09-03 09:46:04'),
(32, 5, 'upload/products/1809171469800754.jpg', 'upload/products/zoom/1809171469800754.jpg', 'jpg', 100, '2024-09-03 09:46:05', '2024-09-03 09:46:05'),
(33, 3, 'upload/products/1809171651277335.jpg', 'upload/products/zoom/1809171651277335.jpg', 'jpg', 100, '2024-09-03 09:48:58', '2024-09-03 09:48:58'),
(34, 3, 'upload/products/1809171651769620.jpg', 'upload/products/zoom/1809171651769620.jpg', 'jpg', 100, '2024-09-03 09:48:58', '2024-09-03 09:48:58'),
(35, 3, 'upload/products/1809171652037811.jpg', 'upload/products/zoom/1809171652037811.jpg', 'jpg', 100, '2024-09-03 09:48:58', '2024-09-03 09:48:58'),
(36, 3, 'upload/products/1809171652236722.jpg', 'upload/products/zoom/1809171652236722.jpg', 'jpg', 100, '2024-09-03 09:48:58', '2024-09-03 09:48:58'),
(37, 9, 'upload/products/1815088139512442.jpg', 'upload/products/zoom/1815088139512442.jpg', 'jpg', 100, '2024-11-07 17:09:01', '2024-11-07 17:09:01'),
(38, 9, 'upload/products/1815088220699810.jpg', 'upload/products/zoom/1815088220699810.jpg', 'jpg', 100, '2024-11-07 17:10:18', '2024-11-07 17:10:18'),
(39, 9, 'upload/products/1815088221369151.jpg', 'upload/products/zoom/1815088221369151.jpg', 'jpg', 100, '2024-11-07 17:10:19', '2024-11-07 17:10:19'),
(40, 9, 'upload/products/1815088221933333.jpg', 'upload/products/zoom/1815088221933333.jpg', 'jpg', 100, '2024-11-07 17:10:19', '2024-11-07 17:10:19'),
(41, 9, 'upload/products/1815088222424357.jpg', 'upload/products/zoom/1815088222424357.jpg', 'jpg', 100, '2024-11-07 17:10:20', '2024-11-07 17:10:20'),
(42, 9, 'upload/products/1815088222978217.jpg', 'upload/products/zoom/1815088222978217.jpg', 'jpg', 100, '2024-11-07 17:10:20', '2024-11-07 17:10:20'),
(43, 9, 'upload/products/1815088223460535.jpg', 'upload/products/zoom/1815088223460535.jpg', 'jpg', 100, '2024-11-07 17:10:21', '2024-11-07 17:10:21'),
(44, 9, 'upload/products/1815088223971589.jpg', 'upload/products/zoom/1815088223971589.jpg', 'jpg', 100, '2024-11-07 17:10:21', '2024-11-07 17:10:21'),
(45, 9, 'upload/products/1815088224412013.jpg', 'upload/products/zoom/1815088224412013.jpg', 'jpg', 100, '2024-11-07 17:10:23', '2024-11-07 17:10:23');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  `review` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 7, 'SMALL', 10, '2024-09-03 09:44:42', '2024-09-03 09:44:42'),
(2, 7, 'MEDIUM', 20, '2024-09-03 09:44:42', '2024-09-03 09:44:42'),
(3, 7, 'LARGE', 30, '2024-09-03 09:44:42', '2024-09-03 09:44:42'),
(4, 7, 'X-LARGE', 40, '2024-09-03 09:44:42', '2024-09-03 09:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `product_wishlists`
--

CREATE TABLE `product_wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `favicon` text DEFAULT NULL,
  `footer_description` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone1` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `email1` varchar(255) DEFAULT NULL,
  `email2` varchar(255) DEFAULT NULL,
  `working_hours` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `logo`, `favicon`, `footer_description`, `address`, `phone1`, `phone2`, `contact_email`, `email1`, `email2`, `working_hours`, `facebook`, `twitter`, `instagram`, `created_at`, `updated_at`) VALUES
(1, 'AfroFoods', 'upload/settings/1809171723086362.png', 'upload/settings/1808472489354808.jpg', '', 'With Porto you can customize the layout, colors and styles within only a f', '+2345678900', '+1505937833', '', 'deemo@example.com', 'info@demo.com', 'Mon - Sun / 9:00 AM - 8:00 PM', 'https://facebook.com', '', '', NULL, '2024-09-03 09:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `isdelete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `name`, `price`, `status`, `isdelete`, `created_at`, `updated_at`) VALUES
(1, 'Free Shipping', '0', 0, 0, '2024-08-01 15:12:07', '2024-08-01 15:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text1` varchar(255) DEFAULT NULL,
  `text2` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `redirect_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `text1`, `text2`, `image`, `redirect_url`, `created_at`, `updated_at`) VALUES
(1, 'Get up to 30% off on your first $150 purchase', 'Do not miss our amazing grocery', 'upload/banner/1807548224658499.jpg', 'contact', NULL, '2024-08-16 11:45:17'),
(2, 'Do not miss our amazing grocery deals', 'Get up to 30% off on your first $150 purchase', 'upload/banner/1807548306229604.jpg', 'about', NULL, '2024-08-16 11:46:35'),
(3, 'Get up to 30% off on your first $150 purchase', 'Do not miss our amazing grocery deals', 'upload/banner/1807548350510521.jpg', 'register', NULL, '2024-08-16 11:47:18');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `isdelete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `category_id`, `status`, `isdelete`, `created_at`, `updated_at`) VALUES
(1, 'Nescafe', 1, 0, 0, '2024-08-27 17:13:10', '2024-08-27 17:13:10'),
(2, 'Shoes', 2, 0, 0, '2024-08-28 19:56:16', '2024-08-28 19:56:16'),
(3, 'Smartphones', 3, 0, 0, '2024-08-28 19:58:35', '2024-08-28 19:58:35'),
(4, 'Headsets', 3, 0, 0, '2024-08-28 19:58:56', '2024-08-28 19:58:56'),
(5, 'Bags', 2, 0, 0, '2024-09-03 09:36:19', '2024-09-03 09:36:19'),
(6, 'Clothings', 2, 0, 0, '2024-09-03 09:41:24', '2024-09-03 09:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `support_brands`
--

CREATE TABLE `support_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_brands`
--

INSERT INTO `support_brands` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'upload/brands/1807556301597549.png', NULL, '2024-08-16 13:53:40'),
(2, 'upload/brands/1807556351790420.png', NULL, '2024-08-16 13:54:28'),
(3, 'upload/brands/1807556369568983.png', NULL, '2024-08-16 13:54:45'),
(4, 'upload/brands/1807556403409476.png', NULL, '2024-08-16 13:55:17'),
(5, 'upload/brands/1807556450731801.png', NULL, '2024-08-16 13:56:02'),
(6, 'upload/brands/1807556491016693.png', NULL, '2024-08-16 13:56:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `profile_image` text DEFAULT NULL,
  `isdelete` tinyint(4) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `firstname`, `lastname`, `country`, `address1`, `address2`, `city`, `state`, `postcode`, `phone`, `profile_image`, `isdelete`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'TEST', 'user@test.com', 'Firstname', 'Lastname', 'Nigeria', 'ANy address', 'None', 'Akure', 'Ondo', '101121', '09102678284', NULL, 0, '2024-08-28 14:48:10', '$2y$12$yMI6uoq6TRYcvyUjYsiAsO55TMBRje01TBLhnBqWvEXZUFzKvTwLq', NULL, '2024-08-28 14:46:22', '2024-08-29 09:38:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_wishlists`
--
ALTER TABLE `product_wishlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribers_email_unique` (`email`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_brands`
--
ALTER TABLE `support_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_wishlists`
--
ALTER TABLE `product_wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `support_brands`
--
ALTER TABLE `support_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
