<!DOCTYPE html>
<html>
<head>

<title>Course Management</title>

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


/* Back to Dashboard */

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


/* Course Box */

.box {
    width: 500px;

    background: #fffdf7;

    padding: 40px;

    border-radius: 10px;

    border: 1px solid #eadfc9;

    box-shadow: 0 5px 20px rgba(75, 20, 20, 0.12);
}


/* Title */

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

input,
select {
    width: 100%;

    padding: 11px;

    border: 1px solid #aaa;

    border-radius: 5px;

    font-size: 14px;

    background: white;

    color: #000000;
}

input:focus,
select:focus {
    outline: none;

    border-color: #741f2b;
}


/* Class Time */

.class-time {
    display: flex;

    gap: 10px;
}

.class-time select,
.class-time input {
    flex: 1;
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
        max-width: 500px;
    }

    .class-time {
        flex-direction: column;
    }

}

</style>

</head>

<body>


<!-- Header -->

<div class="header">

    <h1>Course Management</h1>

    <a href="course_admin.php" class="back">
        Back to Dashboard
    </a>

</div>


<!-- Main Content -->

<div class="container">

    <div class="box">

        <h2>Create New Course</h2>

        <p class="subtitle">
            Enter the course information to create a new university course.
        </p>


        <form id="courseForm">


            <!-- Course ID -->

            <div class="form-group">

                <label>Course ID</label>

                <input
                    type="text"
                    name="course_id"
                    placeholder="Enter course ID"
                >

            </div>


            <!-- Course Name -->

            <div class="form-group">

                <label>Course Name</label>

                <input
                    type="text"
                    name="course_name"
                    placeholder="Enter course name"
                >

            </div>


            <!-- Course Code -->

            <div class="form-group">

                <label>Course Code</label>

                <input
                    type="text"
                    name="course_code"
                    placeholder="Enter course code"
                >

            </div>


            <!-- Course Credit -->

            <div class="form-group">

                <label>Course Credit</label>

                <input
                    type="number"
                    name="credit"
                    placeholder="Enter course credit"
                    min="1"
                    max="6"
                >

            </div>


            <!-- Class Time -->

            <div class="form-group">

                <label>Class Time</label>

                <div class="class-time">

                    <select name="day">

                        <option value="">
                            Select Day
                        </option>

                        <option value="Sunday">
                            Sunday
                        </option>

                        <option value="Monday">
                            Monday
                        </option>

                        <option value="Tuesday">
                            Tuesday
                        </option>

                        <option value="Wednesday">
                            Wednesday
                        </option>

                        <option value="Thursday">
                            Thursday
                        </option>

                        <option value="Saturday">
                            Saturday
                        </option>

                    </select>


                    <input
                        type="time"
                        name="start_time"
                    >


                    <input
                        type="time"
                        name="end_time"
                    >

                </div>

            </div>


            <!-- Buttons -->

            <div class="buttons">

                <button type="submit">
                    Create Course
                </button>

                <button
                    type="button"
                    onclick="window.location.href='course_admin.php'">
                    Cancel
                </button>

            </div>


        </form>

    </div>

</div>


<script>

document.getElementById("courseForm").onsubmit = function(event) {

    event.preventDefault();


    let courseID =
        document.querySelector("[name='course_id']").value.trim();

    let courseName =
        document.querySelector("[name='course_name']").value.trim();

    let courseCode =
        document.querySelector("[name='course_code']").value.trim();

    let credit =
        document.querySelector("[name='credit']").value.trim();

    let day =
        document.querySelector("[name='day']").value;

    let startTime =
        document.querySelector("[name='start_time']").value;

    let endTime =
        document.querySelector("[name='end_time']").value;


    if (
        courseID === "" ||
        courseName === "" ||
        courseCode === "" ||
        credit === "" ||
        day === "" ||
        startTime === "" ||
        endTime === ""
    ) {

        alert("Please fill all fields.");

        return;

    }


    if (startTime >= endTime) {

        alert("End time must be after start time.");

        return;

    }


    /*
        Course will be stored in the database here later.
    */

    alert("Course created successfully.");

};

</script>


</body>

</html>
