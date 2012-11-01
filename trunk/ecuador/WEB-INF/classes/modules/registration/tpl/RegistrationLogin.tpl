<h2>Bienvenido al Sistema |-$parameters.siteName-|</h2> 
|-if $message eq "created"-|
	<div class='successMessage'>El Usuario ha sido creado. A continuación puede ingresar al sistema.</div>
|-elseif $message eq "wrongUser"-|
	<div class='failureMessage'>Usuario desconocido o contraseña incorrecta!. Intente nuevamente.</div>
|-elseif $message eq "passwordSent"-|
	<div class='successMessage'>Se envio una nueva contraseña a su casilla de correo.</div>
|-elseif $message eq "createdModerated"-|
	<div class='successMessage'>El Usuario ha sido creado. Su cuenta debera ser activada por un administrador para ser utilizada.</div>
|-/if-|
<form method='post' action="Main.php?do=registrationDoLogin"> 
	<fieldset> 
		<legend>Login</legend>
		<p>Ingrese su Identificación de usuario y contraseña para ingresar al sistema</p> 
		<p>
		<label for="registrationUsername">Identificación de Usuario</label> 
			<input type='text' name='registrationUsername' size='35' />
		</p> 
		<p>
		<label for="registrationPassword">Contraseña</label> 
			<input type='password' name='registrationPassword' size='20' />
		</p> 
		<p><input type='submit' value='Ingresar' />
		</p>
	</fieldset>
</form> 
