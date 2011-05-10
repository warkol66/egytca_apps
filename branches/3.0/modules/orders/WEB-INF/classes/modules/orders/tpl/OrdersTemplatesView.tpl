<h2>Pedidos</h2>
<h1>Plantilla de pedido</h1>
<p>A continuación se muestra la plantilla de pedido: |-$orderTemplate->getName()-|. Las plantillas se pueden utilizar para repetir pedidos pulsando el botón "Agregar al carrito".</p>
<div id="div_order">
<fieldset>
<legend>Datos de la plantilla</legend>

	<p class="textAfterLabel"><label>Nombre de plantilla:</label>
	|-$orderTemplate->getName()-|
	</p>
<p class="textAfterLabel"><label>Creada:</label>
	|-$orderTemplate->getCreated()|system_date_format:""-|
	</p>
<p class="textAfterLabel"><label>Mayorista:</label>
|-assign var=affiliate value=$orderTemplate->getAffiliate()-||-if $affiliate-||-$affiliate->getName()-||-/if-| </p>
	<p class="textAfterLabel"><label>Sucursal:</label>
	|-assign var=branch value=$orderTemplate->getAffiliateBranch()-||-if $branch-||-$branch->getName()-||-/if-|
	</p>
<p class="textAfterLabel"><label>Usuario:</label>
|-assign var=user value=$orderTemplate->getAffiliateUser()-||-if $user-||-$user->getUsername()-||-/if-|
</p>
</fieldset>

	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-products">
		<thead>
			<tr>
				<th>C&oacute;digo</th>
				<th>Nombre</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Total</th>				
			</tr>
		</thead>
	|-if $orderTemplate|@count gt 0-|
		<tbody>  |-foreach from=$orderTemplate->getOrderTemplateItems() item=item name=for_products-| |-assign var=product value=$item->getProduct()-| 
		<tr>
			<td>|-$product->getcode()-|</td>
			<td>|-$product->getname()-|</td>
			<td align="right">|-$item->getPrice()|system_numeric_format-|</td>
			<td align="right">|-$item->getQuantity()-|</td>
			<td align="right">|-math equation="x * y" x=$item->getPrice() y=$item->getQuantity() assign=totalItem-||-$totalItem|system_numeric_format-|</td>
		</tr>
		|-/foreach-|
		<tr>
			<th colspan="4" class="right">Total</th>
			<th class="right">|-$orderTemplate->getTotal()|system_numeric_format-|</th>
		</tr>
		|-else-|
		<tr>
			<td coldiv="5">Sin Productos</td>
		</tr>
		|-/if-|
		</tbody>
	</table> 
</div>

|- if $orderTemplate->getOrderTemplateItems()|@count gt 0-|
<form action="Main.php" method="post">
	<input type="hidden" name="do" value="ordersTemplatesDoAddToCart" />
	<input type="hidden" name="id" value="|-$orderTemplate->getId()-|" />
	<input type="submit" value="Agregar al carrito" />
</form>
|-/if-|


