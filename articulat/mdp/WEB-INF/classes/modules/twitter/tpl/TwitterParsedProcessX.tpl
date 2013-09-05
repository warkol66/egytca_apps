<script language="JavaScript" type="text/javascript">
|-if isset($error)-|
	$("resultDiv").innerHTML = '<span class="resultSuccess">Error procesando el Tweet</span>';
|-elseif $processAction eq 'save'-|
	$("li_|-$tweet->getId()-|").toggle();
	$("resultDiv").innerHTML = '<span class="resultSuccess">Tweet Guardado</span>';
|-elseif $processAction eq 'discard'-|
	$("li_|-$tweet->getId()-|").toggle();
	$("resultDiv").innerHTML = '<span class="resultSuccess">Tweet Descartado</span>';
|-/if-|
</script>
