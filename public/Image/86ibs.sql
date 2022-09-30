-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2022 at 02:47 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ibs`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `cat_image`, `created_at`, `updated_at`, `slug`, `parent_id`) VALUES
(1, 'ONLINE COURSES', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s,</p>', '202208250848Associate-Degree-in-Information-Technology-500x500.jpg', '2022-08-25 03:18:11', '2022-08-25 03:18:11', 'online-courses', NULL),
(2, 'VIRTUAL OFFICE', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s,</p>', '202208250853advanced-diploma-accounting-500x500.jpg', '2022-08-25 03:23:44', '2022-08-25 03:23:44', 'virtual-office', NULL),
(3, 'PROFESSIONAL COURSES', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s,</p>', '202208250856advanced-diploma-accounting-500x500.jpg', '2022-08-25 03:26:13', '2022-08-25 04:07:24', 'professional-courses', 1);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcat_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `slug`, `cat_id`, `subcat_id`, `course_image`, `course_duration`, `course_id`, `short_description`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Online Advanced Diploma in Economics', 'advance-diploma', '1', '3', '202208251014advanced-diploma-accounting-500x500.jpg', '1 year (full time)', 'ADIE', '<p>&nbsp;</p>\r\n\r\n<p>This course explores the fundamentals of the human workforce, including personality development and principles of management.</p>', '<h1>Online Advanced Diploma in Economics</h1>\r\n\r\n<p><em>Available online.</em></p>\r\n\r\n<p>This course provides advance skills and knowledge for individuals to be competent in a wide range of policy making job roles in Public/Private sector organizations and Non-governmental organizations requiring advisory supports.</p>\r\n\r\n<h2>Structure:</h2>\r\n\r\n<ul>\r\n	<li>Online</li>\r\n</ul>\r\n\r\n<p>This course is comprised of eight units, each designed to build your capabilities in the areas mentioned above. The structure is aligned with workplace outcomes and local industry requirements.</p>\r\n\r\n<h3>Year 2 &ndash; Semester 1</h3>\r\n\r\n<p>ED0202 Financial Markets and Organizations</p>\r\n\r\n<p>IT0209 Business Statistics</p>\r\n\r\n<p>IT0210 Introduction to Calculus</p>\r\n\r\n<p>AF0101 Principles of Accounting</p>\r\n\r\n<h3>Year 2 &ndash; Semester 2</h3>\r\n\r\n<p>BM0104 Fundamentals of Business Practices</p>\r\n\r\n<p>ED0204 Introductory Econometrics</p>\r\n\r\n<p>AF0206 Fundamentals of Business Finance</p>\r\n\r\n<p>BM0206 Internship &ndash; Internal Practice</p>', '2022-08-25 04:44:05', '2022-08-25 04:44:05'),
(2, 'Online Advanced Diploma in Accounting', 'diploma-accounting', '1', '3', '202208251016Associate-Degree-in-Information-Technology-500x500.jpg', '1 year (full time)', 'ADIA', '<p>This course offers a deep dive into advanced accounting practices. It covers taxation and auditing, cost accounting and management accounting.&nbsp;</p>', '<p>This course&nbsp;offers a deep dive into advanced accounting practices, including the way organisations record financial transactions and analyse and communicate the results of such transactions. It covers taxation and auditing, cost accounting and management accounting among other topics.&nbsp;</p>\r\n\r\n<h2>Structure:</h2>\r\n\r\n<ul>\r\n	<li>Online</li>\r\n</ul>\r\n\r\n<p>This course is comprised of eight units, each designed to build your capabilities in the areas mentioned above. The structure is aligned with workplace outcomes and global industry requirements.&nbsp;</p>\r\n\r\n<h3><strong>Year 2 &ndash; Semester 1</strong></h3>\r\n\r\n<p><strong>BM0204</strong>&nbsp;Business Law</p>\r\n\r\n<p><strong>IT0209</strong>&nbsp;Business Statistics</p>\r\n\r\n<p><strong>AF0202</strong>&nbsp;Auditing</p>\r\n\r\n<p><strong>BM0201</strong>&nbsp;Business Ethics</p>\r\n\r\n<h3><strong>Year 2 &ndash; Semester 2</strong></h3>\r\n\r\n<p><strong>AF0203</strong>&nbsp;Cost Accounting</p>\r\n\r\n<p><strong>AF0204</strong>&nbsp;Taxation</p>\r\n\r\n<p><strong>ECO10250</strong>&nbsp;Economics for Decision Making</p>\r\n\r\n<p><strong>AF0205</strong>&nbsp;Internship &ndash; Internal Practice</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Course duration:</strong>&nbsp;1 year (full time)​</p>\r\n\r\n<p><strong>Entry requirements:</strong>&nbsp;<a href=\"http://www.ibs.ac.pg/?u_course=diploma-in-accounting\">Diploma in Accounting</a></p>', '2022-08-25 04:46:49', '2022-08-25 04:46:49'),
(3, 'Online Advanced Diploma in Business', 'advance-diploma-business', '1', '3', '202208251026Associate-Degree-in-Information-Technology-500x500.jpg', '1 year (full time)', 'ADIB', '<h2>ADVANCED DIPLOMA IN BUSINESS MANAGEMENT</h2>\r\n\r\n<p>This course offers a deep dive into advanced business strategy, research, information systems, industrial relations and consumer behaviour.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>DURATION:</p>\r\n\r\n<p>1 year (full time)</p>\r\n\r\n<p>ID:</p>\r\n\r\n<p>ADIB</p>', '<h2>Online Advanced Diploma in Business</h2>\r\n\r\n<p><em>Available online.</em></p>\r\n\r\n<p>This course offers a deep dive into advanced business strategy, research, information systems, industrial relations and consumer behaviour. Graduates can expect to work in global organisations with a view to taking on leadership roles.&nbsp;</p>\r\n\r\n<h2>Structure:</h2>\r\n\r\n<ul>\r\n	<li>Online</li>\r\n</ul>\r\n\r\n<p>This course is comprised of eight units, each designed to build your capabilities in the areas mentioned above. The structure is aligned with workplace outcomes and local industry requirements.</p>\r\n\r\n<h3><strong>Year 2 &ndash; Semester 1</strong></h3>\r\n\r\n<p><strong>BM0204</strong>&nbsp;Business Law</p>\r\n\r\n<p><strong>IT0203</strong>&nbsp;Principles of Human Resource Management</p>\r\n\r\n<p><strong>IT0209</strong>&nbsp;Business Statistics</p>\r\n\r\n<p><strong>AF0101</strong>&nbsp;Principles of Accounting</p>\r\n\r\n<h3><strong>Year 2 &ndash; Semester 2</strong></h3>\r\n\r\n<p><strong>ECO10250</strong>&nbsp;Economics for Decision Making</p>\r\n\r\n<p><strong>BM0205</strong>&nbsp;Entrepreneurship and Small Business</p>\r\n\r\n<p><strong>AF0206</strong>&nbsp;Fundamentals of Business Finance</p>\r\n\r\n<p><strong>BM0206</strong>&nbsp;Internship &ndash; Internal Practice</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Course duration:</strong>&nbsp;1 year (full time)​</p>\r\n\r\n<p><strong>Entry requirements:</strong>&nbsp;<a href=\"http://www.ibs.ac.pg/?u_course=diploma-in-business-management\">Diploma in Business Management</a></p>', '2022-08-25 04:56:29', '2022-08-25 04:56:29'),
(4, 'Online Diploama in Economics', 'online-diploma-economics', '1', '3', '202208251029Associate-Degree-in-Information-Technology-500x500.jpg', '1 year (full time)', 'DIE', '<p>This course is a relevant and career-focused degree program, which prepares students to lead and add value to organisations in a global marketplace.</p>\r\n\r\n<p>DURATION:</p>\r\n\r\n<p>1 year (full time)</p>\r\n\r\n<p>ID:</p>\r\n\r\n<p>DIE</p>', '<h1>Online Diploma in Economics</h1>\r\n\r\n<p><em>Available online.</em></p>\r\n\r\n<p>This qualification provides necessary skills and knowledge for individuals to be competent in a wide range of policy making job roles in Public/Private sector organizations and Non-governmental organizations requiring advisory supports.</p>\r\n\r\n<h2>Structure:</h2>\r\n\r\n<ul>\r\n	<li>Online</li>\r\n</ul>\r\n\r\n<p>This course is comprised of 8 units, each designed to build your capabilities in the areas mentioned above. The structure is aligned with workplace outcomes and global industry requirements.</p>\r\n\r\n<h3>Year 1 &ndash; Semester 1</h3>\r\n\r\n<p><strong>BM0103</strong>&nbsp;Business and Academic English</p>\r\n\r\n<p><strong>IT0101</strong>&nbsp;Fundamentals of Information Technology</p>\r\n\r\n<p><strong>IT0102</strong>&nbsp;Business Mathematics</p>\r\n\r\n<p><strong>BM0102</strong>&nbsp;Principles of Management</p>\r\n\r\n<h3>Year 1 &ndash; Semester 2</h3>\r\n\r\n<p><strong>ED0201</strong>&nbsp;Principles of Microeconomics</p>\r\n\r\n<p><strong>ECO10250</strong>&nbsp;Economics for Decision Making</p>\r\n\r\n<p><strong>BM0101</strong>&nbsp;Personality Development</p>\r\n\r\n<p><strong>ED0203</strong>&nbsp;Principles of Macroeconomics</p>', '2022-08-25 04:59:28', '2022-08-25 04:59:28'),
(5, 'Online Advanced Diploma in Information Technology', 'advance-diploma-information-technology', '1', '3', '202208251041Associate-Degree-in-Information-Technology-500x500.jpg', '1 year (full time)', 'ADIT', '<h2>ADVANCED DIPLOMA IN INFORMATION TECHNOLOGY</h2>\r\n\r\n<p>This course furthers IT knowledge regarding security management, object oriented programming, graphics and multimedia and IT infrastructure management.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>DURATION:</p>\r\n\r\n<p>1 year (full time)</p>\r\n\r\n<p>ID:</p>\r\n\r\n<p>ADIT</p>', '<h2>Online Advanced Diploma in IT</h2>\r\n\r\n<p><em>Available online.</em></p>\r\n\r\n<p>This course furthers students&rsquo; knowledge of information technology with topics such as security management, object oriented programming and design, graphics and multimedia and IT infrastructure management. Students will also cover business process and IT strategy.&nbsp;&nbsp;</p>\r\n\r\n<h2>Structure:</h2>\r\n\r\n<ul>\r\n	<li>Online</li>\r\n</ul>\r\n\r\n<p>This course is comprised of eight units, each designed to build your capabilities in the areas mentioned above. The structure is aligned with workplace outcomes and local industry requirements.&nbsp;</p>\r\n\r\n<h3><strong>Year 2 &ndash; Semester 1</strong></h3>\r\n\r\n<p><strong>IT0203</strong>&nbsp;Web Systems</p>\r\n\r\n<p><strong>IT0202</strong>&nbsp;Programming Fundamentals</p>\r\n\r\n<p><strong>IT0204</strong>&nbsp;Database Management Systems</p>\r\n\r\n<p>Principles of Management</p>\r\n\r\n<h3><strong>Year 2 &ndash; Semester 2</strong></h3>\r\n\r\n<p><strong>IT0206</strong>&nbsp;Advanced Computer Programming</p>\r\n\r\n<p><strong>BM0101</strong>&nbsp;Personality Development</p>\r\n\r\n<p><strong>ECO10250</strong>&nbsp;Economics for Decision Making</p>\r\n\r\n<p><strong>IT0208</strong>&nbsp;Industry Study on IT</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Course duration:</strong>&nbsp;1 year (full time)​</p>\r\n\r\n<p><strong>Entry requirements:</strong>&nbsp;Diploma in Information Technology</p>', '2022-08-25 05:11:17', '2022-08-25 05:11:17'),
(6, 'Online Diploma in Accounting', 'diploma-in-accounting', '1', '3', '202208251046Associate-Degree-in-Information-Technology-500x500.jpg', '1 year (full time)', 'DIA', '<p>This course covers standard accounting financial statements, analysis of operating results and utilisation of accounting information.</p>\r\n\r\n<p>DURATION:</p>\r\n\r\n<p>1 year (full time)</p>\r\n\r\n<p>ID:</p>\r\n\r\n<p>DIA</p>', '<h1>Online Diploma in Accounting</h1>\r\n\r\n<p><em>Available online</em></p>\r\n\r\n<p>This course provides necessary skills and knowledge for individuals to be competent in a wide range of accounting roles in auditing firms, trading and manufacturing organizations and services industries accounting support function.</p>\r\n\r\n<h2>Structure:</h2>\r\n\r\n<ul>\r\n	<li>Online</li>\r\n</ul>\r\n\r\n<p>This course is comprised of 8 units, each designed to build your capabilities in the areas mentioned above. The structure is aligned with workplace outcomes and global industry requirements.</p>\r\n\r\n<h3>Year 1 &ndash; Semester 1</h3>\r\n\r\n<p><strong>BM0103</strong>&nbsp;Business and Academic English</p>\r\n\r\n<p><strong>IT0101</strong>&nbsp;Fundamentals of Information Technology</p>\r\n\r\n<p><strong>IT0102</strong>&nbsp;Business Mathematics</p>\r\n\r\n<p><strong>BM0102</strong>&nbsp;Principles of Management</p>\r\n\r\n<h3>Year 1 &ndash; Semester 2</h3>\r\n\r\n<p><strong>BM0104</strong>&nbsp;Fundamentals of Business Practices</p>\r\n\r\n<p><strong>AF0101</strong>&nbsp;Principles of Accounting</p>\r\n\r\n<p><strong>BM0101</strong>&nbsp;Personality Development</p>\r\n\r\n<p><strong>AF0102</strong>&nbsp;Financial Accounting</p>', '2022-08-25 05:16:50', '2022-08-25 05:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `courseselections`
--

CREATE TABLE `courseselections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stu_id` int(11) NOT NULL,
  `course_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`course_id`)),
  `studentSelCid` int(10) NOT NULL DEFAULT 0,
  `offer_generated` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courseselections`
--

INSERT INTO `courseselections` (`id`, `stu_id`, `course_id`, `studentSelCid`, `offer_generated`, `created_at`, `updated_at`) VALUES
(14, 9, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"]', 4, 0, '2022-09-06 08:40:47', '2022-09-06 09:47:57'),
(15, 10, '[\"1\",\"2\",\"3\"]', 1, 0, '2022-09-07 00:25:44', '2022-09-07 00:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stu_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `stu_id`, `status`, `created_at`, `updated_at`) VALUES
(7, 3, 1, '2022-08-26 07:39:28', '2022-08-26 07:39:28'),
(10, 6, 1, '2022-09-05 12:41:37', '2022-09-05 12:41:37'),
(11, 6, 1, '2022-09-05 12:42:17', '2022-09-05 12:42:17'),
(12, 7, 1, '2022-09-06 08:16:53', '2022-09-06 08:16:53'),
(13, 9, 1, '2022-09-06 08:40:34', '2022-09-06 08:40:34'),
(14, 10, 1, '2022-09-07 00:24:59', '2022-09-07 00:24:59'),
(15, 9, 1, '2022-09-07 00:25:29', '2022-09-07 00:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stu_id` int(11) NOT NULL,
  `qualification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `board` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `stu_id`, `qualification`, `board`, `percentage`, `document`, `created_at`, `updated_at`) VALUES
(1, 2, 'tt', 'hh', '45', 'hh', '2022-08-24 00:39:34', '2022-08-24 00:39:34'),
(2, 2, 'tt', 'gg', '45', '12.jpg', '2022-08-24 01:17:44', '2022-08-24 01:17:44'),
(3, 2, 'tt', 'hh', '45', '12.jpg', '2022-08-24 01:18:27', '2022-08-24 01:18:27'),
(4, 2, 'tt', 'fff', '45', '12.jpg', '2022-08-24 01:21:56', '2022-08-24 01:21:56'),
(5, 2, 'Higher School(10th)', 'fff', '34', '14.jpg', '2022-08-24 06:04:17', '2022-08-24 06:04:17'),
(6, 2, 'Higher School(10th)', 'gt', '45', '14.jpg', '2022-08-24 06:05:30', '2022-08-24 06:05:30'),
(7, 2, 'Higher School(12th)', 'gggg', '49', '14.jpg', '2022-08-24 06:05:31', '2022-08-24 06:05:31'),
(8, 2, 'Higher School(10th)', 'gt', '45', '14.jpg', '2022-08-24 06:05:32', '2022-08-24 06:05:32'),
(9, 2, 'Higher School(12th)', 'gggg', '49', '14.jpg', '2022-08-24 06:05:32', '2022-08-24 06:05:32'),
(10, 2, 'Higher School(10th)', 'gg', '56', '202208241331campus-1.jpg', '2022-08-24 08:01:27', '2022-08-24 08:01:27'),
(11, 2, 'Higher School(10th)', 'fff', '45', '41course_2.jpg', '2022-08-24 08:09:00', '2022-08-24 08:09:00'),
(12, 2, 'Higher School(10th)', 'FF', '45', '95course_1.jpg', '2022-08-24 09:47:17', '2022-08-24 09:47:17'),
(13, 2, 'Higher School(10th)', 'gg', '45', '22course_2.jpg', '2022-08-24 09:47:33', '2022-08-24 09:47:33'),
(14, 2, 'Higher School(10th)', 'ff', '49', '64blog_large_1.jpg', '2022-08-24 09:48:25', '2022-08-24 09:48:25'),
(15, 2, 'Higher School(10th)', 'ff', '56', '37blog_1.jpg', '2022-08-24 09:49:58', '2022-08-24 09:49:58'),
(16, 2, 'Higher School(10th)', 'fff', '34', '78IBS-Logo.png', '2022-08-24 09:56:50', '2022-08-24 09:56:50'),
(17, 3, 'Higher School(10th)', 'UP', '78', '53blog_large_1.jpg', '2022-08-25 00:51:48', '2022-08-25 00:51:48'),
(18, 3, 'Higher School(12th)', 'NOIDA', '56', '48course_2.jpg', '2022-08-25 00:53:18', '2022-08-25 00:53:18'),
(23, 6, 'Higher School(10th)', 'noida', '56', '7433blog_large_1.jpg', '2022-09-05 12:33:26', '2022-09-05 12:33:26'),
(25, 6, 'Higher School(12th)', 'gg', '78', '2278IBS-Logo.png', '2022-09-06 02:19:45', '2022-09-06 02:19:45'),
(26, 6, 'Higher School(12th)', 'ff', '55', '5778IBS-Logo.png', '2022-09-06 02:23:58', '2022-09-06 02:23:58'),
(27, 7, 'Higher School(10th)', 'RBSE', '60', '92AdityaResult.pdf', '2022-09-06 04:48:08', '2022-09-06 04:48:08'),
(28, 7, 'Higher School(10th)', 'RBSE', '60', '60AdityaResult.pdf', '2022-09-06 08:06:56', '2022-09-06 08:06:56'),
(29, 7, 'Higher School(10th)', 'RBSE', '60', '84AdityaResult.pdf', '2022-09-06 08:08:00', '2022-09-06 08:08:00'),
(30, 7, 'Higher School(10th)', 'RBSE', '60', '25AdityaResult.pdf', '2022-09-06 08:17:18', '2022-09-06 08:17:18'),
(31, 7, 'Higher School(10th)', 'RBSE', '60', '64AdityaResult.pdf', '2022-09-06 08:32:45', '2022-09-06 08:32:45'),
(32, 9, 'Higher School(10th)', 'RBSE', '60', '37AdityaResult.pdf', '2022-09-06 08:39:35', '2022-09-06 08:39:35'),
(33, 9, 'Higher School(12th)', 'RBSE', '60', '77AdityaResult.pdf', '2022-09-06 08:41:30', '2022-09-06 08:41:30'),
(34, 9, 'Graduation(Bachelors)', 'RBSE', '60', '35AdityaResult.pdf', '2022-09-06 10:42:43', '2022-09-06 10:42:43'),
(35, 10, 'Higher School(10th)', 'JAC', '60', '41AdityaResult.pdf', '2022-09-07 00:24:41', '2022-09-07 00:24:41');

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
(4, '2020_07_12_000000_create_otps_table', 1),
(5, '2022_08_02_041505_create_companies_table', 1),
(6, '2022_08_02_041600_create_products_table', 1),
(7, '2022_08_02_041752_create_categories_table', 1),
(8, '2022_08_02_052409_add_parent_id_to_categories_table', 1),
(9, '2022_08_02_110431_add_cat_id_to_products_table', 1),
(10, '2022_08_02_110637_add_subcat_id_to_products_table', 1),
(11, '2022_08_02_111230_add_is_featured_to_products_table', 1),
(12, '2022_08_02_111259_add_stock_to_products_table', 1),
(13, '2022_08_05_050203_add_slug_to_products_table', 1),
(14, '2022_08_05_063909_rename_categories_table', 1),
(15, '2022_08_05_120814_add_course_image_to_courses', 1),
(16, '2022_08_08_100749_create_roles_table', 1),
(17, '2022_08_08_110514_add_user_role_to_users_table', 1),
(18, '2022_08_17_134445_add_otp_to_users', 1),
(19, '2022_08_17_171239_add_phone_to_users', 1),
(20, '2022_08_18_102206_add_is_email_verified_to_users', 1),
(21, '2022_08_22_102625_create_education_table', 2),
(22, '2022_08_25_082348_create_categories_table', 3),
(23, '2022_08_25_091000_create_courses_table', 4),
(24, '2022_08_25_101018_create_courses_table', 5),
(25, '2022_08_26_073048_add_status_to_education_table', 6),
(26, '2022_08_26_115547_create_documents_table', 7),
(27, '2022_08_26_120720_drop_status_column_from_education_table', 8),
(28, '2022_08_26_132806_create_courseselections_table', 9),
(29, '2022_08_26_140102_drop_document_id_column_from_courseselections_table', 10),
(30, '2022_08_26_152820_create_courseselections_table', 11),
(31, '2022_08_26_173829_add_status_to_courseselections_table', 12),
(32, '2022_08_26_184421_add_status_to_courseselections_table', 13),
(33, '2022_08_26_185347_drop_status_column_from_courseselections_table', 14),
(34, '2022_09_01_143454_create_studentcourses_table', 15),
(35, '2022_09_02_054014_create_studentcourses_table', 16),
(36, '2022_09_02_081207_create_studentcourseoffers_table', 17),
(37, '2022_09_05_105549_add_status_to_studentcourseoffers_table', 18),
(38, '2022_09_05_120040_add_status_to_studentcourses_table', 19),
(39, '2022_09_05_131658_add_status_to_courseselections_table', 20),
(40, '2022_09_05_135417_drop_status_from_courseselections_table', 21),
(41, '2022_09_05_140052_add_status_to_users_table', 22);

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_req_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `retry` tinyint(4) NOT NULL,
  `status` enum('new','used','expired') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_information` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regular_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cat_id` int(11) NOT NULL,
  `subcat_id` int(11) NOT NULL,
  `is_featured` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Enrolment officer', '2022-08-24 14:09:48', '2022-08-25 00:41:21'),
(2, 'Student', '2022-08-25 00:41:49', '2022-08-25 00:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `studentcourseoffers`
--

CREATE TABLE `studentcourseoffers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stu_id` int(11) NOT NULL,
  `offer_course_id` int(11) NOT NULL,
  `course_offer_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentcourseoffers`
--

INSERT INTO `studentcourseoffers` (`id`, `stu_id`, `offer_course_id`, `course_offer_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 'hhio', 1, '2022-09-05 01:15:23', '2022-09-05 06:17:23'),
(2, 3, 2, 'f', NULL, '2022-09-05 01:16:11', '2022-09-05 01:16:11'),
(3, 3, 2, 'gh', NULL, '2022-09-05 01:30:01', '2022-09-05 01:30:01'),
(4, 3, 2, 'f', NULL, '2022-09-05 01:32:14', '2022-09-05 01:32:14'),
(5, 3, 2, 'hh', NULL, '2022-09-05 02:05:19', '2022-09-05 02:05:19'),
(6, 3, 2, 'hh', NULL, '2022-09-05 02:08:27', '2022-09-05 02:08:27'),
(7, 3, 2, 'gg', NULL, '2022-09-05 02:13:46', '2022-09-05 02:13:46'),
(8, 3, 2, 'g', NULL, '2022-09-05 02:16:33', '2022-09-05 02:16:33'),
(9, 3, 2, 'g', NULL, '2022-09-05 02:18:57', '2022-09-05 02:18:57'),
(10, 3, 2, 'g', NULL, '2022-09-05 02:24:58', '2022-09-05 02:24:58'),
(15, 6, 1, 'duration:-5months\r\nprice:600usd', 1, '2022-09-05 23:49:46', '2022-09-06 00:24:52'),
(16, 3, 2, 'asdfaasf', NULL, '2022-09-07 04:02:59', '2022-09-07 04:02:59'),
(17, 3, 2, 'asdfaasf', NULL, '2022-09-07 04:10:53', '2022-09-07 04:10:53'),
(18, 3, 2, 'asdfaasf', NULL, '2022-09-07 04:14:03', '2022-09-07 04:14:03'),
(19, 3, 2, 'Hello text format', NULL, '2022-09-07 04:15:10', '2022-09-07 04:15:10'),
(20, 3, 2, 'sdgasasgasg', NULL, '2022-09-07 04:21:29', '2022-09-07 04:21:29'),
(21, 10, 1, 'Text email to test.', NULL, '2022-09-07 04:55:04', '2022-09-07 04:55:04'),
(22, 9, 2, 'Testing purpose', NULL, '2022-09-07 07:16:32', '2022-09-07 07:16:32');

-- --------------------------------------------------------

--
-- Table structure for table `studentcourses`
--

CREATE TABLE `studentcourses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stu_id` int(11) NOT NULL,
  `student_course_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentcourses`
--

INSERT INTO `studentcourses` (`id`, `stu_id`, `student_course_id`, `status`, `created_at`, `updated_at`) VALUES
(10, 3, 2, 1, '2022-09-05 06:54:27', '2022-09-05 06:54:27'),
(11, 6, 1, 1, '2022-09-05 13:42:17', '2022-09-05 13:42:17'),
(12, 9, 2, 1, NULL, NULL),
(13, 10, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_email_verified` int(11) DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_role`, `email`, `email_verified_at`, `is_email_verified`, `password`, `remember_token`, `created_at`, `updated_at`, `otp`, `phone`, `status`) VALUES
(2, 'him', '1', 'himanshukumar89@virtualemployee.com', '2022-09-05 17:49:26', 1, '$2y$10$mGLQunqbTlrNfyAIyF9BIepTBybiyoEskBNwRBDrCCA3uq9TUQCQW', NULL, '2022-08-18 11:00:08', '2022-08-18 11:00:27', 3753, '9304781861', NULL),
(3, 'IBS', '2', 'himanshukumar789@virtualemployee.com', '2022-09-07 09:32:59', 1, '$2y$10$90Wx3OSE4egHX7fqeRABq.bfvsOn3Y2xggVX2Ul0JY4IDYq7PPyeC', NULL, '2022-08-25 00:48:47', '2022-09-07 04:02:59', 2529, '9304781863', 6),
(9, 'Chandra Narayan Sharma', '2', 'cnsharma@virtualemployee.com', '2022-09-07 05:55:29', 1, '$2y$10$XtklaG8XXKBv7LDamE7CfOfp.iTFaAB9ioGvLWOxRq/zYhNiHPa4W', NULL, '2022-09-06 08:38:41', '2022-09-07 00:25:29', 4504, '9460614212', 3),
(10, 'Vedmani Modugal', '2', 'vedmanimoudgal@virtualemployee.com', '2022-09-07 09:41:40', 1, '$2y$10$/TJqfTMsTqobYU9RfHfd6OHDMPnRdTZxDO0LE0Qd/nNnykykdhXh2', NULL, '2022-09-07 00:22:23', '2022-09-07 00:25:44', 9082, '9304101572', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_slug_unique` (`slug`);

--
-- Indexes for table `courseselections`
--
ALTER TABLE `courseselections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
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
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `otps_client_req_id_uuid_status_type_index` (`client_req_id`,`uuid`,`status`,`type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentcourseoffers`
--
ALTER TABLE `studentcourseoffers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentcourses`
--
ALTER TABLE `studentcourses`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courseselections`
--
ALTER TABLE `courseselections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `studentcourseoffers`
--
ALTER TABLE `studentcourseoffers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `studentcourses`
--
ALTER TABLE `studentcourses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
