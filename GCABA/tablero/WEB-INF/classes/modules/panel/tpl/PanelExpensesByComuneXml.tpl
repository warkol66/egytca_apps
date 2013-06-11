<chart 
	caption='Gasto por Comuna' 
	xAxisName='Estado' 
	yAxisName='Cantidad' 
	showLabels='1'
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

	|-if $allZero-|
		<set label="Todos son cero" color="#FFFFFF" value="1" />
	|-else-|
		|-foreach $regionsExpenses as $regionExpenses-|
			<set label="|-$regionExpenses->getEntityName()-|" color="#|-$colors->next()-|" value="|-$regionExpenses->getAccrued()|default:0|system_numeric_format:"0"-|" />
		|-/foreach-|
	|-/if-|
		
</chart>
