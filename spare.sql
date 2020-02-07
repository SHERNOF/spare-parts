-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2020 at 09:58 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

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
  `category` text COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `date`) VALUES
(1, 'Electromechanic Equipment', '2020-01-14 07:51:53'),
(2, 'Drills', '2020-01-14 07:50:24'),
(3, 'Scaffolds', '2020-01-14 07:50:32'),
(4, 'energy Generators', '2020-01-14 07:50:41'),
(5, 'construction equipment', '2020-01-14 07:50:48'),
(6, 'Mechanic hammers', '2020-01-14 07:50:55'),
(7, 'Merlin', '2020-01-14 07:53:11');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `code` text COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `image` text COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `buyingPrice` float NOT NULL,
  `sellingPrice` float NOT NULL,
  `sales` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`id`, `idCategory`, `code`, `description`, `image`, `stock`, `buyingPrice`, `sellingPrice`, `sales`, `date`) VALUES
(1, 1, '101', 'Industrial vacuum cleaner', 'views/img/parts/101/955.jpg', 7, 50, 100, 3, '2020-02-06 04:19:50'),
(2, 1, '102', 'Floating Plate for Palletizer', 'views/img/parts/102/439.jpg', 9, 1000, 1500, 1, '2020-02-03 05:22:25'),
(3, 1, '103', 'Air Compressor for painting', 'views/img/parts/103/712.jpg', 19, 3000, 4200, 1, '2020-01-31 08:30:12'),
(4, 1, '104', 'Brick Cutter without Disk', 'views/img/parts/104/188.jpg', 17, 4000, 5600, 3, '2020-02-03 05:21:55'),
(5, 1, '105', 'Floor Cutter without Disk', 'views/img/parts/105/970.jpg', 20, 1540, 2156, 0, '2020-01-29 06:31:57'),
(6, 1, '106', 'Diamond Tip Disk', 'views/img/parts/106/129.jpg', 17, 1100, 1540, 3, '2020-02-03 05:22:25'),
(7, 1, '107', 'Air extractor', 'views/img/parts/107/871.jpg', 20, 1540, 2156, 0, '2020-01-14 07:42:03'),
(8, 1, '108', 'Mower', 'views/img/parts/108/484.jpg', 19, 1540, 2156, 1, '2020-02-06 04:20:16'),
(9, 1, '109', 'Electric Water Washer', 'views/img/parts/109/332.jpg', 20, 2600, 3640, 0, '2020-01-29 06:05:14'),
(10, 1, '110', 'Petrol pressure washer', 'views/img/parts/110/424.jpg', 17, 2210, 3094, 3, '2020-02-06 04:57:30'),
(11, 1, '111', 'Gasoline motor pump', 'views/img/parts/111/930.jpg', 20, 3000, 4200, 0, '2020-01-15 07:04:16'),
(12, 1, '112', 'Electric motor pump', 'views/img/parts/112/206.png', 20, 2400, 3360, 0, '2020-01-15 06:43:12'),
(13, 1, '113', 'Circular saw', 'views/img/parts/113/344.png', 20, 1100, 1540, 0, '2020-01-15 06:45:45'),
(14, 1, '114', 'Tungsten disc for circular saw', 'views/img/parts/114/525.png', 20, 4500, 6300, 0, '2020-01-15 07:04:58'),
(15, 1, '115', 'Electric welder', 'views/img/parts/default/anonymous.png', 20, 1980, 2772, 0, '2020-01-14 07:43:08'),
(16, 1, '116', 'Welders face', 'views/img/parts/default/anonymous.png', 20, 4200, 5880, 0, '2020-01-14 07:43:15'),
(17, 1, '117', 'Illumination tower', 'views/img/parts/default/anonymous.png', 19, 1800, 2520, 1, '2020-02-06 04:21:19'),
(18, 2, '201', 'Floor Demolishing Hammer 110V', 'views/img/parts/default/anonymous.png', 20, 5600, 7840, 0, '2020-01-14 07:43:23'),
(19, 2, '202', 'Muela or chisel hammer demolishing floor', 'views/img/parts/default/anonymous.png', 20, 9600, 13440, 0, '2020-01-14 07:43:29'),
(20, 2, '203', 'Wall Wrecking Drill 110V', 'views/img/parts/default/anonymous.png', 20, 3850, 5390, 0, '2020-01-14 07:43:32'),
(21, 2, '204', 'Muela or chisel hammer demolition wall', 'views/img/parts/204/321.png', 20, 9600, 13440, 0, '2020-01-15 07:06:50'),
(22, 2, '205', '1/2 Hammer Drill Wood and Metal', 'views/img/parts/default/anonymous.png', 20, 8000, 11200, 0, '2020-01-14 07:43:39'),
(23, 2, '206', 'Drill Percussion SDS Plus 110V', 'views/img/parts/default/anonymous.png', 20, 3900, 5460, 0, '2020-01-14 07:43:44'),
(24, 2, '207', 'Drill Percussion SDS Max 110V (Mining)', 'views/img/parts/default/anonymous.png', 20, 4600, 6440, 0, '2020-01-14 07:43:53'),
(25, 3, '301', 'Hanging scaffolding', 'views/img/parts/default/anonymous.png', 20, 1440, 2016, 0, '2020-01-14 07:43:58'),
(26, 3, '302', 'Scaffolding hanging spacer', 'views/img/parts/default/anonymous.png', 20, 1600, 2240, 0, '2020-01-14 07:44:13'),
(27, 3, '303', 'Modular scaffolding frame', 'views/img/parts/default/anonymous.png', 20, 900, 1260, 0, '2020-01-14 07:44:17'),
(28, 3, '304', 'Frame scaffolding scissors', 'views/img/parts/default/anonymous.png', 20, 100, 140, 0, '2020-01-14 07:44:19'),
(29, 3, '305', 'Scaffolding scissors', 'views/img/parts/default/anonymous.png', 20, 162, 226, 0, '2020-01-14 07:44:21'),
(30, 3, '306', 'Internal ladder for scaffolding', 'views/img/parts/default/anonymous.png', 20, 270, 378, 0, '2020-01-14 07:44:23'),
(31, 3, '307', 'Security handrails', 'views/img/parts/307/378.png', 20, 75, 105, 0, '2020-01-15 07:07:50'),
(32, 3, '308', 'Rotating wheel for scaffolding', 'views/img/parts/default/anonymous.png', 20, 168, 235, 0, '2020-01-14 07:44:27'),
(33, 3, '309', 'safety harness', 'views/img/parts/default/anonymous.png', 20, 1750, 2450, 0, '2020-01-14 07:44:30'),
(34, 3, '310', 'Sling for harness', 'views/img/parts/default/anonymous.png', 20, 175, 245, 0, '2020-01-14 07:44:32'),
(35, 3, '311', 'Metallic Platform', 'views/img/parts/default/anonymous.png', 20, 420, 588, 0, '2020-01-14 07:44:35'),
(36, 4, '401', '6 Kva Diesel Power Plant', 'views/img/parts/default/anonymous.png', 20, 3500, 4900, 0, '2020-01-14 07:44:38'),
(37, 4, '402', '10 Kva Diesel Power Plant', 'views/img/parts/default/anonymous.png', 20, 3550, 4970, 0, '2020-01-14 07:44:41'),
(38, 4, '403', '20 Kva Diesel Power Plant', 'views/img/parts/default/anonymous.png', 20, 3600, 5040, 0, '2020-01-14 07:44:45'),
(39, 4, '404', '30 Kva Diesel Power Plant', 'views/img/parts/default/anonymous.png', 20, 3650, 5110, 0, '2020-01-14 07:44:54'),
(40, 4, '405', '60 Kva Diesel Power Plant', 'views/img/parts/default/anonymous.png', 20, 3700, 5180, 0, '2020-01-14 07:44:57'),
(41, 4, '406', '75 Kva Diesel Power Plant', 'views/img/parts/default/anonymous.png', 20, 3750, 5250, 0, '2020-01-14 07:45:00'),
(42, 4, '407', '100 Kva Diesel Power Plant', 'views/img/parts/default/anonymous.png', 20, 3800, 5320, 0, '2020-01-14 07:45:06'),
(43, 4, '408', '120 Kva Diesel Power Plant', 'views/img/parts/default/anonymous.png', 20, 3850, 5390, 0, '2020-01-14 07:45:12'),
(44, 5, '501', 'Aluminum Scissor Ladder', 'views/img/parts/default/anonymous.png', 20, 350, 490, 0, '2020-01-14 07:45:15'),
(45, 5, '502', 'Electric extension', 'views/img/parts/default/anonymous.png', 20, 370, 518, 0, '2020-01-14 07:45:20'),
(46, 5, '503', 'Tensioner cat', 'views/img/parts/503/513.png', 20, 380, 532, 0, '2020-01-15 07:07:09'),
(47, 5, '504', 'Lamina Covers Gap', 'views/img/parts/default/anonymous.png', 20, 380, 532, 0, '2020-01-14 07:45:27'),
(48, 5, '505', 'Pipe wrench', 'views/img/parts/default/anonymous.png', 20, 480, 672, 0, '2020-01-14 07:45:29'),
(49, 5, '506', 'Manila by Metro', 'views/img/parts/default/anonymous.png', 20, 600, 840, 0, '2020-01-14 07:45:33'),
(50, 5, '507', '2-channel pulley', 'views/img/parts/default/anonymous.png', 20, 900, 1260, 0, '2020-01-14 07:45:35'),
(51, 5, '508', 'Tensor', 'views/img/parts/508/758.jpg', 30, 200, 220, 0, '2020-01-15 06:24:21'),
(52, 5, '509', 'Weighing machine', 'views/img/parts/default/anonymous.png', 20, 130, 182, 0, '2020-01-14 07:46:22'),
(53, 5, '510', 'Hydrostatic pump', 'views/img/parts/default/anonymous.png', 20, 770, 1078, 0, '2020-01-14 07:46:26'),
(54, 5, '511', 'Chapeta', 'views/img/parts/default/anonymous.png', 20, 660, 924, 0, '2020-01-14 07:46:29'),
(55, 5, '512', 'Concrete sample cylinder', 'views/img/parts/default/anonymous.png', 20, 400, 560, 0, '2020-01-14 07:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `partsuser`
--

CREATE TABLE `partsuser` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `idDocument` int(11) NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `phone` text COLLATE utf8_bin NOT NULL,
  `address` text COLLATE utf8_bin NOT NULL,
  `birthdate` date NOT NULL,
  `partsWithdrawn` int(11) NOT NULL,
  `lastWithdrawn` datetime NOT NULL,
  `registerDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `partsuser`
--

INSERT INTO `partsuser` (`id`, `name`, `idDocument`, `email`, `phone`, `address`, `birthdate`, `partsWithdrawn`, `lastWithdrawn`, `registerDate`) VALUES
(1, 'J', 222, 'jamaludding@pciltd.com.sg', '6281270068807', 'Batam', '1978-10-07', 7, '2020-02-05 23:20:16', '2020-02-06 04:20:16'),
(2, 'S', 222, 'sherwin.nofuente@cognex.com', '97781073', 'SG', '1978-10-07', 7, '2020-02-03 00:22:25', '2020-02-03 05:22:25'),
(3, 'A', 111111, 'angelynnofuente@yahoo.com', '91780406', 'SG', '1980-04-06', 2, '2020-02-05 23:57:30', '2020-02-06 04:57:30');

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
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user`, `password`, `profile`, `photo`, `status`, `lastLogin`, `date`) VALUES
(11, 'Sherwin Nofuente', 'sherwin', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/sherwin/869.jpg', 1, '2020-02-07 16:46:57', '2020-02-07 08:46:57'),
(33, 'Angelyn Nofuente', 'angie', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Special', 'views/img/users/angie/607.jpg', 1, '2020-02-07 11:44:49', '2020-02-07 03:44:49'),
(34, 'Boss', 'boss', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Seller', 'views/img/users/boss/972.png', 1, '2020-02-07 11:48:08', '2020-02-07 03:48:08'),
(35, 'A', 'A', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/A/616.jpg', 0, '0000-00-00 00:00:00', '2019-12-28 18:12:11'),
(36, 'b', 'b', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/b/609.jpg', 0, '0000-00-00 00:00:00', '2019-12-31 16:19:16'),
(37, 'c', 'c', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/c/433.jpg', 0, '0000-00-00 00:00:00', '2019-12-31 16:19:31'),
(38, 'd', 'd', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/d/570.jpg', 0, '0000-00-00 00:00:00', '2019-12-31 16:19:47'),
(39, 'e', 'e', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/e/868.jpg', 0, '0000-00-00 00:00:00', '2019-12-31 16:20:05'),
(40, 'f', 'f', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/f/242.jpg', 0, '0000-00-00 00:00:00', '2019-12-31 16:20:17'),
(41, 'g', 'g', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/g/305.jpg', 0, '0000-00-00 00:00:00', '2019-12-31 16:20:28'),
(43, 'h', 'h', '$2a$07$usesomesillystringforeOyL9OHkEHx2/qTzssLMVGM8Mg9uR9Xy', 'Administrator', 'views/img/users/h/711.jpg', 0, '0000-00-00 00:00:00', '2020-01-01 14:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal`
--

CREATE TABLE `withdrawal` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `idPartsUser` int(11) NOT NULL,
  `idIssuer` int(11) NOT NULL,
  `parts` text COLLATE utf8_spanish_ci NOT NULL,
  `tax` int(11) NOT NULL,
  `netPrice` float NOT NULL,
  `totalPrice` float NOT NULL,
  `paymentMethod` text COLLATE utf8_spanish_ci NOT NULL,
  `withdrawalDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `withdrawal`
--

INSERT INTO `withdrawal` (`id`, `code`, `idPartsUser`, `idIssuer`, `parts`, `tax`, `netPrice`, `totalPrice`, `paymentMethod`, `withdrawalDate`) VALUES
(0, 10001, 1, 11, '[{\"id\":\"1\",\"description\":\"Industrial vacuum cleaner\",\"quantity\":\"1\",\"stock\":\"9\",\"price\":\"100\",\"totalPrice\":\"100\"}]', 10, 100, 110, 'cash', '2020-01-30 08:06:41'),
(0, 10002, 1, 11, '[{\"id\":\"3\",\"description\":\"Air Compressor for painting\",\"quantity\":\"1\",\"stock\":\"19\",\"price\":\"4200\",\"totalPrice\":\"4200\"}]', 420, 4200, 4620, 'cash', '2020-01-31 08:30:12'),
(0, 10003, 1, 33, '[{\"id\":\"4\",\"description\":\"Brick Cutter without Disk\",\"quantity\":\"2\",\"stock\":\"18\",\"price\":\"5600\",\"totalPrice\":\"11200\"}]', 1008, 11200, 12208, 'cash', '2020-02-03 04:51:01'),
(0, 10004, 2, 33, '[{\"id\":\"4\",\"description\":\"Brick Cutter without Disk\",\"quantity\":\"1\",\"stock\":\"17\",\"price\":\"5600\",\"totalPrice\":\"5600\"}]', 560, 5600, 6160, 'cash', '2020-02-03 05:21:55'),
(0, 10005, 2, 33, '[{\"id\":\"2\",\"description\":\"Floating Plate for Palletizer\",\"quantity\":\"1\",\"stock\":\"9\",\"price\":\"1500\",\"totalPrice\":\"1500\"},{\"id\":\"6\",\"description\":\"Diamond Tip Disk\",\"quantity\":\"3\",\"stock\":\"17\",\"price\":\"1540\",\"totalPrice\":\"4620\"},{\"id\":\"10\",\"description\":\"Petrol pressure washer\",\"quantity\":\"2\",\"stock\":\"18\",\"price\":\"3094\",\"totalPrice\":\"6188\"}]', 1231, 12308, 13538.8, 'cash', '2020-02-03 05:22:25'),
(0, 10006, 1, 11, '[{\"id\":\"1\",\"description\":\"Industrial vacuum cleaner\",\"quantity\":\"2\",\"stock\":\"7\",\"price\":\"100\",\"totalPrice\":\"200\"}]', 20, 200, 220, 'cash', '2020-02-06 04:19:50'),
(0, 10007, 1, 11, '[{\"id\":\"8\",\"description\":\"Mower\",\"quantity\":\"1\",\"stock\":\"19\",\"price\":\"2156\",\"totalPrice\":\"2156\"}]', 216, 2156, 2371.6, 'cash', '2020-02-06 04:20:16'),
(0, 10008, 3, 11, '[{\"id\":\"17\",\"description\":\"Illumination tower\",\"quantity\":\"1\",\"stock\":\"19\",\"price\":\"2520\",\"totalPrice\":\"2520\"}]', 252, 2520, 2772, 'cash', '2020-02-06 04:21:19'),
(0, 10009, 3, 11, '[{\"id\":\"10\",\"description\":\"Petrol pressure washer\",\"quantity\":\"1\",\"stock\":\"17\",\"price\":\"3094\",\"totalPrice\":\"3094\"}]', 309, 3094, 3403.4, 'cash', '2020-02-06 04:57:30');

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
-- Indexes for table `partsuser`
--
ALTER TABLE `partsuser`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `partsuser`
--
ALTER TABLE `partsuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
