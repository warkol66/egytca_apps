<chart caption='Reporte de Obras' decimals='2' labelDisplay='Rotate' slantLabels='1'>
	<categories>
	|-foreach from=$dates item=date-|
		<category label='|-$date-|' />
	|-/foreach-|
	</categories>
	
	<dataset seriesName='Certificados' showValues='0'>
	|-foreach from=$certificatesArray item=certificate-|
		<set value='|-$certificate-|' />
	|-/foreach-|
	</dataset>
	<dataset seriesName='Acumulado' showValues='0'>
	|-foreach from=$acumulatedArray item=acumulated-|
		<set value='|-$acumulated-|' />
	|-/foreach-|
	</dataset>
</chart>
