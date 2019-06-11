<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

	$from  = $_POST['email']; // this is the sender's Email address

	$sender_name = $_POST['name'];

	$phone = $_POST['phone'];

	$business = $_POST['business'];
	$subject = "Form submission";

	$message = $sender_name . " has send the contact message. His / her phone number is : " .  $phone . " and 
	his / her selected business type is " . $business;
	$headers = 'From: ' . $from;

try {
    //Server settings
	$email->SMTPDebug = true;                                    // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.office365.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'info@ecollectionz.com';                     // SMTP username
    $mail->Password   = 'ecollectz@2018';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
   	$mail->setFrom('info@ecollectionz.com', 'info@ecollectionz.com');
   	$mail->addAddress('info@ecollectionz.com', 'info@ecollectionz.com');
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Form submission -'.$sender_name;
	$mail->Body    = "<h3>".$sender_name . " has send the Request a Call. <br>  His / her phone number is : " .  $phone . " 
	and his / her selected business type is " . $business." <br> His email is: ".$from."</h3>";

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


	
	



?>