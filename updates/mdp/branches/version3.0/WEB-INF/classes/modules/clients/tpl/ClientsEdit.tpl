<h2>##clients,1,Clientes##</h2>
	<h1>Administración de ##clients,1,Clientes## - |-if $action eq 'create'-|Crear|-else-|Editar|-/if-| ##clients,3,Cliente##</h1>
|-if $action eq 'create'-|	
	<p>A continuación podrá ingresar los datos para crear el ##clients,3,Cliente##.</p>
|-else-|		
	<p>A continuación podrá editar los datos del ##clients,3,Cliente##.</p>
|-/if-|
	<fieldset title="Formulario de edición de nombre del Cliente">
		<legend>##clients,1,Clientes##</legend>
		<p>Realice los cambios y para guardar haga click en "Guardar Cambios"</p>
			<form method="post" action="Main.php?do=clientsDoEdit">
			<input type="hidden" value="|-$action-|" name="action">
			<input type="hidden" value="|-$client->getId()-|" name="id">
		 <p><label for="params[name]">Nombre</label>
			<input name="params[name]" type="text" value="|-$client->getName()|escape-|" size="60">
		 </p>
		 <p><label for="params[internalId]">ID interno</label>
			<input name="params[internalId]" type="text" value="|-$client->getInternalNumber()|escape-|" size="15"> 
		</p>
		 <p><label for="params[address]">Dirección</label>
				<input name="params[address]" type="text" value="|-$client->getAddress()|escape-|" size="55"> 
		</p>
		 <p><label for="params[phone]">Teléfono</label>
				<input name="params[phone]" type="text" value="|-$client->getPhone()|escape-|" size="25"> 
			</p>
		 <p><label for="params[mail]">E-mail</label>
				<input name="params[mail]" id="params[mail]" type="text" value="|-$client->getEmail()|escape-|" size="30" class="mailValidation" onchange="javascript:validationValidateFieldClienSide('params[mail]');" /> |-validation_msg_box idField=params[mail]-|
			</p>
		 <p><label for="params[contact]">Persona contacto</label>
				<input name="params[contact]" type="text" value="|-$client->getContact()|escape-|" size="40"> 
			</p>
		 <p><label for="params[contactEmail]">Email persona contacto</label>
				<input name="params[contactEmail]" type="text" value="|-$client->getContactEmail()|escape-|" size="40">
			</p>
		 <p><label for="params[web]">Sitio WEB</label>
				<input name="params[web]" type="text" value="|-$client->getWeb()|escape-|" size="40">
			</p>
		 <p><label for="params[memo]">Información</label>
				<textarea name="params[memo]" cols="45" rows="6" wrap="VIRTUAL">|-$client->getMemo()|escape-|</textarea>
			</p>
		 <p><input name="save" type="submit" value="Guardar Cambios"> 
				<input type='button' onClick='location.href="Main.php?do=clientsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de ##clients,1,Clientes##"/>
			 </p>
		</form>
	</fieldset>
