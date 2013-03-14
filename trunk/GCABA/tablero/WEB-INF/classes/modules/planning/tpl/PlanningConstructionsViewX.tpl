|-if !$showGantt-|	
	|-include file="PlanningConstructionsForm.tpl" readonly="readonly"-|
|-else-|
	<script language="JavaScript" src="scripts/FusionCharts/FusionCharts.js"></script>
|-assign var=activities value=$planningConstruction->getActivitiesOrderedForGantt()-|
	|-capture name=xml-|<chart dateFormat='dd/mm/yyyy' caption='|-$planningConstruction->getName()-|' subCaption='' showSlackAsFill='0' showPercentLabel='1'>	|-foreach from=$datesArray item=date name=for_categories-|
	|-if !$date@first-|
		|-assign var=tempYearFrom value=$date.first|date_format:"Y"-|
		|-if $tempYearFrom neq $yearFrom-|<categories><category start='|-$dateFrom-|' end='|-$dateTo-|' label='|-$yearFrom-|' />
			|-assign var=dateFrom value=$date.first|date_format-|
			|-assign var=dateTo value=$date.last|date_format-|
			|-assign var=yearFrom value=$tempYearFrom-|
		|-else-|
			|-assign var=dateTo value=$date.last|date_format-|
		|-/if-|
		|-if $date@last-|
			<category start='|-$dateFrom-|' end='|-$dateTo-|' label='|-$yearFrom-|' /></categories>
		|-/if-|
	|-else-|
		|-assign var=yearFrom value=$date.first|date_format:"Y"-|
		|-assign var=dateFrom value=$date.first|date_format-|
		|-assign var=dateTo value=$date.last|date_format-|
	|-/if-|	
	|-/foreach-|
	<categories>
	|-foreach from=$datesArray item=date name=for_categories-|
		<category start='|-$date.first|date_format-|' end='|-$date.last|date_format-|' label='|-$date.first|date_format:"M"-|' />
	|-/foreach-|
	</categories>
	<processes fontSize='10' isBold='0' align='left' headerText='Actividades' headerFontSize='18' headerVAlign='bottom' headerAlign='left'>|-/capture-|
	|-capture name=process-||-foreach from=$activities item=activity name=for_contractActivitys-|<process label='|-$activity|escape:"javascript"-|' />|-/foreach-|</processes>|-/capture-|
	|-capture name=task-|<tasks>|-foreach from=$activities item=activity name=for_contractActivitys-|<task start='|-$activity->getEndingDate()|date_format:"%d/%m/%Y"-|' end='|-$activity->getEndingDate()|date_format:"%d/%m/%Y"-|' label='|-$activity|escape:"javascript"-|' showLabel='0' id='|-$activity->getid()-|' showborder='0'/>|-/foreach-|</tasks><milestones>|-foreach from=$activities item=activity name=for_contractActivitys-|<milestone date='|-$activity->getEndingDate()|date_format:"%d/%m/%Y"-|' taskId='|-$activity->getid()-|' radius='10' color='|-if $activity->getAcomplished()-|00ACD3|-else-|D38200|-/if-|' shape='Star' numSides='5' |-if $activity->getPriority()-|showBorder='true' borderThickness='3' borderColor='FFF602'|-/if-| tooltext='|-$activity|escape:"javascript"-|, |-$activity->getEndingDate()|date_format:"%d/%m/%Y"-|'/>|-/foreach-|</milestones></chart>|-/capture-| 
<div id="chartdiv" align="center">Diagrama de Gantt</div>
<script type="text/javascript">|-assign var=height value="250"-||-math equation="q * y" q=$planningConstruction->countActivities() y="35" assign=calculatedHeight-|
	var myChart = new FusionCharts("scripts/FusionCharts/Gantt.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId", "700", "|-if $calculatedHeight gt $height-||-$calculatedHeight-||-else-||-$height-||-/if-|", "0", "0");
	myChart.setDataXML("|-$smarty.capture.xml-||-$smarty.capture.process-||-$smarty.capture.task-|");
	myChart.render("chartdiv");
 </script>
<div>
<p>&nbsp;</p>
<p>&nbsp;</p>
	<p align="center">Actividades Prioritarias  <img src="images/clear.png" style="background-color:#00ACD3; border: 3px solid #FFF602" height="9px" width="24px" /> o <img src="images/clear.png" style="background-color:#D38200; border: 3px solid #FFF602" height="9px" width="24px" />
&nbsp;&nbsp;/&nbsp;&nbsp;Actividades Terminadas <img src="images/clear.png" style="background-color:#00ACD3" height="15px" width="30px" />
</p>
</div>
|-/if-|
	<script language="JavaScript" type="text/JavaScript">
		$("planningConstructionsShowWorking").innerHTML = "";
	</script>
