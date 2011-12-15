<chart caption='Reporte de Obras' decimals='2' labelDisplay='Rotate' slantLabels='1'>
	<categories>
	|-foreach from=$periods item=period-|
		<category label='|-$period-|' />
	|-/foreach-|
	</categories>
	
	<dataset seriesName='Certificados' showValues='0'>
	|-foreach from=$periods item=period-|
		<set value='|-$constructionPriceData->getPriceOnPeriod($period)-|' />
	|-/foreach-|
	</dataset>
	<dataset seriesName='Acumulado' showValues='0'>
	|-foreach from=$periods item=period-|
		<set value='|-$constructionPriceData->getAccumulatedPriceOnPeriod($period)-|' />
	|-/foreach-|
	</dataset>
</chart>
