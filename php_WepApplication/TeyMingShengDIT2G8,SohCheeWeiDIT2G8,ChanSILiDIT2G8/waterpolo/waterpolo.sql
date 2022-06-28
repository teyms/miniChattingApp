-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2019 at 04:46 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `waterpolo`
--

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `pTeam` varchar(15) NOT NULL,
  `Pcategory` char(2) NOT NULL,
  `Pname` varchar(30) NOT NULL,
  `Pic` varchar(12) NOT NULL,
  `Ptshirt` varchar(5) NOT NULL,
  `Pfood` char(1) NOT NULL,
  `RegisterId` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `RegisterId` int(10) NOT NULL,
  `RegisterName` varchar(30) NOT NULL,
  `RegisterGender` char(1) NOT NULL,
  `RegisterEmail` varchar(60) NOT NULL,
  `Type` int(1) NOT NULL DEFAULT 0,
  `User` varchar(50) NOT NULL,
  `Pass` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`RegisterId`, `RegisterName`, `RegisterGender`, `RegisterEmail`, `Type`, `User`, `Pass`) VALUES
(1, 'Tey Ming Sheng', 'M', 'teymingsheng@gmail.com', 1, 'teymingsheng', 'q123456'),
(2, 'Soh Chee Wei', 'M', 'sohcheewei@gmail.com', 0, 'sohcheewei', 'q123456'),
(3, 'Chan Si Li', 'M', 'chauguanhin@gmail.com', 0, 'chansili', 'q123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`Pic`),
  ADD KEY `RegisterId` (`RegisterId`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`RegisterId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `RegisterId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
