<chart caption='Reporte de Obras' decimals='2' labelDisplay='Rotate' slantLabels='1'>
	<categories>
	|-foreach from=$periods item=period-|
		<category label='|-$period-|' />
	|-/foreach-|
	</categories>
	
	|-foreach from=$constructions item=construction-|
	<dataset seriesName='Certificados|-if $entityType eq "contract"-| de |-$construction-||-/if-|' showValues='0'>
	|-foreach from=$periods item=period-|
		<set value='|-$construction->getPriceOnPeriod($period)-|' />
	|-/foreach-|
	</dataset>
	<dataset seriesName='Acumulado|-if $entityType eq "contract"-| de |-$construction-||-/if-|' showValues='0'>
	|-foreach from=$periods item=period-|
		<set value='|-$construction->getAccumulatedPriceOnPeriod($period)-|' />
	|-/foreach-|
	</dataset>
	|-/foreach-|
</chart>
