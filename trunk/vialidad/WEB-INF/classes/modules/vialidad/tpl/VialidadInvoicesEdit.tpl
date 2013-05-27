<h2>Facturas de Contratistas</h2>

|-if $notValidId eq "true"-|
<div class="errorMessage">El identificador de la facturao ingresado no es válido. Seleccione un item del listado.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadInvoicesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Facturas"/>
|-else-|

|-include file="CommonAutocompleterInclude.tpl"-|

<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Factura de Contratista</h1>
<div id="div_invoice">
	<p>Ingrese los datos del Factura de Contratista</p>
	|-if $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar el Factura de Contratista</div>
	|-elseif $message eq "ok"-|
		<div class="successMessage">Cambios guardados correctamente</div>
	|-/if-|
	<form name="form_edit_invoice" id="form_edit_invoice" onsubmit="return validateForm()" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un Factura de Contratista">
			<legend>Formulario de Administración de Factura de Contratista</legend>
			<p>
				|-if $action eq "create"-|
				<div style="position: relative;z-index:10000;">
				|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" url="Main.php?do=vialidadMeasurementRecordsAutocompleteListX&noCertificate=1" hiddenName="params[measurementRecordId]" disableSubmit="button_edit_invoice" label="Certificado"-|
				</div>
				|-else-|
				<label for="params[measurementRecordId]">Certificado</label>
				<span>&nbsp;</span>
				|-/if-|
			</p>
		 <p>
		   <label for="params[contractorNumber]">Número S/Contratista</label>
			<input id='params[contractorNumber]' name='params[contractorNumber]' type='text' title="Número de Factura Según el Contratista" value='|-$invoice->getContractorNumber()|escape-|' class="right" size="10" />
		</p>
		 <p>
		   <label for="params[advancePayment]">Anticipo</label>
			<input id='params[advancePayment]' name='params[advancePayment]' type='text' title="Importe del Anticipo" value='|-$invoice->getAdvancePayment()|system_numeric_format-|' class="right" size="20" />
		</p>
		 <p>
		   <label for="params[advancePaymentRecovery]">Recupero de Anticipo</label>
			<input id='params[advancePaymentRecovery]' name='params[advancePaymentRecovery]' type='text' title="Recupero de Anticipo" value='|-$invoice->getAdvancePaymentRecovery()|system_numeric_format-|' class="right" size="20" />
		</p>
		 <p>
		   <label for="params[withholding]">Retención</label>
			<input id='params[withholding]' name='params[withholding]' type='text' title="Retención" value='|-$invoice->getWithholding()|system_numeric_format-|' class="right" size="20" />
		</p>
		 <p>
		   <label for="params[totalPrice]">Total</label>
			<input id='params[totalPrice]' name='params[totalPrice]' type='text' title="Recupero de Anticipo" value='|-$invoice->getTotalPrice()|system_numeric_format-|' class="right" size="20" />
		</p>
		 <p>
		   <label for="params[status]">Estado</label>
			<select id='params[status]' name='params[status]'>
					<option value="">Seleccionar estado</option>
					<option value="submitted" |-$invoice->getStatus()|selected:"submitted"-|>Presentada</option>
					<option value="void" |-$invoice->getStatus()|selected:"void"-|>Anulada</option>
					<option value="paid" |-$invoice->getStatus()|selected:"paid"-|>Pagada</option>
				</select>
			</p>	
			<p>
				|-if !$invoice->isNew()-|
				<input type="hidden" name="id" value="|-$invoice->getId()-|" />
				|-/if-|
				<input type="hidden" name="do" id="do" value="vialidadInvoicesDoEdit" />
				<input type="submit" id="button_edit_invoice" name="button_edit_invoice" |-if $action eq "create"-|disabled="disabled"|-/if-| title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=vialidadInvoicesList'"/>
				<div id="div_form_error" style="display:none">Falta completar campos</div>
			</p>
		</fieldset>
	</form>
	
	|-if $action eq 'edit'-|
	
	<h3>Items</h3>
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
			<td align="center">|-$item->getMeasureUnit()-|</td>
			<td align="right"><span id="price|-$relation->getId()-|">|-$relation->getPrice()|system_numeric_format-|</span></td>
			<td align="right"><span id="totalPrice|-$relation->getId()-|">|-$relation->getTotalPrice()|system_numeric_format-|</span></td>
			<td align="center"><input id="button_priceEdit|-$relation->getId()-|" type="button" class="icon iconEdit"/></td>
		</tr>
		|-/foreach-|
		|-/if-|
		</tbody>
	</table>
	</div>
	
	

	
|-if $fines->count() gt 0-|
	<h3>Multas</h3>
	<div id=div_fines>
	<table id="table_fines" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="85%">Descripción</th> 
			<th width="15%">Precio</th>
		</tr>
		</thead>
		<tbody>
		|-foreach from=$fines item=fine-|
		<tr>
			<td>|-$fine->getDescription()-|</td>
			<td align="right">|-$fine->getPrice()|system_numeric_format-|</td>
		</tr>
		|-/foreach-|
		</tbody>
	</table>
	</div>
|-/if-|
	
|-if $dailyWorks->count() gt 0-|
	<h3>Trabajos por Día</h3>
	<div id=div_dailyWorks>
	<table id="table_dailyWorks" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="85%">Descripción</th> 
			<th width="15%">Precio</th>
		</tr>
		</thead>
		<tbody>
		|-foreach from=$dailyWorks item=dailyWork-|
		<tr>
			<td>|-$dailyWork->getDescription()-|</td>
			<td align="right">|-$dailyWork->getPrice()|system_numeric_format-|</td>
		</tr>
		|-/foreach-|
		</tbody>
	</table>
	</div>
|-/if-|
	
|-if $adjustments->count() gt 0-|
	<h3>Ajustes</h3>
	<div id=div_adjustments>
	<table id="table_adjustments" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="85%">Descripción</th> 
			<th width="15%">Precio</th>
		</tr>
		</thead>
		<tbody>
		|-foreach from=$adjustments item=adjustment-|
		<tr>
			<td>|-$adjustment->getDescription()-|</td>
			<td align="right">|-$adjustment->getPrice()|system_numeric_format-|</td>
		</tr>
		|-/foreach-|
		</tbody>
	</table>
	</div>
	|-/if-|
|-if $others->count() gt 0-|
	<h3>Otros bienes y servicios</h3>
	<div id=div_others>
	<table id="table_others" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead>
		<tr class="thFillTitle"> 
			<th width="85%">Descripción</th> 
			<th width="15%">Precio</th>
		</tr>
		</thead>
		<tbody>
		|-foreach from=$others item=other-|
		<tr>
			<td>|-$other->getDescription()-|</td>
			<td align="right">|-$other->getPrice()|system_numeric_format-|</td>
		</tr>
		|-/foreach-|
		</tbody>
	</table>
	</div>
	|-/if-|
		
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
		if (!($('form_edit_invoice').elements['params['+params[i]+']'].value)) {
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
		'Main.php?do=vialidadInvoicesGetTotalPriceX',
		{
			method: 'post',
			parameters: {id: '|-$invoice->getid()-|'}
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
