<form method='post' action="Main.php" onsubmit="return registrationDoLogin(this)"> 
	<div id="registrationLoginMessage">
	</div>
	<div id="registrationLoginFormInclude">	
		<label for="registrationUsername">Usuario</label>
		<input type='text' name='registrationUsername' class='textbox' />
		<label for="registrationPassword">Contraseña</label>
		<input type='password' name='registrationPassword' class='textbox' />
		<input type="hidden" name="do" value="registrationDoLogin" />
		<input type="hidden" name="ajax" value="1" />
		<p><input name="submit" type='submit' class='button' value='Ingresar' /></p>
		<p><a href="Main.php?do=registrationEdit">&nbsp;&nbsp;Registrarse&nbsp;&nbsp;</a></p>
	</div>
</form> 
