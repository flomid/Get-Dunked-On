<?php
require_once('includes/connection.php');
require('includes/functions.php');

$email = $_POST['email'];
$invite_code = gen_invite();

$sql = "SELECT * FROM users WHERE email_address='$email'";
$result = mysql_query($sql);
$count = mysql_num_rows($result);

if ($count > 0) {
	header('location:invite.php?message=0');
}	
else {
	$sql = "INSERT INTO invitations (invite_code) VALUES ('$invite_code')";
	$run = mysql_query($sql) or die( "An error has occurred: " .mysql_error (). ":" .mysql_errno ());
	
	//change this to your email. 
	    $to = $email; 
	
	    $subject = "You've been invited to Get Dunked On!"; 

	    // Define an HTML file to read
		$message_base = 'invitation.html';

		// Open the HTML file
		$html_email = fopen($message_base,"r");

		// Read the HTML file and store it in the variable MESSAGE
		$message = fread($html_email, filesize($message_base));

		// Close the HTML file
		fclose($html_email);

		$message = str_replace("THEINVITATIONCODE", $invite_code, $message);

	    // To send the HTML mail we need to set the Content-type header. 
	   	$headers = "From: " . "'Get Dunked On' <noreply@getdunkedon.com>" . "\r\n";
		// $headers .= "Reply-To: ". "noreply@test.com" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	    // now lets send the email. 
	    mail($to, $subject, $message, $headers);
		//echo $message;
	
	header('location:invite.php?message=1');
}


?>