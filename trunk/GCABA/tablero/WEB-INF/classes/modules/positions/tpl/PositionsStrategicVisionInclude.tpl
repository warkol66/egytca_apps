<table width='60%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-objectives">
	<thead>
		<tr class="thFillTitle">
			<th colspan="2">Jurisdicción</th>
			|-if !$smarty.session.panelMode-|<th>&nbsp;</th>				
			|-else-|<th colspan="1"><div style="width:108px;">Proyectos</div></th>|-/if-|
		</tr>
	</thead>
	<tbody>
	|-foreach from=$result item=position name=for_positions-|	
		<tr>
			<td width="2%"><a href="Main.php?do=panelAchievementsShow&id=|-$position-%3EgetId()-|&nav=true-|" class="icon iconFollow">|-$position->getname()-|</a></td> 
			<td width="90%"><a href="Main.php?do=planningImpactObjectivesList&id=|-$position-%3EgetId()-|&nav=true&objectives=true&filters%5BentityFilter%5D%5BentityType%5D=position&filters%5BentityFilter%5D%5BentityId%5D=|-$position-%3EgetId()-|" class="followLink">|-$position->getname()-|</a></td>
			|-if !$smarty.session.panelMode-|<td width="2%" align="center" nowrap>|-if $position->countBrood() gt 0-|<a href="Main.php?do=planningTreeDivs&id=|-$position-%3EgetId()-|" class="icon iconNodes" title="ver arbol de objetivos">|-$position->getname()-|</a>|-/if-|</td>
			|-else-|<td width="2%" align="center" nowrap >|-assign var=colorsCount value=$position->getProjectsByStatusColorCountAssoc()-|
				<a href="Main.php?do=planningProjectsShow&positionId=|-$position-%3EgetId()-|&color=green" class="flagGreen">|-$colorsCount.green-|</a>
				<a href="Main.php?do=planningProjectsShow&positionId=|-$position-%3EgetId()-|&color=yellow" class="flagYellow">|-$colorsCount.yellow-|</a>
				<a href="Main.php?do=planningProjectsShow&positionId=|-$position-%3EgetId()-|&color=red" class="flagRed">|-$colorsCount.red-|</a>
			</td>|-/if-|
		</tr>
	|-/foreach-|
	</tbody>
</table>
