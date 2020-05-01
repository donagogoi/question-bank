-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2020 at 07:21 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `question_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT 1,
  `teacher_id` varchar(100) DEFAULT NULL,
  `teacher_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `username`, `password`, `role`, `active`, `teacher_id`, `teacher_name`) VALUES
(1, 'dona7999@gmail.com', '123', 'ADMIN', 1, NULL, NULL),
(2, 'dkgogoi10@gmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa', 'TEACHER', 1, 'gr12', 'dk');

-- --------------------------------------------------------

--
-- Table structure for table `question_paper`
--

CREATE TABLE `question_paper` (
  `paper_id` int(11) NOT NULL,
  `paper_code` varchar(200) DEFAULT NULL,
  `paper_name` text DEFAULT NULL,
  `degree_name` text DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `course_type` varchar(200) DEFAULT NULL,
  `file` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_paper`
--

INSERT INTO `question_paper` (`paper_id`, `paper_code`, `paper_name`, `degree_name`, `year`, `course_type`, `file`) VALUES
(9, 'EDU101', 'Education First Semester', 'BA', '2019', 'REGULAR', 'uploads/EDU101_1846154871.pdf'),
(10, 'POL101', 'Political Science First Semester', 'BA', '2020', 'REGULAR', 'uploads/POL101_2059714628.pdf'),
(11, 'HIS101', 'History First Semester', 'BA', '2020', 'REGULAR', 'uploads/HIS101_632676164.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `question_paper`
--
ALTER TABLE `question_paper`
  ADD PRIMARY KEY (`paper_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `question_paper`
--
ALTER TABLE `question_paper`
  MODIFY `paper_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
