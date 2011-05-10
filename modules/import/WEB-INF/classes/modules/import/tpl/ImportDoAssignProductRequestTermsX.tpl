<script language="JavaScript" type="text/javascript">
// <![CDATA[
	var message = "Terminos " |-if isset($statusChanged)-| + "y estado " |-/if-| + "Actualizados";
	$('msgBox').innerHTML = message;
	$('msgBox').show();
	$('productRequestIncoterm').innerHTML = "|-assign var="incoterm" value=$incotermPeer->get($productRequest->getIncotermId())-||- $incoterm->getName()-|";
	$('productRequestPort').innerHTML = "|- assign var="port" value=$portPeer->get($productRequest->getPortId())-||-$port->getName()-|";
	$('productRequestPriceSupplier').innerHTML = "|- $productRequest->getPriceSupplier()-|";
	$('productRequestStatus').innerHTML = "|-$productRequest->getStatus()-|";
	$('messageActivitySupplier').innerHTML = "";
// ]]>
</script>
