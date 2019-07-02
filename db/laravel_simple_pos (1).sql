-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2018 at 10:09 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_simple_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `lsp_activities`
--

CREATE TABLE `lsp_activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `activity_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lsp_customers`
--

CREATE TABLE `lsp_customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_invoice_no` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_customers`
--

INSERT INTO `lsp_customers` (`id`, `name`, `address`, `phone`, `email`, `last_invoice_no`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Rakib', '', '', '', 0, 0, 0, 0, '2018-02-14 13:33:32', '2018-02-14 13:33:32', NULL),
(2, 'Brand Custom-S', 'Brand Custom-S', 'Brand Custom-S', 'Brand Custom-S', 0, 0, 0, 0, '2018-02-14 13:39:26', '2018-02-14 13:39:26', NULL),
(3, 'Brand Custom-S', 'asdas', '01860748020', 'f.bhuyian@gmail.com', 0, 0, 0, 0, '2018-02-14 13:42:17', '2018-02-14 13:42:17', NULL),
(4, 'Fahad Bhuyian', 'asdas', '01860748020', 'mdmahamodurzaman@gmail.com', 0, 13, 1, 1, '2018-02-14 14:05:02', '2018-02-14 15:57:29', '2018-02-14 15:57:29'),
(5, 'Brand Custom-S', 'asdas', '01860748020', 'fakhrul@gmail.com', 0, 13, 1, 1, '2018-02-14 14:32:57', '2018-02-15 14:30:13', NULL),
(6, 'Wireless Geeks', '15011 E. 8 Mile Rd', '5863334005', 'na@na', 0, 13, 1, 0, '2018-02-15 14:26:49', '2018-02-15 14:26:49', NULL),
(7, 'Wireless Geeks', '15011 E. 8 Mile Rd', '5863334405', 'quote@geekbuyback.com', 0, 13, 1, 0, '2018-02-15 14:27:38', '2018-02-15 14:27:38', NULL),
(8, 'iGeek Eastpointe', '15011 E. 8 Mile Rd', '111111111', 'sales@igeekrepaircenter.com', 0, 13, 1, 0, '2018-02-15 14:29:49', '2018-02-15 14:29:49', NULL),
(9, 'Rami Sprint', '29920 Southfield Rd.', '2485359679', 'pcs727@mypcsexperts.com', 0, 13, 1, 0, '2018-02-15 14:31:22', '2018-02-15 14:31:22', NULL),
(10, 'iGeek Southfield', '28935 Southfield Rd.', '5867468101', 'none@none.com', 0, 13, 1, 0, '2018-02-15 14:32:16', '2018-02-15 14:32:16', NULL),
(11, 'iGeek Toledo', '123 Street', '11111', 'Na@Na.com', 0, 13, 1, 0, '2018-02-15 14:34:17', '2018-02-15 14:34:17', NULL),
(12, 'Marlon B. JR', '16810 Steel St. Detroit, Mi 48235', '2485250011', 'itechheroesllc@gmail.com', 0, 13, 1, 0, '2018-02-15 14:35:36', '2018-02-15 14:35:36', NULL),
(13, 'Eddie Abro', '7 Van Dyke', '2485613838', 'metropcs@gmail.com', 0, 13, 1, 0, '2018-02-15 15:23:43', '2018-02-15 15:23:43', NULL),
(14, 'Marcella Zoma', '123 Street', '11111111', 'Na@Na', 0, 13, 1, 0, '2018-02-15 15:29:16', '2018-02-15 15:29:16', NULL),
(15, 'Mazba', '123 Street', '111111111', 'Na@na', 0, 13, 1, 0, '2018-02-15 15:30:04', '2018-02-15 15:30:04', NULL),
(16, 'Platinum Wireless', '13 and hoover', '1111', 'na@na', 0, 13, 1, 0, '2018-02-15 15:31:02', '2018-02-15 15:31:02', NULL),
(17, 'Platinum Wireless', 'na', '111111', 'Na@Na', 0, 13, 1, 0, '2018-02-15 15:32:03', '2018-02-15 15:32:03', NULL),
(18, 'Laith Metro PCS', '8000 w outer dr', '5867473930', 'Laith@na.com', 0, 13, 1, 0, '2018-02-15 15:33:00', '2018-02-15 15:33:00', NULL),
(19, 'Brian Phone Resque', 'Na', '11111', 'na@na', 0, 13, 1, 0, '2018-02-15 15:34:11', '2018-02-15 15:34:11', NULL),
(20, 'Mazba', 'Na', '23454345345', 'na@na', 0, 13, 1, 0, '2018-02-15 15:35:25', '2018-02-15 15:35:25', NULL),
(21, 'Geek BuyBack', '1820 E 11 Mile Rd', '2488407003', 'quote@geekbuyback.com', 0, 13, 1, 0, '2018-02-15 15:36:45', '2018-02-15 15:36:45', NULL),
(22, 'Geek BuyBack', 'Na', '1111111', 'na@na', 0, 13, 1, 0, '2018-02-15 15:37:50', '2018-02-15 15:37:50', NULL),
(23, 'Laith Metro-PCS', '8000 w outer dr', '2484167746', 'metropcs@gmail.com', 0, 13, 1, 0, '2018-02-15 15:38:50', '2018-02-15 15:38:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_invoices`
--

CREATE TABLE `lsp_invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tender_id` int(11) NOT NULL,
  `total_amount` float(10,2) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_invoices`
--

INSERT INTO `lsp_invoices` (`id`, `invoice_id`, `customer_id`, `tender_id`, `total_amount`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1518800639, 6, 6, 0.00, 13, 1, 0, '2018-02-16 11:03:59', '2018-02-16 12:50:36', '2018-02-16 12:50:36'),
(2, 1518802217, 6, 6, 0.00, 13, 1, 0, '2018-02-16 11:30:17', '2018-02-16 12:51:00', '2018-02-16 12:51:00'),
(3, 1518802273, 6, 6, 0.00, 13, 1, 0, '2018-02-16 11:31:13', '2018-02-16 12:51:18', '2018-02-16 12:51:18'),
(4, 1518806346, 6, 6, 130.00, 13, 1, 0, '2018-02-16 12:39:06', '2018-02-16 12:51:37', '2018-02-16 12:51:37'),
(5, 1518807226, 12, 6, 46.00, 13, 1, 1, '2018-02-16 12:53:47', '2018-02-16 16:13:55', NULL),
(6, 1518819408, 7, 6, 15.00, 13, 1, 0, '2018-02-16 16:16:48', '2018-02-16 16:16:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_invoice_payments`
--

CREATE TABLE `lsp_invoice_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tender_id` int(11) NOT NULL,
  `total_amount` double(8,2) NOT NULL,
  `paid_amount` double(8,2) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lsp_invoice_products`
--

CREATE TABLE `lsp_invoice_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `cost` double(8,2) NOT NULL,
  `tax_percent` double(8,2) NOT NULL,
  `tax_amount` double(8,2) NOT NULL,
  `discount_percent` double(8,2) NOT NULL,
  `discount_amount` double(8,2) NOT NULL,
  `cupon_amount` double(8,2) NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `total_cost` double(8,2) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_invoice_products`
--

INSERT INTO `lsp_invoice_products` (`id`, `invoice_id`, `product_id`, `quantity`, `price`, `cost`, `tax_percent`, `tax_amount`, `discount_percent`, `discount_amount`, `cupon_amount`, `total_price`, `total_cost`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1518802273, 22, 4, 14.00, 9.00, 0.00, 0.00, 0.00, 0.00, 0.00, 56.00, 36.00, 13, 1, 0, '2018-02-16 11:31:13', '2018-02-16 12:51:18', '2018-02-16 12:51:18'),
(2, 1518802273, 28, 4, 47.00, 42.00, 0.00, 0.00, 0.00, 0.00, 0.00, 188.00, 168.00, 13, 1, 0, '2018-02-16 11:31:13', '2018-02-16 12:51:18', '2018-02-16 12:51:18'),
(3, 1518802273, 25, 4, 45.00, 40.00, 0.00, 0.00, 0.00, 0.00, 0.00, 180.00, 160.00, 13, 1, 0, '2018-02-16 11:31:13', '2018-02-16 12:51:18', '2018-02-16 12:51:18'),
(4, 1518806346, 8, 1, 14.00, 9.00, 0.00, 0.00, 0.00, 0.00, 0.00, 14.00, 9.00, 13, 1, 0, '2018-02-16 12:39:06', '2018-02-16 12:51:37', '2018-02-16 12:51:37'),
(5, 1518806346, 15, 1, 22.00, 22.00, 0.00, 0.00, 0.00, 0.00, 0.00, 22.00, 22.00, 13, 1, 0, '2018-02-16 12:39:06', '2018-02-16 12:51:37', '2018-02-16 12:51:37'),
(6, 1518806346, 27, 1, 47.00, 42.00, 0.00, 0.00, 0.00, 0.00, 0.00, 47.00, 42.00, 13, 1, 0, '2018-02-16 12:39:06', '2018-02-16 12:51:37', '2018-02-16 12:51:37'),
(7, 1518806346, 27, 1, 47.00, 42.00, 0.00, 0.00, 0.00, 0.00, 0.00, 47.00, 42.00, 13, 1, 0, '2018-02-16 12:39:06', '2018-02-16 12:51:37', '2018-02-16 12:51:37'),
(8, 1518807226, 7, 1, 12.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 12.00, 10.00, 13, 1, 0, '2018-02-16 12:53:46', '2018-02-16 16:11:44', '2018-02-16 16:11:44'),
(9, 1518807226, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-02-16 12:53:47', '2018-02-16 16:11:44', '2018-02-16 16:11:44'),
(10, 1518807226, 12, 1, 19.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 19.00, 12.00, 13, 1, 0, '2018-02-16 12:53:47', '2018-02-16 16:11:44', '2018-02-16 16:11:44'),
(11, 1518807226, 7, 1, 12.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 12.00, 10.00, 13, 1, 0, '2018-02-16 16:11:44', '2018-02-16 16:13:54', '2018-02-16 16:13:54'),
(12, 1518807226, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-02-16 16:11:44', '2018-02-16 16:13:54', '2018-02-16 16:13:54'),
(13, 1518807226, 12, 1, 19.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 19.00, 12.00, 13, 1, 0, '2018-02-16 16:11:44', '2018-02-16 16:13:54', '2018-02-16 16:13:54'),
(14, 1518807226, 7, 1, 12.00, 10.00, 0.00, 0.00, 0.00, 0.00, 0.00, 12.00, 10.00, 13, 1, 0, '2018-02-16 16:13:54', '2018-02-16 16:13:54', NULL),
(15, 1518807226, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-02-16 16:13:54', '2018-02-16 16:13:54', NULL),
(16, 1518807226, 12, 1, 19.00, 12.00, 0.00, 0.00, 0.00, 0.00, 0.00, 19.00, 12.00, 13, 1, 0, '2018-02-16 16:13:54', '2018-02-16 16:13:54', NULL),
(17, 1518819408, 6, 1, 15.00, 11.25, 0.00, 0.00, 0.00, 0.00, 0.00, 15.00, 11.25, 13, 1, 0, '2018-02-16 16:16:48', '2018-02-16 16:16:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_invoice_profits`
--

CREATE TABLE `lsp_invoice_profits` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `invoice_datetime` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_total_amount` double(8,2) NOT NULL,
  `invoice_cost_total_amount` double(8,2) NOT NULL,
  `profit` double(8,2) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lsp_migrations`
--

CREATE TABLE `lsp_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_migrations`
--

INSERT INTO `lsp_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(14, '2018_02_14_165142_create_customers_table', 2),
(15, '2018_02_14_165308_create_products_table', 2),
(16, '2018_02_14_165452_create_product_stockins_table', 2),
(17, '2018_02_14_165515_create_invoices_table', 2),
(18, '2018_02_14_165549_create_invoice_products_table', 2),
(19, '2018_02_14_165610_create_invoice_payments_table', 2),
(20, '2018_02_14_165638_create_product_variances_table', 2),
(21, '2018_02_14_165731_create_product_profits_table', 2),
(22, '2018_02_14_165826_create_product_variance_datas_table', 2),
(23, '2018_02_14_165848_create_tenders_table', 2),
(24, '2018_02_14_172725_create_activities_table', 2),
(25, '2018_02_14_184104_create_invoice_profits_table', 2),
(26, '2018_02_17_182452_create_product_stockin_invoices_table', 3),
(27, '2018_02_25_204411_create_warranties_table', 4),
(28, '2018_02_28_182342_create_warranty_products_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_password_resets`
--

CREATE TABLE `lsp_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lsp_products`
--

CREATE TABLE `lsp_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `cost` double(8,2) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_products`
--

INSERT INTO `lsp_products` (`id`, `name`, `quantity`, `price`, `cost`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Brand Custom-S', 5, 1.22, 1.00, 13, 1, 1, '2018-02-14 16:38:59', '2018-02-14 16:43:06', NULL),
(2, 'Amit 2.5 GB', 2, 2.45, 1.25, 13, 1, 0, '2018-02-14 16:41:07', '2018-02-14 16:43:19', '2018-02-14 16:43:19'),
(3, 'Glassware', 10, 100.00, 50.00, 13, 1, 0, '2018-02-14 16:41:50', '2018-02-14 16:41:50', NULL),
(4, 'iPhone 5 LCD White - Premium', 37, 19.00, 12.00, 13, 1, 0, '2018-02-15 13:26:40', '2018-02-15 13:26:40', NULL),
(5, 'iPhone 6S Plus LCD Black - Premium', 220, 38.00, 33.00, 13, 1, 0, '2018-02-15 13:28:39', '2018-02-15 13:28:39', NULL),
(6, 'Small Parts', 9, 15.00, 11.25, 13, 1, 0, '2018-02-15 13:30:13', '2018-02-15 13:30:13', NULL),
(7, 'Battery', 0, 12.00, 10.00, 13, 1, 0, '2018-02-15 13:40:44', '2018-02-15 13:40:44', NULL),
(8, 'iPad 2 Digi', 11, 14.00, 9.00, 13, 1, 0, '2018-02-15 13:41:38', '2018-02-15 13:41:38', NULL),
(9, 'iPhone 6S Plus LCD White - Premium', 312, 38.00, 33.00, 13, 1, 0, '2018-02-15 13:42:48', '2018-02-15 13:42:48', NULL),
(10, 'iPhone 6S LCD White - Premium', 414, 32.00, 27.00, 13, 1, 0, '2018-02-15 13:44:11', '2018-02-15 13:44:11', NULL),
(11, 'iPhone 6S LCD Black - Premium', 340, 32.00, 27.00, 13, 1, 0, '2018-02-15 13:48:46', '2018-02-15 13:48:46', NULL),
(12, 'Phone 5 LCD Black - Premium', 29, 19.00, 12.00, 13, 1, 0, '2018-02-15 13:50:07', '2018-02-15 13:50:07', NULL),
(13, 'iPhone 5C LCD Black - Premium', 101, 19.00, 12.00, 13, 1, 0, '2018-02-15 13:52:01', '2018-02-15 13:52:01', NULL),
(14, 'iPhone 5SE LCD White - Premium', 171, 22.00, 22.00, 13, 1, 0, '2018-02-15 13:53:48', '2018-02-15 13:53:48', NULL),
(15, 'iPhone 5SE LCD Black - Premium', 164, 22.00, 22.00, 13, 1, 0, '2018-02-15 13:55:26', '2018-02-15 13:55:26', NULL),
(16, 'iPhone 6 LCD White - Premium', 510, 23.00, 18.00, 13, 1, 0, '2018-02-15 13:56:59', '2018-02-15 13:56:59', NULL),
(17, 'iPhone 6 LCD Black - Premium', 478, 23.00, 18.00, 13, 1, 0, '2018-02-15 13:58:07', '2018-02-15 13:58:07', NULL),
(18, 'iPhone 6 Plus LCD Black - Premium', 206, 26.00, 21.00, 13, 1, 0, '2018-02-15 13:59:25', '2018-02-15 13:59:25', NULL),
(19, 'iPhone 6 Plus LCD White - Premium', 223, 26.00, 21.00, 13, 1, 0, '2018-02-15 14:01:25', '2018-02-15 14:01:25', NULL),
(20, 'iPad Air Digi', 8, 19.00, 14.00, 13, 1, 0, '2018-02-15 14:02:40', '2018-02-15 14:02:40', NULL),
(21, 'iPad Mini 1 Digi', 5, 26.00, 21.00, 13, 1, 0, '2018-02-15 14:03:54', '2018-02-15 14:03:54', NULL),
(22, 'iPad 3 Digi', 4, 14.00, 9.00, 13, 1, 0, '2018-02-15 14:04:56', '2018-02-15 14:04:56', NULL),
(23, 'Overnight Shipping - Under Minimum Order', 5, 30.00, 30.00, 13, 1, 0, '2018-02-15 14:05:59', '2018-02-15 14:05:59', NULL),
(24, 'Note 4 LCD', 0, 165.00, 155.00, 13, 1, 0, '2018-02-15 14:07:02', '2018-02-15 14:07:02', NULL),
(25, 'iPhone 8 LCD Black - Premium', 1, 45.00, 40.00, 13, 1, 0, '2018-02-15 14:08:01', '2018-02-15 14:08:01', NULL),
(26, 'iPhone 8 LCD White - Premium', 1, 45.00, 40.00, 13, 1, 0, '2018-02-15 14:09:29', '2018-02-15 14:09:29', NULL),
(27, 'iPhone 8 Plus LCD Black - Premium', 1, 47.00, 42.00, 13, 1, 0, '2018-02-15 14:23:00', '2018-02-15 14:23:00', NULL),
(28, 'iPhone 8 Plus LCD White - Premium', 1, 47.00, 42.00, 13, 1, 0, '2018-02-15 14:24:16', '2018-02-15 14:24:16', NULL),
(29, 'Other', 1, 88.00, 95.00, 13, 1, 0, '2018-02-15 14:25:08', '2018-02-15 14:25:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_product_profits`
--

CREATE TABLE `lsp_product_profits` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `invoice_datetime` datetime NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_total_quantity` int(11) NOT NULL,
  `product_total_amount` double(8,2) NOT NULL,
  `product_cost_total_amount` double(8,2) NOT NULL,
  `profit` double(8,2) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lsp_product_stockins`
--

CREATE TABLE `lsp_product_stockins` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_tracking_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `cost` double(8,2) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_product_stockins`
--

INSERT INTO `lsp_product_stockins` (`id`, `order_tracking_id`, `product_id`, `quantity`, `price`, `cost`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '0', 7, 141, 12.00, 10.00, 13, 1, 0, '2018-02-15 13:40:44', '2018-02-15 13:40:44', NULL),
(2, '0', 8, 11, 14.00, 9.00, 13, 1, 0, '2018-02-15 13:41:38', '2018-02-15 13:41:38', NULL),
(3, '0', 9, 312, 38.00, 33.00, 13, 1, 0, '2018-02-15 13:42:48', '2018-02-15 13:42:48', NULL),
(4, '0', 10, 414, 32.00, 27.00, 13, 1, 0, '2018-02-15 13:44:11', '2018-02-15 13:44:11', NULL),
(5, '0', 11, 340, 32.00, 27.00, 13, 1, 0, '2018-02-15 13:48:46', '2018-02-15 13:48:46', NULL),
(6, '0', 12, 29, 19.00, 12.00, 13, 1, 0, '2018-02-15 13:50:07', '2018-02-15 13:50:07', NULL),
(7, '0', 13, 101, 19.00, 12.00, 13, 1, 0, '2018-02-15 13:52:01', '2018-02-15 13:52:01', NULL),
(8, '0', 14, 171, 22.00, 22.00, 13, 1, 0, '2018-02-15 13:53:48', '2018-02-15 13:53:48', NULL),
(9, '0', 15, 164, 22.00, 22.00, 13, 1, 0, '2018-02-15 13:55:26', '2018-02-15 13:55:26', NULL),
(10, '0', 16, 510, 23.00, 18.00, 13, 1, 0, '2018-02-15 13:56:59', '2018-02-15 13:56:59', NULL),
(11, '0', 17, 478, 23.00, 18.00, 13, 1, 0, '2018-02-15 13:58:07', '2018-02-15 13:58:07', NULL),
(12, '0', 18, 206, 26.00, 21.00, 13, 1, 0, '2018-02-15 13:59:25', '2018-02-15 13:59:25', NULL),
(13, '0', 19, 223, 26.00, 21.00, 13, 1, 0, '2018-02-15 14:01:25', '2018-02-15 14:01:25', NULL),
(14, '0', 20, 8, 19.00, 14.00, 13, 1, 0, '2018-02-15 14:02:40', '2018-02-15 14:02:40', NULL),
(15, '0', 21, 5, 26.00, 21.00, 13, 1, 0, '2018-02-15 14:03:54', '2018-02-15 14:03:54', NULL),
(16, '0', 22, 4, 14.00, 9.00, 13, 1, 0, '2018-02-15 14:04:56', '2018-02-15 14:04:56', NULL),
(17, '0', 23, 5, 30.00, 30.00, 13, 1, 0, '2018-02-15 14:05:59', '2018-02-15 14:05:59', NULL),
(18, '0', 24, 0, 165.00, 155.00, 13, 1, 0, '2018-02-15 14:07:02', '2018-02-15 14:07:02', NULL),
(19, '0', 25, 1, 45.00, 40.00, 13, 1, 0, '2018-02-15 14:08:01', '2018-02-15 14:08:01', NULL),
(20, '0', 26, 1, 45.00, 40.00, 13, 1, 0, '2018-02-15 14:09:29', '2018-02-15 14:09:29', NULL),
(21, '0', 6, 1500, 0.00, 0.00, 13, 2, 0, '2018-02-15 14:21:49', '2018-02-15 14:21:49', NULL),
(22, '0', 27, 1, 47.00, 42.00, 13, 1, 0, '2018-02-15 14:23:00', '2018-02-15 14:23:00', NULL),
(23, '0', 28, 1, 47.00, 42.00, 13, 1, 0, '2018-02-15 14:24:16', '2018-02-15 14:24:16', NULL),
(24, '0', 29, 1, 88.00, 95.00, 13, 1, 0, '2018-02-15 14:25:09', '2018-02-15 14:25:09', NULL),
(25, '0', 15, 20000, 0.00, 0.00, 13, 2, 0, '2018-02-15 14:30:06', '2018-02-15 14:30:06', NULL),
(26, '0', 5, 2000, 0.00, 0.00, 13, 2, 0, '2018-02-15 14:31:30', '2018-02-15 14:31:30', NULL),
(27, '0', 3, 3000, 0.00, 0.00, 13, 2, 0, '2018-02-15 14:33:13', '2018-02-15 14:33:13', NULL),
(28, '0', 5, 1500, 0.00, 0.00, 13, 2, 0, '2018-02-15 14:33:55', '2018-02-15 14:33:55', NULL),
(29, '0', 3, 2, 0.00, 0.00, 13, 1, 0, '2018-02-15 14:40:44', '2018-02-15 14:40:44', NULL),
(30, '0', 1, 1, 0.00, 0.00, 13, 1, 0, '2018-02-15 14:42:09', '2018-02-15 14:42:09', NULL),
(31, '0', 1, 1, 0.00, 0.00, 13, 1, 0, '2018-02-16 16:19:06', '2018-02-16 16:19:06', NULL),
(32, '0', 1, 1, 0.00, 0.00, 13, 1, 0, '2018-02-16 16:19:06', '2018-02-16 16:19:06', NULL),
(33, '0', 1, 1, 0.00, 0.00, 13, 1, 0, '2018-02-16 16:19:07', '2018-02-16 16:19:07', NULL),
(34, '1518898843', 1, 1, 1.22, 1.00, 13, 1, 0, '2018-02-17 14:20:43', '2018-02-17 14:20:43', NULL),
(35, '1518898843', 1, 1, 1.22, 1.00, 13, 1, 0, '2018-02-17 14:20:43', '2018-02-17 14:20:43', NULL),
(36, '1518898843', 1, 1, 1.22, 1.00, 13, 1, 0, '2018-02-17 14:20:43', '2018-02-17 14:20:43', NULL),
(37, '1518898975', 1, 1, 1.22, 1.00, 13, 1, 0, '2018-02-17 14:22:55', '2018-02-17 14:46:29', '2018-02-17 14:46:29'),
(38, '1518898975', 1, 1, 1.22, 1.00, 13, 1, 0, '2018-02-17 14:22:55', '2018-02-17 14:46:29', '2018-02-17 14:46:29'),
(39, '1519059040', 1, 1, 1.22, 1.00, 13, 1, 0, '2018-02-19 10:50:40', '2018-02-19 12:21:52', '2018-02-19 12:21:52'),
(40, '1519059040', 1, 2, 1.22, 1.00, 13, 1, 0, '2018-02-19 10:50:40', '2018-02-19 12:21:52', '2018-02-19 12:21:52'),
(41, '1519059040', 1, 1, 1.22, 1.00, 13, 1, 1, '2018-02-19 12:21:52', '2018-02-19 12:24:37', '2018-02-19 12:24:37'),
(42, '1519059040', 1, 2, 1.22, 1.00, 13, 1, 1, '2018-02-19 12:21:52', '2018-02-19 12:24:37', '2018-02-19 12:24:37'),
(43, '1519059040', 1, 11, 1.22, 1.00, 13, 1, 1, '2018-02-19 12:24:37', '2018-02-19 12:45:18', '2018-02-19 12:45:18'),
(44, '1519059040', 1, 2, 1.22, 1.00, 13, 1, 1, '2018-02-19 12:24:37', '2018-02-19 12:45:18', '2018-02-19 12:45:18'),
(45, '1519059040', 1, 11, 1.22, 1.00, 13, 1, 1, '2018-02-19 12:45:18', '2018-02-19 12:45:18', NULL),
(46, '1519059040', 1, 2, 1.22, 1.00, 13, 1, 1, '2018-02-19 12:45:18', '2018-02-19 12:45:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_product_stockin_invoices`
--

CREATE TABLE `lsp_product_stockin_invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_tracking_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `order_date` date NOT NULL,
  `order_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_quantity` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_product_stockin_invoices`
--

INSERT INTO `lsp_product_stockin_invoices` (`id`, `order_tracking_id`, `order_date`, `order_no`, `total_quantity`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1518898843', '2018-01-12', '1', 3, 13, 1, 0, '2018-02-17 14:20:43', '2018-02-17 14:20:43', NULL),
(2, '1518898975', '2018-01-12', '1', 2, 13, 1, 0, '2018-02-17 14:22:55', '2018-02-17 14:46:29', '2018-02-17 14:46:29'),
(3, '1519059040', '2018-01-12', '1', 13, 13, 1, 1, '2018-02-19 10:50:40', '2018-02-19 12:24:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_product_variances`
--

CREATE TABLE `lsp_product_variances` (
  `id` int(10) UNSIGNED NOT NULL,
  `variance_id` int(11) NOT NULL,
  `total_variance_quantity` int(11) NOT NULL DEFAULT '0',
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_product_variances`
--

INSERT INTO `lsp_product_variances` (`id`, `variance_id`, `total_variance_quantity`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1519073836, 5, 13, 1, 0, '2018-02-19 14:57:16', '2018-02-19 14:57:16', NULL),
(2, 1519584479, 12, 13, 1, 0, '2018-02-25 12:47:59', '2018-02-25 12:47:59', NULL),
(3, 1519584535, 14, 13, 1, 0, '2018-02-25 12:48:55', '2018-02-25 12:51:07', '2018-02-25 12:51:07'),
(4, 1519584479, 12, 13, 1, 0, '2018-02-25 14:08:15', '2018-02-25 14:10:57', '2018-02-25 14:10:57'),
(5, 1519584479, 17, 13, 1, 1, '2018-02-25 14:08:26', '2018-02-25 14:10:48', '2018-02-25 14:10:48'),
(6, 1519589526, 9, 13, 1, 1, '2018-02-25 14:12:06', '2018-02-25 14:12:37', NULL),
(7, 1519589647, 18, 13, 1, 1, '2018-02-25 14:14:07', '2018-02-25 14:16:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_product_variance_datas`
--

CREATE TABLE `lsp_product_variance_datas` (
  `id` int(10) UNSIGNED NOT NULL,
  `variance_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_in_system` int(11) NOT NULL,
  `quantity_in_hand` int(11) NOT NULL,
  `variance_quanity` int(11) NOT NULL DEFAULT '0',
  `cost` double(8,2) NOT NULL,
  `variance_cost` double(8,2) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_product_variance_datas`
--

INSERT INTO `lsp_product_variance_datas` (`id`, `variance_id`, `product_id`, `quantity_in_system`, `quantity_in_hand`, `variance_quanity`, `cost`, `variance_cost`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1519073836, 3, 10, 2, 8, 50.00, 100.00, 13, 1, 0, '2018-02-19 14:57:16', '2018-02-25 14:11:32', '2018-02-25 14:11:32'),
(2, 1519073836, 6, 9, 2, 7, 11.25, 22.50, 13, 1, 0, '2018-02-19 14:57:16', '2018-02-25 14:11:32', '2018-02-25 14:11:32'),
(3, 1519073836, 8, 11, 1, 10, 9.00, 9.00, 13, 1, 0, '2018-02-19 14:57:16', '2018-02-25 14:11:32', '2018-02-25 14:11:32'),
(4, 1519584479, 5, 220, 5, 215, 33.00, 165.00, 13, 1, 0, '2018-02-25 12:47:59', '2018-02-25 14:08:15', '2018-02-25 14:08:15'),
(5, 1519584479, 8, 11, 2, 9, 9.00, 18.00, 13, 1, 0, '2018-02-25 12:47:59', '2018-02-25 14:08:15', '2018-02-25 14:08:15'),
(6, 1519584479, 12, 29, 5, 24, 12.00, 60.00, 13, 1, 0, '2018-02-25 12:47:59', '2018-02-25 14:08:15', '2018-02-25 14:08:15'),
(7, 1519584535, 6, 9, 2, 7, 11.25, 22.50, 13, 1, 0, '2018-02-25 12:48:55', '2018-02-25 12:51:07', '2018-02-25 12:51:07'),
(8, 1519584535, 9, 312, 6, 306, 33.00, 198.00, 13, 1, 0, '2018-02-25 12:48:55', '2018-02-25 12:51:07', '2018-02-25 12:51:07'),
(9, 1519584535, 15, 164, 6, 158, 22.00, 132.00, 13, 1, 0, '2018-02-25 12:48:55', '2018-02-25 12:51:07', '2018-02-25 12:51:07'),
(10, 1519584479, 4, 37, 5, 32, 12.00, 60.00, 13, 1, 0, '2018-02-25 14:08:15', '2018-02-25 14:08:25', '2018-02-25 14:08:25'),
(11, 1519584479, 5, 220, 2, 218, 33.00, 66.00, 13, 1, 0, '2018-02-25 14:08:15', '2018-02-25 14:08:25', '2018-02-25 14:08:25'),
(12, 1519584479, 6, 9, 5, 4, 11.25, 56.25, 13, 1, 0, '2018-02-25 14:08:15', '2018-02-25 14:08:25', '2018-02-25 14:08:25'),
(13, 1519584479, 10, 414, 5, 409, 27.00, 135.00, 13, 1, 0, '2018-02-25 14:08:26', '2018-02-25 14:10:37', '2018-02-25 14:10:37'),
(14, 1519584479, 11, 340, 6, 334, 27.00, 162.00, 13, 1, 0, '2018-02-25 14:08:26', '2018-02-25 14:10:37', '2018-02-25 14:10:37'),
(15, 1519584479, 12, 29, 5, 24, 12.00, 60.00, 13, 1, 0, '2018-02-25 14:08:26', '2018-02-25 14:10:37', '2018-02-25 14:10:37'),
(16, 1519584479, 13, 101, 5, 96, 12.00, 60.00, 13, 1, 0, '2018-02-25 14:10:38', '2018-02-25 14:10:48', '2018-02-25 14:10:48'),
(17, 1519584479, 14, 171, 7, 164, 22.00, 154.00, 13, 1, 0, '2018-02-25 14:10:38', '2018-02-25 14:10:48', '2018-02-25 14:10:48'),
(18, 1519584479, 15, 164, 5, 159, 22.00, 110.00, 13, 1, 0, '2018-02-25 14:10:38', '2018-02-25 14:10:48', '2018-02-25 14:10:48'),
(19, 1519073836, 1, 5, 2, 3, 1.00, 2.00, 13, 1, 0, '2018-02-25 14:11:32', '2018-02-25 14:11:32', NULL),
(20, 1519589526, 7, 141, 1, 140, 10.00, 10.00, 13, 1, 0, '2018-02-25 14:12:06', '2018-02-25 14:12:25', '2018-02-25 14:12:25'),
(21, 1519589526, 14, 171, 4, 167, 22.00, 88.00, 13, 1, 0, '2018-02-25 14:12:06', '2018-02-25 14:12:25', '2018-02-25 14:12:25'),
(22, 1519589526, 22, 4, 2, 2, 9.00, 18.00, 13, 1, 0, '2018-02-25 14:12:06', '2018-02-25 14:12:25', '2018-02-25 14:12:25'),
(23, 1519589526, 29, 1, 1, 0, 95.00, 95.00, 13, 1, 0, '2018-02-25 14:12:06', '2018-02-25 14:12:25', '2018-02-25 14:12:25'),
(24, 1519589526, 20, 8, 1, 7, 14.00, 14.00, 13, 1, 0, '2018-02-25 14:12:26', '2018-02-25 14:12:37', '2018-02-25 14:12:37'),
(25, 1519589526, 21, 5, 4, 1, 21.00, 84.00, 13, 1, 0, '2018-02-25 14:12:26', '2018-02-25 14:12:37', '2018-02-25 14:12:37'),
(26, 1519589526, 22, 4, 2, 2, 9.00, 18.00, 13, 1, 0, '2018-02-25 14:12:26', '2018-02-25 14:12:37', '2018-02-25 14:12:37'),
(27, 1519589526, 23, 5, 1, 4, 30.00, 30.00, 13, 1, 0, '2018-02-25 14:12:26', '2018-02-25 14:12:37', '2018-02-25 14:12:37'),
(28, 1519589526, 24, 0, 1, -1, 155.00, 155.00, 13, 1, 0, '2018-02-25 14:12:37', '2018-02-25 14:12:37', NULL),
(29, 1519589526, 25, 1, 4, -3, 40.00, 160.00, 13, 1, 0, '2018-02-25 14:12:37', '2018-02-25 14:12:37', NULL),
(30, 1519589526, 26, 1, 2, -1, 40.00, 80.00, 13, 1, 0, '2018-02-25 14:12:37', '2018-02-25 14:12:37', NULL),
(31, 1519589526, 27, 1, 2, -1, 42.00, 84.00, 13, 1, 0, '2018-02-25 14:12:37', '2018-02-25 14:12:37', NULL),
(32, 1519589647, 6, 9, 5, 4, 11.25, 56.25, 13, 1, 0, '2018-02-25 14:14:07', '2018-02-25 14:16:34', '2018-02-25 14:16:34'),
(33, 1519589647, 20, 8, 9, -1, 14.00, 126.00, 13, 1, 0, '2018-02-25 14:14:07', '2018-02-25 14:16:34', '2018-02-25 14:16:34'),
(34, 1519589647, 29, 1, 2, -1, 95.00, 190.00, 13, 1, 0, '2018-02-25 14:14:07', '2018-02-25 14:16:34', '2018-02-25 14:16:34'),
(35, 1519589647, 6, 9, 5, 4, 11.25, 56.25, 13, 1, 0, '2018-02-25 14:16:34', '2018-02-25 14:19:16', '2018-02-25 14:19:16'),
(36, 1519589647, 20, 8, 9, -1, 14.00, 126.00, 13, 1, 0, '2018-02-25 14:16:34', '2018-02-25 14:19:16', '2018-02-25 14:19:16'),
(37, 1519589647, 29, 1, 4, -3, 95.00, 380.00, 13, 1, 0, '2018-02-25 14:16:34', '2018-02-25 14:19:16', '2018-02-25 14:19:16'),
(38, 1519589647, 6, 9, 5, 4, 11.25, 56.25, 13, 1, 0, '2018-02-25 14:19:16', '2018-02-25 14:19:16', NULL),
(39, 1519589647, 20, 8, 9, -1, 14.00, 126.00, 13, 1, 0, '2018-02-25 14:19:16', '2018-02-25 14:19:16', NULL),
(40, 1519589647, 29, 1, 4, -3, 95.00, 380.00, 13, 1, 0, '2018-02-25 14:19:16', '2018-02-25 14:19:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_tenders`
--

CREATE TABLE `lsp_tenders` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_tenders`
--

INSERT INTO `lsp_tenders` (`id`, `name`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'pos System', 13, 2, 2, '2018-02-15 04:56:59', '2018-02-15 05:00:32', '2018-02-15 05:00:32'),
(2, 'Amit 2.5 GB', 13, 2, 0, '2018-02-15 05:00:44', '2018-02-15 07:04:37', '2018-02-15 07:04:37'),
(3, 'Tableware', 13, 2, 0, '2018-02-15 05:00:48', '2018-02-15 05:00:48', NULL),
(4, 'simpleretailpos', 13, 2, 0, '2018-02-15 05:00:52', '2018-02-15 05:00:52', NULL),
(5, 'Brand Custom-S', 13, 2, 0, '2018-02-15 07:04:33', '2018-02-15 07:04:33', NULL),
(6, 'Cash', 13, 1, 0, '2018-02-15 11:38:28', '2018-02-15 11:38:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_users`
--

CREATE TABLE `lsp_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_id` bigint(11) NOT NULL DEFAULT '0',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_users`
--

INSERT INTO `lsp_users` (`id`, `name`, `store_id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Md Fahad Bhuyian', 0, 'f.bhuyian@gmail.com', '$2y$10$Dn9ZjChxZZMPi4EkH4UgYew2kqTmAWgqx.t1NiKFc8YUVgU0Y/gA.', 'zcrjgkiLHE27G74i2OAkCVW5PPH4wkucfWUwu1zEV0FVhL1VuUsHQndansBe', '2018-02-11 13:38:38', '2018-02-11 13:38:38', NULL),
(2, 'Fakhrul', 0, 'fakhrul@gmail.com', '$2y$10$2Gey31b93nXMUZ6HmP8gEuHH1y0fQCMctuGdobID7ZVhQ1bq10/4e', 'oNGc3SIM9wnTBa4SiNDlGzi3IJJ9XaDIPVbT8uE4mxdi5e7MTtc9VF87BrWR', '2018-02-12 04:51:03', '2018-02-12 04:51:03', NULL),
(3, 'Fakhrul Islam Talukder', 0, 'fkhrl@gmail.com', '$2y$10$Pkn9oKLAeQSulsEmiVKk3Og/VJNid1u69wNeLucbgrJK.BNx7gvgC', NULL, '2018-02-13 15:15:28', '2018-02-13 15:15:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lsp_warranties`
--

CREATE TABLE `lsp_warranties` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `warranty_date` date NOT NULL,
  `warranty_batch_quantity` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_warranties`
--

INSERT INTO `lsp_warranties` (`id`, `invoice_id`, `warranty_date`, `warranty_batch_quantity`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1518807226, '2018-02-28', 3, 13, 1, 0, '2018-02-28 12:55:24', '2018-02-28 12:55:24', NULL),
(2, 1518807226, '2018-02-28', 3, 13, 1, 0, '2018-02-28 12:55:49', '2018-02-28 12:55:49', NULL),
(3, 1518819408, '2018-02-28', 1, 13, 1, 0, '2018-02-28 12:59:08', '2018-02-28 13:25:55', '2018-02-28 13:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `lsp_warranty_products`
--

CREATE TABLE `lsp_warranty_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `warranty_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `warranty_date` date NOT NULL,
  `old_product_id` int(11) NOT NULL,
  `new_product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lsp_warranty_products`
--

INSERT INTO `lsp_warranty_products` (`id`, `warranty_id`, `invoice_id`, `warranty_date`, `old_product_id`, `new_product_id`, `store_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1518807226, '2018-02-28', 7, 5, 13, 1, 0, '2018-02-28 12:55:49', '2018-02-28 12:55:49', NULL),
(2, 2, 1518807226, '2018-02-28', 6, 12, 13, 1, 0, '2018-02-28 12:55:49', '2018-02-28 12:55:49', NULL),
(3, 2, 1518807226, '2018-02-28', 12, 23, 13, 1, 0, '2018-02-28 12:55:49', '2018-02-28 12:55:49', NULL),
(4, 3, 1518819408, '2018-02-28', 6, 5, 13, 1, 0, '2018-02-28 12:59:08', '2018-02-28 13:25:55', '2018-02-28 13:25:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lsp_activities`
--
ALTER TABLE `lsp_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_customers`
--
ALTER TABLE `lsp_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_invoices`
--
ALTER TABLE `lsp_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_id_index` (`id`),
  ADD KEY `invoices_invoice_id_index` (`invoice_id`);

--
-- Indexes for table `lsp_invoice_payments`
--
ALTER TABLE `lsp_invoice_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_invoice_products`
--
ALTER TABLE `lsp_invoice_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_invoice_profits`
--
ALTER TABLE `lsp_invoice_profits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_profits_invoice_id_index` (`invoice_id`),
  ADD KEY `invoice_profits_id_index` (`id`),
  ADD KEY `invoice_profits_invoice_datetime_index` (`invoice_datetime`),
  ADD KEY `invoice_profits_customer_id_index` (`customer_id`);

--
-- Indexes for table `lsp_migrations`
--
ALTER TABLE `lsp_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_password_resets`
--
ALTER TABLE `lsp_password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `lsp_products`
--
ALTER TABLE `lsp_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_id_index` (`id`),
  ADD KEY `products_name_index` (`name`);

--
-- Indexes for table `lsp_product_profits`
--
ALTER TABLE `lsp_product_profits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_product_stockins`
--
ALTER TABLE `lsp_product_stockins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_product_stockin_invoices`
--
ALTER TABLE `lsp_product_stockin_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_product_variances`
--
ALTER TABLE `lsp_product_variances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variances_variance_id_index` (`variance_id`),
  ADD KEY `product_variances_id_index` (`id`);

--
-- Indexes for table `lsp_product_variance_datas`
--
ALTER TABLE `lsp_product_variance_datas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variance_datas_variance_id_index` (`variance_id`),
  ADD KEY `product_variance_datas_id_index` (`id`),
  ADD KEY `product_variance_datas_product_id_index` (`product_id`);

--
-- Indexes for table `lsp_tenders`
--
ALTER TABLE `lsp_tenders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_users`
--
ALTER TABLE `lsp_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `lsp_warranties`
--
ALTER TABLE `lsp_warranties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lsp_warranty_products`
--
ALTER TABLE `lsp_warranty_products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lsp_activities`
--
ALTER TABLE `lsp_activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lsp_customers`
--
ALTER TABLE `lsp_customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `lsp_invoices`
--
ALTER TABLE `lsp_invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lsp_invoice_payments`
--
ALTER TABLE `lsp_invoice_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lsp_invoice_products`
--
ALTER TABLE `lsp_invoice_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `lsp_invoice_profits`
--
ALTER TABLE `lsp_invoice_profits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lsp_migrations`
--
ALTER TABLE `lsp_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `lsp_products`
--
ALTER TABLE `lsp_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `lsp_product_profits`
--
ALTER TABLE `lsp_product_profits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lsp_product_stockins`
--
ALTER TABLE `lsp_product_stockins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `lsp_product_stockin_invoices`
--
ALTER TABLE `lsp_product_stockin_invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lsp_product_variances`
--
ALTER TABLE `lsp_product_variances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lsp_product_variance_datas`
--
ALTER TABLE `lsp_product_variance_datas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `lsp_tenders`
--
ALTER TABLE `lsp_tenders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lsp_users`
--
ALTER TABLE `lsp_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lsp_warranties`
--
ALTER TABLE `lsp_warranties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lsp_warranty_products`
--
ALTER TABLE `lsp_warranty_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
