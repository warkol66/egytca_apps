<script language="JavaScript" type="text/javascript">
	$('tweetsList').innerHTML = '';
	initialize();
</script>
<p>Mostrando tweets más recientes de: <a href="https://twitter.com/|-$user->getScreenname()-|" class="twitterUrl " target="_blank">@|-$user->getScreenname()-|</a></p>
<ul class="userTweetsList">
|-foreach from=$userTweets item=tweet-|
<li class="userTweetsListItem">|-$tweet->getEmbed()-|</li>
|-/foreach-|
</ul>
<script language="JavaScript" type="text/javascript">
	twttr.widgets.load();
</script>

