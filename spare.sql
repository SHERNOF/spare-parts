-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2020 at 06:22 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spare`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` text COLLATE utf8_spanish_ci NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `Date`) VALUES
(1, 'Electromechanic Equipment', '2018-11-03 04:03:39'),
(2, 'Drills', '2018-11-03 04:04:19'),
(3, 'Scaffolds', '2018-11-03 04:05:23'),
(4, 'energy Generators', '2018-11-03 04:05:45'),
(5, 'construction equipment', '2018-11-03 04:08:21'),
(7, 'Merlin', '2020-01-07 17:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `code` text COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `image` text COLLATE utf8_bin NOT NULL,
  `stock` int(11) NOT NULL,
  `buyingPrice` float NOT NULL,
  `sellingPrice` float NOT NULL,
  `sales` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`id`, `idCategory`, `code`, `description`, `image`, `stock`, `buyingPrice`, `sellingPrice`, `sales`, `date`) VALUES
(1, 1, '101', 'Industrial vacuum cleaner', 'views/img/parts/101/128.jpg', 12, 1500, 2100, 0, '2020-01-15 12:53:09'),
(2, 1, '102', 'Float Plate for Palletizer', 'views/img/parts/102/270.jpg', 9, 4500, 6300, 0, '2020-01-13 17:24:42'),
(3, 1, '103', 'Air Compressor for painting', 'views/img/parts/103/712.jpg', 10, 3000, 4200, 0, '2020-01-13 17:17:34'),
(4, 1, '104', 'Adobe Cutter without Disk', 'views/img/parts/104/188.jpg', 15, 4000, 5600, 0, '2020-01-13 17:17:39'),
(5, 1, '105', 'Floor Cutter without Disk', 'views/img/parts/105/970.jpg', 20, 1540, 2156, 0, '2020-01-13 17:17:43'),
(6, 1, '106', 'Diamond Tip Disk', 'views/img/parts/106/129.jpg', 20, 1100, 1540, 0, '2020-01-13 17:17:51'),
(7, 1, '107', 'Air extractor', 'views/img/parts/107/871.jpg', 20, 1540, 2156, 0, '2020-01-13 17:17:53'),
(8, 1, '108', 'Mower', 'views/img/parts/108/484.jpg', 20, 1540, 2156, 0, '2020-01-13 17:17:56'),
(9, 1, '109', 'Electric Water Washer', 'views/img/parts/109/332.jpg', 20, 2600, 3640, 0, '2020-01-13 17:17:59'),
(10, 1, '110', 'Petrol pressure washer', 'views/img/parts/110/424.jpg', 20, 2210, 3094, 0, '2020-01-13 17:18:03'),
(11, 1, '111', 'Gasoline motor pump', 'views/img/parts/default/anonymous.png', 20, 2860, 4004, 0, '2020-01-13 17:18:06'),
(12, 1, '112', 'Electric motor pump', 'views/img/parts/default/anonymous.png', 20, 2400, 3360, 0, '2020-01-13 17:18:09'),
(13, 1, '113', 'Circular saw', '', 20, 1100, 1540, 0, '2020-01-01 15:20:03'),
(14, 1, '114', 'Tungsten disc for circular saw', '', 20, 4500, 6300, 0, '2020-01-01 15:20:03'),
(15, 1, '115', 'Electric welder', '', 20, 1980, 2772, 0, '2020-01-01 15:20:03'),
(16, 1, '116', 'Welders face', '', 20, 4200, 5880, 0, '2020-01-01 15:20:03'),
(17, 1, '117', 'Illumination tower', '', 20, 1800, 2520, 0, '2020-01-01 15:20:03'),
(18, 2, '201', 'Floor Demolishing Hammer 110V', '', 20, 5600, 7840, 0, '2020-01-01 15:20:03'),
(19, 2, '202', 'Muela or chisel hammer demolishing floor', '', 20, 9600, 13440, 0, '2020-01-01 15:20:03'),
(20, 2, '203', 'Wall Wrecking Drill 110V', '', 20, 3850, 5390, 0, '2020-01-01 15:20:03'),
(21, 2, '204', 'Muela or chisel hammer demolition wall', '', 20, 9600, 13440, 0, '2020-01-01 15:20:03'),
(22, 2, '205', '1/2 Hammer Drill Wood and Metal', '', 20, 8000, 11200, 0, '2020-01-01 15:20:03'),
(23, 2, '206', 'Drill Percussion SDS Plus 110V', '', 20, 3900, 5460, 0, '2020-01-01 15:20:03'),
(24, 2, '207', 'Drill Percussion SDS Max 110V (Mining)', '', 20, 4600, 6440, 0, '2020-01-01 15:20:03'),
(25, 3, '301', 'Hanging scaffolding', '', 20, 1440, 2016, 0, '2020-01-01 15:20:03'),
(26, 3, '302', 'Scaffolding hanging spacer', '', 20, 1600, 2240, 0, '2020-01-01 15:20:03'),
(27, 3, '303', 'Modular scaffolding frame', '', 20, 900, 1260, 0, '2020-01-01 15:20:03'),
(28, 3, '304', 'Frame scaffolding scissors', '', 20, 100, 140, 0, '2020-01-01 15:20:03'),
(29, 3, '305', 'Scaffolding scissors', '', 20, 162, 226, 0, '2020-01-01 15:20:03'),
(30, 3, '306', 'Internal ladder for scaffolding', '', 20, 270, 378, 0, '2020-01-01 15:20:03'),
(31, 3, '307', 'Security handrails', '', 20, 75, 105, 0, '2020-01-01 15:20:03'),
(32, 3, '308', 'Rotating wheel for scaffolding', '', 20, 168, 235, 0, '2020-01-01 15:20:03'),
(33, 3, '309', 'safety harness', '', 20, 1750, 2450, 0, '2020-01-01 15:20:03'),
(34, 3, '310', 'Sling for harness', '', 20, 175, 245, 0, '2020-01-01 15:20:03'),
(35, 3, '311', 'Metallic Platform', '', 20, 420, 588, 0, '2020-01-01 15:20:03'),
(36, 4, '401', '6 Kva Diesel Power Plant', '', 20, 3500, 4900, 0, '2020-01-01 15:20:03'),
(37, 4, '402', '10 Kva Diesel Power Plant', '', 20, 3550, 4970, 0, '2020-01-01 15:20:03'),
(38, 4, '403', '20 Kva Diesel Power Plant', '', 20, 3600, 5040, 0, '2020-01-01 15:20:03'),
(39, 4, '404', '30 Kva Diesel Power Plant', '', 20, 3650, 5110, 0, '2020-01-01 15:20:03'),
(40, 4, '405', '60 Kva Diesel Power Plant', '', 20, 3700, 5180, 0, '2020-01-01 15:20:03'),
(41, 4, '406', '75 Kva Diesel Power Plant', '', 20, 3750, 5250, 0, '2020-01-01 15:20:03'),
(42, 4, '407', '100 Kva Diesel Power Plant', '', 20, 3800, 5320, 0, '2020-01-01 15:20:03'),
(43, 4, '408', '120 Kva Diesel Power Plant', '', 20, 3850, 5390, 0, '2020-01-01 15:20:03'),
(44, 5, '501', 'Aluminum Scissor Ladder', '', 20, 350, 490, 0, '2020-01-01 15:20:03'),
(45, 5, '502', 'Electric extension', '', 20, 370, 518, 0, '2020-01-01 15:20:03'),
(46, 5, '503', 'Tensioner cat', '', 20, 380, 532, 0, '2020-01-01 15:20:03'),
(47, 5, '504', 'Lamina Covers Gap', '', 20, 380, 532, 0, '2020-01-01 15:20:03'),
(48, 5, '505', 'Pipe wrench', '', 20, 480, 672, 0, '2020-01-01 15:20:03'),
(49, 5, '506', 'Manila by Metro', '', 20, 600, 840, 0, '2020-01-01 15:20:03'),
(50, 5, '507', '2-channel pulley', '', 20, 900, 1260, 0, '2020-01-01 15:20:03'),
(51, 5, '508', 'Tensor', 'views/img/parts/default/anonymous.png', 20, 100, 140, 0, '2020-01-15 12:45:15'),
(52, 5, '509', 'Weighing machine', 'views/img/parts/default/anonymous.png', 30, 120, 156, 0, '2020-01-15 12:45:19'),
(53, 5, '510', 'Hydrostatic pump', '', 20, 770, 1078, 0, '2020-01-01 15:20:03'),
(54, 5, '511', 'Chapeta', '', 20, 660, 924, 0, '2020-01-01 15:20:03'),
(55, 5, '512', 'Concrete sample cylinder', '', 20, 400, 560, 0, '2020-01-01 15:20:03'),
(56, 5, '513', 'Lever Shear', '', 20, 450, 630, 0, '2020-01-01 15:20:03'),
(57, 5, '514', 'Scissor Shear', '', 20, 580, 812, 0, '2020-01-01 15:20:03'),
(58, 5, '515', 'Pneumatic tire car', '', 20, 420, 588, 0, '2020-01-01 15:20:03'),
(59, 5, '516', 'Cone slump', '', 20, 140, 196, 0, '2020-01-01 15:20:03'),
(60, 5, '517', 'Baldosin cutter', '', 20, 930, 1302, 0, '2020-01-01 15:20:03');

-- --------------------------------------------------------

--
-- Table structure for table `partsUser`
--

CREATE TABLE `partsUser` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `idDocument` int(11) NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `phone` text COLLATE utf8_bin NOT NULL,
  `address` text COLLATE utf8_bin NOT NULL,
  `birthdate` date NOT NULL,
  `partsWithdrawn` int(11) NOT NULL,
  `lastWithdrawn` datetime NOT NULL,
  `registerDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `partsUser`
--

INSERT INTO `partsUser` (`id`, `name`, `idDocument`, `email`, `phone`, `address`, `birthdate`, `partsWithdrawn`, `lastWithdrawn`, `registerDate`) VALUES
(10, 'Sherwin', 777, 'sherwin.nofuente@cognex.com', '97781073', 'Singapore', '1978-10-07', 0, '0000-00-00 00:00:00', '2020-01-15 17:07:44'),
(11, 'Angie', 46, 'angelynnofuente@yahoo.com', '6591780406', 'SIngapore', '1980-04-06', 0, '0000-00-00 00:00:00', '2020-01-15 17:21:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `user` text NOT NULL,
  `password` text NOT NULL,
  `profile` text NOT NULL,
  `photo` text NOT NULL,
  `status` int(11) NOT NULL,
  `lastLogin` datetime NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user`, `password`, `profile`, `photo`, `status`, `lastLogin`, `date`) VALUES
(11, 'Sherwin Nofuente', 'sherwin', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/sherwin/869.jpg', 1, '2020-01-15 23:54:20', '2020-01-15 15:54:20'),
(33, 'Angelyn Nofuente', 'angie', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/angie/607.jpg', 1, '0000-00-00 00:00:00', '2019-12-27 08:32:48'),
(34, 'Boss', 'boss', '$2a$07$usesomesillystringforeP2z4S2A1gs4xMtjeS4l0aCZcXJgCZxe', 'Administrator', 'views/img/users/boss/972.png', 1, '0000-00-00 00:00:00', '2019-12-28 14:06:08'),
(35, 'A', 'A', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/A/616.jpg', 0, '0000-00-00 00:00:00', '2019-12-28 18:12:11'),
(36, 'b', 'b', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/b/609.jpg', 0, '0000-00-00 00:00:00', '2019-12-31 16:19:16'),
(37, 'c', 'c', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/c/433.jpg', 0, '0000-00-00 00:00:00', '2019-12-31 16:19:31'),
(38, 'd', 'd', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/d/570.jpg', 0, '0000-00-00 00:00:00', '2019-12-31 16:19:47'),
(39, 'e', 'e', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/e/868.jpg', 0, '0000-00-00 00:00:00', '2019-12-31 16:20:05'),
(40, 'f', 'f', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/f/242.jpg', 0, '0000-00-00 00:00:00', '2019-12-31 16:20:17'),
(41, 'g', 'g', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/g/305.jpg', 0, '0000-00-00 00:00:00', '2019-12-31 16:20:28'),
(43, 'h', 'h', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/h/711.jpg', 0, '0000-00-00 00:00:00', '2020-01-01 14:31:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partsUser`
--
ALTER TABLE `partsUser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `partsUser`
--
ALTER TABLE `partsUser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
