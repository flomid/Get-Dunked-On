<?php session_start();
require("includes/functions.php");
check_login();
$page_title = "View Schedule";
$nav_active = "viewschedule";
$main_heading = "Manage basketball schedule";
$sub_heading = "Logged in as <b>{$_SESSION['username']}</b>";
include("includes/header.php");
?>

	<div id="content">
		<p>Schedule goes here</p>
	</div>

<?php
include("includes/footer.php");
?>