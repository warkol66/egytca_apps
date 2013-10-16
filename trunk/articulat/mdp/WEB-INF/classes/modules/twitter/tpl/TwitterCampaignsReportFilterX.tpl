<script>
	|-if !empty($byValue)-|
	$j('#byValueMessage').html('');

	var arrByFilter = [|-foreach from=$byValue item=pos-|{"Fecha":"|-$pos['date']|date_format:'%d-%m-%Y'-|"|-if !empty($positive)-|,"Positivos":"|-$pos['positive']-|"|-/if-||-if !empty($neutral)-|,"Neutros":"|-$pos['neutral']-|"|-/if-||-if !empty($negative)-|,"Negativos":"|-$pos['negative']-|"|-/if-|}|-if !$byValue.last-|,|-/if-||-/foreach-|];
	
	barChart(arrByFilter,'byValueChart');
	
	|-elseif !empty($byRelevance)-|
	
	$j('#byRelevanceMessage').html('');

	var arrByFilter = [|-foreach from=$byRelevance item=pos-|{"Fecha":"|-$pos['date']|date_format:'%d-%m-%Y'-|"|-if !empty($relevant)-|,"Relevantes":"|-$pos['relevant']-|"|-/if-||-if !empty($neutrally_relevant)-|,"Neutros":"|-$pos['neutrally_relevant']-|"|-/if-||-if !empty($irrelevant)-|,"Irrelevantes":"|-$pos['irrelevant']-|"|-/if-|}|-if !$byRelevance.last-|,|-/if-||-/foreach-|];
	
	barChart(arrByFilter,'byRelevanceChart');
	|-else-|
	$j('#byValueMessage').html('');
	$j('#byRelevanceMessage').html('');
	|-/if-|

</script>
