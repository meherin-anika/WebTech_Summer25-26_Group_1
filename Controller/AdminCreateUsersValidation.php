<?php
include "../Model/db.php";
session_start();

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $confirm_password = trim($_POST["confirm_password"] ?? "");
    $role = $_POST["role"] ?? "";

    if (empty($name) || empty($email) || empty($username) || empty($password) || empty($role)) {
        $_SESSION['message'] = "Please fill all fields.";
        $_SESSION['message_type'] = "error";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format.";
        $_SESSION['message_type'] = "error";
    } else if ($password !== $confirm_password) {
        $_SESSION['message'] = "Passwords do not match.";
        $_SESSION['message_type'] = "error";
    } else {
        $database = new db();
        $connection = $database->connection();
        
        // Check if username already exists
        $userCheck = $database->CheckUser($connection, "users", $username);
        if ($userCheck && $userCheck->num_rows > 0) {
            $_SESSION['message'] = "Username already exists.";
            $_SESSION['message_type'] = "error";
        } else {
            $result = $database->createUserDirect($connection, "users", $name, $email, $username, $password, $role);

            if ($result) {
                $_SESSION['message'] = "User created successfully!";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Creation failed. Try again.";
                $_SESSION['message_type'] = "error";
            }
        }
    }
}

header("Location: ../View/admin_create_users.php");
exit();
?>