<h2>##common,18,Configuración del Sistema##</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Barrio</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>A continuación podrá |-if $action eq "edit"-|editar|-else-|crear|-/if-| un barrio del sistema.</p>
<div id="div_region">
	<form name="form_edit_region" id="form_edit_region" action="Main.php" method="post">
		|-if $message eq "error"-|<div class="errorMessage">Ha ocurrido un error al intentar guardar el barrio </div>|-/if-|
		<fieldset title="Formulario de edición de datos de un region">
     <legend>Ingrese los datos del Barrio</legend>
				<label for="name">Nombre</label>
				<input name="name" type="text" id="name" title="name" value="|-if $action eq 'edit'-||-$region->getname()-||-/if-|" size="60" maxlength="100" />
				|-if $action eq "edit"-|
				<input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$region->getid()-||-/if-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="tableroRegionsDoEdit" />
				<br>
				<input type="submit" id="button_edit_region" name="button_edit_region" title="Aceptar" value="Aceptar" />
		</fieldset>
	</form>
</div>
