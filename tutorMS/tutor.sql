-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2020 at 04:00 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tutor`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(10) NOT NULL DEFAULT 'User',
  `user_id` int(2) DEFAULT NULL,
  `approval_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `username`, `email`, `phone`, `password`, `user_type`, `user_id`, `approval_status`) VALUES
(2, 'Aditi', 'aditi315', 'keya7828@gmail.com', 1758590083, '1234', 'ADMIN', NULL, 1),
(16, 'sharia', 'shariya1', 'xyz@gmail.com', 1234, '1234', 'TEACHER', 8, 1),
(17, 'aditikeya', 'aditikeya1', 'xyz@gmail.com', 123, '1234', 'STUDENT', 13, 1),
(18, 'test teacher', 'tt1', 'hgdggh@gmail.com', 17, '1234', 'TEACHER', 9, 1),
(19, 'test student', 'tt2', 'gfcccv@gmail.com', 21224, '1234', 'STUDENT', 14, 1),
(20, 'test student', 'tt3', 'djhasdhv@gmail.com', 38262, '1234', 'STUDENT', 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `medium` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `institution` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `gender`, `group`, `medium`, `class`, `institution`, `address`) VALUES
(13, 2, 1, 1, 2, 'AIUB', 'dhaka'),
(14, 1, 1, 1, 1, 'AIUB', 'dhaka'),
(15, 1, 1, 1, 5, 'AIUB', 'dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `medium` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `education` int(1) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `gender`, `group`, `medium`, `class`, `status`, `education`, `address`) VALUES
(8, 2, 1, '1', '1', 1, 1, 'dhaka'),
(9, 1, 1, '2', '1,2,3', 1, 2, 'dhaka');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
