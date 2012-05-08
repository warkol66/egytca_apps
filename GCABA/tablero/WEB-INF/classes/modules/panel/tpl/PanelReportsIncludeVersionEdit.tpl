|-include file="CommonEditTinyMceInclude.tpl" elements="reportVersionData[description]" plugins="safari,style,table,advlink,inlinepopups,media,contextmenu,paste,nonbreaking"-|
<form name="form_edit_report_version" id="form_edit_report_version" action="Main.php" method="post">
	<fieldset title="Formulario de edición de versiones de reportes">
    	<legend>Ingrese los datos de la versión</legend>
		<p>
			<label for="reportVersionData[dateFrom]">Fecha desde la cual es válido el reporte</label>
			<input name="reportVersionData[dateFrom]" type="text" id="reportVersionData_dateFrom" value="|-$reportVersion->getDateFrom()|date_format:"%d-%m-%Y"-|" size="12" maxlength="20" />
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('reportVersionData[dateFrom]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">					
		</p>	
	
		<p>
			<label for="reportVersionData[dateTo]">Fecha hasta la cual es válido el reporte</label>
			<input name="reportVersionData[dateTo]" type="text" id="reportVersionData_dateTo" value="|-$reportVersion->getDateTo()|date_format:"%d-%m-%Y"-|" size="12" maxlength="20" />
			<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('reportVersionData[dateTo]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
		</p>

		<p>
			<label for="reportVersionData[name]">Nombre</label>
			<input name="reportVersionData[name]" type="text" id="reportVersionData_description" value="|-$reportVersion->getName()|escape-|" size="50" />
		</p>	
		<p>
			<label for="reportVersionData[description]">Información sobre el reporte</label>
			<textarea name="reportVersionData[description]" cols="50" rows="8" id="reportVersionData[description]">|-$reportVersion->getDescription()|escape-|</textarea>
		</p>
		
		|-if $action eq 'create' && $latestVersionId gt 0-|
		<p>
			<label for="replicate">Crear a partir de versión anterior</label>
			<input name="replicate" type="checkbox" id="replicate" checked="checked" />
			
		</p>	
		|-/if-|
		
		|-*if $reportVersion->getId() ne ""*-|
			<input type="hidden" name="id" id="id" value="|-$reportVersion->getId()-|" />
		|-*/if*-|
			<input type="hidden" name="do" id="do" value="panelReportsVersionsDoEdit" />
			<br />
			<input type="submit" id="button_edit_report_version" name="button_edit_report_version" title="Aceptar" value="Aceptar" />
		</p>
	</fieldset>
</form>	