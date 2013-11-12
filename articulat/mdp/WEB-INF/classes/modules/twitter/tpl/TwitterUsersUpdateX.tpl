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
	$('followers_|-$twitterUser->getId()-|').innerHTML = '|-$twitterUser->getFollowers()-|';
	$('friends_|-$twitterUser->getId()-|').innerHTML = '|-$twitterUser->getFriends()-|';
	$('statuses_|-$twitterUser->getId()-|').innerHTML = '|-$twitterUser->getStatuses()-|';
	$('updated_|-$twitterUser->getId()-|').innerHTML = '|-$twitterUser->getUpdatedAt()|change_timezone|date_format:"%d-%m-%Y"-|';
	|-capture name="influenceRadio"-|
						<form action="Main.php" method="post" id="formLevels|-$twitterUser->getId()-|">
							|-foreach from=$levels key=key item=name-|
								|-if $name@first-|<span class="radioLabelIcon">+</span>|-/if-|<input name="params[influence]" type="radio" value="|-$key-|"  title="|-$name-|" |-$twitterUser->getInfluence()|checked:$key-| onChange="javascript:twitterDoEditValue(this.form);"/>|-if $name@last-|<span class="radioLabelIcon">-</span>|-/if-|
							|-/foreach-|
						<input type="hidden" name="id" id="id" value="|-$twitterUser->getid()-|" />
						<input type="hidden" name="do" value="twitterUsersDoEditX" id="do">
					</form>
	|-/capture-|
	$('influence_|-$twitterUser->getId()-|').innerHTML = '|-$smarty.capture.influenceRadio|strip-|';

</script>
|-/if-|
