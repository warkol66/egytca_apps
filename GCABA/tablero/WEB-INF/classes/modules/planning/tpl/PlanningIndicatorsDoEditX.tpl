|-if $type eq 'json'-|
	|-$jsonIndicator-|
|-else-|
<div class="successMessage" id="actionMessage">Indicador guardado correctamente</div>

<script type="text/javascript">
		var validationMessage = $('validationMessage');
		if (Object.isElement(validationMessage))
			validationMessage.remove();
	$('form_edit_indicator').reset();
</script>
|-/if-|
