-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 19, 2023 at 03:42 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33
--
-- Database: `rentify`
--
CREATE DATABASE IF NOT EXISTS rentify;
DROP DATABASE IF EXISTS rentify;
USE rentify;
----------------------------------------------------------
--
-- Table structure for table `admin_credentials`
--
CREATE TABLE admin_credentials {
  `admin_id` INT(7) NOT NULL UNIQUE,
  `admin_password` VARCHAR(255) NOT NULL
}

----------------------------------------------------------
--
-- Table structure for table `custodian_credentials`
--
CREATE TABLE custodian_credentials (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `custodian_id` INT(7) NOT NULL UNIQUE,
    `custodian_name` VARCHAR(255) NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL, 
    `date_created` DATETIME NOT NULL,
    `reset_token` VARCHAR(512), 
    `reset_token_expiration` DATETIME
);

----------------------------------------------------------
--
-- Table structure for table `user_credentials`
--
CREATE TABLE `user_credentials` (
  `school_id` INT(7) NOT NULL,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`school_id`, `password`) VALUES
(2222075, 'admin123');

-- --------------------------------------------------------
--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `equipment_name`, `quantity`, `image_path`) VALUES
(21, 'Volleyball', 2, 'uploads/image.jpg'),
(20, 'Basketball', 1, 'uploads/dada.jpg');

-- --------------------------------------------------------
--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `reservation_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `floor` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_name`, `floor`, `capacity`, `available`) VALUES
(1, 'Audio Visual Room (AVR)', '9th Floor', 249, 1),
(2, 'Another Room', '10th Floor', 200, 0),
(3, 'D325', '3', 150, 1),
(4, 'D925', '9', 10, 1),
(5, 'AVR', '9', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_credentials`
--
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` char(50) NOT NULL,
  `user_password` varchar(16) NOT NULL,
  `user_status` char(7) NOT NULL DEFAULT 'offline',
  `user_category` char(9) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_status`, `user_category`) VALUES
(1, 'admin', 'admin', 'offline', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `equipment_id` (`equipment_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
