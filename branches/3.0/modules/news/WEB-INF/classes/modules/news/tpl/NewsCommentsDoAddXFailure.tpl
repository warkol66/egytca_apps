|-if $captcha-|
	<script type="text/javascript" charset="utf-8">
		$('msgBoxAdder'+|-$article->getId()-|).innerHTML = '<span class="resultFailure">El código de validación ingresao es incorrecto, ingreselo nuevamente</span>';
	</script>
|-else-|
	<script type="text/javascript" charset="utf-8">
		$('msgBoxAdder'+|-$article->getId()-|).innerHTML = '<span class="resultFailure">Se ha producido un error al agregar el comentario</span>';
	</script>
|-/if-|