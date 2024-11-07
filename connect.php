<?php
// connect.php - Database connection file

// Database connection parameters
$host = 'localhost'; // e.g. localhost
$db = 'students'; // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    // Connection failed
    die("Connection failed: " . $conn->connect_error);
} else {
    // Connection successful
    ?>
    <!-- <div id="connectionMessage" style="display: none; color: #fff;">
        Database connection successful!
    </div>
    <script>
        // Display the success message
        const messageDiv = document.getElementById('connectionMessage');
        messageDiv.style.display = 'block'; // Show the message

        // Hide the message after 2 seconds
        setTimeout(() => {
            messageDiv.style.display = 'none'; // Hide the message
        }, 2000);
    </script> -->
    <?php
}


// Your database operations go here...

// Close the connection when done
// $conn->close();
?>