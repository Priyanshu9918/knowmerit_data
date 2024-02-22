-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2023 at 03:25 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `merit`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus_points`
--

CREATE TABLE `aboutus_points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aboutus_points`
--

INSERT INTO `aboutus_points` (`id`, `title`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'asdfg', '2023082407030115.jpg', 1, '2023-08-24 07:03:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `m_title` varchar(255) DEFAULT NULL,
  `m_description` longtext DEFAULT NULL,
  `m_image` varchar(255) DEFAULT NULL,
  `b_title` varchar(255) DEFAULT NULL,
  `b_description` longtext DEFAULT NULL,
  `b_image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `description`, `image`, `m_title`, `m_description`, `m_image`, `b_title`, `b_description`, `b_image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Want to share your knowledge? Join us a Mentor', '<p style=\"margin: 30px 0px; font-size: 18px; color: rgb(104, 95, 120); font-family: Inter, sans-serif;\">High-definition\r\n video is video of higher resolution and quality than \r\nstandard-definition. While there is no standardized meaning for \r\nhigh-definition, generally any video.</p><p><p></p></p><ul class=\"course-list\" style=\"box-sizing: border-box; padding: 0px; margin-top: 0px; margin-bottom: 35px; color: rgb(34, 16, 13); font-family: Inter, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><li style=\"box-sizing: border-box; list-style: none; font-weight: 600; font-size: 20px; margin-bottom: 20px;\"><i class=\"fa-solid fa-circle-check\" style=\"box-sizing: border-box; -webkit-font-smoothing: antialiased; display: var(--fa-display,inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-family: \" font=\"\" awesome=\"\" 6=\"\" free\";=\"\" font-weight:=\"\" 900;=\"\" color:=\"\" rgb(0,=\"\" 159,=\"\" 255);=\"\" margin-right:=\"\" 15px;\"=\"\"></i>Best Courses</li><li style=\"box-sizing: border-box; list-style: none; font-weight: 600; font-size: 20px; margin-bottom: 20px;\"><i class=\"fa-solid fa-circle-check\" style=\"box-sizing: border-box; -webkit-font-smoothing: antialiased; display: var(--fa-display,inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-family: \" font=\"\" awesome=\"\" 6=\"\" free\";=\"\" font-weight:=\"\" 900;=\"\" color:=\"\" rgb(0,=\"\" 159,=\"\" 255);=\"\" margin-right:=\"\" 15px;\"=\"\"></i>Top rated Instructors</li></ul>', '2023082204572181.png', 'Master the skills to drive your career', '<p><span style=\"color: rgb(104, 95, 120); font-family: Inter, sans-serif; font-size: 16px;\">Get\r\n certified, master modern tech skills, and level up your career — \r\nwhether you’re starting out or a seasoned pro. 95% of eLearning learners\r\n report our hands-on content directly helped their careers.</span></p>', '2023082204572196.png', 'Want to share your knowledge? Join us a Mentor', '<div class=\"section-title\" style=\"color: rgb(34, 16, 13); font-family: Inter, sans-serif; background-color: rgb(251, 252, 255);\"><div class=\"joing-section-text\" style=\"font-size: 14px; color: rgb(41, 41, 41); margin-bottom: 25px;\"><div class=\"section-title\" style=\"color: rgb(34, 16, 13); font-size: 16px;\"><div class=\"joing-section-text\" style=\"font-size: 14px; color: rgb(41, 41, 41); margin-bottom: 25px;\"><p class=\"mb-0\">High-definition video is video of higher resolution and quality than standard-definition. While there is no standardized meaning for high-definition, generally any video.</p></div></div><div class=\"joing-list\" style=\"color: rgb(34, 16, 13); font-size: 16px;\"><ul style=\"padding: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; list-style: none; outline: none;\"><li data-aos=\"fade-bottom\" class=\"aos-init aos-animate\" style=\"opacity: 1; transition-property: opacity, transform; transition-duration: 1.2s; transition-timing-function: ease; transform: translateZ(0px);\"><div class=\"joing-header\" style=\"display: flex; margin-bottom: 47px;\"><span class=\"joing-icon bg-blue\" style=\"background: rgb(57, 44, 125); align-items: center; display: inline-flex; justify-content: center; text-align: center; border-radius: 10px; padding: 0px; width: 70px; height: 70px; flex-shrink: 0;\"><img src=\"http://merit.techsaga.live/assets/img/icon/joing-01.svg\" alt=\"\" class=\"img-fluid\" style=\"filter: hue-rotate(218deg);\"></span><div class=\"joing-content\" style=\"margin-left: 20px;\"><h5 class=\"joing-title\" style=\"font-weight: 700; line-height: 1.2; font-size: 16px; color: rgb(92, 92, 92);\">Stay motivated with engaging instructors</h5><div class=\"joing-para\"><p style=\"margin-bottom: 0px; font-size: 14px; color: rgb(41, 41, 41);\">High-definition video is video of higher resolution and quality than standard-definition.</p><p style=\"margin-bottom: 0px; font-size: 14px; color: rgb(41, 41, 41);\">While there is no standardized meaning for high-definition, generally any video.</p></div></div></div></li><li data-aos=\"fade-bottom\" class=\"aos-init aos-animate\" style=\"opacity: 1; transition-property: opacity, transform; transition-duration: 1.2s; transition-timing-function: ease; transform: translateZ(0px);\"><div class=\"joing-header\" style=\"display: flex; margin-bottom: 47px;\"><span class=\"joing-icon bg-yellow\" style=\"background: rgb(255, 181, 0); align-items: center; display: inline-flex; justify-content: center; text-align: center; border-radius: 10px; padding: 0px; width: 70px; height: 70px; flex-shrink: 0;\"><img src=\"http://merit.techsaga.live/assets/img/icon/joing-02.svg\" alt=\"\" class=\"img-fluid\" style=\"filter: hue-rotate(218deg);\"></span><div class=\"joing-content\" style=\"margin-left: 20px;\"><h5 class=\"joing-title\" style=\"font-weight: 700; line-height: 1.2; font-size: 16px; color: rgb(92, 92, 92);\">Keep up with in the latest in cloud</h5><div class=\"joing-para\"><p style=\"margin-bottom: 0px; font-size: 14px; color: rgb(41, 41, 41);\">High-definition video is video of higher resolution and quality than standard-definition.</p><p style=\"margin-bottom: 0px; font-size: 14px; color: rgb(41, 41, 41);\">While there is no standardized meaning for high-definition, generally any video.</p></div></div></div></li><li data-aos=\"fade-bottom\" class=\"aos-init aos-animate\" style=\"opacity: 1; transition-property: opacity, transform; transition-duration: 1.2s; transition-timing-function: ease; transform: translateZ(0px);\"><div class=\"joing-header\" style=\"display: flex; margin-bottom: 47px;\"><span class=\"joing-icon bg-green\" style=\"background: rgb(33, 180, 119); align-items: center; display: inline-flex; justify-content: center; text-align: center; border-radius: 10px; padding: 0px; width: 70px; height: 70px; flex-shrink: 0;\"><img src=\"http://merit.techsaga.live/assets/img/icon/joing-03.svg\" alt=\"\" class=\"img-fluid\" style=\"filter: hue-rotate(218deg);\"></span><div class=\"joing-content aos\" style=\"margin-left: 20px;\"><h5 class=\"joing-title\" style=\"font-weight: 700; line-height: 1.2; font-size: 16px; color: rgb(92, 92, 92);\">Build skills your way, from labs to courses</h5><div class=\"joing-para\"><p style=\"margin-bottom: 0px; font-size: 14px; color: rgb(41, 41, 41);\">High-definition video is video of higher resolution and quality than standard-definition.</p><p style=\"margin-bottom: 0px; font-size: 14px; color: rgb(41, 41, 41);\">While there is no standardized meaning for high-definition, generally any video.</p></div></div></div></li><li data-aos=\"fade-bottom\" class=\"mb-0 aos-init aos-animate\" style=\"opacity: 1; transition-property: opacity, transform; transition-duration: 1.2s; transition-timing-function: ease; transform: translateZ(0px);\"><div class=\"joing-header\" style=\"display: flex; margin-bottom: 47px;\"><span class=\"joing-icon bg-orange\" style=\"background: rgb(255, 96, 46); align-items: center; display: inline-flex; justify-content: center; text-align: center; border-radius: 10px; padding: 0px; width: 70px; height: 70px; flex-shrink: 0;\"><img src=\"http://merit.techsaga.live/assets/img/icon/joing-04.svg\" alt=\"\" class=\"img-fluid\" style=\"filter: hue-rotate(218deg);\"></span><div class=\"joing-content aos\" style=\"margin-left: 20px;\"><h5 class=\"joing-title\" style=\"font-weight: 700; line-height: 1.2; font-size: 16px; color: rgb(92, 92, 92);\">Get certified with 100+ certification courses</h5><div class=\"joing-para\"><p style=\"margin-bottom: 0px; font-size: 14px; color: rgb(41, 41, 41);\">High-definition video is video of higher resolution and quality than standard-definition.</p><p style=\"margin-bottom: 0px; font-size: 14px; color: rgb(41, 41, 41);\">While there is no standardized meaning for high-definition, generally any video.</p></div></div></div></li></ul></div></div></div>', '2023082204572170.png', 1, '2023-08-22 04:57:21', '2023-08-22 05:42:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `action_masters`
--

CREATE TABLE `action_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) DEFAULT 0,
  `action` varchar(200) DEFAULT NULL,
  `action_title` varchar(255) DEFAULT NULL,
  `show_in_menu` varchar(200) DEFAULT NULL,
  `show_in_permission` varchar(200) DEFAULT NULL,
  `display_order` varchar(200) DEFAULT NULL,
  `icon` varchar(200) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `action_masters`
--

INSERT INTO `action_masters` (`id`, `parent_id`, `action`, `action_title`, `show_in_menu`, `show_in_permission`, `display_order`, `icon`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, '/user', 'Manage User', NULL, NULL, NULL, NULL, 1, '2023-08-16 11:15:51', '2023-08-24 11:15:51', NULL),
(2, 1, '/user/create', 'Manage user create', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(3, 1, '/user/edit', 'Manage user edit', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(4, 0, '/role', 'Manage role', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(5, 4, '/role/create', 'Manage role create', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL),
(6, 4, '/role/edit', 'Manage role edit', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `benifits`
--

CREATE TABLE `benifits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `benifits` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `blog_category` varchar(100) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `b_image` varchar(200) DEFAULT NULL,
  `short_description` longtext DEFAULT NULL,
  `long_description` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_a_classes`
--

CREATE TABLE `book_a_classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `classes_choice` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '0 => Inactive, 1 => Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_a_classes`
--

INSERT INTO `book_a_classes` (`id`, `category`, `pincode`, `first_name`, `email`, `phone`, `classes_choice`, `payment_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Testing', 'India', 'wefref sdfghj,', '9918priyanshu@gmail.com', '8112911291', '', '', 1, '2023-08-30 12:54:34', '2023-08-30 12:54:34'),
(2, 'Testing', 'Malta', 'ritika', 'seegggma@techsaga.co.in', '9625688000', '', '', 1, '2023-08-30 12:59:41', '2023-08-30 12:59:41'),
(6, 'undefined', 'Zürich, Switzerland', 'ritika', 'sandesssssep.s@techsaga.co.in', '9625688000', '', '', 1, '2023-08-30 13:40:32', '2023-08-30 13:40:32'),
(7, 'Development', 'Hyderabad, Telangana 502032, India', 'Naveen Chandra', 'naveenchandrasamala@gmail.com', '8897918239', 'online_class', 'Continue without prime benifits', 1, '2023-08-31 13:33:35', NULL),
(8, 'Development', 'SDF Building, GP Block, Sector V, Bidhannagar, Kolkata, West Bengal, India', 'wrqew', 'abhinav199739@gmail.com', '9874561230', 'online_class', 'Continue without prime benifits', 1, '2023-09-05 23:50:20', NULL),
(9, '', '', '', '', '', '', '', 1, '2023-09-06 03:52:47', '2023-09-06 03:52:47'),
(10, 'Testing', 'Zsdála, Croatia', 'sdfa', 'dasf', '987654324565', '', '', 1, '2023-09-06 03:53:50', '2023-09-06 03:53:50'),
(11, '', '', '', '[object HTMLInputElement]', '', '', '', 1, '2023-09-06 03:57:19', '2023-09-06 03:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent` bigint(20) DEFAULT 0,
  `name` varchar(200) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent`, `name`, `slug`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'testing', 'testing', '2023080711251249.png', 2, '2023-08-07 05:55:12', NULL, '2023-08-08 06:18:11'),
(2, 5, 'category1', 'sdfg', '2023080712480778.png', 2, '2023-08-07 05:58:33', '2023-08-07 07:18:07', '2023-08-08 06:18:17'),
(5, 0, 'Category', 'testing-2', '2023080712054364.png', 2, '2023-08-07 06:35:43', '2023-08-16 12:13:10', '2023-08-16 16:20:38'),
(6, 5, 'category244', 'testing22', '2023080712500449.jpg', 2, '2023-08-07 06:59:15', '2023-08-07 07:21:13', '2023-08-08 06:09:54'),
(7, 0, 'TEST', 'test', '2023081611450578.jpeg', 2, '2023-08-16 11:45:05', NULL, '2023-08-16 12:12:51'),
(8, 7, 'TEST1', 'test1', NULL, 2, '2023-08-16 11:45:19', NULL, '2023-08-16 12:12:56'),
(9, 15, 'Math', 'math', '2023081612573264.png', 2, '2023-08-16 12:14:59', '2023-08-16 12:57:32', '2023-08-16 16:20:24'),
(10, 15, 'English', 'english', '2023081612154609.png', 2, '2023-08-16 12:15:46', '2023-08-16 12:58:18', '2023-08-16 16:20:15'),
(11, 15, 'Coding', 'coding', '2023081612172823.png', 2, '2023-08-16 12:17:28', '2023-08-16 12:58:26', '2023-08-16 16:20:12'),
(12, 15, 'Science', 'science', '2023081612511633.png', 2, '2023-08-16 12:51:16', '2023-08-16 12:57:47', '2023-08-16 16:20:29'),
(13, 15, 'Social Studies', 'social-studies', '2023081612535565.png', 2, '2023-08-16 12:53:55', '2023-08-16 12:57:58', '2023-08-16 16:20:33'),
(14, 15, 'EVS', 'evs', '2023081612553506.png', 2, '2023-08-16 12:55:35', '2023-08-16 12:58:08', '2023-08-16 16:20:20'),
(15, 0, 'K12', 'k12', '2023081612571114.png', 2, '2023-08-16 12:57:11', NULL, '2023-08-16 16:20:44'),
(16, 0, 'K12', 'k12-1', '2023081616210641.png', 1, '2023-08-16 16:21:06', NULL, NULL),
(17, 0, 'Class 5 tuition', 'class-5-tuition', '2023083014223902.jpg', 1, '2023-08-30 14:22:39', NULL, NULL),
(18, 0, 'Class 6 tuition', 'class-6-tuition', '2023083014230982.jpg', 1, '2023-08-30 14:23:09', NULL, NULL),
(19, 0, 'Class 7 tuition', 'class-7-tuition', '2023083014235075.jpg', 1, '2023-08-30 14:23:50', NULL, NULL),
(20, 0, 'Class 8 tuition', 'class-8-tuition', '2023083014243169.jpg', 1, '2023-08-30 14:24:31', NULL, NULL),
(21, 0, 'Class 9 tuition', 'class-9-tuition', '2023083014250761.jpg', 1, '2023-08-30 14:25:07', NULL, NULL),
(22, 0, 'Class 10 tuition', 'class-10-tuition', '2023083014254019.jpg', 1, '2023-08-30 14:25:40', NULL, NULL),
(23, 0, 'Class 11 tuition', 'class-11-tuition', '2023083014272178.jpg', 1, '2023-08-30 14:27:21', NULL, NULL),
(24, 0, 'Class 12 tuition', 'class-12-tuition', '2023083014280424.jpg', 1, '2023-08-30 14:28:04', NULL, NULL),
(25, 17, 'Mathematics', 'mathematics', '2023083014292594.jpg', 1, '2023-08-30 14:29:25', NULL, NULL),
(26, 17, 'English', 'english-1', '2023083014294844.jpg', 1, '2023-08-30 14:29:48', NULL, NULL),
(27, 17, 'Science', 'science-1', '2023083014301306.jpg', 1, '2023-08-30 14:30:13', NULL, NULL),
(28, 17, 'Physics', 'physics', '2023083014305624.jpg', 1, '2023-08-30 14:30:56', NULL, NULL),
(29, 17, 'Hindi', 'hindi', '2023083014312768.jpg', 1, '2023-08-30 14:31:27', NULL, NULL),
(30, 18, 'Mathematics', 'mathematics-1', '2023083014315314.jpg', 1, '2023-08-30 14:31:53', NULL, NULL),
(31, 18, 'English', 'english-2', '2023083014325469.jpg', 1, '2023-08-30 14:32:54', NULL, NULL),
(32, 18, 'Science', 'science-2', '2023083014331602.jpg', 1, '2023-08-30 14:33:16', NULL, NULL),
(33, 18, 'Physics', 'physics-1', '2023083014333982.jpg', 1, '2023-08-30 14:33:39', NULL, NULL),
(34, 18, 'Hindi', 'hindi-1', '2023083014340565.jpg', 1, '2023-08-30 14:34:05', NULL, NULL),
(35, 19, 'Mathematics', 'mathematics-2', '2023083014343129.jpg', 1, '2023-08-30 14:34:31', NULL, NULL),
(36, 19, 'English', 'english-3', '2023083014345597.jpg', 1, '2023-08-30 14:34:55', NULL, NULL),
(37, 19, 'Science', 'science-3', '2023083014354572.jpg', 1, '2023-08-30 14:35:45', NULL, NULL),
(38, 19, 'Physics', 'physics-2', '2023083014362190.jpg', 1, '2023-08-30 14:36:21', NULL, NULL),
(39, 19, 'Hindi', 'hindi-2', '2023083014363830.jpg', 1, '2023-08-30 14:36:38', NULL, NULL),
(40, 20, 'Mathematics', 'mathematics-3', '2023083014380104.jpg', 1, '2023-08-30 14:38:01', NULL, NULL),
(41, 20, 'English', 'english-4', '2023083014383621.jpg', 1, '2023-08-30 14:38:36', NULL, NULL),
(42, 20, 'Science', 'science-4', '2023083014385775.jpg', 1, '2023-08-30 14:38:57', NULL, NULL),
(43, 20, 'Physics', 'physics-3', '2023083014400916.jpg', 1, '2023-08-30 14:40:09', NULL, NULL),
(44, 20, 'Hindi', 'hindi-3', '2023083014402554.jpg', 1, '2023-08-30 14:40:25', NULL, NULL),
(45, 21, 'Mathematics', 'mathematics-4', '2023083014410307.jpg', 1, '2023-08-30 14:41:03', NULL, NULL),
(46, 21, 'English', 'english-5', '2023083014413063.jpg', 1, '2023-08-30 14:41:30', NULL, NULL),
(47, 21, 'Science', 'science-5', '2023083014415843.jpg', 2, '2023-08-30 14:41:58', NULL, '2023-08-30 14:47:07'),
(48, 21, 'Physics', 'physics-4', '2023083014422223.jpg', 1, '2023-08-30 14:42:22', NULL, NULL),
(49, 21, 'Hindi', 'hindi-4', '2023083014425072.jpg', 1, '2023-08-30 14:42:50', NULL, NULL),
(50, 22, 'Mathematics', 'mathematics-5', '2023083014433056.jpg', 1, '2023-08-30 14:43:30', NULL, NULL),
(51, 21, 'Chemistry', 'chemistry', '2023083014475866.jpg', 1, '2023-08-30 14:47:58', NULL, NULL),
(52, 21, 'Biology', 'biology', '2023083014485971.jpg', 1, '2023-08-30 14:48:59', NULL, NULL),
(53, 22, 'Physics', 'physics-5', '2023083014492786.jpg', 1, '2023-08-30 14:49:27', NULL, NULL),
(54, 22, 'Chemistry', 'chemistry-1', '2023083014503984.jpg', 1, '2023-08-30 14:50:39', NULL, NULL),
(55, 22, 'Biology', 'biology-1', '2023083014510002.jpg', 1, '2023-08-30 14:51:00', NULL, NULL),
(56, 22, 'English', 'english-6', '2023083014513168.jpg', 1, '2023-08-30 14:51:31', NULL, NULL),
(57, 23, 'Mathematics', 'mathematics-6', '2023083014515261.jpg', 1, '2023-08-30 14:51:52', NULL, NULL),
(58, 23, 'English', 'english-7', '2023083014522085.jpg', 1, '2023-08-30 14:52:20', NULL, NULL),
(59, 23, 'Physics', 'physics-6', '2023083014524466.jpg', 1, '2023-08-30 14:52:44', NULL, NULL),
(60, 23, 'Chemistry', 'chemistry-2', '2023083014540304.jpg', 1, '2023-08-30 14:54:03', NULL, NULL),
(61, 23, 'Biology', 'biology-2', '2023083014542336.jpg', 1, '2023-08-30 14:54:23', NULL, NULL),
(62, 24, 'Physics', 'physics-7', '2023083014551141.jpg', 1, '2023-08-30 14:55:11', NULL, NULL),
(63, 24, 'Mathematics', 'mathematics-7', '2023083014552979.jpg', 1, '2023-08-30 14:55:29', NULL, NULL),
(64, 24, 'English', 'english-8', '2023083014563638.jpg', 1, '2023-08-30 14:56:36', NULL, NULL),
(65, 24, 'Biology', 'biology-3', '2023083014565610.jpg', 1, '2023-08-30 14:56:56', NULL, NULL),
(66, 24, 'Chemistry', 'chemistry-3', '2023083014571083.jpg', 1, '2023-08-30 14:57:10', NULL, NULL),
(67, 0, 'Dance and Music', 'dance-and-music', '2023090106152896.jpg', 1, '2023-09-01 06:15:28', NULL, NULL),
(68, 67, 'Dance', 'dance', '2023090106161007.jpg', 1, '2023-09-01 06:16:10', NULL, NULL),
(69, 67, 'Hindustani Music', 'hindustani-music', '2023090106163307.jpg', 1, '2023-09-01 06:16:33', NULL, NULL),
(70, 67, 'Guitar', 'guitar', '2023090106171544.jpg', 1, '2023-09-01 06:17:15', NULL, NULL),
(71, 67, 'Carnatic Music', 'carnatic-music', '2023090106174214.jpg', 1, '2023-09-01 06:17:42', NULL, NULL),
(72, 67, 'Keyboard', 'keyboard', '2023090106180770.jpg', 1, '2023-09-01 06:18:07', NULL, NULL),
(73, 67, 'Hobbies', 'hobbies', '2023090106191435.jpg', 2, '2023-09-01 06:19:14', NULL, '2023-09-01 06:19:37'),
(74, 0, 'Hobbies', 'hobbies-1', '2023090106195627.jpg', 1, '2023-09-01 06:19:56', NULL, NULL),
(75, 74, 'Yoga', 'yoga', '2023090106201951.jpg', 1, '2023-09-01 06:20:19', NULL, NULL),
(76, 74, 'Cooking', 'cooking', '2023090106203709.jpg', 1, '2023-09-01 06:20:37', NULL, NULL),
(77, 74, 'Photography', 'photography', '2023090106222651.jpg', 1, '2023-09-01 06:22:26', NULL, NULL),
(78, 74, 'Drawing', 'drawing', '2023090106224779.jpg', 1, '2023-09-01 06:22:47', NULL, NULL),
(79, 74, 'Painting', 'painting', '2023090106231191.jpg', 1, '2023-09-01 06:23:11', NULL, NULL),
(80, 0, 'Other Hobbies', 'other-hobbies', '2023090106244172.jpg', 1, '2023-09-01 06:24:41', NULL, NULL),
(81, 80, 'Singing', 'singing', '2023090106250239.jpg', 1, '2023-09-01 06:25:02', NULL, NULL),
(82, 80, 'Violin', 'violin', '2023090106254067.jpg', 1, '2023-09-01 06:25:40', NULL, NULL),
(83, 80, 'Piano', 'piano', '2023090106260636.jpg', 1, '2023-09-01 06:26:06', NULL, NULL),
(84, 80, 'Makeup', 'makeup', '2023090106262308.jpg', 1, '2023-09-01 06:26:23', NULL, NULL),
(85, 80, 'Handwriting', 'handwriting', '2023090106264742.jpg', 1, '2023-09-01 06:26:47', NULL, NULL),
(86, 0, 'More', 'more', '2023090106271065.jpg', 1, '2023-09-01 06:27:10', NULL, NULL),
(87, 86, 'All hobby Classes', 'all-hobby-classes', '2023090106274221.jpg', 1, '2023-09-01 06:27:42', NULL, NULL),
(88, 0, 'Foreign Languages', 'foreign-languages', '2023090111534708.jpg', 1, '2023-09-01 11:53:47', NULL, NULL),
(89, 88, 'Spoken English', 'spoken-english', '2023090111544516.jpg', 1, '2023-09-01 11:54:45', NULL, NULL),
(90, 88, 'German Language', 'german-language', '2023090111550849.jpg', 1, '2023-09-01 11:55:08', NULL, NULL),
(91, 88, 'French Language', 'french-language', '2023090111553305.jpg', 1, '2023-09-01 11:55:33', NULL, NULL),
(92, 88, 'Spanish Language', 'spanish-language', '2023090111570617.jpg', 1, '2023-09-01 11:57:06', NULL, NULL),
(93, 88, 'Japanese Language', 'japanese-language', '2023090111573378.jpg', 1, '2023-09-01 11:57:33', NULL, NULL),
(94, 0, 'Indian Languages', 'indian-languages', '2023090111575468.jpg', 1, '2023-09-01 11:57:54', NULL, NULL),
(95, 94, 'Hindi Language', 'hindi-language', '2023090111584532.jpg', 1, '2023-09-01 11:58:45', NULL, NULL),
(96, 94, 'Kannada Language', 'kannada-language', '2023090111591162.jpg', 1, '2023-09-01 11:59:11', NULL, NULL),
(97, 94, 'Tamil Language', 'tamil-language', '2023090111593484.jpg', 1, '2023-09-01 11:59:34', NULL, NULL),
(98, 94, 'Telegu Language', 'telegu-language', '2023090112000490.jpg', 1, '2023-09-01 12:00:04', NULL, NULL),
(99, 94, 'Marathi Language', 'marathi-language', '2023090112003795.jpg', 1, '2023-09-01 12:00:37', NULL, NULL),
(100, 0, 'Other Languages', 'other-languages', '2023090112014557.jpg', 1, '2023-09-01 12:01:45', NULL, NULL),
(101, 100, 'Chinese Language', 'chinese-language', '2023090112020627.jpg', 1, '2023-09-01 12:02:06', NULL, NULL),
(102, 100, 'Arabic Language', 'arabic-language', '2023090112024033.jpg', 1, '2023-09-01 12:02:40', NULL, NULL),
(103, 100, 'Russian Language', 'russian-language', '2023090112043427.jpg', 1, '2023-09-01 12:04:34', NULL, NULL),
(104, 100, 'Italian Language', 'italian-language', '2023090112045857.jpg', 1, '2023-09-01 12:04:58', NULL, NULL),
(105, 100, 'Sanskrit Language', 'sanskrit-language', '2023090112051983.jpg', 1, '2023-09-01 12:05:19', NULL, NULL),
(106, 0, 'More', 'more-1', '2023090112060107.jpg', 1, '2023-09-01 12:06:01', NULL, NULL),
(107, 106, 'All Languages', 'all-languages', '2023090112062952.jpg', 1, '2023-09-01 12:06:29', NULL, NULL),
(108, 0, 'Programming Languages', 'programming-languages', '2023090112211848.jpg', 1, '2023-09-01 12:21:18', NULL, NULL),
(109, 108, 'Python Training', 'python-training', '2023090112224233.jpg', 1, '2023-09-01 12:22:42', NULL, NULL),
(110, 108, 'Java Training', 'java-training', '2023090112230240.jpg', 1, '2023-09-01 12:23:02', NULL, NULL),
(111, 108, '.Net Training', '.net-training', '2023090112241930.jpg', 1, '2023-09-01 12:24:19', NULL, NULL),
(112, 108, 'C Language', 'c-language', '2023090112373375.jpg', 1, '2023-09-01 12:37:33', NULL, NULL),
(113, 0, 'IT Training', 'it-training', '2023090113340782.jpg', 1, '2023-09-01 13:34:07', NULL, NULL),
(114, 113, 'Microsoft Excel training', 'microsoft-excel-training', '2023090113343271.jpg', 1, '2023-09-01 13:34:32', NULL, NULL),
(115, 113, 'SAP', 'sap', '2023090113350220.jpg', 1, '2023-09-01 13:35:02', NULL, NULL),
(116, 113, 'Selenium', 'selenium', '2023090113352248.jpg', 1, '2023-09-01 13:35:22', NULL, NULL),
(117, 113, 'Angular.JS', 'angular.js', '2023090113362930.jpg', 1, '2023-09-01 13:36:29', NULL, NULL),
(118, 113, 'Amazon Web Services', 'amazon-web-services', '2023090113414288.jpg', 1, '2023-09-01 13:41:42', NULL, NULL),
(119, 0, 'Other IT Courses', 'other-it-courses', '2023090113420337.jpg', 1, '2023-09-01 13:42:03', NULL, NULL),
(120, 119, 'PHP', 'php', '2023090113423501.jpg', 1, '2023-09-01 13:42:35', NULL, NULL),
(121, 119, 'Java Script Training', 'java-script-training', '2023090113431029.jpg', 1, '2023-09-01 13:43:10', NULL, NULL),
(122, 119, 'Adobe Photoshop Training', 'adobe-photoshop-training', '2023090113433179.jpg', 1, '2023-09-01 13:43:31', NULL, NULL),
(123, 119, 'DevOps Training', 'devops-training', '2023090113435389.jpg', 1, '2023-09-01 13:43:53', NULL, NULL),
(124, 119, 'Data Science', 'data-science', '2023090113442898.jpg', 1, '2023-09-01 13:44:28', NULL, NULL),
(125, 0, 'More', 'more-2', '2023090113445129.jpg', 1, '2023-09-01 13:44:51', NULL, NULL),
(126, 125, 'All IT Courses', 'all-it-courses', '2023090113452979.jpg', 1, '2023-09-01 13:45:29', NULL, NULL),
(127, 125, 'Software Training Institutes', 'software-training-institutes', '2023090113470550.jpg', 1, '2023-09-01 13:47:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cbse`
--

CREATE TABLE `cbse` (
  `id` bigint(20) NOT NULL,
  `parent` tinyint(4) NOT NULL DEFAULT 0,
  `subject` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cbse`
--

INSERT INTO `cbse` (`id`, `parent`, `subject`, `created_at`) VALUES
(1, 0, 'English', '2023-08-24 12:08:20'),
(2, 0, 'Mathematics', '2023-08-24 12:08:20'),
(3, 0, 'Science', '2023-08-24 12:08:20'),
(4, 0, 'EVS', '2023-08-24 12:08:20'),
(5, 0, 'Computers', '2023-08-24 12:08:20'),
(6, 0, 'Hindi', '2023-08-31 12:08:20'),
(7, 0, 'Sanskrit', '2023-08-24 12:08:20'),
(8, 0, 'French', '2023-08-24 12:08:20'),
(9, 0, 'German', '2023-08-24 12:08:20'),
(10, 0, 'Spanish', '2023-08-24 12:08:20'),
(11, 0, 'Marathi', '2023-08-24 12:08:20'),
(12, 0, 'Bengali', '2023-08-24 12:08:20'),
(13, 0, 'Urdu', '2023-08-24 12:08:20'),
(14, 0, 'Tamil', '2023-08-24 12:08:20'),
(15, 0, 'Telugu', '2023-08-31 12:08:20'),
(16, 0, 'Kannada', '2023-08-24 12:08:20'),
(17, 0, 'Malayalam', '2023-08-24 12:08:20'),
(18, 0, 'Punjabi', '2023-08-24 12:08:20'),
(19, 0, 'Japanese', '2023-08-24 12:08:20'),
(20, 0, 'Gujarati', '2023-08-24 12:08:20'),
(21, 0, 'Assamese', '2023-08-24 12:08:20'),
(22, 0, 'Oriya', '2023-08-24 12:08:20'),
(23, 0, 'Manipuri', '2023-08-24 12:08:20'),
(24, 0, 'Social Science', '2023-08-24 12:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` char(36) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` char(36) NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `communities`
--

CREATE TABLE `communities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `community_type` tinyint(4) DEFAULT 0,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `communities`
--

INSERT INTO `communities` (`id`, `title`, `description`, `image`, `community_type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Exploring Leadership', '<p><span style=\"color: rgb(34, 16, 13); font-family: Inter, sans-serif; font-size: 16px; font-style: italic;\">“\r\n This is the second Photoshop course I have completed with Cristian. \r\nWorth every penny and recommend it highly. To get the most out of this \r\ncourse, its best to to take the Beginner to Advanced course first. The \r\nsound and video quality is of a good standard. Thank you Cristian. “</span><br></p>', '2023082205330214.jpg', 1, 2, '2023-08-22 05:33:02', NULL, '2023-08-25 10:27:31'),
(2, 'qe', '<p>cdas<br></p>', '2023090804391082.jpg', 56, 1, '2023-09-07 23:09:10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `community_comments`
--

CREATE TABLE `community_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent` bigint(20) DEFAULT 0,
  `community_id` varchar(200) DEFAULT NULL,
  `user_id` varchar(200) DEFAULT NULL,
  `comment` longtext DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `community_likes`
--

CREATE TABLE `community_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(200) DEFAULT NULL,
  `community_id` varchar(200) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => dislike, 1 => like',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `community_likes`
--

INSERT INTO `community_likes` (`id`, `user_id`, `community_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '2', '1', 1, '2023-08-24 07:13:44', NULL),
(2, '1', '2', 0, '2023-09-08 04:37:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_masters`
--

CREATE TABLE `contact_masters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_sec_fsts`
--

CREATE TABLE `contact_sec_fsts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `one_image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_sec_scnds`
--

CREATE TABLE `contact_sec_scnds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `one_image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Republic Of The Congo', 242),
(50, 'CD', 'Democratic Republic Of The Congo', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` bigint(20) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `symbol` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `country`, `currency`, `code`, `symbol`) VALUES
(1, 'Albania', 'Leke', 'ALL', 'Lek'),
(2, 'America', 'Dollars', 'USD', '$'),
(3, 'Afghanistan', 'Afghanis', 'AFN', '؋'),
(4, 'Argentina', 'Pesos', 'ARS', '$'),
(5, 'Aruba', 'Guilders', 'AWG', 'ƒ'),
(6, 'Australia', 'Dollars', 'AUD', '$'),
(7, 'Azerbaijan', 'New Manats', 'AZN', 'ман'),
(8, 'Bahamas', 'Dollars', 'BSD', '$'),
(9, 'Barbados', 'Dollars', 'BBD', '$'),
(10, 'Belarus', 'Rubles', 'BYR', 'p.'),
(11, 'Belgium', 'Euro', 'EUR', '€'),
(12, 'Beliz', 'Dollars', 'BZD', 'BZ$'),
(13, 'Bermuda', 'Dollars', 'BMD', '$'),
(14, 'Bolivia', 'Bolivianos', 'BOB', '$b'),
(15, 'Bosnia and Herzegovina', 'Convertible Marka', 'BAM', 'KM'),
(16, 'Botswana', 'Pula', 'BWP', 'P'),
(17, 'Bulgaria', 'Leva', 'BGN', 'лв'),
(18, 'Brazil', 'Reais', 'BRL', 'R$'),
(19, 'Britain (United Kingdom)', 'Pounds', 'GBP', '£'),
(20, 'Brunei Darussalam', 'Dollars', 'BND', '$'),
(21, 'Cambodia', 'Riels', 'KHR', '៛'),
(22, 'Canada', 'Dollars', 'CAD', '$'),
(23, 'Cayman Islands', 'Dollars', 'KYD', '$'),
(24, 'Chile', 'Pesos', 'CLP', '$'),
(25, 'China', 'Yuan Renminbi', 'CNY', '¥'),
(26, 'Colombia', 'Pesos', 'COP', '$'),
(27, 'Costa Rica', 'Colón', 'CRC', '₡'),
(28, 'Croatia', 'Kuna', 'HRK', 'kn'),
(29, 'Cuba', 'Pesos', 'CUP', '₱'),
(30, 'Cyprus', 'Euro', 'EUR', '€'),
(31, 'Czech Republic', 'Koruny', 'CZK', 'Kč'),
(32, 'Denmark', 'Kroner', 'DKK', 'kr'),
(33, 'Dominican Republic', 'Pesos', 'DOP ', 'RD$'),
(34, 'East Caribbean', 'Dollars', 'XCD', '$'),
(35, 'Egypt', 'Pounds', 'EGP', '£'),
(36, 'El Salvador', 'Colones', 'SVC', '$'),
(37, 'England (United Kingdom)', 'Pounds', 'GBP', '£'),
(38, 'Euro', 'Euro', 'EUR', '€'),
(39, 'Falkland Islands', 'Pounds', 'FKP', '£'),
(40, 'Fiji', 'Dollars', 'FJD', '$'),
(41, 'France', 'Euro', 'EUR', '€'),
(42, 'Ghana', 'Cedis', 'GHC', '¢'),
(43, 'Gibraltar', 'Pounds', 'GIP', '£'),
(44, 'Greece', 'Euro', 'EUR', '€'),
(45, 'Guatemala', 'Quetzales', 'GTQ', 'Q'),
(46, 'Guernsey', 'Pounds', 'GGP', '£'),
(47, 'Guyana', 'Dollars', 'GYD', '$'),
(48, 'Holland (Netherlands)', 'Euro', 'EUR', '€'),
(49, 'Honduras', 'Lempiras', 'HNL', 'L'),
(50, 'Hong Kong', 'Dollars', 'HKD', '$'),
(51, 'Hungary', 'Forint', 'HUF', 'Ft'),
(52, 'Iceland', 'Kronur', 'ISK', 'kr'),
(53, 'India', 'Rupees', 'INR', 'Rp'),
(54, 'Indonesia', 'Rupiahs', 'IDR', 'Rp'),
(55, 'Iran', 'Rials', 'IRR', '﷼'),
(56, 'Ireland', 'Euro', 'EUR', '€'),
(57, 'Isle of Man', 'Pounds', 'IMP', '£'),
(58, 'Israel', 'New Shekels', 'ILS', '₪'),
(59, 'Italy', 'Euro', 'EUR', '€'),
(60, 'Jamaica', 'Dollars', 'JMD', 'J$'),
(61, 'Japan', 'Yen', 'JPY', '¥'),
(62, 'Jersey', 'Pounds', 'JEP', '£'),
(63, 'Kazakhstan', 'Tenge', 'KZT', 'лв'),
(64, 'Korea (North)', 'Won', 'KPW', '₩'),
(65, 'Korea (South)', 'Won', 'KRW', '₩'),
(66, 'Kyrgyzstan', 'Soms', 'KGS', 'лв'),
(67, 'Laos', 'Kips', 'LAK', '₭'),
(68, 'Latvia', 'Lati', 'LVL', 'Ls'),
(69, 'Lebanon', 'Pounds', 'LBP', '£'),
(70, 'Liberia', 'Dollars', 'LRD', '$'),
(71, 'Liechtenstein', 'Switzerland Francs', 'CHF', 'CHF'),
(72, 'Lithuania', 'Litai', 'LTL', 'Lt'),
(73, 'Luxembourg', 'Euro', 'EUR', '€'),
(74, 'Macedonia', 'Denars', 'MKD', 'ден'),
(75, 'Malaysia', 'Ringgits', 'MYR', 'RM'),
(76, 'Malta', 'Euro', 'EUR', '€'),
(77, 'Mauritius', 'Rupees', 'MUR', '₨'),
(78, 'Mexico', 'Pesos', 'MXN', '$'),
(79, 'Mongolia', 'Tugriks', 'MNT', '₮'),
(80, 'Mozambique', 'Meticais', 'MZN', 'MT'),
(81, 'Namibia', 'Dollars', 'NAD', '$'),
(82, 'Nepal', 'Rupees', 'NPR', '₨'),
(83, 'Netherlands Antilles', 'Guilders', 'ANG', 'ƒ'),
(84, 'Netherlands', 'Euro', 'EUR', '€'),
(85, 'New Zealand', 'Dollars', 'NZD', '$'),
(86, 'Nicaragua', 'Cordobas', 'NIO', 'C$'),
(87, 'Nigeria', 'Nairas', 'NGN', '₦'),
(88, 'North Korea', 'Won', 'KPW', '₩'),
(89, 'Norway', 'Krone', 'NOK', 'kr'),
(90, 'Oman', 'Rials', 'OMR', '﷼'),
(91, 'Pakistan', 'Rupees', 'PKR', '₨'),
(92, 'Panama', 'Balboa', 'PAB', 'B/.'),
(93, 'Paraguay', 'Guarani', 'PYG', 'Gs'),
(94, 'Peru', 'Nuevos Soles', 'PEN', 'S/.'),
(95, 'Philippines', 'Pesos', 'PHP', 'Php'),
(96, 'Poland', 'Zlotych', 'PLN', 'zł'),
(97, 'Qatar', 'Rials', 'QAR', '﷼'),
(98, 'Romania', 'New Lei', 'RON', 'lei'),
(99, 'Russia', 'Rubles', 'RUB', 'руб'),
(100, 'Saint Helena', 'Pounds', 'SHP', '£'),
(101, 'Saudi Arabia', 'Riyals', 'SAR', '﷼'),
(102, 'Serbia', 'Dinars', 'RSD', 'Дин.'),
(103, 'Seychelles', 'Rupees', 'SCR', '₨'),
(104, 'Singapore', 'Dollars', 'SGD', '$'),
(105, 'Slovenia', 'Euro', 'EUR', '€'),
(106, 'Solomon Islands', 'Dollars', 'SBD', '$'),
(107, 'Somalia', 'Shillings', 'SOS', 'S'),
(108, 'South Africa', 'Rand', 'ZAR', 'R'),
(109, 'South Korea', 'Won', 'KRW', '₩'),
(110, 'Spain', 'Euro', 'EUR', '€'),
(111, 'Sri Lanka', 'Rupees', 'LKR', '₨'),
(112, 'Sweden', 'Kronor', 'SEK', 'kr'),
(113, 'Switzerland', 'Francs', 'CHF', 'CHF'),
(114, 'Suriname', 'Dollars', 'SRD', '$'),
(115, 'Syria', 'Pounds', 'SYP', '£'),
(116, 'Taiwan', 'New Dollars', 'TWD', 'NT$'),
(117, 'Thailand', 'Baht', 'THB', '฿'),
(118, 'Trinidad and Tobago', 'Dollars', 'TTD', 'TT$'),
(119, 'Turkey', 'Lira', 'TRY', 'TL'),
(120, 'Turkey', 'Liras', 'TRL', '£'),
(121, 'Tuvalu', 'Dollars', 'TVD', '$'),
(122, 'Ukraine', 'Hryvnia', 'UAH', '₴'),
(123, 'United Kingdom', 'Pounds', 'GBP', '£'),
(124, 'United States of America', 'Dollars', 'USD', '$'),
(125, 'Uruguay', 'Pesos', 'UYU', '$U'),
(126, 'Uzbekistan', 'Sums', 'UZS', 'лв'),
(127, 'Vatican City', 'Euro', 'EUR', '€'),
(128, 'Venezuela', 'Bolivares Fuertes', 'VEF', 'Bs'),
(129, 'Vietnam', 'Dong', 'VND', '₫'),
(130, 'Yemen', 'Rials', 'YER', '﷼'),
(131, 'Zimbabwe', 'Zimbabwe Dollars', 'ZWD', 'Z$'),
(132, 'India', 'Rupees', 'INR', '₹');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `name`, `email`, `subject`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'nupur', 'nupur@knowmerit.com', 'dcd', 'sss', 1, '2023-09-04 06:25:07', NULL),
(2, 'Abhinav Singh', 'abhinavkuamrsingh217@gmail.com', 'sdf', 'sdaf', 1, '2023-09-08 23:00:45', NULL),
(3, 'Abhinav Singh', 'abhinavkuamrsingh217@gmail.com', 'sdf', 'sdaf', 1, '2023-09-08 23:00:46', NULL);

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` longtext DEFAULT NULL,
  `f_type` tinyint(4) DEFAULT 0 COMMENT '0 => student, 1 => teacher',
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `f_type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'wartyuuythrgefwdqsa', '<p>dfsdfgfhj,k,dss</p>', NULL, 2, '2023-08-11 13:31:26', '2023-08-12 05:12:48', '2023-08-12 06:48:21'),
(2, 'wartyuuythrgefwdqsadsaas', '<p>dfsdfgfhj,k,sadfas</p>', NULL, 2, '2023-08-11 13:31:34', '2023-08-11 13:47:18', '2023-08-12 06:48:15'),
(3, 'sadf', '<p>sadsdf</p>', 1, 2, '2023-08-11 13:31:57', '2023-08-12 06:47:50', '2023-08-12 06:48:26'),
(4, 'dasf', '<p>sdf</p>', 0, 2, '2023-08-12 06:47:23', NULL, '2023-08-12 06:48:31'),
(5, 'What is your Name?', '<p>My Name is Abhinav Kumar .</p>', 0, 1, '2023-08-12 06:49:03', NULL, NULL),
(6, 'What is your Job?', '<p>IT Company</p>', 1, 1, '2023-08-12 06:50:33', '2023-08-12 12:06:26', NULL),
(7, 'fdsgdfsgdsgsd', '<p>dfgdfsgdsgdsfgfdsgdsfgssdfgdsfdgdsgdsg</p>', 0, 2, '2023-08-12 06:51:02', '2023-08-12 06:51:53', '2023-08-16 09:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `featureds`
--

CREATE TABLE `featureds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `featureds`
--

INSERT INTO `featureds` (`id`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '<p>Get certified, master modern tech skills, and level up your career — whether\r\n                                you’re starting out or a seasoned pro. 95% . Get certified, master modern tech skills, and\r\n                                level up your career — whether you’re starting out or a seasoned pro. 95% of eLearning\r\n                                learners report our hands-on content directly helped their careers.</p>', 1, '2023-09-11 06:58:12', '2023-09-11 06:59:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `icse`
--

CREATE TABLE `icse` (
  `id` bigint(20) NOT NULL,
  `parent` varchar(200) NOT NULL DEFAULT '0',
  `subject` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `icse`
--

INSERT INTO `icse` (`id`, `parent`, `subject`) VALUES
(1, '0', 'English'),
(2, '0', 'Social Studies'),
(3, '0', 'Mathematics'),
(4, '0', 'Science'),
(5, '0', 'EVS'),
(6, '0', 'Hindi'),
(7, '0', 'Sanskrit'),
(8, '0', 'French'),
(9, '0', 'Telugu'),
(10, '0', 'Malayalam'),
(11, '0', 'German'),
(12, '0', 'Kannada'),
(13, '0', 'Spanish'),
(14, '0', 'Tamil'),
(15, '0', 'Punjabi'),
(16, '0', 'Gujarathi'),
(17, '0', 'Urdu'),
(18, '0', 'Marathi'),
(19, '0', 'Bengali'),
(20, '0', 'Assamese'),
(21, '0', 'Manipuri'),
(22, '0', 'Mizo'),
(23, '0', 'Computer science\n'),
(24, '0', 'Bengali');

-- --------------------------------------------------------

--
-- Table structure for table `igcse`
--

CREATE TABLE `igcse` (
  `id` bigint(20) NOT NULL,
  `parent` tinyint(4) NOT NULL DEFAULT 0,
  `subject` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `igcse`
--

INSERT INTO `igcse` (`id`, `parent`, `subject`) VALUES
(1, 0, 'English'),
(2, 0, 'Mathematics'),
(3, 0, 'Science'),
(4, 0, 'Hindi'),
(5, 0, 'Bengali');

-- --------------------------------------------------------

--
-- Table structure for table `international_baccalaureate_sub`
--

CREATE TABLE `international_baccalaureate_sub` (
  `id` bigint(20) NOT NULL,
  `parent` tinyint(4) NOT NULL DEFAULT 0,
  `subject` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `international_baccalaureate_sub`
--

INSERT INTO `international_baccalaureate_sub` (`id`, `parent`, `subject`) VALUES
(1, 0, 'English'),
(2, 0, 'Mathematics'),
(3, 0, 'Science'),
(4, 0, 'Social studies'),
(5, 0, 'Hindi'),
(6, 0, 'Arts'),
(7, 0, 'Computers'),
(8, 0, 'French'),
(9, 0, 'German'),
(10, 0, 'Spanish'),
(11, 0, 'Chinese'),
(12, 0, 'Japanese'),
(13, 0, 'Personal, Social and Physical education');

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `id` varchar(64) NOT NULL,
  `value` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`id`, `value`) VALUES
('aa', 'Afar'),
('ab', 'Abkhazian'),
('ace', 'Achinese'),
('ach', 'Acoli'),
('ada', 'Adangme'),
('ady', 'Adyghe'),
('ae', 'Avestan'),
('aeb', 'Tunisian Arabic'),
('af', 'Afrikaans'),
('afh', 'Afrihili'),
('agq', 'Aghem'),
('ain', 'Ainu'),
('ak', 'Akan'),
('akk', 'Akkadian'),
('akz', 'Alabama'),
('ale', 'Aleut'),
('aln', 'Gheg Albanian'),
('alt', 'Southern Altai'),
('am', 'Amarik'),
('an', 'Aragonese'),
('ang', 'Old English'),
('anp', 'Angika'),
('ar', 'Arabik'),
('ar_001', 'Modern Standard Arabic'),
('arc', 'Aramaic'),
('arn', 'Mapuche'),
('aro', 'Araona'),
('arp', 'Arapaho'),
('arq', 'Algerian Arabic'),
('arw', 'Arawak'),
('ary', 'Moroccan Arabic'),
('arz', 'Egyptian Arabic'),
('as', 'Assamese'),
('asa', 'Asu'),
('ase', 'American Sign Language'),
('ast', 'Asturian'),
('av', 'Avaric'),
('avk', 'Kotava'),
('awa', 'Awadhi'),
('ay', 'Aymara'),
('az', 'Azerbaijani'),
('azb', 'South Azerbaijani'),
('ba', 'Bashkir'),
('bal', 'Baluchi'),
('ban', 'Balinese'),
('bar', 'Bavarian'),
('bas', 'Basaa'),
('bax', 'Bamun'),
('bbc', 'Batak Toba'),
('bbj', 'Ghomala'),
('be', 'Belarus kasa'),
('bej', 'Beja'),
('bem', 'Bemba'),
('bew', 'Betawi'),
('bez', 'Bena'),
('bfd', 'Bafut'),
('bfq', 'Badaga'),
('bg', 'Bɔlgeria kasa'),
('bho', 'Bhojpuri'),
('bi', 'Bislama'),
('bik', 'Bikol'),
('bin', 'Bini'),
('bjn', 'Banjar'),
('bkm', 'Kom'),
('bla', 'Siksika'),
('bm', 'Bambara'),
('bn', 'Bengali kasa'),
('bo', 'Tibetan'),
('bpy', 'Bishnupriya'),
('bqi', 'Bakhtiari'),
('br', 'Breton'),
('bra', 'Braj'),
('brh', 'Brahui'),
('brx', 'Bodo'),
('bs', 'Bosnian'),
('bss', 'Akoose'),
('bua', 'Buriat'),
('bug', 'Buginese'),
('bum', 'Bulu'),
('byn', 'Blin'),
('byv', 'Medumba'),
('ca', 'Catalan'),
('cad', 'Caddo'),
('car', 'Carib'),
('cay', 'Cayuga'),
('cch', 'Atsam'),
('ce', 'Chechen'),
('ceb', 'Cebuano'),
('cgg', 'Chiga'),
('ch', 'Chamorro'),
('chb', 'Chibcha'),
('chg', 'Chagatai'),
('chk', 'Chuukese'),
('chm', 'Mari'),
('chn', 'Chinook Jargon'),
('cho', 'Choctaw'),
('chp', 'Chipewyan'),
('chr', 'Cherokee'),
('chy', 'Cheyenne'),
('ckb', 'Central Kurdish'),
('co', 'Corsican'),
('cop', 'Coptic'),
('cps', 'Capiznon'),
('cr', 'Cree'),
('crh', 'Crimean Turkish'),
('cs', 'Kyɛk kasa'),
('csb', 'Kashubian'),
('cu', 'Church Slavic'),
('cv', 'Chuvash'),
('cy', 'Welsh'),
('da', 'Danish'),
('dak', 'Dakota'),
('dar', 'Dargwa'),
('dav', 'Taita'),
('de', 'Gyaaman'),
('de_AT', 'Austrian German'),
('de_CH', 'Swiss High German'),
('del', 'Delaware'),
('den', 'Slave'),
('dgr', 'Dogrib'),
('din', 'Dinka'),
('dje', 'Zarma'),
('doi', 'Dogri'),
('dsb', 'Lower Sorbian'),
('dtp', 'Central Dusun'),
('dua', 'Duala'),
('dum', 'Middle Dutch'),
('dv', 'Divehi'),
('dyo', 'Jola-Fonyi'),
('dyu', 'Dyula'),
('dz', 'Dzongkha'),
('dzg', 'Dazaga'),
('ebu', 'Embu'),
('ee', 'Ewe'),
('efi', 'Efik'),
('egl', 'Emilian'),
('egy', 'Ancient Egyptian'),
('eka', 'Ekajuk'),
('el', 'Greek kasa'),
('elx', 'Elamite'),
('en', 'Borɔfo'),
('en_AU', 'Australian English'),
('en_CA', 'Canadian English'),
('en_GB', 'British English'),
('en_US', 'American English'),
('enm', 'Middle English'),
('eo', 'Esperanto'),
('es', 'Spain kasa'),
('es_419', 'Latin American Spanish'),
('es_ES', 'European Spanish'),
('es_MX', 'Mexican Spanish'),
('esu', 'Central Yupik'),
('et', 'Estonian'),
('eu', 'Basque'),
('ewo', 'Ewondo'),
('ext', 'Extremaduran'),
('fa', 'Pɛɛhyia kasa'),
('fan', 'Fang'),
('fat', 'Fanti'),
('ff', 'Fulah'),
('fi', 'Finnish'),
('fil', 'Filipino'),
('fit', 'Tornedalen Finnish'),
('fj', 'Fijian'),
('fo', 'Faroese'),
('fon', 'Fon'),
('fr', 'Frɛnkye'),
('fr_CA', 'Canadian French'),
('fr_CH', 'Swiss French'),
('frc', 'Cajun French'),
('frm', 'Middle French'),
('fro', 'Old French'),
('frp', 'Arpitan'),
('frr', 'Northern Frisian'),
('frs', 'Eastern Frisian'),
('fur', 'Friulian'),
('fy', 'Western Frisian'),
('ga', 'Irish'),
('gaa', 'Ga'),
('gag', 'Gagauz'),
('gan', 'Gan Chinese'),
('gay', 'Gayo'),
('gba', 'Gbaya'),
('gbz', 'Zoroastrian Dari'),
('gd', 'Scottish Gaelic'),
('gez', 'Geez'),
('gil', 'Gilbertese'),
('gl', 'Galician'),
('glk', 'Gilaki'),
('gmh', 'Middle High German'),
('gn', 'Guarani'),
('goh', 'Old High German'),
('gom', 'Goan Konkani'),
('gon', 'Gondi'),
('gor', 'Gorontalo'),
('got', 'Gothic'),
('grb', 'Grebo'),
('grc', 'Ancient Greek'),
('gsw', 'Swiss German'),
('gu', 'Gujarati'),
('guc', 'Wayuu'),
('gur', 'Frafra'),
('guz', 'Gusii'),
('gv', 'Manx'),
('gwi', 'Gwichʼin'),
('ha', 'Hausa'),
('hai', 'Haida'),
('hak', 'Hakka Chinese'),
('haw', 'Hawaiian'),
('he', 'Hebrew'),
('hi', 'Hindi'),
('hif', 'Fiji Hindi'),
('hil', 'Hiligaynon'),
('hit', 'Hittite'),
('hmn', 'Hmong'),
('ho', 'Hiri Motu'),
('hr', 'Croatian'),
('hsb', 'Upper Sorbian'),
('hsn', 'Xiang Chinese'),
('ht', 'Haitian'),
('hu', 'Hangri kasa'),
('hup', 'Hupa'),
('hy', 'Armenian'),
('hz', 'Herero'),
('ia', 'Interlingua'),
('iba', 'Iban'),
('ibb', 'Ibibio'),
('id', 'Indonihyia kasa'),
('ie', 'Interlingue'),
('ig', 'Igbo'),
('ii', 'Sichuan Yi'),
('ik', 'Inupiaq'),
('ilo', 'Iloko'),
('inh', 'Ingush'),
('io', 'Ido'),
('is', 'Icelandic'),
('it', 'Italy kasa'),
('iu', 'Inuktitut'),
('izh', 'Ingrian'),
('ja', 'Gyapan kasa'),
('jam', 'Jamaican Creole English'),
('jbo', 'Lojban'),
('jgo', 'Ngomba'),
('jmc', 'Machame'),
('jpr', 'Judeo-Persian'),
('jrb', 'Judeo-Arabic'),
('jut', 'Jutish'),
('jv', 'Gyabanis kasa'),
('ka', 'Georgian'),
('kaa', 'Kara-Kalpak'),
('kab', 'Kabyle'),
('kac', 'Kachin'),
('kaj', 'Jju'),
('kam', 'Kamba'),
('kaw', 'Kawi'),
('kbd', 'Kabardian'),
('kbl', 'Kanembu'),
('kcg', 'Tyap'),
('kde', 'Makonde'),
('kea', 'Kabuverdianu'),
('ken', 'Kenyang'),
('kfo', 'Koro'),
('kg', 'Kongo'),
('kgp', 'Kaingang'),
('kha', 'Khasi'),
('kho', 'Khotanese'),
('khq', 'Koyra Chiini'),
('khw', 'Khowar'),
('ki', 'Kikuyu'),
('kiu', 'Kirmanjki'),
('kj', 'Kuanyama'),
('kk', 'Kazakh'),
('kkj', 'Kako'),
('kl', 'Kalaallisut'),
('kln', 'Kalenjin'),
('km', 'Kambodia kasa'),
('kmb', 'Kimbundu'),
('kn', 'Kannada'),
('ko', 'Korea kasa'),
('koi', 'Komi-Permyak'),
('kok', 'Konkani'),
('kos', 'Kosraean'),
('kpe', 'Kpelle'),
('kr', 'Kanuri'),
('krc', 'Karachay-Balkar'),
('kri', 'Krio'),
('krj', 'Kinaray-a'),
('krl', 'Karelian'),
('kru', 'Kurukh'),
('ks', 'Kashmiri'),
('ksb', 'Shambala'),
('ksf', 'Bafia'),
('ksh', 'Colognian'),
('ku', 'Kurdish'),
('kum', 'Kumyk'),
('kut', 'Kutenai'),
('kv', 'Komi'),
('kw', 'Cornish'),
('ky', 'Kyrgyz'),
('la', 'Latin'),
('lad', 'Ladino'),
('lag', 'Langi'),
('lah', 'Lahnda'),
('lam', 'Lamba'),
('lb', 'Luxembourgish'),
('lez', 'Lezghian'),
('lfn', 'Lingua Franca Nova'),
('lg', 'Ganda'),
('li', 'Limburgish'),
('lij', 'Ligurian'),
('liv', 'Livonian'),
('lkt', 'Lakota'),
('lmo', 'Lombard'),
('ln', 'Lingala'),
('lo', 'Lao'),
('lol', 'Mongo'),
('loz', 'Lozi'),
('lt', 'Lithuanian'),
('ltg', 'Latgalian'),
('lu', 'Luba-Katanga'),
('lua', 'Luba-Lulua'),
('lui', 'Luiseno'),
('lun', 'Lunda'),
('luo', 'Luo'),
('lus', 'Mizo'),
('luy', 'Luyia'),
('lv', 'Latvian'),
('lzh', 'Literary Chinese'),
('lzz', 'Laz'),
('mad', 'Madurese'),
('maf', 'Mafa'),
('mag', 'Magahi'),
('mai', 'Maithili'),
('mak', 'Makasar'),
('man', 'Mandingo'),
('mas', 'Masai'),
('mde', 'Maba'),
('mdf', 'Moksha'),
('mdr', 'Mandar'),
('men', 'Mende'),
('mer', 'Meru'),
('mfe', 'Morisyen'),
('mg', 'Malagasy'),
('mga', 'Middle Irish'),
('mgh', 'Makhuwa-Meetto'),
('mgo', 'Metaʼ'),
('mh', 'Marshallese'),
('mi', 'Maori'),
('mic', 'Micmac'),
('min', 'Minangkabau'),
('mk', 'Macedonian'),
('ml', 'Malayalam'),
('mn', 'Mongolian'),
('mnc', 'Manchu'),
('mni', 'Manipuri'),
('moh', 'Mohawk'),
('mos', 'Mossi'),
('mr', 'Marathi'),
('mrj', 'Western Mari'),
('ms', 'Malay kasa'),
('mt', 'Maltese'),
('mua', 'Mundang'),
('mul', 'Multiple Languages'),
('mus', 'Creek'),
('mwl', 'Mirandese'),
('mwr', 'Marwari'),
('mwv', 'Mentawai'),
('my', 'Bɛɛmis kasa'),
('mye', 'Myene'),
('myv', 'Erzya'),
('mzn', 'Mazanderani'),
('na', 'Nauru'),
('nan', 'Min Nan Chinese'),
('nap', 'Neapolitan'),
('naq', 'Nama'),
('nb', 'Norwegian Bokmål'),
('nd', 'North Ndebele'),
('nds', 'Low German'),
('ne', 'Nɛpal kasa'),
('new', 'Newari'),
('ng', 'Ndonga'),
('nia', 'Nias'),
('niu', 'Niuean'),
('njo', 'Ao Naga'),
('nl', 'Dɛɛkye'),
('nl_BE', 'Flemish'),
('nmg', 'Kwasio'),
('nn', 'Norwegian Nynorsk'),
('nnh', 'Ngiemboon'),
('no', 'Norwegian'),
('nog', 'Nogai'),
('non', 'Old Norse'),
('nov', 'Novial'),
('nqo', 'NʼKo'),
('nr', 'South Ndebele'),
('nso', 'Northern Sotho'),
('nus', 'Nuer'),
('nv', 'Navajo'),
('nwc', 'Classical Newari'),
('ny', 'Nyanja'),
('nym', 'Nyamwezi'),
('nyn', 'Nyankole'),
('nyo', 'Nyoro'),
('nzi', 'Nzima'),
('oc', 'Occitan'),
('oj', 'Ojibwa'),
('om', 'Oromo'),
('or', 'Oriya'),
('os', 'Ossetic'),
('osa', 'Osage'),
('ota', 'Ottoman Turkish'),
('pa', 'Pungyabi kasa'),
('pag', 'Pangasinan'),
('pal', 'Pahlavi'),
('pam', 'Pampanga'),
('pap', 'Papiamento'),
('pau', 'Palauan'),
('pcd', 'Picard'),
('pdc', 'Pennsylvania German'),
('pdt', 'Plautdietsch'),
('peo', 'Old Persian'),
('pfl', 'Palatine German'),
('phn', 'Phoenician'),
('pi', 'Pali'),
('pl', 'Pɔland kasa'),
('pms', 'Piedmontese'),
('pnt', 'Pontic'),
('pon', 'Pohnpeian'),
('prg', 'Prussian'),
('pro', 'Old Provençal'),
('ps', 'Pashto'),
('pt', 'Pɔɔtugal kasa'),
('pt_BR', 'Brazilian Portuguese'),
('pt_PT', 'European Portuguese'),
('qu', 'Quechua'),
('quc', 'Kʼicheʼ'),
('qug', 'Chimborazo Highland Quichua'),
('raj', 'Rajasthani'),
('rap', 'Rapanui'),
('rar', 'Rarotongan'),
('rgn', 'Romagnol'),
('rif', 'Riffian'),
('rm', 'Romansh'),
('rn', 'Rundi'),
('ro', 'Romenia kasa'),
('ro_MD', 'Moldavian'),
('rof', 'Rombo'),
('rom', 'Romany'),
('root', 'Root'),
('rtm', 'Rotuman'),
('ru', 'Rahyia kasa'),
('rue', 'Rusyn'),
('rug', 'Roviana'),
('rup', 'Aromanian'),
('rw', 'Rewanda kasa'),
('rwk', 'Rwa'),
('sa', 'Sanskrit'),
('sad', 'Sandawe'),
('sah', 'Sakha'),
('sam', 'Samaritan Aramaic'),
('saq', 'Samburu'),
('sas', 'Sasak'),
('sat', 'Santali'),
('saz', 'Saurashtra'),
('sba', 'Ngambay'),
('sbp', 'Sangu'),
('sc', 'Sardinian'),
('scn', 'Sicilian'),
('sco', 'Scots'),
('sd', 'Sindhi'),
('sdc', 'Sassarese Sardinian'),
('se', 'Northern Sami'),
('see', 'Seneca'),
('seh', 'Sena'),
('sei', 'Seri'),
('sel', 'Selkup'),
('ses', 'Koyraboro Senni'),
('sg', 'Sango'),
('sga', 'Old Irish'),
('sgs', 'Samogitian'),
('sh', 'Serbo-Croatian'),
('shi', 'Tachelhit'),
('shn', 'Shan'),
('shu', 'Chadian Arabic'),
('si', 'Sinhala'),
('sid', 'Sidamo'),
('sk', 'Slovak'),
('sl', 'Slovenian'),
('sli', 'Lower Silesian'),
('sly', 'Selayar'),
('sm', 'Samoan'),
('sma', 'Southern Sami'),
('smj', 'Lule Sami'),
('smn', 'Inari Sami'),
('sms', 'Skolt Sami'),
('sn', 'Shona'),
('snk', 'Soninke'),
('so', 'Somalia kasa'),
('sog', 'Sogdien'),
('sq', 'Albanian'),
('sr', 'Serbian'),
('srn', 'Sranan Tongo'),
('srr', 'Serer'),
('ss', 'Swati'),
('ssy', 'Saho'),
('st', 'Southern Sotho'),
('stq', 'Saterland Frisian'),
('su', 'Sundanese'),
('suk', 'Sukuma'),
('sus', 'Susu'),
('sux', 'Sumerian'),
('sv', 'Sweden kasa'),
('sw', 'Swahili'),
('swb', 'Comorian'),
('swc', 'Congo Swahili'),
('syc', 'Classical Syriac'),
('syr', 'Syriac'),
('szl', 'Silesian'),
('ta', 'Tamil kasa'),
('tcy', 'Tulu'),
('te', 'Telugu'),
('tem', 'Timne'),
('teo', 'Teso'),
('ter', 'Tereno'),
('tet', 'Tetum'),
('tg', 'Tajik'),
('th', 'Taeland kasa'),
('ti', 'Tigrinya'),
('tig', 'Tigre'),
('tiv', 'Tiv'),
('tk', 'Turkmen'),
('tkl', 'Tokelau'),
('tkr', 'Tsakhur'),
('tl', 'Tagalog'),
('tlh', 'Klingon'),
('tli', 'Tlingit'),
('tly', 'Talysh'),
('tmh', 'Tamashek'),
('tn', 'Tswana'),
('to', 'Tongan'),
('tog', 'Nyasa Tonga'),
('tpi', 'Tok Pisin'),
('tr', 'Tɛɛki kasa'),
('tru', 'Turoyo'),
('trv', 'Taroko'),
('ts', 'Tsonga'),
('tsd', 'Tsakonian'),
('tsi', 'Tsimshian'),
('tt', 'Tatar'),
('ttt', 'Muslim Tat'),
('tum', 'Tumbuka'),
('tvl', 'Tuvalu'),
('tw', 'Twi'),
('twq', 'Tasawaq'),
('ty', 'Tahitian'),
('tyv', 'Tuvinian'),
('tzm', 'Central Atlas Tamazight'),
('udm', 'Udmurt'),
('ug', 'Uyghur'),
('uga', 'Ugaritic'),
('uk', 'Ukren kasa'),
('umb', 'Umbundu'),
('und', 'Unknown Language'),
('ur', 'Urdu kasa'),
('uz', 'Uzbek'),
('vai', 'Vai'),
('ve', 'Venda'),
('vec', 'Venetian'),
('vep', 'Veps'),
('vi', 'Viɛtnam kasa'),
('vls', 'West Flemish'),
('vmf', 'Main-Franconian'),
('vo', 'Volapük'),
('vot', 'Votic'),
('vro', 'Võro'),
('vun', 'Vunjo'),
('wa', 'Walloon'),
('wae', 'Walser'),
('wal', 'Wolaytta'),
('war', 'Waray'),
('was', 'Washo'),
('wbp', 'Warlpiri'),
('wo', 'Wolof'),
('wuu', 'Wu Chinese'),
('xal', 'Kalmyk'),
('xh', 'Xhosa'),
('xmf', 'Mingrelian'),
('xog', 'Soga'),
('yao', 'Yao'),
('yap', 'Yapese'),
('yav', 'Yangben'),
('ybb', 'Yemba'),
('yi', 'Yiddish'),
('yo', 'Yoruba'),
('yrl', 'Nheengatu'),
('yue', 'Cantonese'),
('za', 'Zhuang'),
('zap', 'Zapotec'),
('zbl', 'Blissymbols'),
('zea', 'Zeelandic'),
('zen', 'Zenaga'),
('zgh', 'Standard Moroccan Tamazight'),
('zh', 'Kyaena kasa'),
('zh_Hans', 'Simplified Chinese'),
('zh_Hant', 'Traditional Chinese'),
('zu', 'Zulu'),
('zun', 'Zuni'),
('zxx', 'No linguistic content'),
('zza', 'Zaza');

-- --------------------------------------------------------

--
-- Table structure for table `manage_banners`
--

CREATE TABLE `manage_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext DEFAULT NULL,
  `one_image` varchar(255) DEFAULT NULL,
  `two_image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manage_banners`
--

INSERT INTO `manage_banners` (`id`, `description`, `one_image`, `two_image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '<p>fdsfddsddsaf<br></p>', '2023090713183240.png', '2023090713183208.jpg', 2, '2023-09-07 07:48:32', NULL, '2023-09-07 08:05:01'),
(2, '<div class=\"home-three-slide-text\">\r\n            <h4>Unlock your potential in Math and Coding</h4>\r\n            <h1>Online Tutoring for K-12 Math & Coding Mastery</h1>\r\n            <p>KnowMerit’s expert live 1:1 online tutoring, customized learning plans and experienced tutors. </p>\r\n          </div><p></p>', '2023090805021752.png', '2023090805021744.png', 1, '2023-09-07 08:02:53', '2023-09-07 23:32:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manage_pages`
--

CREATE TABLE `manage_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manage_pages`
--

INSERT INTO `manage_pages` (`id`, `name`, `slug`, `image`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'xzCczxvv', 'czxVczxv', '2023090807504628.png', '<p>zVCczxv<br></p>', 2, '2023-09-08 02:19:43', '2023-09-08 02:20:46', '2023-09-08 02:20:59'),
(2, 'zcx', 'zcxv', '2023090807503165.png', '<p>xzv<br></p><div class=\"col-xl-6 col-lg-12 col-md-12 aos-init aos-animate\" data-aos=\"fade-down\">\r\n          <div class=\"become-content\">\r\n            <h2 class=\"aos-init aos-animate\">Our Happy Parents!</h2>\r\n            <h4 class=\"aos-init aos-animate\">We are a very happy because we have a happy customer</h4>\r\n          </div>\r\n        </div>', 2, '2023-09-08 02:20:31', '2023-09-08 02:23:11', '2023-09-08 04:28:18'),
(3, 'Terms and Conditions', 'terms-and-conditions', '2023090809380168.png', '<main>\r\n<section class=\"stb\">\r\n<div class=\"container\">\r\n<div class=\"row justify-content-center\">\r\n<div class=\"col-lg-8\">\r\n<div class=\"section-title text-center mb-0\"><br>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>\r\n<section class=\"space-pb\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-12\">\r\n<p>Access to and the use of Know Merit is subject to the following terms :</p>\r\n<ul class=\"list-unstyled\"><li class=\"mb-2\"> <i class=\"fa fa-angle-right pe-2 mb-2\"></i>By \r\naccessing this website you agree to be legally bound by these terms and \r\nconditions, all applicable laws and regulations, and agree that you are \r\nresponsible for compliance with any applicable local laws. If you do not\r\n agree to being legally bound by these terms and conditions, please do \r\nnot enter the site.</li><li class=\"mb-2\"> <i class=\"fa fa-angle-right pe-2 mb-2\"></i>These terms\r\n and conditions are subject to change by Know Merit at any time. Please \r\ncheck these terms and conditions from time to time to take notice of any\r\n changes we make, as they are legally binding on you. Some of the \r\nprovisions contained in these Terms of Use may also be superseded by \r\nprovisions or notices published elsewhere on our site.</li><li class=\"mb-2\"> <i class=\"fa fa-angle-right pe-2 mb-2\"></i> You may \r\nnot copy, reproduce, republish, download, post, broadcast, transmit, \r\nmake available to the public, or otherwise use the content of Know Merit \r\nin any way unless you have prior written permission from Know Merit. You \r\nmay download items, for example white papers, that are intended for this\r\n use but you may only print one copy for reference purposes.</li><li class=\"mb-2\"> <i class=\"fa fa-angle-right pe-2 mb-2\"></i>Know Merit will not be responsible for any loss or damage of any kind whether \r\ndirect or indirect resulting from the use of this website.</li><li class=\"mb-2\"> <i class=\"fa fa-angle-right pe-2 mb-2\"></i>Any links \r\nto external websites should not be taken as an endorsement of that site \r\nand Know Merit accepts no responsibility for the content of any external \r\nwebsites.</li></ul>\r\n</div>\r\n</div>\r\n</div>\r\n</section>\r\n</main><p></p>', 1, '2023-09-08 03:05:05', '2023-09-08 04:22:34', NULL),
(4, 'Privacy Policy', 'fd', NULL, '<p>adffsad<br></p>', 2, '2023-09-08 04:23:14', '2023-09-08 04:24:17', '2023-09-08 04:28:12'),
(5, 'Privacy Policy', 'privacy-policy', NULL, '<ul class=\"list-unstyled\"><li class=\"mb-2\"> Techsaga has created this privacy statement in order \r\nto demonstrate our firm commitment to privacy. The following discloses \r\nour information gathering and dissemination practices for this </li><li class=\"mb-2\"> <i class=\"fa fa-angle-right pe-2 mb-2\"></i> Techsaga \r\nuse your IP address to help diagnose problems with our server, and to \r\nadminister our Web site. Your IP address is used to gather broad \r\ndemographic information.</li><li class=\"mb-2\"> <i class=\"fa fa-angle-right pe-2 mb-2\"></i> Techsaga \r\nsite\'s registration form requires users to give us contact information \r\n(like their name and email address) and demographic information (like \r\ntheir zip code, age, or income level). The customer\'s contact \r\ninformation is used to contact the visitor when necessary. Users may \r\nopt-out of receiving future mailings; see the choice/opt-out section \r\nbelow. Demographic and profile data is also collected at our site. We \r\nuse this data to tailor the visitor\'s experience at our site, showing \r\nthem content that we think they might be interested in, and displaying \r\nthe content according to their preferences.</li><li class=\"mb-2\"> <i class=\"fa fa-angle-right pe-2 mb-2\"></i>This site \r\ncontains links to other sites. www.techsaga.co.in is not responsible for\r\n the privacy practices or the content of such Web sites.</li><li> <i class=\"fa fa-angle-right pe-2 mb-2\"></i> Techsaga site uses an \r\norder form for customers to request information, products, and services.\r\n We collect visitor\'s contact information (like their email address) and\r\n demographic information (like their zip code, age, or income level). \r\nContact information from the order form is used to send orders to our \r\ncustomers. The customer\'s contact information is used to get in touch \r\nwith the visitor when necessary. Users may opt-out of receiving future \r\nmailings; see the choice/opt-out section below. Demographic and profile \r\ndata is also collected at our site. We use this data to tailor our \r\nvisitor\'s experience at our site, showing them content that we think \r\nthey might be interested in, and displaying the content according to \r\ntheir preferences.</li><li> <i class=\"fa fa-angle-right pe-2 mb-2\"></i> Techsaga online surveys\r\n ask visitors for contact information (like their email address) and \r\ndemographic information (like their zip code, age, or income level). We \r\nuse contact data from our surveys to send the user information about our\r\n company. The customer\'s contact information is also used to contact the\r\n visitor when necessary. Users may opt-out of receiving future mailings;\r\n see the choice/opt-out section below. Demographic and profile data is \r\nalso collected at our site. We use this data to tailor our visitor\'s \r\nexperience at our site, showing them content that we think they might be\r\n interested in, and displaying the content according to their \r\npreferences.</li><li> <i class=\"fa fa-angle-right pe-2 mb-2\"></i> We run contests on our \r\nsite in which we ask visitors for contact information (like their email \r\naddress) and demographic information (like their zip code, age, or \r\nincome level). We use contact data from our contests to send users \r\ninformation about our company. The customer\'s contact information is \r\nalso used to contact the visitor when necessary. Users may opt-out of \r\nreceiving future mailings; see the choice/opt-out section below. \r\nDemographic and profile data is also collected at our site. We use this \r\ndata to tailor our visitor\'s experience at our site, showing them \r\ncontent that we think they might be interested in, and displaying the \r\ncontent according to their preferences.</li></ul><p></p>', 1, '2023-09-08 04:29:07', NULL, NULL),
(6, 'Refund Policy', 'refund-policy', NULL, '<ul class=\"list-unstyled\"><li class=\"mb-2\">Techsaga has created this privacy statement in order to\r\n demonstrate our firm commitment to privacy. The following discloses our\r\n information gathering and dissemination practices for this </li><li class=\"mb-2\"> <i class=\"fa fa-angle-right pe-2 mb-2\"></i> Techsaga \r\nuse your IP address to help diagnose problems with our server, and to \r\nadminister our Web site. Your IP address is used to gather broad \r\ndemographic information.</li><li class=\"mb-2\"> <i class=\"fa fa-angle-right pe-2 mb-2\"></i> Techsaga \r\nsite\'s registration form requires users to give us contact information \r\n(like their name and email address) and demographic information (like \r\ntheir zip code, age, or income level). The customer\'s contact \r\ninformation is used to contact the visitor when necessary. Users may \r\nopt-out of receiving future mailings; see the choice/opt-out section \r\nbelow. Demographic and profile data is also collected at our site. We \r\nuse this data to tailor the visitor\'s experience at our site, showing \r\nthem content that we think they might be interested in, and displaying \r\nthe content according to their preferences.</li><li class=\"mb-2\"> <i class=\"fa fa-angle-right pe-2 mb-2\"></i>This site \r\ncontains links to other sites. www.techsaga.co.in is not responsible for\r\n the privacy practices or the content of such Web sites.</li><li> <i class=\"fa fa-angle-right pe-2 mb-2\"></i> Techsaga site uses an \r\norder form for customers to request information, products, and services.\r\n We collect visitor\'s contact information (like their email address) and\r\n demographic information (like their zip code, age, or income level). \r\nContact information from the order form is used to send orders to our \r\ncustomers. The customer\'s contact information is used to get in touch \r\nwith the visitor when necessary. Users may opt-out of receiving future \r\nmailings; see the choice/opt-out section below. Demographic and profile \r\ndata is also collected at our site. We use this data to tailor our \r\nvisitor\'s experience at our site, showing them content that we think \r\nthey might be interested in, and displaying the content according to \r\ntheir preferences.</li><li> <i class=\"fa fa-angle-right pe-2 mb-2\"></i> Techsaga online surveys\r\n ask visitors for contact information (like their email address) and \r\ndemographic information (like their zip code, age, or income level). We \r\nuse contact data from our surveys to send the user information about our\r\n company. The customer\'s contact information is also used to contact the\r\n visitor when necessary. Users may opt-out of receiving future mailings;\r\n see the choice/opt-out section below. Demographic and profile data is \r\nalso collected at our site. We use this data to tailor our visitor\'s \r\nexperience at our site, showing them content that we think they might be\r\n interested in, and displaying the content according to their \r\npreferences.</li><li> <i class=\"fa fa-angle-right pe-2 mb-2\"></i> We run contests on our \r\nsite in which we ask visitors for contact information (like their email \r\naddress) and demographic information (like their zip code, age, or \r\nincome level). We use contact data from our contests to send users \r\ninformation about our company. The customer\'s contact information is \r\nalso used to contact the visitor when necessary. Users may opt-out of \r\nreceiving future mailings; see the choice/opt-out section below. \r\nDemographic and profile data is also collected at our site. We use this \r\ndata to tailor our visitor\'s experience at our site, showing them \r\ncontent that we think they might be interested in, and displaying the \r\ncontent according to their preferences.</li></ul><p></p>', 1, '2023-09-08 04:31:03', NULL, NULL),
(7, 'Our Commitment', 'our-commitment', NULL, '<p>zvxzc<br></p>', 1, '2023-09-08 23:36:19', '2023-09-08 23:37:11', NULL),
(8, 'Need Help', 'need-help', NULL, '<p>cxzvvz<br></p>', 1, '2023-09-08 23:36:34', '2023-09-08 23:36:54', NULL),
(9, 'Who Are We', 'who-are-we', NULL, '<p>xcvxzcv<br></p>', 1, '2023-09-08 23:37:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manage_sliders`
--

CREATE TABLE `manage_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_ship_plans`
--

CREATE TABLE `member_ship_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `benifits` varchar(200) DEFAULT NULL,
  `user_type` tinyint(4) DEFAULT 0 COMMENT '0 => student, 1 => teacher',
  `amount` varchar(200) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member_ship_plans`
--

INSERT INTO `member_ship_plans` (`id`, `name`, `benifits`, `user_type`, `amount`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'techsaga', '6 months', 1, '1234', 1, '2023-08-07 08:22:12', '2023-08-08 06:24:13', NULL),
(4, 'abhinav', '12 months', 0, '3698', 1, '2023-08-17 10:28:04', NULL, NULL);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2014_10_12_000000_create_users_table', 2),
(7, '2023_08_07_094704_create_categories_table', 3),
(8, '2023_08_07_125529_create_membershipplans_table', 4),
(9, '2023_08_07_130158_create_member_ship_plans_table', 5),
(10, '2023_08_09_050541_create_tutors_table', 6),
(11, '2023_08_11_104859_create_faqs_table', 6),
(12, '2023_08_21_051346_create_communities_table', 7),
(13, '2023_08_21_092218_create_about_us_table', 7),
(14, '2023_08_21_092738_create_aboutus_points_table', 7),
(15, '2023_08_22_071602_create_community_comments_table', 8),
(16, '2023_08_22_100400_create_community_likes_table', 8),
(17, '2023_08_22_112858_create_write_reviews_table', 8),
(18, '2023_08_23_090939_create_enquiries_table', 9),
(19, '2023_08_24_054802_create_blogs_table', 10),
(20, '2023_08_28_085319_create_book_a_classes_table', 11),
(21, '2023_08_29_071401_create_benifits_table', 11),
(22, '2023_08_29_130834_create_payments_table', 11),
(23, '2023_09_06_999999_add_active_status_to_users', 12),
(24, '2023_09_06_999999_add_avatar_to_users', 12),
(25, '2023_09_06_999999_add_dark_mode_to_users', 12),
(26, '2023_09_06_999999_add_messenger_color_to_users', 12),
(27, '2023_09_06_999999_create_chatify_favorites_table', 12),
(28, '2023_09_06_999999_create_chatify_messages_table', 12),
(33, '2023_09_07_121343_create_manage_banners_table', 13),
(35, '2023_09_08_065834_create_manage_pages_table', 14),
(36, '2023_09_08_091717_create_common_controllers_table', 15),
(37, '2023_09_11_045959_create_testimonials_table', 15),
(38, '2023_09_07_113129_create_manage_sliders_table', 16),
(39, '2023_09_08_092527_create_whyknowmerits_table', 16),
(40, '2023_09_09_085235_create_contact_sec_fsts_table', 16),
(41, '2023_09_09_102114_create_contact_sec_scnds_table', 16),
(42, '2023_09_09_110020_create_contact_masters_table', 16),
(43, '2023_09_11_120123_create_featureds_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `nios`
--

CREATE TABLE `nios` (
  `id` bigint(20) NOT NULL,
  `parent` tinyint(4) NOT NULL DEFAULT 0,
  `subject` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `nios`
--

INSERT INTO `nios` (`id`, `parent`, `subject`) VALUES
(1, 0, 'English'),
(2, 0, 'Social Studies'),
(3, 0, 'Mathematics'),
(4, 0, 'Science'),
(5, 0, 'EVS'),
(6, 0, 'Hindi'),
(7, 0, 'Sanskrit'),
(8, 0, 'French'),
(9, 0, 'Telugu'),
(10, 0, 'Malayalam'),
(11, 0, 'German'),
(12, 0, 'Kannada'),
(13, 0, 'Spanish'),
(14, 0, 'Tamil'),
(15, 0, 'Punjabi'),
(16, 0, 'Gujarathi'),
(17, 0, 'Urdu'),
(18, 0, 'Marathi'),
(19, 0, 'Bengali'),
(20, 0, 'Assamese'),
(21, 0, 'Manipuri'),
(22, 0, 'Mizo'),
(23, 0, 'Computer science\n'),
(24, 0, 'Bengali');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `r_payment_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `r_payment_id`, `user_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'pay_MWHqx4bN4YTAcT', '1', '1234', NULL, NULL),
(2, 'pay_MWHwKiWjjjbjNc', '2', '1234', NULL, NULL),
(3, 'pay_MWIdNRxKMEsYso', '6', '1234', NULL, NULL),
(4, 'pay_MYzmWsXVTrKaAt', '26', '3698', NULL, NULL),
(5, 'pay_MYzmWsXVTrKaAt', '27', '3698', NULL, NULL),
(6, 'pay_MYzoFdFcw6psES', '28', '3698', NULL, NULL),
(7, 'pay_MZ00DiDonU4Bkd', '10', '3698', NULL, NULL),
(8, 'pay_MZ03vRK7JV7bAx', '11', '3698', NULL, NULL),
(9, 'pay_MZ0zgACo5WeWfx', '29', '3698', NULL, NULL),
(10, 'pay_MZ11AxnYB19DKr', '30', '3698', NULL, NULL),
(11, 'pay_MZ1MWaayWyXMPu', '31', '3698', NULL, NULL),
(12, 'pay_MZ1MWaayWyXMPu', '32', '3698', NULL, NULL),
(13, 'pay_MZ26oW1N4haO8U', '33', '3698', NULL, NULL),
(14, 'pay_MZ2IwLacPDMna7', '34', '3698', NULL, NULL),
(15, 'pay_MZ2fKRTlXD4qgn', '35', '3698', NULL, NULL),
(16, 'pay_MZ2y5Lwlu1p6ZX', '36', '3698', NULL, NULL),
(17, 'pay_MZ3BQVsSZYjTyj', '37', '3698', NULL, NULL),
(18, 'pay_MZ3OZJFAaAMbgp', '38', '1234', NULL, NULL),
(19, 'pay_MZ47u1VOMhRI6A', '39', '3698', NULL, NULL),
(20, 'pay_MZ4dZ40kldWFEG', '40', '3698', NULL, NULL),
(21, 'pay_MZJuyPGmmHV27V', '42', '3698', NULL, NULL),
(22, 'pay_MZKQ9uVZ9pE4Qr', '43', '3698', NULL, NULL),
(23, 'pay_MZKXP7Bl5wOU7i', '44', '3698', NULL, NULL),
(24, 'pay_MZKZzFvIftLlW3', '45', '3698', NULL, NULL),
(25, 'pay_MZKgqUzIU4w4UN', '46', '3698', NULL, NULL),
(26, 'pay_MZL82E8hhPaAo4', '47', '3698', NULL, NULL),
(27, 'pay_MZL9pTdfDoYg3X', '48', '3698', NULL, NULL),
(28, 'pay_MZLDy6zsAwD5zR', '49', '3698', NULL, NULL),
(29, 'pay_MZM7W26HsZEOaY', '50', '3698', NULL, NULL),
(30, 'pay_MZMDGU4j5kBGVN', '51', '3698', NULL, NULL),
(31, 'pay_MZMJMH14u3We7X', '52', '3698', NULL, NULL),
(32, 'pay_MZMLy8qp3fx810', '53', '3698', NULL, NULL),
(33, 'pay_MZMjbqwzAoSuNA', '54', '1234', NULL, NULL),
(34, 'pay_MZMmqPDR0STPld', '55', '1234', NULL, NULL),
(35, 'pay_MZMozOPhVYSX1n', '56', '1234', NULL, NULL),
(36, 'pay_MZNhjmN9YamL7C', '59', '3698', NULL, NULL),
(37, 'pay_MZNuIuPcKz3rIN', '60', '3698', NULL, NULL),
(38, 'pay_MZO0j7YkPCgVaz', '61', '1234', NULL, NULL),
(39, 'pay_MZO4yw2wAzVADv', '62', '1234', NULL, NULL),
(40, 'pay_MZO9wXKvouRPqW', '63', '1234', NULL, NULL),
(41, 'pay_MZOfRmJe6wfNUk', '66', '3698', NULL, NULL),
(42, 'pay_MZOkAVEKCA7uZw', '67', '3698', NULL, NULL),
(43, 'pay_MZOm3PKBBtYyAp', '68', '1234', NULL, NULL),
(44, 'pay_MZOpnkN80BGKDX', '69', '1234', NULL, NULL),
(45, 'pay_MZOsmFV9m0ReKX', '1', '3698', NULL, NULL),
(46, 'pay_MZOzVRIcKieTBZ', '4', '3698', NULL, NULL),
(47, 'pay_MZP6LRWbnYE4X0', '5', '3698', NULL, NULL),
(48, 'pay_MZPA6dATmrMHa4', '6', '3698', NULL, NULL),
(49, 'pay_MZPC9dk38D7LAt', '7', '3698', NULL, NULL),
(50, 'pay_MZokRXixQlZv87', '8', '3698', NULL, NULL),
(51, 'pay_MZp5fKFtNnYBTH', '9', '3698', NULL, NULL),
(52, 'pay_MZpYE89IOUVbKW', '10', '3698', NULL, NULL),
(53, 'pay_MZpdIkdCwXJyO2', '11', '1234', NULL, NULL),
(54, 'pay_MZpfN8HtLgWGSp', '12', '1234', NULL, NULL),
(55, 'pay_MZptXhiXUnrizi', '14', '3698', NULL, NULL),
(56, 'pay_MZpwvx4EW8WU17', '15', '1234', NULL, NULL),
(57, 'pay_MZpyt5QbyNJH3u', '16', '3698', NULL, NULL),
(58, 'pay_Mb0AUeVvQLUme7', '2', '3698', NULL, NULL),
(59, 'pay_MbLAldGnZrJPvs', '13', '1234', NULL, NULL),
(60, 'pay_MbMKbQOKeeRdjv', '14', '3698', NULL, NULL),
(61, 'pay_MbMMUNpMMfm1VZ', '15', '1234', NULL, NULL),
(62, 'pay_MbMgMOqoOduKuC', '16', '3698', NULL, NULL),
(63, 'pay_MbO1S312Zr3rhm', '18', '3698', NULL, NULL),
(64, 'pay_MbP8zXBJDHA575', '20', '3698', NULL, NULL),
(65, 'pay_MbQDhuC3VGrY1C', '22', '3698', NULL, NULL),
(66, 'pay_MbQHlJDt34vPb1', '23', '1234', NULL, NULL),
(67, 'pay_MbQLyspAmVKvuU', '24', '3698', NULL, NULL),
(68, 'pay_MbQPc8JdlglPyQ', '26', '1234', NULL, NULL),
(69, 'pay_MbQj1wU4Kri2Un', '27', '1234', NULL, NULL);

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sub Admin', 1, '2023-04-29 05:38:25', NULL, NULL),
(2, 'Accountant', 1, '2023-04-29 10:43:27', '2023-04-29 13:12:36', '2023-07-26 15:15:12'),
(3, 'super agent', 1, '2023-06-26 15:35:22', '2023-07-11 14:16:01', NULL),
(4, 'Agent', 1, '2023-07-07 12:25:24', '2023-08-03 00:03:15', NULL),
(5, 'Accountant1', 2, '2023-08-02 05:44:14', '2023-08-02 07:05:27', '2023-08-02 07:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `permission_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 5, '1,2,3,4,5,6', '2023-08-02 06:50:34', NULL),
(2, 4, '1,2,3,4,5,6', '2023-08-02 23:49:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `state_boards`
--

CREATE TABLE `state_boards` (
  `id` bigint(20) NOT NULL,
  `parent` tinyint(4) NOT NULL DEFAULT 0,
  `board_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `state_boards`
--

INSERT INTO `state_boards` (`id`, `parent`, `board_name`) VALUES
(1, 0, 'Delhi State Board'),
(2, 0, 'Karnataka State Board'),
(3, 0, 'Andhra Pradesh State Board'),
(4, 0, 'West Bengal State Board'),
(5, 0, 'Tamil Nadu State Board'),
(6, 0, 'Maharashtra State Board'),
(7, 0, 'Punjab State Board'),
(8, 0, 'Gujarat State Board'),
(9, 0, 'Uttar Pradesh State Board'),
(10, 0, 'Rajasthan State Board'),
(11, 0, 'Odisha State Board'),
(12, 0, 'Uttarakhand State Board'),
(13, 0, 'Himachal Pradesh State Board'),
(14, 0, 'Bihar State Board');

-- --------------------------------------------------------

--
-- Table structure for table `state_sub`
--

CREATE TABLE `state_sub` (
  `id` bigint(20) NOT NULL,
  `parent` tinyint(4) NOT NULL DEFAULT 0,
  `subject` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `state_sub`
--

INSERT INTO `state_sub` (`id`, `parent`, `subject`) VALUES
(1, 0, 'English'),
(2, 0, 'Mathematics'),
(3, 0, 'Science'),
(4, 0, 'EVS'),
(5, 0, 'Social Science'),
(6, 0, 'Hindi'),
(7, 0, 'Sanskrit'),
(8, 0, 'French'),
(9, 0, 'Tamil'),
(10, 0, 'Telugu'),
(11, 0, 'Kannada\r\n'),
(12, 0, 'Malayalam'),
(13, 0, 'Marathi'),
(14, 0, 'Gujarati'),
(15, 0, 'Oriya'),
(16, 0, 'Punjabi'),
(17, 0, 'Urdu'),
(18, 0, 'Computer Science'),
(19, 0, 'Bengali');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `location`, `rating`, `image`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Abhinav kumar Singh', 'India', '4.5', '2023090906142850.svg', 'Being a parent I am very happy that I took a right choice for my son’s \r\nMath tuition. Special thanks to teacher as she understood my child \r\nlearning needs and guided him accordingly. Loved the customized learning\r\n concept.', 1, '2023-09-11 05:12:05', '2023-09-11 00:56:07', NULL),
(2, 'Gyan Singh', 'India', '5', '2023090906142850.svg', '<p>KnowMerit has been a game-changer for my child’s math education. The personalized approach and experienced tutors have helped my child gain confidence and excel in the subject. Highly recommend!<br></p>', 1, '2023-09-11 05:12:05', '2023-09-11 01:05:19', NULL),
(3, 'Gyanabhi', 'India', '2.5', '2023090906142850.svg', '<p>KnowMerit has the right coding program for my daughter’s exquisite nature. Each and Every class was new and exciting for her and She enjoyed it to the core. Her teacher handles everything with utmost patience.<br></p>', 1, '2023-09-11 05:12:05', '2023-09-11 00:56:55', NULL),
(4, 'daf', 'sdaf', NULL, '2023091105281002.png', '<p>dsaf<br></p>', 2, '2023-09-10 23:58:10', NULL, '2023-09-11 00:03:02');

-- --------------------------------------------------------

--
-- Table structure for table `tutors`
--

CREATE TABLE `tutors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(200) DEFAULT NULL,
  `tutor_type` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `c_code` varchar(200) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `gender` varchar(200) DEFAULT NULL,
  `parent_id` varchar(200) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `language` varchar(200) DEFAULT NULL,
  `backgorund_experience` varchar(200) DEFAULT NULL,
  `degree` varchar(200) DEFAULT NULL,
  `institute_name` varchar(255) DEFAULT NULL,
  `university_name` varchar(200) DEFAULT NULL,
  `degree_status` varchar(200) DEFAULT NULL,
  `school_board` varchar(200) DEFAULT NULL,
  `conduct_mode_class` varchar(200) DEFAULT NULL,
  `tutor_travel` varchar(200) DEFAULT NULL,
  `teaching_experience` varchar(255) DEFAULT NULL,
  `experience_year` varchar(200) DEFAULT NULL,
  `classes_mode` varchar(200) DEFAULT NULL,
  `charge_amount` varchar(200) DEFAULT NULL,
  `all_state_subject` varchar(200) DEFAULT NULL,
  `state_board` varchar(200) DEFAULT NULL,
  `cbse_subject` varchar(200) DEFAULT NULL,
  `icse_subject` varchar(200) DEFAULT NULL,
  `international_subject` varchar(200) DEFAULT NULL,
  `igcse_subject` varchar(200) DEFAULT NULL,
  `nios_subject` varchar(200) DEFAULT NULL,
  `describe_experience` varchar(200) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tutors`
--

INSERT INTO `tutors` (`id`, `user_id`, `tutor_type`, `name`, `email`, `c_code`, `mobile`, `gender`, `parent_id`, `location`, `lng`, `lat`, `image`, `status`, `language`, `backgorund_experience`, `degree`, `institute_name`, `university_name`, `degree_status`, `school_board`, `conduct_mode_class`, `tutor_travel`, `teaching_experience`, `experience_year`, `classes_mode`, `charge_amount`, `all_state_subject`, `state_board`, `cbse_subject`, `icse_subject`, `international_subject`, `igcse_subject`, `nios_subject`, `describe_experience`, `payment_status`, `is_featured`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '158', 'individual', 'Abhinav Kumar Singh', 'abhinavkuamrsingh217@gmail.com', '91', '8115555857', 'male', '17', 'India', NULL, NULL, '2023091110270141.jpg', 1, 'hi', 'adf', 'Post Graduation', NULL, 'Agra University', 'Pursuing', 'CBSE', 'Online Video Call,Student Home', '2', 'No', '10', 'Private Classes,Group Classes', '2342', NULL, NULL, 'English,Mathematics', NULL, NULL, NULL, NULL, 'dsf', NULL, 1, '2023-09-11 04:57:01', NULL, NULL),
(2, '159', 'institute', 'Gyan', 'gyan@gmail.com', '91', '8765433456', NULL, '18', 'India', '78.96288', '20.593684', NULL, 1, 'ang', 'good', 'Post Graduation', 'Agra University', NULL, 'Completed', 'cbse', 'Online Video Call,Student Home', '3', 'Yes', '1', 'Group Classes', '223', '', '', 'English,Mathematics,Science,Computers,Hindi', '', '', '', '', 'xcvf', '12 months', 1, '2023-09-11 05:21:32', '2023-09-11 05:21:32', NULL),
(3, '161', 'individual', 'rahul', 'rahul@gmail.com', '91', '6754345643', 'male', '17,18,19', 'India', NULL, NULL, '2023091205381186.jpg', 1, 'ab,ach', 'dsa', '12th', NULL, 'dsaf', 'Completed', 'CBSE,DAV board', 'Online Video Call,Student Home', '7', 'No', '11', 'Private Classes', '654', NULL, NULL, 'English,Mathematics', NULL, NULL, NULL, NULL, 'fdg', NULL, 1, '2023-09-12 00:08:11', NULL, NULL),
(4, '162', 'institute', 'sadf', 'df@gmail.com', '91', '6754356435', NULL, '17', 'Sri Lanka', NULL, NULL, '2023091205454290.jpg', 1, 'ady', 'sdf', 'Graduation', 'df', 'adsf', 'Completed', 'DAV board', 'Online Video Call,Student Home', '3', 'Yes', '3', 'Private Classes', '87654', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ds', NULL, 1, '2023-09-12 00:15:42', NULL, NULL),
(5, '163', 'individual', 'sdaf', 'dsdsfa@gmail.com', '91', '8765434554', 'male', '17', 'USA', NULL, NULL, '2023091205570497.jpg', 1, 'ach', 'rdfg', 'Graduation', NULL, 'rew', 'Completed', 'CBSE', 'Online Video Call', '3', 'Yes', '10', 'Group Classes', '2345', NULL, NULL, 'EVS,Computers,Hindi,Sanskrit', NULL, NULL, NULL, NULL, 'dsf', NULL, 1, '2023-09-12 00:27:04', NULL, NULL),
(6, '164', 'individual', 'dsaf', 'abhinavkuamrdssingh217@gmail.com', '91', '7654345678', 'female', '18', 'SDSU, Campanile Drive, San Diego, CA, USA', NULL, NULL, '2023091205593892.jpg', 1, 'ab', 'sdf', 'Graduation', NULL, 'asds', 'Completed', 'CBSE', 'Online Video Call', '3', 'Yes', '12', 'Private Classes,Group Classes', '34', NULL, NULL, 'Hindi', NULL, NULL, NULL, NULL, 'xcv', NULL, 1, '2023-09-12 00:29:38', NULL, NULL),
(7, '165', 'individual', 'czxc', 'zxc@gmail.com', '91', '7654323456', 'male', '16', 'Dschibuti', NULL, NULL, '2023091206053654.jpg', 1, 'ace', 'sdaf', 'Post Graduation', NULL, 'sdaf', 'Pursuing', 'CBSE,ICSE,International', 'Online Video Call', '8', 'No', '12', 'Private Classes', '23', NULL, NULL, 'English,Mathematics', 'Spanish,Tamil', 'Arts,Computers,French', NULL, NULL, 'sdaf', NULL, 1, '2023-09-12 00:35:36', NULL, NULL),
(8, '166', 'institute', 'asdf', 'sa@gmail.com', '91', '9876543234', NULL, '16', 'Egypt', '30.802498', '26.820553', '2023091206083890.jpg', 1, 'ab', 'dsaf', 'Graduation', 'dsaf', 'sadf', 'Pursuing', 'CBSE', 'Online Video Call', '3', 'No', '0', 'Private Classes', '43', NULL, NULL, 'Mathematics,Science', NULL, NULL, NULL, NULL, 'dfs', NULL, 1, '2023-09-12 00:38:38', NULL, NULL),
(9, '167', 'individual', 'asdf', 's322adf@gamoasdfk.com2', '91', '6987654321', 'female', '17', '99 Fifth Ave #401, Ottawa, ON K1S 5P5, Canada', '-75.6872885', '45.402136', '2023091206134307.jpg', 1, 'aa', 'cxzv', 'Graduation', NULL, 'xz', 'Pursuing', 'DAV board', 'Online Video Call', '23', 'Yes', '0', 'Private Classes', '32424', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sdaa', NULL, 1, '2023-09-12 00:43:43', NULL, NULL),
(10, '172', 'institute', 'asdf', 'ads@gmail.com', '91', '9876543456', NULL, '16', 'Delhi, India', '77.10249019999999', '28.7040592', '2023091206410585.jpg', 1, 'ab', 'fdg', 'Graduation', 'dsaf', 'dsfg', 'Pursuing', 'CBSE,DAV board', 'Student Home', '4', 'Yes', '7', 'Private Classes', '343', NULL, NULL, 'Hindi,Sanskrit,French,German,Oriya', NULL, NULL, NULL, NULL, 'dsf', 'Continue without prime benifits', 1, '2023-09-12 01:11:05', NULL, NULL),
(11, '174', 'individual', 'dsgdf', 'dsf@gjkljdsfgk.com', '91', '076543 567', 'female', '18', 'Sfax, Tunisia', '10.7600196', '34.739822', '2023091206441446.jpg', 1, 'ab', 'fdsg', 'Graduation', NULL, 'fdsg', 'Pursuing', 'CBSE,ICSE,State', 'Online Video Call,Student Home', '4', 'Yes', '4', 'Private Classes', '654654', 'English,Mathematics,EVS', 'Delhi State Board,Karnataka State Board,Andhra Pradesh State Board', 'English,Mathematics', 'English,Social Studies', NULL, NULL, NULL, 'dfs', 'Continue without prime benifits', 1, '2023-09-12 01:14:14', NULL, NULL),
(12, '175', 'individual', 'dsaf', 'dasf@gmail.com', '91', '98765432', 'other', '19', '3880 Kearny Villa Rd, San Diego, CA 92123, USA', '-117.1507835', '32.8123654', '2023091207142385.jpg', 1, 'ab', 'dsaf', 'Graduation', NULL, 'adsf', 'Completed', 'DAV board', 'Online Video Call', '3', 'No', '4', 'Private Classes', '2342', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dsa', '6 months', 0, '2023-09-12 01:44:23', NULL, NULL),
(13, '177', 'individual', 'undefined', 'undefined', '91', '98765432', 'undefined', '19', '3880 Kearny Villa Rd, San Diego, CA 92123, USA', '-117.1507835', '32.8123654', NULL, 1, 'ab', 'dsaf', 'Graduation', NULL, 'undefined', 'Completed', 'DAV board', 'Online Video Call', 'undefined', 'No', '4', 'Private Classes', 'undefined', '', '', '', '', '', '', '', 'dsa', '6 months', 1, '2023-09-12 01:54:21', '2023-09-12 01:54:21', NULL),
(14, '187', 'individual', 'zxcv', 'zxcv213@gmail.com', '91', '8765456732', 'female', '16', 'Singapore', '103.819836', '1.352083', NULL, 1, 'ab', 'dsf', 'Post Graduation', NULL, 'dfs', 'Completed', 'CBSE', 'Online Video Call', '4', 'No', '4', 'Private Classes', '4324234', '', '', 'Computers', '', '', '', '', 'fdsg', '12 months', 1, '2023-09-12 03:02:21', '2023-09-12 03:02:21', NULL),
(15, '188', 'individual', 'zxcv', 'zxcv2135@gmail.com', '91', '8765456732', 'female', '16', 'Singapore', '103.819836', '1.352083', NULL, 1, 'ab', 'dsf', 'Post Graduation', NULL, 'dfs', 'Completed', 'CBSE', 'Online Video Call', '4', 'No', '4', 'Private Classes', '4324234', '', '', 'Computers', '', '', '', '', 'fdsg', '6 months', 1, '2023-09-12 03:04:09', '2023-09-12 03:04:09', NULL),
(16, '191', 'individual', 'undefined', 'undefined', '91', '8765432345', 'undefined', '18', '600 Terminal Drive, Louisville, KY 40209, USA', '-85.7307673', '38.1706549', NULL, 1, 'ab', 'sdaf', '12th', NULL, 'undefined', 'Pursuing', 'CBSE', 'Online Video Call,Student Home', 'undefined', 'No', '8', 'Group Classes', 'undefined', '', '', 'English,Mathematics,Science,EVS', '', '', '', '', 'dsf', '12 months', 0, '2023-09-12 03:22:57', '2023-09-12 03:22:57', NULL),
(17, '192', 'individual', 'fvfgds', 'sfdg@gmail.com', '91', '7564335687', 'male', '16', 'Egypt', '30.802498', '26.820553', '2023091210110176.jpg', 1, 'akk', 'dfs', 'Graduation', NULL, 'sdf', 'Completed', 'CBSE', 'Online Video Call', '3', 'Yes', '6', 'Private Classes', '43', NULL, NULL, 'Sanskrit,French,German', NULL, NULL, NULL, NULL, 'gsfadsfas', 'Continue without prime benifits', 0, '2023-09-12 04:41:02', NULL, NULL),
(18, '193', 'individual', 'fvfgds', 'sfdg2345678@gmail.com', '91', '7564335687', 'male', '16', 'Egypt', '30.802498', '26.820553', NULL, 1, 'akk', 'dfs', 'Graduation', NULL, 'sdf', 'Completed', 'CBSE', 'Online Video Call', '3', 'Yes', '6', 'Private Classes', '43', '', '', 'Sanskrit,French,German', '', '', '', '', 'gsfadsfas', '12 months', 0, '2023-09-12 04:41:37', '2023-09-12 04:41:37', NULL),
(19, '195', 'individual', 'fda', 'afds@gmail.com', '91', '3242', 'male', '16', 'DSK Vishwa, Dhayari, Pune, Maharashtra, India', '73.7992634', '18.4427627', '2023091211162160.jpg', 1, 'Abkhazian', 'sd', '12th', NULL, 'dsf', 'Completed', 'CBSE', 'Online Video Call', '3', 'Yes', '0', 'Private Classes,Group Classes', '3223', NULL, NULL, 'English,Mathematics,Science', NULL, NULL, NULL, NULL, 'dsf', 'Continue without prime benifits', 0, '2023-09-12 05:46:21', NULL, NULL),
(20, '196', 'individual', 'fda', 'afds12131232143213@gmail.com', '91', '3242', 'male', '16', 'DSK Vishwa, Dhayari, Pune, Maharashtra, India', '73.7992634', '18.4427627', NULL, 1, 'Abkhazian', 'sd', '12th', NULL, 'dsf', 'Completed', 'CBSE', 'Online Video Call', '3', 'Yes', '0', 'Private Classes,Group Classes', '3223', '', '', 'English,Mathematics,Science', '', '', '', '', 'dsf', '12 months', 0, '2023-09-12 05:47:27', '2023-09-12 05:47:27', NULL),
(21, '202', 'institute', 'zxcv', '1232gyan32434@gmail.com', '91', '876565432', NULL, '17', 'Greece', '21.824312', '39.074208', '2023091212065799.jpg', 1, 'Afar', 'sdaf', '12th', 'czvxc', NULL, 'Completed', 'CBSE', 'Online Video Call,Student Home', '4', 'Yes', '10', 'Private Classes', '3432', NULL, NULL, 'English,Mathematics,Science', NULL, NULL, NULL, NULL, 'xcvbds', 'Continue without prime benifits', 0, '2023-09-12 06:36:57', NULL, NULL),
(22, '205', 'institute', 'adsf', 's232da4f@gmail.com', '', '8765435678', NULL, '16', 'Delhi, India', '', '', NULL, 1, 'Acoli', '', '12th', 'techsaga', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '2023-09-12 06:50:36', '2023-09-12 06:50:36', NULL),
(23, '206', 'institute', 'adsf', '2233s232da4f@gmail.com', '', '8765435678', NULL, '16', 'Delhi, India', '', '', NULL, 1, 'Acoli', '', '12th', 'techsaga', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '2023-09-12 06:54:27', '2023-09-12 06:54:27', NULL),
(24, '209', 'institute', 'dsa', 'aadadf123@gmail.com', '91', '8765434567', NULL, '17', 'Delhi, India', '77.10249019999999', '28.7040592', NULL, 1, 'Abkhazian', 'dfg', 'Post Graduation', 'tea', 'asd', 'Completed', 'CBSE', 'Online Video Call', '4', 'No', '10', 'Private Classes', '343', '', '', 'English,Mathematics,Science', '', '', '', '', 'fdg', '12 months', 0, '2023-09-12 06:58:26', '2023-09-12 06:58:26', NULL),
(25, '210', 'institute', 'dsa', 'aw33adadf123@gmail.com', '91', '8765434567', NULL, '17', 'Delhi, India', '77.10249019999999', '28.7040592', '2023091212310399.jpg', 1, 'Abkhazian', 'dfg', 'Post Graduation', 'tanu', 'asd', 'Completed', 'CBSE,ICSE,State Board,International Baccalaureate,NIOS,DAV board', 'Online Video Call', '4', 'No', '10', 'Private Classes', '343', NULL, 'Rajasthan State Board,Odisha State Board,Himachal Pradesh State Board,Bihar State Board', 'English,Mathematics,Science', 'English,Social Studies,Mathematics,Science', 'English,Mathematics,Science,Social studies', NULL, 'English,Social Studies,Mathematics,Science', 'fdg', 'Continue without prime benifits', 0, '2023-09-12 07:01:03', NULL, NULL),
(26, '211', 'institute', 'dsa', 'aw121333adadf123@gmail.com', '91', '8765434567', NULL, '16,17,18', 'Delhi, India', '77.10249019999999', '28.7040592', NULL, 1, 'Abkhazian,Achinese,Acoli,Adangme', 'dfg', 'Post Graduation', 'tanu', 'asd', 'Completed', 'CBSE,ICSE,State Board,International Baccalaureate,NIOS,DAV board', 'Online Video Call', '4', 'No', '10', 'Private Classes', '343', '', 'Rajasthan State Board,Odisha State Board,Himachal Pradesh State Board,Bihar State Board', 'English,Mathematics,Science', 'English,Social Studies,Mathematics,Science', 'English,Mathematics,Science,Social studies', '', 'English,Social Studies,Mathematics,Science', 'fdg', '6 months', 0, '2023-09-12 07:01:53', '2023-09-12 07:01:53', NULL),
(27, '212', 'institute', 'dsa', 'sdfasd3g@gmail.com', '91', '87654345', NULL, '16,17,18', 'Delhi, India', '77.10249019999999', '28.7040592', NULL, 1, 'Abkhazian,Achinese,Acoli,Adangme', 'dfg', 'Post Graduation', 'tanusfd', 'asd', 'Completed', 'State Board', '', '4', 'No', '10', '', '343', 'English,Hindi,Oriya,Punjabi,Urdu', 'Delhi State Board,Karnataka State Board,Andhra Pradesh State Board', 'Hindi,Sanskrit,French,German', 'Bengali,Assamese,Manipuri,Mizo', '', '', '[object Object]', 'fdg', '6 months', 0, '2023-09-12 07:20:15', '2023-09-12 07:20:15', NULL),
(28, '213', 'institute', 'dsa', 'sdfa23sd3g@gmail.com', '91', '87654345', NULL, '16,17,18', 'Delhi, India', '77.10249019999999', '28.7040592', '2023091212522737.jpg', 1, 'Abkhazian,Achinese,Acoli,Adangme', 'dfg', 'Post Graduation', 'tanusfd', 'asd', 'Completed', 'CBSE,ICSE,State Board,International Baccalaureate,NIOS,DAV board', 'Online Video Call,Student Home', '4', 'No', '10', 'Private Classes,Group Classes', '343', 'English,Hindi,Oriya,Punjabi,Urdu', 'Delhi State Board,Karnataka State Board,Andhra Pradesh State Board', 'Hindi,Sanskrit,French,German', 'English,Social Studies,Bengali,Assamese,Manipuri,Mizo', 'English,Mathematics', NULL, 'English,Social Studies', 'fdg', 'Continue without prime benifits', 0, '2023-09-12 07:22:27', NULL, NULL),
(29, '214', 'individual', 'sdf', '12sd@gmaial.com', '91', '8765487654', 'male', '18,19', 'Albania', '20.168331', '41.153332', '2023091212583890.jpg', 1, 'Achinese,Acoli', 'asd', '12th', NULL, 'sda', 'Pursuing', 'CBSE', 'Online Video Call,Student Home', '2', 'Yes', '10', 'Private Classes,Group Classes', '6543', NULL, NULL, 'English,Mathematics,Science', NULL, NULL, NULL, NULL, 'zxc', 'Continue without prime benifits', 0, '2023-09-12 07:28:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` varchar(255) DEFAULT NULL,
  `user_type` tinyint(4) DEFAULT 0 COMMENT '0 => admin, 1 => user',
  `status` tinyint(4) DEFAULT 1 COMMENT '0 => Inactive, 1 => Active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(255) DEFAULT NULL,
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `messenger_color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role_id`, `user_type`, `status`, `remember_token`, `created_at`, `updated_at`, `active_status`, `avatar`, `dark_mode`, `messenger_color`) VALUES
(1, 'Super', 'admin', 'super admin', 'admin@gmail.com', '2323123212', '2023-08-24 05:05:29', '$2y$10$KAe3HOwj.TQPmnyBQpOhpOXInhPNctT1wU8g5fB93mrrd/n44ZA/m', NULL, 0, 1, NULL, '2023-08-09 05:05:29', '2023-08-10 05:05:29', 0, 'avatar.png', 0, NULL),
(2, 'priyanshu', 'srivastav', 'priyanshu srivastav', '9918priyanshu@gmail.com', '81129112914', NULL, '$2y$10$tpbSDapgdg3/wZ86KIN3..EqyIWeGnxNpbFOLxy66kFmG.8KI2WTO', '4', 1, 1, NULL, '2023-08-02 23:49:29', '2023-08-03 00:00:50', 0, 'avatar.png', 0, NULL),
(3, 'Naveen Chandra', 'Samala', 'Naveen Chandra Samala', 'agent@gmail.com', '7286932429', NULL, '$2y$10$MGlWKgE8qgFU8G/Un7899ud4xKm0k7.EAU.G6FSo3kBK2l5FDkPV.', '4', 1, 1, NULL, '2023-08-07 14:35:31', NULL, 0, 'avatar.png', 0, NULL),
(158, NULL, NULL, 'Abhinav Kumar Singh', 'abhinavkuamrsingh217@gmail.com', '8115555857', NULL, '$2y$10$3.xkAL.gSja32SrS.NXlqOA3hok7pKSr2YhYqqzTKpgjNw/PrbJw2', NULL, 2, 1, NULL, '2023-09-11 04:57:01', '2023-09-11 04:57:01', 0, '2023091110270141.jpg', 0, NULL),
(159, NULL, NULL, 'Gyan', 'gyan@gmail.com', '8765433456', NULL, '$2y$10$auFEi0HQKX89A869ilrZauwl1tXKUHgGR0DPY9CTnVb.ANAGjDrRe', NULL, 2, 1, NULL, '2023-09-11 05:21:32', NULL, 0, NULL, 0, NULL),
(161, NULL, NULL, 'rahul', 'rahul@gmail.com', '6754345643', NULL, '$2y$10$ZHWI8J3W3asz8NiqNdVnLeft19AyuFOVZEyF2E9nwMQQOBSoIPeT6', NULL, 2, 1, NULL, '2023-09-12 00:08:11', '2023-09-12 00:08:11', 0, '2023091205381186.jpg', 0, NULL),
(162, NULL, NULL, 'sadf', 'df@gmail.com', '6754356435', NULL, '$2y$10$OWDOELuQY9NReG47/5pqoeG1X28LJJy9Pyz4nYppNG40ROJDhfXyK', NULL, 2, 1, NULL, '2023-09-12 00:15:42', '2023-09-12 00:15:42', 0, '2023091205454290.jpg', 0, NULL),
(163, NULL, NULL, 'sdaf', 'dsdsfa@gmail.com', '8765434554', NULL, '$2y$10$9ONYEUjgOttWa.E3VgqESuNDNQYI7U0UNayGAw.u1ESYHqhdEIBDG', NULL, 2, 1, NULL, '2023-09-12 00:27:04', '2023-09-12 00:27:04', 0, '2023091205570497.jpg', 0, NULL),
(164, NULL, NULL, 'dsaf', 'abhinavkuamrdssingh217@gmail.com', '7654345678', NULL, '$2y$10$GTAqTsKxAoCFB1f1RteH1.Wj5mtsMzVX7hPjrEWZN7xQnYBYsW566', NULL, 2, 1, NULL, '2023-09-12 00:29:38', '2023-09-12 00:29:38', 0, '2023091205593892.jpg', 0, NULL),
(165, NULL, NULL, 'czxc', 'zxc@gmail.com', '7654323456', NULL, '$2y$10$F/N3NqlxG35Reecy6Jpn9Otl/3W/hfWhOGHup6sWLqH60Rp.B/seq', NULL, 2, 1, NULL, '2023-09-12 00:35:36', '2023-09-12 00:35:36', 0, '2023091206053654.jpg', 0, NULL),
(166, NULL, NULL, 'asdf', 'sa@gmail.com', '9876543234', NULL, '$2y$10$/QbP8.z9bdJoBJfhXaQkDO5SIdb4tiCsQbGCiWdbuU.WIzb4Z19ka', NULL, 2, 1, NULL, '2023-09-12 00:38:38', '2023-09-12 00:38:38', 0, '2023091206083890.jpg', 0, NULL),
(167, NULL, NULL, 'asdf', 's322adf@gamoasdfk.com2', '6987654321', NULL, '$2y$10$9hpblTXpCYDW7v6DFfAzQ.DiG.KvdL15EKYZ5jAc7M4g3xAfqBcXe', NULL, 2, 1, NULL, '2023-09-12 00:43:43', '2023-09-12 00:43:43', 0, '2023091206134307.jpg', 0, NULL),
(172, NULL, NULL, 'asdf', 'ads@gmail.com', '9876543456', NULL, '$2y$10$Gf1VZTlhrR1O6aIOHryfOelDaTqdizp/kicQVBAlz32IMblrKtE3W', NULL, 2, 1, NULL, '2023-09-12 01:11:05', '2023-09-12 01:11:05', 0, '2023091206410585.jpg', 0, NULL),
(174, NULL, NULL, 'dsgdf', 'dsf@gjkljdsfgk.com', '076543 567', NULL, '$2y$10$D1DuUdG2D4SWsBhANcJwbOZg98lTQV6U4trweOhf/1QQjidgxbheS', NULL, 2, 1, NULL, '2023-09-12 01:14:14', '2023-09-12 01:14:14', 0, '2023091206441446.jpg', 0, NULL),
(184, NULL, NULL, 'zxcv', 'zxcv@gmail.com', '8765456787', NULL, '$2y$10$EOCgY.AMuwrBtdt1VNr/guEN9THfPfNpg4Lcd2FbesmeXmXBLRmeW', NULL, 2, 1, NULL, '2023-09-12 03:00:39', NULL, 0, NULL, 0, NULL),
(185, NULL, NULL, 'zxcv', 'zxcv21@gmail.com', '8765456732', NULL, '$2y$10$XbhC4tBwqROox3NU8nCpA.BbBCWDNMTEaiUBnCLJ4Vj2iW3QXyh/O', NULL, 2, 1, NULL, '2023-09-12 03:01:26', NULL, 0, NULL, 0, NULL),
(187, NULL, NULL, 'zxcv', 'zxcv213@gmail.com', '8765456732', NULL, '$2y$10$KwNTe5CN37O6n4YsMfkf0Ockory.0C8FLHjY63XyqZqxSyBtwuaF2', NULL, 2, 1, NULL, '2023-09-12 03:02:21', NULL, 0, NULL, 0, NULL),
(188, NULL, NULL, 'zxcv', 'zxcv2135@gmail.com', '8765456732', NULL, '$2y$10$pvvhEot1eyVwoh90L4nHwuDAWMwXVr0alWdsvMz6CGF.g/Y8VZy8W', NULL, 2, 1, NULL, '2023-09-12 03:04:09', NULL, 0, NULL, 0, NULL),
(191, NULL, NULL, 'undefined', 'undefined', '8765432345', NULL, '$2y$10$xEN6JioelIvEe6rOPak33.jGCKmK81t1MEwi/shru4zDiax1qDJz.', NULL, 2, 1, NULL, '2023-09-12 03:22:57', NULL, 0, NULL, 0, NULL),
(192, NULL, NULL, 'fvfgds', 'sfdg@gmail.com', '7564335687', NULL, '$2y$10$vc7QN809ySeb6o3c9bB07.9kntzuJuuLZHC7Jq/z9YthhHDF4C6v.', NULL, 2, 1, NULL, '2023-09-12 04:41:01', '2023-09-12 04:41:01', 0, '2023091210110176.jpg', 0, NULL),
(193, NULL, NULL, 'fvfgds', 'sfdg2345678@gmail.com', '7564335687', NULL, '$2y$10$mWRd31FFxp.hTOIIl/Tg8OIqY4ajsdrb4PCnOfdAfp8G0xcY9yy.2', NULL, 2, 1, NULL, '2023-09-12 04:41:37', NULL, 0, NULL, 0, NULL),
(195, NULL, NULL, 'fda', 'afds@gmail.com', '3242', NULL, '$2y$10$UTWzGYh5sfoWFx32CnGDbO1EgWsw/8Xuo4gVy/7q3NuKByGsLWU3S', NULL, 2, 1, NULL, '2023-09-12 05:46:21', '2023-09-12 05:46:21', 0, '2023091211162160.jpg', 0, NULL),
(196, NULL, NULL, 'fda', 'afds12131232143213@gmail.com', '3242', NULL, '$2y$10$0yhNFC2DCvvpMk0hnXw85eZu6yM2te74tdzorL7LivFo/RI7Q7qFW', NULL, 2, 1, NULL, '2023-09-12 05:47:27', NULL, 0, NULL, 0, NULL),
(202, NULL, NULL, 'zxcv', '1232gyan32434@gmail.com', '876565432', NULL, '$2y$10$ip8e2B.zpIt/ZWT6k5WE/.Fo9O1BzXxDCWp16eavLtxIJ4XSW48Lm', NULL, 2, 1, NULL, '2023-09-12 06:36:57', '2023-09-12 06:36:57', 0, '2023091212065799.jpg', 0, NULL),
(203, NULL, NULL, 'adsf', 'sda4f@gmail.com', '8765435678', NULL, '$2y$10$yE4v6boahCUIbajJRmccdOkJcoHEiuz07qXDsr.Mrwbx.qC55Cp4S', NULL, 2, 1, NULL, '2023-09-12 06:47:49', NULL, 0, NULL, 0, NULL),
(205, NULL, NULL, 'adsf', 's232da4f@gmail.com', '8765435678', NULL, '$2y$10$GG.B0pPkMANgN8oKBC8Y9.s5/2d3R8Cl4VmnAn1FXwDy.C.4x36U6', NULL, 2, 1, NULL, '2023-09-12 06:50:36', NULL, 0, NULL, 0, NULL),
(206, NULL, NULL, 'adsf', '2233s232da4f@gmail.com', '8765435678', NULL, '$2y$10$f990pggXUXBW8swN5NzXeOzLN/DWWEyq1hTtuGutD4gcrAHH1wB4e', NULL, 2, 1, NULL, '2023-09-12 06:54:27', NULL, 0, NULL, 0, NULL),
(207, NULL, NULL, 'dsa', 'a123@gmail.com', '8765434567', NULL, '$2y$10$Yf91RQLVzbRuYCJ6sGVaqOcZm2tu0x15vh70JgG.zhWS9r7W9Auyy', NULL, 2, 1, NULL, '2023-09-12 06:57:34', NULL, 0, NULL, 0, NULL),
(209, NULL, NULL, 'dsa', 'aadadf123@gmail.com', '8765434567', NULL, '$2y$10$nv0Ed4MMcHgOO65.5zTs9.OpcTCB8Ang.hTsehH8UuJHefAp.Qjmu', NULL, 2, 1, NULL, '2023-09-12 06:58:26', NULL, 0, NULL, 0, NULL),
(210, NULL, NULL, 'dsa', 'aw33adadf123@gmail.com', '8765434567', NULL, '$2y$10$uo3F4ORoqZ3dEDA5bbccVOLkeVT/gGP.TB/P1yve28dPAZC/ztX3u', NULL, 2, 1, NULL, '2023-09-12 07:01:03', '2023-09-12 07:01:03', 0, '2023091212310399.jpg', 0, NULL),
(211, NULL, NULL, 'dsa', 'aw121333adadf123@gmail.com', '8765434567', NULL, '$2y$10$N7Yvigf8hYmpPTvV56V1huS4ZxmoGPNnesMCAQxrCcOxAKEfj.pLe', NULL, 2, 1, NULL, '2023-09-12 07:01:53', NULL, 0, NULL, 0, NULL),
(212, NULL, NULL, 'dsa', 'sdfasd3g@gmail.com', '87654345', NULL, '$2y$10$.6xkBvVxWBXOO4P/pOQmfO.RZqOsmzFemm/Y7bIAficGKcqFP/Uum', NULL, 2, 1, NULL, '2023-09-12 07:20:15', NULL, 0, NULL, 0, NULL),
(213, NULL, NULL, 'dsa', 'sdfa23sd3g@gmail.com', '87654345', NULL, '$2y$10$vv2OofbFSRzWRFWzWxG9Iew3cRQMXFg5Gtta5qjrxZU8/YNNt6Q8S', NULL, 2, 1, NULL, '2023-09-12 07:22:27', '2023-09-12 07:22:27', 0, '2023091212522737.jpg', 0, NULL),
(214, NULL, NULL, 'sdf', '12sd@gmaial.com', '8765487654', NULL, '$2y$10$oyyQyMxpfZbO3Dl31Cyo/uJWuKYNtRoieTRW8lIghtJfjy6XPyfeW', NULL, 2, 1, NULL, '2023-09-12 07:28:38', '2023-09-12 07:28:38', 0, '2023091212583890.jpg', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `whyknowmerits`
--

CREATE TABLE `whyknowmerits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `one_image` varchar(255) DEFAULT NULL,
  `two_image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `write_reviews`
--

CREATE TABLE `write_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tutor_type` varchar(255) DEFAULT NULL,
  `tutor_name` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0 => Inactive, 1 => Active, 2 => Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `write_reviews`
--

INSERT INTO `write_reviews` (`id`, `tutor_type`, `tutor_name`, `comment`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tutor', 'Jamesh gosling', 'good', 1, '2023-08-22 12:50:03', NULL, NULL),
(2, 'Tutor', 'Jamesh gosling', 'czxv', 1, '2023-09-08 04:39:04', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus_points`
--
ALTER TABLE `aboutus_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `action_masters`
--
ALTER TABLE `action_masters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_masters_parent_index` (`parent_id`);

--
-- Indexes for table `benifits`
--
ALTER TABLE `benifits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_a_classes`
--
ALTER TABLE `book_a_classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `book_a_classes_email_unique` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_index` (`parent`);

--
-- Indexes for table `cbse`
--
ALTER TABLE `cbse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `communities`
--
ALTER TABLE `communities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `community_comments`
--
ALTER TABLE `community_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `community_comments_parent_index` (`parent`);

--
-- Indexes for table `community_likes`
--
ALTER TABLE `community_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_masters`
--
ALTER TABLE `contact_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_sec_fsts`
--
ALTER TABLE `contact_sec_fsts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_sec_scnds`
--
ALTER TABLE `contact_sec_scnds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `featureds`
--
ALTER TABLE `featureds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `icse`
--
ALTER TABLE `icse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `igcse`
--
ALTER TABLE `igcse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `international_baccalaureate_sub`
--
ALTER TABLE `international_baccalaureate_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_banners`
--
ALTER TABLE `manage_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_pages`
--
ALTER TABLE `manage_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manage_sliders`
--
ALTER TABLE `manage_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_ship_plans`
--
ALTER TABLE `member_ship_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nios`
--
ALTER TABLE `nios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_boards`
--
ALTER TABLE `state_boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_sub`
--
ALTER TABLE `state_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutors`
--
ALTER TABLE `tutors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `whyknowmerits`
--
ALTER TABLE `whyknowmerits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `write_reviews`
--
ALTER TABLE `write_reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus_points`
--
ALTER TABLE `aboutus_points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `action_masters`
--
ALTER TABLE `action_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `benifits`
--
ALTER TABLE `benifits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_a_classes`
--
ALTER TABLE `book_a_classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `cbse`
--
ALTER TABLE `cbse`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `communities`
--
ALTER TABLE `communities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `community_comments`
--
ALTER TABLE `community_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `community_likes`
--
ALTER TABLE `community_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_masters`
--
ALTER TABLE `contact_masters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_sec_fsts`
--
ALTER TABLE `contact_sec_fsts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_sec_scnds`
--
ALTER TABLE `contact_sec_scnds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `featureds`
--
ALTER TABLE `featureds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `icse`
--
ALTER TABLE `icse`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `igcse`
--
ALTER TABLE `igcse`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `international_baccalaureate_sub`
--
ALTER TABLE `international_baccalaureate_sub`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `manage_banners`
--
ALTER TABLE `manage_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manage_pages`
--
ALTER TABLE `manage_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `manage_sliders`
--
ALTER TABLE `manage_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_ship_plans`
--
ALTER TABLE `member_ship_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `nios`
--
ALTER TABLE `nios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `state_boards`
--
ALTER TABLE `state_boards`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `state_sub`
--
ALTER TABLE `state_sub`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tutors`
--
ALTER TABLE `tutors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT for table `whyknowmerits`
--
ALTER TABLE `whyknowmerits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `write_reviews`
--
ALTER TABLE `write_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
