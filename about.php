<?php session_start();
require("includes/functions.php");
// check_login();
$page_title = "About";
$nav_active = "about";
$main_heading = "About Get Dunked On";
if ($_SESSION['username']) {
	$sub_heading = "Logged in as <b>{$_SESSION['username']}</b>";
}
include("includes/header.php");
?>

	<div id="content">
		<div class="about_map">
			<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=12045+East+Waterfront+Drive,+Los+Angeles,+CA&amp;aq=0&amp;oq=12045+e+waterfront+dr&amp;sll=33.981891,-118.405216&amp;sspn=0.004733,0.009624&amp;ie=UTF8&amp;hq=&amp;hnear=12045+E+Waterfront+Dr,+Los+Angeles,+California+90094&amp;t=m&amp;ll=33.99084,-118.407125&amp;spn=0.024908,0.036478&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=12045+East+Waterfront+Drive,+Los+Angeles,+CA&amp;aq=0&amp;oq=12045+e+waterfront+dr&amp;sll=33.981891,-118.405216&amp;sspn=0.004733,0.009624&amp;ie=UTF8&amp;hq=&amp;hnear=12045+E+Waterfront+Dr,+Los+Angeles,+California+90094&amp;t=m&amp;ll=33.99084,-118.407125&amp;spn=0.024908,0.036478&amp;z=14&amp;iwloc=A" style="color:#0000FF;text-align:left">View Larger Map</a></small>
		</div>
		<div class="about_question">
			<h3>What is this all about?</h3>
			<p>Get Dunked On was made to help determine who and how many will be coming out to play basketball on the Weekends.  Feel free to invite others to join with the Invite link at the top.</p>
		</div>
		<div class="about_question">
			<h3>Where do we play?</h3>
			<p>Playa Vista basketball courts next to the soccer field.  The map on the right shows the address of the basketball court.</p>
		</div>
		<div class="about_question">
			<h3>What time?</h3>
			<p>Typically on Saturdays there will be 10 ready to start a game at 9:00am.  Sundays start a bit later and are typically ready to start at around 10:00am.</p>
		</div>
		<div class="about_question">
			<h3>How do I use Get Dunked On?</h3>
			<p>If you've made it this far, then you already have an account and are signed in.  All you need to do is click on the Availability page and check off when you will be able to make it.  Clicking the box once will leave a check mark that denotes you can make it.  Clicking again will leave an X noting that you won't make it.  And clicking a third time will leave a question mark which means you aren't sure if you'll be able to make it.  Easy, right?</p>
		</div>
	</div>

<?php
include("includes/footer.php");
?>