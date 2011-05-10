|- if $item neq '' -|
<script type="text/javascript">
	if ($('productSearchMsgBox')) 
		$('productSearchMsgBox').innerHTML = '<div class="resultSuccess">Se ha agregado el producto a la solicitud</div>';
</script>

|-assign var=product value=$item->getProduct()-|
<tr id="itemProduct|-$item->getProductId()-|">
	<td>|-$product->getCode()-|</td>
	<td>|-$product->getName()-|</td>
	|-if $quantitiesOnQuotesFlag -|
		<td>|-$item->getQuantity()-|</td>
	|-/if-|
	<td>
		<form action="Main.php" method="post">
			<input type="hidden" name="do" value="importClientQuoteDeleteItemX" />
			<input type="hidden" name="productId" value="|-$item->getProductId()-|" />
			<input type="button" name="submit_go_delete_quote" value="Borrar" onClick="javascript:importDeleteItemFromClientQuoteX(this.form)" class="iconDelete" />
		</form>
	</td>
<!--	<td>|-$item->getQuantity()-|</td> -->
<!--	<td>|-$item->getPrice()-|</td>		-->	
</tr>
|-else-|

	|-if $message eq 'already-added'-|
		<script type="text/javascript">
			if ($('productSearchMsgBox')) 
				$('productSearchMsgBox').innerHTML = '<div class="resultFailure">Ya ha agregado el producto a la solicitud</div>';
		</script>
	|-else-|
		<script type="text/javascript">
			if ($('productSearchMsgBox')) 
				$('productSearchMsgBox').innerHTML = '<div class="resultFailure">Ha ocurrido un error al agregar el producto</div>';
		</script>
	|-/if-|
|-/if-|