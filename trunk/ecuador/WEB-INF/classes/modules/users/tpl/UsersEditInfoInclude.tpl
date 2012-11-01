<script language="JavaScript" type="text/javascript">
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
<fieldset title="Formulario de Información adicional">
<legend>Información adicional del Usuario</legend>
	<div id="AdditionalInfo"> <span id="userInfoMsgField"></span> 
		<form method="post"> 
|-if $editInfo-|	<p><label for="userParams[name]">##users,163,Nombre##</label>
			<input id='userParams[name]' name='userParams[name]' type='text' value='|-$currentUser->getName()|escape-|' size="50" />|-validation_msg_box idField=userParams[name]-|
		</p>
		<p><label for="userParams[surname]">##users,164,Apellido##</label>
			<input id='userParams[surname]' name='userParams[surname]' type='text' value='|-$currentUser->getSurname()|escape-|' size="50" />|-validation_msg_box idField=userParams[surname]-|
		</p>
		<p><label for="userParams[mailAddress]">E-mail</label>
			<input id='userParams[mailAddress]' name='userParams[mailAddress]' type='text' value='|-$currentUser->getMailAddress()-|' size="40" class="mailValidation" onchange="javascript:validationValidateFieldClienSide('userParams[mailAddress]');" /> |-validation_msg_box idField=userParams[mailAddress]-|
		</p>
|-/if-|				<p><label for="userParams[documentType]">Tipo y Número de documento</label>
				<select name="userParams[documentType]" id="userParams[documentType]">
					<option value="">Tipo</option>
					|-foreach from=$documentTypes key=typeKey item=documentType name=for_documentTypes-|
					<option value="|-$typeKey-|" |-if isset($currentUser) and $currentUser->getDocumentType() eq $typeKey-|selected="selected"|-/if-|>|-$documentType-|</option>
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
		<p><label for="userParams[timezone]">Huso Horario</label>
				<select name="userParams[timezone]" id="userParams[timezone]">
					<option value="">Seleccione una zona horaria (opcional)</option>
					|-foreach from=$timezones item=timezone name=for_timezones-|
					<option value="|-$timezone->getCode()-|" |-if isset($currentUser) and $currentUser->getTimezone() eq $timezone->getCode()-|selected="selected"|-/if-|>|-$timezone->getDescription()-|</option>
					|-/foreach-|
				</select>
			</p>
				<input type="hidden" name="do" id="do" value="usersDoEditInfoX" /> 
				<input type="hidden" name="id" id="id" value="|-$currentUser->getId()-|" /> 
				<input type="button" value="Guardar información del Usuario" onClick="javascript:usersDoEditInfo(this.form)"/> 
			</p> 
		</form> 
</div>
</fieldset>
