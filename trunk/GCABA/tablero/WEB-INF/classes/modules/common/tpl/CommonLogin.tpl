<div id="loginWrapper"> 
	<!-- Begin Login --> 
	<div id="login">
		<div id="loginTopBorder"><b class="rounded"><b class="rtop"><b class="r7"></b><b class="r6"></b><b class="r5"></b><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b></b></div>
		 <!-- Begin loginContentWrapper --> 
		<div id="loginContentWrapper">
		<form method='post' action="Main.php"> 
		 <!-- Begin LoginTop --> 
		 <div id="loginTop"></div><!-- End LoginTop --> 
		 <!-- Begin LoginContent --> 
		 <div id="loginContent"><br />
 			<noscript><div align='center' class='errorMessage'>Su navegador tiene desabilitada la ejecución de Javascript.
			<br /><br />Este sistema requiere que la habilite para su correcto funcionamiento.
			<br /><br />Podrá ingresar al sistema pero recuerde que algunas funciones pueden no ejecutarse correctamente.</div></noscript>
			<p>|-if isset($unifiedLogin)-|Selecciones el tipo de usuario e i|-else-|I|-/if-|ngrese su usuario y contraseña para ingresar al sistema</p> 
			|-if $message eq "dataMissmatch"-|
				<div align='center' class='errorMessage'>Usuario desconocido o contraseña incorrecta!. Intente nuevamente.</div> 
			|-elseif $message eq "missingData"-|
				<div align='center' class='errorMessage'>Para acceder al sistema debe ingresar usuario y contraseña. Intente nuevamente.</div> 
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
				<div align='center' class='successMessage'>Se envió un mail de verificación a su casilla de correo. Siga las intrucciones indicadas en el mismo para recuperar su contraseña.</div> 
			|-/if-|
				<input type="hidden" name="do" value="commonDoLogin" id="loginFormDo" />
			<h1>Usuario</h1> 
			<p><input type='text' name='loginUsername' size='35' /></p> 
			<h1>Contraseña</h1> 
			<p><input type='password' name='loginPassword' size='20' /></p> 
		<!--[if lte IE 6]><p>Su versión actual de navegador es IExplorer 6.<br />Este sistema requiere que utilice una versión mas nueva de Interntet Explorer.<br />
													Debe actualizarla para el correcto funcionamiento del sistema.</p><![endif]-->
		</div><!-- End LoginContent --> 
		 <!-- Begin LoginBottom --> 
		 <div id="loginBottom">
			<div id="loginButtonDiv"><input type='submit' value='Ingresar' id="loginButton" /></div>
			<div id="lostPassword"><a href="Main.php?do=commonPasswordRecovery">¿Olvidó su contraseña?</a></div>
		</div><!-- End LoginBottom --> 
		</form> 
	 </div><!-- End LoginContentWrapper --> 
	 <div id="loginBottomBorder"><b class="rounded"><b class="rbottom "><b class="r1"></b><b class="r2"></b><b class="r3"></b><b class="r4"></b><b class="r5"></b><b class="r6"></b><b class="r7"></b></b></b></div>
	</div><!-- End Login --> 
</div><!-- End loginWrapper --> 
