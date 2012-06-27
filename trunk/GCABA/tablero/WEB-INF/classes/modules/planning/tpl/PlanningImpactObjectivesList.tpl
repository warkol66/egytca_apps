<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="planningImpactObjectivesShowWorking"></div>
	<div class="innerLighbox">
		<div id="planningImpactObjectivesShowDiv"></div>
	</div>
</div> 
<h2>Planificación</h2>
<h1>Administración de Objetivos de Impacto</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de Objetivos de Impacto</p>
<div id="div_planningImpactObjectives">
	|-if $message eq "ok"-|
		<div class="successMessage">Objetivo de Impacto guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Objetivo de Impacto eliminado correctamente</div>
	|-elseif $message eq "saved"-|
		<div class="successMessage">Los cambios fueron guardados</div>
	|-elseif $message eq "notsaved"-|
		<div class="successMessage">No se guardaron los cambios</div>
	|-/if-|
	<table id="tabla-planningImpactObjectives" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
		<tr>
			<td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="tdSearch"><a href="javascript:void(null);" onClick='$("divSearch").toggle();' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0 && !($filters.fromStrategicObjectives)-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="planningImpactObjectivesList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />|-if $filters|@count gt 0-|
				<input type='button' onClick='location.href="Main.php?do=planningImpactObjectivesList"' value="Quitar Filtros" title="Quitar Filtros"/>
|-/if-|</form></div></td>
		</tr>
			<tr>
				 <th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=planningImpactObjectivesEdit" class="addLink">Agregar Objetivo de Impacto</a></div></th>
			</tr>
			<tr class="thFillTitle">
			<th width="5%" class="thFillTitle">Id</th>
				<th width="25%">Objetivo de Impacto</th>
				<th width="4%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $impactObjectiveColl|@count eq 0-|
			<tr>
				 <td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|">|-if isset($filters)-|No hay Objetivo de Impacto que concuerden con la búsqueda|-else-|No hay Objetivo de Impacto disponibles|-/if-|</td>
			</tr>
			|-else-|
		|-foreach from=$impactObjectiveColl item=objective name=for_planningImpactObjectives-|
			<tr>
				<td>|-$objective->getId()-|</td>
				<td>|-$objective->getName()-|</td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningImpactObjectivesViewX" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningImpactObjectivesShowDiv", "Main.php?do=planningImpactObjectivesViewX&id=|-$objective->getid()-|", { method: "post", parameters: { id: "|-$objective->getId()-|"}, evalScripts: true})};$("planningImpactObjectivesShowWorking").innerHTML = "<span class=\"inProgress\">buscando Objetivo de Impacto...</span>";' value="Ver detalle" name="submit_go_show_objective" title="Ver detalle" /></a>
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningImpactObjectivesEdit" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_edit_objective" value="Editar" class="icon iconEdit" title="Editar Objetivo de Impacto"/>
					</form>
					
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="planningImpactObjectivesDoDelete" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_delete_objective" value="Borrar" onclick="return confirm('Seguro que desea eliminar el objetivo?')" class="icon iconDelete" title="Eliminar Objetivo de Impacto" />
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningProjectsEdit" />
						<input type="hidden" name="fromImpactObjectiveId" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_edit_project" value="Agregar Proyectos" class="icon iconAdd" title="Agregar proyectos al Objetivo de Impacto" />
					</form>			
					</td>
			</tr>
		|-/foreach-|
		|-/if-|					
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="5" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				<th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="thFillTitle">|-if $impactObjectiveColl|@count gt 5-|<div class="rightLink"><a href="Main.php?do=planningImpactObjectivesEdit" class="addLink">Agregar Objetivo de Impacto</a></div>|-/if-|</th>
			</tr>
		</tbody>
	</table>
</div>
