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
|-assign var=graphParent value=$position->getGraphParent()-|
                <object title="|-$graphParent-|" height="250" width="250">
                    <param name="wmode" value="transparent" />
                    <param name="movie" value="images/speedometer.swf" />
                    <param name="flashvars" value="var3=|-$graphParent->getSpeed()-|" />
                    <embed src="images/speedometer.swf" wmode="transparent" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="var3=|-$graphParent->getSpeed()-|" height="250" width="250" /></object>
                </div>
<div class="floatleft" id="chartContainer2">Cargando...</div>
<script type="text/javascript">

var myChart = new FusionCharts( "images/Pie3D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId", "400", "300", "0", "1" );
myChart.setDataURL(escape("Main.php?do=planningCakeByStatusColorXml&type=projects&positionId=|-$position->getId()-|"));
myChart.setTransparent(true);
myChart.render("chartContainer");

var myChart2 = new FusionCharts( "images/Pie3D.swf?ChartNoDataText=No se encontraron datos para mostrar&PBarLoadingText=Cargando datos&ChartNoDataText=No se encontraron datos para mostrar&LoadDataErrorText=Error cargando los datos&InvalidXMLText=Datos inválidos&XMLLoadingText=Obteniendo datos", "myChartId2", "400", "300", "0", "1" );
myChart2.setDataURL(escape("Main.php?do=planningCakeByStatusColorXml&type=constructions&positionId=|-$position->getId()-|"));
myChart2.setTransparent(true);
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

|-if !$planningProject->isNew()-|
<fieldset><legend>Notas de Seguimiento</legend>
<div id="messageAdd"></div>
|-assign var=panelNotes value=$planningProject->getPanelNotes()-|
<ul id="panelNotes" class="iconOptionsList">|-foreach from=$panelNotes item=note-|
			<li id="noteListItem|-$note->getId()-|" title="Nota">
						<form action="Main.php" method="post" style="display:inline;"> 
							<input type="hidden" name="do" value="panelNotesDoDeleteX" /> 
							<input type="hidden" name="id" value="|-$note->getId()-|" /> 
							<input type="button" name="submit_go_remove_actor" value="Borrar" title="Eliminar nota" onclick="if (confirm('Seguro que desea eliminar nota?')) removePanelNotes(this.form);" class="icon iconDelete" /> 
						</form> |-$note->getCreatedAt()|change_timezone|dateTime_format-| - |-$note->updatedBy()-| | |-$note->getNote()-|</li>
|-/foreach-|</ul>
<h3>Agregar nota</h3>
<script language="JavaScript" type="text/JavaScript">
	function removePanelNotes(form){
		var fields = Form.serialize(form);
		var myAjax = new Ajax.Updater(
					{success: 'panelNotes'},
					'Main.php?do=panelNotesDoDeleteX',
					{
						method: 'post',
						postBody: fields,
						evalScripts: true,
						insertion: Insertion.Bottom
					});
		$('messageAdd').innerHTML = '<span class="inProgress">Eliminando nota...</span>';
		return true;
	}
function addPanelNotes(form) {
			var fields = Form.serialize(form);
			var myAjax = new Ajax.Updater(
				{success: 'panelNotes'},
				'Main.php?do=panelNotesDoAddX',
				{
					method: 'post',
					postBody: fields,
					evalScripts: true,
					insertion: Insertion.Bottom
				});	
	$('messageAdd').innerHTML = '<span class="inProgress">agregando nota ...</span>';
	return true;
}
</script>

<form method="post" style="display:inline;">
	<input type="hidden" name="do" id="do" value="panelNotesDoAddX" /> 
	<input type="hidden" name="params[objectId]" id="params_objectId" value="|-$planningProject->getId()-|" />
	<input type="hidden" name="params[objectType]" id="params_objectType" value="PlanningProject" />
	<p><label for="params_note">Texto de la nota</label><textarea name="params[note]" cols="60" rows="5" wrap="VIRTUAL" id="params_note" height="5"></textarea></p>
  <input type="button" id="addNote" name="addNoteSubmit" value="Agregar nota" title="" onClick="javascript:addPanelNotes(this.form)"/> </p>
</form>
</fieldset> 
|-/if-|
|-else-|
	<h1>Administración de Proyectos</h1>
	<div class="errorMessage">El identificador del proyecto ingresado no es válido. Seleccione un proyecto de la lista.</div>
	<input type='button' onClick='location.href="Main.php?do=planningProjectsList|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|"' value='##104,Regresar##' title="Regresar al listado de Proyectos"/>
|-/if-|

    <script type="text/javascript" src="scripts/FusionCharts.js"></script>
    <script type="text/javascript" src="scripts/FusionChartsExportComponent.js"></script>
    <link rel="stylesheet" href="css/extrastyles.css" type="text/css" />

|-if is_object($planningProject)-||-includeReport id=$planningProject->getId()-||-/if-|

<div id="fcexpDiv" align="center">FusionCharts Export</div>
  <script type="text/javascript">
  var myExportComponent = new FusionChartsExportObject("fcExporter1", "images/FCExporter.swf");
     //Render the exporter SWF in our DIV fcexpDiv
		myExportComponent.Render("fcexpDiv");
	</script>
