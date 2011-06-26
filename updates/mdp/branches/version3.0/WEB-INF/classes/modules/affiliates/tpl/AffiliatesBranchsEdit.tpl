<h2>##affiliates,5,Sucursales##</h2> 
	<h1>|-if $action eq "edit"-|Editar|-else-|Crear|-/if-| ##affiliates,4,Sucursal##|-if $action eq "edit"-| - |-$branch->getname()-||-/if-|</h1> 
	<p>A continuación se muestra la ficha de ##affiliates,4,Sucursal## del sistema. Para guardar los cambios, haga click en "Aceptar";<br> 
  para regresar al listado sin guardar cambios, haga click en "Cancelar". </p> 
 <div id="div_branch"> 
	<form name="form_edit_branch" id="form_edit_branch" action="Main.php" method="post">
 		|-if $message eq "error"-|
			<div class="resultFailure">Ha ocurrido un error al intentar guardar el registro</div>
		|-/if-|
		<fieldset title="Formulario de edición de ##affiliates,4,Sucursal## de ##affiliates,3,Afiliado##">
     <legend>##affiliates,4,Sucursal##</legend>
		 |-if $affiliates|@count gt 0-|
	<p>
	<label for="params[affiliateId]">##affiliates,3,Afiliado##</label>
		<select id="affiliateId" name="params[affiliateId]"> 
			<option value="">Seleccionar ##affiliates,3,Afiliado##</option> 
				|-foreach from=$affiliates item=affiliate-|
			<option value="|-$affiliate->getId()-|" |-$branch->getAffiliateId()|selected:$affiliate->getId()-|>|-$affiliate->getName()-|</option> 
				|-/foreach-|									
		</select> 
	</p>
		|-/if-|
	<p>
	<label for="params[number]">##affiliates,4,Sucursal## No. </label>
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
		<input type="hidden" name="do" id="do" value="affiliatesBranchsDoEdit" /> 
		<input type="submit" id="button_edit_branch" name="button_edit_branch" title="Aceptar" value="Aceptar" />
		<input name="rmoveFilters" type="button" value="Cancelar" onclick="location.href='Main.php?do=affiliatesBranchsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|'"  />	</p>
	</fieldset>
	</form> 
</div>
