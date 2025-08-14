-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2025 at 11:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobnest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Name`, `Email`, `Password`) VALUES
(1, 'Admin', 'admin@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `resume_path` varchar(500) NOT NULL,
  `cover_letter` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `name`, `email`, `resume_path`, `cover_letter`) VALUES
(4, '3', 'hjkhku', '2025-08-10 21:59:35', ''),
(5, 'you', 'you@gmail.com', 'resumes/resume_1754889027_pdf-test.pdf', 'plplp');

-- --------------------------------------------------------

--
-- Table structure for table `empolyee`
--

CREATE TABLE `empolyee` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `empolyee`
--

INSERT INTO `empolyee` (`id`, `Name`, `Email`, `Password`) VALUES
(1, 'Mansoor', 'man@gmail.com', '42688213'),
(2, 'kpk', 'kpk@ffko', 'pkk'),
(3, ';kpkijij', 'jojoj@yffj', 'ufgg'),
(4, 'Azhaan', 'azhaan@gmail.com', '555'),
(5, 'talha', 'talha@gmail.com', '113');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`) VALUES
(1, 'Mansoor', 'admin@shopstore.com', 'gdfgfgdf'),
(2, 'hgh', 'yg@g', 'ghgfhfg');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `employer_email` varchar(500) NOT NULL,
  `title` varchar(500) NOT NULL,
  `company` varchar(500) NOT NULL,
  `location` varchar(500) NOT NULL,
  `sector` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `employer_email`, `title`, `company`, `location`, `sector`, `description`) VALUES
(1, '', 'lk', 'klk', 'klk', '', 'klklk'),
(2, '', 'kj', 'kjjk', 'kjkj', '', 'kjkjkj'),
(3, '', 'Front-end Developer', 'Job-section', 'karachi', '', 'djkasdjakjsakj'),
(4, 'man@gmail.com', 'Back-end Developer', 'unknown', 'karachi', '', 'lkjlkjlljiljijoi'),
(5, 'azhaan@gmail.com', 'Web Designing', 'unknown', 'Lahore', 'Engineering', 'okokokokok;k;;k'),
(6, 'man@gmail.com', 'UI/UX', 'unknown', 'karachi', 'Engineering', 'okoko'),
(7, 'azhaan@gmail.com', 'PHP Developer', 'unknown', 'karachi', 'Engineering', 'kokokokihuhik'),
(8, 'man@gmail.com', 'lokk', 'okko', 'kok', 'kok', 'kok');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Name`, `Email`, `Password`) VALUES
(1, 'sfdsd', 'dff@sfsf', 'fdfsfs'),
(2, 'abc', 'def@gmail.com', '123'),
(3, 'waiz', 'waiz@gmail.com', '555'),
(4, 'you', 'you@gmail.com', '576'),
(5, 'you', 'you@gmail.com', '576'),
(6, 'umer', 'umer@gmail.com', '222'),
(7, 'kjk', 'kjkj@gjg', '777'),
(8, 'sfdsd', 'waiz@gmail.com', '888'),
(9, 'mmm', 'mmm@rrmm', '$2y$10$Qilo1lkV1.GE1Bjr1PUuSOZ/37nOu6Ar236oyHxtNE7pSb8kYCQIG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empolyee`
--
ALTER TABLE `empolyee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `empolyee`
--
ALTER TABLE `empolyee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
