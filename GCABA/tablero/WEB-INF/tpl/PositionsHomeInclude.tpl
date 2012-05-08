<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-objectives">
	<thead>
		<tr class="thFillTitle">
			<th colspan="2">Dependencia</th>
			<th colspan="1"><div style="width:175px;">##objectives,6,Objetivos##</div></th>													
		</tr>
	</thead>
	<tbody>
	|-foreach from=$result item=position name=for_positions-|
	|-assign var=colorsCount value=$position->getProjectsByStatusColorCountAssoc()-|
		<tr>
			<td width="2%"><img src="images/clear.png" class="gauge|-$position->getSpeedClass()-|"></td> 
			<td width="90%"><a href="Main.php?do=positionsShow&id=|-$position->getId()-|&objectives=true" class="follow">|-$position->getname()-|</a></td>
			<td width="2%" align="center" nowrap >
				<a href="Main.php?do=projectsShow&positionId=|-$position->getId()-|&color=white" class="flagWhite">
					|-$colorsCount.white-|
				</a><a href="Main.php?do=projectsShow&positionId=|-$position->getId()-|&color=green" class="flagGreen">
					|-$colorsCount.green-|
				</a><a href="Main.php?do=projectsShow&positionId=|-$position->getId()-|&color=yellow" class="flagYellow">					
					|-$colorsCount.yellow-|
				</a><a href="Main.php?do=projectsShow&positionId=|-$position->getId()-|&color=red" class="flagRed">
					|-$colorsCount.red-|
				</a><a href="Main.php?do=projectsShow&positionId=|-$position->getId()-|&color=blue" class="flagBlue">
					|-$colorsCount.blue-|
				</a><!--<a href="Main.php?do=projectsShow&positionId=|-$position->getId()-|&color=black" class="flagBlack">
					|-$colorsCount.black-|
				</a>-->
			</td>
		</tr>
	|-/foreach-|						
	</tbody>
</table>
