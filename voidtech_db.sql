-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 28, 2025 at 08:28 PM
-- Server version: 5.7.24
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voidtech.db`
--

-- --------------------------------------------------------

--
-- Table structure for table `connection`
--

CREATE TABLE `connection` (
  `connection_id` int(11) NOT NULL,
  `connection_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `manufacturer_id` int(11) NOT NULL,
  `manufacturer_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`manufacturer_id`, `manufacturer_name`) VALUES
(1, 'LogiCore'),
(2, 'RazerTech'),
(3, 'ViewEdge'),
(4, 'HyperZone'),
(5, 'TechNova'),
(6, 'SoundBlitz'),
(7, 'PixelPeak'),
(8, 'NeoGear');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(2) NOT NULL,
  `prod_name` varchar(80) NOT NULL,
  `type_id` int(1) NOT NULL,
  `price` int(6) NOT NULL,
  `manufacturer_id` int(2) NOT NULL,
  `weight` int(5) NOT NULL,
  `connection_id` int(1) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `prod_name`, `type_id`, `price`, `manufacturer_id`, `weight`, `connection_id`, `image`) VALUES
(1, 'ViewEdge Elite 2024 Keyboard', 1, 830, 3, 1, 3, 'product_1.jpg'),
(2, 'RazerTech Max 2025 Headset', 8, 298, 2, 3, 3, 'product_2.jpg'),
(3, 'PixelPeak Fusion V4 Headset', 6, 262, 7, 3, 3, 'product_3.jpg'),
(4, 'NeoGear Xtreme V1 Speaker', 4, 487, 8, 6, 4, 'product_4.jpg'),
(5, 'PixelPeak Xtreme V4 Docking Station', 6, 158, 7, 2, 1, 'product_5.jpg'),
(6, 'LogiCore Quantum 2024 Microphone', 3, 776, 7, 4, 3, 'product_6.jpg'),
(7, 'NeoGear Ultralight V3 Speaker', 4, 592, 1, 5, 3, 'product_7.jpg'),
(8, 'HyperZone Elite 2025 Webcam', 3, 677, 7, 5, 3, 'product_8.jpg'),
(9, 'PixelPeak Elite 2025 Monitor', 3, 266, 8, 6, 2, 'product_9.jpg'),
(10, 'PixelPeak Stealth 2024 Monitor', 7, 670, 2, 5, 4, 'product_10.jpg'),
(11, 'PixelPeak Ultralight 2024 Speaker', 4, 109, 5, 4, 3, 'product_11.jpg'),
(12, 'NeoGear Stealth 2024 Webcam', 7, 425, 7, 5, 1, 'product_12.jpg'),
(13, 'ViewEdge Quantum V3 Keyboard', 1, 759, 6, 3, 3, 'product_13.jpg'),
(14, 'NeoGear Elite 2025 Monitor', 1, 124, 7, 0, 3, 'product_14.jpg'),
(15, 'PixelPeak Ultralight V4 Monitor', 7, 803, 3, 4, 4, 'product_15.jpg'),
(16, 'TechNova Turbo 2025 Monitor', 3, 583, 1, 7, 1, 'product_16.jpg'),
(17, 'HyperZone Turbo V4 Mouse', 5, 606, 6, 3, 4, 'product_17.jpg'),
(18, 'HyperZone Ultralight 2024 Keyboard', 8, 517, 1, 4, 2, 'product_18.jpg'),
(19, 'PixelPeak Stealth V3 Mouse', 6, 309, 2, 2, 2, 'product_19.jpg'),
(20, 'TechNova Turbo V4 Mouse', 8, 850, 6, 3, 3, 'product_20.jpg'),
(21, 'SoundBlitz Quantum V3 Microphone', 7, 399, 6, 3, 1, 'product_21.jpg'),
(22, 'PixelPeak Ultralight V3 Webcam', 4, 227, 8, 6, 2, 'product_22.jpg'),
(23, 'TechNova Elite 2024 Microphone', 2, 813, 6, 3, 2, 'product_23.jpg'),
(24, 'SoundBlitz Turbo V2 Webcam', 3, 682, 3, 2, 2, 'product_24.jpg'),
(25, 'NeoGear Elite V2 Webcam', 4, 565, 4, 1, 3, 'product_25.jpg'),
(26, 'NeoGear Fusion 2025 Monitor', 5, 265, 3, 1, 2, 'product_26.jpg'),
(27, 'SoundBlitz Max 2025 Webcam', 1, 723, 6, 4, 4, 'product_27.jpg'),
(28, 'TechNova Xtreme V4 Webcam', 4, 53, 7, 1, 1, 'product_28.jpg'),
(29, 'ViewEdge Quantum 2025 Speaker', 3, 708, 3, 3, 3, 'product_29.jpg'),
(30, 'NeoGear Max V4 Docking Station', 4, 747, 7, 1, 2, 'product_30.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `type_id` int(11) NOT NULL,
  `product_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`type_id`, `product_type`) VALUES
(1, 'Mouse'),
(2, 'Keyboard'),
(3, 'Monitor'),
(4, 'Headset'),
(5, 'Webcam'),
(6, 'Speaker'),
(7, 'Microphone'),
(8, 'Docking Station');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `connection`
--
ALTER TABLE `connection`
  ADD PRIMARY KEY (`connection_id`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`manufacturer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `connection`
--
ALTER TABLE `connection`
  MODIFY `connection_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
