|-if $message eq "wrongUser"-|
	<div class='errorMessage'>Ingresó un usuario desconocido o email incorrecto!. Intente nuevamente.</div>
|-/if-|
 <p>El sistema generará una contraseña que le será enviada a la cuenta de correo que utlizó para su registro. En caso de no poder acceder a la misma, puede solicitar el envío a la cuenta de correo alternativa.</p>
<form method='post' action="Main.php?do=registrationDoPasswordRecovery">
	<fieldset>
		<legend>
			Recuperar Contraseña
		</legend>
		<p>
			Ingrese su dirección de correo eletrónico para recibir una nueva contraseña
		</p>
		<p>
			<label for='username' >Identificación</label>
			<input type='text' name='username' size='45' />
		</p>
		<p>
			<label for='alternateMailSend'>Enviar a dirección alternativa</label>
			<input type='checkbox' name='alternateMailSend' value="1" />
		</p>
		<p>
			<input type='submit' value='Enviar' class='button' />
		</p>
	</fieldset>
</form> 
