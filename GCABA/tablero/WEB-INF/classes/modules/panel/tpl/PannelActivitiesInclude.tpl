	<h1>Proyecto: |-$planningProject->getName()-|</h1>
	<h3>Listado y Gantt de actividades</h3>
	|-$planningActivityColl|@print_r-|
<div id="div_activities">
	<table id="tabla-activities" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
			<tr class="thFillTitle">
				<th colspan="8" nowrap>
				|-if "planningProjectsViewX"|security_has_access-||-if $planningProject->getActivities()|count gt 0-|
					Ver Gantt<input type="button" class="icon iconViewGantt" onClick='window.open("Main.php?do=planningProjectsViewX&showGantt=true&id=|-$planningProject->getid()-|","Gantt","scrollbars=1,width=800,height=600");' value="Ver Gantt" title="Ver Gantt (abre en ventana nueva)" />|-else-|<img src="images/clear.png" class="icon iconClear disabled" />|-/if-|
				|-/if-|
				</th>
			</tr>
			<tr class="thFillTitle">
				<th width="25%">Nombre</th>
				<th width="15%">Fecha Inicio</th>
				<th width="15%">Fecha Fin</th>
				<th width="10%">Cumplida</th>
				<th width="15%">Finalizado</th>
				<th width="5%">&nbsp;</th>
				<th width="10%">Prioridad</th>
				<th width="5%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="4" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			|-if $planningConstructionColl|@count gt 5-|<tr>
				 <th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="thFillTitle"><div class="rightLink">|-if $smarty.session.planningMode || $loginUser->mayPlan() || $loginUser->mayFollow()-|<a href="Main.php?do=panelConstructionsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-||-if $nav-|&fromPlanningProjectId=|-$filters.planningprojectid-||-/if-|" class="addLink">Agregar Obra</a>|-/if-|</div></th>
			</tr>|-/if-|
		</tbody>
	</table>
</div>
