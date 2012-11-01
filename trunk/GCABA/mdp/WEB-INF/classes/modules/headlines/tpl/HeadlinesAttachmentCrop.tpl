<fieldset>
<h2>Titulares</h2>
|-if $errorMessage eq "invalidId"-|
	<div class="errorMessage">El identificador de la imágen es inválido</div>
<p>	<input type='button' id='button_return_edit' value='Regresar a listado de titulares' onClick='location.href="Main.php?do=headlinesList"' /></p>
|-else-|

<h1>Imágen - |-$attachment->getHeadline()-|</h1>
|-include file='HeadlinesCropImageInclude.tpl' id=$attachment->getId() isAttachment=1-|
<p><br>
<input type='button' id='button_save_crop' value='Guardar' onClick='applyCrop(gotoViewCrop);' />
<input type='button' id='button_return' value='Volver' onClick='location.href="Main.php?do=headlinesViewAttachments&id=|-$attachment->getHeadlineid()-|"' />
</p>

<script type='text/javascript'>
	
	function gotoViewCrop() {
		window.location='Main.php?do=headlinesAttachmentCrop&id=|-$attachment->getId()-|';
	}
	
	Event.observe(window, 'load', enableCrop);
</script>

|-/if-|
</fieldset>
