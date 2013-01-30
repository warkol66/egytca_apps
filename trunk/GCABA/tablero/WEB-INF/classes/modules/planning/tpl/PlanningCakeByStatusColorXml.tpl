<chart 
	caption='|-if $type eq 'projects'-|Proyectos|-else-|Obras|-/if-| por estado de avance|-if $type eq 'projects'-| de hitos|-/if-|' 
	xAxisName='Estado' 
	yAxisName='Cantidad' 
	showLabels='0'
	exportEnabled='1' 
	exportAtClient='1'
	exportHandler='fcExporter1'
	exportDataSeparator='{tab}' 
	showExportDataMenuItem='1'
	> 
	
	<set label='Gris' value='|-$blackCount-|' color='#A4A4A4' />
	<set label='Verde' value='|-$greenCount-|' color='#04B431' />
	<set label='Amarillo' value='|-$yellowCount-|' color='#FFFF00'/>
	<set label='Rojo' value='|-$redCount-|' color='#DF0101'/> 
	<set label='Azul' value='|-$blueCount-|' color='#0040FF'/> 
	
</chart>
