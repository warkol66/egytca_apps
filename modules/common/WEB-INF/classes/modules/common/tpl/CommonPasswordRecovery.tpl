<div id="loginWrapper"> 
	<!-- Begin Login --> 
	<div id="login">
		<div id="loginTopBorder"><b class="rounded"><b class="rtop"><b class="r7"></b><b class="r6"></b><b class="r5"></b><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b></b></div>
		 <!-- Begin loginContentWrapper --> 
		<div id="loginContentWrapper">
		<form method='post' action="Main.php?do=commonPasswordRecoveryDoRequest">
		 <!-- Begin LoginTop --> 
		 <div id="loginTop"></div><!-- End LoginTop --> 
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
								<img src="Main.php?do=commonCaptchaGeneration" />
							</p>
							<p>
								Ingrese el código de seguridad de la imagen <br />
								<input id="security_code" name="securityCode" type="text" size="10" />
							</p>
							<!-- End Captcha -->
				|-/if-|
		<!--[if lte IE 6]><p>Su versión actual de navegador es IExplorer 6.<br />Este sistema requiere que utilice una versión mas nueva de Interntet Explorer.<br />
													Debe actualizarla para el correcto funcionamiento del sistema.</p><![endif]-->
		</div><!-- End LoginContent --> 
		 <!-- Begin LoginBottom --> 
		 <div id="loginBottom">
			<div id="loginButtonDiv"><input type='submit' value='Enviar solicitud' id="loginButton" /></div>
		</div><!-- End LoginBottom --> 
		</form> 
	 </div><!-- End LoginContentWrapper --> 
	 <div id="loginBottomBorder"><b class="rounded"><b class="rbottom "><b class="r1"></b><b class="r2"></b><b class="r3"></b><b class="r4"></b><b class="r5"></b><b class="r6"></b><b class="r7"></b></b></b></div>
	</div><!-- End Login --> 
</div><!-- End loginWrapper --> 
