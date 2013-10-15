
<script>
	|-if !empty($byValue)-|
	$j('#byValueMessage').html('');

	var arrByFilter = [|-foreach from=$byValue item=pos-|{"Fecha":"|-$pos['date']|date_format:'%d-%m-%Y'-|"|-if !empty($positive)-|,"Positivos":"|-$pos['positive']-|"|-/if-||-if !empty($neutral)-|,"Neutros":"|-$pos['neutral']-|"|-/if-||-if !empty($negative)-|,"Negativos":"|-$pos['negative']-|"|-/if-|}|-if !$byValue.last-|,|-/if-||-/foreach-|];
	
	barChart(arrByFilter,'byValueChart');
	
	|-elseif !empty($byRelevance)-|
	$j('#byRelevanceMessage').html('');

	var arrByFilter = [|-foreach from=$byRelevance item=pos-|{"Fecha":"|-$pos['date']|date_format:'%d-%m-%Y'-|"|-if !empty($positive)-|,"Relevantes":"|-$pos['relevant']-|"|-/if-||-if !empty($neutral)-|,"Neutros":"|-$pos['neutrally_relevant']-|"|-/if-||-if !empty($negative)-|,"Irrelevantes":"|-$pos['irrelevant']-|"|-/if-|}|-if !$byValue.last-|,|-/if-||-/foreach-|];
	
	barChart(arrByFilter,'byRelevanceChart');
	|-else-|
	$j('#byValueMessage').html('');
	$j('#byRelevanceMessage').html('');
</script>
	<div class="resultFailure">Ocurrió un error al actualizar los datos</div>
	|-/if-|

</script>
