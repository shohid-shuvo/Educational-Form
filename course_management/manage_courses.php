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
$page_title = "Manage Courses";
include('../templates/header.php')
?>


    <div class="sdl_course_mngmnt pt-5">
        <div class="sdl_add_crs_container row px-4">
            <div class="sdl_add_crs_cvr col-md-5 pe-2 shadow d-flex align-self-baseline flex-column bg-light-subtle">
                <h2 class="mb-2">Manage Courses</h2>
                <!-- Add Course Form -->
                <form id="addCourseForm">
                    <input type="text" id="courseName" name="courseName" placeholder="Enter Course Name" required>
                    <button type="submit" class="add_crs_btn mt-0">Add Course</button>
                </form>
            </div>
            <div class="sdl_crs_list_cvr col-md-7 shadow">  
                <h2>Course List</h2>
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
                                <td width="200">
                                    <!-- Soft delete button (mark as deleted) -->
                                    <button class="deleteCourseBtn" data-id="<?php echo $row['id']; ?>"><img src="../assets/images/delete.png" class="me-2" alt="delete" width="22">Delete</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php  include('../templates/footer.php') ?>