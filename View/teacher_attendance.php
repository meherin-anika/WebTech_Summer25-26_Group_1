<?php require_once "../Controller/AttendanceController.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Attendance - Teacher</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
        html, body { height: 100%; }
        body { background: #f7f0df; color: #000000; display: flex; flex-direction: column; min-height: 100vh; }

        /* Header */
        .header { background: #741f2b; color: white; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { font-size: 24px; }
        .back { background: #fffdf7; color: #741f2b; height: 37px; padding: 0 15px; border-radius: 5px; text-decoration: none; font-weight: 500; display: flex; align-items: center; justify-content: center; }
        .back:hover { background: #f3e8d2; }

        /* Main Layout */
        .container { padding: 40px; max-width: 800px; margin: 0 auto; width: 100%; }
        .page-title { margin-bottom: 25px; }
        .page-title h2 { margin-bottom: 8px; color: #741f2b; }
        .page-title p { color: #333333; }

        /* Controls Section */
        .controls { background: #fffdf7; padding: 25px; border-radius: 10px; border: 1px solid #eadfc9; box-shadow: 0 3px 10px rgba(75, 20, 20, 0.12); margin-bottom: 25px; }
        .controls label { display: block; margin-bottom: 8px; font-size: 14px; font-weight: bold; }
        .controls select, .controls input[type="text"] { width: 100%; padding: 11px; border: 1px solid #d8cdb8; border-radius: 6px; background: white; color: #000000; outline: none; margin-bottom: 15px; }
        .controls select:focus, .controls input[type="text"]:focus { border-color: #741f2b; }

        /* Student Card Container */
        .student-list-container { background: #fffdf7; padding: 25px; border-radius: 10px; border: 1px solid #eadfc9; box-shadow: 0 3px 10px rgba(75, 20, 20, 0.12); }
        .student-card { display: flex; justify-content: space-between; align-items: center; padding: 16px; border-bottom: 1px solid #eadfc9; }
        .student-card:last-child { border-bottom: none; }
        
        .student-info h3 { font-size: 16px; color: #741f2b; margin-bottom: 4px; }
        .student-info p { font-size: 13px; color: #555555; }

        /* Radio Group Styling */
        .status-options label { margin-left: 15px; font-size: 14px; cursor: pointer; color: #333333; }
        .status-options input[type="radio"] { accent-color: #741f2b; margin-right: 4px; }

        /* Save Button */
        .save-btn { margin-top: 20px; background: #741f2b; color: white; border: none; padding: 12px 25px; border-radius: 6px; cursor: pointer; font-size: 14px; font-weight: bold; width: 100%; }
        .save-btn:hover { background: #5c1721; }

        /* Messages */
        .message { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px; border-radius: 6px; margin-bottom: 20px; text-align: center; }
        .empty-msg { text-align: center; color: #555555; padding: 20px 0; }

        /* Footer */
        .footer { background: #741f2b; color: #fffdf7; text-align: center; padding: 15px 20px; font-size: 14px; margin-top: auto; width: 100%; }
        
        @media (max-width: 800px) { .header { padding: 20px; } .container { padding: 25px; } }
    </style>
</head>
<body>

<div class="header">
    <h1>Attendance</h1>
    <a href="teacher.php" class="back">Back to Dashboard</a>
</div>

<div class="container">
    <div class="page-title">
        <h2>Student Attendance</h2>
        <p>Record and manage attendance for your courses.</p>
    </div>

    <?php if (!empty($message)): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <!-- Controls Form -->
    <div class="controls">
        <form method="GET" id="filterForm">
            <label>Select Course</label>
            <select name="course_id" onchange="document.getElementById('filterForm').submit()">
                <option value="">Select Course</option>
                <?php if ($assigned_courses): ?>
                    <?php while ($course = $assigned_courses->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($course['course_id']); ?>" <?php echo ($selected_course === $course['course_id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($course['course_code'] . " - " . $course['course_name']); ?>
                        </option>
                    <?php endwhile; ?>
                <?php endif; ?>
            </select>

            <label>Date (Manual Entry)</label>
            <input type="text" name="attendance_date" placeholder="YYYY-MM-DD (e.g., 2026-08-27)" value="<?php echo htmlspecialchars($selected_date); ?>" onchange="document.getElementById('filterForm').submit()">
        </form>
    </div>

    <!-- Student Attendance Cards Container -->
    <div class="student-list-container">
        <?php if ($students && $students->num_rows > 0): ?>
            <form method="POST">
                <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($selected_course); ?>">
                <input type="hidden" name="attendance_date" value="<?php echo htmlspecialchars($selected_date); ?>">

                <?php while ($student = $students->fetch_assoc()): ?>
                    <?php 
                        $u_name = $student['username'];
                        $current_status = $existing_attendance[$u_name] ?? 'Present';
                    ?>
                    <div class="student-card">
                        <div class="student-info">
                            <h3><?php echo htmlspecialchars($student['name']); ?></h3>
                            <p>ID: <?php echo htmlspecialchars($student['username']); ?></p>
                        </div>

                        <div class="status-options">
                            <label>
                                <input type="radio" name="attendance[<?php echo htmlspecialchars($u_name); ?>]" value="Present" <?php echo ($current_status === 'Present') ? 'checked' : ''; ?>> Present
                            </label>
                            <label>
                                <input type="radio" name="attendance[<?php echo htmlspecialchars($u_name); ?>]" value="Absent" <?php echo ($current_status === 'Absent') ? 'checked' : ''; ?>> Absent
                            </label>
                            <label>
                                <input type="radio" name="attendance[<?php echo htmlspecialchars($u_name); ?>]" value="Late" <?php echo ($current_status === 'Late') ? 'checked' : ''; ?>> Late
                            </label>
                        </div>
                    </div>
                <?php endwhile; ?>

                <button type="submit" name="submit_attendance" class="save-btn">Save Attendance</button>
            </form>
        <?php elseif (!empty($selected_course)): ?>
            <p class="empty-msg">No students enrolled in this course.</p>
        <?php else: ?>
            <p class="empty-msg">Please select a course to view and mark attendance.</p>
        <?php endif; ?>
    </div>
</div>

<div class="footer">
    <p>&copy; <?php echo date("Y"); ?> University Portal. All Rights Reserved.</p>
</div>

</body>
</html>