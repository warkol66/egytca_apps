<?php /* Smarty version 2.6.16, created on 2010-04-23 16:33:19
         compiled from users_login.tpl */ ?>
<table width="760" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" height="5"><img src="images/merlogo_n1.gif" width="101" height="5" border="0" /></td>
		<td height="5" align="left" valign="top" class="filled1"></td>
		<td align="left" height="5" valign="top"><img src="images/menu_rtc.gif" width="6" height="5"></td>
	</tr>
	<tr>
		<td width="99" valign="top" class="fondomenu"><img src="images/merlogo_n3.gif" width="99" height="80" border="0"></td>
		<td align="left" valign="top" bgcolor="ffffff"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr valign="top">
					<td height="20" align="right" class="filled1"><div class='opciomenusup'>&nbsp; &nbsp; &nbsp; </div>
						<div class='opciomenusup'><a href='Main.php?do=htmlsShow&name=##5,acercadelsistema##' class='texto12bblanco'> &nbsp; &nbsp;##4,Acerca del Sistema##&nbsp; &nbsp; </a></div>
						<div class='opciomenusup'><a href='Main.php?do=htmlsShow&name=##7,contactenos##' class='texto12bblanco'> &nbsp; &nbsp;##6,Contátenos##&nbsp;	&nbsp; </a></div>
						<img src="images/clear.gif" width="20" height="1" border="0"></td>
				</tr>
			</table>
			<table class='fondoffffff' width='100%' border='0' cellspacing="0" cellpadding='0'>
				<tr>
					<td><img src="images/clear.gif" width="10" height="5"></td>
					<td width='100%'><img src="images/clear.gif" width="10" height="5"></td>
					<td><img src="images/clear.gif" width="10" height="5"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><!--fin encabezado -->
						<table border='0' cellpadding='0' cellspacing='0' width='520' align='center'>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td class='fondotitulo'>##2,Bienvenido al Sistema de Manejo Estratégico de Relaciones##</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
						<?php if ($this->_tpl_vars['message'] == 'wrongUser'): ?>
						<div align='center' class='textoerror'>##11,Usuario desconocido o contraseña incorrecta!##</div>
						<?php endif; ?>
						<form method='post' action="Main.php?do=usersDoLogin">
							<center>
								<table width='520' border="0" cellpadding='5' cellspacing='1' class='tablaborde'>
									<tr>
										<td colspan='2' class='titulodato1'>##3,Ingrese su Identificación de usuario y contraseña para ingresar al sistema##</td>
									</tr>
									<tr>
										<td width='20%' nowrap class='titulodato1'>##8,Identificación de Usuario ##</td>
										<td class='celldato'><input type='text' name='username' size='35' /></td>
									</tr>
									<tr>
										<td class='titulodato1'>##9,Contraseña##</td>
										<td class='celldato'><input type='password' name='password' size='20' /></td>
									</tr>
									<tr>
										<td colspan='2' class='celldato' align='center'><input type='submit' value='##10,Ingresar##' class='boton' /></td>
									</tr>
								</table>
							</center>
						</form>
						<br />
						<br />
						<br />
						<div align="right"> <img src="images/Logoegytcatt.gif" width="115" height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
						</div>
						<script>
	self.moveTo(0,0); self.resizeTo(screen.availWidth,screen.availHeight)
	self.focus()
</script>
						<!--inicio de pie -->
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table></td>
		<td align="left" valign="top" class="bordederecho"><table width="100%" border="0" cellspacing="0" cellpadding="0" name="Principal">
				<tr valign="top">
					<td height="20" class="filled1"><img src="images/clear.gif" width="4" height="20"></td>
				</tr>
			</table></td>
	</tr>
	<tr>
		<td height="6" class="bordebajo_izq"><img src="images/clear.gif" width="100" height="6"></td>
		<td height="6" class="bordebajo"><img src="images/clear.gif" width="574" height="6"></td>
		<td height="6"><img src="images/rbbluewh.gif" width="6" height="6"></td>
	</tr>
</table>