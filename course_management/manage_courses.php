<?php
include('../connect.php');

// Fetch courses where status is 1 (active)
$sql = "SELECT * FROM courses WHERE status = 1"; // Fetch only active courses
$result = $conn->query($sql);

// Handle soft delete (update status to 0)
if (isset($_POST['courseId'])) {
    $courseId = $_POST['courseId'];

    // Soft delete the course by updating status to 0
    $deleteSql = "UPDATE courses SET status = 0 WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $courseId);

    if ($stmt->execute()) {
        echo "Course marked as deleted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    exit; // Stop further script execution
}

// Insert new course
if (isset($_POST['courseName'])) {
    $courseName = $_POST['courseName'];

    // Insert the course with status set to 1 (active)
    $stmt = $conn->prepare("INSERT INTO courses (course_name, status) VALUES (?, 1)");
    $stmt->bind_param("s", $courseName);

    if ($stmt->execute()) {
        echo "Course added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="sdl_course_mngmnt">
        <div class="container">
            <h2>Manage Courses</h2>

            <!-- Add Course Form -->
            <form id="addCourseForm">
                <input type="text" id="courseName" name="courseName" placeholder="Enter Course Name" required>
                <button type="submit">Add Course</button>
            </form>

            <h3>Course List</h3>
            <table>
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['course_name']; ?></td>
                            <td>
                                <!-- Soft delete button (mark as deleted) -->
                                <button class="deleteCourseBtn" data-id="<?php echo $row['id']; ?>">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="../assets/js/my_custom.js"></script>
