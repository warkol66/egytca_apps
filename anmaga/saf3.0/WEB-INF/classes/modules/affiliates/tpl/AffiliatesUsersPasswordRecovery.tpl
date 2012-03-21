<script type="text/javascript" language="javascript" src="scripts/login.js"></script>
<form method='post' action="Main.php?do=affiliatesUsersPasswordRecoverySendConfirmationRequest">
	<div id="loginWrapper">
	<!-- Begin Login --> 
	<div id="login"><img src="images/passRecoveryTop.png" />
		 <!-- Begin LoginTop --> 
		 <div id="loginTop"></div> 
		 <!-- End LoginTop --> 
		 <!-- Begin LoginContent --> 
		 <div id="passRecovery"><br />
			<noscript><div align='center' class='errorMessage'>Su navegador tiene desabilitada la ejecución de Javascript.<br /><br />Este sistema requiere que la habilite para su correcto funcionamiento.<br /><br />Podrá ingresar al sistema pero recuerde que algunas funciones pueden no ejecutarse correctamente.</div></noscript>
			<h2>Recuperar contraseña</h2>
			<p>Ingrese su Identificación de usuario y su email para recibir una nueva contraseña en su casilla de correo electrónico</p>
				|-if $message eq "wrongUser"-|
					<div align='center' class='errorMessage'>Usuario desconocido o email incorrecto!. Intente nuevamente.</div>
				|-elseif $message eq "requestAlredyMade"-|
					<div align='center' class='errorMessage'>Usted ya tiene una petición de recuperación de contraseña pendiente de confirmación, por favor revise su casilla de correo electrónico.<br /> Si no tiene acceso a la misma o tiene problemas con la recuperación, comuniquese con el administrador del sistema</div>
				|-elseif $message eq "wrongCaptcha"-|
					<div align='center' class='errorMessage'>Código de verificación de imagen incorrecto. Intente nuevamente.</div>
				|-/if-|
				|-if $message neq "requestAlredyMade"-|
							<h1>Usuario</h1> 
							<p><input type='text' name='username' size='35'  class="inputLogin" /></p>
							<h1>E-Mail</h1>
							<p><input type='text' name='mailAddress' size='35'  class="inputLogin" /></p>
							
							<!--Captcha -->
							<p>
								<label for="newsletterSubscribe">Código de Seguridad</label>
								<img src="Main.php?do=commonCaptchaGeneration&width=120&height=45&characters=5" />
							</p>
							<p>
								Ingrese el código de seguridad de la imagen <br />
								<input id="security_code" name="securityCode" type="text" size="10" />
							</p>
							<!-- End Captcha -->
				|-/if-|
		<!--[if lte IE 6]><p>Su versión actual de navegador es IExplorer 6.<br />Este sistema requiere que utilice una versión mas nueva de Interntet Explorer.<br />
Debe actualizarla para el correcto funcionamiento del sistema.</p><![endif]-->
		 <!-- Begin LoginBottom --> 
		 <div id="loginBottom">
			<input type='submit' value='Solicitar contraseña' id="loginButton" /> 
		</div> 
		 <!-- End LoginBottom --> 
		</div>
		 <!-- End LoginContent --> 
	 </div> 
	<!-- End Login --> 
	</div>
	<script>
	self.moveTo(0,0); self.resizeTo(screen.availWidth,screen.availHeight)
	self.focus()
</script> 
</form> 
