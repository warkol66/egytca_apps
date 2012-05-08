<h2>Tablero de Control</h2>
<h1>Administración de Procesos</h1>
<!-- Link VOLVER -->
<!-- /Link VOLVER -->
<p>A continuación se muestra la lista de procesos del sistema.</p>
<div id="div_processes">
	|-if $message eq "ok"-|
		<div class="successMessage">Proceso guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Proceso eliminado correctamente</div>
	|-/if-|
	<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-processes">
	<thead>
	<tr>
		<td colspan="7" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar procesos</a>
			<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
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
	|-if $moduleConfig.useRegions.value == "YES"-|
			<label for="filters[region]">Barrio</label>
			<select name="filters[region]">
				<option value="">Todas</option>
			|-foreach from=$regions item=regionItem name=for_regions-|
				<option value="|-$regionItem->getId()-|" |-if isset($filters.region) and $region eq $regionItem->getId()-|selected="selected"|-/if-|>|-$regionItem->getName()-|</option>
			|-/foreach-|	
			</select>
		|-/if-|
		<p><label for="filters[searchString]">Texto a buscar</label>
<input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" /></p>
		</p>
		<p><input type="checkbox" name="filters[delayed]" value="1" |-if isset($filters.delayed)-|checked="checked"|-/if-|>
			<label>Retrasados</label>
			<input type="checkbox" name="filters[ended]" value="1" |-if isset($filters.ended)-|checked="checked"|-/if-|>
			<label>Finalizados</label>
			<input type="checkbox" name="filters[working]" value="1" |-if isset($filters.working)-|checked="checked"|-/if-| />
			<label>En Ejecución</label> 
		</p>
			<input type="hidden" name="do" value="tableroProcessesList" />
			<input name="submit" type="submit" value="Aplicar filtros" />
	</form>
	<form  method="get">
			<input type="hidden" name="do" value="tableroProcessesList" />
			<input type="submit" value="Quitar Filtros" />
	</form></div>
	</td>
	</tr>
		<tr>
			<th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroProcessesEdit" class="addLink">Agregar Proceso</a></div></th>
		</tr>
		<tr>
			<th width="4%" class="thFillTitle">Id</th>
				<th width="40%" class="thFillTitle">Objetivo</th>
				<th width="40%" class="thFillTitle">Proceso</th>
				<th width="4%" class="thFillTitle">Vencimiento</th>
				<th width="4%" class="thFillTitle">Finalizado</th>
				<th width="4%" class="thFillTitle">Progreso</th>														
				<th width="4%" class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
	<tbody>|-if $processes|@count eq 0-|
		<tr>
			 <td colspan="7">|-if isset($filters)-|No hay Procesos que concuerden con la búsqueda|-else-|No hay Procesos disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$processes item=process name=for_processes-|
			<tr>
				<td class="line1">|-$process->getid()-|</td>
				<td class="line1">|-assign var="objective" value=$process->getTableroObjective()-||-$objective->getName()-|</td>
				<td class="line1">|-$process->getname()-| </td>
				<td align="center" class="line1">|-$process->getgoalExpirationDate()|date_format:"%d-%m-%Y"-|</td>
				<td align="center" class="line1">|-if $process->getfinished() eq 1-|Si|-/if-||-if $process->getfinished() eq 0-|No|-/if-|</td>
				<td class="line1">|-$process->getgoalProgress()-|</td>
				<td align="center" nowrap class="line1">
					<form action="Main.php" method="get" style="display:inline;">
					|-assign var=processDescription value=$process->getDescription()|escape-||-if $processDescription eq ''-||-assign var=processDescription value="No hay descripción disponible"-||-/if-|<input type="button" |-popup sticky=true caption="Descripción del proceso" trigger="onMouseOver" text="$processDescription" snapx=10 snapy=10-| class="icon iconInfo" />
						<input type="hidden" name="do" value="tableroProcessesEdit" />
							<input type="hidden" name="id" value="|-$process->getid()-|" />
							<input type="submit" name="submit_go_edit_process" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="tableroProcessesDoDelete" />
							<input type="hidden" name="id" value="|-$process->getid()-|" />
							<input type="submit" name="submit_go_delete_process" value="Borrar" onclick="return confirm('Seguro que desea eliminar el proceso?')" class="icon iconDelete" />
				</form>					</td>
			</tr>
		|-/foreach-|						
	|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="7" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
	|-/if-|
		<tr>
			<th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroProcessesEdit" class="addLink">Agregar Proceso</a></div></th>
		</tr>
	|-/if-|
		</tbody>
	</table>
</div>
