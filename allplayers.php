<?php session_start();
require("includes/functions.php");
check_login();
$page_title = "All Players";
$nav_active = "allplayers";
$main_heading = "Manage all players";
$sub_heading = "Logged in as <b>{$_SESSION['username']}</b>";
include("includes/header.php");
?>

	<div id="content">
		<p>Listing of all players here</p>
	</div>

<?php
include("includes/footer.php");
?>