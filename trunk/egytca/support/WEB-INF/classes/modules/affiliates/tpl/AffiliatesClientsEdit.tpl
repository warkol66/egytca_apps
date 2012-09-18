<h2>Clientes</h2>
|-if !$notValidId-|	
<h1>Administración de Clientes - |-if $affiliate->isNew()-|Crear|-else-|Editar|-/if-| Cliente</h1>
|-if $affiliate->isNew()-|
	<p>A continuación podrá ingresar los datos para crear el Cliente.</p>
|-else-|		
	<p>A continuación podrá editar los datos del Cliente.</p>
|-/if-|
	<fieldset title="Formulario de edición de nombre del Cliente">
		<legend>Clientes</legend>
		<p>Realice los cambios y para guardar haga click en "Guardar Cambios"</p>
			<form method="post" action="Main.php?do=affiliatesClientsDoEdit">
			<input type="hidden" value="|-$affiliate->getId()-|" name="id">
		 <p><label for="params[name]">Razón Social</label>
			<input name="params[name]" id="params[name]" type="text" value="|-$affiliate->getName()|escape-|" class="emptyValidation" size="60"> |-validation_msg_box idField="params[name]"-|
		 </p>
		 <p><label for="params[internalNumber]">Código de cliente</label>
			<input name="params[internalNumber]" type="text" id="params[internalNumber]" value="|-$affiliate->getInternalNumber()|escape-|" size="9" maxlength="9" title="Ingrese código de cliente"> |-validation_msg_box idField="params[internalNumber]"-|
		</p>
		 <p><label for="params[address]">Dirección</label>
				<input name="params[address]" id="params[address]" type="text" value="|-$affiliate->getAddress()|escape-|" size="55"> |-validation_msg_box idField="params[address]"-|
		</p>
		 <p><label for="params[phone]">Teléfono</label>
				<input name="params[phone]" id="params[phone]" type="text" value="|-$affiliate->getPhone()|escape-|" size="25"> |-validation_msg_box idField="params[phone]"-|
			</p>
		 <p><label for="params[email]">E-mail</label>
				<input name="params[email]" id="params[email]" type="text" value="|-$affiliate->getEmail()|escape-|" size="30" class="mailValidation" onchange="javascript:validationValidateFieldClienSide('params[email]');" /> |-validation_msg_box idField="params[email]"-|
			</p>
		 <p><label for="params[contact]">Persona contacto</label>
				<input name="params[contact]" id="params[contact]" type="text" value="|-$affiliate->getContact()|escape-|" size="40"> |-validation_msg_box idField="params[contact]"-|
			</p>
		 <p><label for="params[contactEmail]">Email persona contacto</label>
				<input name="params[contactEmail]" type="text" value="|-$affiliate->getContactEmail()|escape-|" size="40">
			</p>
		 <p><label for="params[web]">Sitio WEB</label>
				<input name="params[web]" type="text" value="|-$affiliate->getWeb()|escape-|" size="40">
			</p>
		 <p><label for="params[memo]">Información</label>
				<textarea name="params[memo]" cols="45" rows="6" wrap="VIRTUAL">|-$affiliate->getMemo()|escape-|</textarea>
			</p>
		<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
		 <p>
			|-javascript_form_validation_button value='Guardar' title='Guardar'-|
				<input type="button" onClick='location.href="Main.php?do=affiliatesClientsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Clientes"/>
			 </p>
		</form>
	</fieldset>
|-else-|
<div class="errorMessage">El identificador del cliente ingresado no es válido. Seleccione un cliente de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=affiliatesClientsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Clientes"/>
|-/if-|