<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    // If user is not logged in, redirect to login page
    header("Location: ../admin/login.php");
    exit();
}

// Database connection
require_once('../connect.php'); 

// Modify query to select required fields: id, preferred_course, student_name, email, and mobile
$query = "
    SELECT 
        student_enrollment.id, 
        student_enrollment.student_name, 
        student_enrollment.email, 
        student_enrollment.mobile, 
        courses.course_name AS preferred_course
    FROM student_enrollment
    LEFT JOIN courses ON student_enrollment.preferred_course = courses.id
"; 

$result = mysqli_query($conn, $query);

$page_title = "Student Enrollment Form ";
include('../templates/header.php');
?>

<section class="enroll_list">
    <!-- STUDENT ADD  -->
    <div class="sdl_studentListBody">
        <h1 class="text-center fw-bold my-4">Student Enrolling Lists</h1>

        <!-- student add success message -->
        <div id="custom-alert" style="display: none; background-color: #4CAF50; color: white; padding: 10px; position: fixed; top: 10px; right: 10px; z-index: 1000;">
            Student added successfully.
        </div>
        
        <!-- student list table -->
        <div class="row sdl_enroll_table">
            <div class="col-lg-12 mx-auto">
                <div class="card border-0 shadow">
                    <div class="card-body p-5">
                        <div class="table-responsive">
                            <table class="table m-0" id="studentTable" class="display" style="width:100%">
                                <!-- filter course -->
                                <?php
                                    // Fetch course names from the database to populate the dropdown
                                    $courseQuery = "SELECT id, course_name FROM courses";
                                    $courseResult = mysqli_query($conn, $courseQuery);
                                    ?>
                                    <div class="dropdown w-25 mb-3">
                                        <label for="courseFilter">Select Course</label>
                                        <select id="courseFilter" class="form-select">
                                            <option value="">All Courses</option>
                                            <?php 
                                            if ($courseResult) {
                                                while ($courseRow = mysqli_fetch_assoc($courseResult)) {
                                                    echo '<option value="' . htmlspecialchars($courseRow['course_name']) . '">' . htmlspecialchars($courseRow['course_name']) . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                <!-- filter course END -->
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Preferred Course</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="studentListBody">
                                    <!-- Student data will be loaded here -->
                                    <?php 
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['preferred_course']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['student_name']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['mobile']) . '</td>';
                                            echo '<td class="sdl_dlt d-flex nowrap">';
                                            echo '<a id="delBtn" class="sdl_btnn" data-id="' . $row['id'] . '">Delete</a>';
                                            echo '<div id="loadingSpinner" style="display: none;"><img src="../assets/image/loading.gif" alt="Loading..."/></div>';
                                            echo '<a id="editStudentButton" class="editBtn" data-bs-toggle="modal" data-bs-target="#editStudentModal">Edit</a>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php  include('../templates/footer.php') ?>
