<script language="JavaScript" type="text/javascript">
function resetPassword(form){
	var fields = Form.serialize(form);
	var myAjax = new Ajax.Updater(
				{success: 'usersMsgField'},
				url,
				{
					method: 'post',
					postBody: fields,
					evalScripts: true
				});
	$('usersMsgField').innerHTML = '<span class="inProgress">generando nueva contraseña...</span>';
	return true;
}
</script>
<h2>##affiliates,1,Afiliados##</h2>
<h1>Administración de Usuarios de ##affiliates,1,Afiliados##</h1>
<p>A continuación podrá editar la lista de Usuarios de ##affiliates,1,Afiliados## del sistema.</p>
|-if $message eq "deleted"-|
<div class='successMessage'>Usuario eliminado</div>
|-elseif $message eq "activated"-|
<div class='successMessage'>Usuario reactivado</div>
|-elseif $message eq "ownerEdited"-|
<div class='successMessage'>El dueño ha sido modificado</div>
|-elseif $message eq "ownerNotEdited"-|
<div class='errorMessage'>El dueño no ha sido modificado</div>
|-/if-|
<span id="usersMsgField"></span>
<table cellpadding='5' cellspacing='0' width='100%' class='tableTdBorders'>
|-if $loginUser ne '' || $loginAffiliateUser ne ''-|
<tr>
<td colspan="5" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar usuario</a>
			<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none;|-/if-|"><form action="Main.php" method="get">
			<p>Texto a buscar: <input name="filters[searchString]" type="text" title="Ingrese el nombre, parte del nombre, apellido o parte del apellido a buscar" value="|-$filters.searchString-|" size="50" /></p>
			<p>|-if $loginUser ne ''-|Filtrar por ##affiliates,3,Afiliado##
			<select name="filters[searchAffiliateId]" onchange="this.form.submit();">
					<option value="0">Seleccione un ##affiliates,3,Afiliado##</option>
				|-foreach from=$affiliates item=affiliate name=for_affiliate-|
					<option value="|-$affiliate->getId()-|"|-if $affiliate->getId() eq $filters.searchAffiliateId-| selected="selected"|-/if-|>|-$affiliate->getName()-|</option>
				|-/foreach-|
			</select>|-/if-| 
				Resultados por página
				|-html_options name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getRowsPerPage()-|
				<input type='submit' value='Buscar' />
				|-if $filters.searchAffiliateId gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=affiliatesUsersList'" />|-/if-|</p>
			<input type="hidden" name="do" value="affiliatesUsersList" />
		</form></div>
</td>
</tr>
|-/if-|
	<tr class="thFillTitle">
			<th colspan="5"><div class="rightLink"><a href="Main.php?do=affiliatesUsersEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar usuario</a></div></th>
	</tr>
	<tr>
		<th>##affiliates,3,Afiliado##</th>
		<th>Identificación</th>
		<th>Apellido, Nombre</th>
		<th>E-mail</th>
		<th>&nbsp;</th>
	</tr>
	|-foreach from=$users item=user name=for_users-|
	<tr>
		<td width="15%">|-$user->getAffiliate()-|</td>
		<td width="25%">|-$user->getUsername()-|</td>
		<td width="25%">|-$user->getSurname()-|, |-$user->getName()-|</td>
		<td width="25%">|-$user->getMailAddress()-|</td>
		<td width="10%" nowrap>
			|-if "affiliatesUsersEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;"> 
			  <input type="hidden" name="do" value="affiliatesUsersEdit" /> 
			  <input type="hidden" name="id" value="|-$user->getId()-|" /> 
			  <input type="submit" name="submit_go_edit_affiliate" title="Editar" value="Editar" class="icon iconEdit" /> 
			</form>|-/if-|
			|-if "affiliatesUsersDoDelete"|security_has_access-|
			<form action="Main.php" method="post" style="display:inline;"> 
			  <input type="hidden" name="do" value="affiliatesUsersDoDelete" /> 
			  <input type="hidden" name="id" value="|-$user->getId()-|" /> 
			  <input type="submit" name="submit_go_delete_affiliate" value="Borrar" |-if $user->isAffiliateOwner()-|title="Para eliminar este usuario debe asignar la administración del afiliado a otro usuario" class="icon iconDelete disabled" onclick="return false;"|-else-|title="Eliminar" class="icon iconDelete" onclick="return confirm('Seguro que desea eliminar el usuario?')"|-/if-|  /> 
			</form>|-/if-|
		    |-if $loginUser ne ''-|
				|-if $user->isAffiliateOwner()-|
					<img src="images/clear.png" class="icon iconOwner" title="Este es el usuario dueño del ##affiliates,3,Afiliado##" />
				|-elseif "affiliatesDoSetOwner"|security_has_access-|
					<form method="post">
						<input type="hidden" name="userId" value="|-$user->getId()-|" />
						<input type="hidden" name="affiliateId" value="|-$user->getAffiliateId()-|" />
						<input type="hidden" name="do" value="affiliatesDoSetOwner" />
						<input type="submit" title="Fijar como dueño" value="Fijar como dueño" class="icon iconSetPrivileges" />
					</form>
				|-/if-| 
			|-/if-|
		|-if "affiliatesUsersPasswordResetX"|security_has_access-|
			|-if ($user->getMailAddress() ne '') && (!isset($loginAffiliateUser) || (isset($loginAffiliateUser) && ($loginAffiliateUser->getUsername() neq $user->getUsername())))-|<form method="post">
				<input type="hidden" name="do" value="affiliatesUsersPasswordResetX" />
				<input type="hidden" name="id" value="|-$user->getId()-|" />
				<input type="button" value="Resetear contraseña" onClick="if (confirm('Una nueva contraseña se enviará por correo a la dirección del usuario. ¿Seguro que desea resetear esta contraseña?')){resetPassword(this.form)}; return false" title="Resetear contraseña" class="icon iconPassword">
				</form>
			|-elseif ($user->getMailAddress() eq '' && (isset($loginAffiliateUser) && ($loginAffiliateUser->getUsername() neq $user->getUsername())))-|
				<input type="button" title="El usuario no posee dirección de correo electrónico, no se puede resetear la contraseña" class="icon iconPassword disabled">
			|-/if-|
		|-/if-|
		</td>
	</tr>
	|-/foreach-|
	|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="5" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
	|-/if-|
	<tr class="thFillTitle">
			<th colspan="5"><div class="rightLink"><a href="Main.php?do=affiliatesUsersEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar usuario</a></div></th>
	</tr>
</table>

|-if $deletedUsers|@count gt 0-|
<br />
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
	<tr>
		<td colspan='4' class='celltitulo2'>Usuarios Eliminados&nbsp;<a href="javascript:void(null)" class='deta' onClick="alert('Si quiere dar de alta a un usuario que estuvo registrado alguna vez, debe reactivarlo desde esta opción. Si lo intenta desde un usuario nuevo el sistema le informará que ese usuario ya está en uso.')">Ayuda</a> </td>
	</tr>
	<tr>
		<th>Identificación de Usuario</th>
		<th>&nbsp;</th>
	</tr>
	|-foreach from=$deletedUsers item=user name=for_deleted_users-|
	<tr>
		<td width="90%">|-$user->getUsername()-|</td>
		<td width="10%" nowrap><a href='Main.php?do=affiliatesUsersDoActivate&user=|-$user->getId()-|'><img src="images/clear.png"  class="icon iconActivate" /></a></td>
	</tr>
	|-/foreach-|
</table>
|-/if-|
