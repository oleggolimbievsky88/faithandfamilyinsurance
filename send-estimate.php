<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $dob = trim($_POST['dob']);
    $beneficiary = trim($_POST['beneficiary']);
    $tobacco = trim($_POST['tobacco']);
    $coverage = trim($_POST['coverage']);
    $call_time = trim($_POST['call-time']);
    $email = trim($_POST['email']);
    $additional_details = trim($_POST['additional-details']);

    // Validate data
    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($phone) || !preg_match('/^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/', $phone)) {
        $errors[] = "Valid phone number is required.";
    }
    if (empty($address)) {
        $errors[] = "Address is required.";
    }
    if (empty($dob) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dob)) {
        $errors[] = "Valid date of birth is required.";
    }
    if (empty($beneficiary)) {
        $errors[] = "Beneficiary name is required.";
    }
    if (!in_array($tobacco, ['yes', 'no'])) {
        $errors[] = "Tobacco use must be 'yes' or 'no'.";
    }
    if (empty($coverage) || !is_numeric($coverage)) {
        $errors[] = "Valid coverage amount is required.";
    }
    if (!in_array($call_time, ['morning', 'afternoon', 'evening'])) {
        $errors[] = "Preferred call time is invalid.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }

    // If there are errors, return them as JSON
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit;
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.ionos.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'info@faithandfamilyinsurance.com'; // SMTP username
        $mail->Password = 'M0nsterX2011!'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('info@faithandfamilyinsurance.com', 'Faith & Family Insurance');
        $mail->addAddress('info@faithandfamilyinsurance.com', 'Insurance Team');

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Insurance Estimate Request from $name";
        $mail->Body    = "Name: $name<br>Email: $email<br>..."; // Add other fields

        $mail->send();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
        echo json_encode(['success' => false, 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
    }
    exit;
}
?> 