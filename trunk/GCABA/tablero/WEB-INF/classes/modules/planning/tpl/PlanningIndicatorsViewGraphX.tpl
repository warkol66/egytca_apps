|-if !$notValidId-|
|-if $indicator->getGraphType() eq constant("PlanningIndicator::COLUMN")-|
	|-assign var=graphType value='MSColumn3D'-|
|-elseif $indicator->getGraphType() eq constant("PlanningIndicator::LINE")-|
	|-assign var=graphType value='MSLine'-|
|-elseif $indicator->getGraphType() eq constant("PlanningIndicator::PIE")-|
	|-assign var=graphType value='Pie3D'-|
|-elseif $indicator->getGraphType() eq constant("PlanningIndicator::STACKEDCOLUMN")-|
	|-assign var=graphType value='StackedColumn2D'-|
|-/if-|
<script language="JavaScript" src="scripts/FusionCharts/FusionCharts.js"></script>
	<div id="chartdiv" align="center"></div>
	<script type="text/javascript">
		 var chart = new FusionCharts("scripts/FusionCharts/|-$graphType-|.swf", "ChartId", "640", "420", "0", "0");
		 |-if $entity ne ''-|
		 	chart.setDataURL("Main.php%3Fdo%3DplanningIndicatorsViewXml%26id%3D|-$entityId-|%26entity%3D|-$entity-|");
		 |-else-|
		 	chart.setDataURL("Main.php%3Fdo%3DplanningIndicatorsViewXml%26id%3D|-$indicator->getId()-|");
		 |-/if-|
		 chart.render("chartdiv");
	</script>
|-else-|
	<h1>Administración de Indicadores</h1>
	<div class="errorMessage">El identificador del indicador ingresado no es válido. Seleccione un indicador de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=planningIndicatorsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Indicadores"/>
|-/if-|
