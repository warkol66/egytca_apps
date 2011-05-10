<fieldset>
<legend>Recorrido</legend>
<p>
<input id="generate_route" type="button" value="Generar Recorrido" onClick="routeSheetsMap.generateDirections();this.hide();$('back_to_poly').show()" class="noPrint" />
<input id="back_to_poly" type="button" value="Volver a polilinea" onClick="routeSheetsMap.clearDirections();routeSheetsMap.redrawPolyline($('addresses_list'));this.hide();$('generate_route').show()" class="noPrint" style="display:none;"/>
</p>
<p></p>
<div>
	<ol id="addresses_list" style="float:left;">
	|-foreach from=$results item=result name=for_result-|
		|-foreach from=$result.addresses item=byAddress name=for_byAddress-|
			|-assign var=address value=$byAddress.address-|
			<li id="address_|-$address->getId()-|" style="display:none;" onMouseOver="routeSheetsMap.markerOnMouseOver(routeSheetsMap.markers[this.id])" onMouseOut="routeSheetsMap.markerOnMouseOut(routeSheetsMap.markers[this.id])">|-$address->getName()-|</li>
		|-/foreach-|
	|-/foreach-|
	</ol>
</div>

<div id="map_canvas"></div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="scripts/keydragzoom_packed.js"></script>
<script type="text/javascript" src="scripts/lausi-map-base.js"></script>
<script type="text/javascript" src="scripts/lausi-map-route-sheets.js"></script>

<script type="text/javascript" language="javascript">
	var routeSheetsMap = new RouteSheetsMap();

	routeSheetsMap.initializeMap('map_canvas');
	
	Sortable.create('addresses_list', {
		onUpdate: function(list) {
			routeSheetsMap.redrawPolyline(list);
		}
	});
	
	|-foreach from=$results item=result name=for_result-|
		|-foreach from=$result.addresses item=byAddress name=for_byAddress-|
			|-assign var=address value=$byAddress.address-|
			var loc = new google.maps.LatLng('|-$address->getLatitude()-|', '|-$address->getLongitude()-|');
			var marker = routeSheetsMap.displayMarker('address_|-$address->getId()-|', loc);
			routeSheetsMap.markerOnClick(marker);
		|-/foreach-|
	|-/foreach-|
	
	/**
	 * Inserta tantos input hidden en el form pasado por parámetro
	 * como elementos existan en el listado ordenado.
	 * 
	 * @param Form form, el formulario donde agregar los ids
	 * @param String name, el nombre de los hidden a agregar. 
	 * Por defecto es 'addressesIds[]'. 
	 */
	function addAddressesIdsToForm(form, name) {
		var id;
		var input;
		var p;
		
		if (name === undefined)
			name = 'addressesIds[]';
		
		// Si el parrafo no existe lo creamos, y si existe lo vaciamos
		p = $('addressesIds');	
		if (!p) {
			p = new Element('p', {id: 'addressesIds'});
			//Insertamos el parrafo en el form.
			form.insert({bottom: p});
		} else {
			p.innerHTML = '';
		}
			
		$$('#addresses_list > li').each(function(li) {
			//Si no es visible no lo agregamos
			if (li.visible()) {
				//Extraemos el prefijo "address_" de las ids de los li
				id = li.id.gsub('address_', '');
				
				//Creamos el input.
				input = new Element('input', {
					name: name,
					value: id,
					type: 'hidden'
				});
				
				//Insertamos el input en el parrafo.
				p.insert({bottom: input});
			}
		});
	}
</script>
</fieldset>
