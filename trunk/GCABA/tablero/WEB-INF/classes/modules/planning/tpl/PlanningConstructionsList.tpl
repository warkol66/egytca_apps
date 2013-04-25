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
<h2>Planificación</h2>
<h1>Administración de Obras</h1>
<!-- Link VOLVER -->
	|-if !is_null($planningProject) && is_object($planningProject)-|
		<div id="navBar">|-include file="PlanningNavigationIncludeList.tpl" object=$planningProject-|</div>
	|-/if-|
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de Obras</p>
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
		|-if !$nav-|	<tr>
			<td colspan="4" class="tdSearch"><a href="javascript:void(null);" onClick='$("divSearch").toggle();' class="tdTitSearch">Buscar Obras</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0 && !($filters.fromProjects)-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="planningConstructionsList" />
					<p><label for="filters[searchString]">Texto</label><input name="filters[searchString]" type="text" value="|-$filters.searchString-|" size="30" /></p>
		<div div="div_filters[positionCode]" style="position: relative;z-index:10000;">
					|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_position" url="Main.php?do=commonAutocompleteListX&object=position&objectParam=code" hiddenName="filters[positionCode]" label="Dependencia" defaultValue=$filters.positionName defaultHiddenValue=$filters.positionCode name="filters[positionName]"-|
		</div>
<p><label for="filters[getPositionBrood]">Incluir dependientes</label>
				<input name="filters[getPositionBrood]" type="checkbox" value="1" |-$filters.getPositionBrood|checked_bool-| />
</p>
<p><label for="filters[constructiontype]">Tipo de Obra</label>
    <select id="filters_constructionyype" name="filters[constructiontype]" title="Tipo de Obra">
      <option value="">Seleccione tipo de Obra</option>
      |-foreach from=$constructionTypes key=key item=name-|
					<option value="|-$key-|" |-$filters.constructiontype|selected:$key-|>|-$name-|</option>
      |-/foreach-|
    </select>
</p>
				<p><input type='submit' value='Buscar' class='tdSearchButton' />|-if $filters|@count gt 0-|
				&nbsp;&nbsp;<input type='button' onClick='location.href="Main.php?do=planningConstructionsList"' value="Quitar Filtros" title="Quitar Filtros"/>
				&nbsp;&nbsp;<input type="button" value="Exportar" onclick="window.open(('Main.php?'+Form.serialize(this.form)+'&csv=true'));"/>|-/if-|</p>
</form></div></td>
		</tr>
|-/if-|			<tr>
				 <th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=planningConstructionsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-||-if $nav-|&fromPlanningProjectId=|-$filters.planningprojectid-||-/if-|" class="addLink">Agregar Obra</a></div></th>
			</tr>
			<tr class="thFillTitle">
				<th width="33%">Proyecto</th>
				<th width="33%">Dependencia</th>
				<th width="33%">Obra</th>
				<th width="1%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $planningConstructionColl|@count eq 0-|
			<tr>
				 <td colspan="4">|-if isset($filters)-|No hay Obra que concuerden con la búsqueda|-else-|No hay Obra disponibles|-/if-|</td>
			</tr>
			|-else-|
		|-foreach from=$planningConstructionColl item=construction name=for_constructions-|
			<tr>
				<td>|-assign var=planningProject value=$construction->getPlanningProject()-||-$planningProject-|</td>
				<td>|-if is_object($planningProject)-||-$planningProject->getPosition()-||-/if-|</td>
				<td>|-$construction->getName()-|</td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningConstructionsViewX" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningConstructionsShowDiv", "Main.php?do=planningConstructionsViewX&id=|-$construction->getid()-|", { method: "post", parameters: { id: "|-$construction->getId()-|"}, evalScripts: true, onComplete: function() {new Chosen($("params_regions"));}})};$("planningConstructionsShowWorking").innerHTML = "<span class=\"inProgress\">buscando Obra...</span>";' value="Ver detalle" name="submit_go_show_construction" title="Ver detalle" /></a>
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="planningConstructionsEdit" />
						<input type="hidden" name="id" value="|-$construction->getid()-|" />
						<input type="submit" name="submit_go_edit_construction" value="Editar" class="icon iconEdit" title="Editar Obra"/>
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
			<tr>
				<th colspan="4" class="thFillTitle">|-if $planningConstructionColl|@count gt 5-|<div class="rightLink"><a href="Main.php?do=planningConstructionsEdit" class="addLink">Agregar Obra</a></div>|-/if-|</th>
			</tr>
		</tbody>
	</table>
</div>
|-else-|
"Eje"|"Proyecto"|"Dependencia"|"Actividad"|"Fecha Inicio"|"Fecha Fin"|"Completado"
|-foreach from=$planningConstructionColl item=construction name=for_constructions-||-assign var=project value=$construction->getPlanningProject()-|
"|-if is_object($project)-||-$project->getPolicyGuideline()-||-/if-|"|"|-$project-|"|"|-if is_object($project)-||-$project->getPosition()-||-/if-|"|"|-$construction->getName()-|"|"|-$construction->getStartingDate()|date_format-|"|"|-$construction->getEndingDate()|date_format-|"|"|-$construction->getAcomplished()|si_no-|"
|-/foreach-|
|-/if-|