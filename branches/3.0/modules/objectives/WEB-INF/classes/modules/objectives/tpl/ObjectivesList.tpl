<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="iconDelete" /></a> 
	</p> 
	<div id="objectivesShowWorking"></div>
	<div class="innerLighbox">
		<div id="objectivesShowDiv"></div>
	</div>
</div> 
<h2>Tablero de Gestión</h2>
<h1>Administración de ##objectives,6,Objetivos##</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de ##objectives,6,Objetivos##.</p>
|-if is_object($parentObject)-|
<object title="|-$parentObject->getName()-|" height="120" width="120">
	<param name="movie" value="images/speedometer.swf">
	<embed src="images/speedometer.swf" wmode="transparent" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="var3=|-$parentObject->getSpeed()-|" height="120" width="120" /></object>      
<div id="navBar">|-include file="NavigationParentInclude.tpl" object=$parentObject first="true"-| |-$parentObject->getName()-|</div>|-/if-|
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
			<td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|8|-else-|7|-/if-|" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda por nombre</a>
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
				 <th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|8|-else-|7|-/if-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=objectivesEdit" class="addNew">Agregar ##objectives,3,Objetivo##</a></div></th>
			</tr>
			<tr class="thFillTitle">
			<!--	<th width="5%" class="thFillTitle">Id</th>-->
				<th width="25%">##objectives,2,Objetivo Etratégico##</th>
				<th width="1%">&nbsp;</th>
				<th width="30%">##objectives,3,Objetivo##</th>
				|-if $moduleConfig.useDependencies.value =="YES"-|
				<th width="35%">Dependencia</th>
				|-/if-|
				<th width="10%">Fecha</th>
				<th width="10%">Fecha de Expiración</th>
				<th width="5%">Logrado</th>
				<th width="5%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $objectives|@count eq 0-|
			<tr>
				 <td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|8|-else-|7|-/if-|">|-if isset($filters)-|No hay ##objectives,3,Objetivo## que concuerden con la búsqueda|-else-|No hay ##objectives,3,Objetivo## disponibles|-/if-|</td>
			</tr>
		|-else-|
		|-foreach from=$objectives item=objective name=for_objectives-|
			<tr>
				<!--<td>|-$objective->getid()-|</td>-->
				<td>|-$objective->getStrategicObjective()-|</td>
				<td><img src="images/clear.png" class="gauge|-$objective->getSpeedClass()-|"></td> 
				<td><a href="Main.php?do=projectsList&filters[objective]=|-$objective->getid()-|&filters[fromObjectives]=true" title="Ver proyectos del ##objectives,3,Objetivo##" class="follow">|-$objective->getname()-|</a></td>
				|-if $moduleConfig.useDependencies.value =="YES"-|
				|-assign var=affiliate value=$objective->getAffiliate()-|
				<td>|-$affiliate->getName()-|</td>
				|-/if-|
				<td nowrap>|-$objective->getdate()|date_format-|</td>
				<td nowrap>|-$objective->getexpirationDate()|date_format-|</td>
				<td align="center">|-if $objective->getachieved() eq 0-|No|-/if-||-if $objective->getachieved() eq 1-|Si|-/if-|</td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="objectivesViewX" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="iconView" onClick='{new Ajax.Updater("objectivesShowDiv", "Main.php?do=objectivesViewX&id=|-$objective->getid()-|", { method: "post", parameters: { id: "|-$objective->getId()-|"}, evalScripts: true})};$("objectivesShowWorking").innerHTML = "<span class=\"inProgress\">buscando ##objectives,3,Objetivo##...</span>";' value="Ver detalle" name="submit_go_show_objective" title="Ver detalle" /></a>
					</form>
					|-if $configModule->get("global","applicationName") eq "wb"-|			
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="indicatorsView" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="hidden" name="entity" value="Objective" />
						<input type="submit" name="submit_go_view_project_graph" value="Ver Curva de Desembolsos" class="iconGraph" title="Ver Curva de Desembolsos" />
					</form>
					|-/if-|
					|-if $objective->hasWriteAccess($loginUser) -|
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="objectivesEdit" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_edit_objective" value="Editar" class="iconEdit" title="Editar ##objectives,3,Objetivo##"/>
					</form>
					
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="objectivesDoDelete" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_delete_objective" value="Borrar" onclick="return confirm('Seguro que desea eliminar el objetivo?')" class="iconDelete" title="Eliminar ##objectives,3,Objetivo##" />
					</form>
					|-/if-|
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="projectsEdit" />
						<input type="hidden" name="fromObjectiveId" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_edit_project" value="Agregar Proyectos" class="iconAdd" title="Agregar proyectos al ##objectives,3,Objetivo##" />
					</form>			
					
				|-if $objective->getProjectsCount() gt 1 && ($loginUser->isAdmin() || $loginUser->isSupervisor())-|
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="projectsOrderByObjective" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_order_projects" value="Ordenar proyectos" class="iconOrder" title="Ordenar proyectos relacionados"/>
					</form>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="projectsWeightByObjective" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_change_weights_projects" value="Cambiar pesos de proyectos" class="iconWeight" title="Cambiar pesos de proyectos relacionados"/>
					</form>
					|-else-|
						<!--				<form action="Main.php" method="get" style="display:inline;">
											<input type="button" value="Ordenar proyectos" class="iconOrder disabled" title="El objetivo no tiene proyectos relacionados"/>
											<input type="button" value="Cambiar pesos de proyectos" class="iconWeight disabled" title="El objetivo no tiene proyectos relacionados"/>
										</form>-->
					|-/if-|
					|-if $objective->getLogCount() gt 0 && ($loginUser->isAdmin() || $loginUser->isSupervisor())-|
						<form action="Main.php" method="get" style="display:inline;">
							<input type="hidden" name="do" value="objectivesShowHistory" />
							<input type="hidden" name="id" value="|-$objective->getid()-|" />
							<input type="submit" name="submit_go_show_objective_history" value="Mostrar Historico de cambios" class="iconHistory"  title="Mostrar Historico de cambios" />
						</form>
					|-/if-|
				</td>
			</tr>
		|-/foreach-|						
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|8|-else-|7|-/if-|" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>
		|-/if-|
		|-/if-|
			<tr>
				<th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|8|-else-|7|-/if-|" class="thFillTitle">|-if $objectives|@count gt 5-|<div class="rightLink"><a href="Main.php?do=objectivesEdit" class="addNew">Agregar ##objectives,3,Objetivo##</a></div>|-/if-|</th>
			</tr>
		</tbody>
	</table>
</div>
