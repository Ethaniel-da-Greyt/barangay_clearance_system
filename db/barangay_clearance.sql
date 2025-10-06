-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2025 at 01:42 PM
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
-- Database: `barangay_clearance`
--
CREATE DATABASE IF NOT EXISTS `barangay_clearance` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `barangay_clearance`;

-- --------------------------------------------------------

--
-- Table structure for table `census`
--

CREATE TABLE `census` (
  `id` int(10) UNSIGNED NOT NULL,
  `resident_id` text NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middle_initial` varchar(50) DEFAULT NULL,
  `suffix` varchar(50) DEFAULT NULL,
  `sex` enum('M','F') NOT NULL,
  `purok` text DEFAULT NULL,
  `census_year` year(4) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) UNSIGNED NOT NULL,
  `document_id` text NOT NULL,
  `document_name` varchar(100) NOT NULL,
  `requirements` text DEFAULT NULL,
  `fee` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `document_id`, `document_name`, `requirements`, `fee`, `created_at`, `updated_at`, `is_deleted`) VALUES
(12, 'DOC-68c0163fd138c', 'Community Tax Certificate (CTC)', '- Valid ID\n- Latest copy of CTC', NULL, '2025-09-09 11:57:51', '2025-09-09 11:57:51', 0),
(18, 'DOC-68c6ba9bbfd41', 'Barangay Certification (Old Resident)', '- Valid ID\n- School ID\n- Company/Office ID\n- Voter\'s ID\n- CTC', 100, '2025-09-14 12:52:43', '2025-09-14 12:52:43', 0),
(19, 'DOC-68c6ba9bbfd4a', 'Barangay Certification (New Resident)', '- Valid ID\n- CTC\n- Endorsement from Purok Barangay Officials', 100, '2025-09-14 12:52:43', '2025-09-14 12:52:43', 0),
(20, 'DOC-68c6ba9bbfd4b', 'Barangay Clearance', '- Valid ID\n- CTC', 100, '2025-09-14 12:52:43', '2025-09-14 12:52:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fire_cases`
--

CREATE TABLE `fire_cases` (
  `id` int(11) UNSIGNED NOT NULL,
  `case_id` text NOT NULL,
  `date_occurrence` datetime NOT NULL,
  `date_report` datetime NOT NULL,
  `exact_location` text NOT NULL,
  `cause_of_fire` text DEFAULT NULL,
  `affected_households` int(11) NOT NULL DEFAULT 0,
  `type_of_occupancy` varchar(100) DEFAULT NULL,
  `casualties` int(11) NOT NULL DEFAULT 0,
  `affected_individuals` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) UNSIGNED NOT NULL,
  `request_id` text NOT NULL,
  `request_type` varchar(100) NOT NULL,
  `requestor_id` varchar(100) DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `middle_initial` varchar(50) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `suffix` varchar(50) DEFAULT NULL,
  `sex` enum('M','F') NOT NULL,
  `purok` text DEFAULT NULL,
  `contact_no` text NOT NULL,
  `photo` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `claimed_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('approved','pending','rejected','claimed') DEFAULT 'pending',
  `rejection_remarks` text NULL,
  `is_canceled` tinyint(1) DEFAULT 0,
  `notified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middle_initial` text DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `sex` enum('M','F') NOT NULL,
  `purok` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','resident') NOT NULL DEFAULT 'resident',
  `photo` text DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `census`
--
ALTER TABLE `census`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_id` (`document_id`(768)),
  ADD KEY `document_name` (`document_name`);

--
-- Indexes for table `fire_cases`
--
ALTER TABLE `fire_cases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `case_id` (`case_id`) USING HASH;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `request_id` (`request_id`) USING HASH,
  ADD KEY `request_type` (`request_type`),
  ADD KEY `requestor_id` (`requestor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `census`
--
ALTER TABLE `census`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `fire_cases`
--
ALTER TABLE `fire_cases`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
