<script type="text/javascript">
|-if $bEdit eq "ok"-|
	$('budgetItemMsgField').innerHTML = '<span class="resultSuccess">Datos de la partida guardados con éxito</span>';
|-else-|
	$('budgetItemMsgField').innerHTML = '<span class="resultFailure">Ocurrió un error al intentar actualizar los datos de la partida</span>';
|-/if-|
</script>
