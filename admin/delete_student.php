<?php
include '../connect.php'; // Include database connection

if (isset($_POST['deleteid'])) {
    $student_id = $_POST['deleteid'];

    // Prepare and execute the delete query
    $query = "DELETE FROM student_enrollment WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $student_id);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        echo 'success'; // Return success if the row is deleted
    } else {
        echo 'error'; // Return error if no rows were deleted
    }

    $stmt->close();
}
?>
