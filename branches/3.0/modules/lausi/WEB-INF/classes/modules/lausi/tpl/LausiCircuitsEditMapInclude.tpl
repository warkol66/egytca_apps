<fieldset>
<legend>Circuito</legend>
|-include file="LausiMapHelpInclude.tpl" help="circuit"-|
<div id="point_dummy_container">
	<div id="point_dummy">
		<input type="hidden" id="point_dummy_latitude" name="circuitPoints[point_dummy][params][latitude]" value="" />
		<input type="hidden" id="point_dummy_longitude" name="circuitPoints[point_dummy][params][longitude]" value="" />
		<input type="hidden" id="point_dummy_circuitId" name="circuitPoints[point_dummy][params][circuitId]" value="|-$circuit->getId()-|" />
	</div>
</div>

<div id="map_canvas"></div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="scripts/keydragzoom_packed.js"></script>
<script type="text/javascript" src="scripts/lausi-map-base.js"></script>
<script type="text/javascript" src="scripts/lausi-map-circuit.js"></script>

<script type="text/javascript" language="javascript">
	var circuitMap = new CircuitMap();
	
	circuitMap.initializeMap("map_canvas");
	circuitMap.markersDraggables = true;
	circuitMap.mapClickable = true;
	
	|-foreach from=$circuitPoints key=key item=point-|
		var loc = new google.maps.LatLng('|-$point->getLatitude()-|', '|-$point->getLongitude()-|');
		var marker = circuitMap.displayMarker('point_|-$key-|', loc, 'pinBlue');
		marker.setIcon('images/pin_blue.png');
		circuitMap.polyLine.getPath().push(loc);
	|-/foreach-|
	
	|-if $circuit->getColor() ne ''-|
		circuitMap.polygon.setOptions({fillColor:'|-$circuit->getColor()-|',strokeColor: '|-$circuit->getColor()-|'});
	|-/if-|
	
	|-if $circuitPoints|@count > 2-|
		circuitMap.closePolygon();
	|-/if-|
	
	|-include file="LausiCircuitsDraw.tpl" mapJsVarName="circuitMap"-|
</script>
</fieldset>