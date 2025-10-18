-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2025 at 03:24 PM
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

--
-- Dumping data for table `census`
--

INSERT INTO `census` (`id`, `resident_id`, `firstname`, `lastname`, `middle_initial`, `suffix`, `sex`, `purok`, `census_year`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '202509-0001', 'Kailey', 'Kohler', 'X', 'Sr.', 'M', 'Purok 4', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(2, '202509-0002', 'Moses', 'Cronin', 'E', 'Jr.', 'M', 'Purok 1', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(3, '202509-0003', 'Keagan', 'Heaney', 'Y', NULL, 'M', 'Purok 6', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(4, '202509-0004', 'Hilario', 'Wehner', 'Y', 'III', 'M', 'Purok 9', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(5, '202509-0005', 'Abdul', 'Friesen', 'H', NULL, 'M', 'Purok 8', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(6, '202509-0006', 'Julianne', 'Kirlin', 'G', NULL, 'M', 'Purok 2', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(7, '202509-0007', 'Dulce', 'Padberg', 'B', NULL, 'F', 'Purok 1', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(8, '202509-0008', 'Waino', 'Metz', 'A', NULL, 'F', 'Purok 5', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(9, '202509-0009', 'Blaze', 'Kunze', 'L', NULL, 'M', 'Purok 9', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(10, '202509-0010', 'Jacquelyn', 'Haley', 'Q', 'III', 'F', 'Purok 2', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(11, '202509-0011', 'Arnold', 'Schumm', 'Y', NULL, 'F', 'Purok 5', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(12, '202509-0012', 'Ally', 'Rau', 'E', NULL, 'M', 'Purok 1', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(13, '202509-0013', 'Magnolia', 'Reichel', 'Z', 'III', 'F', 'Purok 4', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(14, '202509-0014', 'Leanne', 'Morar', 'J', 'Sr.', 'F', 'Purok 2', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(15, '202509-0015', 'Trent', 'White', 'K', 'III', 'M', 'Purok 10', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(16, '202509-0016', 'Camilla', 'Harber', 'K', 'III', 'F', 'Purok 3', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(17, '202509-0017', 'Ana', 'O\'Reilly', 'G', 'III', 'F', 'Purok 9', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(18, '202509-0018', 'Brisa', 'Koch', 'N', NULL, 'F', 'Purok 8', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(19, '202509-0019', 'Jeffry', 'Hoppe', 'E', 'Jr.', 'F', 'Purok 4', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(20, '202509-0020', 'Brielle', 'Heaney', 'K', 'Sr.', 'M', 'Purok 1', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(21, '202509-0021', 'Alena', 'Rodriguez', 'F', 'III', 'F', 'Purok 3', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(22, '202509-0022', 'Nicola', 'Walter', 'Y', 'Jr.', 'F', 'Purok 5', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(23, '202509-0023', 'Quinton', 'Yost', 'S', 'Jr.', 'M', 'Purok 2', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(24, '202509-0024', 'Duane', 'Turner', 'Z', 'Sr.', 'F', 'Purok 8', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(25, '202509-0025', 'Berenice', 'Willms', 'E', 'Jr.', 'F', 'Purok 8', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(26, '202509-0026', 'Barrett', 'Leannon', 'H', 'Jr.', 'M', 'Purok 10', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(27, '202509-0027', 'Garrison', 'Wunsch', 'L', 'Jr.', 'M', 'Purok 5', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(28, '202509-0028', 'Anissa', 'Gleason', 'H', 'Jr.', 'M', 'Purok 10', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(29, '202509-0029', 'Octavia', 'Barton', 'S', 'Sr.', 'F', 'Purok 7', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(30, '202509-0030', 'Shemar', 'Kutch', 'D', 'III', 'F', 'Purok 2', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(31, '202509-0031', 'Lilian', 'Hand', 'A', 'Sr.', 'M', 'Purok 10', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(32, '202509-0032', 'Jude', 'Stehr', 'Z', NULL, 'F', 'Purok 4', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(33, '202509-0033', 'Mack', 'Schuppe', 'X', 'Jr.', 'F', 'Purok 8', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(34, '202509-0034', 'Makayla', 'Kling', 'Z', 'Sr.', 'F', 'Purok 1', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(35, '202509-0035', 'Christa', 'Gulgowski', 'M', 'III', 'M', 'Purok 2', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(36, '202509-0036', 'Madisyn', 'Moore', 'L', 'III', 'M', 'Purok 8', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(37, '202509-0037', 'Amaya', 'Macejkovic', 'H', 'Jr.', 'F', 'Purok 7', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(38, '202509-0038', 'Darlene', 'Fritsch', 'W', 'Sr.', 'F', 'Purok 6', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(39, '202509-0039', 'Afton', 'Carter', 'J', 'Jr.', 'M', 'Purok 5', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(40, '202509-0040', 'Alayna', 'Adams', 'Q', NULL, 'F', 'Purok 6', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(41, '202509-0041', 'Santa', 'Collier', 'H', 'III', 'F', 'Purok 5', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(42, '202509-0042', 'Arjun', 'Pacocha', 'R', 'Sr.', 'F', 'Purok 3', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(43, '202509-0043', 'Rebekah', 'Hodkiewicz', 'A', 'Sr.', 'F', 'Purok 6', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(44, '202509-0044', 'Lynn', 'Cormier', 'P', 'III', 'F', 'Purok 5', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(45, '202509-0045', 'Cary', 'Stanton', 'J', 'Sr.', 'F', 'Purok 9', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(46, '202509-0046', 'Ambrose', 'Homenick', 'K', NULL, 'M', 'Purok 3', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(47, '202509-0047', 'Antonina', 'Smith', 'W', 'III', 'F', 'Purok 5', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(48, '202509-0048', 'Callie', 'Heathcote', 'Y', 'III', 'M', 'Purok 4', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(49, '202509-0049', 'Jalyn', 'Kessler', 'O', NULL, 'F', 'Purok 3', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(50, '202509-0050', 'Lessie', 'Ledner', 'V', 'Sr.', 'F', 'Purok 5', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(51, '202509-0051', 'Maymie', 'Hartmann', 'R', 'III', 'F', 'Purok 7', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(52, '202509-0052', 'Marguerite', 'Von', 'P', 'III', 'F', 'Purok 8', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(53, '202509-0053', 'Isaac', 'Rice', 'Y', NULL, 'M', 'Purok 6', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(54, '202509-0054', 'Reva', 'Schiller', 'I', 'Sr.', 'M', 'Purok 7', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(55, '202509-0055', 'Flossie', 'Lowe', 'S', 'Jr.', 'M', 'Purok 5', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(56, '202509-0056', 'Madisen', 'Pfeffer', 'U', 'Jr.', 'F', 'Purok 5', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(57, '202509-0057', 'Esmeralda', 'Rice', 'K', 'Jr.', 'M', 'Purok 3', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(58, '202509-0058', 'Fatima', 'Prosacco', 'W', 'Sr.', 'F', 'Purok 8', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(59, '202509-0059', 'Elise', 'Kautzer', 'S', 'III', 'M', 'Purok 6', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(60, '202509-0060', 'Jewell', 'Schuster', 'P', 'Jr.', 'M', 'Purok 2', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(61, '202509-0061', 'Kitty', 'Predovic', 'T', 'III', 'F', 'Purok 2', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(62, '202509-0062', 'Constance', 'Bergnaum', 'M', 'III', 'F', 'Purok 5', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(63, '202509-0063', 'Geovanni', 'Harvey', 'G', 'Sr.', 'M', 'Purok 7', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(64, '202509-0064', 'Guy', 'Blanda', 'F', NULL, 'M', 'Purok 9', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(65, '202509-0065', 'Sheridan', 'Fahey', 'V', NULL, 'M', 'Purok 3', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(66, '202509-0066', 'Carol', 'Reynolds', 'O', 'Sr.', 'F', 'Purok 7', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(67, '202509-0067', 'Sammie', 'Hills', 'O', 'III', 'M', 'Purok 6', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(68, '202509-0068', 'Kurtis', 'Collier', 'E', NULL, 'F', 'Purok 4', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(69, '202509-0069', 'Pat', 'Hane', 'A', 'Sr.', 'M', 'Purok 4', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(70, '202509-0070', 'Linda', 'Steuber', 'E', 'Sr.', 'M', 'Purok 5', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(71, '202509-0071', 'Dasia', 'Reichert', 'A', 'III', 'M', 'Purok 3', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(72, '202509-0072', 'Kendra', 'Jacobs', 'Z', 'Jr.', 'M', 'Purok 6', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(73, '202509-0073', 'Wendy', 'Davis', 'X', 'Jr.', 'M', 'Purok 6', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(74, '202509-0074', 'Helga', 'Graham', 'W', 'Jr.', 'M', 'Purok 8', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(75, '202509-0075', 'Wilmer', 'Oberbrunner', 'O', 'Jr.', 'F', 'Purok 3', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(76, '202509-0076', 'Oral', 'Nikolaus', 'P', 'Jr.', 'M', 'Purok 4', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(77, '202509-0077', 'Brenna', 'D\'Amore', 'B', 'III', 'F', 'Purok 3', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(78, '202509-0078', 'Dorris', 'Ebert', 'B', 'Jr.', 'F', 'Purok 8', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(79, '202509-0079', 'Abelardo', 'Kreiger', 'H', 'III', 'M', 'Purok 10', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(80, '202509-0080', 'Claire', 'Grant', 'X', 'Jr.', 'M', 'Purok 7', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(81, '202509-0081', 'Francesca', 'Schiller', 'R', 'III', 'F', 'Purok 2', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(82, '202509-0082', 'Mathias', 'Kovacek', 'Q', 'III', 'F', 'Purok 3', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(83, '202509-0083', 'Roberta', 'Champlin', 'Y', 'III', 'F', 'Purok 8', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(84, '202509-0084', 'Lewis', 'Cummings', 'F', 'III', 'F', 'Purok 1', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(85, '202509-0085', 'Beth', 'Zemlak', 'A', 'Jr.', 'F', 'Purok 2', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(86, '202509-0086', 'Kellen', 'Zulauf', 'Y', NULL, 'M', 'Purok 9', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(87, '202509-0087', 'Alvis', 'Hirthe', 'Y', 'III', 'M', 'Purok 5', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(88, '202509-0088', 'Earlene', 'Harvey', 'M', 'III', 'F', 'Purok 2', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(89, '202509-0089', 'Adell', 'Hermann', 'C', NULL, 'M', 'Purok 5', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(90, '202509-0090', 'Amalia', 'Kuhic', 'X', 'III', 'F', 'Purok 6', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(91, '202509-0091', 'Josianne', 'Schneider', 'B', NULL, 'M', 'Purok 10', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(92, '202509-0092', 'Doris', 'Sanford', 'S', 'Jr.', 'F', 'Purok 10', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(93, '202509-0093', 'Evert', 'Reichel', 'I', 'Jr.', 'M', 'Purok 7', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(94, '202509-0094', 'Wilhelmine', 'Greenfelder', 'N', 'Jr.', 'M', 'Purok 6', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(95, '202509-0095', 'Oren', 'Jones', 'H', 'Sr.', 'M', 'Purok 4', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(96, '202509-0096', 'Abbey', 'Bednar', 'U', 'Jr.', 'F', 'Purok 2', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(97, '202509-0097', 'Agnes', 'Wolf', 'R', 'III', 'F', 'Purok 10', '2025', 1, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(98, '202509-0098', 'Cloyd', 'Willms', 'B', 'III', 'M', 'Purok 8', '2025', 1, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(99, '202509-0099', 'Napoleon', 'Schiller', 'J', 'III', 'F', 'Purok 6', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(100, '202509-0100', 'Santos', 'Swaniawski', 'E', 'Sr.', 'M', 'Purok 8', '2025', 0, '2025-09-08 11:41:45', '2025-09-08 11:41:45'),
(101, '202509-0101', 'Ethaniel', 'Gwapo', 'Acopio', 'III', 'M', 'Purok Gwapo', '2025', 0, NULL, NULL);

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
-- Table structure for table `esp_system`
--

CREATE TABLE `esp_system` (
  `id` int(11) NOT NULL,
  `esp_id` varchar(200) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `household` varchar(200) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `esp_system`
--

INSERT INTO `esp_system` (`id`, `esp_id`, `address`, `household`, `is_deleted`) VALUES
(6, '13186920', 'Purok Makulot', 'Johny Sins', 0);

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
  `affected_households` int(11) DEFAULT 0,
  `type_of_occupancy` varchar(100) DEFAULT NULL,
  `casualties` int(11) DEFAULT 0,
  `affected_individuals` int(11) DEFAULT 0,
  `household` varchar(250) NOT NULL,
  `status` enum('warning','emergency') NOT NULL DEFAULT 'warning',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `alarm` enum('true','false') DEFAULT NULL,
  `is_notified` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fire_cases`
--

INSERT INTO `fire_cases` (`id`, `case_id`, `date_occurrence`, `date_report`, `exact_location`, `cause_of_fire`, `affected_households`, `type_of_occupancy`, `casualties`, `affected_individuals`, `household`, `status`, `created_at`, `updated_at`, `is_deleted`, `alarm`, `is_notified`) VALUES
(42, 'FC-202510-001', '2025-10-18 14:54:15', '2025-10-18 14:54:15', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'warning', '2025-10-18 14:54:15', '2025-10-18 14:54:15', 1, NULL, 0),
(43, 'FC-202510-002', '2025-10-18 15:00:25', '2025-10-18 15:00:25', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'emergency', '2025-10-18 15:00:25', '2025-10-18 15:00:25', 1, NULL, 0),
(44, 'FC-202510-003', '2025-10-18 15:09:31', '2025-10-18 15:09:31', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'emergency', '2025-10-18 15:09:31', '2025-10-18 15:09:31', 1, NULL, 0),
(45, 'FC-202510-004', '2025-10-18 15:09:52', '2025-10-18 15:09:52', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'warning', '2025-10-18 15:09:52', '2025-10-18 15:09:52', 1, NULL, 0),
(46, 'FC-202510-005', '2025-10-18 15:10:59', '2025-10-18 15:10:59', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'warning', '2025-10-18 15:10:59', '2025-10-18 15:10:59', 1, NULL, 0),
(47, 'FC-202510-006', '2025-10-18 15:11:15', '2025-10-18 15:11:15', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'emergency', '2025-10-18 15:11:15', '2025-10-18 15:11:15', 1, NULL, 1),
(48, 'FC-202510-007', '2025-10-18 15:11:38', '2025-10-18 15:11:38', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'warning', '2025-10-18 15:11:38', '2025-10-18 15:11:38', 1, NULL, 1),
(49, 'FC-202510-008', '2025-10-18 15:13:24', '2025-10-18 15:13:24', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'warning', '2025-10-18 15:13:24', '2025-10-18 15:13:24', 1, NULL, 1),
(50, 'FC-202510-009', '2025-10-18 15:13:30', '2025-10-18 15:13:30', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'emergency', '2025-10-18 15:13:30', '2025-10-18 15:13:30', 1, NULL, 1),
(51, 'FC-202510-010', '2025-10-18 15:14:07', '2025-10-18 15:14:07', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'warning', '2025-10-18 15:14:07', '2025-10-18 15:14:07', 1, NULL, 1),
(52, 'FC-202510-011', '2025-10-18 15:14:13', '2025-10-18 15:14:13', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'emergency', '2025-10-18 15:14:13', '2025-10-18 15:14:13', 1, NULL, 1),
(53, 'FC-202510-012', '2025-10-18 15:16:25', '2025-10-18 15:16:25', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'warning', '2025-10-18 15:16:25', '2025-10-18 15:16:25', 1, NULL, 1),
(54, 'FC-202510-013', '2025-10-18 15:16:30', '2025-10-18 15:16:30', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'emergency', '2025-10-18 15:16:30', '2025-10-18 15:16:30', 1, NULL, 1),
(55, 'FC-202510-014', '2025-10-18 15:17:38', '2025-10-18 15:17:38', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'warning', '2025-10-18 15:17:38', '2025-10-18 15:17:38', 1, NULL, 1),
(56, 'FC-202510-015', '2025-10-18 15:17:43', '2025-10-18 15:17:43', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'emergency', '2025-10-18 15:17:43', '2025-10-18 15:17:43', 1, NULL, 1),
(57, 'FC-202510-016', '2025-10-18 15:20:00', '2025-10-18 15:20:00', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'emergency', '2025-10-18 15:20:00', '2025-10-18 15:20:00', 0, NULL, 1),
(58, 'FC-202510-017', '2025-10-18 15:20:22', '2025-10-18 15:20:22', 'Purok Makulot', NULL, NULL, NULL, NULL, NULL, 'Johny Sins', 'warning', '2025-10-18 15:20:22', '2025-10-18 15:20:22', 0, NULL, 1);

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

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-09-06-130112', 'App\\Database\\Migrations\\UserRegister', 'default', 'App', 1757163698, 1),
(2, '2025-09-08-011949', 'App\\Database\\Migrations\\Population', 'default', 'App', 1757331586, 2),
(3, '2025-09-08-031916', 'App\\Database\\Migrations\\FireCase', 'default', 'App', 1757331586, 2),
(4, '2025-09-08-043129', 'App\\Database\\Migrations\\Requests', 'default', 'App', 1757331587, 2),
(5, '2025-09-08-051618', 'App\\Database\\Migrations\\Document', 'default', 'App', 1757331587, 2),
(6, '2025-09-09-114917', 'App\\Database\\Migrations\\AddStatusColumn', 'default', 'App', 1757418856, 3),
(7, '2025-09-09-121722', 'App\\Database\\Migrations\\AddIsCenceledColumn', 'default', 'App', 1757421507, 4),
(8, '2025-09-09-123925', 'App\\Database\\Migrations\\AddEmailColumn', 'default', 'App', 1757422861, 5),
(9, '2025-09-09-130414', 'App\\Database\\Migrations\\AddColumn', 'default', 'App', 1757423070, 6),
(10, '2025-09-11-025115', 'App\\Database\\Migrations\\AddIsCanceledColumn', 'default', 'App', 1757596895, 7),
(11, '2025-09-11-131033', 'App\\Database\\Migrations\\AddRequestorIdColumn', 'default', 'App', 1757596895, 7),
(12, '2025-09-13-141442', 'App\\Database\\Migrations\\AddNotifiedColumn', 'default', 'App', 1757773003, 8);

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
  `claimed_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('approved','pending','rejected','claimed') DEFAULT 'pending',
  `rejection_remarks` text DEFAULT NULL,
  `is_canceled` tinyint(1) DEFAULT 0,
  `notified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `request_id`, `request_type`, `requestor_id`, `firstname`, `middle_initial`, `lastname`, `suffix`, `sex`, `purok`, `contact_no`, `photo`, `created_at`, `claimed_at`, `updated_at`, `is_deleted`, `status`, `rejection_remarks`, `is_canceled`, `notified`) VALUES
(16, 'REQ-68c58ce91611d', 'Barangay Clearance', '2509-0001', 'Nayeli', NULL, 'Metz', 'Jr.', 'F', 'Emma Forks', '606-306-1421', NULL, '2025-09-13 15:25:29', NULL, '2025-09-13 15:25:29', 0, 'claimed', NULL, 0, 1),
(17, 'REQ-68c58ce9194fc', 'Barangay Certification (Old Resident)', '2509-0001', 'Adolfo', 'B', 'Hills', NULL, 'F', 'Arne Cliffs', '(703) 382-1713', NULL, '2025-09-13 15:25:29', NULL, '2025-09-13 15:25:29', 0, 'claimed', NULL, 0, 1),
(18, 'REQ-68c58ce91c409', 'Barangay Certification (New Resident)', '2509-0001', 'Eldridge', NULL, 'Von', 'Jr.', 'M', 'Lessie Island', '+19408641681', NULL, '2025-09-13 15:25:29', NULL, '2025-09-13 15:25:29', 0, 'claimed', NULL, 0, 1),
(19, 'REQ-68c58ce91e3f4', 'Barangay Certification (New Resident)', '2509-0001', 'Cory', 'A', 'Aquino', '', 'F', 'Purok Dilawan', '093426464', 'uploads/avatar/2509-0001/requirements/REQ-68c58ce91e3f4/1757947742_1dc6aa19a97411dcb118.webp', '2025-09-13 15:25:29', NULL, '2025-09-13 15:25:29', 0, 'rejected', NULL, 0, 1),
(20, 'REQ-68c58ce9203d1', 'Barangay Clearance', '2509-0001', 'Elisabeth', 'C', 'Yost', 'Sr.', 'M', 'Abernathy Plaza', '(443) 543-8565', NULL, '2025-09-13 15:25:29', NULL, '2025-09-13 15:25:29', 0, 'claimed', NULL, 0, 1),
(21, 'REQ-68c591260be52', 'Community Tax Certificate (CTC)', '202509-0009', 'Winona', 'A', 'Kshlerin', 'Sr.', 'F', 'Domenick Isle', '09343436390', NULL, '2025-09-13 15:43:34', NULL, '2025-09-13 15:43:34', 0, 'rejected', NULL, 0, 0),
(22, 'REQ-68c591260defa', 'Community Tax Certificate (CTC)', '202509-0009', 'Jarred', 'A', 'Torp', 'Sr.', 'F', 'Summer Island', '09343431284', NULL, '2025-09-13 15:43:34', NULL, '2025-09-13 15:43:34', 0, 'claimed', NULL, 0, 0),
(23, 'REQ-68c591260f585', 'Barangay Certification (New Resident)', '2509-0001', 'Adan', 'B', 'Lehner', 'Sr.', 'M', 'Purok Macapuno', '09343439116', 'uploads/avatar/2509-0001/requirements/REQ-68c591260f585/1757947890_bd8f751b8ed3c5ad70d3.webp', '2025-09-13 15:43:34', NULL, '2025-09-13 15:43:34', 0, 'claimed', NULL, 0, 1),
(24, 'REQ-68c5912610c85', 'Barangay Certification (Old Resident)', '202509-0011', 'Willy', 'B', 'Schuppe', NULL, 'F', 'Ashleigh Place', '09343435389', NULL, '2025-09-13 15:43:34', NULL, '2025-09-13 15:43:34', 0, 'claimed', NULL, 0, 0),
(25, 'REQ-68c59126123a5', 'Community Tax Certificate (CTC)', '202509-0009', 'Darrell', 'C', 'Bogisich', NULL, 'F', 'Bonnie Stream', '09343432643', NULL, '2025-09-13 15:43:34', '2025-10-06 22:01:05', '2025-09-13 15:43:34', 0, 'claimed', NULL, 0, 0),
(32, 'REQ-68c6bbcad5e25', 'Community Tax Certificate (CTC)', NULL, 'Samuel John', '', 'Zosa', '', 'M', 'Purok Santol', '092445245345', 'uploads/avatar/2509-0001/requirements/REQ-68c6bbcad5e25/1757854666_f058d057f2c456e588ba.webp', '2025-09-14 20:57:46', NULL, NULL, 0, 'rejected', NULL, 0, 0),
(33, 'REQ-68c6bd480b1fe', 'Barangay Certification (New Resident)', NULL, 'Samuel John', '', 'Zosa', '', 'M', 'Purok Mahogani', '0987865676', 'uploads/avatar/2509-0001/requirements/REQ-68c6bd480b1fe/1757855048_a992359b48269edc0d88.webp', '2025-09-14 21:04:08', NULL, NULL, 0, 'rejected', NULL, 0, 0),
(34, 'REQ-68c6bde74dd86', 'Community Tax Certificate (CTC)', NULL, 'Samuel John', '', 'Zosa', '', 'M', 'Purok Makulot', '0934234255', 'uploads/avatar/2509-0001/requirements/REQ-68c6bde74dd86/1757855207_27637ca4c11cb04e2143.webp', '2025-09-14 21:06:47', NULL, NULL, 0, 'rejected', NULL, 0, 0),
(35, 'REQ-68c6c030e86f7', 'Community Tax Certificate (CTC)', NULL, 'Samuel John', '', 'Zosa', '', 'M', 'Purok Makulot', '09841423423', 'uploads/avatar/2509-0001/requirements/REQ-68c6c030e86f7/1757855793_f421811d4092d86342fc.webp', '2025-09-14 21:16:33', NULL, NULL, 0, 'claimed', NULL, 0, 0),
(36, 'REQ-68c6c1d9c67fa', 'Community Tax Certificate (CTC)', NULL, 'Samuel John', '', 'Zosa', '', 'M', 'Purok Macapuno', '0932423423', 'uploads/avatar/2509-0001/requirements/REQ-68c6c1d9c67fa/1757856217_d0edd46c3338de6f345a.webp', '2025-09-14 21:23:37', NULL, NULL, 0, 'claimed', NULL, 0, 0),
(37, 'REQ-68c6c2861d05f', 'Community Tax Certificate (CTC)', '2509-0001', 'Samuel John', '', 'Zosa', '', 'M', 'Purok Macapuno', '0934234255', 'uploads/avatar/2509-0001/requirements/REQ-68c6c2861d05f/1757856390_09e7e7356789c7b3e56c.webp', '2025-09-14 21:26:30', NULL, NULL, 0, 'claimed', NULL, 0, 1),
(38, 'REQ-68ce44bc68ae1', 'Barangay Certification (Old Resident)', '2509-0001', 'Johny', '', 'Soliva', '', 'M', 'Purok Manumbag', '092445245345', 'uploads/avatar/2509-0001/requirements/REQ-68ce44bc68ae1/1758348476_68a6854926ba46558057.jpg', '2025-09-20 14:07:56', NULL, NULL, 0, 'claimed', NULL, 0, 1),
(39, 'REQ-68ce461928d53', 'Community Tax Certificate (CTC)', '2509-0001', 'Samuel John', '', 'Zosa', '', 'M', 'Purok Mahogani', '09343439116', 'uploads/avatar/2509-0001/requirements/REQ-68ce461928d53/1758348825_bfdfc9844fae61aee9b9.webp', '2025-09-20 14:13:45', NULL, NULL, 0, 'claimed', NULL, 0, 1),
(40, 'REQ-68e3b912a95ae', 'Barangay Certification (Old Resident)', '202509-0001', 'Johnny', 'Dante', 'Bravo', '', 'M', 'Purok Manumbag', '09435453466', 'uploads/avatar/202509-0001/requirements/REQ-68e3b912a95ae/1759754542_3de065897d0115a746ac.webp', '2025-10-06 20:41:54', NULL, NULL, 0, 'claimed', NULL, 0, 0),
(41, 'REQ-68e3c362ba999', 'Community Tax Certificate (CTC)', '2509-0001', 'Samuel John', 'A', 'Zosa', '', 'M', 'Purok Macapuno', '09841423423', 'uploads/avatar/2509-0001/requirements/REQ-68e3c362ba999/1759757155_12ab8136f6622592b1f1.webp', '2025-10-06 21:25:55', NULL, NULL, 0, 'claimed', NULL, 0, 1),
(42, 'REQ-68e3c428e0cf2', 'Community Tax Certificate (CTC)', '2509-0001', 'Samuel John', 'Dante', 'Zosa', '', 'M', 'Purok Macapuno', '09841423423', 'uploads/avatar/2509-0001/requirements/REQ-68e3c428e0cf2/1759757352_befa8d216bdd5463ec2e.webp', '2025-10-06 21:29:12', NULL, NULL, 0, 'claimed', NULL, 0, 1),
(43, 'REQ-68e3c5d290817', 'Community Tax Certificate (CTC)', '2509-0001', 'Samuel John', '', 'Zosa', '', 'M', 'Purok Mamaak', '0943543534', 'uploads/avatar/2509-0001/requirements/REQ-68e3c5d290817/1759757778_bb9b59f4467f8b4fe2f3.webp', '2025-10-06 21:36:18', NULL, NULL, 0, 'claimed', NULL, 0, 1),
(44, 'REQ-68e3d2cded2fb', 'Community Tax Certificate (CTC)', '202509-0001', 'Johny', '', 'Bravo', '', 'M', 'Purok Makulot', '0942353453', 'uploads/No_image.png', '2025-10-06 22:31:42', '2025-10-14 21:28:03', NULL, 0, 'claimed', NULL, 0, 1),
(45, 'REQ-68e3d2fd66144', 'Community Tax Certificate (CTC)', '202509-0001', 'Johnny', '', 'Bravo', '', 'M', 'Purok Malungkot', '093425325', 'uploads/No_image.png', '2025-10-06 22:32:29', NULL, NULL, 0, 'rejected', NULL, 0, 1),
(46, 'REQ-68e3d3bf9d634', 'Community Tax Certificate (CTC)', '202509-0011', 'Guile Oswald', '', 'Amedo', '', 'M', 'Purok Malandi', '092342342', 'uploads/No_image.png', '2025-10-06 22:35:43', NULL, NULL, 0, 'rejected', 'Failed to meet the requirements.', 0, 1),
(47, 'REQ-68e3d4339c2a1', 'Community Tax Certificate (CTC)', '202509-0011', 'Guile Oswald', '', 'Amedo', '', 'M', 'Purok Marupok', '09123241', 'uploads/No_image.png', '2025-10-06 22:37:39', NULL, NULL, 0, 'rejected', 'ID not valid', 0, 1);

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `firstname`, `middle_initial`, `lastname`, `sex`, `purok`, `username`, `password`, `role`, `photo`, `is_deleted`, `created_at`, `updated_at`) VALUES
(3, '2509-0001', 'Samuel John', 'A', 'Zosa', 'M', 'Purok Sampaguita', 'sam', '$2y$10$cK0b5g4tI/Ddt168IYEX6eIWwaQM5rx3bsfXifAruspvV8VZO29rG', 'resident', 'uploads/avatar/2509-0001/1758029680_65eadde254be770020b9.gif', 0, NULL, NULL),
(4, '202509-0001', 'John', '', 'Medina', 'M', 'Purok Santol', 'john', '$2y$10$Bjc4FpAJd7boeduPtzfvNuS3pE5H8shenzASe.5XM35bmEgPrODki', 'resident', 'uploads/avatar/202509-0001/1758031383_de55d197b438394e2fee.gif', 0, NULL, NULL),
(5, '202509-0002', 'Eilegna', 'Baguio', 'Ventula', 'F', 'Purok Macapuno', 'ventula', '$2y$10$jgSN4TMhcI5D3Bi1cAXVLedqDKRMyP6W22OUD3uSKbsTkq3ZVwjeO', 'resident', '1757286390_f58125ef955a73388fa4.jpg', 0, NULL, NULL),
(6, '202509-0003', 'Johnny', 'Dante', 'Bravo', 'M', 'Purok Makulot', 'kulot', '$2y$10$.ADAptuj0PdIdq3DBjMe.uVzMPhV97YKxBC7s2TGzF2o0n482Nki6', 'admin', '1757286305_e86b1fa4e0ce787627b8.gif', 0, NULL, NULL),
(7, '202509-0004', 'Reimond Brix', 'D', 'Pesales', 'M', 'Purok Marupok', 'brix', '$2y$10$I7EvFA5vraYw2rRRTrmjtOdzQ944SLPPK5GZYAL0jUxYON3EjCsxq', 'admin', '1757236088_139108ca99e5a32bdeb7.gif', 1, NULL, NULL),
(8, '202509-0005', 'Ethaniel', 'A', 'Obordo', 'M', 'Purok Sampaguita', 'ethaniel', '$2y$10$XBVrY5zyrOCbPAKK4PYToexVf070BZpJxgaKOkLkQF9tnTDkF2egW', 'admin', '1757236334_fdf5958602de52d5cb84.gif', 0, NULL, NULL),
(9, '202509-0006', 'Ryan Vincent', 'Dante', 'Nazareno', 'M', 'Purok Mahogani', 'ryan', '$2y$10$LRyj8kuiQU2xoF.NXIGMP.QMrSYwUJU2pQA4vnp6F1bMrdMWVD3ZW', 'admin', '1757238809_d55a63a7fcff547be3e4.gif', 0, NULL, NULL),
(10, '202509-0007', 'Loveley', '', 'Caplano', 'F', 'Purok Manumbag', 'loveley', '$2y$10$.5eHYNCW30Zzz/n.FN7/vecklNRPS2yG/PEQ4.UAfLLFwXSL.FaSi', 'admin', 'no_photo.jpg', 0, NULL, NULL),
(11, '202509-0008', 'Bradley Ezekiel', 'Acopiado', 'Rosal', 'M', 'Purok Halang', 'brad', '$2y$10$lEdv8dLwULppYPhAZIYGpuFfOKKjUdRjs5czVhPkvqybolpk786ty', 'resident', 'no_photo.jpg', 0, NULL, NULL),
(12, '202509-0009', 'Vince Lloyd', '', 'Rosal', 'M', 'Purok Hangin', 'rosal', '$2y$10$zIv6F.jZyeMX27tgWL4Z5OMjmjURq6KRfQJk/Z1M0eQAEiiN56/Fi', 'resident', 'no_photo.jpg', 0, NULL, NULL),
(13, '202509-0010', 'Jehoiakhin', 'Sabado', 'Sapalleda', 'M', 'Purok Dahon', 'wakin', '$2y$10$IO0FRZLu1/zNQuGhEsIF2.d5G9Tl32.Dc1GLb.ErEiqVudkBx8xKq', 'resident', 'no_photo.jpg', 0, NULL, NULL),
(14, '202509-0011', 'Guile Oswald', '', 'Amedo', 'M', 'Purok Mahogani', 'gayl', '$2y$10$i7repXBl3M2YwUq0myYXl.VLnXBIHlB7vy6HazYDThqV2CYefoWIi', 'resident', '1757246582_2a845da006fe90c054ad.gif', 0, NULL, NULL),
(15, '202509-0012', 'Ethaniel', 'A', 'Gwapo', 'M', 'Purok Gwapo', 'etanyel', '$2y$10$Dd.BumJKKdrF7DQC1N4bhecesUQLu72uT.ZpZ2ZRz0KZq0Hq5HwUG', 'resident', 'uploads/avatar/202509-0012/1758118496_2804ca4d8f6e384297cd.gif', 0, NULL, NULL);

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
-- Indexes for table `esp_system`
--
ALTER TABLE `esp_system`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `esp_system`
--
ALTER TABLE `esp_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fire_cases`
--
ALTER TABLE `fire_cases`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
