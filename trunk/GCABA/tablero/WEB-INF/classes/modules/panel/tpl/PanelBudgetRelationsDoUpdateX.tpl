<script type="text/javascript">
	$('budgetItemMsgField').innerHTML = '';
	|-if isset($error)-|
		$('budgetItemMsgField').innerHTML = '<span class="resultFailure">Error al conectar al servidor. Por favor intente nuevamente. </span>';
		$('update_|-$budget->getId()-|').className = "";
		$('update_|-$budget->getId()-|').addClassName('icon iconClose');
		$('update_|-$budget->getId()-|').setAttribute('title', 'Error');
	|-elseif $message eq "error"-|
		$('budgetItemMsgField').innerHTML = '<span class="resultFailure">La partida presupuestaria que quiere actualizar no existe.</span>';
		$('update_|-$budget->getId()-|').className = "";
		$('update_|-$budget->getId()-|').addClassName('icon iconClose');
		$('update_|-$budget->getId()-|').setAttribute('title', 'No se encontró la partida');
	|-else-|
		|-if $budget->getMatch() eq "true"-|
	|-capture name=budgetData-|	
		<table width="490" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <th>Vigente</th>
    <th>Restringido</th>
    <th>Preventivo</th>
    <th>Definitivo</th>
    <th>Devengado</th>
    <th>Pagado</th>
  </tr>
  <tr align="right">
    <td>|-$budget->getActive()|system_numeric_format-|</td>
    <td>|-$budget->getRestricted()|system_numeric_format-|</td>
    <td>|-$budget->getPreventive()|system_numeric_format-|</td>
    <td>|-$budget->getDefinitive()|system_numeric_format-|</td>
    <td>|-$budget->getAccrued()|system_numeric_format-|</td>
    <td>|-$budget->getPaid()|system_numeric_format-|</td>
  </tr>
</table>
|-/capture-|
			$('budgetItemMsgField').innerHTML = '<span class="resultSuccess">Partida presupuestaria actualizada.</span>';
			$('update_|-$budget->getId()-|').className = "";
			$('update_|-$budget->getId()-|').addClassName('icon disabled iconActivate');
			$('update_|-$budget->getId()-|').disabled = 'disabled';
			$('update_|-$budget->getId()-|').setAttribute('title', 'Partida actualizada el |-$budget->getUpdatedSigaf()|change_timezone|dateTime_format-|');
			$('update_|-$budget->getId()-|').disabled = true;
			$('budgetSpanId_|-$budget->getId()-|').innerHTML = '|-$smarty.capture.budgetData|strip-|';
		|-else-|
			$('budgetItemMsgField').innerHTML = '<span class="resultFailure">Error al intentar actualizar la partida.</span>';
			$('update_|-$budget->getId()-|').className = "";
			$('update_|-$budget->getId()-|').addClassName('icon iconClose');
			$('update_|-$budget->getId()-|').setAttribute('title', 'No se encontró la partida');
		|-/if-|
	|-/if-|
</script>


	
