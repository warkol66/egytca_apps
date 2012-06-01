<h2>Planificación</h2>
<h1>Administración de ##objectives,6,Objetivos##</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de Objetivos de Impacto</p>
<div id="div_objectives">
	|-if $message eq "ok"-|
		<div class="successMessage">##objectives,3,Objetivo## guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">##objectives,3,Objetivo## eliminado correctamente</div>
	|-elseif $message eq "saved"-|
		<div class="successMessage">Los cambios fueron guardados</div>
	|-elseif $message eq "notsaved"-|
		<div class="successMessage">No se guardaron los cambios</div>
	|-/if-|
	<table id="tabla-objectives" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
		<tr>
			<td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0 && !($filters.fromStrategicObjectives)-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="objectivesList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>|-if $filters|@count gt 0-|<form  method="get">
				 <input type="hidden" name="do" value="objectivesList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=planningImpactObjectivesEdit" class="addLink">Agregar ##objectives,3,Objetivo##</a></div></th>
			</tr>
			<tr class="thFillTitle">
			<th width="5%" class="thFillTitle">Id</th>
				<th width="25%">##objectives,2,Objetivo Etratégico##</th>
				<th width="4%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $impactObjectiveColl|@count eq 0-|
			<tr>
				 <td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|">|-if isset($filters)-|No hay ##objectives,3,Objetivo## que concuerden con la búsqueda|-else-|No hay ##objectives,3,Objetivo## disponibles|-/if-|</td>
			</tr>
			|-else-|
		|-foreach from=$impactObjectiveColl item=objective name=for_objectives-|
			<tr>
				<td>|-$objective->getId()-|</td>
				<td>|-$objective->getName()-|</td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="objectivesViewX" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("objectivesShowDiv", "Main.php?do=objectivesViewX&id=|-$objective->getid()-|", { method: "post", parameters: { id: "|-$objective->getId()-|"}, evalScripts: true})};$("objectivesShowWorking").innerHTML = "<span class=\"inProgress\">buscando ##objectives,3,Objetivo##...</span>";' value="Ver detalle" name="submit_go_show_objective" title="Ver detalle" /></a>
					</form>
					|-if $configModule->get("global","applicationName") eq "wb"-|			
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="indicatorsView" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="hidden" name="entity" value="Objective" />
						<input type="submit" name="submit_go_view_project_graph" value="Ver Curva de Desembolsos" class="icon iconGraph" title="Ver Curva de Desembolsos" />
					</form>
					|-/if-|
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningImpactObjectivesEdit" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_edit_objective" value="Editar" class="icon iconEdit" title="Editar ##objectives,3,Objetivo##"/>
					</form>
					
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="planningImpactObjectivesDoDelete" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_delete_objective" value="Borrar" onclick="return confirm('Seguro que desea eliminar el objetivo?')" class="icon iconDelete" title="Eliminar ##objectives,3,Objetivo##" />
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="projectsEdit" />
						<input type="hidden" name="fromObjectiveId" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_edit_project" value="Agregar Proyectos" class="icon iconAdd" title="Agregar proyectos al ##objectives,3,Objetivo##" />
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
				<th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="thFillTitle">|-if $impactObjectiveColl|@count gt 5-|<div class="rightLink"><a href="Main.php?do=planningImpactObjectivesEdit" class="addLink">Agregar ##objectives,3,Objetivo##</a></div>|-/if-|</th>
			</tr>
		</tbody>
	</table>
</div>
