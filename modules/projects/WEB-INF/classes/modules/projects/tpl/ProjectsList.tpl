<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="iconDelete" /></a> 
	</p> 
	<div id="projectsShowWorking"></div>
	<div class="innerLighbox">
		<div id="projectsShowDiv"></div>
	</div>
</div> 
<h2>Tablero de Gestión</h2>
<h1>Administración de ##projects,2,Proyectos##</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>A continuación se muestra la lista de ##projects,5,proyectos## del sistema.</p>
|-if is_object($parentObject)-|
<object title="|-$parentObject->getName()-|" height="120" width="120">
	<param name="movie" value="images/speedometer.swf">
	<embed src="images/speedometer.swf" wmode="transparent" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="var3=|-$parentObject->getSpeed()-|" height="120" width="120" /></object>      
<div id="navBar">|-include file="NavigationParentInclude.tpl" object=$parentObject first="true"-| |-$parentObject->getName()-|</div>|-/if-|
<div id="div_projects">
	|-if $message eq "ok"-|
		<div class="successMessage">##projects,1,Proyecto## guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">##projects,1,Proyecto## eliminado correctamente</div>
	|-/if-|
	<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-projects">
	<thead>
	<tr>
		<td colspan="8" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar ##projects,5,proyectos##</a>
		<div id="divSearch" style="display:|-if $filters|@count gt 0 && !($filters.fromObjectives)-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
			<p>
		|-if isset($dependencies)-|
			<label for="filters[dependency]">Dependencia</label>
			<select name="filters[dependency]">
				<option value="">Todas</option>
			|-foreach from=$dependencies item=dependency name=for_dependencies-|
				<option value="|-$dependency->getId()-|" |-if $filters.dependency eq $dependency->getId()-|selected="selected"|-/if-|>|-$dependency->getName()-|</option>
			|-/foreach-|	
			</select>
		|-/if-|
		|-if $moduleConfig.useCommunes.value == "YES"-|
			<label for="filters[commune]">Comuna</label>
			<select name="filters[commune]">
				<option value="">Todas</option>
			|-foreach from=$communes item=communeItem name=for_communes-|
				<option value="|-$communeItem->getId()-|" |-if isset($filters.commune) and $commune eq $communeItem->getId()-|selected="selected"|-/if-|>|-$communeItem->getName()-|</option>
			|-/foreach-|	
			</select>
	|-/if-|
	|-if $configModule->get("projects","useRegions")-|
			<label for="filters[region]">Regiones</label>
			<select name="filters[region]">
				<option value="">Todas</option>
			|-foreach from=$regions item=regionItem name=for_regions-|
				<option value="|-$regionItem->getId()-|" |-if isset($filters.region) and $filters.region eq $regionItem->getId()-|selected="selected"|-/if-|>|-section name=space loop=$regionItem->getLevel()-|&nbsp; &nbsp;|-/section-||-$regionItem->getName()-|</option>
			|-/foreach-|	
			</select>
		|-/if-|
		<p><label for="filters[searchString]">Texto a buscar</label>
		<input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="50" />
		</p>
		<p><input type="checkbox" name="filters[delayed]" value="1" |-if isset($filters.delayed)-|checked="checked"|-/if-|>
			<label>Retrasados</label>
			<input type="checkbox" name="filters[ended]" value="1" |-if isset($filters.ended)-|checked="checked"|-/if-|>
			<label>Finalizados</label>
			<input type="checkbox" name="filters[working]" value="1" |-if isset($filters.working)-|checked="checked"|-/if-| />
			<label>En Ejecución</label> 
		</p>
			<input type="hidden" name="do" value="projectsList" />
			<input name="submit" type="submit" value="Aplicar filtros" />
		</form>
		|-if $filters|@count gt 0-|<form  method="get">
			<input type="hidden" name="do" value="projectsList" />
			<input type="submit" value="Quitar Filtros" />
	</form>|-/if-|</div>
	</td>
	</tr>
		<tr class="thFillTitle">
			<th colspan="8"><div class="rightLink"><a href="Main.php?do=projectsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar ##projects,1,Proyecto##</a></div></th>
		</tr>
		<tr class="thFillTitle">
			<!--<th width="4%">Id</th>-->
				<th width="30%">##objectives,6,Objetivos##</th>
				<th width="4%">&nbsp;</th>
				<th width="50%">##projects,1,Proyecto##</th>
				<th width="4%">Inicio Real</th>
				<th width="4%">Fin Planificado </th>
				<th width="4%">Fin real </th>
				<th width="4%">Progreso</th>														
				<th width="4%">&nbsp;</th>
			</tr>
		</thead>
	<tbody>|-if $projects|@count eq 0-|
		<tr>
			 <td colspan="7">|-if isset($filters)-|No hay ##projects,2,Proyectos## que concuerden con la búsqueda|-else-|No hay ##projects,2,Proyectos## disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$projects item=project name=for_projects-|
			<tr valign="bottom">
			<!--	<td>|-$project->getid()-|</td>-->
				<td>|-assign var="objective" value=$project->getObjective()-||-if is_object($objective)-||-$objective->getName()-||-/if-|</td>
				<td><a href="javascript:void(null);" class="flag|-$project->statusColor()|capitalize-|"></a></td>
				<td><a href="Main.php?do=projectsActivitiesList&filters[projectId]=|-$project->getid()-|&filters[fromProjects]=true" title="Ver actividades del ##projects,4,proyecto##" class="follow">|-$project->getname()-|</a> </td>
				<td align="center">|-$project->getRealStart()|date_format:"%d-%m-%Y"-|</td>
				<td align="center">|-$project->getPlannedEnd()|date_format:"%d-%m-%Y"-|</td>
				<td align="center">|-$project->getRealEnd()|date_format:"%d-%m-%Y"-|</td>
				<td align="center">|-$project->getgoalProgress()-|</td>
				<td nowrap>|-if $configModule->get("projects","useDisbursements")-|
					|-if $project->getIndicatorId() ne ''-|
						<form action="Main.php" method="get" style="display:inline;">
							<input type="hidden" name="do" value="indicatorsView" />
							<input type="hidden" name="id" value="|-$project->getIndicatorId()-|" />
							<input type="submit" name="submit_go_view_project_graph" value="Ver Curva de Desembolsos" class="iconGraph" title="Ver Curva de Desembolsos" />
						</form>
					|-else-|
						<form action="Main.php" method="get" style="display:inline;">
							<input type="hidden" name="do" value="projectsCreateGraph" />
							<input type="hidden" name="id" value="|-$project->getid()-|" />
							|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
							|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
							<input type="submit" name="submit_go_create_project_graph" value="Ver Curva de Desembolsos" class="iconGraph" title="Ver Curva de Desembolsos" />
						</form>
					|-/if-||-/if-|
					<form action="Main.php" method="get" style="display:inline;">
						
						<input type="hidden" name="do" value="projectsViewX" />
						<input type="hidden" name="id" value="|-$project->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="iconView" onClick='{new Ajax.Updater("projectsShowDiv", "Main.php?do=projectsViewX&id=|-$project->getid()-|", { method: "post", parameters: { id: "|-$project->getId()-|"}, evalScripts: true})};$("projectsShowWorking").innerHTML = "<span class=\"inProgress\">buscando ##projects,4,proyecto##...</span>";' value="Ver detalle" name="submit_go_show_project" /></a>
					</form>
					|-if $project->hasWriteAccess($loginUser) -|
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="projectsEdit" />
						<input type="hidden" name="id" value="|-$project->getid()-|" />
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="submit" name="submit_go_edit_project" value="Editar" class="iconEdit" />
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="projectsDoDelete" />
						<input type="hidden" name="id" value="|-$project->getid()-|" />
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="submit" name="submit_go_delete_project" value="Borrar" onclick="return confirm('Seguro que desea eliminar el proyecto?')" class="iconDelete" />
					</form>
					|-/if-|
					|-if $project->getLogCount() gt 0-|
						<form action="Main.php" method="get" style="display:inline;">
							<input type="hidden" name="do" value="projectsShowHistory" />
							<input type="hidden" name="id" value="|-$project->getid()-|" />
							<input type="submit" name="submit_go_show_project_history" value="Mostrar Historico de cambios" class="iconHistory"  title="Mostrar Historico de cambios" />
						</form>
					|-/if-|
				<form action="Main.php" method="get" style="display:inline;">
	<input type="hidden" name="do" value="projectsActivitiesEdit" />
	<input type="hidden" name="fromProjectsList" value="|-$project->getid()-|" />
	|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
	|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
	<input type="submit" name="submit_go_edit_project" value="Agregar Actividades" class="iconAdd" title="Agregar actividades al proyecto" />
</form></td>
			</tr>
		|-/foreach-|						
	|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="8" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
	|-/if-|
		<tr class="thFillTitle">
			<th colspan="8"><div class="rightLink"><a href="Main.php?do=projectsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addNew">Agregar ##projects,1,Proyecto##</a></div></th>
		</tr>
	|-/if-|
		</tbody>
	</table>
</div>
