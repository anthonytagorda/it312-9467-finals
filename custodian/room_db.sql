-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 18, 2023 at 06:44 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `room_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` int NOT NULL AUTO_INCREMENT,
  `room_no` varchar(255) NOT NULL,
  `room_type` varchar(255) DEFAULT NULL,
  `room_location` varchar(255) DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `room_status` tinyint(1) DEFAULT NULL,
  `room_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`room_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_no`, `room_type`, `room_location`, `capacity`, `room_status`, `room_photo`, `created_at`, `updated_at`) VALUES
(1, 'D325', 'Classroom', '3rd Floor', 50, 0, 'uploads/dada.jpg', '2023-12-14 11:50:16', '2023-12-17 11:29:51'),
(2, 'D901', 'AVR', '9th Floor', 49, 1, 'uploads/image.jpg', '2023-12-14 11:55:21', '2023-12-14 11:55:21'),
(3, 'D325', 'Classroom', '3rd Floor', 12, 1, 'uploads/dada.jpg', '2023-12-14 11:58:03', '2023-12-17 11:19:58'),
(4, 'D325', 'Classroom', '3rd Floor', 1, 1, 'uploads/dada.jpg', '2023-12-14 12:01:10', '2023-12-14 12:01:10'),
(5, 'D525', 'Classroom', '5th Floor', 10, 1, 'uploads/', '2023-12-18 17:40:37', '2023-12-18 17:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `temp_rooms`
--

DROP TABLE IF EXISTS `temp_rooms`;
CREATE TABLE IF NOT EXISTS `temp_rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `room_name` varchar(255) NOT NULL,
  `floor` varchar(255) NOT NULL,
  `capacity` int NOT NULL,
  `available` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `temp_rooms`
--

INSERT INTO `temp_rooms` (`id`, `room_name`, `floor`, `capacity`, `available`) VALUES
(1, 'Audio Visual Room (AVR)', '9th Floor', 249, 1),
(2, 'Another Room', '10th Floor', 200, 0),
(3, 'D325', '3', 150, 1),
(4, 'D925', '9', 10, 1),
(5, 'AVR', '9', 10, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
