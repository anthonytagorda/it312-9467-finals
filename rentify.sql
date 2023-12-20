-- Create and use the database
DROP DATABASE IF EXISTS rentify;
CREATE DATABASE IF NOT EXISTS rentify;
USE rentify;

-- Table for admin credentials
CREATE TABLE `admin_credentials` (
  `admin_id` INT NOT NULL PRIMARY KEY,
  `admin_password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin_credentials` (`admin_id`, `admin_password`) VALUES
(2222075, 'admin123');

-- Table for custodian credentials
CREATE TABLE `custodian_credentials` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `custodian_id` INT NOT NULL UNIQUE,
    `custodian_name` VARCHAR(255) NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL, 
    `date_created` DATETIME NOT NULL,
    `reset_token` VARCHAR(512), 
    `reset_token_expiration` DATETIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table for user credentials
CREATE TABLE `user_credentials` (
  `school_id` INT NOT NULL PRIMARY KEY,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user_credentials` (`school_id`, `password`) VALUES
(2222075, 'admin123');

-- Table for equipment
CREATE TABLE `equipment` (
  `equip_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `equip_name` VARCHAR(255) NOT NULL,
  `equip_no` INT NOT NULL,
  `equip_type` VARCHAR(255) DEFAULT NULL,
  `equip_photo` VARCHAR(255) DEFAULT NULL,
  `equip_status` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table for rooms
CREATE TABLE `rooms` (
  `room_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `room_no` INT NOT NULL,
  `room_location` VARCHAR(255) NOT NULL,
  `room_capacity` INT NOT NULL,
  `room_status` VARCHAR(255) NOT NULL,
  `room_photo` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table for transactions
CREATE TABLE `transactions` (
  `transaction_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `transaction_num` INT NOT NULL,
  `user_id` INT,
  `custodian_id` INT,
  `room_id` INT DEFAULT NULL,
  `equip_id` INT DEFAULT NULL,
  `transaction_date` DATE DEFAULT NULL,
  `transaction_status` VARCHAR(255) NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `user_credentials`(`school_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  FOREIGN KEY (`custodian_id`) REFERENCES `custodian_credentials`(`custodian_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `transactions`
ADD CONSTRAINT `chk_room_or_equip`
CHECK ((`room_id` IS NOT NULL AND `equip_id` IS NULL) OR 
       (`room_id` IS NULL AND `equip_id` IS NOT NULL) OR 
       (`room_id` IS NOT NULL AND `equip_id` IS NOT NULL));
