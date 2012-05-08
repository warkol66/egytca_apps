<h2>##common,18,Configuración del Sistema##</h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Communa</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>A continuación podrá |-if $action eq "edit"-|editar|-else-|crear|-/if-| una Communa del sistema.</p>
<div id="div_commune">
	<form name="form_edit_commune" id="form_edit_commune" action="Main.php" method="post">
		|-if $message eq "error"-|<div class="message_error">Ha ocurrido un error al intentar guardar la comuna.</div>|-/if-|
		<fieldset title="Formulario de edición de datos de un commune">
     <legend>Ingrese los datos del Comuna</legend>
					<label for="name">Nombre</label>
						<input name="name" type="text" id="name" title="name" value="|-if $action eq 'edit'-||-$commune->getname()-||-/if-|" size="60" maxlength="100" />
			|-if $action eq "edit"-|
				<input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$commune->getid()-||-/if-|" />
			|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="tableroCommunesDoEdit" />
				<br>
				<input type="submit" id="button_edit_commune" name="button_edit_commune" title="Aceptar" value="Aceptar" />
		</fieldset>
	</form>
</div>
