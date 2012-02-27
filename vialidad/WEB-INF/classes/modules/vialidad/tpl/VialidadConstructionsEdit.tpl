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
				<select id="params[contractId]" name="params[contractId]" |-$action|disabled-| >
					<option value="">Seleccione el contrato</option>
				|-foreach from=$contracts item=contract name=for_contract-|
        		<option id="option|-$contract->getId()-|" value="|-$contract->getId()-|" |-$construction->getContractId()|selected:$contract->getId()-|>|-$contract-|</option>
				|-/foreach-|
				</select>
			</p>
		 </p>
		 <p><label for="params[name]">Nombre</label>
			<input name="params[name]" type="text" value="|-$construction->getName()|escape-|" size="60">
		 </p>
		 <p><label for="params[description]">Descripción</label>
			 <textarea name="params[description]" rows="4" cols="58">|-$construction->getDescription()-|</textarea>
		 </p>
		 <div id="verifier" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="params_verifierId" label="Fiscalizadora" url="Main.php?do=affiliatesVerifiersAutocompleteListX" hiddenName="params[verifierId]" defaultHiddenValue=$construction->getVerifierId() defaultValue=$construction->getAffiliate()-|
		 </div>
			<p>
				<label for="params[typeId]">Tipo del Obra</label>
				<select id="params[typeId]" name="params[typeId]" >
        		<option value="">Seleccione</option>
				|-foreach from=$types item=type name=for_type-|
        		<option value="|-$type->getId()-|"|-$construction->getTypeId()|selected:$type->getId()-|>|-$type-|</option>
				|-/foreach-|
				</select>
			</p>
			 <p><label for="params[length]">Longitud</label>
			<input name="params[length]" type="text" value="|-$construction->getLength()|escape-|" size="6"> Kms.
		 </p>
			<p>     
				<label for="params[startDate]">Fecha de inicio</label>
				<input id="params[startDate]" name="params[startDate]" type='text' value='|-$construction->getStartDate()|date_format-|' size="12" title="Ingrese la fecha de inicio" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[startDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
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
|-if !$contract->isNew()-|
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

<h3>Multas</h3>
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<thead>
	|-if "vialidadFineDoEditX"|security_has_access-|
	<tr>
		<th colspan="4" class="thFillTitle"><div class="rightLink">
			<a href="#" id="link_addFine" class="addLink" onclick="this.hide(); $('form_addFine').show(); return false">Agregar Multa</a>
			<form id="form_addFine" onsubmit="addFine(this); this.hide(); $('link_addFine').show(); return false;" style="display:none">
				<input type="hidden" name="params[constructionId]" value="|-$construction->getId()-|" />
				<label>Descripción</label>
				<input type="text" size="60" name="params[description]" />
				<label>Fecha</label>
				<input type="text" size="12" name="params[date]" />
				<label>Importe</label>
				<input type="text" size="12" name="params[price]" />
				<input type="submit" class="icon iconActivate" />
				<input type="button" class="icon iconCancel" onclick="this.form.hide(); $('link_addFine').show();" />
			</form>
		</div></th>
	</tr>
	|-/if-|
	<tr>
		<th width="70%">Descripción</th>
		<th width="15%">Fecha</th>
		<th width="10%">Importe</th>
		<th width="3%">&nbsp;
		</th>
	</tr>
	</thead>
	<tbody id="fines">
	|-foreach from=$fines item=fine-|
		|-include file="VialidadFineTableRowInclude.tpl" fine=$fine-|
	|-/foreach-|
	</tbody>
</table>
|-/if-|

<script type="text/javascript">

function addFine(form) {
	new Ajax.Updater(
		{success: 'fines'},
		'Main.php?do=vialidadFineDoEditX',
		{
			methos: 'post',
			parameters: Form.serialize(form),
			insertion: 'bottom',
			evalScripts: true
		}
	);
}

function removeFine(id) {
	new Ajax.Request(
		'Main.php?do=vialidadFineDoDeleteX',
		{
			method: 'post',
			parameters: {
				id: id
			},
			evalScripts: true,
			onSuccess: function() {
				$('fines').removeChild($('fine'+id));
			}
		}
	);
}

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
