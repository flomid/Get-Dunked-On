<?php session_start();
require("includes/functions.php");
check_login();
$page_title = "Profile";
$nav_active = "profile";
$main_heading = "My player profile";
$sub_heading = "Logged in as <b>{$_SESSION['username']}</b>";
$user_id = $_SESSION['user_id'];
if (isset($_GET['id'])) {
	$user_id = $_GET['id'];
	$main_heading = "Player profile";
}
if ($user_id == $_SESSION['user_id']) {
	$user_id = $_SESSION['user_id'];
	$main_heading = "My player profile";
}
include("includes/header.php");

$sql_player = "SELECT user_id, email_address, first_name, last_name, username, photo_url_196 FROM users WHERE user_id = '$user_id'";
$lookup_player = mysql_query($sql_player);
$my_profile = mysql_fetch_assoc($lookup_player);
extract($my_profile);
?>

	<div id="content">
		<div id="profile_box">
			<div id="photo_box">
				<?php if ($user_id == $_SESSION['user_id']) { ?>
				<a href="image_upload.php?keepThis=true&TB_iframe=true&height=450&width=800" class="thickbox">
				<div id="change_photo">
					<p style="height: 50px; margin: 0;">Change Photo</p>
				</div>
				<?php } ?>
				<img src="<?php get_photo('196'); ?>" <?php if ($user_id == $_SESSION['user_id']) {echo "style='top: -50px;'"; } ?> />
				<?php if ($user_id == $_SESSION['user_id']) { ?>
				</a>
				
				<?php } ?>
			</div>
			<div id="profile_column1">
				<p><?php echo $username ?></p>
				<p><?php echo $first_name . " " . $last_name; ?></p>
				<p><?php echo $email_address; ?></p>
			</div>
			<div id="profile_column2">
				<p>Days Played: <strong><?php echo get_days_played($user_id); ?></strong></p>
				<p>Days Missed: <strong><?php echo get_total_days($user_id) - get_days_played($user_id); ?></strong></p>
			</div>
		</div>
	</div>

<?php
include("includes/footer.php");
?>