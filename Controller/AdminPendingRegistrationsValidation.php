<?php
include "../Model/db.php";
session_start();

$database = new db();
$connection = $database->connection();

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    if ($_GET['action'] === 'approve') {
        $database->approveUser($connection, "users", $id);
        $_SESSION['message'] = "User approved successfully.";
        $_SESSION['message_type'] = "success";
    } else if ($_GET['action'] === 'reject') {
        $database->deleteUser($connection, "users", $id);
        $_SESSION['message'] = "User registration rejected.";
        $_SESSION['message_type'] = "error";
    }
}

header("Location: ../View/admin_pending_registrations.php");
exit();
?>