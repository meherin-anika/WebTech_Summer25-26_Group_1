<!DOCTYPE html>
<html>

<head>

<title>Marks - Teacher</title>

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
    margin-bottom: 25px;
}

.page-title h2 {
    margin-bottom: 8px;
}

.page-title p {
    color: #333333;
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

    font-weight: bold;
}

.controls select {
    width: 300px;

    padding: 11px;

    border: 1px solid #d8cdb8;

    border-radius: 6px;

    background: white;

    color: #000000;

    font-size: 14px;
}

.controls select:focus {
    outline: none;

    border-color: #741f2b;
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
    padding: 14px;

    border-bottom: 1px solid #eadfc9;

    font-size: 14px;
}


/* Mark Input */

.mark-input {
    width: 100px;

    padding: 9px;

    border: 1px solid #d8cdb8;

    border-radius: 5px;

    font-size: 14px;
}

.mark-input:focus {
    outline: none;

    border-color: #741f2b;
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


/* Save Button */

.save-btn {
    margin-top: 20px;

    background: #741f2b;

    color: white;

    border: none;

    padding: 11px 20px;

    border-radius: 5px;

    cursor: pointer;

    font-size: 14px;
}

.save-btn:hover {
    background: #5c1721;
}


/* Responsive */

@media (max-width: 700px) {

    .header {
        padding: 20px;
    }

    .container {
        padding: 25px;
    }

    .controls select {
        width: 100%;
    }

}

</style>

</head>


<body>


<!-- Header -->

<div class="header">

    <h1>Marks</h1>

    <a href="teacher.php" class="back">
        Back to Dashboard
    </a>

</div>


<!-- Main Content -->

<div class="container">


    <!-- Page Title -->

    <div class="page-title">

        <h2>Student Marks</h2>

        <p>
            Enter marks out of 100 for students enrolled in your course.
        </p>

    </div>


    <!-- Course Selection -->

    <div class="controls">

        <label>
            Select Course
        </label>

        <select>

            <option value="">
                Select Course
            </option>

            <!--
                Courses assigned to the teacher
                will be loaded from the database later.
            -->

        </select>

    </div>


    <!-- Student Marks -->

    <div class="table-card">

        <table>

            <thead>

                <tr>

                    <th>Student ID</th>

                    <th>Student Name</th>

                    <th>Marks (Out of 100)</th>

                    <th>Grade</th>

                </tr>

            </thead>


            <tbody>

                <!--
                    Students enrolled in the selected course
                    will be loaded from the database later.
                -->

                <tr>

                    <td colspan="4" class="empty-row">
                        No students available.
                    </td>

                </tr>

            </tbody>

        </table>


        <button class="save-btn">
            Save Marks
        </button>

    </div>


</div>


<script>

/* Calculate Grade */

function calculateGrade(mark) {

    if (mark >= 80) {
        return "A+";
    }

    else if (mark >= 75) {
        return "A";
    }

    else if (mark >= 70) {
        return "A-";
    }

    else if (mark >= 65) {
        return "B+";
    }

    else if (mark >= 60) {
        return "B";
    }

    else if (mark >= 55) {
        return "B-";
    }

    else if (mark >= 50) {
        return "C+";
    }

    else if (mark >= 45) {
        return "C";
    }

    else if (mark >= 40) {
        return "D";
    }

    else {
        return "F";
    }

}


/* Update Grade */

function updateGrade(input) {

    let mark = Number(input.value);

    let gradeCell = input.parentElement.nextElementSibling;

    if (input.value === "") {

        gradeCell.innerText = "—";

        return;

    }

    if (mark < 0 || mark > 100) {

        gradeCell.innerText = "Invalid";

        return;

    }

    gradeCell.innerText = calculateGrade(mark);

}

</script>


</body>

</html>