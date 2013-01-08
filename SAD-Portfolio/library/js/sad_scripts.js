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
};

//Convert URLs (w/ or w/o protocol), @mentions, and #hashtags into anchor links
function twitterLinks(text){
    var base_url = 'http://twitter.com/';   //'http://identi.ca/'
    var hashtag_part = 'search?q=#';        //'tag/'
    //convert URLs into links
    text = text.replace(
        /(>|<a[^<>]+href=['"])?(https?:\/\/([-a-z0-9]+\.)+[a-z]{2,5}(\/[-a-z0-9!#()\/?&.,]*[^ !#?().,])?)/gi,
        function($0, $1, $2) {
            return ($1 ? $0 : '<a href="' + $2 + '" target="_blank">' + $2 + '</a>');
        });
    //convert protocol-less URLs into links        
    text = text.replace(
        /(:\/\/|>)?\b(([-a-z0-9]+\.)+[a-z]{2,5}(\/[-a-z0-9!#()\/?&.]*[^ !#?().,])?)/gi,
        function($0, $1, $2) {
            return ($1 ? $0 : '<a href="http://' + $2 + '">' + $2 + '</a>');
        });
    //convert @mentions into follow links
    text = text.replace(
        /(:\/\/|>)?(@([_a-z0-9\-]+))/gi,
        function($0, $1, $2, $3) {
            return ($1 ? $0 : '<a href="' + base_url + $3
                + '" title="Follow ' + $3 + '" target="_blank">@' + $3
                + '</a>');
        });
    //convert #hashtags into tag search links
    text = text.replace(
        /(:\/\/[^ <]*|>)?(\#([_a-z0-9\-]+))/gi,
        function($0, $1, $2, $3) {
            return ($1 ? $0 : '<a href="' + base_url + hashtag_part + $3
                + '" title="Search tag: ' + $3 + '" target="_blank">#' + $3
                + '</a>');
        });
    return text;
}

//Document Ready, LET'S DO THIS.
$(function() {
	//Populate footer tweet
	$.getJSON("https://api.twitter.com/1/statuses/user_timeline.json?screen_name=dunhamscott&count=1&callback=?", function(data) {
		$.each(data, function(key,value){
			cur = value;
			if(cur.in_reply_to_user_id == null && cur.retweeted == false){
				var linkifiedText = twitterLinks(cur.text);
				$("#tweet").html(linkifiedText);
				$("#posted").html("<a href='https://twitter.com/" + cur.user.screen_name + "/status/" + cur.id_str + "' target='_target'>" + TwitterDateConverter(cur.created_at) + "</a>");
				return false; //End the loop!
			}
		});
	});
	
	//Load portfolio item
	$("#project-list div p").click(function() {
		var post_id = $(this).attr("class");
		$.ajax({
			type : "get",
			url : "../?p="+post_id,
			success: function(response) {
				$(".project").fadeOut("slow", function(){
					$(".project").html(response);
					$(".project").fadeIn("slow");
				});
			}
		});
	});
});