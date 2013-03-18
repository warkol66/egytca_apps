<script type="text/javascript">
	$('budgetItemMsgField').innerHTML = '';
	|-if isset($error)-|
		$('budgetItemMsgField').innerHTML = '<span id="errorMessage">Se detectó el siguiente error: |-$error-|.</ br> Por favor intente nuevamente. </span>';
		$('update_|-$budget->getId()-|').className = "";
		$('update_|-$budget->getId()-|').addClassName('icon iconClose');
	|-elseif $message eq "error"-|
		$('budgetItemMsgField').innerHTML = '<span id="errorMessage">La partida presupuestaria que quiere actualizar no existe</span>';
		$('update_|-$budget->getId()-|').className = "";
		$('update_|-$budget->getId()-|').addClassName('icon iconClose');
	|-else-|
		$('budgetItemMsgField').innerHTML = '<span id="successMessage">Partida presupuestaria actualizada.</span>';
		|-if $budget->getMatch() eq "true"-|
			$('update_|-$budget->getId()-|').className = "";
			$('update_|-$budget->getId()-|').addClassName('icon iconActivate');
		|-else-|
			$('update_|-$budget->getId()-|').className = "";
			$('update_|-$budget->getId()-|').addClassName('icon iconClose');
		|-/if-|
	|-/if-|
</script>


	
