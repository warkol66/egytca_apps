|-if $message eq "logged"-|
<div id="success"><p>Autenticación exitosa!</p>
<p>|-*$loginRegistrationUser->getUsername()*-|</p>
<p>Puede <a href="Main.php?do=registrationEdit">editar las opciones de su Cuenta</a> o
<a href="Main.php?do=registrationDoLogout">cerrar la sesión</a></p>
</div>
	<script language="JavaScript" type="text/JavaScript">
		$('registrationLoginFormInclude').hide();
	</script>
|-elseif $message eq "wrongUser"-|
	<div id="failure"><p>Ingreso un usuario desconocido o una contraseña incorrecta!. Intente nuevamente.<br />
	Si no recuerda su contraseña haga click <a href="Main.php?do=registrationPasswordRecovery">aquí</a> para recuperarla</div>
|-/if-|

