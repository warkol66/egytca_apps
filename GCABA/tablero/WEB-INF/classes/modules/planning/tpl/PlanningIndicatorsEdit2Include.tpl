<script type="text/javascript" >
	function createIndicator(form) {
		var fields = $(form).serialize();
		$.ajax({
			url: 'Main.php?do=planningIndicatorsDoEditX',
			data: fields+'&action=planningIndicatorsDoEditX&type=json',
			type: 'post',
			dataType: 'json',
			success: function(data) {
				console.log(data);
				var newElem = {};
				newElem[data.Id] = data.Name;
				console.log(newElem);
				$('#autocomplete_indicators').data('setElem')(newElem);
			}
		});
		$('#operationInfo').html('<span class="inProgress">Procesando información</span><img src="images/spinner.gif" />');
		return false;
	}
	
	function createIndicatorAfterValidateFormClienSide(form) {
		var success = validationValidateFormClienSide(form, false);
		if (success) {
			createIndicator(form);
			clearFormFieldsFormat(form);
			$.fancybox.close();
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
      <textarea name="params[description]" cols="70" rows="3" wrap="VIRTUAL" id="params_description" type="text" title="Descripción del Indicador" |-$readonly|readonly-| >|-$planningIndicator->getDescription()|escape-|</textarea> 
      |-validation_msg_box idField="params_description"-|
    </p>		
		<p>
        <label for="params_formula">Fórmula</label>
      <input name="params[formula]" type="text" id="params_formula" size="80" value="|-$planningIndicator->getFormula()-|" title="Fórmula del Indicador" maxlength="100" class="emptyValidation" |-$readonly|readonly-| /> |-validation_msg_box idField="params_formula"-|
      </p>		
		<p>
        <label for="params_dataSources">Fuentes de datos utilizados</label>
      <input name="params[dataSources]" type="text" id="params_dataSources" size="80" value="|-$planningIndicator->getDataSources()-|" title="Fuentes de datos utilizados" maxlength="100" class="emptyValidation" |-$readonly|readonly-| /> |-validation_msg_box idField="params_dataSources"-|
      </p>		
		<p>
        <label for="params_measureFrecuency">Frecuencia de medición</label>
			<select id="params_measureFrecuency" name="params[measureFrecuency]" title="Frecuencia de Medición" |-$readonly|readonly-|>
				<option value="">Seleccione la Frecuencia de medición</option>
				|-foreach from=$measureFrecuencyTypes key=key item=name-|
							<option value="|-$key-|" |-$planningIndicator->getMeasureFrecuencyTypes()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>      
      </p>		
		<p>
        <label for="params_dataResponsible">Responsable de datos</label>
      <input name="params[dataResponsible]" type="text" id="params_dataResponsible" size="80" value="|-$planningIndicator->getDataResponsible()-|" title="Responsable de datos" maxlength="255" class="emptyValidation" |-$readonly|readonly-| /> |-validation_msg_box idField="params_dataResponsible"-|
      </p>		
		<p>
			<label for="params_expectedResults">Resultados Esperados</label>
			<select id="params_expectedResults" name="params[expectedResults]" title="Resultados Esperados" |-$readonly|readonly-|>
				<option value="">Seleccione el Resultado Esperado</option>
				|-foreach from=$expectedResultsTypes key=key item=name-|
							<option value="|-$key-|" |-$planningIndicator->getExpectedResultsTypes()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>
		</p>	
		<p>
        <label for="params_realValue">Valor real</label>
      <input name="params[realValue]" type="text" id="params_realValue" size="80" value="|-$planningIndicator->getRealValue()-|" title="Valor Real" maxlength="100" class="emptyValidation" |-$readonly|readonly-| /> |-validation_msg_box idField="params_realValue"-|
      </p>	
	<p>
        <label for="params_measureTaken">¿Se realizó la medición?</label>
      <input name="params[measureTaken]" type="checkbox" id="params_measureTaken" |-$planningIndicator->getMeasureTaken()|checked_bool-|  value="|-$planningIndicator->getMeasureTaken()-|" title="Se realizó la medición?" |-$readonly|readonly-|/>
      <input name="params[measureTaken]" type="hidden" value="0"/>
    </p>
	<p>     
		<label for="params_updated">Fecha de Actualización</label>
		<input id="params_updated" name="params[updated]" type='text' value='|-$planningIndicator->getUpdated()|date_format-|' size="12" title="Ingrese la fecha de Actualización en el formato dd-mm-aaaa"  |-$readonly|readonly-|/><!--|-if !$show && !$showLog-| <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[updated]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha de Actualización">|-/if-|-->
	</p>
	<p id="projectAndDirect" style="display:none;"> 
		<label for="params_goal2013">Meta 2013</label>
		<input name="params[goal2013]"  id="params_goal2013" type="text" value="|-$planningIndicator->getGoal2013()|escape-|" size="4" title="Magnitud del resultado esperado para 2013">
			<select id="params_goaltype" name="params[expectedResults]" title="Resultados Esperados" |-$readonly|readonly-|>
				<option value="">Tipo de Meta</option>
				|-foreach from=$goalTypes key=key item=name-|
							<option value="|-$key-|" |-$planningIndicator->getGoalType()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>
		<input name="params[value]"  id="params_value" type="text" value="|-$planningIndicator->getValue()|escape-|" size="3" title="Cantidad">
		<input name="params[measureUnitId]"  id="params_measureUnitId" type="text" value="|-$planningIndicator->getMeasureUnitId()|escape-|" size="3" title="Unidad de medida">
		
			<select id="params_trend" name="params[trend]" title="Tendencia Esperada" |-$readonly|readonly-|>
				<option value="">Tendencia</option>
				|-foreach from=$trendTypes key=key item=name-|
							<option value="|-$key-|" |-$planningIndicator->getTrend()|selected:$key-|>|-$name-|</option>
				|-/foreach-|
			</select>
	</p>
	
		|-*<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>*-|
			<p>
				<input type="hidden" name="do" id="do" value="planningIndicatorsDoEditX" />
				<input type="button" id="button_edit_indicator" name="button_edit_indicator" title="Aceptar" value="Agregar nuevo" onClick="javascript:createIndicatorAfterValidateFormClienSide(this.form)"/>
				<a href="#" class="lbAction noDecoration" rel="deactivate"><input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" /></a> 
			</p>
		</fieldset>
	</form>

<script type="text/javascript">
	var selectType = document.getElementById("params_type");
	selectType.onchange = function() {
		var chosenOption = this.options[this.selectedIndex];
		switch(chosenOption.value) {
			case '1':
			case '3':
				$('#projectAndDirect').show();
				break;
			case '2':
				$('#projectAndDirect').hide();
				break;
			default:
				$('#projectAndDirect').hide();
				alert('default');
			}
	}
</script>