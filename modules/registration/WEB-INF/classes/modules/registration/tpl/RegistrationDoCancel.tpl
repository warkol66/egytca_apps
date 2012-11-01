<div id="contentBody">
|-if isset($error) and $error-|
	<p>El código de verificación ingresado es inválido o ya fue utilizado.<br />
	Si ya verificó su cuenta haga click <a href="Main.php?do=registrationLogin">aquí</a> para ingresar al sistema y modificar sus datos</p>
|-else-|
	<p>
		Se ha cancelado la solicitud de verificación de cuenta.
	</p>
|-/if-|
</div>