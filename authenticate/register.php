<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader if you are using Composer
// require 'vendor/autoload.php';

// Include PHPMailer classes

require '../PHPMailer/PHPMailer-master/src/Exception.php';
require '../PHPMailer/PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer/PHPMailer-master/src/SMTP.php';
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $token = bin2hex(random_bytes(50)); // Generate a random token

    // Database connection
    $conn = new mysqli('localhost', 'me', 'Greater@00', 'africuisine_db');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Insert user into database
    $sql = "INSERT INTO users (Name, Surname, Email, password, token) VALUES ('$name', '$surname', '$email', '$password', '$token')";

    if ($conn->query($sql) === TRUE) {
        // Send verification email
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true;
            $mail->Username = 'tshehlanamonyebodi@gmail.com'; // SMTP username
            $mail->Password = 'sayt fndi ssdx vraz'; // SMTP password
          
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('tshehlanamonyebodi@gmail.com', 'Verfication');
            $mail->addAddress($email); // Add a recipient

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification';
            $mail->Body    = "Please click the link below to verify your email address:<br><a href='verify.php?token=$token'>Verify Email</a>";

            $mail->send();
            echo 'A verification email has been sent to your email address.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

