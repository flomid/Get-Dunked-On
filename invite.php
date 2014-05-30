<?php session_start();
require("includes/functions.php");
check_login();
$page_title = "Invite";
$nav_active = "invite";
$main_heading = "Invite a player";
$sub_heading = "Logged in as <b>{$_SESSION['username']}</b>";
include("includes/header.php");
if (isset($_GET['message'])) {
	$message = $_GET['message'];
} else {
	$message = -1;
}
?>

	<div id="content">
		<div class="errors">
			<ul>
				<?php if ($message == 0) {echo "<li class='invite_message' style='color: red; background: rgba(255, 0, 0, 0.3);'>E-mail Address Already Exists!</li>";} ?>
				<?php if ($message == 1) {echo "<li class='invite_message' style='color: green; background: rgba(0, 255, 0, 0.3);'>Invitation Successfully Sent!</li>";} ?>
			</ul>
		</div>
		<div class="form_container">
			<form method="POST" action="send_invite.php">
				<div id="signin_form">
					<p class="form_label">E-mail Address</p>
					<input type="email" name="email" class="form_field" maxlength="30" tabindex="20" />
				</div>
				<div class="clear">
				</div>
				<div id="submit_button" style="top: 10px;">
					<input type="submit" class="submit" value="Send Invite" />
				</div>
			</form>
		</div>
	</div>

<?php
include("includes/footer.php");
?>