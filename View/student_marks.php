<?php
<<<<<<< HEAD
include "../Controller/StudentMarksValidation.php";
=======

if (session_status() === PHP_SESSION_NONE) 
    {
    session_start();
    }

require_once "../Model/db.php";

$userRole=$_SESSION['user_type'] ?? $_SESSION['role'] ?? $_SESSION['user_role'] ?? '';
$student_username=$_SESSION['username'] ?? $_SESSION['user'] ?? '';

if (strtolower(trim($userRole)) != "student" || empty($student_username)) 
    {
    header("Location: login.php");
    exit();
    }

$db=new db();
$connection=$db->connection();

$marks_records=$db->getStudentMarks($connection, $student_username);

>>>>>>> student
?>

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

        html, body {
            height: 100%;
        }

        body {
            background: #f7f0df;
            color: #000000;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

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

        .container {
            width: 750px;
            margin: 40px auto;
            background: #fffdf7;
            border: 1px solid #eadfc9;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(75, 20, 20, 0.12);
            padding: 40px;
        }

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h2 {
            margin-bottom: 8px;
            color: #741f2b;
            font-size: 22px;
        }

        .page-title p {
            color: #333333;
            font-size: 14px;
        }

        .text-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .item-block {
            padding-bottom: 14px;
            border-bottom: 1px solid #eadfc9;
            font-size: 14px;
            line-height: 1.6;
        }

        .item-block:last-child {
            border-bottom: none;
        }

        .item-block strong {
            color: #741f2b;
        }

        .grade-highlight {
            color: #741f2b;
            font-weight: bold;
        }

        .empty-msg {
            color: #555555;
            padding: 10px 0;
            font-size: 14px;
        }

        .footer {
            background: #741f2b;
            color: #fffdf7;
            text-align: center;
            padding: 15px 20px;
            font-size: 14px;
            margin-top: auto;
            width: 100%;
        }

    </style>

</head>

<body>

    <div class="header">

        <h1>Marks</h1>

        <a href="student.php" class="back">Back to Dashboard</a>

    </div>

    <div class="container">

        <div class="page-title">

            <h2>My Marks</h2>

            <p>View your marks for the courses you are enrolled in.</p>

        </div>

        <div class="text-list">

            <?php

<<<<<<< HEAD
            if (!empty($marks_records)) {

                foreach ($marks_records as $row)
=======
            if ($marks_records && $marks_records->num_rows > 0) {

                while ($row = $marks_records->fetch_assoc()) 
>>>>>>> student
                {
                    echo "<div class='item-block'>";

                    echo "<p>";
                    echo "<strong>Course:</strong> ";
<<<<<<< HEAD
                    echo htmlspecialchars($row['course_code'] . " - " . $row['course_name']);
                    echo " (ID: " . htmlspecialchars($row['course_id']) . ")";
=======
                    echo $row['course_code'] . " - " . $row['course_name'];
                    echo " (ID: " . $row['course_id'] . ")";
>>>>>>> student
                    echo "</p>";

                    echo "<p>";
                    echo "<strong>Credits:</strong> ";
<<<<<<< HEAD
                    echo htmlspecialchars($row['credit']);
                    echo " | ";

                    echo "<strong>Marks:</strong> ";
                    echo ($row['marks'] !== null) ? htmlspecialchars($row['marks']) : "N/A";
=======
                    echo $row['credit'];
                    echo " | ";

                    echo "<strong>Marks:</strong> ";
                    echo ($row['marks'] !== null) ? $row['marks'] : "N/A";
>>>>>>> student
                    echo " | ";

                    echo "<strong>Grade:</strong> ";
                    echo "<span class='grade-highlight'>";
<<<<<<< HEAD
                    echo ($row['grade'] !== null) ? htmlspecialchars($row['grade']) : "N/A";
=======
                    echo ($row['grade'] !== null) ? $row['grade'] : "N/A";
>>>>>>> student
                    echo "</span>";

                    echo "</p>";

                    echo "</div>";
                }

<<<<<<< HEAD
            } else
=======
            } else 
>>>>>>> student
            {
                echo "<p class='empty-msg'>";
                echo "No enrolled courses or marks available.";
                echo "</p>";
            }

            ?>

        </div>

    </div>

    <div class="footer">

        <p>
            &copy; <?php echo date("Y"); ?> University Portal. All Rights Reserved.
        </p>

    </div>

</body>

</html>
<<<<<<< HEAD
=======
```
>>>>>>> student
