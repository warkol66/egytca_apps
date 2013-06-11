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
	baseFont='Arial'
	baseFontSize ='12'
	baseFontColor ='000000'
	>
    <styles>
      <definition>
          <style name='captionStyle' type='font' font='Arial' size='14' color='000000' bold='1' />
      </definition>
      <application>
          <apply toObject='Caption' styles='captionStyle' />
      </application>
    </styles>

	<set label='Planificado' value='|-$whiteCount-|' color='#EFEFEF' />
	<set label='A tiempo' value='|-$greenCount-|' color='#04B431' />
	<set label='Demorado/Indefinido' value='|-$yellowCount-|' color='#FFFF00'/>
	<set label='Retrasado' value='|-$redCount-|' color='#DF0101'/> 
	<set label='Concluido' value='|-$blueCount-|' color='#0040FF'/> 

</chart>
