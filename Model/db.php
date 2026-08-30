<?php
class db
{
class db{

    function connection()
    {
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "university_db";

        $connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $connection;
    }

    function signup($connection, $tablename, $name, $email, $username, $password, $role)
    {
        $sql = "INSERT INTO " . $tablename . " (name, email, username, password, role, status) VALUES ('" . $name . "', '" . $email . "', '" . $username . "', '" . $password . "', '" . $role . "', 'pending')";
        return mysqli_query($connection, $sql);
    }

    function signin($connection, $tablename, $username, $password)
    {
        $sql = "SELECT * FROM " . $tablename . " WHERE username ='" . $username . "' AND password ='" . $password . "' AND status = 'approved'";
        return mysqli_query($connection, $sql);
    }

    function CheckUser($connection, $tablename, $username)
    {
        $sql = "SELECT * FROM " . $tablename . " WHERE username ='" . $username . "'";
        return mysqli_query($connection, $sql);
    }

    function getPendingUsers($connection, $tablename)
    {
        $sql = "SELECT * FROM " . $tablename . " WHERE status = 'pending'";
        return mysqli_query($connection, $sql);
    }

    function getAllUsers($connection, $tablename)
    {
        $sql = "SELECT * FROM " . $tablename . " WHERE status = 'approved'";
        return mysqli_query($connection, $sql);
    }

    function approveUser($connection, $tablename, $id)
    {
        $sql = "UPDATE " . $tablename . " SET status = 'approved' WHERE id = " . intval($id);
        return mysqli_query($connection, $sql);
    }

    function deleteUser($connection, $tablename, $id)
    {
        $sql = "DELETE FROM " . $tablename . " WHERE id = " . intval($id);
        return mysqli_query($connection, $sql);
    }

    function createUserDirect($connection, $tablename, $name, $email, $username, $password, $role)
    {
        $sql = "INSERT INTO " . $tablename . " (name, email, username, password, role, status) VALUES ('" . $name . "', '" . $email . "', '" . $username . "', '" . $password . "', '" . $role . "', 'approved')";
        return mysqli_query($connection, $sql);
    }

    function getUserById($connection, $tablename, $id)
    {
        $sql = "SELECT * FROM " . $tablename . " WHERE id = " . intval($id);
        return mysqli_query($connection, $sql);
    }

    function updateProfile($connection, $tablename, $id, $name, $email, $username, $password = "")
    {
        if (!empty($password)) {
            $sql = "UPDATE " . $tablename . " SET name='" . $name . "', email='" . $email . "', username='" . $username . "', password='" . $password . "' WHERE id=" . intval($id);
        } else {
            $sql = "UPDATE " . $tablename . " SET name='" . $name . "', email='" . $email . "', username='" . $username . "' WHERE id=" . intval($id);
        }
        return mysqli_query($connection, $sql);
    }

    function createCourse($connection, $course_id, $course_name, $course_code, $credit, $day, $start_time, $end_time)
    {
        $course_id = mysqli_real_escape_string($connection, $course_id);
        $course_name = mysqli_real_escape_string($connection, $course_name);
        $course_code = mysqli_real_escape_string($connection, $course_code);
        $credit = intval($credit);
        $day = mysqli_real_escape_string($connection, $day);
        $start_time = mysqli_real_escape_string($connection, $start_time);
        $end_time = mysqli_real_escape_string($connection, $end_time);

        $sql = "INSERT INTO courses (course_id, course_name, course_code, credit, day, start_time, end_time) VALUES ('" . $course_id . "', '" . $course_name . "', '" . $course_code . "', " . $credit . ", '" . $day . "', '" . $start_time . "', '" . $end_time . "')";
        return mysqli_query($connection, $sql);
    }

    function getCourses($connection)
    {
        $sql = "SELECT * FROM courses";
        return mysqli_query($connection, $sql);
    }

    function getUsersByRole($connection, $role)
    {
        $role = mysqli_real_escape_string($connection, $role);
        $sql = "SELECT * FROM users WHERE role = '" . $role . "' AND status = 'approved'";
        return mysqli_query($connection, $sql);
    }

    function assignFaculty($connection, $course_id, $faculty_username)
    {
        $course_id = mysqli_real_escape_string($connection, $course_id);
        $faculty_username = mysqli_real_escape_string($connection, $faculty_username);

        $sql = "SELECT * FROM faculty_assignments WHERE course_id = '" . $course_id . "'";
        $result = mysqli_query($connection, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $sql = "UPDATE faculty_assignments SET faculty_username = '" . $faculty_username . "' WHERE course_id = '" . $course_id . "'";
        } else {
            $sql = "INSERT INTO faculty_assignments (course_id, faculty_username) VALUES ('" . $course_id . "', '" . $faculty_username . "')";
        }

        return mysqli_query($connection, $sql);
    }

    function enrollStudent($connection, $course_id, $student_username)
    {
        $check = $connection->prepare("SELECT id FROM student_enrollments WHERE course_id = ? AND student_username = ?");
        $check->bind_param("ss", $course_id, $student_username);
        $check->execute();
        $res = $check->get_result();

        if ($res->num_rows > 0) {
            $check->close();
            return false; // Student is already enrolled
        $course_id = mysqli_real_escape_string($connection, $course_id);
        $student_username = mysqli_real_escape_string($connection, $student_username);

        $sql = "SELECT * FROM student_enrollments WHERE course_id = '" . $course_id . "' AND student_username = '" . $student_username . "'";
        $result = mysqli_query($connection, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            return false;
        }

        $sql = "INSERT INTO student_enrollments (course_id, student_username) VALUES ('" . $course_id . "', '" . $student_username . "')";
        return mysqli_query($connection, $sql);
    }

    function getTeacherCourses($connection, $teacher_username)
    {
        $teacher_username = mysqli_real_escape_string($connection, $teacher_username);

        $sql = "SELECT courses.* FROM courses
                INNER JOIN faculty_assignments
                ON courses.course_id = faculty_assignments.course_id
                WHERE faculty_assignments.faculty_username = '" . $teacher_username . "'
                ORDER BY courses.course_code";

        $result = mysqli_query($connection, $sql);
        $courses = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $courses[] = $row;
            }
        }

        return $courses;
    }

    function isTeacherAssignedToCourse($connection, $teacher_username, $course_id)
    {
        $teacher_username = mysqli_real_escape_string($connection, $teacher_username);
        $course_id = mysqli_real_escape_string($connection, $course_id);

        $sql = "SELECT * FROM faculty_assignments WHERE course_id = '" . $course_id . "' AND faculty_username = '" . $teacher_username . "'";
        $result = mysqli_query($connection, $sql);

        return $result && mysqli_num_rows($result) > 0;
    }

    function getCourseStudents($connection, $course_id)
    {
        $course_id = mysqli_real_escape_string($connection, $course_id);

        $sql = "SELECT users.username, users.name
                FROM student_enrollments
                INNER JOIN users
                ON student_enrollments.student_username = users.username
                WHERE student_enrollments.course_id = '" . $course_id . "'
                AND users.role = 'student'
                AND users.status = 'approved'
                ORDER BY users.name";

        $result = mysqli_query($connection, $sql);
        $students = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $students[] = $row;
            }
        }

        return $students;
    }

    function saveMark($connection, $course_id, $student_username, $marks, $grade)
    {
        $course_id = mysqli_real_escape_string($connection, $course_id);
        $student_username = mysqli_real_escape_string($connection, $student_username);
        $marks = floatval($marks);
        $grade = mysqli_real_escape_string($connection, $grade);

        $sql = "SELECT * FROM marks WHERE course_id = '" . $course_id . "' AND student_username = '" . $student_username . "'";
        $result = mysqli_query($connection, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $sql = "UPDATE marks SET marks = " . $marks . ", grade = '" . $grade . "' WHERE course_id = '" . $course_id . "' AND student_username = '" . $student_username . "'";
        } else {
            $sql = "INSERT INTO marks (course_id, student_username, marks, grade) VALUES ('" . $course_id . "', '" . $student_username . "', " . $marks . ", '" . $grade . "')";
        }

        return mysqli_query($connection, $sql);
    }

    function getMarks($connection, $course_id)
    {
        $course_id = mysqli_real_escape_string($connection, $course_id);
        $sql = "SELECT * FROM marks WHERE course_id = '" . $course_id . "'";
        $result = mysqli_query($connection, $sql);
        $marks = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $marks[$row["student_username"]] = $row;
            }
        }

        return $marks;
    }

    function saveAttendance($connection, $course_id, $student_username, $attendance_date, $status)
    {
        $course_id = mysqli_real_escape_string($connection, $course_id);
        $student_username = mysqli_real_escape_string($connection, $student_username);
        $attendance_date = mysqli_real_escape_string($connection, $attendance_date);
        $status = mysqli_real_escape_string($connection, $status);

        $sql = "SELECT * FROM attendance WHERE course_id = '" . $course_id . "' AND student_username = '" . $student_username . "' AND date = '" . $attendance_date . "'";
        $result = mysqli_query($connection, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $sql = "UPDATE attendance SET status = '" . $status . "' WHERE course_id = '" . $course_id . "' AND student_username = '" . $student_username . "' AND date = '" . $attendance_date . "'";
        } else {
            $sql = "INSERT INTO attendance (course_id, student_username, date, status) VALUES ('" . $course_id . "', '" . $student_username . "', '" . $attendance_date . "', '" . $status . "')";
        }

        return mysqli_query($connection, $sql);
    }

    function getAttendance($connection, $course_id, $date)
    {
        $course_id = mysqli_real_escape_string($connection, $course_id);
        $date = mysqli_real_escape_string($connection, $date);
        $sql = "SELECT * FROM attendance WHERE course_id = '" . $course_id . "' AND date = '" . $date . "'";
        $result = mysqli_query($connection, $sql);
        $attendance = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $attendance[$row["student_username"]] = $row;
            }
        }

        return $attendance;
    }

    function getStudentCourses($connection, $student_username)
    {
        $student_username = mysqli_real_escape_string($connection, $student_username);

        $sql = "SELECT courses.* FROM student_enrollments
                INNER JOIN courses
                ON student_enrollments.course_id = courses.course_id
                WHERE student_enrollments.student_username = '" . $student_username . "'
                ORDER BY courses.course_code";

        $result = mysqli_query($connection, $sql);
        $courses = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $courses[] = $row;
            }
        }

        return $courses;
    }

    function getStudentCourseDetails($connection, $student_username, $course_id)
    {
        $student_username = mysqli_real_escape_string($connection, $student_username);
        $course_id = mysqli_real_escape_string($connection, $course_id);

        $sql = "SELECT courses.*, users.name AS teacher_name, faculty_assignments.faculty_username
                FROM student_enrollments
                INNER JOIN courses
                ON student_enrollments.course_id = courses.course_id
                LEFT JOIN faculty_assignments
                ON courses.course_id = faculty_assignments.course_id
                LEFT JOIN users
                ON faculty_assignments.faculty_username = users.username
                WHERE student_enrollments.student_username = '" . $student_username . "'
                AND courses.course_id = '" . $course_id . "'";

        $result = mysqli_query($connection, $sql);

        if (!$result || mysqli_num_rows($result) == 0) {
            return null;
        }

        $course = mysqli_fetch_assoc($result);

        if (empty($course["teacher_name"])) {
            if (!empty($course["faculty_username"])) {
                $course["teacher_name"] = $course["faculty_username"];
            } else {
                $course["teacher_name"] = "Not Assigned";
            }
        }

        return $course;
    }

    function getStudentAttendanceRecords($connection, $student_username, $course_id)
    {
        $student_username = mysqli_real_escape_string($connection, $student_username);
        $course_id = mysqli_real_escape_string($connection, $course_id);

        $sql = "SELECT date, status FROM attendance
                WHERE student_username = '" . $student_username . "'
                AND course_id = '" . $course_id . "'
                ORDER BY date DESC";

        $result = mysqli_query($connection, $sql);
        $records = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $records[] = $row;
            }
        }

        return $records;
    }

    function getStudentMarks($connection, $student_username)
    {
        $student_username = mysqli_real_escape_string($connection, $student_username);

        $sql = "SELECT courses.course_id, courses.course_name, courses.course_code, courses.credit,
                       marks.marks, marks.grade
                FROM student_enrollments
                INNER JOIN courses
                ON student_enrollments.course_id = courses.course_id
                LEFT JOIN marks
                ON student_enrollments.course_id = marks.course_id
                AND student_enrollments.student_username = marks.student_username
                WHERE student_enrollments.student_username = '" . $student_username . "'
                ORDER BY courses.course_code";

        $result = mysqli_query($connection, $sql);
        $marks = [];

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $marks[] = $row;
            }
        }

        return $marks;
    }

    function getTeacherCourses($connection, $teacher_username)
    {
        $stmt = $connection->prepare(
            "SELECT c.*
         FROM courses c
         INNER JOIN faculty_assignments fa
         ON c.course_id = fa.course_id
         WHERE fa.faculty_username = ?
         ORDER BY c.course_code"
        );

        $stmt->bind_param("s", $teacher_username);
        $stmt->execute();

        return $stmt->get_result();
    }


    function isTeacherAssignedToCourse($connection, $teacher_username, $course_id)
    {
        $stmt = $connection->prepare(
            "SELECT id
         FROM faculty_assignments
         WHERE course_id = ?
         AND faculty_username = ?"
        );

        $stmt->bind_param(
            "ss",
            $course_id,
            $teacher_username
        );

        $stmt->execute();

        $result = $stmt->get_result();

        $exists = $result->num_rows > 0;

        $stmt->close();

        return $exists;
    }


    function getCourseStudents($connection, $course_id)
    {
        $stmt = $connection->prepare(
            "SELECT u.username, u.name
         FROM student_enrollments se
         INNER JOIN users u
         ON se.student_username = u.username
         WHERE se.course_id = ?
         AND u.role = 'student'
         AND u.status = 'approved'
         ORDER BY u.name"
        );

        $stmt->bind_param(
            "s",
            $course_id
        );

        $stmt->execute();

        return $stmt->get_result();
    }


    function saveMark($connection, $course_id, $student_username, $marks, $grade)
    {
        $stmt = $connection->prepare(
            "INSERT INTO marks
        (course_id, student_username, marks, grade)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
        marks = VALUES(marks),
        grade = VALUES(grade)"
        );

        $stmt->bind_param(
            "ssds",
            $course_id,
            $student_username,
            $marks,
            $grade
        );

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }


    function getMarks($connection, $course_id)
    {
        $sql = "SELECT * FROM marks
            WHERE course_id = ?";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $course_id);
        $stmt->execute();

        $result = $stmt->get_result();

        $marks = [];

        while ($row = $result->fetch_assoc()) {
            $marks[$row["student_username"]] = $row;
        }

        return $marks;
    }


    function saveAttendance($connection, $course_id, $student_username, $attendance_date, $status)
    {
        $stmt = $connection->prepare(
            "INSERT INTO attendance
        (course_id, student_username, date, status)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
        status = VALUES(status)"
        );

        $stmt->bind_param(
            "ssss",
            $course_id,
            $student_username,
            $attendance_date,
            $status
        );

        $result = $stmt->execute();

        $stmt->close();

        return $result;
    }


    function getAttendance($connection, $course_id, $date)
    {
        $sql = "SELECT * FROM attendance
            WHERE course_id = ?
            AND date = ?";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ss", $course_id, $date);
        $stmt->execute();

        $result = $stmt->get_result();

        $attendance = [];

        while ($row = $result->fetch_assoc()) {
            $attendance[$row["student_username"]] = $row;
        }

        return $attendance;
    }
}
?>
