|-popup_init src="scripts/overlib.js"-|
<h2>Exportaciones</h2>
<h1>Cotizaciones de Clientes</h1>
<p>A continuación puede ver el listado de sus solicitudes de cotización y sus correspondiente estado.</p>

<div id="div_messages">
	|-if $message eq "create-failed"-|
		<div class="successMessage">Se ha producido un error al crear la cotización</div>
	|-elseif $message eq "confirmed"-|
		<div class="successMessage">Cotización confirmada correctamente. Puedo ver su detalle accediendo a este <a href="Main.php?do=importClientQuoteEdit&id=|-$clientQuoteId-|" >link</a></div>
	|-elseif $message eq "quoted"-|
		<div class="successMessage">Cotización cerrada. Se han confirmado los precios al cliente. Puedo ver su detalle accediendo a este <a href="Main.php?do=importClientQuoteEdit&id=|-$clientQuoteId-|" >link</a></div>
	|-/if-|
</div>

<div id="div_filters">
	<form action="Main.php" method="get">
		<fieldset>
		<p>
			<label for="filters[affiliateId]">Cliente</label>
			<select name="filters[affiliateId]">
					<option value="">Seleccione Un Cliente</option>
				|-foreach from=$affiliates item=client name=for_suppliers-|
					<option value="|-$client->getId()-|" |-if $filters neq '' and $filters.affiliateId eq $client->getId() -|selected="selected"|-/if-|>|-$client->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<label for="filters[productName]">Producto</label>
			<input type="text" name="filters[productName]" value="|-if $filters neq '' and $filters.productName neq '' -||-$filters.productName-||-/if-|" id="filters">
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
			<input type="hidden" name="do" value="importClientQuoteList" />
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
						<form action="Main.php" method="post" >
							<select name="clientQuote[affiliateId]">
									<option value="">Seleccione un cliente</option>
								|-foreach from=$affiliates item=affiliate name=for_affiliates-|
									<option value="|-$affiliate->getId()-|">|-$affiliate->getName()-|</option>
								|-/foreach-|
							</select>
							<input type="hidden" name="do" value="importClientQuoteCreate" />
							<input type="submit" value="Crear Nueva Cotización" />
						</form>
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
		|-foreach from=$quotes item=quote name=for_quotes-|
			<tr valign="top">
				<td>|-$quote->getId()-|</td>
				<td><img src="images/clear.gif" class="aqua|-*$smarty.foreach.for_quotes.iteration*-||-php-|echo rand(1,10);|-/php-|" /></td>
				<td>
					|-assign var=client value=$quote->getAffiliate()-|
					|-$client->getName()-|
				</td>
				<td>|-$quote->getCreatedAt()|change_timezone|date_format:"%d-%m-%Y"-|</td>
				<td>|-$quote->getStatusNameAdmin()-|</td>
				<td>|-assign var=items value=$quote->getClientQuoteItems()-|
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
						<input type="hidden" name="do" value="importClientQuoteEdit" />
						<input type="hidden" name="id" value="|-$quote->getid()-|" />
						<input type="submit" name="submit_go_edit_quote" value="Editar" class="iconEdit" title="Editar" alt="Editar" />
					</form>
					<form action="Main.php" method="get">						
						<input type="hidden" name="do" value="importClientQuoteHistory" />
						<input type="hidden" name="id" value="|-$quote->getid()-|" />
						<input type="submit" name="submit_go_edit_quote" value="Ver Historial" class="iconHistory" title="Ver Historial" alt="Ver Historial" onClick="window.open('Main.php?do=importClientQuoteHistory&id=|-$quote->getid()-|','History','width=670,height=500,menubar=no,status=no,location=no,toolbar=no,scrollbars=yes');" />
					</form>
<!--					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="importClientQuoteDelete" />
						<input type="hidden" name="id" value="|-$quote->getid()-|" />
						<input type="submit" name="submit_go_delete_quote" value="Borrar" onclick="return confirm('Seguro que desea eliminar la cotizacion?')" class="iconDelete" />
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
