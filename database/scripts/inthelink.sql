-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2020 at 09:04 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inthelink`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `order`, `description`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'Clothes', 0, 1, NULL, '2019-12-14 01:38:43', '2019-11-15 03:00:42', NULL),
(2, 'Shoes', 0, 2, NULL, '2019-12-17 01:31:59', '2019-11-15 03:00:42', NULL),
(3, 'Health & Beauty', 0, 3, NULL, '2019-12-14 01:38:43', '2019-11-15 03:01:42', NULL),
(4, 'Bags', 0, 4, NULL, '2019-12-14 01:38:43', '2019-11-15 03:01:42', NULL),
(5, 'Mom & Kid', 0, 5, NULL, '2019-12-14 01:38:43', '2019-11-15 03:02:55', NULL),
(6, 'Home Care', 0, 6, NULL, '2019-12-14 01:38:43', '2019-11-15 03:02:55', NULL),
(7, 'Books', 0, 7, NULL, '2019-12-14 01:38:43', '2019-11-15 03:02:55', NULL),
(8, 'Mobile & Accessories', 3, 8, NULL, '2019-12-14 01:38:43', '2019-11-15 03:02:55', NULL),
(9, 'Men', 1, 10, NULL, '2019-12-17 01:31:52', '2019-11-15 03:47:01', NULL),
(10, 'T-Shirt', 2, 11, NULL, '2019-12-17 01:32:13', '2019-11-15 03:54:34', NULL),
(11, 'Women', 1, 12, NULL, '2019-12-14 01:38:43', '2019-11-15 04:56:00', NULL),
(12, 'thomas', 3, 0, NULL, '2019-12-16 18:46:30', '2019-12-16 18:46:30', NULL),
(13, 'Phone', 0, 0, NULL, '2019-12-17 02:02:08', '2019-12-17 02:02:08', NULL),
(14, 'Galaxy S10', 13, 0, NULL, '2019-12-17 02:02:40', '2019-12-17 02:02:40', NULL),
(15, 'Technology', 0, 0, NULL, '2019-12-18 02:25:52', '2019-12-18 02:25:52', NULL),
(16, 'Laptop', 15, 0, NULL, '2019-12-18 02:26:31', '2019-12-18 02:26:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_addresses`
--

CREATE TABLE `delivery_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `set_default` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_addresses`
--

INSERT INTO `delivery_addresses` (`id`, `user_id`, `name`, `address`, `phone`, `set_default`, `created_at`, `updated_at`) VALUES
(20, 63, 'Taewoong Kong', '204, 711-22 Banpo-dong, Seocho-gu', '0787441816', 1, '2019-12-17 02:37:11', '2019-12-17 02:37:11'),
(22, 66, 'I love you your old girlfriends', 'Blo2ck 13 Lai Yen Factory Zone, Lai Yen Ward, Hoai Duc District, Hanoi', '0972918120', 1, '2019-12-18 03:09:31', '2019-12-18 03:09:57'),
(23, 66, 'haongogia', 'Blo2ck 13 Lai Yen Factory Zone, Lai Yen Ward, Hoai Duc District, Hanoi', '0972918120', 0, '2019-12-18 03:09:38', '2019-12-18 03:09:57'),
(24, 58, 'toomy', 'thu dcu', '0345934545', 0, '2019-12-18 19:54:18', '2019-12-24 03:20:30'),
(25, 58, 'thomas', '23iorj23l', 'asdjfkl', 0, '2019-12-19 03:40:14', '2019-12-24 03:20:30'),
(26, 72, 'bodyfriend', 'aqua 1, vinhome', '0787441816', 1, '2019-12-19 23:57:11', '2019-12-19 23:57:11'),
(27, 73, 'bodyfriend', 'aqua1', '0787441816', 1, '2019-12-20 00:01:26', '2019-12-20 00:02:10'),
(28, 73, 'bodyfriend', 'aqua 1', '0787441816', 0, '2019-12-20 00:01:59', '2019-12-20 00:02:10'),
(31, 69, 'join', 'thu duc', '09292349', 1, '2019-12-20 01:25:14', '2019-12-20 01:25:14'),
(33, 58, 'louise', 'quan 11', '092949234223', 0, '2019-12-24 03:14:36', '2019-12-24 03:20:30'),
(34, 58, 'louise', 'quan 11', '092949234223', 0, '2019-12-24 03:14:45', '2019-12-24 03:20:30'),
(35, 58, 'bang', 'quan 12', '0765747456445', 0, '2019-12-24 03:15:15', '2019-12-24 03:20:30'),
(36, 58, 'joiny', 'thu duc', '0293493294', 1, '2019-12-24 03:20:30', '2019-12-24 03:20:30'),
(43, 79, 'join', 'thu duc', '029349234t', 1, '2019-12-26 09:40:54', '2019-12-26 09:41:07'),
(48, 88, 'louiseee', 'thu duc', '029392342', 1, '2020-01-09 06:12:27', '2020-01-20 02:46:48'),
(49, 88, 'join', 'thu duc', '092942394', 0, '2020-01-16 04:56:03', '2020-01-20 02:46:48'),
(50, 89, 'tommi', 'thu3 d9u7c', '0929349234', 0, '2020-01-21 08:54:43', '2020-01-22 04:04:29'),
(51, 89, 'mono', 'cacacc', '0998886786', 1, '2020-01-22 03:56:58', '2020-01-22 04:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_unit`
--

CREATE TABLE `delivery_unit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_estimate` int(11) NOT NULL,
  `delivery_price` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_unit`
--

INSERT INTO `delivery_unit` (`id`, `name`, `time_estimate`, `delivery_price`, `created_at`, `updated_at`) VALUES
(3, 'Inthelink Express', 2, '20000', '2019-12-16 17:00:00', '2019-12-16 17:00:00'),
(4, 'Grab Express', 3, '20000', '2019-12-25 17:00:00', '2019-12-27 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `dir` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `size` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `target_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `target_id` bigint(20) NOT NULL DEFAULT 0,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `name`, `dir`, `path`, `size`, `target_type`, `target_id`, `created_at`, `updated_at`) VALUES
(222, 'images (3).jpg', 'user_profile', '.jpg', NULL, '0', 0, '2019-12-17', '2019-12-17'),
(224, 'phone1.png', 'product', '.png', NULL, '1', 135, '2019-12-17', '2019-12-17'),
(225, 'images (3).jpg', 'influencer_banking', '.jpg', NULL, '0', 0, '2019-12-18', '2019-12-18'),
(226, 'asl.jpg', 'user_profile', '.jpg', NULL, '0', 0, '2019-12-18', '2019-12-18'),
(227, '52forest_snow_tourist_143012_1920x1080.png', 'product', '.png', NULL, '0', 136, '2019-12-18', '2019-12-18'),
(228, 'brain.jpg', 'product', '.jpg', NULL, '0', 137, '2019-12-18', '2019-12-18'),
(229, 'download_(1).png', 'product', '.png', NULL, '1', 137, '2019-12-18', '2019-12-18'),
(230, 'download1.png', 'product', '.png', NULL, '2', 137, '2019-12-18', '2019-12-18'),
(231, 'logo.png', 'product', '.png', NULL, '3', 137, '2019-12-18', '2019-12-18'),
(232, '2-rice.jpeg', 'product', '.jpeg', NULL, '0', 138, '2019-12-18', '2019-12-18'),
(233, '3-pork-belly.jpg', 'product', '.jpg', NULL, '1', 138, '2019-12-18', '2019-12-18'),
(234, '4-garlic.jpeg', 'product', '.jpeg', NULL, '2', 138, '2019-12-18', '2019-12-18'),
(235, '5-chicory.jpg', 'product', '.jpg', NULL, '3', 138, '2019-12-18', '2019-12-18'),
(236, '6.png', 'product', '.png', NULL, '0', 139, '2019-12-18', '2019-12-18'),
(237, '6-shallot.jpeg', 'product', '.jpeg', NULL, '1', 139, '2019-12-18', '2019-12-18'),
(238, '7-ginger.jpeg', 'product', '.jpeg', NULL, '2', 139, '2019-12-18', '2019-12-18'),
(239, '9-onion.jpg', 'product', '.jpg', NULL, '3', 139, '2019-12-18', '2019-12-18'),
(240, '12-cucumber.jpeg', 'product', '.jpeg', NULL, '0', 140, '2019-12-18', '2019-12-18'),
(241, '24-bok-choy.jpg', 'product', '.jpg', NULL, '1', 140, '2019-12-18', '2019-12-18'),
(242, '15-white-sesame.jpg', 'product', '.jpg', NULL, '2', 140, '2019-12-18', '2019-12-18'),
(243, '21-sesame-leaf.jpeg', 'product', '.jpeg', NULL, '3', 140, '2019-12-18', '2019-12-18'),
(244, '25-carrot.jpg', 'product', '.jpg', NULL, '0', 141, '2019-12-18', '2019-12-18'),
(245, '11-lime.jpeg', 'product', '.jpeg', NULL, '1', 141, '2019-12-18', '2019-12-18'),
(246, '29.jpg', 'product', '.jpg', NULL, '2', 141, '2019-12-18', '2019-12-18'),
(247, '30.jpeg', 'product', '.jpeg', NULL, '3', 141, '2019-12-18', '2019-12-18'),
(248, '28.jpeg', 'product', '.jpeg', NULL, '0', 142, '2019-12-18', '2019-12-18'),
(249, '40.jpg', 'product', '.jpg', NULL, '1', 142, '2019-12-18', '2019-12-18'),
(250, '22-baechu-kimchi.jpeg', 'product', '.jpeg', NULL, '2', 142, '2019-12-18', '2019-12-18'),
(251, '36.jpg', 'product', '.jpg', NULL, '3', 142, '2019-12-18', '2019-12-18'),
(252, '48.jpeg', 'product', '.jpeg', NULL, '0', 143, '2019-12-18', '2019-12-18'),
(253, '26-white-potato.jpeg', 'product', '.jpeg', NULL, '1', 143, '2019-12-18', '2019-12-18'),
(254, '29.jpg', 'product', '.jpg', NULL, '2', 143, '2019-12-18', '2019-12-18'),
(255, '52.jpeg', 'product', '.jpeg', NULL, '3', 143, '2019-12-18', '2019-12-18'),
(256, '37-mustard.jpg', 'product', '.jpg', NULL, '0', 144, '2019-12-18', '2019-12-18'),
(257, '32-chilli-powder-small.jpeg', 'product', '.jpeg', NULL, '1', 144, '2019-12-18', '2019-12-18'),
(258, '35-qweqwe.jpg', 'product', '.jpg', NULL, '2', 144, '2019-12-18', '2019-12-18'),
(259, '51.jpg', 'product', '.jpg', NULL, '3', 144, '2019-12-18', '2019-12-18'),
(260, '7-ginger.jpeg', 'product', '.jpeg', NULL, '0', 145, '2019-12-18', '2019-12-18'),
(261, '29.jpg', 'product', '.jpg', NULL, '1', 145, '2019-12-18', '2019-12-18'),
(262, '35-qweqwe.jpg', 'product', '.jpg', NULL, '2', 145, '2019-12-18', '2019-12-18'),
(263, '44.jpeg', 'product', '.jpeg', NULL, '3', 145, '2019-12-18', '2019-12-18'),
(264, 'mushroom.png', 'product', '.png', NULL, '0', 146, '2019-12-18', '2019-12-18'),
(265, '6-shallot.jpeg', 'product', '.jpeg', NULL, '1', 146, '2019-12-18', '2019-12-18'),
(266, 'flag_vnd.png', 'product', '.png', NULL, '2', 146, '2019-12-18', '2019-12-18'),
(267, '9-onion.jpg', 'product', '.jpg', NULL, '3', 146, '2019-12-18', '2019-12-18'),
(268, '32-chilli-powder-small.jpeg', 'user_profile', '.jpeg', NULL, '0', 0, '2019-12-18', '2019-12-18'),
(271, '32-chilli-powder-small.jpeg', 'user_profile', '.jpeg', NULL, '0', 0, '2019-12-18', '2019-12-18'),
(272, '1-product1.png', 'product', '.png', NULL, '0', 147, '2019-12-18', '2019-12-18'),
(273, '12-cucumber.jpeg', 'product', '.jpeg', NULL, '0', 148, '2019-12-18', '2019-12-18'),
(274, '13-green-chilli.jpeg', 'product', '.jpeg', NULL, '1', 148, '2019-12-18', '2019-12-18'),
(275, '12-cucumber.jpeg', 'product', '.jpeg', NULL, '0', 149, '2019-12-18', '2019-12-18'),
(276, '4-garlic.jpeg', 'product', '.jpeg', NULL, '1', 149, '2019-12-18', '2019-12-18'),
(277, '12-cucumber.jpeg', 'product', '.jpeg', NULL, '0', 151, '2019-12-18', '2019-12-18'),
(278, '74-boneless-pork-belly.jpeg', 'product', '.jpeg', NULL, '0', 152, '2019-12-19', '2019-12-19'),
(279, '81-fanta-orange-flavor.jpg', 'product', '.jpg', NULL, '0', 153, '2019-12-19', '2019-12-19'),
(280, '3-pork-belly.jpg', 'product', '.jpg', NULL, '0', 154, '2019-12-19', '2019-12-19'),
(281, '3-pork-belly.jpg', 'product', '.jpg', NULL, '0', 155, '2019-12-19', '2019-12-19'),
(282, '3-pork-belly.jpg', 'product', '.jpg', NULL, '0', 156, '2019-12-19', '2019-12-19'),
(283, '3-pork-belly.jpg', 'product', '.jpg', NULL, '0', 157, '2019-12-19', '2019-12-19'),
(284, '3-pork-belly.jpg', 'product', '.jpg', NULL, '0', 158, '2019-12-19', '2019-12-19'),
(285, '3-pork-belly.jpg', 'product', '.jpg', NULL, '0', 159, '2019-12-19', '2019-12-19'),
(286, '3-pork-belly.jpg', 'product', '.jpg', NULL, '0', 160, '2019-12-19', '2019-12-19'),
(287, '24-bok-choy.jpg', 'product', '.jpg', NULL, '0', 161, '2019-12-19', '2019-12-19'),
(288, '24-bok-choy.jpg', 'product', '.jpg', NULL, '0', 162, '2019-12-19', '2019-12-19'),
(289, '24-bok-choy.jpg', 'product', '.jpg', NULL, '0', 163, '2019-12-19', '2019-12-19'),
(290, '24-bok-choy.jpg', 'product', '.jpg', NULL, '0', 164, '2019-12-19', '2019-12-19'),
(291, '24-bok-choy.jpg', 'product', '.jpg', NULL, '0', 165, '2019-12-19', '2019-12-19'),
(292, '24-bok-choy.jpg', 'product', '.jpg', NULL, '0', 166, '2019-12-19', '2019-12-19'),
(293, '24-bok-choy.jpg', 'product', '.jpg', NULL, '0', 167, '2019-12-19', '2019-12-19'),
(294, '24-bok-choy.jpg', 'product', '.jpg', NULL, '0', 168, '2019-12-19', '2019-12-19'),
(295, '3.jpg', 'influencer_banking', '.jpg', NULL, '0', 0, '2019-12-23', '2019-12-23'),
(296, '3.jpg', 'influencer_banking', '.jpg', NULL, '0', 0, '2019-12-23', '2019-12-23'),
(297, 'a.png', 'influencer_banking', '.png', NULL, '0', 0, '2019-12-23', '2019-12-23'),
(298, 'tải xuống (1).jpg', 'user_profile', '.jpg', NULL, '0', 0, '2019-12-23', '2019-12-23'),
(299, 'tải xuống (2).jpg', 'user_profile', '.jpg', NULL, '0', 0, '2019-12-23', '2019-12-23'),
(300, '52forest_snow_tourist_143012_1920x1080.png', 'influencer_banking', '.png', NULL, '0', 0, '2019-12-23', '2019-12-23'),
(301, 'tải xuống (2).jpg', 'user_profile', '.jpg', NULL, '0', 0, '2019-12-23', '2019-12-23'),
(302, 'images (1).jpg', 'user_profile', '.jpg', NULL, '0', 0, '2019-12-23', '2019-12-23'),
(303, 'asl.jpg', 'user_profile', '.jpg', NULL, '0', 0, '2019-12-23', '2019-12-23'),
(304, 'asl.jpg', 'user_profile', '.jpg', NULL, '0', 0, '2019-12-23', '2019-12-23'),
(305, 'asl.jpg', 'user_profile', '.jpg', NULL, '0', 0, '2019-12-23', '2019-12-23'),
(306, '3.jpg', 'influencer_banking', '.jpg', NULL, '0', 0, '2019-12-24', '2019-12-24'),
(307, 'tải xuống (1).jpg', 'product', '.jpg', NULL, '0', 135, '2019-12-24', '2019-12-24'),
(325, 'asl.jpg', 'user_profile', '.jpg', NULL, '0', 84, '2020-01-03', '2020-01-03'),
(326, 'download.jpg', 'influencer-profile', '.jpg', NULL, 'font_thumb', 26, '2020-01-03', '2020-01-03'),
(327, 'images (1).jpg', 'influencer-profile', '.jpg', NULL, 'back_thumb', 26, '2020-01-03', '2020-01-03'),
(328, 'images.png', 'influencer-profile', '.png', NULL, 'bank_thumb', 26, '2020-01-03', '2020-01-03'),
(329, 'tải xuống.png', 'user_profile', '.png', NULL, '0', 79, '2020-01-03', '2020-01-03'),
(330, 'avaatar_thomas.jpg', 'user_profile', '.jpg', NULL, '0', 78, '2020-01-06', '2020-01-06'),
(331, 'images (3).jpg', 'user_profile', '.jpg', NULL, '0', 0, '2020-01-06', '2020-01-06'),
(333, 'images.png', 'user_profile', '.png', NULL, '0', 64, '2020-01-06', '2020-01-06'),
(334, 'asl.jpg', 'user_profile', '.jpg', NULL, '0', 69, '2020-01-07', '2020-01-07'),
(335, 'avaatar_thomas.jpg', 'user_profile', '.jpg', NULL, '0', 88, '2020-01-10', '2020-01-10'),
(336, 'images (2).jpg', 'user_profile', '.jpg', NULL, '0', 58, '2020-01-13', '2020-01-13'),
(337, 'a.png', 'product', '.png', NULL, '0', 170, '2020-01-21', '2020-01-21'),
(338, '52forest_snow_tourist_143012_1920x1080.png', 'product', '.png', NULL, '0', 171, '2020-01-21', '2020-01-21'),
(339, '03.png', 'product', '.png', NULL, '1', 171, '2020-01-21', '2020-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `influencers`
--

CREATE TABLE `influencers` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `bank_name` text NOT NULL,
  `bank_acc_name` varchar(101) NOT NULL,
  `bank_acc_num` varchar(30) NOT NULL,
  `commission` float NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `reason_block` text DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `influencers`
--

INSERT INTO `influencers` (`id`, `user_id`, `bank_name`, `bank_acc_name`, `bank_acc_num`, `commission`, `status`, `reason_block`, `updated_at`, `created_at`) VALUES
(13, 61, '2', '32342342324', '23423423', 3, 1, NULL, '2020-01-02 10:21:53', '2019-12-17 02:07:20'),
(14, 62, '2', '32342342324', '23423423', 5, 2, 'Influencer not exist', '2020-01-02 10:21:53', '2019-12-17 02:11:01'),
(16, 68, '2', '32342342324', '23423423', 7, 1, NULL, '2020-01-02 10:21:53', '2019-12-18 03:21:27'),
(17, 70, '2', '32342342324', '23423423', 5, 2, NULL, '2020-01-02 10:21:53', '2019-12-19 21:03:18'),
(18, 71, '2', '32342342324', '23423423', 5, 1, NULL, '2020-01-02 10:21:53', '2019-12-19 23:49:50'),
(19, 75, 'ngan hang tpbank', '32342342324', '23423423', 5, 1, NULL, '2020-01-02 10:21:53', '2019-12-23 06:58:37'),
(20, 77, '34', '32342342324', '23423423', 0, 0, NULL, '2020-01-02 10:21:53', '2019-12-23 10:23:47'),
(21, 78, '423434', '32342342324', '12345679', 5, 1, NULL, '2020-01-02 10:55:22', '2019-12-23 11:36:42'),
(25, 83, 'tpabnk', '32342342324', '23423423', 5, 1, NULL, '2020-01-02 10:21:53', '2019-12-24 08:12:41'),
(26, 84, 'tpbanka', 'thongmas', '2342342366', 5, 1, NULL, '2020-01-20 03:45:51', '2020-01-02 02:18:42'),
(28, 87, 'tpabnk', 'dinh cong thong', '002934923', 0, 2, NULL, '2020-01-14 02:26:29', '2020-01-07 07:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `influencers_commission_histories`
--

CREATE TABLE `influencers_commission_histories` (
  `id` int(11) NOT NULL,
  `influencer_id` int(11) DEFAULT NULL,
  `commission_money` float NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `payment_date` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `influencers_commission_histories`
--

INSERT INTO `influencers_commission_histories` (`id`, `influencer_id`, `commission_money`, `order_id`, `status`, `payment_date`, `updated_at`, `created_at`) VALUES
(258, 25, 0, 258, 2, NULL, '2019-12-26 02:55:40', '2019-12-26 02:35:18'),
(259, 21, 501000, 259, 0, NULL, '2019-12-26 07:12:34', '2019-12-26 07:12:34'),
(260, 21, 1001, 260, 2, NULL, '2020-01-03 08:22:47', '2019-12-26 08:57:08'),
(261, 21, 1001, 261, 2, NULL, '2020-01-03 08:22:58', '2019-12-26 08:59:34'),
(262, 21, 0, 264, 2, NULL, '2020-01-09 04:51:38', '2020-01-09 04:02:04'),
(263, 21, 0, 265, 2, NULL, '2020-01-09 10:31:18', '2020-01-09 06:12:27'),
(264, 21, 0, 266, 2, NULL, '2020-01-10 03:03:03', '2020-01-09 07:53:44'),
(265, 21, 5001000, 267, 0, NULL, '2020-01-09 10:26:09', '2020-01-09 10:26:09'),
(266, 26, 1001000, 268, 0, NULL, '2020-01-10 03:29:19', '2020-01-10 03:29:19'),
(267, 26, 2001000, 271, 0, NULL, '2020-01-13 02:06:28', '2020-01-13 02:06:28'),
(268, 26, 501000, 272, 0, NULL, '2020-01-15 09:21:10', '2020-01-15 09:21:10'),
(269, 26, 2234, 273, 0, NULL, '2020-01-20 02:28:06', '2020-01-20 02:28:06'),
(270, 26, 0, 274, 2, NULL, '2020-01-22 07:08:22', '2020-01-20 02:36:34'),
(271, 26, 1001000, 275, 0, NULL, '2020-01-20 02:36:44', '2020-01-20 02:36:44'),
(272, 26, 501000, 276, 0, NULL, '2020-01-20 02:36:50', '2020-01-20 02:36:50'),
(273, 26, 501000, 277, 0, NULL, '2020-01-20 02:36:57', '2020-01-20 02:36:57'),
(274, 26, 501000, 278, 0, NULL, '2020-01-20 02:41:53', '2020-01-20 02:41:53'),
(275, 26, 501000, 279, 0, NULL, '2020-01-20 02:42:03', '2020-01-20 02:42:03'),
(276, 26, 501000, 280, 0, NULL, '2020-01-20 02:42:11', '2020-01-20 02:42:11'),
(277, 26, 501000, 281, 0, NULL, '2020-01-20 02:42:19', '2020-01-20 02:42:19'),
(278, 26, 501000, 282, 0, NULL, '2020-01-20 02:43:19', '2020-01-20 02:43:19'),
(279, 21, 1000, 283, 0, NULL, '2020-01-20 10:34:10', '2020-01-20 10:34:10'),
(280, 21, 1000, 284, 0, NULL, '2020-01-21 02:35:52', '2020-01-21 02:35:52'),
(281, 21, 1002, 285, 0, NULL, '2020-01-21 03:02:44', '2020-01-21 03:02:44'),
(282, 21, 1050, 286, 0, NULL, '2020-01-21 03:14:26', '2020-01-21 03:14:26'),
(283, 21, 1000, 287, 0, NULL, '2020-01-21 03:35:27', '2020-01-21 03:35:27'),
(284, 21, 62616, 288, 0, NULL, '2020-01-21 03:46:39', '2020-01-21 03:46:39'),
(285, 21, 62616, 289, 0, NULL, '2020-01-21 03:57:12', '2020-01-21 03:57:12'),
(286, 21, 62616, 290, 0, NULL, '2020-01-21 04:52:39', '2020-01-21 04:52:39'),
(287, 21, 251000, 291, 0, NULL, '2020-01-21 08:42:50', '2020-01-21 08:42:50'),
(288, 21, 0, 292, 2, NULL, '2020-01-21 08:54:58', '2020-01-21 08:54:43'),
(289, 21, 5001000, 293, 0, NULL, '2020-01-21 09:10:11', '2020-01-21 09:10:11'),
(290, 21, 0, 294, 2, NULL, '2020-01-21 09:23:08', '2020-01-21 09:21:36'),
(291, 21, 0, 295, 2, NULL, '2020-01-21 09:26:56', '2020-01-21 09:23:50'),
(292, 21, 251000, 296, 0, NULL, '2020-01-21 09:27:26', '2020-01-21 09:27:26'),
(293, 21, 0, 297, 2, NULL, '2020-01-21 09:29:44', '2020-01-21 09:29:09'),
(294, 21, 751000, 298, 0, NULL, '2020-01-21 09:30:13', '2020-01-21 09:30:13'),
(295, 21, 0, 299, 2, NULL, '2020-01-21 09:31:37', '2020-01-21 09:30:59'),
(296, 21, 501000, 300, 0, NULL, '2020-01-21 09:31:54', '2020-01-21 09:31:54'),
(297, 21, 551000, 301, 0, NULL, '2020-01-21 09:32:44', '2020-01-21 09:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `inthelink_info`
--

CREATE TABLE `inthelink_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_acc_num` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `momo_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zalopay_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `editor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inthelink_info`
--

INSERT INTO `inthelink_info` (`id`, `name`, `phone`, `address`, `email`, `website`, `bank_name`, `bank_acc_num`, `momo_info`, `zalopay_info`, `editor_id`, `created_at`, `updated_at`) VALUES
(1, 'INTHELINK', '1900123333', 'Num 2, Ton Duc Thang St, Ben Nghe ward, HCM.', 'linh.hoangmy12@gmail.com', 'https://inthelink.net', '02098812701', '02098812701', '0929753173', '01694535199', 58, '2019-12-24 17:00:00', '2020-01-13 02:09:44');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2019_11_22_022040_create_product_evaluation_table', 2),
(11, '2019_11_22_035146_create_orders_table', 3),
(12, '2019_11_25_034825_create_product_selected_table', 4),
(14, '2014_10_12_000000_create_users_table', 5),
(15, '2019_11_29_111331_create_user_addresses_table', 6),
(16, '2019_12_02_022131_create_delevery_unit_table', 7),
(17, '2019_12_02_022627_create_delivery_unit_table', 8),
(18, '2019_12_02_025617_create_delivery_addresses_table', 9),
(19, '2019_12_03_024632_create_inthelink_info_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'NAX3UiD7mpmnJxybPivMVfGSWyVEwMfX3eIsewnR', 'http://localhost', 1, 0, 0, '2019-11-05 00:11:40', '2019-11-05 00:11:40'),
(2, NULL, 'Laravel Password Grant Client', 'Pj0GVhMbWbnQKJds2sf0uqau2f5Pja2l7yomYTeH', 'http://localhost', 0, 1, 0, '2019-11-05 00:11:40', '2019-11-05 00:11:40'),
(3, NULL, 'Laravel Personal Access Client', 'KegYBhjBcdjDvv5nxJuPcvSjSjDAH1Rkk1UAIQqM', 'http://localhost', 1, 0, 0, '2019-11-05 00:38:28', '2019-11-05 00:38:28'),
(4, NULL, 'Laravel Password Grant Client', 'bdsfv0Excxo9PcopU56fJ7omcNef2M7SU1tXm5eg', 'http://localhost', 0, 1, 0, '2019-11-05 00:38:28', '2019-11-05 00:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-11-05 00:11:40', '2019-11-05 00:11:40'),
(2, 3, '2019-11-05 00:38:28', '2019-11-05 00:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `influencer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `evaluation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_addr` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_unit` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `person_incharge` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_incharge` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `price` decimal(10,0) NOT NULL,
  `total_amount` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `profit` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` int(11) NOT NULL DEFAULT 0,
  `payment_status` int(11) NOT NULL DEFAULT 0,
  `date_receive_est` date NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `influencer_id`, `product_id`, `evaluation_id`, `delivery_addr`, `delivery_unit`, `person_incharge`, `phone_incharge`, `product_name`, `category_name`, `quantity`, `status`, `price`, `total_amount`, `profit`, `payment_method`, `payment_status`, `date_receive_est`, `note`, `created_at`, `updated_at`, `deleted_at`) VALUES
(258, 58, 25, 135, NULL, 'thu duc', 'Inthelink Express', 'joiny', '0293493294', 'Galaxy S10 5G', 'Galaxy S10', 1, 3, '10000000', '10020000', '-20000', 0, 0, '2019-12-28', NULL, '2019-12-01 02:35:18', '2020-01-13 08:57:22', NULL),
(259, 58, 21, 135, NULL, 'thu duc', 'Inthelink Express', 'joiny', '0293493294', 'Galaxy S10 5G', 'Galaxy S10', 1, 3, '10000000', '10020000', '-20000', 0, 0, '2019-12-28', NULL, '2019-12-26 07:12:34', '2020-01-02 07:18:52', NULL),
(260, 79, 21, 169, NULL, 'thu duc', 'Inthelink Express', 'joiny', '0923923493', 'tett last', 'T-Shirt', 1, 4, '10', '20010', '-20000', 0, 0, '2019-12-28', NULL, '2019-12-26 08:57:08', '2020-01-03 08:22:47', NULL),
(261, 79, 21, 169, 122, 'thu duc', 'Inthelink Express', 'joiny', '0923923493', 'tett last', 'T-Shirt', 1, 3, '10', '20010', '-20000', 0, 0, '2019-12-28', NULL, '2020-01-02 08:59:34', '2020-01-03 09:09:12', NULL),
(264, 88, 21, 135, NULL, 'thủ đức', 'Inthelink Express', 'join', '092393922', 'Galaxy S10 5G', 'Galaxy S10', 3, 4, '10000000', '30020000', '-20000', 1, 0, '2020-01-11', NULL, '2020-01-09 04:02:04', '2020-01-09 04:51:38', NULL),
(265, 88, 21, 135, NULL, 'thu duc', 'Inthelink Express', 'join', '029392342', 'Galaxy S10 5G', 'Galaxy S10', 1, 4, '10000000', '10020000', '-20000', 1, 0, '2020-01-11', NULL, '2020-01-09 06:12:27', '2020-01-09 10:31:18', NULL),
(266, 88, 21, 135, NULL, 'thu duc', 'Grab Express', 'join', '029392342', 'Galaxy S10 5G', 'Galaxy S10', 5, 4, '10000000', '50020000', '-20000', 1, 0, '2020-01-12', NULL, '2020-01-09 07:53:44', '2020-01-10 03:03:03', NULL),
(267, 88, 21, 135, 125, 'thu duc', 'Inthelink Express', 'join', '029392342', 'Galaxy S10 5G', 'Galaxy S10', 10, 3, '10000000', '100020000', '-20000', 0, 0, '2020-01-11', NULL, '2020-01-09 10:26:09', '2020-01-13 02:17:15', NULL),
(268, 88, 26, 135, 124, 'thu duc', 'Inthelink Express', 'join', '029392342', 'Galaxy S10 5G', 'Galaxy S10', 2, 3, '10000000', '20020000', '-20000', 0, 0, '2020-01-12', NULL, '2020-01-10 03:29:19', '2020-01-13 02:15:09', NULL),
(271, 88, 26, 135, 123, 'thu duc', 'Inthelink Express', 'join', '029392342', 'Galaxy S10 5G', 'Galaxy S10', 4, 3, '10000000', '40020000', '-20000', 1, 0, '2020-01-15', NULL, '2020-01-13 02:06:28', '2020-01-13 02:11:16', NULL),
(272, 88, 26, 135, NULL, 'thu duc', 'Inthelink Express', 'join', '029392342', 'Galaxy S10 5G', 'Galaxy S10', 1, 0, '10000000', '10020000', '-20000', 0, 0, '2020-01-17', NULL, '2020-01-15 09:21:10', '2020-01-15 09:21:10', NULL),
(273, 88, 26, 156, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Test123', 'Men', 2, 0, '12344', '44688', '-20000', 0, 0, '2020-01-22', NULL, '2020-01-20 02:28:06', '2020-01-20 02:28:06', NULL),
(274, 88, 26, 135, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Galaxy S10 5G', 'Galaxy S10', 1, 4, '10000000', '10020000', '-20000', 0, 0, '2020-01-22', NULL, '2020-01-20 02:36:34', '2020-01-22 07:08:22', NULL),
(275, 88, 26, 135, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Galaxy S10 5G', 'Galaxy S10', 2, 0, '10000000', '20020000', '-20000', 0, 0, '2020-01-22', NULL, '2020-01-20 02:36:44', '2020-01-20 02:36:44', NULL),
(276, 88, 26, 135, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Galaxy S10 5G', 'Galaxy S10', 1, 0, '10000000', '10020000', '-20000', 0, 0, '2020-01-22', NULL, '2020-01-20 02:36:50', '2020-01-20 02:36:50', NULL),
(277, 88, 26, 135, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Galaxy S10 5G', 'Galaxy S10', 1, 0, '10000000', '10020000', '-20000', 0, 0, '2020-01-22', NULL, '2020-01-20 02:36:57', '2020-01-20 02:36:57', NULL),
(278, 88, 26, 135, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Galaxy S10 5G', 'Galaxy S10', 1, 0, '10000000', '10020000', '-20000', 0, 0, '2020-01-22', NULL, '2020-01-20 02:41:53', '2020-01-20 02:41:53', NULL),
(279, 88, 26, 135, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Galaxy S10 5G', 'Galaxy S10', 1, 0, '10000000', '10020000', '-20000', 0, 0, '2020-01-22', NULL, '2020-01-20 02:42:03', '2020-01-20 02:42:03', NULL),
(280, 88, 26, 135, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Galaxy S10 5G', 'Galaxy S10', 1, 0, '10000000', '10020000', '-20000', 0, 0, '2020-01-22', NULL, '2020-01-20 02:42:11', '2020-01-20 02:42:11', NULL),
(281, 88, 26, 135, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Galaxy S10 5G', 'Galaxy S10', 1, 0, '10000000', '10020000', '-20000', 0, 0, '2020-01-22', NULL, '2020-01-20 02:42:19', '2020-01-20 02:42:19', NULL),
(282, 88, 26, 135, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Galaxy S10 5G', 'Galaxy S10', 1, 0, '10000000', '10020000', '-20000', 0, 0, '2020-01-22', NULL, '2020-01-20 02:43:19', '2020-01-20 02:43:19', NULL),
(283, 88, 21, 147, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Louis kha ngon', 'Men', 1, 0, '1', '20001', '-20000', 1, 0, '2020-01-22', NULL, '2020-01-20 10:34:10', '2020-01-20 10:34:10', NULL),
(284, 88, 21, 147, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Louis kha ngon', 'Men', 2, 0, '1', '20002', '-20000', 1, 1, '2020-01-23', NULL, '2020-01-21 02:35:52', '2020-01-21 03:00:58', NULL),
(285, 88, 21, 147, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Louis kha ngon', 'Men', 30, 0, '1', '20030', '-20000', 1, 1, '2020-01-23', NULL, '2020-01-21 03:02:44', '2020-01-21 03:03:22', NULL),
(286, 88, 21, 147, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Louis kha ngon', 'Men', 1000, 0, '1', '21000', '-20000', 0, 0, '2020-01-23', NULL, '2020-01-21 03:14:26', '2020-01-21 03:14:26', NULL),
(287, 88, 21, 147, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Louis kha ngon', 'Men', 1, 0, '1', '20001', '-20000', 1, 1, '2020-01-23', NULL, '2020-01-21 03:35:27', '2020-01-21 03:43:58', NULL),
(288, 88, 21, 170, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Hộp thoại', 'T-Shirt', 1, 0, '1232312', '1252312', '-20000', 1, 1, '2020-01-23', NULL, '2020-01-21 03:46:39', '2020-01-21 03:47:12', NULL),
(289, 88, 21, 170, NULL, 'thu duc', 'Inthelink Express', 'louiseee', '029392342', 'Hộp thoại', 'T-Shirt', 1, 0, '1232312', '1252312', '-20000', 1, 1, '2020-01-23', NULL, '2020-01-21 03:57:12', '2020-01-21 03:58:05', NULL),
(290, 58, 21, 170, NULL, 'thu dcu', 'Inthelink Express', 'toomy', '0345934545', 'Hộp thoại', 'T-Shirt', 1, 0, '1232312', '1252312', '-20000', 1, 1, '2020-01-23', NULL, '2020-01-21 04:52:39', '2020-01-21 06:38:15', NULL),
(291, 58, 21, 171, NULL, 'thu dcu', 'Inthelink Express', 'toomy', '0345934545', 'tada', 'Men', 5, 0, '1000000', '5020000', '-20000', 1, 1, '2020-01-23', NULL, '2020-01-21 08:42:50', '2020-01-21 08:43:29', NULL),
(292, 89, 21, 171, NULL, 'thu3 d9u7c', 'Inthelink Express', 'tommy', '0929349234', 'tada', 'Men', 1, 4, '1000000', '1020000', '-20000', 1, 0, '2020-01-23', NULL, '2020-01-21 08:54:43', '2020-01-21 08:54:58', NULL),
(293, 58, 21, 171, NULL, 'thu dcu', 'Inthelink Express', 'toomy', '0345934545', 'tada', 'Men', 100, 0, '1000000', '100020000', '-20000', 1, 0, '2020-01-23', NULL, '2020-01-21 09:10:11', '2020-01-21 09:10:11', NULL),
(294, 58, 21, 171, NULL, 'thu dcu', 'Inthelink Express', 'toomy', '0345934545', 'tada', 'Men', 19, 4, '1000000', '19020000', '-20000', 1, 0, '2020-01-23', NULL, '2020-01-21 09:21:36', '2020-01-21 09:23:08', NULL),
(295, 58, 21, 171, NULL, 'thu dcu', 'Inthelink Express', 'toomy', '0345934545', 'tada', 'Men', 19, 4, '1000000', '19020000', '-20000', 1, 0, '2020-01-23', NULL, '2020-01-21 09:23:50', '2020-01-21 09:26:56', NULL),
(296, 58, 21, 171, NULL, 'thu dcu', 'Inthelink Express', 'toomy', '0345934545', 'tada', 'Men', 5, 0, '1000000', '5020000', '-20000', 1, 1, '2020-01-23', NULL, '2020-01-21 09:27:26', '2020-01-21 09:28:01', NULL),
(297, 58, 21, 171, NULL, 'thu dcu', 'Inthelink Express', 'toomy', '0345934545', 'tada', 'Men', 18, 4, '1000000', '18020000', '-20000', 1, 0, '2020-01-23', NULL, '2020-01-21 09:29:09', '2020-01-21 09:29:44', NULL),
(298, 58, 21, 171, NULL, 'thu dcu', 'Inthelink Express', 'toomy', '0345934545', 'tada', 'Men', 15, 0, '1000000', '15020000', '-20000', 1, 0, '2020-01-23', NULL, '2020-01-21 09:30:13', '2020-01-21 09:30:13', NULL),
(299, 58, 21, 171, NULL, 'thu dcu', 'Inthelink Express', 'toomy', '0345934545', 'tada', 'Men', 12, 4, '1000000', '12020000', '-20000', 1, 0, '2020-01-23', NULL, '2020-01-21 09:30:59', '2020-01-21 09:31:37', NULL),
(300, 58, 21, 171, NULL, 'thu dcu', 'Inthelink Express', 'toomy', '0345934545', 'tada', 'Men', 10, 0, '1000000', '10020000', '-20000', 1, 1, '2020-01-23', NULL, '2020-01-21 09:31:54', '2020-01-21 09:32:25', NULL),
(301, 58, 21, 171, NULL, 'thu dcu', 'Inthelink Express', 'toomy', '0345934545', 'tada', 'Men', 11, 0, '1000000', '11020000', '-20000', 1, 0, '2020-01-23', NULL, '2020-01-21 09:32:44', '2020-01-21 09:32:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`, `updated_at`) VALUES
(6, 'dinhcongthong97y@gmail.com', '0BVaTYldP6uubHsqrYLsDudzLRYeHxCMHFi7pcVwJeATTYCbNwKDFcaXJBmx', '2020-01-07 06:54:28', '2020-01-07 07:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `inthelink_commission` int(11) NOT NULL,
  `brand` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `description` text CHARACTER SET utf8 DEFAULT NULL,
  `seller_info` text CHARACTER SET utf8 DEFAULT NULL,
  `weight` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `length` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `height` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `width` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `author_id`, `category_id`, `price`, `inthelink_commission`, `brand`, `description`, `seller_info`, `weight`, `length`, `height`, `width`, `updated_at`, `created_at`, `deleted_at`) VALUES
(135, 'Galaxy S10 5G', 58, 14, 10000000, 5, 'china', 'Samsung Galaxy S10 5G Description', NULL, NULL, NULL, NULL, NULL, '2020-01-20 10:44:40', '2019-12-17 02:05:08', NULL),
(136, 'dell inspiron 3559', 58, 16, 10000000, 5, NULL, 'dell of  thomas in gwork', NULL, NULL, NULL, NULL, NULL, '2019-12-18 02:38:14', '2019-12-18 02:38:14', NULL),
(137, 'What is Lorem Ipsum?', 58, 12, 19000000, 5, 'Adidapho', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'is simply dummy text of the printing and typesetting industry.', '20', '10', '10', '10', '2019-12-18 02:53:04', '2019-12-18 02:53:04', NULL),
(138, 'Why do we use it?', 58, 16, 100000, 5, 'Adidapho', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'is simply dummy text of the printing and typesetting industry.', '11', '11', '11', '11', '2019-12-18 02:54:04', '2019-12-18 02:54:04', NULL),
(139, 'Where does it come from?', 58, 10, 99999999, 5, 'Adidapho', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of', 'is simply dummy text of the printing and typesetting industry.', '11', '11', '11', '11', '2019-12-18 02:54:58', '2019-12-18 02:54:58', NULL),
(140, 'Where can I get some?', 58, 4, 2000000, 5, 'Adidapho', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'is simply dummy text of the printing and typesetting industry.', '11', '11', '11', '11', '2019-12-18 02:55:49', '2019-12-18 02:55:49', NULL),
(141, 'DongYanNongSan', 58, 5, 123321123, 5, 'Adidapho', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'is simply dummy text of the printing and typesetting industry.', '123', '123', '312', '321', '2019-12-18 02:57:13', '2019-12-18 02:57:13', NULL),
(142, 'The standard Lorem Ipsum passage, used since the 1500s', 58, 14, 972910129, 5, 'Adidapho', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 'is simply dummy text of the printing and typesetting industry.', '123', '123', '312', '123', '2019-12-18 02:59:49', '2019-12-18 02:59:49', NULL),
(143, 'Section 1.10.32 of \"de Finibus Bonoru', 58, 11, 9999999, 5, 'Adidapho', '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"', 'is simply dummy text of the printing and typesetting industry.', '15', '15', '15', '15', '2019-12-18 03:00:56', '2019-12-18 03:00:56', NULL),
(144, 'I love you your old girlfriends', 58, 11, 100000000, 5, 'Adidapho', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 'is simply dummy text of the printing and typesetting industry.', '123', '123', '123', '123', '2019-12-18 03:03:38', '2019-12-18 03:03:38', NULL),
(145, 'I love you your mother', 58, 4, 12333300, 5, 'Adidapho', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 'is simply dummy text of the printing and typesetting industry.', '12', '12', '12', '12', '2019-12-18 03:05:02', '2019-12-18 03:05:02', NULL),
(146, 'I love you my old girlfriends', 58, 14, 123456789, 5, 'Adidapho', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 'is simply dummy text of the printing and typesetting industry.', '123', '123', '123', '123', '2019-12-18 03:07:00', '2019-12-18 03:07:00', NULL),
(147, 'Louis kha ngon', 58, 9, 1, 5, '12312', '123 123 123', 'Louis ngon', '2', '3', '3', '5', '2020-01-21 03:35:27', '2019-12-18 03:19:33', NULL),
(148, 'Tommy đâm bang', 58, 12, 12344, 5, '123', '23123123', 'DELETE * FROM inthelink', '3', '3', '4', '3', '2019-12-18 03:20:46', '2019-12-18 03:20:46', NULL),
(149, ';DELETE * FROM inthelink.products', 58, 9, 123123, 5, '12312', '123123', 'Louis ngon', '123', '2', '2', '12', '2019-12-18 03:21:57', '2019-12-18 03:21:57', NULL),
(151, 'Tracy sạch sẽ', 58, 9, 19000000, 5, '123', 'abc', '123', '4', '2', '1', '3', '2019-12-18 03:27:06', '2019-12-18 03:27:06', NULL),
(152, 'DELETE FROM inthelink.product', 58, 11, 123, 5, '2', 'Product', '123', '2', '2', '2', '2', '2019-12-18 19:10:14', '2019-12-18 19:10:14', NULL),
(153, 'Thomas có bạn gái >.<', 58, 9, 8999, 5, NULL, '123', '123', '2', '2', '2', '2', '2019-12-18 19:15:37', '2019-12-18 19:15:37', NULL),
(154, 'Test123', 58, 9, 12344, 5, '1', '1', '123', '2', '2', '2', '2', '2019-12-26 05:00:08', '2019-12-18 19:21:12', '2019-12-26 05:00:08'),
(155, 'Test123', 58, 9, 12344, 5, '1', '1', '123', '2', '2', '2', '2', '2019-12-18 19:21:12', '2019-12-18 19:21:12', NULL),
(156, 'Test123', 58, 9, 12344, 5, '1', '1', '123', '2', '2', '2', '2', '2020-01-20 02:28:06', '2019-12-18 19:21:12', NULL),
(157, 'Test123', 58, 9, 12344, 5, '1', '1', '123', '2', '2', '2', '2', '2019-12-18 19:21:13', '2019-12-18 19:21:13', NULL),
(158, 'Test123', 58, 9, 12344, 5, '1', '1', '123', '2', '2', '2', '2', '2019-12-18 19:21:13', '2019-12-18 19:21:13', NULL),
(159, 'Test123', 58, 9, 12344, 5, '1', '1', '123', '2', '2', '2', '2', '2019-12-18 19:21:13', '2019-12-18 19:21:13', NULL),
(160, 'Test123', 58, 9, 12344, 5, '1', '1', '123', '2', '2', '2', '2', '2019-12-18 19:21:13', '2019-12-18 19:21:13', NULL),
(161, 'Test123', 58, 9, 1, 5, '1', '2', '123', '2', '2', '2', '2', '2019-12-18 19:22:00', '2019-12-18 19:22:00', NULL),
(162, 'Test123', 58, 9, 1, 5, '1', '2', '123', '2', '2', '2', '2', '2019-12-18 19:22:01', '2019-12-18 19:22:01', NULL),
(163, 'Test123', 58, 9, 1, 5, '1', '2', '123', '2', '2', '2', '2', '2019-12-18 19:22:01', '2019-12-18 19:22:01', NULL),
(164, 'Test123', 58, 9, 1, 5, '1', '2', '123', '2', '2', '2', '2', '2019-12-18 19:22:01', '2019-12-18 19:22:01', NULL),
(165, 'Test123', 58, 9, 1, 5, '1', '2', '123', '2', '2', '2', '2', '2019-12-19 03:40:18', '2019-12-18 19:22:01', NULL),
(166, 'Test123', 58, 9, 1, 5, '1', '2', '123', '2', '2', '2', '2', '2019-12-18 19:22:02', '2019-12-18 19:22:02', NULL),
(167, 'Test123', 58, 9, 1, 5, '1', '2', '123', '2', '2', '2', '2', '2020-01-20 10:43:57', '2019-12-18 19:22:02', NULL),
(168, 'Test123', 58, 9, 1, 5, '1', '2', '123', '2', '2', '2', '2', '2019-12-18 19:22:02', '2019-12-18 19:22:02', NULL),
(169, 'tett last', 58, 10, 10, 5, NULL, 'test test', NULL, NULL, NULL, NULL, NULL, '2019-12-26 08:59:34', '2019-12-26 04:50:38', NULL),
(170, 'Hộp thoại', 58, 10, 1232312, 5, NULL, 'trang chủ', NULL, '12', '12', '21', '12', '2020-01-21 04:52:39', '2019-12-27 05:03:07', NULL),
(171, 'tada', 58, 9, 1000000, 5, 'vet', 'modal share\r\n- optimize for safari\r\n- menu customer navbar\r\n- change logout and fix reponsive for ordered screen', 'cacacaca', '10', '12', '12', '12', '2020-01-21 08:41:01', '2020-01-21 08:41:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_evaluation`
--

CREATE TABLE `product_evaluation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stars_number` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_evaluation`
--

INSERT INTO `product_evaluation` (`id`, `user_id`, `product_id`, `content`, `stars_number`, `created_at`, `updated_at`, `deleted_at`) VALUES
(115, 64, 135, 'good', 5, '2019-12-17 17:00:00', '2019-12-17 17:00:00', NULL),
(116, 58, 167, NULL, NULL, '2019-12-19 04:23:55', '2019-12-19 04:23:55', NULL),
(117, 58, 135, 'Delivery on time, Good communication', 5, '2019-12-19 23:44:23', '2019-12-19 23:44:23', NULL),
(118, 58, 135, 'Delivery on time', 5, '2019-12-25 06:16:25', '2019-12-25 06:16:25', NULL),
(121, 79, 169, 'Delivery on time', 5, '2020-01-03 09:07:48', '2020-01-03 09:07:48', NULL),
(122, 79, 169, 'Delivery on time', 5, '2020-01-03 09:09:12', '2020-01-03 09:09:12', NULL),
(123, 88, 135, 'Delivery on time', 4, '2020-01-13 02:11:16', '2020-01-13 02:11:16', NULL),
(124, 88, 135, 'Delivery on time, Good communication', 3, '2020-01-13 02:15:09', '2020-01-13 02:15:09', NULL),
(125, 88, 135, 'Bad communication', 2, '2020-01-13 02:17:15', '2020-01-13 02:17:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_selected`
--

CREATE TABLE `product_selected` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_selected`
--

INSERT INTO `product_selected` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(119, 62, 135, '2019-12-17 02:21:25', '2019-12-17 02:21:25'),
(121, 65, 135, '2019-12-17 20:44:18', '2019-12-17 20:44:18'),
(122, 71, 135, '2019-12-19 23:52:30', '2019-12-19 23:52:30'),
(123, 78, 135, '2019-12-26 06:43:01', '2019-12-26 06:43:01'),
(132, 75, 170, '2019-12-31 09:37:49', '2019-12-31 09:37:49'),
(133, 75, 169, '2019-12-31 09:37:50', '2019-12-31 09:37:50'),
(134, 75, 135, '2019-12-31 09:37:52', '2019-12-31 09:37:52'),
(135, 75, 147, '2019-12-31 09:37:54', '2019-12-31 09:37:54'),
(146, 78, 147, '2020-01-07 02:49:13', '2020-01-07 02:49:13'),
(147, 78, 165, '2020-01-07 02:49:23', '2020-01-07 02:49:23'),
(150, 84, 135, '2020-01-10 09:04:37', '2020-01-10 09:04:37');

-- --------------------------------------------------------

--
-- Table structure for table `social_network`
--

CREATE TABLE `social_network` (
  `id` int(11) NOT NULL,
  `link` text NOT NULL,
  `influencer_id` bigint(20) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `social_network`
--

INSERT INTO `social_network` (`id`, `link`, `influencer_id`, `updated_at`, `created_at`) VALUES
(8, 'https://oda.vn/oda/order', 13, '2019-12-17 02:07:20', '2019-12-17 02:07:20'),
(9, 'https://oda.vn/oda/order', 14, '2019-12-18 03:59:05', '2019-12-17 02:11:01'),
(10, 'http://localhost:81/inthelink/public/signup/influencer', 16, '2019-12-18 03:21:27', '2019-12-18 03:21:27'),
(11, 'http://localhost:81/inthelink/public/signup/influencer', 17, '2019-12-19 21:03:18', '2019-12-19 21:03:18'),
(12, 'http://www.naver.com', 18, '2019-12-19 23:49:50', '2019-12-19 23:49:50'),
(13, 'http://localhost:81/inthelink/public/signup/influencer', 19, '2019-12-23 06:58:37', '2019-12-23 06:58:37'),
(14, 'http://52.77.230.41/signup/influencer', 20, '2019-12-23 10:23:47', '2019-12-23 10:23:47'),
(15, 'http://localhost:81/inthelink/public/signup/influencer', 21, '2019-12-23 11:36:42', '2019-12-23 11:36:42'),
(16, 'http://52.77.230.41/signup/influencer', 22, '2019-12-24 01:49:22', '2019-12-24 01:49:22'),
(17, 'http://52.77.230.41/signup/influencer', 23, '2019-12-24 01:50:39', '2019-12-24 01:50:39'),
(18, 'http://localhost:81/inthelink/public/signup/influencer', 24, '2019-12-24 02:00:09', '2019-12-24 02:00:09'),
(19, 'http://localhost:81/inthelink/public/signup/influencer', 25, '2019-12-24 08:12:41', '2019-12-24 08:12:41'),
(20, 'http://localhost:81/inthelink/public/signup/influencer', 26, '2020-01-02 02:18:42', '2020-01-02 02:18:42'),
(21, 'http://localhost:81/inthelink/public/register/influencer', 27, '2020-01-07 07:31:30', '2020-01-07 07:31:30'),
(22, 'http://localhost:81/inthelink/public/register/influencer', 28, '2020-01-07 07:35:44', '2020-01-07 07:35:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `last_sign_in_ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verify_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason_block` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `email_verified_at`, `user_type`, `mobile`, `gender`, `birthday`, `last_sign_in_ip`, `verify_code`, `password`, `remember_token`, `reason_block`, `created_at`, `updated_at`, `deleted_at`) VALUES
(58, 'admin', 'admin@mailinator.com', '2019-12-09 17:00:00', 'admin', '0242342423', 0, '2005-04-03', '::1', 'aebb3bdb-3db1-496b-ac48-0bc58cdaabb3', '$2y$12$EPmmDUFl1xds1j/U3Sxs3OjLvFaty5qCuh0qVij3MS02iwg6raKVG', '3TwaS9JB8I7DrWMo2p90Dig8pAsKHR1U3MJ30Fujk8BrQeCgAxu4mQ5pE9qe', NULL, '2019-12-09 23:19:11', '2020-01-13 03:41:47', NULL),
(64, 'thomascus', 'dinhcongthong97y@gmail.com', '2019-12-16 17:00:00', 'customer', '023424234', 0, '2001-03-18', '::1', '39b962e0-e0ec-4983-a1fb-72955cbfad59', '$2y$12$OMKHTIoDomw7ZJ3PuI4Mo.tAIw6DKe0jORxKfasu7xu89DsvarTru\r\n', 'kReUfSIiEjPovIpHgwIg7HuXRbPRIOnk37vC2trb9yOO8dySMDsWZUybWF5o', NULL, '2019-12-17 02:33:47', '2020-01-08 02:55:08', NULL),
(66, 'iloveyouonelife', 'haoohaoo123@gmail.com', NULL, 'customer', '0972918120', 1, '1948-07-13', '192.168.1.15', NULL, '$2y$10$MGoSyyEw1QNgnX7z81NX/.Klviprs/W4oPHxMpdkUDNadhEVYJs3K', NULL, 'Influencer invalid, Influencer isn\'t exist, oke con de', '2019-12-18 03:08:35', '2019-12-19 21:10:30', NULL),
(67, 'iloveyouonelife123', 'haongolog@gmail.com', NULL, 'admin', '0972918120', 2, '2000-10-21', '192.168.1.15', NULL, '$2y$10$Gko7AH3NP7cxonkf2cCloeGq/ltrcN/HbsHGy5UbI65GX6LoHAegW', NULL, NULL, '2019-12-18 03:16:29', '2019-12-18 03:16:57', NULL),
(68, 'influencer1', 'dcthong081023@gmail.com', '2019-12-18 03:33:52', 'influencer', '091231232', 0, '2004-09-18', '::1', '1d04c198-dfb6-4333-888b-c52fa690949e', '$2y$10$QygVOIPeQnvhBQvFz8kLa.btnKa18g3RseSsTQQC73TbV/VqTAgnC', NULL, 'Influencer not exist', '2019-12-18 03:21:26', '2019-12-23 11:03:07', NULL),
(69, 'customer', 'csu@gmail.com', NULL, 'customer', '0242394323', 0, '2003-11-16', '::1', NULL, '$2y$12$9FROAJFuDY37BpnpEj0bi.TT4S3O2a8PVoFq2jk1jr58yRm0UCWIe', 'KA6VnTfx036CbkTl3dx0jUUg9dvdOAa58tYwQ90mZF9OLi5E7uuNdBcf0O98', NULL, '2019-12-18 03:46:07', '2020-01-07 09:18:06', NULL),
(70, 'influ2', 'dcthong08190@gmail.com', '2019-12-19 21:04:01', 'influencer', '09234234234', 0, '2018-03-04', '::1', '40d7ed0e-893d-479c-846f-656ab1ef9cee', '$2y$10$2/d0N2/FKCMNJQvsfSDV0eAcfu135X/frsdhyCs1K7ZiPHloLOaO2', NULL, 'Influencer isn\'t exist', '2019-12-19 21:03:18', '2019-12-19 21:10:55', '2019-12-19 21:10:55'),
(71, 'kong-influencer', 'aak830117@gmail.com', '2019-12-19 23:50:07', 'influencer', '0787441816', 0, '2019-01-01', '192.168.1.4', 'a987f77b-3518-4554-a6bb-1fa350834500', '$2y$10$g2.dyR10tMYsJwH96pbkpOcNaWiYicgyUBTh5OEOXIqvKi2DMsZSW', NULL, NULL, '2019-12-19 23:49:50', '2019-12-19 23:50:07', NULL),
(72, 'kong-customer', 'konggoon@gmail.com', NULL, 'customer', '0787441817', 0, '2019-01-01', '192.168.1.4', NULL, '$2y$10$LgdojmbxTi9WzhiBIzPHluYmOfRVk2hG9ZFVV3JwKxnz0iV3lQKEC', NULL, NULL, '2019-12-19 23:53:55', '2019-12-19 23:53:55', NULL),
(73, 'kong-customer2', 'kong1@a.com', NULL, 'customer', '0787441818', 0, '2019-01-01', '192.168.1.4', NULL, '$2y$10$PKnR.lxl9393niUJFgZ4ReodNQ0Pd3yHQwvHkZxJ0dp8CND6Byu2W', NULL, NULL, '2019-12-20 00:00:33', '2019-12-20 00:00:33', NULL),
(75, 'influ', 'dcthong081@gmail.com', '2019-12-23 06:59:37', 'influencer', '092934924223', 0, '2001-11-14', '::1', 'a9ee2644-455c-4871-900f-2288059102a0', '$2y$10$z.lRZnmpou8WVrBlIBpMjOcaaE/wLUKM37PaE8AeYX4egmQxxR0Gi', NULL, NULL, '2019-12-23 06:58:37', '2019-12-23 06:59:37', NULL),
(78, 'influ23', 'dcthong@gmail.com', '2019-12-23 11:36:59', 'influencer', '09294934', 1, '2003-10-18', '::1', '9f827a64-ec04-4c89-a924-7579f1d44713', '$2y$10$mE5fSb3s8xuDbftnyhCIce8tpJZZ9D63XSVQLTS1P1e3OAkFRZ9eK', '2MnLDw49FDaX0d9WadqYpbtPRPWiI7bGlpyXywtspoEfgg0DkFquGcvBsfAE', NULL, '2019-12-23 11:36:41', '2020-01-07 08:51:17', NULL),
(79, 'customer', 'abc@gmail.com', NULL, 'customer', '0029492492943', 0, '2003-10-18', '::1', NULL, '$2y$10$gZaqyKy5RwFdE02QmdCFae7O2PEaAxrD7GcuOuLJyCE3bugVpuPK6', NULL, NULL, '2019-12-23 11:40:08', '2020-01-03 08:52:19', NULL),
(83, 'influ11', 'testing1@mailinator.com', '2019-12-24 08:13:12', 'influencer', '0923934', 1, '2003-10-16', '::1', '3614781c-92b8-4fe1-8ec3-046837bbd933', '$2y$10$FU1kVYgsolLNblauDud3cewBye5a9a9XvOv2x0iM3S8G4fIxrEoRS', NULL, NULL, '2019-12-24 08:12:40', '2019-12-24 08:13:12', NULL),
(84, 'thomass', '810.sudo.rm.rf@gmail.com', '2020-01-02 02:19:41', 'influencer', '092394943', 2, '2003-11-20', '::1', 'e93eb84a-f8a4-4fab-8265-f1e010cc1399', '$2y$10$/SpTUaG7CP7K79A3LMTNdOBb4rAz7mv8yBQm4LI..WMrlBkUDGjqe', 'bDgCKMJdZRsa8VBznGSjBQUytQjHTJV4EYFtUadY7URtFJJdtdOOzwRendut', NULL, '2020-01-02 02:18:42', '2020-01-20 03:45:51', NULL),
(87, 'thongdc', 'testing2@mailinator.com', '2020-01-07 07:51:56', 'influencer', '0923942394', 0, '2020-01-01', '::1', '950d1dc1-07bf-4cd7-b539-0a769b966479', '$2y$10$LBodDOTF82gCOqoXSLp3n.nqDQPt/bQ.PY9dcX.UcZKf18gnweCie', 'vj5dPWlBtUzL7lKjuDeVFbOtCDBtQZgtWRdb2OI8lCW4VPx045Lj2f2Q23zb', NULL, '2020-01-07 07:35:44', '2020-01-14 02:26:29', '2020-01-14 02:26:29'),
(88, 'cus_new', 'cusnew@mailinator.com', NULL, 'customer', '0923492349', 1, '2002-02-18', '192.168.1.103', NULL, '$2y$12$9FROAJFuDY37BpnpEj0bi.TT4S3O2a8PVoFq2jk1jr58yRm0UCWIe', '0T1CkfcH8yGNa6gfxgzZERM3Zeekj1i5ZVLJEqz4tA1l77k8gweHIuu1LPbh', NULL, '2020-01-09 02:58:19', '2020-02-03 03:23:22', NULL),
(89, 'thonaa', 't@g.com', NULL, 'customer', '092394293', NULL, NULL, '::1', NULL, '$2y$10$WACJtU5xgo9YzCiO9NlfEOb7srW..3v2PE9Qb9g4fd8SGzog6dGi6', 'WuzQy5wLuvhevUiKTIINaDeLA3SfaRCPaIWlCqj6HP71m1rfri9PBRY5Ww2Z', NULL, '2020-01-21 07:12:39', '2020-01-21 07:12:39', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_idx` (`parent_id`);

--
-- Indexes for table `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_unit`
--
ALTER TABLE `delivery_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `influencers`
--
ALTER TABLE `influencers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `influencers_commission_histories`
--
ALTER TABLE `influencers_commission_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inthelink_info`
--
ALTER TABLE `inthelink_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_idx` (`category_id`);

--
-- Indexes for table `product_evaluation`
--
ALTER TABLE `product_evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_selected`
--
ALTER TABLE `product_selected`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_network`
--
ALTER TABLE `social_network`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `delivery_addresses`
--
ALTER TABLE `delivery_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `delivery_unit`
--
ALTER TABLE `delivery_unit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=340;

--
-- AUTO_INCREMENT for table `influencers`
--
ALTER TABLE `influencers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `influencers_commission_histories`
--
ALTER TABLE `influencers_commission_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `inthelink_info`
--
ALTER TABLE `inthelink_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `product_evaluation`
--
ALTER TABLE `product_evaluation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `product_selected`
--
ALTER TABLE `product_selected`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `social_network`
--
ALTER TABLE `social_network`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
