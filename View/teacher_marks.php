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

$message = "";

$selected_course =
    $_GET["course_id"] ??
    $_POST["course_id"] ??
    "";


/* ==========================================
   GRADE CALCULATION
   ========================================== */

function calculateGrade($mark)
{
    if ($mark >= 80) {
        return "A+";
    }

    if ($mark >= 75) {
        return "A";
    }

    if ($mark >= 70) {
        return "A-";
    }

    if ($mark >= 65) {
        return "B+";
    }

    if ($mark >= 60) {
        return "B";
    }

    if ($mark >= 55) {
        return "B-";
    }

    if ($mark >= 50) {
        return "C+";
    }

    if ($mark >= 45) {
        return "C";
    }

    if ($mark >= 40) {
        return "D";
    }

    return "F";
}


/* ==========================================
   SAVE MARKS
   ========================================== */

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $course_id =
        trim($_POST["course_id"] ?? "");


    if (empty($course_id)) {

        $message =
            "Please select a course.";

    } elseif (
        !$database->isTeacherAssignedToCourse(
            $connection,
            $teacher_username,
            $course_id
        )
    ) {

        $message =
            "You are not assigned to this course.";

    } else {

        $marks_data =
            $_POST["marks"] ?? [];


        foreach (
            $marks_data
            as $student_username => $mark
        ) {

            if ($mark === "") {
                continue;
            }


            $mark = floatval($mark);


            if (
                $mark >= 0 &&
                $mark <= 100
            ) {

                $grade =
                    calculateGrade($mark);


                $database->saveMark(
                    $connection,
                    $course_id,
                    $student_username,
                    $mark,
                    $grade
                );
            }
        }


        $message =
            "Marks saved successfully.";


        $selected_course =
            $course_id;
    }
}


/* ==========================================
   GET TEACHER COURSES
   ========================================== */

$courses =
    $database->getTeacherCourses(
        $connection,
        $teacher_username
    );


/* ==========================================
   GET STUDENTS
   ========================================== */

$students = false;

$existing_marks = [];


if (!empty($selected_course)) {

    if (
        $database->isTeacherAssignedToCourse(
            $connection,
            $teacher_username,
            $selected_course
        )
    ) {

        $students =
            $database->getCourseStudents(
                $connection,
                $selected_course
            );


        $marks_result =
            $database->getMarks(
                $connection,
                $selected_course
            );


        while (
            $mark =
            $marks_result->fetch_assoc()
        ) {

            $existing_marks[
                $mark["student_username"]
            ] = [
                "marks" =>
                    $mark["marks"],

                "grade" =>
                    $mark["grade"]
            ];
        }
    }
}

?>

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
        }

        .message {
            background: #d4edda;

            color: #155724;

            border: 1px solid #c3e6cb;

            padding: 12px;

            border-radius: 6px;

            margin-bottom: 20px;
        }

        .student-card {
            background: #fffdf7;

            padding: 20px;

            margin-bottom: 15px;

            border-radius: 10px;

            border: 1px solid #eadfc9;

            box-shadow: 0 3px 10px rgba(75, 20, 20, 0.12);

            display: flex;

            justify-content: space-between;

            align-items: center;
        }

        .student-info h3 {
            color: #741f2b;

            margin-bottom: 6px;
        }

        .student-info p {
            font-size: 14px;

            margin-bottom: 4px;
        }

        .mark-area {
            display: flex;

            align-items: center;

            gap: 12px;
        }

        .mark-input {
            width: 100px;

            padding: 9px;

            border: 1px solid #d8cdb8;

            border-radius: 5px;
        }

        .grade {
            font-weight: bold;

            color: #741f2b;

            min-width: 40px;
        }

        .save-btn {
            margin-top: 10px;

            background: #741f2b;

            color: white;

            border: none;

            padding: 12px 25px;

            border-radius: 5px;

            cursor: pointer;

            font-size: 14px;
        }

        .save-btn:hover {
            background: #5c1721;
        }

        .empty {
            background: #fffdf7;

            padding: 30px;

            border-radius: 10px;

            border: 1px solid #eadfc9;

            color: #555555;
        }

        @media (max-width: 700px) {

            .container {
                padding: 25px;
            }

            .controls select {
                width: 100%;
            }

            .student-card {
                flex-direction: column;

                align-items: flex-start;

                gap: 15px;
            }

        }
    </style>

</head>

<body>


    <div class="header">

        <h1>Marks</h1>

        <a href="teacher.php" class="back">
            Back to Dashboard
        </a>

    </div>


    <div class="container">


        <div class="page-title">

            <h2>
                Student Marks
            </h2>

            <p>
                Enter marks out of 100 for students enrolled in your course.
            </p>

        </div>


        <?php if (!empty($message)): ?>

            <div class="message">

                <?php

                echo htmlspecialchars(
                    $message
                );

                ?>

            </div>

        <?php endif; ?>


        <div class="controls">

            <form method="GET">

                <label>
                    Select Course
                </label>


                <select name="course_id" onchange="this.form.submit()" required>

                    <option value="">
                        Select Course
                    </option>


                    <?php while (
                        $course =
                        $courses->fetch_assoc()
                    ): ?>

                        <option value="<?php
                        echo htmlspecialchars(
                            $course["course_id"]
                        );
                        ?>" <?php

                        if (
                            $selected_course ===
                            $course["course_id"]
                        ) {
                            echo "selected";
                        }

                        ?>>

                            <?php

                            echo htmlspecialchars(
                                $course["course_code"]
                                . " - "
                                . $course["course_name"]
                            );

                            ?>

                        </option>

                    <?php endwhile; ?>

                </select>

            </form>

        </div>


        <?php if ($students !== false): ?>


            <?php if ($students->num_rows > 0): ?>


                <form method="POST">

                    <input type="hidden" name="course_id" value="<?php
                    echo htmlspecialchars(
                        $selected_course
                    );
                    ?>">


                    <?php while (
                        $student =
                        $students->fetch_assoc()
                    ): ?>


                        <?php

                        $username =
                            $student["username"];


                        $current_mark =
                            $existing_marks[
                                $username
                            ]["marks"] ?? "";


                        $current_grade =
                            $existing_marks[
                                $username
                            ]["grade"] ?? "";

                        ?>


                        <div class="student-card">


                            <div class="student-info">

                                <h3>

                                    <?php

                                    echo htmlspecialchars(
                                        $student["name"]
                                    );

                                    ?>

                                </h3>


                                <p>

                                    Student ID:

                                    <?php

                                    echo htmlspecialchars(
                                        $student["username"]
                                    );

                                    ?>

                                </p>

                            </div>


                            <div class="mark-area">


                                <input class="mark-input" type="number" name="marks[<?php
                                echo htmlspecialchars(
                                    $username
                                );
                                ?>]" min="0" max="100" step="0.01" value="<?php
                                echo htmlspecialchars(
                                    $current_mark
                                );
                                ?>" placeholder="0 - 100" oninput="updateGrade(this)">


                                <span class="grade">

                                    <?php

                                    echo $current_grade !== ""
                                        ? htmlspecialchars(
                                            $current_grade
                                        )
                                        : "—";

                                    ?>

                                </span>


                            </div>

                        </div>


                    <?php endwhile; ?>


                    <button type="submit" class="save-btn">
                        Save Marks
                    </button>


                </form>


            <?php else: ?>


                <div class="empty">

                    No students are enrolled in this course.

                </div>


            <?php endif; ?>


        <?php elseif (!empty($selected_course)): ?>


            <div class="empty">

                You are not assigned to this course.

            </div>


        <?php endif; ?>


    </div>


    <script>

        function calculateGrade(mark) {
            if (mark >= 80) {
                return "A+";
            }

            if (mark >= 75) {
                return "A";
            }

            if (mark >= 70) {
                return "A-";
            }

            if (mark >= 65) {
                return "B+";
            }

            if (mark >= 60) {
                return "B";
            }

            if (mark >= 55) {
                return "B-";
            }

            if (mark >= 50) {
                return "C+";
            }

            if (mark >= 45) {
                return "C";
            }

            if (mark >= 40) {
                return "D";
            }

            return "F";
        }


        function updateGrade(input) {
            let mark = Number(input.value);

            let grade =
                input.parentElement.querySelector(".grade");


            if (input.value === "") {

                grade.innerText = "—";

                return;
            }


            if (
                mark < 0 ||
                mark > 100
            ) {

                grade.innerText =
                    "Invalid";

                return;
            }


            grade.innerText =
                calculateGrade(mark);
        }

    </script>


</body>

</html>