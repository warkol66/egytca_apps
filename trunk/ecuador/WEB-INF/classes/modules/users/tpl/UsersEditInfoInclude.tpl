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
|-if $editInfo-|	<p><label for="params[name]">##users,163,Nombre##</label>
			<input id='params[name]' name='params[name]' type='text' value='|-$user->getName()|escape-|' size="50" />|-validation_msg_box idField="params[name]"-|
		</p>
		<p><label for="params[surname]">##users,164,Apellido##</label>
			<input id='params[surname]' name='params[surname]' type='text' value='|-$user->getSurname()|escape-|' size="50" />|-validation_msg_box idField="params[surname]"-|
		</p>
		<p><label for="params[mailAddress]">E-mail</label>
			<input id='params[mailAddress]' name='params[mailAddress]' type='text' value='|-$user->getMailAddress()-|' size="40" class="mailValidation" onchange="javascript:validationValidateFieldClienSide('params[mailAddress]');" /> |-validation_msg_box idField="params[mailAddress]"-|
		</p>
|-/if-|	
		<p><label for="params[timezone]">Huso Horario</label>
				<select name="params[timezone]" id="params[timezone]">
					<option value="">Seleccione una zona horaria (opcional)</option>
					|-foreach from=$timezones item=timezone name=for_timezones-|
					<option value="|-$timezone->getCode()-|" |-if isset($user) and $user->getTimezone() eq $timezone->getCode()-|selected="selected"|-/if-|>|-$timezone->getDescription()-|</option>
					|-/foreach-|
				</select>
			</p>
				<input type="hidden" name="do" id="do" value="usersDoEditInfoX" /> 
				<input type="hidden" name="id" id="id" value="|-$user->getId()-|" /> 
				<input type="button" value="Guardar información del Usuario" onClick="javascript:usersDoEditInfo(this.form)"/> 
			</p> 
		</form> 
</div>
</fieldset>
