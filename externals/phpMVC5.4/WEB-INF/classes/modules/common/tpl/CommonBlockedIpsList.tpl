<script language="JavaScript" type="text/javascript">
function unblockIp(form){
	$.ajax({
		url: url,
		data: $('#' + form).serialize(),
		type: 'post',
		success: function(data){
			$('#ipsMsgField').html(data);
		}	
	});
	$('#ipsMsgField').html('<span class="inProgress">desbloqueando IP...</span>');
	return true;
}
</script>
<h2>##common,18,Configuración del Sistema##</h2>
<h1>##151,Administración de IPs##</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>##152,A continuación podrá desbloquear las IPs bloqueadas##</p>
|-if $message eq "activated"-|
	<div class='successMessage'>##154,Usuario reactivado##</div>
|-elseif $message eq "wrongPassword"-|
	<div class='errorMessage'>##155,Las contraseñas deben coincidir##</div>
|-elseif $message eq "errorUpdate"-|
	<div class='errorMessage'>##156,Ha ocurrido un error al intentar guardar la información del usuario##</div>
|-elseif $message eq "saved"-|
	<div class='successMessage'>##157,Usuario guardado##</div>
|-/if-|
<span id="ipsMsgField"></span>
<h2>IPs bloqueadas</h2>

<table class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
	<tr>
		<th width="70%" nowrap >##162,IP##</th>
		<th width="30%">&nbsp;</th>
	</tr>
	|-foreach from=$blockedIpColl item=ip name=for_ips-|
	<tr>
		<td>|-$ip->getIp()-|</td>
		<td>|-if $ip->getBlockedAt()-|
			<form method="post" id="unblock_|-$ip->getId()-|">
			<input type="hidden" name="do" value="commonBlockedIpsDoUnblockX" />
			<input type="hidden" name="ip" value="|-$ip->getIp()-|" />
			<input type="button" value="Desbloquear Usuario" onClick="unblockIp('unblock_|-$ip->getId()-|'); return false" title="Desbloquear IP" class="icon iconPassword">
			</form>
		|-/if-|
		</td>
	</tr>
	|-/foreach-|				
</table>


