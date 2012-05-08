<h2>|-if $loginUser-|<a href="Main.php?do=tableroDependenciesNav">Dependencias</a> > |-/if-| <a href="Main.php?do=tableroObjectivesNav|-if $loginUser-|&dependencyId=|-$dependency->getId()-||-/if-|">|-$dependency->getName()-|</a> > <a href="Main.php?do=tableroProjectsNav&objectiveId=|-$objective->getid()-|">|-$objective->getName()-|</a> > |-$project->getName()-| </h2>
<h1>Actividades|-if $status ne ""-| - Status: |-$status-||-/if-|</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<div id="div_projects"> 
	<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-projects"> 
		<thead> 
			<tr> 
				<th class="thFillTitle">Nombre<h>  
			</tr> 
		</thead> 
		<tbody>  |-foreach from=$Activities item=Activity name=for_Activities-|
		<tr> 
			<td>
				<span style="background-color:|-$Activity->statusColor()-|; padding-left:15px; padding-right:15px; border:1px solid |-$Activity->statusColor()-|;">&nbsp;</span>
				|-$Activity->getname()-|
			</td> 
		</tr> 
		|-/foreach-|
		</tbody> 
  </table> 
</div>
