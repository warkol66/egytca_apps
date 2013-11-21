<script language="JavaScript" type="text/javascript">
	//$('tweetsList').innerHTML = '';
	initialize();
</script>
<p>Mostrando tweets más recientes de: <a href="https://twitter.com/|-$user->getScreenname()-|" class="twitterUrl " target="_blank">@|-$user->getScreenname()-|</a></p>
<ul class="userTweetsList">
|-foreach from=$userTweets item=tweet-|
|-assign var=embed value=$tweet->getEmbed()-|
	|-if empty($embed)-|
	<li class="userTweetsListItem">
		<div class="twitterText">|-if is_object($user)-|<strong>|-$user->getName()-|</strong> &nbsp; <span class="twitterUser">@|-$user->getScreenname()-|</span>|-/if-|<small class="twitterTime">|-timeAgo mysqlTime=$tweet->getCreatedat()-|</small></br>|-$tweet->getText()|twitterHighlight-|</div>
	</li>
	|-else-|
	<li class="userTweetsListItem">|-$tweet->getEmbed()-|</li>
	<script language="JavaScript" type="text/javascript">twttr.widgets.load()</script>
	|-/if-|
|-/foreach-|
</ul>
<script language="JavaScript" type="text/javascript">
	twttr.widgets.load();
</script>

