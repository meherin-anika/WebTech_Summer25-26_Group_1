<?php
session_start();
include "../Model/db.php";

$database = new db();
$connection = $database->connection();

$upload_message = "";
$upload_error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["course_file"])) {
    $file = $_FILES["course_file"];
    $fileName = $file["name"];
    $fileTmpName = $file["tmp_name"];
    $fileError = $file["error"];

    if ($fileError === 0) {
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = array("txt", "csv");

        if (in_array($fileExt, $allowed)) {
            $handle = fopen($fileTmpName, "r");
            $inserted = 0;
            
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (count($data) >= 7) {
                    $c_id = trim($data[0]);
                    $c_name = trim($data[1]);
                    $c_code = trim($data[2]);
                    $credit = intval($data[3]);
                    $day = trim($data[4]);
                    $start_time = trim($data[5]);
                    $end_time = trim($data[6]);

                    $res = $database->createCourse($connection, $c_id, $c_name, $c_code, $credit, $day, $start_time, $end_time);
                    if ($res) {
                        $inserted++;
                    }
                }
            }
            fclose($handle);
            
            $_SESSION['upload_message'] = "Successfully uploaded and inserted {$inserted} courses.";
        } else {
            $_SESSION['upload_error'] = "Invalid file type. Only .txt and .csv are allowed.";
        }
    } else {
        $_SESSION['upload_error'] = "Error uploading file. Please try again.";
    }
}

header("Location: ../View/course_upload.php");
exit();
?>