-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2023 at 09:14 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vinixcrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `banner_title` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `order_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `banner`, `banner_title`, `status`, `order_by`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'ring', 'ring', '', '4.jpg', '', 1, 1, 1, 1, NULL, '2023-08-29 11:03:34', '2023-08-29 11:14:49', NULL),
(7, 'earring', 'earring', NULL, NULL, NULL, 1, 2, 1, NULL, NULL, '2023-08-29 11:23:33', '2023-08-29 11:23:33', NULL),
(8, 'pendant', 'pendant', NULL, '3.7mm-hsi2-diamond-white-gold-ring.webp', NULL, 1, 3, 1, NULL, NULL, '2023-08-29 11:24:04', '2023-08-29 11:24:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_types`
--

CREATE TABLE `category_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `banner_title` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_types`
--

INSERT INTO `category_types` (`id`, `name`, `description`, `slug`, `category_id`, `banner`, `banner_title`, `status`, `order_by`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Shop by', '', 'shop-by', 6, 'Artboard_4_997af38f-56f1-410e-86b7-a0498d06e38c.jpg', 'Shop by', 1, 1, 1, 1, NULL, '2023-07-28 11:02:49', '2023-08-29 11:26:22', NULL),
(4, 'shop by diamond', NULL, 'shop-by-diamond', 7, 'Daily-Wear-Ring.webp', 'diamond', 1, 1, 1, 1, NULL, '2023-07-28 11:19:04', '2023-08-29 11:26:31', NULL),
(5, 'shop by style', NULL, 'shop-by-style', 8, 'Daily-Wear-Ring.webp', 'style', 1, 2, 1, 1, NULL, '2023-07-28 11:48:44', '2023-08-29 11:26:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `color_stone_qualities`
--

CREATE TABLE `color_stone_qualities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `color_stone_qualities`
--

INSERT INTO `color_stone_qualities` (`id`, `code`, `description`, `order_by`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Natural', NULL, 1, 1, 1, NULL, NULL, '2023-08-22 12:17:00', '2023-08-22 12:17:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `color_stone_shapes`
--

CREATE TABLE `color_stone_shapes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `color_stone_shapes`
--

INSERT INTO `color_stone_shapes` (`id`, `code`, `description`, `order_by`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Round', NULL, 1, 1, 1, NULL, NULL, '2023-08-22 12:16:34', '2023-08-22 12:16:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile_number` bigint(12) DEFAULT NULL,
  `phone_number` bigint(12) DEFAULT NULL,
  `whatsapp_number` bigint(12) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`id`, `email`, `mobile_number`, `phone_number`, `whatsapp_number`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'sales@gmail.com', 7222222232, 7222222232, 7222222232, 1, 1, NULL, '2023-07-27 10:13:44', '2023-07-31 09:43:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diadond_qualities`
--

CREATE TABLE `diadond_qualities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diadond_qualities`
--

INSERT INTO `diadond_qualities` (`id`, `code`, `description`, `order_by`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'I1-HI', NULL, 1, 1, 1, NULL, NULL, '2023-08-22 12:14:28', '2023-08-22 12:14:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diamond_cuts`
--

CREATE TABLE `diamond_cuts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_cuts`
--

INSERT INTO `diamond_cuts` (`id`, `code`, `description`, `order_by`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'RD Cut', NULL, 1, 1, 1, NULL, NULL, '2023-08-22 12:15:58', '2023-08-22 12:15:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diamond_shapes`
--

CREATE TABLE `diamond_shapes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diamond_shapes`
--

INSERT INTO `diamond_shapes` (`id`, `code`, `description`, `order_by`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Oval', NULL, 1, 1, 1, NULL, NULL, '2023-08-22 12:15:35', '2023-08-22 12:15:35', NULL);

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
-- Table structure for table `featured_collections`
--

CREATE TABLE `featured_collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fc_image` varchar(255) NOT NULL,
  `image_title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `featured_collections`
--

INSERT INTO `featured_collections` (`id`, `fc_image`, `image_title`, `url`, `order_by`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'YHQi3ETloNVC4qQb0fIi.jpg', 'col1', ' http://127.0.0.1:8000/product-front', 3, 1, 1, 1, NULL, '2023-07-26 17:21:34', '2023-07-26 18:11:51', NULL),
(5, 'ypXjiW6veKg8zhvu87bG.jpg', 'col2', 'http://127.0.0.1:8000/product-front', 1, 1, 1, 1, NULL, '2023-07-26 17:23:26', '2023-07-26 18:11:25', NULL),
(6, 'qJvVa1ji9AfYbiueGOYt.jpg', 'col3', 'http://127.0.0.1:8000/product-front', 2, 1, 1, 1, NULL, '2023-07-26 17:39:38', '2023-07-26 18:11:40', NULL),
(7, '7gPcLEWasNqiPLYjlTYb.jpg', 'col4', 'http://127.0.0.1:8000/product-front', 4, 1, 1, NULL, NULL, '2023-07-26 17:45:35', '2023-07-26 17:45:35', NULL),
(8, 'YHQi3ETloNVC4qQb0fIi.jpg', 'col-5', 'fghjk', 5, 1, 1, NULL, NULL, '2023-07-26 17:56:11', '2023-07-26 17:56:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `get_inspireds`
--

CREATE TABLE `get_inspireds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gi_image` varchar(255) NOT NULL,
  `image_title` varchar(255) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `get_inspireds`
--

INSERT INTO `get_inspireds` (`id`, `gi_image`, `image_title`, `heading`, `content`, `url`, `order_by`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'chill2.jpg', 'chill', 'Style Studio', 'Your source for the latest trends, styling tips and inspiration for all things jewelry.', 'http://127.0.0.1:8000/product-front', 1, 1, 1, 1, NULL, '2023-07-26 11:33:34', '2023-07-26 12:19:03', NULL),
(3, 'chill1.jpg', 'chill', 'Jewelry Essentials', 'Your source for the latest trends, styling tips and inspiration for all things jewelry.', 'http://127.0.0.1:8000/product-front', 2, 1, 1, 1, NULL, '2023-07-26 11:50:26', '2023-07-26 12:19:09', NULL),
(4, 'chill3.jpg', 'chill', 'Lab-Created Diamonds', 'Your source for the latest trends, styling tips and inspiration for all things jewelry.', 'http://127.0.0.1:8000/product-front', 3, 1, 1, NULL, NULL, '2023-07-26 11:56:44', '2023-07-26 11:56:44', NULL),
(5, 'chill4.jpg', 'Enjoy', 'Style Studio', 'Your source for the latest trends, styling tips and inspiration for all things jewelry.', 'http://127.0.0.1:8000/product-front', 4, 1, 1, NULL, NULL, '2023-07-26 11:57:49', '2023-07-26 11:57:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `heading_single_banners`
--

CREATE TABLE `heading_single_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `heading_first` varchar(255) DEFAULT NULL,
  `heading_second` varchar(255) DEFAULT NULL,
  `heading_third` varchar(255) DEFAULT NULL,
  `heading_forth` varchar(255) DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `image_title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `heading_single_banners`
--

INSERT INTO `heading_single_banners` (`id`, `heading_first`, `heading_second`, `heading_third`, `heading_forth`, `banner_image`, `image_title`, `url`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Shop by Category', 'WEDDING IDENTITY', 'Get Inspired', 'Featured Collections', 'Artboard_4_997af38f-56f1-410e-86b7-a0498d06e38c.jpg', 'banner', 'http://127.0.0.1:8000/product-front', 1, 1, NULL, '2023-07-28 05:12:27', '2023-07-28 05:39:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hero_banners`
--

CREATE TABLE `hero_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hb_image` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hero_banners`
--

INSERT INTO `hero_banners` (`id`, `hb_image`, `image_path`, `image_title`, `url`, `order_by`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(45, '2.png', NULL, 'banner235', 'http://127.0.0.1:8000/product-front', 1, 1, 1, 1, NULL, '2023-07-26 06:11:20', '2023-07-26 09:00:06', NULL),
(46, '3.png', NULL, 'banner265n6', 'http://127.0.0.1:8000/recently-viewed', 2, 1, 1, 1, NULL, '2023-07-26 06:16:35', '2023-07-27 05:59:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kitcos`
--

CREATE TABLE `kitcos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `metal_type_id` varchar(255) NOT NULL,
  `gram` int(11) DEFAULT NULL,
  `rate` decimal(8,2) DEFAULT NULL,
  `kt10` decimal(10,2) DEFAULT NULL,
  `kt14` decimal(10,2) DEFAULT NULL,
  `kt18` decimal(10,2) DEFAULT NULL,
  `kt22` decimal(10,2) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kitcos`
--

INSERT INTO `kitcos` (`id`, `metal_type_id`, `gram`, `rate`, `kt10`, `kt14`, `kt18`, `kt22`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '2', 2, '2.00', '2.00', '2.00', '2.00', '2.00', 1, NULL, NULL, '2023-08-23 10:36:10', '2023-08-23 10:36:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(100) NOT NULL,
  `url` varchar(200) NOT NULL DEFAULT '#',
  `icon` varchar(100) DEFAULT NULL,
  `label` int(11) DEFAULT NULL,
  `label_color` varchar(100) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `text`, `url`, `icon`, `label`, `label_color`, `order_by`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dashboard', '/admin', 'fas fa-tachometer-alt', NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'Tools', '/admin', 'fas fa-cog', NULL, NULL, 3, 1, NULL, NULL, NULL, NULL, NULL),
(3, 'Home Master', '/admin', 'fas fa-home', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Product Master', '/admin', 'fas fa-cart-arrow-down', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `metal_purities`
--

CREATE TABLE `metal_purities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metal_purities`
--

INSERT INTO `metal_purities` (`id`, `code`, `description`, `order_by`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '14kt', NULL, 1, 1, 1, NULL, NULL, '2023-08-22 12:12:13', '2023-08-22 12:12:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `metal_types`
--

CREATE TABLE `metal_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metal_types`
--

INSERT INTO `metal_types` (`id`, `code`, `description`, `order_by`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Gold', NULL, 1, 1, 1, NULL, NULL, '2023-08-22 12:11:25', '2023-08-22 12:11:25', NULL);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_11_112809_add_column_to_users_table', 1),
(6, '2022_10_12_120225_create_roles_table', 1),
(7, '2022_11_27_093627_create_urls_table', 1),
(8, '2022_12_02_054601_create_user_urls_table', 1),
(9, '2023_01_25_162503_create_rooms_table', 1),
(10, '2023_01_25_162656_create_room_users_table', 1),
(11, '2023_01_26_093605_create_menus_table', 1),
(12, '2023_06_12_221529_create_role_user_table', 1),
(13, '2023_06_12_221632_create_role_url_table', 1),
(14, '2023_07_24_160209_create_hero_banners_table', 2),
(15, '2023_07_25_132644_create_shop_by_categories_table', 3),
(16, '2023_07_25_144808_create_wedding_identities_table', 4),
(17, '2023_07_25_153334_create_get_inspireds_table', 5),
(18, '2023_07_25_154722_create_featured_collections_table', 6),
(19, '2023_07_27_143710_create_contact_details_table', 7),
(20, '2023_07_27_222926_create_heading_single_banners_table', 8),
(21, '2023_07_28_115651_create_categories_table', 9),
(22, '2023_07_28_150303_create_category_types_table', 10),
(23, '2023_07_30_113043_create_sub_categories_table', 11),
(24, '2023_07_30_151836_create_subscribes_table', 12),
(25, '2023_08_01_123350_create_social_media_table', 13),
(26, '2023_08_22_110348_create_products_table', 14),
(27, '2023_08_22_113219_create_product_categories_table', 15),
(28, '2023_08_22_113819_create_product_details_table', 16),
(29, '2023_08_22_120413_create_product_images_table', 17),
(30, '2023_08_22_120917_create_product_tags_table', 18),
(31, '2023_08_22_121158_create_product_collections_table', 19),
(32, '2023_08_22_121355_create_product_sizes_table', 20),
(33, '2023_08_22_135644_create_metal_types_table', 21),
(34, '2023_08_22_143005_create_sizes_table', 22),
(35, '2023_08_22_144622_create_metal_purities_table', 23),
(36, '2023_08_22_154302_create_diadond_qualities_table', 24),
(37, '2023_08_22_163349_create_diamond_shapes_table', 25),
(38, '2023_08_22_164248_create_diamond_cuts_table', 26),
(39, '2023_08_22_165144_create_color_stone_shapes_table', 27),
(40, '2023_08_22_172033_create_color_stone_qualities_table', 28),
(41, '2023_08_23_143743_create_kitcos_table', 29);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `short_desc` text NOT NULL,
  `long_desc` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_header_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_collections`
--

CREATE TABLE `product_collections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `collection_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `material_type_id` bigint(20) UNSIGNED NOT NULL,
  `quality_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `shape_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `setting_id` int(11) NOT NULL,
  `weight` decimal(12,3) NOT NULL,
  `qty` int(11) NOT NULL,
  `stone_name_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `metal_color_id` bigint(20) UNSIGNED NOT NULL,
  `is_video` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_size_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `is_default` varchar(11) NOT NULL DEFAULT 'Yes',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_desc` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `role_desc`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'Super Admin', NULL, NULL, NULL, '2023-06-12 17:56:52', '2023-06-12 17:56:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_url`
--

CREATE TABLE `role_url` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `url_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_url`
--

INSERT INTO `role_url` (`id`, `role_id`, `url_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 6, 1, 1, NULL, '2023-07-24 08:46:27', '2023-07-24 09:57:33', NULL),
(7, 1, 7, 1, NULL, NULL, '2023-07-25 07:44:19', '2023-07-25 07:44:19', NULL),
(8, 1, 8, 1, NULL, NULL, '2023-07-25 09:26:39', '2023-07-25 09:26:39', NULL),
(9, 1, 9, 1, NULL, NULL, '2023-07-25 10:06:43', '2023-07-25 10:06:43', NULL),
(10, 1, 10, 1, NULL, NULL, '2023-07-25 10:20:45', '2023-07-25 10:20:45', NULL),
(11, 1, 11, 1, NULL, NULL, '2023-07-27 09:05:02', '2023-07-27 09:05:02', NULL),
(12, 1, 12, 1, NULL, NULL, '2023-07-27 11:00:32', '2023-07-27 11:00:32', NULL),
(13, 1, 13, 1, NULL, NULL, '2023-07-28 06:20:00', '2023-07-28 06:20:00', NULL),
(14, 1, 14, 1, NULL, NULL, '2023-07-28 09:31:23', '2023-07-28 09:31:23', NULL),
(15, 1, 15, 1, NULL, NULL, '2023-07-28 17:20:56', '2023-07-28 17:20:56', NULL),
(16, 1, 16, 1, NULL, NULL, '2023-08-01 07:13:53', '2023-08-01 07:13:53', NULL),
(17, 1, 17, 1, NULL, NULL, '2023-08-14 06:55:42', '2023-08-14 06:55:42', NULL),
(18, 1, 18, 1, NULL, NULL, '2023-08-22 07:50:11', '2023-08-22 07:50:11', NULL),
(19, 1, 19, 1, NULL, NULL, '2023-08-22 08:07:13', '2023-08-22 08:07:13', NULL),
(20, 1, 20, 1, NULL, NULL, '2023-08-22 09:19:30', '2023-08-22 09:19:30', NULL),
(22, 1, 22, 1, NULL, NULL, '2023-08-22 10:47:54', '2023-08-22 10:47:54', NULL),
(23, 1, 23, 1, NULL, NULL, '2023-08-22 11:06:09', '2023-08-22 11:06:09', NULL),
(24, 1, 24, 1, NULL, NULL, '2023-08-22 11:15:13', '2023-08-22 11:15:13', NULL),
(25, 1, 25, 1, NULL, NULL, '2023-08-22 11:35:42', '2023-08-22 11:35:42', NULL),
(26, 1, 26, 1, NULL, NULL, '2023-08-22 11:55:20', '2023-08-22 11:55:20', NULL),
(27, 1, 27, 1, NULL, NULL, '2023-08-23 09:15:29', '2023-08-23 09:15:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_name_id` bigint(20) UNSIGNED NOT NULL,
  `has_group` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_users`
--

CREATE TABLE `room_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_by_categories`
--

CREATE TABLE `shop_by_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sbc_image` varchar(255) NOT NULL,
  `image_title` varchar(255) DEFAULT NULL,
  `button_name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_by_categories`
--

INSERT INTO `shop_by_categories` (`id`, `sbc_image`, `image_title`, `button_name`, `url`, `order_by`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'ring.jpg', 'wqf', 'Ring', 'http://127.0.0.1:8000/product-front', 1, 1, 1, 1, NULL, '2023-07-26 09:29:08', '2023-07-26 09:51:05', NULL),
(5, 'earring.jpg', 'qqf', 'Earring', 'http://127.0.0.1:8000/product-front', 2, 1, 1, 1, NULL, '2023-07-26 09:34:46', '2023-07-26 09:52:20', NULL),
(6, 'Bracelet.jpg', 'bracelet', 'Bracelet', 'http://127.0.0.1:8000/product-front', 3, 1, 1, NULL, NULL, '2023-07-26 09:53:05', '2023-07-26 09:53:05', NULL),
(7, 'necklace.jpg', 'Necklace', 'Necklace', 'http://127.0.0.1:8000/product-front', 4, 1, 1, NULL, NULL, '2023-07-26 09:53:51', '2023-07-26 09:53:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `code`, `description`, `order_by`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '7', NULL, 1, NULL, 1, NULL, NULL, '2023-08-22 12:10:41', '2023-08-22 12:10:41', NULL),
(3, '7.5', NULL, 2, NULL, 1, NULL, NULL, '2023-08-22 12:11:06', '2023-08-22 12:11:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `order_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `name`, `icon`, `link`, `status`, `order_by`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'facebook', 'fa-brands fa-facebook', 'https://www.facebook.com/', 1, 1, 1, 1, NULL, '2023-08-01 07:35:56', '2023-08-01 07:58:16', NULL),
(2, 'twitter', 'fa-brands fa-twitter', 'twitter', 1, 2, 1, 1, NULL, '2023-08-01 07:57:47', '2023-08-01 07:58:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

CREATE TABLE `subscribes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribes`
--

INSERT INTO `subscribes` (`id`, `email`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'prajakta.yamgar@kamaschachter.com', 'subscribe', NULL, NULL, NULL, '2023-07-30 11:24:27', '2023-07-30 11:24:27', NULL),
(4, 'mantosh@gmail.com', 'subscribe', NULL, NULL, NULL, '2023-07-31 08:38:49', '2023-07-31 08:38:49', NULL),
(20, 'developerpradeep845@gmail.com', 'subscribe', NULL, NULL, NULL, '2023-08-04 10:13:33', '2023-08-07 13:04:06', NULL),
(22, 'sachinghorpade654@gmail.com', 'unsubscribe', NULL, NULL, NULL, '2023-08-04 10:22:10', '2023-08-04 10:24:27', NULL),
(23, 'developer@oriflammeitsolutions.com', 'subscribe', NULL, NULL, NULL, '2023-08-07 13:04:46', '2023-08-07 13:04:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `categorytype_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `banner_title` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `order_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `category_id`, `categorytype_id`, `description`, `banner`, `banner_title`, `status`, `order_by`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'new ring', 'new-ring', 6, 3, NULL, NULL, NULL, 1, 1, 1, 1, NULL, '2023-07-30 09:26:03', '2023-08-29 11:26:54', NULL),
(5, 'new earring', 'new-earring', 7, 4, NULL, NULL, NULL, 1, 1, 1, 1, NULL, '2023-07-30 09:26:29', '2023-08-29 11:27:02', NULL),
(6, 'Diamond ring', 'diamond-ring', 8, 5, NULL, NULL, NULL, 1, 2, 1, 1, NULL, '2023-07-31 11:35:43', '2023-08-29 11:27:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `urls`
--

CREATE TABLE `urls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `label` int(11) DEFAULT NULL,
  `label_color` varchar(50) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `urls`
--

INSERT INTO `urls` (`id`, `text`, `url`, `icon`, `label`, `label_color`, `order_by`, `menu_id`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Menu', 'master/menu', 'far fa-dot-circle', NULL, NULL, 1, 2, 1, 1, NULL, NULL, '2023-06-12 18:41:18', NULL),
(2, 'Urls', 'master/urls', 'far fa-dot-circle', NULL, NULL, 2, 2, 1, NULL, NULL, NULL, NULL, NULL),
(3, 'RoleMapUrl', 'master/role-url', 'far fa-dot-circle', NULL, NULL, 3, 2, 1, NULL, NULL, NULL, NULL, NULL),
(4, 'RoleMapUser', 'master/role-user', 'far fa-dot-circle', NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL),
(5, 'User', 'master/user', 'far fa-dot-circle', NULL, NULL, 4, 2, 1, NULL, NULL, NULL, NULL, NULL),
(6, 'Hero Banner', 'master/herobanner', 'far fa-dot-circle', NULL, NULL, 1, 3, 1, 1, NULL, '2023-07-24 08:42:29', '2023-07-24 09:58:50', NULL),
(7, 'Shop By Category', 'master/shop-by-category', 'far fa-dot-circle', NULL, NULL, 2, 3, 1, NULL, NULL, '2023-07-25 07:43:54', '2023-07-25 07:43:54', NULL),
(8, 'Wedding Identity', 'master/wedding-identity', 'far fa-dot-circle', NULL, NULL, 3, 3, 1, NULL, NULL, '2023-07-25 09:26:22', '2023-07-25 09:26:22', NULL),
(9, 'Get Inspired', 'master/get-inspired', ' far fa-dot-circle	', NULL, NULL, 4, 3, 1, 1, NULL, '2023-07-25 10:06:19', '2023-07-25 10:07:11', NULL),
(10, 'Featured Collections', 'master/featured-collections', 'far fa-dot-circle', NULL, NULL, 5, 3, 1, NULL, NULL, '2023-07-25 10:20:19', '2023-07-25 10:20:19', NULL),
(11, 'Contact Details', 'master/contact-details', 'far fa-dot-circle	', NULL, NULL, 6, 3, 1, 1, NULL, '2023-07-27 09:04:02', '2023-07-27 09:04:25', NULL),
(12, 'Headings & Single Banner', 'master/heading-single-banner', 'far fa-dot-circle', NULL, NULL, 7, 3, 1, 1, NULL, '2023-07-27 11:00:19', '2023-07-27 11:01:59', NULL),
(13, 'Category', 'master/category', 'far fa-dot-circle', NULL, NULL, 8, 4, 1, NULL, NULL, '2023-07-28 06:19:32', '2023-07-28 06:19:32', NULL),
(14, 'Category Type', 'master/category-type', 'far fa-dot-circle', NULL, NULL, 2, 4, 1, 1, NULL, '2023-07-28 09:31:07', '2023-07-28 09:32:18', NULL),
(15, 'Subcategory', 'master/sub-category', 'far fa-dot-circle', NULL, NULL, 3, 4, 1, NULL, NULL, '2023-07-28 17:20:26', '2023-07-28 17:20:26', NULL),
(16, 'Socail Media', 'master/social-media', 'far fa-dot-circle', NULL, NULL, 8, 3, 1, 1, NULL, '2023-08-01 07:13:24', '2023-08-01 07:14:37', NULL),
(17, 'Products', 'master/product', 'far fa-dot-circle', NULL, NULL, 4, 4, 1, 1, NULL, '2023-08-14 06:54:03', '2023-08-14 06:58:38', NULL),
(18, 'Size', 'master/size', 'far fa-dot-circle', NULL, NULL, 5, 4, 1, 1, NULL, '2023-08-22 07:49:43', '2023-08-22 10:04:21', NULL),
(19, 'Metals', 'master/metal', 'far fa-dot-circle', NULL, NULL, 6, 4, 1, 1, NULL, '2023-08-22 08:06:34', '2023-08-22 10:04:02', NULL),
(20, 'Metal Purity', 'master/metal-purity', 'far fa-dot-circle', NULL, NULL, 7, 4, 1, 1, NULL, '2023-08-22 09:19:13', '2023-08-22 10:03:54', NULL),
(22, 'Diamond Quality', 'master/diamond-quality', 'far fa-dot-circle', NULL, NULL, 8, 4, 1, 1, NULL, '2023-08-22 10:47:21', '2023-08-22 11:00:26', NULL),
(23, 'Diamond Shape', 'master/diamond-shape', 'far fa-dot-circle', NULL, NULL, 9, 4, 1, NULL, NULL, '2023-08-22 11:05:54', '2023-08-22 11:05:54', NULL),
(24, 'Diamond Cuts', 'master/diamond-cut', 'far fa-dot-circle', NULL, NULL, 10, 4, 1, NULL, NULL, '2023-08-22 11:14:52', '2023-08-22 11:14:52', NULL),
(25, 'Color Stone Shapes', 'master/color-stone-shape', 'far fa-dot-circle', NULL, NULL, 11, 4, 1, 1, NULL, '2023-08-22 11:35:21', '2023-08-22 11:35:56', NULL),
(26, 'Color Stone Quality', 'master/color-stone-quality', 'far fa-dot-circle', NULL, NULL, 12, 4, 1, NULL, NULL, '2023-08-22 11:54:57', '2023-08-22 11:54:57', NULL),
(27, 'Kitcos', 'master/kitco', 'far fa-dot-circle', NULL, NULL, 13, 4, 1, 1, NULL, '2023-08-23 09:14:28', '2023-08-23 09:14:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mantosh Nishad', 'mantosh@gmail.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, '2023-06-12 17:56:52', '2023-06-12 17:56:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_urls`
--

CREATE TABLE `user_urls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `url_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wedding_identities`
--

CREATE TABLE `wedding_identities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wi_image` varchar(255) NOT NULL,
  `image_title` varchar(255) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wedding_identities`
--

INSERT INTO `wedding_identities` (`id`, `wi_image`, `image_title`, `heading`, `content`, `url`, `order_by`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'chill4.jpg', 'Chill', 'Jewelry Essentials', 'Your source for the latest trends, styling tips and inspiration for                               all things jewelry.', 'http://127.0.0.1:8000/product-front', 1, 1, 1, 1, NULL, '2023-07-26 10:52:18', '2023-07-26 12:18:31', NULL),
(7, 'chill2.jpg', 'WQQF', 'Lab-Created Diamonds', 'Your source for the latest trends, styling tips and inspiration for                               all things jewelry.', 'http://127.0.0.1:8000/product-front', 2, 1, 1, 1, NULL, '2023-07-26 10:53:46', '2023-07-26 12:18:36', NULL),
(8, 'chill1.jpg', 'Enjoy', 'Jewelry Essentials', 'Your source for the latest trends, styling tips and inspiration', 'http://127.0.0.1:8000/admin/master/wedding-identity', 3, 1, 1, 1, NULL, '2023-07-26 10:59:11', '2023-08-05 15:48:15', NULL),
(9, 'chill3.jpg', 'chill', 'Lab-Created Diamonds', 'Your source for the latest trends, styling tips and inspiration for                               all things jewelry.', 'http://127.0.0.1:8000/product-front', 4, 1, 1, 1, NULL, '2023-07-26 11:03:57', '2023-07-26 12:18:47', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_types`
--
ALTER TABLE `category_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color_stone_qualities`
--
ALTER TABLE `color_stone_qualities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color_stone_shapes`
--
ALTER TABLE `color_stone_shapes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diadond_qualities`
--
ALTER TABLE `diadond_qualities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diamond_cuts`
--
ALTER TABLE `diamond_cuts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diamond_shapes`
--
ALTER TABLE `diamond_shapes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `featured_collections`
--
ALTER TABLE `featured_collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `get_inspireds`
--
ALTER TABLE `get_inspireds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `heading_single_banners`
--
ALTER TABLE `heading_single_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hero_banners`
--
ALTER TABLE `hero_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kitcos`
--
ALTER TABLE `kitcos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metal_purities`
--
ALTER TABLE `metal_purities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metal_types`
--
ALTER TABLE `metal_types`
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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_collections`
--
ALTER TABLE `product_collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_url`
--
ALTER TABLE `role_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_users`
--
ALTER TABLE `room_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_by_categories`
--
ALTER TABLE `shop_by_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_urls`
--
ALTER TABLE `user_urls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wedding_identities`
--
ALTER TABLE `wedding_identities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category_types`
--
ALTER TABLE `category_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `color_stone_qualities`
--
ALTER TABLE `color_stone_qualities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `color_stone_shapes`
--
ALTER TABLE `color_stone_shapes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `diadond_qualities`
--
ALTER TABLE `diadond_qualities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `diamond_cuts`
--
ALTER TABLE `diamond_cuts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `diamond_shapes`
--
ALTER TABLE `diamond_shapes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `featured_collections`
--
ALTER TABLE `featured_collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `get_inspireds`
--
ALTER TABLE `get_inspireds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `heading_single_banners`
--
ALTER TABLE `heading_single_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hero_banners`
--
ALTER TABLE `hero_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `kitcos`
--
ALTER TABLE `kitcos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `metal_purities`
--
ALTER TABLE `metal_purities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `metal_types`
--
ALTER TABLE `metal_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_collections`
--
ALTER TABLE `product_collections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_url`
--
ALTER TABLE `role_url`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_users`
--
ALTER TABLE `room_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_by_categories`
--
ALTER TABLE `shop_by_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscribes`
--
ALTER TABLE `subscribes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `urls`
--
ALTER TABLE `urls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_urls`
--
ALTER TABLE `user_urls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wedding_identities`
--
ALTER TABLE `wedding_identities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
