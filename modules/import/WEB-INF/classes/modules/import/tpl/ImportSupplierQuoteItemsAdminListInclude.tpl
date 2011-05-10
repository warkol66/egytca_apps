<div id="supplierQuoteItemLister">
	<table id="supplierQuoteItemList" cellpadding="4" cellspacing="0" class="tableTdBorders">
		<tr>
			<th>##import,30,Código##</th>
			<th>##import,31,Nombre##</th>
			<th>##import,11,Estado##</th>
			<th>##import,32,Plazo de Entrega##</th>
<!--			<th>##import,33,Cantidad##</th>  -->
			<th>##import,34,Precio Unitario del Proveedor##</th>
			|-if $quantitiesOnQuotesFlag -|
				<th>Cantidad</th>
			|-/if-|
			<th></th>		
		</tr>
		|-foreach from=$supplierQuote->getSupplierQuoteItems() item=item name=for_supplierQuotesItems-|
		|-assign var=product value=$item->getProduct()-|
		<tr>
			<td>|-$product->getCode()-|</td>
			<td>|-$product->getName()-|</td>
			<td>|-$item->getStatusName()-|</td>
			<td>|-$item->getDelivery()-| ##import,35,Dias##.</td>
<!--			<td>|-$item->getQuantity()-|</td>  -->
			<td>|-if $item->getPrice() eq 0-|##import,36,No se ha cotizado##|-else-||-$item->getPrice()|number_format:2:",":"."-||-/if-|</td>
			|-if $quantitiesOnQuotesFlag -|
				<td>|-$item->getQuantity()-|</td>
			|-/if-|
			<td>|-if $item->isQuoted()-|
				<form action="Main.php" method="post">
					<input type="hidden" name="supplierQuoteItemId" value="|-$item->getId()-|" />
					<input type="hidden" name="do" value="importSupplierQuoteItemsNegociate" />
					<input type="submit" value="##import,37,Negociar##" />
				</form>
				|-/if-|
			</td>
		</tr>
		|-/foreach-|
	</table>
</div>	
