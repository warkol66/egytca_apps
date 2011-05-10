<!-- mapa google -->
<div id="map_container" style="display:none">
	<div><ul id="directions_results" style="display:none"></ul></div>
|-include file="LausiMapHelpInclude.tpl"-|
	<div id="map_canvas"></div>
	<br />
	<p>
		<input id="hide_map" type="button" value="Ocultar mapa" title="Ocultar mapa" onClick="$('map_container').hide();$('show_map').show()"/>
	</p>
</div>
<p><input id="show_map" type="button" value="Mostrar mapa" title="Mostrar mapa" onClick="$('map_container').show(); this.hide()" style="display:none;"/></p>
<!-- fin mapa google -->

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="scripts/keydragzoom_packed.js"></script>
<script type="text/javascript" src="scripts/lausi-map-base.js"></script>
<script type="text/javascript" src="scripts/lausi-map-address.js"></script>

<script type="text/javascript">
	var addressMap = new AddressMap();
	var latlng = new google.maps.LatLng(|-if $address->getLatitude() ne '' && $address->getLongitude() ne ''-|'|-$address->getLatitude()-|', '|-$address->getLongitude()-|'|-else-|'-34.649', '-58.456'|-/if-|);
	addressMap.mapOptions.zoom = |-if $address->getId() ne ''-|16|-else-|12|-/if-|;
	addressMap.mapOptions.zoom = latlng;
	
	addressMap.drawCircuits = function() {
		|-include file="LausiCircuitsDraw.tpl"-|
	}
</script>
