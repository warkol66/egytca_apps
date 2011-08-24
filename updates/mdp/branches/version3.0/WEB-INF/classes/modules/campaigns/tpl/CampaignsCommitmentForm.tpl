<script type="text/javascript" >
	function createCommitment(form) {
		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater('operationInfo',
					"Main.php?do=campaignsCommitmentDoEditX",
					{
						method: 'post',
						parameters: { action: "campaignsCommitmentDoEditX"},
						postBody: fields,
						evalScripts: true
					});
		$('commitmentInfo').innerHTML = '<span class="inProgress">Procesando información</span><img src="images/spinner.gif" />';
		return false;
	}
	function editCommitment(form) {
		$('form_edit_commitment').reset();
		$('form_edit_commitment').commitmentId.value = "";
		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater('commitmentInfo',
					"Main.php?do=campaignsCommitmentEditX",
					{
						method: 'post',
						parameters: { action: "campaignsCommitmentEditX"},
						postBody: fields,
						evalScripts: true
					});
		$('commitmentInfo').innerHTML = '<span class="inProgress">Procesando información</span>';
		return false;
	}
	function deleteCommitment(form) {
		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater('commitmentInfo',
					"Main.php?do=campaignsCommitmentDoDeleteX",
					{
						method: 'post',
						parameters: { action: "campaignsCommitmentDoDeleteX"},
						postBody: fields,
						evalScripts: true
					});
		$('commitmentInfo').innerHTML = '<span class="inProgress">Procesando información</span>';
		return false;
	}
</script>
	
<fieldset title="Formulario de edición de datos de un compromiso">
 <legend>Ingrese los datos del compromiso</legend>
	<div id="commitmentInfo"></div>
	<form id="form_edit_commitment" name="form_edit_commitment" action="Main.php" method="post">
	<p><label for="commitmentData[commitment]">Compromiso</label>
		<textarea name="commitmentData[commitment]" cols="60" rows="3" wrap="virtual" id="commitmentData_commitment" title="Compromiso" class="emptyValidation"></textarea>|-validation_msg_box idField="commitmentData_commitment"-|
	</p>
	<p><label for="commitmentData[responsible]">Responsable</label>
		<input name="commitmentData[responsible]" type="text" id="commitmentData_responsible" title="Responsable" value="" size="60" />
	</p>
	<p> 
		<label for="commitmentData[date]">Fecha</label> 
		<input type="text" id="commitmentData_date" name="commitmentData[date]" class="dateValidation emptyValidation" value="" title="Fecha (Formato: dd-mm-yyyy)" |-javascript_onchange_validation_attribute idField="commitmentData_date"-| /> 
	<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('commitmentData[date]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-', 'fixed');" title="Seleccione la fecha"> &nbsp;&nbsp;|-validation_msg_box idField="commitmentData[date]"-|</p> 
	<p>    
		<label for="commitmentData[achieved]">Cumplido</label>
	    <input type="hidden" name="commitmentData[achieved]" value="0" />
	    <input type="checkbox" name="commitmentData[achieved]" id="commitmentData_achieved" value="1" title="Marque esta opción si está cumplido el compromiso" />
    </p> 
		<p>			
				<input type="hidden" name="do" id="do" value="campaignsCommitmentDoEditX" />
				<input type="hidden" name="commitmentId" id="commitmentId" value="" />
				<input type="hidden" name="commitmentData[campaignId]" id="commitmentData[campaignId]" value="|-$campaign->getId()-|" />
				<input type="button" id="button_edit_commitment" name="button_edit_commitment" title="Aceptar" value="Agregar" onClick="javascript: if (validationValidateFormClienSide(this.form, false)) createCommitment(this.form);" />
				<a href="#" class="lbAction noDecoration" rel="deactivate"><input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" /></a> 
		</p>
	</form>
</fieldset>

