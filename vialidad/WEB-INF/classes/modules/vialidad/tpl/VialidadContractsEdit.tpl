<h2>Contratos</h2>
	<h1>Administración de Contratos - |-if $action eq 'create'-|Crear|-else-|Editar|-/if-| Contrato</h1>
|-if $action eq 'create'-|	
	<p>A continuación podrá ingresar los datos para crear el Contrato.</p>
|-else-|		
	<p>A continuación podrá editar los datos del Contrato.</p>
|-/if-|
|-if $message eq "ok"-|
	<div class="successMessage">Contrato guardado</div>
|-/if-|
|-if !$notValidId-|	
	<fieldset title="Formulario de edición de nombre del Contrato">
		<legend>Contratos</legend>
		<p>Realice los cambios y para guardar haga click en "Guardar Cambios"</p>
			<form method="post" action="Main.php?do=vialidadContractsDoEdit">
			<input type="hidden" value="|-$action-|" name="action">
			<input type="hidden" value="|-$contract->getId()-|" name="id">
		 <p><label for="params[name]">Nombre</label>
			<input name="params[name]" type="text" value="|-$contract->getName()|escape-|" size="60">
		 </p>
		 <p>
		   <label for="params[code]">C&oacute;digo</label>
				<input name="params[code]" type="text" value="|-$contract->getCode()|escape-|" size="55"> 
		</p>

	 <p><input name="save" type="submit" value="Guardar Cambios"> 
				<input type='button' onClick='location.href="Main.php?do=vialidadContractsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Contratos"/>
			 </p>
		</form>
	</fieldset>
|-else-|
<div class="errorMessage">El identificador del contrato ingresado no es válido. Seleccione un contrato de la lista.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadContractsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Contratos"/>
|-/if-|