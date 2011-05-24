<div id="div_products">	
	<div id="messageCart" style="position:fixed; right: 50px; top: 5px;">
	</div>
	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-products"> 
		<COL>
		<COL>
		<COL id="description" class="colCollapse">
		<thead> 
		<tr>
			<td colspan="7" class="pages">|-include file="PaginateNumberedInclude.tpl"-|</td>
		</tr> 
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
			<td>|-$product->getName()-|</td>
			<td>|-$product->getDescription()-|</td>
			<td nowrap align="right">|-if $product->getPrice() neq 0-||-$product->getPrice()|number_format:2:",":"."-||-/if-|</td>
			<td nowrap align="right">|-$product->getSalesUnit()-|</td>
			<td nowrap align="right">|-if $product->getPrice() neq 0-||-math equation="x * y" x=$product->getPrice() y=$product->getSalesUnit() assign=totalItem-||-$totalItem|number_format:2:",":"."-||-/if-|</td>
			<td nowrap>|-if $product->getPrice() neq 0-|
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
		<tr>
			<td colspan="7" class="pages">|-include file="PaginateNumberedInclude.tpl"-|</td>
		</tr> 
		</tbody> 
	</table> 
</div>
