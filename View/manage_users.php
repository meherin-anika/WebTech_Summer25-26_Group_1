<!DOCTYPE html>
<html>
<head>

<title>Manage Users - Main Admin</title>

<style>

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

.back {
    background: #fffdf7;
    color: #741f2b;
    padding: 9px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 500;
}

.back:hover {
    background: #f3e8d2;
}

/* Container */

.container {
    padding: 40px;
}

.page-title {
    margin-bottom: 25px;
}

.page-title h2 {
    margin-bottom: 8px;
}

.page-title p {
    color: #000000;
}

/* Table Card */

.table-card {
    background: #fffdf7;
    padding: 25px;
    border-radius: 10px;
    border: 1px solid #eadfc9;
    box-shadow: 0 3px 10px rgba(75, 20, 20, 0.12);
    overflow-x: auto;
}

/* Search */

.search-box {
    width: 300px;
    padding: 11px;
    border: 1px solid #d8cdb8;
    border-radius: 6px;
    margin-bottom: 20px;
    outline: none;
    font-size: 14px;
}

.search-box:focus {
    border-color: #741f2b;
}

/* Table */

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #741f2b;
    color: white;
    padding: 13px;
    text-align: left;
    font-size: 14px;
}

td {
    padding: 18px;
    border-bottom: 1px solid #eadfc9;
    font-size: 14px;
}

/* Empty Table */

.empty-row {
    text-align: center;
    color: #555555;
    padding: 35px;
}

/* Buttons */

.edit-btn,
.delete-btn {
    border: none;
    padding: 7px 12px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 13px;
}

.edit-btn {
    background: #741f2b;
    color: white;
    margin-right: 5px;
}

.edit-btn:hover {
    background: #5c1721;
}

.delete-btn {
    background: #e7d6c8;
    color: #741f2b;
}

.delete-btn:hover {
    background: #dbc4b3;
}

</style>

</head>

<body>

<div class="header">

    <h1>Manage Users</h1>

    <a href="admin.php" class="back">
        Back to Dashboard
    </a>

</div>


<div class="container">

    <div class="page-title">

        <h2>System Users</h2>

        <p>
            View, edit and manage users in the university system.
        </p>

    </div>


    <div class="table-card">

        <input
            type="text"
            class="search-box"
            id="search"
            placeholder="Search users..."
        >


        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>

            </thead>


            <tbody>

                <!--
                    User data will be loaded from the database
                    using PHP/MySQL later.
                -->

                <tr>

                    <td colspan="6" class="empty-row">
                        No users available.
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>