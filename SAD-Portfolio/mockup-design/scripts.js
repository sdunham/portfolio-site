//Converts twitter "created_at" date to an easily-read string
//http://www.phpmind.com/blog/2011/02/how-to-change-date-formate-of-twitter-field-created_at%E2%80%99/
function TwitterDateConverter(time){
	var date = new Date(time),
	diff = (((new Date()).getTime() - date.getTime()) / 1000),
	day_diff = Math.floor(diff / 86400);
 
	if ( isNaN(day_diff) || day_diff < 0 || day_diff >= 31 )
		return;
 
	return day_diff == 0 && (
		diff < 60 && "just now" ||
		diff < 120 && "1 minute ago" ||
		diff < 3600 && Math.floor( diff / 60 ) + " minutes ago" ||
		diff < 7200 && "1 hour ago" ||
		diff < 86400 && Math.floor( diff / 3600 ) + " hours ago") ||
		day_diff == 1 && "Yesterday" ||
		day_diff < 7 && day_diff + " days ago" ||
		day_diff < 31 && Math.ceil( day_diff / 7 ) + " weeks ago";
}

//Populate footer tweet
$.getJSON("http://twitter.com/statuses/user_timeline/dunhamscott.json?callback=?", function(data) {
	$.each(data, function(key,value){
		cur = value;
		if(cur.in_reply_to_user_id == null && cur.retweeted == false){
			$("#tweet").html(cur.text);
			$("#posted").html(TwitterDateConverter(cur.created_at));
			return false; //End the loop!
		}
	});

	//$("#tweet").html(data[0].text);
	//$("#posted").html(TwitterDateConverter(data[0].created_at));
});

//Document Ready
$(function() {
	//Portfolio behavior
	$("#project-list div p").click(function() {
		var thisClass = $(this).attr("class");
		$(".project").filter(":visible").fadeOut("slow", function(){
			$(".project#" + thisClass).fadeIn("slow");
		});
	});
});


//Old Animation
/*$(function() {
	//Portfolio behavior
	$("#project-list div p").click(function() {
		var thisClass = $(this).attr("class");
		$(".project").filter(":visible").slideUp("slow", function(){
			$(".project#" + thisClass).slideDown("slow");
		});
	});
});*/