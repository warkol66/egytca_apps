<h2>##common,18,Configuración del Sistema##</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Indicador de marco de resultados</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<script type="text/javascript" language="javascript">
function indicatorsGetPosibleObjectsByIndicatorX(form){
	var fields = Form.serialize(form, true);
	fields['do'] = 'panelResultFramesIndicatorsGetPosibleObjectsByIndicatorX';
	fields = Object.toQueryString(fields);
	var myAjax = new Ajax.Updater(
				{success: 'object_id_selector'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('resultFrameIndicatorsMsgField').innerHTML = '<p><span class="inProgress">Obteniendo posibles entidades...</span></p>';
	return false;
}

function indicatorsGetAllParentsByIndicatorX(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'parentInfo'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('resultFrameIndicatorsMsgField').innerHTML = '<p><span class="inProgress">buscando padres...</span></p>';
	return true;
}

function indicatorsGetObjectInfoX(form){
	var fields = Form.serialize(form, true);
	fields['do'] = 'panelResultFramesIndicatorsGetObjectInfoX';
	fields = Object.toQueryString(fields);
	var myAjax = new Ajax.Updater(
				{success: 'embeddedForm'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('resultFrameIndicatorsMsgField').innerHTML = '<p><span class="inProgress">Actualizando información de la entidad...</span></p>';
	indicatorsGetValuesX(form);
	return false;
}

function indicatorsGetValuesX(form){
	var fields = Form.serialize(form, true);
	fields['do'] = 'panelResultFramesIndicatorsGetValuesX';
	fields = Object.toQueryString(fields);
	var myAjax = new Ajax.Updater(
				{success: 'valuesList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('resultFrameIndicatorsMsgField').innerHTML = '<p><span class="inProgress">Generando valores...</span></p>';
	return false;
}
function changeValidationType(type) {
	var fields = $$('input.indicatorValue');
	var form = $('form_edit_indicator');
	validationClearInvalidFields(fields);
	if (type == 1) {
		fields.each(function(e) {
			e.addClassName('numericValidation');
		});
	} else {
		fields.each(function(e) {
			e.removeClassName('numericValidation');
		});
	}
	validationValidateFormClienSide(form, false);
}
</script>

<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox"> 
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar<input type="button" class="iconDelete" /></a> 
	</p>
	<div id="embeddedForm">
		|-include file=$formTemplateName action="showLog"-|
	</div> 
</div> 

<p>A continuación podrá |-if $action eq "edit"-|editar|-else-|crear|-/if-| una indicador de marco de resultados.</p>
<div id="div_resultFrameIndicator">
	|-if $message eq "ok"-|
		<div class="successMessage">Indicador guardada correctamente</div>
	|-/if-|
	|-if $message eq "error"-|
		<div class="errorMessage">Ha ocurrido un error al intentar guardar la indicador </div>
	|-/if-|
		<fieldset title="Formulario de edición de datos de una indicador">
     <legend>Ingrese los datos de la Indicador</legend>
	<form action="Main.php" method="post" >
				<input type="hidden" name="do" value="panelResultFramesIndicatorsGetAllParentsByIndicatorX" />
<p>
      <label for="indicatorDataX[type]">Tipo</label>
|-if $action eq "edit"-|
|-$indicator->getTypeTranslated()-|
|-else-|<select id="indicatorDataX[type]" name="indicatorDataX[type]" title="type" onChange="indicatorsGetAllParentsByIndicatorX(this.form);">
				<option value="0">Seleccione el tipo</option>
			|-foreach from=$indicatorTypes key=typeKey item=type name=for_type-|
				|-if $typeKey gt $configModule->get('resultFrameIndicators','treeRootType')-|
        <option value="|-$typeKey-|">|-$type-|</option>
				|-/if-|
			|-/foreach-|
      </select>|-/if-|</p>
		</form>
	<form name="form_edit_indicator" id="form_edit_indicator" action="Main.php" method="post">
<div id="resultFrameIndicatorsMsgField"></div>
<div id="parentInfo">
|-if $action eq "edit"-|
  <p><label for="indicatorData[parentId]">Dentro de</label>
  <select id="indicatorData[parentId]" name="indicatorData[parentId]" title="parentId" onChange="indicatorsGetPosibleObjectsByIndicatorX(this.form); indicatorsGetValuesX(this.form);"> 
	|-if $indicator->getType() eq $configModule->get('resultFrameIndicators','treeRootType') or empty($indicators) or count($indicators) eq 0 -|
    <option value="0" selected="selected">Ninguna</option> 
	|-else-|
	|-foreach from=$indicators item=parent name=for_parent-|
   |-assign var=level value=$parent->getLevel()-|<option value="|-$parent->getId()-|" |-if $indicator->getParentId() eq $parent->getId()-|selected="selected" |-/if-|>|-section name=space loop=$level-|&nbsp;&nbsp;|-/section-||-$parent->getName()-|</option> 
	|-/foreach-|
	|-/if-|
  </select></p>
|-/if-|
|-if $action eq "edit"-|
  <input type="hidden" name="indicatorData[objectType]" value="|-$objectType-|" />
  <div id="object_id_selector">
  <p><label for="indicatorData[objectId]">Acerca de</label>
  <select id="indicatorData[objectId]" name="indicatorData[objectId]" title="objectId" onChange="indicatorsGetObjectInfoX(this.form);"> 
	|-if $indicator->getType() eq $configModule->get('resultFrameIndicators','treeRootType') or empty($objects) or count($objects) eq 0-|
    <option value="0" selected="selected">Ninguna</option>
    |-else-|
    	|-foreach from=$objects item=object name=for_object-|
   			<option value="|-$object->getId()-|" |-if $indicator->getObjectId() eq $object->getId()-|selected="selected" |-/if-|>|-$object->getName()|truncate:70-|</option> 
		|-/foreach-|
	|-/if-|
  </select><a id="lbOn" href="#lightbox1" rel="lightbox1" class="lbOn linkView">Ver Detalle</a></p>
  </div>
|-/if-|
</div>
	<p>
	  <label for="indicatorData[name]">Nombre</label>
	  <input name="indicatorData[name]" type="text" id="indicatorData[name]" title="Nombre del Indicador" value="|-$indicator->getName()|escape-|" size="60" maxlength="150" />
	</p>
	<p>
	  <label for="indicatorData[useData]">Utiliza datos</label>
	  <input name="indicatorData[useData]" type="hidden" value="0" />
	  <input name="indicatorData[useData]" type="checkbox" id="indicatorData[useData]" title="Utiliza datos" value="1" |-$indicator->getUseData()|checked_bool-| onclick="switch_vis('divUseData')"/>
	</p>
	<div id="divUseData" style="display:|-if $indicator->getUseData()-|block|-else-|none|-/if-|">

	<p>
	  <label for="indicatorData[dataRecolectionInstrument]">Recolección de datos</label>
	  <textarea name="indicatorData[dataRecolectionInstrument]" id="indicatorData[dataRecolectionInstrument]" title="Recolección de datos" cols="70" rows="3" wrap="VIRTUAL">|-$indicator->getDataRecolectionInstrument()|escape-|</textarea>
	</p>
	<p>
	  <label for="indicatorData[dataRecolectionResponsible]">Responsable</label>
	  <textarea name="indicatorData[dataRecolectionResponsible]" id="indicatorData[dataRecolectionResponsible]" title="Responsable" cols="70" rows="3" wrap="VIRTUAL">|-$indicator->getDataRecolectionResponsible()|escape-|</textarea>
	</p>
	<p>
	  <label for="indicatorData[baseValue]">Valor Base</label>
	  <input name="indicatorData[baseValue]" type="text" id="indicatorData[baseValue]" title="Valor Base" value="|-$indicator->getBaseValue()|escape-|" size="60" maxlength="150" />
	</p>
  <p><label for="indicatorData[frequency]">Frecuencia</label>
  <select id="indicatorData[frequency]" name="indicatorData[frequency]" title="Frecuencia"> 
    <option value="0" selected="selected">Seleccione frequencia</option>
   			<option value="1" |-if $indicator->getFrequency() eq 1-|selected="selected" |-/if-|>Anual</option> 
   			<option value="2" |-if $indicator->getFrequency() eq 2-|selected="selected" |-/if-|>Semestral</option> 
   			<option value="3" |-if $indicator->getFrequency() eq 3-|selected="selected" |-/if-|>Trimestral</option> 
  </select></p>
  <p><label for="indicatorData[valueType]">Tipo</label>
  <select id="indicatorData[valueType]" name="indicatorData[valueType]" title="Tipo de valor" onChange="javascript:changeValidationType(this.value)"> 
    <option value="0" selected="selected">Seleccione tipo de valor</option>
   			<option value="1" |-if $indicator->getValueType() eq 1-|selected="selected" |-/if-|>Numérico</option> 
   			<option value="2" |-if $indicator->getValueType() eq 2-|selected="selected" |-/if-|>Texto</option> 
  </select></p>
	<p>
	  <label for="indicatorData[content]">Detalle de Avance</label>
	  <textarea name="indicatorData[content]" id="indicatorData[content]" title="Detalle de avance" cols="70" rows="6" wrap="VIRTUAL">|-$indicator->getContent()|escape-|</textarea>
	</p>
	
	<div id="valuesList">
		|-include file="PanelResultFramesIndicatorValuesEditInclude.tpl"-|
	</div>
	</div>
		<p>	
	|-if $action eq "edit"-|
		<input type="hidden" name="id" id="id" value="|-$indicator->getId()-|" />
	|-/if-|
		<input type="hidden" name="from" value="|-$from-|" />
		<input type="hidden" name="policyGuidelineId" value="|-$policyGuidelineId-|" />
		<input type="hidden" name="action" id="action" value="|-$action-|" />
		<input type="hidden" name="do" id="do" value="panelResultFramesIndicatorsDoEdit" />
		<br />
		<input type="button" id="button_edit_indicator" name="button_edit_indicator" title="Aceptar" value="Aceptar" onClick="javascript:validationValidateFormClienSide(this.form);" />
|-if $from eq "panelResultFramesView"-|
		<input type="button" id="button_return_indicator" name="button_return_indicator" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=|-$from-|&policyGuidelineId=|-$policyGuidelineId-|'" />
|-else-|		<input type="button" id="button_return_indicator" name="button_return_indicator" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=panelResultFramesIndicatorsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page) -|&page=|-$page-||-/if-|'" />
|-/if-|
		<input type="hidden" name="indicatorData[type]" id="indicatorData[type]" value="|-$indicator->getType()-|" />
	</p>
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
		|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
	</form>
		</fieldset>
</div>