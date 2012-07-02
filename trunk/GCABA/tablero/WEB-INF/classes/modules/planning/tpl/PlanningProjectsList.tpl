<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="planningProjectsShowWorking"></div>
	<div class="innerLighbox">
		<div id="planningProjectsShowDiv"></div>
	</div>
</div>
<h2>Planificación</h2>
<h1>Administración de Projectos</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de Projectos</p>
<div id="div_projects">
	|-if $message eq "ok"-|
		<div class="successMessage">Projecto guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Projecto eliminado correctamente</div>
	|-elseif $message eq "saved"-|
		<div class="successMessage">Los cambios fueron guardados</div>
	|-elseif $message eq "notsaved"-|
		<div class="successMessage">No se guardaron los cambios</div>
	|-/if-|
	<table id="tabla-projects" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
		<tr>
			<td colspan="4" class="tdSearch"><a href="javascript:void(null);" onClick='$("divSearch").toggle();' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0 && !($filters.fromStrategicObjectives)-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="planningProjectsList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />|-if $filters|@count gt 0-|
				<input type='button' onClick='location.href="Main.php?do=planningProjectsList"' value="Quitar Filtros" title="Quitar Filtros"/>
|-/if-|</form></div></td>
		</tr>
			<tr>
				 <th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=planningProjectsEdit" class="addLink">Agregar Projecto</a></div></th>
			</tr>
			<tr class="thFillTitle">
				<th width="33%">Objetivo Operativo</th>
				<th width="33%">Dependencia</th>
				<th width="33%">Projecto</th>
				<th width="1%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $planningProjectColl|@count eq 0-|
			<tr>
				 <td colspan="4">|-if isset($filters)-|No hay Projecto que concuerden con la búsqueda|-else-|No hay Projecto disponibles|-/if-|</td>
			</tr>
			|-else-|
		|-foreach from=$planningProjectColl item=project name=for_projects-|
			<tr>
				<td>|-$project->getOperativeobjective()-|</td>
				<td>|-$project->getPosition()-|</td>
				<td>|-$project->getName()-|</td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningProjectsViewX" />
						<input type="hidden" name="id" value="|-$project->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningProjectsShowDiv", "Main.php?do=planningProjectsViewX&id=|-$project->getid()-|", { method: "post", parameters: { id: "|-$project->getId()-|"}, evalScripts: true})};$("planningProjectsShowWorking").innerHTML = "<span class=\"inProgress\">buscando Projecto...</span>";' value="Ver detalle" name="submit_go_show_project" title="Ver detalle" /></a>
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningProjectsEdit" />
						<input type="hidden" name="id" value="|-$project->getid()-|" />
						<input type="submit" name="submit_go_edit_project" value="Editar" class="icon iconEdit" title="Editar Projecto"/>
					</form>
					
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="planningProjectsDoDelete" />
						<input type="hidden" name="id" value="|-$project->getid()-|" />
						<input type="submit" name="submit_go_delete_project" value="Borrar" onclick="return confirm('Seguro que desea eliminar el objetivo?')" class="icon iconDelete" title="Eliminar Projecto" />
					</form>
					</td>
			</tr>
		|-/foreach-|
		|-/if-|					
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="4" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				<th colspan="4" class="thFillTitle">|-if $projectColl|@count gt 5-|<div class="rightLink"><a href="Main.php?do=planningProjectsEdit" class="addLink">Agregar Projecto</a></div>|-/if-|</th>
			</tr>
		</tbody>
	</table>
</div>
