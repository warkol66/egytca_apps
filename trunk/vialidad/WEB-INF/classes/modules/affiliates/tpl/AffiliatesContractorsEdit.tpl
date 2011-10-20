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
		 <p><label for="params[name]">Nombre</label>
			<input name="params[name]" type="text" value="|-$affiliate->getName()|escape-|" size="60">
		 </p>
		 <p><label for="params[internalNumber]">ID interno</label>
			<input name="params[internalNumber]" type="text" value="|-$affiliate->getInternalNumber()|escape-|" size="15"> 
		</p>
		 <p>
		   <label for="params[contractorCode]">Código de Contratista</label>
			<input name="params[contractorCode]" type="text" value="|-*$affiliate->getContractorCode()|escape*-|" size="15"> 
		</p>
		 <p><label for="params[address]">Dirección</label>
				<input name="params[address]" type="text" value="|-$affiliate->getAddress()|escape-|" size="55"> 
		</p>
		 <p><label for="params[phone]">Teléfono</label>
				<input name="params[phone]" type="text" value="|-$affiliate->getPhone()|escape-|" size="25"> 
			</p>
		 <p><label for="params[mail]">E-mail</label>
				<input name="params[mail]" id="params[mail]" type="text" value="|-$affiliate->getEmail()|escape-|" size="30" class="mailValidation" onchange="javascript:validationValidateFieldClienSide('params[mail]');" /> |-validation_msg_box idField=params[mail]-|
			</p>
		 <p><label for="params[contact]">Persona contacto</label>
				<input name="params[contact]" type="text" value="|-$affiliate->getContact()|escape-|" size="40"> 
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
		 <p><input name="save" type="submit" value="Guardar Cambios"> 
				<input type="button" onClick='location.href="Main.php?do=affiliatesContractorsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Contratistas"/>
			 </p>
		</form>
	</fieldset>
|-else-|
<div class="errorMessage">El identificador del contratista ingresado no es válido. Seleccione un contratista de la lista.</div>
				<input type='button' onClick='location.href="Main.php?do=affiliatesContractorsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Contratistas"/>
|-/if-|