<?php
require_once("connection.php");

function check_login() {
	if (!isset($_SESSION['username'])) {
		session_destroy();
		header('location:signin.php');
	}
}

// No Longer Using This Function!!!
function get_weekend_old() {
	$today = date('l', strtotime('today'));

	$day1 = date('U', strtotime('next saturday'));
	$day2 = date('U', strtotime('next sunday'));
	$day3 = date('U', strtotime('next saturday + 7 days'));
	$day4 = date('U', strtotime('next sunday + 7 days'));
	
	if ($today == "Saturday") {
		$day1 = date('U', strtotime('today'));
		$day3 = date('U', strtotime('next saturday'));
	}
	
	if ($today == "Sunday") {
		$day1 = date('U', strtotime('today - 1 day'));
		$day2 = date('U', strtotime('today'));
		$day3 = date('U', strtotime('next saturday'));
		$day4 = date('U', strtotime('next sunday'));
	}
	
	return array('day1'=>$day1, 'day2'=>$day2, 'day3'=>$day3, 'day4'=>$day4);
}

function get_weekend() {
	
	if (date('l', strtotime('today')) == "Sunday") {
	$sql = "SELECT date FROM events WHERE date >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) ORDER BY date ASC LIMIT 4";
	} else {
		$sql = "SELECT date FROM events WHERE date >= CURDATE() ORDER BY date ASC LIMIT 4";
	}
	$query = mysql_query($sql);
	$dates = array();
	while ($row = mysql_fetch_array($query)) {
		$dates[] = $row[0];
	}
	
	$dates[0] = strtotime($dates[0]);
	$dates[1] = strtotime($dates[1]);
	$dates[2] = strtotime($dates[2]);
	$dates[3] = strtotime($dates[3]);
	
	return array('day1'=>$dates[0], 'day2'=>$dates[1], 'day3'=>$dates[2], 'day4'=>$dates[3]);
}

function get_availability($daynumber, $dayletter) {
	
	global $user_id;
	global $username;
	global $a_event_id;
	global $b_event_id;
	global $c_event_id;
	global $d_event_id;
	global ${"day".$daynumber."_accepted"};
	global ${"day".$daynumber."_declined"};
	global ${"day".$daynumber."_undecided"};
	
	if (strcasecmp($username, $_SESSION['username']) == 0) {
		
		if (in_array($user_id, ${"day".$daynumber."_accepted"})) {
			echo "<a href=\"javascript:void(0)\" onClick=\"availchange$daynumber('no', $daynumber, '$dayletter', $user_id, ${$dayletter.'_event_id'});\"><img src='images/check.png' alt='Yes' /></a>";
		}
		elseif (in_array($user_id, ${"day".$daynumber."_declined"})) {
			echo "<a href=\"javascript:void(0)\" onClick=\"availchange$daynumber('maybe', $daynumber, '$dayletter', $user_id, ${$dayletter.'_event_id'});\"><img src='images/x.png' alt='No' /></a>";
		}
		elseif (in_array($user_id, ${"day".$daynumber."_undecided"})) {
			echo "<a href=\"javascript:void(0)\" onClick=\"availchange$daynumber('yes', $daynumber, '$dayletter', $user_id, ${$dayletter.'_event_id'});\"><img src='images/maybe.png' alt='Maybe' /></a>";
		} else {echo "<a href=\"javascript:void(0)\" onClick=\"availchange$daynumber('yes', $daynumber, '$dayletter', $user_id, ${$dayletter.'_event_id'});\"><img src='images/empty.png' alt='Empty' style='opacity: 0.4;' /></a>";}
	}
	
	else {
	
		if (in_array($user_id, ${"day".$daynumber."_accepted"})) {
		echo "<img src='images/check.png' alt='Yes' />";
		}
		elseif (in_array($user_id, ${"day".$daynumber."_declined"})) {
			echo "<img src='images/x.png' alt='No' />";
		}
		elseif (in_array($user_id, ${"day".$daynumber."_undecided"})) {
			echo "<img src='images/maybe.png' alt='Maybe' />";
		} else {echo "<img src='images/empty.png' alt='Empty' style='opacity: 0.4;' />";}
	}
	
}

function get_photo($size) {
	
	global $photo_url_40;
	global $photo_url_196;
	
	if ($size == 40) {
		if ($photo_url_40 == NULL || $photo_url_40 == "") {
			echo "images/player_icon" . $size . ".png";
			} 
		
			else {
				echo $photo_url_40;
			}
	} else {
		if ($photo_url_196 == NULL || $photo_url_196 == "") {
			echo "images/player_icon" . $size . ".png";
			} 
		
			else {
				echo $photo_url_196;
			}
	}
}

function gen_invite() {
    $length = 10;
    $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$p = 0;
	$string = "";
    while ($p < $length) {
		$random = mt_rand(0, strlen($characters) -1);
        $string .= $characters[$random];
		$p++;
    }
    return $string;
}

function validateLength($value, $length) {  
	if (strlen($value) < $length) {
		return false;
	} else {  
		return true;
  	}
}  

function validateEmail($email) {
	$regexp = '/^([a-zA-Z0-9.])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-]+)+/';
	if (preg_match($regexp, $email) == 'false') {
		return false;
	} else {
		return true;
	}
}

function validateCharacters($input) {
	$regexp = "/^[a-zA-Z0-9]+$/"; // Alphanumeric regular expression
	if (preg_match($regexp, $input) == 'false') {
		return false;
	} else {
		return true;
	}
}

function validateEmailExists($email) {
	$sql = "SELECT email_address FROM users WHERE email_address='$email'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if ($count > 0) {
		return false;
	} else {
		return true;
	}
}

function validateUsernameExists($username) {
	$sql = "SELECT username FROM users WHERE username='$username'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if ($count > 0) {
		return false;
	} else {
		return true;
	}
}

function validatePasswordsMatch($pass1, $pass2) {  
	if($pass1 !== $pass2) {
		return false;  
	} else {
		return true;  
	}
}

function validateInvitation($invite_code) {
	$sql = "SELECT invite_code FROM invitations WHERE invite_code='$invite_code'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if ($count < 1) {
		return false;
	} else {
		return true;
	}
}

function countit($day) {
	if (date('l', strtotime('today')) == "Sunday") {
	$sql_events = "SELECT * FROM events WHERE date >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) ORDER BY date ASC LIMIT 4";
	} else {
		$sql_events = "SELECT * FROM events WHERE date >= CURDATE() ORDER BY date ASC LIMIT 4";
	}
	$lookup_event = mysql_query($sql_events);
	$i = "a";

	 while ($event = mysql_fetch_assoc($lookup_event)) {
		extract($event, EXTR_PREFIX_ALL, $i);
		explode(",", $i . "_" . "accepted");
		$i++;
	}

	$day1_accepted = array_filter(explode(",", $a_accepted));
	$day2_accepted = array_filter(explode(",", $b_accepted));
	$day3_accepted = array_filter(explode(",", $c_accepted));
	$day4_accepted = array_filter(explode(",", $d_accepted));
	
	if ($day == 1) {
		$count = count($day1_accepted);
		return $count;
	}
	
	if ($day == 2) {
		$count = count($day2_accepted);
		return $count;
	}
	
	if ($day == 3) {
		$count = count($day3_accepted);
		return $count;
	}
	
	if ($day == 4) {
		$count = count($day4_accepted);
		return $count;
	}

}

function get_days_played($user_id) {
	$sql = "SELECT * FROM events WHERE accepted LIKE '%,$user_id,%' AND date < CURDATE()";
	if ($lookup_days_played = mysql_query($sql)) {
		$lookup_days_played = mysql_query($sql);
		$days_played = mysql_num_rows($lookup_days_played);
		return $days_played;
	} else {
		return 0;
	}
}

function get_days_declined($user_id) {
	$sql = "SELECT * FROM events WHERE declined LIKE '%,$user_id,%' AND date < CURDATE()";
	if ($lookup_days_declined = mysql_query($sql)) {
		$lookup_days_declined = mysql_query($sql);
		$days_declined = mysql_num_rows($lookup_days_declined);
		return $days_declined;
	} else {
		return 0;
	}
}

function get_days_undecided($user_id) {
	$sql = "SELECT * FROM events WHERE undecided LIKE '%,$user_id,%' AND date < CURDATE()";
	if ($lookup_days_undecided = mysql_query($sql)) {
		$lookup_days_undecided = mysql_query($sql);
		$days_undecided = mysql_num_rows($lookup_days_undecided);
		return $days_undecided;
	} else {
		return 0;
	}
}

function get_total_days($user_id) {
	$sql = "SELECT * FROM events WHERE date < CURDATE()";
	$lookup_total_days = mysql_query($sql);
	$lookup_total_days = mysql_query($sql);
	$total_days = mysql_num_rows($lookup_total_days);
	return $total_days;
}

?>