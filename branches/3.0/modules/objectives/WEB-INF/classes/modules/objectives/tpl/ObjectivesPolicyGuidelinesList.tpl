<h2>Tablero de Gestión</h2>
<h1>Administración de ##objectives,4,Ejes de Gestión##</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de ##objectives,4,Ejes de Gestión##.</p>
<div id="div_guidelines">
	|-if $message eq "ok"-|
		<div class="successMessage">##objectives,1,Eje de Gestión## guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">##objectives,1,Eje de Gestión## eliminado correctamente</div>
	|-/if-|
	<table id="tabla-guidelines" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
		<tr>
			<td colspan="|-if $configModule->get('global','applicationName') eq 'wb'-|7|-else-|4|-/if-|" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="objectivesPolicyGuidelinesList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>|-if $filters|@count gt 0-|<form  method="get">
				<input type="hidden" name="do" value="objectivesPolicyGuidelinesList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="|-if $configModule->get('global','applicationName') eq 'wb'-|7|-else-|4|-/if-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=objectivesPolicyGuidelinesEdit" class="addNew">Agregar ##objectives,1,Eje de Gestión##</a></div></th>
			</tr>
			<tr class="thFillTitle">
				<th width="1%">&nbsp;</th> 
				<th width="25%">##objectives,1,Ejes de Gestión##</th>
				<th width="55%">Descripción</th>
    |-if $configModule->get("global","applicationName") eq "wb"-|
				<th width="5%">Inicio</th>
				<th width="5%">Fin</th>
				<th width="5%">Tasa cambio</th>|-/if-|
				<th width="5%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $guidelines|@count eq 0-|
			<tr>
				 <td colspan="|-if $configModule->get('global','applicationName') eq 'wb'-|7|-else-|4|-/if-|">|-if isset($filters)-|No hay ##objectives,4,Ejes de Gestión## que concuerden con la búsqueda|-else-|No hay ##objectives,4,Ejes de Gestión## disponibles|-/if-|</td>
			</tr>
		|-else-|
		|-foreach from=$guidelines item=guideline name=for_guidelines-|
			<tr>
				<td><img src="images/clear.png" class="gauge|-$guideline->getSpeedClass()-|"></td> 
				<td><a href="Main.php?do=objectivesStrategicObjectivesList&filters[guideline]=|-$guideline->getid()-|&filters[fromGuidelines]=true" title="Ver ##objectives,5,Objetivos Etratégicos##" class="follow">|-$guideline->getName()-|</a></td>
				<td>|-$guideline->getDescription()-|</td>
				|-if $configModule->get('global','applicationName') eq 'wb'-|<td>|-$guideline->getStartingYear()-|</td>
				<td>|-$guideline->getEndingYear()-|</td>
				<td>|-if $guideline->getExchangeRate() neq 0-||-$guideline->getExchangeRate()|system_numeric_format:2-||-/if-|</td>|-/if-|
				<td nowrap>
					|-if $guideline->hasAnyDisbursementIndicator()-|
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="indicatorsView" />
						<input type="hidden" name="id" value="|-$guideline->getid()-|" />
						<input type="hidden" name="entity" value="PolicyGuideline" />
						<input type="submit" name="submit_go_view_project_graph" value="Ver Curva de Desembolsos" class="icon iconGraph" title="Ver Curva de Desembolsos" />
					</form>
					|-/if-|
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="objectivesPolicyGuidelinesEdit" />
						<input type="hidden" name="id" value="|-$guideline->getid()-|" />
						|-if $pager->getPage() gt 1-|<input type="hidden" name="filters[currentPage]" value="|-$pager->getPage()-|" />|-/if-|
						<input type="submit" name="submit_go_edit_guideline" value="Editar" title="Editar ##objectives,1,Eje de Gestión##" class="icon iconEdit" />
					</form>
					|-if $loginUser->isAdmin() || $loginUser->isSupervisor()-|
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="objectivesPolicyGuidelinesDoDelete" />
						<input type="hidden" name="id" value="|-$guideline->getid()-|" />
						<input type="hidden" name="filters[currentPage]" value="|-$pager->getPage()-|" />
						<input type="submit" name="submit_go_delete_guideline" value="Borrar" title="Eliminar ##objectives,1,Eje de Gestión##" onclick="return confirm('Seguro que desea eliminar el ##objectives,1,Eje de Gestión##?')" class="icon iconDelete" />
					</form>
					|-/if-|
				</td>
			</tr>
		|-/foreach-|						
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="|-if $configModule->get('global','applicationName') eq 'wb'-|7|-else-|4|-/if-|" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>
		|-/if-|							
		|-/if-|
			<tr>
				 <th colspan="|-if $configModule->get('global','applicationName') eq 'wb'-|7|-else-|4|-/if-|" class="thFillTitle">|-if $guidelines|@count gt 5-|<div class="rightLink"><a href="Main.php?do=objectivesPolicyGuidelinesEdit" class="addNew">Agregar ##objectives,1,Eje de Gestión##</a></div>|-/if-|</th>
			</tr>
		</tbody>
	</table>
</div>
