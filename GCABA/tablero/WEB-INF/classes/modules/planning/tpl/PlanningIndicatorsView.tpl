|-if !$notValidId-|
|-if !$disbursement-|
	<h2>Indicadores</h2>
	<h1>Ver Indicador</h1>
		|-if !$lightbox-|
		|-if !$fromEdit-|
			<input type="button" id="indicatorsList" name="indicatorsList" title="Ir a listado de Indicadores" value="Ir a listado de Indicadores" onClick="location.href='Main.php?do=planningIndicatorsList'" />
		|-else-|
			<input type="button" id="button_edit_xs" name="button_edit_xs" title="Regresar" value="Regresar" onClick="javascript:history.back(1)" />
			<input type="button" id="indicatorsList" name="indicatorsList" title="Ir a listado de Indicadores" value="Ir a listado de Indicadores" onClick="location.href='Main.php?do=planningIndicatorsList'" />
		|-/if-|
		|-/if-|
|-else-|
	<h2>|-if $entity eq "Objective"-|Subcomponentes|-elseif $entity eq "StrategicObjective"-|Componentes|-else-|Proyectos|-/if-|</h2>
	<h1>Curva de desembolso |-if $entityObj-| - |-$entityObj->getName()-||-/if-|</h1>
	|-if $message eq "graph_ok"-|
		<div class="successMessage">Se ha creado la curva de desembolso correctamente.</div>
		<p>Para cargar los datos, ingrese a Editar Importes.</p>
	|-/if-|
	|-if !$entity-|
  <p><input type="button" id="button_edit_xs" name="button_edit_xs" title="Editar Curvas" value="Editar Curvas" onClick="location.href='Main.php?do=indicatorsSeriesEdit&id=|-$indicator->getId()-|&disbursement=1'" />
	<input type="button" id="button_edit_xs" name="button_edit_xs" title="Editar Meses" value="Editar Meses" onClick="location.href='Main.php?do=indicatorsXsEdit&id=|-$indicator->getId()-|&disbursement=1'" />
		<input type="button" id="button_edit_ys" name="button_edit_ys" title="Editar Importes" value="Editar Importes" onClick="location.href='Main.php?do=indicatorsYsEdit&id=|-$indicator->getId()-|&disbursement=1'" />
		<input type="button" id="projectsList" name="projectsList" title="Ir a listado de Projectos" value="Ir a listado de Projectos" onClick="location.href='Main.php?do=projectsList'" /></p>
	|-else-|
		<input type="button" id="button_edit_xs" name="button_edit_xs" title="Regresar" value="Regresar" onClick="javascript:history.back(1)" />
	|-/if-|
|-/if-|
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
|-if $indicator->getType() eq constant("PlanningIndicator::COLUMN")-|
	|-assign var=graphType value='MSColumn3D'-|
|-elseif $indicator->getType() eq constant("PlanningIndicator::LINE")-|
	|-assign var=graphType value='MSLine'-|
|-elseif $indicator->getType() eq constant("PlanningIndicator::PIE")-|
	|-assign var=graphType value='Pie3D'-|
|-elseif $indicator->getType() eq constant("PlanningIndicator::STACKEDCOLUMN")-|
	|-assign var=graphType value='StackedColumn2D'-|
|-/if-|
<script language="JavaScript" src="scripts/FusionCharts/FusionCharts.js"></script>
	<div id="chartdiv" align="center"></div>
	<script type="text/javascript">
		 var chart = new FusionCharts("scripts/FusionCharts/|-$graphType-|.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "ChartId", "640", "420", "0", "0");
		 |-if $entity ne ''-|
		 	chart.setDataURL("Main.php%3Fdo%3DplanningIndicatorsViewXml%26id%3D|-$entityId-|%26entity%3D|-$entity-|");
		 |-else-|
		 	chart.setDataURL("Main.php%3Fdo%3DplanningIndicatorsViewXml%26id%3D|-$indicator->getId()-|");
		 |-/if-|
		 chart.render("chartdiv");
	</script>
<p>&nbsp;</p>
<p>|-$indicator->getSource()-|</p>
<p>&nbsp;</p>
|-else-|
	<h1>Administración de Indicadores</h1>
	<div class="errorMessage">El identificador del indicador ingresado no es válido. Seleccione un indicador de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=planningIndicatorsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Indicadores"/>
|-/if-|
<script language="JavaScript" type="text/JavaScript">
	$("planningGraphShowWorking").innerHTML = "";
</script>
