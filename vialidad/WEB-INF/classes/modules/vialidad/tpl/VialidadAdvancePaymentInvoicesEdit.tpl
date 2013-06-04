<h2>Facturas de Contratistas</h2>

|-if $notValidId eq "true"-|
<div class="errorMessage">El identificador de la factura ingresado no es válido. Seleccione un item del listado.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadAdvancePaymentInvoicesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Facturas"/>
|-else-|

|-include file="CommonAutocompleterInclude.tpl"-|

<h1>|-if $advancePaymentInvoice->isNew()-|Crear|-else-|Editar|-/if-| Factura de Contratista</h1>
<div id="div_invoice">
	<p>Ingrese los datos del Factura de Contratista</p>
	|-if $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar el Factura de Contratista</div>
	|-elseif $message eq "ok"-|
		<div class="successMessage">Cambios guardados correctamente</div>
	|-/if-|
	<form name="form_edit_invoice" id="form_edit_invoice" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de una Factura de Contratista">
			<legend>Formulario de Administración de Factura de Contratista</legend>
			<p>
				|-if $advancePaymentInvoice->isNew()-|
					<div style="position: relative;z-index:10000;">
						|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" url="Main.php?do=vialidadContractsAutocompleteListX" hiddenName="params[contractId]" disableSubmit="button_edit_invoice" label="Contrato"-|
					</div>
				|-else-|
					<label for="contract">Contrato</label>
					<span id="contract">|-$advancePaymentInvoice->getContract()->getName()-|</span>
				|-/if-|
			</p>
			<p>
				<label for="params[contractorNumber]">Número S/Contratista</label>
				<input id='params[contractorNumber]' name='params[contractorNumber]' type='text' title="Número de Factura Según el Contratista" value='|-$advancePaymentInvoice->getContractorNumber()|escape-|' class="right" size="10" />
			</p>
			<p>
				<label for="params[advancePayment]">Anticipo</label>
				<input id='params[advancePayment]' name='params[advancePayment]' type='text' title="Anticipo" value='|-$advancePaymentInvoice->getAdvancePayment()|system_numeric_format-|' class="right" size="20" />
			</p>
			<p>
				<label for="params[status]">Estado</label>
				<select id='params[status]' name='params[status]'>
					<option value="submitted" |-$advancePaymentInvoice->getStatus()|selected:"submitted"-|>Presentada</option>
					<option value="void" |-$advancePaymentInvoice->getStatus()|selected:"void"-|>Anulada</option>
					<option value="paid" |-$advancePaymentInvoice->getStatus()|selected:"paid"-|>Pagada</option>
				</select>
			</p>	
			<p>
				|-if !$advancePaymentInvoice->isNew()-|
					<input type="hidden" name="id" value="|-$advancePaymentInvoice->getId()-|" />
				|-/if-|
				<input type="hidden" name="do" id="do" value="vialidadAdvancePaymentInvoicesDoEdit" />
				<input type="submit" id="button_edit_invoice" name="button_edit_invoice" |-if $advancePaymentInvoice->isNew()-|disabled="disabled"|-/if-| title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=|-if $returnToInvoicesList-|vialidadInvoicesList|-else-|vialidadAdvancePaymentInvoicesList|-/if-|'"/>
				<div id="div_form_error" style="display:none">Falta completar campos</div>
			</p>
		</fieldset>
	</form>
</div>

|-/if-|
