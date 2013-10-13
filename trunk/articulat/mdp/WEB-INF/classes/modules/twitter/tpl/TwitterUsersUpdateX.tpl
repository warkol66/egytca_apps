|-if !is_object($twitterUser)-|
	<div class="resultFailure">El usuario que está buscando no existe</div>
|-else-|
	<div class="resultSuccess">El usuario que está buscando no existe</div>
<script type="text/javascript">
	//$('twitterDivShowWorking').innerHTML = '<div class="resultSuccess">Usuario actualizado</div>';
	$('name_|-$twitterUser->getId()-|').innerHTML = '|-$twitterUser->getName()-|';
	$('screenName_|-$twitterUser->getId()-|').innerHTML = '|-$twitterUser->getUrl()-|';
	$('description_|-$twitterUser->getId()-|').innerHTML = '|-$twitterUser->getDescription()-|';
	$('url_|-$twitterUser->getId()-|').innerHTML = '|-$twitterUser->getUrl()-|';
	$('followers_|-$twitterUser->getId()-|').innerHTML = '|-$twitterUser->getFollowers()-|';
	$('friends_|-$twitterUser->getId()-|').innerHTML = '|-$twitterUser->getFriends()-|';
</script>
|-/if-|
