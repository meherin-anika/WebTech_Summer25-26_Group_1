```php
<?php

if (isset($_GET["from"])) {

    if ($_GET["from"] == "course_admin.php") {
        $backPage = "course_admin.php";
    }
    else if ($_GET["from"] == "teacher.php") {
        $backPage = "teacher.php";
    }
    else if ($_GET["from"] == "student.php") {
        $backPage = "student.php";
    }
    else {
        $backPage = "admin.php";
    }

}
else {
    $backPage = "admin.php";
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Profile</title>

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
    min-height: calc(100vh - 77px);

    display: flex;
    justify-content: center;
    align-items: center;

    padding: 40px;
}


/* Form Box */

.box {
    width: 400px;

    background: #fffdf7;

    padding: 40px;

    border-radius: 10px;

    border: 1px solid #eadfc9;

    box-shadow: 0 5px 20px rgba(75, 20, 20, 0.12);
}

.box h2 {
    color: #741f2b;

    text-align: center;

    font-size: 24px;

    margin-bottom: 8px;
}

.subtitle {
    text-align: center;

    color: #333333;

    margin-bottom: 30px;

    font-size: 14px;
}


/* Form */

.form-group {
    margin-bottom: 18px;
}

label {
    display: block;

    margin-bottom: 6px;

    font-weight: bold;

    font-size: 14px;
}

input {
    width: 100%;

    padding: 11px;

    border: 1px solid #aaa;

    border-radius: 5px;

    font-size: 14px;

    background: white;

    color: #000000;
}

input:focus {
    outline: none;

    border-color: #741f2b;
}


/* Buttons */

.buttons {
    display: flex;

    gap: 10px;

    margin-top: 5px;
}

button {
    width: 100%;

    padding: 12px;

    background: #741f2b;

    color: white;

    border: none;

    border-radius: 6px;

    cursor: pointer;

    font-size: 14px;
}

button:hover {
    background: #5c1721;
}


/* Responsive */

@media (max-width: 600px) {

    .header {
        padding: 20px;
    }

    .container {
        padding: 25px;
    }

    .box {
        width: 100%;
        max-width: 400px;
    }

}

</style>

</head>

<body>


<!-- Header -->

<div class="header">

    <h1>Edit Profile</h1>

    <a href="<?php echo $backPage; ?>" class="back">
        Back to Dashboard
    </a>

</div>


<!-- Main Content -->

<div class="container">

    <div class="box">

        <h2>Manage Profile Information</h2>

        <p class="subtitle">
            Update your personal account information.
        </p>


        <form id="profileForm">


            <div class="form-group">

                <label>Name</label>

                <input
                    type="text"
                    name="name"
                    placeholder="Enter name"
                >

            </div>


            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    placeholder="Enter email"
                >

            </div>


            <div class="form-group">

                <label>Username</label>

                <input
                    type="text"
                    name="username"
                    placeholder="Enter username"
                >

            </div>


            <div class="form-group">

                <label>New Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter new password"
                >

            </div>


            <div class="form-group">

                <label>Confirm Password</label>

                <input
                    type="password"
                    name="confirm_password"
                    placeholder="Confirm password"
                >

            </div>


            <div class="buttons">

                <button type="submit">
                    Save Changes
                </button>

                <button
                    type="button"
                    onclick="window.location.href='<?php echo $backPage; ?>'">
                    Cancel
                </button>

            </div>


        </form>

    </div>

</div>


<script>

document.getElementById("profileForm").onsubmit = function(event) {

    event.preventDefault();


    let name =
        document.querySelector("[name='name']").value.trim();

    let email =
        document.querySelector("[name='email']").value.trim();

    let username =
        document.querySelector("[name='username']").value.trim();

    let password =
        document.querySelector("[name='password']").value.trim();

    let confirmPassword =
        document.querySelector("[name='confirm_password']").value.trim();


    if (
        name === "" ||
        email === "" ||
        username === ""
    ) {

        alert("Please fill all required fields.");

        return;

    }


    if (password !== confirmPassword) {

        alert("Passwords do not match.");

        return;

    }


    alert("Profile updated successfully.");

};

</script>


</body>

</html>
```

