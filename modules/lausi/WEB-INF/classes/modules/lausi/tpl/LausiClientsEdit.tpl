<h2>Administración de Clientes </h2>
<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| Cliente</h1>
<p>A continuación se muestra el formulario de datos de clientes. Para ingresar un nuevo cliente, escriba la información y pulse "Guardar". Para modificar un cliente, puede editar los campos y pulsar "Guardar" para aceptar las modificaciones. Para regresar sin hacer cambios, pulse "Cancelar".</p>
<div id="div_client">
	<form name="form_edit_client" id="form_edit_client" action="Main.php" method="post">
		|-if $message eq "error"-|<span class="message_error">Ha ocurrido un error al intentar guardar el cliente</span>|-/if-|
		<fieldset title="Formulario de edición de datos de un cliente">
			<legend>Clientes</legend>
		<p>
			Ingrese los datos del cliente.
		</p>
			<p>
				<label for="name">Nombre</label>
				<input name="name" type="text" id="name" title="Nombre del cliente" value="|-$client->getname()-|" size="60" maxlength="100" />
			</p>
			<p>
				<label for="contact">Contacto</label>
				<input name="contact" type="text" id="contact" title="Datos de contacto" value="|-$client->getcontact()-|" size="50" maxlength="100" />
			</p>
			<p>
				|-if $action eq "edit"-|
				<input type="hidden" name="id" id="id" value="|-$client->getid()-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="lausiClientsDoEdit" />
				<input type="submit" id="button_edit_client" name="button_edit_client" title="Aceptar" value="Aceptar" />
				<input type='button' onClick='location.href="Main.php?do=lausiClientsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='Cancelar' title="Regresar al listado de clientes"/>
			</p>
				</fieldset>
	</form>
</div>
