-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2023 at 08:24 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthsupport`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `hospital` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`hospital`, `email`, `pass`) VALUES
('National Institute of Neurosciences & Hospital', 'nit@gmail.com', '12345'),
('Popular Diagnostic Center, Kushtia', 'popular@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `chamber_day`
--

CREATE TABLE `chamber_day` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `start` time DEFAULT NULL,
  `end` time DEFAULT NULL,
  `Saturday` varchar(255) DEFAULT NULL,
  `Sunday` varchar(255) DEFAULT NULL,
  `Monday` varchar(255) DEFAULT NULL,
  `Tuesday` varchar(255) DEFAULT NULL,
  `Wednesday` varchar(255) DEFAULT NULL,
  `Thursday` varchar(255) DEFAULT NULL,
  `Friday` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chamber_day`
--

INSERT INTO `chamber_day` (`id`, `name`, `start`, `end`, `Saturday`, `Sunday`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`) VALUES
(18, 'Dr. Sanjoy Sahaa', '08:00:00', '12:00:00', '1', '0', '0', '1', '1', '1', '1'),
(20, 'Dr. Sanjoy Sah11', '08:00:00', '10:00:00', '0', '1', '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `Id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `speciality` varchar(255) DEFAULT NULL,
  `chamber` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `visit` varchar(255) DEFAULT NULL,
  `search` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`Id`, `image`, `name`, `speciality`, `chamber`, `time`, `visit`, `search`) VALUES
(18, '', 'Dr. Sanjoy Sahaa', 'medicine', 'National Institute of Neurosciences & Hospital', '8:00:00-12:00:00', '1000', 'Medicine'),
(20, '', 'Dr. Sanjoy Sah11', 'surgon', 'Popular Diagnostic Center, Kushtia', '(Sunday-Friday) 8:00:00AM-10:00:00PM', '1000', 'General Surgery');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `expiry_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`email`, `token`, `expiry_time`) VALUES
('piudassaikat@gmail.com', 'a46d706952b36043892f40c0239207e5c3390df66940be82c1', '1686411596'),
('amdadul@gmail.com', 'd1b078ae50c3f909604d79b141ecb43013fdabe22976936913', '1686411611'),
('piudassaikat@gmail.com', '48f160a79e30e9f9ebbda22deb551978f0e9724498d3fe964d', '1686411692'),
('anik@gmail.com', 'af6efeb4e0a4bee0b3aca10fde9789d5240e95567795fab9a3', '1686411851');

-- --------------------------------------------------------

--
-- Table structure for table `total_visit`
--

CREATE TABLE `total_visit` (
  `Id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `chamber` varchar(50) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `Saturday` varchar(10) NOT NULL,
  `Sunday` int(10) NOT NULL,
  `Monday` int(10) NOT NULL,
  `Tuesday` int(10) NOT NULL,
  `Wednesday` int(10) NOT NULL,
  `Thursday` int(10) NOT NULL,
  `Friday` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `total_visit`
--

INSERT INTO `total_visit` (`Id`, `name`, `chamber`, `start`, `end`, `Saturday`, `Sunday`, `Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`) VALUES
(18, 'Dr. Sanjoy Sahaa', 'National Institute of Neurosciences & Hospital', '08:00:00', '12:00:00', '0', 0, 0, 0, 0, 0, 0),
(20, 'Dr. Sanjoy Sah11', 'Popular Diagnostic Center, Kushtia', '08:00:00', '10:00:00', '0', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(50) NOT NULL,
  `age` int(6) NOT NULL,
  `nid` int(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `age`, `nid`, `email`, `pass`, `phone`) VALUES
('anik', 56456, 456456, 'piudas64564saikat@gmail.com', '64564646', 1753154061),
('rafi', 54645646, 4564566, 'piudass546456546aikat@gmail.co', '54646556645', 1753154061),
('amdadul', 12332, 4546, 'piudassa546546ikat@gmail.com', '12231', 1753154061),
('Piu Das Sarkit Saikat', 456, 123123, 'piudassaikat1@gmail.com', '123', 1753154061),
('tamim', 12, 12222, 'piudassaikat2@gmail.com', '123', 1753154061),
('Piu Das Sarkit Saikat', 1234, 12345, 'piudassaikat@gmail.com', '123', 1753154061),
('Piu Das Sarkit Saikat', 565, 546, 'piudassfdgfgaikat@gmail.com', 'fdggdf', 1753154061);

-- --------------------------------------------------------

--
-- Table structure for table `user-ticket`
--

CREATE TABLE `user-ticket` (
  `email` varchar(50) NOT NULL,
  `doctor-id` int(50) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `payment` int(50) NOT NULL,
  `trxid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `chamber_day`
--
ALTER TABLE `chamber_day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `total_visit`
--
ALTER TABLE `total_visit`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `total_visit`
--
ALTER TABLE `total_visit`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chamber_day`
--
ALTER TABLE `chamber_day`
  ADD CONSTRAINT `chamber_day_ibfk_1` FOREIGN KEY (`id`) REFERENCES `doctor` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
