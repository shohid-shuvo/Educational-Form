<?php
if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
} else {
    // Handle the case when 'user_name' is not set, for example:
    $user_name = ''; // Or any default value or redirect to login
}
?>


<div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <div class="sidebar-brand">
                <img src="../assets/images/admin-panel.png" alt="photo" width="50"> 
                <span class="align-middle">Dashboard</span>
                </div>

                <ul class="sidebar-nav">
                    <li class="sidebar-item ">
                        <a class="sidebar-link" href="../admin/dashbord.php">
                        <img src="../assets/images/dashboard.png" class="me-2" width="24px" height="24px"  alt="Dashboard icon" data-target="../admin/dashbord.php"> <span class="align-middle">Enrolled List</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="../students/all_students.php" id="studentMenuItem" class="sidebar-link ajax-load"  data-target="../course_management/manage_courses.php">
                        <img src="../assets/images/course.png" class="me-2" width="24px" height="24px"  alt="Students icon"> <span class="align-middle">All Student</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="../students/student_profile.php" id="studentMenuItem" class="sidebar-link ajax-load"  data-target="../course_management/manage_courses.php">
                        <img src="../assets/images/course.png" class="me-2" width="24px" height="24px"  alt="Students icon"> <span class="align-middle">Student Profile</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="../course_management/manage_courses.php" id="studentMenuItem" class="sidebar-link ajax-load"  data-target="../course_management/manage_courses.php">
                        <img src="../assets/images/course.png" class="me-2" width="24px" height="24px"  alt="Students icon"> <span class="align-middle">Course List</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse justify-content-end">
                    <ul class="navbar-nav navbar-align">
                        
                        <li class="nav-item d-flex align-items-center ms-2 sdl_out_btn">
                            <!-- <span class="nav-icon  d-inline-block d-sm-none">
                                <i class="align-middle" data-feather="settings"></i>
                            </span> -->

                            <span class=" d-sm-inline-block" data-bs-toggle="dropdown">
                                <img src="../assets/images/avatar-1.jpeg" class="avatar img-fluid rounded me-1" alt="admin photo" /> <span class="text-dark"><?php echo $user_name; ?></span>
                            </span>
                        </li>
                        <li class="nav-item d-flex align-items-center ms-4 sdl_out_btn">
                            
                            <a  href="../admin/logout.php"> <img src="../assets/images/logout.png" alt="logout" width="22px"> Log out</a>
                        </li>
                    </ul>
                </div>
            </nav>
            