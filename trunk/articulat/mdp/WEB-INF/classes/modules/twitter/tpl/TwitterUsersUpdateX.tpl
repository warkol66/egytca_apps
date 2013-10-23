|-if !is_object($twitterUser)-|
	<div class="resultFailure">El usuario que está buscando no existe</div>
|-else-|
	<div class="resultSuccess">Usuario actualizado</div>
<script type="text/javascript">
	|-assign var=userUrl value=$twitterUser->getUrl()-|
	$('name_|-$twitterUser->getId()-|').innerHTML = '|-$twitterUser->getName()|escape-|';
	$('screenName_|-$twitterUser->getId()-|').innerHTML = '<a href="https://twitter.com/|-$twitterUser->getScreenname()-|" class="twitterUrl " target="_blank">@|-$twitterUser->getScreenname()-|</a>';
	$('description_|-$twitterUser->getId()-|').innerHTML = '|-$twitterUser->getDescription()|escape-|';
	$('url_|-$twitterUser->getId()-|').innerHTML = '|-if !empty($userUrl)-|<a href="|-$userUrl-|" class="twitterUrl " target="_blank">|-$userUrl-|</a>|-/if-|';
	$('followers_|-$twitterUser->getId()-|').innerHTML = '|-$twitterUser->getFollowers()|escape-|';
	$('friends_|-$twitterUser->getId()-|').innerHTML = '|-$twitterUser->getFriends()|escape-|';
</script>
|-/if-|
