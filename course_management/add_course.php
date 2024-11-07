<?php
include '../connect.php';  // Include the database connection file

// Get POST data
if (isset($_POST['course_name'])) {
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
    $created_by = 'admin_user'; // Replace with actual logged-in user (e.g., from session)
    $updated_by = 'admin_user'; // Replace with actual logged-in user

    // Insert the new course into the database
    $query = "INSERT INTO courses (course_name, status, created_by, updated_by) 
              VALUES ('$course_name', 1, '$created_by', '$updated_by')";

    if (mysqli_query($conn, $query)) {
        header("Location: manage_courses.php");  // Redirect to manage courses page
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
