<script language="JavaScript" type="text/javascript">
function usersDoAddFromGroup(form) {
	
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'groupList'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});
				
	$('groupMsgField').innerHTML = '<span class="inProgress">agregando usuario a grupo...</span>';
	
	return true;
}

function usersDoDeleteFromGroup(form){

	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'groupMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
				
				});
				
	$('groupMsgField').innerHTML = '<span class="inProgress">eliminando usuario de grupo...</span>';
	
	return true;

}
</script>
<!-- inclusion de validación de javascript -->
|-include file='ValidationJavascriptInclude.tpl'-|

<form method='post' action='Main.php?do=usersDoEdit'>
<fieldset title="Formulario de edición de usuarios">
<legend>Datos del Usuario</legend>
	<input type='hidden' name='id' value='|-if $action eq "edit"-||-$currentUser->getId()-||-/if-|' />
	<p><label for="username">##162,Identificación de Usuario##</label>
|-if $action eq 'edit' and $currentUser->getId() lt 3-|
		<input name="username" type="hidden" value="|-$currentUser->getUsername()-|" />
		<input id='usernameDisabled' name='usernameDisabled' type='text' value='|-$currentUser->getUsername()-|' size="30" disabled="disabled" />
|-else-|
			<input id='username' name='username' type='text' value='|-if $action eq "edit"-||-$currentUser->getUsername()-||-/if-|'  size="30" |-ajax_onchange_validation_attribute actionName=usersValidationUsernameX-| />|-validation_msg_box idField=username-|
|-/if-|</p>
		<p><label for="name">##163,Nombre##</label>
			<input id='name' name='name' type='text' value='|-if $action eq "edit"-||-$currentUserInfo->getName()|escape-||-/if-|' size="50" />|-validation_msg_box idField=name-|
		</p>
		<p><label for="surname">##164,Apellido##</label>
			<input id='surname' name='surname' type='text' value='|-if $action eq "edit"-||-$currentUserInfo->getSurname()|escape-||-/if-|' size="50" />|-validation_msg_box idField=surname-|
		</p>
		<p><label for="mailAddress">E-mail</label>
			<input id='mailAddress' name='mailAddress' type='text' value='|-if $action eq "edit"-||-$currentUserInfo->getMailAddress()-||-/if-|' size="40" class="mailValidation" onchange="javascript:validationValidateFieldClienSide('mailAddress');" /> |-validation_msg_box idField=mailAddress-|
		</p>
		<p><label for="pass">##165,Contraseña##</label>
			<input id='pass' name='pass' type='password' value='' size="20" class="" onchange="javascript:setElementClass('pass','emptyValidation');setElementClass('pass2','passwordMatch');validationValidateFieldClienSide('pass');" /> |-validation_msg_box idField=pass-|
		</p>
		<p><label for="pass2">##166,Repetir Contraseña##</label>
			<input id='pass2' name='pass2' type='password' value='' size="20" class="" onchange="javascript:validationValidateFieldClienSide('pass2');" /> |-validation_msg_box idField=pass2-|
		</p>
		<p><label for="username">Nivel de Usuario</label>
				|-if $action eq 'edit' and $currentUser->getId() lt 3-|
				<input name="levelId" type="hidden" value="|-$currentUser->getLevelId()-|" />
				<select name='levelIdDisabled' disabled="disabled">
				|-else-|
				<select name='levelId'>
				|-/if-|
					<option value="">Seleccionar nivel</option>
					|-foreach from=$levels item=level name=for_levels-|
					<option value="|-$level->getId()-|"|-if $action eq "edit" and $level->getId() eq $currentUser->getLevelId()-| selected="selected"|-/if-|>|-$level->getName()-|</option>
					|-/foreach-|
				</select>
			</p>
|-if $configModule->get('users','useTimezones')-|
		<p><label for="username">Huso Horario</label>
				<select name='timezone'>
					<option value="">Seleccione una zona horaria (opcional)</option>
					|-foreach from=$timezones item=timezone name=for_timezones-|
					<option value="|-$timezone->getCode()-|" |-if isset($currentUser) and $currentUser->getTimezone() eq $timezone->getCode()-|selected="selected"|-/if-|>|-$timezone->getDescription()-|</option>
					|-/foreach-|
				</select>
			</p>
|-/if-|
		<p> |-if $action eq "edit"-|
				<input type="hidden" name="accion" value="edit" />
				|-/if-|
						|-javascript_form_validation_button value=Guardar-|
				<input type='button' onClick='javascript:history.go(-1)' value='##104,Regresar##'/>
			</p>

</fieldset>
</form>

|-if $action eq "edit"-|


<fieldset title="Formulario de edición de grupos de usuarios">
<legend>Grupos de Usuarios</legend>
	<p>##167,El usuario ## |-$currentUserInfo->getName()-| |-$currentUserInfo->getSurname()-| (|-$currentUser->getUsername()-|) ##168,es miembro de los grupos:##</p>
	<div id="GroupsManage"> <span id="groupMsgField"></span> 
		<form method="post"> 
			<p> 
				<select id="groupId" name="groupId" title="groupId" > 
					<option value="">Seleccione un grupo</option>
					|-foreach from=$groups item=group name=for_group-|
					<option id="groupOption|-$group->getId()-|" value="|-$group->getId()-|" >|-$group->getName()-|</option> 
					|-/foreach-|
				</select> 
				<input type="hidden" name="do" id="do" value="usersDoAddToGroupX" /> 
				<input type="hidden" name="userId" id="userId" value="|-$currentUser->getId()-|" /> 
				<input type="button" value="Agregar Usuario al grupo" onClick="javascript:usersDoAddFromGroup(this.form)"/> 
			</p> 
		</form> 
		<ul id="groupList">
			 |-foreach from=$currentUserGroups item=userGroup name=for_group-||-assign var="group" value=$userGroup->getGroup()-|
			<li id="groupListItem|-$group->getId()-|">|-$group->getName()-|
				<form  method="post"> 
					<input type="hidden" name="do" id="do" value="usersDoDeleteFromGroupX" /> 
					<input type="hidden" name="userId"  value="|-$currentUser->getId()-|" /> 
					<input type="hidden" name="groupId"  value="|-$group->getId()-|" /> 
					<input type="button" value="Eliminar" onClick="javascript:usersDoDeleteFromGroup(this.form)" class="icon iconDelete" /> 
				</form> 
			</li> 
			|-/foreach-|
		</ul> 
	</div>
	</fieldset>






<!--
<fieldset title="Formulario de edición de grupos de usuarios">
<legend>Grupos de Usuarios</legend>
	<p>##167,El usuario ## |-$currentUser->getUsername()-| ##168,es miembro de los grupos:##</p>
		|-if $currentUserGroups|@count eq 0-|
		<p>##169,El usuario todavía no es miembro de ningún grupo##.</p>
			|-else-|
		<ul class="ulOptions">
			|-foreach from=$currentUserGroups item=userGroup name=for_user_group-|
				|-assign var="group" value=$userGroup->getGroup()-|
					<li class="liOptions"><span class="textOptionMove" style="float:left;width:40%;">|-$group->getName()-|</span>			
					<span style="float:left;width:15%;text-align:right;">|-if $currentUser->isSupplier()-|
						<span class='deactivated' title="No se puede eliminar de este grupo"><img src="images/clear.png" class="icon iconDeleteDisabled"></span>
					|-else-|
						<a href='Main.php?do=usersDoRemoveFromGroup&user=|-$currentUser->getId()-|&group=|-$group->getId()-|' title="Eliminar de este grupo"><img src="images/clear.png" class="icon iconDelete"></a>
					|-/if-|</span><br style="clear: all" />
</li>
			|-/foreach-|
			</ul>
		|-/if-|
		|-if not ($currentUser->isSupplier())-|
				<form action='Main.php' method='post'><p><label for="group">##171,Agregar a Grupo##</label>
					
						<input type="hidden" name="do" value="usersDoAddToGroup" />
						<select name="group">
							<option value="" selected="selected">##172,Seleccionar grupo##</option>
								|-foreach from=$groups item=group name=for_groups-|
							<option value="|-$group->getId()-|">|-$group->getName()-|</option>
								|-/foreach-|
						</select>
						<input type="hidden" name="user" value="|-$currentUser->getId()-|" />
						<input type='submit' value='##123,Agregar##'/>
				
			</p>	</form>
		|-/if-|
	</fieldset>	
|-/if-|
-->

|-include file="UsersEditAddonInclude.tpl"-|
