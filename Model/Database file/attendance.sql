-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2026 at 04:45 PM
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
-- Database: `university_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_username` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `status` enum('present','absent') NOT NULL DEFAULT 'absent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_username`, `course_id`, `date`, `status`) VALUES
(1, 'adiba', '01', '2026-08-29', 'present'),
(2, 'anika', '01', '2026-08-29', 'absent'),
(3, 'adiba', '02', '2026-08-29', 'absent'),
(4, 'anika', '02', '2026-08-29', 'present'),
(5, 'anika', '03', '2026-08-29', 'absent'),
(6, 'adiba', '04', '2026-08-29', 'present'),
(7, 'anika', '04', '2026-08-29', 'present'),
(8, 'Bruce', '101', '2026-08-29', 'present'),
(9, 'Peter', '101', '2026-08-29', 'present'),
(10, 'Steve', '101', '2026-08-29', 'absent'),
(11, 'Wanda', '101', '2026-08-29', 'absent'),
(12, 'adiba', '101', '2026-08-29', 'present'),
(13, 'anika', '101', '2026-08-29', 'present'),
(14, 'bishal2026', '101', '2026-08-29', 'absent'),
(16, 'fuad', '101', '2026-08-29', 'absent'),
(22, 'bishal2026', '02', '2026-08-29', 'present'),
(24, 'bishal2026', '03', '2026-08-29', 'absent'),
(27, 'bishal2026', '01', '2026-08-29', 'present');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_attendance` (`student_username`,`course_id`,`date`),
  ADD KEY `fk_attendance_course` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_attendance_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_attendance_user` FOREIGN KEY (`student_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
