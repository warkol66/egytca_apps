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
			<noscript><div align='center' class='errorMessage'>Su navegador tiene desabilitada la ejecución de Javascript.<br /><br />Este sistema requiere que la habilite para su correcto funcionamiento.<br /><br />Podrá ingresar al sistema pero recuerde que algunas funciones pueden no ejecutarse correctamente.</div></noscript>
			<p>Ingrese su usuario y contraseña para ingresar al sistema</p>
			|-if $message eq "wrongUser"-|
				<div align='center' class='errorMessage'>Usuario desconocido o contraseña incorrecta!. Intente nuevamente.</div> 
			|-elseif $message eq "missingData"-|
				<div align='center' class='errorMessage'>Debe ingresar usuario y contraseña válidos para ingresar al sistema.</div> 
			|-elseif $message eq "passwordSent"-|
				<div align='center' class='successMessage'>Se envió una nueva contraseña a su casilla de correo.</div> 
			|-/if-|
				<input type="hidden" name="do" value="commonDoLogin" id="loginFormDo" />
			<p></p> 
			<h1>Usuario</h1> 
			<p><input type='text' name='loginUsername' size='35' class="inputLogin" /> 
			 </p> 
			<h1>Contraseña</h1> 
			<p><input type='password' name='loginPassword' size='20' class="inputLogin" /></p> 
			<p><a href="Main.php?do=commonPasswordRecovery">¿Olvidó su contraseña?</a></p>
		<!--[if lte IE 6]><p>Su versión actual de navegador es IExplorer 6.<br />Este sistema requiere que utilice una versión mas nueva de Interntet Explorer.<br />
Debe actualizarla para el correcto funcionamiento del sistema.</p><![endif]-->
		 <!-- Begin LoginBottom --> 
		 <div id="loginBottom">
			<input type='submit' value='Ingresar' id="loginButton" /> 
		</div> 
		 <!-- End LoginBottom --> 
		</div>
		 <!-- End LoginContent --> 
	 </div> 
	<!-- End Login -->
	</div>
</form> 
