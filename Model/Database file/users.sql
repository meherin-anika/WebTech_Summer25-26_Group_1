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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
