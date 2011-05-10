<h2>Exportaciones</h2>
<h1>Seguimiento de Pedido</h1>
<p>En el siguiente formulario puede guardar información referente al reporte de seguimiento de fabricación del pedido <strong>"|-$supplierPurchaseOrder->getId()-|"</strong>.<br />
Seleccione un estado para el pedido y agregue un comentario. Para guardar, haga click en "Guardar Reporte de Seguimiento".</p>

<div id="div_general_information">
	<p>
		Fecha de Creación del Pedido: |-$supplierPurchaseOrder->getCreatedAt()|change_timezone|date_format:"%d-%m-%Y"-|
	</p>
	<p>
		Estado Actual: |-$supplierPurchaseOrder->getStatusName()-|	<form action="Main.php" method="get" style="display:inline">						
						<input type="hidden" name="do" value="importSupplierOrderHistory" />
						<input type="hidden" name="id" value="$supplierPurchaseOrder->getId()" />
						<input type="button" name="submit_go_edit_order" value="Ver Historial" title="Ver Historial" alt="Ver Historial" onClick="window.open('Main.php?do=importSupplierOrderHistory&id=|-$supplierPurchaseOrder->getid()-|','History','width=670,height=500,menubar=no,status=no,location=no,toolbar=no,scrollbars=yes');" />
					</form></p>
</div>

<div id="supplierQuoteTracking">
	<form action="Main.php" method="post">
		<fieldset>
		<legend>Seguimiento</legend>
		<p>
			<label for="status">Seleccione Estado</label>
			<select name="status" id="status">
				|-foreach from=$status key=key item=stat name=for_possible_status-|
				<option value="|-$key-|">|-$stat-|</option>
				|-/foreach-|
			</select>
		</p>
		<p>
			<label for="comment">Información sobre el Cambio de Estado</label>
			<textarea name="comment" rows="8" cols="60" wrap="virtual"></textarea>
		</p>
		<p>
			<input type="hidden" name="id" value="|-$supplierPurchaseOrder->getId()-|" />
			<input type="hidden" name="do" value="importSupplierOrderDoTracking" />
			<input type="submit" value="Guardar Reporte de Seguimiento" />
		</p>
		</fieldset>
	</form>
</div>