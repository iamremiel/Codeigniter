-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2016 at 11:47 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vtour`
--

-- --------------------------------------------------------

--
-- Table structure for table `amounts`
--

CREATE TABLE IF NOT EXISTS `amounts` (
`id` int(11) NOT NULL,
  `hash` text NOT NULL,
  `amount` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amounts`
--

INSERT INTO `amounts` (`id`, `hash`, `amount`, `created_date`, `updated_date`) VALUES
(12, 'IB6EJzLhSKQM89vf', 100, '2016-01-14 00:00:00', '2016-01-14 06:26:47'),
(13, 'IB6EJzLhSKQM89vf', 200, '2016-01-14 00:00:00', '2016-01-14 06:26:58'),
(14, 'IB6EJzLhSKQM89vf', 100, '2016-01-14 00:00:00', '2016-01-14 06:56:25'),
(15, 'QRagUlmsy98oLEJO', 100, '2016-01-14 00:00:00', '2016-01-14 08:51:48'),
(16, 'QRagUlmsy98oLEJO', 100, '2016-01-18 00:00:00', '2016-01-18 07:29:43'),
(17, 'QRagUlmsy98oLEJO', 100, '2016-01-18 00:00:00', '2016-01-18 07:29:56');

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE IF NOT EXISTS `credentials` (
`id` int(11) NOT NULL,
  `hash` text NOT NULL,
  `email` text NOT NULL,
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`id`, `hash`, `email`, `user`, `pass`, `created_date`, `updated_date`) VALUES
(1, 'g%hy6u7ji89oik9', 'iamremiel@gmail.com', 'Remmar, Moroscallo', 'KNthBe6DZsQCQRqWbNJ79rjg0n4d/bPpj4vN06bypeIDCWenBKZkx8ydMIm7k2azaZbtDpAWIzTqLFi1w6woyw==', '2015-11-20 00:00:00', '2015-11-20 05:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `panoramas`
--

CREATE TABLE IF NOT EXISTS `panoramas` (
`id` int(11) NOT NULL,
  `hash` text NOT NULL,
  `name` text NOT NULL,
  `link` text NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `panoramas`
--

INSERT INTO `panoramas` (`id`, `hash`, `name`, `link`, `created_date`, `updated_date`) VALUES
(1, '', 'pano_1_left.jpg,pano_1_front.jpg,pano_1_right.jpg', 'example/28/pano_1_left.jpg', '2015-11-20 00:00:00', '2015-11-20 03:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `ternuhan`
--

CREATE TABLE IF NOT EXISTS `ternuhan` (
`id` int(11) NOT NULL,
  `hash` text NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `picture` text NOT NULL,
  `picture_thumb` text NOT NULL,
  `amount` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ternuhan`
--

INSERT INTO `ternuhan` (`id`, `hash`, `name`, `email`, `picture`, `picture_thumb`, `amount`, `created_date`, `updated_date`) VALUES
(54, 'IB6EJzLhSKQM89vf', 'Remmar Moroscallo ', '', 'icon-17.png', 'icon-17_thumb.png', 400, '2016-01-14', '2016-01-19 10:41:52'),
(55, 'QRagUlmsy98oLEJO', 'Marge Ranola ', '', 'icon-2.png', 'icon-2_thumb.png', 200, '2016-01-14', '2016-01-19 10:42:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amounts`
--
ALTER TABLE `amounts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panoramas`
--
ALTER TABLE `panoramas`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ternuhan`
--
ALTER TABLE `ternuhan`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amounts`
--
ALTER TABLE `amounts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `panoramas`
--
ALTER TABLE `panoramas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ternuhan`
--
ALTER TABLE `ternuhan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
