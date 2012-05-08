<h2>Tablero de Control</h2>
<h1>Administración de Objetivos</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p class='paragraphEdit'>A continuación se muestra la lista de Objetivos.</p>
<div id="div_objectives">
	|-if $message eq "ok"-|
		<div class="successMessage">Objetivo guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Objetivo eliminado correctamente</div>
	|-/if-|
	<table id="tabla-objectives" class='tableTdBorders' cellpadding='5' cellspacing='0' width='100%'>
		<thead>
		<tr>
			<td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|7|-else-|6|-/if-|" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="tableroObjectivesList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form><form  method="get">
				<input type="hidden" name="do" value="tableroObjectivesList" />
				<input type="submit" value="Quitar Filtros" />
		</form></div></td>
		</tr>
			<tr>
				 <th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|7|-else-|6|-/if-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroObjectivesEdit" class="addLink">Agregar Objetivo</a></div></th>
			</tr>
			<tr>
				<th width="5%" class="thFillTitle">Id</th>
				<th width="30%" class="thFillTitle">Nombre</th>
				|-if $moduleConfig.useDependencies.value =="YES"-|
				<th width="35%" class="thFillTitle">Dependencia</th>
				|-/if-|
				<th width="10%" class="thFillTitle">Fecha</th>
				<th width="10%" class="thFillTitle">Fecha de Expiración</th>
				<th width="5%" class="thFillTitle">Logrado</th>
				<th width="5%" class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $objectives|@count eq 0-|
			<tr>
				 <td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|7|-else-|6|-/if-|">|-if isset($filters)-|No hay Objetivos que concuerden con la búsqueda|-else-|No hay Objetivos disponibles|-/if-|</td>
			</tr>
		|-else-|
		|-foreach from=$objectives item=objective name=for_objectives-|
			<tr>
				<td>|-$objective->getid()-|</td>
				<td>|-$objective->getname()-|</td>
				|-if $moduleConfig.useDependencies.value =="YES"-|
				|-assign var=affiliate value=$objective->getAffiliate()-|
				<td>|-$affiliate->getName()-|</td>
				|-/if-|
				<td nowrap>|-$objective->getdate()|change_timezone|date_format-|</td>
				<td nowrap>|-$objective->getexpirationDate()|change_timezone|date_format-|</td>
				<td align="center">|-if $objective->getachieved() eq 0-|No|-/if-||-if $objective->getachieved() eq 1-|Si|-/if-|</td>
				<td nowrap>
|-if $objective->getDescription() neq ''-|
	|-assign var=objectiveDescription value=$objective->getDescription()|escape:'html'-|
	|-assign var=objectiveDescription value="<strong>Descripción:</strong> $objectiveDescription<br />"-|
	|-assign var=class value="buttonImageInfo"-|
|-else-|
	|-assign var=objectiveDescription value="<strong>Descripción:</strong> No hay descripción disponible<br />"-|
	|-assign var=class value="buttonImageInfoDisabled"-|
|-/if-|   <input type="button" |-popup sticky=true caption="Descripción del Objetivo" trigger="onMouseOver" text="$objectiveDescription" snapx=10 snapy=10-| class="|-$class-|" />
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="tableroObjectivesEdit" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_edit_objective" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="tableroObjectivesDoDelete" />
						<input type="hidden" name="id" value="|-$objective->getid()-|" />
						<input type="submit" name="submit_go_delete_objective" value="Borrar" onclick="return confirm('Seguro que desea eliminar el objetivo?')" class="icon iconDelete" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="|-if $moduleConfig.useDependencies.value =="YES"-|7|-else-|6|-/if-|" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>
		|-/if-|
			<tr>
				<th colspan="|-if $moduleConfig.useDependencies.value =="YES"-|7|-else-|6|-/if-|" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroObjectivesEdit" class="addLink">Agregar Objetivo</a></div></th>
			</tr>
		|-/if-|
		</tbody>
	</table>
</div>
