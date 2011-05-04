<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='titulo'>##40,Configuración del Sistema##</td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1'></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='fondotitulo'>##151,Administración de Usuarios##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>##152,A continuación podrá editar la lista de usuarios del sistema##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
|-if $message eq "deleted"-|
<div align='center' class='textoerror'>##153,Usuario eliminado##</div>
|-/if-|
|-if $message eq "activated"-|
<div align='center' class='textoerror'>##154,Usuario reactivado##</div>
|-/if-|
|-if $message eq "wrongPassword"-|
<div align='center' class='textoerror'>##155,Las contraseñas deben coincidir##</div>
|-/if-|
|-if $message eq "errorUpdate"-|
<div align='center' class='textoerror'>##156,Ha ocurrido un error al intentar guardar la información del usuario##</div>
|-/if-|
|-if $message eq "saved"-|
<div align='center' class='textoerror'>##157,Usuario guardado##</div>
|-/if-|
|-if $message eq "notAddedToGroup"-|
<div align='center' class='textoerror'>##158,Ha ocurrido un error al intentar agregar el usuario al grupo##</div>
|-/if-|
|-if $message eq "notRemovedFromGroup"-|
<div align='center' class='textoerror'>##159,Ha ocurrido un error al intentar eliminar el usuario al grupo##</div>
|-/if-|
|-if $accion eq "creacion" or $accion eq "edicion"-|
	|-if $accion eq "creacion"-|
			##160,Ingrese  la Identificación del usuario y la contraseña para el nuevo usuario,  luego haga click en Guardar para generar el nuevo usuario.##
	|-else-|
			##161,Realice los cambios en el usuario y haga click en Aceptar para guardar las modificaciones.##|-/if-| <br />
	<br />
|-if $accion eq "edicion"-||-assign var="currentUserInfo" value=$currentUser->getUserInfo()-||-/if-|
<form method='post' action='Main.php?do=usersDoEdit'>
	<input type='hidden' name='id' value='|-if $accion eq "edicion"-||-$currentUser->getId()-||-/if-|' />
	<table class='tablaborde' cellpadding='5' cellspacing='1' width='60%'>
		<tr>
			<td nowrap="nowrap" class='titulodato1'>##162,Identificación de Usuario##</td>
			<td class='celldato'><input name='username' type='text'  class='textodato' value='|-if $accion eq "edicion"-||-$currentUser->getUsername()-||-/if-|' size="70" /></td>
		</tr>
		<tr>
			<td class='titulodato1'>##163,Nombre##</td>
			<td class='celldato'><input name='name' type='text'  class='textodato' value='|-if $accion eq "edicion"-||-$currentUserInfo->getName()-||-/if-|' size="70" /></td>
		</tr>
		<tr>
			<td class='titulodato1'>##164,Apellido##</td>
			<td class='celldato'><input name='surname' type='text'  class='textodato' value='|-if $accion eq "edicion"-||-$currentUserInfo->getSurname()-||-/if-|' size="70" /></td>
		</tr>
		<tr>
			<td class='titulodato1'>##165,Contraseña##</td>
			<td class='celldato'><input name='pass' type='password' class='textodato' value='' size="50" /></td>
		</tr>
		<tr>
			<td class='titulodato1'>##166,Repetir Contraseña##</td>
			<td class='celldato'><input name='pass2' type='password' class='textodato' value='' size="50" /></td>
		</tr>
		<tr>
			<td class='titulodato1'>Nivel de Usuario</td>
			<td class='celldato'>
				<select name='levelId'>
					<option value="">Seleccionar nivel</option>
					|-foreach from=$levels item=level name=for_levels-|
					<option value="|-$level->getId()-|"|-if $accion eq "edicion" and $level->getId() eq $currentUser->getLevelId()-| selected="selected"|-/if-|>|-$level->getName()-|</option>
					|-/foreach-|
				</select>
			</td>
		</tr>
		<tr>
			<td class='cellboton' colspan='2'> |-if $accion eq "edicion"-|
				<input type="hidden" name="accion" value="edicion" />
				|-/if-|
				<input type='submit' name='guardar' value='##97,Guardar##'  class='boton' />
				&nbsp;&nbsp;
				<input type='button' onClick='javascript:history.go(-1)' value='##104,Regresar##' class='boton'  />
			</td>
		</tr>
	</table>
</form>
|-if $accion eq "edicion"-|
<table class='tablaborde' cellpadding='5' cellspacing='1' width='100%'>
	<caption>
	##167,El usuario ## |-$currentUser->getUsername()-| ##168,es miembro de los grupos:##
	</caption>
	|-if $currentUserGroups|@count eq 0-|
	<tr>
		<th>##169,El usuario todavía no es miembro de ningún grupo##.</th>
	</tr>
	|-else-|
	<tr>
		<th width="95%">##170,Grupo##</th>
		<th width="5%">&nbsp;</th>
	</tr>
	|-foreach from=$currentUserGroups item=userGroup name=for_user_group-|
	|-assign var="group" value=$userGroup->getGroup()-|
	<tr>
		<td class='celldato'><div class='titulo2'>|-$group->getName()-|</div></td>
		<td class='cellopciones' nowrap> [ <a href='Main.php?do=usersDoRemoveFromGroup&user=|-$currentUser->getId()-|&group=|-$group->getId()-|' class='elim'>##115,Eliminar##</a> ] </td>
	</tr>
	|-/foreach-|
	|-/if-|
	<tr>
		<td class='cellboton' colspan='4'>##171,Agregar al Usuario en el Grupo##:
			<form action='Main.php' method='post'>
				<input type="hidden" name="do" value="usersDoAddToGroup" />
				<select name="group">
					<option value="" selected="selected">##172,Seleccionar grupo##</option>
								|-foreach from=$groups item=group name=for_groups-|
					<option value="|-$group->getId()-|">|-$group->getName()-|</option>
								|-/foreach-|
				</select>
				<input type="hidden" name="user" value="|-$currentUser->getId()-|" />
				<input type='submit' value='##123,Agregar##' class='boton' />
			</form></td>
	</tr>
</table>
|-/if-|
|-/if-|
<table class='tablaborde' cellpadding='5' cellspacing='1' width='100%'>
	<tr>
		<th>##162,Identificación de Usuario##</th>
		<th>##163,Nombre##</th>
		<th>##164,Apellido##</th>
		<th>&nbsp;</th>
	</tr>
	|-foreach from=$users item=user name=for_users-|
	|-assign var="userInfo" value=$user->getUserInfo()-|
	<tr>
		<td class='celldato'><div class='titulo2'>|-$user->getUsername()-|</div></td>
		<td class='celldato'>|-$userInfo->getName()-|</td>
		<td class='celldato'>|-$userInfo->getSurname()-|</td>
		<td class='cellopciones' nowrap> [ <a href='Main.php?do=usersList&user=|-$user->getId()-|']' class='edit'>##114,Editar##</a> ]
			[ <a href='Main.php?do=usersDoDelete&user=|-$user->getId()-|']' class='elim'>##115,Eliminar##</a> ] </td>
	</tr>
	|-/foreach-|
	|-if $licensesLeft gt 0-|
	<tr>
		<td class='cellboton' colspan='4'><form action='Main.php' method='get'>
				<input type="hidden" name="do" value="usersList" />
				<input type="hidden" name="user" value="" />
				<input type='submit' value='##173,Nuevo Usuario##' class='boton' />
			</form></td>
	</tr>
	|-else-|
	<tr>
		<td class='cellboton' colspan='4'><input type='submit' value='##173,Nuevo Usuario##' class='boton' onClick="return alert('Todas las licencias se encuentran en uso. Si desea dar de alta un nuevo usuario debe eliminar alguno de los existentes.');"/></td>
	</tr>
	|-/if-|
</table>
<br />
<table class='tablaborde' cellpadding='5' cellspacing='1' width='100%'>
	<tr>
		<td colspan='4' class='celltitulo2'>##175,Usuarios Eliminados##&nbsp;<a href="javascript:void(null)" class='deta' onClick="alert('##174,Si quiere dar de alta a un usuario que estuvo registrado alguna vez, debe reactivarlo desde esta opción. Si lo intenta desde un usuario nuevo el sistema le informará que ese usuario ya está en uso.##')">##38,Ayuda##</a> </td>
	</tr>
	<tr>
		<th>##162,Identificación de Usuario##</th>
		<th>##163,Nombre##</th>
		<th>##164,Apellido##</th>
		<th>&nbsp;</th>
	</tr>
	|-foreach from=$deletedUsers item=user name=for_deleted_users-|
	|-assign var="userInfo" value=$user->getUserInfo()-|
	<tr>
		<td class='celldato'><div class='titulo2'> |-$user->getUsername()-| </div></td>
		<td class='celldato'> |-$userInfo->getName()-| </td>
		<td class='celldato'> |-$userInfo->getSurname()-| </td>
		<td class='cellopcionescen' nowrap> [ <a href='Main.php?do=usersDoActivate&user=|-$user->getId()-|'
|-if $licensesLeft eq 0-|
onClick="alert('##177,Todas las licencias se encuentran en uso. Si desea dar de alta un nuevo usuario debe eliminar alguno de los existentes.##');return false;"
|-/if-|
class='edit'>##176,Reactivar##</a> ] </td>
	</tr>
	|-/foreach-|
</table>
