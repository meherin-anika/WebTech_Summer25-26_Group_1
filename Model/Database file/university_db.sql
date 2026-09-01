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

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `course_name` varchar(150) NOT NULL,
  `course_code` varchar(50) NOT NULL,
  `credit` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `start_time` varchar(20) NOT NULL,
  `end_time` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_id`, `course_name`, `course_code`, `credit`, `day`, `start_time`, `end_time`, `created_at`) VALUES
(1, '01', 'ICS', '01', 1, 'Sunday', '8', '10', '2026-08-23 14:42:46'),
(2, '02', 'C++', '02', 3, 'Sunday', '10', '11', '2026-08-23 14:45:43'),
(3, '03', 'Java', '03', 3, 'Sunday', '11', '12', '2026-08-23 14:47:10'),
(8, '04', 'Database', '04', 3, 'Monday', '8', '10', '2026-08-23 14:57:35'),
(9, '05', 'Data Structure', '05', 3, 'Monday', '10', '11', '2026-08-23 14:58:23'),
(12, '06', 'C#', '06', 3, 'Monday', '11', '12', '2026-08-23 15:49:29'),
(13, '101', 'Introduction to AI', 'AI101', 6, 'Thursday', '05:00AM', '09:00PM', '2026-08-29 19:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_assignments`
--

CREATE TABLE `faculty_assignments` (
  `id` int(11) NOT NULL,
  `course_id` varchar(50) NOT NULL,
  `faculty_username` varchar(100) NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_assignments`
--

INSERT INTO `faculty_assignments` (`id`, `course_id`, `faculty_username`, `assigned_at`) VALUES
(1, '01', 'TS', '2026-08-23 14:43:09'),
(2, '02', 'TS', '2026-08-23 15:22:40'),
(3, '03', 'TS', '2026-08-23 15:47:15'),
(5, '04', 'teacher02', '2026-08-23 15:47:34'),
(7, '05', 'teacher03', '2026-08-23 15:48:32'),
(8, '06', 'teacher03', '2026-08-23 15:49:41'),
(10, '101', 'TS', '2026-08-29 19:17:13');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `role`, `status`, `created_at`) VALUES
(1, 'Main Admin', 'admin@university.edu', 'admin', '123', 'admin', 'approved', '2026-08-23 11:17:35'),
(2, 'anika', 'anika@gmail.com', 'anika', '123', 'student', 'approved', '2026-08-23 11:18:44'),
(3, 'adiba', 'adiba@gmai.com', 'adiba', '123', 'student', 'approved', '2026-08-23 11:20:25'),
(4, 'teacher01', 'teacher01@gmail.com', 'teacher01', '123', 'teacher', 'approved', '2026-08-23 11:39:12'),
(6, 'Course Admin', 'course.admin@gmail.com', 'course.admin', '123', 'course_admin', 'approved', '2026-08-23 12:19:43'),
(7, 'teacher02', 'teacher02@gmail.com', 'teacher02', '123', 'teacher', 'approved', '2026-08-23 15:43:34'),
(8, 'teacher03', 'teacher03@gamil.com', 'teacher03', '123', 'teacher', 'approved', '2026-08-23 15:46:28'),
(9, 'Bishal Ahmed', 'bishal.ahmed1007@gmail.com', 'bishal2026', '123', 'student', 'approved', '2026-08-29 18:33:02'),
(10, 'Kazi Nafis Fuad Ahmed', 'kazi@gmail.com', 'kazi', '123', 'teacher', 'approved', '2026-08-29 18:33:47'),
(11, 'nafis ahmed', 'nafis@gmail.com', 'nafis', '123', 'teacher', 'approved', '2026-08-29 18:34:33'),
(12, 'fuad ahmed', 'fuad@gmail.com', 'fuad', '123', 'student', 'approved', '2026-08-29 18:35:04'),
(13, 'Tony Stark', 'TS@gmail.com', 'TS', '123', 'teacher', 'approved', '2026-08-29 18:44:19'),
(14, 'Steve Rogers', 'SR@gmail.com', 'Steve', '123', 'student', 'approved', '2026-08-29 18:55:38'),
(15, 'Peter Parker', 'PP@gmail.com', 'Peter', '123', 'student', 'approved', '2026-08-29 18:56:20'),
(16, 'Wanda', 'W@gmail.com', 'Wanda', '123', 'student', 'approved', '2026-08-29 18:57:02'),
(17, 'Bruce Banner', 'BB@gmail.com', 'Bruce', '123', 'student', 'approved', '2026-08-29 18:57:31'),
(18, 'Arthur Morgan', 'AR@gmail.com', 'AR', '123', 'student', 'pending', '2026-08-29 22:07:08'),
(19, 'John Marston', 'JM@gmail.com', 'JM', '123', 'student', 'pending', '2026-08-29 22:07:37'),
(20, 'Micah Bell', 'MB@gmail.com', 'MB', '123', 'student', 'pending', '2026-08-29 22:08:12'),
(21, 'Dutch Van Dar Linde', 'DVDL@gmail.com', 'DVDL', '123', 'teacher', 'pending', '2026-08-29 22:08:54');

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
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_id` (`course_id`);

--
-- Indexes for table `faculty_assignments`
--
ALTER TABLE `faculty_assignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_assignment` (`course_id`,`faculty_username`),
  ADD UNIQUE KEY `course_id` (`course_id`),
  ADD KEY `fk_faculty_user` (`faculty_username`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_student_course` (`student_username`,`course_id`),
  ADD KEY `fk_marks_course` (`course_id`);

--
-- Indexes for table `student_enrollments`
--
ALTER TABLE `student_enrollments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_enrollment` (`course_id`,`student_username`),
  ADD KEY `fk_student_user` (`student_username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `faculty_assignments`
--
ALTER TABLE `faculty_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `student_enrollments`
--
ALTER TABLE `student_enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_attendance_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_attendance_user` FOREIGN KEY (`student_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `faculty_assignments`
--
ALTER TABLE `faculty_assignments`
  ADD CONSTRAINT `faculty_assignments_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_faculty_user` FOREIGN KEY (`faculty_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `fk_marks_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_marks_user` FOREIGN KEY (`student_username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

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
