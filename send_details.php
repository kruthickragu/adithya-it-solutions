<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMPT;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer library files
require 'vendor/autoload.php'; // Ensure PHPMailer is installed via Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $mobile = htmlspecialchars(trim($_POST['mobile']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP(); // Use SMTP
        $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'kruthick.ragu@gmail.com'; // Your Gmail email address
        $mail->Password = 'hhtw lnrw wbif hhau'; // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587; // SMTP port for TLS

        // Sender and recipient settings
        $mail->setFrom('p.r.kruthick.rosan@gmail.com', 'Aditya IT solutions'); // Sender's email and name
        $mail->addAddress('kruthick.ragu@gmail.com'); // Recipient's email

        // Email content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "
        <html>
        <head>
            <title>New Contact Form Submission</title>
        </head>
        <body>
            <h2>Contact Form Details</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Mobile:</strong> $mobile</p>
            <p><strong>Email:</strong> $email</p>
        </body>
        </html>";
        $mail->AltBody = "Name: $name\nMobile: $mobile\nEmail: $email"; // Plain text alternative

        // Send email
        if ($mail->send()) {
            echo "success"; // Notify the front-end of success
        } else {
            echo "Error sending email.";
        }
    } catch (Exception $e) {
        // Catch and display errors
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}
?>
