-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2022 at 03:47 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravelc`
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
(2, 'e', '<p>vfgd</p>', '202208080643Bachelor-of-Information-Technology-with-a-major-in-User-Experience-500x500.jpg', '2022-08-08 01:13:09', '2022-08-08 01:13:09', 'f', NULL),
(3, 'Test123gter', '<p>sdfdfdfdgfd</p>', '202208080646information-technology.jpg', '2022-08-08 01:16:40', '2022-08-08 01:18:17', 'reeteressdfsa', 2);

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
  `cat_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subcat_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `slug`, `cat_id`, `subcat_id`, `course_image`, `course_duration`, `course_id`, `short_description`, `description`, `created_at`, `updated_at`) VALUES
(1, 'INFORMATION TECHNOLOGY', 'information-technology', '', '', '202208051227information-technology.jpg', '', '0', NULL, NULL, '2022-08-05 06:57:00', '2022-08-05 06:57:00'),
(3, 'WEB DEVELOPMENT USING CMS', 'web-development-with-wordpress', '', '', '202208051313web-development-wordpress-500x500.jpg', '60 hrs or 6 weeks (full time)​', 'WordPress', '<h2>WEB DEVELOPMENT USING CMS (WORDPRESS)</h2>\r\n\r\n<p>This WordPress course is specially designed for those who wish to know WordPress in and out in order to design and deploy WordPress websites professionally.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '<h2>Web Development using CMS (WordPress)</h2>\r\n\r\n<p>This WordPress course will traverse students through the interiors of a WordPress website. This training is especially designed for those who wish to know WordPress in and out so that they can design and deploy WordPress websites professionally.</p>\r\n\r\n<p>This course concentrates on how to build your website using WordPress without any programming or design experience.</p>\r\n\r\n<p>On completion of this WordPress course you will be able to:</p>\r\n\r\n<ul>\r\n	<li>Download and install WordPress</li>\r\n	<li>Configure existing templates and install new ones</li>\r\n	<li>Build a website, blog or online shop</li>\r\n	<li>Use plug-ins and widgets</li>\r\n	<li>Manage users and groups</li>\r\n	<li>Administer WordPress</li>\r\n</ul>\r\n\r\n<h3>Course outline</h3>\r\n\r\n<ol>\r\n	<li>Introduction to WordPressWordPress Installation and setup</li>\r\n	<li>Creating Content with WordPress</li>\r\n	<li>How to Publish Images and Videos</li>\r\n	<li>Organising the Content on Your Blog</li>\r\n	<li>Changing the Appearance of Your Site</li>\r\n	<li>How to add functionality to your site with WordPress plugins</li>\r\n	<li>Users and User Profiles</li>\r\n	<li>Configuring Settings</li>\r\n	<li>Getting, and Interacting with, Readers</li>\r\n	<li>WordPress: Behind the Curtain</li>\r\n	<li>Maintenance and Security</li>\r\n	<li>Diving Further into the World of WordPress</li>\r\n</ol>\r\n\r\n<p><strong>Course Duration:</strong>&nbsp;60 hrs or 6 weeks (full time)​<br />\r\nMinimum of four (4) hrs per day​<br />\r\n<strong>Entry Requirements:</strong>&nbsp;Studied through IBS or part of a corporate training program.​​​​​</p>', '2022-08-05 07:43:04', '2022-08-05 07:43:04'),
(4, 'wefew', 'erew', '2', NULL, '202208080742information-technology.jpg', '333`', 'erff', '<p>csdcfwfw</p>', '<p>dwff</p>', '2022-08-08 02:01:30', '2022-08-08 02:24:10');

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
(4, '2022_08_02_041505_create_companies_table', 1),
(5, '2022_08_02_041600_create_products_table', 1),
(6, '2022_08_02_041752_create_categories_table', 1),
(7, '2022_08_05_121905_create_courses_table', 2),
(8, '2022_08_08_055704_add_cat_image_to_categories_table', 3),
(9, '2022_08_08_072120_add_cat_id_to_courses_table', 4),
(10, '2022_08_08_072141_add_subcat_id_to_courses_table', 5),
(11, '2022_08_08_100749_create_roles_table', 6),
(12, '2022_08_08_110514_add_user_role_to_users_table', 7);

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
(2, 'Teacher', '2022-08-08 05:15:21', '2022-08-08 05:15:21'),
(3, 'Student', '2022-08-08 05:41:40', '2022-08-08 05:41:40'),
(4, 'Admin', '2022-08-08 05:42:12', '2022-08-08 05:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `users` (`id`, `uid`, `user_role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test', '', 'test@gmail.com', NULL, '$2y$10$jTEiY1RSQb4tmbf2tv0Ine44j7edxFq1E2ihntdZaDBXVgSTewgb2', NULL, '2022-08-07 22:00:36', '2022-08-07 22:00:36'),
(2, 'weww', '3', 'test@test.in', NULL, '$2y$10$QUWu46/fTflD3knGdeT6tuLwFaz6fVzNr3ujgwHlrlQSbFY23/kEy', NULL, '2022-08-08 06:00:49', '2022-08-08 06:00:49'),
(3, 'jjj', '3', 'tt678@hh.in', NULL, '$2y$10$JPuyKgUz5BXOGNMYcENKbeMwddVSmeeYqonGTzGLfESyNUJQOFxuC', NULL, '2022-08-09 22:23:46', '2022-08-09 22:23:46'),
(4, 'Test345', '3', 'try@gmail.com', NULL, '$2y$10$ojhFgbbAHMedltiY2rQciu00dHSSKlLgNrBHjFUnMH2SEw.r.A336', NULL, '2022-08-10 00:33:26', '2022-08-10 00:33:26'),
(5, 'tet3467', '3', 'test567@gmail.com', NULL, '$2y$10$ivCLqBAx3eTX2WA58v4FZOazkhiop39rTVNBBLcjcx1/0w2gFzW4.', NULL, '2022-08-10 00:40:53', '2022-08-10 00:40:53'),
(6, 'tet34679', '3', 'test5679@gmail.com', NULL, '$2y$10$/ZVR.4QDYct.hdkuy/n/TeYemvMZ6AbERmQmyagp5WLB6ZjexvpFe', NULL, '2022-08-10 00:43:42', '2022-08-10 00:43:42');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
