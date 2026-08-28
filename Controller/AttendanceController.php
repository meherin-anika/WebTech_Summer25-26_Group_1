<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../Model/db.php';

// Session Validation
$userRole = $_SESSION['user_type'] ?? $_SESSION['role'] ?? $_SESSION['user_role'] ?? '';
$teacher_username = $_SESSION['username'] ?? $_SESSION['user'] ?? '';

if (strtolower(trim($userRole)) !== 'teacher' || empty($teacher_username)) {
    header('Location: ../View/login.php');
    exit();
}

$db = new db();
$connection = $db->connection();

// 1. Fetch courses assigned to this teacher
$assigned_courses = $db->getTeacherCourses($connection, $teacher_username);

$selected_course = $_GET['course_id'] ?? '';
$selected_date = $_GET['attendance_date'] ?? date('Y-m-d');

$students = false;
$existing_attendance = [];

if (!empty($selected_course)) {
    // 2. Fetch enrolled students for selected course
    $students = $db->getCourseStudents($connection, $selected_course);

    // 3. Fetch existing attendance records for selected course and date
    $att_res = $db->getAttendance($connection, $selected_course, $selected_date);
    if ($att_res) {
        while ($row = $att_res->fetch_assoc()) {
            $existing_attendance[$row['student_username']] = $row['status'];
        }
    }
}

// 4. Handle Attendance Submission
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_attendance'])) {
    $course_id = $_POST['course_id'] ?? '';
    $attendance_date = $_POST['attendance_date'] ?? '';
    $attendance_data = $_POST['attendance'] ?? []; // Array of student_username => status

    if (!empty($course_id) && !empty($attendance_date) && is_array($attendance_data)) {
        $all_saved = true;
        foreach ($attendance_data as $student_username => $status) {
            $saved = $db->saveAttendance($connection, $course_id, $student_username, $attendance_date, $status);
            if (!$saved) {
                $all_saved = false;
            }
        }
        if ($all_saved) {
            header("Location: ../View/teacher_attendance.php?course_id=" . urlencode($course_id) . "&attendance_date=" . urlencode($attendance_date) . "&status=success");
            exit();
        } else {
            $message = "Error saving some attendance records.";
        }
    } else {
        $message = "Please select a valid course, date, and attendance statuses.";
    }
}

if (isset($_GET['status']) && $_GET['status'] === 'success') {
    $message = "Attendance recorded successfully!";
}
?>