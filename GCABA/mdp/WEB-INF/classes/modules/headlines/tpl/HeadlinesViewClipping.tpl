|-if $errorMessage neq ''-|
	|-$errorMessage-|
|-elseif $image eq ''-|
	No hay una imágen asociada al titular.
	&nbsp;
	<input type='button' id='button_render' value='Capturar imágen' onClick='location.href="Main.php?do=headlinesRenderUrl&id=|-$id-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) && ($page ne 1)-|&page=|-$page-||-/if-|"' />
|-else-|
	
<div id="statusMsg"></div>
	
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
	
	function deleteClipping() {
		$("statusMsg").innerHTML = "eliminando imagen...";
		new Ajax.Request(
			"Main.php?do=headlinesDoRemoveClippingX",
			{
				method: "post",
				parameters: { id: "|-$headline->getId()-|" },
				onSuccess: function() {
					$("statusMsg").innerHTML = "imagen eliminada";
					reload();
				},
				onFailure: function(response) {
					$("statusMsg").innerHTML = "error eliminando imagen: "+response.statusText;
				}
			}
		);
	}
	
	Event.observe(window, 'load', disableEdit);
</script>

<p><br>

|-include file="HiddenInputsInclude.tpl" filters="$filters" page="$page"-|

<input type='button' id='button_save_crop' value='Guardar' onClick='applyCrop(function() { setTimeout("reload()", 500); });' style="display:none" />
<input type='button' id='button_start_crop' value='Recortar' onClick='enableEdit()' />
<input type='button' id='button_cancel_crop' value='Cancelar' onClick='disableEdit()' style="display:none" />
<input type='button' id='button_render' value='Capturar nuevamente' onClick='location.href="Main.php?do=headlinesRenderUrl&id=|-$id-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) && ($page ne 1)-|&page=|-$page-||-/if-|"' />
<input type='button' id='button_return_edit' value='Volver a edición' onClick='location.href="Main.php?do=headlinesEdit&id=|-$id-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) && ($page ne 1)-|&page=|-$page-||-/if-|&submit_go_edit_headline=Editar"' />
<input type='button' id='button_create_new' value='Crear nuevo' onClick='location.href="Main.php?do=headlinesEdit&campaignId=|-$headline->getCampaignId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) && ($page ne 1)-|&page=|-$page-||-/if-|"' />
<input type='button' id='button_delete' value='Eliminar' onClick='deleteClipping();' />
</p>

|-/if-|
