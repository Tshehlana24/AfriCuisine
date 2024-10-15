<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require '../PHPMailer/PHPMailer-master/src/Exception.php';
require '../PHPMailer/PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer/PHPMailer-master/src/SMTP.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50)); // Generate a random token
    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expires in 1 hour

    // Database connection
    $conn = new mysqli('localhost', 'me', 'Greater@00', 'africuisine_db');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Check if email exists
    $emailCheckQuery = $conn->prepare("SELECT * FROM users WHERE Email = ?");
    $emailCheckQuery->bind_param("s", $email);
    $emailCheckQuery->execute();
    $result = $emailCheckQuery->get_result();

    if ($result->num_rows > 0) {
        // Email exists, save the token and expiry
        $sql = $conn->prepare("UPDATE users SET reset_token = ?, reset_expiry = ? WHERE Email = ?");
        $sql->bind_param("sss", $token, $expiry, $email);

        if ($sql->execute()) {
            // Send password reset email
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Sendinblue SMTP server
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
                $mail->Subject = 'Password Reset Request';
                $mail->Body    = "Please click the link below to reset your password:<br><a href='http://localhost/PHP/AfriCuisine/authenticate/reset_password.php?token=$token'>Reset Password</a>";

                $mail->send();
                ?>
                <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <title>Password Reset Request</title>
</head>
<body>
                <div id="myModal" class="modal fade">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="icon-box">
                                <i class="material-icons">&#xE876;</i>
                            </div>				
                            <h4 class="modal-title w-100">Awesome!</h4>	
                        </div>
                        <div class="modal-body">
                            <p class="text-center">Your booking has been confirmed. Check your email for detials.</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div></div></body>
            </div><?php
                echo 'A password reset link has been sent to your email address.';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error: " . $sql->error;
        }
    } else {
        echo "No account found with that email address.";
    }

    $emailCheckQuery->close();
    $sql->close();
    $conn->close();
}
?>
