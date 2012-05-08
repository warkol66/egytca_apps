<h2>Tablero de Gestión</h2>
<h1>Administración de Actividades</h1>
<p>A continuación se muestra la lista de actividades cargadas en el sistema.</p>
|-if is_object($parentObject)-|<div id="navBar">|-include file="NavigationParentInclude.tpl" object=$parentObject first="true"-| |-$parentObject->getName()-|</div>|-/if-|
<div id="div_Activities"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Actividad guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Actividad eliminada correctamente</div>
	|-/if-|
	<table id="tabla-Activities" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="7" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda actividades</a>
				<div id="divSearch" style="display:|-if $filter|@count gt 0 && !($filters.fromProjects)-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="projectsActivitiesList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filter.searchString)-||-$filter.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>
					|-if $filters|@count gt 0-|<form  method="get">
				<input type="hidden" name="do" value="projectsActivitiesList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=projectsActivitiesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Actividad</a></div></th>
			</tr>
			<tr class="thFillTitle"> 
	     <th width="5%">&nbsp;</th>
				<th width="35%">##projects,1,Proyecto##</th> 
				<th width="35%">Actividad</th> 
				<th width="5%">Fin planificado</th> 
				<th width="5%">Fin real</th> 
				<th width="5%">Terminado</th> 
				<th width="5%">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $activities|@count eq 0-|
		<tr>
			 <td colspan="7">|-if isset($filter)-|No hay Actividades que concuerden con la búsqueda|-else-|No hay Actividades disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$activities item=activity name=for_Activities-|
		<tr> 
			<td><a href="" class="flag|-$activity->statusColor()|capitalize-|">&nbsp;</a></td>
			<td>|-assign var="project" value=$activity->getProject()-||-if is_object($project)-||-$project->getName()-||-/if-|</td> 
			<td>|-$activity->getname()-|</td> 
			<td>|-$activity->getPlannedEnd()|change_timezone|date_format-|</td> 
			<td>|-$activity->getRealEnd()|change_timezone|date_format-|</td> 
			<td align="center">|-if $activity->getcompleted() eq 1-|Si|-else-|No|-/if-|</td> 
			<td nowrap> 
				|-if $project->hasWriteAccess($loginUser)-|
				<form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="projectsActivitiesEdit" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$activity->getid()-|" /> 
					<input type="submit" name="submit_go_edit_activity" value="Editar" class="icon iconEdit" /> 
				</form>

				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="projectsActivitiesDoDelete" /> 
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
					<input type="hidden" name="id" value="|-$activity->getid()-|" /> 
					<input type="submit" name="submit_go_delete_activity" value="Borrar" onclick="return confirm('Seguro que desea eliminar la actividad?')" class="icon iconDelete" /> 
				</form>
				|-/if-|
			
				|-if $activity->getLogCount() gt 0-|
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="projectsActivitiesShowHistory" />
						<input type="hidden" name="id" value="|-$activity->getid()-|" />
						<input type="submit" name="submit_go_show_project_activity_history" value="Mostrar Historico de cambios" class="icon iconHistory"  title="Mostrar Historico de cambios" />
					</form>
				|-/if-|
			</td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="7" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				 <th colspan="7" class="thFillTitle">|-if $activities|@count gt 5-|<div class="rightLink"><a href="Main.php?do=projectsActivitiesEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Actividad</a></div>|-/if-|</th>
			</tr>
		|-/if-|
		</tbody> 
		 </table> 
</div>
