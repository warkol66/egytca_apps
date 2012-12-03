<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="planningActivitiesShowWorking"></div>
	<div class="innerLighbox">
		<div id="planningActivitiesShowDiv"></div>
	</div>
</div>
<h2>Planificación</h2>
<h1>Administración de Actividades</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de Actividades</p>
<div id="div_constructions">
	|-if $message eq "ok"-|
		<div class="successMessage">Actividad guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Actividad eliminado correctamente</div>
	|-elseif $message eq "saved"-|
		<div class="successMessage">Los cambios fueron guardados</div>
	|-elseif $message eq "notsaved"-|
		<div class="successMessage">No se guardaron los cambios</div>
	|-/if-|
	<table id="tabla-constructions" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
		<tr>
			<td colspan="7" class="tdSearch"><a href="javascript:void(null);" onClick='$("divSearch").toggle();' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0 && !($filters.fromStrategicObjectives)-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="planningActivitiesList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />|-if $filters|@count gt 0-|
				<input type='button' onClick='location.href="Main.php?do=planningActivitiesList"' value="Quitar Filtros" title="Quitar Filtros"/>
|-/if-|</form></div></td>
		</tr>
			<!--<tr>
				 <th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=planningActivitiesEdit" class="addLink">Agregar Actividad</a></div></th>
			</tr>-->
			<tr class="thFillTitle">
				<th width="25%">Proyecto</th>
				<th width="25%">Dependencia</th>
				<th width="20%">Actividad</th>
				<th width="9%">Inicio</th>
				<th width="9%">Fin</th>
				<th width="1%">&nbsp;</th>
				<th width="1%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $planningActivityColl|@count eq 0-|
			<tr>
				 <td colspan="7">|-if isset($filters)-|No hay Actividad que concuerden con la búsqueda|-else-|No hay Actividad disponibles|-/if-|</td>
			</tr>
			|-else-|
		|-foreach from=$planningActivityColl item=construction name=for_constructions-|
			<tr>
				<td>|-assign var=project value=$construction->getProject()-||-$project-|</td>
				<td>|-if is_object($project)-||-$project->getPosition()-||-/if-|</td>
				<td>|-$construction->getName()-|</td>
				<td>|-$construction->getStartingDate()|date_format-|</td>
				<td>|-$construction->getEndingDate()|date_format-|</td>
				<td>|-$construction->getAcomplished()|si_no-|</td>
				<td nowrap>
					<!--<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningActivitiesViewX" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningActivitiesShowDiv", "Main.php?do=planningActivitiesViewX&id=|-$construction->getid()-|", { method: "post", parameters: { id: "|-$construction->getId()-|"}, evalScripts: true})};$("planningActivitiesShowWorking").innerHTML = "<span class=\"inProgress\">buscando Actividad...</span>";' value="Ver detalle" name="submit_go_show_construction" title="Ver detalle" /></a>
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningActivitiesEdit" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<input type="submit" name="submit_go_edit_construction" value="Editar" class="icon iconEdit" title="Editar Actividad"/>
					</form>
					-->
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="planningActivitiesDoDelete" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<input type="submit" name="submit_go_delete_construction" value="Borrar" onclick="return confirm('¿Seguro que desea eliminar el objetivo?')" class="icon iconDelete" title="Eliminar Actividad" />
					</form>
					</td>
			</tr>
		|-/foreach-|
		|-/if-|					
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="7" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<!--<tr>
				<th colspan="7" class="thFillTitle">|-if $planningActivityColl|@count gt 5-|<div class="rightLink"><a href="Main.php?do=planningActivitiesEdit" class="addLink">Agregar Actividad</a></div>|-/if-|</th>
			</tr>-->
		</tbody>
	</table>
</div>
