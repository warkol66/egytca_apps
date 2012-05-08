<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-guidelines">
	<thead>
		<tr class="thFillTitle">
			<th colspan="2">##objectives,4,Ejes de Gestión##</th>
			<th colspan="1"><div style="width:175px;">##objectives,6,Objetivos##</div></th>													
		</tr>
	</thead>
	<tbody>
	|-foreach from=$result item=guideline name=for_guidelines-|
	|-assign var=colorsCount value=$guideline->getProjectsByStatusColorCountAssoc()-|
		<tr>
			<td width="2%"><img src="images/clear.png" class="gauge|-$guideline->getSpeedClass()-|"></td> 
			<td width="90%"><a href="Main.php?do=objectivesStrategicObjectivesList&filters[guideline]=|-$guideline->getId()-|&filters[fromGuidelines]=true" class="follow">|-$guideline->getname()-|</a></td>
			<td width="2%" align="center" nowrap >
				<a href="Main.php?do=projectsShow&policyGuidelineId=|-$guideline->getId()-|&color=white" class="flagWhite">
					|-$colorsCount.white-|
				</a><!--
				<a href="Main.php?do=projectsShow&policyGuidelineId=|-$guideline->getId()-|&color=black" class="flagBlack">
					|-$colorsCount.black-|
				</a>-->
				<a href="Main.php?do=projectsShow&policyGuidelineId=|-$guideline->getId()-|&color=green" class="flagGreen">
					|-$colorsCount.green-|
				</a>
				<a href="Main.php?do=projectsShow&policyGuidelineId=|-$guideline->getId()-|&color=yellow" class="flagYellow">
					|-$colorsCount.yellow-|
				</a>
				<a href="Main.php?do=projectsShow&policyGuidelineId=|-$guideline->getId()-|&color=red" class="flagRed">
					|-$colorsCount.red-|
				</a>
				<a href="Main.php?do=projectsShow&policyGuidelineId=|-$guideline->getId()-|&color=blue" class="flagBlue">
					|-$colorsCount.blue-|
				</a>
			</td>
		</tr>
	|-/foreach-|						
	</tbody>
</table>
