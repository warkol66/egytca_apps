<script type="text/javascript" src="scripts/lightbox.js"></script> 			
<div id="lightbox1" class="leightbox">
	<p align="right">				
		<a href="#" class="lbAction blackNoDecoration" rel="deactivate">Cerrar formulario <input type="button" class="icon iconDelete" /></a> 
	</p> 
	<div id="objectivesShowWorking"></div>
	<div class="innerLighbox">
		<div id="objectivesShowDiv"></div>
	</div>
</div> 
<h2>Tablero de Gestión</h2>
<h1>Administración de ##objectives,5,Objetivos Etratégicos##</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de ##objectives,5,Objetivos Etratégicos##.</p>
|-if is_object($parentObject)-|
<object title="|-$parentObject->getName()-|" height="120" width="120">
	<param name="movie" value="images/speedometer.swf">
	<embed src="images/speedometer.swf" wmode="transparent" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" flashvars="var3=|-$parentObject->getSpeed()-|" height="120" width="120" /></object>      
<div id="navBar">|-include file="NavigationParentInclude.tpl" object=$parentObject first="true"-| |-$parentObject->getName()-|</div>|-/if-|
<div id="div_objectives">
	|-if $message eq "ok"-|
		<div class="successMessage">##objectives,2,Objetivo Etratégico## guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">##objectives,2,Objetivo Etratégico## eliminado correctamente</div>
	|-/if-|
	<table id="tabla-objectives" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
		<tr>
			<td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|5|-else-|4|-/if-|" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0 && !($filters.fromGuidelines)-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="objectivesStrategicObjectivesList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>|-if $filters|@count gt 0-|<form  method="get">
				<input type="hidden" name="do" value="objectivesStrategicObjectivesList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|5|-else-|4|-/if-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=objectivesStrategicObjectivesEdit" class="addLink">Agregar ##objectives,2,Objetivo Etratégico##</a></div></th>
			</tr>
			<tr class="thFillTitle">
				<!--<th width="5%">Id</th>-->
				<th width="15%">##objectives,1,Eje de Gestión##</th>
				<th width="1%">&nbsp;</th>
				<th width="35%">##objectives,2,Objetivo Etratégico##</th>
				|-if $moduleConfig.useDependencies.value =="YES"-|
				<th width="35%">Dependencia</th>
				|-/if-|
				<th width="5%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $objectives|@count eq 0-|
			<tr>
				 <td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|5|-else-|4|-/if-|">|-if isset($filters)-|No hay ##objectives,2,Objetivo Etratégico## que concuerden con la búsqueda|-else-|No hay ##objectives,2,Objetivo Etratégico## disponibles|-/if-|</td>
			</tr>
		|-else-|
		|-foreach from=$objectives item=objective name=for_objectives-|
			<tr>
				<!--<td>|-$objective->getid()-|</td>-->
				<td>|-$objective->getPolicyGuideline()-|</td>
				<td><img src="images/clear.png" class="gauge|-$objective->getSpeedClass()-|"></td> 
				<td><a href="Main.php?do=objectivesList&filters[strategicObjective]=|-$objective->getid()-|&filters[fromStrategicObjectives]=true" title="Ver ##objectives,6,Objetivos## del ##objectives,2,Objetivo Etratégico##" class="follow">|-$objective->getName()-|</a></td>
				|-if $moduleConfig.useDependencies.value =="YES"-|
				|-assign var=affiliate value=$objective->getAffiliate()-|
				<td>|-$affiliate->getName()-|</td>
				|-/if-|
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="objectivesStrategicObjectivesViewX" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconView" onClick='{new Ajax.Updater("objectivesShowDiv", "Main.php?do=objectivesStrategicObjectivesViewX&id=|-$objective->getid()-|", { method: "post", parameters: { id: "|-$objective->getId()-|"}, evalScripts: true})};$("objectivesShowWorking").innerHTML = "<span class=\"inProgress\">buscando ##objectives,3,Objetivo##...</span>";' value="Ver detalle" name="submit_go_show_objective" title="Ver detalle" /></a>
					</form>
					|-if $objective->hasAnyDisbursementIndicator()-|
				<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="indicatorsView" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="hidden" name="entity" value="StrategicObjective" />
						<input type="submit" name="submit_go_view_project_graph" value="Ver Curva de Desembolsos" class="icon iconGraph" title="Ver Curva de Desembolsos" />
					</form>
					|-/if-|
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="objectivesStrategicObjectivesEdit" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						|-if $pager->getPage() gt 1-|<input type="hidden" name="filters[currentPage]" value="|-$pager->getPage()-|" />|-/if-|
						<input type="submit" name="submit_go_edit_objective" value="Editar" class="icon iconEdit" title="Editar" />
					</form>
					
					|-if $objective->getLogCount() gt 0 && ($loginUser->isAdmin() || $loginUser->isSupervisor())-|
						<form action="Main.php" method="get" style="display:inline;">
							<input type="hidden" name="do" value="objectivesStrategicObjectivesShowHistory" />
							<input type="hidden" name="id" value="|-$objective->getid()-|" />
							<input type="submit" name="submit_go_show_objective_history" value="Mostrar Historico de cambios" title="Mostrar Historico de cambios" class="icon iconHistory"  title="Mostrar Historico de cambios" />
						</form>
					|-/if-|
					
					|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="objectivesStrategicObjectivesDoDelete" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="hidden" name="filters[currentPage]" value="|-$pager->getPage()-|" />
						<input type="submit" name="submit_go_delete_objective" value="Borrar" title="Borrar" onclick="return confirm('Seguro que desea eliminar el ##objectives,2,Objetivo Etratégico##?')" class="icon iconDelete" />
					</form>
					|-/if-|
				</td>
			</tr>
		|-/foreach-|						
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|5|-else-|4|-/if-|" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>
		|-/if-|
		|-/if-|
			<tr>
				<th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|5|-else-|4|-/if-|" class="thFillTitle">|-if $objectives|@count gt 5-|
				  <div class="rightLink"><a href="Main.php?do=objectivesStrategicObjectivesEdit" class="addLink">Agregar ##objectives,2,Objetivo Etratégico##</a></div>|-/if-|</th>
			</tr>
		</tbody>
	</table>
</div>
