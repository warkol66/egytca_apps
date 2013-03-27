<script type="text/javascript">
|-if $message eq 'success'-|
	$('#usersMsgField').html('<span class="resultSuccess">Usuario desbloqueado</span>');
	$('#unblock_|-$id-|').remove();
|-else-|
	$('#usersMsgField').html('<span class="resultError">Ocurrió un error al desbloquear al usuario. Intente nuevamente</span>');
|-/if-|
</script>
