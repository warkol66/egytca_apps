<h2>Boletines</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Bolet&iacute;n</h1>
<div id="div_bulletin">
	<p>Ingrese los datos del Bolet&iacute;n</p>
	|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el Bolet&iacute;n</span>|-/if-|
	<form name="form_edit_bulletin" id="form_edit_bulletin" action="Main.php" method="post">
		<fieldset title="Formulario de edici&oacute;n de datos de un Bolet&iacute;n">
			<legend>Formulario de Administraci&oacute;n de Boletines</legend>
			<p>
				<label for="params[name]">N&uacute;mero</label>
				<input type="text" id="params[number]" name="params[number]" size="10" value="|-$bulletin->getNumber()|escape-|" title="N&uacute;mero" /><img src="images/clear.png" class="mandatoryField" title="Campo obligatorio" />
			</p>
			<p>     
				<label for="params[bulletinDate]">Fecha del Bolet&iacute;n</label>
				<input id="params[bulletinDate]" name="params[bulletinDate]" type='text' value='|-$bulletin->getBulletinDate()-|' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[bulletinDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-$bulletin->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="vialidadBulletinDoEdit" />
				<input type="submit" id="button_edit_bulletin" name="button_edit_bulletin" title="Aceptar" value="Guardar" />
				<input type="button" id="cancel" name="cancel" title="Cancelar" value="Cancelar" onClick="location.href='Main.php?do=vialidadBulletinList'"/>
			</p>
		</fieldset>
	</form>
</div>
