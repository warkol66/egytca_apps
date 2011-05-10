<div id="supplierQuoteItemLister">
	<table id="supplierQuoteItemList" cellpadding="4" cellspacing="0" class="tableTdBorders">
		<tr>
			<th>Código</th>
			<th>Producto</th>
<!--			<th>Cantidad</th> -->
			<th>Precio Cotizado</th>
			<th></th>
		</tr>
		|-foreach from=$supplierQuote->getSupplierQuoteItems() item=item name=for_supplierQuotesItems-|
		|-assign var=product value=$item->getProduct()-|
		<tr>
			<td>|-$product->getSupplierProductCode()-|</td>
			<td>|-$product->getName()-|</td>
<!--			<td>|-$item->getQuantity()-|</td> -->
			<td>|-if $item->getPrice() eq ''-|Precio no asignado|-else-|US$ |-$item->getPrice()|number_format:2:",":"."-| /u.|-/if-|</td>
			<td>
				|-if not $supplierQuote->isConfirmed() and not $supplierQuote->isOnFeedback()-|
				<form action="Main.php" method="get">						
					<input type="hidden" name="do" value="importSupplierQuoteItemAccess" />
					<input type="hidden" name="id" value="|-$item->getid()-|" />
					<input type="hidden" name="token" value="|-$token-|" >
					<input type="submit" name="submit_go_edit_quote" value="Click aquí para cotizar"/>
				</form>
				|-/if-|
				|-if $item->isOnFeedback() -|
				<form action="Main.php" method="get">						
					<input type="hidden" name="do" value="importSupplierQuoteItemAccess" />
					<input type="hidden" name="id" value="|-$item->getid()-|" />
					<input type="hidden" name="token" value="|-$token-|" >
					<input type="submit" name="submit_go_edit_quote" value="Click aquí para dar Feedback"/>
				</form>
				|-/if-|
				|-if not $supplierQuote->isConfirmed() and not $item->hasProductBeingReplaced()-|
					<form action="Main.php" method="get">						
						<input type="hidden" name="do" value="importSupplierQuoteItemReplace" />
						<input type="hidden" name="id" value="|-$item->getid()-|" />
						<input type="hidden" name="token" value="|-$token-|" >
						<input type="submit" name="submit_go_edit_quote" value="Proponer un reemplazo de producto"/>
					</form>
				|-/if-|
			</td>
		</tr>
		|-/foreach-|
	</table>
</div>	
