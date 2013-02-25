|-if is_object($blogTag)-|
<p class="successMessage">La nueva etiqueta ha sido creada</p>
<script type="text/javascript">
	var option = $('<option id="tagOption|-$blogTag->getId()-|" value="|-$blogTag->getId()-|" >|-$blogTag->getName()-|</option>');
	$('#tagId').append(option);
</script>
|-else-|
<p class="failureMessage">Error al crear la etiqueta</p>
|-/if-|
