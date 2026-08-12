<!DOCTYPE html>
<html>
<head>

<title>Attendance - Teacher</title>

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

/* Course Selection */

.controls {
    background: #fffdf7;
    padding: 25px;
    border-radius: 10px;
    border: 1px solid #eadfc9;
    box-shadow: 0 3px 10px rgba(75, 20, 20, 0.12);
    margin-bottom: 25px;
}

.controls label {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 500;
}

.controls select,
.controls input {
    width: 300px;
    padding: 11px;
    border: 1px solid #d8cdb8;
    border-radius: 6px;
    background: white;
    color: #000000;
    outline: none;
}

.controls select:focus,
.controls input:focus {
    border-color: #741f2b;
}

/* Attendance Table */

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

/* Save Button */

.save-btn {
    margin-top: 20px;
    background: #741f2b;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.save-btn:hover {
    background: #5c1721;
}

</style>

</head>

<body>

<div class="header">

    <h1>Attendance</h1>

    <a href="teacher.php" class="back">
        Back to Dashboard
    </a>

</div>


<div class="container">

    <div class="page-title">

        <h2>Student Attendance</h2>

        <p>
            Record and manage attendance for your courses.
        </p>

    </div>


    <!-- Course and Date Selection -->

    <div class="controls">

        <label>Select Course</label>

        <select>

            <option value="">
                Select Course
            </option>

        </select>


        <br><br>


        <label>Select Date</label>

        <input type="date">

    </div>


    <!-- Attendance Table -->

    <div class="table-card">

        <table>

            <thead>

                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Status</th>
                </tr>

            </thead>


            <tbody>

                <tr>

                    <td colspan="3" class="empty-row">
                        —
                    </td>

                </tr>

            </tbody>

        </table>


        <button class="save-btn">
            Save Attendance
        </button>

    </div>

</div>

</body>
</html>