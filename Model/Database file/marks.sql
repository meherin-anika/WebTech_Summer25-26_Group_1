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
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `student_username` varchar(50) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `marks` decimal(5,2) NOT NULL CHECK (`marks` between 0 and 100),
  `grade` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `student_username`, `course_id`, `marks`, `grade`) VALUES
(1, 'adiba', '01', 90.00, 'A+'),
(2, 'anika', '01', 75.00, 'A'),
(3, 'adiba', '02', 40.00, 'D'),
(4, 'anika', '02', 60.00, 'B'),
(5, 'anika', '03', 50.00, 'C+'),
(6, 'adiba', '04', 55.00, 'B-'),
(7, 'anika', '04', 45.00, 'C'),
(8, 'Bruce', '101', 75.00, 'A'),
(9, 'Peter', '101', 90.00, 'A+'),
(10, 'Steve', '101', 30.00, 'F'),
(11, 'Wanda', '101', 50.00, 'C+'),
(12, 'adiba', '101', 90.00, 'A+'),
(13, 'anika', '101', 75.00, 'A'),
(14, 'bishal2026', '101', 70.00, 'A-'),
(16, 'fuad', '101', 65.00, 'B+'),
(22, 'bishal2026', '01', 80.00, 'A+'),
(25, 'bishal2026', '02', 70.00, 'A-'),
(27, 'bishal2026', '03', 60.00, 'B');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_student_course` (`student_username`,`course_id`),
  ADD KEY `fk_marks_course` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `fk_marks_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_marks_user` FOREIGN KEY (`student_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
