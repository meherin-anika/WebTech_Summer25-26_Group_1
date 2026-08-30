CREATE TABLE IF NOT EXISTS attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_username VARCHAR(50) NOT NULL,
    course_id VARCHAR(20) NOT NULL,
    date DATE NOT NULL,
    status ENUM('present', 'absent') NOT NULL DEFAULT 'absent',

    UNIQUE KEY unique_attendance (
        student_username,
        course_id,
        date
    )
);