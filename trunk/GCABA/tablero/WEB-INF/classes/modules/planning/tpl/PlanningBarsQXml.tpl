<chart 
	caption='Cantidad de obras ejecutandose ministerio' 
	xAxisName='' 
	yAxisName='Cantidad' 
	showLabels='1'
	exportEnabled='1' 
	exportAtClient='1'
	exportHandler='fcExporter1'
	exportDataSeparator='{tab}' 
	showExportDataMenuItem='1'
	labelDisplay='rotate' 	
	>
	
	|-foreach $q as $label => $value-|
		<set label="|-$label-|" value="|-$value-|"/> 
	|-/foreach-|
</chart>