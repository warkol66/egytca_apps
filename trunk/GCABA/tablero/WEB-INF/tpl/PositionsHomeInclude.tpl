<table width='60%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-objectives">
	<thead>
		<tr class="thFillTitle">
			<th colspan="2">Ministerio</th>
			<th colspan="1">&nbsp;</th>													
		</tr>
	</thead>
	<tbody>
	|-foreach from=$result item=position name=for_positions-|	
		<tr>
			<td width="2%"></td> 
			<td width="90%"><a href="Main.php?do=planningImpactObjectivesList&id=|-$position->getId()-|&nav=true&objectives=true&filters[entityFilter][entityType]=position&filters[entityFilter][entityId]=|-$position->getId()-|" class="follow">|-$position->getname()-|</a></td>
			<td width="2%" align="center" nowrap >
			</td>
		</tr>
	|-/foreach-|						
	</tbody>
</table>
