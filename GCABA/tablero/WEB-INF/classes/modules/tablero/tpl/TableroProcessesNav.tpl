<script type="text/javascript" language="javascript" src="scripts/nav.js"></script>
<h2>Tablero de Control - |-if $loginUser-|<a href="Main.php?do=tableroDependenciesNav">Dependencias</a> > |-/if-|
	<a href="Main.php?do=tableroObjectivesNav|-if $loginUser-|&dependencyId=|-$dependency->getId()-||-/if-|">|-$dependency->getName()-|</a> > 
	|-$objective->getName()-|</h2> 
<h1>Procesos|-if $status ne ""-| - Status: |-$status-||-/if-|</h1>
<p>A continuación se muestra la lista de Procesos.</p>
<div id="div_processes">			

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
					<input type="hidden" name="do" value="tableroProcessesBarNav"/>
					<input type="hidden" name="objectiveId" value="|-$objective->getId()-|"/>
					<input type="button" name="send" onClick="javascript:tableroNavigationShowBar(this.form)" value="Ver Gráfico de Barras" title="Comparativo de los hitos del objetivo"/>
		</form>
		</p>
	</div>

	<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-processes">
		<thead>
			<tr>														
				<th width="80%" colspan="3" class="thFillTitle">Nombre</th>
				<th width="20%" colspan="3" class="thFillTitle">Hitos</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$processes item=process name=for_processes-|
			<tr>
				<td width="2%" class="flag|-$process->statusColor()|capitalize:true-|">&nbsp;&nbsp;&nbsp;
				</td>
				<td width="90%" class="line1">					<a href="Main.php?do=tableroMilestonesNav&processId=|-$process->getId()-|">
						|-$process->getname()-|					</a>
						
						
</td>
				<td width="2%" class="line1"><form>
					<input type="hidden" name="do" value="tableroProcessesPlotGantt"/>
					<input type="hidden" name="processId" value="|-$process->getId()-|" />
					<input type="button" name="send" onClick="javascript:tableroNavigationShowGantt(this.form)" value="Ver Gráfico Gantt" class="icon iconViewGantt" title="Ver gráfico Gantt"/>
				</form>		</td>
				<td align="center" nowrap class="flag|-$colors.onTime|capitalize:true-|">
						<a href="Main.php?do=tableroMilestonesNav&processId=|-$process->getId()-|&status=OnTime" class='whiteNoDecoration'>
							|-$process->getCountMilestonesOnTime()-|
						</a>
				</td>
			<td align="center" nowrap class="flag|-$colors.delayed|capitalize:true-|">
						<a href="Main.php?do=tableroMilestonesNav&processId=|-$process->getId()-|&status=Delayed" class='blackNoDecoration'>					
							|-$process->getCountMilestonesDelayed()-|
						</a>		
</td>
			  <td align="center" nowrap class="flag|-$colors.late|capitalize:true-|">
						<a href="Main.php?do=tableroMilestonesNav&processId=|-$process->getId()-|&status=Late" class='whiteNoDecoration'>
							|-$process->getCountMilestonesLate()-|
						</a>		
</td>
			</tr>
		|-/foreach-|						
		</tbody>
	</table>
</div>
