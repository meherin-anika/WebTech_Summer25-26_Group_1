<?php

// Start session.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "../Model/db.php";

// Check teacher login.
if (
    !isset($_SESSION["logged_in"]) ||
    $_SESSION["logged_in"] !== true ||
    !isset($_SESSION["role"]) ||
    $_SESSION["role"] !== "teacher"
) {
    header("Location: ../login.php");
    exit;
}

// Get logged-in teacher.
$teacher_username = $_SESSION["username"];

// Create database connection.
$db = new db();
$connection = $db->connection();

// Get teacher courses.
$teacher_courses = $db->getTeacherCourses(
    $connection,
    $teacher_username
);
session_start();
include "../Model/db.php";

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] != true || !isset($_SESSION["role"]) || $_SESSION["role"] != "teacher" || !isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$teacher_username = $_SESSION["username"];

$db = new db();
$connection = $db->connection();
$teacher_courses = $db->getTeacherCourses($connection, $teacher_username);
?>
