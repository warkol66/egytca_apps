<h2>Obras</h2>
	<h1>Administración de Obras - |-if $action eq 'create'-|Crear|-else-|Editar|-/if-| Obra</h1>
|-if $action eq 'create'-|	
	<p>A continuación podrá ingresar los datos para crear el Obra.</p>
|-else-|		
	<p>A continuación podrá editar los datos del Obra.</p>
|-/if-|
|-if $message eq "ok"-|
	<div  class="successMessage">Obra guardada</div>
|-/if-|
|-if !$notValidId-|	
	<fieldset title="Formulario de edición de nombre del Obra">
		<legend>Obras</legend>
		<p>Realice los cambios y para guardar haga click en "Guardar Cambios"</p>
			<form method="post" action="Main.php?do=vialidadConstructionsDoEdit">
			<input type="hidden" value="|-$action-|" name="action">
			<input type="hidden" value="|-$construction->getId()-|" name="id">
		 <p><label for="params[contractId]">Contrato</label>
				<select id="params[contractId]" name="params[contractId]" |-$action|disabled-| >
					<option value="">Seleccione el contrato</option>
				|-foreach from=$contracts item=contract name=for_contract-|
        		<option value="|-$contract->getId()-|" |-$construction->getContractId()|selected:$contract->getId()-|>|-$contract-|</option>
				|-/foreach-|
				</select>
			</p>
		 </p>
		 <p><label for="params[name]">Nombre</label>
			<input name="params[name]" type="text" value="|-$construction->getName()|escape-|" size="60">
		 </p>
		 <p><input name="save" type="submit" value="Guardar Cambios"> 
				<input type='button' onClick='location.href="Main.php?do=vialidadConstructionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Obras"/>
			 </p>
		</form>
	</fieldset>
|-else-|
<div class="errorMessage">El identificador de la obra ingresado no es válido. Seleccione una obra de la lista.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadConstructionsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Obras"/>
|-/if-|