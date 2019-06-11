<?php 


	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	// Load Composer's autoloader
	require 'vendor/autoload.php';
	
	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);
	
	$from  = $_POST['email']; // this is the sender's Email address

	$name = $_POST['name'];

	$location = $_POST['location'];

	$note = $_POST['message'];



	$subject = "Contact submission - ".$name;

	$message = $name . " has send the contact message. His / her location is : " .  $location . 
			". He / she worte the following... <br> <br>" . $note;
	$message.="<br> Email Address: ".$from;
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
		$mail->Subject = $subject;
		$mail->Body    = $message;
	
		$mail->send();
		echo 'Message has been sent';
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}

?>