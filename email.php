   <?php
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;

   require 'vendor/autoload.php'; // Adjust the path if you installed PHPMailer manually

   $mail = new PHPMailer(true);

   try {
       //Server settings
       $mail->isSMTP();
       $mail->Host = 'smtp.ionos.com';
       $mail->SMTPAuth = true;
       $mail->Username = 'yourname@yourdomain.com'; // Your Ionos email
       $mail->Password = 'yourpassword'; // Your Ionos email password
       $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS
       $mail->Port = 587;

       //Recipients
       $mail->setFrom('yourname@yourdomain.com', 'Your Name');
       $mail->addAddress('recipient@example.com', 'Recipient Name');

       // Content
       $mail->isHTML(true);
       $mail->Subject = 'Test Email';
       $mail->Body    = 'This is a test email sent using PHPMailer with Ionos SMTP.';

       $mail->send();
       echo 'Email has been sent';
   } catch (Exception $e) {
       echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
   }