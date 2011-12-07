<chart caption='Reporte de Obras' decimals='2' labelDisplay='Rotate' slantLabels='1'>
	<categories>
	|-foreach from=$dates item=date-|
		<category label='|-$date-|' />
	|-/foreach-|
	</categories>
	
	<dataset seriesName='Certificados' showValues='0'>
	|-foreach from=$prices item=price-|
		<set value='|-$price-|' />
	|-/foreach-|
	</dataset>
	<dataset seriesName='Acumulado' showValues='0'>
	|-foreach from=$prices item=price-|
	|-math equation="x + y" x=$price y=$acumulado assign=suma-|
		<set value='|-$suma-|' />
	|-assign var=acumulado value=$suma-|
	|-/foreach-|
	</dataset>
</chart>
