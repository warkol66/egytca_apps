<script type="text/javascript" language="javascript" >
	|-if $error eq ''-|
		$('#partieMsgField').html('<span class="resultSuccess">Destinatario Eliminado</span>');
		$('#partyListItem|-$id-|').remove();
	|-else-|
		$('#partieMsgField').html('<span class="resultFailure">Error al eliminar el destinatario</span>');
	|-/if-|
</script>
