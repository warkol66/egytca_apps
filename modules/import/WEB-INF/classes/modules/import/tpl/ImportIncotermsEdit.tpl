<h2>##40,Configuración del Sistema##</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Creaer|-/if-| Incoterm</h1>
<div id="div_incoterm">
	<form name="form_edit_incoterm" id="form_edit_incoterm" action="Main.php" method="post">
		|-if $message eq "error"-|
			<span class="failureMessage">Ha ocurrido un error al intentar guardar el incoterm</span>
		|-/if-|
		<p>|-if $action eq 'edit'-|Modifique los datos del Incoterm y haga click en "Aceptar" para guardar el cambio|-else-|Ingrese los datos del Incoterm y haga click en "Aceptar" para guardar el incoterm|-/if-|.
		</p>
		<fieldset title="Formulario de edición de datos de un incoterm">
			<legend>Incoterms</legend>
																															<p>
				<label for="name">Nombre</label>
																				<input name="name" type="text" id="name" title="name" value="|-if $action eq 'edit'-||-$incoterm->getname()-||-/if-|" size="9" maxlength="255" />
																			</p>
										<p>
				<label for="description">Descripción</label>
																				<input name="description" type="text" id="description" title="description" value="|-if $action eq 'edit'-||-$incoterm->getdescription()-||-/if-|" size="35" maxlength="255" />
		</p>
										<p>
												|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$incoterm->getid()-||-/if-|" />
				|-/if-|
												<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="importIncotermsDoEdit" />
				<input type="submit" id="button_edit_incoterm" name="button_edit_incoterm" title="Aceptar" value="Aceptar" class="boton" />
			</p>
		</fieldset>
	</form>
</div>
