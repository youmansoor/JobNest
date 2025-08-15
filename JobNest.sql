-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2025 at 08:17 PM
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
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `resume_path` varchar(255) NOT NULL,
  `cover_letter` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `name`, `email`, `resume_path`, `cover_letter`) VALUES
(1, 'Ali Raza', 'ali.raza@example.com', 'resumes/ali_raza_cv.pdf', 'I am excited to apply for the software engineer position. I bring hands-on experience in PHP and MySQL.'),
(2, 'Sara Khan', 'sara.khan@example.com', 'resumes/sara_khan_resume.pdf', 'With a strong background in UI/UX design, I am confident I can contribute to your team.'),
(3, 'Ahmed Hassan', 'ahmed.hassan@example.com', 'resumes/ahmed_hassan_cv.pdf', 'I have 3 years of experience as a Java Developer and am eager to join your backend team.'),
(4, 'Fatima Noor', 'fatima.noor@example.com', 'resumes/fatima_noor_resume.pdf', 'My background in data analysis and visualization makes me a great fit for this role.'),
(5, 'Bilal Ahmed', 'bilal.ahmed@example.com', 'resumes/bilal_ahmed_cv.pdf', 'Please find attached my resume for your consideration for the DevOps position.'),
(6, 'Ayesha Malik', 'ayesha.malik@example.com', 'resumes/ayesha_malik_resume.pdf', 'I am passionate about frontend technologies and have 2 years experience in React.js.'),
(7, 'Zain Siddiqui', 'zain.siddiqui@example.com', 'resumes/zain_siddiqui_cv.pdf', 'I am applying for the network engineer role and have a CCNA certification.'),
(8, 'Mariam Yousaf', 'mariam.yousaf@example.com', 'resumes/mariam_yousaf_resume.pdf', 'My background in cybersecurity aligns with your current job opening.'),
(9, 'Usman Tariq', 'usman.tariq@example.com', 'resumes/usman_tariq_cv.pdf', 'Experienced in Laravel and ready to work on scalable systems.'),
(10, 'Hina Javed', 'hina.javed@example.com', 'resumes/hina_javed_resume.pdf', 'Enthusiastic about joining your QA team. I bring manual and automated testing experience.');

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
(1, 'HR - Systems Limited', 'hr@systemsltd.com', 'system123'),
(2, 'Recruiter - 10Pearls', 'recruit@10pearls.com', 'pearls456'),
(3, 'Talent Acquisition - NetSol', 'jobs@netsol.com', 'netsol@789'),
(4, 'HR Manager - Techlogix', 'hr@techlogix.com', 'techlogix321'),
(5, 'Recruitment - Folio3', 'careers@folio3.com', 'folio#dev'),
(6, 'Hiring Manager - Arbisoft', 'hiring@arbisoft.com', 'arbiHR!'),
(7, 'HR - CureMD', 'hr@curemd.com', 'curemd@123'),
(8, 'Talent Team - Tkxel', 'talent@tkxel.com', 'tkxelpwd'),
(9, 'Jobs - Ufone', 'jobs@ufone.com', 'ufonejobs'),
(10, 'HR - VisionX', 'hr@visionx.com', 'visionx_pass'),
(11, 'HR - Mindstorm Studios', 'hr@mindstorm.com', 'games123'),
(12, 'HR - Rozee.pk', 'hr@rozee.pk', 'rozeepass'),
(13, 'Hiring - Zong 4G', 'hr@zong.com.pk', 'zong4ghr'),
(14, 'HR - PTCL', 'hr@ptcl.com.pk', 'ptcljobs'),
(15, 'Recruiter - DPL', 'recruit@dpl.com', 'dplteam'),
(16, 'HR - Techverx', 'hr@techverx.com', 'verx2025'),
(17, 'Careers - Si Global', 'careers@siglobal.com', 'siglobal321'),
(18, 'HR - TRG Pakistan', 'hr@trg.com.pk', 'trgtrg!'),
(19, 'HR - CodeNinja', 'hr@codeninja.com', 'ninjajobs'),
(20, 'Recruitment - Contour Software', 'recruitment@contour.com', 'contourHR');

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
  `employer_email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `employer_email`, `title`, `company`, `location`, `sector`, `description`) VALUES
(1, 'hr@systemsltd.com', 'Software Engineer', 'Systems Limited', 'Lahore', 'IT', 'Develop scalable enterprise applications in .NET and Angular.'),
(2, 'recruit@10pearls.com', 'Full Stack Developer', '10Pearls', 'Karachi', 'IT', 'Work on modern web stacks including MERN for global clients.'),
(3, 'jobs@netsol.com', 'Java Developer', 'NetSol Technologies', 'Lahore', 'IT', 'Develop financial software using Java Spring Framework.'),
(4, 'hr@techlogix.com', 'Business Analyst', 'Techlogix', 'Islamabad', 'IT', 'Liaise between business units and software developers.'),
(5, 'careers@folio3.com', 'QA Engineer', 'Folio3', 'Karachi', 'IT', 'Test and validate applications for mobile and web.'),
(6, 'hiring@arbisoft.com', 'DevOps Engineer', 'Arbisoft', 'Lahore', 'IT', 'Manage CI/CD pipelines and cloud infrastructure.'),
(7, 'hr@curemd.com', 'UI/UX Designer', 'CureMD', 'Lahore', 'IT', 'Design clean and modern interfaces for healthcare apps.'),
(8, 'talent@tkxel.com', 'Data Analyst', 'Tkxel', 'Lahore', 'IT', 'Analyze customer data and create dashboards in Power BI.'),
(9, 'jobs@ufone.com', 'Network Engineer', 'Ufone', 'Islamabad', 'IT', 'Maintain and troubleshoot telecom network infrastructure.'),
(10, 'hr@visionx.com', 'AI Engineer', 'VisionX', 'Islamabad', 'IT', 'Develop machine learning models for real-time vision systems.'),
(11, 'hr@mindstorm.com', 'Game Developer', 'Mindstorm Studios', 'Lahore', 'IT', 'Build mobile and PC games using Unity and C#.'),
(12, 'hr@rozee.pk', 'Product Manager', 'Rozee.pk', 'Lahore', 'IT', 'Define product strategy and lead agile teams.'),
(13, 'hr@zong.com.pk', 'Cybersecurity Analyst', 'Zong 4G', 'Islamabad', 'IT', 'Monitor networks and respond to cyber threats.'),
(14, 'hr@ptcl.com.pk', 'System Administrator', 'PTCL', 'Lahore', 'IT', 'Ensure uptime and performance of internal systems.'),
(15, 'recruit@dpl.com', 'Mobile App Developer', 'DPL', 'Islamabad', 'IT', 'Develop cross-platform apps in Flutter and React Native.'),
(16, 'hr@techverx.com', 'Front-End Developer', 'Techverx', 'Lahore', 'IT', 'Build pixel-perfect web interfaces using Vue.js.'),
(17, 'careers@siglobal.com', 'Cloud Engineer', 'Si Global', 'Karachi', 'IT', 'Design and deploy cloud infrastructure on AWS.'),
(18, 'hr@trg.com.pk', 'Technical Support Specialist', 'TRG Pakistan', 'Karachi', 'IT', 'Provide support to clients for IT-related issues.'),
(19, 'hr@codeninja.com', 'Laravel Developer', 'CodeNinja', 'Lahore', 'IT', 'Build secure and scalable apps with Laravel.'),
(20, 'recruitment@contour.com', 'ERP Consultant', 'Contour Software', 'Lahore', 'IT', 'Implement ERP systems for large international clients.');

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
(1, 'Ali Raza', 'ali.raza@example.com', 'password123'),
(2, 'Sara Khan', 'sara.khan@example.com', 'sarak123'),
(3, 'Ahmed Hassan', 'ahmed.hassan@example.com', 'ahmedpass'),
(4, 'Fatima Noor', 'fatima.noor@example.com', 'fatinoor321'),
(5, 'Bilal Ahmed', 'bilal.ahmed@example.com', 'bilalpass'),
(6, 'Ayesha Malik', 'ayesha.malik@example.com', 'ayesha!2025'),
(7, 'Zain Siddiqui', 'zain.siddiqui@example.com', 'zainsid123'),
(8, 'Mariam Yousaf', 'mariam.yousaf@example.com', 'mariamy@pass'),
(9, 'Usman Tariq', 'usman.tariq@example.com', 'usman!@#'),
(10, 'Hina Javed', 'hina.javed@example.com', 'hinaj321'),
(11, 'Kashif Ali', 'kashif.ali@example.com', 'kashifsecure'),
(12, 'Rabia Shah', 'rabia.shah@example.com', 'rabiashah789'),
(13, 'Saad Mehmood', 'saad.mehmood@example.com', 'saadmehmood!'),
(14, 'Nida Qureshi', 'nida.qureshi@example.com', 'nida1234'),
(15, 'Omar Farooq', 'omar.farooq@example.com', 'omarpass2024'),
(16, 'Tania Anwar', 'tania.anwar@example.com', 'taniaa321'),
(17, 'Imran Akhtar', 'imran.akhtar@example.com', 'imran@khtar'),
(18, 'Mehwish Iqbal', 'mehwish.iqbal@example.com', 'mehwishP@ss'),
(19, 'Hamza Shahid', 'hamza.shahid@example.com', 'hamza786'),
(20, 'Zara Sheikh', 'zara.sheikh@example.com', 'zara@job');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
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
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `empolyee`
--
ALTER TABLE `empolyee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
