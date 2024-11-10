<?php
ob_start(); // Start output buffering to prevent accidental output
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json'); // Set header for JSON response

require 'vendor/autoload.php';
include 'connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

    if (empty($preferredCourse)) {
        $errors['email'] = '';
    }
    if (empty($studentName)) {
        $errors['email'] = '';
    }
    if (empty($fatherName)) {
        $errors['email'] = '';
    }
    if (empty($motherName)) {
        $errors['email'] = '';
    }
    if (empty($guardianMobile)) {
        $errors['email'] = '';
    }
    if (empty($uni)) {
        $errors['email'] = '';
    }
    if (empty($deptSubject)) {
        $errors['email'] = '';
    }

    // Email validation
    if (empty($email)) {
        $errors['email'] = ''; // can use error message in this string
    } else {
        $emailDuplicate = mysqli_query($conn, "SELECT * FROM student_enrollment WHERE email='$email'");
        if (mysqli_num_rows($emailDuplicate) > 0) {
            $errors['email'] = 'This email address already use.';
        }
    }

    // Mobile validation
    if (empty($mobile)) {
        $errors['mobile'] = ''; // can use error message in this string
    } elseif (!preg_match('/^\d{11}$/', $mobile)) {
        $errors['mobile'] = 'Mobile number must be exactly 11 digits.';
    } else {
        $mobileDuplicate = mysqli_query($conn, "SELECT * FROM student_enrollment WHERE mobile='$mobile'");
        if (mysqli_num_rows($mobileDuplicate) > 0) {
            $errors['mobile'] = 'This mobile number already Use.';
        }
    }

    // NID validation
    if (!empty($nid)) {
        $nidDuplicate = mysqli_query($conn, "SELECT * FROM student_enrollment WHERE nid='$nid'");
        if (mysqli_num_rows($nidDuplicate) > 0) {
            $errors['nid'] = 'This Nid already use.'; // can use error message in this string
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
            // sending to email setup
            if ($stmt->execute()) {
                // Send confirmation email using PHPMailer
                $mail = new PHPMailer(true);
                try {
                    // Server settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'shuvo001956@gmail.com';
                    $mail->Password = 'oiqdzulhqnyogptx';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
                
                    // Recipients for student email
                    $mail->setFrom('shuvo001956@gmail.com', 'HSTU');
                    $mail->addAddress($email, $studentName);
                
                    // Content for student email
                    $mail->isHTML(true);
                    $mail->Subject = 'Enrollment Confirmation';
                    $mail->Body    = "<h1>Thank you for enrolling, $studentName!</h1><p>Your enrollment in the course <b>$preferredCourse</b> has been successfully received.</p>
                                        <ul>
                                            <li><strong>Preferred Course:</strong> $preferredCourse</li>
                                            <li><strong>Student Name:</strong> $studentName</li>
                                            <li><strong>Father's Name:</strong> $fatherName</li>
                                            <li><strong>Mother's Name:</strong> $motherName</li>
                                            <li><strong>Date of Birth:</strong> $dob</li>
                                            <li><strong>Mobile:</strong> $mobile</li>
                                            <li><strong>Email:</strong> $email</li>
                                            <li><strong>Guardian's Mobile:</strong> $guardianMobile</li>
                                            <li><strong>Present Address:</strong> $presentAddress</li>
                                            <li><strong>Permanent Address:</strong> $permanentAddress</li>
                                            <li><strong>Gender:</strong> $gender</li>
                                            <li><strong>NID:</strong> $nid</li>
                                            <li><strong>Religion:</strong> $religion</li>
                                            <li><strong>Educational Level:</strong> $edulev</li>
                                            <li><strong>Department/Subject:</strong> $deptSubject</li>
                                            <li><strong>University:</strong> $uni</li>
                                        </ul>";
                
                    // Send email to student
                    $mail->send();
                
                    // Clear recipient for admin email
                    $mail->clearAddresses();
                    $mail->addAddress('shuvo001956@gmail.com'); // Add admin email here
                
                    // Content for admin email
                    $mail->Subject = 'New Student Enrollment Notification';
                    $mail->Body    = "<h1>New Enrollment Notification</h1>
                                        <p>A new student has enrolled with the following details:</p>
                                        <ul>
                                            <li><strong>Preferred Course:</strong> $preferredCourse</li>
                                            <li><strong>Student Name:</strong> $studentName</li>
                                            <li><strong>Father's Name:</strong> $fatherName</li>
                                            <li><strong>Mother's Name:</strong> $motherName</li>
                                            <li><strong>Date of Birth:</strong> $dob</li>
                                            <li><strong>Mobile:</strong> $mobile</li>
                                            <li><strong>Email:</strong> $email</li>
                                            <li><strong>Guardian's Mobile:</strong> $guardianMobile</li>
                                            <li><strong>Present Address:</strong> $presentAddress</li>
                                            <li><strong>Permanent Address:</strong> $permanentAddress</li>
                                            <li><strong>Gender:</strong> $gender</li>
                                            <li><strong>NID:</strong> $nid</li>
                                            <li><strong>Religion:</strong> $religion</li>
                                            <li><strong>Educational Level:</strong> $edulev</li>
                                            <li><strong>Department/Subject:</strong> $deptSubject</li>
                                            <li><strong>University:</strong> $uni</li>
                                        </ul>";
                
                    // Send email to admin
                    $mail->send();
                
                    $response = ['success' => true, 'message' => 'Data inserted successfully and confirmation emails sent to both student and admin.'];
                } catch (Exception $e) {
                    $response = ['success' => true, 'message' => 'Data inserted successfully but emails could not be sent.'];
                }
                
            } else {
                $response = ['success' => false, 'message' => 'Data insertion failed.'];
            }
            // sending to email setup END
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
