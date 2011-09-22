|-if $error_message neq ''-|
	|-$error_message-|
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
					headline_id: '|-$id-|',
					image_file: '|-$image-|',
					relative_x: 0,
					relative_y: 0,
					relative_width: '|-$displayedWidth-|',
					relative_height: '|-$displayedHeight-|',
					displayed_width: '|-$displayedWidth-|',
					displayed_height: '|-$displayedHeight-|'
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

<input type='button' id='button_save_crop' value='Guardar' onClick='applyCrop();gotoViewCrop()' />
<input type='button' id='button_save_unmodified' value='Guardar' onClick='saveUnmodified();gotoViewCrop()' />
<input type='button' id='button_start_crop' value='Recortar' onClick='enableEdit()' />
<input type='button' id='button_cancel_crop' value='Cancelar' onClick='disableEdit()' />

|-/if-|
