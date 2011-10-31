<h2>Paramétricas</h2>
<h1>Administración de Items </h1>
<p>A continuación podrá administrar la composición del item  </p>
|-if $message eq "error"-|
	<div class="failureMessage">Ha ocurrido un error al intentar guardar el Item</div>
|-elseif $message eq "ok"-|
	<div class="successMessage">Cambios guardados correctamente</div>
|-/if-|
<fieldset title="Formulario de |-if $action eq 'create'-|creación|-else-|edición|-/if-| del item de construcción">
	<legend>Item</legend>
<form name="form_edit_construction_item" id="form_edit_construction_item" action="Main.php" method="post">
	<p>Ingrese los datos correspondientes y haga click en &quot;Guardar&quot; </p>
	<p>
		<label for="params[name]">Nombre</label>
		<input type="text" id="params[name]" name="params[name]" size="50" value="|-$item->getName()|escape-|" title="Nombre" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
	</p>
	<p>
		<label for="params[code]">Código</label>
		<input id="params[code]" name="params[code]" type="text" value="|-$item->getCode()-|" size="15" title="C&oacute;digo" />
	</p>
	<p>
		<label for="params[unit]">Unidad</label>
		<select id="params[unit]" name="params[unit]">
			|-foreach from=$units item=unit-|
			<option value="|-$unit-|" |-$item->getUnit()|selected:$unit-|>|-$unit-|</option>
			|-/foreach-|
		</select>
	</p>
	<p>
		|-if $action eq 'edit'-|
		<input type="hidden" name="id" id="id" value="|-$item->getid()-|" />
		|-/if-|
		<input type="hidden" name="action" id="action" value="|-$action-|" />
		<input type="hidden" name="do" value="vialidadConstructionItemDoEdit" />
		<input name="save" type="submit" value="Guardar Cambios" title="Guardar Cambios" /> 
		<input type='button' onClick='location.href="Main.php?do=vialidadConstructionItemList"' value='Regresar' title="Regresar al listado de Items de Construcción" />
	</p>
</form>
|-if $action eq 'edit'-|
<h3>Componentes</h3>
<div id="div_items"> 
	<table class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
			<tr><th colspan="3" class="thFillTitle"><div class="rightLink">
				<a href="#" id="link_add1" class="addLink" onclick="$('link_add1').hide();$('form_add1').show();return false">Agregar más insumos </a>
				<form id="form_add1" style="display:none" action="Main.php" method="post">
					<input type="text" name="value" id="new_supply1" />
					<input name="add_supply_button" type="button" disabled="disabled" class="icon iconActivate" onclick="addSupply($('new_supply1').value);$('form_add2').hide();$('link_add2').show();" />
					<div id="div_autocomplete1" class="autocomplete" style="display:none"></div>
					<input type="button" class="icon iconCancel" onclick="$('form_add1').hide();$('link_add1').show();" />
				</form>
			</div></th></tr>
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
			<tr>
				<td>|-$component->getSupply()-|</td>
				<td><span id="proportion|-$component->getSupplyid()-|" name="span_proportion">|-$component->getProportion()-|</span>&nbsp;%</td>
				<td align="center">
					|-if "vialidadConstructionItemDoRemoveRelationX"|security_has_access-|<form action="Main.php" method="post" onsubmit="removeRelationX(this);return false;" style="display:inline;">
						<input type="hidden" name="itemId" value="|-$item->getId()-|" />
						<input type="hidden" name="supplyId" value="|-$component->getSupplyid()-|" />
						<input type="submit" name="submit_go_remove_item_relation" value="Borrar" onclick="return confirm('Seguro que desea eliminar el Insumo')" class="icon iconDelete" /> 
					</form>|-/if-|
				</td>
			</tr>
			|-/foreach-|
			
			|-/if-|
		</tbody>
		<tfoot>
			<tr>
			  <td colspan="3" class="thFillTitle"><p>Total 
	<input name="params[price1]2" type="text" value="" size="15" /> 
</p><p id="message_invalid_proportions" style="display:none">Proporciones inválidas</p>
	
<p id="message_incomplete_proportions" style="display:none">Item incompleto</p>
&nbsp;</td>
			</tr>
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
		attachSupplyAutocompleter('new_supply2', 'div_autocomplete2');
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

function calculateTotalProportion(value) {
	var sum = 0;
	var spans = document.getElementsByName('span_proportion');

	for (var i=0; i<spans.length; i++) {
		var val = parseFloat(spans[i].innerHTML);
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
		"Main.php?do=vialidadSupplyAutocompleteListX",
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
			cols: 20,
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
				if (result == 1) {
					alert('proporciones inválidas');
					// TODO: buscar mejor solución que usar una accion sin parametros validos
					return '';
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
