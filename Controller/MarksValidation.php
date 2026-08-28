<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../Model/db.php";

// Session check for teacher
$userRole = $_SESSION['user_type'] ?? $_SESSION['role'] ?? $_SESSION['user_role'] ?? '';
$teacher_username = $_SESSION['username'] ?? $_SESSION['user'] ?? '';

if (strtolower(trim($userRole)) !== 'teacher' || empty($teacher_username)) {
    header("Location: ../View/login.php");
    exit();
}

$db = new db();
$connection = $db->connection();

// 1. Fetch courses assigned to this teacher
$courses = $db->getTeacherCourses($connection, $teacher_username);

$selected_course = $_GET['course_id'] ?? '';
$students = false;
$existing_marks = [];
$message = "";

if (!empty($selected_course)) {
    // 2. Fetch enrolled students for selected course
    $students = $db->getCourseStudents($connection, $selected_course);

    // 3. Fetch current marks for selected course
    $marks_res = $db->getMarks($connection, $selected_course);
    if ($marks_res) {
        while ($row = $marks_res->fetch_assoc()) {
            $existing_marks[$row['student_username']] = [
                'marks' => $row['marks'],
                'grade' => $row['grade']
            ];
        }
    }
}

// 4. Handle Marks Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_marks'])) {
    $course_id = $_POST['course_id'] ?? '';
    $marks_data = $_POST['marks'] ?? [];

    if (!empty($course_id) && is_array($marks_data)) {
        $all_saved = true;
        foreach ($marks_data as $student_username => $mark_val) {
            if ($mark_val !== "") {
                $num_mark = floatval($mark_val);
                
                // Calculate grade
                if ($num_mark >= 80) $grade = "A+";
                elseif ($num_mark >= 75) $grade = "A";
                elseif ($num_mark >= 70) $grade = "A-";
                elseif ($num_mark >= 65) $grade = "B+";
                elseif ($num_mark >= 60) $grade = "B";
                elseif ($num_mark >= 55) $grade = "B-";
                elseif ($num_mark >= 50) $grade = "C+";
                elseif ($num_mark >= 45) $grade = "C";
                elseif ($num_mark >= 40) $grade = "D";
                else $grade = "F";

                $saved = $db->saveMark($connection, $course_id, $student_username, $num_mark, $grade);
                if (!$saved) {
                    $all_saved = false;
                }
            }
        }
        if ($all_saved) {
            header("Location: ../View/teacher_marks.php?course_id=" . urlencode($course_id) . "&status=success");
            exit();
        } else {
            $message = "Error saving some marks.";
        }
    }
}

if (isset($_GET['status']) && $_GET['status'] === 'success') {
    $message = "Marks saved successfully!";
}
?>