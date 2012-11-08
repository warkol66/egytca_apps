|-if $captcha-|
	<script type="text/javascript" charset="utf-8">
		$('#msgBoxAdder'+|-$entry->getId()-|).html('<span class="resultFailure">El código de validación ingresado es incorrecto, ingreselo nuevamente</span>');
	</script>
|-else-|
	<script type="text/javascript" charset="utf-8">
		$('#msgBoxAdder'+|-$entry->getId()-|).html('<span class="resultFailure">Se ha producido un error al agregar el comentario</span>');
	</script>
|-/if-|
