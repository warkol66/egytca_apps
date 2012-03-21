<h2>Pedidos</h2>
<h1>Carrito de compras</h1>
	<p>A continuación se muestra el contenido del carrito de compras.</p>
<div id="div_order">
	|-if $message eq "deleted_ok"-|
		<div class="successMessage">Carrito Vaciado!</div>
	|-/if-|
	<div id="messageCart" style="position: fixed; right: 50px; top: 5px;">
	</div>
	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-products">
		<thead>
			<tr>
				<th width="10%" nowrap>Código</th>
				<th width="45%">Nombre</th>
				<th width="10%">Precio Unitario</th> 
				<th width="10%">Unidad de Venta</th>
				<th width="15%">Precio por Empaque </th>
				<th width="5%">Cantidad</th>
			</tr>
		</thead>
		|-assign var=total value=0-|
		<tbody>  |-foreach from=$orderItems item=item name=for_products-| |-assign var=product value=$item->getProduct()-|
		<tr id="product_|-$product->getCode()-|">
			<td align="center">|-$product->getCode()-|</td>
			<td>|-$product->getname()-|</td>
			<td nowrap align="right">|-$product->getprice()|system_numeric_format-|</td>
			<td align="center" nowrap>|-$product->getSalesUnit()-|</td>
			<td nowrap align="right">
				|-math equation="x * y" x=$product->getprice() y=$product->getSalesUnit() assign=totalItem-||-$totalItem|system_numeric_format-|
				|-math equation="x + (y*z)" x=$total y=$totalItem z=$item->getQuantity() assign=total-|
			</td>
			<td nowrap>
				<form>
					<input type="text" name="quantity" value="|-$item->getQuantity()-|" size="3" />
					<input type="hidden" name="productCode" value="|-$product->getCode()-|" />
					<input type="hidden" name="do" value="ordersChangeItemCartX" />
					<input type="button" value="Cambiar" class="icon iconUpdateCart" title="Actualizar carrito" alt="Actualizar carrito" onclick="javascript:ordersChangeItemCartX(this.form)" />
				</form>
				<form>
					<input type="hidden" name="productCode" value="|-$product->getCode()-|" />
					<input type="hidden" name="do" value="ordersRemoveItemCartX" />
					<input type="button" value="Eliminar" class="icon iconRemoveFromCart" title="Eliminar del carrito" alt="Eliminar del carrito" onclick="javascript:ordersRemoveItemCartX(this.form)" />
				</form>
			</td>
		</tr>
		|-foreachelse-|
		<tr>
			<td colspan="7">Sin Productos</td>
		</tr>
		|-/foreach-|
		|-if $orderItems|@count neq 0-|<tr>
			<td colspan="4" align="right">Total</td>
			<td colspan="3" align="center" id="orderTotal">|-$total|system_numeric_format-|</td>
		</tr>
		|-/if-|
		</tbody>
	</table> 
</div>

|- if $orderItems|@count gt 0-|
<form action="Main.php" method="post">
	<input type="hidden" name="do" value="ordersCartDoDelete" />
	<input type="submit" value="Vaciar Carrito" onclick="return confirm('Seguro que desea vaciar el carrito?')" />
</form>
<br>
|-if $affiliates|@count gt 0-|
<h3>Opciones de Administrador</h3>
|-/if-|
<form action="Main.php" method="post">
	|-if $affiliates|@count gt 0-|
	<h4>Pedido para mayorista</h4>
	<p>Para generar este pedido para un mayorista, seleccione de la lista el mayorista, haga click en "Generar Orden".</p>
	<select name="affiliateId">
		<option value="">Seleccionar Afiliado</option>
		|-foreach from=$affiliates item=affiliate-|
		<option value="|-$affiliate->getId()-|">|-$affiliate->getName()-|</option>
		|-/foreach-|
	</select>
	|-else-|
	<h4>Procesar pedido</h4>
	<p>Para generar este pedido, haga click en "Generar Orden".</p>
	|-/if-|
	<input type="hidden" name="do" value="ordersConfirm" />
	<input type="submit" value="Generar orden" />
</form>
<br>
<form action="Main.php" method="post">
	|-if $affiliates|@count gt 0-|
	<h4>Plantilla de pedido para mayorista</h4>
	<p>Para guardar este pedido como plantilla para un mayorista, seleccione de la lista el mayorista, haga click en "Guardar plantilla de pedido".</p>
	<select name="affiliateId">
		<option value="">Seleccionar Afiliado</option>
		|-foreach from=$affiliates item=affiliate-|
		<option value="|-$affiliate->getId()-|">|-$affiliate->getName()-|</option>
		|-/foreach-|
	</select>
	|-else-|
	<h4>Plantillas de pedido</h4>
	<p>Para guardar este pedido como plantilla, haga click en "Guardar plantilla de pedido".</p>
	|-/if-|
	<input type="hidden" name="do" value="ordersDoSave" />
	<input type="hidden" name="name" id="name" value="" />
	<input type="submit" value="Guardar plantilla de pedido" onclick="$('name').value = window.prompt('Nombre de la orden:','');" />
</form>
|-/if-|


