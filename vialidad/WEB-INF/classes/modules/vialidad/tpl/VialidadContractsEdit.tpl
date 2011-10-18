|-include file="CommonAutocompleterInclude.tpl" -|
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
		   <label for="params[code]">Código</label>
				<input name="params[code]" type="text" value="|-$contract->getCode()|escape-|" size="55"> 
		</p>
			<div id="contractor" style="position: relative;z-index:11000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="params_contractorId" label="Contratista" url="Main.php?do=affiliatesContractorsAutocompleteListX" hiddenName="params[contractorId]" defaultHiddenValue=$contract->getContractorId() defaultValue=$contract->getAffiliateRelatedByContractorid()-|
			</div>
			<div id="verifier" style="position: relative;z-index:10000;">
			|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="params_verifierId" label="Verificador" url="Main.php?do=affiliatesVerifiersAutocompleteListX" hiddenName="params[verifierId]" defaultHiddenValue=$contract->getVerifierId() defaultValue=$contract->getAffiliateRelatedByVerifierid()-|
			</div>
	 <p><input name="save" type="submit" value="Guardar Cambios"> 
				<input type='button' onClick='location.href="Main.php?do=vialidadContractsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Contratos"/>
			 </p>
		</form>
	</fieldset>
	|-if $constructions|@count gt 0-|
		<fieldset title="Obras del contrato">
				<legend>Obras</legend>
				|-foreach from=$constructions item=construction name=for_construction-|
        	<p>|-$construction->getName()-|</p>
				|-/foreach-|
		</fieldset>
	|-/if-|
|-else-|
<div class="errorMessage">El identificador del contrato ingresado no es válido. Seleccione un contrato de la lista.</div>
<input type='button' onClick='location.href="Main.php?do=vialidadContractsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Contratos"/>
|-/if-|