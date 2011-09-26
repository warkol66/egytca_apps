|-if $errorMessage neq ''-|
	|-$errorMessage-|
|-elseif $image eq ''-|
	No hay una imágen asociada al titular.
	&nbsp;
	<a href='Main.php?do=headlinesRenderUrl&id=|-$id-|'>Capturar imágen</a>
|-else-|
	
|-include file='HeadlinesCropImageInclude.tpl'-|

<script type='text/javascript'>
	function disableEdit() {
		disableCrop();
		$('button_start_crop').show();
		$('button_cancel_crop').hide();
		$('button_save_crop').hide();
	}
	
	function enableEdit() {
		enableCrop();
		$('button_start_crop').hide();
		$('button_cancel_crop').show();
		$('button_save_crop').show();
	}
	
	function reload() {
		window.location=window.location;// Forma horrible de refrescar la imágen
	}
	
	Event.observe(window, 'load', disableEdit);
</script>

<input type='button' id='button_save_crop' value='Guardar' onClick='applyCrop();setTimeout("reload()", 500)' style="display:none" />
<input type='button' id='button_start_crop' value='Recortar' onClick='enableEdit()' />
<input type='button' id='button_cancel_crop' value='Cancelar' onClick='disableEdit()' style="display:none" />
<p>
	<a href='Main.php?do=headlinesEdit&id=|-$id-|&submit_go_edit_headline=Editar'>Volver a edición</a>
</p>

|-/if-|
