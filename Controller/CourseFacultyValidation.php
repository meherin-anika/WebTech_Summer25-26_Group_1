<?php
session_start();
include "../Model/db.php";

$database = new db();
$connection = $database->connection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $course_id = trim($_POST["course_id"] ?? "");
    $faculty_username = trim($_POST["faculty_username"] ?? "");

    if (empty($course_id) || empty($faculty_username)) {
        $_SESSION['message'] = "Please select both a course and a teacher.";
        $_SESSION['message_type'] = "error";
    } else {
        $assigned = $database->assignFaculty($connection, $course_id, $faculty_username);
        if ($assigned) {
            $_SESSION['message'] = "Faculty successfully assigned to course!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Failed to assign faculty.";
            $_SESSION['message_type'] = "error";
        }
    }
}

header("Location: ../View/course_faculty.php");
exit();
?>