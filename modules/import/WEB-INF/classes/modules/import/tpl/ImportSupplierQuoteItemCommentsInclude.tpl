|-if $supplierQuoteItem->getSupplierQuoteItemComments()|@count gt 0-|
<p>##import,69,Historial de comentarios##:</p>
<div id="supplierQuoteItemCommentsLister">
	<table id="supplierQuoteItemCommentsListTable" cellpadding="3" cellspacing="0" class="tableTdBorders">
		<tr>
			<th>##import,10,Fecha##</th>
			<th>##import,66,Usuario##</th>
			<th>##import,60,Precio Unitario##</th>
			<th>##import,32,Plazo de Entrega##</th>
			<th>##import,67,Comentario##</th>			
		</tr>
		|-foreach from=$supplierQuoteItem->getSupplierQuoteItemComments() item=comment name=for_supplierQuotesItemsComments-|
		<tr>
			<td>|-$comment->getCreatedAt()-|</td>
			<td>
				|-if $comment->getUserName() neq ''-|##import,66,Usuario##: |-$comment->getUserName()-||-/if-|
				|-if $comment->getSupplierName() neq ''-|##import,67,Proveedor##: |-$comment->getSupplierName()-||-/if-|
			</td>
			<td>|-$comment->getPrice()-|</td>
			<td>|-$comment->getDelivery()-| ##import,35,Dias##</td>
			<td>|-$comment->getComments()-|</td>			
		</tr>
		|-/foreach-|
	</table>
</div>
|-/if-|
