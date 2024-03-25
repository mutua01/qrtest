-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2024 at 07:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `class_id`, `status`, `timestamp`) VALUES
(1, 17, 0, 0, '2024-03-14 11:35:48'),
(2, 17, 0, 0, '2024-03-14 11:35:48'),
(3, 17, 0, 0, '2024-03-14 11:35:48'),
(4, 17, 0, 0, '2024-03-14 11:35:48'),
(5, 17, 0, 0, '2024-03-14 11:35:48'),
(6, 17, 0, 0, '2024-03-14 11:35:48'),
(7, 17, 0, 0, '2024-03-14 11:35:48'),
(8, 17, 0, 0, '2024-03-14 11:35:48'),
(9, 17, 0, 0, '2024-03-14 11:35:48'),
(10, 17, 0, 0, '2024-03-14 11:35:48'),
(11, 17, 0, 0, '2024-03-14 11:35:48'),
(12, 17, 0, 0, '2024-03-14 11:35:48'),
(13, 17, 0, 0, '2024-03-14 11:35:48'),
(14, 18, 0, 0, '2024-03-14 11:35:48'),
(15, 18, 0, 0, '2024-03-14 11:35:48'),
(16, 18, 4, 0, '2024-03-14 11:35:48'),
(17, 20, 5, 0, '2024-03-14 11:35:48'),
(18, 20, 6, 0, '2024-03-14 11:35:48'),
(19, 20, 6, 0, '2024-03-14 11:35:48'),
(20, 20, 6, 0, '2024-03-14 11:35:48'),
(21, 20, 6, 0, '2024-03-14 11:35:48'),
(22, 20, 6, 0, '2024-03-14 11:35:48'),
(23, 20, 6, 0, '2024-03-14 11:35:48'),
(24, 20, 6, 0, '2024-03-14 11:35:48'),
(25, 21, 7, 0, '2024-03-14 11:35:48'),
(26, 27, 8, 0, '2024-03-14 11:35:48'),
(27, 27, 9, 0, '2024-03-14 11:35:48'),
(28, 27, 9, 0, '2024-03-14 11:35:48'),
(29, 27, 9, 0, '2024-03-14 11:45:45'),
(30, 27, 9, 0, '2024-03-14 11:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `topic` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `venue` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `unit_id`, `topic`, `date`, `time_from`, `time_to`, `venue`, `user_id`) VALUES
(1, 1, 'Introduction', '2024-03-15', '20:06:00', '20:08:00', 'Hall 4', 17),
(2, 1, 'Intro', '2024-03-15', '20:26:00', '20:27:00', 'Hall1', 16),
(3, 3, 'Mwanza', '2024-03-14', '20:29:00', '20:30:00', 'Hall 7', 17),
(4, 1, 'Functions', '2024-03-12', '09:23:00', '12:23:00', 'Hall 7', 17),
(5, 1, 'Encapsulation', '2024-03-12', '12:49:00', '18:49:00', 'Hall 3', 19),
(6, 8, 'UI', '2024-03-12', '20:21:00', '23:21:00', 'Hall 7', 19),
(7, 9, 'statisitcs', '2024-03-14', '09:17:00', '11:00:00', 'room 3a', 22),
(9, 13, 'Intro', '2024-03-14', '14:05:00', '16:05:00', 'Hall 0', 17);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `school` varchar(50) NOT NULL,
  `course` varchar(30) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` varchar(30) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `school`, `course`, `year`, `semester`, `user_id`) VALUES
(2, 'HIV', 'Medicine', ' Medicine and Surgery', 1, '1', 16),
(3, 'Kiswahili', 'Education', ' Information Technology', 1, '1', 17),
(7, 'Calculus', 'Computing', ' Computer Science', 2, '1', 17),
(8, 'Visual Basic', 'Computing', ' Information Technology', 1, '2', 19),
(9, 'Probability', 'Computing', ' Information Technology', 3, '2', 19),
(13, 'Management', 'Business and Economics', ' Accounting', 1, '2', 17);

-- --------------------------------------------------------

--
-- Table structure for table `unit_registration`
--

CREATE TABLE `unit_registration` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_registration`
--

INSERT INTO `unit_registration` (`id`, `user_id`, `unit_id`) VALUES
(4, 20, 8),
(5, 0, 0),
(6, 20, 7),
(7, 20, 9),
(8, 21, 9),
(9, 27, 13),
(10, 28, 13);

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `school` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `verify_token` varchar(1000) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `phone`, `school`, `password`, `user_type`, `verify_token`, `timestamp`) VALUES
(15, 'Owen', 'owen1@gmailcom', '', '', '32250170a0dca92d53ec9624f336ca24', 'Lecturer', NULL, '2024-03-14 10:24:13'),
(16, 'Mutua', 'nyangeowen01@gmail.com', '', '', '32250170a0dca92d53ec9624f336ca24', 'Student', NULL, '2024-03-14 10:24:13'),
(17, 'Kennedy Mwanza', 'kenmwanza8@gmail.com', '', '', 'b22dea7fe28664817be4754c9b52295a', 'Lecturer', '66253f4d0e3db0008b3601b5873dd430d6a340eedf90ab84c193769e0a5aa113', '2024-03-14 10:24:13'),
(18, 'John Doe', 'john@test.com', '', '', 'b22dea7fe28664817be4754c9b52295a', 'Student', NULL, '2024-03-14 10:24:13'),
(19, 'Moses Wetangula', 'moses@test.com', '', 'Computing', 'b22dea7fe28664817be4754c9b52295a', 'Lecturer', NULL, '2024-03-14 10:24:13'),
(20, 'Alex Wachira', 'alex@test.com', '', 'Computing', 'b22dea7fe28664817be4754c9b52295a', 'Student', '586036ff3c4e61ad95297b6daf0b2e4dce824d3545775bdd85727edf9c87d6c3', '2024-03-14 10:24:13'),
(21, 'David', 'davidmusembi30@gmail.com', '', 'Computing', '49360ba4cbe27a1b900df25b247315d7', 'Student', NULL, '2024-03-14 18:50:48'),
(22, 'sam', 'samdoe@gmail.com', '', 'Education', '49360ba4cbe27a1b900df25b247315d7', 'Lecturer', NULL, '2024-03-14 10:24:13'),
(23, 'owen', 'owen01@gmail.com', '', 'Computing', '32250170a0dca92d53ec9624f336ca24', 'Lecturer', NULL, '2024-03-14 10:24:13'),
(24, 'owen', 'owen01@gmail.com', '', 'Education', 'fcea920f7412b5da7be0cf42b8c93759', 'Student', NULL, '2024-03-14 10:24:13'),
(25, 'Joseph Khandi', 'Khandi@test.com', '', 'Computing', 'b22dea7fe28664817be4754c9b52295a', 'Student', NULL, '2024-03-14 10:24:13'),
(26, 'Michael Njuguna', 'mike@test.com', '', 'Education', 'b22dea7fe28664817be4754c9b52295a', 'Student', NULL, '2024-03-14 10:24:13'),
(27, 'Nimrod', 'nimzy@test.com', '0727333639', 'Business and Economics', 'b22dea7fe28664817be4754c9b52295a', 'Student', NULL, '2024-03-14 10:52:46'),
(28, 'Test ', 'test@test.com', '0727333639', 'Business and Economics', 'b22dea7fe28664817be4754c9b52295a', 'Student', NULL, '2024-03-14 10:24:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_registration`
--
ALTER TABLE `unit_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `unit_registration`
--
ALTER TABLE `unit_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
