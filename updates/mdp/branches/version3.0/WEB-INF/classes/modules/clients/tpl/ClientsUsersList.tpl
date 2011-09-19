<h2>##clients,1,Clientes##</h2>
<h1>Administración de Usuarios de ##clients,1,Clientes##</h1>
<p>A continuación podrá editar la lista de Usuarios de ##clients,1,Clientes## del sistema.</p>
|-if $message eq "deleted"-|
<div class='successMessage'>Usuario eliminado</div>
|-elseif $message eq "activated"-|
<div class='successMessage'>Usuario reactivado</div>
|-elseif $message eq "ownerEdited"-|
<div class='successMessage'>El dueño ha sido modificado</div>
|-elseif $message eq "ownerNotEdited"-|
<div class='errorMessage'>El dueño no ha sido modificado</div>
|-/if-|
<table cellpadding='5' cellspacing='0' width='100%' class='tableTdBorders'>
|-if $loginUser ne ''-|
<tr>
<td colspan="5" class="tdSearch">
			<form action="Main.php" method="get">
			<p>Filtrar por ##clients,3,Cliente##
			<select name="filters[searchClientId]" onchange="this.form.submit();">
					<option value="0">Seleccione un ##clients,3,Cliente##</option>
					<option value="-1">Todos</option>
				|-foreach from=$clients item=client name=for_client-|
					<option value="|-$client->getId()-|"|-if $client->getId() eq $filters.searchClientId-| selected="selected"|-/if-|>|-$client->getName()-|</option>
				|-/foreach-|
			</select> 
				|-if $filters.searchClientId gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=clientsUsersList'" />|-/if-|</p>
			<input type="hidden" name="do" value="clientsUsersList" />
		</form>
</td>
</tr>
|-/if-|
	<tr class="thFillTitle">
			<th colspan="5"><div class="rightLink"><a href="Main.php?do=clientsUsersEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar usuario</a></div></th>
	</tr>
	<tr>
		<th>##clients,3,Cliente##</th>
		<th>Identificación</th>
		<th>Apellido, Nombre</th>
		<th>E-mail</th>
		<th>&nbsp;</th>
	</tr>
	|-foreach from=$users item=user name=for_users-|
	<tr>
		<td width="15%">|-$user->getClient()-|</td>
		<td width="25%">|-$user->getUsername()-|</td>
		<td width="25%">|-$user->getSurname()-|, |-$user->getName()-|</td>
		<td width="25%">|-$user->getMailAddress()-|</td>
		<td width="10%" nowrap>
			<form action="Main.php" method="get" style="display:inline;"> 
			  <input type="hidden" name="do" value="clientsUsersEdit" /> 
			  <input type="hidden" name="id" value="|-$user->getId()-|" /> 
			  <input type="submit" name="submit_go_edit_client" title="Editar" value="Editar" class="icon iconEdit" /> 
			</form>
			<form action="Main.php" method="post" style="display:inline;"> 
			  <input type="hidden" name="do" value="clientsUsersDoDelete" /> 
			  <input type="hidden" name="id" value="|-$user->getId()-|" /> 
			  <input type="submit" name="submit_go_delete_client" value="Borrar" |-if $user->isClientOwner()-|title="Para eliminar este usuario debe asignar la administración del cliente a otro usuario" class="icon iconDelete disabled" onclick="return false;"|-else-|title="Eliminar" class="icon iconDelete" onclick="return confirm('Seguro que desea eliminar el usuario?')"|-/if-|  /> 
			</form>
		    |-if $loginUser ne ''-|
				|-if $user->isClientOwner()-|
					<img src="images/clear.png" class="icon iconOwner" title="Este es el usuario dueño del ##clients,3,Cliente##" />
				|-else-|
					<form method="post">
						<input type="hidden" name="userId" value="|-$user->getId()-|" />
						<input type="hidden" name="clientId" value="|-$user->getClientId()-|" />
						<input type="hidden" name="do" value="clientsDoSetOwner" />
						<input type="submit" title="Fijar como dueño" value="Fijar como dueño" class="icon iconSetPrivileges" />
					</form>
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
			<th colspan="5"><div class="rightLink"><a href="Main.php?do=clientsUsersEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar usuario</a></div></th>
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
		<td width="10%" nowrap><a href='Main.php?do=clientsUsersDoActivate&user=|-$user->getId()-|'><img src="images/clear.png"  class="icon iconActivate" /></a></td>
	</tr>
	|-/foreach-|
</table>
|-/if-|
