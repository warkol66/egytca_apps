|-if !$include-|
<h2>Tablero de Gestión - |-$parameters.siteName-|</h2> 
<h1>Objetivos por Secretarías</h1> 
<p>A continuación encontrará el listado con las dependencias y sus respectivos objetivos. |-if !$toPrint-|Para obtener una versión para imprimir, haga click <a href="Main.php?do=objectivesReport&amp;toPrint=true" target="_blank">aquí</a>.|-/if-|</p>
|-else-|
|-/if-|					
<table width='100%' cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-objectives">
		<tr class="thFillTitle">
			<th colspan="2">##projects,2,Proyectos##</th>
		</tr>
	|-foreach from=$projects item=project name=for_projects-|
		<tr class="thFillTitle">
			<th colspan="2">|-$project->getName()|escape-||-if $configModule->get("projects","useCodeAux")-| (SEPA: |-$project->getCodeAux()|escape-|)|-/if-|</th>
		</tr>
		<tr>
			<td colspan="2">|-$project->getDescription()|escape-|</td>
		</tr>
	|-if !$hideActivities-|
	|-assign var=activities value=$project->getAllActivities()-|
	|-if $activities|@count gt 0-|
		<tr>
			<td colspan="2" class="noPaddingCell">|-include file="PanelReportActivitiesInclude.tpl" activities=$activities include=true-|</td>
		</tr>
	|-/if-|					
		<tr>
			<td colspan="2" class="|-if $smarty.foreach.for_positions.last-|tdClose|-else-|tdSplit|-/if-|"></td>
		</tr>
	|-/if-|
	|-/foreach-|
	|-assign var=projects value=""-|
</table>
