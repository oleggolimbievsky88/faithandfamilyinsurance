<?php
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

    // Email details
    $to_email = "info@faithandfamilyinsurance.com";
    $subject = "New Insurance Estimate Request from $name";
    $message = "New Insurance Estimate Request:\n\n";
    $message .= "Name: $name\n";
    $message .= "Phone: $phone\n";
    $message .= "Address: $address\n";
    $message .= "Date of Birth: $dob\n";
    $message .= "Beneficiary: $beneficiary\n";
    $message .= "Tobacco Use: $tobacco\n";
    $message .= "Coverage Amount: $$coverage\n";
    $message .= "Preferred Call Time: $call_time\n";
    $message .= "Email: $email\n";
    $message .= "Additional Details: $additional_details\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send email
    if (mail($to_email, $subject, $message, $headers)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send email']);
    }
    exit;
}
?> 