<h2>Tablero de Gestión - |-$parameters.siteName-|</h2> 
<h1>Objetivos por Secretarías</h1> 
<p>A continuación encontrará el listado con las dependencias y sus respectivos objetivos. |-if !$toPrint-|Para obtener una versión para imprimir, haga click <a href="Main.php?do=objectivesReport&amp;toPrint=true" target="_blank">aquí</a>.|-/if-|</p>
<table width='100%' cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-objectives">
	|-foreach from=$positions item=position name=for_positions-|
			<tr class="thFillTitle">
			<th colspan="2">|-$position->getName()|escape-|</th>
		</tr>
	|-assign var=objectives value=$position->getObjectives()-|
	|-if $objectives|@count gt 0-|
		<tr>
			<th width="30%">Objetivo</th>
			<th width="60%">Descripción</th>
		</tr>
	|-foreach from=$objectives item=objective name=for_objectives-|
		<tr>
			<td width="30%">|-$objective->getName()|escape-|</td>
			<td width="60%">|-$objective->getDescription()|escape-|</td>
		</tr>
	|-/foreach-|
	|-/if-|					
		<tr>
			<td colspan="2" class="|-if $smarty.foreach.for_positions.last-|tdClose|-else-|tdSplit|-/if-|"></td>
		</tr>
	|-/foreach-|
</table>
