<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-objectives">
	<thead>
		<tr class="thFillTitle">
			<th colspan="2">Dependencia</th>
			<th colspan="1"><div style="width:108px;">Objetivos</div></th>													
		</tr>
	</thead>
	<tbody>
	|-foreach from=$result.dependencies item=dependency name=for_dependencies-|
		<tr>
			<td width="2%"><img src="images/clear.png" class="gauge|-$dependency->statusColor()|capitalize:true-|"></td> 
			<td width="90%"><a href="Main.php?do=tableroObjectivesNav&dependencyId=|-$dependency->getId()-|">|-$dependency->getname()-|</a></td>
			<td width="2%" align="center" nowrap >
				<a href="Main.php?do=tableroObjectivesNav&dependencyId=|-$dependency->getId()-|" class="flagGreen">
					|-$dependency->getCountObjectivesOnTime()-|
				</a>
				<a href="Main.php?do=tableroObjectivesNav&dependencyId=|-$dependency->getId()-|" class="flagYellow">					
					|-$dependency->getCountObjectivesDelayed()-|
				</a>
				<a href="Main.php?do=tableroObjectivesNav&dependencyId=|-$dependency->getId()-|" class="flagRed">
					|-$dependency->getCountObjectivesLate()-|
				</a></td>
		</tr>
	|-/foreach-|						
	</tbody>
</table>
<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-objectives">
	<thead>
		<tr class="thFillTitle">
			<th colspan="2">Monitoreo de Obras </th>
			<th colspan="1"><div style="width:108px;">Objetivos</div></th>													
		</tr>
	</thead>
	<tbody>
	|-foreach from=$result.depdendencyObjs item=dependency name=for_dependencies-|
		<tr>
			<td width="2%"><img src="images/clear.png" class="gauge|-$dependency->statusColor()|capitalize:true-|"></td> 
			<td width="90%"><a href="Main.php?do=tableroObjectivesNav&dependencyId=|-$dependency->getId()-|">|-$dependency->getname()-|</a></td>
			<td width="2%" align="center" nowrap >
				<a href="Main.php?do=tableroObjectivesNav&dependencyId=|-$dependency->getId()-|" class="flagGreen">
					|-$dependency->getCountObjectivesOnTime()-|
				</a>
				<a href="Main.php?do=tableroObjectivesNav&dependencyId=|-$dependency->getId()-|" class="flagYellow">					
					|-$dependency->getCountObjectivesDelayed()-|
				</a>
				<a href="Main.php?do=tableroObjectivesNav&dependencyId=|-$dependency->getId()-|" class="flagRed">
					|-$dependency->getCountObjectivesLate()-|
				</a></td>
		</tr>
	|-/foreach-|						
	</tbody>
</table>
