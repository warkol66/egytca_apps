<h2>Exportaciones</h2>
<h1>Información de Embarque</h1>

<div id="div_shipment">
	<form name="form_edit_shipment" id="form_edit_shipment" action="Main.php" method="post">
		|-if $message eq "error"-|
			<div class="failureMessage">Ha ocurrido un error al intentar guardar el embarque</div>
		|-/if-|
		<p>|-if $action eq 'edit'-|Modifique los datos del Embarque y haga click en "Aceptar" para guardar el cambio|-else-|Ingrese los datos del Embarque y haga click en "Aceptar"|-/if-|.
		</p>
		<fieldset title="Formulario de edición de datos de un embarque">
		<legend>Embarque</legend>
			|-assign var=supplierPurchaseOrder value=$shipment->getSupplierPurchaseOrder()-|
			|-assign var=supplier value=$supplierPurchaseOrder->getSupplier()-|
			<p>
				<label for="order_numer">Número de Orden</label>
				<span id="order_numer" title="Número de Orden" >|-$shipment->getSupplierPurchaseOrderId()-|</span>
			</p>
			<p>
				<label for="supplier">Proveedor</label>
				<span id="order_numer" title="Proveedor" >|-$supplier->getName()-|</span>
			</p>
			
			|-foreach from=$supplierPurchaseOrder->getSupplierPurchaseOrderItems() item=item-|
				|-assign var=product value=$item->getProduct()-|
				|-assign var=port value=$item->getPort()-|
				<div id="item_|-$item->getId()-|" class="item">
					<p>
						<label for="product">Producto</label>
						<span id="product" title="Producto" >|-$product->getName()-|</span>
						<a href="#" onClick="$$('#item_|-$item->getId()-| > div.itemInfo')[0].toggle(); return false;">Ver Detalle</a>
					</p>
					<div class="itemInfo" style="display: none;">
						<p>
							<label for="quantity_|-$item->getId()-|">Cantidad</label>
							<span id="quantity_|-$item->getId()-|" title="Cantidad" >|-$item->getQuantity()-|</span>
						</p>
						<p>
							<label for="weight_|-$item->getId()-|">Peso Total</label>
							<span id="weight_|-$item->getId()-|" title="Peso Total" >|-$item->getTotalWeigth()-|</span>
						</p>
						<p>
							<label for="volume_|-$item->getId()-|">Volumen Total</label>
							<span id="volume_|-$item->getId()-|" title="Volumen Total" >|-$item->getTotalVolume()-|</span>
						</p>	
						<p>
							<label for="departurePortName_|-$item->getId()-|">Puerto de salida</label>
							<span id="departurePortName_|-$item->getId()-|" title="Puerto de salida">|-$port->getName()-|</span>
						</p>
						<p>
						|-assign var=container value=$item->getRecommendedContainer()-|	
							<label for="estimatedRequiredContainers_|-$item->getId()-|">Containers requeridos (estimados)</label>
							<span id="estimatedRequiredContainers_|-$item->getId()-|" title="Containers requeridos (estimados)" >|-$item->getRecommendedContainersQuantity()|number_format:3:",":"."-| contenedores de |-$container.type-|</span>
						</p>
					</div>
				</div>
			|-/foreach-|
			|-assign var=totalContainersQuantity value=$supplierPurchaseOrder->getContainersQuantityAssoc()-|	
			<p>
				<label for="estimatedRequiredContainers">Containers requeridos (estimados)</label>
				<span id="estimatedRequiredContainers" title="Containers requeridos (estimados)" >
				|-foreach from=$totalContainersQuantity key=type item=quantity-|
					|-$quantity|number_format:3:",":"."-| contenedores de |-$type-|<br />
				|-/foreach-|
				</span>
			</p>
			<p>
				<label for="requiredContainers20">Containers utilizados (reales) de 20'</label>
				<input type="text" name="shipment[containersRealCount20]" cols="70" rows="7" wrap="virtual" id="requiredContainers20" title="Containers utilizados (reales) de 20'" value="|-$shipment->getContainersRealCount20()-|"/>
			</p>
			<p>
				<label for="requiredContainers40">Containers utilizados (reales) de 40'</label>
				<input type="text" name="shipment[containersRealCount40]" cols="70" rows="7" wrap="virtual" id="requiredContainers40" title="Containers utilizados (reales) de 40'" value="|-$shipment->getContainersRealCount40()-|"/>
			</p>
			<p>
				<label for="containersNumbers">Números de los contenedores</label>
				<textarea name="shipment[containersNumbers]" cols="60" rows="7" wrap="virtual" id="containersNumbers" title="Números de los contenedores" >|-$shipment->getContainersNumbers()-|</textarea>
			</p>
																		
			<p>
				<label for="estimatedFactoryDate">Fecha estimada de la conclusión de la fabricación</label>
				<span id="estimatedFactoryDate" title="Fecha estimada de la conclusión de la fabricación" >|-$supplierPurchaseOrder->getEstimatedDeliveryDate()|date_format:"%d-%m-%Y"-|</span>
			</p>	
			<p>
				<label for="factoryDate">Fecha de conclusión de fabricación</label>
				<span id="factoryDate" title="Fecha de conclusión de fabricación" >|-$supplierPurchaseOrder->getFabricationDate()|date_format:"%d-%m-%Y"-|</span>
			</p>
			<p>
				<label for="pickupDate">Fecha de retiro de la mercancia</label>
				<input type="text" name="shipment[pickupDate]" cols="70" rows="7" wrap="virtual" id="pickupDate" title="Fecha de retiro de la mercancia" value="|-$shipment->getPickupDate()|date_format:"%d-%m-%Y"-|"/>
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('shipment[pickupDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="shipmentDate">Fecha de embarque</label>
				<input type="text" name="shipment[shipmentDate]" cols="70" rows="7" wrap="virtual" id="shipmentDate" title="Fecha de embarque" value="|-$shipment->getShipmentDate()|date_format:"%d-%m-%Y"-|"/>
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('shipment[shipmentDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="blNumber">BL Hawb</label>
				<input type="text" name="shipment[blNumber]" cols="70" rows="7" wrap="virtual" id="blNumber" title="BL Hawb" value="|-$shipment->getBlNumber()-|"/>
			</p>
			<p>
				<label for="vesselName">Nombre del buque</label>
				<input type="text" name="shipment[vesselName]" cols="70" rows="7" wrap="virtual" id="vesselName" title="Nombre del buque" value="|-$shipment->getVesselName()-|"/>
			</p>
			<p>
				<label for="estimatedDepartureDate">Fecha estimada de partida del buque</label>
				<input type="text" name="shipment[estimatedDepartureDate]" cols="70" rows="7" wrap="virtual" id="estimatedDepartureDate" title="Fecha estimada de partida del buque" value="|-$shipment->getEstimatedDepartureDate()|date_format:"%d-%m-%Y"-|"/>
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('shipment[estimatedDepartureDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="departureDate">Fecha de partida del buque</label>
				<input type="text" name="shipment[departureDate]" cols="70" rows="7" wrap="virtual" id="departureDate" title="Fecha de partida del buque" value="|-$shipment->getDepartureDate()|date_format:"%d-%m-%Y"-|"/>
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('shipment[departureDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="arrivalPort">Puerto de llegada</label>
				<select id="arrivalPort" name="shipment[arrivalPort]" title="Puerto de llegada">
					<option value="0">-- Selecciones uno --</option>
					|-foreach from=$ports item=port-|
						<option value="|-$port->getId()-|">|-$port->getName()-|</option>
					|-/foreach-|
				</select>
			</p>
			<p>
				<label for="arrivalToPanamaDate">Fecha de llegada a Panama</label>
				<input type="text" name="shipment[arrivalToPanamaDate]" cols="70" rows="7" wrap="virtual" id="arrivalToPanamaDate" title="Fecha de llegada a Panama" value="|-$shipment->getArrivalToPanamaDate()|date_format:"%d-%m-%Y"-|"/>
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('shipment[arrivalToPanamaDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="transshipmentDate">Fecha de transbordo</label>
				<input type="text" name="shipment[transshipmentDate]" cols="70" rows="7" wrap="virtual" id="transshipmentDate" title="Fecha de transbordo" value="|-$shipment->getTransshipmentDate()|date_format:"%d-%m-%Y"-|"/>
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('shipment[transshipmentDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="telexRelease">Telex release</label>
				<input type="checkbox" name="shipment[telexRelease]" cols="70" rows="7" wrap="virtual" id="departureDate" title="Telex release" value="|-$shipment->getTelexRelease()-|"/>
			</p>
			<p>
				<label for="estimatedArrivalDate">Fecha estimada de llegada del buque a puerto</label>
				<input type="text" name="shipment[estimatedArrivalDate]" cols="70" rows="7" wrap="virtual" id="estimatedArrivalDate" title="Fecha estimada de llegada del buque a puerto" value="|-$shipment->getEstimatedArrivalDate()|date_format:"%d-%m-%Y"-|"/>
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('shipment[estimatedArrivalDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			<p>
				<label for="arrivalDate">Fecha de llegada a puerto</label>
				<input type="text" name="shipment[arrivalDate]" cols="70" rows="7" wrap="virtual" id="arrivalDate" title="Fecha de llegada a puerto" value="|-$shipment->getArrivalDate()|date_format:"%d-%m-%Y"-|"/>
				<img src="images/calendar.png" width="16" height="15" border="0" onclick="displayDatePicker('shipment[arrivalDate]', false, '|-$parameters.dateFormat.value|lower|replace:'-':''-|', '-');" title="Seleccione la fecha">
			</p>
			
			<p>
				<input type="hidden" name="id" id="id" value="|-$shipment->getid()-|" />
				<input type="hidden" name="shipmentReleaseId" id="shipmentReleaseId" value="|-$shipmentReleaseId-|" />
				<input type="hidden" name="shipment[supplierPurchaseOrderId]" id="shipment[supplierPurchaseOrderId]" value="|-$shipment->getSupplierPurchaseOrderId()-|" />
				<input type="hidden" name="do" id="do" value="importShipmentsDoEdit" />
				<input type="submit" id="button_edit_shipment" name="button_edit_shipment" title="Aceptar" value="Aceptar" />
				<input type="button" title="Cancelar" value="Cancelar" onClick="javascript: history.go(-1);" />
			</p>
		</fieldset>
	</form>
</div>

<div id="div_supplier_info">
	<fieldset title="Información de contacto del proveedor">
		<legend>Información de contacto del proveedor</legend>
		<p>
			<label for="name">Nombre</label>
			<span id="name" title="Nombre" >|-$supplier->getName()-|</span>
		</p>
		<p>
			<label for="address">Dirección</label>
			<span id="address" title="Dirección" >|-$supplier->getAddress()-|</span>
		</p>
		<p>
			<label for="phone_number">Número Telefónico</label>
			<span id="phone_number" title="Número Telefónico" >|-$supplier->getPhoneNumber()-|</span>
		</p>
		<p>
			<label for="email">E-Mail</label>
			<span id="email" title="E-Mail" >|-$supplier->getEmail()-|</span>
		</p>
		<p>
			<label for="contact_name">Nombre de Contacto</label>
			<span id="contact_name" title="Nombre de Contacto" >|-$supplier->getContactName()-|</span>
		</p>
	</fieldset>
</div>