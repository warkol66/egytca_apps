<h2>Administración de Datos de Usuarios</h2>
<h1>Cambio de Contraseña</h1>
<p>A continuación podrá cambiar la contraseña con la que ingresa al sistema.</p>
<p>Ingrese la nueva contraseña dos veces y haga click en Guardar.</p>
<!-- inclusion de validación de javascript -->
|-include file='ValidationJavascriptInclude.tpl'-|

<form method='post' action='Main.php?do=usersPasswordDoChangeForRecovery'>
<fieldset title="Formulario de actualización de contraseña">
	<input name="recoveryHash" type="hidden" value="|-$recoveryHash-|" />
	<p><label for="pass">Nueva Contraseña</label>
		<input id='pass' name='pass' type='password' value='' size="20" class="emptyValidation" onchange="javascript:validationValidateFieldClienSide('pass');" /> |-validation_msg_box idField=pass-|
	</p>
	<p><label for="pass2">Repetir Contraseña</label>
		<input id='pass2' name='pass2' type='password' value='' size="20" class="passwordMatch" onchange="javascript:validationValidateFieldClienSide('pass2');" /> |-validation_msg_box idField=pass2-|
	</p>
	<p> 
		|-javascript_form_validation_button value=Guardar-|
	</p>

</fieldset>
</form>

