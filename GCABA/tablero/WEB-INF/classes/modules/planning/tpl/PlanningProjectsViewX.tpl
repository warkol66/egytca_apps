|-if !$showGantt-|	
	|-include file="PlanningProjectsForm.tpl" readonly="readonly"-|
|-else-|
	<script language="JavaScript" src="scripts/FusionCharts/FusionCharts.js"></script>
|-assign var=activities value=$planningProject->getActivities()-|
	|-capture name=xml-|<chart dateFormat='dd-mm-yyyy' caption='|-$planningProject->getName()-|' subCaption='' showSlackAsFill='0' showPercentLabel='1'><categories><category start='01-01-2013' end='31-12-2013' label='2013' /></categories><categories><category start='01-01-2013' end='31-01-2013' label='Ene' /><category start='01-02-2013' end='28-02-2013' label='Feb' /><category start='01-03-2013' end='31-03-2013' label='Mar' /><category start='01-04-2013' end='30-04-2013' label='Abr' /><category start='01-05-2013' end='31-05-2013' label='May' /><category start='01-06-2013' end='30-06-2013' label='Jun' /><category start='01-07-2013' end='31-07-2013' label='Jul' /><category start='01-08-2013' end='31-08-2013' label='Ago' /><category start='01-09-2013' end='30-09-2013' label='Sep' /><category start='01-10-2013' end='31-10-2013' label='Oct' /><category start='01-11-2013' end='30-11-2013' label='Nov' /><category start='01-12-2013' end='31-12-2013' label='Dic' /></categories><processes fontSize='12' isBold='0' align='right' headerText='Actividades' headerFontSize='18' headerVAlign='bottom' headerAlign='right'>|-/capture-|
	|-capture name=process-||-foreach from=$activities item=activity name=for_contractActivitys-|<process label='|-$activity|escape:"javascript"-|' />|-/foreach-|</processes>|-/capture-|
	|-capture name=task-|<tasks>|-foreach from=$activities item=activity name=for_contractActivitys-|<task start='|-$activity->getStartingDate()|date_format:"%d-%m-%Y"-|' end='|-$activity->getEndingDate()|date_format:"%d-%m-%Y"-|' label='|-$activity|escape:"javascript"-|' showLabel='1' id='|-$activity->getid()-|' showborder='0'/>|-/foreach-|</tasks><milestones>|-foreach from=$activities item=activity name=for_contractActivitys-||-if ($activity->getStartingDate() eq $activity->getEndingDate()) || ($activity->getStartingDate() neq "" && $activity->getEndingDate() eq "")-|<milestone date='|-if $activity->getStartingDate() neq ""-||-$activity->getStartingDate()|date_format:"%d-%m-%Y"-||-else-||-$activity->getEndingDate()|date_format:"%d-%m-%Y"-||-/if-|' taskId='|-$activity->getid()-|' radius='10' color='333333' shape='Star' numSides='5' borderThickness='1' tooltext='|-$activity|escape:"javascript"-|, |-if $activity->getStartingDate() neq ""-||-$activity->getStartingDate()|date_format:"%d-%m-%Y"-||-else-||-$activity->getEndingDate()|date_format:"%d-%m-%Y"-||-/if-|'/>|-/if-||-/foreach-|</milestones></chart>|-/capture-| 

<div id="chartdiv" align="center">Diagrama de Gantt</div>
<script type="text/javascript">|-assign var=height value="450"-||-math equation="q * y" q=$planningProject->countActivities() y="35" assign=calculatedHeight-|
	var myChart = new FusionCharts("scripts/FusionCharts/Gantt.swf", "myChartId", "700", "|-if $calculatedHeight gt $height-||-$calculatedHeight-||-else-||-$height-||-/if-|", "0", "0");
	myChart.setDataXML("|-$smarty.capture.xml-||-$smarty.capture.process-||-$smarty.capture.task-|");
	myChart.render("chartdiv");
 </script>
|-/if-|
	<script language="JavaScript" type="text/JavaScript">
		$("planningProjectsShowWorking").innerHTML = "";
	</script>

