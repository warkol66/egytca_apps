|-if $mapJsVarName ne ''-|
var theMap = |-$mapJsVarName-|;
|-else-|
var theMap = this;
|-/if-|
|-foreach from=$circuits item=circuit-|
	|-assign var=circuitPoints value=$circuit->getCircuitPoints()-|
	|-if $circuitPoints ne '' && $circuitPoints|@count > 2-|
		var polygonDrawing = new google.maps.Polygon({
			map: theMap.map,
			clickable: false,
			fillOpacity: 0.15,
			strokeOpacity: 0.25
		});
		|-if $circuit->getColor() ne ''-|
			polygonDrawing.setOptions({fillColor: '|-$circuit->getColor()-|',strokeColor: '|-$circuit->getColor()-|'});
		|-/if-|
		var pathForPolygon = polygonDrawing.getPath();
		|-foreach from=$circuit->getCircuitPoints() item=circuitPoint-|
			pathForPolygon.push(new google.maps.LatLng('|-$circuitPoint->getLatitude()-|', '|-$circuitPoint->getLongitude()-|'));
		|-/foreach-|
	|-/if-|
|-/foreach-|