<h2>Proveedores</h2>
	<h1>Administración de Proveedores - |-if $action eq 'create'-|Crear|-else-|Editar|-/if-| Proveedor</h1>
|-if $action eq 'create'-|	
	<p>A continuación podrá ingresar los datos para crear el Proveedor.</p>
|-else-|		
	<p>A continuación podrá editar los datos del Proveedor.</p>
|-/if-|
|-if $message eq "ok"-|
	<div  class="successMessage">Proveedor guardado</div>
|-/if-|
|-if !$notValidId-|	
	<fieldset title="Formulario de edición de nombre del Proveedor">
		<legend>Proveedores</legend>
		<p>Realice los cambios y para guardar haga click en "Guardar Cambios"</p>
			<form method="post" action="Main.php?do=vialidadSuppliersDoEdit">
			<input type="hidden" value="|-$action-|" name="action">
			<input type="hidden" value="|-$supplier->getId()-|" name="id">
		 <p><label for="params[name]">Nombre</label>
			<input name="params[name]" type="text" value="|-$supplier->getName()|escape-|" size="60">
		 </p>
		 <p><label for="params[address]">Dirección</label>
				<input name="params[address]" type="text" value="|-$supplier->getAddress()|escape-|" size="55"> 
		</p>
		 <p><label for="params[phone]">Teléfono</label>
				<input name="params[phone]" type="text" value="|-$supplier->getPhone()|escape-|" size="25"> 
			</p>
		 <p><label for="params[mail]">E-mail</label>
				<input name="params[mail]" id="params[mail]" type="text" value="|-$supplier->getEmail()|escape-|" size="30" class="mailValidation" onchange="javascript:validationValidateFieldClienSide('params[mail]');" /> |-validation_msg_box idField=params[mail]-|
			</p>
		 <p><label for="params[contact]">Persona contacto</label>
				<input name="params[contact]" type="text" value="|-$supplier->getContact()|escape-|" size="40"> 
			</p>
		 <p><label for="params[contactEmail]">Email persona contacto</label>
				<input name="params[contactEmail]" type="text" value="|-$supplier->getContactEmail()|escape-|" size="40">
			</p>
		 <p><label for="params[web]">Sitio WEB</label>
				<input name="params[web]" type="text" value="|-$supplier->getWeb()|escape-|" size="40">
			</p>
		 <p><label for="params[memo]">Información</label>
				<textarea name="params[memo]" cols="45" rows="6" wrap="VIRTUAL">|-$supplier->getMemo()|escape-|</textarea>
			</p>
		 <p><input name="save" type="submit" value="Guardar Cambios"> 
				<input type='button' onClick='location.href="Main.php?do=vialidadSuppliersList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Proveedores"/>
			 </p>
		</form>
	</fieldset>
|-else-|
<div class="errorMessage">El identificador del proveedor ingresado no es válido. Seleccione un proveedor de la lista.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadSuppliersList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Proveedores"/>
|-/if-|