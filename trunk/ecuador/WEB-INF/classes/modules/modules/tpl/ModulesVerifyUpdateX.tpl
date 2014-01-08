<script>
	$('#messageMod').html("");
	|-if !empty($error)-|
	$('#messageResult').html("<span class='resultFailure'>Ocurrió un error al |-$error-|</span>");
	|-else-|
	$('#messageResult').html("<span class='resultSuccess'>El módulo fue actualizado</span>");
	|-/if-|
	$('#|-$verifiedModule-|_hash').html('<span style="color: #0099CC;">|-$directoryHash-|</span>');
	$('#|-$verifiedModule-|_update').empty();
	$('#|-$verifiedModule-|_hash').html('<span style="color: #0099CC;">|-$hash-|</span>');
</script>
