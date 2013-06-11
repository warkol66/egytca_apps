<chart 
	caption='Cantidad de obras ejecutándose por ministerio' 
	xAxisName='' 
	yAxisName='Cantidad' 
	showLabels='1'
	exportEnabled='1' 
	exportAtClient='1'
	exportHandler='fcExporter1'
	exportDataSeparator='{tab}' 
	showExportDataMenuItem='1'
	labelDisplay='rotate' 	
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
	
	|-foreach $q as $label => $value-|
		<set label="|-$label-|" value="|-$value-|"/> 
	|-/foreach-|
</chart>