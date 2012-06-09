<h2>##affiliates,1,Afiliados##</h2>
	<h1>Administración de ##affiliates,1,Afiliados## - |-if $action eq 'create'-|Crear|-else-|Editar|-/if-| ##affiliates,3,Afiliado##</h1>
|-if $action eq 'create'-|	
	<p>A continuación podrá ingresar los datos para crear el ##affiliates,3,Afiliado##.</p>
|-else-|		
	<p>A continuación podrá editar los datos del ##affiliates,3,Afiliado##.</p>
|-/if-|
|-if !$notValidId-|	
	<fieldset title="Formulario de edición de nombre del Afiliado">
		<legend>##affiliates,1,Afiliados##</legend>
		<p>Realice los cambios y para guardar haga click en "Guardar Cambios"</p>
			<form method="post" action="Main.php?do=affiliatesDoEdit">
			<input type="hidden" value="|-$action-|" name="action">
			<input type="hidden" value="|-$affiliate->getId()-|" name="id">
		 <p><label for="params[name]">Razón Social</label>
			<input name="params[name]" type="text" value="|-$affiliate->getName()|escape-|" size="60">
		 </p>
		 <p><label for="params[internalNumber]">RUC</label>
			<input name="params[internalNumber]" type="text" value="|-$affiliate->getInternalNumber()|escape-|" size="15"> 
		</p>
		 <p><label for="params[address]">Dirección</label>
				<input name="params[address]" type="text" value="|-$affiliate->getAddress()|escape-|" size="55"> 
		</p>
		 <p><label for="params[phone]">Teléfono</label>
				<input name="params[phone]" type="text" value="|-$affiliate->getPhone()|escape-|" size="25"> 
			</p>
		 <p><label for="params[email]">E-mail</label>
				<input name="params[email]" id="params[email]" type="text" value="|-$affiliate->getEmail()|escape-|" size="30" class="mailValidation" onchange="javascript:validationValidateFieldClienSide('params[email]');" /> |-validation_msg_box idField="params[email]"-|
			</p>
<!--			 <p><label for="params[contact]">Persona contacto</label>
				<input name="params[contact]" type="text" value="|-$affiliate->getContact()|escape-|" size="40"> 
			</p>
	 <p><label for="params[contactEmail]">Email persona contacto</label>
				<input name="params[contactEmail]" type="text" value="|-$affiliate->getContactEmail()|escape-|" size="40">
			</p>-->
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
			|-javascript_form_validation_button value='Guardar' title='Guardar'-|				<input type='button' onClick='location.href="Main.php?do=affiliatesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de ##affiliates,1,Afiliados##"/>
			 </p>
		</form>
	</fieldset>
|-else-|
<div class="errorMessage">El identificador del afiliado ingresado no es válido. Seleccione un afiliado de la lista.</div>
				<input type='button' onClick='location.href="Main.php?do=affiliatesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de ##affiliates,1,Afiliados##"/>
|-/if-|