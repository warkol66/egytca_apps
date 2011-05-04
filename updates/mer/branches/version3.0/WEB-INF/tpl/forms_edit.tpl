				<div id="div_form">
					<form name="form_edit_form" id="form_edit_form" action="Main.php" method="post">
						|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el form</span>|-/if-|
						<h3>|-if $action eq "edit"-|Edit|-else-|Create|-/if-| Form</h3>
						<p>
							Ingrese los datos del form.
						</p>
						<fieldset title="Formulario de edición de datos de un form">
							<p>
								<label for="name">Name</label>
								<input type="text" id="name" name="name" value="|-if $action eq "edit"-||-$form->getname()-||-/if-|" title="name" maxlength="255" />
							</p>
							<p>
								<label for="relationship">Relationship?</label>
								<select name="relationship">
									<option value="0"|-if $action eq "edit" and $form->getrelationship() ne 1-| selected="selected"|-/if-|>No</option>
									<option value="1"|-if $action eq "edit" and $form->getrelationship() eq 1-| selected="selected"|-/if-|>Yes</option>
								</select>
							</p>
							<p>
							|-if $action eq "edit"-|
								<input type="hidden" name="id" id="id" value="|-if $action eq "edit"-||-$form->getid()-||-/if-|" />
							|-/if-|
								<input type="hidden" name="action" id="action" value="|-$action-|" />
								<input type="hidden" name="do" id="do" value="formsDoEdit" />
								<input type="submit" id="button_edit_form" title="Aceptar" value="Aceptar" class="boton" />
							</p>
			      </fieldset>
					</form>
				</div>
