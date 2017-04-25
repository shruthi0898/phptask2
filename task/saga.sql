-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2017 at 05:57 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saga`
--

-- --------------------------------------------------------

--
-- Table structure for table `images1`
--

CREATE TABLE `images1` (
  `id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `path_org` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images1`
--

INSERT INTO `images1` (`id`, `path`, `path_org`) VALUES
(1, '', 'imgorg/25-04-2017-1493135450.jpeg'),
(2, '', 'imgorg/25-04-2017-1493135486.jpeg'),
(3, '', 'imgorg/25-04-2017-1493135530.jpeg'),
(4, '', 'imgorg/25-04-2017-1493135574.jpeg'),
(5, 'img/25-04-2017-1493135617.jpeg', 'imgorg/25-04-2017-1493135609.jpeg'),
(6, '', 'imgorg/25-04-2017-1493135667.jpeg'),
(7, 'img/25-04-2017-1493135751.jpeg', 'imgorg/25-04-2017-1493135746.jpeg'),
(8, 'img/25-04-2017-1493135829.jpeg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images1`
--
ALTER TABLE `images1`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images1`
--
ALTER TABLE `images1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
