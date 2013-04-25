<chart 
	caption='|-if $type eq 'projects'-|Proyectos|-else-|Obras|-/if-| por estado de avance' 
	xAxisName='Estado' 
	yAxisName='Cantidad' 
	showLabels='0'
	exportEnabled='1' 
	exportAtClient='1'
	exportHandler='fcExporter1'
	exportDataSeparator='{tab}' 
	showExportDataMenuItem='1'
	> 
	
	<set label='Planificado' value='|-$blackCount-|' color='#A4A4A4' />
	<set label='En término' value='|-$greenCount-|' color='#04B431' />
	<set label='Demorado/Indefinido' value='|-$yellowCount-|' color='#FFFF00'/>
	<set label='Retrasado' value='|-$redCount-|' color='#DF0101'/> 
	<set label='Concluido' value='|-$blueCount-|' color='#0040FF'/> 

</chart>
