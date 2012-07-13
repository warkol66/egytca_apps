<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-objectives">
	<thead>
		<tr class="thFillTitle">
			<th colspan="2">Ministerio</th>
			<th colspan="1"><div style="width:175px;">##objectives,6,Objetivos##</div></th>													
		</tr>
	</thead>
	<tbody>
	|-foreach from=$result item=position name=for_positions-|	
		<tr>
			<td width="2%"></td> 
			<td width="90%"><a href="Main.php?do=planningMinistryObjectivesList&id=|-$position->getId()-|&objectives=true&filters[entityFilter][entityType]=position&filters[entityFilter][entityId]=|-$position->getId()-|" class="follow">|-$position->getname()-|</a></td>
			<td width="2%" align="center" nowrap >
			</td>
		</tr>
	|-/foreach-|						
	</tbody>
</table>
