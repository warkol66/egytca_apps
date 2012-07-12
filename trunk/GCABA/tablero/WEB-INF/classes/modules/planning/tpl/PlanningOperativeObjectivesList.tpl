<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="planningOperativeObjectivesShowWorking"></div>
	<div class="innerLighbox">
		<div id="planningOperativeObjectivesShowDiv"></div>
	</div>
</div> 
<h2>Planificación</h2>
<h1>Administración de Objetivos Operativos</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de Objetivos Operativos</p>
<div id="div_objectives">
	|-if $message eq "ok"-|
		<div class="successMessage">Objetivo Operativo guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Objetivo Operativo eliminado correctamente</div>
	|-elseif $message eq "saved"-|
		<div class="successMessage">Los cambios fueron guardados</div>
	|-elseif $message eq "notsaved"-|
		<div class="successMessage">No se guardaron los cambios</div>
	|-/if-|
	<table id="tabla-objectives" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
		|-if !$nav-|<tr>
			<td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="tdSearch"><a href="javascript:void(null);" onClick='$("divSearch").toggle();' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0 && !($filters.fromStrategicObjectives)-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="planningOperativeObjectivesList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />|-if $filters|@count gt 0-|
				<input type='button' onClick='location.href="Main.php?do=planningOperativeObjectivesList"' value="Quitar Filtros" title="Quitar Filtros"/>
|-/if-|</form></div></td>
		</tr>
			<tr>
				 <th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=planningOperativeObjectivesEdit" class="addLink">Agregar Objetivo Operativo</a></div></th>
			</tr>|-/if-|
			<tr class="thFillTitle">
				<th width="45%">Objetivo Ministerial</th>
				<th width="50%">Objetivo Operativo</th>
				<th width="1%">&nbsp;</th>
				<th width="4%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $operativeObjectiveColl|@count eq 0-|
			<tr>
				 <td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|">|-if isset($filters)-|No hay Objetivo Operativo que concuerden con la búsqueda|-else-|No hay Objetivo Operativo disponibles|-/if-|</td>
			</tr>
			|-else-|
		|-foreach from=$operativeObjectiveColl item=objective name=for_objectives-|
			<tr>
				<td>|-$objective->getMinistryObjective()-|</td>
				<td>|-$objective->getName()-|</td>
				<td nowrap>|-if $objective->countPlanningProjects() gt 0-|<a href="Main.php?do=planningProjectsList&nav=true&&filters[operativeobjectiveid]=|-$objective->getid()-|" class="icon iconFollow" title="Ver Proyectos del Objetivo Operativo">Ver Proyectos</a>|-/if-|</td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningOperativeObjectivesViewX" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningOperativeObjectivesShowDiv", "Main.php?do=planningOperativeObjectivesViewX&id=|-$objective->getid()-|", { method: "post", parameters: { id: "|-$objective->getId()-|"}, evalScripts: true})};$("planningOperativeObjectivesShowWorking").innerHTML = "<span class=\"inProgress\">buscando Objetivo Operativo...</span>";' value="Ver detalle" name="submit_go_show_objective" title="Ver detalle" /></a>
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningOperativeObjectivesEdit" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_edit_objective" value="Editar" class="icon iconEdit" title="Editar Objetivo Operativo"/>
					</form>
					
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="planningOperativeObjectivesDoDelete" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_delete_objective" value="Borrar" onclick="return confirm('Seguro que desea eliminar el objetivo?')" class="icon iconDelete" title="Eliminar Objetivo Operativo" />
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningProjectsEdit" />
						<input type="hidden" name="fromOperativeObjectiveId" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_edit_project" value="Agregar Proyectos" class="icon iconAdd" title="Agregar proyectos al Objetivo Operativo" />
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
				<th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="thFillTitle">|-if $operativeObjectiveColl|@count gt 5-|<div class="rightLink"><a href="Main.php?do=planningOperativeObjectivesEdit" class="addLink">Agregar Objetivo Operativo</a></div>|-/if-|</th>
			</tr>
		</tbody>
	</table>
</div>
