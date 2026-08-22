<!DOCTYPE html>
<html>
<head>

<title>Student Dashboard</title>

<link rel="stylesheet" href="../Assets/style.css">

</head>

<body>

<div class="header">

    <h1>Student Dashboard</h1>

    <div class="header-right">

        <div class="notification" onclick="notifications()">
            Notifications
        </div>

        <a href="login.php" class="logout">
            Logout
        </a>

    </div>

</div>

<div class="container">

    <div class="welcome">

        <h2>Welcome, Student</h2>

        <p>
            View your courses and academic information.
        </p>

    </div>

    <div class="menu">

        <button onclick="window.location.href='student_courses.php'">
            My Courses
        </button>

        <button onclick="window.location.href='student_attendance.php'">
            Attendance
        </button>

        <button onclick="window.location.href='student_marks.php'">
            Marks
        </button>

        <button onclick="window.location.href='edit_profile.php?from=student.php'">
            Edit Profile
        </button>

    </div>

</div>

<script>

function notifications() {
    // Notifications will be connected with the database later.
}

</script>

</body>
</html>