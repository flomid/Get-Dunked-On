<?php
require_once('includes/connection.php');
require('includes/functions.php');

$custom_message = nl2br(htmlentities($_POST['message']));
$onlysubscribed = 0;
if (isset($_POST['onlysubscribed'])) {
	$onlysubscribed = $_POST['onlysubscribed'];
}

if ($onlysubscribed == 1) {
	$sql = "SELECT email_address FROM users WHERE subscription = 1";
} else {
	$sql = "SELECT email_address FROM users";
}
$query = mysql_query($sql);
while ($result = mysql_fetch_assoc($query)) {
	$recipients .= $result['email_address'] . ", ";
}
	
	//change this to your email.
		//$to = "flomid@getdunkedon.com, flomid@gmail.com, "; // For testing
	    $to = $recipients; 
	
	    $subject = "Message from Get Dunked On!" . date('m/d/y');

	    // Define an HTML file to read
		$message_base = "message.html";

		// Open the HTML file
		$html_email = fopen($message_base,"r");

		// Read the HTML file and store it in the variable MESSAGE
		$message = fread($html_email, filesize($message_base));

		// Close the HTML file
		fclose($html_email);

		$message = str_replace("THECUSTOMMESSAGE", $custom_message, $message);

	    // To send the HTML mail we need to set the Content-type header. 
	   	$headers = "From: " . "'Get Dunked On' <noreply@getdunkedon.com>" . "\r\n";
		// $headers .= "Reply-To: ". "noreply@test.com" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	    // now lets send the email. 
	    mail($to, $subject, $message, $headers);
		// echo $recipients;
		//echo $message;
	
	header('location:sendmessage.php?message=1');


?>