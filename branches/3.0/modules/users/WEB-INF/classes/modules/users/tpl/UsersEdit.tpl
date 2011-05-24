<h2>##common,18,Configuración del Sistema##</h2>
<h1>##users,151,Administración de Usuarios##</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
|-if $message eq "deleted"-|
	<div class='successMessage'>##users,153,Usuario eliminado##</div>
|-elseif $message eq "activated"-|
	<div class='successMessage'>##users,154,Usuario reactivado##</div>
|-elseif $message eq "wrongPassword"-|
	<div class='errorMessage'>##users,155,Las contraseñas deben coincidir##</div>
|-elseif $message eq "errorUpdate"-|
	<div class='errorMessage'>##users,156,Ha ocurrido un error al intentar guardar la información del usuario##</div>
|-elseif $message eq "ok"-|
	<div class='successMessage'>##users,157,Usuario guardado##</div>
|-elseif $message eq "notAddedToGroup"-|
	<div class='errorMessage'>##users,158,Ha ocurrido un error al intentar agregar el usuario al grupo##</div>
|-elseif $message eq "notRemovedFromGroup"-|
	<div class='errorMessage'>##users,159,Ha ocurrido un error al intentar eliminar el usuario al grupo##</div>
|-elseif $message eq "notLinkedWithSupplier"-|
	<div class='errorMessage'>##users,156,Ha ocurrido un error al relacionar el usuario con el correspondiente Supplier##</div>
|-/if-|
|-if $action eq "create" or $action eq "edit"-|
	|-if $action eq "create"-|
		<p>	##users,160,Ingrese la Identificación del usuario y la contraseña para el nuevo usuario, luego haga click en Guardar para generar el nuevo usuario.##</p>
	|-else-|
		<p>	##users,161,Realice los cambios en el usuario y haga click en Aceptar para guardar las modificaciones.##</p>
	|-*assign var="currentUserInfo" value=$currentUser->getUserInfo()*-|
	|-/if-|
	<br />
|-/if-|
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
function usersDoEditInfo(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'userInfoMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('userInfoMsgField').innerHTML = '<span class="inProgress">Actualizando información del usuario...</span>';
	return true;
}
</script>
|-include file='ValidationJavascriptInclude.tpl'-|
<form method='post' action='Main.php?do=usersDoEdit'>
<fieldset title="Formulario de edición de usuarios">
<legend>Datos del Usuario</legend>
	<input type='hidden' name='id' value='|-if $action eq "edit"-||-$currentUser->getId()-||-/if-|' />
|-if $action eq 'edit' and $currentUser->getId() lt 3-|
	<p><label for="userParams[usernameDisabled]">##users,162,Identificación de Usuario##</label>
		<input id='userParams[usernameDisabled]' name='userParams[usernameDisabled]' type='text' value='|-$currentUser->getUsername()-|' size="30" disabled="disabled" />
|-else-|
	<p><label for="userParams[username]">##users,162,Identificación de Usuario##</label>
			<input id='userParams[username]' name='userParams[username]' type='text' value='|-$currentUser->getUsername()-|'  size="30" |-ajax_onchange_validation_attribute actionName=usersValidationUsernameX-| />|-validation_msg_box idField=userParams[username]-|
|-/if-|</p>
		<p><label for="userParams[name]">##users,163,Nombre##</label>
			<input id='userParams[name]' name='userParams[name]' type='text' value='|-$currentUser->getName()|escape-|' size="50" />|-validation_msg_box idField=userParams[name]-|
		</p>
		<p><label for="userParams[surname]">##users,164,Apellido##</label>
			<input id='userParams[surname]' name='userParams[surname]' type='text' value='|-$currentUser->getSurname()|escape-|' size="50" />|-validation_msg_box idField=userParams[surname]-|
		</p>
		<p><label for="userParams[mailAddress]">E-mail</label>
			<input id='userParams[mailAddress]' name='userParams[mailAddress]' type='text' value='|-$currentUser->getMailAddress()-|' size="40" class="mailValidation" onchange="javascript:validationValidateFieldClienSide('userParams[mailAddress]');" /> |-validation_msg_box idField=userParams[mailAddress]-|
		</p>
		<p><label for="pass">##users,165,Contraseña##</label>
			<input id='pass' name='pass' type='password' value='' size="20" class="" onchange="javascript:setElementClass('pass','emptyValidation');setElementClass('pass2','passwordMatch');validationValidateFieldClienSide('pass');" /> |-validation_msg_box idField=pass-|
		</p>
		<p><label for="pass2">##users,166,Repetir Contraseña##</label>
			<input id='pass2' name='pass2' type='password' value='' size="20" class="" onchange="javascript:validationValidateFieldClienSide('pass2');" /> |-validation_msg_box idField=pass2-|
		</p>
		<p><label for="userParams[levelId]">Nivel de Usuario</label>
				|-if $action eq 'edit' and $currentUser->getId() lt 3-|
				<input name="userParams[levelId]" id="userParams[levelId]" type="hidden" value="|-$currentUser->getLevelId()-|" />
				<select name='userParams[levelIdDisabled]' id='userParams[levelIdDisabled]' disabled="disabled">
				|-else-|
				<select name='userParams[levelId]'>
				|-/if-|
					<option value="">Seleccionar nivel</option>
					|-foreach from=$levels item=level name=for_levels-|
					<option value="|-$level->getId()-|"|-if $action eq "edit" and $level->getId() eq $currentUser->getLevelId()-| selected="selected"|-/if-|>|-$level->getName()-|</option>
					|-/foreach-|
				</select>
			</p>
		<p> |-if $action eq "edit"-|
				<input type="hidden" name="accion" value="edit" />
				|-/if-|
				|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if $page gt 1-| <input type="hidden" name="page" id="page" value="|-$page-|" />|-/if-|
						|-javascript_form_validation_button value='Guardar' title='Guardar'-|
				<input type='button' onClick='location.href="Main.php?do=usersList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de usuarios"/>
			</p>

</fieldset>
</form>

|-if $action eq "edit"-|
<fieldset title="Formulario de edición de grupos de usuarios">
<legend>Grupos de Usuarios</legend>
	<p>##users,167,El usuario ## |-$currentUser->getName()-| |-$currentUser->getSurname()-| (|-$currentUser->getUsername()-|) ##168,es miembro de los grupos:##</p>
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
			 |-foreach from=$currentUser->getGroups() item=groupRelation name=for_group-|			 
			 |-assign var="group" value=$groupRelation->getGroup()-|
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
|-if $configModule->get('users','aditionalInfo')-|
<fieldset title="Formulario de Información adicional">
<legend>Información adicional del Usuario</legend>
	<div id="AdditionalInfo"> <span id="userInfoMsgField"></span> 
		<form method="post"> 
		<p><label for="userParams[documentType]">Tipo y Número de documento</label>
				<select name="userParams[documentType]" id="userParams[documentType]">
					<option value="">Seleccione tipo de documento</option>
					|-foreach from=$documentTypes key=typeKey item=documentType name=for_documentTypes-|
					<option value="|-$documentType-|" |-if isset($currentUser) and $currentUser->getDocumentType() eq $documentType-|selected="selected"|-/if-|>|-$typeKey|@upper-|</option>
					|-/foreach-|
				</select>
				<input id="userParams[document]" name="userParams[document]" type='text' value='|-$currentUser->getDocument()-|' size="30" />
			</p>
		<p><label for="userParams[birthdate]">Fecha de Nacimiento</label>
				<input id="userParams[birthdate]" name="userParams[birthdate]" type='text' value='|-$currentUser->getBirthdate()-|' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('userParams[birthdate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
		<p><label for="userParams[gender]">Género</label>
				<select name="userParams[gender]" id="userParams[gender]">
					<option value="">Seleccione género</option>
					<option value="1" |-if isset($currentUser) and $currentUser->getGender() eq 1-|selected="selected"|-/if-|>Femenino</option>
					<option value="2" |-if isset($currentUser) and $currentUser->getGender() eq 2-|selected="selected"|-/if-|>Maculino</option>
				</select>
			</p>
|-if $configModule->get('users','useTimezones')-|
		<p><label for="userParams[timezone]">Huso Horario</label>
				<select name="userParams[timezone]" id="userParams[timezone]">
					<option value="">Seleccione una zona horaria (opcional)</option>
					|-foreach from=$timezones item=timezone name=for_timezones-|
					<option value="|-$timezone->getCode()-|" |-if isset($currentUser) and $currentUser->getTimezone() eq $timezone->getCode()-|selected="selected"|-/if-|>|-$timezone->getDescription()-|</option>
					|-/foreach-|
				</select>
			</p>
|-/if-|
				<input type="hidden" name="do" id="do" value="usersDoEditInfoX" /> 
				<input type="hidden" name="id" id="id" value="|-$currentUser->getId()-|" /> 
				<input type="button" value="Guardar información del Usuario" onClick="javascript:usersDoEditInfo(this.form)"/> 
			</p> 
		</form> 
		</div>
	</fieldset>
|-/if-|
|-/if-|


|-include file="UsersEditAddonInclude.tpl"-|
