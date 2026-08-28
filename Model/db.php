<?php
class db
{
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
        $stmt = $connection->prepare("INSERT INTO " . $tablename . " (name, email, username, password, role, status) VALUES (?, ?, ?, ?, ?, 'pending')");
        $stmt->bind_param("sssss", $name, $email, $username, $password, $role);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    function signin($connection, $tablename, $username, $password)
    {
        $stmt = $connection->prepare("SELECT * FROM " . $tablename . " WHERE username = ? AND password = ? AND status = 'approved'");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        return $stmt->get_result();
    }

    function CheckUser($connection, $tablename, $username)
    {
        $stmt = $connection->prepare("SELECT * FROM " . $tablename . " WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result();
    }

    function getPendingUsers($connection, $tablename)
    {
        $stmt = $connection->prepare("SELECT * FROM " . $tablename . " WHERE status = 'pending'");
        $stmt->execute();
        return $stmt->get_result();
    }

    function getAllUsers($connection, $tablename)
    {
        $stmt = $connection->prepare("SELECT * FROM " . $tablename . " WHERE status = 'approved'");
        $stmt->execute();
        return $stmt->get_result();
    }

    function approveUser($connection, $tablename, $id)
    {
        $stmt = $connection->prepare("UPDATE " . $tablename . " SET status = 'approved' WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    function deleteUser($connection, $tablename, $id)
    {
        $stmt = $connection->prepare("DELETE FROM " . $tablename . " WHERE id = ?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    function createUserDirect($connection, $tablename, $name, $email, $username, $password, $role)
    {
        $stmt = $connection->prepare("INSERT INTO " . $tablename . " (name, email, username, password, role, status) VALUES (?, ?, ?, ?, ?, 'approved')");
        $stmt->bind_param("sssss", $name, $email, $username, $password, $role);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    function getUserById($connection, $tablename, $id)
    {
        $stmt = $connection->prepare("SELECT * FROM " . $tablename . " WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    function updateProfile($connection, $tablename, $id, $name, $email, $username, $password = "")
    {
        if (!empty($password)) {
            $stmt = $connection->prepare("UPDATE " . $tablename . " SET name=?, email=?, username=?, password=? WHERE id=?");
            $stmt->bind_param("ssssi", $name, $email, $username, $password, $id);
        } else {
            $stmt = $connection->prepare("UPDATE " . $tablename . " SET name=?, email=?, username=? WHERE id=?");
            $stmt->bind_param("sssi", $name, $email, $username, $id);
        }
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    function createCourse($connection, $course_id, $course_name, $course_code, $credit, $day, $start_time, $end_time)
    {
        $stmt = $connection->prepare("INSERT INTO courses (course_id, course_name, course_code, credit, day, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisss", $course_id, $course_name, $course_code, $credit, $day, $start_time, $end_time);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    function getCourses($connection)
    {
        $sql = "SELECT * FROM courses";
        return mysqli_query($connection, $sql);
    }

    function getUsersByRole($connection, $role)
    {
        $stmt = $connection->prepare("SELECT * FROM users WHERE role = ? AND status = 'approved'");
        $stmt->bind_param("s", $role);
        $stmt->execute();
        return $stmt->get_result();
    }

    function assignFaculty($connection, $course_id, $faculty_username)
    {
        $check = $connection->prepare("SELECT id FROM faculty_assignments WHERE course_id = ?");
        $check->bind_param("s", $course_id);
        $check->execute();
        $res = $check->get_result();

        if ($res && $res->num_rows > 0) {
            $check->close();
            $stmt = $connection->prepare("UPDATE faculty_assignments SET faculty_username = ? WHERE course_id = ?");
            $stmt->bind_param("ss", $faculty_username, $course_id);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        } else {
            $check->close();
            $stmt = $connection->prepare("INSERT INTO faculty_assignments (course_id, faculty_username) VALUES (?, ?)");
            $stmt->bind_param("ss", $course_id, $faculty_username);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }
    }

    function enrollStudent($connection, $course_id, $student_username)
    {
        $check = $connection->prepare("SELECT id FROM student_enrollments WHERE course_id = ? AND student_username = ?");
        $check->bind_param("ss", $course_id, $student_username);
        $check->execute();
        $res = $check->get_result();

        if ($res->num_rows > 0) {
            $check->close();
            return false;
        }
        $check->close();

        $stmt = $connection->prepare("INSERT INTO student_enrollments (course_id, student_username) VALUES (?, ?)");
        $stmt->bind_param("ss", $course_id, $student_username);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    function getTeacherCourses($connection, $teacher_username)
    {
        $stmt = $connection->prepare(
            "SELECT c.* FROM courses c
             INNER JOIN faculty_assignments fa ON c.course_id = fa.course_id
             WHERE fa.faculty_username = ?
             ORDER BY c.course_code"
        );
        $stmt->bind_param("s", $teacher_username);
        $stmt->execute();
        return $stmt->get_result();
    }

    function isTeacherAssignedToCourse($connection, $teacher_username, $course_id)
    {
        $stmt = $connection->prepare("SELECT id FROM faculty_assignments WHERE course_id = ? AND faculty_username = ?");
        $stmt->bind_param("ss", $course_id, $teacher_username);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
        return $exists;
    }

    function getCourseStudents($connection, $course_id)
    {
        $stmt = $connection->prepare(
            "SELECT u.username, u.name FROM student_enrollments se
             INNER JOIN users u ON se.student_username = u.username
             WHERE se.course_id = ? AND u.role = 'student' AND u.status = 'approved'
             ORDER BY u.name"
        );
        $stmt->bind_param("s", $course_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    function saveMark($connection, $course_id, $student_username, $marks, $grade)
    {
        $stmt = $connection->prepare(
            "INSERT INTO marks (course_id, student_username, marks, grade) VALUES (?, ?, ?, ?)
             ON DUPLICATE KEY UPDATE marks = VALUES(marks), grade = VALUES(grade)"
        );
        $stmt->bind_param("ssds", $course_id, $student_username, $marks, $grade);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    function getMarks($connection, $course_id)
    {
        $stmt = $connection->prepare("SELECT student_username, marks, grade FROM marks WHERE course_id = ?");
        $stmt->bind_param("s", $course_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    function saveAttendance($connection, $course_id, $student_username, $attendance_date, $status)
    {
        $stmt = $connection->prepare(
            "INSERT INTO attendance (course_id, student_username, date, status) VALUES (?, ?, ?, ?)
             ON DUPLICATE KEY UPDATE status = VALUES(status)"
        );
        $stmt->bind_param("ssss", $course_id, $student_username, $attendance_date, $status);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    function getAttendance($connection, $course_id, $attendance_date)
    {
        $stmt = $connection->prepare("SELECT student_username, status FROM attendance WHERE course_id = ? AND date = ?");
        $stmt->bind_param("ss", $course_id, $attendance_date);
        $stmt->execute();
        return $stmt->get_result();
    }
    function getStudentEnrolledCourses($connection, $student_username)
    {
        $stmt = $connection->prepare(
            "SELECT c.* FROM courses c
             INNER JOIN student_enrollments se ON c.course_id = se.course_id
             WHERE se.student_username = ?
             ORDER BY c.course_code"
        );
        $stmt->bind_param("s", $student_username);
        $stmt->execute();
        return $stmt->get_result();
    }
    function getStudentAttendance($connection, $course_id, $student_username)
    {
        $stmt = $connection->prepare(
            "SELECT date, status FROM attendance 
             WHERE course_id = ? AND student_username = ? 
             ORDER BY date DESC"
        );
        $stmt->bind_param("ss", $course_id, $student_username);
        $stmt->execute();
        return $stmt->get_result();
    }
    function getStudentMarks($connection, $student_username)
    {
        $stmt = $connection->prepare(
            "SELECT c.course_id, c.course_name, c.course_code, c.credit, m.marks, m.grade 
             FROM student_enrollments se
             INNER JOIN courses c ON se.course_id = c.course_id
             LEFT JOIN marks m ON (se.course_id = m.course_id AND se.student_username = m.student_username)
             WHERE se.student_username = ?
             ORDER BY c.course_code"
        );
        $stmt->bind_param("s", $student_username);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>