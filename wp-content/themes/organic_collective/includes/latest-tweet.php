<script type="text/javascript">

/**
 * How to use fetch function:
 * @param {string} Your Twitter widget ID.
 * @param {string} The ID of the DOM element you want to write results to. 
 * @param {int} Optional - the maximum number of tweets you want returned. Must
 *     be a number between 1 and 20.
 * @param {boolean} Optional - set true if you want urls and hash
       tags to be hyperlinked!
 * @param {boolean} Optional - Set false if you dont want user photo /
 *     name for tweet to show.
 * @param {boolean} Optional - Set false if you dont want time of tweet
 *     to show.
 * @param {function/string} Optional - A function you can specify to format
 *     tweet date/time however you like. This function takes a JavaScript date
 *     as a parameter and returns a String representation of that date.
 *     Alternatively you may specify the string 'default' to leave it with
 *     Twitter's default renderings.
 * @param {boolean} Optional - Show retweets or not. Set false to not show.
 * @param {function/string} Optional - A function to call when data is ready. It
 *     also passes the data to this function should you wish to manipulate it
 *     yourself before outputting. If you specify this parameter you  must
 *     output data yourself!
 */

twitterFetcher.fetch('<?php echo get_post_meta(get_the_ID(), 'team_twitter_id', true); ?>', '', 1, true, false, true, '', false, handleTweets);

function handleTweets(tweets){
	var x = tweets.length;
	var n = 0;
	var element = document.getElementById('tweets');
	var html = '<span class="twitter-arrow"></span><div class="twitter-feed"><i class="fa fa-twitter"></i>';
	while(n < x) {
		html += '' + tweets[n] + '';
		n++;
	}
	html += '</div>';
	element.innerHTML = html;
}
      
</script>