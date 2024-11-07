<?php
// Include database connection file (if applicable)
include 'connect.php'; // Your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    // Your PHP logic for processing the form data and inserting into the database
    // Use isset() as explained in the previous response
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Enrollment Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="form-container py-3 py-md-4">
  <div class="form-header">Student Enrollment Form</div>

  <form  id="enrollmentForm" class="needs-validation row" method="post" enctype="multipart/form-data" novalidate>
    <!-- Choose Preferred Course -->
    

    <!-- Choose Preferred Course -->
    <div class="mb-3">
      <label for="preferredCourse" class="form-label" >Choose Preferred Course*</label>
      <select class="form-select" name="preferredCourse" id="preferredCourse" required>
        <option value="">--Please choose--</option>
        <option value="Basic Programming with Python">Basic Programming with Python</option>
        <option value="Python DjangoDatabase">Python Django</option>
        <option value="Database">Database</option>
        <option value="Mobile App Development">Mobile App Development</option>
        <option value="Microsoft Excel">Microsoft Excel</option>
        <option value="Microsoft Excel"> Microsoft Word</option>
        <!-- Add other options here -->
      </select>
      <div class="invalid-feedback">Please select a course.</div>
    </div>
    
    <!-- Student's Name -->
    <div class="mb-3  col-md-6">
      <label for="studentName"  class="form-label">Student’s Name*</label>
      <input type="text" class="form-control" name="studentName" id="studentName" placeholder="Enter Name" required>
      <div class="invalid-feedback">Please enter your name.</div>
    </div>
    
    <!-- Father’s Name -->
    <div class="mb-3 col-md-6">
      <label for="fatherName" class="form-label">Father’s Name*</label>
      <input type="text" class="form-control" name="fatherName" id="fatherName" placeholder="Enter Father's Name" required>
      <div class="invalid-feedback">Please enter father's name.</div>
    </div>

    <!-- Mother’s Name -->
    <div class="mb-3 col-md-6">
      <label for="motherName" class="form-label">Mother’s Name*</label>
      <input type="text" class="form-control" name="motherName" id="motherName" placeholder="Enter Mother's Name" required>
      <div class="invalid-feedback">Please enter mother's name.</div>
    </div>
    
    <!-- Date of Birth -->
    <div class="mb-3 sdl_dob col-md-6">
      <label for="dob" class="form-label">Date of Birth*</label>
      <input type="date" name="dob"  class="form-control" id="dob" required>
      <!-- <span class="input-group-text">
        <i class="bi bi-calendar-date" style="pointer-events: none;"></i>
    </span> -->
      <div class="invalid-feedback">Please enter date of birth.</div>
    </div>

    <!-- 6. Mobile* -->
    <div class="mb-3 col-md-6">
        <label for="mobile" class="form-label">Mobile*</label>
        <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile" required>
        <div class="invalid-feedback">Please enter your mobile number.</div>
        <div id="mobile-error" class="error-message" style="display:none; color:red">number is already exist</div>
      </div>
  
      <!-- 7. Email* -->
      <div class="mb-3 col-md-6">
        <label for="email" class="form-label">Email*</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
        <div class="invalid-feedback">Please enter your email.</div>
        <div id="email-error" class="error-message" style="display:none; color:red">email is already exist</div>
      </div>

    <!-- 8. Guardian's Mobile* -->
    <div class="mb-3 col-md-5">
        <label for="guardianMobile" class="form-label">Guardian's Mobile*</label>
        <input type="tel" class="form-control" name="guardianMobile" id="guardianMobile" placeholder="Enter Guardian's Mobile" required>
        <div class="invalid-feedback">Please enter the guardian's mobile number.</div>
      </div>
  
      <!-- 11. Gender* -->
      <div class="mb-3 col-md-3">
        <label class="form-label">Gender*</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
          <label class="form-check-label" for="male">Male</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gender" id="female" value="female" required>
          <label class="form-check-label" for="female">Female</label>
        </div>
        <div class="invalid-feedback">Please select your gender.</div>
      </div>

      <!-- 13. Religion -->
      <div class="mb-3 col-md-4">
        <label for="religion" class="form-label">Religion*</label>
        <select class="form-select" name="religion" id="religion" required>
          <option value="">Select</option>
          <option value="Islam">Islam</option>
          <option value="Hindu">Hindu</option>
          <option value="Christian">Christian</option>
          <option value="Buddhism">Buddhism</option>
          <option value="Others">Others</option>
        </select>
        <div class="invalid-feedback">Please select your religion.</div>
      </div>
  
      <!-- 12. National ID/Birth Certificate No.* -->
      <div class="mb-3">
        <label for="nid" class="form-label">National ID/Birth Certificate No.*</label>
        <input type="text" name="nid" class="form-control" id="nid" placeholder="Enter NID" required>
        <div class="invalid-feedback">Please enter your National ID or Birth Certificate number.</div>
        <div id="nid-error" class="error-message" style="display:none; color:red">nid number is already exist</div>
      </div>
  
      

    <!-- Passport Size Image -->
    <div class="mb-3">
      <label for="imageUpload" class="form-label">Passport Size Image (max size: 1MB, .jpg, .png, .jpeg)*</label>
      <input class="form-control" name="imageUpload" type="file" id="imageUpload" accept=".jpg, .jpeg, .png" required>
      <div class="invalid-feedback">Please upload an image (max 1MB).</div>
    </div>

    <!-- 9. Present Address* -->
    <div class="mb-3">
        <label for="presentAddress" class="form-label">Present Address*</label>
        <input type="text" class="form-control" name="presentAddress" id="presentAddress" placeholder="Enter Present Address" required>
        <div class="invalid-feedback">Please enter the present address.</div>
      </div>
  
      <!-- 10. Permanent Address -->
      <div class="mb-3">
        <label for="permanentAddress" class="form-label">Permanent Address</label>
        <input type="text" class="form-control" name="permanentAddress" id="permanentAddress" placeholder="Enter Permanent Address">
      </div>

    <!-- 15. Educational Level* -->
    <div class="mb-3">
        <label for="edulev" class="form-label">Educational Level*</label>
        <select name="edulev" id="edulev" class="form-control form-select" required>
          <option value="">Select Level</option>
          <option value="Bachelor (Third Year)">Bachelor (Third Year)</option>
          <option value="Bachelor (Fourth Year)">Bachelor (Fourth Year)</option>
          <option value="Bachelor Completed">Bachelor Completed</option>
          <option value="Masters (First Year)">Masters (First Year)</option>
          <option value="Masters (Second Year)">Masters (Second Year)</option>
          <option value="Masters Completed">Masters Completed</option>
          <option value="Diploma (Third Year)">Diploma (Third Year)</option>
          <option value="Diploma (Fourth Year)">Diploma (Fourth Year)</option>
          <option value="Diploma Completed">Diploma Completed</option>
          <option value="Fazil (Third Year)">Fazil/ Equivalent (Third Year)</option>
          <option value="Fazil (Fourth Year)">Fazil/ Equivalent (Fourth Year)</option>
          <option value="Fazil Completed">Fazil/ Equivalent Completed</option>
        </select>
        <div class="invalid-feedback">Please select your educational level.</div>
      </div>
  
      <!-- 16. Department/Subject/Group* -->
      <div class="mb-3">
        <label for="deptSubject" class="form-label">Department/Subject/Group*</label>
        <input type="text" name="deptSubject" class="form-control" id="deptSubject" placeholder="Enter Department/Subject/Group" required>
        <div class="invalid-feedback">Please enter your Department/Subject/Group.</div>
      </div>
  
      <!-- 16. Trainee's University/Institute/College Name* -->
    <div class="mb-3">
        <label for="uni" class="form-label">Trainee's University/Institute/College Name*</label>
        <select id="uni" name="uni" onchange="CheckColors(this.value);" class="form-control form-select" required>
          <option value="Hajee Mohammad Danesh Science and Technology University (HSTU)">Hajee Mohammad Danesh Science and Technology University (HSTU)</option>
          <option value="others">Others</option>
        </select>
        <div class="invalid-feedback">Please select your university/institute/college.</div>
      </div>

    <!-- Password and Confirm Password -->
    <!-- <div class="mb-3">
      <label for="password" class="form-label">Password*</label>
      <input type="password" name="password" class="form-control" id="password" placeholder="Min. 8 characters" required minlength="8">
      <div class="invalid-feedback">Please enter a password (min. 8 characters).</div>
    </div>
    <div class="mb-3">
      <label for="confirmPassword" class="form-label">Confirm Password*</label>
      <input type="password" name="password"  class="form-control" id="confirmPassword" placeholder="Confirm Password" required minlength="8">
      <div class="invalid-feedback">Passwords do not match.</div>
    </div> -->

    <p class="succuss_msg p-3"></p>

    <!-- SUBMIT Button -->
    <button type="submit" name="REQUEST_METHOD"  class="btn btn-success w-100">Enroll</button>
     <div class="sdl_form_btn">
      <!-- Loading Spinner, initially hidden -->
      <div id="loadingSpinner" style="display: none;">
          <img src="assets/images/loading.gif" alt="Loading..." />
      </div>
     </div>
  </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/my_custom.js"></script>
</body>
</html>
