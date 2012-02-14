|-include file="CommonAutocompleterInclude.tpl"-|
<link type="text/css" href="css/chosen.css" rel="stylesheet">
<script language="JavaScript" type="text/javascript" src="scripts/event.simulate.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/chosen.js"></script>
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
<h1>|-if $media->isNew()-|Crear|-else-|Editar|-/if-| ##medias,2,Medio##</h1>
<div id="div_media">
	<p>Ingrese los datos del ##medias,2,Medio##</p>
	|-if $message eq "ok"-|
		<div class="successMessage">##medias,2,Medio## guardado correctamente</div>
	|-elseif $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar el ##medias,2,Medio##</div>
	|-/if-|
	<form name="form_edit_media" id="form_edit_media" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un medio">
			<legend>Formulario de Administración de ##medias,1,Medios##</legend>
			<p>
				<label for="params[name]">Nombre</label>
				<input type="text" id="params[name]" name="params[name]" size="60" value="|-$media->getName()|escape-|" class="emptyValidation" title="Nombre" |-js_char_counter object=$media columnName="name" fieldName="params[name]" idRemaining="remaining" sizeRemaining="3" classRemaining="charCount" counterTitle="Cantidad de caracteres restantes" showHide=1 useSpan=0-||-$Counter.pre-| /> |-$Counter.pos-| |-validation_msg_box idField="params[name]"-|
			</p>
			<p>
				<label for="params[typeId]">Tipo</label>
				<select id="params[typeId]" name="params[typeId]" >
        		<option value="">Seleccione</option>
				|-foreach from=$mediaTypes item=mediaType name=for_mediaType-|
        		<option value="|-$mediaType->getId()-|"|-$media->getTypeId()|selected:$mediaType->getId()-|>|-$mediaType->getName()-|</option>
				|-/foreach-|
				</select>
			</p>
			<p>
				<label for="params[importance]">Importancia</label>
				<input name="params[importance]" type="hidden" value="0" />
				&nbsp; 1 <input name="params[importance]" type="radio" value="1" |-$media->getImportance()|checked:1-|/>
				&nbsp; 2 <input name="params[importance]" type="radio" value="2" |-$media->getImportance()|checked:2-|/>
				&nbsp; 3 <input name="params[importance]" type="radio" value="3" |-$media->getImportance()|checked:3-|/>
				&nbsp; 4 <input name="params[importance]" type="radio" value="4" |-$media->getImportance()|checked:4-|/>
			</p>
			<p>
				<label for="params[description]">Descripción</label>
				<textarea name="params[description]" cols="50" rows="5" wrap="VIRTUAL" id="params[description]" title="Description">|-$media->getdescription()|escape-|</textarea>
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
			<p>
				<div style="position: relative;z-index:10000;">
				|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_medias" url="Main.php?do=mediasAutocompleteListX" hiddenName="params[aliasOf]" label="Alias de" defaultValue=$media->getMediaRelatedByAliasof() defaultHiddenValue=$media->getAliasof() name="params[aliasOf]"-|
				</div>
			</p>

			</p><script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
			<p>
				|-if !$media->isNew()-|
				<input type="hidden" name="id" id="id" value="|-$media->getid()-|" />
				|-/if-|
				|-include file="HiddenInputsInclude.tpl" action="$action" filters="$filters" page="$page"-|
				<input type="hidden" name="do" id="do" value="mediasDoEdit" />
				|-javascript_form_validation_button value='Guardar' title='Guardar'-|
				<input type="button" id="cancel" name="cancel" title="Regresar al listado" value="Regresar al listado" onClick="location.href='Main.php?do=mediasList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|'"/>
			</p>
		</fieldset>
	</form>

|-if !$media->isNew()-|
<script type="text/javascript">

	function updateSelected(options, action) {
		
		var postParams = "";
		postParams += "mediaId=|-$media->getId()-|";
		
		// Cargar selecionados
		for (var i=0; i < options.length; i++) {
			if (options[i].selected)
				postParams += "&selectedIds[]="+options[i].value;
		}
		
		new Ajax.Updater(
			"",
			action,
			{
				method: 'post',
				postBody: postParams,
				evalScripts: true
			});
		return true;
	}
	
</script>

<fieldset title="Formulario de mercados y audiencias asociados al medio">
	<legend>Mercados y Audiencias</legend>
	<p>
	<form method="post" id="form_markets">
		<label for="markets">Mercados</label>
		<select class="chzn-select markets-chz-select" data-placeholder="Seleccione uno o varios mercados..." id="marketsIds" name="marketsIds[]" size="5" multiple="multiple" onChange="updateSelected(this.options, 'Main.php?do=mediasUpdateMarketsX')" >
			|-foreach from=$mediaMarkets item=mediaMarket name=for_mediaMarket-|
        		<option value="|-$mediaMarket->getId()-|" |-if $media->hasMediaMarket($mediaMarket)-|selected="selected"|-/if-| >|-$mediaMarket->getName()-|</option>
			|-/foreach-|
		</select>
	</form>
	</p>
	<p>
	<form method="post" id="form_audiences">
		<label for="audiences">Audiencias</label>
		<select class="chzn-select markets-chz-select" data-placeholder="Seleccione una o varias audiencias..." id="audiencesIds" name="audiencesIds[]" size="5" multiple="multiple" onChange="updateSelected(this.options, 'Main.php?do=mediasUpdateAudiencesX')" >
			|-foreach from=$mediaAudiences item=mediaAudience name=for_mediaAudience-|
        		<option value="|-$mediaAudience->getId()-|" |-if $media->hasMediaAudience($mediaAudience)-|selected="selected"|-/if-| >|-$mediaAudience->getName()-|</option>
			|-/foreach-|
		</select>
	</form>
	</p>
</fieldset>
|-/if-|
<!--<fieldset>
<legend>Contactos</legend>
</fieldset>-->
</div>
