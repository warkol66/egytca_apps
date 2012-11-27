<h2>Tablero de Gestión</h2>
|-if $position-|
<h1>|-$position->getName()-|</h1>
<p>Responsable : |-$position->getOwnerName()-||-if get_class($position->getActiveTenureName()) eq "PositionTenure"-||-assign var=tenure value=$position->getActiveTenureName()-||-if $tenure->getName() ne ''-| &#8212; |-$tenure->getName()-||-/if-||-else-||-assign var=userInfo value=$position->getActiveTenureName()-||-if $userInfo->getName() ne '' || $userInfo->getSurname() ne ''-| &#8212; |-/if-||-$userInfo->getName()-| |-$userInfo->getSurname()-||-/if-|</p>
<p>
<object title="|-$position->getName()-|" height="170" width="170">
	<param name="movie" value="images/speedometer.swf">
	<param name="flashvars" value="var3=|-$position->getSpeed()-|&amp;var4=Main.php?do=positionsShow&amp;positionId=|-$position->getId()-|">
	<embed src="images/speedometer.swf" wmode="transparent" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="var3=|-$position->getSpeed()-|&amp;var4=Main.php?do=positionsShow&amp;positionId=|-$position->getId()-|" height="170" width="170" /></object>
</p>
|-elseif $objective-|
	<h1>|-$objective->getName()-|</h1>
|-/if-|        
<h3>Proyectos</h3>
		<table id="table-projects" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
			<tr class="thFillTitle">
				<th width="20%">##objectives,3,Objetivo##</th>
				<th width="2%">&nbsp;</th>
				<th width="40%">Nombre</th>
				<th width="5%">Fecha</th>
				<th width="5%">Fin Planificado </th>
				<th width="5%">Terminado</th>
				<th width="5%"><div style="width:175px;">Actividades</div></th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$projects item=project name=for_projects-|
			|-assign var=colorsCount value=$project->getActivitiesByStatusColorCountAssoc()-|
			<tr>
				<td>|-$project->getObjective()->getName()-|</td>
				<td><a href="javascript:void(null);" class="flag|-$project->statusColor()|capitalize-|"></a></td>
				<td><a href="Main.php?do=projectsActivitiesList&filters[projectId]=|-$project->getid()-|&filters[fromProjects]=true" title="Ver actividades del proyecto" title="Ver actividades del proyecto" class="follow">|-$project->getname()-|</a></td>
				<td>asd</td>|-*<td nowrap>|-$project->getdate()|date_format-|</td>*-|
				<td>asd</td>|-*<td nowrap>|-$project->getPlannedEnd()|date_format:"%d-%m-%Y"-|</td>*-|
				<td>asd</td>|-*<td align="center">|-if $project->getfinished() eq 1-|Si|-else-|No|-/if-|</td>*-|
				<td align="center" nowrap >
					<a href="Main.php?do=projectsActivitiesShow&projectId=|-$project->getId()-|&color=white" class="flagWhite">
						|-$colorsCount.white-|
					</a>
					<a href="Main.php?do=projectsActivitiesShow&projectId=|-$project->getId()-|&color=green" class="flagGreen">
						|-$colorsCount.green-|
					</a>
					<a href="Main.php?do=projectsActivitiesShow&projectId=|-$project->getId()-|&color=yellow" class="flagYellow">					
						|-$colorsCount.yellow-|
					</a>
					<a href="Main.php?do=projectsActivitiesShow&projectId=|-$project->getId()-|&color=red" class="flagRed">
						|-$colorsCount.red-|
					</a>
					<a href="Main.php?do=projectsActivitiesShow&projectId=|-$project->getId()-|&color=blue" class="flagBlue">
						|-$colorsCount.blue-|
					</a>
				</td>
			</tr>
		|-/foreach-|						
		</tbody>
	</table>
