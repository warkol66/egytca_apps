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
</script>
<h2>##common,18,Configuración del Sistema##</h2>
<h1>##151,Administración de Usuarios##</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>##152,A continuación podrá desbloquear los usuarios bloqueados##</p>
|-if $message eq "activated"-|
	<div class='successMessage'>##154,Usuario reactivado##</div>
|-elseif $message eq "wrongPassword"-|
	<div class='errorMessage'>##155,Las contraseñas deben coincidir##</div>
|-elseif $message eq "errorUpdate"-|
	<div class='errorMessage'>##156,Ha ocurrido un error al intentar guardar la información del usuario##</div>
|-elseif $message eq "saved"-|
	<div class='successMessage'>##157,Usuario guardado##</div>
|-/if-|
<span id="usersMsgField"></span>
<h2>Usuarios del sistema</h2>
<table class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
	<tr>
		<th width="25%" nowrap >##162,Identificación de Usuario##</th>
		<th width="20%">##163,Nombre##</th>
		<th width="25%">##164,Apellido##</th>
		<th width="20%">Email</th>
		<th width="10%">Nivel Permisos</th>
		<th width="10%">&nbsp;</th>
	</tr>
	|-foreach from=$blockedUsers item=user name=for_users-|
	<tr>
		<td>|-$user->getUsername()-|</td>
		<td>|-$user->getName()-|</td>
		<td>|-$user->getSurname()-|</td>
		<td>|-$user->getMailAddress()-|</td>
		<td>|-$user->getLevel()-|</td>
		<td nowrap>|-if isset($loginUser)-|
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
			<input type="hidden" name="type" value="|-get_class($user)-|" />
			<input type="hidden" name="id" value="|-$user->getId()-|" />
			<input type="button" value="Desbloquear Usuario" onClick="unblockUser('unblock_|-$user->getId()-|'); return false" title="Desbloquear Usuario" class="icon iconPassword">
			</form>
		|-/if-|
		</td>
	</tr>
	|-/foreach-|
	|-if "usersEdit"|security_has_access-||-if !isset($licensesLeft) || (isset($licensesLeft) && $licensesLeft gt 0)-|
	
	|-else-|
	|-/if-||-/if-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="6" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
</table>
<!--Usuarios de afiliados-->
<br /><br />
<h2>Usuarios de afiliados</h2>
<table cellpadding='5' cellspacing='0' width='100%' class='tableTdBorders'>
	<tr>
		<th>##affiliates,3,Afiliado##</th>
		<th>Identificación</th>
		<th>Apellido, Nombre</th>
		<th>E-mail</th>
		<th>&nbsp;</th>
	</tr>
	|-foreach from=$blockedAffiliates item=user name=for_users-|
	<tr>
		<td width="15%">|-$user->getAffiliate()-|</td>
		<td width="20%">|-$user->getUsername()-|</td>
		<td width="25%">|-$user->getSurname()-|, |-$user->getName()-|</td>
		<td width="25%">|-$user->getMailAddress()-|</td>
		<td width="15%" nowrap>
		|-if "affiliatesUsersPasswordResetX"|security_has_access-|
			|-if ($user->getMailAddress() ne '') && (!isset($loginAffiliateUser) || (isset($loginAffiliateUser) && ($loginAffiliateUser->getUsername() neq $user->getUsername())))-|<form method="post" id="pss_|-$user->getId()-|">
				<input type="hidden" name="do" value="affiliatesUsersPasswordResetX" />
				<input type="hidden" name="id" value="|-$user->getId()-|" />
				<input type="button" value="Resetear contraseña" onClick="if (confirm('Una nueva contraseña se enviará por correo a la dirección del usuario. ¿Seguro que desea resetear esta contraseña?')){resetPassword('pss_|-$user->getId()-|')}; return false" title="Resetear contraseña" class="icon iconPassword">
				</form>
			|-elseif ($user->getMailAddress() eq '' && (isset($loginAffiliateUser) && ($loginAffiliateUser->getUsername() neq $user->getUsername())))-|
				<input type="button" title="El usuario no posee dirección de correo electrónico, no se puede resetear la contraseña" class="icon iconPassword disabled">
			|-/if-|
		|-/if-|
		|-if $user->getBlockedAt()-|
			<form method="post" id="unblockAffiliate_|-$user->getId()-|">
			<input type="hidden" name="do" value="commonUsersDoUnblockX" />
			<input type="hidden" name="type" value="|-get_class($user)-|" />
			<input type="hidden" name="id" value="|-$user->getId()-|" />
			<input type="button" value="Desbloquear Usuario" onClick="unblockUser('unblockAffiliate_|-$user->getId()-|'); return false" title="Desbloquear Usuario" class="icon iconPassword">
			</form>
		|-/if-|
		</td>
	</tr>
	|-/foreach-|
	|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="5" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
	|-/if-|
</table>
