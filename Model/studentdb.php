<?php
class studentdb
{
    function connection()
    {
        $db_host="localhost";
        $db_user="root";
        $db_password="";
        $db_name="university_db";

        $connection=mysqli_connect($db_host, $db_user, $db_password, $db_name);

        if (!$connection) 
        {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $connection;
    }

    function getCourses($connection)
    {
        $sql="SELECT * FROM courses";
        return mysqli_query($connection, $sql);
    }

    function enrollStudent($connection, $course_id, $student_username)
    {
        $sql="SELECT id FROM student_enrollments 
                WHERE course_id = '$course_id' 
                AND student_username = '$student_username'";

        $result=mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) 
        {
            return false;
        }

        $sql="INSERT INTO student_enrollments 
                (course_id, student_username) 
                VALUES ('$course_id', '$student_username')";

        return mysqli_query($connection, $sql);
    }

    function getStudentEnrolledCourses($connection, $student_username)
    {
        $sql = "SELECT c.* 
                FROM courses c
                INNER JOIN student_enrollments se 
                ON c.course_id = se.course_id
                WHERE se.student_username = '$student_username'
                ORDER BY c.course_code";

        return mysqli_query($connection, $sql);
    }

    function getStudentAttendance($connection, $course_id, $student_username)
    {
        $sql="SELECT date, status 
                FROM attendance
                WHERE course_id = '$course_id'
                AND student_username = '$student_username'
                ORDER BY date DESC";

        return mysqli_query($connection, $sql);
    }

    function getStudentMarks($connection, $student_username)
    {
        $sql="SELECT c.course_id, c.course_name, c.course_code, 
                       c.credit, m.marks, m.grade
                FROM student_enrollments se
                INNER JOIN courses c 
                ON se.course_id = c.course_id
                LEFT JOIN marks m 
                ON se.course_id = m.course_id
                AND se.student_username = m.student_username
                WHERE se.student_username = '$student_username'
                ORDER BY c.course_code";

        return mysqli_query($connection, $sql);
    }
}
?>