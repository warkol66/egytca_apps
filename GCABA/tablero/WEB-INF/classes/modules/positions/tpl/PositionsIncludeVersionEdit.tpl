<form name="form_edit_position_version" id="form_edit_position_version" action="Main.php" method="post">
	<fieldset title="Formulario de edición de versiones de organigramas">
    	<legend>Ingrese los datos de la versión</legend>
		<p>
			<label for="positionVersionData_dateFrom">Fecha desde la cual es válido el organigrama</label>
			<input name="positionVersionData[dateFrom]" type="text" id="positionVersionData_dateFrom" value="|-$positionVersion->getDateFrom()|date_format:"%d-%m-%Y"-|" size="12" maxlength="20" />
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('positionVersionData[dateFrom]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">					
		</p>	
	
		<p>
			<label for="positionVersionData_dateTo">Fecha hasta la cual es válido el organigrama</label>
			<input name="positionVersionData[dateTo]" type="text" id="positionVersionData_dateTo" value="|-$positionVersion->getDateTo()|date_format:"%d-%m-%Y"-|" size="12" maxlength="20" />
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('positionVersionData[dateTo]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
		</p>

		<p>
			<label for="positionVersionData_description">Información sobre el organigrama</label>
			<textarea name="positionVersionData[description]" id="positionVersionData_description">|-$positionVersion->getDescription()-|</textarea>
		</p>	
		
		|-*if $positionVersion->getId() ne ""*-|
			<input type="hidden" name="id" id="id" value="|-$positionVersion->getId()-|" />
		|-*/if*-|
			<input type="hidden" name="do" id="do" value="positionsVersionsDoEdit" />
			<p>
			<input type="submit" id="button_edit_position_version" name="button_edit_position_version" title="Aceptar" value="Aceptar" />
		</p>
	</fieldset>
</form>	