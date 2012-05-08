<h2>Tablero de Gestión
|-if isset($show)-|
 - <a href="Main.php?do=tableroObjectivesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
<h1>Administración de Objetivos - Purgar Historial del Objetivo</h1>
<p class='paragraphEdit'>A continuación puede purgar el historial de cambios del objetivo. Elija una fecha antes de la cual desee eliminar el historial.</p>
|-if $message eq "success"-|
	<div class="resultSuccess">
		La operación se realizó con éxito.
	</div>
|-/if-|
<form name="form_edit_objective" id="form_edit_objective" action="Main.php" method="post">
	<fieldset title="Formulario de limpieza del historial">
		<p> 
      		<label for="date">Eliminar historial hasta: </label> 
      		<input name="date" type="text" id="date" title="date" value="|-$defaultDate-|"/> 
      		<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('date', false, '|-$datePickerDateFormat-|', '-');" title="Seleccione la fecha"> 
      	</p>
		<input type="hidden" name="do" id="do" value="objectivesDoPurgeLogs" /> 
		<input type="submit" id="button_purge_logs" name="button_purge_logs" title="Aceptar" value="Aceptar" onClick="return confirm('¿Está seguro que desea eliminar todo el historial hasta la fecha seleccionada?');"/> 
		<input type="button" id="button_return_objective" name="button_return_objective" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=objectivesList'" />
	</fieldset>
</form>