<script type="text/javascript">
	$('budgetItemMsgField').innerHTML = '';
	|-if isset($error)-|
	$('budgetItemMsgField').innerHTML = '<span id="errorMessage">Se detectó el siguiente error: |-$message-|.</span>';
	|-elseif $message eq "error"-|
	$('budgetItemMsgField').innerHTML = '<span id="errorMessage">La partida presupuestaria que quiere actualizar no existe</span>';
	|-else-|
	$('budgetItemMsgField').innerHTML = '<span id="errorMessage">Se detectó el siguiente error: |-$message-|.</span>';
	|-/if-|
</script>


	
