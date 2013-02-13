|-if !$csv-|<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<link type="text/css" href="css/chosen.css" rel="stylesheet" />
<script language="JavaScript" type="text/javascript" src="scripts/chosen.proto.js"></script>
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar <input type="button" class="icon iconClose" /></a> 
	</p> 
	<div id="planningProjectsShowWorking"></div>
	<div class="innerLighbox">
		<div id="planningProjectsShowDiv"></div>
	</div>
</div>
|-include file="CommonAutocompleterInclude.tpl"-|
<h2>Seguimiento</h2>
<h1>Seguimiento de Proyectos</h1>
<!-- Link VOLVER -->
	|-if !is_null($operativeObjective) && is_object($operativeObjective)-|
		<div id="navBar">|-include file="PlanningNavigationIncludeList.tpl" object=$operativeObjective-|</div>
	|-/if-|
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de Proyectos</p>
<div id="div_projects">
	|-if $message eq "ok"-|
		<div class="successMessage">Proyecto guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Proyecto eliminado correctamente</div>
	|-elseif $message eq "saved"-|
		<div class="successMessage">Los cambios fueron guardados</div>
	|-elseif $message eq "notsaved"-|
		<div class="successMessage">No se guardaron los cambios</div>
	|-/if-|
	<table id="tabla-projects" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
		|-if !$nav-|<tr>
			<td colspan="5" class="tdSearch"><a href="javascript:void(null);" onClick='$("divSearch").toggle();' class="tdTitSearch">Busqueda por nombre del proyecto</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0 && !($filters.fromStrategicObjectives)-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="panelProjectsList" />
					<p><label for="filters[searchString]">Texto</label><input name="filters[searchString]" type="text" value="|-$filters.searchString-|" size="30" /></p>
		<div div="div_filters[positionCode]" style="position: relative;z-index:10000;">
					|-include file="CommonAutocompleterInstanceSimpleInclude.tpl" id="autocomplete_position" url="Main.php?do=commonAutocompleteListX&object=position&objectParam=code" hiddenName="filters[positionCode]" label="Dependencia" defaultValue=$filters.positionName defaultHiddenValue=$filters.positionCode name="filters[positionName]"-|
		</div>
<p><label for="filters[getPositionBrood]">Incluir dependientes</label>
				<input name="filters[getPositionBrood]" type="checkbox" value="1" |-$filters.getPositionBrood|checked_bool-| />
</p>
<p>
	<label for="filters_tags">Etiquetas</label>
	<select style="width:480px" class="chzn-select wide-chz-select" data-placeholder="Seleccione una o varias etiquetas..." multiple="multiple" id="filters_tags" name="filters[tagIds][]" size="5" title="tags">
		|-foreach from=$tags item=tag-|
			<option value="|-$tag->getId()-|" |-in_array($tag->getId(), $filters.tagIds)|selected:true-|>|-$tag->getName()-|</option>
		|-/foreach-|
	</select>
</p>
					<p><input type='submit' value='Buscar' class='tdSearchButton' />|-if $filters|@count gt 0-|
				&nbsp;&nbsp;<input type="button" value="Exportar" onclick="window.open(('Main.php?'+Form.serialize(this.form)+'&csv=true'));"/>
				&nbsp;&nbsp;<input type='button' onClick='location.href="Main.php?do=panelProjectsList"' value="Quitar Filtros" title="Quitar Filtros"/>
|-/if-|</p>

					|-if $loginUser->isSupervisor()-||-/if-|
</form></div></td>
		</tr>|-/if-|
			<tr>
				 <th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|9|-else-|8|-/if-|" class="thFillTitle"><div class="rightLink">|-if $smarty.session.planningMode || $loginUser->mayPlan() || $loginUser->mayFollow()-|<a href="Main.php?do=planningProjectsEdit|-if $filters.operativeobjectiveid-|&fromOperativeObjectiveId=|-$filters.operativeobjectiveid-||-/if-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|" class="addLink">Agregar Proyecto</a></div>|-/if-|</th>
			</tr>
			<tr class="thFillTitle">
				<th width="33%">Objetivo Operativo</th>
				<th width="33%">Dependencia</th>
				<th width="30%">Proyecto</th>
				<th width="1%">&nbsp;</th>
				<th width="4%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $planningProjectColl|@count eq 0-|
			<tr>
				 <td colspan="5">|-if isset($filters)-|No hay Proyecto que concuerden con la búsqueda|-else-|No hay Proyecto disponibles|-/if-|</td>
			</tr>
			|-else-|
		|-foreach from=$planningProjectColl item=project name=for_projects-|
			<tr>|-assign var=operativeObjective value=$project->getOperativeObjective()-|
				<td>|-if is_object($operativeObjective)-||-$operativeObjective->getStringCode()-|&nbsp;|-/if-||-$project->getOperativeobjective()-|</td>
				<td>|-$project->getPosition()-|</td>
				<td>|-$project->getStringCode()-|&nbsp;|-$project->getName()-|</td>
				<td nowrap>|-if $project->countPlanningConstructions() gt 0-|<a href="Main.php?do=planningConstructionsList&nav=true&&filters[planningprojectid]=|-$project->getId()-|" class="icon iconFollow" title="Ver Obras del Proyecto">Ver Obras</a>|-/if-|</td>
				<td nowrap>
					|-if "planningProjectsViewX"|security_has_access-||-if $project->getActivities()|count gt 0-|
					<input type="button" class="icon iconViewGantt" onClick='window.open("Main.php?do=planningProjectsViewX&showGantt=true&id=|-$project->getid()-|","Gantt","scrollbars=1,width=800,height=600");' value="Ver Gantt" title="Ver Gantt (abre en ventana nueva)" />|-else-|<img src="images/clear.png" class="icon iconClear disabled" />|-/if-|
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="planningProjectsViewX" />
						<input type="hidden" name="id" value="|-$project->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("planningProjectsShowDiv", "Main.php?do=planningProjectsViewX&id=|-$project->getid()-|", { method: "post", parameters: { id: "|-$project->getId()-|"}, evalScripts: true})};$("planningProjectsShowWorking").innerHTML = "<span class=\"inProgress\">buscando Proyecto...</span>";' value="Ver detalle" name="submit_go_show_project" title="Ver detalle" /></a>
					</form>|-/if-|
					|-if "panelProjectsEdit"|security_has_access-|<form action="Main.php" method="get" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="panelProjectsEdit" />
						<input type="hidden" name="id" value="|-$project->getid()-|" />
						<input type="submit" name="submit_go_edit_project" value="Editar" class="icon iconListCheck" title="Seguimiento del Proyecto"/>
					</form>|-/if-|
					|-if "planningProjectsDoDelete"|security_has_access-|<form action="Main.php" method="post" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="planningProjectsDoDelete" />
						<input type="hidden" name="id" value="|-$project->getid()-|" />
						<input type="submit" name="submit_go_delete_project" value="Borrar" onclick="return confirm('¿Seguro que desea eliminar el objetivo?')" class="icon iconDelete" title="Eliminar Proyecto" />
					</form>|-/if-|
					|-if $smarty.session.planningMode || $loginUser->mayPlan() || $loginUser->mayFollow()-||-if "planningConstructionsEdit"|security_has_access-||-if $project->getInvestment()-|<form action="Main.php" method="get" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="planningConstructionsEdit" />
						<input type="hidden" name="fromPlanningProjectId" value="|-$project->getid()-|" />
						<input type="submit" name="submit_go_edit_construction" value="Agregar Obras" class="icon iconAdd" title="Agregar Obras" />
					</form>|-/if-||-/if-||-/if-|
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
				<th colspan="5" class="thFillTitle">|-if $projectColl|@count gt 5-|<div class="rightLink"><a href="Main.php?do=planningProjectsEdit|-if $filters.operativeobjectiveid-|&fromOperativeObjectiveId=|-$filters.operativeobjectiveid-||-/if-||-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($page)-|&page=|-$page-||-/if-|" class="addLink">Agregar Proyecto</a></div>|-/if-|</th>
			</tr>
		</tbody>
	</table>
</div>
<script>
	Element.observe(window, 'load', function() {
		$$('.chzn-select').each(function(e) {new Chosen(e)} );
	});
</script>
|-else-|
"Eje"|"Objetivo Ministerial"|"Objetivo Operativo"|"Proyecto"|"Dependencia"|"Inversion"|"Prioridad Ministerial"|"Prioridad"|"Presupuesto Solicitado"
|-foreach from=$planningProjectColl item=project name=for_projects-||-assign var=operativeObjective value=$project->getOperativeObjective()-||-if is_object($operativeObjective)-||-assign var=ministryObjective value=$operativeObjective->getMinistryObjective()-||-if is_object($ministryObjective)-||-assign var=impactObjective value=$ministryObjective->getImpactObjective()-||-/if-||-/if-|
"|-$project->getPolicyGuideline()|escape-|"|"|-$ministryObjective|escape-|"|"|-$operativeObjective-|"|"|-$project-|"|"|-$project->getPosition()-|"|"|-$project->getInvestment()|si_no-|"|"|-$project->getMinistrypriorityTrasnlated()-|"|"|-$project->getPriorityTrasnlated()-|"|"|-$project->getAppliedAmount()|system_numeric_format-|"
|-/foreach-|
|-/if-|