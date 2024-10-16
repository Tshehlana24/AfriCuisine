<?php
session_start();
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection
    $conn = mysqli_connect('db', 'my_user', 'my_password', 'africuisine_db');

    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    // Check if email exists
    $stmt = $conn->prepare("SELECT user_id, Name, Surname, password FROM users WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();


    if (!$stmt) {
        die('Prepare failed: ' . $conn->error); // Output any errors from prepare()
    }

    // Bind parameters and execute
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['Name'];
            $_SESSION['surname'] = $user['Surname'];
            
            // Redirect to a dashboard or welcome page
            header("Location: ../index.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password.'); window.location.href = './login.html';</script>";
        }
    } else {
        echo "<script>alert('No user found with that email address.'); window.location.href = './login.html';</script>";
    }

    $stmt->close();
    $conn->close();

}

