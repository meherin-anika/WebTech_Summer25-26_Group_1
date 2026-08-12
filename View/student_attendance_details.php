<!DOCTYPE html>
<html>

<head>

    <title>Attendance Details</title>

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


        /* Page Title */

        .page-title {
            margin-bottom: 25px;
        }


        .page-title h2 {
            margin-bottom: 8px;
        }


        .page-title p {
            color: #000000;
        }


        /* Course Information */

        .course-info {
            background: #fffdf7;

            padding: 25px;

            border-radius: 10px;

            border: 1px solid #eadfc9;

            box-shadow: 0 3px 10px rgba(75, 20, 20, 0.12);

            margin-bottom: 25px;
        }


        .course-info h3 {
            color: #741f2b;

            margin-bottom: 20px;
        }


        .course-details {
            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 20px;
        }


        .detail p:first-child {
            color: #666666;

            font-size: 13px;

            margin-bottom: 6px;
        }


        .detail p:last-child {
            font-weight: 500;
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

            font-size: 15px;
        }


        .value {
            font-size: 27px;

            font-weight: bold;
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
            padding: 15px;

            border-bottom: 1px solid #eadfc9;

            font-size: 14px;
        }


        .empty-row {
            text-align: center;

            color: #555555;

            padding: 35px;
        }


        /* Responsive */

        @media (max-width: 800px) {

            .container {
                padding: 25px;
            }

            .course-details {
                grid-template-columns: 1fr;
            }

            .summary {
                grid-template-columns: 1fr;
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

        <h1>Attendance Details</h1>

        <a
            href="student_attendance.php"
            class="back"
        >
            Change Course
        </a>

    </div>


    <!-- Main Content -->

    <div class="container">


        <!-- Page Title -->

        <div class="page-title">

            <h2>Course Attendance</h2>

            <p>
                View your attendance records for the selected course.
            </p>

        </div>


        <!-- Course Information -->

        <div class="course-info">

            <h3>Course Information</h3>


            <div class="course-details">


                <div class="detail">

                    <p>Course ID</p>

                    <p>—</p>

                </div>


                <div class="detail">

                    <p>Course Name</p>

                    <p>—</p>

                </div>


                <div class="detail">

                    <p>Teacher</p>

                    <p>—</p>

                </div>


            </div>

        </div>


        <!-- Attendance Summary -->

        <div class="summary">


            <div class="summary-card">

                <h3>Total Classes</h3>

                <div class="value">
                    —
                </div>

            </div>


            <div class="summary-card">

                <h3>Classes Present</h3>

                <div class="value">
                    —
                </div>

            </div>


            <div class="summary-card">

                <h3>Attendance Percentage</h3>

                <div class="value">
                    —
                </div>

            </div>


        </div>


        <!-- Attendance Records -->

        <div class="table-card">

            <table>

                <thead>

                    <tr>

                        <th>Date</th>

                        <th>Status</th>

                    </tr>

                </thead>


                <tbody>

                    <tr>

                        <td colspan="2" class="empty-row">

                            No attendance records available.

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>


    </div>


</body>

</html>