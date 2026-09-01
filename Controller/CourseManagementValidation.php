<?php
// Prevent session re-initialization error
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once "../Model/db.php";

// 1. Live AJAX Uniqueness Check
if (isset($_GET["action"]) && $_GET["action"] === "check_unique") {
    header("Content-Type: application/json");

    $database = new db();
    $connection = $database->connection();

    $field = $_GET["field"] ?? "";
    $value = trim($_GET["value"] ?? "");
    $response = ["isUnique" => true];

    if (!empty($value)) {
        $courses = $database->getCourses($connection);
        if ($courses) {
            while ($course = mysqli_fetch_assoc($courses)) {
                if ($field === "course_id" && strcasecmp($course["course_id"], $value) === 0) {
                    $response["isUnique"] = false;
                    break;
                }
                if ($field === "course_code" && strcasecmp($course["course_code"], $value) === 0) {
                    $response["isUnique"] = false;
                    break;
                }
            }
        }
    }

    echo json_encode($response);
    exit();
}

// 2. Controller Definition
class CourseController
{
    public function handleCourseCreation()
    {
        $message = "";
        $message_type = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $course_id = trim($_POST["course_id"] ?? "");
            $course_name = trim($_POST["course_name"] ?? "");
            $course_code = trim($_POST["course_code"] ?? "");
            $credit = trim($_POST["credit"] ?? "3");
            $day = trim($_POST["day"] ?? "");
            $start_time = trim($_POST["start_time"] ?? "");
            $end_time = trim($_POST["end_time"] ?? "");

            if (empty($course_id) || empty($course_name) || empty($course_code) || empty($credit) || empty($day) || empty($start_time) || empty($end_time)) {
                $message = "Please fill all fields.";
                $message_type = "error";
            } elseif (!is_numeric($credit) || $credit < 1 || $credit > 6) {
                $message = "Course credit must be between 1 and 6.";
                $message_type = "error";
            } else {
                $database = new db();
                $connection = $database->connection();

                $created = $database->createCourse(
                    $connection,
                    $course_id,
                    $course_name,
                    $course_code,
                    $credit,
                    $day,
                    $start_time,
                    $end_time
                );

                if ($created) {
                    $message = "Course created successfully!";
                    $message_type = "success";
                } else {
                    $message = "Failed to create course. Course ID or Code may already exist.";
                    $message_type = "error";
                }
            }
        }

        return [
            "message" => $message,
            "message_type" => $message_type
        ];
    }

    public function fetchAllCoursesWithDetails()
    {
        $database = new db();
        $connection = $database->connection();

        $sql = "SELECT courses.*,
                       users.name AS teacher_name,
                       COUNT(student_enrollments.student_username) AS enrolled_students
                FROM courses
                LEFT JOIN faculty_assignments
                ON courses.course_id = faculty_assignments.course_id
                LEFT JOIN users
                ON faculty_assignments.faculty_username = users.username
                LEFT JOIN student_enrollments
                ON courses.course_id = student_enrollments.course_id
                GROUP BY courses.course_id";

        $result = mysqli_query($connection, $sql);

        if ($result === false) {
            return $database->getCourses($connection);
        }

        return $result;
    }
}

// 3. Form Submission Endpoint (Executes strictly on form POST)
if ($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_GET["action"]) && basename($_SERVER['SCRIPT_FILENAME']) === 'CourseManagementValidation.php') {
    $controller = new CourseController();
    $result = $controller->handleCourseCreation();

    $_SESSION['message'] = $result['message'];
    $_SESSION['message_type'] = $result['message_type'];

    header("Location: ../View/course_management.php");
    exit();
}
?>