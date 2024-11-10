<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: ../admin/login.php");
    exit();
}

require_once('../connect.php');

// Get student ID from the URL
$student_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch student data based on the ID
$query = "
    SELECT 
        student_enrollment.id, 
        student_enrollment.student_name, 
        student_enrollment.father_name,
        student_enrollment.mother_name,
        student_enrollment.dob,
        student_enrollment.mobile,
        student_enrollment.email,
        student_enrollment.guardian_mobile,
        student_enrollment.present_address,
        student_enrollment.permanent_address,
        student_enrollment.gender,
        student_enrollment.nid,
        student_enrollment.religion,
        student_enrollment.image,
        student_enrollment.educational_level,
        student_enrollment.department,
        student_enrollment.university,
        student_enrollment.created_at,
        courses.course_name AS preferred_course
    FROM student_enrollment
    LEFT JOIN courses ON student_enrollment.preferred_course = courses.id
    WHERE student_enrollment.id = $student_id
";

$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);

$page_title = "Student Profile";
include('../templates/header.php');
?>

<section class="student-profile">
    <div class="container">
        <?php if ($student): ?>
            <div class="card mx-auto mt-4" style="max-width: 800px;">
                <div class="card-header text-center">
                    <h2>Profile of <?php echo htmlspecialchars($student['student_name']); ?></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <!-- Student Profile Image -->
                            <img src="../uploads/<?php echo htmlspecialchars($student['image']); ?>" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;" alt="Student Image">
                        </div>
                        <div class="col-md-8">
                            <!-- Basic Information -->
                            <h5>Personal Details</h5>
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($student['student_name']); ?></p>
                            <p><strong>Father's Name:</strong> <?php echo htmlspecialchars($student['father_name']); ?></p>
                            <p><strong>Mother's Name:</strong> <?php echo htmlspecialchars($student['mother_name']); ?></p>
                            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($student['dob']); ?></p>
                            <p><strong>Gender:</strong> <?php echo htmlspecialchars($student['gender']); ?></p>
                            <p><strong>National ID:</strong> <?php echo htmlspecialchars($student['nid']); ?></p>
                            <p><strong>Religion:</strong> <?php echo htmlspecialchars($student['religion']); ?></p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Contact Information</h5>
                            <p><strong>Mobile:</strong> <?php echo htmlspecialchars($student['mobile']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?></p>
                            <p><strong>Guardian's Mobile:</strong> <?php echo htmlspecialchars($student['guardian_mobile']); ?></p>
                            <p><strong>Present Address:</strong> <?php echo htmlspecialchars($student['present_address']); ?></p>
                            <p><strong>Permanent Address:</strong> <?php echo htmlspecialchars($student['permanent_address']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Educational Details</h5>
                            <p><strong>Preferred Course:</strong> <?php echo htmlspecialchars($student['preferred_course']); ?></p>
                            <p><strong>Educational Level:</strong> <?php echo htmlspecialchars($student['educational_level']); ?></p>
                            <p><strong>Department:</strong> <?php echo htmlspecialchars($student['department']); ?></p>
                            <p><strong>University:</strong> <?php echo htmlspecialchars($student['university']); ?></p>
                        </div>
                    </div>

                    <hr>

                    <div class="text-end">
                        <p><strong>Profile Created On:</strong> <?php echo htmlspecialchars($student['created_at']); ?></p>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger mt-4 text-center">
                Student not found.
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include('../templates/footer.php'); ?>
