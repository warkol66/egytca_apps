<h2>Exportaciones</h2>
<h1>Información General del Pedido</h1>
|-if $message eq "ok"-|
	<div class='successMessage'>Información guardada correctamente</div>
|-/if-|
<div id="div_general_information">
	<p>
		Fecha de Creación: |-$supplierPurchaseOrder->getCreatedAt()|change_timezone|date_format:"%d-%m-%Y"-|
	</p>
	<p>
		Estado: |-$supplierPurchaseOrder->getStatusName()-|
	</p>
<fieldset>
<form name="form_edit_shipment" id="form_edit_shipment" action="Main.php" method="post">
<p><label for="estimatedDeliveryDate">Fecha estimada de entrega</label>
	<input type="text" name="params[estimatedDeliveryDate]" cols="70" rows="7" wrap="virtual" id="estimatedDeliveryDate" title="Fecha de retiro de la mercancia" value="|-$supplierPurchaseOrder->getEstimatedDeliveryDate()|date_format:"%d-%m-%Y"-|"/>
	<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('params[estimatedDeliveryDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
</p>

<p>
	<input type="hidden" name="id" id="id" value="|-$supplierPurchaseOrder->getId()-|" />
	<input type="hidden" name="do" id="do" value="importSupplierOrderDoEdit" />
	<input type="submit" id="button_edit_shipment" name="button_edit_shipment" title="Aceptar" value="Aceptar" />
</p>
</form>
</fieldset>


</div>


<div id="supplierQuoteItemsHolder">
		|-include file='ImportSupplierOrdertemsListInclude.tpl' supplierPurchaseOrder=$supplierPurchaseOrder-|
</div>