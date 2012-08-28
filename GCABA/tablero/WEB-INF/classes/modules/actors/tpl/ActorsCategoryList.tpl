<h2>##actors,1,Actores##</h2>
<h1>Administración de Categorías de ##actors,1,Actores##</h1>
	<!-- /Link VOLVER -->
<p>A continuación podrá editar la lista de categorías de ##actors,1,Actores## del sistema.</p>
<div id="div_indicators"> |-if $message eq "ok"-|
	<div class="successMessage">Categoría guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Categoría eliminada correctamente</div>
	|-/if-|
	<table border="0" cellpadding="5" cellspacing="0" class='tableTdBorders' id="tabla-indicators" width="100%">
		<thead>
			<tr>
				<td colspan="3" class="tdSearch"><div><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar</a></div>
					<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
						<form action='Main.php' method='get' style="display:inline;">
							<input type="hidden" name="do" value="actorsCategoryList" />
							Nombre:
							<input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
							&nbsp;&nbsp;
							<input type='submit' value='Buscar' class='tdSearchButton' />
						</form>
						<form  method="get">
							<input type="hidden" name="do" value="actorsCategoryList" />
							|-if isset($filters.searchString)-|<input type="submit" value="Quitar Filtros" onClick="location.href='Main.php?do=actorsCategoryList'" />|-/if-|
						</form>
					</div></td>
			</tr>
			<tr>
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=actorsCategoryEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Categoría</a></div></th>
			</tr>
			<tr>
				<th width="60%" class="thFillTitle">Nombre</th>
				<th width="30%" class="thFillTitle">Dentro de </th>
				<th width="5%" class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-if $categories|@count eq 0-|
		<tr>
			<td colspan="3">|-if isset($filters)-|No hay categorías que concuerden con la búsqueda|-else-|No hay categorías disponibles|-/if-|</td>
		</tr>
		|-else-|
		|-foreach from=$categories item=category name=for_categories-|
		<tr>
	<!--		<td>|-$category->getId()-|</td> -->
			<td>|-$category->getName()-|</td>
			<td>|-if $category->getTreeLevel() > 0-||-$category->getParentName()-||-/if-|</td>
			<td nowrap><form action="Main.php" method="get" style="display:inline;">
					<input type="hidden" name="do" value="actorsCategoryEdit" />
					<input type="hidden" name="id" value="|-$category->getid()-|" />
					<input type="submit" name="submit_go_edit_indicator" value="Editar" class="icon iconEdit" title="Editar" />
				</form>
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="actorsCategoryDoDelete" />
					<input type="hidden" name="id" value="|-$category->getid()-|" />
					<input type="submit" name="submit_go_delete_indicator" value="Borrar" title="Borrar" onclick="return confirm('|-if $category->hasChildren() ne 0-|Atención: Al eliminar una categoría que contiene otras categorías asociadas, se eliminarán las mismas, al igual que la categoría seleccionada. |-/if-|¿Está seguro que desea eliminar la categoría?')" class="icon iconDelete" />
				</form>
			</td>
		</tr>
		|-/foreach-|						
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
		<tr>
			<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td>
		</tr>
		|-/if-|
		<tr>
			<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=actorsCategoryEdit|-include file="FiltersRedirectUrlInclude.tpl" filters=$filters-||-if isset($pager) && ($pager->getPage() ne 1)-|&page=|-$pager->getPage()-||-/if-|" class="addLink">Agregar Categoría</a></div></th>
		</tr>
		|-/if-|
		</tbody>
		
	</table>
</div>
