-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2018 at 08:26 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lotus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@lotus.com', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `name_ar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name_en`, `name_ar`) VALUES
(8, 'dhglordjho', 'قاهىتفبخهتاق5ب9'),
(9, 'sdhfjhft', 'سبيشلثسيا'),
(10, 'dfgsehtdfAdf', 'يلءىؤبلبئسثبيب'),
(11, 'jhnftjdhd', 'يباليقبتبلاءيث');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dateOfOrder` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product`, `user`, `quantity`, `dateOfOrder`) VALUES
(1, 31, 26, 5, '2018-08-08 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_ar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_ingredient_ar` varchar(570) NOT NULL,
  `properties_ar` varchar(570) NOT NULL,
  `features_ar` varchar(570) NOT NULL,
  `active_ingredient` varchar(570) NOT NULL,
  `properties` varchar(570) NOT NULL,
  `features` varchar(570) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `name_ar`, `active_ingredient_ar`, `properties_ar`, `features_ar`, `active_ingredient`, `properties`, `features`, `image`, `video`, `visible`, `category`) VALUES
(30, 'gsdggqagdsh', 'بيانبلنتاسيات', '', '', '', '', '', '', '2538_24-07-2018_36988999_2119909684934636_809574526110138368_n.jpg', 'QW-XHbEVmbk', 0, 10),
(31, 'n', 's', 's', 's', 's', '4', '4', '4', '4', '4', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `rate_of_use`
--

CREATE TABLE `rate_of_use` (
  `id` int(11) NOT NULL,
  `crops` int(11) NOT NULL,
  `controlled_pest` varchar(570) COLLATE utf8_unicode_ci NOT NULL,
  `rate_of_use` varchar(570) COLLATE utf8_unicode_ci NOT NULL,
  `phi` varchar(570) COLLATE utf8_unicode_ci NOT NULL,
  `crops_ar` varchar(570) COLLATE utf8_unicode_ci NOT NULL,
  `controlled_pest_ar` varchar(570) COLLATE utf8_unicode_ci NOT NULL,
  `rate_of_use_ar` varchar(570) COLLATE utf8_unicode_ci NOT NULL,
  `phi_ar` varchar(570) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rate_of_use`
--

INSERT INTO `rate_of_use` (`id`, `crops`, `controlled_pest`, `rate_of_use`, `phi`, `crops_ar`, `controlled_pest_ar`, `rate_of_use_ar`, `phi_ar`, `product_id`) VALUES
(1, 4, '4', '4', '4', '4', '4', '4', '4', 30);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `block` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `gender`, `picture`, `link`, `phone`, `password`, `block`) VALUES
(24, 'lotus', NULL, 'Abdullah', 'Tarek', 'abdallah@lotas.com', 'Male', '4943_21-07-2018_36278650_1762835880474868_4305623109861376000_n.jpg', '', '01013648201', '1234', 0),
(26, 'google', '111526412264331119039', 'Abdallah', 'Tarek', 'abdallahtarekrashad@gmail.com', 'male', 'https://lh4.googleusercontent.com/-DNsuhHUTdXw/AAAAAAAAAAI/AAAAAAAAAxk/JjhsdVl_fok/photo.jpg', 'https://plus.google.com/111526412264331119039', NULL, NULL, 0),
(28, 'facebook', '1872837129444422', 'Abdallah', 'Tarek', 'abdallahtarekrashad@gmail.com', 'male', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=1872837129444422&height=200&width=200&ext=1532726846&hash=AeTGWnxvet6jD25r', 'https://www.facebook.com/app_scoped_user_id/YXNpZADpBWEhnNFN2MGt4WnFiQnVaWWpmdjh3ZAk81dllPU0F0RU9WR0hrMlhsQVZApaG5sa09Bem5FSjlUZAktBZAnJTQmZAYOUk5WGNyT085aTdDUFZA3Nk9XWnd4YmtuSnNwa1F6V29ZAQUNGemxpUmVqSEFsV2g0/', NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserId` (`user`),
  ADD KEY `ProductId` (`product`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CategoryId` (`category`);

--
-- Indexes for table `rate_of_use`
--
ALTER TABLE `rate_of_use`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rate_of_use_ibfk_1` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `rate_of_use`
--
ALTER TABLE `rate_of_use`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `ProductId` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserId` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `CategoryId` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rate_of_use`
--
ALTER TABLE `rate_of_use`
  ADD CONSTRAINT `rate_of_use_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
