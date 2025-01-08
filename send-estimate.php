<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your email address
    // $to_email = "info@faithandfamilyinsurance.com,oleg.golimbievsky@gmail.com";
    
    // // Collect form data
    // $name = $_POST['name'];
    // $phone = $_POST['phone'];
    // $address = $_POST['address'];
    // $dob = $_POST['dob'];
    // $beneficiary = $_POST['beneficiary'];
    // $tobacco = $_POST['tobacco'];
    // $coverage = $_POST['coverage'];
    // $call_time = $_POST['call-time'];
    // $email = $_POST['email'];
    // $additional_details = $_POST['additional-details'];
    
    // // Email subject
    // $subject = "New Insurance Estimate Request from $name";
    
    // // Email message
    // $message = "New Insurance Estimate Request:\n\n";
    // $message .= "Name: $name\n";
    // $message .= "Phone: $phone\n";
    // $message .= "Address: $address\n";
    // $message .= "Date of Birth: $dob\n";
    // $message .= "Beneficiary: $beneficiary\n";
    // $message .= "Tobacco Use: $tobacco\n";
    // $message .= "Coverage Amount: $$coverage\n";
    // $message .= "Preferred Call Time: $call_time\n";
    // $message .= "Email: $email\n";
    // $message .= "Additional Details: $additional_details\n";
    
    // // Headers
    // $headers = "From: $email\r\n";
    // $headers .= "Reply-To: $email\r\n";
    // $headers .= "X-Mailer: PHP/" . phpversion();
    
    // // Send email
    // if (mail($to_email, $subject, $message, $headers)) {
    //     header("Location: confirmation.html"); // Redirect to confirmation page
    //     exit;
    // } else {
    //     echo json_encode(['success' => false, 'message' => 'Failed to send email']);
    // }
    echo "test";
    exit;
}
?> 