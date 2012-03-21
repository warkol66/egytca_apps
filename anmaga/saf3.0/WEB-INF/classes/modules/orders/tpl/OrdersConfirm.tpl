<h2>Pedidos</h2>
<h1>Confirmar Pedido</h1>
<div id="div_order">
	<div id="messageCart">
</div>
	<table width="100%" border="0" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-products">
		<thead>
			<tr>
				<th>Código</th>
				<th>Nombre</th>
				<th>Precio Unitario</th> 
				<th>Unidad de Venta</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Total</th>
			</tr>
		</thead>
		|-assign var=total value=0-|
		<tbody>  |-foreach from=$orderItems item=item name=for_products-| |-assign var=product value=$item->getProduct()-|
		<tr>
			<td align="right">|-$product->getcode()-|</td>
			<td>|-$product->getname()-|</td>
			<td nowrap align="right">|-$product->getprice()|number_format:2:",":"."-|</td>
			<td nowrap align="right">|-$product->getSalesUnit()-|</td>
			<td nowrap align="right">|-math equation="x * y" x=$product->getprice() y=$product->getSalesUnit() assign=totalItem-||-$totalItem|number_format:2:",":"."-|</td>
			<td align="right">|-$item->getQuantity()-|</td>
			<td align="right">
				|-math equation="x * y" x=$totalItem y=$item->getQuantity() assign=subTotal-||-$subTotal|number_format:2:",":"."-|
				|-math equation="x + (y*z)" x=$total y=$totalItem z=$item->getQuantity() assign=total-|
			</td>
		</tr>
		|-foreachelse-|
		<tr>
			<td colspan="6">Sin Productos</td>
		</tr>
		|-/foreach-|
		<tr>
			<td colspan="4">Total</td>
			<td colspan="3">|-$total|number_format:2:",":"."-|</td>
		</tr>		
		</tbody>
	</table> 
</div>

<form action="Main.php" method="post">
	<input type="hidden" name="do" value="ordersViewCart" />
	<input type="submit" value="Editar Pedido" />
</form>

<br /><br />

|- if $orderItems|@count gt 0-|
<p><strong>Datos del Pedido</strong></p>
<form action="Main.php" method="post">
	<p>	<label for="number">Número:</label>
		<img src="images/helpIcon.png" width="16" height="16" alt="Si el cliente asignó un número a este pedido, ingrese ese número como referencia" title="Si el cliente asignó un número a este pedido, ingrese ese número como referencia">	<input type="text" name="number" />
	</p>
	|-if $affiliate-|
	<p>
		<label>Affiliado:</label> <span>|-$affiliate->getName()-|</span>
		<input type="hidden" name="affiliateId" value="|-$affiliate->getId()-|" />
	</p>
	|-/if-|

	|-if $branchs|@count gt 0-|<p>Seleccione la sucursal correspondiente
		<select name="branchId">
			<option value="">Seleccionar sucursal</option>
			|-foreach from=$branchs item=branch-|
			<option value="|-$branch->getId()-|">|-$branch->getName()-| (|-$branch->getNumber()-|)</option>
			|-/foreach-|
		</select>
	</p>
	|-/if-|
	<input type="hidden" name="do" value="ordersDoGenerate" />
	<input type="submit" value="Confirmar pedido" />
</form>
|-/if-|
