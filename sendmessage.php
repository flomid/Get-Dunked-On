<?php session_start();
require("includes/functions.php");
check_login();
$page_title = "Send Message";
$nav_active = "sendmessage";
$main_heading = "Send an e-mail to all players";
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
				<?php if ($message == 1) {echo "<li class='invite_message' style='color: green; background: rgba(0, 255, 0, 0.3);'>Message Successfully Sent!</li>";} ?>
			</ul>
		</div>
		<div class="form_container">
			<form method="POST" action="send_message.php">
				<div id="signin_form" style="width: 600px">
					<p class="form_label">Message</p>
					<textarea type="text" name="message" class="form_field" tabindex="20"></textarea>
				</div>
				<div id="send_to_all">
					<p class="form_label">Send only to subscribed?</p>
					<div id="email_subscribe" style="width: 95px; display: block; margin: auto;">
						<div id="checkbox_container">
							<div id="reg_check">
								<input type="checkbox" name="onlysubscribed" class="checkbox" id="subscribe" value="1" checked />
								<label for="subscribe">Checkbox Label</label>
							</div>
						</div>
					</div>
				</div>
				<div class="clear">
				</div>
				<div id="submit_button" style="top: 10px;">
					<input type="submit" class="submit" value="Send" />
				</div>
			</form>
		</div>
	</div>

<?php
include("includes/footer.php");
?>