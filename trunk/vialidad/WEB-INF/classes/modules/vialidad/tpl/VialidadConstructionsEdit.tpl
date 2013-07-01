<link type="text/css" href="css/chosen.css" rel="stylesheet">
<script language="JavaScript" type="text/javascript" src="scripts/event.simulate.js"></script>
<script language="JavaScript" type="text/javascript" src="scripts/chosen.js"></script>
<h2>Obras</h2>
|-if $notValidId eq "true"-|
<div class="errorMessage">El identificador de la obra ingresado no es válido. Seleccione una obra del listado.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadConstructionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Obras"/>
|-else-|

|-include file="CommonAutocompleterInclude.tpl"-|

<h1>Administración de Obras - |-if $action eq 'create'-|Crear|-else-|Editar|-/if-| Obra</h1>
|-if $action eq 'create'-|	
	<p>A continuación podrá ingresar los datos para crear el Obra.</p>
|-else-|		
	<p>A continuación podrá editar los datos del Obra.</p>
|-/if-|
|-if $message eq "ok"-|
	<div  class="successMessage">Obra guardada</div>
|-/if-|
|-if !$notValidId-|	
	<fieldset title="Formulario de edición de nombre del Obra">
		<legend>Obras</legend>
		<p>Realice los cambios y para guardar haga click en "Guardar Cambios"</p>
			<form id="form_construction" method="post" action="Main.php?do=vialidadConstructionsDoEdit">
			<input type="hidden" value="|-$action-|" name="action">
			<input type="hidden" value="|-$construction->getId()-|" name="id">

		 <p><label for="params[contractId]">Contrato</label>
			|-if $returnContractId neq ""-|
				<input type="hidden" value="|-$returnContractId-|" name="params[contractId]">
				<input type="text" value="|-$contract-|" readonly="readOnly" size="60">
			|-else-|
				<input type="hidden" value="|-$construction->getContractId()-|" name="params[contractId]">
				<input type="text" value="|-$construction->getContract()-|" size="60" readonly="readOnly">
			|-/if-|

		 </p>
		 <p>
		   <label>N° de Contrato</label>
			 |-if !is_object($contract)-||-assign var=contract value=$construction->getContract()-||-/if-|
				|-if is_object($contract)-||-$contract->getContractNumber()|escape-||-/if-|
		</p>
		 <p><label for="params[name]">Nombre</label>
			<input name="params[name]" type="text" value="|-$construction->getName()|escape-|" size="60">
		 </p>
		 <p><label for="params[description]">Descripción</label>
			 <textarea name="params[description]" rows="4" cols="58">|-$construction->getDescription()-|</textarea>
		 </p>
		 <div id="verifier" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="params_verifierId" label="Fiscalizadora" url="Main.php?do=affiliatesAutocompleteListX" hiddenName="params[verifierId]" defaultHiddenValue=$construction->getVerifierId() defaultValue=$construction->getAffiliate()-|
		 </div>
			<p>
				<label for="params[typeId]">Tipo de Obra</label>
				<select id="params[typeId]" name="params[typeId]" >
        		<option value="">Seleccione</option>
				|-foreach from=$types item=type name=for_type-|
        		<option value="|-$type->getId()-|"|-$construction->getTypeId()|selected:$type->getId()-|>|-$type-|</option>
				|-/foreach-|
				</select>
			</p>
			 <p><label for="params[length]">Longitud</label>
			<input name="params[length]" type="text" value="|-$construction->getLength()|escape-|" size="6"> 
			<select id="params_lengthUnit" name="params[lengthUnit]" title="Unidad de medida">
        		<option value="">Seleccione unidad de medida</option>
				|-foreach from=$measureUnits item=object-|
							<option value="|-$object->getId()-|" |-$construction->getLengthUnit()|selected:$object->getId()-|>(|-$object-|) |-$object->getName()-|</option>
				|-/foreach-|
			</select>
		 </p>
			<p>     
				<label for="params[startDate]">Orden de Inicio</label>
				<input id="params[startDate]" name="params[startDate]" type='text' value='|-$construction->getStartDate()|date_format-|' size="12" title="Ingrese la fecha de inicio" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[startDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>

		 <p><label for="params[validationLength]">Plazo de la Obra</label>
			<input name="params[validationLength]" type="text" value="|-$construction->getValidationLength()|system_numeric_format:0-|" size="6"> 
			<select id="params_validationType" name="params[validationType]" title="Tipo de plazo">
				|-foreach from=$termTypes key=key item=name-|
							<option value="|-$key-|" |-$construction->getValidationType()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>
		 </p>


		 <p><label for="params[routeType]">Tipo de Ruta</label>
			<input name="params[routeType]" type="text" value="|-$construction->getrouteType()|escape-|" size="20">
		 </p>
		 <p><label for="params[routeStartingKm]">Kilómetro</label>
			&nbsp; desde <input name="params[routeStartingKm]" type="text" value="|-$construction->getrouteStartingKm()|system_numeric_format:3-|" class="right" size="6">
			&nbsp; &nbsp; hasta <input name="params[routeEndingKm]" type="text" value="|-$construction->getrouteEndingKm()|system_numeric_format:3-|" class="right" size="6">
		 </p>
		 <p><label for="params[startingLatitude]">Desde</label>
			&nbsp; Latitud <input name="params[startingLatitude]" type="text" value="|-$construction->getstartingLatitude()|system_numeric_format:8-|" class="right" size="12">
			&nbsp; &nbsp; Longitud <input name="params[startingLongitude]" type="text" value="|-$construction->getstartingLongitude()|system_numeric_format:8-|" class="right" size="12">
		 </p>
		 <p><label for="params[endingLatitude]">Hasta</label>
			&nbsp; Latitud <input name="params[endingLatitude]" type="text" value="|-$construction->getendingLatitude()|system_numeric_format:8-|" class="right" size="12">
			&nbsp; &nbsp; Longitud <input name="params[endingLongitude]" type="text" value="|-$construction->getendingLongitude()|system_numeric_format:8-|" class="right" size="12">
		 </p>

		 |-if $returnContractId neq ""-|
		 <input type="hidden" name="returnToContract" value="|-$returnContractId-|" />
		 |-/if-|
		 <p><input name="save" type="submit" value="Guardar Cambios"> 
				<input id="button_back" type='button' onClick='location.href="|-if $returnContractId neq ""-|Main.php?do=vialidadContractsEdit&id=|-$returnContractId-||-else-|Main.php?do=vialidadConstructionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-||-/if-|"' value='##104,Regresar##' title="Regresar"/>
			 </p>
		</form>
	</fieldset>
|-else-|
<div class="errorMessage">El identificador de la obra ingresado no es válido. Seleccione una obra de la lista.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadConstructionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Obras"/>
|-/if-|


|-if $action eq 'edit'-|
|-if !$construction->isNew()-|
<script type="text/javascript">

	function updateSelected(options, action) {
		
		var postParams = "";
		postParams += "constructionId=|-$construction->getId()-|";
		
		// Cargar selecionados
		for (var i=0; i < options.length; i++) {
			if (options[i].selected)
				postParams += "&departmentsIds[]="+options[i].value;
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
<fieldset title="Formulario de departamentos afectados por la obra">
	<legend>Departamentos</legend>
	<p>
	<form method="post" id="form_departments">
		<label for="departments">Departamentos</label>
		<select class="chzn-select wide-chz-select" data-placeholder="Seleccione uno o varios departamentos..." id="departmentsIds" name="departmentsIds[]" size="5" multiple="multiple" onChange="updateSelected(this.options, 'Main.php?do=vialidadConstructionDepartmentsDoUpdateX')" >
			|-foreach from=$departments item=department name=for_department-|
        		<option value="|-$department->getId()-|" |-if $construction->hasDepartment($department)-|selected="selected"|-/if-| >|-$department-|</option>
			|-/foreach-|
		</select>
	</form>
	</p>
</fieldset>
|-/if-|
<h3>Items de Construcción</h3>
<p align="right"><a class="report" href="Main.php?do=vialidadConstructionItemReport&id=|-$construction->getId()-|&action=show" target="_blank">Ver Reporte</a> <a class="download" href="Main.php?do=vialidadConstructionItemReport&id=|-$construction->getId()-|">Descargar Reporte</a></p>
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<thead>
	|-if "vialidadConstructionItemEdit"|security_has_access-|<tr>
		<th colspan="4" class="thFillTitle"><div class="rightLink">
			<form action="Main.php?do=vialidadConstructionItemEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" method="post">
			<input type="hidden" name="constructionId" value="|-$construction->getId()-|" />
			<input type="hidden" name="returnConstructionId" value="|-$construction->getId()-|" />
			<a href="#" onclick='this.parentNode.submit()' class="addLink">Agregar Item</a></form>
		</div></th>
	</tr>
	<tr><th colspan="4" class="thFillTitle"><div class="rightLink">
		<a href="#" id="link_copy1" class="addLink" onclick="$('link_copy1').hide();$('form_copy1').show();return false">Agregar desde otra obra</a>
		<form id="form_copy1" style="display:none" action="Main.php" method="post">
			<div style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_items" label="Buscar item" url="Main.php?do=vialidadConstructionItemAutocompleteListX" hiddenName="copiedId" disableSubmit="copyItemSubmit" notIncludeParagraph=true-|
			<input type="hidden" name="constructionId" value="|-$construction->getId()-|" />
			<input id="copyItemSubmit" type="button" disabled="disabled" class="icon iconActivate" onclick="copyItem(this.parentNode);$('form_copy1').hide();$('link_copy1').show();" />
			<input type="button" class="icon iconCancel" onclick="$('form_copy1').hide();$('link_copy1').show();" />
			</div>
		</form>
	</div></th></tr>
	|-/if-|
	<tr>
		<th width="10%">Código</th>
		<th width="75%">Item</th>
		<th width="10%">Cantidad</th>
		<th width="5%">&nbsp;
		</th>
	</tr>
	</thead>
	<tbody id="items_table_body">
	|-foreach from=$items item=item name=for_item-|
		|-include file="VialidadConstructionsTableRowInclude.tpl" item=$item constructionId=$construction->getId() filters=$filters pager=$pager-|
	|-/foreach-|
	</tbody>
	<tfoot>
	|-if isset($pager) && $pager->haveToPaginate()-|
	<tr>
		<td colspan="4" class="pages">|-include file="ModelPagerInclude.tpl"-|</td>
	</tr>
	|-/if-|
	|-if "vialidadConstructionItemEdit"|security_has_access && $items|@count gt 5-|<tr>
		<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=vialidadConstructionItemEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Item</a></div></th>
	</tr>|-/if-|
	</tfoot>
</table>

|-*include
	file="VialidadConstructionExtraTableInclude.tpl"
	extras=$fines
	extraType="fine"
	extraName="Multas"
	deleteText="Seguro que desea eliminar la Multa?"
	createAction="vialidadFineDoEditX"
	editAction="vialidadFineDoEditFieldX"
	deleteAction="vialidadFineDoDeleteX"
*-|

|-*include
	file="VialidadConstructionExtraTableInclude.tpl"
	extras=$dailyWorks
	extraType="dailyWork"
	extraName="Trabajos por Día"
	deleteText="Seguro que desea eliminar el Trabajo por Día?"
	createAction="vialidadDailyWorkDoEditX"
	editAction="vialidadDailyWorkDoEditFieldX"
	deleteAction="vialidadDailyWorkDoDeleteX"
*-|

|-*include
	file="VialidadConstructionExtraTableInclude.tpl"
	extras=$adjustments
	extraType="adjustment"
	extraName="Ajustes"
	deleteText="Seguro que desea eliminar el Ajuste?"
	createAction="vialidadAdjustmentDoEditX"
	editAction="vialidadAdjustmentDoEditFieldX"
	deleteAction="vialidadAdjustmentDoDeleteX"
*-|

|-*include
	file="VialidadConstructionExtraTableInclude.tpl"
	extras=$others
	extraType="other"
	extraName="Otros bienes y servicios"
	deleteText="Seguro que desea eliminar el el bien o servicio?"
	createAction="vialidadOtherDoEditX"
	editAction="vialidadOtherDoEditFieldX"
	deleteAction="vialidadOtherDoDeleteX"
*-|

|-/if-|

<script type="text/javascript">

function copyItem(form) {
	var fields = Form.serialize(form);
	new Ajax.Updater(
		{success: 'items_table_body'},
		'Main.php?do=vialidadConstructionsAddItemFromOtherX',
		{
			method: 'post',
			parameters: fields,
			insertion: 'bottom',
			evalScripts: true
		}
	);
}

function removeItem(itemId) {
	new Ajax.Request(
		'Main.php?do=vialidadConstructionItemDoDelete',
		{
			method: 'post',
			parameters: {
				id: itemId
			},
			evalScripts: true,
			onSuccess: function() {
				$('items_table_body').removeChild($('item'+itemId));
			}
		}
	);
}

</script>

|-/if-|
