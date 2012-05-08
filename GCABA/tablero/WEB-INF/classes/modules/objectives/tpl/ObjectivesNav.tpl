<script type="text/javascript" language="javascript" src="scripts/nav.js"></script>
|-if $navStrategicObjectives neq 1-|<h2>|-if $loginUser-|<a href="Main.php?do=tableroDependenciesNav">Dependencias</a> > |-/if-| |-$dependency->getName()-| </h2>
|-else-|
<h2>|-if $loginUser-|<a href="Main.php?do=tableroStrategicObjectivesNav">Objetivos Estratégicos</a> > |-/if-| |-$dependency->getName()-| </h2>
|-/if-|
<h1>Objetivos|-if $status ne ""-| - Status: |-$status-||-/if-|</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>A continuación se muestra la lista de Objetivos.</p>
<div id="div_objectives"> 

	<div id="graphicHolder" style="display : none;">
		
	</div>
	<div>
	<div id="graphicCloser" style="display : none;">
		<p>
			<a href="#" onClick="javascript:tableroDestroyGraphic()">Cerrar Gráfico</a>
		</p>
	</div>
	<p>	
		<form>
					<input type="hidden" name="do" value="tableroObjectivesBarNav"/>
					<input type="hidden" name="dependencyId" value="|-$dependency->getId()-|"/>
					<input type="button" name="send" onClick="javascript:tableroNavigationShowBar(this.form)" value="Ver Gráfico de Barras" title="Comparativo de los objetivos de la dependencia"/>
		</form>

	</p>
	</div>

	<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-objectives"> 
		<thead> 
			<tr class="thFillTitle"> 
				<th colspan="3">Nombre</th>
				<th colspan="3"><div style="width:108px;">Proyectos</div></th>
			</tr> 
		</thead> 
		<tbody>  
			|-foreach from=$objectives item=objective name=for_objectives-|
			<tr> 
				<td width="2%"><img src="images/clear.png" class="gauge|-$objective->statusColor()|capitalize:true-|"></td> 
				<td width="90%"><a href="Main.php?do=tableroProjectsNav&objectiveId=|-$objective->getId()-|"> |-$objective->getname()-|</a> 
				</td>
				<td width="2%"><form>
					<input type="hidden" name="do" value="tableroObjectivesPlotGantt"/>
					<input type="hidden" name="objectiveId" value="|-$objective->getId()-|" />
					<input type="button" name="send" onClick="javascript:tableroNavigationShowGantt(this.form)" value="Ver Gráfico Gantt" class="icon iconViewGantt2" title="Ver gráfico Gantt"/>
				</form></td>
				<td width="2%" align="center" nowrap>
					<a href="Main.php?do=tableroProjectsNav&objectiveId=|-$objective->getId()-|&status=OnTime" class='flag|-$colors.onTime|capitalize:true-|'>
							|-$objective->getCountProjectsOnTime()-|
						</a>
						<a href="Main.php?do=tableroProjectsNav&objectiveId=|-$objective->getId()-|&status=Delayed" class='flag|-$colors.delayed|capitalize:true-|'>					
							|-$objective->getCountProjectsDelayed()-|
						</a>
						<a href="Main.php?do=tableroProjectsNav&objectiveId=|-$objective->getId()-|&status=Late" class='flag|-$colors.late|capitalize:true-|'>
							|-$objective->getCountProjectsLate()-|
						</a>
				</td>
			</tr> 
			|-/foreach-|
			|-if $pager-|
			<tr> 
				<td colspan="6" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr> 
			|-/if-|
		</tbody> 
	</table> 
</div>
