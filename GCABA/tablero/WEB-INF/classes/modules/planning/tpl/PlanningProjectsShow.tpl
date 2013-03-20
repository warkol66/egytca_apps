<h2>Tablero de Gestión</h2>
|-if $position-|
<h1>|-$position->getName()-|</h1>
<p>Responsable : |-$position->getOwnerName()-|
|-if get_class($position->getActiveTenureName()) eq "PositionTenure"-|
|-assign var=tenure value=$position->getActiveTenureName()-|
|-if $tenure->getObject() != NULL-|
&#8212;  |-assign var=tenureObject value=$tenure->getObject()-||-$tenureObject->getName()-| |-$tenureObject->getSurname()-||-/if-|
|-else-|
|-assign var=userInfo value=$position->getActiveTenureName()-|
|-if $userInfo->getName() ne '' || $userInfo->getSurname() ne ''-|
 &#8212; |-/if-|
|-$userInfo->getName()-|
 |-$userInfo->getSurname()-|
|-/if-|
</p>
<!--Aca comienzan los cambios -->
<script type="text/javascript" src="scripts/FusionCharts.js"></script>
<script type="text/javascript" src="scripts/FusionChartsExportComponent.js"></script>
<link rel="stylesheet" href="css/extrastyles.css" type="text/css" />
<!-- fin de los cambios -->

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


|-elseif $objective-|
	<h1>|-$objective->getName()-|</h1>
|-/if-|        
<h3>Filtrar Proyectos &nbsp;|&nbsp; <form action='Main.php' method='get' style="display:inline;"><input type="hidden" name="do" value="planningProjectsShow" />
&nbsp;&nbsp;Prioridad Ministerial
<select name="filters[ministrypriority]">
<option value="">Seleccione</option>
<option value="1">Si</option>
<option value="0">No</option>
</select>
&nbsp;&nbsp;Prioridad Jefatura
<select name="filters[priority]">
<option value="">Seleccione</option>
	|-foreach from=$priorities key=key item=name-|
		<option value="|-$key-|" |-$filters.priority|selected:$key-|>|-$name-|</option>
	|-/foreach-|
</select>
&nbsp;&nbsp;Inversión
<select name="filters[investment]">
<option value="">Seleccione</option>
<option value="1">Si</option>
<option value="0">No</option>
</select>
&nbsp;&nbsp;Etiquetas
<select name="filters[tag]">
<option value="">Seleccione</option>
	|-foreach from=$planningTags item=tag-|
		<option value="|-$tag->getId()-|" |-$filters.tag|selected:$tag->getId()-|>|-$tag-|</option>
	|-/foreach-|
</select>
|-include file="FiltersRedirectInclude.tpl" filters=$filters-|<input type='submit' value='Buscar' class='tdSearchButton' />|-if $filters|@count gt 0-|
				&nbsp;&nbsp;<input type='button' onClick='location.href="Main.php?do=planningProjectsList"' value="Quitar Filtros" title="Quitar Filtros"/>
|-/if-|
</form></h3>
		<table id="table-projects" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
			<tr class="thFillTitle">
				<th width="20%">##objectives,3,Objetivo##</th>
				<th width="2%">&nbsp;</th>
				<th width="40%">Nombre</th>
				<th width="5%">Fecha</th>
				<th width="5%">Fin Planificado </th>
				<th width="5%">Terminado</th>
				<th width="5%"><div style="width:175px;">Actividades</div></th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$projects item=project name=for_projects-|
			|-assign var=colorsCount value=$project->getActivitiesByStatusColorCountAssoc()-|
			<tr>
				<td>|-$project->getOperativeObjective()-|</td>
				<td><a href="javascript:void(null);" class="flag|-$project->statusColor()|capitalize-|"></a></td>
				<td><a href="Main.php?do=planningActivitiesList&filters[|-if get_class($project) eq "PlanningConstruction"-|construction|-else-|project|-/if-|Id]=|-$project->getid()-|&filters[fromProjects]=true" title="Ver actividades del proyecto" class="follow">|-$project->getname()-|</a></td>
				<td nowrap>|-*$project->getdate()|date_format*-|</td>
				<td nowrap>|-*$project->getPlannedEnd()|date_format:"%d-%m-%Y"*-|</td>
				<td align="center">|-$project->getAcomplished()|si_no-|</td>
				<td align="center" nowrap >
					<a href="Main.php?do=planningActivitiesList&filters[|-if get_class($project) eq "PlanningConstruction"-|construction|-else-|project|-/if-|Id]=|-$project->getId()-|&filters[color]=white" class="flagWhite">
						|-$colorsCount.white-|
					</a>
					<a href="Main.php?do=planningActivitiesList&filters[|-if get_class($project) eq "PlanningConstruction"-|construction|-else-|project|-/if-|Id]=|-$project->getId()-|&filters[color]=green" class="flagGreen">
						|-$colorsCount.green-|
					</a>
					<a href="Main.php?do=planningActivitiesList&filters[|-if get_class($project) eq "PlanningConstruction"-|construction|-else-|project|-/if-|Id]=|-$project->getId()-|&filters[color]=yellow" class="flagYellow">					
						|-$colorsCount.yellow-|
					</a>
					<a href="Main.php?do=planningActivitiesList&filters[|-if get_class($project) eq "PlanningConstruction"-|construction|-else-|project|-/if-|Id]=|-$project->getId()-|&filters[color]=red" class="flagRed">
						|-$colorsCount.red-|
					</a>
					<a href="Main.php?do=planningActivitiesList&filters[|-if get_class($project) eq "PlanningConstruction"-|construction|-else-|project|-/if-|Id]=|-$project->getId()-|&filters[color]=blue" class="flagBlue">
						|-$colorsCount.blue-|
					</a>
				</td>
			</tr>
		|-/foreach-|						
		</tbody>
	</table>
