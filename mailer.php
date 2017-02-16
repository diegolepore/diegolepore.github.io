<?php
require 'phpmailer/class.phpmailer.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$name = strip_tags(trim($_POST["name"]));
$name = str_replace(array("\r","\n"),array(" "," "),$name);
$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
$message = trim($_POST["message"]);

$email_content = "Name: $name\n";
$email_content .= "Email: $email\n\n";
$email_content .= "Message:\n$message\n";

$mail = new PHPMailer;

// $mail->IsSMTP();                                      // Set mailer to use SMTP
// $mail->Host = 'webcloud41.au.syrahost.com;mail.prestigesigngroup.com.au';  // Specify main and backup server
// $mail->SMTPAuth = true;                               // Enable SMTP authentication
// $mail->Username = 'info@prestigesigngroup.com.au';                            // SMTP username
// $mail->Password = 'Psgitb';                           // SMTP password
// $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'info@diegolepore.com.ve';
$mail->FromName = 'Mailer';
$mail->AddAddress('diegopalacios3@gmail.com');  // Add a recipient
//$mail->AddAddress('ellen@example.com', 'Josh Adams');               // Name is optional
//$mail->AddReplyTo('info@example.com', 'Information');
//$mail->AddCC('cc@example.com');
//$mail->AddBCC('bcc@example.com');

//$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
//$mail->AddAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = $email_content;
$mail->AltBody = $email_content;

if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';
}
    //
    // // Only process POST reqeusts.
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     // Get the form fields and remove whitespace.
    //     $name = strip_tags(trim($_POST["name"]));
		// 		//$name = str_replace(array("\r","\n"),array(" "," "),$name);
    //     $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    //     $message = trim($_POST["message"]);
    //
    //     // Check that data was sent to the mailer.
    //     if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //         // Set a 400 (bad request) response code and exit.
    //         http_response_code(400);
    //         echo "Oops! There was a problem with your submission. Please complete the form and try again.";
    //         exit;
    //     }
    //
    //     // Set the recipient email address.
    //     $recipient = "diegopalacios3@gmail.com";
    //
    //     // Set the email subject.
    //     $subject = "New contact from $name";
    //
    //     // Build the email content.
    //     $email_content = "Name: $name\n";
    //     $email_content .= "Email: $email\n\n";
    //     $email_content .= "Message:\n$message\n";
    //
    //     // Build the email headers.
    //     $email_headers = "From: $name <$email>";
    //
    //     // Send the email.
    //     if (mail($recipient, $subject, $email_content, $email_headers)) {
    //         // Set a 200 (okay) response code.
    //         http_response_code(200);
    //         echo "Thank You! Your message has been sent.";
    //     } else {
    //         // Set a 500 (internal server error) response code.
    //         http_response_code(500);
    //         echo "Oops! Something went wrong and we couldn't send your message.";
    //     }
    //
    // } else {
    //     // Not a POST request, set a 403 (forbidden) response code.
    //     http_response_code(403);
    //     echo "There was a problem with your submission, please try again.";
    // }

?>
