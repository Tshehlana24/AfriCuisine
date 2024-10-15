<?php
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Database connection
    $conn =  mysqli_connect('db', 'my_user', 'my_password', 'africuisine_db');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Verify token
    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $update = "UPDATE users SET is_verified=1, token=NULL WHERE user_id=" . $user['user_id'];
        if ($conn->query($update) === TRUE) {
            echo "Your email has been verified.";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Invalid token.";
    }

    $conn->close();
} else {
    echo "No token provided.";
}
?>
