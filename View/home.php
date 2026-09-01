<!DOCTYPE html>
<html>
<head>

<title>University Management System</title>

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

.container {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.box {
    width: 400px;
    background: #fffdf7;
    padding: 40px;
    border-radius: 10px;
    border: 1px solid #eadfc9;
    box-shadow: 0 5px 20px rgba(75, 20, 20, 0.12);
    text-align: center;
}

.box h1 {
    color: #741f2b;
    font-size: 27px;
    margin-bottom: 10px;
}

.box p {
    color: #333333;
    font-size: 14px;
    margin-bottom: 30px;
}

.buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.button {
    display: block;
    width: 100%;
    padding: 12px;
    background: #741f2b;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    text-decoration: none;
    text-align: center;
}

.button:hover {
    background: #5c1721;
}

</style>

</head>

<body>

<div class="container">

    <div class="box">

        <h1>University Management System</h1>

        <p>
            Welcome to the University Management System.
        </p>

        <div class="buttons">
            <a class="button" href="login.php">Login</a>
            <a class="button" href="registration.php">Register</a>
        </div>

    </div>

</div>

</body>
</html>