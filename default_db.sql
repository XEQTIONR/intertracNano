-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 05, 2017 at 09:57 AM
-- Server version: 5.5.51-38.2
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `default_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `consignments`
--

CREATE TABLE IF NOT EXISTS `consignments` (
  `BOL` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'CONSIGNMENT ID / BOL#',
  `value` decimal(10,2) NOT NULL,
  `exchange_rate` float NOT NULL,
  `tax` decimal(10,2) NOT NULL DEFAULT '0.00',
  `land_date` date NOT NULL,
  `lc` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `consignments`
--

INSERT INTO `consignments` (`BOL`, `value`, `exchange_rate`, `tax`, `land_date`, `lc`, `created_at`, `updated_at`) VALUES
('BOL1', '2500.00', 0, '200.00', '2017-05-17', 'LC0001', '2017-05-06 11:44:59', '2017-05-06 11:44:59'),
('BOL2', '500.00', 0, '25.00', '2017-05-18', 'LC0001', '2017-05-07 09:13:15', '2017-05-07 09:13:15'),
('BOL4', '5000.00', 0, '500.00', '2017-06-20', 'LC2', '2017-06-19 09:24:27', '2017-06-19 09:24:27'),
('BOL5', '5000.00', 0, '0.00', '2017-06-22', 'LC3', '2017-06-22 13:18:35', '2017-06-22 13:18:35'),
('BOL7', '5000.00', 0, '500.00', '2017-06-22', 'LC2', '2017-06-23 04:08:57', '2017-06-23 04:08:57'),
('BOLC3', '10000.00', 50, '25000.00', '2017-06-24', 'LC3', '2017-06-23 10:38:54', '2017-06-23 10:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `consignment_containers`
--

CREATE TABLE IF NOT EXISTS `consignment_containers` (
  `Container_num` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `BOL` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `consignment_containers`
--

INSERT INTO `consignment_containers` (`Container_num`, `BOL`, `created_at`, `updated_at`) VALUES
('c10', 'BOL2', '2017-05-24 18:48:02', '2017-05-24 18:48:02'),
('c4', 'BOL2', '2017-05-24 07:06:34', '2017-05-24 07:06:34'),
('c7', 'BOL2', '2017-05-24 18:41:05', '2017-05-24 18:41:05'),
('c8', 'BOL2', '2017-05-24 18:41:30', '2017-05-24 18:41:30'),
('c9', 'BOL2', '2017-05-24 18:47:07', '2017-05-24 18:47:07'),
('Cont3', 'BOL2', '2017-05-23 02:04:42', '2017-05-23 02:04:42'),
('cont5', 'BOL2', '2017-05-24 18:35:11', '2017-05-24 18:35:11'),
('cont6', 'BOL1', '2017-05-24 18:39:30', '2017-05-24 18:39:30'),
('Container 1', 'BOL1', '2017-05-07 10:41:23', '2017-05-07 10:41:23'),
('Container 2', 'BOL2', '2017-05-17 00:33:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `consignment_expenses`
--

CREATE TABLE IF NOT EXISTS `consignment_expenses` (
  `BOL` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `expense_id` int(11) NOT NULL,
  `expense_foreign` decimal(10,2) NOT NULL DEFAULT '0.00',
  `expense_local` decimal(10,2) NOT NULL DEFAULT '0.00',
  `expense_notes` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `consignment_expenses`
--

INSERT INTO `consignment_expenses` (`BOL`, `expense_id`, `expense_foreign`, `expense_local`, `expense_notes`, `created_at`, `updated_at`) VALUES
('BOL1', 1, '2500.00', '500.00', NULL, '2017-05-07 09:11:34', '2017-05-07 09:11:34'),
('BOL1', 3, '600.00', '0.00', 'some note also', '2017-05-07 09:12:20', '2017-05-07 09:12:20'),
('BOL2', 4, '50.00', '6000.00', NULL, '2017-05-07 09:14:10', '2017-05-07 09:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `container_contents`
--

CREATE TABLE IF NOT EXISTS `container_contents` (
  `Container_num` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `BOL` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tyre_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '1',
  `unit_price` decimal(7,3) NOT NULL,
  `total_tax` decimal(7,3) NOT NULL DEFAULT '0.000',
  `total_weight` decimal(7,3) NOT NULL DEFAULT '0.000',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `container_contents`
--

INSERT INTO `container_contents` (`Container_num`, `BOL`, `tyre_id`, `qty`, `unit_price`, `total_tax`, `total_weight`, `created_at`, `updated_at`) VALUES
('c10', 'BOL2', 4, 10, '50.000', '700.000', '500.000', '2017-05-24 18:48:02', '2017-05-24 18:48:02'),
('c7', 'BOL2', 4, 50, '1000.000', '500.000', '400.000', '2017-05-24 18:41:05', '2017-05-24 18:41:05'),
('c8', 'BOL2', 4, 10, '500.000', '200.000', '400.000', '2017-05-24 18:41:30', '2017-05-24 18:41:30'),
('c9', 'BOL2', 1, 43, '54.000', '78.000', '65.000', '2017-05-24 18:47:07', '2017-05-24 18:47:07'),
('Cont3', 'BOL2', 1, 30, '10.000', '2400.000', '500.000', '2017-05-23 02:51:13', '2017-05-23 02:51:13'),
('Cont3', 'BOL2', 2, 60, '12.000', '2400.000', '700.000', '2017-05-23 02:51:13', '2017-05-23 02:51:13'),
('Cont3', 'BOL2', 3, 90, '14.000', '2400.000', '900.000', '2017-05-23 02:51:13', '2017-05-23 02:51:13'),
('cont5', 'BOL2', 1, 30, '400.000', '700.000', '900.000', '2017-05-24 18:35:11', '2017-05-24 18:35:11'),
('cont5', 'BOL2', 2, 50, '500.000', '750.000', '1000.000', '2017-05-24 18:35:11', '2017-05-24 18:35:11'),
('cont6', 'BOL1', 1, 40, '400.000', '700.000', '500.000', '2017-05-24 18:39:30', '2017-05-24 18:39:30'),
('Container 1', 'BOL1', 1, 10, '20.000', '0.000', '0.000', '2017-05-15 06:30:21', '2017-05-15 06:30:21'),
('Container 1', 'BOL1', 2, 20, '30.000', '0.000', '0.000', '2017-05-15 06:30:21', '2017-05-15 06:30:21'),
('Container 1', 'BOL1', 3, 30, '30.000', '0.000', '0.000', '2017-05-16 08:57:01', '2017-05-16 08:57:01'),
('Container 2', 'BOL2', 1, 10, '40.000', '0.000', '0.000', '2017-05-17 00:35:07', NULL),
('Container 2', 'BOL2', 2, 10, '50.000', '0.000', '0.000', '2017-05-17 00:35:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `phone`, `notes`, `created_at`, `updated_at`) VALUES
(1, 'Tyre Buyer 3', '100 TB Road', '678888', 'Test Note 2', '2017-05-06 03:32:32', '2017-06-22 00:39:39'),
(2, 'Second Buyer', '2 sbuyer Street', '656666', 'some note.', '2017-05-06 05:51:55', NULL),
(3, '3 Guys Tyre Buyers', '3 guy street', '3374878', 'We sell burgers too.', '2017-05-06 10:53:36', '2017-06-22 00:40:35'),
(4, 'A New Customer', 'New Address', '6777777', 'A new note about a new customer', '2017-06-22 00:38:51', '2017-06-22 00:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `hscodes`
--

CREATE TABLE IF NOT EXISTS `hscodes` (
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hscodes`
--

INSERT INTO `hscodes` (`id`, `created_at`, `updated_at`) VALUES
('HSCODE1', '2017-05-10 11:10:26', '2017-05-10 11:10:26'),
('HSCODE2', '2017-05-10 11:16:33', '2017-05-10 11:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `lcs`
--

CREATE TABLE IF NOT EXISTS `lcs` (
  `lc_num` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `date_issued` date NOT NULL,
  `date_expiry` date NOT NULL,
  `applicant` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `beneficiary` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `currency_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'USD',
  `foreign_amount` decimal(10,2) NOT NULL,
  `foreign_expense` decimal(10,2) NOT NULL DEFAULT '0.00',
  `domestic_expense` decimal(10,2) NOT NULL DEFAULT '0.00',
  `exchange_rate` decimal(5,2) NOT NULL DEFAULT '1.00',
  `port_depart` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ENTER PORT',
  `port_arrive` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ENTER PORT',
  `invoice_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `notes` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lcs`
--

INSERT INTO `lcs` (`lc_num`, `date_issued`, `date_expiry`, `applicant`, `beneficiary`, `currency_code`, `foreign_amount`, `foreign_expense`, `domestic_expense`, `exchange_rate`, `port_depart`, `port_arrive`, `invoice_no`, `notes`, `created_at`, `updated_at`) VALUES
('000000', '2017-07-01', '2017-07-31', 'Ishtehar', 'Ovi', 'CAD', '5000.00', '300.00', '2000.00', '60.00', 'TOR', 'DHK', '00110000', NULL, '2017-07-01 17:45:48', '2017-07-01 17:45:48'),
('009988776655', '2017-06-09', '2017-06-20', 'ME', 'you', 'USD', '5000.00', '400.00', '3000.00', '61.00', 'aad', 'asd', '2333456', NULL, '2017-07-01 04:05:17', '2017-07-01 04:05:17'),
('1234556789012', '2017-06-01', '2017-06-14', 'df', 'dsf', 'das', '5000.00', '50.00', '0.00', '50.00', 'sfd', 'sfd', '9878', NULL, '2017-07-01 07:24:38', '2017-07-01 07:24:38'),
('67666678', '2017-06-01', '2017-06-30', 'yui', 'yui', 'CAD', '5000.00', '200.00', '3000.00', '60.00', 'yiu', 'yui', '767666', NULL, '2017-07-01 07:01:37', '2017-07-01 07:01:37'),
('LC0001', '2017-05-06', '2017-05-29', 'Me', 'You', 'CAD', '5000.00', '200.00', '12000.00', '60.00', 'PIA', 'DAC', '11111111', NULL, '2017-05-06 10:28:38', '2017-05-06 10:28:38'),
('LC2', '2017-06-01', '2017-06-04', 'A', 'B', 'USD', '5000.00', '200.00', '2000.00', '60.90', 'C', 'D', '222', NULL, '2017-06-05 02:17:50', '2017-06-05 02:17:50'),
('LC3', '2017-06-21', '2017-06-24', 'A', 'B', 'USD', '5000.00', '200.00', '2000.00', '60.90', 'C', 'D', '333', NULL, '2017-06-05 02:30:45', '2017-06-05 02:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `Order_num` bigint(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `discount_percent` decimal(5,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_percentage` decimal(5,2) NOT NULL DEFAULT '0.00',
  `tax_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_num`, `customer_id`, `discount_percent`, `discount_amount`, `tax_percentage`, `tax_amount`, `created_at`, `updated_at`) VALUES
(1, 1, '0.00', '0.00', '15.00', '0.00', '2017-05-10 09:14:28', '2017-05-10 09:14:28'),
(2, 1, '15.00', '0.00', '15.00', '0.00', '2017-05-10 09:14:59', '2017-05-10 09:14:59'),
(3, 2, '15.00', '0.00', '0.00', '200.00', '2017-05-10 09:18:45', '2017-05-10 09:18:45'),
(12, 3, '0.00', '0.00', '0.00', '0.00', '2017-05-20 19:29:34', '2017-05-20 19:29:34'),
(13, 3, '10.00', '0.00', '0.00', '0.00', '2017-05-20 19:31:40', '2017-05-20 19:31:40'),
(20, 3, '0.00', '0.00', '15.00', '0.00', '2017-05-22 08:38:12', '2017-05-22 08:38:12'),
(28, 1, '0.00', '0.00', '15.00', '0.00', '2017-05-22 08:58:55', '2017-05-22 08:58:55'),
(30, 2, '0.00', '0.00', '0.00', '0.00', '2017-06-06 21:07:30', '2017-06-06 21:07:30'),
(31, 3, '15.00', '0.00', '15.00', '0.00', '2017-06-19 02:08:43', '2017-06-19 02:08:43'),
(32, 1, '12.00', '0.00', '15.00', '0.00', '2017-07-01 02:38:52', '2017-07-01 02:38:52');

-- --------------------------------------------------------

--
-- Table structure for table `order_contents`
--

CREATE TABLE IF NOT EXISTS `order_contents` (
  `Order_num` bigint(20) NOT NULL,
  `tyre_id` int(11) NOT NULL,
  `container_num` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bol` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '1',
  `unit_price` decimal(7,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_contents`
--

INSERT INTO `order_contents` (`Order_num`, `tyre_id`, `container_num`, `bol`, `qty`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 1, 'Container 1', 'BOL1', 5, '500.00', '2017-05-16 03:00:22', NULL),
(1, 2, 'Container 1', 'BOL1', 10, '450.00', '2017-05-16 03:00:22', NULL),
(2, 1, 'Container 1', 'BOL1', 2, '500.00', '2017-05-17 00:29:06', NULL),
(12, 3, 'Container 1', 'BOL1', 10, '1000.00', '2017-05-20 19:29:34', '2017-05-20 19:29:34'),
(13, 3, 'Container 1', 'BOL1', 7, '1000.00', '2017-05-20 19:31:40', '2017-05-20 19:31:40'),
(20, 3, 'Container 1', 'BOL1', 3, '500.00', '2017-05-22 08:38:13', '2017-05-22 08:38:13'),
(28, 1, 'Container 1', 'BOL1', 3, '500.00', '2017-05-22 08:58:55', '2017-05-22 08:58:55'),
(28, 2, 'Container 1', 'BOL1', 5, '1000.00', '2017-05-22 08:58:56', '2017-05-22 08:58:56'),
(28, 3, 'Container 1', 'BOL1', 5, '700.00', '2017-05-22 08:58:56', '2017-05-22 08:58:56'),
(30, 1, 'Cont3', 'BOL2', 30, '500.00', '2017-06-06 21:07:31', '2017-06-06 21:07:31'),
(30, 1, 'cont5', 'BOL2', 13, '500.00', '2017-06-06 21:07:31', '2017-06-06 21:07:31'),
(30, 1, 'Container 1', 'BOL1', 0, '500.00', '2017-06-06 21:07:31', '2017-06-06 21:07:31'),
(30, 1, 'Container 2', 'BOL2', 10, '500.00', '2017-06-06 21:07:31', '2017-06-06 21:07:31'),
(30, 2, 'Cont3', 'BOL2', 10, '500.00', '2017-06-06 21:07:32', '2017-06-06 21:07:32'),
(30, 2, 'Container 1', 'BOL1', 5, '500.00', '2017-06-06 21:07:31', '2017-06-06 21:07:31'),
(30, 2, 'Container 2', 'BOL2', 10, '500.00', '2017-06-06 21:07:32', '2017-06-06 21:07:32'),
(31, 1, 'Cont3', 'BOL2', 0, '250.00', '2017-06-19 02:08:44', '2017-06-19 02:08:44'),
(31, 1, 'cont5', 'BOL2', 17, '250.00', '2017-06-19 02:08:44', '2017-06-19 02:08:44'),
(31, 1, 'cont6', 'BOL1', 33, '250.00', '2017-06-19 02:08:44', '2017-06-19 02:08:44'),
(31, 1, 'Container 1', 'BOL1', 0, '250.00', '2017-06-19 02:08:44', '2017-06-19 02:08:44'),
(31, 1, 'Container 2', 'BOL2', 0, '250.00', '2017-06-19 02:08:44', '2017-06-19 02:08:44'),
(31, 2, 'Cont3', 'BOL2', 50, '250.00', '2017-06-19 02:08:45', '2017-06-19 02:08:45'),
(31, 2, 'Container 1', 'BOL1', 0, '250.00', '2017-06-19 02:08:44', '2017-06-19 02:08:44'),
(31, 2, 'Container 2', 'BOL2', 0, '250.00', '2017-06-19 02:08:44', '2017-06-19 02:08:44'),
(31, 3, 'Container 1', 'BOL1', 5, '300.00', '2017-06-19 02:08:45', '2017-06-19 02:08:45'),
(32, 1, 'c9', 'BOL2', 3, '450.00', '2017-07-01 02:38:53', '2017-07-01 02:38:53'),
(32, 1, 'Cont3', 'BOL2', 0, '450.00', '2017-07-01 02:38:53', '2017-07-01 02:38:53'),
(32, 1, 'cont5', 'BOL2', 0, '450.00', '2017-07-01 02:38:53', '2017-07-01 02:38:53'),
(32, 1, 'cont6', 'BOL1', 7, '450.00', '2017-07-01 02:38:53', '2017-07-01 02:38:53'),
(32, 1, 'Container 1', 'BOL1', 0, '450.00', '2017-07-01 02:38:53', '2017-07-01 02:38:53'),
(32, 1, 'Container 2', 'BOL2', 0, '450.00', '2017-07-01 02:38:53', '2017-07-01 02:38:53'),
(32, 2, 'Cont3', 'BOL2', 0, '500.00', '2017-07-01 02:38:54', '2017-07-01 02:38:54'),
(32, 2, 'cont5', 'BOL2', 10, '500.00', '2017-07-01 02:38:54', '2017-07-01 02:38:54'),
(32, 2, 'Container 1', 'BOL1', 0, '500.00', '2017-07-01 02:38:53', '2017-07-01 02:38:53'),
(32, 2, 'Container 2', 'BOL2', 0, '500.00', '2017-07-01 02:38:54', '2017-07-01 02:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `username` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`username`, `token`, `created_at`, `email`) VALUES
('', '$2y$10$Hp76xXR2ANcAH1R8Qj/ET.quvNKr7wjWwLGFUA0ackaIFJeM7EZFa', '2017-06-28 23:25:40', 'ishteharhussain@gmail.com'),
('', '$2y$10$mNaRi05MLw5RHUV3Di/4A.DNQ0c4kStG2J03/yreR9D5ipO1qNmua', '2017-07-03 07:40:41', 'tshahriyer@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `Invoice_num` bigint(20) unsigned zerofill NOT NULL,
  `Order_num` bigint(20) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`Invoice_num`, `Order_num`, `payment_amount`, `created_at`, `updated_at`) VALUES
(00000000000000000001, 1, '500.00', '2017-05-10 10:51:53', '2017-05-10 10:51:53'),
(00000000000000000002, 2, '200.00', '2017-05-10 10:54:15', '2017-05-10 10:54:15'),
(00000000000000000003, 3, '2700.00', '2017-05-10 10:56:13', '2017-05-10 10:56:13'),
(00000000000000000004, 1, '1000.00', '2017-06-17 13:49:41', '2017-06-17 13:49:41');

-- --------------------------------------------------------

--
-- Table structure for table `performa_invoices`
--

CREATE TABLE IF NOT EXISTS `performa_invoices` (
  `lc_num` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `tyre_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '1',
  `unit_price` decimal(5,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `performa_invoices`
--

INSERT INTO `performa_invoices` (`lc_num`, `tyre_id`, `qty`, `unit_price`, `created_at`, `updated_at`) VALUES
('000000', 1, 10, '45.00', '2017-07-01 17:45:48', '2017-07-01 17:45:48'),
('000000', 2, 20, '55.00', '2017-07-01 17:45:48', '2017-07-01 17:45:48'),
('009988776655', 5, 10, '50.00', '2017-07-01 04:06:28', '2017-07-01 04:06:28'),
('009988776655', 6, 20, '50.00', '2017-07-01 04:06:28', '2017-07-01 04:06:28'),
('67666678', 1, 10, '50.00', '2017-07-01 07:05:21', '2017-07-01 07:05:21'),
('67666678', 2, 10, '50.00', '2017-07-01 07:05:21', '2017-07-01 07:05:21'),
('LC0001', 1, 10, '100.00', '2017-05-10 08:11:44', '2017-05-10 08:11:44'),
('LC0001', 2, 20, '200.00', '2017-05-10 08:11:44', '2017-05-10 08:11:44'),
('LC0001', 3, 24, '300.00', '2017-05-10 08:23:31', '2017-05-10 08:23:31'),
('LC2', 1, 10, '50.00', '2017-06-05 02:17:51', '2017-06-05 02:17:51'),
('LC2', 2, 20, '60.00', '2017-06-05 02:17:51', '2017-06-05 02:17:51'),
('LC3', 2, 10, '50.00', '2017-06-05 02:30:46', '2017-06-05 02:30:46'),
('LC3', 3, 10, '60.00', '2017-06-05 02:30:46', '2017-06-05 02:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `tyres`
--

CREATE TABLE IF NOT EXISTS `tyres` (
  `tyre_id` int(11) NOT NULL,
  `brand` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'INTERTRAC',
  `size` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `pattern` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tyres`
--

INSERT INTO `tyres` (`tyre_id`, `brand`, `size`, `pattern`, `created_at`, `updated_at`) VALUES
(1, 'INTERTRAC', 'SIZE1', 'PAT1', '2017-05-06 10:43:40', '2017-05-06 10:43:40'),
(2, 'BOL1', 'LC001', '20', '2017-05-06 11:32:44', '2017-05-06 11:32:44'),
(3, 'BOL1', 'LC001', '20', '2017-05-06 11:34:10', '2017-05-06 11:34:10'),
(4, 'INTERTRAC', '', '', '2017-05-10 03:42:02', '2017-05-10 03:42:02'),
(5, 'HUSSAIN', 'H', 'P', '2017-06-06 20:54:29', '2017-06-06 20:54:29'),
(6, 'TYRE BRAND', 'TYRE SIZE', 'TYRE PATTE', '2017-06-19 09:06:18', '2017-06-19 09:06:18'),
(7, 'NABILA', 'XS', 'POLKA', '2017-06-23 04:06:27', '2017-06-23 04:06:27');

-- --------------------------------------------------------

--
-- Table structure for table `tyre_hscodes`
--

CREATE TABLE IF NOT EXISTS `tyre_hscodes` (
  `tyre_id` int(11) NOT NULL,
  `hscode` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Ovi', 'x.e.q.tionrz@gmail.com', '$2y$10$EqyfChB2OS2JfTpxH5piT.5xUSE974uCyZOXGpF84Y3MVZi1kUZuS', 0, 'S2Hy3WJLKEiHkXmHgSKD1uzMUkdCknPJ3baW93jZfjndIU74GnI08wvu8Jj7', '2017-06-27 08:24:48', '2017-06-28 23:28:39'),
(3, 'Ishtehar Hussain', 'ishteharhussain@gmail.com', '$2y$10$oLMoIqRFBR8.nVlHZDweveCQt7WAxFRYgC0fCVkRTwGLCAePJyxzS', 1, 'RFw7kxrr8w7tMkTDgRW4jvjmkqqm12X1MML1JNWruXzlkgR1HdbFlHgDsolp', '2017-06-28 23:16:59', '2017-06-28 23:16:59'),
(4, 'Nabila', 'tasnimnh@hotmail.com', '$2y$10$Tx235LhKdh8RzwdK8SWfO.9B4bhoHcqu1ueEfPQNUv8m9SybBKhhq', 0, 'I2edbuYsNF5C5LTDh5MUhkVxwXCHqqBA3wR1xjtHnPNWAFszn70fWysJ2tve', '2017-06-29 03:14:57', '2017-06-29 03:14:57'),
(5, 'Tausif', 'tshahriyer@gmail.com', '$2y$10$muIAyEbGF68v9APN9caUGOZZZEr4cG6iN3wCEsvkAqPa1Vj.RBYxG', 0, 'eqOSqg5M7C26sGCKxKHDtLGNwDX74zCjYC7l76JgVEYdVXhmoO2S15dBJsBw', '2017-07-03 07:40:19', '2017-07-03 07:40:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consignments`
--
ALTER TABLE `consignments`
  ADD PRIMARY KEY (`BOL`), ADD KEY `fk_LCconsignments_idx` (`lc`);

--
-- Indexes for table `consignment_containers`
--
ALTER TABLE `consignment_containers`
  ADD PRIMARY KEY (`Container_num`,`BOL`), ADD KEY `fk_CONSIGNMENTcontainer_idx` (`BOL`);

--
-- Indexes for table `consignment_expenses`
--
ALTER TABLE `consignment_expenses`
  ADD PRIMARY KEY (`expense_id`), ADD KEY `fk_CONSIGNMENTexpenses_idx` (`BOL`);

--
-- Indexes for table `container_contents`
--
ALTER TABLE `container_contents`
  ADD PRIMARY KEY (`Container_num`,`BOL`,`tyre_id`), ADD KEY `fk_TYREcontents_idx` (`tyre_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hscodes`
--
ALTER TABLE `hscodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lcs`
--
ALTER TABLE `lcs`
  ADD PRIMARY KEY (`lc_num`), ADD UNIQUE KEY `LC_invoice#_UNIQUE` (`invoice_no`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_num`), ADD KEY `fk_CUSTOMERorder_idx` (`customer_id`);

--
-- Indexes for table `order_contents`
--
ALTER TABLE `order_contents`
  ADD PRIMARY KEY (`Order_num`,`tyre_id`,`container_num`,`bol`), ADD KEY `fk_ORDERcontainer_idx` (`tyre_id`,`container_num`,`bol`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_username_index` (`username`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`Invoice_num`), ADD KEY `fk_ORDERSpayment_idx` (`Order_num`);

--
-- Indexes for table `performa_invoices`
--
ALTER TABLE `performa_invoices`
  ADD PRIMARY KEY (`lc_num`,`tyre_id`), ADD KEY `fk_TYRE_idx` (`tyre_id`);

--
-- Indexes for table `tyres`
--
ALTER TABLE `tyres`
  ADD PRIMARY KEY (`tyre_id`);

--
-- Indexes for table `tyre_hscodes`
--
ALTER TABLE `tyre_hscodes`
  ADD KEY `fk_TYRE_idx` (`tyre_id`), ADD KEY `fk_HSCODE_idx` (`hscode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consignment_expenses`
--
ALTER TABLE `consignment_expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_num` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `Invoice_num` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tyres`
--
ALTER TABLE `tyres`
  MODIFY `tyre_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `consignments`
--
ALTER TABLE `consignments`
ADD CONSTRAINT `fk_LCconsignments` FOREIGN KEY (`lc`) REFERENCES `lcs` (`lc_num`) ON UPDATE CASCADE;

--
-- Constraints for table `consignment_containers`
--
ALTER TABLE `consignment_containers`
ADD CONSTRAINT `fk_CONSIGNMENTcontainer` FOREIGN KEY (`BOL`) REFERENCES `consignments` (`BOL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consignment_expenses`
--
ALTER TABLE `consignment_expenses`
ADD CONSTRAINT `fk_CONSIGNMENTexpenses` FOREIGN KEY (`BOL`) REFERENCES `consignments` (`BOL`) ON UPDATE CASCADE;

--
-- Constraints for table `container_contents`
--
ALTER TABLE `container_contents`
ADD CONSTRAINT `fk_CONTAINERcontents` FOREIGN KEY (`Container_num`, `BOL`) REFERENCES `consignment_containers` (`Container_num`, `BOL`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_TYREcontents` FOREIGN KEY (`tyre_id`) REFERENCES `tyres` (`tyre_id`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
ADD CONSTRAINT `fk_CUSTOMERorder` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `order_contents`
--
ALTER TABLE `order_contents`
ADD CONSTRAINT `fk_ORDERcontainer` FOREIGN KEY (`tyre_id`, `container_num`, `bol`) REFERENCES `container_contents` (`tyre_id`, `Container_num`, `BOL`) ON UPDATE CASCADE,
ADD CONSTRAINT `fk_ORDERcontents` FOREIGN KEY (`Order_num`) REFERENCES `orders` (`Order_num`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
ADD CONSTRAINT `fk_ORDERSpayment` FOREIGN KEY (`Order_num`) REFERENCES `orders` (`Order_num`) ON UPDATE CASCADE;

--
-- Constraints for table `performa_invoices`
--
ALTER TABLE `performa_invoices`
ADD CONSTRAINT `fk_LCperforma` FOREIGN KEY (`lc_num`) REFERENCES `lcs` (`lc_num`) ON UPDATE CASCADE,
ADD CONSTRAINT `fk_TYREperforma` FOREIGN KEY (`tyre_id`) REFERENCES `tyres` (`tyre_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tyre_hscodes`
--
ALTER TABLE `tyre_hscodes`
ADD CONSTRAINT `fk_HSCODEhscode` FOREIGN KEY (`hscode`) REFERENCES `hscodes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_TYREtyre` FOREIGN KEY (`tyre_id`) REFERENCES `tyres` (`tyre_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
