<h3>Detalle del Pedido de Producto</h3>
|-if isset($productRequest) and isset($productInfo)-|
<table id="requestStatus" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
	<tr>
		<td class='cellboton' colspan='4'>Informacion del Pedido:
			<p>Nombre del Producto: |-$productInfo->getName()-|<br />
			   Cantidad Pedida: |-$productRequest->getQuantity()-|<br />
			   Status: <span id="productRequestStatus">|-if ($productRequest->getStatus()) eq "Quoted" and $loginAffiliateUser neq ""-|Pending|-else-||-$productRequest->getStatus()-||-/if-|</span><br />
			   |-if (($loginUser neq "") and ($loginUser->isAdmin() or $loginUser->isSupplier()))-|
			   Incoterm: <span id="productRequestIncoterm">|- assign var="incoterm" value=$incotermPeer->get($productRequest->getIncotermId())-||-if not empty($incoterm)-||-$incoterm->getName()-||-/if-|</span><br />
			   Port: <span id="productRequestPort">|-assign var="port" value=$portPeer->get($productRequest->getPortId())-||-if not empty($port)-||-$port->getName()-||-/if-|</span><br />
			   Precio Supplier: <span id="productRequestPriceSupplier">|-$productRequest->getPriceSupplier()-|</span><br />
			   |-/if-|
			   |-if ($loginAffiliateUser neq "" or ($loginUser neq "" and $loginUser->isAdmin()))-|
			   Precio: <span id="productRequestPriceClient">|-$productRequest->getPriceClient()-|</span><br />
			   |-/if-|
			</p>
		</td>

	</tr>

</table>
<br />
<p>
<input type="button" value="Volver al Detalle de la Orden de Pedido" onclick="javascript:history.go(-1)"></input>
</p>
<br />
<div id="msgBox" style="display : none;">
	
</div>

|-if $loginAffiliateUser neq ""-|
<br />

<table id="affiliateActions" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
	<tr>
		<td class='cellboton' colspan='4'>Acciones Usuario Afiliado:
			<span id="affiliateActionsText">	
			|- if $productRequest->isWaiting()-|
				<p><p><a class='delete' onClick="javascript:importConfirmProductRequest(|-$productRequest->getId()-|,true)">Aceptar Cotizacion</a></p></p>
				<p><p><a class='delete' onClick="javascript:importConfirmProductRequest(|-$productRequest->getId()-|,false)">Rechazar Cotizacion</a></p></p>
			|-else-|
				<p>No hay acciones para realizar en este Estado<p>					
			|- /if-|
			</span>
						

		</td>

	</tr>

</table>

|-/if-|

|-if ($loginUser neq "" and $loginUser->isAdmin())-|
<br />
<table id="adminActions" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
	<tr>
		<td class='cellboton' colspan='4'>Acciones Usuario Admin:
			<span id="adminActionsText">			
			|- if $productRequest->isNew()-|
				<p><a class='delete' onClick="javascript:importAssignSupplierToProductRequest(|-$productRequest->getId()-|)">Asignar Product Request a Supplier</a></p>
			|- /if-|
		
			|- if $productRequest->isQuoted() or $productRequest->isWaiting()-|
				<p><form method="post">
					<label>Asignar precio unitario:</label><br/>
					<input type="text" name="priceClient" value="|-$productRequest->getPriceClient()-|" id="priceClient" />
					<input type="hidden" name="do" value="importDoEditProductRequestPriceX"  />
					<input type="hidden" name="productRequestId" value="|-$productRequest->getId()-|" />					
					<input type="button" name="Asignar Precio" onClick="javascript:importDoEditProductRequestPrice(this.form)" value="Asignar Precio"/>
					
				</form></p>
			|- /if-|

			|- if (not $productRequest->isNew()) and (not $productRequest->isQuoted() and (not $productRequest->isWaiting()))-|
				<p>No hay acciones para realizar en este Estado</p>			
			|- /if-|
			</span>

		</td>

	</tr>

</table>

|-/if-|


|-if ($loginUser neq "" and $loginUser->isSupplier())-|
<br />
<table class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
	<tr>
		<td class='cellboton' colspan='4'>Acciones Usuario Supplier:

			|- if $productRequest->isPending() or $productRequest->isQuoted()-|
				<span id="supplierActionsText">				
				<p>Podra modificar las opciones hasta establecer el valor de precio, incoterm y puerto. Una vez establecidos los tres, la orden pasara a Quoted</p>
				<p><form method="post">
					<label>Asignar precio unitario:</label><br />
					<input type="text" name="priceSupplier" value="|-$productRequest->getPriceSupplier()-|" id="priceClient" />
				</p>
				<p>Asignar un Incoterm:
					<select name="incotermId">
					|- foreach from=$incoterms item=incoterm-|	
								<option name="incotermId" value="|-$incoterm->getId()-|" |-if ($productRequest->getIncotermId() == $incoterm->getId())-|selected="selected"|-/if-|>|-$incoterm->getName()-|</option>
	|-/foreach-|
</select>
				</p>
				<p>Asignar un Puerto:
					<select name="portId">
					|- foreach from=$ports item=port-|	
								<option name="portId" value="|-$port->getId()-|" |-if ($productRequest->getPortId() == $port->getId())-|selected="selected"|-/if-|>|-$port->getName()-|</option>
					|-/foreach-|
</select>
</p>
<p>
						<input type="hidden" name="do" value="importDoAssignProductRequestTermsX"  />
		<input type="hidden" name="productRequestId" value="|-$productRequest->getId()-|" />
						<input type="button" value="Asignar Terminos" onClick="javascript:importDoAssignProductRequestTerms(this.form)"/> <span id="messageActivitySupplier"></span>
</p>
					</form>				


				</p>
				</span>
				<br />
			|- /if-|

			|- if (not $productRequest->isPending()) and (not $productRequest->isQuoted())-|
				<p>No hay acciones para realizar en este Estado</p>			
			|- /if-|


		</td>

	</tr>

</table>

|-/if-|


|-/if-|


<br />

|-if ($loginUser neq "" and $loginUser->isAdmin())-|
<h3>Comentarios Con Afiliado</h3>
|-/if-|

	<table id="commentTable" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
		<thead>
			<th class="thFillTitle">Usuario</th>
			<th class="thFillTitle">Mensaje</th>
		</thead>
		<tbody id="commentTableBody">

			|-foreach from=$comments item=comment name=for_comments-|			
			<tr style="background-color : |-if $comment->isFromAdmin()-|#00CCFF;|-/if-||-if $comment->isFromSupplier()-|#CCFF99;|-/if-||-if $comment->isFromUser()-|#FFFF66;|-/if-|">
				<td width="10%">|-if $comment->isFromAdmin() or $comment->isFromSupplier()-||-assign var="user" value=$userPeer->get($comment->getUserId())-||- $user->getUsername() -||-/if-|
				|-if $comment->isFromUser()-||-assign var="user" value=$affiliateUserPeer->get($comment->getUserId())-||- $user->getUsername() -||-/if-|
				</td>
				<td width="90%">|-$comment->getText()-|</td>
			</tr>
			|-/foreach-|
		</tbody>				
	</table>

<br />

|-if ($loginUser neq "" and $loginUser->isAdmin())-|
<h3>Comentarios Con Supplier</h3>
|-/if-|

|- if isset($commentsSupplier) -|

	<table id="commentTableSupplier" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
		<thead>
			<th class="thFillTitle">Usuario</th>
			<th class="thFillTitle">Mensaje</th>
		</thead>
		<tbody id="commentTableBodySupplier">

			|-foreach from=$commentsSupplier item=comment name=for_comments-|			
			<tr style="background-color : |-if $comment->isFromAdmin()-|#00CCFF;|-/if-||-if $comment->isFromSupplier()-|#CCFF99;|-/if-||-if $comment->isFromUser()-|#FFFF66;|-/if-|">
				<td width="10%">|-if $comment->isFromAdmin() or $comment->isFromSupplier()-||-assign var="user" value=$userPeer->get($comment->getUserId())-||- $user->getUsername() -||-/if-|
				|-if $comment->isFromUser()-||-assign var="user" value=$affiliateUserPeer->get($comment->getUserId())-||- $user->getUsername() -||-/if-|
				</td>
				<td width="90%">|-$comment->getText()-|</td>
			</tr>
			|-/foreach-|
		</tbody>				
	</table>



|-/if-|

	<div id="messageSenderBox">
		<form method="get">
			<p>
				<p>Envio de Mensajes</p>
				|-if ($loginUser neq "") and $loginUser->isAdmin()-|

				<label>Destinatario: </label>
				<select id="selectMessageTo" name="messageTo">
					<option value="user" selected="selected">Afiliado</option>
					<option value="supplier">Supplier</option>
				</select><br /><br />
				
				|-/if-|
				<label>Contenido del Mensaje</label><br />
				<textarea name="message" rows="4" cols="40"></textarea><br/>
				<input type="button" name="send_message" value="Enviar Mensaje" onClick="javascript:importSendMessageX(this.form)"/>
				<input type="hidden" name="productRequestId" value="|-$productRequest->getId()-|"/>
				<input type="hidden" name="do" value="importSendMessageX" />
			</p>
		</form>	
	</div>


