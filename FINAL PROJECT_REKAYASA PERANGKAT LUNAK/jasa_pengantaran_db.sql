-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3308
-- Generation Time: Jun 07, 2024 at 01:02 PM
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
-- Database: `jasa_pengantaran_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tracking_number` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `shipment_date` date NOT NULL,
  `sender` varchar(100) NOT NULL,
  `receiver` varchar(100) NOT NULL,
  `sender_address` varchar(255) NOT NULL,
  `receiver_address` varchar(255) NOT NULL,
  `service` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `user_id`, `tracking_number`, `status`, `shipment_date`, `sender`, `receiver`, `sender_address`, `receiver_address`, `service`) VALUES
(7, 1, 'TRACK111', 'In Transit', '2024-12-05', 'Elsa', 'Monica', 'Jl. Stress Berat', 'Jl. Ndak Turu-turu', 'Kilat'),
(10, 1, 'TRACK222', 'In Transit', '2024-12-08', 'Preis', 'Maria', 'Jl. Sampe Capek', 'Jl. Hubungan Tanpa Status', 'Expres'),
(11, 1, 'TRACK333', 'Pending', '2024-12-08', 'Nobi', 'Ana', 'Jl. Putus atau Trus?', 'Jl. sesat', 'Si cepat');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `user_type` enum('admin','member') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO users (id, username, password, name, email, phone, user_type)
VALUES
  (1, 'admin1', 'adminpassword1', 'ElsaPreisNobi', 'admin1@example.com', '081340298862', 'admin'),
  (3, 'day.elzzfilm', 'elsasiwy', 'Elsa Monica Siwy', 'elsasiwy@example.com', '081340298862', 'member'),
  (4, 'teletabisk', 'preis', 'Praise Maria Moniaga', 'praisemoniaga@example.com', '082191315664', 'member'),
  (5, 'naudreylie', 'nobiana', 'Nobliana Audrey Lie', 'nobianalie@example.com', '081351560119', 'member'),
  (6, 'admin2', 'adminpassword2', 'Admin2', 'admin2@example.com', '081340298862', 'admin'),
  (8, 'elsauser', 'elsasiwy', 'elsa', 'elsa@gmail.com', '081340298861', 'member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tracking_number` (`tracking_number`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
