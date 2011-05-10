|-if $clientQuote->isQuoted()-|
	<form action="Main.php" method="post" >
|-/if-|

<div id="clientQuoteItemLister">
	<table id="clientQuoteItemList" cellpadding="4" cellspacing="0" class="tableTdBorders">
		<thead>
			|-if $clientQuote->isQuoted()-|
				<th></th>
			|-/if-|
			<th>Código</th>
			<th>Nombre</th>
			|-if $clientQuote->isQuoted()-|
			<th>Precio Unitario</th>
			|-/if-|	
			|-if $quantitiesOnQuotesFlag or $clientQuote->isQuoted()-|
				<th>Cantidad</th>
			|-/if-|			
				|-if $clientQuote->isNew()-|
			<th></th>
			|-/if-|			
		</thead>
		|-foreach from=$clientQuote->getClientQuoteItems() item=item name=for_clientQuotesItems-|
		|-assign var=product value=$item->getProduct()-|
		<tbody>
		<tr id="itemProduct|-$item->getProductId()-|">
			|-if $clientQuote->isQuoted()-|
				<td><input type="checkbox" name="clientQuoteItems[]" value="|-$item->getId()-|" /></td>
			|-/if-|
			<td>|-$product->getCode()-|</td>
			<td>|-$product->getName()-|</td>
			|-if $clientQuote->isQuoted()-|
			<td>|-$item->getPrice()-|</td>
			|-/if-|
			|-if $quantitiesOnQuotesFlag-|
			<td>
				|-$item->getQuantity()-|
				|-if $clientQuote->isQuoted()-|
					<input type="hidden" name="clientQuoteItemsQuantity[|-$item->getId()-|]" value="|-$item->getQuantity()-|" id="clientQuoteItemsQuantity[|-$item->getId()-|]" />
				|-/if-|
			</td>
			|-/if-|
			|-if not $quantitiesOnQuotesFlag and $clientQuote->isQuoted()-|
			<td><input type="text" size="5" name="clientQuoteItemsQuantity[|-$item->getId()-|]" value="" id="clientQuoteItemsQuantity[|-$item->getId()-|]" /></td>
			|-/if-|
				|-if $clientQuote->isNew()-|
			<td>
				<form action="Main.php" method="post">
					<input type="hidden" name="do" value="importClientQuoteDeleteItemX" />
					<input type="hidden" name="productId" value="|-$item->getProductId()-|" />
					<input type="button" name="submit_go_delete_quote" value="Borrar" onClick="javascript:importDeleteItemFromClientQuoteX(this.form)" class="iconDelete" />
				</form>
			</td>
				|-/if-|
		</tr>
		|-/foreach-|
		</tbody>
	</table>
</div>	

|-if $clientQuote->isQuoted()-|
	<p>
		<input type="button" name="selectAll" value="Seleccionar Todos" onClick="javascript:importSelectAllByName('clientQuoteItems[]')" />
	</p>
	<p>
		<input type="hidden" name="clienQuoteId" value="|-$clientQuote->getId()-|" />
		<input type="hidden" name="do" value="importClientQuoteAccept" id="do" />
		<input type="submit" value="Aceptar Cotización de Elementos Seleccionados" />
	</p>
</form>
|-/if-|