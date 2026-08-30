CREATE TABLE IF NOT EXISTS marks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_username VARCHAR(50) NOT NULL,
    course_id VARCHAR(20) NOT NULL,
    marks DECIMAL(5,2) CHECK (marks BETWEEN 0 AND 100),
    grade VARCHAR(3),

    UNIQUE KEY unique_student_course (
        student_username,
        course_id
    )
);