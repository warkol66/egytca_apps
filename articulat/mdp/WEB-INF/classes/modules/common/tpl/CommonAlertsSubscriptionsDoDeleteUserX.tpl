<script type="text/javascript" language="javascript" >
	|-if $error eq ''-|
		$('partieMsgField').innerHTML = '<span class="resultSuccess">Destinatario Eliminado</span>';
		$('partyListItem|-$id-|').remove();
	|-else-|
		$('partieMsgField').innerHTML = '<span class="resultFailure">Error al eliminar el destinatario</span>';
	|-/if-|
</script>