<?php
include "../Model/db.php";
session_start();

$database = new db();
$connection = $database->connection();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $delete_id = intval($_GET['id']);
    
    $target_user = $database->getUserById($connection, "users", $delete_id);
    $target_data = $target_user ? $target_user->fetch_assoc() : null;

    if ($target_data && strtolower($target_data['role']) === 'admin') {
        $_SESSION['error_message'] = "Main Admin accounts cannot be deleted!";
    } else {
        $database->deleteUser($connection, "users", $delete_id);
        $_SESSION['success_message'] = "User deleted successfully.";
    }
}

header("Location: ../View/admin_manage_users.php");
exit();
?>