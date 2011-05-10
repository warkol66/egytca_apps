<div id="clientPurchaseOrderItemLister">
	<table id="clientPurchaseOrderItemList" cellpadding="4" cellspacing="0" class="tableTdBorders">
		<tr>
			<th>Código</th>
			<th>Nombre</th>
			<th>Cantidad</th>
			<th>Precio Unitario</th>
		</tr>
		|-foreach from=$clientPurchaseOrder->getClientPurchaseOrderItems() item=item name=for_clientQuotesItems-|
		|-assign var=product value=$item->getProduct()-|
		<tr>
			<td>|-$product->getCode()-|</td>
			<td>|-$product->getName()-|</td>
			<td>|-$item->getQuantity()-|</td>
			<td>|-$item->getPrice()-|</td>
		</tr>
		|-/foreach-|
	</table>
</div>	

<input type="button" name="cancel" value="Volver" onClick="javascript:history.go(-1)"/>
