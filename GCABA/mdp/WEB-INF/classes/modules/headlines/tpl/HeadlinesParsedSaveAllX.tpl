|-if $errorMessage neq ''-|
	|-$errorMessage-|
|-else-|
<script language="JavaScript" type="text/javascript">
	|-if $selectiveSave-|
		|-foreach $headlinesIds as $headlineId-|
			$("li_|-$headlineId-|").remove();
		|-/foreach-|
	|-else-|
		$("list").innerHTML = '<li id="noHeadlines">No hay más Titulares disponibles</li>';
	|-/if-|
	$("resultDiv").innerHTML = '<span class="resultSuccess">Titulares Guardados</span>';
</script>
|-/if-|