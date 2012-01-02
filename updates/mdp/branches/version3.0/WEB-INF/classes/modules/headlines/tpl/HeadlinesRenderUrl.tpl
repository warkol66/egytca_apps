|-if $errorMessage neq ''-|
	|-$errorMessage-|
|-else-|
	
|-include file='HeadlinesCropImageInclude.tpl'-|

<script type='text/javascript'>
	function gotoViewCrop() {
		window.location='Main.php?do=headlinesViewClipping&id=|-$id-|';
	}
	
	function saveUnmodified() {
		new Ajax.Request(
			'Main.php?do=headlinesDoCropImageX',
			{
				method: 'post',
				parameters: {
					headlineId: '|-$id-|',
					imageFile: '|-$image-|',
					|-if $temp neq ''-|temp: '1',
					|-/if-|
					relativeX: '0',
					relativeY: '0',
					relativeWidth: '|-$displayedWidth-|',
					relativeHeight: '|-$displayedHeight-|',
					displayedWidth: '|-$displayedWidth-|',
					displayedHeight: '|-$displayedHeight-|'
				}
			}
		);
	}
	
	function disableEdit() {
		disableCrop();
		$('button_save_unmodified').show();
		$('button_start_crop').show();
		$('button_cancel_crop').hide();
		$('button_save_crop').hide();
	}
	
	function enableEdit() {
		enableCrop();
		$('button_save_unmodified').hide();
		$('button_start_crop').hide();
		$('button_cancel_crop').show();
		$('button_save_crop').show();
	}
	
	Event.observe(window, 'load', disableEdit);
</script>

<p><br>

<input type='button' id='button_save_crop' value='Guardar' onClick='applyCrop();gotoViewCrop()' style="display:none" />
<input type='button' id='button_save_unmodified' value='Guardar' onClick='saveUnmodified();gotoViewCrop()' />
<input type='button' id='button_start_crop' value='Recortar' onClick='enableEdit()' />
<input type='button' id='button_cancel_crop' value='Cancelar' onClick='disableEdit()' style="display:none" />
<input type='button' id='button_render' value='Capturar nuevamente' onClick='location.href="Main.php?do=headlinesRenderUrl&id=|-$id-|"' />
<input type='button' id='button_return_edit' value='Volver a edición' onClick='location.href="Main.php?do=headlinesEdit&id=|-$id-|&submit_go_edit_headline=Editar"' />
</p>

|-/if-|
