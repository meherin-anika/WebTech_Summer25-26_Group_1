<!DOCTYPE html>
<html>
<head>

<title>Main Admin Dashboard</title>

<link rel="stylesheet" href="../Assets/style.css">

</head>

<body>

<div class="header">

    <h1>Main Admin Dashboard</h1>

    <div class="header-right">

        <div class="notification" onclick="notifications()">
            Notifications
        </div>

        <a href="login.php" class="logout">
            Logout
        </a>

    </div>

</div>

<div class="container">

    <div class="welcome">

        <h2>Welcome, Main Admin</h2>

        <p>
            Manage users and registration requests.
        </p>

    </div>

    <div class="menu">

        <button onclick="window.location.href='create_user.php'">
            Create Users
        </button>

        <button onclick="window.location.href='pending_registrations.php'">
            Pending Registrations
        </button>

        <button onclick="window.location.href='manage_users.php'">
            Manage Users
        </button>

        <button onclick="window.location.href='edit_profile.php?from=admin.php'">
            Edit Profile
        </button>

    </div>

</div>

<script>

function notifications() {

}

</script>

</body>
</html>