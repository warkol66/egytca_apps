<form method='post' action="Main.php?do=affiliatesUsersDoLogin"> 
   <!-- Begin Login -->
   <div id="login">
    	<!-- Begin LoginTop -->
	   <div id="loginTop"></div>
	   <!-- End LoginTop -->
	   
		   <!-- Begin LoginContent -->
		   <div id="loginContent">
				|-if $message eq "wrongUser"-|
					<div align='center' class='errorMessage'>Usuario desconocido o contraseña incorrecta!. Intente nuevamente.</div>
				|-/if-|
				|-if $message eq "passwordSent"-|
					<div align='center' class='successMessage'>Se envio una nueva contraseña a su casilla de correo.</div>
				|-/if-|

	       <p>Ingrese su Identificación de usuario y contraseña para ingresar al sistema</p>
	       <h1>Usuario</h1>
	         <input type='text' name='username' size='35' />
	       </p>
	       <h1>Password</h1> 
	         <input type='password' name='password' size='20' /></p>  
			 </div>
			<!-- End LoginContent -->
		       
		 <!-- Begin LoginBottom -->       
       <div id="loginBottom"><input type='submit' value='Ingresar' class='button' id="loginButton" /></div>
	   <!-- End LoginBottom -->   
   
   
   </div>
   <!-- End Login -->
   
<script>
	self.moveTo(0,0); self.resizeTo(screen.availWidth,screen.availHeight)
	self.focus()
</script> 
</form>

