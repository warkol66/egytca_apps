<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="planningMinistryObjectivesShowWorking"></div>
	<div class="innerLighbox">
		<div id="planningMinistryObjectivesShowDiv"></div>
	</div>
</div> 
<h2>Planificación</h2>
<h1>Administración de Objetivos Ministeriales</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de Objetivos Ministeriales</p>
<div id="div_objectives">
	|-if $message eq "ok"-|
		<div class="successMessage">Objetivo Ministerial guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Objetivo Ministerial eliminado correctamente</div>
	|-elseif $message eq "saved"-|
		<div class="successMessage">Los cambios fueron guardados</div>
	|-elseif $message eq "notsaved"-|
		<div class="successMessage">No se guardaron los cambios</div>
	|-/if-|
	<table id="tabla-objectives" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
		<tr>
			<td colspan="3" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0 && !($filters.fromStrategicObjectives)-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="planningMinistryObjectivesList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />|-if $filters|@count gt 0-|
				<input type='button' onClick='location.href="Main.php?do=planningMinistryObjectivesList"' value="Quitar Filtros" title="Quitar Filtros"/>
|-/if-|</form></div></td>
		</tr>
			<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=planningMinistryObjectivesEdit" class="addLink">Agregar Objetivo Ministerial</a></div></th>
			</tr>
			<tr class="thFillTitle">
				<th width="50%">Objetivo de Impacto</th>
				<th width="45%">Objetivo Ministerial</th>
				<th width="5%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $ministryObjectiveColl|@count eq 0-|
			<tr>
				 <td colspan="3">|-if isset($filters)-|No hay Objetivo Ministerial que concuerden con la búsqueda|-else-|No hay Objetivo Ministerial disponibles|-/if-|</td>
			</tr>
			|-else-|
		|-foreach from=$ministryObjectiveColl item=objective name=for_objectives-|
			<tr>
				<td>|-$objective->getImpactObjective()-|</td>
				<td>|-$objective-|</td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="objectivesViewX" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningMinistryObjectivesShowDiv", "Main.php?do=planningMinistryObjectivesViewX&id=|-$objective->getid()-|", { method: "post", parameters: { id: "|-$objective->getId()-|"}, evalScripts: true})};$("planningMinistryObjectivesShowWorking").innerHTML = "<span class=\"inProgress\">buscando Objetivo Ministerial...</span>";' value="Ver detalle" name="submit_go_show_objective" title="Ver detalle" /></a>
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningMinistryObjectivesEdit" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_edit_objective" value="Editar" class="icon iconEdit" title="Editar Objetivo Ministerial"/>
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="planningMinistryObjectivesDoDelete" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_delete_objective" value="Borrar" onclick="return confirm('Seguro que desea eliminar el objetivo?')" class="icon iconDelete" title="Eliminar Objetivo Ministerial" />
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningOperativeObjectivesEdit" />
						<input type="hidden" name="fromMinistryObjectiveId" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_edit" value="Agregar Objetivos Operativos" class="icon iconAdd" title="Agregar Objetivos Operativos al Objetivo Ministerial" />
					</form>			
					</td>
			</tr>
		|-/foreach-|
		|-/if-|					
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="3" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				<th colspan="3" class="thFillTitle">|-if $ministryObjectiveColl|@count gt 5-|<div class="rightLink"><a href="Main.php?do=planningMinistryObjectivesEdit" class="addLink">Agregar Objetivo Ministerial</a></div>|-/if-|</th>
			</tr>
		</tbody>
	</table>
</div>
