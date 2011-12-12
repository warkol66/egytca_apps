<h2>Certificados de Obra</h2>

|-if $notValidId eq "true"-|
<div class="errorMessage">El identificador del certificado ingresado no es válido. Seleccione un item del listado.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadCertificatesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Certificados"/>
|-else-|

|-include file="CommonAutocompleterInclude.tpl" -|

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
				|-if $action eq "create"-|
				<div style="position: relative;z-index:10000;">
				|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" url="Main.php?do=vialidadMeasurementRecordsAutocompleteListX&noCertificate=1" hiddenName="params[measurementRecordId]" disableSubmit="button_edit_certificate" label="Acta"-|
				</div>
				|-else-|
				|-assign var=record value=$certificate->getMeasurementRecord()-|
				|-assign var=construction value=$record->getConstruction()-|
				<label for="params[measurementRecordId]">Acta</label>
				<span>|-$construction->getName()-|&nbsp;-&nbsp;|-$record->getMeasurementDate()|date_format:"%B / %Y"|@ucfirst-|</span>
				|-/if-|
			</p>
			|-if $action eq 'edit'-|
			<p>
				<label for="totalPrice">Precio Total</label>
				<span id="totalPrice" name="totalPrice" size="12" title="Precio total">|-$certificate->calculatePrice()|system_numeric_format-|</span>
			</p>
			|-/if-|
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" value="|-$certificate->getid()-|" />
				<input type="hidden" name="action" value="edit" />
				|-/if-|
				<input type="hidden" name="do" id="do" value="vialidadCertificatesDoEdit" />
				<input type="submit" id="button_edit_certificate" name="button_edit_certificate" |-if $action eq "create"-|disabled="disabled"|-/if-| title="Aceptar" value="Guardar" />
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
			<th width="10%">Cantidad</th> 
			<th width="5%">Unidad</th> 
			<th width="10%">Precio unitario</th>
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
			<td align="right">|-$relation->getQuantity()|system_numeric_format-|</td>
			<td align="center">|-$item->getUnit()-|</td>
			<td align="right"><span id="price|-$relation->getId()-|">|-$relation->getPrice()|system_numeric_format-|</span></td>
			<td align="right"><span id="totalPrice|-$relation->getId()-|">|-$relation->getTotalPrice()|system_numeric_format-|</span></td>
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

|-/if-|
