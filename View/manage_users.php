<?php
include "../Model/db.php";
session_start();

$database = new db();
$connection = $database->connection();

$message = "";

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $delete_id = intval($_GET['id']);
    
    $logged_in_username = $_SESSION['username'] ?? '';
    
    $admin_check = $database->CheckUser($connection, "users", $logged_in_username);
    $admin_data = $admin_check ? $admin_check->fetch_assoc() : null;

    if ($admin_data && intval($admin_data['id']) === $delete_id) {
        $_SESSION['error_message'] = "You cannot delete your own admin account!";
    } else {
        $database->deleteUser($connection, "users", $delete_id);
    }
    
    header("Location: manage_users.php");
    exit();
}

if (isset($_SESSION['error_message'])) {
    $message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

$all_users = $database->getAllUsers($connection, "users");

$logged_in_username = $_SESSION['username'] ?? '';
$admin_check = $database->CheckUser($connection, "users", $logged_in_username);
$current_admin_id = ($admin_check && $row = $admin_check->fetch_assoc()) ? intval($row['id']) : 0;
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Users - Main Admin</title>
<style>
* { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
body { background: #f7f0df; color: #000000; display: flex; flex-direction: column; min-height: 100vh; }
.header { background: #741f2b; color: white; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; }
.header h1 { font-size: 24px; }
.back { background: #fffdf7; color: #741f2b; height: 37px; padding: 0 15px; border-radius: 5px; text-decoration: none; font-weight: 500; display: flex; align-items: center; justify-content: center; }
.back:hover { background: #f3e8d2; }
.container { flex: 1; padding: 40px; }
.welcome { margin-bottom: 25px; }
.welcome h2 { margin-bottom: 8px; }
.welcome p { color: #333333; }
.user-item { margin-bottom: 15px; font-size: 15px; }
.delete-btn { background: #741f2b; color: white; border: none; padding: 4px 10px; border-radius: 4px; text-decoration: none; font-size: 13px; margin-left: 5px; }
.delete-btn:hover { background: #5c1721; }
.error-msg { color: #a00000; margin-bottom: 15px; font-size: 14px; }
.footer { background: #741f2b; color: #fffdf7; text-align: center; padding: 15px 20px; font-size: 14px; margin-top: auto; }
</style>
</head>
<body>

<div class="header">
    <h1>Manage Users</h1>
    <a href="admin.php" class="back">Back to Dashboard</a>
</div>

<div class="container">
    <div class="welcome">
        <h2>System Users</h2>
        <p>View and delete existing users.</p>
    </div>

    <?php if (!empty($message)): ?>
        <p class="error-msg"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <div class="user-list">
        <?php if ($all_users && $all_users->num_rows > 0): ?>
            <?php while ($row = $all_users->fetch_assoc()): ?>
                <div class="user-item">
                    ID: <?php echo $row['id']; ?> | 
                    Name: <?php echo htmlspecialchars($row['name']); ?> | 
                    Username: <?php echo htmlspecialchars($row['username']); ?> | 
                    Password: <?php echo htmlspecialchars($row['password']); ?> | 
                    Email: <?php echo htmlspecialchars($row['email']); ?> | 
                    Role: <?php echo htmlspecialchars($row['role']); ?>
                    <?php if (intval($row['id']) !== $current_admin_id): ?>
                        <a href="manage_users.php?action=delete&id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Delete this user?')">Delete</a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No users available.</p>
        <?php endif; ?>
    </div>
</div>

<div class="footer">
    <p>&copy; <?php echo date("Y"); ?> University Portal. All Rights Reserved.</p>
</div>

</body>
</html>