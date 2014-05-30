<?php
require_once("includes/connection.php");
?>

<html>
	<head>
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link href="css/thickbox.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="js/jquery.js"></script>          
		<script type="text/javascript" src="js/wb.js"></script>
		<script type="text/javascript" src="js/thickbox.js"></script>
		<title>Get Dunked On | <?php echo $page_title; ?></title>
	</head>
	<body>
		<div id="container">
			<div id="wrapper">
				<div id="header">
					<div id="logo_image">
					</div>
					<h1 id="logo_text"><a href="index.php" style="color: #EDA43B;">Get Dunked On.</a></h1>
					<div class="clear">
					</div>
					<div id="user_nav">
						<?php
						if (isset($_SESSION['username'])) {
							echo
								"<a href='about.php'>
									<div class='auth_nav_item";if ($nav_active == "about") {echo "_active";} echo "'>
										<p class='navlink'>About</p>
									</div>
								</a>
								<a href='index.php'>
									<div class='auth_nav_item";if ($nav_active == "index") {echo "_active";} echo "'>
										<p class='navlink'>Availability</p>
									</div>
								</a>
								<a href='invite.php'>
									<div class='auth_nav_item";if ($nav_active == "invite") {echo "_active";} echo "'>
										<p class='navlink'>Invite</p>
									</div>
								</a>
								<a href='profile.php'>
									<div class='auth_nav_item";if ($nav_active == "profile") {echo "_active";} echo "'>
										<p class='navlink'>Profile</p>
									</div>
								</a>
								<a href='logout.php'>
									<div class='auth_nav_item'>
										<p class='navlink'>Sign Out</p>
									</div>
								</a>";
						}	else {
							echo 
							"<a href='about.php'>
								<div class='nav_item";if ($nav_active == "about") {echo "_active";} echo "'>
									<p class='navlink'>About</p>
								</div>
							</a>
							<a href='register.php'>
								<div class='nav_item";if ($nav_active == "register") {echo "_active";} echo "' style='width: 34%'>
									<p class='navlink'>Register</p>
								</div>
							</a>
							<a href='signin.php'>
								<div class='nav_item";if ($nav_active == "signin") {echo "_active";} echo "'>
									<p class='navlink'>Sign In</p>
								</div>
							</a>";
						}
						?>
					</div>
					<div class="clear">
					</div>
					<?php
					if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == "admin") {
						echo
							"<div id='admin_nav'>
								<a href='allplayers.php'>
									<div class='admin_nav_item";if ($nav_active == "allplayers") {echo "_active";} echo "'>
										<p class='navlink'>All Players</p>
									</div>
								</a>
								<a href='viewschedule.php'>
									<div class='admin_nav_item";if ($nav_active == "viewschedule") {echo "_active";} echo "' style='width: 34%'>
										<p class='navlink'>View Schedule</p>
									</div>
								</a>
								<a href='sendmessage.php'>
									<div class='admin_nav_item";if ($nav_active == "sendmessage") {echo "_active";} echo "'>
										<p class='navlink'>Send Message</p>
									</div>
								</a>
							</div>";
					}
					?>
					<div id="page_heading">
						<h2 id="main_heading"><?php echo $main_heading ?></h2>
						<h2 id="sub_heading"><?php echo $sub_heading ?></h2>
					</div>
					<div class="clear">
					</div>
				</div>