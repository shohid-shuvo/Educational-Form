<?php
// session_start();
// require '../connect.php';

// header('Content-Type: application/json');
// $response = ['success' => false, 'errors' => []];

// if (isset($_POST['login'])) {
//     $username = trim($_POST['username']);
//     $password = trim($_POST['password']);

//     // Check if fields are empty
//     if (empty($username)) {
//         $response['errors']['username'] = "Username cannot be empty.";
//     }
//     if (empty($password)) {
//         $response['errors']['password'] = "Password cannot be empty.";
//     }

//     if (empty($response['errors'])) {
//         $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ?");
//         $stmt->bind_param("s", $username);
//         $stmt->execute();
//         $result = $stmt->get_result();

//         if ($result->num_rows > 0) {
//             $user = $result->fetch_assoc();
//             if (password_verify($password, $user['password'])) {
//                 $_SESSION['user_id'] = $user['id'];
//                 $_SESSION['user_name'] = $user['user_name'];
//                 $response['success'] = true;
//             } else {
//                 $response['errors']['password'] = "Incorrect password.";
//             }
//         } else {
//             $response['errors']['username'] = "User not found.";
//         }
//     }
// }

// // Encode and return the response
// echo json_encode($response);
// exit;


// include '../connect.php';

// $user_name = "exampleUser";
// $plain_password = "userpassword123";

// // Hash the password
// $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

// // Insert into the database
// $sql = "INSERT INTO users (user_name, password) VALUES ('$user_name', '$hashed_password')";
// if (mysqli_query($conn, $sql)) {
//     echo "User added successfully with hashed password.";
// } else {
//     echo "Error: " . mysqli_error($conn);
// }
?>
