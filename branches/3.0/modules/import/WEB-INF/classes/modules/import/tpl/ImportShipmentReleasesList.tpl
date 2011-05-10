<h2>Exportaciones</h2>
<h1>Productos sujetos al trámite de nacionalización</h1>
<p>A continuación puede ver el listado de productos sujetos al trámite de nacionalización.</p>

<div id="div_messages">
	|-if $message eq "ok"-|
		<div class="successMessage">Se ha guardado la información de nacionalización exitosamente.</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Se ha borrado la información de nacionalización exitosamente.</div>
	|-elseif $message eq "deleted_error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar borrar la información de nacionalización</div>
	|-elseif $message eq "error"-|
		<div class="failureMessage">Ha ocurrido un error al intentar guardar la información de nacionalización</div>
	|-/if-|
</div>

<div id="div_filters">
	<form action="Main.php" method="get">
		<fieldset>
		<p>
			<label for="filters[searchSupplierId]">Proveedor</label>
			<select name="filters[searchSupplierId]">
					<option value="">Seleccione Un Proveedor</option>
				|-foreach from=$suppliers item=supplier name=for_suppliers-|
					<option value="|-$supplier->getId()-|" |-if $filters neq '' and $filters.searchSupplierId eq $supplier->getId() -|selected="selected"|-/if-|>|-$supplier->getName()-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<label for="filters[searchStatus]">Estado</label>
			<select name="filters[searchStatus]">
					<option value="">Seleccione Un Estado</option>
				|-foreach from=$status key=key item=stat name=for_status-|
					<option value="|-$key-|" |-if $filters neq '' and $filters.searchStatus eq $key -|selected="selected"|-/if-|>|-$stat|multilang_get_translation:"import"-|</option>
				|-/foreach-|
			</select>
		</p> 
		<p>
			<input type="hidden" name="do" value="importShipmentReleasesList" />
			<input type="submit" value="Aplicar Filtro"/>
		</p>
		</fieldset>
	</form>
</div>


<div id="div_orders">
	<table cellpadding="4" cellspacing="0" class="tableTdBorders" id="table-shipments">
		<thead>
			<tr>
				<th colspan="7" class="thFillTitle">
				</th>
			</tr>
			<tr>
				<th>Id</th>
				<th>Número de BL</th>
				<th>Productos</th>
				<th>Cantidad de Containers</th>
				<th>Nros de los Containers</th>
				<th>Estado</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$shipmentReleases item=shipmentRelease name=for_orders-|
			|-assign var=shipment value=$shipmentRelease->getShipment()-|
			|-assign var=supplierPurchaseOrder value=$shipment->getSupplierPurchaseOrder()-|
			<tr valign="top">
				<td>|-$shipmentRelease->getId()-|</td>
				<td>|-$shipment->getBlNumber()-|</td>
				<td>
					|-assign var=items value=$supplierPurchaseOrder->getSupplierPurchaseOrderItems()-|
					|-if $items|@count eq 0-|
						No hay productos en la solicitud
					|-else-|
					|-foreach from=$items item=item name=for_shipmentReleases_item-|
						|-assign var=product value=$item->getProduct()-|
						|-$product->getName()-|
						|-if not $smarty.foreach.for_shipmentReleases_item.last-|<br />|-/if-|
					|-/foreach-|
					|-/if-|
				</td>
				<td>
					|-$shipment->getContainersRealCount20()|number_format:3:",":"."-| de 20' <br />
					|-$shipment->getContainersRealCount40()|number_format:3:",":"."-| de 40'
				</td>
				<td>
					|-$shipment->getContainersNumbers()-|
				</td>
				<td>|-$shipmentRelease->getStatusName()|multilang_get_translation:"import"-|</td>
				<td nowrap="nowrap">
					<form action="Main.php" method="get">						
						<input type="hidden" name="do" value="importShipmentReleasesEdit" />
						<input type="hidden" name="id" value="|-$shipmentRelease->getid()-|" />
						<input type="submit" name="submit_go_edit_shipmentRelease" value="Editar" class="iconEdit" title="Editar" alt="Editar" />
					</form>
					<form action="Main.php" method="post">						
						<input type="hidden" name="do" value="importShipmentReleasesDoDelete" />
						<input type="hidden" name="id" value="|-$shipmentRelease->getid()-|" />
						<input type="submit" name="submit_go_delete_shipmentRelease" value="Eliminar" class="iconDelete" title="Eliminar" alt="Eliminar" onClick="return confirm('¿Está seguro que desea eliminar la información de nacionalización?');" />
					</form>
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
