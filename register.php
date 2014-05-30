<?php
require("includes/functions.php");
$page_title = "Register";
$nav_active = "register";
$main_heading = "Register an account";
$sub_heading = "Registration is currently invite-only";
include("includes/header.php");
if (isset($_GET['invitation'])) {
	$invite_url = $_GET['invitation'];
}

?>
				
	<div id="content">
		<div class="errors">
			<ul>
				<?php 
				$subscribe = 0;
					while (isset($_POST['submit'])) {
						extract($_POST);
						if (!validateLength($first_name, 2)) {
							echo "<li class='register_message'>First name must be at least 2 characters long</li>";
							break;
						}
						if (!validateCharacters($first_name)) {
							echo "<li class='register_message'>First name cannot contain special characters</li>";
							break;
						}
						if (!validateLength($last_name, 2)) {
							echo "<li class='register_message'>Last name must be at least 2 characters long</li>";
							break;
						}
						if (!validateCharacters($last_name)) {
							echo "<li class='register_message'>Last name cannot contain special characters</li>";
							break;
						}
						if (!validateLength($email, 1)) {
							echo "<li class='register_message'>Please enter an e-mail address</li>";
							break;
						}
						if (!validateEmail($email)) {
							echo "<li class='register_message'>Please enter a valid e-mail address</li>";
							break;
						}
						if (!validateEmailExists($email)) {
							echo "<li class='register_message'>E-Mail address already exists!</li>";
							break;
						}
						if (!validateLength($username, 6)) {
							echo "<li class='register_message'>Username must be at least 6 characters long</li>";
							break;
						}
						if (!validateCharacters($username)) {
							echo "<li class='register_message'>Username cannot contain special characters</li>";
							break;
						}
						if (!validateUsernameExists($username)) {
							echo "<li class='register_message'>Username already exists!</li>";
							break;
						}
						if (!validateLength($pass1, 6)) {
							echo "<li class='register_message'>Password must be at least 6 characters long</li>";
							break;
						}
						if (!validateCharacters($pass1)) {
							echo "<li class='register_message'>Password cannot contain special characters</li>";
							break;
						}
						if (!validatePasswordsMatch($pass1, $pass2)) {
							echo "<li class='register_message'>Password and password confirmation must match</li>";
							break;
						}
						if (!validateInvitation($invite_code)) {
							echo "<li class='register_message'>Invalid invitation code</li>";
							break;
						}
						$password = md5($pass1);
						$sql = "INSERT INTO users (user_type, email_address, subscription, first_name, last_name, username, password)
						VALUES ('user', '$email', '$subscribe', '$first_name', '$last_name', '$username', '$password')";
						$insert = mysql_query($sql) or die( "An error has occurred: " .mysql_error (). ":" .mysql_errno ());
						echo '<meta http-equiv="refresh" content="0; url=signin.php?message=1">';
						exit;
					} ?>
			</ul>
		</div>
		<div class="form_container">
			<form method="POST" action="<?php htmlentities($_SERVER['PHP_SELF']); ?>">
				<div class="left_column">
					<p class="form_label">First Name</p>
					<input type="text" class="form_field" name="first_name" value="<?php if (isset($_POST['submit'])) {echo $first_name;} ?>" maxlength="30" tabindex="10" />
					<p class="form_label">E-Mail Address</p>
					<input type="email" class="form_field" name="email" value="<?php if (isset($_POST['submit'])) {echo $email;} ?>" maxlength="40" tabindex="30" />
					<p class="form_label">Create your Password</p>
					<input type="password" class="form_field" name="pass1"  maxlength="30" tabindex="50" value="<?php if (isset($_POST['submit'])) {echo $pass1;} ?>" />
					<p class="form_label">Invitation Code</p>
					<input type="text" class="form_field" name="invite_code" maxlength="10" tabindex="70" value="<?php if (isset($invite_url)) {echo $invite_url;} elseif (isset($_POST['submit'])) {echo $invite_code;} ?>"/>
				</div>
				<div class="right_column">
					<p class="form_label">Last Name</p>
					<input type="text" class="form_field" name="last_name" value="<?php if (isset($_POST['submit'])) {echo $last_name;} ?>" maxlength="30" tabindex="20" />
					<p class="form_label">Create your Username</p>
					<input type="text" class="form_field" name="username" value="<?php if (isset($_POST['submit'])) {echo $username;} ?>" maxlength="30" tabindex="40" />
					<p class="form_label">Confirm your Password</p>
					<input type="password" class="form_field" name="pass2" maxlength="30" tabindex="60" value="<?php if (isset($_POST['submit'])) {echo $pass2;} ?>" />
					<p class="form_label">Send me E-mail Reminders</p>
					<div id="email_subscribe">
						<div id="checkbox_container">
							<div id="reg_check">
								<input type="checkbox" name="subscribe" class="checkbox" id="subscribe" value="1" checked />
								<label for="subscribe">Checkbox Label</label>
							</div>
						</div>
					</div>
				</div>
				<div class="clear">
				</div>
				<div id="submit_button" style="top: 10px;">
					<input type="submit" class="submit" name="submit" value="Register" />
				</div>
			</form>
		</div>
	</div>
	
<?php
require("includes/footer.php");
?>