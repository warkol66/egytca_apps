<h2>Contratistas</h2>
	<h1>Administración de Contratistas - |-if $action eq 'create'-|Crear|-else-|Editar|-/if-| Contratista</h1>
|-if $action eq 'create'-|	
	<p>A continuación podrá ingresar los datos para crear el Contratista.</p>
|-else-|		
	<p>A continuación podrá editar los datos del Contratista.</p>
|-/if-|
|-if !$notValidId-|	
	<fieldset title="Formulario de edición de nombre del Afiliado">
		<legend>Contratistas</legend>
		<p>Realice los cambios y para guardar haga click en "Guardar Cambios"</p>
			<form method="post" action="Main.php?do=affiliatesContractorsDoEdit">
			<input type="hidden" value="|-$action-|" name="action">
			<input type="hidden" value="|-$affiliate->getId()-|" name="id">
		 <p><label for="params[name]">Razón Social</label>
			<input name="params[name]" id="params[name]" type="text" value="|-$affiliate->getName()|escape-|" class="emptyValidation" size="60"> |-validation_msg_box idField="params[name]"-|
		 </p>
		 <p><label for="params[internalNumber]">RUC</label>
			<input name="params[internalNumber]" type="text" class="emptyValidation" id="params[internalNumber]" value="|-$affiliate->getInternalNumber()|escape-|" size="9" maxlength="9" title="Ingrese el RUC sin guiones"> |-validation_msg_box idField="params[internalNumber]"-|
		</p>
		 <p><label for="params[address]">Dirección</label>
				<input name="params[address]" id="params[address]" type="text" value="|-$affiliate->getAddress()|escape-|" class="emptyValidation" size="55"> |-validation_msg_box idField="params[address]"-|
		</p>
		 <p><label for="params[phone]">Teléfono</label>
				<input name="params[phone]" id="params[phone]" type="text" value="|-$affiliate->getPhone()|escape-|" class="emptyValidation" size="25"> |-validation_msg_box idField="params[phone]"-|
			</p>
		 <p><label for="params[email]">E-mail</label>
				<input name="params[email]" id="params[email]" type="text" value="|-$affiliate->getEmail()|escape-|" size="30" class="mailValidation emptyValidation" onchange="javascript:validationValidateFieldClienSide('params[email]');" /> |-validation_msg_box idField="params[email]"-|
			</p>
		 <p><label for="params[contact]">Persona contacto</label>
				<input name="params[contact]" id="params[contact]" type="text" value="|-$affiliate->getContact()|escape-|" class="emptyValidation" size="40"> |-validation_msg_box idField="params[contact]"-|
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
<h3>Contactos</h3>
<table class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
<tr>
<th>Nombre y Apellido </th>
<th>Cargo</th>
<th>Teléfono</th>
<th>E-mail</th>
</tr>
<tr>
<td><input name="params[contact1]" type="text" value="|-$affiliate->getContact1()|escape-|" size="20"></td>
<td><input name="params[position1]" type="text" value="|-$affiliate->getPosition1()|escape-|" size="25"></td>
<td><input name="params[phone1]" type="text" value="|-$affiliate->getPhone1()|escape-|" size="15"></td>
<td><input name="params[contactEmail1]" type="text" value="|-$affiliate->getContactEmail1()|escape-|" size="15"></td>
</tr>
<tr>
<td><input name="params[contact2]" type="text" value="|-$affiliate->getContact2()|escape-|" size="20"></td>
<td><input name="params[position2]" type="text" value="|-$affiliate->getPosition2()|escape-|" size="25"></td>
<td><input name="params[phone2]" type="text" value="|-$affiliate->getPhone2()|escape-|" size="15"></td>
<td><input name="params[contactEmail2]" type="text" value="|-$affiliate->getContactEmail2()|escape-|" size="15"></td>
</tr>
<tr>
<td><input name="params[contact3]" type="text" value="|-$affiliate->getContact3()|escape-|" size="20"></td>
<td><input name="params[position3]" type="text" value="|-$affiliate->getPosition3()|escape-|" size="25"></td>
<td><input name="params[phone3]" type="text" value="|-$affiliate->getPhone3()|escape-|" size="15"></td>
<td><input name="params[contactEmail3]" type="text" value="|-$affiliate->getContactEmail3()|escape-|" size="15"></td>
</tr>
</table>
<p>&nbsp;</p>
		<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
		 <p>
			|-javascript_form_validation_button value='Guardar' title='Guardar'-|
				<input type="button" onClick='location.href="Main.php?do=affiliatesContractorsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Contratistas"/>
			 </p>
		</form>
	</fieldset>
|-else-|
<div class="errorMessage">El identificador del contratista ingresado no es válido. Seleccione un contratista de la lista.</div>
				<input type='button' onClick='location.href="Main.php?do=affiliatesContractorsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Contratistas"/>
|-/if-|