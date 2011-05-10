<h2>##40,Configuración del Sistema##</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Puerto</h1>
<div id="div_port">
	<form name="form_edit_port" id="form_edit_port" action="Main.php" method="post">
		|-if $message eq "error"-|
			<div class="failureMessage">Ha ocurrido un error al intentar guardar el port</div>
		|-/if-|
		<p>|-if $action eq 'edit'-|Modifique los datos del Puerto y haga click en "Aceptar" para guardar el cambio|-else-|Ingrese los datos del Puerto y haga click en "Aceptar" para guardar el Puerto|-/if-|.
		</p>
		<fieldset title="Formulario de edición de datos de un port">
			<legend>Puerto</legend>
			<p>
				<label for="code">Código</label>
					<input name="code" type="text" id="code" title="code" value="|-if $action eq 'edit'-||-$port->getcode()-||-/if-|" size="15" maxlength="255" />
		</p>
				<p>
				<label for="name">Nombre</label>
				<input name="name" type="text" id="name" title="name" value="|-if $action eq 'edit'-||-$port->getname()-||-/if-|" size="50" maxlength="255" />
		</p>
		<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$port->getid()-||-/if-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="importPortsDoEdit" />
				<input type="submit" id="button_edit_port" name="button_edit_port" title="Aceptar" value="Aceptar" class="button" />
			</p>
		</fieldset>
	</form>
</div>
