<script language="JavaScript" type="text/javascript">
	//$('viewWorking').innerHTML = '';
	initialize();
</script>
<p>Mostrando tweets más recientes de: @|-$user->getScreenname()-|</p>
<ul class="userTweetsList">
|-foreach from=$userTweets item=tweet-|
<li class="userTweetsListItem">|-$tweet->getEmbed()-|</li>

|-/foreach-|
</ul>
<script language="JavaScript" type="text/javascript">twttr.widgets.load()</script>
