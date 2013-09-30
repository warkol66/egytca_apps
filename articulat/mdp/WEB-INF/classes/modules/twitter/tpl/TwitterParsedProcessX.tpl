<script language="JavaScript" type="text/javascript">
|-if isset($error)-|
	$("resultDiv").innerHTML = '<span class="resultSuccess">Error procesando el Tweet</span>';
|-else-|
	|-if isset($multiple)-|
	|-foreach from=$tweets item=tweet-|
	$("li_|-$tweet-|").remove();
	|-/foreach-|
	$("resultDiv").innerHTML = '<span class="resultSuccess">Tweets |-$infoMessage-|</span>';
	|-else-|
	$("li_|-$tweet->getId()-|").remove();
	$("resultDiv").innerHTML = '<span class="resultSuccess">Tweet |-$infoMessage-|</span>';
	|-/if-|
|-/if-|
</script>
