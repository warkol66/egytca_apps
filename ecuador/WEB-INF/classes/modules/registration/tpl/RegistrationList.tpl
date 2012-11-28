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
        <td colspan="6" class="tdSearch"><a href="javascript:void(null);" onClick='$("#divSearch").toggle();return false;' class="tdTitSearch">Busqueda por nombre</a>
            <div id="divSearch" style="display:none;"><form action='Main.php' method='get' style="display:inline;">
                <input type="hidden" name="do" value="registrationList" />
                Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
                &nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />|-if $filters|@count gt 0-|
                <input type='button' onClick='location.href="Main.php?do=registrationList"' value="Quitar Filtros" title="Quitar Filtros"/>
            |-/if-|</form></div></td>
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

    |-if $registrationUserColl|@count eq 0-|
    <tr>
        <td colspan="6">|-if isset($filters)-|No hay usuarios que concuerden con la búsqueda|-else-|No hay usuarios disponibles|-/if-|</td>
    </tr>
    |-else-|

	|-foreach from=$registrationUserColl item=user-|
	<tr>
		|-assign var=userInfoTelephone value=$user->getTelephone()-||-assign var=userInfoOrganization value=$user->getOrganization()-||-*assign var=userInfoGroup value=$user->getGroup()*-||-*assign var=userInfoCountry value=$user->getCountry()*-||-assign var=userCreated value=$user->getCreatedAt()-||-assign var=userLastLogin value=$user->getLastLogin()-|
		<td><a href="#" |-popup sticky=true caption="Información del Usuario" trigger="onMouseOver" text="Organización: $userOrganization <br />Teléfono: $userTelephone<br />Grupo: $userGroup<br />País: $userCountry<br />Fecha de registro: $userCreated<br />Último ingreso: $userLastLogin" snapx=10 snapy=10-|><img src="images/clear.png" class="linkImageInfo"></a></td>
		<td>|-$user->getSurname()-|</td>
		<td>|-$user->getName()-|</td>
		<td>|-$user->getMailAddress()-|</td>
		<td nowrap="nowrap">|-if $user->getActive()-|Activo|-else-|Inactivo|-/if-|</td>
		<td nowrap="nowrap">
            <a href='Main.php?do=registrationEdit&id=|-$user->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|' title="##114,Editar##"><img src="images/clear.png" class="icon iconEdit"></a>
            <a href='Main.php?do=registrationDoDelete&id=|-$user->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|' title="##115,Eliminar##" onClick='return window.confirm("¿Esta seguro que quiere eliminar este usuario?")'><img src="images/clear.png" class="icon iconDelete"></a>
        </td>
	</tr>
	|-/foreach-|
	|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="7" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>							
	|-/if-|
    |-/if-|
	<tr>
		<th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=registrationEdit" class="addLink">Crear Nuevo Usuario</a></div></th>
	</tr>
</table>
	
