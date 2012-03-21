<div id="div_products">	
	<div id="messageCart" style="position:fixed; right: 50px; top: 5px;">
	</div>
	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-products"> 
		<COL>
		<COL>
		<COL id="description" class="colCollapse">
		<thead> 
		<tr>
			<td colspan="7" class="tdSearch"><form action="Main.php" method="get">
			<p>
			<label for="filters[categoryId]">Ver</label> 
				<select name="filters[categoryId]" id="categoryId" onchange="this.form.submit();">
					<option value="all" |-"all"|selected:$filters.categoryId-|>Todas</option> 
						|-include file="CatalogProductCategoriesIncludeOptions.tpl" productCategories=$productCategories-|
					<option value="" |-""|selected:$filters.categoryId-|>Sin categoría</option> 
				</select> </p>
<a href="javascript:void(null);" onClick='switch_vis("divSearch");' class="tdTitSearch">Búsqueda avanzada</a><div id="divSearch" style="display:|-if $filters.searchString ne ""-|block|-else-|none|-/if-|;">
		 
		<p><label for="filters[searchString]">Texto</label>
		<input name="filters[searchString]" type="text" value="|-$filters.searchString-|" size="50" />
		</p>
		<input type="hidden" name="do" value="catalogShow" />
		<input name="filter" type="submit" value="Aplicar filtros" />
		|-if $filters|@count gt 0-|
			<input type="button" value="Quitar Filtros" onClick="location.href='Main.php?do=catalogShow'" />
	|-/if-|</div>
	</form></td>
		</tr> 
	|-if $pager->getLastPage() gt 1-|
		<tr>
			<td colspan="7" class="pages">|-include file="PaginateNumberedInclude.tpl"-|</td>
		</tr> 
	|-/if-|
			<tr> 
				<th width="5%">Código</th> 
				<th width="35%">Nombre</th> 
				<th width="40%">Descripción</th> 
				<th width="5%">Precio Unitario</th> 
				<th width="5%">Unidad de Venta</th>
				<th width="5%">Precio</th>
				<th width="5%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>  |-foreach from=$products item=product name=for_products-|
		<tr>
			<td nowrap align="right">|-$product->getCode()-|</td>
			<td> <a href="#lightbox1" rel="lightbox1" class="lbOn"><input type="button" class="icon iconPhoto" onClick='{new Ajax.Updater("productsShowDiv", "Main.php?do=catalogProductImageViewX&id=|-$product->getid()-|", { method: "post", parameters: { id: "|-$product->getId()-|"}, evalScripts: true})};$("catalogShowWorking").innerHTML = "<span class=\"inProgress\">buscando imagen ...</span>";' value="Ver imagen" name="submit_go_show_picture" /></a> |-$product->getName()-|</td>
			<td>|-$product->getDescription()-|</td>
			<td nowrap align="right">|-if $product->getPrice() neq 0-||-$product->getPrice()|number_format:2:",":"."-||-/if-|</td>
			<td nowrap align="right">|-$product->getSalesUnit()-|</td>
			<td nowrap align="right">|-if $product->getPrice() neq 0-||-math equation="x * y" x=$product->getPrice() y=$product->getSalesUnit() assign=totalItem-||-$totalItem|number_format:2:",":"."-||-/if-|</td>
			<td nowrap>

|-if $product->getPrice() neq 0-|
				<form>
					<input type="text" name="quantity" value="0" size="3" />
					<input type="hidden" name="productCode" value="|-$product->getCode()-|" />
					<input type="hidden" name="do" value="ordersAddItemToCartX" />
					<input type="button" value="Agregar" class="icon iconAddToCart" onclick="javascript:ordersAddItemToCartX(this.form)" />
				</form>|-/if-|
			</td>
		</tr>
		|-foreachelse-|
		<tr>
			<td colspan="7">Sin Productos</td>
		</tr>
		|-/foreach-|
	|-if $pager->getLastPage() gt 1-|
		<tr>
			<td colspan="7" class="pages">|-include file="PaginateNumberedInclude.tpl"-|</td>
		</tr> 
	|-/if-|
		</tbody> 
	</table> 
</div>
