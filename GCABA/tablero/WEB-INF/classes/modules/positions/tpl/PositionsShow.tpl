<h2>Tablero de Gestión</h2>
<h1>|-$position->getName()-|</h1>
<p>Responsable: |-$position->getOwnerName()-||-assign var=tenure value=$position->getActiveTenure()-| |-if $tenure->getObject() != NULL-||-assign var=tenureObject value=$tenure->getObject()-| &#8212; |-$tenureObject->getName()-| |-$tenureObject->getSurname()-||-/if-|</p>
<p>
|-assign var=graphParent value=$position->getGraphParent()-|
<object title="|-$graphParent-|" height="170" width="170">
	<param name="movie" value="images/speedometer.swf">
	<param name="flashvars" value="var3=|-$graphParent->getSpeed()-|&amp;var4=Main.php?do=positionsShow&amp;positionId=|-$position->getId()-|">
	<embed src="images/speedometer.swf" wmode="transparent" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="var3=|-$position->getSpeed()-|&amp;var4=Main.php?do=positionsShow&amp;positionId=|-$position->getId()-|" height="170" width="170" /></object>
</p>        
|-if !empty($objectives)-|
<h3>##objectives,6,Objetivos##</h3>
		<table id="tabla-objectives" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
			<tr class="thFillTitle">
				<th width="20%">Objetivo de Impacto </th>
				<th width="20%">Objetivo Ministerial </th>
				<th width="50%">Objetivo Operativo </th>
				<th width="5%">Fecha</th>
				<th width="5%">Fecha de Expiración</th>
				<th width="5%">Logrado</th>
				<th width="5%"><div style="width:175px;">Proyectos</div></th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$objectives item=objective name=for_objectives-|
			|-assign var=colorsCount value=$objective->getProjectsByStatusColorCountAssoc()-|
			<tr>
				<!-- TODO: completar -->
				|-*<td>|-$objective->getPolicyGuideline()-|</td>
				<td>|-$objective->getStrategicObjective()-|</td>
				<td><a href="Main.php?do=projectsList&filters[objective]=|-$objective->getid()-|&filters[fromObjectives]=true" title="Ver proyectos del Objetivo" class="follow">|-$objective->getname()-|</a></td>
				<td nowrap>|-$objective->getdate()|date_format-|</td>
				<td nowrap>|-$objective->getexpirationDate()|date_format-|</td>
				<td align="center">|-if $objective->getachieved() eq 0-|No|-/if-||-if $objective->getachieved() eq 1-|Si|-/if-|</td>*-|
				<td>|-$objective->getName()-|</td>
				
				<td>asd</td>
				<td>asd</td>
				<td>asd</td>
				<td>asd</td>
				<td>asd</td>
				
				<td width="2%" align="center" nowrap >
					<a href="Main.php?do=planningProjectsShow&objectiveId=|-$objective->getId()-|&color=white" class="flagWhite">
						|-$colorsCount.white-|
					</a><a href="Main.php?do=planningProjectsShow&objectiveId=|-$objective->getId()-|&color=green" class="flagGreen">
						|-$colorsCount.green-|
					</a><a href="Main.php?do=planningProjectsShow&objectiveId=|-$objective->getId()-|&color=yellow" class="flagYellow">					
						|-$colorsCount.yellow-|
					</a><a href="Main.php?do=planningProjectsShow&objectiveId=|-$objective->getId()-|&color=red" class="flagRed">
						|-$colorsCount.red-|
					</a><a href="Main.php?do=planningProjectsShow&objectiveId=|-$objective->getId()-|&color=blue" class="flagBlue">
						|-$colorsCount.blue-|
					</a>
				</td>
			</tr>
		|-/foreach-|						
		</tbody>
	</table>
|-else-|
<h3>##projects,2,Proyectos##</h3>
		<table id="tabla-projectss" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
			<tr class="thFillTitle">
				<th width="20%">Objetivo de Impacto </th>
				<th width="20%">Objetivo Ministerial </th>
				<th width="20%">Objetivo Operativo </th>
				<th width="50%">Proyecto</th>
				<th width="5%">Fecha</th>
				<th width="5%">Fecha de Expiración</th>
				<th width="5%">Logrado</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$position->getAllProjectsWithDescendants() item=project name=for_projectss-|
			<tr>
				|-assign var=operativeObjective value=$project->getOperativeObjective()-|
				|-if is_object($operativeObjective)-|
					|-assign var=ministryObjective value=$operativeObjective->getMinistryObjective()-|
				|-/if-|
				|-if is_object($ministryObjective)-|
				|-assign var=impactObjective value=$ministryObjective->getImpactObjective()-|
				|-/if-|
				<td>|-$impactObjective-|</td>
				<td>|-$ministryObjective-|</td>
				<td>|-$operativeObjective-|</td>
				<td>|-$project->getName()-|</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="background-color:|-$project->statusColor()-|">&nbsp;</td>
				|-*<td><a href="Main.php?do=projectsList&filters[objective]=|-$project->getObjectiveId()-|&filters[fromObjectives]=true" title="Ver proyectos" class="follow">|-$project->getname()-|</a></td>
				<td nowrap>|-$project->getdate()|date_format-|</td>
				<td nowrap>|-$project->getgoalExpirationDate()|date_format-|</td>
				<td align="center">|-$project->getFinished()|yes_no|multilang_get_translation:"common"-|</td>*-|
			</tr>
		|-/foreach-|						
		</tbody>
	</table>
|-/if-|