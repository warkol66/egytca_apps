<h2>Administración de Motivos</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Motivos</h1>
<p>A continuación se muestra el formulario de datos de motivos. Para ingresar un nuevo motivo, escriba la información y pulse "Guardar". Para modificar un motivo, puede editar los campos y pulsar "Guardar" para aceptar las modificaciones. Para regresar sin hacer cambios, pulse "Cancelar".</p>
<div id="div_theme">
	|-if $message eq "error"-|
		<div class="successMessage">Ha ocurrido un error al intentar guardar el Motivo</div>
	|-/if-|
	<form name="form_edit_theme" id="form_edit_theme" action="Main.php" method="post">
		<p>Ingrese los datos del Motivo a |-if $action eq "edit"-|editar|-else-|crear|-/if-|</p>
		<fieldset title="Formulario de edición de datos de un motivo">
				<legend>Motivo</legend>
				<p>Ingrese la información referente al motivo</p>
			<p>
				<label for="name">Nombre</label>
				<input name="name" type="text" id="name" title="Nombre del motivo" value="|-$theme->getname()-|" size="45" maxlength="100" />
			</p>
			<p>
				<label for="shortName">Nombre corto</label>
				<input name="shortName" type="text" id="shortName" title="Nombre corto del motivo para ser utilizado en listados" value="|-$theme->getshortName()-|" size="15" maxlength="100" />
			</p>
			<p>
				<label for="startDate">Fecha de inicio</label>
					<input name="startDate" type="text" id="startDate" title="Fecha de inicio de publicación" value="|-$theme->getstartDate()|date_format:"%d-%m-%Y"-|" size="12" /> 
					<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('startDate', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="duration">Duración</label>
				<input name="duration" type="text" id="duration" title="Duración de la publicación del motivo" value="|-$theme->getduration()-|" size="8" />
			</p>
			<p>
				<label for="type">Tipo</label>
				<select id="type" name="type" title="Tipo de motivo (Doble o séxtuple)">
					<option value="">Seleccione un Tipo</option>
					<option value="1"|-if $theme->getType() eq "1"-|selected="selected" |-/if-|>Doble</option>
					<option value="2"|-if $theme->getType() eq "2"-|selected="selected" |-/if-|>Séxtuple</option>
				</select>								
			</p>
			<p>
				<label for="clientId">Cliente</label>
				<select id="clientId" name="clientId" title="Seleccione el cliente">
					<option value="">Seleccione un Cliente</option>
					|-foreach from=$clientIdValues item=object-|
					<option value="|-$object->getid()-|" |-if $theme->getclientId() eq $object->getid()-|selected="selected" |-/if-|>|-$object->getname()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				<label for="sheetsTotal">Cantidad Total de Afiches</label>
				<input name="sheetsTotal" type="text" id="sheetsTotal" title="Cantidad de afiches a publicar" value="|-$theme->getSheetsTotal()-|" size="8" />
			</p>
			<p>
				|-if $action eq "edit"-|
				<input type="hidden" name="id" id="id" value="|-$theme->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="lausiThemesDoEdit" />
				<input type="submit" id="button_edit_theme" name="button_edit_theme" title="Aceptar" value="Aceptar" />
				<input type='button' onClick='location.href="Main.php?do=lausiThemesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='Cancelar' title="Regresar al listado de motivos"/>
		</p>
		</fieldset>
	</form>
</div>