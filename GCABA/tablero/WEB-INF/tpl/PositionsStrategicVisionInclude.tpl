

<table width='60%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-objectives">
	<thead>
		<tr class="thFillTitle">
			<th>Avances</th>				
			<th>Jurisdicción</th>
			<th>Resultados</th>				
		</tr>
	</thead>
	<tbody>
	|-foreach from=$result item=position name=for_positions-|	
		<tr>
			<td width="2%"><a href="Main.php?do=panelAchievementsShow&id=|-$position->getId()-|&nav=true" class="icon iconFollow">|-$position->getname()-|</a></td> 
			<td width="90%"><a href="Main.php?do=panelResultsShow&positionId=|-$position->getId()-|" class="followLink">|-$position->getname()-|</a></td>
			<td width="2%" align="center" nowrap ><a href="Main.php?do=panelResultsShow&positionId=|-$position->getId()-|" class="icon iconFollow">
			</td>
		</tr>
	|-/foreach-|
	</tbody>
</table>
