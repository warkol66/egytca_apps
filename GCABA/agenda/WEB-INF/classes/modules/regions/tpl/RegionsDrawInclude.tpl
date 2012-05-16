|-if $mapJsVarName ne ''-|
var theMap = |-$mapJsVarName-|;
|-else-|
var theMap = this;
|-/if-|
|-foreach from=$regions item=region-|
	|-assign var=regionPoints value=$region->getRegionPoints()-|
	|-if $regionPoints ne '' && $regionPoints|count > 2-|
		var polygonDrawing = new google.maps.Polygon({
			map: theMap.map,
			clickable: false,
			fillOpacity: 0.15,
			strokeOpacity: 0.25
		});
		var pathForPolygon = polygonDrawing.getPath();
		polygonDrawing.setOptions({fillColor: '#ff0000',strokeColor: '#ff0000'}); // $region->getColor()?
		|-foreach from=$regionPoints item=regionPoint-|
			pathForPolygon.push(new google.maps.LatLng('|-$regionPoint->getLatitude()-|', '|-$regionPoint->getLongitude()-|'));
		|-/foreach-|
	|-/if-|
|-/foreach-|