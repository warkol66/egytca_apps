<script language="JavaScript" type="text/javascript">
|-if isset($error)-|
	$("resultDiv").innerHTML = '<span class="resultSuccess">Error procesando el Tweet</span>';
|-elseif $processAction eq 'save'-|
	|-if isset($multiple)-|
	|-foreach from=$tweets item=tweet-|
	$("li_|-$tweet-|").toggle();
	|-/foreach-|
	$("resultDiv").innerHTML = '<span class="resultSuccess">Tweets Guardados</span>';
	|-else-|
	$("li_|-$tweet->getId()-|").toggle();
	$("resultDiv").innerHTML = '<span class="resultSuccess">Tweet Guardado</span>';
	|-/if-|
|-elseif $processAction eq 'discard'-|
	|-if isset($multiple)-|
	|-foreach from=$tweets item=tweet-|
	$("li_|-$tweet-|").toggle();
	|-/foreach-|
	$("resultDiv").innerHTML = '<span class="resultSuccess">Tweets Descartados</span>';
	|-else-|
	$("li_|-$tweet->getId()-|").toggle();
	$("resultDiv").innerHTML = '<span class="resultSuccess">Tweet Descartado</span>';
	|-/if-|
|-/if-|
</script>
