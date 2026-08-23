<?php
class db {
    function connection()
    {
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "university_db";

        // Simple XAMPP Connection
        $connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $connection;
    }

    function signup($connection, $tablename, $name, $email, $username, $password, $role)
    {
        $sql = "INSERT INTO " . $tablename . " (name, email, username, password, role, status) VALUES ('" . $name . "', '" . $email . "', '" . $username . "', '" . $password . "', '" . $role . "', 'pending')";
        $result = mysqli_query($connection, $sql);
        return $result;
    }

    function signin($connection, $tablename, $username, $password)
    {
        $sql = "SELECT * FROM " . $tablename . " WHERE username ='" . $username . "' AND password ='" . $password . "' AND status = 'approved'";
        $result = mysqli_query($connection, $sql);
        return $result;
    }

    function CheckUser($connection, $tablename, $username)
    {
        $sql = "SELECT * FROM " . $tablename . " WHERE username ='" . $username . "'";
        $result = mysqli_query($connection, $sql);
        return $result;
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
}
?>