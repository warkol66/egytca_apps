|-popup_init src="scripts/overlib.js"-|
<h2>Exportaciones</h2>
<h1>Pedidos de Clientes</h1>
<p>A continuación puede ver el listado de sus pedidos realizados por los clientes y sus correspondiente estado.</p>

<div id="div_filters">
	<form action="Main.php" method="get">
		<fieldset>
		<p>
			<label for="filters[adminStatus]">Estado</label>
			<select name="filters[adminStatus]">
					<option value="">Seleccione Un Estado</option>
				|-foreach from=$status item=stat name=for_status-|
					<option value="|-$stat-|" |-if $filters neq '' and $filters.adminStatus eq $stat -|selected="selected"|-/if-|>|-$stat-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<input type="hidden" name="do" value="importClientOrderList" />
			<input type="submit" value="Aplicar Filtro"/>
		</p>
		</fieldset>
	</form>
</div>

<div id="div_orders">
	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-newsmedias">
		<thead>
			<tr>
				<th colspan="7" class="thFillTitle">
				</th>
			</tr>
			<tr>
				<th>Id</th>
				<th>&nbsp;</th>
				<th>Cliente</th>
				<th>Fecha</th>
				<th>Estado</th>
				<th>Productos</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$orders item=order name=for_orders-|
			<tr>
				<td>|-$order->getId()-|</td>
				<td><img src="images/clear.gif" class="aqua|-*$smarty.foreach.for_orders.iteration*-||-php-|echo rand(1,10);|-/php-|" /></td>
				<td>
					|-assign var=client value=$order->getAffiliate()-|
					|-$client->getName()-|
				</td>
				<td>|-$order->getCreatedAt()|change_timezone|date_format:"%d-%m-%Y"-|</td>
				<td>|-$order->getStatusNameAdmin()-|</td>
				<td>
					|-assign var=items value=$order->getClientPurchaseOrderItems()-|
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
					<form action="Main.php" method="get">						
						<input type="hidden" name="do" value="importClientOrderEdit" />
						<input type="hidden" name="id" value="|-$order->getid()-|" />
						<input type="submit" name="submit_go_edit_order" value="Editar" class="iconEdit" title="Editar" alt="Editar" />
					</form>
					<form action="Main.php" method="get">						
						<input type="hidden" name="do" value="importClientOrderHistory" />
						<input type="hidden" name="id" value="|-$order->getid()-|" />
						<input type="button" name="submit_go_edit_order" value="Ver Historial" class="iconHistory" title="Ver Historial" alt="Ver Historial" onClick="window.open('Main.php?do=importClientOrderHistory&id=|-$order->getid()-|','History','width=670,height=500,menubar=no,status=no,location=no,toolbar=no,scrollbars=yes');" />
					</form>
<!--					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="importClientQuoteDelete" />
						<input type="hidden" name="id" value="|-$order->getid()-|" />
						<input type="submit" name="submit_go_delete_order" value="Borrar" onclick="return confirm('Seguro que desea eliminar la cotizacion?')" class="iconDelete" />
					</form>
-->
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
