<?php
session_start();
include "../Model/db.php";

$database = new db();
$connection = $database->connection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $course_id = trim($_POST["course_id"] ?? "");
    $student_username = trim($_POST["student_username"] ?? "");

    if (empty($course_id) || empty($student_username)) {
        $_SESSION['message'] = "Please select both a course and a student.";
        $_SESSION['message_type'] = "error";
    } else {
        $enrolled = $database->enrollStudent($connection, $course_id, $student_username);
        if ($enrolled) {
            $_SESSION['message'] = "Student successfully enrolled in course!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to enroll student.";
            $_SESSION['message_type'] = "error";
        }
    }
}

header("Location: ../View/course_student.php");
exit();
?>