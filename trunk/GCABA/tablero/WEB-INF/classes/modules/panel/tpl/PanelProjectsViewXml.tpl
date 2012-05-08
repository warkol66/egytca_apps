<ptuba>
|-foreach from=$policyGuidelines item=eachPolicyGuidelines name=for_policyGuidelines-|
|-assign value=$eachPolicyGuidelines->getAllProjects() var=projects-|
|-foreach from=$projects item=eachProject name=for_projects-|
|-if $eachProject->getConstruction() eq 1-|
|-assign value=$indicatorPeer->get($eachProject->getIndicatorid()) var=indicator-|
|-if is_object($indicator)-|
<chart caption='|-$indicator->getName()-|' subcaption='' |-if $disbursement-|formatNumberScale='0' numberPrefix='$'|-/if-| palette='1' decimals='0|-$indicator->getDecimals()-|' showValues='|-$indicator->getShowValue()-|'  enableSmartLabels='1' showBorder='1' formatNumberScale='0' xAxisMinValue='|-$indicator->getMinX()-|' xAxisMaxValue='|-$indicator->getMaxX()-|' yAxisMinValue='|-$indicator->getMiny()-|' YAxisMaxValue='|-$indicator->getMaxy()-|' decimalSeparator='|-$parameters.decimalSeparator-|' thousandSeparator='|-$parameters.thousandsSeparator-|' labelDisplay='Rotate' slantLabels='1'  clickURL='#'> 
		<info>
			<project>|-$eachProject->getName()-|</project>
			<budget>|-$eachProject->getBudget()-|</budget>
			<plannedStart>|-$eachProject->getPlannedStart()-|</plannedStart>
			<plannedEnd>|-$eachProject->getPlannedEnd()-|</plannedEnd>
			<realStart>|-$eachProject->getRealStart()-|</realStart>
			<realEnd>|-$eachProject->getRealend()-|</realEnd>
			<latitude>|-$eachProject->getLatitude()-|</latitude>
			<longitude>|-$eachProject->getLongitude()-|</longitude>
		</info>
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
		<set value='|-if !is_null($yValue->getValue())-||-$yValue->getValue()|number_format:2:".":""-||-/if-|' />
	|-/foreach-|
|-else-|
	|-assign var=aggregate value=0-|
	|-foreach from=$yValues item=yValue name=for_yValue-|
		|-math equation="x+y" x=$aggregate y=$yValue->getValue() assign=aggregate-|
		<set value='|-$aggregate|number_format:2:".":""-|' />
	|-/foreach-|
|-/if-|
	</dataset> 
|-/foreach-|
|-else-|
|-assign value=$indicator->getXs() var=xValues-|
|-foreach from=$xValues item=xValue name=for_xValue-|
	|-assign value=$xValue->getYs() var=yValues-|
	|-foreach from=$yValues item=yValue name=for_yValue-|
	<set label='|-$xValue->getName()|escape-|' value='|-$yValue->getValue()|number_format:2:".":""-|' />
	|-/foreach-|
|-/foreach-|
|-/if-|
</chart>
|-/if-|
|-/if-|
|-/foreach-|
|-/foreach-|
</ptuba>
