<!DOCTYPE html>
<html>
<head>
    <title>University Management System - Login</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f7f0df;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 400px;
            background: #fffdf7;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(75, 20, 20, 0.15);
            border: 1px solid #eadfc9;
        }

        h1 {
            text-align: center;
            color: #741f2b;
            margin-bottom: 8px;
            font-size: 27px;
        }

        .subtitle {
            text-align: center;
            color: #000000;
            margin-bottom: 30px;
            font-size: 14px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            color: #000000;
            font-weight: 500;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #d8cdb8;
            border-radius: 6px;
            margin-bottom: 18px;
            font-size: 14px;
            background: #ffffff;
            color: #000000;
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: #741f2b;
            box-shadow: 0 0 0 2px rgba(116, 31, 43, 0.1);
        }

        input::placeholder {
            color: #777777;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #741f2b;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
            transition: 0.2s;
        }

        button:hover {
            background: #5c1721;
        }

        .error {
            color: #a00000;
            font-size: 13px;
            margin-bottom: 15px;
            display: none;
        }
    </style>
</head>

<body>

<div class="login-box">

    <h1>University Management System</h1>

    <p class="subtitle">Please login to continue</p>

    <form id="loginForm">

        <label>Username</label>
        <input type="text" id="username" placeholder="Enter username">

        <label>Password</label>
        <input type="password" id="password" placeholder="Enter password">

        <label>Login As</label>

        <select id="role">
            <option value="">Select Role</option>
            <option value="admin">Main Admin</option>
            <option value="course_admin">Course Administrator</option>
            <option value="teacher">Teacher</option>
            <option value="student">Student</option>
        </select>

        <p class="error" id="error">
            Please fill all fields.
        </p>

        <button type="submit">Login</button>

    </form>

</div>

<script>

document.getElementById("loginForm").onsubmit = function(event) {

    event.preventDefault();

    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let role = document.getElementById("role").value;

    if (username === "" || password === "" || role === "") {
        document.getElementById("error").style.display = "block";
        return;
    }

    if (role === "admin") {
        window.location.href = "admin.php";
    }

    if (role === "course_admin") {
        window.location.href = "course_admin.php";
    }

    if (role === "teacher") {
        window.location.href = "teacher.php";
    }

    if (role === "student") {
        window.location.href = "student.php";
    }

};

</script>

</body>
</html>