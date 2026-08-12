<!DOCTYPE html>
<html>
<head>

<title>Create User - Main Admin</title>

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

/* Main */

.container {
    padding: 40px;
}

.page-title {
    margin-bottom: 25px;
}

.page-title h2 {
    margin-bottom: 8px;
    color: #000000;
}

.page-title p {
    color: #000000;
}

/* Form Card */

.form-card {
    max-width: 650px;
    background: #fffdf7;
    padding: 35px;
    border-radius: 10px;
    border: 1px solid #eadfc9;
    box-shadow: 0 3px 10px rgba(75, 20, 20, 0.12);
}

.form-group {
    margin-bottom: 18px;
}

label {
    display: block;
    margin-bottom: 7px;
    font-size: 14px;
    font-weight: 500;
    color: #000000;
}

input,
select {
    width: 100%;
    padding: 12px;
    border: 1px solid #d8cdb8;
    border-radius: 6px;
    font-size: 14px;
    background: white;
    color: #000000;
    outline: none;
}

input:focus,
select:focus {
    border-color: #741f2b;
    box-shadow: 0 0 0 2px rgba(116, 31, 43, 0.1);
}

/* Button */

button {
    background: #741f2b;
    color: white;
    border: none;
    padding: 11px 22px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    margin-top: 5px;
}

button:hover {
    background: #5c1721;
}

</style>

</head>

<body>

<div class="header">

    <h1>Create User</h1>

    <a href="admin.php" class="back">
        Back to Dashboard
    </a>

</div>

<div class="container">

    <div class="page-title">

        <h2>Create New User</h2>

        <p>
            Create an account for a student, teacher or course administrator.
        </p>

    </div>

    <div class="form-card">

        <form id="userForm">

            <div class="form-group">

                <label>Full Name</label>

                <input
                    type="text"
                    id="name"
                    placeholder="Enter full name"
                >

            </div>


            <div class="form-group">

                <label>Username</label>

                <input
                    type="text"
                    id="username"
                    placeholder="Enter username"
                >

            </div>


            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    id="email"
                    placeholder="Enter email address"
                >

            </div>


            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    id="password"
                    placeholder="Enter password"
                >

            </div>


            <div class="form-group">

                <label>Role</label>

                <select id="role">

                    <option value="">Select Role</option>

                    <option value="student">
                        Student
                    </option>

                    <option value="teacher">
                        Teacher
                    </option>

                    <option value="course_admin">
                        Course Administrator
                    </option>

                </select>

            </div>


            <button type="submit">
                Create User
            </button>

        </form>

    </div>

</div>

<script>

document.getElementById("userForm").onsubmit = function(event) {

    event.preventDefault();

    let name = document.getElementById("name").value;
    let username = document.getElementById("username").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let role = document.getElementById("role").value;

    if (
        name === "" ||
        username === "" ||
        email === "" ||
        password === "" ||
        role === ""
    ) {
        alert("Please fill all fields.");
        return;
    }

    alert("User created successfully.");

};

</script>

</body>
</html>