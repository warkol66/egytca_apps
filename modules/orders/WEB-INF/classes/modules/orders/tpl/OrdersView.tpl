<h2>Pedidos</h2>
	<h1>Ver Pedido: |-$order->getId()-|</h1>
	<p>A continuación puede ver el detalle del pedido |-$order->getId()-|. Puede modificar la orden, cambiar el estado de la misma y agregar o eliminar items.</p>
<div id="div_order"> 

<table width="100%"  border="0" cellspacing="0" cellpadding="5">
	<tr>
		<td><strong>Pedido: |-$order->getId()-|</strong></td>
		<td><strong>Creada: |-$order->getDateCreated()-|</strong></td>
		<td><strong>Número Pedido del Cliente: |-$order->getNumber()-|</strong></td>
	</tr>
	<tr>
		<td><strong>Mayorista: |-assign var=affiliate value=$order->getAffiliate()-||-if $affiliate-||-$affiliate->getName()-||-/if-|</strong></td>
		<td><strong>Usuario: |-assign var=user value=$order->getAffiliateUser()-||-if $user-||-$user->getUsername()-||-/if-|</strong></td>
		<td><strong>Sucursal: |-assign var=branch value=$order->getAffiliateBranch()-||-if $branch-||-$branch->getName()-||-/if-|</strong></td>
	</tr>
	<tr>
		<td><strong>Estado Actual: <span id="state_actual">|-$order->getStateName()-|</span></strong></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
<hr />
<table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableTdBorders"> 
		<caption>
 		Cambios de Estados y Observaciones 
		</caption> 
		<thead> 
			<tr> 
				<th width="15%">Fecha</th> 
				<th width="20%">Afiliado</th> 
				<th width="15%">Usuario</th> 
				<th width="10%">Estado</th> 
				<th width="40%">Observación</th> 
			</tr> 
		</thead> 
		<tbody id="stateChanges">|-if $order->getOrderStateChanges()|@count neq 0-|
		|-foreach from=$order->getOrderStateChanges() item=stateChange-|
		<tr> 
			<td class="tdSize1 center top">|-$stateChange->getCreated()-|</td> 
			<td class="tdSize1 top">|-assign var=affiliate value=$stateChange->getAffiliate()-||-if $affiliate-||-$affiliate->getName()-||-/if-|</td> 
			<td class="tdSize1 top">|-assign var=user value=$stateChange->getUser()-||-if $user-||-$user->getUsername()-||-/if-|</td> 
			<td class="tdSize1 top">|-$stateChange->getStateName()-|</td> 
			<td class="tdSize1 top">|-$stateChange->getComment()-|</td> 
		</tr> 
		|-/foreach-|
|-else-|
		<tr> 
			<td class="tdSize1 left top" colspan="5">No hay cambios de estado registrados.</td> 
		</tr> 
		|-/if-|
		</tbody> 
  </table> 
	<form action="Main.php" method="post"> 
<table width="100%"  border="0" cellspacing="0" cellpadding="5">
	<tr>
		<td class="top">		<label for="state">Nuevo Estado:</label> <br />
		<select name="state" id="state"> 
						<option value="1"|-$order->getState()|selected:1-|>Aceptada</option>
						<option value="2"|-$order->getState()|selected:2-|>Pendiente Aprobación</option>
						<option value="3"|-$order->getState()|selected:3-|>En Proceso</option>
						<option value="4"|-$order->getState()|selected:4-|>Completa</option>
						<option value="5"|-$order->getState()|selected:5-|>Cancelada</option>
						<option value="6"|-$order->getState()|selected:6-|>A Verificar</option>
						<option value="7"|-$order->getState()|selected:7-|>Exportada</option>
		</select></td>
		<td class="top"><label for="comment">Observación:</label> <br />
		<textarea name="comment" cols="60" rows="4" wrap="VIRTUAL" id="comment"></textarea> </td>
	</tr>
	<tr>
		<td colspan="2">		<input type="button" value="Agregar" onclick="javascript:ordersStateDoChangeX(this.form)" /> 
		<input type="hidden" name="do" value="ordersStateDoChangeX" /> 
		<input type="hidden" name="orderId" value="|-$order->getId()-|" /> 
		</td>
		</tr>
	<tr>
		<td colspan="2"><span id="messageState"></span></td>
		</tr>
</table>
	</form> 
<hr />
	<table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableTdBorders" id="tabla-products"> 
		<caption>
 		Detalle del Pedido 
		</caption> 
		<thead> 
			<tr> 
				<th width="10%">Código</th> 
				<th width="50%">Producto</th> 
				<th width="15%">Precio</th> 
				<th width="10%">Cantidad</th> 
				<th width="15%">Total</th> 
			</tr> 
		</thead> 
		<tbody>  |-foreach from=$order->getOrderItems() item=item name=for_products-|
		|-assign var=product value=$item->getProduct()-|
		<tr> 
			<td nowrap class="tdSize1 top center">|-$product->getcode()-|</td> 
			<td class="tdSize1 top">|-$product->getname()-|</td> 
			<td class="tdSize1 bottom right">|-$item->getprice()|system_numeric_format-|</td> 
			<td class="tdSize1 bottom right">|-$item->getQuantity()|system_numeric_format-|</td> 
			<td class="tdSize1 bottom right">|-math equation="x * y" x=$item->getPrice() y=$item->getQuantity() assign=totalItem-||-$totalItem|system_numeric_format-|</td> 
		</tr> 
		|-foreachelse-|
		<tr> 
			<td colspan="5">Sin Productos</td> 
		</tr> 
		|-/foreach-|
		|-if $order->getOrderItems()|@count gt 0-|
		<tr> 
			<td colspan="5" class="tdTitle right">Total:&nbsp;&nbsp;|-$order->getTotal()|system_numeric_format-|</td> 
		</tr> 
		|-/if-|
		</tbody> 
  </table> 
</div>
|-if $all eq "0" and $order->getOrderItems()|@count gt 0-|
<form action="Main.php" method="post"> 
	<input type="hidden" name="do" value="ordersDoAddToCart" /> 
	<input type="hidden" name="id" value="|-$order->getId()-|" /> 
	<input type="submit" value="Add To Cart" /> 
</form>
|-/if-|  
