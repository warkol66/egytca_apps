<script type="text/javascript" language="javascript" charset="utf-8">
// <![CDATA[
	var message = "|-if $message eq 'created'-|Orden Creada y Producto Agregado|-/if-||-if $message eq 'added'-|Producto Agregado|-/if-|";
	$('addRequestId').value = |-$requestId-|;
	$('msgBox').innerHTML = message;
	$('msgBox').show();
// ]]>
</script>

	|-assign var="product" value=$productPeer->get($productReq->getProductId())-|
<tr id="productRequest_|-$productReq->getId()-|">	
	<td>|-$product->getName()-|</td>
	<td>|-$productReq->getQuantity()-|</td>
	<td>|-$productReq->getPriceClient()-|</td>
	<td>|-$productReq->getStatus()-|</td>

	<td nowrap> 
[ <a class='delete' href="Main.php?do=importProductRequestDetail&productRequestId=|-$productReq->getId()-|">Detalle</a> ] 
[ <a class='delete' onClick="javascript:importDeleteProductFromRequest(|-$productReq->getId()-|)">##115,Eliminar##</a> ]

	</td>
</tr>

