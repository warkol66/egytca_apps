<h2>Certificados de Obra</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Certificado de Obra</h1>
<div id="div_certificate">
	<p>Ingrese los datos del Certificado de Obra</p>
	|-if $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar el Certificado de Obra</div>
	|-elseif $message eq "ok"-|
		<div class="successMessage">Cambios guardados correctamente</div>
	|-/if-|
	<form name="form_edit_certificate" id="form_edit_certificate" onsubmit="return validateForm()" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un Certificado de Obra">
			<legend>Formulario de Administración de Certificado de Obra</legend>
			<p>
				<label for="params[measurementRecordId]">Acta</label>
				<select name="params[measurementRecordId]">
					<option value="">Seleccione un Acta</option>
					|-foreach from=$eligibleRecords item=record-|
					|-assign var=construction value=$record->getConstruction()-|
					<option value="|-$record->getId()-|" |-$record->getId()|selected:$certificate->getMeasurementRecordId()-|>|-$construction->getName()-|&nbsp;-&nbsp;|-$record->getMeasurementDate()|date_format:"%B / %Y"|@ucfirst-|</option>
					|-/foreach-|
				</select>
			</p>
			|-if $action eq 'edit'-|
			<p>
				<label for="totalPrice">Precio Total</label>
				<span id="totalPrice" name="totalPrice" size="12" title="Precio total">|-$certificate->calculatePrice()-|</span>
			</p>
			|-/if-|
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" value="|-$certificate->getid()-|" />
				<input type="hidden" name="action" value="edit" />
				|-/if-|
				<input type="hidden" name="do" id="do" value="vialidadCertificatesDoEdit" />
				<input type="submit" id="button_edit_certificate" name="button_edit_certificate" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=vialidadCertificatesList'"/>
				<div id="div_form_error" style="display:none">Falta completar campos</div>
			</p>
		</fieldset>
	</form>
	
	|-if $action eq 'edit'-|
	<div id=div_itemPrices>
	<table id="table_itemPrices" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="50%">Item</th> 
			<th width="15%">Cantidad</th> 
			<th width="15%">Precio por cantidad 1</th>
			<th width="15%">Precio total</th>
			<th width="5%">&nbsp;</th>
		</tr>
		</thead>
		<tbody>
		|-if $relations->count() eq 0-|
		<tr>
			<td colspan="5">No hay Items que mostrar</td>
		</tr>
		|-else-|
		|-foreach from=$relations item=relation name=for_relations-|
		<tr>
			|-assign var=item value=$relation->getConstructionItem()-|
			<td>|-$item->getName()-|</td>
			<td><span id="quantity|-$relation->getId()-|">|-$relation->getQuantity()-|</span></td>
			<td><span id="price|-$relation->getId()-|">|-$relation->getPrice()-|</span></td>
			<td><span id="totalPrice|-$relation->getId()-|">|-$relation->getTotalPrice()-|</span></td>
			<td align="center"><input id="button_priceEdit|-$relation->getId()-|" type="button" class="icon iconEdit"/></td>
		</tr>
		|-/foreach-|
		|-/if-|
		</tbody>
	</table>
	</div>
	|-/if-|
</div>


<script type="text/javascript">
	
var oldPrice = 0;

Event.observe(
	window,
	'load',
	function() {
		|-if $action eq 'edit'-|
		attachInPlaceEditors();
		|-/if-|
	}
);
	
function validateForm() {
	var submit = true;
	var params = ['measurementRecordId'];
	
	for (var i=0; i<params.length; i++) {
		if (!($('form_edit_certificate').elements['params['+params[i]+']'].value)) {
			submit = false;
			$('div_form_error').show();
		}
	}
	
	return submit;
}

function attachInPlaceEditors() {
	|-foreach from=$relations item=relation-|
	new Ajax.InPlaceEditor(
		'price|-$relation->getId()-|',
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
			externalControl: 'button_priceEdit|-$relation->getId()-|',
			callback: function(form, value) {
				return 'id=|-$relation->getId()-|&paramName=price&paramValue=' + encodeURIComponent(value);
			},
			onComplete: function(transport, element) {
				element.innerHTML = element.innerHTML.replace(/(\n|\r)+$/, '');
				new Effect.Highlight(element, { startcolor: this.options.highlightColor });
				updateCertificateTotalPrice();
				updateItemTotalPrice('|-$relation->getId()-|');
			}
		}
	);
	|-/foreach-|
}

function updateCertificateTotalPrice() {
	new Ajax.Updater(
		{success: 'totalPrice'},
		'Main.php?do=vialidadCertificatesGetTotalPriceX',
		{
			method: 'post',
			parameters: {id: '|-$certificate->getid()-|'}
		}
	);
}

function updateItemTotalPrice(relationId) {
	new Ajax.Updater(
		{success: 'totalPrice'+relationId},
		'Main.php?do=vialidadMeasurementRecordRelationsGetTotalPriceX',
		{
			method: 'post',
			parameters: {id: relationId}
		}
	);
}

</script>
