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
-- Table structure for table `student_enrollments`
--

CREATE TABLE `student_enrollments` (
  `id` int(11) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `student_username` varchar(100) NOT NULL,
  `enrolled_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_enrollments`
--

INSERT INTO `student_enrollments` (`id`, `course_id`, `student_username`, `enrolled_at`) VALUES
(1, '01', 'anika', '2026-08-23 14:43:19'),
(2, '01', 'adiba', '2026-08-23 14:43:24'),
(4, '02', 'adiba', '2026-08-23 14:50:01'),
(7, '02', 'anika', '2026-08-23 15:22:50'),
(9, '03', 'anika', '2026-08-29 18:26:20'),
(10, '04', 'anika', '2026-08-29 18:26:46'),
(11, '06', 'adiba', '2026-08-29 18:26:55'),
(12, '05', 'adiba', '2026-08-29 18:27:00'),
(13, '04', 'adiba', '2026-08-29 18:27:06'),
(14, '101', 'Steve', '2026-08-29 19:17:38'),
(15, '101', 'Peter', '2026-08-29 19:18:16'),
(16, '101', 'Wanda', '2026-08-29 19:18:22'),
(17, '101', 'Bruce', '2026-08-29 19:18:26'),
(18, '101', 'anika', '2026-08-29 19:27:57'),
(19, '101', 'adiba', '2026-08-29 19:28:02'),
(20, '101', 'bishal2026', '2026-08-29 19:28:06'),
(21, '101', 'fuad', '2026-08-29 19:28:11'),
(22, '01', 'bishal2026', '2026-08-29 19:37:32'),
(23, '03', 'bishal2026', '2026-08-29 19:37:44'),
(24, '02', 'bishal2026', '2026-08-29 19:37:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_enrollments`
--
ALTER TABLE `student_enrollments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_enrollment` (`course_id`,`student_username`),
  ADD KEY `fk_student_user` (`student_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_enrollments`
--
ALTER TABLE `student_enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_enrollments`
--
ALTER TABLE `student_enrollments`
  ADD CONSTRAINT `fk_student_user` FOREIGN KEY (`student_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_enrollments_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
