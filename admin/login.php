<?php
session_start();
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

            header("Location: ../admin/dashbord.php");
            exit();
        } else {
            $error_password = "Incorrect password.";
        }
    } else {
        $error_user = "Username not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container">
    <h2 class="text-center mt-5">Admin Login</h2>
    <form action="login.php" method="POST" class="mt-3">
        <div class="form-group">
            <label for="user_name">Username</label>
            <input type="text" class="form-control" id="user_name" name="user_name" required>
            <?php if ($error_user): ?>
                <small class="text-danger"><?php echo $error_user; ?></small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <?php if ($error_password): ?>
                <small class="text-danger"><?php echo $error_password; ?></small>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/my_custom.js"></script>
</body>
</html>
