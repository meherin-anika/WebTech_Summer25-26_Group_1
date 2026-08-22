<!DOCTYPE html>
<html>
<head>

<title>Pending Registrations</title>

<style>

/* General */

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

body {
    background: #f7f0df;
    color: #000000;
}


/* Header */

.header {
    background: #741f2b;
    color: white;

    padding: 20px 40px;

    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header h1 {
    font-size: 24px;
}


/* Back Button */

.back {
    background: #fffdf7;
    color: #741f2b;

    height: 37px;
    padding: 0 15px;

    border-radius: 5px;

    text-decoration: none;
    font-weight: 500;

    display: flex;
    align-items: center;
    justify-content: center;
}

.back:hover {
    background: #f3e8d2;
}


/* Main Container */

.container {
    padding: 40px;
}


/* Page Introduction */

.welcome {
    margin-bottom: 35px;
}

.welcome h2 {
    margin-bottom: 8px;
}

.welcome p {
    color: #333333;
}


/* User List */

.user-list {
    width: 100%;
    overflow-x: auto;
}


/* Table */

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
}

th {
    background: #741f2b;
    color: white;

    padding: 12px;

    text-align: left;

    font-size: 14px;
}

td {
    padding: 12px;

    border-bottom: 1px solid #ddd;

    font-size: 14px;
}


/* Action Buttons */

.action-buttons {
    display: flex;
    gap: 8px;
}

button {
    background: #741f2b;
    color: white;

    border: none;

    padding: 8px 14px;

    border-radius: 5px;

    cursor: pointer;

    font-size: 14px;
}

button:hover {
    background: #5c1721;
}


/* Empty Table */

.empty-row {
    text-align: center;

    color: #555555;

    padding: 25px;
}

</style>

</head>

<body>


<!-- Header -->

<div class="header">

    <h1>Pending Registrations</h1>

    <a href="admin.php" class="back">
        Back to Dashboard
    </a>

</div>


<!-- Main Content -->

<div class="container">

    <div class="welcome">

        <h2>Registration Requests</h2>

        <p>
            Review and manage pending user registration requests.
        </p>

    </div>


    <!-- Registration Table -->

    <div class="user-list">

        <table>

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Name</th>

                    <th>Username</th>

                    <th>Email</th>

                    <th>Role</th>

                    <th>Action</th>

                </tr>

            </thead>


            <tbody>

                <tr>

                    <td colspan="6" class="empty-row">
                        No pending registrations available.
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>


</body>
</html>