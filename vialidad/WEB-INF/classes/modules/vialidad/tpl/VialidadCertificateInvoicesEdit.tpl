<h2>Facturas de Contratistas</h2>

|-if $notValidId eq "true"-|
<div class="errorMessage">El identificador de la factura ingresado no es válido. Seleccione un item del listado.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadCertificateInvoicesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Facturas"/>
|-else-|

|-include file="CommonAutocompleterInclude.tpl"-|

<h1>|-if $certificateInvoice->isNew()-|Crear|-else-|Editar|-/if-| Factura de Contratista</h1>
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
			|-if $certificateInvoice->isNew()-|<p>
					<div style="position: relative;z-index:10000;">
						|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" url="Main.php?do=vialidadCertificatesAutocompleteListX&noCertificateInvoice=1" hiddenName="params[certificateId]" disableSubmit="button_edit_invoice" label="Certificado"-|
					</div>
				</p>
				|-else-|
					<p>
					<label for="certificate">Certificado</label>
					<input id='certificate' name='certificate' type='text' id="certificate" |-"readonly"|readonly-| value="|-$certificateInvoice->getCertificate()->getMeasurementRecord()->getConstruction()->getName()-| - |-$certificateInvoice->getCertificate()->getMeasurementRecord()->getPeriod()|date_format:"%B / %Y"-|" size="60" />
				</p>
				<p>
				<label for="certificateAmount">Monto certificado</label>
				<input id='certificateAmount' name='certificateAmount' type='text' title="Monto del certificado" value='|-$certificateInvoice->getCertificate()->getTotalprice()|system_numeric_format-|' |-"readonly"|readonly:"right"-| size="20" />
			</p>
|-/if-|
			

			<p>
				<label for="params[contractorNumber]">Número S/Contratista</label>
				<input id='params[contractorNumber]' name='params[contractorNumber]' type='text' title="Número de Factura Según el Contratista" value='|-$certificateInvoice->getContractorNumber()|escape-|' class="right" size="10" />
			</p>		
			<p>
				<label for="params[advancePaymentRecovery]">Recupero de Anticipo</label>
				<input id='params[advancePaymentRecovery]' name='params[advancePaymentRecovery]' type='text' title="Recupero de Anticipo" value='|-$certificateInvoice->getAdvancePaymentRecovery()|system_numeric_format-|' class="right" size="20" />
				|-if !$certificateInvoice->isNew()-|
					&nbsp; <span>Importe calculado: &nbsp; <span id='calculatedValues[advancePaymentRecovery]' class="resultSuccess">|-$calculatedValues.advancePaymentRecovery|system_numeric_format-|</span></span>
				|-/if-|
			</p>
			<p>
				<label for="params[withholding]">Retención</label>
				<input id='params[withholding]' name='params[withholding]' type='text' title="Retención" value='|-$certificateInvoice->getWithholding()|system_numeric_format-|' class="right" size="20" />
				|-if !$certificateInvoice->isNew()-|
					&nbsp; <span>Importe calculado: &nbsp; <span id='calculatedValues[withholding]' class="resultSuccess">|-$calculatedValues.withholding|system_numeric_format-|</span></span>
				|-/if-|
			</p>
			<p>
				<label for="params[totalPrice]">Total</label>
				<input id='params[totalPrice]' name='params[totalPrice]' type='text' title="Recupero de Anticipo" value='|-$certificateInvoice->getTotalPrice()|system_numeric_format-|' class="right" size="20" />
				|-if !$certificateInvoice->isNew()-|
					&nbsp; <span>Importe calculado: &nbsp; <span id='calculatedValues[totalPrice]' class="resultSuccess">|-$calculatedValues.totalPrice|system_numeric_format-|</span></span>
				|-/if-|
			</p>
			<p>
				<label for="params[status]">Estado</label>
				<select id='params[status]' name='params[status]'>
					<option value="submitted" |-$certificateInvoice->getStatus()|selected:"submitted"-|>Presentada</option>
					<option value="void" |-$certificateInvoice->getStatus()|selected:"void"-|>Anulada</option>
					<option value="paid" |-$certificateInvoice->getStatus()|selected:"paid"-|>Pagada</option>
				</select>
			</p>	
			<p>
				|-if !$certificateInvoice->isNew()-|
					<input type="hidden" name="id" value="|-$certificateInvoice->getId()-|" />
				|-/if-|
				<input type="hidden" name="do" id="do" value="vialidadCertificateInvoicesDoEdit" />
				<input type="submit" id="button_edit_invoice" name="button_edit_invoice" |-if $certificateInvoice->isNew()-|disabled="disabled"|-/if-| title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=vialidadInvoicesList'"/>
				|-if !$certificateInvoice->isNew()-|
					<input type="button" value="Usar valores calculados" onclick="useCalculatedValues();" />
				|-/if-|
				<div id="div_form_error" style="display:none">Falta completar campos</div>
			</p>
		</fieldset>
	</form>
</div>

<script>
	useCalculatedValues = function() {
		
		var calculatedValues = {
			'advancePaymentRecovery': '|-$calculatedValues.advancePaymentRecovery|system_numeric_format-|',
			'withholding': '|-$calculatedValues.withholding|system_numeric_format-|',
			'totalPrice': '|-$calculatedValues.totalPrice|system_numeric_format-|'
		};
		
		for (var key in calculatedValues) {
			$('params['+key+']').value = calculatedValues[key];
		};
	};
</script>

|-/if-|
