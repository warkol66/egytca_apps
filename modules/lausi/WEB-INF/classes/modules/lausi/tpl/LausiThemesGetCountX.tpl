<script type="text/javascript">
$('msgBoxDistributeCount').innerHTML = '';
</script>

|-$count-| |-if isset($theme) and not $theme->isDouble()-|Sextuples|-else-|Afiches|-/if-| Distribuidos (|-$pendingCount-| Afiches Pendientes a Distribuir)

<script type="text/javascript">
	
	|-foreach from=$result item=item key=key -|
		$('inputItem|-$key-|').innerHTML = '|-$item.sheetsDistributed-| |-if isset($theme) and not $theme->isDouble()-|Sextuples|-else-|Afiches|-/if-| distribuidos / |-$item.billboardsAvailable-| Carteleras Disponibles';
	|-/foreach-|
	
</script>
