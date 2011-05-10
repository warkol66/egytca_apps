<div id="supplierPurchaseOrderItemLister">
	<table id="supplierPurchaseOrderItemList" cellpadding="4" cellspacing="0" class="tableTdBorders">
		<tr>
			<th>Código</th>
			<th>Código Proveedor</th>
			<th>Nombre</th>
			<th>Cantidad</th>
			<th>Precio Unitario</th>
		</tr>
		|-foreach from=$supplierPurchaseOrder->getSupplierPurchaseOrderItems() item=item name=for_supplierQuotesItems-|
		|-assign var=product value=$item->getProduct()-|
		<tr>
			<td>|-$product->getCode()-|</td>
			<td>|-$product->getSupplierProductCode()-|</td>
			<td>|-$product->getName()-|</td>
			<td>|-$item->getQuantity()-|</td>
			<td>|-$item->getPrice()-|</td>
		</tr>
		|-/foreach-|
	</table>
</div>	

<input type="button" name="cancel" value="Volver" onClick="javascript:history.go(-1)"/>
