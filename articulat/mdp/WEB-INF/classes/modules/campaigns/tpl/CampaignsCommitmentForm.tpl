<script type="text/javascript" >
	var $j = jQuery.noConflict();

	$j(document).ready(function($) {

		$.datepicker.setDefaults($.datepicker.regional['es']);
	    $( ".datepickerCommitment" ).datepicker({
			dateFormat:"dd-mm-yy"
		}).attr('readonly', 'readonly').css('backgroundColor', '#FFF');
	});

	function createCommitment(form) {
		$j.ajax({
			url: url,
			data: $j(form).serialize(),
			type: 'post',
			success: function(data){
				$j('#operationInfo').html(data);
			}	
		});
		$j('#commitmentInfo').html('<span class="inProgress">Procesando información</span>');
		return false;
	}

		
	function clearCommitmentForm(){
		$j('#form_edit_commitment')[0].reset();
		clearFormFieldsFormat('form_edit_commitment');
		$j('#commitmentId').val('');
		$j('#validationFailureMessage').hide();
		$j('#commitmentInfo').html('');
	}

	function editCommitment(form) {
		clearCommitmentForm();
		$j.ajax({
			url: url,
			data: $j(form).serialize(),
			type: 'post',
			success: function(data){
				$j('#commitmentInfo').html(data);
			}	
		});
		$j('#commitmentInfo').html('<span class="inProgress">Procesando información</span>');
		return false;
	}

	function deleteCommitment(form) {
		$j.ajax({
			url: url,
			data: $j(form).serialize(),
			type: 'post',
			success: function(data){
				$j('#commitmentInfo').html(data);
			}	
		});
		$j('#commitmentInfo').html('<span class="inProgress">Procesando información</span>');
		return false;
	}
</script>
	
<fieldset title="Formulario de edición de datos de un compromiso">
 <legend>Ingrese los datos del compromiso</legend>
	<div id="commitmentInfo"></div>
	<form id="form_edit_commitment" name="form_edit_commitment" action="Main.php" method="post">
	<p><label for="commitmentData[commitment]">Compromiso</label>
		<textarea name="commitmentData[commitment]" cols="60" rows="3" wrap="virtual" id="commitmentData_commitment" title="Compromiso" class="emptyValidation"></textarea>|-validation_msg_box idField="commitmentData[commitment]"-|
	</p>
	<p><label for="commitmentData[responsible]">Responsable</label>
		<input name="commitmentData[responsible]" type="text" id="commitmentData_responsible" title="Responsable" value="" size="60" />
	</p>
	<p> 
		<label for="commitmentData[date]">Fecha</label> 
		<input name="commitmentData[date]" type="text" id="commitmentData_date" class="datepickerCommitment dateValidation emptyValidation" title="Fecha (Formato: dd-mm-yyyy)" |-javascript_onchange_validation_attribute idField="commitmentData_date"-| value="" size="12" /> 
	<img src="images/calendar.png" width="16" height="15" border="0" title="Seleccione la fecha"> &nbsp;&nbsp;|-validation_msg_box idField="commitmentData[date]"-|</p> 
	<p>    
		<label for="commitmentData[achieved]">Cumplido</label>
	    <input type="hidden" name="commitmentData[achieved]" value="0" />
	    <input type="checkbox" name="commitmentData[achieved]" id="commitmentData_achieved" value="1" title="Marque esta opción si está cumplido el compromiso" />
    </p>
		<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
		<p>			
				<input type="hidden" name="do" id="do" value="campaignsCommitmentDoEditX" />
				<input type="hidden" name="commitmentId" id="commitmentId" value="" />
				<input type="hidden" name="commitmentData[campaignId]" id="commitmentData[campaignId]" value="|-$campaign->getId()-|" />
				<input type="button" id="button_edit_commitment" name="button_edit_commitment" title="Aceptar" value="Agregar" onClick="javascript: if (validationValidateFormClienSide(this.form, false)) createCommitment(this.form);" />
				<a href="#" class="lbAction noDecoration" rel="deactivate"><input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" /></a> 
		</p>
	</form>
</fieldset>

