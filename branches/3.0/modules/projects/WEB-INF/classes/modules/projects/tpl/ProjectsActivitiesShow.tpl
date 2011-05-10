<h2>Tablero de Gestión</h2>
<h1>|-$project->getName()-|</h1>
<p>##projects,1,Proyecto##: |-$project->getName()-|
    
<h3>Actividades</h3>
		<table id="table-activities" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
			<tr class="thFillTitle"> 
				<th width="35%">##projects,1,Proyecto##</th> 
				<th width="2%">&nbsp;</th> 
				<th width="40%">Actividad</th> 
				<th width="5%">Vencimiento</th> 
				<th width="5%">Terminado</th>  
			</tr>
		</thead>
		<tbody>
		|-foreach from=$activities item=activity name=for_activities-|
			<tr>
				<td>|-assign var="project" value=$activity->getProject()-||-if is_object($project)-||-$project->getName()-||-/if-|</td> 
			<td><a href="" class="flag|-$activity->statusColor()|capitalize-|">
						&nbsp;
					</a></td>
				<td>|-$activity->getname()-|</td> 
				<td>|-$activity->getexpirationDate()|change_timezone|date_format-|</td> 
				<td align="center">|-if $activity->getcompleted() eq 1-|Si|-else-|No|-/if-|</td> 	
			</tr>
		|-/foreach-|						
		</tbody>
	</table>
