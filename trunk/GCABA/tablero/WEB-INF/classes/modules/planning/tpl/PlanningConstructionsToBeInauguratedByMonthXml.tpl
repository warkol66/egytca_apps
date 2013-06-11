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
	
	|-foreach $months as $month-|
		<set label="|-$month.label-|" value="|-$month.value-|" />
	|-/foreach-|
	
</chart>