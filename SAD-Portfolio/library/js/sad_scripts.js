//Converts twitter "created_at" date to an easily-read string
function parseTwitterDate(tdate) {
    var system_date = new Date(Date.parse(tdate));
    var user_date = new Date();
    if (K.ie) {
        system_date = Date.parse(tdate.replace(/( \+)/, ' UTC$1'))
    }
    var diff = Math.floor((user_date - system_date) / 1000);
    if (diff <= 1) {return "just now";}
    if (diff < 20) {return diff + " seconds ago";}
    if (diff < 40) {return "half a minute ago";}
    if (diff < 60) {return "less than a minute ago";}
    if (diff <= 90) {return "one minute ago";}
    if (diff <= 3540) {return Math.round(diff / 60) + " minutes ago";}
    if (diff <= 5400) {return "1 hour ago";}
    if (diff <= 86400) {return Math.round(diff / 3600) + " hours ago";}
    if (diff <= 129600) {return "1 day ago";}
    if (diff < 604800) {return Math.round(diff / 86400) + " days ago";}
    if (diff <= 777600) {return "1 week ago";}
    return "on " + system_date;
}

// from http://widgets.twimg.com/j/1/widget.js
var K = function () {
    var a = navigator.userAgent;
    return {
        ie: a.match(/MSIE\s([^;]*)/)
    }
}();

//Convert URLs (w/ or w/o protocol), @mentions, and #hashtags into anchor links
//http://roadha.us/2011/03/create-anchor-links-in-twitter-status-text-with-javascript/
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
	$.getJSON("https://api.twitter.com/1/statuses/user_timeline.json?screen_name=dunhamscott&count=1&exclude_replies=true&include_rts=false&callback=?", function(data) {
		$.each(data, function(key,value){
			cur = value;
			if(cur.in_reply_to_user_id == null && cur.retweeted == false){
				var linkifiedText = twitterLinks(cur.text);
				$("#tweet").html(linkifiedText);
				$("#posted").html("<a href='https://twitter.com/" + cur.user.screen_name + "/status/" + cur.id_str + "' target='_target'>" + parseTwitterDate(cur.created_at) + "</a>");
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