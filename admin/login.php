<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../connect.php';

$error_user = '';
$error_password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE user_name = '$user_name'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['status'] = $user['status'];

            header("Location: ../admin/admin_panel.php");
            exit();
        } else {
            $error_password = "Incorrect password.";
        }
    } else {
        $error_user = "Username not found.";
    }
}

$page_title = "Login";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title ?></title>
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
  <link rel="stylesheet" href="../assets/css/app.css">
  <link rel="stylesheet" href="../assets/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="sdl-login">
    <div class="container">
        <div class="login_cover d-md-flex g-5 p-md-3 p-lg-5 align-items-center">
            <div class="login_box">
                <h2 class="text-center mt-5 text-light">Admin Login</h2>
                <form action="login.php" method="POST" class="mt-3 sdl_form">
                    <div class="form-group group">
                        <input type="text" class="form-control" id="user_name" name="user_name" placeholder="User Name" required>
                        <?php if ($error_user): ?>
                            <strong class="text-danger"><?php echo $error_user; ?></strong>
                        <?php endif; ?>
                        <input type="password" class="form-control" id="password" name="password" placeholder="User Password" required>
                        <?php if ($error_password): ?>
                            <strong class="text-danger"><?php echo $error_password; ?></strong>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn sdl_btn">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php  include('../templates/footer.php') ?>
