<!DOCTYPE html>
<html>
<head>

<title>Marks - Student</title>

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
    margin-bottom: 25px;
}

.page-title h2 {
    margin-bottom: 8px;
}

.page-title p {
    color: #000000;
}

/* Summary */

.summary {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 25px;
}

.summary-card {
    background: #fffdf7;
    padding: 22px;
    border-radius: 10px;
    border: 1px solid #eadfc9;
    box-shadow: 0 3px 10px rgba(75, 20, 20, 0.12);
}

.summary-card h3 {
    color: #741f2b;
    margin-bottom: 10px;
    font-size: 16px;
}

.value {
    font-size: 28px;
    font-weight: bold;
}

/* Table */

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

.empty-row {
    text-align: center;
    color: #555555;
    padding: 35px;
}

</style>

</head>

<body>

<div class="header">

    <h1>Marks</h1>

    <a href="student.php" class="back">
        Back to Dashboard
    </a>

</div>


<div class="container">


    <div class="page-title">

        <h2>My Marks</h2>

        <p>
            View your marks and academic results for each course.
        </p>

    </div>


    <!-- Summary -->

    <div class="summary">


        <div class="summary-card">

            <h3>Total Courses</h3>

            <div class="value">
                —
            </div>

        </div>


        <div class="summary-card">

            <h3>Total Credits</h3>

            <div class="value">
                —
            </div>

        </div>


        <div class="summary-card">

            <h3>GPA</h3>

            <div class="value">
                —
            </div>

        </div>


    </div>


    <!-- Marks Table -->

    <div class="table-card">


        <table>


            <thead>

                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Credit</th>
                    <th>Quiz</th>
                    <th>Assignment</th>
                    <th>Midterm</th>
                    <th>Final</th>
                    <th>Total</th>
                    <th>Grade</th>
                </tr>

            </thead>


            <tbody>

                <!--
                    Marks will be loaded from the database
                    using PHP later.
                -->

                <tr>

                    <td colspan="9" class="empty-row">
                        —
                    </td>

                </tr>

            </tbody>


        </table>


    </div>


</div>

</body>
</html>