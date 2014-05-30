<?php session_start();
require_once("includes/connection.php");

$username = $_POST['username'];
$password = $_POST['password'];

// Protect against MySQL injection
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

// Hash the password
$password = md5($password);

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysql_query($sql);
$count = mysql_num_rows($result);

if ($count == 1) {
	
	$entry = mysql_fetch_array($result, MYSQL_ASSOC);

	if (isset($_POST['stay_in'])) {
		$lifetime = (60*60*24*7*2);
		}
			else {
			$lifetime = (60*30);
	}
	
	setcookie(session_name(), session_id(), time()+$lifetime, "/");

	$_SESSION['username'] = $entry['username'];
	$_SESSION['user_type'] = $entry['user_type'];
	$_SESSION['user_id'] = $entry['user_id'];

	header("location:index.php");
	
}

else {
	session_destroy();
	header('location:signin.php?message=0');
}

?>