<h2>##clients,5,Sucursales##</h2> 
	<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| ##clients,4,Sucursal##|-if $action eq "edit"-| - |-$branch->getname()-||-/if-|</h1> 
	<p>A continuación se muestra la ficha de ##clients,4,Sucursal## del sistema. Para guardar los cambios, haga click en "Aceptar";<br> 
  para regresar al listado sin guardar cambios, haga click en "Cancelar". </p> 
 <div id="div_branch"> 
	<form name="form_edit_branch" id="form_edit_branch" action="Main.php" method="post">
 		|-if $message eq "error"-|
			<div class="resultFailure">Ha ocurrido un error al intentar guardar el registro</div>
		|-/if-|
		<fieldset title="Formulario de edición de ##clients,4,Sucursal## de ##clients,3,Cliente##">
     <legend>##clients,4,Sucursal##</legend>
		 |-if $clients|@count gt 0-|
	<p>
	<label for="params[clientId]">##clients,3,Cliente##</label>
		<select id="clientId" name="params[clientId]"> 
			<option value="">Seleccionar ##clients,3,Cliente##</option> 
				|-foreach from=$clients item=client-|
			<option value="|-$client->getId()-|" |-$branch->getClientId()|selected:$client->getId()-|>|-$client->getName()-|</option> 
				|-/foreach-|									
		</select> 
	</p>
		|-/if-|
	<p>
	<label for="params[number]">##clients,4,Sucursal## No. </label>
			<input type="text" id="number" name="params[number]" value="|-$branch->getnumber()-|" size="15" title="number" />
	</p>
	<p>
		<label for="params[code]">Código</label>
		<input type="text" id="code" name="params[code]" value="|-$branch->getCode()-|" size="15" title="code" />
	</p>
	<p>
		<label for="params[name]">Nombre </label>
		<input type="text" id="name" name="params[name]" value="|-$branch->getname()-|" title="name" size="45" maxlength="255" />
	</p>
	<p>
		<label for="params[phone]">Teléfono</label>
		<input type="text" id="phone" name="params[phone]" value="|-$branch->getphone()-|" title="phone" size="35" maxlength="100" />
	</p>
	<p>
		<label for="params[contact]">Contacto</label>
		<input type="text" id="contact" name="params[contact]" value="|-$branch->getcontact()-|" title="contact" size="45" maxlength="50" />
	</p>
	<p>
		<label for="params[contactEmail]">Email contacto</label>
		<input type="text" id="contactEmail" name="params[contactEmail]" value="|-$branch->getcontactEmail()-|" title="contactEmail" size="35" maxlength="100" />
	</p>
	<p>
		<label for="params[memo]">Memo</label>
		<textarea name="params[memo]" cols="40" rows="5" wrap="VIRTUAL" id="memo">|-if $action eq 'edit'-||-$branch->getmemo()-||-/if-|</textarea>
	</p>
	<p>
		<input type="hidden" name="id" id="id" value="|-$branch->getid()-|" />
		<input type="hidden" name="action" id="action" value="|-$action-|" /> 
			|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
			|-if isset($page)-| <input type="hidden" name="page" id="page" value="|-$page-|" />|-/if-|
		<input type="hidden" name="do" id="do" value="clientsBranchesDoEdit" /> 
		<input type="submit" id="button_edit_branch" name="button_edit_branch" title="Aceptar" value="Aceptar" />
		<input name="rmoveFilters" type="button" value="Cancelar" onclick="location.href='Main.php?do=clientsBranchesList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|'"  />	</p>
	</fieldset>
	</form> 
</div>
