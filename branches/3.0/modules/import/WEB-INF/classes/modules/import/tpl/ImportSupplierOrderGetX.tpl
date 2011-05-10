|-foreach from=$supplier->getSupplierPurchaseOrders() item=order name=for_orders-|
	<option value="|-$order->getId()-|">|-$order->getId()-|</option>
|-/foreach-|

<script type="text/javascript" charset="utf-8">
	if ($('msgBox')) {
		$('msgBox').innerHTML = '';
	}
</script>