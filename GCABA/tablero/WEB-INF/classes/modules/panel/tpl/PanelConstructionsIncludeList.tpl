|-if !$csv-|<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="planningConstructionsShowWorking"></div>
	<div class="innerLighbox">
		<div id="planningConstructionsShowDiv"></div>
	</div>
</div>
|-include file="CommonAutocompleterInclude.tpl"-|
<h3>Listado de obras</h3>
<div id="div_constructions">
	|-if $message eq "ok"-|
		<div class="successMessage">Obra guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Obra eliminado correctamente</div>
	|-elseif $message eq "saved"-|
		<div class="successMessage">Los cambios fueron guardados</div>
	|-elseif $message eq "notsaved"-|
		<div class="successMessage">No se guardaron los cambios</div>
	|-/if-|
	<table id="tabla-constructions" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
			<tr class="thFillTitle">
				<th width="33%">Obra</th>
				<th width="33%">Semaforo</th>
				<th width="33%">Acciones</th>
				<th width="1%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $planningConstructionColl|@count eq 0-|
			<tr>
				 <td colspan="4">No hay Obras en este proyecto</td>
			</tr>
			|-else-|
		|-foreach from=$planningConstructionColl item=construction name=for_constructions-|
			<tr>
				<td>|-$construction->getName()-|</td>
				<td></td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningConstructionsViewX" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningConstructionsShowDiv", "Main.php?do=planningConstructionsViewX&id=|-$construction->getid()-|", { method: "post", parameters: { id: "|-$construction->getId()-|"}, evalScripts: true})};$("planningConstructionsShowWorking").innerHTML = "<span class=\"inProgress\">buscando Obra...</span>";' value="Ver detalle" name="submit_go_show_construction" title="Ver detalle" /></a>
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="panelConstructionsEdit" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<input type="submit" name="submit_go_edit_construction" value="Editar" class="icon iconListCheck" title="Seguimiento de Obra"/>
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="planningConstructionsDoDelete" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<input type="submit" name="submit_go_delete_construction" value="Borrar" onclick="return confirm('¿Seguro que desea eliminar el objetivo?')" class="icon iconDelete" title="Eliminar Obra" />
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
			|-if $planningConstructionColl|@count gt 5-|<tr>
				 <th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="thFillTitle"><div class="rightLink">|-if $smarty.session.planningMode || $loginUser->mayPlan() || $loginUser->mayFollow()-|<a href="Main.php?do=panelConstructionsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-||-if $nav-|&fromPlanningProjectId=|-$filters.planningprojectid-||-/if-|" class="addLink">Agregar Obra</a>|-/if-|</div></th>
			</tr>|-/if-|
		</tbody>
	</table>
</div>
|-else-|
"Eje"|"Proyecto"|"Dependencia"|"Actividad"|"Fecha Inicio"|"Fecha Fin"|"Completado"
|-foreach from=$planningConstructionColl item=construction name=for_constructions-||-assign var=project value=$construction->getPlanningProject()-|
"|-if is_object($project)-||-$project->getPolicyGuideline()-||-/if-|"|"|-$project-|"|"|-if is_object($project)-||-$project->getPosition()-||-/if-|"|"|-$construction->getName()-|"|"|-$construction->getStartingDate()|date_format-|"|"|-$construction->getEndingDate()|date_format-|"|"|-$construction->getAcomplished()|si_no-|"
|-/foreach-|
|-/if-|
