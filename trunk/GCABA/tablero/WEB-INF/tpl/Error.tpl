|-if (isset($errorTagId))-|
<script type="text/javascript" language="javascript" >
	$('|-$errorTagId-|').innerHTML = '<span class="resultFailure">Ha ocurrido un error en la operación</span>';
</script>
|-elseif (isset($errorMsg))-|
	|-$errorMsg-|
|-else-|
	<p class="resultFailure">Ha ocurrido un error en la operación</p>
|-/if-|
