<!DOCTYPE html>
<html>
<head>

<title>Student Enrollment</title>

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


/* Back to Dashboard */

.back {
    background: #fffdf7;
    color: #741f2b;

    height: 37px;
    padding: 0 15px;

    border-radius: 5px;

    text-decoration: none;
    font-weight: 500;

    display: flex;
    align-items: center;
    justify-content: center;
}

.back:hover {
    background: #f3e8d2;
}


/* Main Container */

.container {
    padding: 40px;
}


/* Welcome */

.welcome {
    margin-bottom: 30px;
}

.welcome h2 {
    margin-bottom: 8px;
}

.welcome p {
    color: #333333;
}


/* Student List */

.student-list {
    width: 100%;
    overflow-x: auto;
}


/* Table */

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

th {
    background: #741f2b;
    color: white;

    padding: 12px;

    text-align: left;
}

td {
    padding: 12px;

    border-bottom: 1px solid #ddd;
}


/* Enroll Button */

.enroll-btn {
    background: #741f2b;
    color: white;

    border: none;

    padding: 8px 14px;

    border-radius: 5px;

    cursor: pointer;
}

.enroll-btn:hover {
    background: #5c1721;
}


/* No Data */

.no-data {
    text-align: center;
    color: #555555;

    padding: 25px;
}

</style>

</head>

<body>

<div class="header">

    <h1>Student Enrollment</h1>

    <a href="course_admin.php" class="back">
        Back to Dashboard
    </a>

</div>

<div class="container">

    <div class="welcome">

        <h2>Manage Student Enrollment</h2>

        <p>
            Manage students enrolled in university courses.
        </p>

    </div>

    <div class="student-list">

        <table>

            <thead>

                <tr>

                    <th>Student ID</th>

                    <th>Student Name</th>

                    <th>Course ID</th>

                    <th>Course Name</th>

                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td colspan="5" class="no-data">
                        No enrollment data available.
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>