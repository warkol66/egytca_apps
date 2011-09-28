|-include file='ValidationJavascriptInclude.tpl'-|
<!-- inclusion de validación de javascript -->
<div id="loginWrapper"> 
	<!-- Begin Login --> 
	<div id="login">
		<div id="loginTopBorder"><b class="rounded"><b class="rtop"><b class="r7"></b><b class="r6"></b><b class="r5"></b><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b></b></div>
		 <!-- Begin loginContentWrapper --> 
		<div id="loginContentWrapper">
		 <!-- Begin LoginTop --> 
		 <div id="loginTop"></div><!-- End LoginTop --> 
		 <!-- Begin LoginContent --> 
		<form method="post" action="Main.php?do=commonPasswordDoSetFromRecovery">
		<input name="recoveryHash" type="hidden" value="|-$recoveryHash-|" />
		 <div id="loginContent"><br />
 			<noscript><div align='center' class='errorMessage'>Su navegador tiene desabilitada la ejecución de Javascript.
			<br /><br />Este sistema requiere que la habilite para su correcto funcionamiento.
			<br /><br />Podrá ingresar al sistema pero recuerde que algunas funciones pueden no ejecutarse correctamente.</div></noscript>
			<h1>Recuperar contraseña</h1> 
			<p>Para completar el proceso de recuperación de contraseña, ingrese la contraseña que desea utilizar y haga click en guardar</p> 
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

	<h1><label for="pass">Nueva Contraseña</label></h1> 
		<p><input id='pass' name='pass' type='password' value='' size="20" class="emptyValidation" onchange="javascript:validationValidateFieldClienSide('pass');" /> |-validation_msg_box idField=pass-|
	</p>
	<h1><label for="pass2">Repetir Contraseña</label></h1>
		<p><input id='pass2' name='pass2' type='password' value='' size="20" class="passwordMatch" onchange="javascript:validationValidateFieldClienSide('pass2');" /> |-validation_msg_box idField=pass2-|
	</p>

		<!--[if lte IE 6]><p>Su versión actual de navegador es IExplorer 6.<br />Este sistema requiere que utilice una versión mas nueva de Interntet Explorer.<br />
													Debe actualizarla para el correcto funcionamiento del sistema.</p><![endif]-->
		</div><!-- End LoginContent --> 
		 <!-- Begin LoginBottom --> 
		 <div id="loginBottom">
			<div id="loginButtonDiv">|-javascript_form_validation_button value=Guardar id=loginButton-|</div>
		</div><!-- End LoginBottom --> 
		 </form>
	 </div><!-- End LoginContentWrapper --> 
	 <div id="loginBottomBorder"><b class="rounded"><b class="rbottom "><b class="r1"></b><b class="r2"></b><b class="r3"></b><b class="r4"></b><b class="r5"></b><b class="r6"></b><b class="r7"></b></b></b></div>
	</div><!-- End Login --> 
</div><!-- End loginWrapper --> 
