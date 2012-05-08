<h2>Configuración de Tablero de Control</h2>
<h1>Administrar Unidades de Medida</h1>
<div id="div_measureunits">
	|-if $message eq "ok"-|
		<div class="successMessage">Unidades de Medida guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Unidades de Medida eliminada correctamente</div>
	|-/if-|
	<table width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders' id="tabla-measureunits">
		<thead>
		<tr>
			<td colspan="5" class="tdSearch"><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Busqueda por nombre</a>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="tableroMeasureUnitsList" />
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
				</form>
				<form  method="get">
				<input type="hidden" name="do" value="tableroMeasureUnitsList" />
				<input type="submit" value="Quitar Filtros" />
		</form>
</div></td>
		</tr>
			<tr> 
				<th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroMeasureUnitsEdit|-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Unidad de Medida</a></div></th> 
			</tr> 
			<tr>
				<th>Id</th>
				<th>Nunidad de Medida</th>
				<th>Abreviatura</th>
				<th>Formato</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
	<tbody>|-if $measureunits|@count eq 0-|
		<tr>
			 <td colspan="5">|-if isset($filters)-|No hay Unidades de medida que concuerden con la búsqueda|-else-|No hay Unidades de medida disponibles|-/if-|</td>
		</tr>
	|-else-|
		|-foreach from=$measureunits item=measureunit name=for_measureunits-|
			<tr>
				<td>|-$measureunit->getId()-|</td>
				<td>|-$measureunit->getName()-|</td>
				<td>|-$measureunit->getAbbreviation()-|</td>
				<td>|-$measureunit->getFormat()-|</td>
				<td>
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="tableroMeasureUnitsEdit" />
					|-if isset($pager) && ($pager->getPage() ne 1)-|
						<input type="hidden" name="page" value="|-$pager->getPage()-|" id="page">
					|-/if-|
						<input type="hidden" name="id" value="|-$measureunit->getid()-|" />
						<input type="submit" name="submit_go_edit_measureunit" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="tableroMeasureUnitsDoDelete" />
					|-if isset($pager) && ($pager->getPage() ne 1)-|
						<input type="hidden" name="page" value="|-$pager->getPage()-|" id="page">
					|-/if-|
						<input type="hidden" name="id" value="|-$measureunit->getid()-|" />
						<input type="submit" name="submit_go_delete_measureunit" value="Borrar" onclick="return confirm('Seguro que desea eliminar la unidad de medida?')" class="icon iconDelete" />
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
				<th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=tableroMeasureUnitsEdit|-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Unidad de Medida</a></div></th> 
			</tr> 
	|-/if-|
		</tbody>
	</table>
</div>
