|-popup_init src="scripts/overlib.js"-|
<h2>Registro de Usuarios</h2> 
<h1>Administración de Usuarios Registrados</h1>
	<p>A continuación podrá editar la lista de usuarios por registro</p>
|-if $message eq "deleted"-|
	<div class='successMessage'>Usuario eliminado</div>
|-elseif $message eq "saved"-|
	<div class='successMessage'>Usuario guardado</div>
|-elseif $message eq "created"-|
	<div class='successMessage'>Usuario creado</div>
|-/if-|
<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-registrationusers">
	<col width="5%">
	<col width="30%">
	<col width="30%">
	<col width="25%">
	<col width="10%">
	<col width="5%">
	<thead>
	<tr>
		<td colspan='7' class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch" style="display:inline;">Busqueda de usuario</a>
			<div id="divSearch" style="display:|-if isset($searchString)-|block|-else-|none|-/if-|;">
			<form action='Main.php' method='get' style="display:inline;">
	  		<input type="hidden" name="do" value="registrationSearch" id="do" />
				Texto a buscar: <input name="searchString" type="text" size="13" class="textbox" value="|-if isset($searchString)-||-$searchString-||-/if-|" /><br />
				El texto ingresado se buscará en identificación de usuario, nombre, apellido y correo electrónico
				<input type="submit" name="searchSubmit" value="Buscar" class="tdSearchButton"/>|-if isset($searchString)-|&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="searchSubmit" value="Ver todos" class="tdSearchButton" onclick="location.href='Main.php?do=registrationList'"/>|-/if-|
		</form></div></td>
	</tr>
	<tr>
		<th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=registrationEdit" class="addLink">Crear Nuevo Usuario</a></div></th>
	</tr>
	<tr>
		<th>&nbsp;</th>
		<th>Apellido</th>
		<th>Nombre</th>
		<th>Email</th>
		<th>Estado</th>		
		<th>&nbsp;</th>
	</tr>
	</thead>
	|-foreach from=$users item=user-|
	<tr>	
		|-assign var=userinfo value=$user->getUserInfo()-||-assign var=userInfoTelephone value=$userinfo->getTelephone()-||-assign var=userInfoOrganization value=$userinfo->getOrganization()-||-*assign var=userInfoGroup value=$userInfo->getGroup()*-||-*assign var=userInfoCountry value=$userInfo->getCountry()*-||-assign var=userCreated value=$user->getCreated()-||-assign var=userLastLogin value=$user->getLastLogin()-|
		<td><a href="#" |-popup sticky=true caption="Información del Usuario" trigger="onMouseOver" text="Organización: $userInfoOrganization <br />Teléfono: $userInfoTelephone<br />Grupo: $userInfoGroup<br />País: $userInfoCountry<br />Fecha de registro: $userCreated<br />Último ingreso: $userLastLogin" snapx=10 snapy=10-|><img src="images/clear.png" class="linkImageInfo"></a></td>
		<td>|-$userinfo->getSurname()-|</td>
		<td>|-$userinfo->getName()-|</td>
		<td>|-$userinfo->getMailAddress()-|</td>
		<td nowrap="nowrap">|-if $user->isActive()-|Activo|-else-|Inactivo|-/if-|</td>
		<td nowrap="nowrap"><a href="Main.php?do=registrationEdit&id_registered_user=|-$user->getId()-|"><img src="images/clear.png" class="linkImageEdit"></a> <a href="Main.php?do=registrationDoDelete&id_registered_user=|-$user->getId()-|"><img src="images/clear.png" class="linkImageDelete"></a></td>
	</tr>
	|-/foreach-|
	|-if $pager->getTotalPages() gt 1-|
		<tr> 
			<td colspan="7" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>							
	|-/if-|						
	<tr>
		<th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=registrationEdit" class="addLink">Crear Nuevo Usuario</a></div></th>
	</tr>
</table>
	
