<chart 
	caption='Cantidad de obras a inaugurar por mes' 
	xAxisName='' 
	yAxisName='Cantidad' 
	showLabels='1'
	exportEnabled='1' 
	exportAtClient='1'
	exportHandler='fcExporter1'
	exportDataSeparator='{tab}' 
	showExportDataMenuItem='1'	
	> 
	
	|-foreach $months as $month-|
		<set label="|-$month.label-|" value="|-$month.value-|" />
	|-/foreach-|
	
</chart>