<!DOCTYPE html>
<html>

<head>

<title>Marks - Student</title>

<style>

/* General */

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


/* Page Title */

.page-title {
    margin-bottom: 30px;
}

.page-title h2 {
    margin-bottom: 8px;
}

.page-title p {
    color: #333333;
}


/* Marks Table */

.table-card {
    background: #fffdf7;

    padding: 25px;

    border-radius: 10px;

    border: 1px solid #eadfc9;

    box-shadow: 0 3px 10px rgba(75, 20, 20, 0.12);

    overflow-x: auto;
}

table {
    width: 100%;

    border-collapse: collapse;
}

th {
    background: #741f2b;

    color: white;

    padding: 13px;

    text-align: left;

    font-size: 14px;
}

td {
    padding: 16px;

    border-bottom: 1px solid #eadfc9;

    font-size: 14px;
}


/* Grade */

.grade {
    font-weight: bold;

    color: #741f2b;
}


/* Empty Table */

.empty-row {
    text-align: center;

    color: #555555;

    padding: 35px;
}


/* Responsive */

@media (max-width: 900px) {

    .container {
        padding: 25px;
    }

    .header {
        padding: 20px;
    }

}

</style>

</head>


<body>


<!-- Header -->

<div class="header">

    <h1>Marks</h1>

    <a href="student.php" class="back">
        Back to Dashboard
    </a>

</div>


<!-- Main Content -->

<div class="container">


    <!-- Page Title -->

    <div class="page-title">

        <h2>My Marks</h2>

        <p>
            View your marks for the courses you are enrolled in.
        </p>

    </div>


    <!-- Marks Table -->

    <div class="table-card">

        <table>

            <thead>

                <tr>

                    <th>Course ID</th>

                    <th>Course Name</th>

                    <th>Course Code</th>

                    <th>Credit</th>

                    <th>Marks</th>

                    <th>Grade</th>

                </tr>

            </thead>


            <tbody>

                <!--
                    Enrolled courses will be loaded
                    from the database later.

                    Marks will be given by the teacher.
                -->

                <tr>

                    <td colspan="6" class="empty-row">
                        No marks available.
                    </td>

                </tr>

            </tbody>

        </table>

    </div>


</div>


</body>

</html>