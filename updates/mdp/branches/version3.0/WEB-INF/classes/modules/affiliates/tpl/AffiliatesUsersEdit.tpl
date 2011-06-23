<h2>Configuración del Sistema</h2>
	<h1>Administración de Usuarios por Afiliados</h1>
	<p>A continuación podrá |-if $currentAffiliateUser->getId() eq ''-|crear|-else-|editar|-/if-| el Usuario por Afiliado|-if $currentAffiliateUser->getAffiliateName() ne ''-| de |-$currentAffiliateUser->getAffiliateName()-||-/if-|.</p>
	|-if $currentAffiliateUser->getId() eq ''-|
		|-if $ownerCreation ne ''-|
			Para terminar de crear el afiliado debe crear una cuenta de usuario asociada. <br />
		|-/if-|
		Ingrese la Identificación del usuario y la contraseña para el nuevo usuario,  luego haga click en Guardar para generar el nuevo usuario.
	|-else-|
			Realice los cambios en el usuario y haga click en Aceptar para guardar las modificaciones.
	|-/if-| 
	<br />
	<br />
	
|-if $message eq "wrongPassword"-|
	<div class='errorMessage'>Las contraseñas deben coincidir</div>
|-elseif $message eq "emptyAffiliate"-|
	<div class='errorMessage'>Debe selecccionar un afiliado</div>
|-elseif $message eq "errorUpdate"-|
	<div class='errorMessage'>Ha ocurrido un error al intentar guardar la información del usuario</div>
|-elseif $message eq "saved"-|
	<div class='errorMessage'>Usuario guardado</div>
|-elseif $message eq "notAddedToGroup"-|
	<div class='errorMessage'>Ha ocurrido un error al intentar agregar el usuario al grupo</div>
|-elseif $message eq "notRemovedFromGroup"-|
	<div class='errorMessage'>Ha ocurrido un error al intentar eliminar el usuario al grupo</div>
|-/if-|
|-if $currentAffiliateUser->getValidationFailures()|@count > 0-|
	<div class="errorMessage">
		<ul>
			|-foreach from=$currentAffiliateUser->getValidationFailures() item=error-|
				<li>|-$error->getMessage()-|</li>
			|-/foreach-|
		</ul>
	</div>
|-/if-|
|-include file='ValidationJavascriptInclude.tpl'-|
<form method="post" action="Main.php">
	<fieldset title="Formulario de edición de usuario">
	<legend>Usuario por Afiliado |-if $currentAffiliateUser->getAffiliateName() ne ''-|- |-$currentAffiliateUser->getAffiliateName()-||-/if-|</legend>
		<p>
			<label for="affiliateUser[username]">Identificación de Usuario</label>
			<input name="affiliateUser[username]" id="affiliateUser[username]" type="text"  value="|-$currentAffiliateUser->getUsername()-|" size="40" |-ajax_onchange_validation_attribute actionName=affiliatesUsersValidationUsernameX-| />|-validation_msg_box idField=affiliateUser[username]-|
		</p>
		<p>
			<label for="affiliateUser[name]">Nombre</label>
			<input name="affiliateUser[name]" type="text"  value="|-$currentAffiliateUser->getName()-|" size="60" />
		</p>
		<p>
			<label for="affiliateUser[surname]">Apellido</label>
			<input name="affiliateUser[surname]" type="text"  value="|-$currentAffiliateUser->getSurname()-|" size="60" />
		</p>
		<p>
			<label for="affiliateUser[mailAddress]">E-mail</label>
			<input name="affiliateUser[mailAddress]" id="affiliateUser[mailAddress]" type="text"  value="|-$currentAffiliateUser->getMailAddress()-|" size="60"  class="mailValidation" onchange="javascript:validationValidateFieldClienSide('affiliateUser[mailAddress]');" /> |-validation_msg_box idField=affiliateUser[mailAddress]-|
		</p>
		<p><label for="pass">##users,165,Contraseña##</label>
			<input id='pass' name='pass' type='password' value='' size="20" class="" onchange="javascript:setElementClass('pass','emptyValidation');setElementClass('pass2','passwordMatch');validationValidateFieldClienSide('pass');" /> |-validation_msg_box idField=pass-|
		</p>
		<p><label for="pass2">##users,166,Repetir Contraseña##</label>
			<input id='pass2' name='pass2' type='password' value='' size="20" class="" onchange="javascript:validationValidateFieldClienSide('pass2');" /> |-validation_msg_box idField=pass2-|
		</p>
|-if $levels|@count gt 0-|		<p>
			<label for="affiliateUser[levelId]">Nivel de Usuario</label>
	        <select name="affiliateUser[levelId]">
	        	<option value="">Seleccionar nivel</option>
				|-foreach from=$levels item=level name=for_levels-|
	        		<option value="|-$level->getId()-|" |-$level->getId()|selected:$currentAffiliateUser->getLevelId()-|>|-$level->getName()-|</option>
				|-/foreach-|
	       	</select>
		</p>|-/if-|
		|-if $affiliates|@count > 0 && $ownerCreation eq ''-|
		<p>
			<label for="affiliateUser[affiliateId]">Afiliado</label>
			<select name="affiliateUser[affiliateId]">
				|-foreach from=$affiliates item=affiliate name=for_affiliates-|
					<option value="|-$affiliate->getId()-|"|-if $affiliate->getId() eq $currentAffiliateUser->getAffiliateId()-| selected="selected"|-/if-|>|-$affiliate->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		|-/if-|
		<p>
			<input type="hidden" name="ownerCreation" value="|-$ownerCreation-|" />
			<input type="hidden" name="id" value="|-$currentAffiliateUser->getId()-|" />
			<input type="hidden" name="do" value="affiliatesUsersDoEdit" />
			|-javascript_form_validation_button value='##97,Guardar##' title='##97,Guardar##'-|
			<input type='button' onClick='javascript:history.go(-1)' value='##104,Regresar##' />
		</p>
	</fieldset>
</form>

|-if $currentAffiliateUser->getId() ne '' && $groups|@count gt 0-|
<fieldset title="Formulario de edición de grupos del usuario">
	<legend>El usuario |-$currentAffiliateUser->getUsername()-| es miembro de los grupos:</legend>
	<table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableTdBorders">
		|-if $currentUserGroups|@count eq 0-|
			<tr>
				<th colspan="2">El usuario todavía no es miembro de ningún grupo.</th>
			</tr>
		|-else-|
			<tr>
				<th width="95%">Grupo</th>
				<th width="5%">&nbsp;</th>
			</tr>
			|-foreach from=$currentUserGroups item=group name=for_user_group-|
			<tr>
				<td width="95%"><div class="titulo2">|-$group->getName()-|</div></td>
				<td width="5%" nowrap>
					<form action="Main.php" method="post" style="display:inline;"> 
						<input type="hidden" name="do" value="affiliatesUsersDoRemoveFromGroup" /> 
						<input type="hidden" name="group" value="|-$group->getId()-|" /> 
						<input type="hidden" name="user" value="|-$currentAffiliateUser->getId()-|" /> 
						<input type="submit" name="submit_go_delete_affiliate_group" value="##192,Eliminar acceso##" title="Eliminar" class="icon iconDelete" onclick="return confirm('##257,Esta opción remueve el acceso del grupo a la categoría. ¿Está seguro que desea eliminarlo?##');"  /> 
					</form>
				</td>
			</tr>
			|-/foreach-|
		|-/if-|
	</table>
	<p>
		<form action="Main.php" method="post">
			<label for="category">Agregar al Usuario en el Grupo:</label>
			<select name="group">
				<option value="" selected="selected">Seleccionar grupo</option>
				|-foreach from=$groups item=group name=for_groups-|
					<option value="|-$group->getId()-|">|-$group->getName()-|</option>
				|-/foreach-|
			</select>
			<input type="hidden" name="do" value="affiliatesUsersDoAddToGroup" />
			<input type="hidden" name="user" value="|-$currentAffiliateUser->getId()-|" />
			<input type="submit" value="Agregar" class="button" />
		</form>
	</p>
</fieldset>
|-/if-|