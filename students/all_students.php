<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    // If user is not logged in, redirect to login page
    header("Location: ../admin/login.php");
    exit();
}
// database connection
require_once('../connect.php'); 
$query = "
    SELECT 
        student_enrollment.*,
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
        <h1 class="text-center fw-bold my-4"> Student Enrolling Lists</h1>

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
                            <table class="table m-0"  id="studentTable" class="display" style="width:100%">
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
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Mother Name</th>
                                    <th>Date of Birth</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Guardian Mobile</th>
                                    <th>Present Address</th>
                                    <th>Permanent Address</th>
                                    <th>Gender</th>
                                    <th>National ID</th>
                                    <th>Religion</th>
                                    <th>Image</th>
                                    <th>Educational Level</th>
                                    <th>Department</th>
                                    <th>University</th>
                                    <th>Actions</th> <!-- This should match the action buttons in each row -->
                                </tr>
                            </thead>
                                <tbody id="studentListBody">
                                    <!-- Student data will be loaded here -->
                                    <?php 
                                    // include('../student/fetch_students.php'); 
                                    
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $student_id = $row['id'];
                                            echo '<tr>';
                                            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['preferred_course']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['student_name']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['father_name']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['mother_name']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['dob']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['mobile']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['guardian_mobile']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['present_address']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['permanent_address']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['gender']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['nid']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['religion']) . '</td>';
                                        
                                            // Image column
                                            $imagePath = 'uploads/' . $row['image'];
                                            if (file_exists($imagePath) && !empty($row['image'])) {
                                                echo '<td><img src="' . htmlspecialchars($imagePath) . '" alt="Image" style="width:35px;height:35px;"></td>';
                                            } else {
                                                echo '<td><img src="path_to_default_image.jpg" alt="No Image" style="width:35px;height:35px;"></td>';
                                            }
                                        
                                            echo '<td>' . htmlspecialchars($row['educational_level']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['department']) . '</td>';
                                            echo '<td>' . htmlspecialchars($row['university']) . '</td>';
                                        
                                                                    // Actions column
                                            
                                            echo '<td class="sdl_dlt d-flex nowrap">';
                                            echo '<a id="delBtn" class="sdl_btnn" data-id="' . $student_id . '">Delete</a>';
                                            echo '<div id="loadingSpinner" style="display: none;"><img src="../assets/image/loading.gif" alt="Loading..."/></div>';
                                            echo '<a id="editStudentButton" class="editBtn" data-bs-toggle="modal" data-bs-target="#editStudentModal">Edit</a>';
                                            echo '<a href="student_profile.php?id=' . $student_id . '" class="btn btn-primary btn-sm ms-2">View Profile</a>';
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
