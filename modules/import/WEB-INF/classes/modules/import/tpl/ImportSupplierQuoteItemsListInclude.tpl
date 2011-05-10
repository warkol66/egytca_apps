<div id="supplierQuoteItemLister">
	<table id="supplierQuoteItemList" cellpadding="4" cellspacing="0" class="tableTdBorders">
		<tr>
			<th>Código</th>
			<th>Nombre</th>
<!--			<th>Cantidad Pedida</th> -->
			<th>Precio Unitario del Proveedor</th>			
		</tr>
		|-foreach from=$supplierQuote->getSupplierQuoteItems() item=item name=for_supplierQuotesItems-|
		|-assign var=product value=$item->getProduct()-|
		<tr>
			<td>|-$product->getCode()-|</td>
			<td>|-$product->getName()-|</td>
<!--			<td>|-$item->getQuantity()-|</td> -->
			<td>|-$item->getPrice()|number_format:2:",":"."-|</td>			
		</tr>
		|-/foreach-|
	</table>
</div>	
