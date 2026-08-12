<!DOCTYPE html>
<html>

<head>

    <title>Student Attendance</title>

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
            color: #000000;
        }


        /* Selection Card */

        .selection-card {
            width: 600px;

            background: #fffdf7;

            padding: 30px;

            border-radius: 10px;

            border: 1px solid #eadfc9;

            box-shadow: 0 3px 10px rgba(75, 20, 20, 0.12);
        }


        .selection-card label {
            display: block;

            margin-bottom: 8px;

            font-size: 14px;

            font-weight: 500;
        }


        .selection-card select {
            width: 100%;

            padding: 12px;

            border: 1px solid #d8cdb8;

            border-radius: 6px;

            background: white;

            color: #000000;

            font-size: 14px;

            margin-bottom: 20px;
        }


        .selection-card select:focus {
            outline: none;

            border-color: #741f2b;
        }


        /* Button */

        .view-btn {
            background: #741f2b;

            color: white;

            border: none;

            padding: 11px 20px;

            border-radius: 5px;

            cursor: pointer;

            font-size: 14px;
        }


        .view-btn:hover {
            background: #5c1721;
        }


        /* Responsive */

        @media (max-width: 700px) {

            .container {
                padding: 25px;
            }

            .selection-card {
                width: 100%;
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

        <h1>Attendance</h1>

        <a href="student.php" class="back">
            Back to Dashboard
        </a>

    </div>


    <!-- Main Content -->

    <div class="container">


        <div class="page-title">

            <h2>View Attendance</h2>

            <p>
                Select a course to view your attendance records.
            </p>

        </div>


        <!-- Course Selection -->

        <div class="selection-card">

            <form
                action="student_attendance_details.php"
                method="GET"
            >

                <label>
                    Select Course
                </label>


                <select
                    name="course_id"
                    required
                >

                    <option value="">
                        Select Course
                    </option>

                    <!--
                        Courses will be loaded from
                        the database later.
                    -->

                </select>


                <button
                    type="submit"
                    class="view-btn"
                >
                    View Attendance
                </button>

            </form>

        </div>


    </div>


</body>

</html>