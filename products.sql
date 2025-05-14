-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 08, 2025 at 11:19 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
