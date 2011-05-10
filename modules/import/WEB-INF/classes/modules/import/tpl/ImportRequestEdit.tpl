<div id="msgBox" style="display : none;">
	
</div>
<h3>Orden de Pedido</h3>
|-if $loginAffiliateUser neq ""-|
<table class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
	<tr>
		<td class='cellboton' colspan='4'>Seleccione un producto a agregar a su Pedido: <br /><br />
			<form id="adder" action='Main.php' method='post'>
				<input type="hidden" name="do" value="importDoAddProductToRequestX" />
				<label>Producto:</label>
				<select name="productId" id="product_name">
					<option value="" selected="selected">Seleccionar Producto</option>
					|-foreach from=$products item=product name=for_products-|
						<option value="|-$product->getId()-|">|-$product->getName()-|</option>
					|-/foreach-|
				</select><br />
				<label>Cantidad:</label>
				<input type="text" name="quantity" value="" id="quantity" />
				<input id="addRequestId"type="hidden" name="requestId" value="|-if isset($request) -||-$request->getId()-||-/if-|" id="requestId"/> 
			</form>
			<input type='button' value='Agregar' class='button' onClick="javascript:importAddProductToRequestX($('adder'))" />
		</td>

	</tr>
</table>
|-/if-|

<br />
<input type=button value="Volver al Listado de Ordenes de Pedido" onclick="history.go(-1)"> <br /><br />
<table class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
	<thead>
		<th width="30%" nowrap class="thFillTitle">Nombre de Producto</th>
		<th width="20%" class="thFillTitle">Cantidad</th>
		|-if ($loginAffiliateUser neq "") or ($loginUser neq "" and $loginUser->isAdmin())-|
			<th width="10%" class="thFillTitle">Precio</th>
		|-/if-|
		|- if (($loginUser neq "") and ($loginUser->isAdmin() or $loginUser->isSupplier()))-|
			<th width="10%" class="thFillTitle">Precio Supplier</th>
		|-/if-|
		<th width="10%" class="thFillTitle">Status</th>
		<th width="10%" class="thFillTitle">&nbsp;</th>
	</head>
	<tbody id="productsTable">
	|-foreach from=$productRequests item=productReq name=for_requestProducts-|
		|-assign var="product" value=$productPeer->get($productReq->getProductId())-|
	<tr id="productRequest_|-$productReq->getId()-|">	
		<td class="size2"><div class='titulo2'></div>|-$product->getName()-|</td>
		<td class="size2">|-$productReq->getQuantity()-|</td>		|-if ($loginAffiliateUser neq "") or ($loginUser neq "" and $loginUser->isAdmin())-|
			<td class="size2">|-$productReq->getPriceClient()-|</td>
		|-/if-|
		|- if (($loginUser neq "") and ($loginUser->isAdmin() or $loginUser->isSupplier()))-|
			<td class="size2">|-$productReq->getPriceSupplier()-|</td>
		|-/if-|
		<td class="size2">|-if ($productReq->getStatus()) eq "Quoted" and $loginAffiliateUser neq "" -|Pending|-else-||-$productReq->getStatus()-||-/if-|</td>
		<td class='tdSize1 center cellTextOptions' nowrap>
		[ <a class='delete' href="Main.php?do=importProductRequestDetail&productRequestId=|-$productReq->getId()-|">Detalle</a> ]
		|-if $loginAffiliateUser neq "" and $productReq->isNew()-|
 			[ <a class='delete' onClick="javascript:importDeleteProductFromRequest(|-$productReq->getId()-|)">##115,Eliminar##</a> ]
		|-/if-|

		</td>
	</tr>
	|-/foreach-|
	</tbody>

</table>






