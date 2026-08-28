<?php require_once "../Controller/TeacherCoursesValidation.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <title>My Courses - Teacher</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
        html, body { height: 100%; }
        body { background: #f7f0df; color: #000000; display: flex; flex-direction: column; min-height: 100vh; }

        /* Header */
        .header { background: #741f2b; color: white; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 24px; }

        /* Back to Dashboard */
        .back { background: #fffdf7; color: #741f2b; height: 37px; padding: 0 15px; border-radius: 5px; text-decoration: none; font-weight: 500; display: flex; align-items: center; justify-content: center; }
        .back:hover { background: #f3e8d2; }

        /* Main Container */
        .container { padding: 40px; max-width: 800px; margin: 0 auto; width: 100%; }

        /* Page Title */
        .page-title { margin-bottom: 25px; }
        .page-title h2 { margin-bottom: 8px; color: #741f2b; }
        .page-title p { color: #333333; }

        /* Course Card (Plain Text Layout) */
        .course-card { background: #fffdf7; padding: 25px; border-radius: 10px; border: 1px solid #eadfc9; box-shadow: 0 3px 10px rgba(75, 20, 20, 0.12); margin-bottom: 20px; }
        .course-card h3 { color: #741f2b; font-size: 20px; margin-bottom: 12px; border-bottom: 1px solid #eadfc9; padding-bottom: 8px; }
        .course-info { font-size: 15px; line-height: 1.8; color: #333333; }
        .course-info strong { color: #000000; display: inline-block; width: 140px; }

        /* Empty Message */
        .empty-card { background: #fffdf7; padding: 30px; border-radius: 10px; border: 1px solid #eadfc9; text-align: center; color: #555555; font-size: 15px; }

        /* Footer */
        .footer { background: #741f2b; color: #fffdf7; text-align: center; padding: 15px 20px; font-size: 14px; margin-top: auto; width: 100%; }

        /* Responsive */
        @media (max-width: 600px) {
            .header { padding: 20px; }
            .container { padding: 25px; }
            .course-info strong { width: 110px; }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <h1>My Courses</h1>
        <a href="teacher.php" class="back">Back to Dashboard</a>
    </div>

    <!-- Main Content -->
    <div class="container">

        <!-- Page Title -->
        <div class="page-title">
            <h2>Courses Assigned to Me</h2>
            <p>View the details and class schedules for all your assigned courses.</p>
        </div>

        <!-- Course List (Plain Text Cards) -->
        <?php if ($assigned_courses && $assigned_courses->num_rows > 0): ?>
            <?php while ($course = $assigned_courses->fetch_assoc()): ?>
                <div class="course-card">
                    <h3><?php echo htmlspecialchars($course['course_name']); ?></h3>
                    <div class="course-info">
                        <p><strong>Course ID:</strong> <?php echo htmlspecialchars($course['course_id']); ?></p>
                        <p><strong>Course Code:</strong> <?php echo htmlspecialchars($course['course_code']); ?></p>
                        <p><strong>Credit:</strong> <?php echo htmlspecialchars($course['credit']); ?></p>
                        <p><strong>Class Week(s):</strong> <?php echo htmlspecialchars($course['day']); ?></p>
                        <p><strong>Class Time:</strong> 
                            <?php 
                                $start = date("h:i A", strtotime($course['start_time']));
                                $end = date("h:i A", strtotime($course['end_time']));
                                echo htmlspecialchars($start . " - " . $end); 
                            ?>
                        </p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-card">
                No courses currently assigned to you.
            </div>
        <?php endif; ?>

    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; <?php echo date("Y"); ?> University Portal. All Rights Reserved.</p>
    </div>

</body>
</html>