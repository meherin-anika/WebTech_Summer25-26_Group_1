<!DOCTYPE html>
<html>
<head>

<title>Course Administrator</title>

<link rel="stylesheet" href="../Assets/style.css">

</head>

<body>

<div class="header">

    <h1>Course Administrator Dashboard</h1>

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

        <h2>Welcome, Course Administrator</h2>

        <p>
            Manage courses, faculty and student enrollment.
        </p>

    </div>

    <div class="menu">

        <button onclick="window.location.href='course_management.php'">
            Manage Courses
        </button>

        <button onclick="window.location.href='course_faculty.php'">
            Assign Faculty
        </button>

        <button onclick="window.location.href='course_student.php'">
            Manage Enrollment
        </button>

        <button onclick="window.location.href='edit_profile.php?from=course_admin.php'">
            Edit Profile
        </button>

    </div>

</div>

<script>

function notifications() {
    // Notifications will be connected with database later.
}

</script>

</body>
</html>