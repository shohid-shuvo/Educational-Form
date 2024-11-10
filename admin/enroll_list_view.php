<section class="pdf-layout">
    <h2 class="text-center my-4">Student Enrollment Form Preview</h2>
    <?php
    // Fetch form data for a specific student (example using a student ID)
    $studentId = 1; // Replace with dynamic ID
    $studentQuery = "SELECT * FROM student_enrollment WHERE id = $studentId";
    $studentResult = mysqli_query($conn, $studentQuery);
    $studentData = mysqli_fetch_assoc($studentResult);

    // Display the form data in a PDF-like layout
    ?>
    <div class="pdf-preview-container">
        <div class="pdf-preview">
            <h3>Student Details</h3>
            <table class="table">
                <tr><th>ID:</th><td><?php echo htmlspecialchars($studentData['id']); ?></td></tr>
                <tr><th>Name:</th><td><?php echo htmlspecialchars($studentData['student_name']); ?></td></tr>
                <tr><th>Preferred Course:</th><td><?php echo htmlspecialchars($studentData['preferred_course']); ?></td></tr>
                <tr><th>Email:</th><td><?php echo htmlspecialchars($studentData['email']); ?></td></tr>
                <tr><th>Mobile:</th><td><?php echo htmlspecialchars($studentData['mobile']); ?></td></tr>
                <tr><th>Father's Name:</th><td><?php echo htmlspecialchars($studentData['father_name']); ?></td></tr>
                <tr><th>Mother's Name:</th><td><?php echo htmlspecialchars($studentData['mother_name']); ?></td></tr>
                <tr><th>Date of Birth:</th><td><?php echo htmlspecialchars($studentData['dob']); ?></td></tr>
                <tr><th>Guardian Mobile:</th><td><?php echo htmlspecialchars($studentData['guardian_mobile']); ?></td></tr>
                <tr><th>Present Address:</th><td><?php echo htmlspecialchars($studentData['present_address']); ?></td></tr>
                <tr><th>Permanent Address:</th><td><?php echo htmlspecialchars($studentData['permanent_address']); ?></td></tr>
                <tr><th>Gender:</th><td><?php echo htmlspecialchars($studentData['gender']); ?></td></tr>
                <tr><th>National ID:</th><td><?php echo htmlspecialchars($studentData['nid']); ?></td></tr>
                <tr><th>Religion:</th><td><?php echo htmlspecialchars($studentData['religion']); ?></td></tr>
                <tr><th>Educational Level:</th><td><?php echo htmlspecialchars($studentData['educational_level']); ?></td></tr>
                <tr><th>Department:</th><td><?php echo htmlspecialchars($studentData['department']); ?></td></tr>
                <tr><th>University:</th><td><?php echo htmlspecialchars($studentData['university']); ?></td></tr>
                <tr><th>Image:</th><td>
                    <?php
                    $imagePath = 'uploads/' . $studentData['image'];
                    if (file_exists($imagePath) && !empty($studentData['image'])) {
                        echo '<img src="' . htmlspecialchars($imagePath) . '" alt="Student Image" style="width:100px;height:100px;">';
                    } else {
                        echo '<img src="path_to_default_image.jpg" alt="No Image" style="width:100px;height:100px;">';
                    }
                    ?>
                </td></tr>
            </table>
        </div>
    </div>
</section>
