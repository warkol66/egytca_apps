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
			<input id='userParams[name]' name='userParams[name]' type='text' value='|-$currentUser->getName()|escape-|' size="50" />|-validation_msg_box idField="userParams[name]"-|
		</p>
		<p><label for="userParams[surname]">##users,164,Apellido##</label>
			<input id='userParams[surname]' name='userParams[surname]' type='text' value='|-$currentUser->getSurname()|escape-|' size="50" />|-validation_msg_box idField="userParams[surname]"-|
		</p>
		<p><label for="userParams[mailAddress]">E-mail</label>
			<input id='userParams[mailAddress]' name='userParams[mailAddress]' type='text' value='|-$currentUser->getMailAddress()-|' size="40" class="mailValidation" onchange="javascript:validationValidateFieldClienSide('userParams[mailAddress]');" /> |-validation_msg_box idField="userParams[mailAddress]"-|
		</p>
|-/if-|	
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
