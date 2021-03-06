<h2>##affiliates,1,Afiliados##</h2>
<h1>Administración de Usuarios de ##affiliates,1,Afiliados##</h1>
	<p>A continuación podrá |-if $currentAffiliateUser->getId() eq ''-|crear|-else-|editar|-/if-| el Usuario de ##affiliates,3,Afiliado##|-if $currentAffiliateUser->getAffiliate() ne ''-| de |-$currentAffiliateUser->getAffiliate()-||-/if-|.</p>
	|-if $currentAffiliateUser->getId() eq ''-|
		<p>Ingrese la Identificación del usuario y la contraseña para el nuevo usuario, luego haga click en Guardar para generar el nuevo usuario.</p>
		|-if $ownerCreation ne ''-|
			<p><div class="successMessage">El sistema ha recibido su solicitud.<br />
Para terminar de crear el ##affiliates,3,Afiliado## debe crear una cuenta de usuario asociada.</div></p>
		|-/if-|
	|-else-|
			<p>Realice los cambios en el usuario y haga click en Aceptar para guardar las modificaciones.</p>
	|-/if-| 
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
<form method="post" action="Main.php">
	<fieldset title="Formulario de edición de usuario">
	<legend>Usuario de ##affiliates,1,Afiliados## |-if $currentAffiliateUser->getAffiliate() ne ''-|- |-$currentAffiliateUser->getAffiliate()-||-/if-|</legend>
		<p>
			<label for="affiliateUser[username]">Identificación de Usuario</label>
	|-if $action eq 'edit' and $currentAffiliateUser->getUsername() ne ''-|<input id='actualaffiliateUser[username]' type='hidden' value='|-$currentAffiliateUser->getUsername()-|' />|-/if-|
			<input name="affiliateUser[username]" id="affiliateUser[username]" type="text"  value="|-$currentAffiliateUser->getUsername()-|" class="emptyValidation" size="40" |-ajax_onchange_validation_attribute actionName=affiliatesUsersValidationUsernameX-| />|-validation_msg_box idField="affiliateUser[username]"-|
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
			<input name="affiliateUser[mailAddress]" id="affiliateUser[mailAddress]" type="text"  value="|-$currentAffiliateUser->getMailAddress()-|" size="60"  class="mailValidation emptyValidation" onchange="javascript:validationValidateFieldClienSide('affiliateUser[mailAddress]');" /> |-validation_msg_box idField="affiliateUser[mailAddress]"-|
		</p>
		<p><label for="pass">##users,165,Contraseña##</label>
			<input id='pass' name='pass' type='password' value='' size="20" class="|-if $currentAffiliateUser->isNew()-|emptyValidation|-/if-|" onChange="javascript:setElementClass('pass','emptyValidation');setElementClass('pass2','passwordMatch');validationValidateFieldClienSide('pass');" /> |-validation_msg_box idField=pass-|
		</p>
		<p><label for="pass2">##users,166,Repetir Contraseña##</label>
			<input id='pass2' name='pass2' type='password' value='' size="20" class="|-if $currentAffiliateUser->isNew()-|emptyValidation|-/if-|" onChange="javascript:validationValidateFieldClienSide('pass2');" /> |-validation_msg_box idField=pass2-|
		</p>
|-if $levels|@count gt 0 && $ownerCreation eq ''-|		<p>
			<label for="affiliateUser[levelId]">Nivel de Usuario</label>
	        <select name="affiliateUser[levelId]" class="emptyValidation">
	        	<option value="">Seleccionar nivel</option>
				|-foreach from=$levels item=level name=for_levels-|
	        		<option value="|-$level->getId()-|" |-$level->getId()|selected:$currentAffiliateUser->getLevelId()-|>|-$level->getName()-|</option>
				|-/foreach-|
	       	</select>
		</p>|-/if-|
		|-if $affiliates|@count > 0 && $ownerCreation eq ''-|
		<p>
			<label for="affiliateUser[affiliateId]">##affiliates,3,Afiliado##</label>
			<select name="affiliateUser[affiliateId]" class="emptyValidation">
					<option value="">Seleccione ##affiliates,3,Afiliado##</option>
				|-foreach from=$affiliates item=affiliate name=for_affiliates-|
					<option value="|-$affiliate->getId()-|"|-if $affiliate->getId() eq $currentAffiliateUser->getAffiliateId()-| selected="selected"|-/if-|>|-$affiliate->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		|-/if-|
		<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
		<p>
			<input type="hidden" name="ownerCreation" value="|-$ownerCreation-|" />
			<input type="hidden" name="id" value="|-$currentAffiliateUser->getId()-|" />
			<input type="hidden" name="do" value="affiliatesUsersDoEdit" />
			|-javascript_form_validation_button value='Guardar' title='Guardar'-|
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
			<input type="submit" value="Agregar" />
		</form>
	</p>
</fieldset>
|-/if-|