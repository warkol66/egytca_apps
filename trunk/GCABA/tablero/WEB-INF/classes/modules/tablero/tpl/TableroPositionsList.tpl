<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración de Cargos
<!-- /Link VOLVER -->
</h1>
<p>A continuación podrá editar la lista de cargos del sistema.</p>
<div id="div_positions">
	|-if $message eq "ok"-|
		<div class="successMessage">Cargo guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Cargo eliminada correctamente</div>
	|-/if-|
	<table border="0" cellpadding="5" cellspacing="0"  class='tableTdBorders' id="tabla-positions">
		<thead>
		<tr>
			<td colspan="5" class="tdSearch"><div><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar</a></div>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="tableroPositionsList" />
					Por tipo<select id="filters[type]" name="filters[type]" title="type">
				<option value="0">Seleccione el tipo</option>
			|-foreach from=$positionTypes key=typeKey item=type name=for_type-|
        <option value="|-$typeKey-|" |-if $typeKey eq $filters.type-|selected="selected" |-/if-|>|-$type-|</option> 
			|-/foreach-|
      </select>
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form><form  method="get">
				<input type="hidden" name="do" value="tableroPositionsList" />
				<input type="submit" value="Quitar Filtros" />
		</form></div></td>
		</tr>
			<tr>
				 <th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroPositionsEdit" class="addLink">Agregar Cargo</a></div></th>
			</tr>
			<tr class="thFillTitle">
				<th width="5%">Id</th>
				<th width="30%">Nombre</th>
				<th width="30%">Tipo</th>
				<th width="30%">Depende   de</th>
				<th width="5%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $positions|@count eq 0-|
			<tr>
				 <td colspan="5">|-if isset($filters)-|No hay cargos que concuerden con la búsqueda|-else-|No hay Cargos disponibles|-/if-|</td>
			</tr>
		|-else-|
		|-foreach from=$positions item=position name=for_positions-|
			<tr>
				<td class="line1">|-$position->getid()-|</td>
				<td class="line1">|-$position->getname()-|</td>
				<td class="line1">|-$position->getPositionTypeTranslated()-|</td>
				<td class="line1">|-$position->getParentName()-|</td>
				<td class="line1" nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="tableroPositionsEdit" />
						<input type="hidden" name="id" value="|-$position->getid()-|" />
						<input type="submit" name="submit_go_edit_position" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="tableroPositionsDoDelete" />
						<input type="hidden" name="id" value="|-$position->getid()-|" />
						<input type="submit" name="submit_go_delete_position" value="Borrar" onclick="return confirm('Seguro que desea eliminar el cargo?')" class="icon iconDelete" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="5" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|
			<tr>
				 <th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroPositionsEdit" class="addLink">Agregar Cargo</a></div></th>
			</tr>
		|-/if-|
		</tbody>
	</table>
</div>
