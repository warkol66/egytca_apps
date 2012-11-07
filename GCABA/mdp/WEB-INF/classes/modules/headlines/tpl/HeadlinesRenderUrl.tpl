<h2>Titulares</h2>
|-if $errorMessage eq "invalidId"-|
	<div class="errorMessage">El identificador del titular es inválido</div>
<p>	<input type='button' id='button_return_edit' value='Regresar a listado de titulares' onClick='location.href="Main.php?do=headlinesList"' /></p>
|-else if $errorMessage neq ''-|
<h1>Clipping - |-$headline-|</h1>
<div class="errorMessage">|-$errorMessage-|</div>
<p>El generador automático de imágenes no pudo obtener una imagen de la dirección asociada al titular. Puede capturarla manualmente y asignarla en el formulario inferior.</p>
|-if $headline->getUrl() ne ''-|<p>Para verificar la dirección asociada al titular, puede ir a la url  <a href="|-$headline->getUrl()-|" target="_blank" title="Ir a nota original" ><img src="images/clear.png" class="icon iconNewsGoTo" /></a> </p>|-/if-|
|-else-|
<h1>Clipping - |-$headline-|</h1>

|-if $type eq 'clipping'-|

|-include file='HeadlinesCropImageInclude.tpl'-|

<script type='text/javascript'>
	function gotoViewCrop() {
		window.location='Main.php?do=headlinesViewClipping&id=|-$id-|';
	}
	
	function saveUnmodified(onsuccess) {
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
				},
				onSuccess: onsuccess
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

<input type='button' id='button_save_crop' value='Guardar' onClick='applyCrop(gotoViewCrop);' style="display:none" />
<input type='button' id='button_save_unmodified' value='Guardar' onClick='saveUnmodified(gotoViewCrop);' />
<input type='button' id='button_start_crop' value='Recortar' onClick='enableEdit()' />
<input type='button' id='button_cancel_crop' value='Cancelar' onClick='disableEdit()' style="display:none" />
<input type='button' id='button_render' value='Capturar nuevamente' onClick='location.href="Main.php?do=headlinesRenderUrl&id=|-$id-|"' />
<input type='button' id='button_manual_upload' value='Subir imagen' onClick="$('manualUpload').show();" />
<input type='button' id='button_return_edit' value='Volver a edición' onClick='location.href="Main.php?do=headlinesEdit&id=|-$id-|"' />
</p>


|-else-|
	<img src="Main.php?do=headlinesAttachmentGetData&id=|-$attachment->getId()-|" />
	<p>
		<br>
		<input type="button" value="Volver a edición" onclick="window.location='Main.php?do=headlinesEdit&id=|-$headline->getId()-|'" />
	</p>
|-/if-|

|-/if-|

	<div id="manualUpload" style="|-if !$errorMessage || $errorMessage eq 'invalidId'-|display:none;|-/if-|">
	<fieldset>
	<legend>Clipping manual</legend>
		<form action="Main.php?do=headlinesRenderUrl&id=|-$id-|" method="post" enctype="multipart/form-data">
			<p><label for="file">Subir manualmente:</label>
			<input type="file" name="clipping" id="clipping" /></p>
			<input type="hidden" name="manual" value="1" />
			<p><input type="submit" name="submit" value="Subir" />
			<input type='button' id='button_return_edit' value='Volver a edición' onClick='location.href="Main.php?do=headlinesEdit&id=|-$id-|"' />
			</p>
		</form>
	</div>
</fieldset>

