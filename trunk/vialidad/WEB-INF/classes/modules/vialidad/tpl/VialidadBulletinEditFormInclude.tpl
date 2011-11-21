<form name="form_edit_bulletin" id="form_edit_bulletin" action="Main.php" method="post">
	<fieldset title="Formulario de edición de datos de un Boletín">
		<legend>Formulario de Administración de Boletines</legend>
		<p>
			<label for="params[number]">Número</label>
			<input type="text" id="params[number]" name="params[number]" size="10" value="|-$bulletin->getNumber()|escape-|" title="N&uacute;mero" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
		</p>
		<p>     
			<label for="params[bulletinDate]">Fecha del Boletín</label>
			<input id="params[bulletinDate]" name="params[bulletinDate]" type='text' value='|-$bulletin->getBulletinDate()|date_format-|' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[bulletinDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
		</p>
	<p>     
			<label for="params[comments]">Observaciones</label>
			<textarea name="params[comments]" cols="60" wrap="VIRTUAL" id="params[comments]" title="Observaciones">|-$bulletin->getComments()|escape-|</textarea>
		</p>
	<p>     
			<label for="params[published]">Publicado</label>
			<input name="params[published]" type="hidden" value="0">
			<input name="params[published]" type="checkbox" value="1" |-$bulletin->getPublished()|checked_bool-| title="Indica si el boletín acepta modificaciones o no">
		</p>
		<p>
			|-if $action eq 'edit'-|
			<input type="hidden" name="id" id="id" value="|-$bulletin->getid()-|" />
			|-/if-|
			|-if $action eq 'copy'-|
			<input type="hidden" name="lastBulletinId" value="|-$lastBulletinId-|" />
			|-/if-|
			<input type="hidden" name="action" id="action" value="|-$action-|" />
			<input type="hidden" name="do" id="do" value="|-$do-|" />
			<input type="submit" id="button_edit_bulletin" name="button_edit_bulletin" title="Aceptar" value="Guardar" />
			<input type="button" id="cancel" name="cancel" title="Regresar" value="Regresar" onClick="location.href='Main.php?do=vialidadBulletinList'"/>
		</p>
	</fieldset>
</form>