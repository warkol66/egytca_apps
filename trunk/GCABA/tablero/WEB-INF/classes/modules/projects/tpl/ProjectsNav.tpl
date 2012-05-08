<script type="text/javascript" language="javascript" src="scripts/nav.js"></script>
<h2>Tablero de Gestión - |-if $loginUser-|<a href="Main.php?do=tableroDependenciesNav">Dependencias</a> > |-/if-|
	<a href="Main.php?do=tableroObjectivesNav|-if $loginUser-|&dependencyId=|-$dependency->getId()-||-/if-|">|-$dependency->getName()-|</a> > 
	|-$objective->getName()-|</h2> 
<h1>Proyectos|-if $status ne ""-| - Status: |-$status-||-/if-|</h1>
<p>A continuación se muestra la lista de Proyectos.</p>
<div id="div_projects">			

	<div id="graphicHolder" style="display : none;">
		
	</div>
	<div id="graphicCloser" style="display : none;">
		<p>
			<a href="#" onClick="javascript:tableroDestroyGraphic()">Cerrar Gráfico</a>
		</p>
	</div>

	<div>
		<p>	
		<form>
					<input type="hidden" name="do" value="tableroProjectsBarNav"/>
					<input type="hidden" name="objectiveId" value="|-$objective->getId()-|"/>
					<input type="button" name="send" onClick="javascript:tableroNavigationShowBar(this.form)" value="Ver Gráfico de Barras" title="Comparativo de los hitos del objetivo"/>
		</form>
		</p>
	</div>

	<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-projects">
		<thead>
			<tr class="thFillTitle">														
				<th width="80%" colspan="3">Nombre</th>
				<th width="20%" colspan="3" ><div style="width:108px;">Actividades</div></th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$projects item=project name=for_projects-|
			<tr>
				<td width="2%"><img src="images/clear.png" class="gauge|-$project->statusColor()|capitalize:true-|"></td>
				<td width="90%"><a href="Main.php?do=tableroMilestonesNav&projectId=|-$project->getId()-|">|-$project->getname()-|</a></td>
				<td width="2%"><form>
					<input type="hidden" name="do" value="tableroProjectsPlotGantt"/>
					<input type="hidden" name="projectId" value="|-$project->getId()-|" />
					<input type="button" name="send" onClick="javascript:tableroNavigationShowGantt(this.form)" value="Ver Gráfico Gantt" class="icon iconViewGantt2" title="Ver gráfico Gantt"/>
				</form>		</td>
				<td align="center" nowrap >
						<a href="Main.php?do=tableroMilestonesNav&projectId=|-$project->getId()-|&status=OnTime" class="flag|-$colors.onTime|capitalize:true-|">
							|-$project->getCountMilestonesOnTime()-|
						</a>
						<a href="Main.php?do=tableroMilestonesNav&projectId=|-$project->getId()-|&status=Delayed" class="flag|-$colors.delayed|capitalize:true-|">					
							|-$project->getCountMilestonesDelayed()-|
						</a>		
						<a href="Main.php?do=tableroMilestonesNav&projectId=|-$project->getId()-|&status=Late" class="flag|-$colors.late|capitalize:true-|">
							|-$project->getCountMilestonesLate()-|
						</a>		
</td>
			</tr>
		|-/foreach-|						
		</tbody>
	</table>
</div>
