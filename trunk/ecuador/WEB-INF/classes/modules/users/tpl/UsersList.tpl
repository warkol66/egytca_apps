<script language="JavaScript" type="text/javascript">
function resetPassword(form){
	$.ajax({
		url: url,
		data: $('#' + form).serialize(),
		type: 'post',
		success: function(data){
			$('#usersMsgField').html(data);
		}	
	});
	$('usersMsgField').html('<span class="inProgress">generando nueva contraseña...</span>');
	return true;
}

function unblockUser(form){
	$.ajax({
		url: url,
		data: $('#' + form).serialize(),
		type: 'post',
		success: function(data){
			$('#usersMsgField').html(data);
		}	
	});
	$('#usersMsgField').html('<span class="inProgress">desbloqueando usuario...</span>');
	return true;
}
$(function() {
	$.datepicker.setDefaults($.datepicker.regional['es']);
	$( ".datepickerFrom" ).datepicker({
		dateFormat:"dd-mm-yy",
		maxDate: new Date,
		onClose: function(selectedDate) {
			$(".datepickerTo").datepicker("option", "minDate", selectedDate);
			$("#dateTo").prop("disabled",false);
		}
	}).attr('readonly', 'readonly').css('backgroundColor', '#FFF');;
	$(".datepickerTo").datepicker({
		dateFormat:"dd-mm-yy",
		maxDate: new Date,
		onClose: function(selectedDate) {
			$(".datepickerFrom").datepicker("option", "maxDate", selectedDate);
			$("#buttonStatistics").prop("disabled",false);
		}
	}).attr('readonly', 'readonly').css('backgroundColor', '#FFF');;
});
</script>
<h2>##common,18,Configuración del Sistema##</h2>
<h1>##151,Administración de Usuarios##</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>##152,A continuación podrá editar la lista de usuarios del sistema##</p>
|-if $message eq "deleted"-|
	<div class='successMessage'>##153,Usuario eliminado##</div>
|-elseif $message eq "activated"-|
	<div class='successMessage'>##154,Usuario reactivado##</div>
|-elseif $message eq "wrongPassword"-|
	<div class='errorMessage'>##155,Las contraseñas deben coincidir##</div>
|-elseif $message eq "errorUpdate"-|
	<div class='errorMessage'>##156,Ha ocurrido un error al intentar guardar la información del usuario##</div>
|-elseif $message eq "saved"-|
	<div class='successMessage'>##157,Usuario guardado##</div>
|-elseif $message eq "added"-|
	<div class='successMessage'>Usuario agregado</div>
|-elseif $message eq "notAddedToGroup"-|
	<div class='errorMessage'>##158,Ha ocurrido un error al intentar agregar el usuario al grupo##</div>
|-elseif $message eq "notRemovedFromGroup"-|
	<div class='errorMessage'>##159,Ha ocurrido un error al intentar eliminar el usuario al grupo##</div>
|-elseif $message eq "notLinkedWithSupplier"-|
	<div class='errorMessage'>##156,Ha ocurrido un error al relacionar el usuario con el correspondiente Supplier##</div>
|-/if-|
|-if $action eq "add" or $action eq "edit"-|
	|-if $action eq "add"-|
		<p>	##160,Ingrese la Identificación del usuario y la contraseña para el nuevo usuario, luego haga click en Guardar para generar el nuevo usuario.##</p>
	|-else-|
		<p>	##161,Realice los cambios en el usuario y haga click en Aceptar para guardar las modificaciones.##</p>
	|-assign var="currentUserInfo" value=$currentUser->getUserInfo()-|
	|-/if-|
|-/if-|<span id="usersMsgField"></span>

<div>
	<form action="Main.php?do=usersStatisticsViewX" method="post" target="Graph" onSubmit='window.open("","Graph","scrollbars=1,width=800,height=600");'>
		<fieldset title="Formulario de rango de fechas de estadísticas">
		<legend>Rango de fechas de estadísticas</legend>
		<p>
			<label for="fromDate">##blog,5,Fecha Desde##</label>
			<input name="dateFrom" type="text" id="dateFrom" class="datepickerFrom" title="fromDate" size="12" /> 
		</p>
		<p>
			<label for="toDate">##blog,6,Fecha Hasta##</label>
			<input name="dateTo" type="text" id="dateTo" disabled="disabled" class="datepickerTo" title="toDate" size="12" /> 
		</p>
		<input type="submit" value="Ver Estadísticas" disabled="disabled" id="buttonStatistics" title="Ver Estadísticas (abre en ventana nueva)"/>
	</form>
</div>

<table class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
	<thead>
	<tr>
		<td  colspan="6" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar usuario</a>
			<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none;|-/if-|"><form action='Main.php' method='get' style="display:inline;">
				<input type="hidden" name="do" value="usersList" />
				Nombre: <input name="filters[searchString]" type="text" title="Ingrese el nombre, parte del nombre, apellido o parte del apellido a buscar" value="|-$filters.searchString-|" size="50" />
				Resultados por página
				|-html_options name="filters[perPage]" options=',10,25,50,100'|array:"valuekey" selected=$pager->getRowsPerPage()-|
				&nbsp;&nbsp;<input type='submit' value='Buscar' />
				|-if $filters|@count gt 0-|<input name="rmoveFilters" type="button" value="Quitar filtros" onclick="location.href='Main.php?do=usersList'"/>|-/if-|
		</form></div></td>
	</tr>
	|-if "usersEdit"|security_has_access-||-if !isset($licensesLeft) || (isset($licensesLeft) && $licensesLeft gt 0)-|
	<tr>
		<th colspan="6" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=usersEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Usuario</a></div></th>
	</tr>
	|-/if-||-/if-|
	<tr>
		<th width="25%" nowrap >##162,Identificación de Usuario##</th>
		<th width="20%">##163,Nombre##</th>
		<th width="25%">##164,Apellido##</th>
		<th width="20%">Email</th>
		<th width="10%">Nivel Permisos</th>
		<th width="10%">&nbsp;</th>
	</tr>
	</thead>
	<tbody>
	|-foreach from=$users item=user name=for_users-|
	<tr>
		<td>|-$user->getUsername()-|</td>
		<td>|-$user->getName()-|</td>
		<td>|-$user->getSurname()-|</td>
		<td>|-$user->getMailAddress()-|</td>
		<td>|-$user->getLevel()-|</td>
		<td nowrap>|-if isset($loginUser)-|
		<input type="button" class="icon iconViewGantt" onClick='window.open("Main.php?do=usersStatisticsViewX&id=|-$user->getid()-|","Graph","scrollbars=1,width=800,height=600");' value="Ver Estadísticas" title="Ver Estadísticas (abre en ventana nueva)" />
		|-if "usersEdit"|security_has_access-|
		<a href='Main.php?do=usersEdit&id=|-$user->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|' title="##114,Editar##"><img src="images/clear.png" class="icon iconEdit"></a>
		|-/if-|
		|-if "usersDoDelete"|security_has_access-|
			|-if $loginUser->getUsername() eq $user->getUsername()-|
				<img src="images/clear.png" class="icon iconDelete disabled" title="No puede eliminar su propio usuario" alt="No puede eliminar su propio usuario">
			|-elseif $user->getLevelId() lt 3-|
				<img src="images/clear.png" class="icon iconDelete disabled" title="No se puede eliminar. Para eliminar este usuario, debe tener nivel inferior a administrador" alt="No se puede eliminar. Para eliminar este usuario, debe tener nivel inferior a administrador">
			|-else-|
				<a href='Main.php?do=usersDoDelete&user=|-$user->getId()-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|' title="##115,Eliminar##" onClick='return window.confirm("¿Esta seguro que quiere eliminar este usuario?")'><img src="images/clear.png" class="icon iconDelete"></a>
			|-/if-|
		|-/if-|
		|-if ($loginUser->getUsername() neq $user->getUsername()) && ($user->getMailAddress() ne '')-|<form method="post" id="pss_|-$user->getId()-|">
			<input type="hidden" name="do" value="usersPasswordResetX" />
			<input type="hidden" name="id" value="|-$user->getId()-|" />
			<input type="button" value="Resetear contraseña" onClick="if (confirm('Una nueva contraseña se enviará por correo a la dirección del usuario. ¿Seguro que desea resetear esta contraseña?')){resetPassword('pss_|-$user->getId()-|')}; return false" title="Resetear contraseña" class="icon iconPassword">
			</form>
		|-elseif ($loginUser->getUsername() neq $user->getUsername()) && ($user->getMailAddress() eq '') -|
			<input type="button" title="El usuario no posee dirección de correo electrónico, no se puede resetear la contraseña" class="icon iconPassword disabled">
		|-/if-|
		|-/if-|
		|-if $user->getBlockedAt()-|
			<form method="post" id="unblock_|-$user->getId()-|">
			<input type="hidden" name="do" value="commonUsersDoUnblockX" />
			<input type="hidden" name="params[type]" value="|-get_class($user)-|" />
			<input type="hidden" name="id" value="|-$user->getId()-|" />
			<input type="button" value="Desbloquear Usuario" onClick="unblockUser('unblock_|-$user->getId()-|'); return false" title="Desbloquear Usuario" class="icon iconUserBlocked">
			</form>
		|-/if-|
		</td>
	</tr>
	|-/foreach-|
	</tbody>
	<tfoot>
	|-if "usersEdit"|security_has_access-||-if !isset($licensesLeft) || (isset($licensesLeft) && $licensesLeft gt 0)-|
	<tr>
		<th colspan="6" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=usersEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Usuario</a></div></th>
	</tr>
	|-else-|
	<tr>
		<td class='buttonCell' colspan='5'><input type='submit' value='##173,Nuevo Usuario##' class='button' onClick="return alert('Todas las licencias se encuentran en uso. Si desea dar de alta un nuevo usuario debe eliminar alguno de los existentes.');"/></td>
	</tr>
	|-/if-||-/if-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="6" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|
	</tfoot>						
</table>
<!--
|-if $inactiveUsers|@count gt 0-|
<fieldset>
<legend>##175,Usuarios Eliminados##</legend>
<table class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
	<tr>
		<th colspan='4'>Los siguientes usuarios fueron eliminados <a href="javascript:void(null)" onClick="alert('##174,Si quiere dar de alta a un usuario que estuvo registrado alguna vez, debe reactivarlo desde esta opción. Si lo intenta desde un usuario nuevo el sistema le informará que ese usuario ya está en uso.##')"><img src="images/clear.png" class="icon iconInfo"></a> </th>
	</tr>
	<tr>
		<th width="35%">##162,Identificación de Usuario##</th>
		<th width="25%">##163,Nombre##</th>
		<th width="38%">##164,Apellido##</th>
		<th width="2%">&nbsp;</th>
	</tr>
	|-foreach from=$inactiveUsers item=user name=for_inactive_users-|
	<tr>
		<td>|-$user->getUsername()-|</td>
		<td>|-$user->getName()-|</td>
		<td>|-$user->getSurname()-|</td>
		<td nowrap="nowrap"><a href='Main.php?do=usersDoActivate&user=|-$user->getId()-|'
|-if $licensesLeft lt 1-|
onClick="alert('##177,Todas las licencias se encuentran en uso. Si desea dar de alta un nuevo usuario debe eliminar alguno de los existentes.##');return false;"
alt='##176,Reactivar##' title='##176,Reactivar##'><img src="images/clear.png" class="icon iconActivate disabled">
|-else-|
alt='##176,Reactivar##' title='##176,Reactivar##'><img src="images/clear.png" class="icon iconActivate">
|-/if-|
</a>
		</td>
	</tr>
	|-/foreach-|
</table>
</fieldset>
|-/if-|
-->
