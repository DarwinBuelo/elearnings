-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2019 at 03:21 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--
CREATE DATABASE IF NOT EXISTS `elearning` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `elearning`;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_desc` varchar(255) NOT NULL,
  `units` int(11) NOT NULL,
  `creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_code`, `course_desc`, `units`, `creator`) VALUES
(1, 'Testsss', 'This is a test only', 'This is a test only', 3, 6),
(2, 'Test2', 'Test Course 2', 'CS-102', 3, 6),
(3, 'Testss', 'This is a test only', 'This is a test only', 3, 0),
(4, 'Tests', 'This is a test only', 'CS-110', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
CREATE TABLE `lessons` (
  `lesson_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `overview` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `course_id` int(11) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lesson_id`, `title`, `overview`, `content`, `course_id`, `date_created`) VALUES
(1, 'This is a test', 'test overview', '[b]This is [/b]test', 1, '2019-08-15'),
(2, 'This is a test', 'test overview', '[b]This is [/b]test', 1, '2019-08-15'),
(3, 'This is a test', 'test overview', '[b]This is [/b]test', 1, '2019-08-15'),
(4, 'This is a test', 'test overview', '[b]This is [/b]test', 1, '2019-08-15'),
(5, 'test', 'test overview', '[sub]This is a test onlsd[/sub]sdf[sub]sdfsdfsdf[/sub]sdffffffffffffffffffffffffffff[b]sdfffffff[/b]Â  Â  Â  Â  Â  Â  Â  sdfasd', 1, '2019-08-18'),
(6, 'hhhh', 'khkllj', 'jhfgjkhhhhhhhhhhhhhhhhhhhh\r\nkjhh', 2, '2019-08-18'),
(7, 'hhhh', 'khkllj', 'jhfgjkhhhhhhhhhhhhhhhhhhhh\r\nkjhh', 1, '2019-08-18');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Teacher');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `surname`, `middlename`, `email`, `phone`, `role`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin', 'admin', 'admin', 'admin@gmail.com', 'admin', 1),
(6, 'darwin.buelo', '2d079c9d0b11b268f3ec56705f7d6026dcfe6a1dbc62e12df3caf3ff59480242', 'Darwin', '', 'Buelva', 'Darwin', '', 1),
(8, 'darwin', '5180956043f09c1adaec1077bf11cd63d5e97a603a4da7f714e61a886c459b53', 'Darwin', 'Buelo', 'Buelva', 'dbuelo@gmail.com', '', 2),
(10, 'dfsadf', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'Darwin', 'Buelo', 'Buelva', 'dbuelso@gmail.com', '', 2),
(18, 'dha', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'Darwin', 'Test', 'Buelva', 'dbuelsoss@gmail.com', '', 2),
(19, 'Dhass', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'TestUser', 'User', 'Test', 'dar12@gmail.com', '', 2),
(22, 'admin2', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'Darwin', 'Buelo', 'Buelva', 'dbueddlsossss@gmail.com', '', 2),
(23, 'dbuelo@gmail.com', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'Darwin', 'Buelo', 'Buelva', 'dbuelsosssss@gmail.com', '', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lesson_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
