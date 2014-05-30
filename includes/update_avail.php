<?php
require_once("connection.php");
//sleep(1); // Test to allow the loading animation to display

$request = $_GET['request'];
$user_id = $_GET['user_id'];
$event_id = $_GET['event_id'];
$daynumber = $_GET['daynumber'];
$dayletter = $_GET['dayletter'];

$sql_events = "SELECT * FROM events WHERE event_id = $event_id";
$lookup_event = mysql_query($sql_events);
$event = mysql_fetch_assoc($lookup_event);
extract($event);

if ($request == "no") {
	$accepted = str_replace($user_id . ",", "", $accepted);
	$declined = $declined . $user_id . ",";
	$query = "UPDATE events 
	SET accepted = '$accepted', declined = '$declined'
	WHERE event_id = $event_id";
	$run = mysql_query($query, $connection) or die( "An error has occured: " .mysql_error (). ":" .mysql_errno ());
	$_SESSION['day1count'] = "docount";
	echo "<a href=\"javascript:void(0)\" onClick=\"availchange$daynumber('maybe', $daynumber, '$dayletter', $user_id, $event_id);\"><img src='images/x.png' alt='No' /></a>";
}

if ($request == "maybe") {
	$declined = str_replace($user_id . ",", "", $declined);
	$undecided = $undecided . $user_id . ",";
	$query = "UPDATE events 
	SET declined = '$declined', undecided = '$undecided'
	WHERE event_id = $event_id";
	$run = mysql_query($query, $connection) or die( "An error has occured: " .mysql_error (). ":" .mysql_errno ());
	$_SESSION['day1count'] = "docount";
	echo "<a href=\"javascript:void(0)\" onClick=\"availchange$daynumber('yes', $daynumber, '$dayletter', $user_id, $event_id);\"><img src='images/maybe.png' alt='Maybe' /></a>";
}

if ($request == "yes") {
	$undecided = str_replace($user_id . ",", "", $undecided);
	$accepted = $accepted . $user_id . ",";
	$query = "UPDATE events 
	SET undecided = '$undecided', accepted = '$accepted'
	WHERE event_id = $event_id";
	$run = mysql_query($query, $connection) or die( "An error has occured: " .mysql_error (). ":" .mysql_errno ());
	$_SESSION['day1count'] = "docount";
	echo "<a href=\"javascript:void(0)\" onClick=\"availchange$daynumber('no', $daynumber, '$dayletter', $user_id, $event_id);\"><img src='images/check.png' alt='Yes' /></a>";
}

?>