-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2020 at 05:17 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carirumah`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

CREATE TABLE `agent` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(50) NOT NULL,
  `education` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(25) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` mediumtext NOT NULL,
  `image` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id` int(11) NOT NULL,
  `propertyName` varchar(200) NOT NULL,
  `propertyAddress` varchar(300) NOT NULL,
  `propertylt` int(11) NOT NULL,
  `propertylb` int(11) NOT NULL,
  `propertyBedroom` int(11) NOT NULL,
  `propertyBathroom` int(11) NOT NULL,
  `propertyElectricity` int(11) NOT NULL,
  `propertyFacility` mediumtext NOT NULL,
  `propertyLetterStatus` mediumtext NOT NULL,
  `propertyTypePrice` mediumtext NOT NULL,
  `ownerName` varchar(200) NOT NULL,
  `ownerAddress` varchar(300) NOT NULL,
  `ownerPhone` varchar(20) NOT NULL,
  `ownerEmail` varchar(50) NOT NULL,
  `ownerLetter` mediumtext NOT NULL,
  `ownerCommission` float NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id`, `propertyName`, `propertyAddress`, `propertylt`, `propertylb`, `propertyBedroom`, `propertyBathroom`, `propertyElectricity`, `propertyFacility`, `propertyLetterStatus`, `propertyTypePrice`, `ownerName`, `ownerAddress`, `ownerPhone`, `ownerEmail`, `ownerLetter`, `ownerCommission`, `status`) VALUES
(1, 'RUMAH XYSKUYYY', 'XYSKUYYY', 120, 100, 5, 1, 1300, 'blablabla', 'blablabla', 'blablabla', 'Ananda', 'Jalan XX', '087731492139', 'ananda@gmail.com', 'blablabla', 0.5, 2),
(2, 'RUMAH XY', 'Jalan X', 120, 100, 5, 1, 1300, 'blablabla', 'blablabla', 'blablabla', 'Ananda', 'Jalan XX', '087731492139', 'ananda@gmail.com', 'blablabla', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `facility` mediumtext DEFAULT NULL,
  `document` mediumtext DEFAULT NULL,
  `lt` int(11) NOT NULL,
  `lb` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `productCondition` tinyint(4) NOT NULL,
  `contactPerson` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `location`, `facility`, `document`, `lt`, `lb`, `status`, `productCondition`, `contactPerson`) VALUES
(24, 'Rumah X', '20000000000', 'Dki Jakarta', '<ul><li>Lengkap</li><li>Kamar mandi UwU</li></ul>', '<p><strong>GoOOOOKS </strong>lah pokoknya</p>', 2000, 1500, 1, 1, '087731492139');

-- --------------------------------------------------------

--
-- Table structure for table `products_image`
--

CREATE TABLE `products_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_image`
--

INSERT INTO `products_image` (`id`, `product_id`, `image`) VALUES
(116, 24, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.9132649987653556_1lwqt9n10wr4u0r2rcjq20ttg.jpg?alt=media&token=154d416b-ba3d-4cbb-97cc-56b36955a736'),
(117, 24, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.6476843970566972_9c9a4b904adf1a182ae8e0b76dee57d1.jpg?alt=media&token=186f5b15-7a4f-4856-b1f6-4e85a2ab7f00'),
(118, 24, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.5099429596616523_102662945_1520033738158299_2196670815983068892_o.png?alt=media&token=b35cac27-a4e1-4ce8-8d6c-62d615f3c619'),
(119, 24, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.7955200240385629_a90ee4a13dd990b8d47b6c112a4f9368.jpg?alt=media&token=6e70854c-cdfb-40d8-af68-b12cccf89aeb'),
(120, 24, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.8497241140825598_EZa8mSvUEAE_WXe.png?alt=media&token=ac3dc246-ddb7-4063-a173-4648eee2809b'),
(121, 24, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.6671008772697617_EZa8mSwU8AEn0Hf.png?alt=media&token=6186c75a-1226-4561-a53e-07a7c5a56d24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_image`
--
ALTER TABLE `products_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE `agent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products_image`
--
ALTER TABLE `products_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products_image`
--
ALTER TABLE `products_image`
  ADD CONSTRAINT `products_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
