-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2023 at 07:33 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jewels1`
--

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `mattype_id` int(11) UNSIGNED DEFAULT NULL,
  `mettyp_id` int(11) UNSIGNED DEFAULT NULL,
  `metpur_id` int(11) UNSIGNED DEFAULT NULL,
  `metcol_id` int(11) UNSIGNED DEFAULT NULL,
  `metform_id` int(11) UNSIGNED DEFAULT NULL,
  `ispointer` varchar(1) DEFAULT 'X',
  `diastntype_id` int(11) UNSIGNED DEFAULT NULL,
  `diastnshape_id` int(11) UNSIGNED DEFAULT NULL,
  `diastnqlty_id` int(11) UNSIGNED DEFAULT NULL,
  `diastncolor_id` int(11) UNSIGNED DEFAULT NULL,
  `diastnsize_id` int(11) UNSIGNED DEFAULT NULL,
  `diastnsizegroup_id` int(11) UNSIGNED DEFAULT NULL,
  `csstntype_id` int(11) UNSIGNED DEFAULT NULL,
  `csstnshape_id` int(11) UNSIGNED DEFAULT NULL,
  `csstnname_id` int(11) UNSIGNED DEFAULT NULL,
  `csstnqlty_id` int(11) UNSIGNED DEFAULT NULL,
  `csstncolor_id` int(11) UNSIGNED DEFAULT NULL,
  `csstnsize_id` int(11) UNSIGNED DEFAULT NULL,
  `allkt_id` int(11) UNSIGNED DEFAULT NULL,
  `allfor_id` int(11) UNSIGNED DEFAULT NULL,
  `allcol_id` int(11) UNSIGNED DEFAULT NULL,
  `allctg_id` int(11) UNSIGNED DEFAULT NULL,
  `findctg_id` int(11) UNSIGNED DEFAULT NULL,
  `findsctg_id` int(11) UNSIGNED DEFAULT NULL,
  `findstyle_id` int(11) UNSIGNED DEFAULT NULL,
  `findsize_id` int(11) UNSIGNED DEFAULT NULL,
  `avg_wt` decimal(12,4) DEFAULT 0.0000,
  `primary_uom_id` int(10) UNSIGNED DEFAULT NULL,
  `secondary_uom_id` int(10) UNSIGNED DEFAULT NULL,
  `own_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
