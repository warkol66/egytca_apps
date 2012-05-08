<script type="text/javascript" language="javascript" src="scripts/nav.js"></script>
<h2>Tablero de Control</h2> 
<h1>Dependencias</h1>
<p>A continuación se muestra la lista de Dependencias.</p>
<div id="div_objectives">
	

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
					<input type="hidden" name="do" value="tableroDependenciesBarNav"/>
					<input type="button" name="send" onClick="javascript:tableroNavigationShowBar(this.form)" value="Ver Gráfico de Barras" title="Comparativo de Todas las Dependencias"/>
		</form>
		</p>
	</div>

	<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-objectives">
		<thead>
			<tr class="thFillTitle">
				<th colspan="3">Nombre</th>
				<th colspan="3"><div style="width:108px;">Objetivos</div></th>													
			</tr>
		</thead>
		<tbody>
		|-foreach from=$dependencies item=dependency name=for_dependencies-|
			<tr>
				<td width="2%"><img src="images/clear.png" class="gauge|-$dependency->statusColor()|capitalize:true-|"></td> 
				</td>
				<td width="90%"><a href="Main.php?do=tableroObjectivesNav&dependencyId=|-$dependency->getId()-|">|-$dependency->getname()-|</a></td>
				<td width="2%"><form style="text-align:right;">
					<input type="hidden" name="do" value="tableroDependenciesPlotGantt"/>
					<input type="hidden" name="dependencyId" value="|-$dependency->getId()-|" />
					<input type="button" name="send" onClick="javascript:tableroNavigationShowGantt(this.form)" value="Ver Gráfico Gantt" class="icon iconViewGantt2" title="Ver gráfico Gantt" />
				</form></td>
				<td width="2%" align="center" nowrap >
					<a href="Main.php?do=tableroObjectivesNav&dependencyId=|-$dependency->getId()-|&status=OnTime" class="flag|-$colors.onTime|capitalize:true-|">
						|-$dependency->getCountObjectivesOnTime()-|
					</a>
					<a href="Main.php?do=tableroObjectivesNav&dependencyId=|-$dependency->getId()-|&status=Delayed" class="flag|-$colors.delayed|capitalize:true-|">					
						|-$dependency->getCountObjectivesDelayed()-|
					</a>
					<a href="Main.php?do=tableroObjectivesNav&dependencyId=|-$dependency->getId()-|&status=Late" class="flag|-$colors.late|capitalize:true-|">
						|-$dependency->getCountObjectivesLate()-|
					</a></td>
			</tr>
		|-/foreach-|						
			<tr> 
				<td colspan="6" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		</tbody>
	</table>
</div>
