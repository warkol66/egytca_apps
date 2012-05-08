<table width='760' border='0' cellpadding='0' cellspacing="0" class='fondoffffff'>
	<tr> 
		<td class="cabezal">&nbsp;</td> 
	</tr> 
	<tr> 
		<td><!--fin encabezado --> 
			<table border='0' cellpadding='0' cellspacing='0' width='520' align='center'> 
				<tr> 
					<td>&nbsp;</td> 
				</tr> 
				<tr> 
					<td class='backgroundTitle'>Bienvenido al Sistema |-$parameters.siteName-|</td> 
				</tr> 
				<tr> 
					<td>&nbsp;</td> 
				</tr> 
				|-if $message eq "wrongUser"-|
				<tr> 
					<td><div align='center' class='errorMessage'>Usuario desconocido o email incorrecto!. Intente nuevamente.</div></td>
				</tr> 
				|-/if-|
				<tr> 
					<td>&nbsp;</td> 
				</tr> 
			</table> 
			<form method='post' action="Main.php?do=affiliatesUsersDoPasswordRecovery">
				<center> 
					<table width='520' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'> 
						<tr> 
							<td colspan='2' class='tdTitle'>Ingrese su Identificaci&oacute;n de usuario y su email para recibir una nueva contraseña en su casilla de correo electr&oacute;nico</td>
						</tr>
						<tr> 
							<td width='20%' nowrap class='tdTitle'>Identificaci&oacute;n de Usuario</td> 
							<td class='tdData'><input type='text' name='username' size='35' /></td> 
						</tr> 
						<tr> 
							<td class='tdTitle'>E-Mail</td>
							<td class='tdData'><input type='text' name='mailAddress' size='35' /></td>
						</tr> 
						<tr> 
							<td colspan='2' class='buttonCell' align='center'><input type='submit' value='Enviar' class='button' /></td> 
						</tr> 
					</table> 
				</center> 
			</form> 
			<br /> 
			<br /> 
			<br /> 
			<script>
	self.moveTo(0,0); self.resizeTo(screen.availWidth,screen.availHeight)
	self.focus()
</script> 
			<!--inicio de pie --> </td> 
	</tr> 
</table>
