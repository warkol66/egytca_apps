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
		<div class="embeddedTweet">
			<div class="embeddedWhole">
				<div class="embeddedHeader">
					<div class="embeddedAuthor">
					<a class="embeddedProfile" aria-label="|-$user->getName()-| (screen name: |-$user->getScreenname()-|)" href="https://twitter.com/|-$user->getScreenname()-|"><span class="full-name">|-$user->getName()-|</span><br /><span class="nickname">@|-$user->getScreenname()-|</span></a>
					</div>
				</div>
				<div class="embeddedContent"><p>|-$tweet->getText()|twitterHighlight-|</p></div>
				<div class="dateline"><time>|-$tweet->getCreatedat()|dateTime_format:"%H:%M - %d %m %Y"-|</time></div>
			</div>
		</div>
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

