CREATE DATABASE IF NOT EXISTS `rentify`;
USE `rentify`;

-- Table structure for table `credentials`
DROP TABLE IF EXISTS `credentials`;
CREATE TABLE IF NOT EXISTS `credentials` (
  `school_id` int(7) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`school_id`)
);

-- Data for table `credentials`
INSERT INTO `credentials` (`school_id`, `password`) VALUES 
('2222075', 'admin123');

-- Table structure for table `equipment`
DROP TABLE IF EXISTS `equipment`;
CREATE TABLE IF NOT EXISTS `equipment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `equipment_name` varchar(255) NOT NULL,
  `quantity` int NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data for table `equipment`
INSERT INTO `equipment` (`id`, `equipment_name`, `quantity`, `image_path`) VALUES
(21, 'Volleyball', 2, 'uploads/image.jpg'),
(20, 'Basketball', 1, 'uploads/dada.jpg');

-- Table structure for table `reservations`
DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `reservation_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `room_id` int DEFAULT NULL,
  `equipment_id` int DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  PRIMARY KEY (`reservation_id`),
  KEY `user_id` (`user_id`),
  KEY `room_id` (`room_id`),
  KEY `equipment_id` (`equipment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `rooms`
DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `room_name` varchar(255) NOT NULL,
  `floor` varchar(255) NOT NULL,
  `capacity` int NOT NULL,
  `available` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table `rooms`
INSERT INTO `rooms` (`id`, `room_name`, `floor`, `capacity`, `available`) VALUES
(1, 'Audio Visual Room (AVR)', '9th Floor', 249, 1),
(2, 'Another Room', '10th Floor', 200, 0),
(3, 'D325', '3', 150, 1),
(4, 'D925', '9', 10, 1),
(5, 'AVR', '9', 10, 1);



