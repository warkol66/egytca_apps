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
				<label for="params[typeId]">Tipo</label>
				<select id="params[typeId]" name="params[typeId]" >
        		<option value="">Seleccione</option>
				|-foreach from=$mediaTypes item=mediaType name=for_mediaType-|
        		<option value="|-$mediaType->getId()-|">|-$mediaType->getName()-|</option>
				|-/foreach-|
				</select>
			</p>
			<p>
				<label for="params[description]">Descripción</label>
				<textarea name="params[description]" cols="50" rows="5" wrap="VIRTUAL" id="params[description]" title="Description">|-$media->getdescription()|escape-|</textarea>
			<p>
				<label for="params[markets]">Mercados</label>
				<select name="params[markets]" size="4" id="params[markets]" >
     		<option value="">Seleccione</option>
				|-foreach from=$mediaMarkets item=mediaMarket name=for_mediaMarket-|
        		<option value="|-$mediaMarket->getId()-|" |-$media->getTypeId()|selected:$mediaMarket->getId()-|>|-$mediaMarket->getName()-|</option>
				|-/foreach-|
				</select>
			</p>
			<p>
				<label for="params[audiences]">Audiencia</label>
				<select name="params[audiences]" size="4" id="params[audiences]" >
     		<option value="">Seleccione</option>
				|-foreach from=$mediaAudiences item=mediaAudience name=for_mediaAudience-|
        		<option value="|-$mediaAudience->getId()-|" |-$media->getTypeId()|selected:$mediaAudience->getId()-|>|-$mediaAudience->getName()-|</option>
				|-/foreach-|
				</select>
			</p>
			<p>
				<label for="params[address]">Dirección</label><input name="params[address]" size="60" value="|-$media->getAddress()|escape-|" type="text">
			</p>
			<p>
				<label for="params[phone]">Teléfono</label><input name="params[phone]" size="60" value="|-$media->getPhone()|escape-|" type="text">
			</p>
			<p>
				<label for="params[receptionist]">Receptionist</label><input name="params[receptionist]" size="60" value="|-$media->getReceptionist()|escape-|" type="text">
			</p>
			<p>
				<label for="params[fax]">Fax</label><input name="params[fax]" size="60" value="|-$media->getFax()|escape-|" type="text">
			</p>
			<p>
				<label for="params[email]">Email</label><input name="params[email]" size="60" value="|-$media->getEmail()|escape-|" type="text">
			</p>
			<p>
				<label for="params[url]">Url</label><input name="params[url]" size="60" value="|-$media->getUrl()|escape-|" type="text">
			</p>
			<p>
				<label for="params[mediakitUrl]">Mediakit Url</label><input name="params[mediakitUrl]" size="60" value="|-$media->getMediakitUrl()|escape-|" type="text">
			</p>

			</p><script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
			<p>
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
<fieldset>
<legend>Contactos</legend>
</fieldset>
</div>
