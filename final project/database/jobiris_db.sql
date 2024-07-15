-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2024 at 12:02 AM
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
-- Database: `jobiris_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `application_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `applicant_name` varchar(255) NOT NULL,
  `applicant_email` varchar(255) NOT NULL,
  `applicant_phone` varchar(20) NOT NULL,
  `applicant_resume` varchar(255) NOT NULL,
  `application_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`application_id`, `job_id`, `user_id`, `applicant_name`, `applicant_email`, `applicant_phone`, `applicant_resume`, `application_date`) VALUES
(1, 2, 2, 'Hamna', 'hamna123@gmail.com', '0787722334', '2019 Model Answers.pdf', '2024-06-16 21:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company_location` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `about_company` varchar(200) DEFAULT NULL,
  `jobs_posted` int(50) DEFAULT NULL,
  `established_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `working_employees` int(200) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'company'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `email`, `company_location`, `password`, `about_company`, `jobs_posted`, `established_date`, `working_employees`, `profile_image`, `user_type`) VALUES
(1, 'Facebook', 'facebook@gmail.com', 'Colombo, Srilanka', 'Facebook@123', 'kjhsdfkjsd', 0, '2024-06-17 00:00:00', 400, 'uploads/users/fb.png', 'company'),
(4, 'Youtube', 'youtube1@gmail.com', 'Trincomalee , Srilanka', 'Youtube@2000', 'good hearted company', NULL, '2024-06-04 00:00:00', 200, 'uploads/users/youtube.jpg', 'company');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `message_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`message_id`, `name`, `email`, `phone`, `role`, `message`, `created_at`) VALUES
(1, 'Facebook', 'facebook@gmail.com', '0782342456', 'job provider', 'nice to see you', '2024-06-16 21:49:20');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `job_location` varchar(255) NOT NULL,
  `job_type` varchar(50) NOT NULL,
  `job_shift` varchar(50) NOT NULL DEFAULT 'Flexible-Shift',
  `job_description` varchar(200) NOT NULL,
  `skills_required` varchar(100) NOT NULL,
  `salary` varchar(100) NOT NULL,
  `education` varchar(100) NOT NULL,
  `age` varchar(50) NOT NULL,
  `language` varchar(100) NOT NULL,
  `experience` varchar(100) NOT NULL,
  `qualification` varchar(200) NOT NULL,
  `job_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `company_id`, `job_title`, `job_location`, `job_type`, `job_shift`, `job_description`, `skills_required`, `salary`, `education`, `age`, `language`, `experience`, `qualification`, `job_image`, `created_at`) VALUES
(1, 1, 'Junior Web Developer', 'Trincomalee, Sri Lanka', 'Full-Time', 'Day-Shift', 'dggdfeijfiefa', 'react.js', '50,000', 'graduate', '25 ', 'Tamil , English', '3+ years', 'hdhdhdhdhdh', 'web developer.jpeg', '2024-06-16 19:09:14'),
(2, 1, 'Trainee Web Developer', 'Colombo, Sri Lanka', 'Full-Time', 'Flexible-Shift', 'adhsajvduy', 'HTML / WordPress', '35,000', 'graduate', '25 ', 'Tamil , English', '3+ years', 'Trainee Web Developer - HTML / WordPress\r\n', 'Trainee Web Developer.jpg', '2024-06-16 19:18:42'),
(3, 4, 'Video Editor', 'Trincomalee, Sri Lanka', 'Part-Time', 'Day-Shift', 'need to know how to edit videos', 'Editing skill', '40,000', 'A/L pass', '23', 'Tamil , English', '3+ years', 'you know how to edit a full fletch video', 'Video editor.jpg', '2024-06-16 19:41:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `profile_image`, `address`, `phone`, `user_type`) VALUES
(1, 'Admin', 'admin123@gmail.com', 'Admin123', 'uploads/users/admin11.png', NULL, NULL, 'admin'),
(2, 'Hamna', 'hamna123@gmail.com', 'Hamna@2001', 'uploads/users/yu.jpg', NULL, 776831774, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`job_id`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
