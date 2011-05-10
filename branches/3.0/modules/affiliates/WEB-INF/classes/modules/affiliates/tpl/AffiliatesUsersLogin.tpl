<script type="text/javascript" language="javascript" src="scripts/login.js"></script>
<form method='post' action="Main.php"> 
	<div id="loginWrapper"> 
	<!-- Begin Login --> 
	<div id="login"> 
		 <!-- Begin LoginTop --> 
		 <div id="loginTop"></div> 
		 <!-- End LoginTop --> 
		 <!-- Begin LoginContent --> 
		 <div id="loginContent"><br />
			<noscript><div align='center' class='errorMessage'>Su navegador tiene desabilitada la ejecución de Javascript.<br /><br />Este sistema requiere que la habilite para su correcto funcionamiento.<br /><br />Podrá ingresar al sistema pero recuerde que algunas funciones pueden no ejecutarse correctamente.</div></noscript><p>|-if isset($unifiedLogin)-|Selecciones el tipo de usuario e i|-else-|I|-/if-|ngrese su usuario y contraseña para ingresar al sistema</p> 
			|-if $message eq "wrongUser"-|
				<div align='center' class='errorMessage'>Usuario desconocido o contraseña incorrecta!. Intente nuevamente.</div> 
			|-elseif $message eq "wrongHash"-|
					<div align='center' class='errorMessage'>El código de confirmación ingresado parece ser invalido o bien ya ha sido utilizado. Por favor verifique la escritura o intente solicitar un código nuevo.</div>
			|-elseif $message eq "expiredHash"-|
					<div align='center' class='errorMessage'>El código de confirmación ingresado ha expirado. Por favor solicite uno nuevo.</div>
			|-elseif $message eq "anotherError"-|
					<div align='center' class='errorMessage'>Ha ocurrido un error inesperado con la validación. Intente nuevamente.</div>
			|-elseif $message eq "passwordSent"-|
				<div align='center' class='successMessage'>Se envió una nueva contraseña a su casilla de correo.</div> 
			|-elseif $message eq "passwordChanged"-|
				<div align='center' class='successMessage'>Contraseña cambiada exitosamente.</div> 
			|-elseif $message eq "confirmationMailSent"-|
				<div align='center' class='successMessage'>Se envió un mail de verificación a su casilla de correo.</div> 
			|-/if-|

			<input type="hidden" name="do" value="affiliatesUsersDoLogin" id="loginFormDo" />
			<p></p> 
			<h1>Usuario</h1> 
			<p><input type='text' name='loginUsername' size='35' class="inputLogin" /> 
			 </p> 
			<h1>Contraseña</h1> 
			<p><input type='password' name='loginPassword' size='20' class="inputLogin" /> 
			 </p> 
		<!--[if lte IE 6]><p>Su versión actual de navegador es IExplorer 6.<br />Este sistema requiere que utilice una versión mas nueva de Interntet Explorer.<br />
Debe actualizarla para el correcto funcionamiento del sistema.</p><![endif]-->
		 <!-- Begin LoginBottom --> 
		 <div id="loginBottom">
			<p><input type='submit' value='Ingresar' id="loginButton" /> </p>
			<p><a href="Main.php?do=affiliatesUsersPasswordRecovery">¿Olvidó su contraseña?</a></p>
		</div> 
		 <!-- End LoginBottom --> 
		</div>
		 <!-- End LoginContent --> 
	 </div> 
	<!-- End Login --> 
	</div>
</form> 
