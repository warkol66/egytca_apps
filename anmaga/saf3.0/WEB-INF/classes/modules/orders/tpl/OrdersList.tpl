<h2>Pedidos</h2>
<h1>Lista de Pedidos</h1> 
<p>Seleccione alguna opción para filtrar el listado de pedidos. Puede Ediar o Ver los pedidos.<br />
Para exportar ordenes, seleccione los pedidos a exportar y haga click en "Exportar órdenes seleccionadas".<br />
Para eliminar pedidos, seleccione los pedidos a eliminar y haga click en "Eliminar órdenes seleccionadas".</p> 
<div id="div_orders">
|-if $message eq "ok"-|
	<div class="successMessage">Orden guardada correctamente</div>
|-elseif $message eq "deleted_ok"-|
	<div class="successMessage">Orden eliminada correctamente</div>
|-elseif $message eq "orders_deleted_ok"-|
	<div class="successMessage">Ordenes eliminadas correctamente</div>
|-/if-|
	<div class="filter">
<form action="Main.php" method="get">
	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-orders">
	<tr>
		<td nowrap="nowrap" class="tdSearch"><p><label>Desde:</label>&nbsp;<span class="size4">(dd-mm-aaaa)</span>
								<input name="dateFrom" type="text" value="|-$selectedDateFrom-|" size="10">&nbsp;&nbsp;
								<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('dateFrom', false, 'dmy', '-');" title="Seleccione la fecha">&nbsp;&nbsp;
								<label>Hasta:</label>&nbsp;<span class="size4">(dd-mm-aaaa)</span>
								<input name="dateTo" type="text" value="|-$selectedDateTo-|" size="10">&nbsp;&nbsp;
					<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('dateTo', false, 'dmy', '-');" title="Seleccione la fecha"></p>
		<p>							
				<label for="state">Estado</label>
					<select name="state">
						<option value="" selected="selected">Todos</option>
						<option value="0"|-if $selectedState neq '' && $selectedState eq 0-| "selected"|-/if-|>Emitida</option>
						<option value="1"|-$selectedState|selected:1-|>Aceptada</option>
						<option value="2"|-$selectedState|selected:2-|>Pendiente Aprobación</option>
						<option value="3"|-$selectedState|selected:3-|>En Proceso</option>
						<option value="4"|-$selectedState|selected:4-|>Completa</option>
						<option value="5"|-$selectedState|selected:5-|>Cancelada</option>
						<option value="6"|-$selectedState|selected:6-|>A Verificar</option>
						<option value="7"|-$selectedState|selected:7-|>Exportada</option>
					</select>
					&nbsp;&nbsp;&nbsp;<label for="affiliateId">Mayorista</label>
					<select name="affiliateId">
						<option value="" selected="selected">Todos</option>
						|-foreach from=$affiliates item=affiliate-|
						<option value="|-$affiliate->getId()-|"|-if $affiliate->getId() eq $selectedAffiliateId-| "selected"|-/if-|>|-$affiliate->getName()-|</option>
						|-/foreach-|
					</select></p>
				<p><input type="hidden" name="do" id="doList" value="ordersList" />
					<input type="submit" value="Buscar" />
					<input type="reset" value="Quitar filtros" onclick="window.location='Main.php?do=ordersList'">
					</p>
					</td>
				</tr>
			</table>
		</form>
	</div>
<form action="Main.php" method="get">
	<table width="100%" cellpadding="4" cellspacing="0" class="tableTdBorders" id="tabla-orders">
		<thead>
			<tr>
				<th width="10%">Mayorista</th>
				<th width="10%">Fecha</th>
				<th width="10%">Número</th>
				<th width="10%">Usuario</th>
				<th width="25%">Sucursal</th>
				<th width="10%">Total</th>
				<th width="15%">Estado</th>
				<th width="5%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$orders item=order name=for_orders-|
			<tr>
				<td>|-assign var=affiliate value=$order->getAffiliate()-||-if $affiliate-||-$affiliate->getName()-||-/if-|</td>
				<td nowrap>|-$order->getcreated()|date_format:"%d-%m-%Y"-|</td>
				<td nowrap align="right">|-if $order->getNumber() eq 0-||-$order->getId()-||-else-||-$order->getNumber()-||-/if-|</td>
				<td>|-assign var=user value=$order->getAffiliateUser()-||-if $user-||-$user->getUsername()-||-/if-|</td>
				<td>|-assign var=branch value=$order->getAffiliateBranch()-||-if $branch-||-$branch->getName()-||-/if-|</td>
				<td align="right">|-$order->gettotal()|system_numeric_format-|</td>
				<td nowrap>|-$order->getStateName()-|</td>
				<td nowrap>
					<input type="button" onclick="javascript:window.location.href='Main.php?do=ordersView&id=|-$order->getid()-|&page=|-$page-|'" value="Ver" class="icon iconView" />
					<input type="button" onclick="javascript:window.location.href='Main.php?do=ordersEdit&id=|-$order->getid()-|&page=|-$page-|'" value="Editar" class="icon iconEdit" />
					|-if $all eq "0"-|
					<input type="button" onclick="javascript:window.location.href='Main.php?do=ordersDoAddToCart&id=|-$order->getid()-|'" value="Add To Cart" class="icon iconAddToCart" />
					|-/if-|
				<input type="checkbox" name="orders[]" value="|-$order->getid()-|" />									</td>
			</tr>
		|-/foreach-|
			|-if isset($loginUser)-|<tr>
				<td colspan="8" class="tdSize1 right"><label for="selectAllBoxes">Seleccionar todo</label> 
		<input name="allbox" onclick="javascript:CheckAllBoxes(this.form)" type="checkbox"></td>
			</tr>|-/if-|
		|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
			<tr> 
				<td colspan="8" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>|-/if-|
	|-if isset($loginUser)-|		<tr> 
				<td colspan="8" class="tdSearch">	<input type="hidden" id="doActions" name="do" value="" />

	<input type="button" onclick="ordersSendOrdersExport(this.form)" value="Exportar órdenes seleccionadas"/>&nbsp;&nbsp;&nbsp;
	<input type="button" onclick="ordersSendOrdersExportSaf(this.form)" value="Consolidar órdenes seleccionadas" />&nbsp;&nbsp;&nbsp;
	<input type="button" onclick="ordersSendOrdersDelete(this.form)" value="Eliminar órdenes seleccionadas" />
</td> 
			</tr>|-/if-|
		</tbody>
	</table>
</form>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
