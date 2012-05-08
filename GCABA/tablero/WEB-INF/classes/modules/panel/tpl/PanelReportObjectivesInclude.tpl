|-if !$include-|
<h2>Tablero de Gestión - |-$parameters.siteName-|</h2> 
<h1>Objetivos por Secretarías</h1> 
<p>A continuación encontrará el listado con las dependencias y sus respectivos objetivos. |-if !$toPrint-|Para obtener una versión para imprimir, haga click <a href="Main.php?do=objectivesReport&amp;toPrint=true" target="_blank">aquí</a>.|-/if-|</p>
|-else-|
|-/if-|					
<table width='100%' cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-objectives">
	|-foreach from=$objectives item=objective name=for_objectives-|
		<tr class="thFillTitle">
			<th colspan="2">|-$objective->getName()|escape-|</th>
		</tr>
		<tr>
			<td colspan="2">|-$objective->getDescription()|escape-|</td>
		</tr>
	|-assign var=projects value=$objective->getProjects()-|
	|-if $projects|@count gt 0-|
		<tr>
			<td colspan="2" class="noPaddingCell">|-include file="PanelReportProjectsInclude.tpl" projects=$projects include=true-|</td>
		</tr>
	|-/if-|					
		<tr>
			<td colspan="2" class="|-if $smarty.foreach.for_positions.last-|tdClose|-else-|tdSplit|-/if-|"></td>
		</tr>
	|-/foreach-|
	|-assign var=objectives value=""-|
</table>
