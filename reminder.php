<?php
require_once("includes/connection.php");
require("includes/functions.php");
$days = get_weekend();
$self = 1;

$sql = "SELECT user_id, first_name, last_name, username, email_address FROM users WHERE subscription = '1'";
$sql_blast = mysql_query($sql);

while ($blast = mysql_fetch_assoc($sql_blast)) {
	
	extract($blast);
	
	$day1 = date('Y-m-d', $days['day1']);
	$day2 = date('Y-m-d', $days['day2']);
	$sql_user_id = "%," . $user_id . ",%";
	
	$day1_sql = "SELECT * FROM events WHERE accepted NOT LIKE '$sql_user_id' AND declined NOT LIKE '$sql_user_id' AND undecided NOT LIKE '$sql_user_id' AND date = '$day1'";
	$day1_sql_need_update = mysql_query($day1_sql);
	
	$day2_sql = "SELECT * FROM events WHERE accepted NOT LIKE '$sql_user_id' AND declined NOT LIKE '$sql_user_id' AND undecided NOT LIKE '$sql_user_id' AND date = '$day2'";
	$day2_sql_need_update = mysql_query($day2_sql);
	
	// If the user hasn't updated their availability for the coming weekend on Saturday OR Sunday, proceed to set up the reminder email
	if (mysql_num_rows($day1_sql_need_update) > 0 || mysql_num_rows($day2_sql_need_update) > 0) {
		
		$to = $first_name . " " . $last_name . " <" . $email_address . ">";

	    $subject = "Get Dunked On. Availability " . date('m/d/y'); 

		// Define an HTML file to read
		$fPath = $_SERVER['PHP_SELF'];
		$path = dirname($fPath);
		$message_base = $path . "/" . "reminder.html";

		// Open the HTML file
		$html_email = fopen($message_base,"r");

		// Read the HTML file and store it in the variable MESSAGE
		$message = fread($html_email, filesize($message_base));

		// Close the HTML file
		fclose($html_email);

		$message = str_replace("THEUSERNAME", $username, $message);
		$message = str_replace("THECOUNTSAT", countit(1), $message);
		$message = str_replace("THECOUNTSUN", countit(2), $message);
		$message = str_replace("THEFIRSTNAME", $first_name, $message);
		$message = str_replace("THETIME", date('g:ia'), $message);
		$message = str_replace("SATDATE", date('l, F jS', $days['day1']), $message);
		$message = str_replace("SUNDATE", date('l, F jS', $days['day2']), $message);

	    // To send the HTML mail we need to set the Content-type header. 
	   	$headers = "From: " . "'Get Dunked On' <noreply@getdunkedon.com>" . "\r\n";
		// $headers .= "Reply-To: ". "noreply@test.com" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	    // Now, lets send the email. 
	    mail($to, $subject, $message, $headers);
		//echo $email_address . "<br />";
		
		// Send once to myself
		if ($self > 0) {
			
			$to = "flomid@getdunkedon.com";
			$message = str_replace($username, "FLomid", $message);
			$message = str_replace($first_name, "Omid", $message);
			
			mail($to, $subject, $message, $headers);
			
			$self = -1;
		}
	}

}

?>