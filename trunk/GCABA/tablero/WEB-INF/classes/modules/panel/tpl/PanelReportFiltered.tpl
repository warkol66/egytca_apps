<h2>Tablero de Gestión - |-$parameters.siteName-|</h2> 
<form action='Main.php' method='get' style="display:inline;" class="printHidden">
	|-if $positionsFilters-|
		<input type="hidden" name="do" value="panelReportFiltered" />
			<label for="filters[positionCode]">Secretaría</label>
			<select id="filters[positionCode]" name="filters[positionCode]" title="Dependencia"> 
				<option value="">Seleccione</option> 
			|-foreach from=$positionsFilters item=positionItem name=for_positions-|
				<option value="|-$positionItem->getCode()-|" |-$positionItem->getCode()|selected:$filters.positionCode-|>|-$positionItem->getName()|truncate:75:"...":false-|</option> 
			|-/foreach-|
			</select> 
	|-elseif $policyGuidelines-|
		<input type="hidden" name="do" value="panelReportFiltered" />
			<label for="filters[policyGuideline]">##objectives,1,Eje de Gestión##</label>
			<select id="filters[policyGuideline]" name="filters[policyGuideline]" title="##objectives,1,Eje de Gestión##"> 
				<option value="">Seleccione</option> 
			|-foreach from=$policyGuidelines item=policyGuidelineItem name=for_policyGuidelines-|
				<option value="|-$policyGuidelineItem->getId()-|" |-$policyGuidelineItem->getId()|selected:$filters.policyGuideline-|>|-$policyGuidelineItem->getName()|truncate:75:"...":false-|</option> 
			|-/foreach-|
			</select> 
			Ocultar actividades <input type="checkbox" name="hideActivities" value="1" |-$hideActivities|checked:1-|>
	|-/if-|
	<input type="submit" value="Buscar" />
</form>
<p>&nbsp;</p>
<table width='100%' cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-objectives">
|-if $positions-|
|-if $positions|@count gt 1-|
		<tr>
			<th colspan="2">Dependencias</th>
		</tr>
|-/if-|
	|-foreach from=$positions item=position name=for_positions-|
		<tr>
			<th colspan="2">|-$position->getName()|escape-|</th>
		</tr>
	|-assign var=objectives value=$position->getObjectives()-|
	|-if $objectives|@count gt 0-|
		<tr>
			<th>Objetivos</th>
		</tr>
		<tr>
			<td colspan="2">|-include file="PanelReportObjectivesInclude.tpl" objectives=$objectives include=true-|</td>
		</tr>
	|-/if-|					
	|-assign var=objectives value=""-|
		<tr>
			<td colspan="2" class="|-if $smarty.foreach.for_positions.last-|tdClose|-else-|tdSplit|-/if-|"></td>
		</tr>
	|-assign var=projects value=$position->getProjects()-|
	|-if $projects|@count gt 0-|
		<tr>
			<th>Proyectos</th>
		</tr>
		<tr>
			<td colspan="2">|-include file="PanelReportProjectsInclude.tpl" projects=$projects include=true-|</td>
		</tr>
	|-/if-|					
	|-assign var=projects value=""-|
		<tr>
			<td colspan="2" class="|-if $smarty.foreach.for_positions.last-|tdClose|-else-|tdSplit|-/if-|"></td>
		</tr>
	|-/foreach-|
|-/if-|
|-if $strategicObjectives-|
	|-foreach from=$strategicObjectives item=strategicObjective name=for_strategicObjective-|
			<tr>
			<th colspan="2">|-$strategicObjective->getName()|escape-|</th>
		</tr>
	|-assign var=objectives value=$strategicObjective->getObjectives()-|
	|-if $objectives|@count gt 0-|
		<tr>
			<td colspan="2">|-include file="PanelReportObjectivesInclude.tpl" objectives=$objectives include=true-|</td>
		</tr>
	|-/if-|					
	|-assign var=objectives value=""-|
		<tr>
			<td colspan="2" class="|-if $smarty.foreach.for_positions.last-|tdClose|-else-|tdSplit|-/if-|"></td>
		</tr>
	|-/foreach-|
|-/if-|
|-if $objectives-|
	|-foreach from=$objectives item=objective name=for_objectives-|
			<tr>
			<th colspan="2">|-$objective->getName()|escape-|</th>
		</tr>
	|-assign var=projects value=$objective->getProjects()-|
	|-if $projects|@count gt 0-|
		<tr>
			<td colspan="2">|-include file="PanelReportProjectsInclude.tpl" projects=$projects include=true-|</td>
		</tr>
	|-/if-|					
	|-assign var=projects value=""-|
		<tr>
			<td colspan="2" class="|-if $smarty.foreach.for_positions.last-|tdClose|-else-|tdSplit|-/if-|"></td>
		</tr>
	|-/foreach-|
|-elseif $policyGuideline-|
		<tr>
			<th colspan="2">##objectives,1,Eje de Gestión##: |-$policyGuideline->getName()|escape-|</th>
		</tr>
|-assign var=strategicObjectives value=$policyGuideline->getStrategicObjectives()-|
|-if $strategicObjectives gt 0-|
	|-foreach from=$strategicObjectives item=strategicObjective name=for_strategicObjective-|
			<tr>
			<th colspan="2">|-$strategicObjective->getName()|escape-|</th>
		</tr>
	|-assign var=objectives value=$strategicObjective->getObjectives()-|
	|-if $objectives|@count gt 0-|
		<tr>
			<td colspan="2">|-include file="PanelReportObjectivesInclude.tpl" objectives=$objectives include=true-|</td>
		</tr>
	|-/if-|					
	|-assign var=objectives value=""-|
		<tr>
			<td colspan="2" class="|-if $smarty.foreach.for_positions.last-|tdClose|-else-|tdSplit|-/if-|"></td>
		</tr>
	|-/foreach-|
|-/if-|
|-if $objectives-|
	|-foreach from=$objectives item=objective name=for_objectives-|
			<tr>
			<th colspan="2">|-$objective->getName()|escape-|</th>
		</tr>
	|-assign var=projects value=$objective->getProjects()-|
	|-if $projects|@count gt 0-|
		<tr>
			<td colspan="2">|-include file="PanelReportProjectsInclude.tpl" projects=$projects include=true-|</td>
		</tr>
	|-/if-|					
	|-assign var=projects value=""-|
		<tr>
			<td colspan="2" class="|-if $smarty.foreach.for_positions.last-|tdClose|-else-|tdSplit|-/if-|"></td>
		</tr>
	|-/foreach-|
|-/if-|
|-/if-|
</table>
