<h2>##blog,1,Blog##</h2>
<h1>Administración de  Categoría de Entradas</h1>
<p>A continuación podrá editar la lista de categorías de entradas del blog del sistema.</p>
<div id="div_categories"> |-if $message eq "ok"-|
	<div class="successMessage">Categoría guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Categoría eliminada correctamente</div>
	|-/if-|
	<table border="0" cellpadding="5" cellspacing="0"  class='tableTdBorders' id="tabla-categories">
		<thead>
			<tr>
				<td colspan="3" class="tdSearch"><div><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar</a></div>
					<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
						<form action='Main.php' method='get' style="display:inline;">
							<input type="hidden" name="do" value="blogCategoriesList" />
							Nombre:
							<input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
							&nbsp;&nbsp;
							<input type='submit' value='Buscar' class='tdSearchButton' />
						</form>
						<form  method="get">
							<input type="hidden" name="do" value="blogCategoriesList" />
							<input type="submit" value="Quitar Filtros" />
						</form>
					</div></td>
			</tr>
			<tr>
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=blogCategoriesEdit" class="addNew">Agregar Categoría</a></div></th>
			</tr>
			<tr>
<!--				<th width="5%" class="thFillTitle">Id</th> -->
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
<!--			<td>|-$category->getId()-|</td> -->
			<td>|-$category->getName()-|</td>
			<td>|-if $category->getTreeLevel() > 0-||-$category->getParentName()-||-/if-|</td>
			<td nowrap><form action="Main.php" method="get" style="display:inline;">
					<input type="hidden" name="do" value="blogCategoriesEdit" />
					<input type="hidden" name="id" value="|-$category->getid()-|" />
					<input type="submit" name="submit_go_edit_category" value="Editar" class="iconEdit" title="Editar" />
				</form>
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="blogCategoriesDoDelete" />
					<input type="hidden" name="id" value="|-$category->getid()-|" />
					<input type="submit" name="submit_go_delete_category" value="Borrar" title="Borrar" onclick="return confirm('|-if $category->hasChildren() ne 0-|Atención: Al eliminar una categoría que contiene otras categorías asociadas, se eliminarán las mismas, al igual que la categoría seleccionada. |-/if-|Confirme que desea eliminar la categoría?')" class="iconDelete" />
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
			<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=blogCategoriesEdit" class="addNew">Agregar Categoría</a></div></th>
		</tr>
		|-/if-|
		</tbody>
		
	</table>
</div>
