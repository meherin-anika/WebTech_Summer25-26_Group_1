<?php
class db {
    
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

    // ON DELETE CASCADE in MySQL automatically removes foreign key records when a user is deleted
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
        $sql = "SELECT * FROM users WHERE role = '" . mysqli_real_escape_string($connection, $role) . "' AND status = 'approved'";
        return mysqli_query($connection, $sql);
    }

    function assignFaculty($connection, $course_id, $faculty_username)
    {
        // 1. Check if an assignment already exists for this course ID
        $check = $connection->prepare("SELECT id FROM faculty_assignments WHERE course_id = ?");
        $check->bind_param("s", $course_id);
        $check->execute();
        $res = $check->get_result();

        if ($res && $res->num_rows > 0) {
            $check->close();
            // 2. Update existing assignment dynamically
            $stmt = $connection->prepare("UPDATE faculty_assignments SET faculty_username = ? WHERE course_id = ?");
            $stmt->bind_param("ss", $faculty_username, $course_id);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        } else {
            $check->close();
            // 3. Insert new assignment if course has no teacher yet
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
            return false; // Student is already enrolled
        }
        $check->close();

        $stmt = $connection->prepare("INSERT INTO student_enrollments (course_id, student_username) VALUES (?, ?)");
        $stmt->bind_param("ss", $course_id, $student_username);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
?>