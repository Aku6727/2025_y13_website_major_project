-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: 43.245.53.240:3306
-- Generation Time: Jul 21, 2025 at 02:17 PM
-- Server version: 8.0.32
-- PHP Version: 7.3.31-1~deb10u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stacd342_voidtech`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `user`, `pass`) VALUES
(1, 'admin@voidtech.nz', '$2y$10$YDtM18wtvMNN89MTZLQU5er3BYmDQcHHWvMT0IOdrL9iySh.m9Njy'),
(7, 'a@a.com', '$2y$10$0zEX.Hu9VWwcu85W2OyKF.VQ2ZHJnx.eSdgOCqzdGXaNOiK.HTkCy'),
(8, 'y@i.i', '$2y$10$bj75lzHvPMTxK0tm/ucpKeWH6C/7FDeeVwx1wh0qmgGnGjn.U6pHe'),
(9, 'kaelan@mail.com', '$2y$10$0qZONIhEoyia.vn.Pcgk5.RizZPIdC6puqfNarnduMq6dqE1PZoAa'),
(10, 'anthony@gmail.com', '$2y$10$npbKDt15tNVwIA5Qq1Qs7.kuIOT4CUvpLNoV2fj89BbEdgIPQYLie'),
(11, 'coolgays@gmail.com', '$2y$10$nygQAgrhFyyxrnHF4Ynr7OihPZp/my4AFEI4zeMOLOZShvgAibJ6y'),
(12, 'asiflwneoiglv@w', '$2y$10$QfUvx7IZqDsA9Il1fLTlseWeGrUVWK6ULKglMA8LrCLE40sHszos6'),
(13, 'gronk@gronk', '$2y$10$hEP95VzR3H7u2ObzzAo05upkZ3NdyydxjudpJhI5WInDR1Mxahs7m'),
(14, 'test@a.a', '$2y$10$us/uj88rigALRkHh3HbbkO3nUE9jd3tipTFNuHvrUT9kDIunkPyRa');

-- --------------------------------------------------------

--
-- Table structure for table `connection`
--

CREATE TABLE `connection` (
  `connection_id` int NOT NULL,
  `connection_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `connection`
--

INSERT INTO `connection` (`connection_id`, `connection_type`) VALUES
(1, 'Wired'),
(2, 'Wireless'),
(3, 'Dongle');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `manufacturer_id` int NOT NULL,
  `manufacturer_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`) VALUES
(20, 1),
(22, 1),
(23, 1),
(36, 1),
(19, 7),
(21, 7),
(24, 8),
(28, 9),
(29, 9),
(25, 10),
(26, 10),
(27, 10),
(30, 11),
(31, 11),
(32, 13),
(33, 14),
(34, 14),
(35, 14);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `prod_name` varchar(80) NOT NULL,
  `type_id` int NOT NULL,
  `price` int NOT NULL,
  `manufacturer_id` int NOT NULL,
  `weight` int NOT NULL,
  `connection_id` int NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `prod_name`, `type_id`, `price`, `manufacturer_id`, `weight`, `connection_id`, `image`) VALUES
(1, 'ViewEdge Elite 2024 Keyboard', 2, 830, 3, 1, 3, 'ViewEdgeElite2024Keyboard.jpg'),
(2, 'RazerTech Max 2025 Headset', 4, 298, 2, 3, 3, 'RazerTechMax2025Headset.jpg'),
(3, 'PixelPeak Fusion V4 Headset', 4, 262, 7, 3, 3, 'PixelPeakFusionV4Headset.jpg'),
(4, 'NeoGear Xtreme V1 Speaker', 6, 487, 8, 6, 2, 'NeoGearXtremeV1Speaker.jpg'),
(5, 'PixelPeak Xtreme V4 Docking Station', 8, 158, 7, 2, 2, 'PixelPeakXtremeV4DockingStation.jpg'),
(6, 'LogiCore Quantum 2024 Microphone', 7, 776, 1, 4, 3, 'LogiCoreQuantum2024Microphone.jpg'),
(7, 'NeoGear Ultralight V3 Speaker', 6, 592, 8, 5, 3, 'NeoGearUltralightV3Speaker.jpg'),
(8, 'HyperZone Elite 2025 Webcam', 5, 677, 4, 5, 1, 'HyperZoneElite2025Webcam.jpg'),
(9, 'PixelPeak Elite 2025 Monitor', 3, 266, 7, 6, 1, 'PixelPeakElite2025Monitor.jpg'),
(10, 'PixelPeak Stealth 2024 Monitor', 3, 670, 7, 5, 1, 'PixelPeakStealth2024Monitor.jpg'),
(11, 'PixelPeak Ultralight 2024 Speaker', 6, 109, 7, 4, 3, 'PixelPeakUltralight2024Speaker.jpg'),
(12, 'NeoGear Stealth 2024 Webcam', 5, 425, 8, 5, 1, 'NeoGearStealth2024Webcam.jpg'),
(13, 'ViewEdge Quantum V3 Keyboard', 2, 759, 3, 3, 3, 'ViewEdgeQuantumV3Keyboard.jpg'),
(14, 'NeoGear Elite 2025 Monitor', 3, 124, 8, 0, 1, 'NeoGearElite2025Monitor.jpg'),
(15, 'PixelPeak Ultralight V4 Monitor', 3, 803, 7, 4, 1, 'PixelPeakUltralightV4Monitor.jpg'),
(16, 'TechNova Turbo 2025 Monitor', 3, 583, 5, 7, 1, 'TechNovaTurbo2025Monitor.jpg'),
(17, 'HyperZone Turbo V4 Mouse', 1, 606, 4, 3, 2, 'HyperZoneTurboV4Mouse.jpg'),
(18, 'HyperZone Ultralight 2024 Keyboard', 2, 517, 4, 4, 2, 'HyperZoneUltralight2024Keyboard.jpg'),
(19, 'PixelPeak Stealth V3 Mouse', 1, 309, 7, 2, 2, 'PixelPeakStealthV3Mouse.jpg'),
(20, 'TechNova Turbo V4 Mouse', 1, 850, 5, 3, 3, 'TechNovaTurboV4Mouse.jpg'),
(21, 'SoundBlitz Quantum V3 Microphone', 7, 399, 6, 3, 1, 'SoundBlitzQuantumV3Microphone.jpg'),
(22, 'PixelPeak Ultralight V3 Webcam', 5, 227, 7, 6, 1, 'PixelPeakUltralightV3Webcam.jpg'),
(23, 'TechNova Elite 2024 Microphone', 7, 813, 5, 3, 2, 'TechNovaElite2024Microphone.jpg'),
(24, 'SoundBlitz Turbo V2 Webcam', 5, 682, 6, 2, 2, 'SoundBlitzTurboV2Webcam.jpg'),
(25, 'NeoGear Elite V2 Webcam', 5, 565, 8, 1, 3, 'NeoGearEliteV2Webcam.jpg'),
(26, 'NeoGear Fusion 2025 Monitor', 3, 265, 8, 1, 1, 'NeoGearFusion2025Monitor.jpg'),
(27, 'SoundBlitz Max 2025 Webcam', 5, 723, 6, 4, 1, 'SoundBlitzMax2025Webcam.jpg'),
(28, 'TechNova Xtreme V4 Webcam', 5, 53, 5, 1, 1, 'TechNovaXtremeV4Webcam.jpg'),
(29, 'ViewEdge Quantum 2025 Speaker', 6, 708, 3, 3, 3, 'ViewEdgeQuantum2025Speaker.jpg'),
(30, 'NeoGear Max V4 Docking Station', 8, 747, 8, 1, 1, 'NeoGearMaxV4DockingStation.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `type_id` int NOT NULL,
  `product_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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

-- --------------------------------------------------------

--
-- Table structure for table `purchased`
--

CREATE TABLE `purchased` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `prod_id` int NOT NULL,
  `quant` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `purchased`
--

INSERT INTO `purchased` (`id`, `order_id`, `prod_id`, `quant`) VALUES
(24, 19, 17, 1),
(25, 20, 17, 1),
(26, 21, 8, 1),
(27, 22, 17, 1),
(28, 22, 9, 1),
(29, 23, 17, 12),
(30, 25, 4, 1),
(31, 26, 8, 1),
(32, 27, 23, 1),
(33, 28, 17, 1),
(34, 29, 2, 1),
(35, 29, 21, 3),
(36, 29, 14, 1),
(37, 33, 17, -1),
(38, 36, 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- Indexes for table `purchased`
--
ALTER TABLE `purchased`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `connection`
--
ALTER TABLE `connection`
  MODIFY `connection_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `manufacturer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `purchased`
--
ALTER TABLE `purchased`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`);

--
-- Constraints for table `purchased`
--
ALTER TABLE `purchased`
  ADD CONSTRAINT `purchased_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
