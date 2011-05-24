<tr id="row|-$item->getCode()-|"> 
	<td nowrap class="tdSize1 top center">|-$product->getCode()-|</td> 
	<td class="tdSize1 top">|-$product->getname()-|</td> 
	<td class="tdSize1 bottom right">|-$item->getprice()|system_numeric_format-|</td>
	<td class="tdSize1 bottom right"><span id="quantity|-$item->getId()-|">|-$item->getQuantity()-|</span></td> 
	<script type="text/javascript">
		editor|-$item->getId()-| = new Ajax.InPlaceEditor("quantity|-$item->getCode()-|", 'Main.php?do=ordersItemsDoEditX&itemId=|-$item->getId()-|&orderId=|-$order->getId()-|', { clickToEditText : 'Editar Cantidad' });
	</script>
	<td class="tdSize1 bottom right">|-math equation="x * y" x=$item->getPrice() y=$item->getQuantity() assign=totalItem-|<span id="totalItem|-$item->getId()-|">|-$totalItem|system_numeric_format-|</span></td> 
	<td class="tdSize1 bottom right">
		<input id="editButton|-$item->getCode()-|" type="button" onclick="editor|-$item->getCode()-|.enterEditMode();" value="Editar" class="icon iconEdit" />
		<form method="post" action="Main.php" id="formRemove|-$item->getCode()-|">
			<input type="hidden" name="itemId" value="|-$item->geCode()-|" />
			<input type="hidden" name="orderId" value="|-$order->getId()-|" />
			<input type="hidden" name="do" value="ordersItemsDoDeleteX" />
			<input type="button" value="Remove" onclick="ordersItemsDoDeleteX('|-$item->getCode()-|')"  class="icon iconDelete"/>
		</form>
		<span  id="messageRemove|-$item->getId()-|"></span>
	</td>
</tr> 

<script type="text/javascript">
    //<![CDATA[
    $('messageAdd').innerHTML = "";
	$('product_total_value').innerHTML = '|-$order->getTotal()|system_numeric_format-|';
    //]]>
</script>