<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<link type="text/css" href="css/chosen.css" rel="stylesheet" />
<script language="JavaScript" type="text/javascript" src="scripts/chosen.proto.js"></script>
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="planningProjectsShowWorking"></div>
	<div class="innerLighbox">
		<div id="planningProjectsShowDiv"></div>
	</div>
</div>
<h2>Tablero de Gestión</h2>
|-if $position-|
<h1>|-$position->getName()-|</h1>
<p>Responsable : |-if get_class($position->getActiveTenureName()) eq "PositionTenure"-||-assign var=tenure value=$position->getActiveTenure()-||-if $tenure->getObject() != NULL-||-$tenure->getOwnerName()-| &#8212;  |-assign var=tenureObject value=$tenure->getObject()-||-$tenureObject->getName()-| |-$tenureObject->getSurname()-||-assign var=tenureId value=$tenure->getId()-||-/if-||-/if-|

</p>
<!--Aca comienzan los cambios -->
<script type="text/javascript" src="scripts/FusionCharts.js"></script>
<script type="text/javascript" src="scripts/FusionChartsExportComponent.js"></script>
<link rel="stylesheet" href="css/extrastyles.css" type="text/css" />
<!-- fin de los cambios -->
|-assign var=graphParent value=$position->getGraphParent()-|
|-if $graphParent ne $position-|
|-assign var=closeFieldset value=true-|
<fieldset style="background-color:white !Important;"><legend>|-$graphParent-|</legend>
|-/if-|
<div class="clearfix">
<div class="floatleft" id="chartContainer">Cargando...</div>
    <div class="floatleft">
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
|-if $closeFieldset-|
</fieldset>
|-/if-|

|-elseif $objective-|
	<h1>|-$objective->getName()-|</h1>
|-/if-|        
<h3>Proyectos</h3>
		<table id="table-projects" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
			<tr class="thFillTitle">
				<th width="20%">##objectives,3,Objetivo##</th>
				<th width="2%">&nbsp;</th>
				<th width="40%">Nombre</th>
				<th width="5%">Fecha de Inicio Planificada</th>
				<th width="5%">Fecha de Fin Planificada</th>
				<th width="5%">Fecha Finalización</th>
				<th width="1%">&nbsp;</th>
				<th width="5%">&nbsp;</th>
				<th width="5%"><div style="width:175px;">Actividades</div></th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$projects item=project name=for_projects-|
			|-assign var=colorsCount value=$project->getActivitiesByStatusColorCountAssoc()-|
			<tr>
				<td>|-$project->getOperativeObjective()-|</td>
				<td><a href="javascript:void(null);" class="flag|-$project->statusColor()|capitalize-|"></a></td>
				<td><a href="Main.php?do=panelActivitiesList&filters[projectId]=|-$project->getid()-|&filters[fromProjects]=true" title="Ver actividades del proyecto" title="Ver actividades del proyecto" class="follow">|-$project->getname()-|</a></td>
				<td nowrap>|-$project->getStartingDate()|date_format-|</td>
				<td nowrap>|-$project->getEndingDate()|date_format-|</td>
				<td nowrap>|-$project->getRealEnd()|date_format-|</td>
				<td nowrap>|-if $project->countPlanningConstructions() gt 0-|<a href="Main.php?do=panelConstructionsList&nav=true&filters[planningprojectid]=|-$project->getId()-|" class="icon iconFollow" title="Ver Obras del Proyecto">Ver Obras</a>|-/if-|</td>
				<td align="center" nowrap="nowrap">					|-if "planningProjectsViewX"|security_has_access-||-if $project->getActivities()|count gt 0-|
					<input type="button" class="icon iconViewGantt" onClick='window.open("Main.php?do=planningProjectsViewX&showGantt=true&id=|-$project->getid()-|","Gantt","scrollbars=1,width=800,height=600");' value="Ver Gantt" title="Ver Gantt (abre en ventana nueva)" />|-else-|<img src="images/clear.png" class="icon iconClear disabled" />|-/if-|
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningProjectsViewX" />
						<input type="hidden" name="id" value="|-$project->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningProjectsShowDiv", "Main.php?do=planningProjectsViewX&id=|-$project->getid()-|", { method: "post", parameters: { id: "|-$project->getId()-|"}, evalScripts: true})};$("planningProjectsShowWorking").innerHTML = "<span class=\"inProgress\">buscando Proyecto...</span>";' value="Ver detalle" name="submit_go_show_project" title="Ver detalle" /></a>
					</form>|-/if-|
|-if "panelProjectsEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="panelProjectsEdit" />
						<input type="hidden" name="id" value="|-$project->getid()-|" />
						<input type="submit" name="submit_go_edit_project" value="Editar" class="icon iconListCheck" title="Seguimiento del Proyecto"/>
					</form>|-/if-|</td>
				<td align="center" nowrap ><div style="width:144px;">
					<a href="|-*Main.php?do=panelActivitiesList&filters[projectId]=|-$project->getId()-|&color=white*-|javascript:void(null);" class="flagWhite">
						|-$colorsCount.white-|
					</a>
					<a href="|-*Main.php?do=panelActivitiesList&filters[projectId]=|-$project->getId()-|&color=green*-|javascript:void(null);" class="flagGreen">
						|-$colorsCount.green-|
					</a>
					<a href="|-*Main.php?do=panelActivitiesList&filters[projectId]=|-$project->getId()-|&color=yellow*-|javascript:void(null);" class="flagYellow">					
						|-$colorsCount.yellow-|
					</a>
					<a href="|-*Main.php?do=panelActivitiesList&filters[projectId]=|-$project->getId()-|&color=red*-|javascript:void(null);" class="flagRed">
						|-$colorsCount.red-|
					</a><!--
					<a href="|-*Main.php?do=panelActivitiesList&filters[projectId]=|-$project->getId()-|&color=blue*-|javascript:void(null);" class="flagBlue">
						|-$colorsCount.blue-|
					</a>--></div>
				</td>
			</tr>
		|-/foreach-|						
		</tbody>
	</table>
