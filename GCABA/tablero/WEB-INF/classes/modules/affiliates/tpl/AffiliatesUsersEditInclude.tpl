<!-- inclusion de validación de javascript -->
|-include file='ValidationJavascriptInclude.tpl'-|
<form method='post' action='Main.php?do=affiliatesUsersDoEditUser'>
	<input type='hidden' name='id' value='|-$currentAffiliateUser->getId()-|' />
<fieldset title="Formulario de edición de Usuarios de Instituciones">
<legend>Datos del Usuario</legend>
	<p>Ingrese los datos del usuario; para guardar, haga click en "Guardar Cambios"</p>
	<p><label for="affiliateUser[username]">##162,Identificación de Usuario##</label>
		<input name='affiliateUser[username]' id='affiliateUser[username]'  type='text' value='|-if $action eq "edit"-||-$currentAffiliateUser->getUsername()-||-/if-|'  size="30" |-ajax_onchange_validation_attribute actionName=affiliatesUsersValidationUsernameX-| />|-validation_msg_box idField=affiliateUser[username]-|	</p>
	<p><label for="affiliateUserInfo[name]">##163,Nombre##</label>
			<input name='affiliateUserInfo[name]' type='text'  class='textodato' value='|-if $action eq "edit"-||-$currentAffiliateUserInfo->getName()-||-/if-|' size="60" />
	</p>
	<p><label for="affiliateUserInfo[surname]">##164,Apellido##</label>
			<input name='affiliateUserInfo[surname]' type='text'  class='textodato' value='|-if $action eq "edit"-||-$currentAffiliateUserInfo->getSurname()-||-/if-|' size="60" />
	</p>
	<p><label for="affiliateUserInfo[mailAddress]">E-mail</label>
			<input name='affiliateUserInfo[mailAddress]' id='affiliateUserInfo[mailAddress]' type='text' value='|-if $action eq "edit"-||-$currentAffiliateUserInfo->getMailAddress()-||-/if-|' size="60" class="mailValidation" onchange="javascript:validationValidateFieldClienSide('affiliateUserInfo[mailAddress]');" /> |-validation_msg_box idField=affiliateUserInfo[mailAddress]-|
	</p>
	<p><label for="pass">##165,Contraseña##</label>
			<input id='pass' name='pass' type='password' value='' size="20" class="emptyValidation" onchange="javascript:validationValidateFieldClienSide('pass');" /> |-validation_msg_box idField=pass-|

	</p>
	<p><label for="pass2">##166,Repetir Contraseña##</label>
			<input id='pass2' name='pass2' type='password' value='' size="20" class="passwordMatch" onchange="javascript:validationValidateFieldClienSide('pass2');" /> |-validation_msg_box idField=pass2-|
	</p>
	<p><label for="affiliateUser[levelId]">Nivel de Usuario</label>
        <select name='affiliateUser[levelId]'>
        	<option value="">Seleccionar nivel</option>
					|-foreach from=$levels item=level name=for_levels-|
        	<option value="|-$level->getId()-|"|-if $level->getId() eq $currentAffiliateUser->getLevelId()-| selected="selected"|-/if-|>|-$level->getName()-|</option>
					|-/foreach-|
       	</select>
	</p>
	<p><label for="affiliateUser[timezone]">Huso Horario (GMT) del Usuario</label>
				<select name='affiliateUser[timezone]'>
					<option value="">seleccione una zona horaria (opcional)</option>
					|-foreach from=$timezones item=timezone name=for_timezones-|
					<option value="|-$timezone->getCode()-|" |-if $currentAffiliateUser->getTimezone() eq $timezone->getCode()-|selected="selected"|-/if-|>|-$timezone->getDescription()-|</option>
					|-/foreach-|
				</select>
		</p>
	|-if $affiliates|@count > 0-|
	<p><label for="affiliateId">Institución</label>
				<select name='affiliateId'>
					<option value="">Seleccionar Institución</option>
					|-foreach from=$affiliates item=affiliate name=for_affiliates-|
					<option value="|-$affiliate->getId()-|"|-if $affiliate->getId() eq $affiliateId-| selected="selected"|-/if-|>|-$affiliate->getName()-|</option>
					|-/foreach-|
				</select>
			</p>
		|-/if-|
		<p> |-if $action eq "edit"-|
				<input type="hidden" name="accion" value="edicion" />
				|-/if-|
						|-javascript_form_validation_button value=Guardar-|
				<input type='button' onClick='javascript:history.go(-1)' value='##104,Regresar##'  />
			</p>
</fieldset>
</form>
|-if $action eq "edit"-|
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<caption>
	##167,El usuario ## |-$currentAffiliateUser->getUsername()-| ##168,es miembro de los grupos:##
	</caption>
	|-if $currentUserGroups|@count eq 0-|
	<tr>
		<th colspan="2">##169,El usuario todavía no es miembro de ningún grupo##.</th>
	</tr>
	|-else-|
	<tr>
		<th width="95%">##170,Grupo##</th>
		<th width="5%">&nbsp;</th>
	</tr>
	|-foreach from=$currentUserGroups item=userGroup name=for_user_group-|
	|-assign var="group" value=$userGroup->getAffiliateUserGroup()-|
	<tr>
		<td><div class='titulo2'>|-$group->getName()-|</div></td>
		<td class='cellopciones' nowrap> [ <a href='Main.php?do=affiliatesUsersDoRemoveFromGroup&user=|-$currentAffiliateUser->getId()-|&group=|-$group->getId()-|' class='delete'>##115,Eliminar##</a> ] </td>
	</tr>
	|-/foreach-|
	|-/if-|
	<tr>
		<td class='cellboton' colspan='4'>##171,Agregar al Usuario en el Grupo##:
			<form action='Main.php' method='post'>
				<input type="hidden" name="do" value="affiliatesUsersDoAddToGroup" />
				<select name="group">
					<option value="" selected="selected">##172,Seleccionar grupo##</option>
								|-foreach from=$groups item=group name=for_groups-|
					<option value="|-$group->getId()-|">|-$group->getName()-|</option>
								|-/foreach-|
				</select>
				<input type="hidden" name="user" value="|-$currentAffiliateUser->getId()-|" />
				<input type='submit' value='##123,Agregar##' />
			</form></td>
	</tr>
</table>
|-/if-|
