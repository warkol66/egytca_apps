<h2>Paramétricas</h2>

|-if $notValidId eq "true"-|
<div class="errorMessage">El identificador del item ingresado no es válido. Seleccione un item de una obra.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadConstructionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Obras"/>
|-else-|

<h1>Administración de Items </h1>
<p>A continuación podrá administrar la composición del item</p>
|-if $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar guardar el Item</div>
|-elseif $message eq "ok"-|
	<div class="successMessage">Cambios guardados correctamente</div>
|-/if-|
<fieldset title="Formulario de |-if $action eq 'create'-|creación|-else-|edición|-/if-| del item de construcción">
	<legend>Item</legend>
<form name="form_edit_construction_item" id="form_edit_construction_item" action="Main.php" method="post">
	<p>Ingrese los datos correspondientes y haga click en &quot;Guardar&quot; </p>
	|-if $item->getId() gt 0-|
	<p><label for="construction">Obra:</label>|-$item->getConstruction()-|</p>
	|-/if-|

	<p>
		<label for="params[name]">Nombre</label>
		<input type="text" id="params[name]" name="params[name]" size="50" value="|-$item->getName()|escape-|" title="Nombre" class="emptyValidation" /> |-validation_msg_box idField="params[name]"-|
	</p>
	<p>
		<label for="params[type]">Tipo</label>
|-if $item->isNew()-|		<select id="params[type]" name="params[type]" title="Seleccione el tipo de item">
			<option value="1" |-$item->getType()|selected:1-|>Item de construcción</option>
			<option value="2" |-$item->getType()|selected:2-|>Otros Items</option>
		</select>
|-else-|
		<input type="text" sise="25" value="|-if $item->getType() eq 1-|Item de construcción|-else-|Otros Items|-/if-|" disabled="disabled" />
|-/if-|
	</p>
	<p>
		<label for="params[code]">Código</label>
		<input id="params[code]" name="params[code]" type="text" value="|-$item->getCode()-|" size="15" title="C&oacute;digo" />
	</p>
	<p>
		<label for="params[quantity]">Cantidad</label>
		<input id="params[quantity]" name="params[quantity]" type="text" value="|-$item->getQuantity()|system_numeric_format-|" size="15" title="Cantidad" />
	</p>
	<p>
		<label for="params[unitId]">Unidad</label>
		<select id="params[unitId]" name="params[unitId]">
			|-foreach from=$units item=unit-|
			<option value="|-$unit->getId()-|" |-$item->getUnitid()|selected:$unit->getId()-|>|-$unit->getCode()-|</option>
			|-/foreach-|
		</select>
	</p>
	<p>
		<label for="params[order]">Orden</label>
		<input id="params[order]" name="params[order]" type="text" value="|-$item->getOrder()-|" size="15" title="Orden" />
	</p>
	<p>
		|-if $action eq 'edit'-|
		<input type="hidden" name="id" id="id" value="|-$item->getid()-|" />
		|-/if-|
		<input type="hidden" name="action" id="action" value="|-$action-|" />
		<input type="hidden" name="do" value="vialidadConstructionItemDoEdit" />
		|-if $constructionId neq ''-|
		<input type="hidden" name="params[constructionId]" value="|-$constructionId-|" />
		|-/if-|
		|-if $returnConstructionId neq ""-|
		<input type="hidden" name="returnToConstruction" value="|-$returnConstructionId-|" />
		|-/if-|
		<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
			|-javascript_form_validation_button value='Guardar' title='Guardar'-|
		<input type='button' onClick='location.href="|-if $returnConstructionId neq ""-|Main.php?do=vialidadConstructionsEdit&id=|-$returnConstructionId-||-else-|Main.php?do=vialidadConstructionItemList|-/if-|"' value='Regresar' title="|-if $returnConstructionId neq ""-|Regresar a la obraRegresar al listado de Items de |-else-|Regresar al listado de Items de Construcción|-/if-|" />
	</p>
</form>
|-if $action eq 'edit'-|
<h3>Componentes</h3>
<div id="div_items"> 
	<table class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
			<tr>
			<th colspan="3" class="thFillTitle"><div class="rightLink">
				<a href="#" id="link_add1" class="addLink" onclick="$('link_add1').hide();$('form_add1').show();$('new_supply1').focus();return false">Agregar más insumos </a>
				<form id="form_add1" style="display:none" action="Main.php" method="post" onsubmit="addSupply($('new_supply1').value);$('form_add1').hide();$('link_add1').show();$('new_supply1').clear();return false;">
					<input type="text" name="value" id="new_supply1" size="50" /><div id="div_autocomplete1" class="autocomplete" style="position: relative;display:none"></div>
					<input name="add_supply_button" id="add_supply_button" type="submit" disabled="disabled" class="icon iconActivate" />
					<input type="button" class="icon iconCancel" onclick="$('form_add1').hide();$('link_add1').show();$('new_supply1').clear();$('add_supply_button').disable();" />
				</form>
			</div>
			</th>
		</tr>
			<tr class="thFillTitle">
				<th width=50%>Insumo</th>
				<th width=45%>Proporción</th>
				<th width=5%>&nbsp;</th>
			</tr>
		</thead>
		<tbody id="components_table">
			|-if $components->count() eq 0-|
			<tr id="empty_table_message"><td colspan="2">No hay componentes que mostrar.</td></tr>
			|-else-|
			
			|-foreach from=$components item=component-|
			|-include file="VialidadConstructionItemRelationTableRowInclude.tpl" component=$component item=$item-|
			|-/foreach-|
			
			|-/if-|
		</tbody>
		<tfoot>
			<tr><td align="center" colspan="3" class="thFillTitle">
				<div id="message_invalid_proportions" class="errorMessage" style="display:none">Proporciones inválidas, se ha superado el 100%</div>
				<div id="message_incomplete_proportions" class="inProgress" style="display:none">Item incompleto, no se ha llegado al 100%</div>
			</td></tr>
		</tfoot>
	</table>
</div>


|-/if-|
</fieldset>




<script type="text/javascript">

var suppliesIds = new Array();
var totalProportion = 0;

Event.observe(
	window,
	'load',
	function() {
		checkProportions(0);
		loadSuppliesIds();
		|-foreach from=$components item=component-|
		attachInPlaceEditor('|-$component->getSupplyid()-|', 'proportion|-$component->getSupplyid()-|')
		|-/foreach-|
		attachSupplyAutocompleter('new_supply1', 'div_autocomplete1');
	}
)

function checkProportions(v) {
	var result = calculateTotalProportion(v);
	if (result < 100) {
		$('message_incomplete_proportions').show();
		$('message_invalid_proportions').hide();
		return -1;
	} else if (result == 100) {
		$('message_incomplete_proportions').hide();
		$('message_invalid_proportions').hide();
		return 0;
	} else if (result > 100) {
		$('message_incomplete_proportions').hide();
		$('message_invalid_proportions').show();
		return 1;
	}
}

function toJavascriptFormat(value) {
	return value.replace('.', '', 'g').replace(',', '.', 'g');
}

function calculateTotalProportion(value) {
	var sum = 0;
	var spans = document.getElementsByName('span_proportion');
	
	value = toJavascriptFormat(value.toString());

	for (var i=0; i<spans.length; i++) {
		var val = parseFloat(toJavascriptFormat(spans[i].innerHTML));
		if (!isNaN(val))
			sum += val;
	}
	
	if (!isNaN(parseFloat(value)))
		sum += parseFloat(value);
	
	return sum;
}

function removeRelationX(form) {
	var params = Form.serialize(form);
	
	new Ajax.Updater(
		'components_table',
		'Main.php?do=vialidadConstructionItemDoRemoveRelationX',
		{
			method: 'post',
			postBody: params
		}
	);
}
	
function loadSuppliesIds() {
	|-foreach from=$allSupplies item=supply-|
	suppliesIds['|-$supply->getName()-|'] = '|-$supply->getId()-|';
	|-/foreach-|
}

function addSupply(supplyName) {
	new Ajax.Updater(
		{success: 'components_table'},
		'Main.php?do=vialidadConstructionItemDoAddRelationX',
		{
			method: 'post',
			parameters: {
				itemId: '|-$item->getId()-|',
				supplyId: suppliesIds[supplyName]
			},
			insertion: 'bottom',
			evalScripts: true
		}
	);
}

function attachSupplyAutocompleter(element, autocompleteDiv) {
	var form = $(element).parentNode;
	
	new Ajax.Autocompleter(
		element,
		autocompleteDiv,
		"Main.php?do=vialidadSupplyAutocompleteListX&getCandidates=true&entityType=ConstructionItem&entityId=|-$item->getId()-|&filters[type]=|-$item->getType()-|",
		{
			minChars: 3,
			afterUpdateElement: function(text, li) {
				var requestParamValue = suppliesIds[text.value];
				if (requestParamValue > 0)
					form.elements["add_supply_button"].enable();
				else
					form.elements["add_supply_button"].disable();
				}
			}
	);
}

function attachInPlaceEditor(supplyId, element) {
	var editor = new Ajax.InPlaceEditor(
		element,
		'Main.php?do=vialidadConstructionItemRelationDoEditFieldX',
		{
			rows: 1,
			cols: 8,
			okText: 'Guardar',
			cancelText: 'Cancelar',
			savingText: 'Guardando...',
			hoverClassName: 'in_place_hover',
			highlightColor: '#b7e0ff',
			cancelControl: 'button',
			savingClassName: 'inProgress',
			clickToEditText: 'Haga click para editar',
			callback: function(form, value) {
				var result = checkProportions(value);
				if (result == 1 || isNaN(parseFloat(value))) {
					return 'itemId=|-$item->getId()-|&supplyId='+supplyId+'&paramName=proportion';
				}
				
				return 'itemId=|-$item->getId()-|&supplyId='+supplyId+'&paramName=proportion&paramValue='+encodeURIComponent(value);
			},
			onComplete: function(transport, element) {
				clean_text_content_from(element);
				new Effect.Highlight(element, { startcolor: this.options.highlightColor });
			}
		}
	);
}

function chomp(raw_text) {
	return raw_text.replace(/(\n|\r)+$/, '');
}

function clean_text_content_from(element) {
	element.innerHTML = chomp(element.innerHTML);
}

</script>

|-/if-|
