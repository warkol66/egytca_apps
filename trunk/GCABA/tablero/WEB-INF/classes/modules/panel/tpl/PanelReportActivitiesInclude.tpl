|-if !$include-|
<h2>Tablero de Gestión - |-$parameters.siteName-|</h2> 
<h1>Objetivos por Secretarías</h1> 
<p>A continuación encontrará el listado con las dependencias y sus respectivos objetivos. |-if !$toPrint-|Para obtener una versión para imprimir, haga click <a href="Main.php?do=objectivesReport&amp;toPrint=true" target="_blank">aquí</a>.|-/if-|</p>
|-else-|
|-/if-|					
	<table width='100%' cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-activities">
	|-if $activities|@count gt 0-|
		<tr class="thFillTitle">
			<th>Actividades</th>
		</tr>
	|-foreach from=$activities item=activity name=for_activity-|
		<tr>
			<td width="30%">|-$activity->getName()|escape-|</td>
<!--			<td width="60%">|-$activity->getDescription()|escape-|</td> -->
		</tr>
	|-/foreach-|
	|-assign var=activities value=""-|
	|-/if-|					
		<tr>
			<td colspan="2" class="|-if $smarty.foreach.for_positions.last-|tdClose|-else-|tdSplit|-/if-|"></td>
		</tr>
</table>
