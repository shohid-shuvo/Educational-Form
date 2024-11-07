<?php
include '../connect.php';  // Include the database connection file

// Check if course_id is passed
if (isset($_POST['course_id'])) {
    $course_id = (int)$_POST['course_id'];

    // Update the course status to 0 (soft delete)
    $query = "UPDATE courses SET status = 0 WHERE id = $course_id";

    if (mysqli_query($conn, $query)) {
        header("Location: manage_courses.php");  // Redirect to manage courses page
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
