<div id="contentBody">
|-if isset($error) and $error-|
	<p>El código de verificación ingresado es inválido o ya fue utilizado.<br />
	Si ya verificó su cuenta haga click <a href="Main.php?do=registrationLogin">aquí</a> para ingresar al sistema y modificar sus datos</p>
|-/if-|
|-if isset($userActive)-|
	<p>Se ha activado la cuenta de usuario: |-$userActive->getUsername()-|</p>
	|-if $password neq ''-|
	<p>Se le ha asignado a la misma el siguiente Password: |-$password-| y podra acceder a la misma usando como usuario el siguiente email: |-$userActive->getUsername()-|</p>
	|-/if-|
	<p>Puede ingresar siguiendo <a href="Main.php?do=registrationLogin">este link.</a></p>
|-/if-|
|-if isset($userVerified)-|
	<p>Se ha verificado la cuenta de usuario: |-$userVerified->getUsername()-|</p>
	<p>Su registro será procesado por el administrador del sistema para activar su cuenta.<br />
	Cuando la misma esté activa, podrá ingresar siguiendo <a href="Main.php?do=registrationLogin">este link.</a></p>
|-/if-|
</div>