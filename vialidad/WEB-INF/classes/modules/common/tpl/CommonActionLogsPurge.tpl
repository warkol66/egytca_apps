<script src="scripts/datePicker.js"></script>
<h2>Histórico de Operaciones</h2>
<h1>Eliminar Histórico de Operaciones</h1>
 <form name="formPurge" method="get" action="Main.php" style='margin-top:10px'> 
	<input type='hidden' name='do' value='commonActionLogsDoPurge' /> 
	<fieldset title="Opciones para eliminar registros históricos">
		<legend>Purga de Datos</legend>
		<p>Ingrese el período para el cual quiere purgar los datos</p> 
			<p><label for="dateFrom">Fecha Desde</label>
		<input name="dateFrom" type="text" value="|-$dateFrom|date_format-|" size="10"> 
<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('dateFrom', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
		</p> 
		 <p> 
			<label for="dateTo">Fecha Hasta</label>
		<input name="dateTo" type="text" value="|-$dateTo-|" size="10"> 
<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('dateTo', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
		</p> 
			<p><input name="purgar" type="submit" id="btnGuardar" value="Purgar" onclick="return confirm('¿Está seguro que desea eliminar los registros del período seleccionado?');"> 
				<input name="btnRegresar" type="button" id="regresar" value="Regresar" onclick="location.href='Main.php?do=commonActionLogsList'" />
			</p> 
	 </fieldset> 
</form> 
