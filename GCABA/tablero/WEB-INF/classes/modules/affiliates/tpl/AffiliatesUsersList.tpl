<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración de Usuarios de Instituciones </h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
|-if $action eq "edit"-|
	<p class='paragraphEdit'>##180,Realice los cambios en el usuario y haga click en "Guardar Cambios" para guardar las modificaciones. ##</p>
|-else-|
	<p class='paragraphEdit'>A continuación podrá editar la lista de Usuarios de Instituciones guardados en el Sistema.</p>
|-/if-|
|-if $message eq "deleted"-|
<div class='successMessage'>##153,Usuario eliminado##</div>
|-elseif $message eq "activated"-|
<div class='successMessage'>##154,Usuario reactivado##</div>
|-elseif $message eq "wrongPassword"-|
<div class='errorMessage'>##155,Las contraseñas deben coincidir##</div>
|-elseif $message eq "emptyAffiliate"-|
<div class='errorMessage'>##155,Debe selecccionar un afiliado##</div>
|-elseif $message eq "emptyUsername"-|
<div class='errorMessage'>##155,Debe completar el nombre de usuario##</div>
|-elseif $message eq "errorUpdate"-|
<div class='errorMessage'>##156,Ha ocurrido un error al intentar guardar la información del usuario##</div>
|-elseif $message eq "saved"-|
<div class='successMessage'>##157,Usuario guardado##</div>
|-elseif $message eq "notAddedToGroup"-|
<div class='errorMessage'>##158,Ha ocurrido un error al intentar agregar el usuario al grupo##</div>
|-elseif $message eq "notRemovedFromGroup"-|
<div class='errorMessage'>##159,Ha ocurrido un error al intentar eliminar el usuario al grupo##</div>
|-/if-|
|-if $accion eq "creacion" or $accion eq "edicion"-|
	|-if $accion eq "creacion"-|
			##160,Ingrese  la Identificación del usuario y la contraseña para el nuevo usuario,  luego haga click en Guardar para generar el nuevo usuario.##
	|-else-|
			##161,Realice los cambios en el usuario y haga click en Aceptar para guardar las modificaciones.##|-/if-| <br />
	<br />
	|-include file="AffiliatesUsersEditInclude.tpl"-|
|-/if-|


|-if $showList-|

|-if $loginUser ne ''-|
<h3>Ver Usuarios por Institución</h3>
			<form name="affiliateFilter" action="Main.php" method="get">
<p>			<select name="affiliateId">
					<option value="0">Seleccione una Institución</option>
					<option value="-1">Todas</option>
				|-foreach from=$affiliates item=affiliate name=for_affiliate-|
					<option value="|-$affiliate->getId()-|"|-if $affiliate->getId() eq $affiliateId-| selected="selected"|-/if-|>|-$affiliate->getName()-|</option>
				|-/foreach-|
			</select> 
			<input type="hidden" name="do" value="affiliatesUsersList" />
			<input name="submit" type="submit" value="Consultar" class="button" />
		</p>
		</form>
|-/if-|

<table cellpadding='5' cellspacing='1' width='100%' class='tableTdBorders'>
	<tr>
		<th>##162,Identificación de Usuario##</th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Email</th>
		<th>&nbsp;</th>
	</tr>
	|-foreach from=$users item=user name=for_users-|
	<tr>
		<td width="45%">|-$user->getUsername()-|</td>
			|-assign var="userInfo" value=$user->getAffiliateUserInfo()-|
		<td width="45%">|-$userInfo->getName()-|</td>
		<td width="45%">|-$userInfo->getSurname()-|</td>
		<td width="45%">|-$userInfo->getMailAddress()-|</td>
		<td width="10%" nowrap><a href='Main.php?do=affiliatesUsersList&user=|-$user->getId()-|' title="##114,Editar##"><img src="images/clear.png" class="linkImageEdit"></a>
		<a href='Main.php?do=affiliatesUsersDoDelete&id=|-$user->getId()-|' title="##115,Eliminar##"><img src="images/clear.png" class="linkImageDelete"></a></td>
	</tr>
	|-/foreach-|
	<tr>
		<td class='cellboton' colspan='5'><form action='Main.php' method='get'>
				<input type="hidden" name="do" value="affiliatesUsersList" />
				<input type="hidden" name="user" value="" />
				<input type="hidden" name="affiliateId" value="|-$affiliateId-|" />
				<input type='submit' value='##173,Nuevo Usuario##' class='button' />
			</form></td>
	</tr>
</table>

|-if $deletedUsers|@count gt 0-|
<br />
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<tr>
		<td colspan='4' class='celltitulo2'>##175,Usuarios Eliminados##&nbsp;<a href="javascript:void(null)" class='detail' onClick="alert('##174,Si quiere dar de alta a un usuario que estuvo registrado alguna vez, debe reactivarlo desde esta opción. Si lo intenta desde un usuario nuevo el sistema le informará que ese usuario ya está en uso.##')">##38,Ayuda##</a> </td>
	</tr>
	<tr>
		<th>##162,Identificación de Usuario##</th>
		<th>&nbsp;</th>
	</tr>
	|-foreach from=$deletedUsers item=user name=for_deleted_users-|
	<tr>
		<td width="90%"><div class='titulo2'>|-$user->getUsername()-|</div></td>
		<td width="10%" nowrap class='cellTextOptions'> [ <a href='Main.php?do=affiliatesUsersDoActivate&user=|-$user->getId()-|' class='edit'>##176,Reactivar##</a> ] </td>
	</tr>
	|-/foreach-|
</table>
|-/if-|

|-/if-|