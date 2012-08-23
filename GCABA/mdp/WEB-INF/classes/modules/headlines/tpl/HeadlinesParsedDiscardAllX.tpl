<script language="JavaScript" type="text/javascript">
	|-if $selectiveDiscard-|
		|-foreach $headlinesIds as $headlineId-|
			$("li_|-$headlineId-|").remove();
		|-/foreach-|
	|-else-|
		$("list").innerHTML = '<li id="noHeadlines">No hay más Titulares disponibles</li>';
	|-/if-|
	$("resultDiv").innerHTML = '<span class="resultSuccess">Titulares Descartados</span>';
</script>