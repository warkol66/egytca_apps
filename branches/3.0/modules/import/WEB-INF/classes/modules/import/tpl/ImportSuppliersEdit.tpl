<h2>##40,Configuración del Sistema##</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Proveedor</h1>
<div id="div_supplier">
	<form name="form_edit_supplier" id="form_edit_supplier" action="Main.php" method="post">
		|-if $message eq "error"-|
			<div class="failureMessage">Ha ocurrido un error al intentar guardar el proveedor</div>
		|-/if-|
		<p>|-if $action eq 'edit'-|Modifique los datos del Proveedor y haga click en "Aceptar" para guardar el cambio|-else-|Ingrese los datos del Proveedor y haga click en "Aceptar" para guardar el Proveedor|-/if-|.
		</p>
		<fieldset title="Formulario de edición de datos de un proveedor">
			<legend>Proveedores</legend>
			<p>
				<label for="name">Nombre</label>
				<input name="supplier[name]" type="text" id="supplier[name]" title="name" value="|-if $action eq 'edit'-||-$supplier->getname()-||-/if-|" size="75" maxlength="255" />
			</p>
			<p>
				<label for="address">Dirección</label>
				<input name="supplier[address]" type="text" id="address" title="Dirección" value="|-if $action eq 'edit'-||-$supplier->getAddress()-||-/if-|" size="60" maxlength="255" />
			</p>
			<p>
				<label for="phoneNumber">Teléfono</label>
				<input name="supplier[phoneNumber]" type="text" id="phoneNumber" title="Teléfono" value="|-if $action eq 'edit'-||-$supplier->getPhoneNumber()-||-/if-|" size="60" maxlength="255" />
			</p>
			<p>
				<label for="name">E-Mail</label>
				<input name="supplier[email]" type="text" id="email" title="E-Mail" value="|-if $action eq 'edit'-||-$supplier->getEmail()-||-/if-|" size="60" maxlength="255" />
			</p>
			<p>
				<label for="contactName">Nombre de Contacto</label>
				<input name="supplier[contactName]" type="text" id="contactName" title="Nombre de Contacto" value="|-if $action eq 'edit'-||-$supplier->getContactName()-||-/if-|" size="60" maxlength="255" />
			</p>
			<p>
				<label for="defaultIncotermId">Incoterm por defecto</label>
				<select name="supplier[defaultIncotermId]" id="supplier[defaultIncotermId]">
					<option value="">Seleccione un Incoterm</option>
					|-foreach from=$incoterms item=incoterm name=for_incoterms-|
						<option value="|-$incoterm->getId()-|" |-if $incoterm->getId() eq $supplier->getDefaultIncotermId()-|selected="selected"|-/if-|>|-$incoterm->getName()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				<label for="defaultPortId">Puerto por defecto</label>
				<select name="supplier[defaultPortId]" id="supplier[defaultPortId]">
					<option value="">Seleccione un Puerto</option>
					|-foreach from=$ports item=port name=for_ports-|
						<option value="|-$port->getId()-|" |-if $port->getId() eq $supplier->getDefaultPortId()-|selected="selected"|-/if-|>|-$port->getName()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="supplier[id]" id="supplier[id]" value="|-if $action eq 'edit'-||-$supplier->getid()-||-/if-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="importSuppliersDoEdit" />
				<input type="submit" id="button_edit_supplier" name="button_edit_supplier" title="Aceptar" value="Aceptar" />
			</p>
		</fieldset>
	</form>
</div>
