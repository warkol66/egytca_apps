<div id="themeCreationDiv" style="display: none;">
	<form name="form_edit_theme" id="themeCreationForm" action="Main.php" method="post">
		<p>Ingrese los datos del Motivo a Crear</p>
		<fieldset title="Formulario Creacion de un Motivo">
				<legend>Creacion de Motivo</legend>
			<p>
				<label for="name">Nombre</label>
				<input name="name" type="text" id="name" title="name" value="" size="45" maxlength="100" />
			</p>
			<p>
				<label for="shortName">Nombre Corto</label>
				<input name="shortName" type="text" id="shortName" title="shortName" value="" size="15" maxlength="100" />
			</p>
			<p>
				<label for="startDate">Fecha de Inicio</label>
					<input name="startDate" type="text" id="startDate" title="Fecha de Inicio" value="|-$smarty.now|date_format:"%d-%m-%Y"-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('startDate', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="duration">Duración</label>
				<input name="duration" type="text" id="duration" title="duration" value="" size="8" />
			</p>
			<p>
				<label for="type">Tipo</label>
				<select id="type" name="type">
					<option value="">Seleccione un Tipo</option>
					<option value="1">Doble</option>
					<option value="2">Séxtuple</option>
				</select>								
			</p>
			<p>
				<label for="clientId">Cliente</label>
				<select id="clientId" name="clientId" title="clientId">
					<option value="">Seleccione un Cliente</option>
									|-foreach from=$clients item=object-|
									<option value="|-$object->getid()-|" >|-$object->getname()-|</option>
									|-/foreach-|
								</select>
							</p>
			<p>
				<label for="sheetsTotal">Cantidad Total de Afiches</label>
				<input name="sheetsTotal" type="text" id="sheetsTotal" title="sheetsTotal" value="" size="8" />
			</p>
			<p>
				|-if $action eq "edit"-|
				<input type="hidden" name="id" id="id" value="" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="create" />
				<input type="hidden" name="do" id="do" value="lausiThemesDoEdit" />
				<input type="button" id="button_edit_theme" name="button_edit_theme" title="Aceptar" value="Crear Motivo" onClick="lausiThemeCreationX(this.form)"/>
				<span id="msgboxCreation"></span>
			</p>
			<p>
				<input type="hidden" name="actionType" value="ajax" />
				<input type="button" id="button_edit_theme" name="button_edit_theme" title="Aceptar" value="Cancelar Creacion"  onClick="lausiThemeCreationCancel(this.form)"/>
			</p>
			</fieldset>
	</form>
</div>
