<h2>Tablero de Control</h2>
<h1>Hitos</h1>
<p>A continuación se muestra la lista de hitos del sistema.</p>
<div id="div_milestones"> 
	|-if $message eq "ok"-|
		<div class="successMessage">Hito guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Hito eliminado correctamente</div>
	|-/if-|
	<table id="tabla-milestones" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'> 
		<thead> 
		<tr>
			<td colspan="6" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filter|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="tableroMilestonesList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filter.searchString)-||-$filter.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form><form  method="get">
				<input type="hidden" name="do" value="tableroMilestonesList" />
				<input type="submit" value="Quitar Filtros" />
		</form></div></td>
		</tr>
			<tr>
				 <th colspan="6" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroMilestonesEdit" class="addLink">Agregar Hito</a></div></th>
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
	<tbody>|-if $milestones|@count eq 0-|
		<tr>
			 <td colspan="6">|-if isset($filter)-|No hay Hitos que concuerden con la búsqueda|-else-|No hay Hitos disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$milestones item=milestone name=for_milestones-|
		<tr> 
			<td class="line1">|-$milestone->getid()-|</td> 
			<td class="line1">|-assign var="project" value=$milestone->getTableroProject()-||-$project->getName()-|</td> 
			<td class="line1">|-$milestone->getname()-|</td> 
			<td class="line1">|-$milestone->getexpirationDate()|change_timezone|date_format-|</td> 
			<td class="line1">|-$milestone->getcompleted()-|</td> 
			<td nowrap> <form action="Main.php" method="get" style="display:inline;"> 
					<input type="hidden" name="do" value="tableroMilestonesEdit" /> 
					<input type="hidden" name="id" value="|-$milestone->getid()-|" /> 
					<input type="submit" name="submit_go_edit_milestone" value="Editar" class="icon iconEdit" /> 
				</form> 
				<form action="Main.php" method="post" style="display:inline;"> 
					<input type="hidden" name="do" value="tableroMilestonesDoDelete" /> 
					<input type="hidden" name="id" value="|-$milestone->getid()-|" /> 
					<input type="submit" name="submit_go_delete_milestone" value="Borrar" onclick="return confirm('Seguro que desea eliminar el milestone?')" class="icon iconDelete" /> 
			</form></td> 
		</tr> 
		|-/foreach-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr> 
			<td colspan="6" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				 <th colspan="6" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroMilestonesEdit" class="addLink">Agregar Hito</a></div></th>
			</tr>
		|-/if-|
		</tbody> 
	 </table> 
</div>
