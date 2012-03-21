<h2>Precios Por Afiliado</h2>
<h1>Listado de Precios Por Afiliado</h1>
	<p>Seleccione una afiliado para buscar su lista de precios.</p>
<p><form method="get" >
				<select name="affiliateId">
					<option value="" selected="selected">Seleccione un Afiliado</option>
				|-foreach from=$affiliates item=eachAffiliate name=for_affiliates-|
					<option value="|-$eachAffiliate->getId()-|" |-$eachAffiliate->getId()|selected:$affiliateId-|>|-$eachAffiliate->getName()-|</option>
				|-/foreach-|
				</select>
				<input type="hidden" name="do" value="catalogAffiliateProductList" />
				<input type="submit" name="search" value="Ver Lista de Precios" />
			</form>
</p>
|-if isset($products)-|
<p>&nbsp;</p>
	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-products"> 
		<thead> 
			<tr> 
				<th colspan="5">Lista de precios de |-$affiliate->getName()-|</th> 
			</tr>
			<tr> 
				<th width="5%">Código Producto</th> 
				<th width="5%">Código Producto Para Afiliado</th>
				<th width="35%">Nombre</th> 
				<th width="50%">Descripción</th> 
				<th width="5%">Precio</th> 
			</tr>
		</thead>
		<tbody>  |-foreach from=$products item=product name=for_products-|
		<tr>
			<td nowrap>|-$product->getcode()-|</td>
			<td nowrap>|-$product->getAffiliateCode($affiliateId)-| </td>
			<td>|-$product->getname()-|</td>
			<td>|-$product->getdescription()-|</td>
			<td nowrap align="right">|-if $product->getAffiliatePrice($affiliateId) neq 0-||-$product->getAffiliatePrice($affiliateId)|system_numeric_format-||-/if-|</td>
		</tr>
		|-foreachelse-|
		<tr>
			<td colspan="5">Sin Lista de Productos</td>
		</tr>
		|-/foreach-|
		<tr>
			<td colspan="5" class="pages">|-include file="PaginateInclude.tpl"-|</td>
		</tr> 
		</tbody> 
</table>
|-/if-|
