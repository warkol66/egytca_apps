<chart caption='Reporte de Obras'>
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
