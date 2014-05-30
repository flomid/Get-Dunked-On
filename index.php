<?php session_start();
require("includes/functions.php");
check_login();
$page_title = "Availability";
$nav_active = "index";
$main_heading = "Player availability";
$sub_heading = "Logged in as <b>{$_SESSION['username']}</b>";
include("includes/header.php");

// Look up players in the database
$sql_player = "SELECT user_id, first_name, last_name, username, photo_url_40 FROM users ORDER BY first_name ASC";
$lookup_player = mysql_query($sql_player);

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
	explode(",", $i . "_" . "declined");
	explode(",", $i . "_" . "undecided");
	$i++;
}

$day1_accepted = array_filter(explode(",", $a_accepted));
$day1_declined = array_filter(explode(",", $a_declined));
$day1_undecided = array_filter(explode(",", $a_undecided));

$day2_accepted = array_filter(explode(",", $b_accepted));
$day2_declined = array_filter(explode(",", $b_declined));
$day2_undecided = array_filter(explode(",", $b_undecided));

$day3_accepted = array_filter(explode(",", $c_accepted));
$day3_declined = array_filter(explode(",", $c_declined));
$day3_undecided = array_filter(explode(",", $c_undecided));

$day4_accepted = array_filter(explode(",", $d_accepted));
$day4_declined = array_filter(explode(",", $d_declined));
$day4_undecided = array_filter(explode(",", $d_undecided));

$weekends = get_weekend();

?>

	<div id="content">
		<div id="calendar_heading">
			<div class="player_icon" style="opacity: 0;">
				<img src="images/player_icon40.png" />
			</div>
			<div class="player_name" style="opacity: 0;">
				<p class="username">USERNAME</p>
				<p class="full_name">FULL NAME</p>
			</div>
			<div class="calendar">
				<p class="day_of_week"><?php echo strtoupper(substr(date('l', $weekends['day1']), 0, 3)); ?></p>
				<p class="month"><?php echo strtoupper(substr(date('F', $weekends['day1']), 0, 3)); ?></p>
				<p class="day"><?php echo date('d', $weekends['day1']); ?></p>
			</div>
			<div class="calendar">
				<p class="day_of_week"><?php echo strtoupper(substr(date('l', $weekends['day2']), 0, 3)); ?></p>
				<p class="month"><?php echo strtoupper(substr(date('F', $weekends['day2']), 0, 3)); ?></p>
				<p class="day"><?php echo date('d', $weekends['day2']); ?></p>
			</div>
			<div class="calendar">
				<p class="day_of_week"><?php echo strtoupper(substr(date('l', $weekends['day3']), 0, 3)); ?></p>
				<p class="month"><?php echo strtoupper(substr(date('F', $weekends['day3']), 0, 3)); ?></p>
				<p class="day"><?php echo date('d', $weekends['day3']); ?></p>
			</div>
			<div class="calendar">
				<p class="day_of_week"><?php echo strtoupper(substr(date('l', $weekends['day4']), 0, 3)); ?></p>
				<p class="month"><?php echo strtoupper(substr(date('F', $weekends['day4']), 0, 3)); ?></p>
				<p class="day"><?php echo date('d', $weekends['day4']); ?></p>
			</div>
		</div>
		<div class="clear">
		</div>
		<?php
		// While a row of data exists, put that row in $player as an associative array
			while ($player = mysql_fetch_assoc($lookup_player)) {
		// Create a php variable with the same name as each label in the associative array 
				extract($player);
		?>
		<div class="player_availability<?php if (strcasecmp($username, $_SESSION['username']) == 0) {echo '_active';} ?>">
			<div class="player_icon">
				<img src="<?php get_photo('40'); ?>" />
			</div>
			<div class="player_name">
				<p class="username"><a href="profile.php?id=<?php echo $user_id; ?>"><?php echo $username; ?></a></p>
				<p class="full_name"><?php echo $first_name . " " . $last_name; ?></p>
			</div>
			<div class="mark">
				<p <?php if (strcasecmp($username, $_SESSION['username']) == 0) {echo "id='avail_text1'";} else {echo "class='mark_text'";} ?>><?php get_availability(1, "a"); ?></p>
			</div>
			<div class="mark">
				<p <?php if (strcasecmp($username, $_SESSION['username']) == 0) {echo "id='avail_text2'";} else {echo "class='mark_text'";} ?>><?php get_availability(2, "b"); ?></p>
			</div>
			<div class="mark">
				<p <?php if (strcasecmp($username, $_SESSION['username']) == 0) {echo "id='avail_text3'";} else {echo "class='mark_text'";} ?>><?php get_availability(3, "c"); ?></p>
			</div>
			<div class="mark">
				<p <?php if (strcasecmp($username, $_SESSION['username']) == 0) {echo "id='avail_text4'";} else {echo "class='mark_text'";} ?>><?php get_availability(4, "d"); ?></p>
			</div>
		</div>
		<div class="clear">
		</div>
		<?php
		// Curly brace is to close the while statements
		}
			mysql_free_result($lookup_player); 
			mysql_free_result($lookup_event);
		?>
		<div id="totals">
			<div class="player_icon" style="opacity: 0;">
				<img src="images/player_icon40.png" />
			</div>
			<div class="player_name">
				<p id="total">Total:</p>
			</div>
			<div class="mark">
				<p class="count_text" id="day1count"><?php echo countit(1); ?></p>
			</div>
			<div class="mark">
				<p class="count_text" id="day2count"><?php echo countit(2); ?></p>
			</div>
			<div class="mark">
				<p class="count_text" id="day3count"><?php echo countit(3); ?></p>
			</div>
			<div class="mark">
				<p class="count_text" id="day4count"><?php echo countit(4); ?></p>
			</div>
		</div>
		<div class="clear">
		</div>
	</div>

<?php
include("includes/footer.php");
?>