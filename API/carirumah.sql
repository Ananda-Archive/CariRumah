-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2020 at 10:46 AM
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

CREATE TABLE agent (
  'id' int(11) NOT NULL,
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

CREATE TABLE article (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` mediumtext NOT NULL,
  `image` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE mitra (
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

INSERT INTO mitra (id, propertyName, propertyAddress, propertylt, propertylb, propertyBedroom, propertyBathroom, propertyElectricity, propertyFacility, propertyLetterStatus, propertyTypePrice, ownerName, ownerAddress, ownerPhone, ownerEmail, ownerLetter, ownerCommission, status) VALUES
(1, 'RUMAH XYSKUYYY', 'XYSKUYYY', 120, 100, 5, 1, 1300, 'blablabla', 'blablabla', 'blablabla', 'Ananda', 'Jalan XX', '087731492139', 'ananda@gmail.com', 'blablabla', 0.5, 2),
(2, 'RUMAH XY', 'Jalan X', 120, 100, 5, 1, 1300, 'blablabla', 'blablabla', 'blablabla', 'Ananda', 'Jalan XX', '087731492139', 'ananda@gmail.com', 'blablabla', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE products (
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
  `contactPerson` varchar(15) NOT NULL,
  `property` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO products (id, name, price, location, facility, document, lt, lb, status, productCondition, contactPerson, property) VALUES
(24, 'Rumah X', '20000000000', 'Dki Jakarta', '<ul><li>Lengkap</li><li>Kamar mandi UwU</li></ul>', '<p><strong>GoOOOOKS </strong>lah pokoknya</p>', 2000, 1500, 1, 1, '087731492139', 1),
(27, 'RUMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', '3000000', 'Aceh', '<ol><li>UwU</li></ol>', '<ul><li>UwU</li></ul>', 200, 100, 1, 2, '088888888', 6),
(28, 'Rumah A', '1230000', 'Bali', '<ul><li>Lengkap</li><li>Kamar mandi UwU</li></ul>', '<p><strong>GoOOOOKS </strong>lah pokoknya</p>', 340, 240, 1, 2, '087777777', 4),
(29, 'Rumah Aawdwa', '21511252', 'Jawa Tengah', '<ul><li>Lengkap</li><li>Kamar mandi UwU</li></ul>', '<p><strong>GoOOOOKS </strong>lah pokoknya</p>', 3400, 2402, 1, 1, '087777777', 3);

-- --------------------------------------------------------

--
-- Table structure for table `products_image`
--

CREATE TABLE products_image (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_image`
--

INSERT INTO products_image (id, product_id, image) VALUES
(116, 24, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.9132649987653556_1lwqt9n10wr4u0r2rcjq20ttg.jpg?alt=media&token=154d416b-ba3d-4cbb-97cc-56b36955a736'),
(117, 24, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.6476843970566972_9c9a4b904adf1a182ae8e0b76dee57d1.jpg?alt=media&token=186f5b15-7a4f-4856-b1f6-4e85a2ab7f00'),
(118, 24, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.5099429596616523_102662945_1520033738158299_2196670815983068892_o.png?alt=media&token=b35cac27-a4e1-4ce8-8d6c-62d615f3c619'),
(119, 24, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.7955200240385629_a90ee4a13dd990b8d47b6c112a4f9368.jpg?alt=media&token=6e70854c-cdfb-40d8-af68-b12cccf89aeb'),
(120, 24, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.8497241140825598_EZa8mSvUEAE_WXe.png?alt=media&token=ac3dc246-ddb7-4063-a173-4648eee2809b'),
(121, 24, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.6671008772697617_EZa8mSwU8AEn0Hf.png?alt=media&token=6186c75a-1226-4561-a53e-07a7c5a56d24'),
(122, 27, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.9124915530148867_wallpaperflare.com_wallpaper%20(2).jpg?alt=media&token=fd4aa269-45dc-422e-8bb1-0e21e6f353b7'),
(123, 27, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.8918513473126792_181004jamusic1.jpg?alt=media&token=b917f540-0d78-4950-8bf2-ab73252fe8c4'),
(124, 27, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.4023696667983081_4f9b849c154dd052b9654930ccbe3ead_a06a87b565388be32d5d54e89eb532ed_raw.jpg?alt=media&token=5c1795fb-67cf-4989-9d3e-4049f8c8d9e0'),
(125, 28, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.6476843970566972_9c9a4b904adf1a182ae8e0b76dee57d1.jpg?alt=media&token=186f5b15-7a4f-4856-b1f6-4e85a2ab7f00'),
(126, 28, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F75179908_1546826298819508_5727173158516613761_n.jpg?alt=media&token=88d45cc1-d2d6-4d35-a9e7-e670a4b5517b'),
(129, 29, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.24853069295596253_IMG_20200629_081138.jpg?alt=media&token=8eef300b-e90c-46a7-8225-529a3461854d'),
(130, 29, 'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/product%2F0.5016741802159155_duckime.png?alt=media&token=a51bcf18-b1f3-4c01-bd63-bfd004c680b6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent`
--
ALTER TABLE agent
  ADD PRIMARY KEY (id);

--
-- Indexes for table `article`
--
ALTER TABLE article
  ADD PRIMARY KEY (id);

--
-- Indexes for table `mitra`
--
ALTER TABLE mitra
  ADD PRIMARY KEY (id);

--
-- Indexes for table `products`
--
ALTER TABLE products
  ADD PRIMARY KEY (id);

--
-- Indexes for table `products_image`
--
ALTER TABLE products_image
  ADD PRIMARY KEY (id),
  ADD KEY product_id (product_id);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent`
--
ALTER TABLE agent
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE article
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE mitra
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE products
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products_image`
--
ALTER TABLE products_image
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products_image`
--
ALTER TABLE products_image
  ADD CONSTRAINT products_image_ibfk_1 FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
