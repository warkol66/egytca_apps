<h2>Configuración del Sistema</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Barrio</h1>
<div id="div_region">
	<form name="form_edit_region" id="form_edit_region" action="Main.php" method="post">
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el Barrio</span>|-/if-|
		<p>
			Ingrese los datos del Barrio.
		</p>
		<fieldset title="Formulario de edición de datos de un Barrio">
			<p>
				<label for="name">Nombre</label>
				<input type="text" id="name" name="name" value="|-$region->getname()-|" title="name" maxlength="100" />
			</p>
			<p>
				|-if $action eq "edit"-|
				<input type="hidden" name="id" id="id" value="|-$region->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="lausiRegionsDoEdit" />
				<input type="submit" id="button_edit_region" name="button_edit_region" title="Aceptar" value="Aceptar" />
			</p>
				</fieldset>
	</form>
</div>