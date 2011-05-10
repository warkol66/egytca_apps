<h2>Exportaciones</h2>
<h1>Pedidos</h1>
<p>A continuación puede ver el listado de sus pedidos de cotización y sus correspondientes estados.</p>

<div id="div_messages">
	|-if $message eq "create-failed"-|
		<div class="successMessage">Se ha producido un error al crear la cotización</div>
	|-elseif $message eq "confirmed"-|
		<div class="successMessage">Cotización confirmada correctamente. Puedo ver su detalle accediendo a este <a href="Main.php?do=importClientQuoteEdit&id=|-$clientQuoteId-|" >link</a></div>
	|-/if-|
</div>


<div id="div_filters">
	<form action="Main.php" method="get">
		<fieldset>
		<p>
			<label for="filters[affiliateStatus]">Estado</label>
			<select name="filters[affiliateStatus]">
					<option value="">Seleccione Un Estado</option>
				|-foreach from=$status item=stat name=for_status-|
					<option value="|-$stat-|" |-if $filters neq '' and $filters.affiliateStatus eq $stat -|selected="selected"|-/if-|>|-$stat-|</option>
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


<div id="div_newsmedias">
	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-newsmedias">
		<thead>
			<tr>
				<th colspan="7" class="thFillTitle">
				</th>
			</tr>
			<tr>
				<th>Id</th>
				<th>Fecha</th>
				<th>Estado</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$orders item=order name=for_orders-|
			<tr>
				<td>|-$order->getId()-|</td>
				<td>|-$order->getCreatedAt()|change_timezone|date_format:"%d-%m-%Y"-|</td>
				<td>|-$order->getStatusNameClient()-|</td>
				<td nowrap="nowrap">
					<form action="Main.php" method="get">						
						<input type="hidden" name="do" value="importClientOrderEdit" />
						<input type="hidden" name="id" value="|-$order->getid()-|" />
						<input type="submit" name="submit_go_edit_order" value="Editar" class="iconEdit" />
					</form>
					<form action="Main.php" method="get">						
						<input type="hidden" name="do" value="importClientOrderHistory" />
						<input type="hidden" name="id" value="|-$order->getid()-|" />
						<input type="button" name="submit_go_edit_order" value="Ver Historial" class="iconHistory" onClick="window.open('Main.php?do=importClientOrderHistory&id=|-$order->getid()-|','History','width=670,height=500,menubar=no,status=no,location=no,toolbar=no,scrollbars=yes');" />
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
				<td colspan="4" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
		</tbody>
	</table>
</div>
