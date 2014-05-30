function availchange1(request, daynumber, dayletter, user_id, event_id) {
	$('#avail_text1').empty().html('<img src="images/ajax-loader.gif" style="margin-top: 20px" />');
	$('#avail_text1').load('includes/update_avail.php?request=' + request + '&daynumber=' + daynumber + '&dayletter=' + dayletter + '&user_id=' + user_id + '&event_id=' + event_id, 
		function() {
			$('#day1count').hide();
			$('#day1count').load('includes/counter.php?daynumber=' + daynumber).show();
		}).fadeIn(200);
}
function availchange2(request, daynumber, dayletter, user_id, event_id) {
	$('#avail_text2').empty().html('<img src="images/ajax-loader.gif" style="margin-top: 20px" />');
	$('#avail_text2').load('includes/update_avail.php?request=' + request + '&daynumber=' + daynumber + '&dayletter=' + dayletter + '&user_id=' + user_id + '&event_id=' + event_id, 
		function() {
			$('#day2count').hide();
			$('#day2count').load('includes/counter.php?daynumber=' + daynumber).show();
		}).fadeIn(200);
}
function availchange3(request, daynumber, dayletter, user_id, event_id) {
	$('#avail_text3').empty().html('<img src="images/ajax-loader.gif" style="margin-top: 20px" />');
	$('#avail_text3').load('includes/update_avail.php?request=' + request + '&daynumber=' + daynumber + '&dayletter=' + dayletter + '&user_id=' + user_id + '&event_id=' + event_id, 
		function() {
			$('#day3count').hide();
			$('#day3count').load('includes/counter.php?daynumber=' + daynumber).show();
		}).fadeIn(200);
}
function availchange4(request, daynumber, dayletter, user_id, event_id) {
	$('#avail_text4').empty().html('<img src="images/ajax-loader.gif" style="margin-top: 20px" />');
	$('#avail_text4').load('includes/update_avail.php?request=' + request + '&daynumber=' + daynumber + '&dayletter=' + dayletter + '&user_id=' + user_id + '&event_id=' + event_id, 
		function() {
			$('#day4count').hide();
			$('#day4count').load('includes/counter.php?daynumber=' + daynumber).show();
		}).fadeIn(200);
}

$(document).ready(function(){
$(window).load( function () {
$(".invite_message").delay(5000).fadeOut(350);
})
.end();
});