<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../Model/db.php";

$userRole = $_SESSION['user_type'] ?? $_SESSION['role'] ?? $_SESSION['user_role'] ?? '';
$student_username = $_SESSION['username'] ?? $_SESSION['user'] ?? '';

if (strtolower(trim($userRole)) !== 'student' || empty($student_username)) {
    header("Location: login.php");
    exit();
}

$db = new db();
$connection = $db->connection();
$enrolled_courses = $db->getStudentEnrolledCourses($connection, $student_username);
?>
<!DOCTYPE html>
<html>
<head>
<title>My Courses - Student</title>
<style>
* { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
html, body { height: 100%; }
body { background: #f7f0df; color: #000000; display: flex; flex-direction: column; min-height: 100vh; }
.header { background: #741f2b; color: white; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
.header h1 { font-size: 24px; }
.back { background: #fffdf7; color: #741f2b; height: 37px; padding: 0 15px; border-radius: 5px; text-decoration: none; font-weight: 500; display: flex; align-items: center; justify-content: center; }
.back:hover { background: #f3e8d2; }

/* Centered White Container Box */
.container { 
    width: 750px; 
    margin: 40px auto; 
    background: #fffdf7; 
    border: 1px solid #eadfc9; 
    border-radius: 12px; 
    box-shadow: 0 5px 20px rgba(75, 20, 20, 0.12); 
    padding: 40px; 
}

.page-title { margin-bottom: 25px; }
.page-title h2 { margin-bottom: 8px; color: #741f2b; font-size: 22px; }
.page-title p { color: #333333; font-size: 14px; }

.text-list { display: flex; flex-direction: column; gap: 14px; }
.item-block { padding-bottom: 14px; border-bottom: 1px solid #eadfc9; font-size: 14px; line-height: 1.6; }
.item-block:last-child { border-bottom: none; }
.item-block strong { color: #741f2b; }
.empty-msg { color: #555555; padding: 10px 0; font-size: 14px; }

.footer { background: #741f2b; color: #fffdf7; text-align: center; padding: 15px 20px; font-size: 14px; margin-top: auto; width: 100%; }

@media (max-width: 800px) { .container { width: 90%; padding: 25px; } }
</style>
</head>
<body>

<div class="header">
    <h1>My Courses</h1>
    <a href="student.php" class="back">Back to Dashboard</a>
</div>

<div class="container">
    <div class="page-title">
        <h2>My Enrolled Courses</h2>
        <p>View the courses you are currently enrolled in.</p>
    </div>

    <div class="text-list">
        <?php if ($enrolled_courses && $enrolled_courses->num_rows > 0): ?>
            <?php while ($course = $enrolled_courses->fetch_assoc()): ?>
                <?php 
                    $start = date("h:i A", strtotime($course['start_time']));
                    $end = date("h:i A", strtotime($course['end_time']));
                ?>
                <div class="item-block">
                    <p><strong>Course:</strong> <?php echo htmlspecialchars($course['course_code'] . " - " . $course['course_name']); ?> (ID: <?php echo htmlspecialchars($course['course_id']); ?>)</p>
                    <p><strong>Credit:</strong> <?php echo htmlspecialchars($course['credit']); ?> | <strong>Schedule:</strong> <?php echo htmlspecialchars($course['day']); ?>, <?php echo htmlspecialchars($start . " - " . $end); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="empty-msg">No enrolled courses available.</p>
        <?php endif; ?>
    </div>
</div>

<div class="footer">
    <p>&copy; <?php echo date("Y"); ?> University Portal. All Rights Reserved.</p>
</div>

</body>
</html>