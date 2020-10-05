-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2020 at 07:57 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pindb`
--
CREATE DATABASE IF NOT EXISTS `pindb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pindb`;

-- --------------------------------------------------------

--
-- Table structure for table `tblaccount`
--

CREATE TABLE `tblaccount` (
  `aId` bigint(255) NOT NULL,
  `accountNumber` bigint(255) NOT NULL,
  `accountBalance` float NOT NULL,
  `aCurrency` varchar(255) NOT NULL,
  `aUserEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblaccount`
--

INSERT INTO `tblaccount` (`aId`, `accountNumber`, `accountBalance`, `aCurrency`, `aUserEmail`) VALUES
(1, 199600000000, 316824, 'LKR', 'nimesh.ekanayaka7@gmail.com'),
(6, 199600000001, 44672.8, 'LKR', 'lahiruthivankara@gmail.com'),
(32, 199600000002, 0, 'LKR', 'nimesh@edvicon.org'),
(33, 199600000003, 0, 'LKR', 'bhanuka@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbliptracking`
--

CREATE TABLE `tbliptracking` (
  `trID` bigint(255) NOT NULL,
  `trIp` varchar(100) NOT NULL,
  `trRegion` varchar(255) NOT NULL,
  `trCountry` varchar(5) NOT NULL,
  `trLocation` varchar(50) NOT NULL,
  `trTime` datetime NOT NULL,
  `trAccountNumber` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbliptracking`
--

INSERT INTO `tbliptracking` (`trID`, `trIp`, `trRegion`, `trCountry`, `trLocation`, `trTime`, `trAccountNumber`) VALUES
(2, '182.161.27.211', 'Western', 'LK', '6.9355,79.8487', '2020-05-16 17:49:45', 199600000000),
(3, '182.161.27.211', 'Western', 'LK', '6.9355,79.8487', '2020-05-16 17:50:01', 199600000000),
(4, '182.161.27.251', 'Western', 'LK', '6.9355,79.8487', '2020-05-16 17:50:57', 199600000000),
(9, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-05-13 10:08:52', 199600000000),
(14, '65.49.22.66', 'California', 'US', '37.5483,-121.9886', '2020-05-16 18:27:56', 199600000000),
(15, '65.49.22.66', 'California', 'US', '37.5483,-121.9886', '2020-05-16 18:29:12', 199600000000),
(16, '199.161.27.25', 'Virginia', 'US', '38.8318,-77.2888', '2020-05-16 06:30:45', 199600000000),
(18, '182.161.27.251', 'Western', 'LK', '6.9355,79.8487', '2020-05-16 18:32:18', 199600000000),
(19, '182.161.27.251', 'Western', 'LK', '6.9355,79.8487', '2020-05-16 18:50:18', 199600000000),
(20, '182.161.27.251', 'Western', 'LK', '6.9355,79.8487', '2020-05-16 18:51:26', 199600000000),
(21, '182.161.27.251', 'Western', 'LK', '6.9355,79.8487', '2020-05-16 18:51:42', 199600000000),
(22, '182.161.27.251', 'Western', 'LK', '6.9355,79.8487', '2020-05-16 18:52:30', 199600000001),
(23, '182.161.27.251', 'Western', 'LK', '6.9355,79.8487', '2020-05-16 19:07:26', 199600000000),
(24, '182.161.27.251', 'Western', 'LK', '6.9355,79.8487', '2020-06-06 06:43:35', 199600000000),
(26, '182.161.27.251', 'Western', 'LK', '6.9355,79.8487', '2020-06-06 14:51:04', 199600000000),
(27, '182.161.27.251', 'Western', 'LK', '6.9355,79.8487', '2020-06-06 14:54:32', 199600000000),
(28, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-06-06 15:01:10', 199600000000),
(29, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-06-06 15:01:40', 199600000000),
(30, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-06-06 15:02:27', 199600000000),
(31, '182.161.27.251', 'Western', 'LK', '6.9355,79.8487', '2020-06-06 15:02:56', 199600000000),
(32, '182.161.27.251', 'Western', 'LK', '6.9355,79.8487', '2020-06-06 15:03:11', 199600000000),
(33, '182.161.27.251', 'Western', 'LK', '6.9355,79.8487', '2020-06-06 15:18:49', 199600000000),
(34, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-06-06 15:19:33', 199600000000),
(35, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-06-06 15:20:35', 199600000000),
(36, '199.161.27.251', '', '', '', '2020-08-22 12:21:02', 199600000000),
(37, '199.161.27.251', '', '', '', '2020-08-22 12:28:15', 199600000000),
(38, '199.161.27.251', '', '', '', '2020-08-22 12:29:18', 199600000001),
(39, '199.161.27.251', '', '', '', '2020-08-22 12:35:17', 199600000000),
(40, '199.161.27.251', '', '', '', '2020-08-22 12:42:45', 199600000000),
(41, '199.161.27.251', '', '', '', '2020-08-22 12:51:24', 199600000000),
(42, '199.161.27.251', '', '', '', '2020-08-22 12:59:28', 199600000001),
(43, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-22 20:36:59', 199600000000),
(44, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-22 20:37:48', 199600000000),
(45, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-22 20:39:26', 199600000000),
(46, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-22 21:31:31', 199600000002),
(47, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-22 21:32:18', 199600000002),
(48, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-22 21:34:58', 199600000002),
(49, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-22 21:35:27', 199600000002),
(50, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-22 21:35:57', 199600000002),
(51, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-22 21:39:37', 199600000002),
(52, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-22 21:41:12', 199600000002),
(53, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-23 07:43:05', 199600000002),
(54, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-23 07:45:21', 199600000000),
(55, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-23 10:47:42', 199600000000),
(56, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-23 11:05:04', 199600000000),
(57, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-23 12:47:54', 199600000000),
(58, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-23 20:53:16', 199600000001),
(59, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-23 20:53:51', 199600000001),
(60, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-23 21:04:33', 199600000001),
(61, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-23 21:21:06', 199600000002),
(62, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-24 05:07:28', 199600000002),
(63, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-24 06:22:17', 199600000002),
(64, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-24 06:24:25', 199600000000),
(65, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-08-24 06:25:51', 199600000002),
(66, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 16:08:29', 199600000002),
(67, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 17:55:53', 199600000002),
(68, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 17:57:19', 199600000002),
(69, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 17:57:47', 199600000000),
(70, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 18:10:56', 199600000002),
(71, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 18:11:41', 199600000000),
(72, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 18:16:41', 199600000002),
(73, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 18:17:56', 199600000000),
(74, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 18:48:57', 199600000000),
(75, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 18:57:13', 199600000000),
(76, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 18:58:52', 199600000002),
(77, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 18:59:21', 199600000000),
(78, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 19:00:48', 199600000002),
(79, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 19:01:13', 199600000000),
(80, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 19:05:18', 199600000002),
(81, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 19:08:49', 199600000000),
(82, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 19:39:00', 199600000002),
(83, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 20:52:09', 199600000000),
(84, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-16 21:04:00', 199600000002),
(85, '199.161.27.251', '', '', '', '2020-09-16 21:09:53', 199600000001),
(86, '199.161.27.251', '', '', '', '2020-09-16 21:11:26', 199600000002),
(87, '199.161.27.251', '', '', '', '2020-09-16 21:13:14', 199600000002),
(88, '199.161.27.251', '', '', '', '2020-09-16 21:13:56', 199600000001),
(89, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-17 14:50:52', 199600000002),
(90, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-17 14:58:35', 199600000000),
(91, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-17 14:58:58', 199600000002),
(92, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-17 17:44:43', 199600000000),
(93, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-17 17:46:30', 199600000000),
(94, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-17 17:49:52', 199600000000),
(95, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-17 17:51:34', 199600000000),
(96, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-17 17:58:09', 199600000002),
(97, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-17 17:58:36', 199600000000),
(98, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-17 18:12:34', 199600000001),
(99, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-17 18:24:58', 199600000001),
(100, '199.161.27.251', 'Virginia', 'US', '38.8318,-77.2888', '2020-09-17 19:41:23', 199600000000);

-- --------------------------------------------------------

--
-- Table structure for table `tblmessage`
--

CREATE TABLE `tblmessage` (
  `mId` int(11) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `email` varchar(100) NOT NULL,
  `lName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmessage`
--

INSERT INTO `tblmessage` (`mId`, `message`, `email`, `lName`) VALUES
(73, 'b', 'nimesh.ekanayaka7@gmail.com', 'Ekanayake'),
(74, 'c', 'nimesh.ekanayaka7@gmail.com', 'Admin'),
(77, 'I\'m Nimesh,', 'lahiruthivankara@gmail.com', 'Admin'),
(78, 'h', 'lahiruthivankara@gmail.com', 'Chamod'),
(79, 'h', 'lahiruthivankara@gmail.com', 'Admin'),
(80, 'e', 'lahiruthivankara@gmail.com', 'Chamod'),
(81, 'hi', 'lahiruthivankara@gmail.com', 'Admin'),
(82, 'check1', 'lahiruthivankara@gmail.com', 'Chamod'),
(83, 'hi', 'nimesh.ekanayaka7@gmail.com', 'Ekanayake'),
(84, 'h', 'nimesh.ekanayaka7@gmail.com', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbltransactions`
--

CREATE TABLE `tbltransactions` (
  `tId` bigint(255) NOT NULL,
  `tType` varchar(100) NOT NULL,
  `tDate` datetime NOT NULL DEFAULT current_timestamp(),
  `tDescription` varchar(255) NOT NULL,
  `tAccountType` varchar(100) NOT NULL,
  `tAmount` float NOT NULL,
  `tBalance` float NOT NULL,
  `tAccountNumber` bigint(255) NOT NULL,
  `notStatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltransactions`
--

INSERT INTO `tbltransactions` (`tId`, `tType`, `tDate`, `tDescription`, `tAccountType`, `tAmount`, `tBalance`, `tAccountNumber`, `notStatus`) VALUES
(94, 'Receive', '2019-12-13 14:44:39', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 20, 447.8, 199600000001, 0),
(95, 'Send', '2019-12-13 14:44:39', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 20, 447.8, 199600000000, 0),
(96, 'Receive', '2019-12-13 14:44:51', 'Received LKR  10.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 2', 'PRA', 10, 457.8, 199600000001, 0),
(97, 'Send', '2019-12-13 14:44:51', 'Transfered LKR  10.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 2', 'PRA', 10, 457.8, 199600000000, 0),
(98, 'Receive', '2019-12-13 14:44:59', 'Received LKR  80.50 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 3', 'PRA', 80.5, 538.3, 199600000001, 0),
(99, 'Send', '2019-12-13 14:44:59', 'Transfered LKR  80.50 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 3', 'PRA', 80.5, 538.3, 199600000000, 0),
(100, 'Receive', '2019-12-13 14:45:09', 'Received LKR  20.50 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 4', 'PRA', 20.5, 558.8, 199600000001, 0),
(101, 'Send', '2019-12-13 14:45:09', 'Transfered LKR  20.50 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 4', 'PRA', 20.5, 558.8, 199600000000, 0),
(102, 'Receive', '2019-12-13 14:50:26', 'Received LKR  10.80 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 5', 'PRA', 10.8, 569.6, 199600000001, 0),
(103, 'Send', '2019-12-13 14:50:26', 'Transfered LKR  10.80 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 5', 'PRA', 10.8, 569.6, 199600000000, 0),
(104, 'Receive', '2019-12-13 14:50:52', 'Received LKR  70.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 6', 'PRA', 70, 639.6, 199600000001, 0),
(105, 'Send', '2019-12-13 14:50:52', 'Transfered LKR  70.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 6', 'PRA', 70, 639.6, 199600000000, 0),
(150, 'Receive', '2019-12-13 16:29:49', 'Received LKR  10.00 from card 1111222233336666<br> to card 5555666644447777. <br>: Test 1', 'VC2', 10, 120, 199600000000, 0),
(151, 'Send', '2019-12-13 16:29:49', 'Transfered LKR  10.00 to card 5555666644447777<br> from card 1111222233336666. <br>: Test 1', 'VC1', 10, 130, 199600000000, 0),
(152, 'Receive', '2019-12-13 16:30:06', 'Received LKR  20.00 from card 5555666644447777<br> to card 9999888811112222. <br>: Test 2', 'VC3', 20, 940, 199600000000, 0),
(153, 'Send', '2019-12-13 16:30:06', 'Transfered LKR  20.00 to card 9999888811112222<br> from card 5555666644447777. <br>: Test 2', 'VC2', 20, 100, 199600000000, 0),
(154, 'Receive', '2019-12-13 16:30:20', 'Received LKR  50.00 from card 9999888811112222<br> to card 1111222233336666. <br>: Test 3', 'VC1', 50, 180, 199600000000, 0),
(155, 'Send', '2019-12-13 16:30:20', 'Transfered LKR  50.00 to card 1111222233336666<br> from card 9999888811112222. <br>: Test 3', 'VC3', 50, 890, 199600000000, 0),
(192, 'Receive', '2019-12-16 18:25:11', 'Received LKR  50.00 from card 1996783738763249<br> to card 1996887923448582. <br>: ', 'VC1', 50, 50, 199600000001, 0),
(193, 'Send', '2019-12-16 18:25:11', 'Transfered LKR  50.00 to card 1996887923448582<br> from card 1996783738763249. <br>: ', 'VC2', 50, 50, 199600000001, 0),
(202, 'Receive', '2019-12-17 17:23:53', 'Received LKR  50.00 from card 1996013724507648<br> to card 1996230935380243. <br>: Test 1', 'VC3', 50, 150, 199600000000, 0),
(203, 'Send', '2019-12-17 17:23:53', 'Transfered LKR  50.00 to card 1996230935380243<br> from card 1996013724507648. <br>: Test 1', 'VC2', 50, 960, 199600000000, 0),
(204, 'Receive', '2019-12-17 18:05:00', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 20, 869.6, 199600000001, 0),
(205, 'Send', '2019-12-17 18:05:00', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 20, 869.6, 199600000000, 0),
(206, 'Receive', '2019-12-17 18:05:26', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 20, 889.6, 199600000001, 0),
(207, 'Send', '2019-12-17 18:05:26', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 20, 889.6, 199600000000, 0),
(208, 'Receive', '2019-12-17 18:51:53', 'Received LKR  100.00 from account lahiruthivankara@gmail.com<br> to account nimesh.ekanayaka7@gmail.com. <br>: Test 5', 'PRA', 100, 120030, 199600000000, 0),
(209, 'Send', '2019-12-17 18:51:53', 'Transfered LKR  100.00 to account nimesh.ekanayaka7@gmail.com<br> from account lahiruthivankara@gmail.com. <br>: Test 5', 'PRA', 100, 120030, 199600000001, 0),
(210, 'Receive', '2019-12-17 18:58:16', 'Received LKR  50.00 from account lahiruthivankara@gmail.com<br> to account nimesh.ekanayaka7@gmail.com. <br>: Test 3', 'PRA', 50, 120080, 199600000000, 0),
(211, 'Send', '2019-12-17 18:58:16', 'Transfered LKR  50.00 to account nimesh.ekanayaka7@gmail.com<br> from account lahiruthivankara@gmail.com. <br>: Test 3', 'PRA', 50, 120080, 199600000001, 0),
(216, 'Receive', '2019-12-17 19:52:58', 'Received LKR  80.50 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 80.5, 840.1, 199600000001, 0),
(217, 'Send', '2019-12-17 19:52:58', 'Transfered LKR  80.50 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 80.5, 840.1, 199600000000, 0),
(232, 'Receive', '2019-12-25 08:01:52', 'Received LKR  10.00 from card 1996501047080921<br> to card 1996525523102356. <br>: Test 1', 'VC2', 10, 10980, 199600000000, 0),
(233, 'Send', '2019-12-25 08:01:52', 'Transfered LKR  10.00 to card 1996525523102356<br> from card 1996501047080921. <br>: Test 1', 'VC3', 10, 520, 199600000000, 0),
(234, 'Receive', '2019-12-25 08:04:33', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 20, 900.1, 199600000001, 0),
(235, 'Send', '2019-12-25 08:04:33', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 20, 900.1, 199600000000, 0),
(306, 'Receive', '2019-12-25 10:28:11', 'Received LKR  10.00 from card 1996501047080921<br> to card 1996525523102356. <br>: Test 2', 'VC2', 10, 10870, 199600000000, 0),
(307, 'Send', '2019-12-25 10:28:11', 'Transfered LKR  10.00 to card 1996525523102356<br> from card 1996501047080921. <br>: Test 2', 'VC3', 10, 740, 199600000000, 0),
(308, 'Receive', '2019-12-25 11:00:46', 'Received LKR 10.00 from account 199600000000<br> to account 1996501047080921. <br>: Test 1', '', 10, 750, 199600000000, 0),
(309, 'Send', '2019-12-25 11:00:46', 'Transfered LKR 10.00 to account 1996501047080921<br> from account 199600000000. <br>: Test 1', '', 10, 120930, 199600000000, 0),
(310, 'Receive', '2019-12-25 16:24:22', 'Received LKR  80.50 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 5', 'PRA', 80.5, 1100.6, 199600000001, 0),
(311, 'Send', '2019-12-25 16:24:22', 'Transfered LKR  80.50 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 5', 'PRA', 80.5, 1100.6, 199600000000, 0),
(312, 'Receive', '2019-12-25 16:00:19', 'Received LKR 10.50 from account 199600000000<br> to account 1996501047080921. <br>: Test 2', '', 10.5, 760.5, 199600000000, 0),
(313, 'Send', '2019-12-25 16:00:19', 'Transfered LKR 10.50 to account 1996501047080921<br> from account 199600000000. <br>: Test 2', '', 10.5, 120840, 199600000000, 0),
(314, 'Receive', '2019-12-25 16:25:55', 'Received LKR  1000.00 from card 1996525523102356<br> to card 1996930419264355. <br>: Test 1', 'VC3', 1000, 1000, 199600000000, 0),
(315, 'Send', '2019-12-25 16:25:55', 'Transfered LKR  1000.00 to card 1996930419264355<br> from card 1996525523102356. <br>: Test 1', 'VC2', 1000, 9870, 199600000000, 0),
(316, 'Receive', '2019-12-26 17:08:07', 'Received LKR  150.10 from account lahiruthivankara@gmail.com<br> to account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 150.1, 120990, 199600000000, 0),
(317, 'Send', '2019-12-26 17:08:07', 'Transfered LKR  150.10 to account nimesh.ekanayaka7@gmail.com<br> from account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 150.1, 120990, 199600000001, 0),
(324, 'Receive', '2019-12-27 17:54:48', 'Received LKR  10.80 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 2', 'PRA', 10.8, 971.3, 199600000001, 0),
(325, 'Send', '2019-12-27 17:54:48', 'Transfered LKR  10.80 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 2', 'PRA', 10.8, 971.3, 199600000000, 0),
(326, 'Receive', '2019-12-27 17:55:57', 'Received LKR  10.00 from account lahiruthivankara@gmail.com<br> to account nimesh.ekanayaka7@gmail.com. <br>: Test 4', 'PRA', 10, 120969, 199600000000, 0),
(327, 'Send', '2019-12-27 17:55:57', 'Transfered LKR  10.00 to account nimesh.ekanayaka7@gmail.com<br> from account lahiruthivankara@gmail.com. <br>: Test 4', 'PRA', 10, 120969, 199600000001, 0),
(346, 'Receive', '2019-12-28 10:01:51', 'Received LKR  80.50 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 5', 'PRA', 80.5, 1071.8, 199600000001, 0),
(347, 'Send', '2019-12-28 10:01:51', 'Transfered LKR  80.50 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 5', 'PRA', 80.5, 1071.8, 199600000000, 0),
(348, 'Receive', '2019-12-28 16:00:36', 'Received LKR 10.50 from account 199600000000<br> to account 1996930419264355. <br>: Test 1', '', 10.5, 1010.5, 199600000000, 0),
(349, 'Send', '2019-12-28 16:00:36', 'Transfered LKR 10.50 to account 1996930419264355<br> from account 199600000000. <br>: Test 1', '', 10.5, 120818, 199600000000, 0),
(350, 'Receive', '2019-12-28 16:00:44', 'Received LKR 10.00 from account 199600000000<br> to account 1996930419264355. <br>: Test 2', '', 10, 1020.5, 199600000000, 0),
(351, 'Send', '2019-12-28 16:00:44', 'Transfered LKR 10.00 to account 1996930419264355<br> from account 199600000000. <br>: Test 2', '', 10, 120808, 199600000000, 0),
(352, 'Receive', '2019-12-29 16:35:55', 'Received LKR  110.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 110, 1181.8, 199600000001, 0),
(353, 'Send', '2019-12-29 16:35:55', 'Transfered LKR  110.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 110, 1181.8, 199600000000, 0),
(354, 'Receive', '2020-01-02 16:05:18', 'Received LKR  70.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 70, 1251.8, 199600000001, 0),
(355, 'Send', '2020-01-02 16:05:18', 'Transfered LKR  70.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 70, 1251.8, 199600000000, 0),
(356, 'Receive', '2020-01-23 04:07:31', 'Received LKR  100.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 100, 1351.8, 199600000001, 0),
(357, 'Send', '2020-01-23 04:07:31', 'Transfered LKR  100.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 100, 1351.8, 199600000000, 0),
(358, 'Receive', '2020-02-18 03:21:47', 'Received LKR  100.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test', 'PRA', 100, 1451.8, 199600000001, 0),
(359, 'Send', '2020-02-18 03:21:47', 'Transfered LKR  100.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test', 'PRA', 100, 1451.8, 199600000000, 0),
(360, 'Receive', '2020-02-19 04:48:57', 'Received LKR  250.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test', 'PRA', 250, 1701.8, 199600000001, 0),
(361, 'Send', '2020-02-19 04:48:57', 'Transfered LKR  250.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test', 'PRA', 250, 1701.8, 199600000000, 0),
(362, 'Receive', '2020-02-19 04:51:40', 'Received LKR  10.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test', 'PRA', 10, 1711.8, 199600000001, 0),
(363, 'Send', '2020-02-19 04:51:40', 'Transfered LKR  10.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test', 'PRA', 10, 1711.8, 199600000000, 0),
(364, 'Receive', '2020-02-19 05:17:57', 'Received LKR  100.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 100, 1811.8, 199600000001, 0),
(365, 'Send', '2020-02-19 05:17:57', 'Transfered LKR  100.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 100, 1811.8, 199600000000, 0),
(366, 'Receive', '2020-02-19 05:18:36', 'Received LKR  500.00 from card 1996501047080921<br> to card 1996525523102356. <br>: ', 'VC2', 500, 10330, 199600000000, 0),
(367, 'Send', '2020-02-19 05:18:36', 'Transfered LKR  500.00 to card 1996525523102356<br> from card 1996501047080921. <br>: ', 'VC3', 500, 340.5, 199600000000, 0),
(368, 'Receive', '2020-02-19 05:00:02', 'Received LKR 10.00 from account 199600000000<br> to account 1996211389731938. <br>: ggh', '', 10, 10, 199600000000, 0),
(369, 'Send', '2020-02-19 05:00:02', 'Transfered LKR 10.00 to account 1996211389731938<br> from account 199600000000. <br>: ggh', '', 10, 121078, 199600000000, 0),
(370, 'Receive', '2020-02-19 05:44:36', 'Received LKR  525.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: jj', 'PRA', 525, 2336.8, 199600000001, 0),
(371, 'Send', '2020-02-19 05:44:36', 'Transfered LKR  525.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: jj', 'PRA', 525, 2336.8, 199600000000, 0),
(372, 'Receive', '2020-03-30 13:18:06', 'Received LKR  100.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 100, 2436.8, 199600000001, 0),
(373, 'Send', '2020-03-30 13:18:06', 'Transfered LKR  100.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 100, 2436.8, 199600000000, 0),
(374, 'Receive', '2020-04-10 07:38:55', 'Received LKR  100.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Review 1 test', 'PRA', 100, 2536.8, 199600000001, 0),
(375, 'Send', '2020-04-10 07:38:55', 'Transfered LKR  100.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Review 1 test', 'PRA', 100, 2536.8, 199600000000, 0),
(376, 'Receive', '2020-04-10 07:39:40', 'Received LKR  300.00 from card 1996501047080921<br> to card 1996525523102356. <br>: Test', 'VC2', 300, 10630, 199600000000, 0),
(377, 'Send', '2020-04-10 07:39:40', 'Transfered LKR  300.00 to card 1996525523102356<br> from card 1996501047080921. <br>: Test', 'VC3', 300, 40.5, 199600000000, 0),
(384, 'Receive', '2020-04-19 10:01:32', 'Received LKR 2323.00 from account 199600000000<br> to account 1996481243502433. <br>: sd', '', 2323, 2323, 199600000000, 0),
(385, 'Send', '2020-04-19 10:01:32', 'Transfered LKR 2323.00 to account 1996481243502433<br> from account 199600000000. <br>: sd', '', 2323, 128630, 199600000000, 0),
(386, 'Receive', '2020-04-19 10:01:23', 'Received LKR 10.00 from account 199600000000<br> to account 1996501047080921. <br>: ', '', 10, 70.5, 199600000000, 0),
(387, 'Send', '2020-04-19 10:01:23', 'Transfered LKR 10.00 to account 1996501047080921<br> from account 199600000000. <br>: ', '', 10, 128620, 199600000000, 0),
(388, 'Receive', '2020-04-19 10:19:44', 'Received LKR  10.00 from card 1996481243502433<br> to card 1996211389731938. <br>: ', 'VC3', 10, 20, 199600000000, 0),
(389, 'Send', '2020-04-19 10:19:44', 'Transfered LKR  10.00 to card 1996211389731938<br> from card 1996481243502433. <br>: ', 'VC3', 10, 2313, 199600000000, 0),
(390, 'Receive', '2020-04-19 10:20:03', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: ', 'PRA', 20, 2566.8, 199600000001, 0),
(391, 'Send', '2020-04-19 10:20:03', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: ', 'PRA', 20, 2566.8, 199600000000, 0),
(392, 'Receive', '2020-04-19 10:01:34', 'Received LKR 10.00 from account 199600000000<br> to account 1996211389731938. <br>: Test 1', '', 10, 30, 199600000000, 0),
(393, 'Send', '2020-04-19 10:01:34', 'Transfered LKR 10.00 to account 1996211389731938<br> from account 199600000000. <br>: Test 1', '', 10, 128590, 199600000000, 0),
(394, 'Receive', '2020-04-19 11:21:55', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: oo', 'PRA', 20, 2586.8, 199600000001, 0),
(395, 'Send', '2020-04-19 11:21:55', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: oo', 'PRA', 20, 2586.8, 199600000000, 0),
(396, 'Receive', '2020-04-19 11:32:20', 'Received LKR  23.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 23, 2609.8, 199600000001, 0),
(397, 'Send', '2020-04-19 11:32:20', 'Transfered LKR  23.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 23, 2609.8, 199600000000, 0),
(398, 'Receive', '2020-04-19 11:39:10', 'Received LKR  10.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: xx', 'PRA', 10, 2619.8, 199600000001, 0),
(399, 'Send', '2020-04-19 11:39:10', 'Transfered LKR  10.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: xx', 'PRA', 10, 2619.8, 199600000000, 0),
(400, 'Receive', '2020-04-19 11:52:05', 'Received LKR  1100.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 5', 'PRA', 1100, 3719.8, 199600000001, 0),
(401, 'Send', '2020-04-19 11:52:05', 'Transfered LKR  1100.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 5', 'PRA', 1100, 3719.8, 199600000000, 0),
(402, 'Receive', '2020-04-19 12:22:35', 'Received LKR  80.50 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: as', 'PRA', 80.5, 3800.3, 199600000001, 0),
(403, 'Send', '2020-04-19 12:22:35', 'Transfered LKR  80.50 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: as', 'PRA', 80.5, 3800.3, 199600000000, 0),
(404, 'Receive', '2020-04-19 12:24:25', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 20, 3820.3, 199600000001, 0),
(405, 'Send', '2020-04-19 12:24:25', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 20, 3820.3, 199600000000, 0),
(406, 'Receive', '2020-04-19 12:40:15', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: jjjj', 'PRA', 20, 3840.3, 199600000001, 0),
(407, 'Send', '2020-04-19 12:40:15', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: jjjj', 'PRA', 20, 3840.3, 199600000000, 0),
(408, 'Receive', '2020-04-19 12:44:44', 'Received LKR  20.00 from account lahiruthivankara@gmail.com<br> to account nimesh.ekanayaka7@gmail.com. <br>: zzz', 'PRA', 20, 127336, 199600000000, 0),
(409, 'Send', '2020-04-19 12:44:44', 'Transfered LKR  20.00 to account nimesh.ekanayaka7@gmail.com<br> from account lahiruthivankara@gmail.com. <br>: zzz', 'PRA', 20, 127336, 199600000001, 1),
(410, 'Receive', '2020-04-19 12:47:03', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: eee', 'PRA', 20, 3840.3, 199600000001, 0),
(411, 'Send', '2020-04-19 12:47:03', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: eee', 'PRA', 20, 3840.3, 199600000000, 1),
(412, 'Receive', '2020-04-19 12:47:30', 'Received LKR  20.00 from account lahiruthivankara@gmail.com<br> to account nimesh.ekanayaka7@gmail.com. <br>: pppp', 'PRA', 20, 127336, 199600000000, 0),
(413, 'Send', '2020-04-19 12:47:30', 'Transfered LKR  20.00 to account nimesh.ekanayaka7@gmail.com<br> from account lahiruthivankara@gmail.com. <br>: pppp', 'PRA', 20, 127336, 199600000001, 1),
(446, 'Receive', '2020-04-20 08:25:30', 'Received LKR  10.00 from account lahiruthivankara@gmail.com<br> to account nimesh.ekanayaka7@gmail.com. <br>: Test 4', 'PRA', 10, 127206, 199600000000, 0),
(447, 'Send', '2020-04-20 08:25:30', 'Transfered LKR  10.00 to account nimesh.ekanayaka7@gmail.com<br> from account lahiruthivankara@gmail.com. <br>: Test 4', 'PRA', 10, 127206, 199600000001, 1),
(448, 'Receive', '2020-04-20 08:30:57', 'Received LKR  100.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 100, 3980.3, 199600000001, 0),
(449, 'Send', '2020-04-20 08:30:57', 'Transfered LKR  100.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 100, 3980.3, 199600000000, 1),
(450, 'Receive', '2020-04-20 08:31:16', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 20, 4000.3, 199600000001, 0),
(451, 'Send', '2020-04-20 08:31:16', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 20, 4000.3, 199600000000, 1),
(452, 'Receive', '2020-04-20 08:41:12', 'Received LKR  100.00 from account lahiruthivankara@gmail.com<br> to account nimesh.ekanayaka7@gmail.com. <br>: Test', 'PRA', 100, 127186, 199600000000, 0),
(453, 'Send', '2020-04-20 08:41:12', 'Transfered LKR  100.00 to account nimesh.ekanayaka7@gmail.com<br> from account lahiruthivankara@gmail.com. <br>: Test', 'PRA', 100, 127186, 199600000001, 1),
(460, 'Receive', '2020-04-25 09:58:21', 'Received LKR  10.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 10, 3920.3, 199600000001, 0),
(461, 'Send', '2020-04-25 09:58:21', 'Transfered LKR  10.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 10, 3920.3, 199600000000, 1),
(462, 'Receive', '2020-04-25 10:01:33', 'Received LKR  11.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 11, 3931.3, 199600000001, 0),
(463, 'Send', '2020-04-25 10:01:33', 'Transfered LKR  11.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 11, 3931.3, 199600000000, 1),
(464, 'Receive', '2020-04-25 10:02:24', 'Received LKR  10.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 5', 'PRA', 10, 3941.3, 199600000001, 0),
(465, 'Send', '2020-04-25 10:02:24', 'Transfered LKR  10.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 5', 'PRA', 10, 3941.3, 199600000000, 1),
(466, 'Receive', '2020-04-25 10:02:40', 'Received LKR  12.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 12, 3953.3, 199600000001, 0),
(467, 'Send', '2020-04-25 10:02:40', 'Transfered LKR  12.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 12, 3953.3, 199600000000, 1),
(468, 'Receive', '2020-04-25 10:05:07', 'Received LKR  23.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 23, 3976.3, 199600000001, 0),
(469, 'Send', '2020-04-25 10:05:07', 'Transfered LKR  23.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 23, 3976.3, 199600000000, 1),
(470, 'Receive', '2020-04-25 10:06:16', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 20, 3996.3, 199600000001, 0),
(471, 'Send', '2020-04-25 10:06:16', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 20, 3996.3, 199600000000, 1),
(472, 'Receive', '2020-04-25 10:06:28', 'Received LKR  6.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 6, 4002.3, 199600000001, 0),
(473, 'Send', '2020-04-25 10:06:28', 'Transfered LKR  6.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 6, 4002.3, 199600000000, 1),
(474, 'Receive', '2020-04-25 10:10:58', 'Received LKR  11.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: ss', 'PRA', 11, 4013.3, 199600000001, 0),
(475, 'Send', '2020-04-25 10:10:58', 'Transfered LKR  11.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: ss', 'PRA', 11, 4013.3, 199600000000, 1),
(476, 'Receive', '2020-04-25 10:15:52', 'Received LKR  10.00 from card 1996211389731938<br> to card 1996026215051508. <br>: q', 'VC2', 10, 10, 199600000001, 0),
(477, 'Send', '2020-04-25 10:15:52', 'Transfered LKR  10.00 to card 1996026215051508<br> from card 1996211389731938. <br>: q', 'VC3', 10, 20, 199600000001, 1),
(478, 'Receive', '2020-04-25 17:01:14', 'Received LKR 10.00 from account 199600000001<br> to account 1996026215051508. <br>: Test 1', '', 10, 20, 199600000001, 0),
(479, 'Send', '2020-04-25 17:01:14', 'Transfered LKR 10.00 to account 1996026215051508<br> from account 199600000001. <br>: Test 1', '', 10, 4003.3, 199600000001, 1),
(480, 'Receive', '2020-04-25 17:01:13', 'Received LKR 10.00 from account 199600000001<br> to account 1996026215051508. <br>: Test 1', '', 10, 30, 199600000001, 0),
(481, 'Send', '2020-04-25 17:01:13', 'Transfered LKR 10.00 to account 1996026215051508<br> from account 199600000001. <br>: Test 1', '', 10, 3993.3, 199600000001, 1),
(482, 'Receive', '2020-04-25 17:01:00', 'Received LKR 10.50 from account 199600000001<br> to account 1996026215051508. <br>: Test 1', '', 10.5, 40.5, 199600000001, 0),
(483, 'Send', '2020-04-25 17:01:00', 'Transfered LKR 10.50 to account 1996026215051508<br> from account 199600000001. <br>: Test 1', '', 10.5, 3982.8, 199600000001, 1),
(484, 'Receive', '2020-04-25 17:01:37', 'Received LKR 10.00 from account 199600000001<br> to account 1996026215051508. <br>: Test 1', '', 10, 50.5, 199600000001, 0),
(485, 'Send', '2020-04-25 17:01:37', 'Transfered LKR 10.00 to account 1996026215051508<br> from account 199600000001. <br>: Test 1', '', 10, 3972.8, 199600000001, 1),
(486, 'Deposit', '2020-04-25 17:44:36', 'Deposited LKR 10.00 <br> to account lahiruthivankara@gmail.com. <br>: test', 'PRA', 10, 3982.8, 199600000001, 1),
(487, 'Deposit', '2020-04-25 17:44:53', 'Deposited LKR 10.00 <br> to account lahiruthivankara@gmail.com. <br>: test', 'PRA', 10, 3992.8, 199600000001, 1),
(488, 'Deposit', '2020-04-25 17:45:20', 'Deposited LKR 10.00 <br> to account lahiruthivankara@gmail.com. <br>: test', 'PRA', 10, 4002.8, 199600000001, 1),
(489, 'Deposit', '2020-04-25 17:49:01', 'Deposited LKR 10.00 <br> to account lahiruthivankara@gmail.com <br>: test', 'PRA', 4002.8, 4012.8, 199600000001, 1),
(490, 'Deposit', '2020-04-25 17:50:17', 'Deposited LKR 10.00 <br> to account lahiruthivankara@gmail.com <br>: test', 'PRA', 4012.8, 4022.8, 199600000001, 1),
(491, 'Deposit', '2020-04-25 17:52:46', 'Deposited LKR 10.00 <br> to account lahiruthivankara@gmail.com <br>: test', 'PRA', 4022.8, 4032.8, 199600000001, 1),
(492, 'Withdraw', '2020-04-25 18:00:02', 'Deposited LKR 10.00 <br> to account lahiruthivankara@gmail.com. <br>: test', 'PRA', 10, 4022.8, 199600000001, 1),
(493, 'Withdraw', '2020-04-25 18:03:37', 'Deposited LKR 10.00 <br> to account lahiruthivankara@gmail.com. <br>: test', 'PRA', 10, 4012.8, 199600000001, 1),
(494, 'Withdraw', '2020-04-25 18:04:35', 'Withdraw LKR 10.00 <br> from account lahiruthivankara@gmail.com. <br>: test', 'PRA', 10, 4002.8, 199600000001, 1),
(495, 'Deposit', '2020-04-25 18:05:14', 'Deposit LKR 1000.00 <br> to account lahiruthivankara@gmail.com <br>: test', 'PRA', 4002.8, 5002.8, 199600000001, 1),
(496, 'Deposit', '2020-04-25 18:06:12', 'Deposit LKR LKR10.00 <br> to account lahiruthivankara@gmail.com <br>: test', 'PRA', 5002.8, 5012.8, 199600000001, 1),
(497, 'Deposit', '2020-04-25 18:07:57', 'Deposit LKR LKR10.00 <br> to account lahiruthivankara@gmail.com <br>: test', 'PRA', 0, 5022.8, 199600000001, 1),
(498, 'Deposit', '2020-04-25 18:08:29', 'Deposit LKR LKR10.00 <br> to account lahiruthivankara@gmail.com <br>: test', 'PRA', 10, 5032.8, 199600000001, 1),
(499, 'Withdraw', '2020-04-25 18:08:46', 'Withdraw LKR LKR20.00 <br> from account lahiruthivankara@gmail.com. <br>: test', 'PRA', 20, 5012.8, 199600000001, 1),
(500, 'Deposit', '2020-04-25 18:09:07', 'Deposit LKR LKR10.00 <br> to account nimesh.ekanayaka7@gmail.com <br>: test', 'PRA', 10, 127073, 199600000000, 1),
(501, 'Withdraw', '2020-04-25 18:09:19', 'Withdraw LKR LKR10.00 <br> from account nimesh.ekanayaka7@gmail.com. <br>: test', 'PRA', 10, 127063, 199600000000, 1),
(502, 'Withdraw', '2020-04-25 18:25:59', 'Withdraw LKR LKR20,000.00 <br> from account nimesh.ekanayaka7@gmail.com. <br>: test', 'PRA', 20000, 107063, 199600000000, 1),
(509, 'Receive', '2020-04-28 18:25:03', 'Received   10.00 from card 1996481243502433<br> to card 1996501047080921. <br>: Test 1', 'VC3', 10, 210.5, 199600000000, 0),
(510, 'Send', '2020-04-28 18:25:03', 'Transfered   10.00 to card 1996501047080921<br> from card 1996481243502433. <br>: Test 1', 'VC3', 10, 2263, 199600000000, 1),
(511, 'Receive', '2020-04-28 18:32:07', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 20, 5042.8, 199600000001, 0),
(512, 'Send', '2020-04-28 18:32:07', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 20, 5042.8, 199600000000, 1),
(513, 'Receive', '2020-04-28 18:46:47', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 20, 5062.8, 199600000001, 0),
(514, 'Send', '2020-04-28 18:46:47', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 20, 5062.8, 199600000000, 1),
(515, 'Receive', '2020-05-16 09:03:44', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 20, 5082.8, 199600000001, 0),
(516, 'Send', '2020-05-16 09:03:44', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 20, 5082.8, 199600000000, 1),
(517, 'Receive', '2020-05-16 09:11:33', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 20, 5102.8, 199600000001, 0),
(518, 'Send', '2020-05-16 09:11:33', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 20, 106964, 199600000000, 1),
(519, 'Receive', '2020-05-16 09:14:16', 'Received LKR  100.00 from account lahiruthivankara@gmail.com<br> to account nimesh.ekanayaka7@gmail.com. <br>: Test 16', 'PRA', 100, 107064, 199600000000, 0),
(520, 'Send', '2020-05-16 09:14:16', 'Transfered LKR  100.00 to account nimesh.ekanayaka7@gmail.com<br> from account lahiruthivankara@gmail.com. <br>: Test 16', 'PRA', 100, 107064, 199600000001, 1),
(521, 'Receive', '2020-05-16 18:52:13', 'Received LKR  100.00 from card 1996481243502433<br> to card 1996104521201288. <br>: Test 1', 'VC3', 100, 100, 199600000000, 0),
(522, 'Send', '2020-05-16 18:52:13', 'Transfered LKR  100.00 to card 1996104521201288<br> from card 1996481243502433. <br>: Test 1', 'VC3', 100, 2163, 199600000000, 1),
(523, 'Receive', '2020-05-16 18:01:05', 'Received LKR 500.00 from account 199600000001<br> to account 1996285133961924. <br>: Test 1', '', 500, 500, 199600000001, 0),
(524, 'Send', '2020-05-16 18:01:05', 'Transfered LKR 500.00 to account 1996285133961924<br> from account 199600000001. <br>: Test 1', '', 500, 4502.8, 199600000001, 1),
(537, 'Receive', '2020-08-22 12:23:56', 'Received   10.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 10, 4532.8, 199600000001, 0),
(538, 'Send', '2020-08-22 12:23:56', 'Transfered   10.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 10, 4532.8, 199600000000, 1),
(539, 'Receive', '2020-08-22 12:01:09', 'Received  10.00 from account 199600000000<br> to account 1996104521201288. <br>: Test 1', '', 10, 110, 199600000000, 0),
(540, 'Send', '2020-08-22 12:01:09', 'Transfered  10.00 to account 1996104521201288<br> from account 199600000000. <br>: Test 1', '', 10, 107004, 199600000000, 1),
(541, 'Receive', '2020-08-22 12:26:03', 'Received   20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 20, 4552.8, 199600000001, 0),
(542, 'Send', '2020-08-22 12:26:03', 'Transfered   20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 20, 4552.8, 199600000000, 1),
(543, 'Receive', '2020-08-22 12:28:35', 'Received   20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: test', 'PRA', 20, 4572.8, 199600000001, 0),
(544, 'Send', '2020-08-22 12:28:35', 'Transfered   20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: test', 'PRA', 20, 4572.8, 199600000000, 1),
(545, 'Receive', '2020-08-22 12:56:19', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 20, 4592.8, 199600000001, 0),
(546, 'Send', '2020-08-22 12:56:19', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 20, 4592.8, 199600000000, 1),
(547, 'Receive', '2020-08-22 13:00:01', 'Received LKR  1000.00 from account lahiruthivankara@gmail.com<br> to account nimesh.ekanayaka7@gmail.com. <br>: Give back', 'PRA', 1000, 107944, 199600000000, 0),
(548, 'Send', '2020-08-22 13:00:01', 'Transfered LKR  1000.00 to account nimesh.ekanayaka7@gmail.com<br> from account lahiruthivankara@gmail.com. <br>: Give back', 'PRA', 1000, 107944, 199600000001, 1),
(549, 'Receive', '2020-08-22 13:01:04', 'Received LKR  20.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 20, 3612.8, 199600000001, 0),
(550, 'Send', '2020-08-22 13:01:04', 'Transfered LKR  20.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 20, 107924, 199600000000, 1),
(551, 'Receive', '2020-08-22 20:18:29', 'Received LKR  122.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: Test 5', 'PRA', 122, 3734.8, 199600000001, 0),
(552, 'Send', '2020-08-22 20:18:29', 'Transfered LKR  122.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: Test 5', 'PRA', 122, 107802, 199600000000, 1),
(553, 'Receive', '2020-08-22 20:21:02', 'Received LKR  11.00 from account lahiruthivankara@gmail.com<br> to account nimesh.ekanayaka7@gmail.com. <br>: ss', 'PRA', 11, 107813, 199600000000, 0),
(554, 'Send', '2020-08-22 20:21:02', 'Transfered LKR  11.00 to account nimesh.ekanayaka7@gmail.com<br> from account lahiruthivankara@gmail.com. <br>: ss', 'PRA', 11, 3723.8, 199600000001, 1),
(555, 'Receive', '2020-08-22 20:21:36', 'Received LKR  13.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: km', 'PRA', 13, 3736.8, 199600000001, 0),
(556, 'Send', '2020-08-22 20:21:36', 'Transfered LKR  13.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: km', 'PRA', 13, 107800, 199600000000, 1),
(557, 'Receive', '2020-08-22 21:01:50', 'Received LKR 10.00 from account 199600000001<br> to account 1996285133961924. <br>: Test 1', '', 10, 510, 199600000001, 0),
(558, 'Send', '2020-08-22 21:01:50', 'Transfered LKR 10.00 to account 1996285133961924<br> from account 199600000001. <br>: Test 1', '', 10, 3726.8, 199600000001, 1),
(559, 'Deposit', '2020-08-22 21:01:46', 'Deposit LKR LKR10.00 <br> to account lahiruthivankara@gmail.com <br>: test', 'PRA', 10, 3736.8, 199600000001, 1),
(560, 'Withdraw', '2020-08-22 21:01:57', 'Withdraw LKR LKR10.00 <br> from account lahiruthivankara@gmail.com. <br>: test', 'PRA', 10, 3726.8, 199600000001, 1),
(561, 'Receive', '2020-08-22 21:06:46', 'Received LKR  44.00 from account lahiruthivankara@gmail.com<br> to account nimesh.ekanayaka7@gmail.com. <br>: Test 5', 'PRA', 44, 107844, 199600000000, 0),
(562, 'Send', '2020-08-22 21:06:46', 'Transfered LKR  44.00 to account nimesh.ekanayaka7@gmail.com<br> from account lahiruthivankara@gmail.com. <br>: Test 5', 'PRA', 44, 3682.8, 199600000001, 1),
(575, 'Receive', '2020-08-23 20:54:07', 'Received LKR  20.00 from account lahiruthivankara@gmail.com<br> to account nimesh.ekanayaka7@gmail.com. <br>: Test 1', 'PRA', 20, 107824, 199600000000, 0),
(576, 'Send', '2020-08-23 20:54:07', 'Transfered LKR  20.00 to account nimesh.ekanayaka7@gmail.com<br> from account lahiruthivankara@gmail.com. <br>: Test 1', 'PRA', 20, 107824, 199600000001, 1),
(577, 'Receive', '2020-08-23 21:04:46', 'Received LKR  20.00 from account lahiruthivankara@gmail.com<br> to account nimesh.ekanayaka7@gmail.com. <br>: Test 5', 'PRA', 20, 107844, 199600000000, 0),
(578, 'Send', '2020-08-23 21:04:46', 'Transfered LKR  20.00 to account nimesh.ekanayaka7@gmail.com<br> from account lahiruthivankara@gmail.com. <br>: Test 5', 'PRA', 20, 107844, 199600000001, 1),
(585, 'Receive', '2020-09-16 18:09:33', 'Received LKR  9000.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: limit check 4', 'PRA', 9000, 12672.8, 199600000001, 0),
(586, 'Send', '2020-09-16 18:09:33', 'Transfered LKR  9000.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: limit check 4', 'PRA', 9000, 12672.8, 199600000000, 1),
(587, 'Receive', '2020-09-16 18:11:53', 'Received LKR  12000.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: limit check 5', 'PRA', 12000, 24672.8, 199600000001, 0),
(588, 'Send', '2020-09-16 18:11:53', 'Transfered LKR  12000.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: limit check 5', 'PRA', 12000, 24672.8, 199600000000, 1),
(589, 'Deposit', '2020-09-16 18:17:22', 'Deposit  LKR250,000.00 <br> to account nimesh.ekanayaka7@gmail.com <br>: Lottery ', 'PRA', 250000, 336824, 199600000000, 1),
(590, 'Receive', '2020-09-16 18:57:24', 'Received LKR  20000.00 from account nimesh.ekanayaka7@gmail.com<br> to account lahiruthivankara@gmail.com. <br>: limit check 5', 'PRA', 20000, 44672.8, 199600000001, 0),
(591, 'Send', '2020-09-16 18:57:24', 'Transfered LKR  20000.00 to account lahiruthivankara@gmail.com<br> from account nimesh.ekanayaka7@gmail.com. <br>: limit check 5', 'PRA', 20000, 44672.8, 199600000000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbluserdetails`
--

CREATE TABLE `tbluserdetails` (
  `uId` bigint(255) NOT NULL,
  `email` varchar(256) NOT NULL,
  `fName` varchar(256) NOT NULL,
  `lName` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `phoneNumber` int(30) NOT NULL,
  `stAddress` varchar(256) DEFAULT NULL,
  `addLine1` varchar(256) NOT NULL,
  `addLine2` varchar(256) DEFAULT NULL,
  `city` varchar(256) NOT NULL,
  `stateProvince` varchar(256) NOT NULL,
  `postalCode` varchar(100) NOT NULL,
  `country` varchar(256) NOT NULL,
  `userStatus` varchar(50) NOT NULL,
  `userType` varchar(50) NOT NULL,
  `transactionLimit` int(20) NOT NULL DEFAULT 10000
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluserdetails`
--

INSERT INTO `tbluserdetails` (`uId`, `email`, `fName`, `lName`, `password`, `phoneNumber`, `stAddress`, `addLine1`, `addLine2`, `city`, `stateProvince`, `postalCode`, `country`, `userStatus`, `userType`, `transactionLimit`) VALUES
(66, 'bhanuka@gmail.com', 'Bhanuka', 'Senevirathne', '$2y$10$zNN.G4qq50OQdu70MWT6X.xk7j2yK8rS35fR8o155UM9CNRcfkXq.', 117878589, 'New Scheme, Track 05, Gomarankalla', 'Palace Road', '', 'Kandy', 'Central Province', '50390', 'SriLanka', 'Active', 'custAdv', 10000),
(7, 'lahiruthivankara@gmail.com', 'Dimuthu', 'Chamod', '$2y$10$AZHoRRfujfNtCZm3476mZOFQQCZhQ53oPBWgaDvTwTYLA8tTAT5Ra', 718810576, 'New Scheme, Track 05', 'Gomarankalla', '', 'Galenbindunuwewa', 'North Central Province', '50390', 'SriLanka', 'Active', 'custMed', 10000),
(1, 'nimesh.ekanayaka7@gmail.com', 'Nimesh Kasun', 'Ekanayake', '$2y$10$/HfTpMG59x3M.cX0ZU2QguE17fd04ThxCeJaMdBhS1LW.2XjYIwqq', 718810575, 'New Scheme, Track 05', 'Gomarankalla', 'Galenbindunuwewa', 'Anuradhapura', 'North Central Province', '10000', 'SriLanka', 'Active', 'custAdv', 10000),
(65, 'nimesh@edvicon.org', 'Nimesh', 'Admin', '$2y$10$V86EvxeSffJRlZHy8k7vuuOAX0DkpkSnpd5iGBSwQ8pORRHoV49AC', 775895402, 'New Scheme, Track 05', 'Gomarankalla', '', 'Galenbindunuwewa', 'North Central Province', '50390', 'SriLanka', 'Active', 'staAdmin', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `tblvirtualcard`
--

CREATE TABLE `tblvirtualcard` (
  `vId` bigint(255) NOT NULL,
  `vCardNumber` bigint(255) NOT NULL,
  `vExpireDate` date NOT NULL,
  `vCSV` int(5) NOT NULL,
  `vCardName` varchar(50) NOT NULL,
  `vCardBalance` float NOT NULL,
  `vCardOrder` varchar(100) NOT NULL,
  `vAccountNumber` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblvirtualcard`
--

INSERT INTO `tblvirtualcard` (`vId`, `vCardNumber`, `vExpireDate`, `vCSV`, `vCardName`, `vCardBalance`, `vCardOrder`, `vAccountNumber`) VALUES
(98, 1996104521201288, '2025-04-27', 490, 'Skrill', 110, 'VC3', 199600000000),
(99, 1996285133961924, '2025-05-15', 300, 'Neteller', 510, 'VC1', 199600000001),
(79, 1996481243502433, '2025-04-18', 715, 'PayPal - Don\'t Del', 2113, 'VC3', 199600000000),
(49, 1996501047080921, '2024-12-15', 959, 'Neteller - Don\'t Del', 310.5, 'VC3', 199600000000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaccount`
--
ALTER TABLE `tblaccount`
  ADD PRIMARY KEY (`accountNumber`),
  ADD UNIQUE KEY `aId` (`aId`),
  ADD UNIQUE KEY `aUserEmail` (`aUserEmail`);

--
-- Indexes for table `tbliptracking`
--
ALTER TABLE `tbliptracking`
  ADD PRIMARY KEY (`trID`);

--
-- Indexes for table `tblmessage`
--
ALTER TABLE `tblmessage`
  ADD PRIMARY KEY (`mId`);

--
-- Indexes for table `tbltransactions`
--
ALTER TABLE `tbltransactions`
  ADD PRIMARY KEY (`tId`),
  ADD KEY `tAccountNumber` (`tAccountNumber`) USING BTREE;

--
-- Indexes for table `tbluserdetails`
--
ALTER TABLE `tbluserdetails`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `uId` (`uId`),
  ADD UNIQUE KEY `phoneNumber` (`phoneNumber`);

--
-- Indexes for table `tblvirtualcard`
--
ALTER TABLE `tblvirtualcard`
  ADD PRIMARY KEY (`vCardNumber`),
  ADD UNIQUE KEY `vId` (`vId`),
  ADD KEY `vAccountNumber` (`vAccountNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblaccount`
--
ALTER TABLE `tblaccount`
  MODIFY `aId` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbliptracking`
--
ALTER TABLE `tbliptracking`
  MODIFY `trID` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `tblmessage`
--
ALTER TABLE `tblmessage`
  MODIFY `mId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tbltransactions`
--
ALTER TABLE `tbltransactions`
  MODIFY `tId` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=592;

--
-- AUTO_INCREMENT for table `tbluserdetails`
--
ALTER TABLE `tbluserdetails`
  MODIFY `uId` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tblvirtualcard`
--
ALTER TABLE `tblvirtualcard`
  MODIFY `vId` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblaccount`
--
ALTER TABLE `tblaccount`
  ADD CONSTRAINT `tblaccount_ibfk_1` FOREIGN KEY (`aUserEmail`) REFERENCES `tbluserdetails` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `tbltransactions`
--
ALTER TABLE `tbltransactions`
  ADD CONSTRAINT `tbltransactions_ibfk_1` FOREIGN KEY (`tAccountNumber`) REFERENCES `tblaccount` (`accountNumber`) ON UPDATE CASCADE;

--
-- Constraints for table `tblvirtualcard`
--
ALTER TABLE `tblvirtualcard`
  ADD CONSTRAINT `tblvirtualcard_ibfk_1` FOREIGN KEY (`vAccountNumber`) REFERENCES `tblaccount` (`accountNumber`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
