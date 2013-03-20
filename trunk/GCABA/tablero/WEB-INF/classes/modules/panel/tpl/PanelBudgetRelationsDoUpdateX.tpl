<script type="text/javascript">
	$('budgetItemMsgField').innerHTML = '';
	|-if isset($error)-|
		$('budgetItemMsgField').innerHTML = '<span>Error al conectar al servidor. Por favor intente nuevamente. </span>';
		$('update_|-$budget->getId()-|').className = "";
		$('update_|-$budget->getId()-|').addClassName('icon iconClose');
		$('update_|-$budget->getId()-|').setAttribute('title', 'Error');
	|-elseif $message eq "error"-|
		$('budgetItemMsgField').innerHTML = '<span>La partida presupuestaria que quiere actualizar no existe.</span>';
		$('update_|-$budget->getId()-|').className = "";
		$('update_|-$budget->getId()-|').addClassName('icon iconClose');
		$('update_|-$budget->getId()-|').setAttribute('title', 'No se encontró la partida');
	|-else-|
		|-if $budget->getMatch() eq "true"-|
			$('budgetItemMsgField').innerHTML = '<span>Partida presupuestaria actualizada.</span>';
			$('update_|-$budget->getId()-|').className = "";
			$('update_|-$budget->getId()-|').addClassName('icon disabled iconActivate');
			$('update_|-$budget->getId()-|').disabled = 'disabled';
			$('update_|-$budget->getId()-|').setAttribute('title', 'Partida actualizada el |-$budget->getUpdatedSigaf()-|');
			$('update_|-$budget->getId()-|').disabled = true;
		|-else-|
			$('budgetItemMsgField').innerHTML = '<span>Error al intentar actualizar la partida.</span>';
			$('update_|-$budget->getId()-|').className = "";
			$('update_|-$budget->getId()-|').addClassName('icon iconClose');
			$('update_|-$budget->getId()-|').setAttribute('title', 'No se encontró la partida');
		|-/if-|
	|-/if-|
</script>


	
