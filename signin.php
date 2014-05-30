<?php
if (isset($_GET['message'])) {
	$message = $_GET['message'];
} else {
	$message = -1;
}
$page_title = "Sign In";
$nav_active = "signin";
$main_heading = "Sign in to your account";
$sub_heading = " ";
include("includes/header.php");
?>

	<div id="content">
		<div class="errors">
			<ul>	
			<?php if ($message == 0) {echo "<li class='invite_message' style='color: red; background: rgba(255, 0, 0, 0.3);'>Incorrect username or password</li>";} ?>
			<?php if ($message == 1) {echo "<li class='invite_message' style='color: green; background: rgba(0, 255, 0, 0.3);'>Success! Sign In Below</li>";} ?>
			</ul>
		</div>
		<div class="form_container">
			<form method="POST" action="login.php">
				<div id="signin_form">
					<p class="form_label">Username</p>
					<input type="text" name="username" class="form_field" maxlength="30" tabindex="20" />
					<p class="form_label">Password</p>
					<input type="password" name="password" class="form_field" maxlength="30" tabindex="40" />
					<div id="stay_signedin">
						<p class="form_label">Stay signed in</p>
						<div id="checkbox_container">
							<div id="reg_check">
								<input type="checkbox" name="stay_in" class="checkbox" id="stay_in" value="1" checked />
								<label for="stay_in">Checkbox Label</label>
							</div>
						</div>
					</div>
				</div>
				<div class="clear">
				</div>
				<div id="submit_button" style="top: 0px;">
					<input type="submit" class="submit" value="Sign In" />
				</div>
			</form>
		</div>
	</div>

<?php
require("includes/footer.php");
?>