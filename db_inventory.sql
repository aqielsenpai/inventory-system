-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2024 at 10:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `condition` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `item_name`, `quantity`, `description`, `category`, `condition`, `created_at`) VALUES
(3, 'nodemcu2', 10, 'test', 'Electronics', 'New', '2024-05-19 05:51:07'),
(4, 'Tesla Roadster', 1, 'red', 'Tools', 'New', '2024-05-19 06:11:58'),
(6, 'Arduino Uno', 15, 'Microcontroller board for building digital devices.', 'Electronics', 'New', '2024-05-19 07:50:54'),
(7, 'Soldering Iron', 20, 'Tool used for soldering electronic components.', 'Tools', 'Used', '2024-05-19 07:50:54'),
(8, 'Resistor Kit', 100, 'Assorted resistor kit for electronic projects.', 'Electronics', 'New', '2024-05-19 07:50:54'),
(9, '3D Printer Filament', 50, 'PLA filament for 3D printing.', 'Materials', 'New', '2024-05-19 07:50:54'),
(10, 'Oscilloscope', 5, 'Instrument used to measure and analyze electronic signals.', 'Electronics', 'Used', '2024-05-19 07:50:54'),
(11, 'Laser Cutter', 2, 'Tool for cutting and engraving materials.', 'Tools', 'New', '2024-05-19 07:50:54'),
(12, 'Multimeter', 25, 'Device for measuring electrical values.', 'Electronics', 'Used', '2024-05-19 07:50:54'),
(13, 'Screwdriver Set', 30, 'Set of various screwdrivers for assembly and repair.', 'Tools', 'New', '2024-05-19 07:50:54'),
(14, 'Breadboard', 200, 'Solderless device for prototyping electronics.', 'Electronics', 'New', '2024-05-19 07:50:54'),
(15, 'Safety Goggles', 50, 'Protective eyewear for safety during operations.', 'Materials', 'New', '2024-05-19 07:50:54'),
(16, 'Power Drill', 10, 'Electric drill for making holes.', 'Tools', 'Used', '2024-05-19 07:50:54'),
(17, 'Capacitor Assortment', 150, 'Various capacitors for electronic circuits.', 'Electronics', 'New', '2024-05-19 07:50:54'),
(18, 'Hot Glue Gun', 12, 'Tool for applying hot adhesive.', 'Tools', 'New', '2024-05-19 07:50:54'),
(19, 'Wire Stripper', 20, 'Tool for stripping insulation from wires.', 'Tools', 'Used', '2024-05-19 07:50:54'),
(20, 'LED Strip Lights', 40, 'Flexible circuit board populated by LEDs.', 'Electronics', 'New', '2024-05-19 07:50:54'),
(21, '3D Printing Resin', 30, 'Resin used for SLA 3D printing.', 'Materials', 'New', '2024-05-19 07:50:54'),
(22, 'Digital Caliper', 15, 'Precision measuring instrument.', 'Tools', 'Used', '2024-05-19 07:50:54'),
(23, 'Copper Clad Board', 60, 'Base material for PCB manufacturing.', 'Materials', 'New', '2024-05-19 07:50:54'),
(24, 'Heat Shrink Tubing', 200, 'Tubing that shrinks when heated to insulate wires.', 'Materials', 'New', '2024-05-19 07:50:54'),
(25, 'Microcontroller Kit', 25, 'Kit including microcontroller and accessories.', 'Electronics', 'New', '2024-05-19 07:50:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `created_at`) VALUES
(4, 'm.aqielakhtar@gmail.com', '6367c48dd193d56ea7b0baad25b19455e529f5ee', 'Aqiel Akhtar', '2024-05-19 03:42:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
