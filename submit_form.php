<?php
ob_start(); // Start output buffering to prevent accidental output
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json'); // Set header for JSON response

require 'vendor/autoload.php';
include 'connect.php';

$response = []; // Initialize the response array

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $preferredCourse = $_POST['preferredCourse'] ?? '';
    $studentName = $_POST['studentName'] ?? '';
    $fatherName = $_POST['fatherName'] ?? '';
    $motherName = $_POST['motherName'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $email = $_POST['email'] ?? '';
    $guardianMobile = $_POST['guardianMobile'] ?? '';
    $presentAddress = $_POST['presentAddress'] ?? '';
    $permanentAddress = $_POST['permanentAddress'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $nid = $_POST['nid'] ?? '';
    $religion = $_POST['religion'] ?? '';
    $imageUpload = $_FILES['imageUpload'] ?? null;
    $edulev = $_POST['edulev'] ?? '';
    $deptSubject = $_POST['deptSubject'] ?? '';
    $uni = $_POST['uni'] ?? '';

    // Handle image upload
    $imagePath = '';
    if ($imageUpload && $imageUpload['size'] > 0) {
        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true);
        }
        $imagePath = "uploads/" . basename($imageUpload['name']);
        $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        $validImageTypes = ['jpg', 'png', 'jpeg', 'gif'];

        if (in_array($imageFileType, $validImageTypes) && $imageUpload['size'] < 500000) {
            if (!move_uploaded_file($imageUpload['tmp_name'], $imagePath)) {
                ob_end_clean();
                echo json_encode(['success' => false, 'message' => 'File upload failed.']);
                exit();
            }
        } else {
            ob_end_clean();
            echo json_encode(['success' => false, 'message' => 'Invalid image file or too large.']);
            exit();
        }
    }

    // Prepare errors array
    $errors = [];

    // Email validation
    if (empty($email)) {
        $errors['email'] = 'Input field is empty';
    } else {
        $emailDuplicate = mysqli_query($conn, "SELECT * FROM student_enrollment WHERE email='$email'");
        if (mysqli_num_rows($emailDuplicate) > 0) {
            $errors['email'] = 'This email address already exists.';
        }
    }

    // Mobile validation
    if (empty($mobile)) {
        $errors['mobile'] = 'Mobile number is required.';
    } elseif (!preg_match('/^\d{11}$/', $mobile)) {
        $errors['mobile'] = '<small>Mobile number must be exactly 11 digits.';
    } else {
        $mobileDuplicate = mysqli_query($conn, "SELECT * FROM student_enrollment WHERE mobile='$mobile'");
        if (mysqli_num_rows($mobileDuplicate) > 0) {
            $errors['mobile'] = 'This mobile number already exists.';
        }
    }

    // NID validation
    if (!empty($nid)) {
        $nidDuplicate = mysqli_query($conn, "SELECT * FROM student_enrollment WHERE nid='$nid'");
        if (mysqli_num_rows($nidDuplicate) > 0) {
            $errors['nid'] = 'This NID number already exists.';
        }
    }

    // Check if there are any errors
    if (!empty($errors)) {
        $response = ['success' => false, 'errors' => $errors];
    } else {
        // If no errors, proceed with data insertion
        try {
            $stmt = $conn->prepare("INSERT INTO student_enrollment (preferred_course, student_name, father_name, mother_name, dob, mobile, email, guardian_mobile, present_address, permanent_address, gender, nid, religion, image, educational_level, department, university) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssssssssssss", $preferredCourse, $studentName, $fatherName, $motherName, $dob, $mobile, $email, $guardianMobile, $presentAddress, $permanentAddress, $gender, $nid, $religion, $imagePath, $edulev, $deptSubject, $uni);

            if ($stmt->execute()) {
                $response = ['success' => true, 'message' => 'Data inserted successfully.'];
            } else {
                $response = ['success' => false, 'message' => 'Data insertion failed.'];
            }
        } catch (mysqli_sql_exception $e) {
            $response = ['success' => false, 'message' => 'Database insertion failed: ' . $e->getMessage()];
        }
    }
} else {
    $response = ['success' => false, 'message' => 'Invalid request method.'];
}

ob_end_clean(); // Clear buffer to avoid extra whitespace or errors
echo json_encode($response); // Send JSON response
exit();
?>
