<script language="JavaScript" type="text/JavaScript">
|-if $message eq ""-|
		$('budgetItemMsgField').innerHTML = '<span class="resultSuccess">Partida eliminada</span>';
|-else-|
		$('budgetItemMsgField').innerHTML = '<span class="resultFailure">No se pudo eliminar la partida</span>';
|-/if-|
</script>
