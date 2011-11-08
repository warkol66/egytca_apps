<h2>Actas de Medición</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Acta de Medición</h1>
<div id="div_bulletin">
	<p>Ingrese los datos del Acta de Medición</p>
	|-if $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar el Acta de Medición</div>
	|-elseif $message eq "ok"-|
		<div class="successMessage">Cambios guardados correctamente</div>
	|-/if-|
	<form name="form_edit_record" id="form_edit_record" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un Acta de Medición">
			<legend>Formulario de Administración de Actas de Medición</legend>
			<p>
				<label for="params[constructionId]">Obra</label>
				<select name="params[constructionId]">
					<option value="">Seleccione una Obra</option>
					|-foreach from=$allConstructions item=construction-|
					<option value="|-$construction->getId()-|" |-$construction->getId()|selected:$record->getConstructionId()-|>|-$construction->getName()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				<label for="params[measurementDate]">Período</label>
				<input type="text" id="params[measurementDate]" name="params[measurementDate]" size="12" value="|-$record->getMeasurementDate()|date_format-|" title="Período" /><img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[measurementDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$record->getid()-|" />
				|-/if-|
				<input type="hidden" name="do" id="do" value="vialidadMeasurementRecordsDoEdit" />
				<input type="submit" id="button_edit_record" name="button_edit_record" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=vialidadMeasurementRecordsList'"/>
			</p>
		</fieldset>
	</form>
	
	|-if $action eq 'edit'-|
	<div id=div_itemsRecords>
	<table id="table_itemsRecords" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="40%">Item</th> 
			<th width="30%">Cantidad</th> 
			<th width="30%">Verificado</th>
		</tr>
		</thead>
		<tbody>
		|-if $itemRecords->count() eq 0-|
		<tr>
			<td colspan="3">No hay Items que mostrar</td>
		</tr>
		|-else-|
		|-foreach from=$itemRecords item=itemRecord name=for_items-|
		<tr>
			|-assign var=item value=$itemRecord->getConstructionItem()-|
			<td>|-$item->getName()-|</td>
			<td><span id="quantity|-$itemRecord->getId()-|" class="inPlaceEditable">|-$itemRecord->getQuantity()-|</span></td>
			<td><input type="checkbox" |-$itemRecord->getVerified()|checked_bool-| onchange="updateVerified('|-$itemRecord->getId()-|', this.checked)" /></td>
		</tr>
		|-/foreach-|
		|-/if-|
		</tbody>
	</table>
	</div>
	|-/if-|
</div>

<script type="text/javascript">

function updateVerified(itemRecordId, checkedValue) {
	new Ajax.Request(
		'Main.php?do=vialidadMeasurementRecordRelationsEditFieldX',
		{
			method: 'post',
			parameters: {
				id: itemRecordId,
				paramName: 'verified',
				paramValue: checkedValue
			}
		}
	);
}

|-if $action eq 'edit'-|
Event.observe(
	window,
	'load',
	function() {
		|-foreach from=$itemRecords item=itemRecord-|
		new Ajax.InPlaceEditor(
			'quantity|-$itemRecord->getId()-|',
			'Main.php?do=vialidadMeasurementRecordRelationsEditFieldX',
			{
				rows: 1,
				cols: 12,
				okText: 'Guardar',
				cancelText: 'Cancelar',
				savingText: 'Guardando...',
				hoverClassName: 'in_place_hover',
				highlightColor: '#b7e0ff',
				cancelControl: 'button',
				savingClassName: 'inProgress',
				clickToEditText: 'Haga click para editar',
				callback: function(form, value) {
					return 'id=|-$itemRecord->getId()-|&paramName=quantity&paramValue=' + encodeURIComponent(value);
				},
				onComplete: function(transport, element) {
					element.innerHTML = element.innerHTML.replace(/(\n|\r)+$/, '');
					new Effect.Highlight(element, { startcolor: this.options.highlightColor });
				}
			}
		);
		|-/foreach-|
	}
);
|-/if-|
</script>

