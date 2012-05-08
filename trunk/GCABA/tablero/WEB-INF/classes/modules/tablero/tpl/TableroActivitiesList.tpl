<h2>Tablero de Control</h2>
<h1>Actividades</h1>
<p>A continuación se muestra la lista de actividades del sistema.</p>
<div id="div_Activities"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Actividad guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Actividad eliminada correctamente</div>
	|-/if-|
	<table id="tabla-Activities" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="6" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filter|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="tableroActivitiesList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filter.searchString)-||-$filter.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form><form  method="get">
				<input type="hidden" name="do" value="tableroActivitiesList" />
				<input type="submit" value="Quitar Filtros" />
		</form></div></td>
		</tr>
			<tr>
				 <th colspan="6" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroActivitiesEdit" class="addLink">Agregar Actividad</a></div></th>
			</tr>
			<tr> 
				<th width="5%" class="thFillTitle">Id</th> 
				<th width="35%" class="thFillTitle">Proyecto</th> 
				<th width="35%" class="thFillTitle">Nombre</th> 
				<th width="5%" class="thFillTitle">Vencimiento</th> 
				<th width="5%" class="thFillTitle">Terminado</th> 
				<th width="5%" class="thFillTitle">&nbsp;</th> 
			</tr> 
		</thead> 
	<tbody>|-if $activities|@count eq 0-|
		<tr>
			 <td colspan="6">|-if isset($filter)-|No hay Actividades que concuerden con la búsqueda|-else-|No hay Actividades disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$activities item=activity name=for_Activities-|
		<tr> 
			<td class="line1">|-$activity->getid()-|</td> 
			<td class="line1">|-assign var="project" value=$activity->getTableroProject()-||-$project->getName()-|</td> 
			<td class="line1">|-$activity->getname()-|</td> 
			<td class="line1">|-$activity->getexpirationDate()|change_timezone|date_format-|</td> 
			<td class="line1">|-$activity->getcompleted()-|</td> 
			<td nowrap> <form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="tableroActivitiesEdit" /> 
					<input type="hidden" name="id" value="|-$activity->getid()-|" /> 
					<input type="submit" name="submit_go_edit_activity" value="Editar" class="icon iconEdit" /> 
				</form> 
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="tableroActivitiesDoDelete" /> 
					<input type="hidden" name="id" value="|-$activity->getid()-|" /> 
					<input type="submit" name="submit_go_delete_activity" value="Borrar" onclick="return confirm('Seguro que desea eliminar la actividad?')" class="icon iconDelete" /> 
			</form></td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="6" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				 <th colspan="6" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroActivitiesEdit" class="addLink">Agregar Actividad</a></div></th>
			</tr>
		|-/if-|
		</tbody> 
		 </table> 
</div>
