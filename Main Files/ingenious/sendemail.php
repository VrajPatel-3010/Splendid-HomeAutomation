<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST["username"])) {
    $mail = new PHPMailer(true); // Passing `true` enables exceptions

    try {
        // Server settings
        // $mail->SMTPDebug = 2; // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        //$mail->Host = 'relay-hosting.secureserver.net'; // Specify GoDaddy's SMTP server
        $mail->Host = 'smtp.office365.com'; // Specify Microsoft's SMTP server (for Office 365)
        $mail->SMTPAuth = false; // Disable SMTP authentication
        $mail->Port = 587; // TCP port to connect to
        //$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->SMTPDebug = 2; // Enable verbose debug output

        // Recipients
        $mail->setFrom('info@splendidit.com', 'Mailer');
        $mail->addAddress('info@splendidit.com', 'Recipient Name'); // Add a recipient
        $mail->SMTPDebug = 2; // Enable verbose debug output

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $userName = isset($_POST['username']) ? preg_replace("/[^\s\S\.\-\_\@a-zA-Z0-9]/", "", $_POST['username']) : "";
        $senderEmail = isset($_POST['email']) ? preg_replace("/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email']) : "";
        $userMessage = isset($_POST['contact_message']) ? preg_replace("/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['contact_message']) : "";
        $messageBody = "Name: " . $userName . "<br>Email: " . $senderEmail . "<br>Message: " . $userMessage;

        $mail->Subject = 'Contact Us';
        $mail->Body    = $messageBody;
        $mail->AltBody = strip_tags($messageBody);

        $mail->send();
        echo '<div class="success">Email has been sent successfully.</div>';
    } catch (Exception $e) {
        echo '<div class="error">Error: Email has not been sent. ' . $e->getMessage() . '</div>';
    }
} else {
    echo '<div class="failed">Failed sending your email.</div>';
}
?>
