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

$selected_course = "";
$selected_date = date("Y-m-d");

$students = [];
$attendance = [];

$message = "";
$error = "";

// Handle course and date selection.
if (isset($_GET["course_id"])) {

    $selected_course = trim($_GET["course_id"]);

    if ($selected_course !== "") {

        // Check teacher course assignment.
        if (
            $db->isTeacherAssignedToCourse(
                $connection,
                $teacher_username,
                $selected_course
            )
        ) {

            // Get selected date.
            if (
                isset($_GET["date"]) &&
                $_GET["date"] !== ""
            ) {
                $selected_date = $_GET["date"];
            }

            // Get course students.
            $students = $db->getCourseStudents(
                $connection,
                $selected_course
            );

            // Get attendance.
            $attendance = $db->getAttendance(
                $connection,
                $selected_course,
                $selected_date
            );

        } else {

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

$selected_course = "";
$selected_date = date("Y-m-d");
$students = [];
$attendance = [];
$message = "";
$error = "";

if (isset($_GET["course_id"])) {
    $selected_course = trim($_GET["course_id"]);

    if ($selected_course != "") {
        if ($db->isTeacherAssignedToCourse($connection, $teacher_username, $selected_course)) {
            if (isset($_GET["date"]) && $_GET["date"] != "") {
                $selected_date = $_GET["date"];
            }

            $students = $db->getCourseStudents($connection, $selected_course);
            $attendance = $db->getAttendance($connection, $selected_course, $selected_date);
        } else {
            $error = "You are not assigned to this course.";
            $selected_course = "";
        }
    }
}

// Handle attendance submission.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $selected_course = isset($_POST["course_id"])
        ? trim($_POST["course_id"])
        : "";

    $selected_date = isset($_POST["date"])
        ? trim($_POST["date"])
        : "";

    // Check course selection.
    if ($selected_course === "") {

        $error = "Please select a course.";

        // Check date selection.
    } elseif ($selected_date === "") {

        $error = "Please select a date.";

        // Check teacher assignment.
    } elseif (
        !$db->isTeacherAssignedToCourse(
            $connection,
            $teacher_username,
            $selected_course
        )
    ) {

        $error = "You are not assigned to this course.";

        // Process attendance.
    } elseif (
        isset($_POST["attendance"]) &&
        is_array($_POST["attendance"])
    ) {

        foreach ($_POST["attendance"] as $student_username => $status) {

            // Validate attendance status.
            if (
                $status !== "present" &&
                $status !== "absent"
            ) {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_course = trim($_POST["course_id"] ?? "");
    $selected_date = trim($_POST["date"] ?? "");
    $valid_date = false;
    $date_parts = explode("-", $selected_date);

    if (count($date_parts) == 3) {
        $valid_date = checkdate((int) $date_parts[1], (int) $date_parts[2], (int) $date_parts[0]);
    }

    if ($selected_course == "") {
        $error = "Please select a course.";
    } elseif ($selected_date == "") {
        $error = "Please select a date.";
    } elseif (!$valid_date) {
        $error = "Please select a valid date.";
    } elseif (!$db->isTeacherAssignedToCourse($connection, $teacher_username, $selected_course)) {
        $error = "You are not assigned to this course.";
    } elseif (isset($_POST["attendance"]) && is_array($_POST["attendance"])) {
        $students = $db->getCourseStudents($connection, $selected_course);

        foreach ($_POST["attendance"] as $student_username => $status) {
            $student_allowed = false;

            foreach ($students as $student) {
                if ($student["username"] == $student_username) {
                    $student_allowed = true;
                    break;
                }
            }

            if (!$student_allowed) {
                $error = "Invalid student for this course.";
                break;
            } elseif ($status != "present" && $status != "absent") {
                $error = "Invalid attendance status.";
                break;
            }

            // Save attendance.
            $db->saveAttendance(
                $connection,
                $selected_course,
                $student_username,
                $selected_date,
                $status
            );
        }

        // Show success message.
        if ($error === "") {
            $message = "Attendance saved successfully.";
        }
    }

    // Reload attendance data.
    if ($error === "") {

        $students = $db->getCourseStudents(
            $connection,
            $selected_course
        );

        $attendance = $db->getAttendance(
            $connection,
            $selected_course,
            $selected_date
        );
    }
}
            $saved = $db->saveAttendance($connection, $selected_course, $student_username, $selected_date, $status);

            if (!$saved) {
                $error = "Unable to save attendance.";
                break;
            }
        }

        if ($error == "") {
            $message = "Attendance saved successfully.";
        }
    } else {
        $error = "Attendance data is missing.";
    }

    if ($selected_course != "" && $db->isTeacherAssignedToCourse($connection, $teacher_username, $selected_course)) {
        $students = $db->getCourseStudents($connection, $selected_course);
        $attendance = $db->getAttendance($connection, $selected_course, $selected_date);
    }
}
?>
