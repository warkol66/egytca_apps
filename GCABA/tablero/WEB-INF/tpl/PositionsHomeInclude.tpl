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
			<td width="2%"><a href="Main.php?do=planningImpactObjectivesList&id=|-$position->getId()-|&nav=true&objectives=true&filters[entityFilter][entityType]=position&filters[entityFilter][entityId]=|-$position->getId()-|" class="icon iconFollow">|-$position->getname()-|</a></td> 
			<td width="90%"><a href="Main.php?do=planningImpactObjectivesList&id=|-$position->getId()-|&nav=true&objectives=true&filters[entityFilter][entityType]=position&filters[entityFilter][entityId]=|-$position->getId()-|" class="follow">|-$position->getname()-|</a></td>
			<td width="2%" align="center" nowrap>|-if $position->countBrood() gt 0-|<a href="Main.php?do=planningTree&id=|-$position->getId()-|" class="icon iconNodes" title="ver arbol de objetivos">|-$position->getname()-|</a>|-/if-|
			</td>
		</tr>
	|-/foreach-|
	</tbody>
</table>
