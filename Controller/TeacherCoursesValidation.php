<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../Model/db.php";

// Check both 'user_type' and 'role' session keys
$userRole = $_SESSION['user_type'] ?? $_SESSION['role'] ?? $_SESSION['user_role'] ?? '';
$username = $_SESSION['username'] ?? $_SESSION['user'] ?? '';

// Perform case-insensitive check for 'teacher'
if (strtolower(trim($userRole)) !== 'teacher' || empty($username)) {
    header("Location: ../View/login.php");
    exit();
}

// Database connection
$database = new db();
$connection = $database->connection();

// Fetch assigned courses
$assigned_courses = $database->getTeacherCourses($connection, $username);
?>