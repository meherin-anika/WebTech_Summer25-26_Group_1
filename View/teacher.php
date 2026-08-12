<!DOCTYPE html>
<html>
<head>

<title>Teacher Dashboard</title>

<style>

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

body {
    background: #f7f0df;
    color: #000000;
}

/* Header */

.header {
    background: #741f2b;
    color: white;
    padding: 20px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header h1 {
    font-size: 24px;
}

/* Logout */

.logout {
    background: #fffdf7;
    color: #741f2b;
    padding: 9px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 500;
}

.logout:hover {
    background: #f3e8d2;
}

/* Container */

.container {
    padding: 40px;
}

/* Welcome */

.welcome {
    margin-bottom: 30px;
}

.welcome h2 {
    margin-bottom: 8px;
    color: #000000;
}

.welcome p {
    color: #000000;
}

/* Cards */

.cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.card {
    background: #fffdf7;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(75, 20, 20, 0.12);
    border: 1px solid #eadfc9;
}

.card h3 {
    color: #741f2b;
    margin-bottom: 12px;
}

.card p {
    color: #000000;
    margin-bottom: 20px;
    line-height: 1.5;
}

/* Buttons */

button {
    background: #741f2b;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

button:hover {
    background: #5c1721;
}

</style>

</head>

<body>

<div class="header">

    <h1>Teacher Dashboard</h1>

    <a href="login.php" class="logout">
        Logout
    </a>

</div>

<div class="container">

    <div class="welcome">

        <h2>Welcome, Teacher</h2>

        <p>
            Manage your courses and student academic information.
        </p>

    </div>

    <div class="cards">

        <div class="card">

            <h3>My Courses</h3>

            <p>
                View the courses assigned to you.
            </p>

            <button onclick="window.location.href='teacher_courses.php'">
            View Courses
            </button>

        </div>


        <div class="card">

            <h3>Attendance</h3>

            <p>
                Record and manage student attendance.
            </p>

            <button onclick="window.location.href='teacher_attendance.php'">
            Manage Attendance
            </button>

        </div>


        <div class="card">

            <h3>Marks</h3>

            <p>
                Enter and manage student marks.
            </p>

            <button onclick="window.location.href='teacher_marks.php'">
            Enter Marks
            </button>

        </div>

    </div>

</div>

<script>

function message(text) {
    alert(text + " page will be connected later.");
}

</script>

</body>
</html>