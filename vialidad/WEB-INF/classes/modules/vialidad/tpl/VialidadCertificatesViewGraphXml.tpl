<chart caption='Reporte de Obras' decimals='2' labelDisplay='Rotate' slantLabels='1'>
	<categories>
	|-foreach from=$dates item=date-|
		<category label='|-$date-|' />
	|-/foreach-|
	</categories>
	
	<dataset seriesName='|-$construction->getName()-|' showValues='0'>
	|-foreach from=$prices item=price-|
		<set value='|-$price-|' />
	|-/foreach-|
	</dataset>
</chart>
