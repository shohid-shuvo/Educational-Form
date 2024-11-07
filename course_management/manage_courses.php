<?php
include '../connect.php';  // Include the database connection file

// Fetch existing courses
$query = "SELECT * FROM courses";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Courses</title>
</head>
<body>

<h2>Manage Courses</h2>

<!-- Add Course Form -->
<form action="add_course.php" method="POST">
    <input type="text" name="course_name" placeholder="Enter new course" required>
    <button type="submit">Add Course</button>
</form>

<!-- Courses Table -->
<table border="1">
    <tr>
        <th>Course ID</th>
        <th>Course Name</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['course_name']; ?></td>
            <td><?php echo $row['status'] == 1 ? 'Active' : 'Inactive'; ?></td>
            <td>
                <form action="delete_course.php" method="POST" style="display:inline;">
                    <input type="hidden" name="course_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
