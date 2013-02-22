<h2>Seguimiento
|-if isset($show) && is_object($dependency)-|
 - <a href="Main.php?do=tableroPolicyGuidelinesShow">|-$dependency->getName()-|</a></h2> 
|-/if-|
|-if !$notValidId || is_object($planningProject)-|
<h1>Seguimiento  de Proyectos</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->


<!--Aca comienzan los cambios -->
<script type="text/javascript" src="scripts/FusionCharts.js"></script>
<script type="text/javascript" src="scripts/FusionChartsExportComponent.js"></script>
<link rel="stylesheet" href="css/extrastyles.css" type="text/css" />
<!-- fin de los cambios -->
|-if is_object($planningProject->getPosition())-|
|-assign var=position value=$planningProject->getPosition()-|

<p>Responsable: |-$position->getGraphParent()-|</p>

<div class="clearfix">
<div class="floatleft" id="chartContainer">Cargando...</div>
    <div class="floatleft">
        <object title="Jefatura de Gabinete de Ministros" height="250" width="250">
            <param name="wmode" value="transparent" />
            <param name="movie" value="images/speedometer.swf" />
            <param name="flashvars" value="var3=20&amp;var4=Main.php?do=positionsShow&amp;positionId=3" />
            <embed src="images/speedometer.swf" wmode="transparent" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="var3=|-$position->getSpeed()-|&amp;var4=Main.php?do=positionsShow&amp;positionId=|-$position->getId()-|" height="250" width="250" /></object>
    </div>
<div class="floatleft" id="chartContainer2">Cargando...</div>
<script type="text/javascript">

var myChart = new FusionCharts( "images/Pie3D.swf", "myChartId", "400", "300", "0", "1" );
myChart.setDataURL(escape("Main.php?do=planningCakeByStatusColorXml&type=projects&positionId=|-$position->getId()-|"));
myChart.render("chartContainer");

var myChart2 = new FusionCharts( "images/Pie3D.swf", "myChartId2", "400", "300", "0", "1" );
myChart2.setDataURL(escape("Main.php?do=planningCakeByStatusColorXml&type=constructions&positionId=|-$position->getId()-|"));
myChart2.render("chartContainer2");
</script>
</div>

|-/if-|

<div id="div_project">
	<h1>Proyecto: |-$planningProject->getName()-|</h1>
	<h3>Listado y Gantt de actividades</h3>
  <form name="form_edit_project" id="form_edit_project" action="Main.php" method="post">
	|-include file="PlanningActivitiesInclude.tpl" activities=$planningProject->getActivities() showGantt="true" margin="false" add="false"-|
    <input type="hidden" name="id" id="id" value="|-$planningProject->getId()-|" /> 
		|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
    <input type="hidden" name="do" id="do" value="panelProjectsDoEdit" /> 
		<p>|-javascript_form_validation_button id="button_edit" value='Guardar cambios' title='Guardar cambios'-|</p>
</form>

	<h3>Listado de obras</h3>
	|-include file="PanelConstructionsInclude.tpl" constructions=$planningProject->getPlanningConstructions() showGantt="true"-|
</div>
|-else-|
	<h1>Administración de Proyectos</h1>
	<div class="errorMessage">El identificador del proyecto ingresado no es válido. Seleccione un proyecto de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=planningProjectsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Proyectos"/>
|-/if-|

    <script type="text/javascript" src="scripts/FusionCharts.js"></script>
    <script type="text/javascript" src="scripts/FusionChartsExportComponent.js"></script>
    <link rel="stylesheet" href="css/extrastyles.css" type="text/css" />
</head>
<body>

|-if is_object($planningProject)-||-includeReport id=$planningProject->getId()-||-/if-|
<div id="planningActivityDocumentsEditTemplate" style="display:none">
	|-include file="DocumentsEditInclude.tpl" entity="PlanningActivity" entityId="<%planningActivityId%>" iframe="true" target="submit-iframe"-|
	<iframe name="submit-iframe" style="display: none;" |-*onload="if (this.innerHTML != '') { closeLightbox(); loadAddDocumentsLightbox('<%planningActivityId%>'); openLightbox1(); }"*-|></iframe>
</div>


<div id="fcexpDiv" align="center">FusionCharts Export</div>
  <script type="text/javascript">
  var myExportComponent = new FusionChartsExportObject("fcExporter1", "images/FCExporter.swf");
     //Render the exporter SWF in our DIV fcexpDiv
		myExportComponent.Render("fcexpDiv");
	</script>