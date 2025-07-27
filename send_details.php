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
    $interest = htmlspecialchars(trim($_POST['interest']));

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
        $mail->Username = 'uniquekalai193@gmail.com'; // Your Gmail email address
        $mail->Password = 'nkis fayr iwta iliv'; // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587; // SMTP port for TLS

        // Sender and recipient settings
        $mail->setFrom('uniquekalai193@gmail.com', 'Aditya IT solutions'); // Sender's email and name
        $mail->addAddress('uniquekalai193@gmail.com'); // Recipient's email

        // Email content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "
        <html>
        <head>
            <title>New Training & Placement Enquiry</title>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 10px; text-align: center; }
                .content { background: #f8f9fa; padding: 20px; border-radius: 10px; margin-top: 20px; }
                .field { margin-bottom: 15px; }
                .label { font-weight: bold; color: #667eea; }
                .value { color: #333; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>🎯 New Training & Placement Enquiry</h2>
                    <p>Someone is interested in your services!</p>
                </div>
                <div class='content'>
                    <div class='field'>
                        <span class='label'>👤 Name:</span>
                        <span class='value'>$name</span>
                    </div>
                    <div class='field'>
                        <span class='label'>📱 Mobile:</span>
                        <span class='value'>$mobile</span>
                    </div>
                    <div class='field'>
                        <span class='label'>✉️ Email:</span>
                        <span class='value'>$email</span>
                    </div>
                    <div class='field'>
                        <span class='label'>🎯 Area of Interest:</span>
                        <span class='value'>$interest</span>
                    </div>
                </div>
            </div>
        </body>
        </html>";
        $mail->AltBody = "Name: $name\nMobile: $mobile\nEmail: $email\nArea of Interest: $interest"; // Plain text alternative

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
