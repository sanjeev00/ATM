-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 12, 2019 at 04:32 PM
-- Server version: 8.0.12
-- PHP Version: 7.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atm`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `cardno` varchar(20) NOT NULL,
  `accno` varchar(20) NOT NULL,
  `ifsc` varchar(15) NOT NULL,
  `balance` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`cardno`, `accno`, `ifsc`, `balance`) VALUES
('8888', '1024', 'ACD123', 60015);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bankname` varchar(30) NOT NULL,
  `ifsc` varchar(15) NOT NULL,
  `branchname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `cardno` varchar(20) NOT NULL,
  `timeof` datetime NOT NULL,
  `amount` int(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`cardno`, `timeof`, `amount`, `type`, `id`) VALUES
('8888', '2019-10-11 20:48:07', 5, 'withdraw', 1),
('8888', '2019-10-11 20:48:19', 5, 'withdraw', 2),
('8888', '2019-10-11 20:48:28', 5, 'withdraw', 3),
('8888', '2019-10-11 21:05:14', 20, 'deposit', 4),
('8888', '2019-10-11 21:05:37', 20000, 'deposit', 5),
('8888', '2019-10-12 13:50:24', 20000, 'withdraw', 8),
('8888', '2019-10-12 14:31:39', 0, 'deposit', 17),
('8888', '2019-10-12 14:31:45', 0, 'deposit', 18),
('8888', '2019-10-12 14:34:18', 1, 'deposit', 19),
('8888', '2019-10-12 14:55:12', 20, 'withdraw', 20);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `cardno` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `age` int(5) NOT NULL,
  `pin` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`cardno`, `fname`, `age`, `pin`) VALUES
('8888', '', 0, '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`cardno`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`ifsc`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`cardno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
