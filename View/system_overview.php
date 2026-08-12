<!DOCTYPE html>
<html>
<head>

<title>System Overview - Main Admin</title>

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

.back {
    background: #fffdf7;
    color: #741f2b;
    padding: 9px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 500;
}

.back:hover {
    background: #f3e8d2;
}

/* Container */

.container {
    padding: 40px;
}

.page-title {
    margin-bottom: 30px;
}

.page-title h2 {
    margin-bottom: 8px;
}

.page-title p {
    color: #000000;
}

/* Overview Cards */

.overview-cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.overview-card {
    background: #fffdf7;
    padding: 25px;
    border-radius: 10px;
    border: 1px solid #eadfc9;
    box-shadow: 0 3px 10px rgba(75, 20, 20, 0.12);
}

.overview-card h3 {
    color: #741f2b;
    margin-bottom: 15px;
    font-size: 17px;
}

.number {
    font-size: 32px;
    font-weight: bold;
    color: #000000;
}

/* Information Section */

.info-card {
    background: #fffdf7;
    padding: 30px;
    border-radius: 10px;
    border: 1px solid #eadfc9;
    box-shadow: 0 3px 10px rgba(75, 20, 20, 0.12);
}

.info-card h3 {
    color: #741f2b;
    margin-bottom: 20px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    padding: 14px 0;
    border-bottom: 1px solid #eadfc9;
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 500;
}

.info-value {
    color: #555555;
}

</style>

</head>

<body>

<div class="header">

    <h1>System Overview</h1>

    <a href="admin.php" class="back">
        Back to Dashboard
    </a>

</div>


<div class="container">

    <div class="page-title">

        <h2>University System Overview</h2>

        <p>
            View overall information about the university management system.
        </p>

    </div>


    <!-- Statistics -->

    <div class="overview-cards">


        <div class="overview-card">

            <h3>Total Students</h3>

            <div class="number">
                —
            </div>

        </div>


        <div class="overview-card">

            <h3>Total Teachers</h3>

            <div class="number">
                —
            </div>

        </div>


        <div class="overview-card">

            <h3>Total Courses</h3>

            <div class="number">
                —
            </div>

        </div>


    </div>


    <!-- System Information -->

    <div class="info-card">

        <h3>System Information</h3>


        <div class="info-row">

            <span class="info-label">
                University
            </span>

            <span class="info-value">
                —
            </span>

        </div>


        <div class="info-row">

            <span class="info-label">
                Total Departments
            </span>

            <span class="info-value">
                —
            </span>

        </div>


        <div class="info-row">

            <span class="info-label">
                Total Enrollments
            </span>

            <span class="info-value">
                —
            </span>

        </div>


        <div class="info-row">

            <span class="info-label">
                System Status
            </span>

            <span class="info-value">
                —
            </span>

        </div>

    </div>

</div>

</body>
</html>