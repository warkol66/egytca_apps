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
					|-foreach from=$allRecords item=record-|
					|-assign var=construction value=$record->getConstruction()-|
					<option value="|-$record->getId()-|" |-$record->getId()|selected:$certificate->getMeasurementRecordId()-|>|-$construction->getName()-|&nbsp;-&nbsp;|-$record->getMeasurementDate()|date_format:"%B / %Y"|@ucfirst-|</option>
					|-/foreach-|
				</select>
			</p>
			|-if $action eq 'edit'-|
			<p>
				<label for="span_suggestedPrice">Precio Sugerido</label>
				<span id="span_suggestedPrice">|-$suggestedPrice-|</span>
			</p>
			<p>
				<label for="params[totalPrice]">Precio Total</label>
				<input type="text" id="params[totalPrice]" name="params[totalPrice]" size="12" value="|-$certificate->getTotalPrice()-|" title="Precio total" />
			</p>
			|-/if-|
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$certificate->getid()-|" />
				|-/if-|
				<input type="hidden" name="do" id="do" value="vialidadCertificatesDoEdit" />
				<input type="submit" id="button_edit_certificate" name="button_edit_certificate" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=vialidadCertificatesList'"/>
				<div id="div_form_error" style="display:none">Falta completar campos</div>
			</p>
		</fieldset>
	</form>
</div>


<script type="text/javascript">
	
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

</script>
