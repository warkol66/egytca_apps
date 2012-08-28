<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración de Regiones
<!-- /Link VOLVER -->
</h1>
<p>A continuación podrá editar la lista de regiones del sistema.</p>
<div id="div_regions">
	|-if $message eq "ok"-|
		<div class="successMessage">Región guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Región eliminada correctamente</div>
	|-/if-|
	<table border="0" cellpadding="5" cellspacing="0"  class='tableTdBorders' id="tabla-regions">
		<thead>
		<tr>
			<td colspan="5" class="tdSearch"><div><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar</a></div>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="regionsTimezoneList" />
					Por tipo<select id="filters[type]" name="filters[type]" title="type">
				<option value="0">Seleccione el tipo</option>
			|-foreach from=$regionTypes key=typeKey item=type name=for_type-|
        <option value="|-$typeKey-|" |-if $typeKey eq $filters.type-|selected="selected" |-/if-|>|-$type-|</option> 
			|-/foreach-|
      </select>
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form><form  method="get">
				<input type="hidden" name="do" value="regionsTimezoneList" />
				<input type="submit" value="Quitar Filtros" />
		</form></div></td>
		</tr>
			<tr>
				 <th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=regionsTimezoneEdit" class="addLink">Agregar Región</a></div></th>
			</tr>
			<tr>
				<th width="5%" class="thFillTitle">Id</th>
				<th width="30%" class="thFillTitle">Nombre</th>
				<th width="30%" class="thFillTitle">Código</th>
				<th width="30%" class="thFillTitle">Dentro de</th>
				<th width="5%" class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $regionstimezone|@count eq 0-|
			<tr>
				 <td colspan="5">|-if isset($filters)-|No hay regiones que concuerden con la búsqueda|-else-|No hay Regiones disponibles|-/if-|</td>
			</tr>
		|-else-|
		|-foreach from=$regionstimezone item=region name=for_regions-|
			<tr>
				<td class="line1">|-$region->getid()-|</td>
				<td class="line1">|-$region->getLabel()-|</td>
				<td class="line1">|-$region->getname()-|</td>
				<td class="line1">|-$region->getParentName()-|</td>
				<td class="line1" nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						<input type="hidden" name="do" value="regionsTimezoneEdit" />
						<input type="hidden" name="id" value="|-$region->getid()-|" />
						<input type="submit" name="submit_go_edit_region" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						<input type="hidden" name="do" value="regionsTimezoneDoDelete" />
						<input type="hidden" name="id" value="|-$region->getid()-|" />
						<input type="submit" name="submit_go_delete_region" value="Borrar" onclick="return confirm('¿Seguro que desea eliminar el barrio?')" class="icon iconDelete" />
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
				 <th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=regionsTimezoneEdit" class="addLink">Agregar Región</a></div></th>
			</tr>
		|-/if-|
		</tbody>
	</table>
</div>
