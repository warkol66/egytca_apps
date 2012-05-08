|-if !empty($result)-|
<table cellpadding="5" cellspacing="0" class="tableTdBorders">
|-foreach from=$result item=objective name=for_objectives-|
<tr class="thFillTitle">
	<th colspan="3">|-$objective->getName()-|</th>
</tr>
<tr>
<td align="center">
<a href="Main.php%3Fdo%3DobjectivesStrategicObjectivesList%26filters%5Bguideline%5D%3D|-$objective->getId()-|%26filters%5BfromGuidelines%5D%3Dtrue"><object title="|-$objective->getName()-|" height="135" width="135">
	<param name="movie" value="images/speedometer.swf">
	<param name="flashvars" value="var3=|-$objective->getSpeed()-|&amp;var4=Main.php%3Fdo%3DobjectivesStrategicObjectivesList%26filters%5Bguideline%5D%3D|-$objective->getId()-|&amp;filters%5BfromGuidelines%5D%3Dtrue">
	<embed src="images/speedometer.swf" wmode="transparent" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="var3=|-$objective->getSpeed()-|&amp;var4=Main.php%3Fdo%3DobjectivesStrategicObjectivesList%26filters%5Bguideline%5D%3D|-$objective->getId()-|%26filters%5BfromGuidelines%5D%3Dtrue" height="135" width="135" /></object></a>
</td>
<td>
	|-if $objective->hasAnyDisbursementIndicator() -|
<form action="Main.php" method="get" style="display:inline;" name="indicator|-$objective->getid()-|">
		<input type="hidden" name="do" value="indicatorsView" />
		<input type="hidden" name="id" value="|-$objective->getid()-|" />
		<input type="hidden" name="entity" value="StrategicObjective" />
		<a href="javascript:void(null)" onclick="indicator|-$objective->getid()-|.submit();" class="bot_desembolsos"><span>Ver curvas de desembolsos</span></a>
	</form>
	|-/if-|
	</td>
<td>
	|-assign var=colorsCount value=$objective->getProjectsByStatusColorCountAssoc()-|	
	<object width="200" height="140" id="objective|-$objective->getId()-|">
		<param name="allowScriptAccess" value="always" />
		<param name="quality" value="high" />
		<param name="movie" value="scripts/FusionCharts/Bar2D.swf"/>	
		<embed src="scripts/FusionCharts/Bar2D.swf" FlashVars="chartWidth=200&chartHeight=140&debugMode=0&dataXML=
		<chart showValues='1' decimals='0' formatNumberScale='0' chartRightMargin='20' chartleftMargin='0' numDivLines='2' yAxisMinValue='0' chartTopMargin='7' chartBottomMargin='7' showBorder='0' useRoundEdges='1' bgColor='#eeeeee' bgAlpha='100' canvasBorderThickness='0' borderColor='#eeeeee' borderThickness='0' decimals='2' thousandSeparator='.' borderAlpha='100' canvasBgColor='#eeeeee' canvasBorderColor='#eeeeee'plotBorderColor='#eeeeee' canvasBorderAlpha='100' canvasBgAlpha='100' divLineAlpha='100' alternateVGridColor='#eeeeee' divLineColor='#eeeeee' showYAxisValues='0'>
		<set label='No vencidos' value='|-$colorsCount.white-|' color='#FFFFFF' link='Main.php%3Fdo%3DprojectsShow%26policyGuidelineId%3D|-$objective->getId()-|%26color%3Dwhite' />
		<set label='En término' value='|-$colorsCount.green-|' color='#33CC00' link='Main.php%3Fdo%3DprojectsShow%26policyGuidelineId%3D|-$objective->getId()-|%26color%3Dgreen' />
		<set label='En alerta' value='|-$colorsCount.yellow-|' color='#FFFF00' link='Main.php%3Fdo%3DprojectsShow%26policyGuidelineId%3D|-$objective->getId()-|%26color%3Dyellow' />
		<set label='Atrasados'  value='|-$colorsCount.red-|' color='#FF0000' link='Main.php%3Fdo%3DprojectsShow%26policyGuidelineId%3D|-$objective->getId()-|%26color%3Dred' />
		<set label='Cancelados'  value='|-$colorsCount.black-|' color='#000000' link='Main.php%3Fdo%3DprojectsShow%26policyGuidelineId%3D|-$objective->getId()-|%26color%3Dblack' />
		<set label='Finalizados'  value='|-$colorsCount.blue-|' color='#0066CC' link='Main.php%3Fdo%3DprojectsShow%26policyGuidelineId%3D|-$objective->getId()-|%26color%blue' /></chart>" quality="high" width="200" height="140" name="objective|-$objective->getId()-|" id="objective|-$objective->getId()-|" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
</td>
</tr>
|-/foreach-|						
</table>
|-/if-|
