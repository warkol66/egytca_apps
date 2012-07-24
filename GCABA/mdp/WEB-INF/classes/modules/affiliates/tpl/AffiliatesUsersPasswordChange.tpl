<h2>Administración de Datos de Usuarios</h2>
<h1>Cambio de Contraseña</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
|-if $firstLogin-|
	<p>Este es su primer ingreso al sistema con una contraseña recuperada o generada por el administrador del sistema.<br />
	Por seguridad, le solicitamos ingrese una nueva contraseña para poder utilizar el sistema.</p>
	<p>Ingrese su contraseña actual y la nueva contraseña, haga click en Guardar para cambiarla.</p>
|-else-|
	<p>A continuación podrá cambiar la contraseña con la que ingresa al sistema.</p>
	<p>Ingrese su contraseña actual y la nueva contraseña, haga click en "Guardar" para cambiarla. Si desea cambiar su dirección de correo electrónico, ingrese la contraseña actual y modifique el correo.</p>
|-/if-|
|-if $message eq "wrongPassword"-|
	<div class='errorMessage'>La contraseña actual no coincide.</div>
|-elseif $message eq "changePassword"-|
	<div class='errorMessage'>La contraseña nueva no puede ser igual a la actual.</div>
|-elseif $message eq "changed"-|
	<div class='successMessage'>Su contraseña ha sido actualizada. |-if $firstLogin-|Debe salir del sistema y reingresar con su nueva clave.|-/if-|</div>
|-elseif $message eq "errorUpdate"-|
	<div class='errorMessage'>No se pudo guardar el cambio.</div>
|-/if-|
	<br />
<!-- inclusion de validación de javascript -->
|-include file='ValidationJavascriptInclude.tpl'-|
<form method='post' action='Main.php?do=affiliatesUsersPasswordDoChange'>
<fieldset title="Formulario de actualización de contraseña">
<legend>Datos del Usuario</legend>
	<input type='hidden' name='id' value='|-$currentUser->getId()-|' />
	<input type='hidden' name='firstLogin' value='|-$firstLogin-|' />
	<input type='hidden' name='message' value='|-$message-|' />
	<p><label for="username">##162,Identificación de Usuario##</label>
		<input id='usernameDisabled' name='usernameDisabled' type='text' value='|-$currentUser->getUsername()-|' size="30" disabled="disabled" />
	</p>
		<p><label for="name">##163,Nombre##</label>
			<input id='name' name='name' type='text' value='|-$currentUser->getName()|escape-|' size="50"  disabled="disabled"/>
		</p>
		<p><label for="surname">##164,Apellido##</label>
			<input id='surname' name='surname' type='text' value='|-$currentUser->getSurname()|escape-|' size="50"  disabled="disabled" />
		</p>
	<p><label for="mailAddress">E-mail</label>
	 	<input id='mailAddress' name='mailAddress' type='text' value='|-$currentUser->getMailAddress()-|' size="40" class="mailValidation" onchange="javascript:validationValidateFieldClienSide('mailAddress');" />	
	 	|-validation_msg_box idField=mailAddress-|</p>
		<p><label for="currentPass">Contraseña actual</label>
			<input id='currentPass' name='currentPass' type='password' value='' size="20"  class="emptyValidation" |-ajax_onchange_validation_attribute actionName=usersValidationPasswordX-| /> |-validation_msg_box idField=currentPass-|
		</p>
		<p><label for="pass">Nueva Contraseña</label>
			<input id='pass' name='pass' type='password' value='' size="20" class="emptyValidation" onchange="javascript:validationValidateFieldClienSide('pass');" /> |-validation_msg_box idField=pass-|
		</p>
		<p><label for="pass2">##166,Repetir Contraseña##</label>
			<input id='pass2' name='pass2' type='password' value='' size="20" class="passwordMatch" onchange="javascript:validationValidateFieldClienSide('pass2');" /> |-validation_msg_box idField=pass2-|
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
				|-if !$firstLogin-|<input type='button' onClick='javascript:history.go(-1)' value='##104,Regresar##'/>|-/if-|
	</p>

</fieldset>
</form>

