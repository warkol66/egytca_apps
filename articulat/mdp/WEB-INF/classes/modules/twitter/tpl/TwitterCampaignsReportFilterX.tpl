	<div id='tweetsByValue'>
		<h4>Tweets por Valoración</h4>
		|-assign var=posCount value=count($positive)-|
		<!--p>Del |-$positive[0]['date']|date_format:'%d/%m/%Y'-| al |-$positive[$posCount - 1]['date']|date_format:'%d/%m/%Y'-|</p-->
		<div id='byValueMessage'></div>
		<div id='byValueChart' height='250'></div>
	</div>
	
	<div id='tweetsByRelevance'>
		<h4>Tweets por Relevancia</h4>
		|-assign var=posCount value=count($positive)-|
		<!--p>Del |-$positive[0]['date']|date_format:'%d/%m/%Y'-| al |-$positive[$posCount - 1]['date']|date_format:'%d/%m/%Y'-|</p-->
		<div id='byRelevanceMessage'></div>
		<div id='byRelevanceChart'></div>
	</div>
<script>
	|-if !empty($byValue)-|
	$j('#byValueMessage').html('');

	var arrByValue = [|-foreach from=$byValue item=pos-|{"Fecha":"|-$pos['date']|date_format:'%d-%m-%Y'-|"|-if !empty($positive)-|,"Positivos":"|-$pos['positive']-|"|-/if-||-if !empty($neutral)-|,"Neutros":"|-$pos['neutral']-|"|-/if-||-if !empty($negative)-|,"Negativos":"|-$pos['negative']-|"|-/if-|}|-if !$byValue.last-|,|-/if-||-/foreach-|];
	
	barChart(arrByValue,'byValueChart');
	|-/if-|
	|-if !empty($byRelevance)-|
	
	$j('#byRelevanceMessage').html('');

	var arrByRelevance = [|-foreach from=$byRelevance item=pos-|{"Fecha":"|-$pos['date']|date_format:'%d-%m-%Y'-|"|-if !empty($relevant)-|,"Relevantes":"|-$pos['relevant']-|"|-/if-||-if !empty($neutrally_relevant)-|,"Neutros":"|-$pos['neutrally_relevant']-|"|-/if-||-if !empty($irrelevant)-|,"Irrelevantes":"|-$pos['irrelevant']-|"|-/if-|}|-if !$byRelevance.last-|,|-/if-||-/foreach-|];
	
	barChart(arrByRelevance,'byRelevanceChart');
	|-/if-|
	$j('#byValueMessage').html('');
	$j('#byRelevanceMessage').html('');

</script>
