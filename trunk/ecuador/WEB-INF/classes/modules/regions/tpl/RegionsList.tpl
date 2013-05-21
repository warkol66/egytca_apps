<h2>##common,18,Configuración del Sistema##</h2>
<h1>Administración de Regiones</h1>
<!-- /Link VOLVER -->
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
			<td colspan="7" class="tdSearch"><div><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar</a></div>
				<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;"><form action='Main.php' method='get' style="display:inline;">
					<input type="hidden" name="do" value="regionsList" />
					Por tipo<select id="filters[type]" name="filters[type]" title="type">
				<option value="0">Seleccione el tipo</option>
			|-foreach from=$regionTypes key=typeKey item=type name=for_type-|
				|-if $typeKey gt $configModule->get("regions","treeRootType")-|
        <option value="|-$typeKey-|" |-if $typeKey eq $filters.type-|selected="selected" |-/if-|>|-$type-|</option> 
				|-/if-|
			|-/foreach-|
      </select>
					Nombre: <input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
					&nbsp;Código Postal: <input name="filters[postalCode]" type="text" value="|-if isset($filters.postalCode)-||-$filters.postalCode-||-/if-|" size="8" />
					&nbsp;&nbsp;<input type='submit' value='Buscar' class='tdSearchButton' />
			</form>|-if $filters|@count gt 0-|<form  method="get">
				<input type="hidden" name="do" value="regionsList" />
				<input type="submit" value="Quitar Filtros" />
		</form>|-/if-|</div></td>
		</tr>
			<tr>
				 <th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=regionsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Región</a></div></th>
			</tr>
			<tr class="thFillTitle">
				<th width="22%">Nombre</th>
				<th width="10%">Tipo</th>
				<th width="6%">Área (Km2)</th>
				<th width="6%">Población</th>
				<th width="22%">Capital</th>
				<th width="22%">Dentro de</th>
				<th width="3%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>|-if $regionColl|@count eq 0-|
			<tr>
				 <td colspan="7">|-if isset($filters)-|No hay regiones que concuerden con la búsqueda|-else-|No hay Regiones disponibles|-/if-|</td>
			</tr>
		|-else-|
		|-foreach from=$regionColl item=region name=for_regions-|
			<tr>
				<td>|-$region->getname()-|</td>
				<td>|-$region->getRegionTypeTranslated()-|</td>
				<td align="right">|-$region->getArea()|system_numeric_format:0-|</td>
				<td align="right">|-$region->getPopulation()|system_numeric_format:0-|</td>
				<td>|-$region->getCapital()-|</td>
				<td>|-$region->getParentName()-|</td>
				<td nowrap>
					<form action="Main.php" method="get" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="regionsEdit" />
						<input type="hidden" name="id" value="|-$region->getid()-|" />
						<input type="submit" name="submit_go_edit_region" value="Editar" class="icon iconEdit" />
					</form>
					<form action="Main.php" method="post" style="display:inline;">
						|-include file="FiltersRedirectInclude.tpl" filters=$filters-|
						|-if isset($pager) && ($pager->getPage() ne 1)-| <input type="hidden" name="page" id="page" value="|-$pager->getPage()-|" />|-/if-|
						<input type="hidden" name="do" value="regionsDoDelete" />
						<input type="hidden" name="id" value="|-$region->getid()-|" />
						<input type="submit" name="submit_go_delete_region" value="Borrar" onclick="return confirm('¿Seguro que desea eliminar el barrio?')" class="icon iconDelete" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if isset($pager) && $pager->haveToPaginate()-|
		<tr> 
			<td colspan="7" class="pages">|-include file="ModelPagerInclude.tpl"-|</td> 
		</tr>
		|-/if-|
			<tr>
				 <th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=regionsEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Región</a></div></th>
			</tr>
		|-/if-|
		</tbody>
	</table>
</div>
