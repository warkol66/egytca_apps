<script type="text/javascript" >
	function createIndicator(form) {
		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater('operationInfo',
					"Main.php?do=planningIndicatorsDoEditX",
					{
						method: 'post',
						parameters: { action: "planningIndicatorsDoEditX"},
						postBody: fields,
						evalScripts: true
					});
		$('operationInfo').innerHTML = '<span class="inProgress">Procesando información</span><img src="images/spinner.gif" />'
		return false;
	}
	function createIndicatorAfterValidateFormClienSide(form) {
		var success = validationValidateFormClienSide(form, false);
		if (success) {
			createIndicator(form);
			clearFormFieldsFormat(form);
		}
	}
</script>
	
	<form name="form_edit_indicator" id="form_edit_indicator" action="Main.php" method="post">
		<fieldset title="Formulario de edición de datos de un Indicador">
			<legend>Formulario de Creación de Indicadores</legend>
			<div id="operationInfo"></div>
		<p>
        <label for="params_name">Nombre</label>
      <input name="params[name]" type="text" id="params_name" size="80" value="|-$planningIndicator->getName()-|" title="Nombre del Indicador" maxlength="255" class="emptyValidation" |-$readonly|readonly-| /> |-validation_msg_box idField="params_name"-|
      </p>
		<p>
			<label for="params_type">Tipo</label>
			<select id="params_type" name="params[type]" title="Tipo de indicador" |-$readonly|readonly-|>
				<option value="">Seleccione el Tipo de indicador</option>
				|-foreach from=$indicatorTypes key=key item=name-|
							<option value="|-$key-|" |-$planningIndicator->getType()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>
		</p>
    <p> 
      <label for="params_description">Descripción</label>
      <textarea name="params[description]" cols="70" rows="6" wrap="VIRTUAL" id="params_description" type="text" title="Descripción del Indicador" |-$readonly|readonly-| >|-$planningIndicator->getDescription()|escape-|</textarea> |-validation_msg_box idField="params_description"-|
    </p>			<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
			<p>
				<input type="hidden" name="do" id="do" value="planningIndicatorsDoEditX" />
				<input type="button" id="button_edit_indicator" name="button_edit_indicator" title="Aceptar" value="Agregar nuevo" onClick="javascript:createIndicatorAfterValidateFormClienSide(this.form)"/>
				<a href="#" class="lbAction noDecoration" rel="deactivate"><input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" /></a> 
			</p>
		</fieldset>
	</form>