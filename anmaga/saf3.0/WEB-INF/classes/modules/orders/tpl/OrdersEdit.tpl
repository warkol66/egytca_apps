<script language="JavaScript" type="text/javascript" src="scripts/order-edit-functions.js"></script>
<h2>Pedidos</h2> 
<h1>Editar Pedido: |-$order->getId()-|</h1> 
<div id="div_order"> 
	<h3>Opciones Generales del Pedido </h3>
	<form action="Main.php" method="post"> 
	<table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableTdBorders">
	<tr>
		<td><strong>Pedido: |-$order->getId()-|</strong></td>
		<td><strong>Creada: |-$order->getDateCreated()-|</strong></td>
		<td> <strong>Número Pedido del Cliente:</strong>
      	<input type="text" name="number" value="|-if $order->getNumber() eq 0-||-$order->getId()-||-else-||-$order->getNumber()-||-/if-|" /></td>
	</tr>
	<tr>
		<td><strong>Mayorista:</strong> |-assign var=affiliate value=$order->getAffiliate()-||-if $affiliate-||-$affiliate->getName()-||-/if-|<br> 
</td>
		<td><strong>Usuario:</strong> |-assign var=user value=$order->getAffiliateUser()-||-if $user-||-$user->getUsername()-||-/if-|</td>
		<td>|-assign var=currentBranch value=$order->getAffiliateBranch()-|
		<strong>Sucursal:</strong> <select name="branch">
		|-assign var=currentBranch value=$order->getAffiliateBranch()-|
		|- foreach from=$branches item=aBranch -|
				<option value="|-$aBranch->getId()-|" |-if $currentBranch and ($currentBranch->getId() eq $aBranch->getId()) -||-assign var=selected value="0"-|selected="selected"|-/if-| >|-$aBranch->getName()-|</option>
		|-/foreach-|
				<option value="" |-if not $selected eq "0" -|selected="selected"|-/if-|>Sin Asignar</option>
		</select></td>
	</tr>
	<tr>
		<td colspan="3"><input type="submit" value="Guardar" /> 
		  <input type="hidden" name="do" value="ordersDoEdit" />
		  <input type="hidden" name="orderId" value="|-$order->getId()-|" />
		  <input type="hidden" name="page" value="|-$page-|" />
			<input type="button" onclick="javascript:window.location.href='Main.php?do=ordersList&page=|-$page-|'" value="Regresar" />
 		</td>
	</tr>
</table>
	</form>
	
	<hr  />
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
			<td class="center top">|-$stateChange->getCreated()-|</td> 
			<td class="top">|-assign var=affiliate value=$stateChange->getAffiliate()-||-if $affiliate-||-$affiliate->getName()-||-/if-|</td> 
			<td class="top">|-assign var=user value=$stateChange->getUser()-||-if $user-||-$user->getUsername()-||-/if-|</td> 
			<td class="top">|-$stateChange->getStateName()-|</td> 
			<td class="top">|-$stateChange->getComment()-|</td> 
		</tr> 
		|-/foreach-|
|-else-|
		<tr> 
			<td class="left top" colspan="5">No hay cambios de estado registrados.</td> 
		</tr> 
		|-/if-|
		</tbody> 
  </table> 
	<form action="Main.php" method="post"> 
	<table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableTdBorders">
	<tr>
		<td class="top"><label for="state">Nuevo Estado:</label><br />
		<select name="state" id="state"> 
						<option value="1"|-$order->getState()|selected:1-|>Aceptada</option>
						<option value="2"|-$order->getState()|selected:2-|>Pendiente Aprobación</option>
						<option value="3"|-$order->getState()|selected:3-|>En Proceso</option>
						<option value="4"|-$order->getState()|selected:4-|>Completa</option>
						<option value="5"|-$order->getState()|selected:5-|>Cancelada</option>
						<option value="6"|-$order->getState()|selected:6-|>A Verificar</option>
						<option value="7"|-$order->getState()|selected:7-|>Exportada</option>
		</select></td>
		<td class="top"><label for="comment">Observación:</label><br />
		<textarea name="comment" cols="60" rows="4" wrap="VIRTUAL" id="comment"></textarea><span id="messageState"></span><span id="state_actual" style="display:none;"></span></td>
	</tr>
	<tr>
		<td colspan="2"><input type="button" value="Agregar" onclick="javascript:ordersStateDoChangeX(this.form)" /> 
		<input type="hidden" name="do" value="ordersStateDoChangeX" /> 
		<input type="hidden" name="orderId" value="|-$order->getId()-|" /> 
		</td>
		</tr>
</table>
	</form> 
<hr  />
	<h3>Edición del Detalle de la Orden</h3>
	<table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableTdBorders" > 
		<thead> 
			<tr> 
				<th width="10%">Código</th> 
				<th width="47%">Producto</th> 
				<th width="15%">Precio</th> 
				<th width="10%">Cantidad</th> 
				<th width="15%">Total</th>
				<th width="3%">&nbsp;</th>
			</tr> 
		</thead> 
		<tbody id="productsTable">  |-foreach from=$order->getOrderItems() item=item name=for_products-|
		|-assign var=product value=$item->getProduct()-|
		<tr id="row|-$item->getId()-|"> 
			<td nowrap class="top center">|-$product->getcode()-|</td> 
			<td class="top">|-$product->getname()-|</td> 
			<td class="bottom right">|-$item->getprice()|system_numeric_format-|</td>
			<td class="bottom right"><span id="quantity|-$item->getId()-|">|-$item->getQuantity()-|</span></td> 
			<script type="text/javascript">
				var editor|-$item->getId()-| = new Ajax.InPlaceEditor("quantity|-$item->getId()-|", 'Main.php?do=ordersItemsDoEditX&itemId=|-$item->getId()-|&orderId=|-$order->getId()-|', { clickToEditText : 'Editar Cantidad' });
			</script>
			<td class="bottom right">|-math equation="x * y" x=$item->getPrice() y=$item->getQuantity() assign=totalItem-|<span id="totalItem|-$item->getId()-|">|-$totalItem|system_numeric_format-|</span></td> 
			<td class="bottom center" nowrap>
			    <input id="editButton|-$item->getId()-|"type="button" onclick="editor|-$item->getId()-|.enterEditMode();" value="Editar" class="icon iconEdit" />
				<form method="post" action="Main.php" id="formRemove|-$item->getId()-|" style="display:inline;">
					<input type="hidden" name="itemId" value="|-$item->getId()-|" />
					<input type="hidden" name="orderId" value="|-$order->getId()-|" />
					<input type="hidden" name="do" value="ordersItemsDoDeleteX" />
					<input type="button" value="Remover" onclick="ordersItemsDoDeleteX('|-$item->getId()-|')" class="icon iconDelete" />
				</form>
				<span  id="messageRemove|-$item->getId()-|"></span>

			</td>
		</tr> 
		|-/foreach-|

      |-if $order->getOrderItems()|@count gt 0-|
		<tr id="product-total">
			<td colspan="6" class="tdTitle right">Total:&nbsp;&nbsp;<span id="product_total_value">|-$order->getTotal()|system_numeric_format-|</span></td>
		</tr>
		|-/if-|
		</tbody>
  </table>
<br />
<br />
  	<div id="test" class="test">
	    <a title="product-add-link" id="product-add-link" onclick="showProductAdd()" class="textLinkButton">Agregar un Producto</a>
	</div>
	<span id="messageAdd"></span>
  	<div id="product-add-box" style="display: none;">
		<form method="post" action="Main.php">
			<label for="product">Producto: </label>
			<select name="productId">
			|- foreach from=$products item=product -|
					<option value="|-$product->getId()-|">|- $product->getCode()-|, |- $product->getName()-|</option>
			|-/foreach-|
			</select><br />
			<label>Cantidad: </label><input type="text" id="productQuantity" name="productQuantity" value="1" /><br />
			
			<input type="button" onclick="javascript:ordersItemsDoAddX(this.form)" value="Agregar" /> 
			<input type="hidden" name="do" value="ordersItemsDoAddX" /> 
			<input type="hidden" name="orderId" value="|-$order->getId()-|" /> 		
			<input type="button" onclick="cancelProductAdd()" value="Cancelar" />
		</form>
	</div>
</div>
|-if $all eq "0" and $order->getOrderItems()|@count gt 0-|
<form action="Main.php" method="post"> 
	<input type="hidden" name="do" value="ordersDoAddToCart" /> 
	<input type="hidden" name="id" value="|-$order->getId()-|" /> 
	<input type="submit" value="Agregar al Pedido" /> 
</form>
|-/if-|  
