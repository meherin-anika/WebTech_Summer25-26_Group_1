<?php

session_start();

if (
    !isset($_SESSION["logged_in"]) ||
    $_SESSION["logged_in"] !== true ||
    $_SESSION["role"] !== "teacher"
) {
    header("Location: login.php");
    exit;
}

include "../Model/db.php";

$database = new db();

$connection = $database->connection();

$teacher_username = $_SESSION["username"];

$courses = $database->getTeacherCourses(
    $connection,
    $teacher_username
);

?>

<!DOCTYPE html>

<html>

<head>

    <title>My Courses - Teacher</title>

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
            padding: 40px;
        }

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h2 {
            margin-bottom: 8px;
        }

        .page-title p {
            color: #333333;
        }

        .course-card {
            background: #fffdf7;

            padding: 25px;

            margin-bottom: 18px;

            border-radius: 10px;

            border: 1px solid #eadfc9;

            box-shadow: 0 3px 10px rgba(75, 20, 20, 0.12);
        }

        .course-card h3 {
            color: #741f2b;

            margin-bottom: 15px;
        }

        .course-info {
            margin-bottom: 8px;

            font-size: 14px;
        }

        .label {
            font-weight: bold;
        }

        .empty {
            background: #fffdf7;

            padding: 30px;

            border-radius: 10px;

            border: 1px solid #eadfc9;

            color: #555555;
        }
    </style>

</head>

<body>

    <div class="header">

        <h1>My Courses</h1>

        <a href="teacher.php" class="back">
            Back to Dashboard
        </a>

    </div>


    <div class="container">

        <div class="page-title">

            <h2>Courses Assigned to Me</h2>

            <p>
                These are the courses assigned to your teacher account.
            </p>

        </div>


        <?php if ($courses->num_rows > 0): ?>

            <?php while ($course = $courses->fetch_assoc()): ?>

                <div class="course-card">

                    <h3>

                        <?php

                        echo htmlspecialchars(
                            $course["course_code"]
                            . " - "
                            . $course["course_name"]
                        );

                        ?>

                    </h3>


                    <div class="course-info">

                        <span class="label">
                            Course ID:
                        </span>

                        <?php

                        echo htmlspecialchars(
                            $course["course_id"]
                        );

                        ?>

                    </div>


                    <div class="course-info">

                        <span class="label">
                            Course Name:
                        </span>

                        <?php

                        echo htmlspecialchars(
                            $course["course_name"]
                        );

                        ?>

                    </div>


                    <div class="course-info">

                        <span class="label">
                            Course Code:
                        </span>

                        <?php

                        echo htmlspecialchars(
                            $course["course_code"]
                        );

                        ?>

                    </div>


                    <div class="course-info">

                        <span class="label">
                            Credit:
                        </span>

                        <?php

                        echo htmlspecialchars(
                            $course["credit"]
                        );

                        ?>

                    </div>


                    <div class="course-info">

                        <span class="label">
                            Class Day:
                        </span>

                        <?php

                        echo htmlspecialchars(
                            $course["day"]
                        );

                        ?>

                    </div>


                    <div class="course-info">

                        <span class="label">
                            Class Time:
                        </span>

                        <?php

                        echo htmlspecialchars(
                            $course["start_time"]
                            . " - "
                            . $course["end_time"]
                        );

                        ?>

                    </div>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="empty">

                No courses have been assigned to you yet.

            </div>

        <?php endif; ?>

    </div>

</body>

</html>