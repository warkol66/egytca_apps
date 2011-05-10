<h2>Pedidos</h2>
<h1>Administrar plantillas de pedido</h1>
<p>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Plantilla de pedidos</p>
<div id="div_ordertemplate">
	<form name="form_edit_ordertemplate" id="form_edit_ordertemplate" action="Main.php" method="post">
		|-if $message eq "error"-|
			<span class="message_error">Ha ocurrido un error al intentar guardar el order template</span>
		|-/if-|
		<p>
			Ingrese los datos del order template.
		</p>
		<fieldset title="Formulario de edición de datos de un order template">
																															<p>
				<label for="name">Nombre</label>
					<input name="name" type="text" id="name" title="name" value="|-if $action eq 'edit'-||-$ordertemplate->getname()-||-/if-|" size="45" maxlength="255" />
				</p>
				<p>
				<label for="created">Creada</label>
					<input name="created" type="text" id="created" title="created" value="|-if $action eq 'edit'-||-$ordertemplate->getcreated()-||-/if-|" size="15" />
		</p>
			<p>
				<label for="userId">Usuario</label>
				<input name="userId" type="text" id="userId" title="userId" value="|-if $action eq 'edit'-||-$ordertemplate->getuserId()-||-/if-|" size="35" />
		</p>
			<p>
				<label for="affiliateId">Mayorista</label>
				<input name="affiliateId" type="text" id="affiliateId" title="affiliateId" value="|-if $action eq 'edit'-||-$ordertemplate->getaffiliateId()-||-/if-|" size="45" />
		</p>
			<p>
				<label for="branchId">Sucursal</label>
					<input name="branchId" type="text" id="branchId" title="branchId" value="|-if $action eq 'edit'-||-$ordertemplate->getbranchId()-||-/if-|" size="45" />
		</p>
			<p>
				<label for="total">Total</label>
					<input name="total" type="text" id="total" title="total" value="|-if $action eq 'edit'-||-$ordertemplate->gettotal()-||-/if-|" size="15" />
		</p>
		<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="id" id="id" value="|-if $action eq 'edit'-||-$ordertemplate->getid()-||-/if-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="ordersTemplatesDoEdit" />
				<input type="submit" id="button_edit_ordertemplate" name="button_edit_ordertemplate" title="Aceptar" value="Aceptar" />
			</p>
		</fieldset>
	</form>
</div>
