<script language="JavaScript" type="text/javascript">
function mediasAddCategoryToActor(form) {
	
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'categoryList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
				
	$('categoryMsgField').innerHTML = '<span class="inProgress">agregando ##medias,2,Medio## a la categoría...</span>';
	
	return true;
}

function mediasDeleteCategoryFromActor(form){

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'categoryMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
				
	$('categoryMsgField').innerHTML = '<span class="inProgress">eliminando ##medias,2,Medio## de la categoría...</span>';
	
	return true;

}
</script>
<h2>##medias,1,Medios##</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| ##medias,2,Medio##</h1>
<div id="div_media">
	<p>Ingrese los datos del ##medias,2,Medio##</p>
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el ##medias,2,Medio##</span>|-/if-|
	<form name="form_edit_media" id="form_edit_media" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un medio">
			<legend>Formulario de Administración de ##medias,1,Medios##</legend>
			<p>
				<label for="params[name]">Nombre</label>
				<input type="text" id="params[name]" name="params[name]" size="60" value="|-$media->getName()|escape-|" class="emptyValidation" title="Nombre" |-js_char_counter object=$media columnName="name" fieldName="params[name]" idRemaining="remaining" sizeRemaining="3" classRemaining="charCount" title="Cantidad de caracteres restantes" showHide=1 useSpan=0-| />|-validation_msg_box idField=params[name]-|
			</p>
			<p>
				<label for="params[description]">Descripción</label>
				<textarea name="params[description]" cols="50" rows="5" wrap="VIRTUAL" id="params[description]" title="Description">|-$media->getdescription()|escape-|</textarea>
			</p>
			<p><script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$media->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="mediasDoEdit" />
				|-javascript_form_validation_button value='Guardar' title='Guardar'-|
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=mediasList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>

</div>
