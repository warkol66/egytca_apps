<h2>Exportaciones</h2>
<h1>Pedidos a Proveedores</h1>
<p>A continuación puede ver el listado de sus pedidos realizados a los proveedores y sus correspondiente estado.</p>

<div id="div_messages">
	|-if $message eq "tracked"-|
		<div class="successMessage">Se ha guardado el comentario de seguimiento exitosamente.</div>
	|-/if-|
</div>

<div id="div_filters">
	<form action="Main.php" method="get">
		<fieldset>
		<p>
			<label for="filters[adminStatus]">Proveedor</label>
			<select name="filters[supplierId]">
					<option value="">Seleccione Un Proveedor</option>
				|-foreach from=$suppliers item=supplier name=for_suppliers-|
					<option value="|-$supplier->getId()-|" |-if $filters neq '' and $filters.supplierId eq $supplier->getId() -|selected="selected"|-/if-|>|-$supplier->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<label for="filters[adminStatus]">Estado</label>
			<select name="filters[adminStatus]">
					<option value="">Seleccione Un Estado</option>
				|-foreach from=$status item=stat name=for_status-|
					<option value="|-$stat-|" |-if $filters neq '' and $filters.adminStatus eq $stat -|selected="selected"|-/if-|>|-$stat|multilang_get_translation:"import"-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<input type="hidden" name="do" value="importSupplierOrderList" />
			<input type="submit" value="Aplicar Filtro"/>
		</p>
		</fieldset>
	</form>
</div>

<div id="div_orders">
	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-newsmedias">
		<thead>
			<tr>
				<th colspan="9" class="thFillTitle">
				</th>
			</tr>
			<tr>
				<th>Id</th>
				<th>&nbsp;</th>
				<th>Cliente</th>
				<th>Proveedor</th>
				<th>Fecha</th>
				<th>Estado</th>
				<th>Productos</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$orders item=order name=for_orders-|
			<tr valign="top">
				<td>|-$order->getId()-|</td>
				<td><img src="images/clear.gif" class="aqua|-*$smarty.foreach.for_orders.iteration*-||-php-|echo rand(1,10);|-/php-|" /></td>
				<td>
					|-assign var=client value=$order->getAffiliate()-|
					|-$client->getName()-|
				</td>
				<td>
					|-assign var=supplier value=$order->getSupplier()-|
					|-$supplier->getName()-|
				</td>
				<td>|-$order->getCreatedAt()|change_timezone|date_format:"%d-%m-%Y"-|</td>
				<td>|-$order->getStatusName()|multilang_get_translation:"import"-|</td>
				<td>
					|-assign var=items value=$order->getSupplierPurchaseOrderItems()-|
					|-if $items|@count eq 0-|
						No hay productos en la solicitud
					|-else-|
					|-foreach from=$items item=item name=for_orders_item-|
						|-assign var=product value=$item->getProduct()-|
						|-$product->getName()-|
						|-if not $smarty.foreach.for_orders_item.last-|<br />|-/if-|
					|-/foreach-|
					|-/if-|
				</td>
				<td nowrap="nowrap">
					|-if $order->isOnFabrication()-|
					<form action="Main.php" method="get">						
						<input type="hidden" name="do" value="importSupplierOrderTracking" />
						<input type="hidden" name="id" value="|-$order->getid()-|" />
						<input type="submit" name="submit_go_edit_order" value="Seguimiento de Fabricación" title="Seguimiento de Fabricación" alt="Seguimiento de Fabricación" class="iconManufacture" />
					</form>
					|-/if-|
					<form action="Main.php" method="get">						
						<input type="hidden" name="do" value="importSupplierOrderEdit" />
						<input type="hidden" name="id" value="|-$order->getid()-|" />
						<input type="submit" name="submit_go_edit_order" value="Editar" class="iconEdit" title="Editar" alt="Editar" />
					</form>
					<form action="Main.php" method="get">						
						<input type="hidden" name="do" value="importSupplierOrderHistory" />
						<input type="hidden" name="id" value="|-$order->getid()-|" />
						<input type="button" name="submit_go_edit_order" value="Ver Historial" class="iconHistory" title="Ver Historial" alt="Ver Historial" onClick="window.open('Main.php?do=importSupplierOrderHistory&id=|-$order->getid()-|','History','width=670,height=500,menubar=no,status=no,location=no,toolbar=no,scrollbars=yes');" />
					</form>
					|-if !$order->hasShipment()-|
					<form action="Main.php" method="get">						
						<input type="hidden" name="do" value="importShipmentsEdit" />
						<input type="hidden" name="supplierPurchaseOrderId" value="|-$order->getid()-|" />
						<input type="submit" name="submit_go_edit_shipment" value="Crear información de embarque" class="iconShipment" title="Crear información de embarque" alt="Crear información de embarque" />
					</form>
					|-/if-|
				</td>
			</tr>
		|-/foreach-|						
		|-if $pager->getTotalPages() gt 1-|
			<tr> 
				<td colspan="7" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
		</tbody>
	</table>
</div>
