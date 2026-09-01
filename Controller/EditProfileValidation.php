<?php
include "../Model/db.php";
session_start();

$database = new db();
$connection = $database->connection();

// Determine navigation back link
$backPage = "admin.php";
if (isset($_GET["from"])) {
    $allowedPages = ["course_admin.php", "teacher.php", "student.php", "admin.php"];
    if (in_array($_GET["from"], $allowedPages)) {
        $backPage = $_GET["from"];
    }
}

// Fetch currently logged-in user
$logged_in_username = $_SESSION['username'] ?? '';
$user_res = $database->CheckUser($connection, "users", $logged_in_username);
$current_user = ($user_res && $user_res->num_rows > 0) ? $user_res->fetch_assoc() : null;

// Handle Delete Account (Blocked for admin role)
if (isset($_POST['action']) && $_POST['action'] === 'delete_account' && $current_user) {
    if ($current_user['role'] === 'admin') {
        $_SESSION['message'] = "Main Admin cannot delete their own account.";
        $_SESSION['message_type'] = "error";
    } else {
        $database->deleteUser($connection, "users", $current_user['id']);
        session_destroy();
        header("Location: ../View/login.php");
        exit();
    }
}

// Handle Form Submission (Save Changes)
if ($_SERVER["REQUEST_METHOD"] === "POST" && (!isset($_POST['action']) || $_POST['action'] !== 'delete_account')) {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $confirm_password = trim($_POST["confirm_password"] ?? "");

    if (empty($name) || empty($email) || empty($username)) {
        $_SESSION['message'] = "Please fill all required fields.";
        $_SESSION['message_type'] = "error";
    } else if (!empty($password) && $password !== $confirm_password) {
        $_SESSION['message'] = "Passwords do not match.";
        $_SESSION['message_type'] = "error";
    } else if ($current_user) {
        // Check if username is taken by another user
        if ($username !== $current_user['username']) {
            $check_user = $database->CheckUser($connection, "users", $username);
            if ($check_user && $check_user->num_rows > 0) {
                $_SESSION['message'] = "Username is already taken by another account.";
                $_SESSION['message_type'] = "error";
            }
        }

        if (empty($_SESSION['message'])) {
            $update_res = $database->updateProfile($connection, "users", $current_user['id'], $name, $email, $username, $password);
            if ($update_res) {
                $_SESSION['username'] = $username; // Update session if username changed
                $_SESSION['message'] = "Profile updated successfully.";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Failed to update profile. Please try again.";
                $_SESSION['message_type'] = "error";
            }
        }
    }
}

header("Location: ../View/edit_profile.php?from=" . urlencode($backPage));
exit();
?>