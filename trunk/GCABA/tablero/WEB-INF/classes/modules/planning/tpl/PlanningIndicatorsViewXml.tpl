<chart caption='|-$indicator->getName()-|' subcaption='' |-if $disbursement-|formatNumberScale='0' numberPrefix='$'|-/if-| palette='1' decimals='|-$indicator->getDecimals()-|' showValues='|-$indicator->getShowValue()-|'  enableSmartLabels='1' showBorder='1' formatNumberScale='0' xAxisMinValue='|-$indicator->getMinX()-|' xAxisMaxValue='|-$indicator->getMaxX()-|' yAxisMinValue='|-$indicator->getMiny()-|' YAxisMaxValue='|-$indicator->getMaxy()-|' decimalSeparator='|-$parameters.decimalSeparator-|' thousandSeparator='|-$parameters.thousandsSeparator-|' labelDisplay='Rotate' slantLabels='1'  clickURL='#'> 
|-if $indicator->getType() neq constant("IndicatorPeer::PIE")-|
	<categories> 
|-assign value=$indicator->getXs() var=xValues-|
|-foreach from=$xValues item=xValue name=for_xValue-|
		<category label='|-$xValue->getName()|escape-|' />
|-/foreach-|
	</categories> 
|-assign value=$indicator->getSeries() var=series-|
|-foreach from=$series item=serie name=for_serie-|
	<dataset seriesName='|-$serie->getName()-|' showValues='0'>
|-assign value=$serie->getYs() var=yValues-|

|-if !$disbursement-|
	|-foreach from=$yValues item=yValue name=for_yValue-|
		<set value='|-if !is_null($yValue->getValue())-||-$yValue->getValue()|number_format:$indicator->getDecimals():".":""-||-/if-|' />
	|-/foreach-|
|-else-|
	|-assign var=aggregate value=0-|
	|-foreach from=$yValues item=yValue name=for_yValue-|
		|-math equation="x+y" x=$aggregate y=$yValue->getValue() assign=aggregate-|
		<set value='|-$aggregate|number_format:$indicator->getDecimals():".":""-|' />
	|-/foreach-|
|-/if-|
	</dataset> 
|-/foreach-|
|-else-|
|-assign value=$indicator->getXs() var=xValues-|
|-foreach from=$xValues item=xValue name=for_xValue-|
	|-assign value=$xValue->getYs() var=yValues-|
	|-foreach from=$yValues item=yValue name=for_yValue-|
	<set label='|-$xValue->getName()|escape-|' value='|-$yValue->getValue()|number_format:$indicator->getDecimals():".":""-|' />
	|-/foreach-|
|-/foreach-|
|-/if-|
</chart>
