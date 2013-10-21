<script type="text/javascript">
	|-if !is_object($twitterUser)-|
	$("resultDiv").innerHTML = "<span class='resultSuccess'>Usuario actualizado</span>";
	|-else-|
	$("resultDiv").innerHTML = "<span class='resultFailure'>Ocurrió un problema al actualizar el usuario</span>";
	|-/if-|
</script>
