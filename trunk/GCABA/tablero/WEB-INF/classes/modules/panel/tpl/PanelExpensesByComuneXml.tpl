<chart 
	caption='Gasto por comuna' 
	xAxisName='Estado' 
	yAxisName='Cantidad' 
	showLabels='1'
	exportEnabled='1' 
	exportAtClient='1'
	exportHandler='fcExporter1'
	exportDataSeparator='{tab}' 
	showExportDataMenuItem='1'
	> 
	
	|-if $allZero-|
		<set label="Todos son cero" color="#FFFFFF" value="1" />
	|-else-|
		|-foreach $regionsExpenses as $regionExpenses-|
			<set label="|-$regionExpenses->getEntityName()-|" color="#|-$colors->next()-|" value="|-$regionExpenses->getAccrued()|default:0|system_numeric_format:"0"-|" />
		|-/foreach-|
	|-/if-|
		
</chart>
