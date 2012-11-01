<h2>##blog,1,Blog##</h2>
<h1>Administración de Etiqueta de Entradas</h1>
<p>A continuación podrá editar la lista de etiquetas de entradas del blog del sistema.</p>
<div id="div_tags"> |-if $message eq "ok"-|
	<div class="successMessage">Etiqueta guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Etiqueta eliminada correctamente</div>
	|-/if-|
	<table border="0" cellpadding="5" cellspacing="0"  class='tableTdBorders' id="tabla-tags">
		<thead>
			<tr>
				<td colspan="3" class="tdSearch"><div><a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Buscar</a></div>
					<div id="divSearch" style="display:|-if $filters|@count gt 0-|block|-else-|none|-/if-|;">
						<form action='Main.php' method='get' style="display:inline;">
							<input type="hidden" name="do" value="blogTagsList" />
							Nombre:
							<input name="filters[searchString]" type="text" value="|-if isset($filters.searchString)-||-$filters.searchString-||-/if-|" size="30" />
							&nbsp;&nbsp;
							<input type='submit' value='Buscar' class='tdSearchButton' />
						</form>
						<form  method="get">
							<input type="hidden" name="do" value="blogTagsList" />
							<input type="submit" value="Quitar Filtros" />
						</form>
					</div></td>
			</tr>
			<tr>
				<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=blogTagsEdit" class="addNew">Agregar Etiqueta</a></div></th>
			</tr>
			<tr class="thFillTitle">
<!--				<th width="5%" class="thFillTitle">Id</th> -->
				<th width="60%">Nombre</th>
				<th width="30%">Entradas (publicadas)</th>
				<th width="5%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-if $tags|@count eq 0-|
		<tr>
			<td colspan="3">|-if isset($filters)-|No hay etiquetas que concuerden con la búsqueda|-else-|No hay etiquetas disponibles|-/if-|</td>
		</tr>
		|-else-|
		|-foreach from=$tags item=tag name=for_tags-|
		<tr>
<!--			<td>|-$tag->getId()-|</td> -->
			<td>|-$tag->getName()-|</td>
			<td>|-$tag->countBlogEntrys()-| (|-$tag->getPublishedEntries()-|)</td>
			<td nowrap><form action="Main.php" method="get" style="display:inline;">
					<input type="hidden" name="do" value="blogTagsEdit" />
					<input type="hidden" name="id" value="|-$tag->getid()-|" />
					<input type="submit" name="submit_go_edit_tag" value="Editar" class="icon iconEdit" title="Editar" />
				</form>
				<form action="Main.php" method="post" style="display:inline;">
					<input type="hidden" name="do" value="blogTagsDoDelete" />
					<input type="hidden" name="id" value="|-$tag->getid()-|" />
					<input type="submit" name="submit_go_delete_tag" value="Borrar" title="Borrar" onclick="return confirm('Confirme que desea eliminar la etiqueta?')" class="icon iconDelete" />
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
			<th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=blogTagsEdit" class="addNew">Agregar Etiqueta</a></div></th>
		</tr>
		|-/if-|
		</tbody>
		
	</table>
</div>
