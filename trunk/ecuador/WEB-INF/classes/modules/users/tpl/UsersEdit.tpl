<script type="text/javascript" src="scripts/jquery/egytca.js"></script>
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
|-if $user->isNew()-|
	<p>	##users,160,Ingrese la Identificación del usuario y la contraseña para el nuevo usuario, luego haga click en Guardar para generar el nuevo usuario.##</p>
|-else-|
	<p>	##users,161,Realice los cambios en el usuario y haga click en Aceptar para guardar las modificaciones.##</p>
|-/if-|
	<br />
<script language="JavaScript" type="text/javascript">
$(function(){
	$("#region").autocomplete({
		source: url + '?do=commonAutocompleteListX&type=json&object=region',
		change: function(event,ui){
			//para que no pueda poner un valor inexistente
			$(this).val((ui.item ? ui.item.label : ""));
		},
		select:function(event,ui){
			$("#region").val(ui.item.label);
			$("#selected-region").val(ui.item.value);
			return false;
		},
		minLength: 3,
		appendTo: '#region-container'
	});
});

function usersDoAddFromGroup(form) {
	var fields = $(form).serialize();
	$.ajax({
		url: url,
		type: 'post',
		data: fields,
		success: function(data) {
			$('#groupList').append($(data));
		}
	});
	$('#groupMsgField').html('<span class="inProgress">agregando usuario a grupo...</span>');
	return true;
}

function usersDoDeleteFromGroup(form){
	var fields = $(form).serialize();
	$.ajax({
		url: url,
		type: 'post',
		data: fields,
		success: function(data) {
			$('#groupMsgField').html($(data));
		}
	});
	$('#groupMsgField').html('<span class="inProgress">eliminando usuario de grupo...</span>');
	return true;
}

function usersDoEditInfo(form){
	var fields = $(form).serialize();
	$.ajax({
		url: url,
		type: 'post',
		success: function(data) {
			$('#userInfoMsgField').html($(data));
		}
	});
	$('#userInfoMsgField').html('<span class="inProgress">Actualizando información del usuario...</span>');
	return true;
}
</script>
<form method='post' action='Main.php?do=usersDoEdit'>
<fieldset title="Formulario de edición de usuarios">
<legend>Datos del Usuario</legend>
	<input type='hidden' name='id' value='|-if $action eq "edit"-||-$user->getId()-||-/if-|' />
|-if $action eq 'edit' and $user->getId() lt 3-|
	<p><label for="params[usernameDisabled]">##users,162,Identificación de Usuario##</label>
	|-if $action eq 'edit' and $user->getUsername() ne ''-|<input id='actualparams[username]' type='hidden' value='|-$user->getUsername()-|' />|-/if-|
		<input id='params[usernameDisabled]' name='params[usernameDisabled]' type='text' value='|-$user->getUsername()-|' size="30" disabled="disabled" />
|-else-|
	<p><label for="params[username]">##users,162,Identificación de Usuario##</label>
			|-if $action eq 'edit' and $user->getUsername() ne ''-|<input id='actualparams[username]' type='hidden' value='|-$user->getUsername()-|' />|-/if-|
			<input id='params[username]' name='params[username]' type='text' value='|-$user->getUsername()-|'  size="30"  class="emptyValidation" |-ajax_onchange_validation_attribute actionName='usersValidationUsernameX'-| /> |-validation_msg_box idField="params[username]"-|
|-/if-|</p>
		<p><label for="params[name]">##users,163,Nombre##</label>
			<input id='params[name]' name='params[name]' type='text' value='|-$user->getName()|escape-|' size="50" /> |-validation_msg_box idField="params[name]"-|
		</p>
		<p><label for="params[surname]">##users,164,Apellido##</label>
			<input id='params[surname]' name='params[surname]' type='text' value='|-$user->getSurname()|escape-|' size="50" /> |-validation_msg_box idField="params[surname]"-|
		</p>
		<p><label for="params[mailAddress]">E-mail</label>
			<input id='params[mailAddress]' name='params[mailAddress]' type='text' value='|-$user->getMailAddress()-|' size="40" class="mailValidation emptyValidation" onchange="javascript:validationValidateFieldClienSide('params[mailAddress]');" /> |-validation_msg_box idField="params[mailAddress]"-|
		</p>
		|-assign var=currentReg value=$user->getRegion()-|
		<p><label for="params[regionId]">Región</label>
			<div id="region-container" style="position:absolute; width: 400px;"></div><input type="text" id="region" placeholder="Ingrese una región" value="|-if is_object($currentReg)-||-$currentReg->getName()-||-/if-|"/>
			<input type="hidden" id="selected-region" name="params[regionId]" value="|-if is_object($currentReg)-||-$currentReg->getId()-||-/if-|" />
		</p>
		<p><label for="pass">##users,165,Contraseña##</label>
			<input id='pass' name='pass' type='password' value='' size="20" class="" onchange="javascript:setElementClass('pass','emptyValidation');setElementClass('pass2','passwordMatch');validationValidateFieldClienSide('pass');" /> |-validation_msg_box idField=pass-|
		</p>
		<p><label for="pass2">##users,166,Repetir Contraseña##</label>
			<input id='pass2' name='pass2' type='password' value='' size="20" class="" onchange="javascript:validationValidateFieldClienSide('pass2');" /> |-validation_msg_box idField=pass2-|
		</p>
		<p><label for="params[levelId]">Nivel de Usuario</label>
				|-if $action eq 'edit' and $user->getId() lt 3-|
				<input name="params[levelId]" id="params[levelId]" type="hidden" value="|-$user->getLevelId()-|" />
				<select name='params[levelIdDisabled]' id='params[levelIdDisabled]' disabled="disabled">
				|-else-|
				<select name='params[levelId]'>
				|-/if-|
					<option value="">Seleccionar nivel</option>
					|-foreach from=$levels item=level name=for_levels-|
					<option value="|-$level->getId()-|" |-$level->getId()|selected:$user->getLevelId()-|>|-$level->getName()-|</option>
					|-/foreach-|
				</select>
			</p>
		<p>	|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
				|-if $page gt 1-| <input type="hidden" name="page" id="page" value="|-$page-|" />|-/if-|
		<script language="JavaScript" type="text/JavaScript">showMandatoryFieldsMessage(this.form);</script>
				<input type="hidden" name="id" id="id" value="|-$user->getId()-|" /> 
						|-javascript_form_validation_button value='Guardar' title='Guardar'-|
				<input type='button' onClick='location.href="Main.php?do=usersList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de usuarios"/>
			</p>

</fieldset>
</form>

|-if !$user->isNew()-|
<fieldset title="Formulario de edición de grupos de usuarios">
<legend>Grupos de Usuarios</legend>
	<p>##users,167,El usuario ## |-$user->getName()-| |-$user->getSurname()-| (|-$user->getUsername()-|) ##168,es miembro de los grupos:##</p>
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
				<input type="hidden" name="userId" id="userId" value="|-$user->getId()-|" /> 
				<input type="button" value="Agregar Usuario al grupo" onClick="javascript:usersDoAddFromGroup(this.form)"/> 
			</p> 
		</form> 
		<ul id="groupList" class="iconOptionsList">
			 |-foreach from=$user->getUserGroups() item=userGroup name=for_group-|
			 |-assign var=group value=$userGroup->getGroup()-|			 
			<li id="groupListItem|-$group->getId()-|">
				<form  method="post"> 
					<input type="hidden" name="do" id="do" value="usersDoDeleteFromGroupX" /> 
					<input type="hidden" name="userId"  value="|-$user->getId()-|" /> 
					<input type="hidden" name="groupId"  value="|-$group->getId()-|" /> 
					<input type="button" value="Eliminar" onClick="javascript:usersDoDeleteFromGroup(this.form)" class="icon iconDelete" title="Eliminar el usuario del grupo"/> 
				</form> |-$group->getName()-|
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
		<p><label for="params[documentType]">Tipo y Número de documento</label>
				<select name="params[documentType]" id="params[documentType]">
					<option value="">Seleccione tipo de documento</option>
					|-foreach from=$documentTypes key=typeKey item=documentType name=for_documentTypes-|
					<option value="|-$documentType-|" |-if isset($user) and $user->getDocumentType() eq $documentType-|selected="selected"|-/if-|>|-$typeKey|@upper-|</option>
					|-/foreach-|
				</select>
				<input id="params[document]" name="params[document]" type='text' value='|-$user->getDocument()-|' size="30" />
			</p>
		<p><label for="params[birthdate]">Fecha de Nacimiento</label>
				<input id="params[birthdate]" name="params[birthdate]" type='text' value='|-$user->getBirthdate()-|' size="12" /> <img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[birthdate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
		<p><label for="params[gender]">Género</label>
				<select name="params[gender]" id="params[gender]">
					<option value="">Seleccione género</option>
					<option value="1" |-if isset($user) and $user->getGender() eq 1-|selected="selected"|-/if-|>Femenino</option>
					<option value="2" |-if isset($user) and $user->getGender() eq 2-|selected="selected"|-/if-|>Maculino</option>
				</select>
			</p>
|-if $configModule->get('users','useTimezones')-|
		<p><label for="params[timezone]">Huso Horario</label>
				<select name="params[timezone]" id="params[timezone]">
					<option value="">Seleccione una zona horaria (opcional)</option>
					|-foreach from=$timezones item=timezone name=for_timezones-|
					<option value="|-$timezone->getCode()-|" |-if isset($user) and $user->getTimezone() eq $timezone->getCode()-|selected="selected"|-/if-|>|-$timezone->getDescription()-|</option>
					|-/foreach-|
				</select>
			</p>
|-/if-|
				<input type="hidden" name="do" id="do" value="usersDoEditInfoX" /> 
				<input type="hidden" name="id" id="id" value="|-$user->getId()-|" /> 
				<input type="button" value="Guardar información del Usuario" onClick="javascript:usersDoEditInfo(this.form)"/> 
			</p> 
		</form> 
		</div>
	</fieldset>
|-/if-|
|-/if-|


|-include file="UsersEditAddonInclude.tpl"-|
<script language="JavaScript" type="text/javascript">
	$('#user_params_regionId').egytca('autocomplete', 'Main.php?do=regionsAutocompleteListX');
</script>
